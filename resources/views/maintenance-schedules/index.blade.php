<x-app-layout>

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-calendar-check me-2 text-success"></i>
                    Maintenance Schedule
                </h4>
                <p class="text-muted mb-0">
                    Preventive maintenance planning and monitoring
                </p>
            </div>

            @if(in_array(auth()->user()->role, ['Admin', 'Technician']))
                <a href="{{ route('maintenance-schedules.create') }}"
                   class="btn btn-success">
                    <i class="bi bi-plus-circle me-1"></i>
                    Add Maintenance Schedule
                </a>
            @endif
        </div>
    </x-slot>

    <div class="container-fluid py-3">

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm"
                 role="alert">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>
            </div>
        @endif

        {{-- Error Message --}}
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm"
                 role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                {{ session('error') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm"
                 role="alert">

                <div class="d-flex align-items-start">
                    <i class="bi bi-exclamation-triangle-fill me-2 mt-1"></i>

                    <div>
                        <strong>Please correct the following errors:</strong>

                        <ul class="mb-0 mt-2 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>
            </div>
        @endif


        {{-- Summary Cards --}}
        <div class="row g-3 mb-4">

            {{-- Total --}}
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <p class="text-muted mb-1">
                                    Total Schedules
                                </p>

                                <h3 class="fw-bold mb-0">
                                    {{ $totalSchedules }}
                                </h3>
                            </div>

                            <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-calendar-check text-success fs-4"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            {{-- Overdue --}}
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <p class="text-muted mb-1">
                                    Overdue
                                </p>

                                <h3 class="fw-bold text-danger mb-0">
                                    {{ $overdueSchedules }}
                                </h3>
                            </div>

                            <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-exclamation-triangle text-danger fs-4"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            {{-- Due Today --}}
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <p class="text-muted mb-1">
                                    Due Today
                                </p>

                                <h3 class="fw-bold text-warning mb-0">
                                    {{ $dueToday }}
                                </h3>
                            </div>

                            <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-clock-history text-warning fs-4"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            {{-- Upcoming --}}
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <p class="text-muted mb-1">
                                    Upcoming (7 Days)
                                </p>

                                <h3 class="fw-bold text-primary mb-0">
                                    {{ $upcomingSchedules }}
                                </h3>
                            </div>

                            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-calendar-event text-primary fs-4"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>


        {{-- Maintenance Schedule Table --}}
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-0 py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="fw-bold mb-1">
                            <i class="bi bi-list-check me-2 text-success"></i>
                            Maintenance Schedules
                        </h5>

                        <small class="text-muted">
                            Manage and monitor preventive maintenance activities
                        </small>
                    </div>

                    <span class="badge bg-success">
                        {{ $totalSchedules }} Schedule{{ $totalSchedules != 1 ? 's' : '' }}
                    </span>

                </div>

            </div>


            <div class="card-body p-0">

                @if($schedules->count())

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">

                                <tr>

                                    <th class="px-3">
                                        Component
                                    </th>

                                    <th>
                                        Maintenance Task
                                    </th>

                                    <th>
                                        Frequency
                                    </th>

                                    <th>
                                        Next Due
                                    </th>

                                    <th>
                                        Priority
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th class="text-center">
                                        Actions
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($schedules as $schedule)

                                    @php

                                        $today = \Illuminate\Support\Carbon::today();

                                        $nextDue = $schedule->next_due_date
                                            ? \Illuminate\Support\Carbon::parse($schedule->next_due_date)
                                            : null;

                                        /*
                                         * Determine visual date state.
                                         */
                                        $isOverdue = $nextDue
                                            && $nextDue->lt($today)
                                            && $schedule->status !== 'Completed';

                                        $isDueToday = $nextDue
                                            && $nextDue->equalTo($today)
                                            && $schedule->status !== 'Completed';

                                        $isUpcoming = $nextDue
                                            && $nextDue->gt($today)
                                            && $nextDue->lte(
                                                $today->copy()->addDays(7)
                                            )
                                            && $schedule->status !== 'Completed';

                                        /*
                                         * Complete button is only available
                                         * for Due or Overdue schedules.
                                         */
                                        $canComplete = in_array(
                                            $schedule->status,
                                            ['Due', 'Overdue']
                                        );

                                    @endphp


                                    <tr>

                                        {{-- Component --}}
                                        <td class="px-3">

                                            <div class="fw-semibold">
                                                {{ $schedule->component->name ?? 'N/A' }}
                                            </div>

                                            @if($schedule->component?->componentType)
                                                <small class="text-muted">
                                                    {{ $schedule->component->componentType->name }}
                                                </small>
                                            @endif

                                        </td>


                                        {{-- Maintenance Task --}}
                                        <td>

                                            <span class="fw-semibold">
                                                {{ $schedule->maintenance_task }}
                                            </span>

                                        </td>


                                        {{-- Frequency --}}
                                        <td>

                                            <span class="badge bg-light text-dark border">
                                                {{ $schedule->frequency }}
                                            </span>

                                        </td>


                                        {{-- Next Due Date --}}
                                        <td>

                                            @if($nextDue)

                                                <div class="
                                                    fw-semibold
                                                    {{ $isOverdue ? 'text-danger' : '' }}
                                                    {{ $isDueToday ? 'text-warning' : '' }}
                                                    {{ $isUpcoming ? 'text-primary' : '' }}
                                                ">

                                                    {{ $nextDue->format('d M Y') }}

                                                </div>


                                                @if($isOverdue)

                                                    <small class="text-danger">
                                                        <i class="bi bi-exclamation-circle me-1"></i>
                                                        Overdue
                                                    </small>

                                                @elseif($isDueToday)

                                                    <small class="text-warning">
                                                        <i class="bi bi-clock me-1"></i>
                                                        Due Today
                                                    </small>

                                                @elseif($isUpcoming)

                                                    <small class="text-primary">
                                                        <i class="bi bi-calendar-event me-1"></i>
                                                        Upcoming
                                                    </small>

                                                @endif

                                            @else

                                                <span class="text-muted">
                                                    Not scheduled
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Priority --}}
                                        <td>

                                            @switch($schedule->priority)

                                                @case('Low')
                                                    <span class="badge bg-success">
                                                        Low
                                                    </span>
                                                    @break

                                                @case('Medium')
                                                    <span class="badge bg-info">
                                                        Medium
                                                    </span>
                                                    @break

                                                @case('High')
                                                    <span class="badge bg-warning text-dark">
                                                        High
                                                    </span>
                                                    @break

                                                @case('Critical')
                                                    <span class="badge bg-danger">
                                                        Critical
                                                    </span>
                                                    @break

                                                @default
                                                    <span class="badge bg-secondary">
                                                        {{ $schedule->priority }}
                                                    </span>

                                            @endswitch

                                        </td>


                                        {{-- Status --}}
                                        <td>

                                            @switch($schedule->status)

                                                @case('Scheduled')
                                                    <span class="badge bg-primary">
                                                        <i class="bi bi-calendar-event me-1"></i>
                                                        Scheduled
                                                    </span>
                                                    @break

                                                @case('Due')
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="bi bi-clock me-1"></i>
                                                        Due
                                                    </span>
                                                    @break

                                                @case('Overdue')
                                                    <span class="badge bg-danger">
                                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                                        Overdue
                                                    </span>
                                                    @break

                                                @case('Completed')
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-circle me-1"></i>
                                                        Completed
                                                    </span>
                                                    @break

                                                @default
                                                    <span class="badge bg-secondary">
                                                        {{ $schedule->status }}
                                                    </span>

                                            @endswitch

                                        </td>


                                        {{-- Actions --}}
                                        <td class="text-center">

                                            <div class="btn-group"
                                                 role="group">

                                                {{-- View --}}
                                                <a href="{{ route('maintenance-schedules.show', $schedule) }}"
                                                   class="btn btn-sm btn-outline-success"
                                                   title="View">

                                                    <i class="bi bi-eye"></i>

                                                </a>


                                                {{-- Edit --}}
                                                @if(in_array(auth()->user()->role, ['Admin', 'Technician']))

                                                    <a href="{{ route('maintenance-schedules.edit', $schedule) }}"
                                                       class="btn btn-sm btn-outline-primary"
                                                       title="Edit">

                                                        <i class="bi bi-pencil-square"></i>

                                                    </a>

                                                @endif


                                                {{-- Complete Maintenance --}}
                                                @if(
                                                    $canComplete &&
                                                    in_array(auth()->user()->role, ['Admin', 'Technician'])
                                                )

                                                    <a href="{{ route('maintenance-schedules.complete', $schedule) }}"
                                                       class="btn btn-sm btn-outline-success"
                                                       title="Complete Maintenance">

                                                        <i class="bi bi-check2-circle"></i>

                                                    </a>

                                                @endif


                                                {{-- Delete --}}
                                                @if(in_array(auth()->user()->role, ['Admin', 'Technician']))

                                                    <form action="{{ route('maintenance-schedules.destroy', $schedule) }}"
                                                          method="POST"
                                                          class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this maintenance schedule?');">

                                                        @csrf

                                                        @method('DELETE')

                                                        <button type="submit"
                                                                class="btn btn-sm btn-outline-danger"
                                                                title="Delete">

                                                            <i class="bi bi-trash"></i>

                                                        </button>

                                                    </form>

                                                @endif

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    {{-- Empty State --}}
                    <div class="text-center py-5">

                        <div class="mb-3">

                            <div class="bg-light rounded-circle d-inline-flex p-4">

                                <i class="bi bi-calendar-x text-muted fs-1"></i>

                            </div>

                        </div>

                        <h5 class="fw-bold">
                            No Maintenance Schedules
                        </h5>

                        <p class="text-muted mb-4">
                            There are currently no maintenance schedules in the system.
                        </p>

                        @if(in_array(auth()->user()->role, ['Admin', 'Technician']))

                            <a href="{{ route('maintenance-schedules.create') }}"
                               class="btn btn-success">

                                <i class="bi bi-plus-circle me-1"></i>

                                Create First Schedule

                            </a>

                        @endif

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>