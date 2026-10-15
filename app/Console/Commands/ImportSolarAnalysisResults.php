<?php

namespace App\Console\Commands;

use App\Models\SolarAnalysisResult;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Throwable;

class ImportSolarAnalysisResults extends Command
{
    protected $signature = 'solar:import-analysis
                            {--file= : Full path to the daylight analysis CSV}';

    protected $description = 'Import solar performance analysis results from a CSV file';

    public function handle(): int
    {
        $filePath = $this->option('file')
            ?: 'C:/solar-ml/results/daylight_analysis.csv';

        if (!File::exists($filePath)) {
            $this->error("CSV file not found: {$filePath}");

            return self::FAILURE;
        }

        $file = fopen($filePath, 'r');

        if ($file === false) {
            $this->error('Unable to open the CSV file.');

            return self::FAILURE;
        }

        $imported = 0;
        $skipped = 0;
        $batch = [];
        $sourceFile = basename($filePath);

        try {
            $headers = fgetcsv($file);

            if ($headers === false) {
                $this->error('The CSV file is empty.');

                return self::FAILURE;
            }

            // Remove a possible UTF-8 BOM from the first header.
            $headers[0] = preg_replace(
                '/^\xEF\xBB\xBF/',
                '',
                (string) $headers[0]
            );

            $headers = array_map(
                fn ($header) => trim((string) $header),
                $headers
            );

            $requiredHeaders = [
                'measured_on',
                'system_id',
                'model_prediction',
                'anomaly_score',
                'model_status',
                'poa_irradiance__421',
                'dc_power__422',
                'ac_power__423',
                'dc_pos_voltage__424',
                'dc_pos_current__425',
            ];

            $missingHeaders = array_diff($requiredHeaders, $headers);

            if (!empty($missingHeaders)) {
                $this->error(
                    'Missing CSV columns: '
                    . implode(', ', $missingHeaders)
                );

                return self::FAILURE;
            }

            $headerIndexes = array_flip($headers);

            DB::transaction(function () use (
                $file,
                $headerIndexes,
                $sourceFile,
                &$imported,
                &$skipped,
                &$batch
            ) {
                while (($row = fgetcsv($file)) !== false) {
                    if (count($row) !== count($headerIndexes)) {
                        $skipped++;
                        continue;
                    }

                    $get = fn (string $column) =>
                        $row[$headerIndexes[$column]] ?? null;

                    $observedAt = trim(
                        (string) $get('measured_on')
                    );

                    $prediction = trim(
                        (string) $get('model_prediction')
                    );

                    $systemId = $get('system_id');

                    if (
                        $observedAt === ''
                        || !is_numeric($prediction)
                        || !in_array((int) $prediction, [-1, 1], true)
                        || !is_numeric($systemId)
                    ) {
                        $skipped++;
                        continue;
                    }

                    try {
                        $date = Carbon::createFromFormat(
                            '!Y-m-d H:i:s',
                            $observedAt
                        );

                        if (
                            $date === false
                            || $date->format('Y-m-d H:i:s') !== $observedAt
                        ) {
                            $skipped++;
                            continue;
                        }
                    } catch (Throwable $exception) {
                        $skipped++;
                        continue;
                    }

                    $number = function (string $column) use ($get): ?float {
                        $value = $get($column);

                        if (
                            $value === null
                            || trim((string) $value) === ''
                            || !is_numeric($value)
                        ) {
                            return null;
                        }

                        return (float) $value;
                    };

                    $batch[] = [
                        'source' => 'PVDAQ',
                        'system_id' => (int) $systemId,
                        'observed_at' => $date->format('Y-m-d H:i:s'),
                        'is_anomaly' => (int) $prediction === -1,
                        'anomaly_score' => $number('anomaly_score'),
                        'model_status' => $get('model_status'),
                        'irradiance' => $number('poa_irradiance__421'),
                        'dc_power' => $number('dc_power__422'),
                        'ac_power' => $number('ac_power__423'),
                        'dc_voltage' => $number('dc_pos_voltage__424'),
                        'dc_current' => $number('dc_pos_current__425'),
                        'source_file' => $sourceFile,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    if (count($batch) >= 250) {
                        $this->saveBatch($batch);
                        $imported += count($batch);
                        $batch = [];
                    }
                }

                if (!empty($batch)) {
                    $this->saveBatch($batch);
                    $imported += count($batch);
                }
            });
        } catch (Throwable $exception) {
            $this->error(
                'Import failed. Database changes were rolled back.'
            );

            $this->line($exception->getMessage());

            return self::FAILURE;
        } finally {
            fclose($file);
        }

        $this->info("Import completed. Records processed: {$imported}");
        $this->info("Rows skipped: {$skipped}");

        $this->comment(
            'Model classifications identify unusual patterns, not confirmed equipment faults.'
        );

        return self::SUCCESS;
    }

    private function saveBatch(array $batch): void
    {
        SolarAnalysisResult::upsert(
            $batch,
            [
                'source',
                'system_id',
                'observed_at',
                'source_file',
            ],
            [
                'is_anomaly',
                'anomaly_score',
                'model_status',
                'irradiance',
                'dc_power',
                'ac_power',
                'dc_voltage',
                'dc_current',
                'updated_at',
            ]
        );
    }
}