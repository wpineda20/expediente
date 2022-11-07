<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\KinshipController;
use App\Http\Controllers\AcademicLevelController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SubdirectionController;
use App\Http\Controllers\FamilyStatusController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ExcelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes(['verify' => true, 'remember_me' => false]);

Route::group(['middleware' => ['auth', 'verified', 'log', 'throttle:web']], function () {
    Route::group(['middleware' => ['has.role:Administrador']], function () {
        // Apis
        Route::resource('/api/web/department', DepartmentController::class);
        Route::resource('/api/web/municipality', MunicipalityController::class);
        Route::resource('/api/web/user', UserController::class);
        Route::resource('/api/web/role', RoleController::class);
        Route::resource('/api/web/direction', DirectionController::class);
        Route::delete('/api/web/direction', [DirectionController::class, 'destroy']);
        Route::resource('/api/web/kinship', KinshipController::class);
        Route::delete('/api/web/kinship', [KinshipController::class, 'destroy']);
        Route::resource('/api/web/academicLevel', AcademicLevelController::class);
        Route::delete('/api/web/academicLevel', [AcademicLevelController::class, 'destroy']);
        Route::resource('/api/web/profession', ProfessionController::class);
        Route::delete('/api/web/profession', [ProfessionController::class, 'destroy']);
        Route::resource('/api/web/unit', UnitController::class);
        Route::delete('/api/web/unit', [UnitController::class, 'destroy']);
        Route::resource('/api/web/subdirection', SubdirectionController::class);
        Route::delete('/api/web/subdirection', [SubdirectionController::class, 'destroy']);
        Route::resource('/api/web/familyStatus', FamilyStatusController::class);
        Route::delete('/api/web/familyStatus', [FamilyStatusController::class, 'destroy']);

        // Views
        Route::get('/departments', function () {
            return view('department.index');
        });

        Route::get('/municipalities', function () {
            return view('municipality.index');
        });

        Route::get('/users', function () {
            return view('user.index');
        });

        Route::get('/directions', function () {
            return view('direction.index');
        });

        Route::get('/kinships', function () {
            return view('kinship.index');
        });

        Route::get('/academicLevels', function () {
            return view('academic_level.index');
        });

        Route::get('/professions', function () {
            return view('profession.index');
        });

        Route::get('/units', function () {
            return view('unit.index');
        });

        Route::get('/subdirections', function () {
            return view('subdirection.index');
        });

        Route::get('/familyStatus', function () {
            return view('family_status.index');
        });

    });

    //Record View
    Route::get('/record', function () {
        return view('form.employee');
    });

    //Employee
    Route::post('api/employee', [EmployeeController::class, 'store']);
    Route::get('api/employee', [EmployeeController::class, 'index']);

    //Reports
    Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

    //Excel
    Route::get('export', [ExcelController::class, 'export']);

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Auth::routes(['verify' => true, 'login' => true, 'reset' => true, 'register' => true]);

//Api's for selects data
Route::get('api/familyStatus', [FamilyStatusController::class, 'index']);
Route::get('api/departments', [DepartmentController::class, 'index']);
Route::get('api/municipality', [MunicipalityController::class, 'index']);
Route::get('api/professions', [ProfessionController::class, 'index']);
Route::get('api/directions', [DirectionController::class, 'index']);
Route::get('api/subdirections', [SubdirectionController::class, 'index']);
Route::get('api/units', [UnitController::class, 'index']);
Route::get('api/kinships', [KinshipController::class, 'index']);
Route::get('api/academicLevels', [AcademicLevelController::class, 'index']);
Route::get('api/municipality/byDepartmentName/{department}', [MunicipalityController::class, 'byDepartmentName']);

Route::post('import', [ExcelController::class, 'import']);
