
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solar_analysis_results', function (Blueprint $table) {
            $table->unique(
                ['source', 'system_id', 'observed_at', 'source_file'],
                'solar_analysis_results_unique_observation'
            );
        });
    }

    public function down(): void
    {
        Schema::table('solar_analysis_results', function (Blueprint $table) {
            $table->dropUnique(
                'solar_analysis_results_unique_observation'
            );
        });
    }
};
