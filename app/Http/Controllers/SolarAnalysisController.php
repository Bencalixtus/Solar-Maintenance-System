<?php

namespace App\Http\Controllers;

use App\Models\SolarAnalysisResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolarAnalysisController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'type' => ['nullable', 'in:anomaly,normal'],
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
        ]);

        // Base query for the external PVDAQ research dataset.
        $baseQuery = SolarAnalysisResult::query()
            ->where('source', 'PVDAQ')
            ->where('system_id', 10);

        // Apply the selected observation type.
        $applyTypeFilter = function ($query) use ($request) {
            if ($request->type === 'anomaly') {
                $query->where('is_anomaly', true);
            } elseif ($request->type === 'normal') {
                $query->where('is_anomaly', false);
            }

            return $query;
        };

        // Apply the selected date range.
        $applyDateFilters = function ($query) use ($request) {
            if ($request->filled('from')) {
                $query->whereDate(
                    'observed_at',
                    '>=',
                    $request->input('from')
                );
            }

            if ($request->filled('to')) {
                $query->whereDate(
                    'observed_at',
                    '<=',
                    $request->input('to')
                );
            }

            return $query;
        };

        // Existing observation table and pagination.
        $resultsQuery = clone $baseQuery;
        $applyTypeFilter($resultsQuery);
        $applyDateFilters($resultsQuery);

        $results = $resultsQuery
            ->orderByDesc('observed_at')
            ->paginate(20)
            ->withQueryString();

        // Overall dataset summary remains independent of table filters.
        $summary = [
            'total' => (clone $baseQuery)->count(),

            'anomalies' => (clone $baseQuery)
                ->where('is_anomaly', true)
                ->count(),

            'normal' => (clone $baseQuery)
                ->where('is_anomaly', false)
                ->count(),

            'latest' => (clone $baseQuery)->max('observed_at'),
        ];

        // Chart data respects the selected type and date filters.
        $chartQuery = SolarAnalysisResult::query()
            ->where('source', 'PVDAQ')
            ->where('system_id', 10);

        $applyTypeFilter($chartQuery);
        $applyDateFilters($chartQuery);

        // Daily average power readings.
        $dailyPower = (clone $chartQuery)
            ->selectRaw('DATE(observed_at) as observation_date')
            ->selectRaw('AVG(dc_power) as average_dc_power')
            ->selectRaw('AVG(ac_power) as average_ac_power')
            ->where(function ($query) {
                $query->whereNotNull('dc_power')
                    ->orWhereNotNull('ac_power');
            })
            ->groupByRaw('DATE(observed_at)')
            ->orderBy('observation_date')
            ->get();

        $powerChart = [
            'labels' => $dailyPower->pluck('observation_date')->values(),
            'dcPower' => $dailyPower->map(
                fn ($row) => $row->average_dc_power !== null
                    ? round((float) $row->average_dc_power, 2)
                    : null
            )->values(),
            'acPower' => $dailyPower->map(
                fn ($row) => $row->average_ac_power !== null
                    ? round((float) $row->average_ac_power, 2)
                    : null
            )->values(),
        ];

        // Classification counts within the selected filters.
        $classificationCounts = (clone $chartQuery)
            ->select('is_anomaly')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('is_anomaly')
            ->pluck('total', 'is_anomaly');

        $classificationChart = [
            'normal' => (int) ($classificationCounts[0] ?? 0),
            'unusual' => (int) ($classificationCounts[1] ?? 0),
        ];

        // Sample at most 500 records for the irradiance relationship chart.
        // This keeps the browser payload manageable.
        $relationshipRows = (clone $chartQuery)
            ->whereNotNull('irradiance')
            ->whereNotNull('dc_power')
            ->orderBy('observed_at')
            ->select([
                'observed_at',
                'irradiance',
                'dc_power',
                'is_anomaly',
            ])
            ->limit(500)
            ->get();

        $relationshipChart = [
            'irradiance' => $relationshipRows->pluck('irradiance')
                ->map(fn ($value) => (float) $value)
                ->values(),

            'dcPower' => $relationshipRows->pluck('dc_power')
                ->map(fn ($value) => (float) $value)
                ->values(),

            'unusual' => $relationshipRows->pluck('is_anomaly')
                ->map(fn ($value) => (bool) $value)
                ->values(),
        ];

        return view('solar-analysis.index', compact(
            'results',
            'summary',
            'powerChart',
            'classificationChart',
            'relationshipChart'
        ));
    }
}