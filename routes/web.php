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
// use App\Http\Controllers\UnitController;
use App\Http\Controllers\SubdirectionController;
use App\Http\Controllers\FamilyStatusController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeStatusController;
use App\Http\Controllers\DependenceController;
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
    //Administrador
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
        // Route::resource('/api/web/unit', UnitController::class);
        // Route::delete('/api/web/unit', [UnitController::class, 'destroy']);
        Route::resource('/api/web/familyStatus', FamilyStatusController::class);
        Route::delete('/api/web/familyStatus', [FamilyStatusController::class, 'destroy']);
        Route::resource('/api/web/employeeStatus', EmployeeStatusController::class);
        Route::delete('/api/web/employeeStatus', [EmployeeStatusController::class, 'destroy']);
        Route::resource('/api/web/dependence', DependenceController::class);
        Route::delete('/api/web/dependence', [DependenceController::class, 'destroy']);



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

        // Route::get('/units', function () {
        //     return view('unit.index');
        // });

        Route::get('/dependencies', function () {
            return view('dependence.index');
        });

        Route::get('/familyStatus', function () {
            return view('family_status.index');
        });

        Route::get('/employeeStatus', function () {
            return view('employee_status.index');
        });



    });

    //Administrador & Editor
    Route::group(['middleware' => ['has.role:Administrador,Editor']], function () {

        //Registered Records View
        Route::get('/registeredRecords', function () {
            return view('registered_records.index');
        });

        //All Records
        Route::get('api/employee/registeredRecords', [EmployeeController::class, 'getRegisteredRecords']);
        //Registered Record By Id
        Route::get('api/registeredRecordById', [EmployeeController::class, 'registeredRecordById']);
        //Search Registered Records
        Route::post('api/employee/registeredRecords/search', [EmployeeController::class, 'searchRegisteredRecords']);
    });


    //Record View
    Route::get('/record', function () {
        return view('form.employee');
    });

    //My Record View
     Route::get('/myRecord', function () {
        return view('my_record.index');
    });

    //My Record View Verify Status
    Route::get('/api/verifyStatus', [EmployeeController::class, 'verifyStatusEmployee']);

    //Employee
    Route::get('api/employee/infoUserLoggedIn', [EmployeeController::class, 'infoEmployeeLoggedIn']);
    Route::post('api/employee', [EmployeeController::class, 'store']);
    Route::get('api/employee', [EmployeeController::class, 'index']);

    //MyRecord
    Route::get('api/employee/myRecord', [EmployeeController::class, 'recordInfoEmployee']);


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
Route::get('api/dependencies', [DependenceController::class, 'index']);
Route::get('api/kinships', [KinshipController::class, 'index']);
Route::get('api/academicLevels', [AcademicLevelController::class, 'index']);
Route::get('api/municipality/byDepartmentName/{department}', [MunicipalityController::class, 'byDepartmentName']);
Route::get('api/dependence/byDirectionName/{direction}', [DependenceController::class, 'byDirectionName']);

Route::post('import', [ExcelController::class, 'import']);
