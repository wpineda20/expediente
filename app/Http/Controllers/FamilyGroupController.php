<?php

namespace App\Http\Controllers;

use App\Models\FamilyGroup;
use App\Models\Kinship;
use Illuminate\Http\Request;

class FamilyGroupController extends Controller
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
    public static function store(array $families, int $employee_id)
    {
        FamilyGroup::where(['employee_id' => $employee_id])->delete();
        // dd($request->families);
        foreach ($families as $key => $family) {

            FamilyGroup::insert([
                'full_name' => $family['full_name'],
                'kinship_id' => $family['kinship_name'],
                'date_birth' => $family['date_birth'],
                'employee_id' => $employee_id,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FamilyGroup  $familyGroup
     * @return \Illuminate\Http\Response
     */
    public function show(FamilyGroup $familyGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FamilyGroup  $familyGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FamilyGroup $familyGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FamilyGroup  $familyGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(FamilyGroup $familyGroup)
    {
        //
    }
}
