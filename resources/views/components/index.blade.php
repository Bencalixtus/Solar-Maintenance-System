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

                    <h3 class="fw-bold mb-0">
                        Solar Components
                    </h3>
                </div>

                <p class="text-muted mb-0">
                    Manage and monitor components installed in solar-battery systems.
                </p>
            </div>

            <a href="{{ route('components.create') }}"
               class="btn btn-success px-3">

                <i class="bi bi-plus-circle me-1"></i>
                Register Component

            </a>

        </div>


        {{-- =========================================================
            ALERTS
        ========================================================== --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0"
                 role="alert">

                <i class="bi bi-check-circle-fill me-2"></i>

                <strong>Success:</strong>
                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        @if(session('error'))

            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0"
                 role="alert">

                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                <strong>Error:</strong>
                {{ session('error') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        {{-- =========================================================
            STATISTICS
        ========================================================== --}}
        <div class="row g-3 mb-4">

            {{-- Total --}}
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm h-100 component-stat-card">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <small class="text-muted d-block mb-1">
                                    Total Components
                                </small>

                                <h3 class="fw-bold mb-0">
                                    {{ $components->total() }}
                                </h3>
                            </div>

                            <div class="stat-icon bg-success bg-opacity-10 text-success">
                                <i class="bi bi-cpu"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Active --}}
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm h-100 component-stat-card">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <small class="text-muted d-block mb-1">
                                    Active
                                </small>

                                <h3 class="fw-bold mb-0 text-success">
                                    {{ $components->getCollection()->where('status', 'Active')->count() }}
                                </h3>
                            </div>

                            <div class="stat-icon bg-success bg-opacity-10 text-success">
                                <i class="bi bi-check-circle"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Maintenance --}}
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm h-100 component-stat-card">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <small class="text-muted d-block mb-1">
                                    Under Maintenance
                                </small>

                                <h3 class="fw-bold mb-0 text-warning">
                                    {{ $components->getCollection()->where('status', 'Under Maintenance')->count() }}
                                </h3>
                            </div>

                            <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                                <i class="bi bi-tools"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Critical --}}
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm h-100 component-stat-card">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <small class="text-muted d-block mb-1">
                                    Critical Condition
                                </small>

                                <h3 class="fw-bold mb-0 text-danger">
                                    {{ $components->getCollection()->where('current_condition', 'Critical')->count() }}
                                </h3>
                            </div>

                            <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            COMPONENTS TABLE
        ========================================================== --}}
        <div class="card border-0 shadow-sm overflow-hidden">

            <div class="card-header bg-white border-bottom py-3">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <div>

                        <h5 class="fw-bold mb-1">
                            <i class="bi bi-list-check text-success me-2"></i>
                            Registered Components
                        </h5>

                        <small class="text-muted">
                            Components currently registered in the system
                        </small>

                    </div>

                    <span class="badge bg-success rounded-pill px-3 py-2">
                        {{ $components->total() }}
                        {{ Str::plural('Component', $components->total()) }}
                    </span>

                </div>

            </div>


            <div class="card-body p-0">

                @if($components->count() > 0)

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">

                                <tr>

                                    <th class="px-4 py-3">
                                        #
                                    </th>

                                    <th class="py-3">
                                        Component
                                    </th>

                                    <th class="py-3">
                                        Type
                                    </th>

                                    <th class="py-3">
                                        Installation
                                    </th>

                                    <th class="py-3">
                                        Condition
                                    </th>

                                    <th class="py-3">
                                        Status
                                    </th>

                                    <th class="text-end px-4 py-3">
                                        Actions
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($components as $component)

                                    <tr>

                                        {{-- Number --}}
                                        <td class="px-4 text-muted fw-semibold">

                                            {{ $components->firstItem() + $loop->index }}

                                        </td>


                                        {{-- Component --}}
                                        <td>

                                            <div class="d-flex align-items-center">

                                                <div class="component-icon bg-success bg-opacity-10 text-success me-3">

                                                    <i class="bi bi-cpu"></i>

                                                </div>

                                                <div>

                                                    <div class="fw-semibold text-dark">

                                                        {{ $component->name }}

                                                    </div>

                                                    <div class="small text-muted">

                                                        @if($component->manufacturer)

                                                            {{ $component->manufacturer }}

                                                            @if($component->model)
                                                                · {{ $component->model }}
                                                            @endif

                                                        @elseif($component->model)

                                                            {{ $component->model }}

                                                        @else

                                                            Manufacturer not specified

                                                        @endif

                                                    </div>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Type --}}
                                        <td>

                                            @if($component->componentType)

                                                <span class="badge bg-light text-dark border px-2 py-1">

                                                    <i class="bi bi-tag me-1"></i>

                                                    {{ $component->componentType->name }}

                                                </span>

                                            @else

                                                <span class="text-muted">
                                                    Not specified
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Installation --}}
                                        <td>

                                            @if($component->installation)

                                                <div class="fw-semibold">

                                                    {{ $component->installation->name }}

                                                </div>

                                                <small class="text-muted">

                                                    <i class="bi bi-geo-alt me-1"></i>

                                                    {{ $component->installation->location }}

                                                </small>

                                            @else

                                                <span class="text-muted">
                                                    Not specified
                                                </span>

                                            @endif

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


                                            <span class="badge bg-{{ $conditionClass }} px-2 py-1">

                                                {{ $component->current_condition ?? 'Not specified' }}

                                            </span>

                                        </td>


                                        {{-- Status --}}
                                        <td>

                                            @if($component->status === 'Active')

                                                <span class="badge bg-success px-2 py-1">

                                                    <i class="bi bi-check-circle me-1"></i>
                                                    Active

                                                </span>

                                            @elseif($component->status === 'Under Maintenance')

                                                <span class="badge bg-warning text-dark px-2 py-1">

                                                    <i class="bi bi-tools me-1"></i>
                                                    Under Maintenance

                                                </span>

                                            @elseif($component->status === 'Replaced')

                                                <span class="badge bg-info px-2 py-1">

                                                    <i class="bi bi-arrow-repeat me-1"></i>
                                                    Replaced

                                                </span>

                                            @else

                                                <span class="badge bg-secondary px-2 py-1">

                                                    {{ $component->status ?? 'Inactive' }}

                                                </span>

                                            @endif

                                        </td>


                                        {{-- Actions --}}
                                        <td class="text-end px-4">

                                            <div class="btn-group shadow-sm">

                                                <a href="{{ route('components.show', $component) }}"
                                                   class="btn btn-sm btn-outline-success"
                                                   title="View Component">

                                                    <i class="bi bi-eye"></i>

                                                </a>


                                                <a href="{{ route('components.edit', $component) }}"
                                                   class="btn btn-sm btn-outline-warning"
                                                   title="Edit Component">

                                                    <i class="bi bi-pencil"></i>

                                                </a>


                                                <form action="{{ route('components.destroy', $component) }}"
                                                      method="POST"
                                                      class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this component?');">

                                                    @csrf

                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-danger"
                                                            title="Delete Component">

                                                        <i class="bi bi-trash"></i>

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- Pagination --}}
                    @if($components->hasPages())

                        <div class="border-top p-3">

                            {{ $components->links() }}

                        </div>

                    @endif

                @else

                    {{-- =================================================
                        EMPTY STATE
                    ================================================== --}}
                    <div class="text-center py-5 px-3">

                        <div class="empty-icon bg-success bg-opacity-10 text-success mx-auto mb-3">

                            <i class="bi bi-cpu"></i>

                        </div>

                        <h5 class="fw-bold mb-2">
                            No Components Registered
                        </h5>

                        <p class="text-muted mb-4 mx-auto"
                           style="max-width: 550px;">

                            Start by registering the solar panels, batteries,
                            inverter and other components connected to your
                            solar-battery installation.

                        </p>

                        <a href="{{ route('components.create') }}"
                           class="btn btn-success">

                            <i class="bi bi-plus-circle me-1"></i>

                            Register First Component

                        </a>

                    </div>

                @endif

            </div>

        </div>


        {{-- =========================================================
            INFORMATION NOTICE
        ========================================================== --}}
        <div class="card border-0 shadow-sm mt-4">

            <div class="card-body">

                <div class="d-flex align-items-start">

                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-2 me-3">

                        <i class="bi bi-info-circle fs-5"></i>

                    </div>

                    <div>

                        <h6 class="fw-bold mb-1">
                            Component Tracking
                        </h6>

                        <p class="text-muted mb-0">

                            Each registered component can be linked to
                            inspections, measurements, maintenance records,
                            maintenance costs and replacement forecasts.
                            This information supports preventive maintenance
                            and long-term decision making.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =============================================================
        COMPONENT PAGE STYLES
    ============================================================== --}}
    <style>

        .component-stat-card {
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .component-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .08) !important;
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
        }

        .component-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
        }

        .empty-icon {
            width: 76px;
            height: 76px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
        }

        .table > :not(caption) > * > * {
            vertical-align: middle;
        }

        .table tbody tr {
            transition: background-color .15s ease;
        }

        .btn-group .btn {
            min-width: 36px;
        }

        @media (max-width: 767.98px) {

            .table {
                min-width: 950px;
            }

        }

    </style>

</x-app-layout>