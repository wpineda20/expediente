<?php

namespace App\Http\Controllers;

//Models
use App\Models\Employee;
use App\Models\Profession;
use App\Models\FamilyStatus;
use App\Models\Municipality;
use App\Models\Direction;
use App\Models\Dependence;
use App\Models\WorkData;
use App\Models\Kinship;
use App\Models\FamilyGroupEmergency;
use App\Models\FamilyGroup;
use App\Models\AcademicData;
use Storage;

use Illuminate\Http\Request;

//Libraries
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::where('user_id', auth()->user()->id)->first();

        return response()->json([
            'message' => 'Registros obtenidos correctamente',
            'success' => true,
            'employee' => $employee
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = Employee::where(['user_id' => auth()->user()->id])->first();

        $request->employee_id = $employee?->id;

        $notificationEmployee = "Registros almacenados correctamente.";

        switch ($request->idSection) {
            case 1:
                $employee->full_name = $request->full_name;
                $employee->family_status_id = FamilyStatus::where('family_status_name', $request->family_status_name)->first()?->id;
                $employee->profession_id = Profession::where('profession_name', $request->profession_name)->first()?->id;
                $employee->current_address = $request->current_address;
                $employee->municipality_id = Municipality::where('municipality_name', $request->municipality_name)->first()?->id;
                $employee->vulnerable_area = ($request->vulnerableArea == 'Sí') ? 1 : (($request->vulnerableArea == 'No') ? 2 : null);
                $employee->personal_email = $request->personal_email;
                $employee->phone = $request->phone;
                $employee->cell_phone = $request->cell_phone;
                $employee->employee_status_id = 2;

                $employee->save();
                break;
            case 2:
                $employee->direction_id = Direction::where('direction_name', $request->direction_name)->first()?->id;
                $employee->unit_id = Dependence::where('unit_name', $request->unit_name)->first()?->id;
                $employee->nominal_fee = $request->nominal_fee;
                $employee->functional_position = $request->functional_position;
                $employee->immediate_superior = $request->immediate_superior;
                $employee->email_institutional = $request->email_institutional;
                $employee->municipality_assigned_id = Municipality::where('municipality_name', $request->municipality_name)->first()?->id;

                $employee->save();
                break;
            case 3:
                FamilyGroupController::store($request->families, $employee->id);

                $family_group_emergency_data = FamilyGroupEmergency::where('employee_id', $request->employee_id)->first();

                if($family_group_emergency_data == null){
                    $family_group_emergency_data = new FamilyGroupEmergency();
                }

                $family_group_emergency_data->emergency_full_name = $request->emergency_full_name;
                $family_group_emergency_data->emergency_phone = $request->emergency_phone;
                $family_group_emergency_data->emergency_cell_phone = $request->emergency_cell_phone;
                $family_group_emergency_data->emergency_address = $request->emergency_address;
                $family_group_emergency_data->kinship_id = Kinship::where('kinship_name', $request->kinship_name)->first()?->id;
                $family_group_emergency_data->employee_id = $employee->id;

                $family_group_emergency_data->save();
                break;
            case 4:

                AcademicDataController::store($request, $employee->id);

                break;
            case 5:

                if ($request->dui_file) {
                $employee->dui_file = FileController::base64ToFile($request->dui_file, date("Y-m-d") . '-dui', 'dui');
                }

                if ($request->title_file) {
                $employee->title_file = FileController::base64ToFile($request->title_file, date("Y-m-d") . '-title', 'titles');
                }

                $employee->employee_status_id = 3;

                $employee->save();
                break;
            default:
                return response()->json(['message', 'fail']);
                break;
        }

         return response()->json([
            'status' => 200,
            'message' => $notificationEmployee,
            'success' => true,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function infoEmployeeLoggedIn(Request $request){

        $employee = Employee::select('*')
        ->where('employee.user_id', auth()->user()->id)
        ->first();

        //Family Status
        $familyStatus = DB::table('employee as e')
            ->select('fs.family_status_name')
            ->join('family_status as fs', 'e.family_status_id', '=', 'fs.id')
            ->where('e.user_id', auth()->user()->id)
            ->first();
        $employee->family_status_name = $familyStatus?->family_status_name;

         //Profession
        $profession = DB::table('employee as e')
            ->select('p.profession_name')
            ->join('profession as p', 'e.profession_id', '=', 'p.id')
            ->where('e.user_id', auth()->user()->id)
            ->first();
        $employee->profession_name = $profession?->profession_name;

        //Department and municipality
        $municipality = DB::table('employee as e')
            // ->select('mun.municipality_name', 'dep.department_name')
            ->join('municipalities as mun', 'e.municipality_id', '=', 'mun.id')
            ->join('department as dep', 'mun.department_id', '=', 'dep.id')
            ->where('e.user_id', auth()->user()->id)
            ->first();
        $employee->municipality_name = $municipality?->municipality_name;
        $employee->department_name = $municipality?->department_name;

        //Direction
        $direction = DB::table('employee as e')
            ->select('d.direction_name')
            ->join('direction as d', 'e.direction_id', '=', 'd.id')
            ->where('e.user_id', auth()->user()->id)
            ->first();
        $employee->direction_name = $direction?->direction_name;

        //Dependencies
        $dependence = DB::table('employee as e')
            ->select('d.unit_name')
            ->join('dependence as d', 'e.unit_id', '=', 'd.id')
            ->where('e.user_id', auth()->user()->id)
            ->first();
        $employee->unit_name = $dependence?->unit_name;

        //Department and municipality assigned
        $municipality_assigned_id = DB::table('employee as e')
            // ->select('mun.municipality_name', 'dep.department_name')
            ->join('municipalities as mun', 'e.municipality_assigned_id', '=', 'mun.id')
            ->join('department as dep', 'mun.department_id', '=', 'dep.id')
            ->where('e.user_id', auth()->user()->id)
            ->first();

        $employee->municipality_assigned_id = $municipality?->municipality_name;
        $employee->department_name = $municipality?->department_name;

        //Family Group
        $families = DB::table('family_group as fg')->select(
            'fg.id',
            'fg.full_name',
            'fg.date_birth',
            'k.kinship_name',
        )
        ->join('employee as e', 'fg.employee_id', '=', 'e.id')
        ->join('kinship as k', 'fg.kinship_id', '=', 'k.id')
        ->where('e.user_id', auth()->user()->id)
        ->get();

        $employee->families = $families;

        //Family Group Emergency
        $family_group_emergency = DB::table('family_group_emergency as fge')
        ->select(
            'fge.id',
            'fge.emergency_full_name',
            'fge.emergency_phone',
            'fge.emergency_cell_phone',
            'fge.emergency_address',
            'k.kinship_name',
        )
        ->join('employee as e', 'fge.employee_id', '=', 'e.id')
        ->join('kinship as k', 'fge.kinship_id', '=', 'k.id')
        ->where('e.user_id', auth()->user()->id)
        ->first();

        $employee->emergency_full_name = $family_group_emergency?->emergency_full_name;
        $employee->emergency_phone = $family_group_emergency?->emergency_phone;
        $employee->emergency_cell_phone = $family_group_emergency?->emergency_cell_phone;
        $employee->emergency_address = $family_group_emergency?->emergency_address;
        $employee->kinship_name = $family_group_emergency?->kinship_name;

        //Academic Data
        $academics = DB::table('academic_data as ad')->select(
            'ad.id',
            'ad.education_center',
            'ad.year',
            'ad.obtained_title',
            'al.level_name',
            )
        ->join('employee as e', 'ad.employee_id', '=', 'e.id')
        ->join('academic_level as al', 'ad.academic_level_id', '=', 'al.id')
        ->where('e.user_id', auth()->user()->id)
        ->get();

        $employee->academics = $academics;

        return response()->json([
            'message' => 'success',
            // 'userAccess' => auth()->user()->idRol,
            'employee' => $employee,
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }

      /**
     * Gets All Registered Records
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getRegisteredRecords(Request $request){

        $skip = $request->skip;
        $limit = $request->take - $skip; // the limit

        $registeredRecords = Employee::select('*', 'employee.id as employee_id', 'es.status_name', DB::raw("CONCAT(u.name,' ',u.last_name) AS user_name"))
        ->join('employee_status as es', 'employee.employee_status_id', '=', 'es.id')
        ->join('users as u', 'employee.user_id', '=', 'u.id')
        ->skip($skip)
        ->take($limit)
        ->get();

        $total = Employee::count();

        return response()->json([
            'message' => 'success',
            'registeredRecords' => $registeredRecords,
            'total' => $total
        ]);
    }

    /**
     * Get All Information For Employee Record
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function recordInfoEmployee()
    {

        $recordInfoEmployee = DB::table('employee as e')
        ->select(
            'e.*',
            'fs.family_status_name as family_status_id',
            'p.profession_name as profession_id',
            'm.municipality_name as municipality_id',
            'd.department_name',
            'di.direction_name as direction_id',
            'dep.unit_name as unit_id',
            'mu.municipality_name as municipality_assigned_id',
            'de.department_name as department_assigned_id',
            'fge.emergency_full_name',
            'fge.emergency_phone',
            'fge.emergency_cell_phone',
            'fge.emergency_address',
            'k.kinship_name as emergency_kinship_id',
        )

        ->join('family_status as fs', 'e.family_status_id', '=', 'fs.id', 'left outer')
        ->join('profession as p', 'e.profession_id', '=', 'p.id', 'left outer')
        ->join('municipalities as m', 'e.municipality_id', '=', 'm.id', 'left outer')
        ->join('department as d', 'm.department_id', '=', 'd.id', 'left outer')
        ->join('direction as di', 'e.direction_id', '=', 'di.id', 'left outer')
        ->join('dependence as dep', 'e.unit_id', '=', 'dep.id', 'left outer')
        ->join('municipalities as mu', 'e.municipality_assigned_id', '=', 'mu.id', 'left outer')
        ->join('department as de', 'mu.department_id', '=', 'de.id', 'left outer')
        ->join('family_group_emergency as fge', 'e.id', '=', 'fge.employee_id', 'left outer')
        ->join('kinship as k', 'fge.kinship_id', '=', 'k.id', 'left outer')
        ->where('e.user_id', auth()->user()->id)
        ->first();


        if(isset($recordInfoEmployee->dui_file)){

            $fullUrlDuiFile = asset($recordInfoEmployee->dui_file);

            $recordInfoEmployee->dui_file = $fullUrlDuiFile;
        }

        if(isset($recordInfoEmployee->title_file)){

            $fullUrlTitleFile = asset($recordInfoEmployee->title_file);

            $recordInfoEmployee->title_file = $fullUrlTitleFile;
        }

        //Family Group
        $familyGroup = DB::table('family_group as fg')
            ->select('fg.*', 'k.kinship_name as kinship_id')
            ->join('employee as e', 'fg.employee_id', '=', 'e.id')
            ->join('kinship as k', 'fg.kinship_id', '=', 'k.id')
            ->where('e.user_id', auth()->user()->id)
            ->get();
            $recordInfoEmployee->familyGroup = $familyGroup;

        //Academic Data
        $academicData = DB::table('academic_data as ad')
        ->select('ad.*', 'al.level_name as academic_level_id')
        ->join('employee as e', 'ad.employee_id', '=', 'e.id')
        ->join('academic_level as al', 'ad.academic_level_id', '=', 'al.id')
        ->where('e.user_id', auth()->user()->id)
        ->get();

        foreach ($academicData as $key => $value) {
            if($value->career_status == 2){
                $value->career_status = "No Finalizada";
            }else{
                $value->career_status = "Finalizada";
            }
        }

        $recordInfoEmployee->academics = $academicData;

        return response()->json(['message' => 'success', 'recordInfoEmployee' => $recordInfoEmployee]);
    }

     /**
     * Search Registered Records
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function searchRegisteredRecords(Request $request){

        $registeredRecords = Employee::select(
            'employee.full_name',
            'employee.personal_email',
            'employee.cell_phone',
            'employee.nominal_fee',
            'employee.id as employee_id',
            'es.status_name'
        )
        ->join('employee_status as es', 'employee.employee_status_id', '=', 'es.id')
        ->where('employee.full_name', 'like', '%' . $request->search . '%')
        ->orWhere('employee.personal_email', 'like', '%' . $request->search . '%')
        ->orWhere('employee.nominal_fee', 'like', '%' . $request->search . '%')
        ->orWhere('es.status_name', 'like', '%' . $request->search . '%')
        ->get();

        return response()->json([
            'message' => 'success',
            'registeredRecords' => $registeredRecords,
        ]);
    }

    /**
     * Gets all the information of the registered record which be found by the ID
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function registeredRecordById(Request $request){


         $record = Employee::where('id', $request->id)->first();

         $registeredRecords = DB::table('employee as e')
         ->select(
            'e.*',
            'fs.family_status_name',
            'p.profession_name',
            'm.municipality_name',
            'd.department_name',
            'mu.municipality_name as municipality_assigned_id',
            'de.department_name as department_assigned_id',
            'di.direction_name',
            'dep.unit_name',
            'fge.emergency_full_name',
            'fge.emergency_phone',
            'fge.emergency_cell_phone',
            'fge.emergency_address',
            'k.kinship_name as emergency_kinship_id',
            )
         ->join('family_status as fs', 'e.family_status_id', '=', 'fs.id', 'left outer')
         ->join('profession as p', 'e.profession_id', '=', 'p.id', 'left outer')
         ->join('municipalities as m', 'e.municipality_id', '=', 'm.id', 'left outer')
         ->join('department as d', 'm.department_id', '=', 'd.id', 'left outer')
         // Department & Municipality Assigned
         ->join('municipalities as mu', 'e.municipality_assigned_id', '=', 'mu.id', 'left outer')
         ->join('department as de', 'mu.department_id', '=', 'de.id', 'left outer')
         ->join('direction as di', 'e.direction_id', '=', 'di.id', 'left outer')
         ->join('dependence as dep', 'e.unit_id', '=', 'dep.id', 'left outer')
         ->join('family_group_emergency as fge', 'e.id', '=', 'fge.employee_id', 'left outer')
         ->join('kinship as k', 'fge.kinship_id', '=', 'k.id', 'left outer')
         ->where('e.id', $request->id)
         ->first();

        if(isset($registeredRecords->dui_file)){

            $fullUrlDuiFile = asset($registeredRecords->dui_file);

            $registeredRecords->dui_file = $fullUrlDuiFile;
        }

        if(isset($registeredRecords->title_file)){

            $fullUrlTitleFile = asset($registeredRecords->title_file);

            $registeredRecords->title_file = $fullUrlTitleFile;
        }

        // Getting all the family group of the employee
        $familyGroup = FamilyGroup::select(
            'family_group.id',
            'family_group.full_name',
            'family_group.date_birth',
            'k.kinship_name as kinship_id',
        )
        ->join('employee as e', 'family_group.employee_id', '=', 'e.id')
        ->join('kinship as k', 'family_group.kinship_id', '=', 'k.id')
        ->where('e.id', $request->id)
        ->get();

        $academicData = AcademicData::select(
            'academic_data.id',
            'academic_data.academic_level_id',
            'academic_data.education_center',
            'academic_data.year',
            'academic_data.obtained_title',
            'academic_data.career_status',
            'academic_data.career',
            'academic_data.subjects_approved',
            'al.level_name as academic_level_id',
            )
        ->join('employee as e', 'academic_data.employee_id', '=', 'e.id')
        ->join('academic_level as al', 'academic_data.academic_level_id', '=', 'al.id')
        ->where('e.id', $request->id)
        ->get();

        foreach ($academicData as $key => $value) {
            if($value->career_status == 2){
                $value->career_status = "No Finalizada";
            }else{
                $value->career_status = "Finalizada";
            }
        }


         return response()->json([
            'message' => 'success',
            'registeredRecords' => $registeredRecords,
            'families' => $familyGroup,
            'academics' => $academicData,
        ]);

     }


      /**
     * Verify Status Employee For View My Record Access
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function verifyStatusEmployee(Request $request){

        $employee = Employee::select('employee_status_id')->where('user_id', auth()->user()->id)->first();

        return response()->json(['message' => 'success', 'status' => $employee->employee_status_id]);

     }

}
