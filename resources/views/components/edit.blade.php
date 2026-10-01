@extends('adminlte::page')

@section('title', 'Edit Component')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-1">
                <i class="fas fa-edit text-warning me-2"></i>
                Edit Component
            </h1>
            <p class="text-muted mb-0">
                Update the details of {{ $component->name }}.
            </p>
        </div>

        <a href="{{ route('components.show', $component) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>
            Back to Details
        </a>
    </div>
@stop

@section('content')

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h6 class="mb-2">
                <i class="fas fa-exclamation-triangle me-1"></i>
                Please correct the following errors:
            </h6>

            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('components.update', $component) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            {{-- Component Information --}}
            <div class="col-lg-8">

                <div class="card card-warning card-outline mb-4">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-microchip me-2"></i>
                            Component Information
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            {{-- Installation --}}
                            <div class="col-md-6 mb-3">
                                <label for="installation_id" class="form-label">
                                    Installation <span class="text-danger">*</span>
                                </label>

                                <select name="installation_id"
                                        id="installation_id"
                                        class="form-select @error('installation_id') is-invalid @enderror"
                                        required>

                                    <option value="">Select Installation</option>

                                    @foreach ($installations as $installation)
                                        <option value="{{ $installation->id }}"
                                            {{ old('installation_id', $component->installation_id) == $installation->id ? 'selected' : '' }}>
                                            {{ $installation->name }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('installation_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Component Type --}}
                            <div class="col-md-6 mb-3">
                                <label for="component_type_id" class="form-label">
                                    Component Type <span class="text-danger">*</span>
                                </label>

                                <select name="component_type_id"
                                        id="component_type_id"
                                        class="form-select @error('component_type_id') is-invalid @enderror"
                                        required>

                                    <option value="">Select Component Type</option>

                                    @foreach ($componentTypes as $type)
                                        <option value="{{ $type->id }}"
                                            {{ old('component_type_id', $component->component_type_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('component_type_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Component Name --}}
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    Component Name <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="name"
                                       id="name"
                                       value="{{ old('name', $component->name) }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="e.g. Solar Panel Array"
                                       required>

                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Manufacturer --}}
                            <div class="col-md-6 mb-3">
                                <label for="manufacturer" class="form-label">
                                    Manufacturer
                                </label>

                                <input type="text"
                                       name="manufacturer"
                                       id="manufacturer"
                                       value="{{ old('manufacturer', $component->manufacturer) }}"
                                       class="form-control @error('manufacturer') is-invalid @enderror"
                                       placeholder="e.g. Canadian Solar">

                                @error('manufacturer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Model --}}
                            <div class="col-md-6 mb-3">
                                <label for="model" class="form-label">
                                    Model
                                </label>

                                <input type="text"
                                       name="model"
                                       id="model"
                                       value="{{ old('model', $component->model) }}"
                                       class="form-control @error('model') is-invalid @enderror"
                                       placeholder="Enter model number">

                                @error('model')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Serial Number --}}
                            <div class="col-md-6 mb-3">
                                <label for="serial_number" class="form-label">
                                    Serial Number
                                </label>

                                <input type="text"
                                       name="serial_number"
                                       id="serial_number"
                                       value="{{ old('serial_number', $component->serial_number) }}"
                                       class="form-control @error('serial_number') is-invalid @enderror"
                                       placeholder="Enter serial number">

                                @error('serial_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Installation Date --}}
                            <div class="col-md-6 mb-3">
                                <label for="installation_date" class="form-label">
                                    Installation Date <span class="text-danger">*</span>
                                </label>

                                <input type="date"
                                       name="installation_date"
                                       id="installation_date"
                                       value="{{ old('installation_date', $component->installation_date ? \Illuminate\Support\Carbon::parse($component->installation_date)->format('Y-m-d') : '') }}"
                                       class="form-control @error('installation_date') is-invalid @enderror"
                                       required>

                                @error('installation_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Rated Capacity --}}
                            <div class="col-md-6 mb-3">
                                <label for="rated_capacity" class="form-label">
                                    Rated Capacity
                                </label>

                                <div class="input-group">
                                    <input type="number"
                                           step="0.01"
                                           min="0"
                                           name="rated_capacity"
                                           id="rated_capacity"
                                           value="{{ old('rated_capacity', $component->rated_capacity) }}"
                                           class="form-control @error('rated_capacity') is-invalid @enderror"
                                           placeholder="e.g. 450">

                                    <span class="input-group-text">W</span>
                                </div>

                                @error('rated_capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Rated Voltage --}}
                            <div class="col-md-6 mb-3">
                                <label for="rated_voltage" class="form-label">
                                    Rated Voltage
                                </label>

                                <div class="input-group">
                                    <input type="number"
                                           step="0.01"
                                           min="0"
                                           name="rated_voltage"
                                           id="rated_voltage"
                                           value="{{ old('rated_voltage', $component->rated_voltage) }}"
                                           class="form-control @error('rated_voltage') is-invalid @enderror"
                                           placeholder="e.g. 24">

                                    <span class="input-group-text">V</span>
                                </div>

                                @error('rated_voltage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Expected Lifespan --}}
                            <div class="col-md-6 mb-3">
                                <label for="expected_lifespan" class="form-label">
                                    Expected Lifespan
                                </label>

                                <div class="input-group">
                                    <input type="number"
                                           min="1"
                                           max="100"
                                           name="expected_lifespan"
                                           id="expected_lifespan"
                                           value="{{ old('expected_lifespan', $component->expected_lifespan) }}"
                                           class="form-control @error('expected_lifespan') is-invalid @enderror"
                                           placeholder="e.g. 25">

                                    <span class="input-group-text">Years</span>
                                </div>

                                @error('expected_lifespan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Current Condition --}}
                            <div class="col-md-6 mb-3">
                                <label for="current_condition" class="form-label">
                                    Current Condition <span class="text-danger">*</span>
                                </label>

                                <select name="current_condition"
                                        id="current_condition"
                                        class="form-select @error('current_condition') is-invalid @enderror"
                                        required>

                                    @foreach (['Excellent', 'Good', 'Fair', 'Poor', 'Critical'] as $condition)
                                        <option value="{{ $condition }}"
                                            {{ old('current_condition', $component->current_condition) === $condition ? 'selected' : '' }}>
                                            {{ $condition }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('current_condition')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">
                                    Status <span class="text-danger">*</span>
                                </label>

                                <select name="status"
                                        id="status"
                                        class="form-select @error('status') is-invalid @enderror"
                                        required>

                                    @foreach (['Active', 'Under Maintenance', 'Inactive', 'Replaced'] as $status)
                                        <option value="{{ $status }}"
                                            {{ old('status', $component->status) === $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="col-12 mb-3">
                                <label for="description" class="form-label">
                                    Description
                                </label>

                                <textarea name="description"
                                          id="description"
                                          rows="5"
                                          class="form-control @error('description') is-invalid @enderror"
                                          placeholder="Enter additional information about this component...">{{ old('description', $component->description) }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-between">

                        <a href="{{ route('components.show', $component) }}"
                           class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-1"></i>
                            Update Component
                        </button>

                    </div>

                </div>

            </div>

            {{-- Information Panel --}}
            <div class="col-lg-4">

                <div class="card card-success card-outline">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-info-circle me-2"></i>
                            Component Information
                        </h3>
                    </div>

                    <div class="card-body">

                        <p class="text-muted">
                            Update the component information carefully. Changes made here
                            will affect maintenance records, measurements and replacement
                            forecasting associated with this component.
                        </p>

                        <hr>

                        <div class="mb-3">
                            <small class="text-muted d-block">
                                Component ID
                            </small>
                            <strong>#{{ $component->id }}</strong>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted d-block">
                                Current Component
                            </small>
                            <strong>{{ $component->name }}</strong>
                        </div>

                        <div>
                            <small class="text-muted d-block">
                                Last Updated
                            </small>
                            <strong>
                                {{ $component->updated_at?->format('d M Y, h:i A') ?? 'N/A' }}
                            </strong>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

@stop