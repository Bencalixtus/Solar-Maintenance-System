@extends('layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Solar Observation Details</h1>
            <p class="text-muted mb-0">
                Individual observation from the external PVDAQ System 10 research dataset.
            </p>
        </div>

        <a href="{{ route('solar-analysis.index') }}"
           class="btn btn-outline-secondary mt-2 mt-md-0">
            <i class="bi bi-arrow-left me-1"></i>
            Back to Solar Analysis
        </a>
    </div>

    {{-- Research Disclaimer --}}
    <div class="alert alert-info" role="alert">
        <strong><i class="bi bi-info-circle me-1"></i> Research note:</strong>
        This observation comes from an external research dataset. An unusual
        model classification indicates a pattern that may need investigation;
        it does not confirm an equipment fault.
    </div>

    {{-- Observation Summary --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h2 class="h5 mb-0">Observation Summary</h2>
        </div>

        <div class="card-body">
            <div class="row g-4">

                <div class="col-md-6 col-lg-3">
                    <div class="text-muted small mb-1">Observation ID</div>
                    <div class="fw-semibold">
                        {{ $observation->id }}
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="text-muted small mb-1">Source</div>
                    <div class="fw-semibold">
                        {{ $observation->source }}
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="text-muted small mb-1">System ID</div>
                    <div class="fw-semibold">
                        {{ $observation->system_id }}
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="text-muted small mb-1">Observed At</div>
                    <div class="fw-semibold">
                        {{ $observation->observed_at
                            ? \Illuminate\Support\Carbon::parse($observation->observed_at)->format('d M Y, h:i:s A')
                            : 'Not available' }}
                    </div>
                </div>

                <div class="col-md-6 col-lg-6">
                    <div class="text-muted small mb-1">Model Classification</div>

                    @if($observation->is_anomaly)
                        <span class="badge bg-warning text-dark fs-6">
                            Unusual Pattern — Inspect
                        </span>
                    @else
                        <span class="badge bg-success fs-6">
                            Normal Pattern
                        </span>
                    @endif
                </div>

                <div class="col-md-6 col-lg-6">
                    <div class="text-muted small mb-1">Model Status</div>
                    <div class="fw-semibold">
                        {{ $observation->model_status ?: 'Not available' }}
                    </div>
                </div>

                <div class="col-md-6 col-lg-6">
                    <div class="text-muted small mb-1">Anomaly Score</div>
                    <div class="fw-semibold">
                        {{ $observation->anomaly_score !== null
                            ? number_format((float) $observation->anomaly_score, 4)
                            : 'Not available' }}
                    </div>
                </div>

                <div class="col-md-6 col-lg-6">
                    <div class="text-muted small mb-1">Source File</div>
                    <div class="fw-semibold text-break">
                        {{ $observation->source_file ?: 'Not available' }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Electrical and Solar Measurements --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h2 class="h5 mb-0">Recorded Performance Measurements</h2>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Measurement</th>
                            <th>Recorded Value</th>
                            <th>Unit</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Irradiance</td>
                            <td>
                                {{ $observation->irradiance !== null
                                    ? number_format((float) $observation->irradiance, 3)
                                    : 'Not available' }}
                            </td>
                            <td>Source unit</td>
                        </tr>

                        <tr>
                            <td>DC Power</td>
                            <td>
                                {{ $observation->dc_power !== null
                                    ? number_format((float) $observation->dc_power, 3)
                                    : 'Not available' }}
                            </td>
                            <td>Source unit</td>
                        </tr>

                        <tr>
                            <td>AC Power</td>
                            <td>
                                {{ $observation->ac_power !== null
                                    ? number_format((float) $observation->ac_power, 3)
                                    : 'Not available' }}
                            </td>
                            <td>Source unit</td>
                        </tr>

                        <tr>
                            <td>DC Voltage</td>
                            <td>
                                {{ $observation->dc_voltage !== null
                                    ? number_format((float) $observation->dc_voltage, 3)
                                    : 'Not available' }}
                            </td>
                            <td>Source unit</td>
                        </tr>

                        <tr>
                            <td>DC Current</td>
                            <td>
                                {{ $observation->dc_current !== null
                                    ? number_format((float) $observation->dc_current, 3)
                                    : 'Not available' }}
                            </td>
                            <td>Source unit</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p class="text-muted small mt-3 mb-0">
                Units are shown as source units until the original dataset's
                measurement definitions have been verified.
            </p>
        </div>
    </div>

    {{-- Interpretation --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="h5 mb-0">Interpretation and Recommended Action</h2>
        </div>

        <div class="card-body">
            @if($observation->is_anomaly)
                <p>
                    The analysis model classified this observation as an
                    <strong>unusual pattern</strong>.
                </p>

                <ul class="mb-0">
                    <li>Review the recorded measurements and observation time.</li>
                    <li>Compare the observation with other readings under similar conditions.</li>
                    <li>Investigate further before drawing conclusions about equipment condition.</li>
                </ul>
            @else
                <p class="mb-0">
                    The analysis model classified this observation as following
                    the expected pattern learned by the model. This classification
                    alone does not guarantee that the equipment is fault-free.
                </p>
            @endif
        </div>
    </div>

</div>
@endsection