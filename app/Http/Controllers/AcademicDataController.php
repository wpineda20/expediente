<?php

namespace App\Http\Controllers;

use App\Models\AcademicData;
use App\Models\AcademicLevel;
use Illuminate\Http\Request;

class AcademicDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store(Request $request, $employee_id)
    {
        AcademicData::where(['employee_id' => $request->employee_id])->delete();
        foreach ($request->academics  as $level) {
            //Validate if career_status is finished (0/false = Finalizada)
            if ($level['career_status'] == false) {
                $level['career_status'] = false;
            }
            //Validate if career_status is no finished (1/true = No Finalizada)
            else {
                $level['career_status'] = true;
            }

            AcademicData::insert([
                'employee_id' => $employee_id,
                'academic_level_id' => AcademicLevel::where('level_name', $level['level_name'])->first()?->id,
                'education_center' => $level['education_center'],
                'year' => $level['year'],
                'obtained_title' => $level['obtained_title'],
                'career_status' => $level['career_status'],
                'career' => $level['career'],
                'subjects_approved' => $level['subjects_approved'],
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcademicData  $academicData
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicData $academicData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AcademicData  $academicData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcademicData $academicData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcademicData  $academicData
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicData $academicData)
    {
        //
    }
}
