<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\Installation;
use App\Models\Inspection;
use App\Models\InspectionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class InspectionController extends Controller
{
    /**
     * Display all inspections.
     */
    public function index()
    {
        $inspections = Inspection::with([
            'installation',
            'inspector',
        ])
            ->latest('inspection_date')
            ->paginate(10);

        return view('inspections.index', compact('inspections'));
    }

    /**
     * Show inspection form.
     */
    public function create()
    {
        $installations = Installation::with('components.componentType')
            ->where('status', '!=', 'Inactive')
            ->orderBy('name')
            ->get();

        return view('inspections.create', compact('installations'));
    }

    /**
     * Store a new inspection.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'installation_id' => ['required', 'exists:installations,id'],
            'inspection_date' => ['required', 'date'],
            'overall_condition' => [
                'required',
                'in:Excellent,Good,Fair,Poor,Critical',
            ],
            'general_observation' => ['nullable', 'string'],
            'recommendation' => ['nullable', 'string'],
            'remarks' => ['nullable', 'string'],
            'next_inspection_date' => [
                'required',
                'date',
                'after_or_equal:inspection_date',
            ],
            'items' => ['required', 'array', 'min:1'],
            'items.*.component_id' => [
                'required',
                'exists:components,id',
            ],
            'items.*.check_item' => [
                'required',
                'string',
                'max:255',
            ],
            'items.*.result' => [
                'required',
                'in:Pass,Fail,Needs Attention,Not Applicable',
            ],
            'items.*.measurement' => ['nullable', 'numeric'],
            'items.*.unit' => ['nullable', 'string', 'max:50'],
            'items.*.condition' => [
                'required',
                'in:Excellent,Good,Fair,Poor,Critical',
            ],
            'items.*.remarks' => ['nullable', 'string'],
        ]);

        $this->verifyComponentsBelongToInstallation(
            $validated['installation_id'],
            $validated['items']
        );

        DB::transaction(function () use ($validated) {
            $inspection = Inspection::create([
                'installation_id' => $validated['installation_id'],
                'inspector_id' => Auth::id(),
                'inspection_date' => $validated['inspection_date'],
                'overall_condition' => $validated['overall_condition'],
                'general_observation' =>
                    $validated['general_observation'] ?? null,
                'recommendation' =>
                    $validated['recommendation'] ?? null,
                'remarks' => $validated['remarks'] ?? null,
                'next_inspection_date' =>
                    $validated['next_inspection_date'],
            ]);

            foreach ($validated['items'] as $item) {
                $inspection->inspectionItems()->create([
                    'component_id' => $item['component_id'],
                    'check_item' => $item['check_item'],
                    'result' => $item['result'],
                    'measurement' => $item['measurement'] ?? null,
                    'unit' => $item['unit'] ?? null,
                    'condition' => $item['condition'],
                    'remarks' => $item['remarks'] ?? null,
                ]);
            }

            $this->syncComponentConditions(
                collect($validated['items'])
                    ->pluck('component_id')
                    ->unique()
                    ->values()
                    ->all()
            );
        });

        return redirect()
            ->route('inspections.index')
            ->with('success', 'Inspection completed and recorded successfully.');
    }

    /**
     * Display a single inspection.
     */
    public function show(Inspection $inspection)
    {
        $inspection->load([
            'installation',
            'inspector',
            'inspectionItems.component.componentType',
        ]);

        return view('inspections.show', compact('inspection'));
    }

    /**
     * Show edit form.
     */
    public function edit(Inspection $inspection)
    {
        $inspection->load([
            'inspectionItems.component.componentType',
        ]);

        $installations = Installation::with('components.componentType')
            ->orderBy('name')
            ->get();

        return view('inspections.edit', compact(
            'inspection',
            'installations'
        ));
    }

    /**
     * Update an existing inspection.
     */
    public function update(
        Request $request,
        Inspection $inspection
    ) {
        $validated = $request->validate([
            'installation_id' => ['required', 'exists:installations,id'],
            'inspection_date' => ['required', 'date'],
            'overall_condition' => [
                'required',
                'in:Excellent,Good,Fair,Poor,Critical',
            ],
            'general_observation' => ['nullable', 'string'],
            'recommendation' => ['nullable', 'string'],
            'remarks' => ['nullable', 'string'],
            'next_inspection_date' => [
                'required',
                'date',
                'after_or_equal:inspection_date',
            ],
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['nullable', 'integer'],
            'items.*.component_id' => [
                'required',
                'exists:components,id',
            ],
            'items.*.check_item' => [
                'required',
                'string',
                'max:255',
            ],
            'items.*.result' => [
                'required',
                'in:Pass,Fail,Needs Attention,Not Applicable',
            ],
            'items.*.measurement' => ['nullable', 'numeric'],
            'items.*.unit' => ['nullable', 'string', 'max:50'],
            'items.*.condition' => [
                'required',
                'in:Excellent,Good,Fair,Poor,Critical',
            ],
            'items.*.remarks' => ['nullable', 'string'],
        ]);

        $this->verifyComponentsBelongToInstallation(
            $validated['installation_id'],
            $validated['items']
        );

        DB::transaction(function () use ($validated, $inspection) {
            // Remember old components before replacing the checklist.
            $oldComponentIds = $inspection->inspectionItems()
                ->pluck('component_id')
                ->unique()
                ->all();

            $inspection->update([
                'installation_id' => $validated['installation_id'],
                'inspection_date' => $validated['inspection_date'],
                'overall_condition' => $validated['overall_condition'],
                'general_observation' =>
                    $validated['general_observation'] ?? null,
                'recommendation' =>
                    $validated['recommendation'] ?? null,
                'remarks' => $validated['remarks'] ?? null,
                'next_inspection_date' =>
                    $validated['next_inspection_date'],
            ]);

            $inspection->inspectionItems()->delete();

            foreach ($validated['items'] as $item) {
                $inspection->inspectionItems()->create([
                    'component_id' => $item['component_id'],
                    'check_item' => $item['check_item'],
                    'result' => $item['result'],
                    'measurement' => $item['measurement'] ?? null,
                    'unit' => $item['unit'] ?? null,
                    'condition' => $item['condition'],
                    'remarks' => $item['remarks'] ?? null,
                ]);
            }

            $affectedComponentIds = array_values(array_unique(
                array_merge(
                    $oldComponentIds,
                    collect($validated['items'])
                        ->pluck('component_id')
                        ->all()
                )
            ));

            $this->syncComponentConditions($affectedComponentIds);
        });

        return redirect()
            ->route('inspections.show', $inspection)
            ->with('success', 'Inspection updated successfully.');
    }

    /**
     * Print inspection report.
     */
    public function print(Inspection $inspection)
    {
        $inspection->load([
            'installation',
            'inspector',
            'inspectionItems.component.componentType',
        ]);

        return view('inspections.print', compact('inspection'));
    }

    /**
     * Delete an inspection.
     */
    public function destroy(Inspection $inspection)
    {
        DB::transaction(function () use ($inspection) {
            $componentIds = $inspection->inspectionItems()
                ->pluck('component_id')
                ->unique()
                ->all();

            $inspection->inspectionItems()->delete();
            $inspection->delete();

            $this->syncComponentConditions($componentIds);
        });

        return redirect()
            ->route('inspections.index')
            ->with('success', 'Inspection deleted successfully.');
    }

    /**
     * Verify every selected component belongs to the selected installation.
     */
    private function verifyComponentsBelongToInstallation(
        int|string $installationId,
        array $items
    ): void {
        $installation = Installation::with('components')
            ->findOrFail($installationId);

        $installationComponentIds = $installation->components
            ->pluck('id')
            ->map(fn ($id) => (int) $id)
            ->all();

        foreach ($items as $item) {
            if (!in_array(
                (int) $item['component_id'],
                $installationComponentIds,
                true
            )) {
                throw ValidationException::withMessages([
                    'items' =>
                        'One or more selected components do not belong to the selected installation.',
                ]);
            }
        }
    }

    /**
     * Synchronize component conditions from their latest inspections.
     *
     * If multiple checklist items assess the same component during the
     * latest inspection, the worst recorded condition is used.
     *
     * If no inspection history remains, the existing condition is preserved.
     */
    private function syncComponentConditions(array $componentIds): void
    {
        $conditionRank = [
            'Excellent' => 1,
            'Good' => 2,
            'Fair' => 3,
            'Poor' => 4,
            'Critical' => 5,
        ];

        foreach (array_unique($componentIds) as $componentId) {
            $component = Component::find($componentId);

            if (!$component) {
                continue;
            }

            $latestInspectionId = InspectionItem::query()
                ->where('inspection_items.component_id', $componentId)
                ->join(
                    'inspections',
                    'inspection_items.inspection_id',
                    '=',
                    'inspections.id'
                )
                ->orderByDesc('inspections.inspection_date')
                ->orderByDesc('inspections.id')
                ->value('inspections.id');

            // Preserve the current condition if no inspection remains.
            if (!$latestInspectionId) {
                continue;
            }

            $conditions = InspectionItem::query()
                ->where('inspection_id', $latestInspectionId)
                ->where('component_id', $componentId)
                ->pluck('condition')
                ->filter()
                ->all();

            if (empty($conditions)) {
                continue;
            }

            $worstCondition = collect($conditions)
                ->sortByDesc(
                    fn ($condition) => $conditionRank[$condition] ?? 0
                )
                ->first();

            if (
                $worstCondition !== null
                && isset($conditionRank[$worstCondition])
            ) {
                $component->update([
                    'current_condition' => $worstCondition,
                ]);
            }
        }
    }
}