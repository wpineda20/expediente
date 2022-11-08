<?php

namespace App\Http\Controllers;

//Models
use App\Models\Employee;
use App\Models\Profession;
use App\Models\FamilyStatus;
use App\Models\Municipality;
use App\Models\Direction;
use App\Models\Subdirection;
use App\Models\Unit;
use App\Models\WorkData;
use App\Models\Kinship;
use App\Models\FamilyGroupEmergency;

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

                $employee->save();
                break;
            case 2:
                $employee->direction_id = Direction::where('direction_name', $request->direction_name)->first()?->id;
                $employee->subdirection_id = Subdirection::where('subdirection_name', $request->subdirection_name)->first()?->id;
                $employee->unit_id = Unit::where('unit_name', $request->unit_name)->first()?->id;
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

                $family_group_emergency_data->full_name = $request->full_name;
                $family_group_emergency_data->phone = $request->phone;
                $family_group_emergency_data->cell_phone = $request->cell_phone;
                $family_group_emergency_data->kinship_id = Kinship::where('kinship_name', $request->kinship_name)->first()?->id;
                $family_group_emergency_data->employee_id = $employee->id;

                $family_group_emergency_data->save();
                break;
            case 4:
                AcademicDataController::store($request, $employee->id);
                break;
            case 5:
                dd($request);
                if(FileController::verifyTypeFile($request->dui_file && $request->title_file)){
                    $fileName = $employee->id;


                 }

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
}
