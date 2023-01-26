<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Employee;
use Illuminate\Http\Request;

class ActionController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function show(Action $action)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Action $action)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function destroy(Action $action)
    {
        //
    }

    /**
     * Get Employee Actions
     *
     * @return \Illuminate\Http\Request
     */
    public function getEmployeeActions(Request $request)
    {

        $employeeActions = Action::select(
            '*',
            'action.created_at as record_updated',
            'es.status_name',
            'e.full_name',
        )
            ->join('employee as e', 'action.employee_id', '=', 'e.id')
            ->join('employee_status as es', 'action.employee_status_id', '=', 'es.id')
            ->get();

        $employeeActions->makeHidden(['id']);

        return response()->json(['message' => 'success', 'employeeActions' => $employeeActions]);
    }
}
