
<x-app-layout>

    <div class="container-fluid py-3">

        {{-- =========================================================
             PAGE HEADER
        ========================================================== --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">

            <div>
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-2">
                        <i class="bi bi-cpu fs-4"></i>
                    </div>

                    <div>
                        <h3 class="fw-bold mb-1">
                            {{ $solarComponent->name }}
                        </h3>

                        <p class="text-muted mb-0">
                            Component details and maintenance information
                        </p>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 flex-wrap">

                <a href="{{ route('components.index') }}"
                   class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>
                    Back
                </a>

                <a href="{{ route('components.edit', $solarComponent) }}"
                   class="btn btn-success">
                    <i class="bi bi-pencil-square me-1"></i>
                    Edit Component
                </a>

            </div>

        </div>


        {{-- =========================================================
             SUCCESS MESSAGE
        ========================================================== --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show shadow-sm"
                 role="alert">

                <i class="bi bi-check-circle-fill me-2"></i>

                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        {{-- =========================================================
             COMPONENT SUMMARY
        ========================================================== --}}
        <div class="card border-0 shadow-sm mb-4 overflow-hidden">

            <div class="card-body p-4">

                <div class="row align-items-center g-4">

                    {{-- Component Icon --}}
                    <div class="col-auto">

                        <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center"
                             style="width: 85px; height: 85px;">

                            <i class="bi bi-cpu fs-1"></i>

                        </div>

                    </div>


                    {{-- Main Information --}}
                    <div class="col">

                        <div class="d-flex flex-wrap align-items-center gap-2 mb-2">

                            <h4 class="fw-bold mb-0">
                                {{ $solarComponent->name }}
                            </h4>


                            @php
                                $conditionClass = match($solarComponent->current_condition) {
                                    'Excellent' => 'success',
                                    'Good' => 'primary',
                                    'Fair' => 'warning',
                                    'Poor' => 'orange',
                                    'Critical' => 'danger',
                                    default => 'secondary',
                                };

                                $statusClass = match($solarComponent->status) {
                                    'Active' => 'success',
                                    'Under Maintenance' => 'warning',
                                    'Inactive' => 'secondary',
                                    'Replaced' => 'info',
                                    default => 'secondary',
                                };
                            @endphp


                            <span class="badge bg-{{ $conditionClass }}">
                                {{ $solarComponent->current_condition }}
                            </span>

                            <span class="badge bg-{{ $statusClass }}">
                                {{ $solarComponent->status }}
                            </span>

                        </div>


                        <p class="text-muted mb-2">

                            <i class="bi bi-diagram-3 me-1"></i>

                            {{ $solarComponent->componentType->name ?? 'Component Type Not Assigned' }}

                        </p>


                        <p class="mb-0 text-muted">

                            <i class="bi bi-building me-1"></i>

                            Installation:

                            <strong class="text-dark">
                                {{ $solarComponent->installation->name ?? 'Not Assigned' }}
                            </strong>

                        </p>

                    </div>


                    {{-- Component ID --}}
                    <div class="col-md-auto">

                        <div class="text-md-end">

                            <small class="text-muted d-block">
                                Component ID
                            </small>

                            <span class="fw-bold fs-5">
                                #{{ $solarComponent->id }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
             QUICK STATISTICS
        ========================================================== --}}
        <div class="row g-3 mb-4">

            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <small class="text-muted">
                                    Measurements
                                </small>

                                <h3 class="fw-bold mb-0 mt-1">
                                    {{ $solarComponent->measurements->count() }}
                                </h3>
                            </div>

                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                <i class="bi bi-activity fs-4"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <small class="text-muted">
                                    Maintenance Schedules
                                </small>

                                <h3 class="fw-bold mb-0 mt-1">
                                    {{ $solarComponent->maintenanceSchedules->count() }}
                                </h3>
                            </div>

                            <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                                <i class="bi bi-calendar-check fs-4"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <small class="text-muted">
                                    Maintenance Records
                                </small>

                                <h3 class="fw-bold mb-0 mt-1">
                                    {{ $solarComponent->maintenanceRecords->count() }}
                                </h3>
                            </div>

                            <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                                <i class="bi bi-tools fs-4"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <small class="text-muted">
                                    Replacement Forecasts
                                </small>

                                <h3 class="fw-bold mb-0 mt-1">
                                    {{ $solarComponent->replacementForecasts->count() }}
                                </h3>
                            </div>

                            <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3">
                                <i class="bi bi-arrow-repeat fs-4"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="row g-4">


            {{-- =====================================================
                 COMPONENT INFORMATION
            ====================================================== --}}
            <div class="col-xl-8">

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-bottom py-3">

                        <h5 class="mb-0 fw-bold">

                            <i class="bi bi-info-circle text-success me-2"></i>

                            Component Information

                        </h5>

                    </div>


                    <div class="card-body p-4">

                        <div class="row g-4">


                            {{-- Installation --}}
                            <div class="col-md-6">

                                <small class="text-muted d-block mb-1">
                                    Solar Installation
                                </small>

                                <div class="fw-semibold">

                                    <i class="bi bi-building text-success me-1"></i>

                                    {{ $solarComponent->installation->name ?? 'Not Assigned' }}

                                </div>

                            </div>


                            {{-- Component Type --}}
                            <div class="col-md-6">

                                <small class="text-muted d-block mb-1">
                                    Component Type
                                </small>

                                <div class="fw-semibold">

                                    <i class="bi bi-diagram-3 text-success me-1"></i>

                                    {{ $solarComponent->componentType->name ?? 'Not Assigned' }}

                                </div>

                            </div>


                            {{-- Manufacturer --}}
                            <div class="col-md-6">

                                <small class="text-muted d-block mb-1">
                                    Manufacturer
                                </small>

                                <div class="fw-semibold">

                                    {{ $solarComponent->manufacturer ?: 'Not provided' }}

                                </div>

                            </div>


                            {{-- Model --}}
                            <div class="col-md-6">

                                <small class="text-muted d-block mb-1">
                                    Model
                                </small>

                                <div class="fw-semibold">

                                    {{ $solarComponent->model ?: 'Not provided' }}

                                </div>

                            </div>


                            {{-- Serial Number --}}
                            <div class="col-md-6">

                                <small class="text-muted d-block mb-1">
                                    Serial Number
                                </small>

                                <div class="fw-semibold">

                                    {{ $solarComponent->serial_number ?: 'Not provided' }}

                                </div>

                            </div>


                            {{-- Installation Date --}}
                            <div class="col-md-6">

                                <small class="text-muted d-block mb-1">
                                    Installation Date
                                </small>

                                <div class="fw-semibold">

                                    <i class="bi bi-calendar3 text-success me-1"></i>

                                    @if($solarComponent->installation_date)

                                        {{ $solarComponent->installation_date->format('d M Y') }}

                                    @else

                                        Not provided

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     TECHNICAL SPECIFICATIONS
                ================================================== --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-bottom py-3">

                        <h5 class="mb-0 fw-bold">

                            <i class="bi bi-speedometer2 text-success me-2"></i>

                            Technical Specifications

                        </h5>

                    </div>


                    <div class="card-body p-4">

                        <div class="row g-3">


                            <div class="col-md-4">

                                <div class="border rounded-3 p-3 h-100">

                                    <small class="text-muted d-block">
                                        Rated Capacity
                                    </small>

                                    <h5 class="fw-bold mb-0 mt-2">

                                        {{ $solarComponent->rated_capacity !== null
                                            ? $solarComponent->rated_capacity
                                            : '—' }}

                                    </h5>

                                </div>

                            </div>


                            <div class="col-md-4">

                                <div class="border rounded-3 p-3 h-100">

                                    <small class="text-muted d-block">
                                        Rated Voltage
                                    </small>

                                    <h5 class="fw-bold mb-0 mt-2">

                                        {{ $solarComponent->rated_voltage !== null
                                            ? $solarComponent->rated_voltage . ' V'
                                            : '—' }}

                                    </h5>

                                </div>

                            </div>


                            <div class="col-md-4">

                                <div class="border rounded-3 p-3 h-100">

                                    <small class="text-muted d-block">
                                        Expected Lifespan
                                    </small>

                                    <h5 class="fw-bold mb-0 mt-2">

                                        {{ $solarComponent->expected_lifespan
                                            ? $solarComponent->expected_lifespan . ' years'
                                            : '—' }}

                                    </h5>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     DESCRIPTION
                ================================================== --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-bottom py-3">

                        <h5 class="mb-0 fw-bold">

                            <i class="bi bi-card-text text-success me-2"></i>

                            Description

                        </h5>

                    </div>


                    <div class="card-body p-4">

                        @if($solarComponent->description)

                            <p class="mb-0 text-muted"
                               style="line-height: 1.8;">

                                {{ $solarComponent->description }}

                            </p>

                        @else

                            <div class="text-center py-3">

                                <i class="bi bi-file-earmark-text text-muted fs-2"></i>

                                <p class="text-muted mb-0 mt-2">
                                    No description has been provided for this component.
                                </p>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- =================================================
                     RELATED MAINTENANCE
                ================================================== --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-bottom py-3">

                        <h5 class="mb-0 fw-bold">

                            <i class="bi bi-tools text-success me-2"></i>

                            Maintenance Activity

                        </h5>

                    </div>


                    <div class="card-body p-4">

                        <div class="row g-3">

                            <div class="col-md-6">

                                <div class="d-flex align-items-center gap-3 border rounded-3 p-3">

                                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-2">

                                        <i class="bi bi-calendar-check fs-4"></i>

                                    </div>

                                    <div>

                                        <small class="text-muted d-block">
                                            Scheduled Maintenance
                                        </small>

                                        <strong>
                                            {{ $solarComponent->maintenanceSchedules->count() }}
                                        </strong>

                                    </div>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="d-flex align-items-center gap-3 border rounded-3 p-3">

                                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-2">

                                        <i class="bi bi-check2-circle fs-4"></i>

                                    </div>

                                    <div>

                                        <small class="text-muted d-block">
                                            Completed Records
                                        </small>

                                        <strong>
                                            {{ $solarComponent->maintenanceRecords->count() }}
                                        </strong>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 RIGHT SIDEBAR
            ====================================================== --}}
            <div class="col-xl-4">


                {{-- Condition --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-bottom py-3">

                        <h5 class="mb-0 fw-bold">

                            <i class="bi bi-heart-pulse text-success me-2"></i>

                            Current Condition

                        </h5>

                    </div>


                    <div class="card-body p-4 text-center">

                        <div class="display-6 text-{{ $conditionClass }} mb-2">

                            @if($solarComponent->current_condition === 'Excellent')
                                <i class="bi bi-star-fill"></i>
                            @elseif($solarComponent->current_condition === 'Good')
                                <i class="bi bi-hand-thumbs-up-fill"></i>
                            @elseif($solarComponent->current_condition === 'Fair')
                                <i class="bi bi-dash-circle-fill"></i>
                            @elseif($solarComponent->current_condition === 'Poor')
                                <i class="bi bi-exclamation-circle-fill"></i>
                            @elseif($solarComponent->current_condition === 'Critical')
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            @else
                                <i class="bi bi-question-circle-fill"></i>
                            @endif

                        </div>

                        <h4 class="fw-bold mb-1">

                            {{ $solarComponent->current_condition }}

                        </h4>

                        <p class="text-muted mb-0">
                            Recorded current condition
                        </p>

                    </div>

                </div>


                {{-- Status --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-bottom py-3">

                        <h5 class="mb-0 fw-bold">

                            <i class="bi bi-toggle-on text-success me-2"></i>

                            Component Status

                        </h5>

                    </div>


                    <div class="card-body p-4">

                        <div class="d-flex align-items-center justify-content-between">

                            <span class="text-muted">
                                Current Status
                            </span>

                            <span class="badge bg-{{ $statusClass }} px-3 py-2">

                                {{ $solarComponent->status }}

                            </span>

                        </div>

                    </div>

                </div>


                {{-- Activity Summary --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-bottom py-3">

                        <h5 class="mb-0 fw-bold">

                            <i class="bi bi-bar-chart-line text-success me-2"></i>

                            Activity Summary

                        </h5>

                    </div>


                    <div class="card-body p-0">

                        <div class="list-group list-group-flush">

                            <div class="list-group-item d-flex justify-content-between align-items-center py-3">

                                <span>
                                    <i class="bi bi-activity text-primary me-2"></i>
                                    Measurements
                                </span>

                                <span class="badge bg-primary rounded-pill">
                                    {{ $solarComponent->measurements->count() }}
                                </span>

                            </div>


                            <div class="list-group-item d-flex justify-content-between align-items-center py-3">

                                <span>
                                    <i class="bi bi-calendar-check text-warning me-2"></i>
                                    Maintenance Schedules
                                </span>

                                <span class="badge bg-warning text-dark rounded-pill">
                                    {{ $solarComponent->maintenanceSchedules->count() }}
                                </span>

                            </div>


                            <div class="list-group-item d-flex justify-content-between align-items-center py-3">

                                <span>
                                    <i class="bi bi-tools text-success me-2"></i>
                                    Maintenance Records
                                </span>

                                <span class="badge bg-success rounded-pill">
                                    {{ $solarComponent->maintenanceRecords->count() }}
                                </span>

                            </div>


                            <div class="list-group-item d-flex justify-content-between align-items-center py-3">

                                <span>
                                    <i class="bi bi-cash-stack text-info me-2"></i>
                                    Cost Records
                                </span>

                                <span class="badge bg-info rounded-pill">
                                    {{ $solarComponent->costRecords->count() }}
                                </span>

                            </div>


                            <div class="list-group-item d-flex justify-content-between align-items-center py-3">

                                <span>
                                    <i class="bi bi-arrow-repeat text-danger me-2"></i>
                                    Replacement Forecasts
                                </span>

                                <span class="badge bg-danger rounded-pill">
                                    {{ $solarComponent->replacementForecasts->count() }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Quick Actions --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-bottom py-3">

                        <h5 class="mb-0 fw-bold">

                            <i class="bi bi-lightning-charge text-success me-2"></i>

                            Quick Actions

                        </h5>

                    </div>


                    <div class="card-body">

                        <div class="d-grid gap-2">

                            <a href="{{ route('components.edit', $solarComponent) }}"
                               class="btn btn-success">

                                <i class="bi bi-pencil-square me-2"></i>

                                Edit Component

                            </a>


                            <a href="{{ route('components.index') }}"
                               class="btn btn-outline-secondary">

                                <i class="bi bi-list-ul me-2"></i>

                                View All Components

                            </a>

                        </div>

                    </div>

                </div>


                {{-- Danger Zone --}}
                <div class="card border-danger border-1 shadow-sm">

                    <div class="card-header bg-danger bg-opacity-10 border-danger">

                        <h6 class="mb-0 fw-bold text-danger">

                            <i class="bi bi-exclamation-triangle me-2"></i>

                            Danger Zone

                        </h6>

                    </div>


                    <div class="card-body">

                        <p class="small text-muted">

                            Deleting this component is permanent. Related records may also be affected depending on your database relationships.

                        </p>


                        <form action="{{ route('components.destroy', $solarComponent) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this component? This action cannot be undone.');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-outline-danger w-100">

                                <i class="bi bi-trash me-1"></i>

                                Delete Component

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
             FOOTER INFORMATION
        ========================================================== --}}
        <div class="text-center text-muted small py-4">

            <i class="bi bi-shield-check me-1"></i>

            Component information is maintained as part of the
            Solar Maintenance System.

        </div>

    </div>

</x-app-layout>

