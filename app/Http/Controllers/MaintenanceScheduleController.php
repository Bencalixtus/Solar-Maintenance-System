<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\MaintenanceRecord;
use App\Models\MaintenanceSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MaintenanceScheduleController extends Controller
{
    /**
     * Display all maintenance schedules.
     */
    public function index()
    {
        $today = Carbon::today();

        $schedules = MaintenanceSchedule::with([
            'component.installation',
            'component.componentType',
        ])
            ->orderBy('next_due_date')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Synchronize Schedule Status
        |--------------------------------------------------------------------------
        |
        | The system automatically changes the schedule status according
        | to the next due date.
        |
        | Future date  = Scheduled
        | Today        = Due
        | Past date    = Overdue
        | Completed    = Remains Completed
        |
        */

        foreach ($schedules as $schedule) {

            // Completed schedules should remain completed.
            if ($schedule->status === 'Completed') {
                continue;
            }

            // If there is no next due date, leave the current status.
            if (!$schedule->next_due_date) {
                continue;
            }

            if ($schedule->next_due_date->lt($today)) {
                $newStatus = 'Overdue';
            } elseif ($schedule->next_due_date->equalTo($today)) {
                $newStatus = 'Due';
            } else {
                $newStatus = 'Scheduled';
            }

            if ($schedule->status !== $newStatus) {
                $schedule->update([
                    'status' => $newStatus,
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Recalculate Summary Counts
        |--------------------------------------------------------------------------
        */

        $totalSchedules = $schedules->count();

        $overdueSchedules = $schedules
            ->where('status', 'Overdue')
            ->count();

        $dueToday = $schedules
            ->where('status', 'Due')
            ->count();

        $upcomingSchedules = $schedules->filter(function ($schedule) use ($today) {
            return $schedule->next_due_date
                && $schedule->next_due_date->gt($today)
                && $schedule->next_due_date->lte(
                    $today->copy()->addDays(7)
                )
                && $schedule->status !== 'Completed';
        })->count();

        $completedSchedules = $schedules
            ->where('status', 'Completed')
            ->count();

        return view(
            'maintenance-schedules.index',
            compact(
                'schedules',
                'totalSchedules',
                'overdueSchedules',
                'dueToday',
                'upcomingSchedules',
                'completedSchedules'
            )
        );
    }

    /**
     * Show the create maintenance schedule form.
     */
    public function create()
    {
        $components = Component::with([
            'installation',
            'componentType',
        ])
            ->where('status', '!=', 'Replaced')
            ->orderBy('name')
            ->get();

        return view(
            'maintenance-schedules.create',
            compact('components')
        );
    }

    /**
     * Store a new maintenance schedule.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'component_id' => [
                'required',
                'exists:components,id',
            ],

            'maintenance_task' => [
                'required',
                'string',
                'max:255',
            ],

            'frequency' => [
                'required',
                'in:Weekly,Monthly,Quarterly,Semi-Annually,Annually,As Needed',
            ],

            'last_maintenance_date' => [
                'nullable',
                'date',
            ],

            'next_due_date' => [
                'required',
                'date',
            ],

            'priority' => [
                'required',
                'in:Low,Medium,High,Critical',
            ],

            'status' => [
                'required',
                'in:Scheduled,Due,Overdue,Completed',
            ],
        ]);

        MaintenanceSchedule::create($validated);

        return redirect()
            ->route('maintenance-schedules.index')
            ->with(
                'success',
                'Maintenance schedule created successfully.'
            );
    }

    /**
     * Display a maintenance schedule.
     */
    public function show(MaintenanceSchedule $maintenanceSchedule)
    {
        $maintenanceSchedule->load([
            'component.installation',
            'component.componentType',
        ]);

        return view(
            'maintenance-schedules.show',
            compact('maintenanceSchedule')
        );
    }

    /**
     * Show the edit maintenance schedule form.
     */
    public function edit(MaintenanceSchedule $maintenanceSchedule)
    {
        $components = Component::with([
            'installation',
            'componentType',
        ])
            ->where('status', '!=', 'Replaced')
            ->orderBy('name')
            ->get();

        return view(
            'maintenance-schedules.edit',
            compact(
                'maintenanceSchedule',
                'components'
            )
        );
    }

    /**
     * Update a maintenance schedule.
     */
    public function update(
        Request $request,
        MaintenanceSchedule $maintenanceSchedule
    ) {
        $validated = $request->validate([
            'component_id' => [
                'required',
                'exists:components,id',
            ],

            'maintenance_task' => [
                'required',
                'string',
                'max:255',
            ],

            'frequency' => [
                'required',
                'in:Weekly,Monthly,Quarterly,Semi-Annually,Annually,As Needed',
            ],

            'last_maintenance_date' => [
                'nullable',
                'date',
            ],

            'next_due_date' => [
                'required',
                'date',
            ],

            'priority' => [
                'required',
                'in:Low,Medium,High,Critical',
            ],

            'status' => [
                'required',
                'in:Scheduled,Due,Overdue,Completed',
            ],
        ]);

        $maintenanceSchedule->update($validated);

        return redirect()
            ->route('maintenance-schedules.index')
            ->with(
                'success',
                'Maintenance schedule updated successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Complete Maintenance
    |--------------------------------------------------------------------------
    */

    /**
     * Show the Complete Maintenance form.
     */
    public function complete(MaintenanceSchedule $maintenanceSchedule)
    {
        // Prevent completing an already completed schedule.
        if ($maintenanceSchedule->status === 'Completed') {
            return redirect()
                ->route('maintenance-schedules.index')
                ->with(
                    'error',
                    'This maintenance schedule has already been completed.'
                );
        }

        $maintenanceSchedule->load([
            'component.installation',
            'component.componentType',
        ]);

        $technicians = User::orderBy('name')->get();

        return view(
            'maintenance-schedules.complete',
            compact(
                'maintenanceSchedule',
                'technicians'
            )
        );
    }

    /**
     * Save completed maintenance and create a maintenance record.
     */
    public function storeCompleted(
        Request $request,
        MaintenanceSchedule $maintenanceSchedule
    ) {
        // Prevent duplicate completion.
        if ($maintenanceSchedule->status === 'Completed') {
            return redirect()
                ->route('maintenance-schedules.index')
                ->with(
                    'error',
                    'This maintenance schedule has already been completed.'
                );
        }

        $validated = $request->validate([
            'technician_id' => [
                'required',
                'exists:users,id',
            ],

            'maintenance_type' => [
                'required',
                'in:Preventive,Corrective,Inspection,Emergency,Replacement',
            ],

            'maintenance_date' => [
                'required',
                'date',
            ],

            'description' => [
                'required',
                'string',
            ],

            'condition_before' => [
                'required',
                'in:Excellent,Good,Fair,Poor,Critical',
            ],

            'action_taken' => [
                'required',
                'string',
            ],

            'condition_after' => [
                'required',
                'in:Excellent,Good,Fair,Poor,Critical',
            ],

            'next_due_date' => [
                'nullable',
                'date',
                'after_or_equal:maintenance_date',
            ],

            'remarks' => [
                'nullable',
                'string',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Maintenance Record + Update Schedule
        |--------------------------------------------------------------------------
        |
        | Both operations happen inside one database transaction.
        | If one operation fails, the other is also rolled back.
        |
        */

        DB::transaction(function () use (
            $validated,
            $maintenanceSchedule
        ) {
            MaintenanceRecord::create([
                'component_id' => $maintenanceSchedule->component_id,

                'technician_id' => $validated['technician_id'],

                'maintenance_type' => $validated['maintenance_type'],

                'maintenance_date' => $validated['maintenance_date'],

                'description' => $validated['description'],

                'condition_before' => $validated['condition_before'],

                'action_taken' => $validated['action_taken'],

                'condition_after' => $validated['condition_after'],

                'next_due_date' => $validated['next_due_date'] ?? null,

                'status' => 'Completed',

                'remarks' => $validated['remarks'] ?? null,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Update Maintenance Schedule
            |--------------------------------------------------------------------------
            */

            $maintenanceSchedule->update([
                'last_maintenance_date' => $validated['maintenance_date'],

                'next_due_date' => $validated['next_due_date'] ?? null,

                /*
                | If another maintenance date was provided,
                | the schedule becomes Scheduled again.
                |
                | If there is no next due date, the schedule
                | remains Completed.
                */
                'status' => !empty($validated['next_due_date'])
                    ? 'Scheduled'
                    : 'Completed',
            ]);
        });

        return redirect()
            ->route('maintenance-schedules.index')
            ->with(
                'success',
                'Maintenance completed successfully and maintenance record created.'
            );
    }

    /**
     * Delete a maintenance schedule.
     */
    public function destroy(MaintenanceSchedule $maintenanceSchedule)
    {
        $maintenanceSchedule->delete();

        return redirect()
            ->route('maintenance-schedules.index')
            ->with(
                'success',
                'Maintenance schedule deleted successfully.'
            );
    }
}