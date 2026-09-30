<x-app-layout>

    <x-slot name="header">
        <div class="installation-page-header">

            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <div class="page-icon">
                        <i class="bi bi-sun"></i>
                    </div>

                    <div>
                        <h2 class="fw-bold mb-0">
                            Solar Installations
                        </h2>

                        <p class="text-muted mb-0">
                            Manage and monitor registered solar-battery installations.
                        </p>
                    </div>
                </div>
            </div>

            <a href="{{ route('installations.create') }}"
               class="btn btn-success installation-add-btn">

                <i class="bi bi-plus-circle me-1"></i>
                Add Installation

            </a>

        </div>
    </x-slot>


    <div class="container-fluid py-2">

        {{-- =========================================================
            SUCCESS MESSAGE
        ========================================================== --}}

        @if (session('success'))

            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0"
                 role="alert">

                <div class="d-flex align-items-center">

                    <i class="bi bi-check-circle-fill fs-5 me-2"></i>

                    <div>
                        <strong>Success:</strong>
                        {{ session('success') }}
                    </div>

                </div>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        {{-- =========================================================
            VALIDATION ERRORS
        ========================================================== --}}

        @if ($errors->any())

            <div class="alert alert-danger shadow-sm border-0">

                <div class="d-flex align-items-start">

                    <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>

                    <div>

                        <strong>Please correct the following errors:</strong>

                        <ul class="mb-0 mt-2">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- =========================================================
            PAGE INTRO
        ========================================================== --}}

        <div class="installation-intro mb-4">

            <div>

                <span class="intro-label">
                    <i class="bi bi-grid-1x2-fill me-1"></i>
                    ASSET MANAGEMENT
                </span>

                <h4 class="fw-bold mt-2 mb-1">
                    Installation Overview
                </h4>

                <p class="text-muted mb-0">
                    Keep track of your solar installations, locations,
                    capacity, installation dates and operational status.
                </p>

            </div>

            <div class="intro-icon">
                <i class="bi bi-building"></i>
            </div>

        </div>


        {{-- =========================================================
            STATISTICS
        ========================================================== --}}

        <div class="row g-3 mb-4">

            {{-- Total Installations --}}
            <div class="col-xl-4 col-md-6">

                <div class="installation-stat-card stat-green">

                    <div class="stat-content">

                        <span class="stat-label">
                            Total Installations
                        </span>

                        <h2>
                            {{ $installations->total() }}
                        </h2>

                        <small>
                            Registered in the system
                        </small>

                    </div>

                    <div class="stat-icon">
                        <i class="bi bi-buildings"></i>
                    </div>

                </div>

            </div>


            {{-- Active Installations --}}
            <div class="col-xl-4 col-md-6">

                <div class="installation-stat-card stat-gold">

                    <div class="stat-content">

                        <span class="stat-label">
                            Active Installations
                        </span>

                        <h2>
                            {{ \App\Models\Installation::where('status', 'Active')->count() }}
                        </h2>

                        <small>
                            Currently operational
                        </small>

                    </div>

                    <div class="stat-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>

                </div>

            </div>


            {{-- Under Maintenance --}}
            <div class="col-xl-4 col-md-6">

                <div class="installation-stat-card stat-danger">

                    <div class="stat-content">

                        <span class="stat-label">
                            Under Maintenance
                        </span>

                        <h2>
                            {{ \App\Models\Installation::where('status', 'Under Maintenance')->count() }}
                        </h2>

                        <small>
                            Requiring maintenance attention
                        </small>

                    </div>

                    <div class="stat-icon">
                        <i class="bi bi-tools"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            INSTALLATION LIST
        ========================================================== --}}

        <div class="card installation-card border-0 shadow-sm">

            {{-- Card Header --}}
            <div class="card-header installation-card-header">

                <div class="d-flex justify-content-between align-items-center gap-3">

                    <div class="d-flex align-items-center">

                        <div class="table-header-icon">
                            <i class="bi bi-list-ul"></i>
                        </div>

                        <div>

                            <h5 class="mb-0 fw-bold">
                                Installation Register
                            </h5>

                            <small class="text-muted">
                                Registered solar-battery systems
                            </small>

                        </div>

                    </div>

                    <span class="records-badge">

                        <i class="bi bi-database me-1"></i>

                        {{ $installations->total() }} Records

                    </span>

                </div>

            </div>


            {{-- =====================================================
                TABLE
            ====================================================== --}}

            <div class="card-body p-0">

                @if ($installations->count() > 0)

                    <div class="table-responsive">

                        <table class="table installation-table align-middle mb-0">

                            <thead>

                                <tr>

                                    <th class="ps-4">
                                        #
                                    </th>

                                    <th>
                                        Installation
                                    </th>

                                    <th>
                                        Location
                                    </th>

                                    <th>
                                        Installation Date
                                    </th>

                                    <th>
                                        Capacity
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th class="text-center pe-4">
                                        Actions
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach ($installations as $installation)

                                    <tr>

                                        {{-- Number --}}
                                        <td class="ps-4">

                                            <span class="row-number">

                                                {{ $loop->iteration + ($installations->currentPage() - 1) * $installations->perPage() }}

                                            </span>

                                        </td>


                                        {{-- Installation --}}
                                        <td>

                                            <div class="installation-name">

                                                <div class="solar-mini-icon">
                                                    <i class="bi bi-sun"></i>
                                                </div>

                                                <div>

                                                    <div class="fw-bold">
                                                        {{ $installation->name }}
                                                    </div>

                                                    <small class="text-muted">
                                                        Installation #{{ $installation->id }}
                                                    </small>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Location --}}
                                        <td>

                                            <div class="location-cell">

                                                <i class="bi bi-geo-alt-fill"></i>

                                                <span>
                                                    {{ $installation->location ?: 'Not specified' }}
                                                </span>

                                            </div>

                                        </td>


                                        {{-- Installation Date --}}
                                        <td>

                                            @if ($installation->installation_date)

                                                <div class="date-cell">

                                                    <strong>
                                                        {{ $installation->installation_date->format('d M Y') }}
                                                    </strong>

                                                    <small class="text-muted">

                                                        {{ $installation->installation_date->diffForHumans() }}

                                                    </small>

                                                </div>

                                            @else

                                                <span class="text-muted">
                                                    Not specified
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Capacity --}}
                                        <td>

                                            @if ($installation->system_capacity)

                                                <div class="capacity-cell">

                                                    <i class="bi bi-lightning-charge-fill"></i>

                                                    <strong>
                                                        {{ number_format($installation->system_capacity, 2) }}
                                                    </strong>

                                                    <span>
                                                        kW
                                                    </span>

                                                </div>

                                            @else

                                                <span class="text-muted">
                                                    Not specified
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Status --}}
                                        <td>

                                            @if ($installation->status === 'Active')

                                                <span class="status-badge status-active">

                                                    <span class="status-dot"></span>

                                                    Active

                                                </span>

                                            @elseif ($installation->status === 'Under Maintenance')

                                                <span class="status-badge status-maintenance">

                                                    <span class="status-dot"></span>

                                                    Under Maintenance

                                                </span>

                                            @else

                                                <span class="status-badge status-inactive">

                                                    <span class="status-dot"></span>

                                                    Inactive

                                                </span>

                                            @endif

                                        </td>


                                        {{-- Actions --}}
                                        <td class="text-center pe-4">

                                            <div class="installation-actions">

                                                {{-- View --}}
                                                <a href="{{ route('installations.show', $installation) }}"
                                                   class="action-btn action-view"
                                                   title="View Installation">

                                                    <i class="bi bi-eye"></i>

                                                </a>


                                                {{-- Edit --}}
                                                <a href="{{ route('installations.edit', $installation) }}"
                                                   class="action-btn action-edit"
                                                   title="Edit Installation">

                                                    <i class="bi bi-pencil"></i>

                                                </a>


                                                {{-- Delete --}}
                                                <form
                                                    action="{{ route('installations.destroy', $installation) }}"
                                                    method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this installation? This action cannot be undone.');"
                                                >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="action-btn action-delete"
                                                        title="Delete Installation"
                                                    >

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


                @else

                    {{-- =================================================
                        EMPTY STATE
                    ================================================== --}}

                    <div class="empty-installation-state">

                        <div class="empty-icon">

                            <i class="bi bi-sun"></i>

                        </div>

                        <h4 class="fw-bold">
                            No Solar Installations Yet
                        </h4>

                        <p class="text-muted mb-4">

                            There are currently no solar-battery
                            installations registered in the system.

                        </p>

                        <a href="{{ route('installations.create') }}"
                           class="btn btn-success px-4">

                            <i class="bi bi-plus-circle me-1"></i>

                            Add First Installation

                        </a>

                    </div>

                @endif

            </div>


            {{-- =====================================================
                PAGINATION
            ====================================================== --}}

            @if ($installations->hasPages())

                <div class="card-footer installation-pagination">

                    <div class="small text-muted">

                        Showing
                        <strong>{{ $installations->firstItem() }}</strong>
                        to
                        <strong>{{ $installations->lastItem() }}</strong>
                        of
                        <strong>{{ $installations->total() }}</strong>
                        installations

                    </div>

                    <div>
                        {{ $installations->links() }}
                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- =============================================================
        PAGE STYLES
    ============================================================= --}}

    <style>

        :root {
            --installation-green: #198754;
            --installation-green-dark: #146c43;
            --installation-gold: #ffc107;
            --installation-danger: #dc3545;
            --installation-dark: #12372a;
            --installation-muted: #6c757d;
            --installation-border: #e7ece9;
        }


        /* ---------------------------------------------------------
           HEADER
        --------------------------------------------------------- */

        .installation-page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }


        .page-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(25, 135, 84, 0.10);
            color: var(--installation-green);
            font-size: 1.35rem;
        }


        .installation-add-btn {
            padding: 11px 18px;
            border-radius: 10px;
            font-weight: 600;
            box-shadow: 0 5px 14px rgba(25, 135, 84, 0.18);
        }


        /* ---------------------------------------------------------
           INTRO
        --------------------------------------------------------- */

        .installation-intro {
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 24px 28px;
            border-radius: 16px;
            background:
                linear-gradient(
                    135deg,
                    #f3faf6 0%,
                    #ffffff 65%
                );
            border: 1px solid var(--installation-border);
        }


        .intro-label {
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 1px;
            color: var(--installation-green);
        }


        .intro-icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(25, 135, 84, 0.08);
            color: var(--installation-green);
            font-size: 2rem;
        }


        /* ---------------------------------------------------------
           STATISTICS
        --------------------------------------------------------- */

        .installation-stat-card {
            position: relative;
            overflow: hidden;
            min-height: 145px;
            border-radius: 16px;
            padding: 23px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.06);
            transition: all 0.25s ease;
        }


        .installation-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.09);
        }


        .stat-green {
            background:
                linear-gradient(
                    135deg,
                    #146c43,
                    #198754
                );
            color: #ffffff;
        }


        .stat-gold {
            background:
                linear-gradient(
                    135deg,
                    #e0a800,
                    #ffc107
                );
            color: #212529;
        }


        .stat-danger {
            background:
                linear-gradient(
                    135deg,
                    #b02a37,
                    #dc3545
                );
            color: #ffffff;
        }


        .stat-content {
            position: relative;
            z-index: 2;
        }


        .stat-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 7px;
            opacity: 0.92;
        }


        .stat-content h2 {
            font-size: 2rem;
            font-weight: 800;
            margin: 0;
        }


        .stat-content small {
            display: block;
            margin-top: 5px;
            opacity: 0.78;
        }


        .stat-icon {
            position: relative;
            z-index: 2;
            width: 58px;
            height: 58px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.17);
            font-size: 1.7rem;
        }


        /* ---------------------------------------------------------
           INSTALLATION CARD
        --------------------------------------------------------- */

        .installation-card {
            border-radius: 16px;
            overflow: hidden;
        }


        .installation-card-header {
            background: #ffffff;
            padding: 19px 22px;
            border-bottom: 1px solid var(--installation-border);
        }


        .table-header-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(25, 135, 84, 0.10);
            color: var(--installation-green);
            margin-right: 12px;
        }


        .records-badge {
            display: inline-flex;
            align-items: center;
            padding: 7px 12px;
            border-radius: 20px;
            background: #edf8f2;
            color: var(--installation-green-dark);
            font-size: 0.78rem;
            font-weight: 700;
        }


        /* ---------------------------------------------------------
           TABLE
        --------------------------------------------------------- */

        .installation-table {
            min-width: 1000px;
        }


        .installation-table thead th {
            padding-top: 14px;
            padding-bottom: 14px;
            background: #f8faf9;
            border-bottom: 1px solid var(--installation-border);
            color: #495057;
            font-size: 0.74rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.45px;
            white-space: nowrap;
        }


        .installation-table tbody td {
            padding-top: 17px;
            padding-bottom: 17px;
            border-bottom: 1px solid #edf0ee;
        }


        .installation-table tbody tr {
            transition: background 0.2s ease;
        }


        .installation-table tbody tr:hover {
            background: #f8fcfa;
        }


        .installation-table tbody tr:last-child td {
            border-bottom: 0;
        }


        .row-number {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: #f1f5f3;
            color: #5b6761;
            font-size: 0.78rem;
            font-weight: 700;
        }


        /* ---------------------------------------------------------
           INSTALLATION NAME
        --------------------------------------------------------- */

        .installation-name {
            display: flex;
            align-items: center;
            gap: 11px;
        }


        .solar-mini-icon {
            width: 39px;
            height: 39px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(255, 193, 7, 0.14);
            color: #c99700;
        }


        /* ---------------------------------------------------------
           LOCATION
        --------------------------------------------------------- */

        .location-cell {
            display: flex;
            align-items: center;
            gap: 7px;
            max-width: 210px;
        }


        .location-cell i {
            color: var(--installation-green);
            flex-shrink: 0;
        }


        .location-cell span {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }


        /* ---------------------------------------------------------
           DATE
        --------------------------------------------------------- */

        .date-cell {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }


        .date-cell strong {
            font-size: 0.88rem;
        }


        .date-cell small {
            font-size: 0.72rem;
        }


        /* ---------------------------------------------------------
           CAPACITY
        --------------------------------------------------------- */

        .capacity-cell {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
        }


        .capacity-cell i {
            color: #c99700;
        }


        .capacity-cell span {
            color: #6c757d;
            font-size: 0.82rem;
        }


        /* ---------------------------------------------------------
           STATUS
        --------------------------------------------------------- */

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 0.74rem;
            font-weight: 700;
            white-space: nowrap;
        }


        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            display: inline-block;
        }


        .status-active {
            background: #e8f7ef;
            color: #146c43;
        }


        .status-active .status-dot {
            background: #198754;
        }


        .status-maintenance {
            background: #fff5d6;
            color: #8a6800;
        }


        .status-maintenance .status-dot {
            background: #ffc107;
        }


        .status-inactive {
            background: #eef0f2;
            color: #5c636a;
        }


        .status-inactive .status-dot {
            background: #6c757d;
        }


        /* ---------------------------------------------------------
           ACTIONS
        --------------------------------------------------------- */

        .installation-actions {
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }


        .action-btn {
            width: 34px;
            height: 34px;
            border: 1px solid transparent;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            transition: all 0.2s ease;
            text-decoration: none;
        }


        .action-view {
            color: var(--installation-green);
            background: #edf8f2;
        }


        .action-view:hover {
            color: #ffffff;
            background: var(--installation-green);
        }


        .action-edit {
            color: #a67c00;
            background: #fff8df;
        }


        .action-edit:hover {
            color: #212529;
            background: var(--installation-gold);
        }


        .action-delete {
            color: #b02a37;
            background: #fff0f1;
        }


        .action-delete:hover {
            color: #ffffff;
            background: var(--installation-danger);
        }


        /* ---------------------------------------------------------
           EMPTY STATE
        --------------------------------------------------------- */

        .empty-installation-state {
            text-align: center;
            padding: 75px 20px;
        }


        .empty-icon {
            width: 88px;
            height: 88px;
            margin: 0 auto 20px;
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #edf8f2;
            color: var(--installation-green);
            font-size: 2.8rem;
        }


        /* ---------------------------------------------------------
           PAGINATION
        --------------------------------------------------------- */

        .installation-pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 16px 20px;
            background: #ffffff;
            border-top: 1px solid var(--installation-border);
        }


        .installation-pagination .pagination {
            margin-bottom: 0;
        }


        /* ---------------------------------------------------------
           RESPONSIVE
        --------------------------------------------------------- */

        @media (max-width: 768px) {

            .installation-page-header {
                flex-direction: column;
                align-items: flex-start;
            }


            .installation-add-btn {
                width: 100%;
            }


            .installation-intro {
                padding: 20px;
            }


            .intro-icon {
                display: none;
            }


            .installation-pagination {
                flex-direction: column;
                align-items: flex-start;
            }

        }


        @media (max-width: 576px) {

            .installation-stat-card {
                min-height: 130px;
                padding: 18px;
            }


            .stat-content h2 {
                font-size: 1.7rem;
            }


            .stat-icon {
                width: 48px;
                height: 48px;
                font-size: 1.4rem;
            }

        }

    </style>

</x-app-layout>