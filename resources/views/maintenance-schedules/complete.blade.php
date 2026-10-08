<x-app-layout>

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-1 fw-bold">
                    <i class="bi bi-check2-circle me-2 text-success"></i>
                    Complete Maintenance
                </h2>

                <p class="text-muted mb-0">
                    Record the completed maintenance activity and schedule the next maintenance.
                </p>
            </div>

            <a
                href="{{ route('maintenance-schedules.index') }}"
                class="btn btn-outline-secondary"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Back to Schedule
            </a>
        </div>
    </x-slot>

    <div class="container-fluid py-4">

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm">
                <div class="d-flex align-items-start">
                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>

                    <div>
                        <h6 class="fw-bold mb-2">
                            Please correct the following errors:
                        </h6>

                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="row g-4">

            {{-- Main Form --}}
            <div class="col-lg-8">

                <form
                    method="POST"
                    action="{{ route(
                        'maintenance-schedules.complete.store',
                        $maintenanceSchedule
                    ) }}"
                >
                    @csrf

                    {{-- Schedule Information --}}
                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-calendar-check me-2 text-success"></i>
                                Maintenance Schedule
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="row g-3">

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Component
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control bg-light"
                                        value="{{ $maintenanceSchedule->component->name ?? 'N/A' }}"
                                        readonly
                                    >

                                </div>

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Component Type
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control bg-light"
                                        value="{{ $maintenanceSchedule->component->componentType->name ?? 'N/A' }}"
                                        readonly
                                    >

                                </div>

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Installation
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control bg-light"
                                        value="{{ $maintenanceSchedule->component->installation->name ?? 'N/A' }}"
                                        readonly
                                    >

                                </div>

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Maintenance Task
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control bg-light"
                                        value="{{ $maintenanceSchedule->maintenance_task }}"
                                        readonly
                                    >

                                </div>

                                <div class="col-md-4">

                                    <label class="form-label fw-semibold">
                                        Frequency
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control bg-light"
                                        value="{{ $maintenanceSchedule->frequency }}"
                                        readonly
                                    >

                                </div>

                                <div class="col-md-4">

                                    <label class="form-label fw-semibold">
                                        Priority
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control bg-light"
                                        value="{{ $maintenanceSchedule->priority }}"
                                        readonly
                                    >

                                </div>

                                <div class="col-md-4">

                                    <label class="form-label fw-semibold">
                                        Current Status
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control bg-light"
                                        value="{{ $maintenanceSchedule->status }}"
                                        readonly
                                    >

                                </div>

                            </div>

                        </div>
                    </div>


                    {{-- Maintenance Details --}}
                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-tools me-2 text-primary"></i>
                                Maintenance Details
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="row g-3">

                                {{-- Technician --}}
                                <div class="col-md-6">

                                    <label
                                        for="technician_id"
                                        class="form-label fw-semibold"
                                    >
                                        Technician <span class="text-danger">*</span>
                                    </label>

                                    <select
                                        name="technician_id"
                                        id="technician_id"
                                        class="form-select @error('technician_id') is-invalid @enderror"
                                        required
                                    >
                                        <option value="">
                                            Select technician
                                        </option>

                                        @foreach ($technicians as $technician)
                                            <option
                                                value="{{ $technician->id }}"
                                                {{ old('technician_id') == $technician->id ? 'selected' : '' }}
                                            >
                                                {{ $technician->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('technician_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                {{-- Maintenance Type --}}
                                <div class="col-md-6">

                                    <label
                                        for="maintenance_type"
                                        class="form-label fw-semibold"
                                    >
                                        Maintenance Type <span class="text-danger">*</span>
                                    </label>

                                    <select
                                        name="maintenance_type"
                                        id="maintenance_type"
                                        class="form-select @error('maintenance_type') is-invalid @enderror"
                                        required
                                    >
                                        <option value="">
                                            Select maintenance type
                                        </option>

                                        @foreach ([
                                            'Preventive',
                                            'Corrective',
                                            'Inspection',
                                            'Emergency',
                                            'Replacement'
                                        ] as $type)

                                            <option
                                                value="{{ $type }}"
                                                {{ old('maintenance_type', 'Preventive') === $type ? 'selected' : '' }}
                                            >
                                                {{ $type }}
                                            </option>

                                        @endforeach
                                    </select>

                                    @error('maintenance_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                {{-- Maintenance Date --}}
                                <div class="col-md-6">

                                    <label
                                        for="maintenance_date"
                                        class="form-label fw-semibold"
                                    >
                                        Maintenance Date <span class="text-danger">*</span>
                                    </label>

                                    <input
                                        type="date"
                                        name="maintenance_date"
                                        id="maintenance_date"
                                        class="form-control @error('maintenance_date') is-invalid @enderror"
                                        value="{{ old(
                                            'maintenance_date',
                                            now()->format('Y-m-d')
                                        ) }}"
                                        required
                                    >

                                    @error('maintenance_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                {{-- Next Due Date --}}
                                <div class="col-md-6">

                                    <label
                                        for="next_due_date"
                                        class="form-label fw-semibold"
                                    >
                                        Next Maintenance Due Date
                                    </label>

                                    <input
                                        type="date"
                                        name="next_due_date"
                                        id="next_due_date"
                                        class="form-control @error('next_due_date') is-invalid @enderror"
                                        value="{{ old('next_due_date') }}"
                                    >

                                    <small class="text-muted">
                                        Leave blank if no further maintenance is scheduled.
                                    </small>

                                    @error('next_due_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                {{-- Description --}}
                                <div class="col-12">

                                    <label
                                        for="description"
                                        class="form-label fw-semibold"
                                    >
                                        Maintenance Description
                                        <span class="text-danger">*</span>
                                    </label>

                                    <textarea
                                        name="description"
                                        id="description"
                                        rows="4"
                                        class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Describe the maintenance activity carried out..."
                                        required
                                    >{{ old('description') }}</textarea>

                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>
                    </div>


                    {{-- Condition Assessment --}}
                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-activity me-2 text-warning"></i>
                                Condition Assessment
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="row g-3">

                                {{-- Condition Before --}}
                                <div class="col-md-6">

                                    <label
                                        for="condition_before"
                                        class="form-label fw-semibold"
                                    >
                                        Condition Before
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select
                                        name="condition_before"
                                        id="condition_before"
                                        class="form-select @error('condition_before') is-invalid @enderror"
                                        required
                                    >
                                        <option value="">
                                            Select condition
                                        </option>

                                        @foreach ([
                                            'Excellent',
                                            'Good',
                                            'Fair',
                                            'Poor',
                                            'Critical'
                                        ] as $condition)

                                            <option
                                                value="{{ $condition }}"
                                                {{ old('condition_before') === $condition ? 'selected' : '' }}
                                            >
                                                {{ $condition }}
                                            </option>

                                        @endforeach
                                    </select>

                                    @error('condition_before')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                {{-- Condition After --}}
                                <div class="col-md-6">

                                    <label
                                        for="condition_after"
                                        class="form-label fw-semibold"
                                    >
                                        Condition After
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select
                                        name="condition_after"
                                        id="condition_after"
                                        class="form-select @error('condition_after') is-invalid @enderror"
                                        required
                                    >
                                        <option value="">
                                            Select condition
                                        </option>

                                        @foreach ([
                                            'Excellent',
                                            'Good',
                                            'Fair',
                                            'Poor',
                                            'Critical'
                                        ] as $condition)

                                            <option
                                                value="{{ $condition }}"
                                                {{ old('condition_after') === $condition ? 'selected' : '' }}
                                            >
                                                {{ $condition }}
                                            </option>

                                        @endforeach
                                    </select>

                                    @error('condition_after')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                {{-- Action Taken --}}
                                <div class="col-12">

                                    <label
                                        for="action_taken"
                                        class="form-label fw-semibold"
                                    >
                                        Action Taken
                                        <span class="text-danger">*</span>
                                    </label>

                                    <textarea
                                        name="action_taken"
                                        id="action_taken"
                                        rows="4"
                                        class="form-control @error('action_taken') is-invalid @enderror"
                                        placeholder="Describe the repairs, inspection, cleaning, replacement or other actions performed..."
                                        required
                                    >{{ old('action_taken') }}</textarea>

                                    @error('action_taken')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>
                    </div>


                    {{-- Remarks --}}
                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-chat-left-text me-2 text-secondary"></i>
                                Additional Remarks
                            </h5>
                        </div>

                        <div class="card-body">

                            <textarea
                                name="remarks"
                                id="remarks"
                                rows="4"
                                class="form-control @error('remarks') is-invalid @enderror"
                                placeholder="Enter any additional observations or recommendations..."
                            >{{ old('remarks') }}</textarea>

                            @error('remarks')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- Form Actions --}}
                    <div class="d-flex justify-content-between align-items-center">

                        <a
                            href="{{ route('maintenance-schedules.index') }}"
                            class="btn btn-outline-secondary"
                        >
                            <i class="bi bi-x-circle me-1"></i>
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="btn btn-success px-4"
                        >
                            <i class="bi bi-check-circle me-1"></i>
                            Complete Maintenance
                        </button>

                    </div>

                </form>

            </div>


            {{-- Information Sidebar --}}
            <div class="col-lg-4">

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-success text-white py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-info-circle me-2"></i>
                            Completion Guide
                        </h5>
                    </div>

                    <div class="card-body">

                        <p class="text-muted">
                            Completing this maintenance schedule will:
                        </p>

                        <ul class="mb-0">

                            <li class="mb-3">
                                Create a permanent maintenance record.
                            </li>

                            <li class="mb-3">
                                Record the technician responsible for the work.
                            </li>

                            <li class="mb-3">
                                Save the component condition before and after maintenance.
                            </li>

                            <li class="mb-3">
                                Record the action taken during maintenance.
                            </li>

                            <li class="mb-3">
                                Update the schedule's last maintenance date.
                            </li>

                            <li>
                                Schedule the next maintenance date when provided.
                            </li>

                        </ul>

                    </div>

                </div>


                {{-- Current Schedule Status --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-clock-history me-2 text-warning"></i>
                            Current Schedule
                        </h5>
                    </div>

                    <div class="card-body">

                        <div class="mb-3">

                            <small class="text-muted d-block">
                                Current Status
                            </small>

                            <strong>
                                {{ $maintenanceSchedule->status }}
                            </strong>

                        </div>

                        <div class="mb-3">

                            <small class="text-muted d-block">
                                Current Due Date
                            </small>

                            <strong>
                                @if ($maintenanceSchedule->next_due_date)
                                    {{ $maintenanceSchedule->next_due_date->format('d M Y') }}
                                @else
                                    Not Set
                                @endif
                            </strong>

                        </div>

                        <div>

                            <small class="text-muted d-block">
                                Priority
                            </small>

                            <strong>
                                {{ $maintenanceSchedule->priority }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>