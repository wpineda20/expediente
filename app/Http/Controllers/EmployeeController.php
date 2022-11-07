<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Profession;
use App\Models\Municipality;
use App\Models\Direction;
use App\Models\Subdirection;
use App\Models\Unit;
use App\Models\WorkData;
use App\Models\Kinship;
use Illuminate\Http\Request;

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
                // dd($request);


                // $request->families[0]['kinship_name'] = Kinship::where('kinship_name', $request->kinship_name)->first()?->id;

                FamilyGroupController::store($request->families, $employee->id);

                $family_group_emergency_data = FamilyGroupEmergencyController::insert([
                    'employee_id' => $request->employee_id,
                    'kinship_id' => Kinship::where('kinship_name', $request->kinship_name)->first()?->id,
                    'full_name' => $request->full_name,
                    'phone' => $request->phone,
                    'cell_phone' => $request->cell_phone,
                ]);
                break;
            case 4:
                AcademicDataController::store($request->academicLevels, $employee->id);

                // // $academic_data = AcademicDataController::insert([
                // //     'subjects_approved' => $request->subjects_approved,
                // // ]);
                // $employee->save();
                break;
            case 5:

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
