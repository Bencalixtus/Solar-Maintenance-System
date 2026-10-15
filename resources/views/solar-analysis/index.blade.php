
@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">

    {{-- Page heading --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Solar Performance Analysis</h1>
            <p class="text-muted mb-0">
                Research data analysis from PVDAQ System 10
            </p>
        </div>

        <span class="badge bg-info text-dark px-3 py-2 mt-2">
            Research Dataset
        </span>
    </div>

    {{-- Research dataset notice --}}
    <div class="alert alert-warning" role="alert">
        <strong>Research data notice:</strong>
        This page uses external PVDAQ research measurements collected in 2023.
        Model-flagged observations indicate unusual patterns and are not
        confirmed equipment faults or measurements from the department's
        solar installation.
    </div>

    {{-- Summary cards --}}
    <div class="row g-3 mb-4">

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Total Observations</div>
                    <div class="h2 fw-bold mb-0">
                        {{ number_format($summary['total']) }}
                    </div>
                    <small class="text-muted">Imported research records</small>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Unusual Observations</div>
                    <div class="h2 fw-bold text-warning mb-0">
                        {{ number_format($summary['anomalies']) }}
                    </div>
                    <small class="text-muted">Flagged by the model</small>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Normal Observations</div>
                    <div class="h2 fw-bold text-success mb-0">
                        {{ number_format($summary['normal']) }}
                    </div>
                    <small class="text-muted">Not flagged as unusual</small>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Latest Observation</div>
                    <div class="h5 fw-bold mb-1">
                        @if ($summary['latest'])
                            {{ \Carbon\Carbon::parse($summary['latest'])->format('d M Y') }}
                        @else
                            N/A
                        @endif
                    </div>
                    <small class="text-muted">Date in the dataset</small>
                </div>
            </div>
        </div>

    </div>

    {{-- Observation filters --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Filter Observations</h2>
        </div>

        <div class="card-body">
            <form method="GET" action="{{ route('solar-analysis.index') }}">
                <div class="row g-3 align-items-end">

                    <div class="col-12 col-md-4">
                        <label for="type" class="form-label">Observation Type</label>
                        <select name="type" id="type" class="form-select">
                            <option value="">All observations</option>
                            <option value="anomaly"
                                {{ request('type') === 'anomaly' ? 'selected' : '' }}>
                                Unusual observations
                            </option>
                            <option value="normal"
                                {{ request('type') === 'normal' ? 'selected' : '' }}>
                                Normal observations
                            </option>
                        </select>
                    </div>

                    <div class="col-12 col-md-3">
                        <label for="from" class="form-label">From Date</label>
                        <input
                            type="date"
                            name="from"
                            id="from"
                            class="form-control"
                            value="{{ request('from') }}"
                        >
                    </div>

                    <div class="col-12 col-md-3">
                        <label for="to" class="form-label">To Date</label>
                        <input
                            type="date"
                            name="to"
                            id="to"
                            class="form-control"
                            value="{{ request('to') }}"
                        >
                    </div>

                    <div class="col-12 col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-success flex-grow-1">
                            Filter
                        </button>
                        <a href="{{ route('solar-analysis.index') }}"
                           class="btn btn-outline-secondary">
                            Reset
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- Research observations table --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h2 class="h5 mb-0">Research Observations</h2>
            <span class="text-muted small">
                {{ $results->total() }} matching records
            </span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-3">Observed At</th>
                            <th>System</th>
                            <th>Irradiance</th>
                            <th>DC Power</th>
                            <th>AC Power</th>
                            <th>DC Voltage</th>
                            <th>DC Current</th>
                            <th>Model Status</th>
                            <th>Classification</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($results as $result)
                            <tr>
                                <td class="px-3 text-nowrap">
                                    {{ $result->observed_at?->format('d M Y, H:i') ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $result->source }}-{{ $result->system_id }}
                                </td>

                                <td>
                                    {{ $result->irradiance !== null ? number_format((float) $result->irradiance, 2) : 'N/A' }}
                                </td>

                                <td>
                                    {{ $result->dc_power !== null ? number_format((float) $result->dc_power, 2) : 'N/A' }}
                                </td>

                                <td>
                                    {{ $result->ac_power !== null ? number_format((float) $result->ac_power, 2) : 'N/A' }}
                                </td>

                                <td>
                                    {{ $result->dc_voltage !== null ? number_format((float) $result->dc_voltage, 2) : 'N/A' }}
                                </td>

                                <td>
                                    {{ $result->dc_current !== null ? number_format((float) $result->dc_current, 2) : 'N/A' }}
                                </td>

                                <td>
                                    {{ $result->model_status ?: 'N/A' }}
                                </td>

                                <td>
                                    @if ($result->is_anomaly)
                                        <span class="badge bg-warning text-dark">
                                            Unusual
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            Normal
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <p class="text-muted mb-2">
                                        No observations match your filters.
                                    </p>
                                    <a href="{{ route('solar-analysis.index') }}"
                                       class="btn btn-outline-success btn-sm">
                                        Clear Filters
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($results->hasPages())
            <div class="card-footer bg-white">
                {{ $results->links() }}
            </div>
        @endif
    </div>

    <p class="text-muted small mt-3">
        The displayed measurements retain the units recorded in the source
        dataset. Verify source metadata before interpreting them. Unusual
        observations require further investigation and do not independently
        establish equipment failure.
    </p>

</div>
@endsection
