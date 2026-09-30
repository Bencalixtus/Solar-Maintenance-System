
<x-app-layout>

    <div class="container-fluid py-3">

        {{-- Page Header --}}
        <div class="row mb-4">
            <div class="col-12">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>
                        <div class="d-flex align-items-center gap-3">

                            <div class="page-icon">
                                <i class="bi bi-building"></i>
                            </div>

                            <div>
                                <h3 class="mb-1 fw-bold">
                                    Installation Details
                                </h3>

                                <p class="text-muted mb-0">
                                    View complete information about this solar-battery installation.
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">

                        <a href="{{ route('installations.index') }}"
                           class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>
                            Back
                        </a>

                        <a href="{{ route('installations.edit', $installation) }}"
                           class="btn btn-warning">
                            <i class="bi bi-pencil me-1"></i>
                            Edit Installation
                        </a>

                    </div>

                </div>

            </div>
        </div>


        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0"
                 role="alert">

                <i class="bi bi-check-circle-fill me-2"></i>

                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>
        @endif


        {{-- Installation Hero --}}
        <div class="installation-hero shadow-sm mb-4">

            <div class="hero-content">

                <div class="hero-icon">
                    <i class="bi bi-sun-fill"></i>
                </div>

                <div class="flex-grow-1">

                    <div class="d-flex align-items-center gap-2 flex-wrap">

                        <h2 class="mb-1 fw-bold">
                            {{ $installation->name }}
                        </h2>

                        @if($installation->status === 'Active')

                            <span class="badge bg-light text-success">
                                <i class="bi bi-check-circle me-1"></i>
                                Active
                            </span>

                        @elseif($installation->status === 'Under Maintenance')

                            <span class="badge bg-warning text-dark">
                                <i class="bi bi-tools me-1"></i>
                                Under Maintenance
                            </span>

                        @else

                            <span class="badge bg-light text-secondary">
                                <i class="bi bi-pause-circle me-1"></i>
                                Inactive
                            </span>

                        @endif

                    </div>

                    <p class="mb-0 opacity-75">

                        <i class="bi bi-geo-alt me-1"></i>

                        {{ $installation->location }}

                    </p>

                </div>

                <div class="hero-capacity text-md-end">

                    <small class="d-block opacity-75">
                        System Capacity
                    </small>

                    <strong>
                        {{ $installation->system_capacity
                            ? number_format($installation->system_capacity, 2)
                            : '0.00' }}
                        kW
                    </strong>

                </div>

            </div>

        </div>


        {{-- Main Overview --}}
        <div class="row g-4 mb-4">

            {{-- Installation Information --}}
            <div class="col-xl-8">

                <div class="card professional-card border-0 shadow-sm h-100">

                    <div class="card-header bg-white border-bottom py-3">

                        <div class="d-flex align-items-center">

                            <div class="section-icon bg-success-subtle text-success me-3">
                                <i class="bi bi-info-circle"></i>
                            </div>

                            <div>
                                <h5 class="mb-0 fw-bold">
                                    Installation Information
                                </h5>

                                <small class="text-muted">
                                    Basic details about this solar-battery system
                                </small>
                            </div>

                        </div>

                    </div>


                    <div class="card-body p-4">

                        <div class="row g-4">

                            {{-- Name --}}
                            <div class="col-md-6">

                                <div class="detail-item">

                                    <small>
                                        Installation Name
                                    </small>

                                    <div class="detail-value">
                                        <i class="bi bi-building text-success me-2"></i>
                                        {{ $installation->name }}
                                    </div>

                                </div>

                            </div>


                            {{-- Location --}}
                            <div class="col-md-6">

                                <div class="detail-item">

                                    <small>
                                        Location
                                    </small>

                                    <div class="detail-value">

                                        <i class="bi bi-geo-alt text-success me-2"></i>

                                        {{ $installation->location }}

                                    </div>

                                </div>

                            </div>


                            {{-- Installation Date --}}
                            <div class="col-md-6">

                                <div class="detail-item">

                                    <small>
                                        Installation Date
                                    </small>

                                    <div class="detail-value">

                                        <i class="bi bi-calendar-event text-success me-2"></i>

                                        {{ $installation->installation_date->format('d M Y') }}

                                    </div>

                                </div>

                            </div>


                            {{-- Capacity --}}
                            <div class="col-md-6">

                                <div class="detail-item">

                                    <small>
                                        System Capacity
                                    </small>

                                    <div class="detail-value">

                                        <i class="bi bi-lightning-charge text-success me-2"></i>

                                        @if($installation->system_capacity)

                                            {{ number_format($installation->system_capacity, 2) }} kW

                                        @else

                                            <span class="text-muted">
                                                Not specified
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </div>


                            {{-- Status --}}
                            <div class="col-md-6">

                                <div class="detail-item">

                                    <small>
                                        Current Status
                                    </small>

                                    <div class="mt-2">

                                        @if($installation->status === 'Active')

                                            <span class="status-badge status-active">
                                                <i class="bi bi-check-circle me-1"></i>
                                                Active
                                            </span>

                                        @elseif($installation->status === 'Under Maintenance')

                                            <span class="status-badge status-maintenance">
                                                <i class="bi bi-tools me-1"></i>
                                                Under Maintenance
                                            </span>

                                        @else

                                            <span class="status-badge status-inactive">
                                                <i class="bi bi-pause-circle me-1"></i>
                                                Inactive
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </div>


                            {{-- Components Count --}}
                            <div class="col-md-6">

                                <div class="detail-item">

                                    <small>
                                        Registered Components
                                    </small>

                                    <div class="detail-value">

                                        <i class="bi bi-cpu text-success me-2"></i>

                                        {{ $installation->components->count() }}

                                        <span class="text-muted fw-normal ms-1">
                                            component(s)
                                        </span>

                                    </div>

                                </div>

                            </div>


                            {{-- Description --}}
                            <div class="col-12">

                                <div class="detail-item">

                                    <small>
                                        Description
                                    </small>

                                    @if($installation->description)

                                        <div class="description-box mt-2">
                                            {{ $installation->description }}
                                        </div>

                                    @else

                                        <div class="description-empty mt-2">
                                            <i class="bi bi-info-circle me-1"></i>
                                            No description provided.
                                        </div>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Quick Statistics --}}
            <div class="col-xl-4">

                <div class="card professional-card border-0 shadow-sm h-100">

                    <div class="card-header bg-white border-bottom py-3">

                        <div class="d-flex align-items-center">

                            <div class="section-icon bg-warning-subtle text-warning me-3">
                                <i class="bi bi-bar-chart"></i>
                            </div>

                            <div>
                                <h5 class="mb-0 fw-bold">
                                    Quick Statistics
                                </h5>

                                <small class="text-muted">
                                    Current installation summary
                                </small>
                            </div>

                        </div>

                    </div>


                    <div class="card-body p-4">

                        {{-- Components --}}
                        <div class="stat-row">

                            <div class="stat-icon bg-success-subtle text-success">
                                <i class="bi bi-cpu"></i>
                            </div>

                            <div class="flex-grow-1">

                                <small class="text-muted d-block">
                                    Components
                                </small>

                                <strong class="fs-4">
                                    {{ $installation->components->count() }}
                                </strong>

                            </div>

                        </div>


                        {{-- Installation Age --}}
                        <div class="stat-row">

                            <div class="stat-icon bg-warning-subtle text-warning">
                                <i class="bi bi-calendar3"></i>
                            </div>

                            <div class="flex-grow-1">

                                <small class="text-muted d-block">
                                    Installation Age
                                </small>

                                <strong class="fs-4">

                                    {{ $installation->installation_date->diffInYears(now()) }}

                                    <small class="fs-6 fw-normal text-muted">
                                        year(s)
                                    </small>

                                </strong>

                            </div>

                        </div>


                        {{-- Capacity --}}
                        <div class="stat-row">

                            <div class="stat-icon bg-success-subtle text-success">
                                <i class="bi bi-lightning-charge"></i>
                            </div>

                            <div class="flex-grow-1">

                                <small class="text-muted d-block">
                                    System Capacity
                                </small>

                                <strong class="fs-4">

                                    {{ $installation->system_capacity
                                        ? number_format($installation->system_capacity, 2)
                                        : '0.00' }}

                                    <small class="fs-6 fw-normal text-muted">
                                        kW
                                    </small>

                                </strong>

                            </div>

                        </div>


                        {{-- Registered Date --}}
                        <div class="stat-row border-bottom-0 pb-0">

                            <div class="stat-icon bg-secondary-subtle text-secondary">
                                <i class="bi bi-clock-history"></i>
                            </div>

                            <div class="flex-grow-1">

                                <small class="text-muted d-block">
                                    Registered
                                </small>

                                <strong>
                                    {{ $installation->created_at->format('d M Y') }}
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Components --}}
        <div class="card professional-card border-0 shadow-sm">

            <div class="card-header bg-white border-bottom py-3">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <div class="d-flex align-items-center">

                        <div class="section-icon bg-success-subtle text-success me-3">
                            <i class="bi bi-cpu"></i>
                        </div>

                        <div>

                            <h5 class="mb-0 fw-bold">
                                Installation Components
                            </h5>

                            <small class="text-muted">
                                Components currently registered under this installation
                            </small>

                        </div>

                    </div>

                    <span class="component-count">

                        <i class="bi bi-cpu me-1"></i>

                        {{ $installation->components->count() }}

                        {{ $installation->components->count() === 1 ? 'Component' : 'Components' }}

                    </span>

                </div>

            </div>


            <div class="card-body p-0">

                @if($installation->components->count() > 0)

                    <div class="table-responsive">

                        <table class="table component-table align-middle mb-0">

                            <thead>

                                <tr>

                                    <th class="ps-4">
                                        Component
                                    </th>

                                    <th>
                                        Type
                                    </th>

                                    <th>
                                        Manufacturer
                                    </th>

                                    <th>
                                        Condition
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($installation->components as $component)

                                    <tr>

                                        {{-- Component --}}
                                        <td class="ps-4">

                                            <div class="d-flex align-items-center">

                                                <div class="component-icon me-3">
                                                    <i class="bi bi-cpu"></i>
                                                </div>

                                                <div>

                                                    <div class="fw-semibold">
                                                        {{ $component->name }}
                                                    </div>

                                                    @if($component->model)

                                                        <small class="text-muted">
                                                            Model: {{ $component->model }}
                                                        </small>

                                                    @endif

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Type --}}
                                        <td>

                                            <span class="text-muted">

                                                {{ $component->componentType->name ?? 'Not specified' }}

                                            </span>

                                        </td>


                                        {{-- Manufacturer --}}
                                        <td>

                                            {{ $component->manufacturer ?? 'Not specified' }}

                                        </td>


                                        {{-- Condition --}}
                                        <td>

                                            @php

                                                $conditionClass = match($component->current_condition) {

                                                    'Excellent' => 'success',

                                                    'Good' => 'success',

                                                    'Fair' => 'warning',

                                                    'Poor' => 'danger',

                                                    'Critical' => 'danger',

                                                    default => 'secondary',

                                                };

                                            @endphp

                                            <span class="badge bg-{{ $conditionClass }}">

                                                {{ $component->current_condition ?? 'Not specified' }}

                                            </span>

                                        </td>


                                        {{-- Status --}}
                                        <td>

                                            @if($component->status === 'Active')

                                                <span class="badge bg-success">
                                                    <i class="bi bi-check-circle me-1"></i>
                                                    Active
                                                </span>

                                            @elseif($component->status === 'Under Maintenance')

                                                <span class="badge bg-warning text-dark">
                                                    <i class="bi bi-tools me-1"></i>
                                                    Under Maintenance
                                                </span>

                                            @else

                                                <span class="badge bg-secondary">
                                                    {{ $component->status ?? 'Inactive' }}
                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    {{-- Empty Components State --}}
                    <div class="empty-state">

                        <div class="empty-icon">
                            <i class="bi bi-cpu"></i>
                        </div>

                        <h5 class="fw-bold mb-2">
                            No Components Registered
                        </h5>

                        <p class="text-muted mb-3">
                            Components such as solar panels, batteries and inverters
                            will appear here after they are registered.
                        </p>

                        <span class="badge bg-light text-dark border">
                            <i class="bi bi-arrow-right me-1"></i>
                            Component Management Coming Next
                        </span>

                    </div>

                @endif

            </div>

        </div>


        {{-- Installation Actions --}}
        <div class="card professional-card border-0 shadow-sm mt-4">

            <div class="card-header bg-white border-bottom py-3">

                <h5 class="mb-0 fw-bold text-danger">

                    <i class="bi bi-exclamation-triangle me-2"></i>

                    Installation Actions

                </h5>

            </div>


            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>

                        <h6 class="fw-semibold mb-1">
                            Manage this installation
                        </h6>

                        <p class="text-muted mb-0 small">
                            You can update the installation information or permanently
                            remove this installation from the system.
                        </p>

                    </div>


                    <form action="{{ route('installations.destroy', $installation) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this installation? This action cannot be undone.');">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-outline-danger">

                            <i class="bi bi-trash me-1"></i>
                            Delete Installation

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>


    {{-- Page Styling --}}
    <style>

        .page-icon {
            width: 46px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(25, 135, 84, 0.1);
            color: #198754;
            border-radius: 12px;
            font-size: 1.25rem;
        }

        .installation-hero {
            background: linear-gradient(
                135deg,
                #146c43 0%,
                #198754 60%,
                #157347 100%
            );
            color: #fff;
            border-radius: 14px;
            overflow: hidden;
        }

        .hero-content {
            min-height: 150px;
            padding: 28px 32px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .hero-icon {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            font-size: 1.7rem;
            flex-shrink: 0;
        }

        .hero-capacity {
            padding-left: 25px;
            border-left: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hero-capacity strong {
            font-size: 1.7rem;
        }

        .professional-card {
            border-radius: 14px;
            overflow: hidden;
        }

        .section-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 1.1rem;
        }

        .detail-item {
            padding-bottom: 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        .detail-item small {
            color: #6c757d;
            display: block;
            margin-bottom: 7px;
        }

        .detail-value {
            font-size: 1rem;
            font-weight: 600;
            color: #343a40;
        }

        .description-box {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 16px;
            color: #495057;
            line-height: 1.7;
        }

        .description-empty {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 14px 16px;
            color: #6c757d;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-active {
            color: #146c43;
            background: #d1e7dd;
        }

        .status-maintenance {
            color: #664d03;
            background: #fff3cd;
        }

        .status-inactive {
            color: #495057;
            background: #e9ecef;
        }

        .stat-row {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 17px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .component-count {
            display: inline-flex;
            align-items: center;
            padding: 7px 12px;
            background: #d1e7dd;
            color: #146c43;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .component-table thead th {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            color: #495057;
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            padding-top: 13px;
            padding-bottom: 13px;
        }

        .component-table tbody td {
            padding-top: 15px;
            padding-bottom: 15px;
            border-color: #f0f0f0;
        }

        .component-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e9f7ef;
            color: #198754;
            border-radius: 9px;
        }

        .empty-state {
            text-align: center;
            padding: 55px 20px;
        }

        .empty-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e9f7ef;
            color: #198754;
            border-radius: 18px;
            font-size: 2rem;
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
        }

        @media (max-width: 768px) {

            .hero-content {
                padding: 22px;
                flex-wrap: wrap;
            }

            .hero-capacity {
                width: 100%;
                padding-left: 0;
                padding-top: 15px;
                border-left: 0;
                border-top: 1px solid rgba(255, 255, 255, 0.2);
            }

            .hero-icon {
                width: 52px;
                height: 52px;
            }

        }

        @media (max-width: 576px) {

            .page-icon {
                width: 40px;
                height: 40px;
            }

            .hero-content {
                gap: 14px;
            }

            .hero-content h2 {
                font-size: 1.3rem;
            }

            .hero-capacity strong {
                font-size: 1.4rem;
            }

        }

    </style>

</x-app-layout>
