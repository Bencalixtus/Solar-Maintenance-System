<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstallationController;
use App\Http\Controllers\ComponentTypeController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\MaintenanceScheduleController;
use App\Http\Controllers\MaintenanceRecordController;
use App\Http\Controllers\CostRecordController;
use App\Http\Controllers\ReplacementForecastController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Authenticated Application Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Installation Management
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:Admin')->group(function () {

        Route::get(
            '/installations/create',
            [InstallationController::class, 'create']
        )->name('installations.create');

        Route::post(
            '/installations',
            [InstallationController::class, 'store']
        )->name('installations.store');
    });


    Route::middleware('role:Admin,Technician,Supervisor')->group(function () {

        Route::get(
            '/installations',
            [InstallationController::class, 'index']
        )->name('installations.index');

        Route::get(
            '/installations/{installation}',
            [InstallationController::class, 'show']
        )->name('installations.show');
    });


    Route::middleware('role:Admin')->group(function () {

        Route::get(
            '/installations/{installation}/edit',
            [InstallationController::class, 'edit']
        )->name('installations.edit');

        Route::put(
            '/installations/{installation}',
            [InstallationController::class, 'update']
        )->name('installations.update');

        Route::patch(
            '/installations/{installation}',
            [InstallationController::class, 'update']
        );

        Route::delete(
            '/installations/{installation}',
            [InstallationController::class, 'destroy']
        )->name('installations.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | Component Types
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:Admin,Technician')->group(function () {

        Route::get(
            '/component-types/create',
            [ComponentTypeController::class, 'create']
        )->name('component-types.create');

        Route::post(
            '/component-types',
            [ComponentTypeController::class, 'store']
        )->name('component-types.store');
    });


    Route::middleware('role:Admin,Technician,Supervisor')->group(function () {

        Route::get(
            '/component-types',
            [ComponentTypeController::class, 'index']
        )->name('component-types.index');

        Route::get(
            '/component-types/{componentType}',
            [ComponentTypeController::class, 'show']
        )->name('component-types.show');
    });


    Route::middleware('role:Admin,Technician')->group(function () {

        Route::get(
            '/component-types/{componentType}/edit',
            [ComponentTypeController::class, 'edit']
        )->name('component-types.edit');

        Route::put(
            '/component-types/{componentType}',
            [ComponentTypeController::class, 'update']
        )->name('component-types.update');

        Route::patch(
            '/component-types/{componentType}',
            [ComponentTypeController::class, 'update']
        );
    });


    Route::middleware('role:Admin')->group(function () {

        Route::delete(
            '/component-types/{componentType}',
            [ComponentTypeController::class, 'destroy']
        )->name('component-types.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | Components
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:Admin,Technician')->group(function () {

        Route::get(
            '/components/create',
            [ComponentController::class, 'create']
        )->name('components.create');

        Route::post(
            '/components',
            [ComponentController::class, 'store']
        )->name('components.store');
    });


    Route::middleware('role:Admin,Technician,Supervisor')->group(function () {

        Route::get(
            '/components',
            [ComponentController::class, 'index']
        )->name('components.index');

        Route::get(
            '/components/{component}',
            [ComponentController::class, 'show']
        )->name('components.show');
    });


    Route::middleware('role:Admin,Technician')->group(function () {

        Route::get(
            '/components/{component}/edit',
            [ComponentController::class, 'edit']
        )->name('components.edit');

        Route::put(
            '/components/{component}',
            [ComponentController::class, 'update']
        )->name('components.update');

        Route::patch(
            '/components/{component}',
            [ComponentController::class, 'update']
        );
    });


    Route::middleware('role:Admin')->group(function () {

        Route::delete(
            '/components/{component}',
            [ComponentController::class, 'destroy']
        )->name('components.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | Inspections
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:Admin,Technician')->group(function () {

        Route::get(
            '/inspections/create',
            [InspectionController::class, 'create']
        )->name('inspections.create');

        Route::post(
            '/inspections',
            [InspectionController::class, 'store']
        )->name('inspections.store');
    });


    Route::middleware('role:Admin,Technician,Supervisor')->group(function () {

        Route::get(
            '/inspections',
            [InspectionController::class, 'index']
        )->name('inspections.index');

        Route::get(
            '/inspections/{inspection}',
            [InspectionController::class, 'show']
        )->name('inspections.show');

        Route::get(
            '/inspections/{inspection}/print',
            [InspectionController::class, 'print']
        )->name('inspections.print');
    });


    Route::middleware('role:Admin,Technician')->group(function () {

        Route::get(
            '/inspections/{inspection}/edit',
            [InspectionController::class, 'edit']
        )->name('inspections.edit');

        Route::put(
            '/inspections/{inspection}',
            [InspectionController::class, 'update']
        )->name('inspections.update');

        Route::patch(
            '/inspections/{inspection}',
            [InspectionController::class, 'update']
        );
    });


    Route::middleware('role:Admin,Technician')->group(function () {

        Route::delete(
            '/inspections/{inspection}',
            [InspectionController::class, 'destroy']
        )->name('inspections.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | Measurements
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:Admin,Technician')->group(function () {

        Route::get(
            '/measurements/create',
            [MeasurementController::class, 'create']
        )->name('measurements.create');

        Route::post(
            '/measurements',
            [MeasurementController::class, 'store']
        )->name('measurements.store');
    });


    Route::middleware('role:Admin,Technician,Supervisor')->group(function () {

        Route::get(
            '/measurements',
            [MeasurementController::class, 'index']
        )->name('measurements.index');

        Route::get(
            '/measurements/{measurement}',
            [MeasurementController::class, 'show']
        )->name('measurements.show');
    });


    Route::middleware('role:Admin,Technician')->group(function () {

        Route::get(
            '/measurements/{measurement}/edit',
            [MeasurementController::class, 'edit']
        )->name('measurements.edit');

        Route::put(
            '/measurements/{measurement}',
            [MeasurementController::class, 'update']
        )->name('measurements.update');

        Route::patch(
            '/measurements/{measurement}',
            [MeasurementController::class, 'update']
        );
    });


    Route::middleware('role:Admin,Technician')->group(function () {

        Route::delete(
            '/measurements/{measurement}',
            [MeasurementController::class, 'destroy']
        )->name('measurements.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | Maintenance Schedules
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:Admin,Technician')->group(function () {

        Route::get(
            '/maintenance-schedules/create',
            [MaintenanceScheduleController::class, 'create']
        )->name('maintenance-schedules.create');

        Route::post(
            '/maintenance-schedules',
            [MaintenanceScheduleController::class, 'store']
        )->name('maintenance-schedules.store');
    });


    Route::middleware('role:Admin,Technician,Supervisor')->group(function () {

        Route::get(
            '/maintenance-schedules',
            [MaintenanceScheduleController::class, 'index']
        )->name('maintenance-schedules.index');

        Route::get(
            '/maintenance-schedules/{maintenanceSchedule}',
            [MaintenanceScheduleController::class, 'show']
        )->name('maintenance-schedules.show');
    });


    Route::middleware('role:Admin,Technician')->group(function () {

        Route::get(
            '/maintenance-schedules/{maintenanceSchedule}/edit',
            [MaintenanceScheduleController::class, 'edit']
        )->name('maintenance-schedules.edit');

        Route::put(
            '/maintenance-schedules/{maintenanceSchedule}',
            [MaintenanceScheduleController::class, 'update']
        )->name('maintenance-schedules.update');

        Route::patch(
            '/maintenance-schedules/{maintenanceSchedule}',
            [MaintenanceScheduleController::class, 'update']
        );
    });


    Route::middleware('role:Admin,Technician')->group(function () {

        Route::delete(
            '/maintenance-schedules/{maintenanceSchedule}',
            [MaintenanceScheduleController::class, 'destroy']
        )->name('maintenance-schedules.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | Maintenance Records
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:Admin,Technician')->group(function () {

        Route::get(
            '/maintenance-records/create',
            [MaintenanceRecordController::class, 'create']
        )->name('maintenance-records.create');

        Route::post(
            '/maintenance-records',
            [MaintenanceRecordController::class, 'store']
        )->name('maintenance-records.store');
    });


    Route::middleware('role:Admin,Technician,Supervisor')->group(function () {

        Route::get(
            '/maintenance-records',
            [MaintenanceRecordController::class, 'index']
        )->name('maintenance-records.index');

        Route::get(
            '/maintenance-records/{maintenanceRecord}',
            [MaintenanceRecordController::class, 'show']
        )->name('maintenance-records.show');
    });


    Route::middleware('role:Admin,Technician')->group(function () {

        Route::get(
            '/maintenance-records/{maintenanceRecord}/edit',
            [MaintenanceRecordController::class, 'edit']
        )->name('maintenance-records.edit');

        Route::put(
            '/maintenance-records/{maintenanceRecord}',
            [MaintenanceRecordController::class, 'update']
        )->name('maintenance-records.update');

        Route::patch(
            '/maintenance-records/{maintenanceRecord}',
            [MaintenanceRecordController::class, 'update']
        );
    });


    Route::middleware('role:Admin,Technician')->group(function () {

        Route::delete(
            '/maintenance-records/{maintenanceRecord}',
            [MaintenanceRecordController::class, 'destroy']
        )->name('maintenance-records.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | Degradation Analysis
    |--------------------------------------------------------------------------
    */

   Route::get('/degradation', [DashboardController::class, 'degradation'])
    ->middleware('role:Admin,Technician,Supervisor')
    ->name('degradation.index');

    /*
    |--------------------------------------------------------------------------
    | Cost Management
    |--------------------------------------------------------------------------
    | Admin:
    |   View, Add, Edit, Delete
    |
    | Technician:
    |   No access
    |
    | Supervisor:
    |   View, Add, Edit
    |--------------------------------------------------------------------------
    */

    // Admin and Supervisor: create cost record
    Route::middleware('role:Admin,Supervisor')->group(function () {

        Route::get(
            '/cost-records/create',
            [CostRecordController::class, 'create']
        )->name('cost-records.create');

        Route::post(
            '/cost-records',
            [CostRecordController::class, 'store']
        )->name('cost-records.store');
    });


    // Admin and Supervisor: view cost records
    Route::middleware('role:Admin,Supervisor')->group(function () {

        Route::get(
            '/cost-records',
            [CostRecordController::class, 'index']
        )->name('cost-records.index');

        Route::get(
            '/cost-records/{costRecord}',
            [CostRecordController::class, 'show']
        )->name('cost-records.show');
    });


    // Admin and Supervisor: edit cost record
    Route::middleware('role:Admin,Supervisor')->group(function () {

        Route::get(
            '/cost-records/{costRecord}/edit',
            [CostRecordController::class, 'edit']
        )->name('cost-records.edit');

        Route::put(
            '/cost-records/{costRecord}',
            [CostRecordController::class, 'update']
        )->name('cost-records.update');

        Route::patch(
            '/cost-records/{costRecord}',
            [CostRecordController::class, 'update']
        );
    });


    // Admin only: delete cost record
    Route::middleware('role:Admin')->group(function () {

        Route::delete(
            '/cost-records/{costRecord}',
            [CostRecordController::class, 'destroy']
        )->name('cost-records.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | Replacement Forecast
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/replacement-forecasts',
        [ReplacementForecastController::class, 'index']
    )->name('replacement-forecasts.index');

   // ==========================================================
// REPLACEMENT FORECASTS
// ==========================================================

// View forecasts - Admin, Technician, Supervisor
Route::middleware('role:Admin,Technician,Supervisor')->group(function () {

    Route::get('/replacement-forecasts', [ReplacementForecastController::class, 'index'])
        ->name('replacement-forecasts.index');

    Route::get('/replacement-forecasts/{replacementForecast}', [ReplacementForecastController::class, 'show'])
        ->name('replacement-forecasts.show');
});

// Generate and refresh forecasts - Admin, Supervisor
Route::middleware('role:Admin,Supervisor')->group(function () {

    Route::get('/replacement-forecasts/generate/{component}', [ReplacementForecastController::class, 'generate'])
        ->name('replacement-forecasts.generate');

    Route::post('/replacement-forecasts/refresh/{component}', [ReplacementForecastController::class, 'refresh'])
        ->name('replacement-forecasts.refresh');
});

// Delete forecasts - Admin only
Route::middleware('role:Admin')->group(function () {

    Route::delete('/replacement-forecasts/{replacementForecast}', [ReplacementForecastController::class, 'destroy'])
        ->name('replacement-forecasts.destroy');
}); Route::get(
        '/replacement-forecasts/generate/{component}',
        [ReplacementForecastController::class, 'generate']
    )->name('replacement-forecasts.generate');

    Route::post(
        '/replacement-forecasts/refresh/{component}',
        [ReplacementForecastController::class, 'refresh']
    )->name('replacement-forecasts.refresh');

    Route::get(
        '/replacement-forecasts/{replacementForecast}',
        [ReplacementForecastController::class, 'show']
    )->name('replacement-forecasts.show');

    Route::delete(
        '/replacement-forecasts/{replacementForecast}',
        [ReplacementForecastController::class, 'destroy']
    )->name('replacement-forecasts.destroy');


    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */

    // ==========================================================
// REPORTS
// ==========================================================

Route::middleware('role:Admin,Technician,Supervisor')->group(function () {

    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');

    Route::get('/reports/print', [ReportController::class, 'print'])
        ->name('reports.print');
});

    /*
    |--------------------------------------------------------------------------
    | User Management
    |--------------------------------------------------------------------------
    | Admin only
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:Admin')->group(function () {

        Route::resource(
            'users',
            UserController::class
        );
    });


    /*
    |--------------------------------------------------------------------------
    | User Profile
    |--------------------------------------------------------------------------
    */

    Route::view(
        '/profile',
        'profile'
    )->name('profile');

    Route::view(
        '/profile/edit',
        'profile'
    )->name('profile.edit');

});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';