<x-app-layout>

    <x-slot name="header">

        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

            <div>
                <div class="d-flex align-items-center gap-2 mb-1">

                    <span class="dashboard-title-icon">
                        <i class="bi bi-sun-fill"></i>
                    </span>

                    <h4 class="fw-bold mb-0">
                        Solar Maintenance Dashboard
                    </h4>

                </div>

                <p class="text-muted mb-0 ms-lg-5">
                    Preventive maintenance, condition monitoring and replacement decision support
                </p>
            </div>

            <div class="d-flex align-items-center gap-2">

                <span class="dashboard-date">
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ now()->format('d M Y') }}
                </span>

                <span class="badge bg-success px-3 py-2">
                    <i class="bi bi-circle-fill me-1" style="font-size: 7px;"></i>
                    System Operational
                </span>

            </div>

        </div>

    </x-slot>


    <style>

        /* ==========================================================
           DASHBOARD BRANDING
        ========================================================== */

        :root {
            --solar-green: #198754;
            --solar-dark: #146c43;
            --solar-gold: #ffc107;
            --solar-teal: #073b2a;
            --solar-light: #f5f8f6;
        }


        body {
            background-color: var(--solar-light);
        }


        /* ==========================================================
           HEADER
        ========================================================== */

        .dashboard-title-icon {

            width: 42px;
            height: 42px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background: rgba(25, 135, 84, 0.12);

            color: var(--solar-green);

            font-size: 20px;
        }


        .dashboard-date {

            background: #ffffff;

            border: 1px solid #e4ebe7;

            color: #5f6f67;

            padding: 8px 12px;

            border-radius: 8px;

            font-size: 13px;
        }


        /* ==========================================================
           WELCOME BANNER
        ========================================================== */

        .dashboard-welcome {

            position: relative;

            overflow: hidden;

            background:
                linear-gradient(
                    120deg,
                    #073b2a 0%,
                    #146c43 60%,
                    #198754 100%
                );

            border-radius: 16px;

            color: #ffffff;

            padding: 28px 30px;

            box-shadow: 0 8px 24px rgba(7, 59, 42, 0.16);
        }


        .dashboard-welcome::after {

            content: "";

            position: absolute;

            width: 230px;
            height: 230px;

            right: -70px;
            top: -100px;

            border: 35px solid rgba(255, 193, 7, 0.13);

            border-radius: 50%;
        }


        .dashboard-welcome::before {

            content: "";

            position: absolute;

            width: 120px;
            height: 120px;

            right: 100px;
            bottom: -70px;

            border: 22px solid rgba(255, 255, 255, 0.06);

            border-radius: 50%;
        }


        .dashboard-welcome-content {
            position: relative;
            z-index: 2;
        }


        .welcome-label {

            color: #ffc107;

            font-size: 12px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 1.2px;

            margin-bottom: 6px;
        }


        .welcome-title {

            font-size: 26px;

            font-weight: 700;

            margin-bottom: 7px;
        }


        .welcome-description {

            max-width: 720px;

            color: rgba(255, 255, 255, 0.82);

            font-size: 14px;

            line-height: 1.7;

            margin-bottom: 0;
        }


        .welcome-actions {

            position: relative;

            z-index: 2;
        }


        .welcome-actions .btn {

            border-radius: 9px;

            padding: 10px 16px;

            font-weight: 600;
        }


        /* ==========================================================
           STATISTIC CARDS
        ========================================================== */

        .stat-card {

            position: relative;

            overflow: hidden;

            background: #ffffff;

            border: 1px solid #e8eeeb;

            border-radius: 14px;

            padding: 20px;

            height: 100%;

            transition: all 0.25s ease;

            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        }


        .stat-card:hover {

            transform: translateY(-3px);

            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }


        .stat-card::after {

            content: "";

            position: absolute;

            width: 80px;
            height: 80px;

            right: -25px;
            bottom: -30px;

            border-radius: 50%;

            background: rgba(25, 135, 84, 0.05);
        }


        .stat-icon {

            width: 48px;
            height: 48px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            font-size: 21px;

            margin-bottom: 16px;
        }


        .stat-icon.green {

            background: rgba(25, 135, 84, 0.12);

            color: var(--solar-green);
        }


        .stat-icon.blue {

            background: rgba(13, 110, 253, 0.10);

            color: #0d6efd;
        }


        .stat-icon.gold {

            background: rgba(255, 193, 7, 0.15);

            color: #b88600;
        }


        .stat-icon.red {

            background: rgba(220, 53, 69, 0.10);

            color: #dc3545;
        }


        .stat-number {

            font-size: 30px;

            line-height: 1;

            font-weight: 700;

            color: #1f2d27;

            margin-bottom: 5px;
        }


        .stat-label {

            color: #718078;

            font-size: 13px;

            margin-bottom: 14px;
        }


        .stat-link {

            color: var(--solar-green);

            font-size: 13px;

            font-weight: 600;

            text-decoration: none;
        }


        .stat-link:hover {
            color: var(--solar-dark);
        }


        /* ==========================================================
           SECTION CARDS
        ========================================================== */

        .dashboard-card {

            border: 1px solid #e8eeeb !important;

            border-radius: 14px !important;

            overflow: hidden;

            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04) !important;

            background: #ffffff;
        }


        .dashboard-card .card-header {

            background: #ffffff;

            border-bottom: 1px solid #edf1ef;

            padding: 17px 20px;
        }


        .section-icon {

            width: 34px;
            height: 34px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background: rgba(25, 135, 84, 0.10);

            color: var(--solar-green);

            margin-right: 8px;
        }


        .section-title {

            font-size: 15px;

            font-weight: 700;

            color: #27352f;

            margin: 0;
        }


        /* ==========================================================
           MAINTENANCE OVERVIEW
        ========================================================== */

        .overview-item {

            border: 1px solid #edf1ef;

            border-radius: 11px;

            padding: 16px;

            height: 100%;

            transition: 0.2s ease;
        }


        .overview-item:hover {

            border-color: rgba(25, 135, 84, 0.3);

            background: #fbfdfc;
        }


        .overview-number {

            font-size: 24px;

            font-weight: 700;

            line-height: 1;

            margin-top: 5px;
        }


        .overview-label {

            font-size: 12px;

            color: #7b8882;
        }


        /* ==========================================================
           UPCOMING MAINTENANCE
        ========================================================== */

        .maintenance-item {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            padding: 13px 0;

            border-bottom: 1px solid #edf1ef;
        }


        .maintenance-item:last-child {
            border-bottom: none;
        }


        .maintenance-date {

            min-width: 58px;

            text-align: center;

            background: rgba(25, 135, 84, 0.09);

            color: var(--solar-green);

            border-radius: 9px;

            padding: 7px 5px;
        }


        .maintenance-date strong {

            display: block;

            font-size: 17px;

            line-height: 1;
        }


        .maintenance-date small {

            font-size: 10px;

            text-transform: uppercase;
        }


        /* ==========================================================
           TABLE
        ========================================================== */

        .dashboard-table th {

            font-size: 11px;

            text-transform: uppercase;

            letter-spacing: 0.4px;

            color: #68766f;

            font-weight: 700;

            white-space: nowrap;
        }


        .dashboard-table td {

            font-size: 13px;

            color: #394840;
        }


        .dashboard-table tbody tr {

            transition: background 0.2s ease;
        }


        .dashboard-table tbody tr:hover {

            background: rgba(25, 135, 84, 0.035);
        }


        /* ==========================================================
           QUICK ACTIONS
        ========================================================== */

        .quick-action {

            display: block;

            height: 100%;

            background: #ffffff;

            border: 1px solid #e8eeeb;

            border-radius: 13px;

            padding: 20px;

            text-decoration: none;

            transition: all 0.25s ease;

            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.035);
        }


        .quick-action:hover {

            transform: translateY(-3px);

            border-color: rgba(25, 135, 84, 0.35);

            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
        }


        .quick-action-icon {

            width: 44px;
            height: 44px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            border-radius: 11px;

            font-size: 19px;

            margin-bottom: 12px;
        }


        .quick-action h6 {

            color: #27352f;

            font-weight: 700;

            margin-bottom: 5px;
        }


        .quick-action small {
            color: #7b8882;
        }


        /* ==========================================================
           EMPTY STATE
        ========================================================== */

        .empty-state {

            padding: 45px 20px;

            text-align: center;
        }


        .empty-state-icon {

            width: 65px;
            height: 65px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #f0f4f2;

            color: #89958f;

            font-size: 28px;
        }


        /* ==========================================================
           FOOTER
        ========================================================== */

        .dashboard-footer {

            text-align: center;

            color: #84918b;

            font-size: 12px;

            padding: 25px 10px 10px;
        }


        .dashboard-footer strong {
            color: #53635b;
        }


        /* ==========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 767px) {

            .dashboard-welcome {
                padding: 22px;
            }

            .welcome-title {
                font-size: 22px;
            }

            .welcome-actions {
                margin-top: 18px;
            }

            .dashboard-date {
                display: none;
            }

            .dashboard-title-icon {
                width: 38px;
                height: 38px;
            }

        }

    </style>


    <div class="container-fluid py-3">


        {{-- ==========================================================
             SUCCESS MESSAGE
        ========================================================== --}}

        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0"
                 role="alert">

                <i class="bi bi-check-circle me-2"></i>

                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        {{-- ==========================================================
             WELCOME BANNER
        ========================================================== --}}

        <div class="dashboard-welcome mb-4">

            <div class="dashboard-welcome-content">

                <div class="row align-items-center">

                    <div class="col-lg-8">

                        <div class="welcome-label">
                            Final Year Project • Department of Software and Web Development
                        </div>

                        <h1 class="welcome-title">
                            Solar Maintenance System
                        </h1>

                        <p class="welcome-description">
                            Preventive maintenance schedule and cost model for a
                            2-year-old solar-battery installation, supporting
                            inspection, condition monitoring and replacement planning.
                        </p>

                    </div>


                    <div class="col-lg-4">

                        <div class="welcome-actions d-flex flex-wrap justify-content-lg-end gap-2">

                            <a href="{{ route('installations.index') }}"
                               class="btn btn-light">

                                <i class="bi bi-grid-3x3-gap me-1"></i>

                                View System

                            </a>

                            <a href="{{ route('maintenance-schedules.create') }}"
                               class="btn btn-warning">

                                <i class="bi bi-calendar-plus me-1"></i>

                                Schedule Maintenance

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ==========================================================
             STATISTICS
        ========================================================== --}}

        <div class="row g-3 mb-4">


            {{-- Installations --}}

            <div class="col-xl-3 col-md-6">

                <div class="stat-card">

                    <div class="stat-icon blue">
                        <i class="bi bi-building"></i>
                    </div>

                    <div class="stat-number">
                        {{ $totalInstallations }}
                    </div>

                    <div class="stat-label">
                        Total Solar Installations
                    </div>

                    <a href="{{ route('installations.index') }}"
                       class="stat-link">

                        View installations
                        <i class="bi bi-arrow-right ms-1"></i>

                    </a>

                </div>

            </div>


            {{-- Components --}}

            <div class="col-xl-3 col-md-6">

                <div class="stat-card">

                    <div class="stat-icon green">
                        <i class="bi bi-cpu"></i>
                    </div>

                    <div class="stat-number">
                        {{ $totalComponents }}
                    </div>

                    <div class="stat-label">
                        Registered Components
                    </div>

                    <a href="{{ route('components.index') }}"
                       class="stat-link">

                        View components
                        <i class="bi bi-arrow-right ms-1"></i>

                    </a>

                </div>

            </div>


            {{-- Inspections --}}

            <div class="col-xl-3 col-md-6">

                <div class="stat-card">

                    <div class="stat-icon gold">
                        <i class="bi bi-clipboard-check"></i>
                    </div>

                    <div class="stat-number">
                        {{ $pendingInspections }}
                    </div>

                    <div class="stat-label">
                        Pending Inspections
                    </div>

                    <a href="{{ route('inspections.index') }}"
                       class="stat-link">

                        Review inspections
                        <i class="bi bi-arrow-right ms-1"></i>

                    </a>

                </div>

            </div>


            {{-- Maintenance --}}

            <div class="col-xl-3 col-md-6">

                <div class="stat-card">

                    <div class="stat-icon red">
                        <i class="bi bi-tools"></i>
                    </div>

                    <div class="stat-number">
                        {{ $maintenanceDue }}
                    </div>

                    <div class="stat-label">
                        Maintenance Due
                    </div>

                    <a href="{{ route('maintenance-schedules.index') }}"
                       class="stat-link">

                        Review maintenance
                        <i class="bi bi-arrow-right ms-1"></i>

                    </a>

                </div>

            </div>

        </div>


        {{-- ==========================================================
             ANALYTICS
        ========================================================== --}}

        <div class="row g-4 mb-4">


            {{-- Component Condition --}}

            <div class="col-xl-6">

                <div class="card dashboard-card h-100">

                    <div class="card-header">

                        <div class="d-flex align-items-center">

                            <span class="section-icon">
                                <i class="bi bi-pie-chart"></i>
                            </span>

                            <div>

                                <h5 class="section-title">
                                    Component Condition
                                </h5>

                                <small class="text-muted">
                                    Latest recorded condition by component
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body">

                        <div style="height: 320px;">

                            <canvas id="conditionChart"></canvas>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Maintenance Status --}}

            <div class="col-xl-6">

                <div class="card dashboard-card h-100">

                    <div class="card-header">

                        <div class="d-flex align-items-center">

                            <span class="section-icon">
                                <i class="bi bi-bar-chart"></i>
                            </span>

                            <div>

                                <h5 class="section-title">
                                    Maintenance Status
                                </h5>

                                <small class="text-muted">
                                    Current maintenance schedule distribution
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body">

                        <div style="height: 320px;">

                            <canvas id="maintenanceChart"></canvas>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ==========================================================
             SECONDARY ANALYTICS
        ========================================================== --}}

        <div class="row g-4 mb-4">


            {{-- Replacement Risk --}}

            <div class="col-xl-5">

                <div class="card dashboard-card h-100">

                    <div class="card-header">

                        <div class="d-flex align-items-center">

                            <span class="section-icon">
                                <i class="bi bi-shield-exclamation"></i>
                            </span>

                            <div>

                                <h5 class="section-title">
                                    Replacement Risk
                                </h5>

                                <small class="text-muted">
                                    Current replacement forecast risk levels
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body">

                        <div style="height: 285px;">

                            <canvas id="riskChart"></canvas>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Maintenance Overview --}}

            <div class="col-xl-7">

                <div class="card dashboard-card h-100">

                    <div class="card-header">

                        <div class="d-flex align-items-center">

                            <span class="section-icon">
                                <i class="bi bi-calendar-check"></i>
                            </span>

                            <div>

                                <h5 class="section-title">
                                    Maintenance Overview
                                </h5>

                                <small class="text-muted">
                                    Schedule activity at a glance
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body">

                        <div class="row g-3">


                            {{-- Total --}}

                            <div class="col-md-6">

                                <div class="overview-item">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <div>

                                            <div class="overview-label">
                                                Total Schedules
                                            </div>

                                            <div class="overview-number">
                                                {{ $totalMaintenance }}
                                            </div>

                                        </div>

                                        <i class="bi bi-calendar-event fs-3 text-success"></i>

                                    </div>

                                </div>

                            </div>


                            {{-- Scheduled --}}

                            <div class="col-md-6">

                                <div class="overview-item">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <div>

                                            <div class="overview-label">
                                                Scheduled
                                            </div>

                                            <div class="overview-number text-primary">
                                                {{ $scheduledMaintenance }}
                                            </div>

                                        </div>

                                        <i class="bi bi-calendar-check fs-3 text-primary"></i>

                                    </div>

                                </div>

                            </div>


                            {{-- Due --}}

                            <div class="col-md-6">

                                <div class="overview-item">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <div>

                                            <div class="overview-label">
                                                Due / Overdue
                                            </div>

                                            <div class="overview-number text-danger">
                                                {{ $dueMaintenance }}
                                            </div>

                                        </div>

                                        <i class="bi bi-exclamation-triangle fs-3 text-danger"></i>

                                    </div>

                                </div>

                            </div>


                            {{-- Upcoming --}}

                            <div class="col-md-6">

                                <div class="overview-item">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <div>

                                            <div class="overview-label">
                                                Upcoming
                                            </div>

                                            <div class="overview-number text-success">
                                                {{ $upcomingMaintenance->count() }}
                                            </div>

                                        </div>

                                        <i class="bi bi-calendar2-week fs-3 text-success"></i>

                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="mt-4">

                            <a href="{{ route('maintenance-schedules.index') }}"
                               class="btn btn-success">

                                <i class="bi bi-calendar-check me-1"></i>

                                Manage Maintenance Schedules

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ==========================================================
             UPCOMING MAINTENANCE
        ========================================================== --}}

        <div class="row mb-4">

            <div class="col-12">

                <div class="card dashboard-card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between align-items-center">

                            <div class="d-flex align-items-center">

                                <span class="section-icon">
                                    <i class="bi bi-calendar2-week"></i>
                                </span>

                                <div>

                                    <h5 class="section-title">
                                        Upcoming Maintenance
                                    </h5>

                                    <small class="text-muted">
                                        Next scheduled maintenance activities
                                    </small>

                                </div>

                            </div>

                            <a href="{{ route('maintenance-schedules.index') }}"
                               class="btn btn-sm btn-outline-success">

                                View All

                            </a>

                        </div>

                    </div>


                    <div class="card-body">


                        @if($upcomingMaintenance->count())


                            <div class="row g-3">

                                @foreach($upcomingMaintenance as $maintenance)

                                    <div class="col-lg-4 col-md-6">

                                        <div class="maintenance-item">

                                            <div class="d-flex align-items-center gap-3">

                                                <div class="maintenance-date">

                                                    <strong>
                                                        {{ $maintenance->next_due_date
                                                            ? $maintenance->next_due_date->format('d')
                                                            : '--' }}
                                                    </strong>

                                                    <small>
                                                        {{ $maintenance->next_due_date
                                                            ? $maintenance->next_due_date->format('M')
                                                            : 'N/A' }}
                                                    </small>

                                                </div>


                                                <div>

                                                    <div class="fw-semibold">

                                                        {{ $maintenance->title
                                                            ?? $maintenance->maintenance_type
                                                            ?? 'Maintenance Activity' }}

                                                    </div>

                                                    <small class="text-muted">

                                                        {{ $maintenance->status ?? 'Scheduled' }}

                                                    </small>

                                                </div>

                                            </div>


                                            @if($maintenance->next_due_date)

                                                <span class="badge bg-success-subtle text-success">
                                                    {{ $maintenance->next_due_date->format('d M') }}
                                                </span>

                                            @endif

                                        </div>

                                    </div>

                                @endforeach

                            </div>


                        @else


                            <div class="empty-state">

                                <div class="empty-state-icon">

                                    <i class="bi bi-calendar-x"></i>

                                </div>

                                <h6 class="fw-bold mt-3">
                                    No upcoming maintenance
                                </h6>

                                <p class="text-muted mb-3">

                                    No upcoming maintenance activities have been scheduled.

                                </p>

                                <a href="{{ route('maintenance-schedules.create') }}"
                                   class="btn btn-success">

                                    <i class="bi bi-calendar-plus me-1"></i>

                                    Schedule Maintenance

                                </a>

                            </div>


                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- ==========================================================
             RECENT INSPECTIONS
        ========================================================== --}}

        <div class="row mb-4">

            <div class="col-12">

                <div class="card dashboard-card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between align-items-center">

                            <div class="d-flex align-items-center">

                                <span class="section-icon">
                                    <i class="bi bi-clipboard-data"></i>
                                </span>

                                <div>

                                    <h5 class="section-title">
                                        Recent Inspections
                                    </h5>

                                    <small class="text-muted">
                                        Latest inspection records
                                    </small>

                                </div>

                            </div>


                            <a href="{{ route('inspections.index') }}"
                               class="btn btn-sm btn-outline-success">

                                View All

                            </a>

                        </div>

                    </div>


                    <div class="card-body p-0">


                        @if($recentInspections->count())


                            <div class="table-responsive">

                                <table class="table table-hover align-middle mb-0 dashboard-table">

                                    <thead class="table-light">

                                        <tr>

                                            <th class="ps-4">#</th>

                                            <th>Installation</th>

                                            <th>Inspector</th>

                                            <th>Inspection Date</th>

                                            <th>Condition</th>

                                            <th>Next Inspection</th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        @foreach($recentInspections as $inspection)

                                            <tr>

                                                <td class="ps-4">
                                                    {{ $loop->iteration }}
                                                </td>


                                                <td>

                                                    <span class="fw-semibold">

                                                        {{ $inspection->installation->name ?? 'N/A' }}

                                                    </span>

                                                </td>


                                                <td>

                                                    {{ $inspection->inspector->name ?? 'N/A' }}

                                                </td>


                                                <td>

                                                    @if($inspection->inspection_date)

                                                        {{ $inspection->inspection_date->format('d M Y') }}

                                                    @else

                                                        N/A

                                                    @endif

                                                </td>


                                                <td>

                                                    @switch($inspection->overall_condition)

                                                        @case('Excellent')

                                                            <span class="badge bg-success">
                                                                <i class="bi bi-check-circle me-1"></i>
                                                                Excellent
                                                            </span>

                                                            @break

                                                        @case('Good')

                                                            <span class="badge bg-primary">
                                                                <i class="bi bi-check2 me-1"></i>
                                                                Good
                                                            </span>

                                                            @break

                                                        @case('Fair')

                                                            <span class="badge bg-warning text-dark">
                                                                <i class="bi bi-dash-circle me-1"></i>
                                                                Fair
                                                            </span>

                                                            @break

                                                        @case('Poor')

                                                            <span class="badge bg-danger">
                                                                <i class="bi bi-exclamation-circle me-1"></i>
                                                                Poor
                                                            </span>

                                                            @break

                                                        @case('Critical')

                                                            <span class="badge bg-dark">
                                                                <i class="bi bi-x-circle me-1"></i>
                                                                Critical
                                                            </span>

                                                            @break

                                                        @default

                                                            <span class="badge bg-secondary">
                                                                N/A
                                                            </span>

                                                    @endswitch

                                                </td>


                                                <td>

                                                    @if($inspection->next_inspection_date)

                                                        {{ $inspection->next_inspection_date->format('d M Y') }}

                                                    @else

                                                        N/A

                                                    @endif

                                                </td>

                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>


                        @else


                            <div class="empty-state">

                                <div class="empty-state-icon">

                                    <i class="bi bi-clipboard-x"></i>

                                </div>

                                <h6 class="fw-bold mt-3">
                                    No inspections recorded
                                </h6>

                                <p class="text-muted mb-3">

                                    Inspection records will appear here once they are created.

                                </p>

                                <a href="{{ route('inspections.create') }}"
                                   class="btn btn-success">

                                    <i class="bi bi-plus-circle me-1"></i>

                                    Create Inspection

                                </a>

                            </div>


                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- ==========================================================
             QUICK ACTIONS
        ========================================================== --}}

        <div class="row g-3 mb-4">


            {{-- Add Installation --}}

            <div class="col-xl-3 col-md-6">

                <a href="{{ route('installations.create') }}"
                   class="quick-action">

                    <span class="quick-action-icon"
                          style="background: rgba(13,110,253,.10); color:#0d6efd;">

                        <i class="bi bi-building-add"></i>

                    </span>

                    <h6>
                        Add Installation
                    </h6>

                    <small>
                        Register a solar installation
                    </small>

                </a>

            </div>


            {{-- Add Component --}}

            <div class="col-xl-3 col-md-6">

                <a href="{{ route('components.create') }}"
                   class="quick-action">

                    <span class="quick-action-icon"
                          style="background: rgba(25,135,84,.10); color:#198754;">

                        <i class="bi bi-cpu"></i>

                    </span>

                    <h6>
                        Register Component
                    </h6>

                    <small>
                        Add a system component
                    </small>

                </a>

            </div>


            {{-- Inspection --}}

            <div class="col-xl-3 col-md-6">

                <a href="{{ route('inspections.create') }}"
                   class="quick-action">

                    <span class="quick-action-icon"
                          style="background: rgba(255,193,7,.14); color:#a77b00;">

                        <i class="bi bi-clipboard-plus"></i>

                    </span>

                    <h6>
                        New Inspection
                    </h6>

                    <small>
                        Record a system inspection
                    </small>

                </a>

            </div>


            {{-- Maintenance --}}

            <div class="col-xl-3 col-md-6">

                <a href="{{ route('maintenance-schedules.create') }}"
                   class="quick-action">

                    <span class="quick-action-icon"
                          style="background: rgba(220,53,69,.10); color:#dc3545;">

                        <i class="bi bi-calendar-plus"></i>

                    </span>

                    <h6>
                        Schedule Maintenance
                    </h6>

                    <small>
                        Plan preventive maintenance
                    </small>

                </a>

            </div>

        </div>


        {{-- ==========================================================
             PROJECT FOOTER
        ========================================================== --}}

        <div class="dashboard-footer">

            <div>
                <strong>Solar Maintenance System</strong>
                · Federal Polytechnic Bauchi
            </div>

            <div>
                Department of Software and Web Development
                · Developed by <strong>Ukaba Benjamin Adekpe</strong>
            </div>

            <div class="mt-1">
                © {{ date('Y') }} All Rights Reserved.
            </div>

        </div>


    </div>


    {{-- ==============================================================
         CHART.JS
    ============================================================== --}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>

        document.addEventListener('DOMContentLoaded', function () {


            /* ========================================================
               COMPONENT CONDITION CHART
            ======================================================== */

            const conditionCanvas =
                document.getElementById('conditionChart');


            if (conditionCanvas) {

                new Chart(conditionCanvas, {

                    type: 'doughnut',

                    data: {

                        labels: [
                            'Excellent',
                            'Good',
                            'Fair',
                            'Poor',
                            'Critical'
                        ],

                        datasets: [{

                            data: [

                                {{ $conditionData['Excellent'] ?? 0 }},

                                {{ $conditionData['Good'] ?? 0 }},

                                {{ $conditionData['Fair'] ?? 0 }},

                                {{ $conditionData['Poor'] ?? 0 }},

                                {{ $conditionData['Critical'] ?? 0 }}

                            ],

                            borderWidth: 2,

                            hoverOffset: 7

                        }]

                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        cutout: '62%',

                        plugins: {

                            legend: {

                                position: 'bottom',

                                labels: {

                                    padding: 18,

                                    usePointStyle: true,

                                    pointStyle: 'circle'

                                }

                            }

                        }

                    }

                });

            }


            /* ========================================================
               MAINTENANCE STATUS CHART
            ======================================================== */

            const maintenanceCanvas =
                document.getElementById('maintenanceChart');


            if (maintenanceCanvas) {

                new Chart(maintenanceCanvas, {

                    type: 'bar',

                    data: {

                        labels: [
                            'Scheduled',
                            'Due',
                            'Completed',
                            'Overdue'
                        ],

                        datasets: [{

                            label: 'Maintenance Activities',

                            data: [

                                {{ $scheduledMaintenance }},

                                {{ $dueMaintenance }},

                                {{ $totalMaintenance - $scheduledMaintenance - $dueMaintenance >= 0
                                    ? $totalMaintenance - $scheduledMaintenance - $dueMaintenance
                                    : 0 }},

                                {{ $dueMaintenance }}

                            ],

                            borderWidth: 0,

                            borderRadius: 7,

                            maxBarThickness: 48

                        }]

                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        scales: {

                            y: {

                                beginAtZero: true,

                                ticks: {

                                    precision: 0

                                },

                                grid: {

                                    color: 'rgba(0,0,0,0.06)'

                                }

                            },

                            x: {

                                grid: {

                                    display: false

                                }

                            }

                        },

                        plugins: {

                            legend: {

                                display: false

                            }

                        }

                    }

                });

            }


            /* ========================================================
               REPLACEMENT RISK CHART
            ======================================================== */

            const riskCanvas =
                document.getElementById('riskChart');


            if (riskCanvas) {

                new Chart(riskCanvas, {

                    type: 'doughnut',

                    data: {

                        labels: [
                            'Low Risk',
                            'Medium Risk',
                            'High Risk'
                        ],

                        datasets: [{

                            data: [

                                {{ $riskData['Low'] ?? 0 }},

                                {{ $riskData['Medium'] ?? 0 }},

                                {{ $riskData['High'] ?? 0 }}

                            ],

                            borderWidth: 2,

                            hoverOffset: 7

                        }]

                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        cutout: '62%',

                        plugins: {

                            legend: {

                                position: 'bottom',

                                labels: {

                                    padding: 18,

                                    usePointStyle: true,

                                    pointStyle: 'circle'

                                }

                            }

                        }

                    }

                });

            }

        });

    </script>

</x-app-layout>