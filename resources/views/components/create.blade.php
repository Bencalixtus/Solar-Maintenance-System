<x-app-layout>

    <div class="container-fluid py-2">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>

                <div class="d-flex align-items-center gap-2 mb-1">

                    <div class="bg-success bg-opacity-10 rounded-3 p-2">
                        <i class="bi bi-cpu text-success fs-4"></i>
                    </div>

                    <div>
                        <h3 class="fw-bold mb-0">
                            Register Component
                        </h3>

                        <p class="text-muted mb-0">
                            Add a physical component to a solar-battery installation.
                        </p>
                    </div>

                </div>

            </div>


            <a href="{{ route('components.index') }}"
               class="btn btn-outline-secondary">

                <i class="bi bi-arrow-left me-1"></i>
                Back to Components

            </a>

        </div>


        {{-- =========================================================
            VALIDATION ERRORS
        ========================================================== --}}
        @if ($errors->any())

            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0"
                 role="alert">

                <div class="d-flex align-items-start">

                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>

                    <div>

                        <strong>
                            Please correct the following errors:
                        </strong>

                        <ul class="mb-0 mt-2">

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

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


        {{-- =========================================================
            NO INSTALLATION WARNING
        ========================================================== --}}
        @if($installations->isEmpty())

            <div class="alert alert-warning shadow-sm border-0">

                <div class="d-flex align-items-start">

                    <div class="warning-icon me-3">

                        <i class="bi bi-exclamation-triangle-fill"></i>

                    </div>

                    <div class="flex-grow-1">

                        <h6 class="fw-bold mb-1">
                            No Solar Installation Available
                        </h6>

                        <p class="mb-3 text-muted">

                            A solar installation must be registered before
                            you can register a component.

                        </p>

                        <a href="{{ route('installations.create') }}"
                           class="btn btn-warning">

                            <i class="bi bi-plus-circle me-1"></i>
                            Add Installation

                        </a>

                    </div>

                </div>

            </div>

        @endif


        {{-- =========================================================
            MAIN FORM
        ========================================================== --}}
        <form action="{{ route('components.store') }}"
              method="POST">

            @csrf


            {{-- =====================================================
                COMPONENT IDENTIFICATION
            ====================================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-bottom py-3">

                    <div class="d-flex align-items-center">

                        <div class="section-icon bg-success bg-opacity-10 text-success me-3">

                            <i class="bi bi-info-circle"></i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Component Identification
                            </h5>

                            <small class="text-muted">
                                Identify the installation and type of component.
                            </small>

                        </div>

                    </div>

                </div>


                <div class="card-body p-4">

                    <div class="row g-4">

                        {{-- Installation --}}
                        <div class="col-md-6">

                            <label for="installation_id"
                                   class="form-label fw-semibold">

                                Solar Installation
                                <span class="text-danger">*</span>

                            </label>

                            <select name="installation_id"
                                    id="installation_id"
                                    class="form-select @error('installation_id') is-invalid @enderror"
                                    required>

                                <option value="">
                                    -- Select Installation --
                                </option>

                                @foreach($installations as $installation)

                                    <option value="{{ $installation->id }}"
                                        {{ old('installation_id') == $installation->id ? 'selected' : '' }}>

                                        {{ $installation->name }}

                                    </option>

                                @endforeach

                            </select>

                            @error('installation_id')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                            <div class="form-text">
                                Select the solar installation where this component is located.
                            </div>

                        </div>


                        {{-- Component Type --}}
                        <div class="col-md-6">

                            <label for="component_type_id"
                                   class="form-label fw-semibold">

                                Component Type
                                <span class="text-danger">*</span>

                            </label>

                            <select name="component_type_id"
                                    id="component_type_id"
                                    class="form-select @error('component_type_id') is-invalid @enderror"
                                    required>

                                <option value="">
                                    -- Select Component Type --
                                </option>

                                @foreach($componentTypes as $type)

                                    <option value="{{ $type->id }}"
                                        {{ old('component_type_id') == $type->id ? 'selected' : '' }}>

                                        {{ $type->name }}

                                    </option>

                                @endforeach

                            </select>

                            @error('component_type_id')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                            <div class="form-text">
                                Select the category of this component.
                            </div>

                        </div>


                        {{-- Component Name --}}
                        <div class="col-md-6">

                            <label for="name"
                                   class="form-label fw-semibold">

                                Component Name
                                <span class="text-danger">*</span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-cpu text-success"></i>
                                </span>

                                <input type="text"
                                       name="name"
                                       id="name"
                                       value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="e.g. Solar Panel 01"
                                       required>

                            </div>

                            @error('name')

                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Manufacturer --}}
                        <div class="col-md-6">

                            <label for="manufacturer"
                                   class="form-label fw-semibold">

                                Manufacturer

                            </label>

                            <input type="text"
                                   name="manufacturer"
                                   id="manufacturer"
                                   value="{{ old('manufacturer') }}"
                                   class="form-control @error('manufacturer') is-invalid @enderror"
                                   placeholder="e.g. Jinko Solar">

                            @error('manufacturer')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Model --}}
                        <div class="col-md-6">

                            <label for="model"
                                   class="form-label fw-semibold">

                                Model

                            </label>

                            <input type="text"
                                   name="model"
                                   id="model"
                                   value="{{ old('model') }}"
                                   class="form-control @error('model') is-invalid @enderror"
                                   placeholder="e.g. JKM550M-72HL4">

                            @error('model')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Serial Number --}}
                        <div class="col-md-6">

                            <label for="serial_number"
                                   class="form-label fw-semibold">

                                Serial Number

                            </label>

                            <input type="text"
                                   name="serial_number"
                                   id="serial_number"
                                   value="{{ old('serial_number') }}"
                                   class="form-control @error('serial_number') is-invalid @enderror"
                                   placeholder="Enter serial number">

                            @error('serial_number')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                TECHNICAL SPECIFICATIONS
            ====================================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-bottom py-3">

                    <div class="d-flex align-items-center">

                        <div class="section-icon bg-warning bg-opacity-10 text-warning me-3">

                            <i class="bi bi-speedometer2"></i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Technical Specifications
                            </h5>

                            <small class="text-muted">
                                Record the component's technical specifications and lifespan.
                            </small>

                        </div>

                    </div>

                </div>


                <div class="card-body p-4">

                    <div class="row g-4">

                        {{-- Installation Date --}}
                        <div class="col-md-6">

                            <label for="installation_date"
                                   class="form-label fw-semibold">

                                Component Installation Date
                                <span class="text-danger">*</span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-calendar3 text-success"></i>
                                </span>

                                <input type="date"
                                       name="installation_date"
                                       id="installation_date"
                                       value="{{ old('installation_date') }}"
                                       class="form-control @error('installation_date') is-invalid @enderror"
                                       required>

                            </div>

                            @error('installation_date')

                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Rated Capacity --}}
                        <div class="col-md-6">

                            <label for="rated_capacity"
                                   class="form-label fw-semibold">

                                Rated Capacity

                            </label>

                            <div class="input-group">

                                <input type="number"
                                       name="rated_capacity"
                                       id="rated_capacity"
                                       value="{{ old('rated_capacity') }}"
                                       class="form-control @error('rated_capacity') is-invalid @enderror"
                                       placeholder="e.g. 550"
                                       min="0"
                                       step="0.01">

                                <span class="input-group-text">
                                    W / Ah / kW
                                </span>

                            </div>

                            @error('rated_capacity')

                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>

                            @enderror

                            <div class="form-text">
                                Enter the rated capacity according to the component specification.
                            </div>

                        </div>


                        {{-- Rated Voltage --}}
                        <div class="col-md-6">

                            <label for="rated_voltage"
                                   class="form-label fw-semibold">

                                Rated Voltage

                            </label>

                            <div class="input-group">

                                <input type="number"
                                       name="rated_voltage"
                                       id="rated_voltage"
                                       value="{{ old('rated_voltage') }}"
                                       class="form-control @error('rated_voltage') is-invalid @enderror"
                                       placeholder="e.g. 48"
                                       min="0"
                                       step="0.01">

                                <span class="input-group-text">
                                    V
                                </span>

                            </div>

                            @error('rated_voltage')

                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Expected Lifespan --}}
                        <div class="col-md-6">

                            <label for="expected_lifespan"
                                   class="form-label fw-semibold">

                                Expected Lifespan

                            </label>

                            <div class="input-group">

                                <input type="number"
                                       name="expected_lifespan"
                                       id="expected_lifespan"
                                       value="{{ old('expected_lifespan') }}"
                                       class="form-control @error('expected_lifespan') is-invalid @enderror"
                                       placeholder="e.g. 10"
                                       min="1"
                                       max="100">

                                <span class="input-group-text">
                                    Years
                                </span>

                            </div>

                            @error('expected_lifespan')

                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                CONDITION AND STATUS
            ====================================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-bottom py-3">

                    <div class="d-flex align-items-center">

                        <div class="section-icon bg-danger bg-opacity-10 text-danger me-3">

                            <i class="bi bi-activity"></i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Condition & Status
                            </h5>

                            <small class="text-muted">
                                Record the current operational condition of the component.
                            </small>

                        </div>

                    </div>

                </div>


                <div class="card-body p-4">

                    <div class="row g-4">

                        {{-- Current Condition --}}
                        <div class="col-md-6">

                            <label for="current_condition"
                                   class="form-label fw-semibold">

                                Current Condition
                                <span class="text-danger">*</span>

                            </label>

                            <select name="current_condition"
                                    id="current_condition"
                                    class="form-select @error('current_condition') is-invalid @enderror"
                                    required>

                                <option value="">
                                    -- Select Condition --
                                </option>

                                <option value="Excellent"
                                    {{ old('current_condition') === 'Excellent' ? 'selected' : '' }}>
                                    Excellent
                                </option>

                                <option value="Good"
                                    {{ old('current_condition') === 'Good' ? 'selected' : '' }}>
                                    Good
                                </option>

                                <option value="Fair"
                                    {{ old('current_condition') === 'Fair' ? 'selected' : '' }}>
                                    Fair
                                </option>

                                <option value="Poor"
                                    {{ old('current_condition') === 'Poor' ? 'selected' : '' }}>
                                    Poor
                                </option>

                                <option value="Critical"
                                    {{ old('current_condition') === 'Critical' ? 'selected' : '' }}>
                                    Critical
                                </option>

                            </select>

                            @error('current_condition')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Status --}}
                        <div class="col-md-6">

                            <label for="status"
                                   class="form-label fw-semibold">

                                Component Status
                                <span class="text-danger">*</span>

                            </label>

                            <select name="status"
                                    id="status"
                                    class="form-select @error('status') is-invalid @enderror"
                                    required>

                                <option value="">
                                    -- Select Status --
                                </option>

                                <option value="Active"
                                    {{ old('status') === 'Active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="Under Maintenance"
                                    {{ old('status') === 'Under Maintenance' ? 'selected' : '' }}>
                                    Under Maintenance
                                </option>

                                <option value="Inactive"
                                    {{ old('status') === 'Inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>

                                <option value="Replaced"
                                    {{ old('status') === 'Replaced' ? 'selected' : '' }}>
                                    Replaced
                                </option>

                            </select>

                            @error('status')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                DESCRIPTION
            ====================================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-bottom py-3">

                    <div class="d-flex align-items-center">

                        <div class="section-icon bg-secondary bg-opacity-10 text-secondary me-3">

                            <i class="bi bi-card-text"></i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Additional Information
                            </h5>

                            <small class="text-muted">
                                Add notes or other relevant information about the component.
                            </small>

                        </div>

                    </div>

                </div>


                <div class="card-body p-4">

                    <label for="description"
                           class="form-label fw-semibold">

                        Description

                    </label>

                    <textarea name="description"
                              id="description"
                              rows="5"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Enter additional information about this component...">{{ old('description') }}</textarea>

                    @error('description')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>


            {{-- =====================================================
                FORM ACTIONS
            ====================================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body p-3">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                        <div class="text-muted small">

                            <i class="bi bi-info-circle me-1"></i>

                            Fields marked with
                            <span class="text-danger">*</span>
                            are required.

                        </div>


                        <div class="d-flex gap-2">

                            <a href="{{ route('components.index') }}"
                               class="btn btn-outline-secondary">

                                <i class="bi bi-x-circle me-1"></i>
                                Cancel

                            </a>


                            <button type="submit"
                                    class="btn btn-success px-4">

                                <i class="bi bi-check-circle me-1"></i>
                                Register Component

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>


    {{-- =============================================================
        PAGE STYLES
    ============================================================== --}}
    <style>

        .section-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
        }

        .warning-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            border-radius: 10px;
            background: rgba(255, 193, 7, .15);
            color: #856404;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .card {
            transition: box-shadow .2s ease;
        }

        .form-control,
        .form-select,
        .input-group-text {
            min-height: 42px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #198754;
            box-shadow: 0 0 0 .2rem rgba(25, 135, 84, .12);
        }

        .form-label {
            color: #343a40;
        }

        @media (max-width: 767.98px) {

            .container-fluid {
                padding-left: 12px;
                padding-right: 12px;
            }

            .card-body {
                padding: 1.25rem !important;
            }

        }

    </style>

</x-app-layout>