<?php

namespace App\Http\Controllers;

use App\Models\SolarAnalysisResult;
use Illuminate\Http\Request;

class SolarAnalysisController extends Controller
{
    public function index(Request $request)
    {
        $query = SolarAnalysisResult::query()
            ->where('source', 'PVDAQ')
            ->where('system_id', 10);

        // Filter by observation type when requested.
        if ($request->filled('type')) {
            if ($request->type === 'anomaly') {
                $query->where('is_anomaly', true);
            } elseif ($request->type === 'normal') {
                $query->where('is_anomaly', false);
            }
        }

        // Filter by date when a valid date is provided.
        if ($request->filled('from')) {
            $request->validate([
                'from' => ['nullable', 'date'],
            ]);

            $query->whereDate('observed_at', '>=', $request->input('from'));
        }

        if ($request->filled('to')) {
            $request->validate([
                'to' => ['nullable', 'date', 'after_or_equal:from'],
            ]);

            $query->whereDate('observed_at', '<=', $request->input('to'));
        }

        $results = (clone $query)
            ->orderByDesc('observed_at')
            ->paginate(20)
            ->withQueryString();

        $summary = [
            'total' => SolarAnalysisResult::where('source', 'PVDAQ')
                ->where('system_id', 10)
                ->count(),

            'anomalies' => SolarAnalysisResult::where('source', 'PVDAQ')
                ->where('system_id', 10)
                ->where('is_anomaly', true)
                ->count(),

            'normal' => SolarAnalysisResult::where('source', 'PVDAQ')
                ->where('system_id', 10)
                ->where('is_anomaly', false)
                ->count(),

            'latest' => SolarAnalysisResult::where('source', 'PVDAQ')
                ->where('system_id', 10)
                ->max('observed_at'),
        ];

        return view('solar-analysis.index', compact(
            'results',
            'summary'
        ));
    }
}
