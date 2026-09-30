
<x-app-layout>

    <div class="container-fluid py-3">

        {{-- Page Header --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="page-icon">
                                <i class="bi bi-sun-fill"></i>
                            </span>

                            <div>
                                <h3 class="mb-0 fw-bold text-dark">
                                    Add Solar Installation
                                </h3>

                                <p class="text-muted mb-0 mt-1">
                                    Register a new solar-battery installation in the system.
                                </p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('installations.index') }}"
                       class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>
                        Back to Installations
                    </a>

                </div>
            </div>
        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4"
                 role="alert">

                <div class="d-flex align-items-start">

                    <div class="error-icon me-3">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>

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

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>
        @endif


        {{-- Main Form Card --}}
        <div class="card installation-card border-0 shadow-sm">

            {{-- Card Header --}}
            <div class="card-header installation-header text-white border-0">

                <div class="d-flex align-items-center">

                    <div class="header-icon me-3">
                        <i class="bi bi-building"></i>
                    </div>

                    <div>
                        <h5 class="mb-1 fw-bold">
                            Installation Information
                        </h5>

                        <small class="opacity-75">
                            Enter the details of the solar-battery installation below.
                        </small>
                    </div>

                </div>

            </div>


            {{-- Form --}}
            <form action="{{ route('installations.store') }}"
                  method="POST">

                @csrf

                <div class="card-body p-4">

                    {{-- Section Title --}}
                    <div class="form-section-title mb-4">
                        <div>
                            <h6 class="fw-bold mb-1">
                                <i class="bi bi-info-circle text-success me-2"></i>
                                Basic Information
                            </h6>

                            <p class="text-muted small mb-0">
                                Provide the basic identification and location details.
                            </p>
                        </div>
                    </div>


                    <div class="row g-4">

                        {{-- Installation Name --}}
                        <div class="col-md-6">

                            <label for="name"
                                   class="form-label fw-semibold">
                                Installation Name
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-building text-success"></i>
                                </span>

                                <input type="text"
                                       name="name"
                                       id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}"
                                       placeholder="e.g. Department Solar-Battery System"
                                       required>

                            </div>

                            @error('name')
                                <div class="text-danger small mt-1">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="form-text text-muted">
                                Enter a unique name that identifies the installation.
                            </small>

                        </div>


                        {{-- Location --}}
                        <div class="col-md-6">

                            <label for="location"
                                   class="form-label fw-semibold">
                                Location
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-geo-alt text-success"></i>
                                </span>

                                <input type="text"
                                       name="location"
                                       id="location"
                                       class="form-control @error('location') is-invalid @enderror"
                                       value="{{ old('location') }}"
                                       placeholder="e.g. Computer Science Department"
                                       required>

                            </div>

                            @error('location')
                                <div class="text-danger small mt-1">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="form-text text-muted">
                                Specify where the solar installation is located.
                            </small>

                        </div>


                        {{-- Installation Date --}}
                        <div class="col-md-6">

                            <label for="installation_date"
                                   class="form-label fw-semibold">
                                Installation Date
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-calendar-event text-success"></i>
                                </span>

                                <input type="date"
                                       name="installation_date"
                                       id="installation_date"
                                       class="form-control @error('installation_date') is-invalid @enderror"
                                       value="{{ old('installation_date') }}"
                                       required>

                            </div>

                            @error('installation_date')
                                <div class="text-danger small mt-1">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="form-text text-muted">
                                Date when the solar-battery system was installed.
                            </small>

                        </div>


                        {{-- System Capacity --}}
                        <div class="col-md-6">

                            <label for="system_capacity"
                                   class="form-label fw-semibold">

                                System Capacity
                                <span class="text-muted fw-normal">(kW)</span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-lightning-charge text-success"></i>
                                </span>

                                <input type="number"
                                       name="system_capacity"
                                       id="system_capacity"
                                       class="form-control @error('system_capacity') is-invalid @enderror"
                                       value="{{ old('system_capacity') }}"
                                       placeholder="e.g. 10"
                                       min="0"
                                       step="0.01">

                                <span class="input-group-text">
                                    kW
                                </span>

                            </div>

                            @error('system_capacity')
                                <div class="text-danger small mt-1">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="form-text text-muted">
                                Total rated capacity of the solar installation.
                            </small>

                        </div>


                        {{-- Status --}}
                        <div class="col-md-6">

                            <label for="status"
                                   class="form-label fw-semibold">

                                Installation Status
                                <span class="text-danger">*</span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-activity text-success"></i>
                                </span>

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

                                </select>

                            </div>

                            @error('status')
                                <div class="text-danger small mt-1">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="form-text text-muted">
                                Current operational status of the installation.
                            </small>

                        </div>

                    </div>


                    {{-- Description Section --}}
                    <div class="form-section-title mt-5 mb-4">

                        <div>
                            <h6 class="fw-bold mb-1">
                                <i class="bi bi-card-text text-success me-2"></i>
                                Additional Information
                            </h6>

                            <p class="text-muted small mb-0">
                                Add any relevant notes or information about the installation.
                            </p>
                        </div>

                    </div>


                    {{-- Description --}}
                    <div class="row">

                        <div class="col-12">

                            <label for="description"
                                   class="form-label fw-semibold">
                                Description
                            </label>

                            <textarea name="description"
                                      id="description"
                                      rows="5"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Enter additional information about the solar-battery installation...">{{ old('description') }}</textarea>

                            @error('description')
                                <div class="text-danger small mt-1">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="form-text text-muted">
                                Optional information such as the purpose of the system,
                                installation details, or other relevant notes.
                            </small>

                        </div>

                    </div>

                </div>


                {{-- Form Footer --}}
                <div class="card-footer bg-light border-top p-4">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                        <div class="text-muted small">
                            <i class="bi bi-info-circle me-1"></i>
                            Fields marked with <span class="text-danger">*</span> are required.
                        </div>

                        <div class="d-flex gap-2">

                            <a href="{{ route('installations.index') }}"
                               class="btn btn-outline-secondary px-4">

                                <i class="bi bi-x-circle me-1"></i>
                                Cancel

                            </a>

                            <button type="submit"
                                    class="btn btn-success px-4">

                                <i class="bi bi-check-circle me-1"></i>
                                Save Installation

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>


        {{-- Information Notice --}}
        <div class="alert installation-tip border-0 shadow-sm mt-4">

            <div class="d-flex align-items-start">

                <i class="bi bi-lightbulb-fill text-warning fs-4 me-3"></i>

                <div>

                    <h6 class="fw-bold mb-1">
                        Registration Tip
                    </h6>

                    <p class="mb-0 text-muted small">
                        Make sure the installation details are accurate. This information
                        will be used later for inspections, measurements, maintenance
                        scheduling, degradation analysis and replacement forecasting.
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- Page Styling --}}
    <style>

        .installation-card {
            border-radius: 14px;
            overflow: hidden;
        }

        .installation-header {
            background: linear-gradient(
                135deg,
                #198754 0%,
                #146c43 100%
            );
        }

        .header-icon {
            width: 46px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            font-size: 1.25rem;
        }

        .page-icon {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(25, 135, 84, 0.1);
            color: #198754;
            border-radius: 10px;
            font-size: 1.2rem;
        }

        .form-section-title {
            padding-bottom: 12px;
            border-bottom: 1px solid #e9ecef;
        }

        .form-label {
            color: #343a40;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select,
        .input-group-text {
            min-height: 44px;
            border-color: #dee2e6;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.12);
        }

        textarea.form-control {
            min-height: 130px;
            resize: vertical;
        }

        .input-group-text {
            background: #f8f9fa;
        }

        .installation-tip {
            background: #fffdf2;
            border-left: 4px solid #ffc107 !important;
        }

        .error-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
        }

        @media (max-width: 576px) {

            .installation-header,
            .card-body,
            .card-footer {
                padding: 1rem !important;
            }

            .page-icon {
                width: 38px;
                height: 38px;
            }

            .card-footer .d-flex {
                align-items: stretch !important;
            }

            .card-footer .text-muted {
                width: 100%;
            }

            .card-footer .d-flex.gap-2 {
                width: 100%;
            }

            .card-footer .btn {
                flex: 1;
            }

        }

    </style>

</x-app-layout>
