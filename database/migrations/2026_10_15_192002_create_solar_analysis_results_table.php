
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solar_analysis_results', function (Blueprint $table) {
            $table->id();

            // Research dataset identification
            $table->string('source')->default('PVDAQ');
            $table->unsignedInteger('system_id')->nullable();

            // Observation details
            $table->dateTime('observed_at')->index();
            $table->boolean('is_anomaly')->default(false);
            $table->decimal('anomaly_score', 12, 8)->nullable();
            $table->string('model_status')->nullable();

            // Solar readings from the dataset
            $table->decimal('irradiance', 12, 3)->nullable();
            $table->decimal('dc_power', 12, 3)->nullable();
            $table->decimal('ac_power', 12, 3)->nullable();
            $table->decimal('dc_voltage', 12, 3)->nullable();
            $table->decimal('dc_current', 12, 3)->nullable();

            // Preserve the original CSV filename for traceability
            $table->string('source_file')->nullable();

            $table->timestamps();

            $table->index(['source', 'system_id']);
            $table->index(['is_anomaly', 'observed_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solar_analysis_results');
    }
};
