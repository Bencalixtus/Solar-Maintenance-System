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
                        <label for="type" class="form-label">
                            Observation Type
                        </label>
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
                        <button type="submit"
                                class="btn btn-success flex-grow-1">
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

    {{-- Solar performance charts --}}
    <div class="row g-3 mb-4">

        {{-- Daily power trend --}}
        <div class="col-12">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <h2 class="h5 mb-1">Daily Solar Power Trend</h2>
                    <p class="text-muted small mb-0">
                        Daily average DC and AC power readings from the research dataset.
                    </p>
                </div>

                <div class="card-body">
                    <div style="position: relative; height: 350px;">
                        <canvas id="powerTrendChart"
                                role="img"
                                aria-label="Daily average DC and AC power chart">
                        </canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Classification summary --}}
        <div class="col-12 col-xl-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <h2 class="h5 mb-1">Observation Classification</h2>
                    <p class="text-muted small mb-0">
                        Model classifications, not confirmed equipment faults.
                    </p>
                </div>

                <div class="card-body">
                    <div style="position: relative; height: 300px;">
                        <canvas id="classificationChart"
                                role="img"
                                aria-label="Normal and unusual observation counts">
                        </canvas>
                    </div>

                    <div class="text-muted small mt-3">
                        Normal:
                        {{ number_format($classificationChart['normal']) }}
                        · Unusual:
                        {{ number_format($classificationChart['unusual']) }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Irradiance relationship --}}
        <div class="col-12 col-xl-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <h2 class="h5 mb-1">Solar Irradiance and DC Power</h2>
                    <p class="text-muted small mb-0">
                        Sample of up to 500 observations with available readings.
                    </p>
                </div>

                <div class="card-body">
                    <div style="position: relative; height: 300px;">
                        <canvas id="irradianceChart"
                                role="img"
                                aria-label="Solar irradiance versus DC power scatter chart">
                        </canvas>
                    </div>

                    <p class="text-muted small mt-3 mb-0">
                        Each point represents one observation. This chart explores
                        the relationship between recorded irradiance and DC power;
                        it does not establish causation.
                    </p>
                </div>
            </div>
        </div>

    </div>

    {{-- Research observations table --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex flex-wrap
                    justify-content-between align-items-center gap-2">
            <h2 class="h5 mb-0">Research Observations</h2>

            <span class="text-muted small">
                {{ number_format($results->total()) }} matching records
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
                                    {{ $result->irradiance !== null
                                        ? number_format((float) $result->irradiance, 2)
                                        : 'N/A' }}
                                </td>

                                <td>
                                    {{ $result->dc_power !== null
                                        ? number_format((float) $result->dc_power, 2)
                                        : 'N/A' }}
                                </td>

                                <td>
                                    {{ $result->ac_power !== null
                                        ? number_format((float) $result->ac_power, 2)
                                        : 'N/A' }}
                                </td>

                                <td>
                                    {{ $result->dc_voltage !== null
                                        ? number_format((float) $result->dc_voltage, 2)
                                        : 'N/A' }}
                                </td>

                                <td>
                                    {{ $result->dc_current !== null
                                        ? number_format((float) $result->dc_current, 2)
                                        : 'N/A' }}
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

    {{-- Research limitation notice --}}
    <p class="text-muted small mt-3">
        The displayed measurements retain the units recorded in the source
        dataset. Verify source metadata before interpreting them. Unusual
        observations require further investigation and do not independently
        establish equipment failure.
    </p>

</div>
@endsection

{{-- Chart.js --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.8/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof Chart === 'undefined') {
        console.error('Chart.js did not load. Check your internet connection.');
        return;
    }

    const powerData = {{ Illuminate\Support\Js::from($powerChart) }};
    const classificationData = {{ Illuminate\Support\Js::from($classificationChart) }};
    const relationshipData = {{ Illuminate\Support\Js::from($relationshipChart) }};

    const commonLegend = {
        position: 'bottom',
        labels: {
            usePointStyle: true,
            padding: 18
        }
    };

    // 1. Daily DC and AC power trend.
    const powerCanvas = document.getElementById('powerTrendChart');

    if (powerCanvas) {
        new Chart(powerCanvas, {
            type: 'line',
            data: {
                labels: powerData.labels,
                datasets: [
                    {
                        label: 'Average DC Power',
                        data: powerData.dcPower,
                        borderColor: '#198754',
                        backgroundColor: 'rgba(25, 135, 84, 0.12)',
                        borderWidth: 2,
                        pointRadius: 2,
                        tension: 0.25,
                        spanGaps: true
                    },
                    {
                        label: 'Average AC Power',
                        data: powerData.acPower,
                        borderColor: '#0d6efd',
                        backgroundColor: 'rgba(13, 110, 253, 0.10)',
                        borderWidth: 2,
                        pointRadius: 2,
                        tension: 0.25,
                        spanGaps: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: commonLegend,
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const value = context.parsed.y;
                                return context.dataset.label + ': ' +
                                    (value === null ? 'N/A' :
                                        Number(value).toLocaleString(undefined, {
                                            maximumFractionDigits: 2
                                        }));
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Observation date'
                        },
                        ticks: {
                            maxTicksLimit: 12,
                            maxRotation: 45,
                            minRotation: 0
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Recorded power (source units)'
                        }
                    }
                }
            }
        });
    }

    // 2. Normal versus model-flagged observations.
    const classificationCanvas =
        document.getElementById('classificationChart');

    if (classificationCanvas) {
        new Chart(classificationCanvas, {
            type: 'doughnut',
            data: {
                labels: ['Normal patterns', 'Unusual patterns'],
                datasets: [{
                    data: [
                        classificationData.normal,
                        classificationData.unusual
                    ],
                    backgroundColor: ['#198754', '#ffc107'],
                    borderColor: ['#ffffff', '#ffffff'],
                    borderWidth: 2,
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '62%',
                plugins: {
                    legend: commonLegend,
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const value = context.parsed || 0;
                                const total = context.dataset.data.reduce(
                                    (sum, number) => sum + number, 0
                                );
                                const percentage = total
                                    ? ((value / total) * 100).toFixed(2)
                                    : '0.00';

                                return context.label + ': ' +
                                    value.toLocaleString() + ' (' +
                                    percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    }

    // 3. Irradiance versus DC power.
    const relationshipCanvas =
        document.getElementById('irradianceChart');

    if (relationshipCanvas) {
        const normalPoints = [];
        const unusualPoints = [];

        relationshipData.irradiance.forEach(function (irradiance, index) {
            const point = {
                x: irradiance,
                y: relationshipData.dcPower[index]
            };

            if (relationshipData.unusual[index]) {
                unusualPoints.push(point);
            } else {
                normalPoints.push(point);
            }
        });

        new Chart(relationshipCanvas, {
            type: 'scatter',
            data: {
                datasets: [
                    {
                        label: 'Normal pattern',
                        data: normalPoints,
                        backgroundColor: 'rgba(25, 135, 84, 0.65)',
                        borderColor: '#198754',
                        pointRadius: 3,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'Unusual pattern',
                        data: unusualPoints,
                        backgroundColor: 'rgba(255, 193, 7, 0.85)',
                        borderColor: '#b58100',
                        pointRadius: 4,
                        pointHoverRadius: 7
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: commonLegend,
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.dataset.label +
                                    ' — Irradiance: ' +
                                    Number(context.parsed.x).toLocaleString(
                                        undefined,
                                        { maximumFractionDigits: 2 }
                                    ) +
                                    ', DC power: ' +
                                    Number(context.parsed.y).toLocaleString(
                                        undefined,
                                        { maximumFractionDigits: 2 }
                                    );
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Recorded irradiance (source units)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Recorded DC power (source units)'
                        }
                    }
                }
            }
        });
    }
});
</script>
@endpush