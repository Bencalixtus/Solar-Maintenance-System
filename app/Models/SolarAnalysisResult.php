<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolarAnalysisResult extends Model
{
    use HasFactory;

    protected $table = 'solar_analysis_results';

    protected $fillable = [
        'source',
        'system_id',
        'observed_at',
        'is_anomaly',
        'anomaly_score',
        'model_status',
        'irradiance',
        'dc_power',
        'ac_power',
        'dc_voltage',
        'dc_current',
        'source_file',
    ];

    protected function casts(): array
    {
        return [
            'observed_at' => 'datetime',
            'is_anomaly' => 'boolean',
            'anomaly_score' => 'float',
            'irradiance' => 'float',
            'dc_power' => 'float',
            'ac_power' => 'float',
            'dc_voltage' => 'float',
            'dc_current' => 'float',
        ];
    }
}
