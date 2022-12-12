<?php

namespace App\Http\Controllers;

use App\Models\EmployeeStatus;

use Illuminate\Http\Request;
use Encrypt;

class EmployeeStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemsPerPage = $request->itemsPerPage;
        $skip = ($request->page - 1) * $request->itemsPerPage;

        // Getting all the records
        if (($request->itemsPerPage == -1)) {
            $itemsPerPage =  EmployeeStatus::count();
            $skip = 0;
        }

        $sortBy = (isset($request->sortBy[0])) ? $request->sortBy[0] : 'id';
        $sort = (isset($request->sortDesc[0])) ? "asc" : 'desc';

        $search = (isset($request->search)) ? "%$request->search%" : '%%';

        $employeestatus = EmployeeStatus::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);
        $employeestatus = Encrypt::encryptObject($employeestatus, "id");

        $total = EmployeeStatus::counterPagination($search);

        return response()->json([
            "status" => 200,
            "message"=>"Registros obtenidos correctamente.",
            "records" => $employeestatus,
            "total" => $total,
            "success"=>true,
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
        $employeestatus = new EmployeeStatus;

		$employeestatus->status_name = $request->status_name;

        $employeestatus->save();

        return response()->json([
            "status"=>200,
            "message"=>"Registro creado correctamente.",
            "success"=>true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeStatus  employeestatus
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeStatus $employeestatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeStatus  $employeestatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = Encrypt::decryptArray($request->all(), 'id');

        $employeestatus = EmployeeStatus::where('id', $data['id'])->first();
		$employeestatus->status_name = $request->status_name;

        $employeestatus->save();

        return response()->json([
            "status"=>200,
            "message"=>"Registro modificado correctamente.",
            "success"=>true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeStatus  $employeestatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = isset($request->selected) ? $request->selected : [];

        if (count($data) > 0) {
            foreach ($data as $item) {
                $item = json_decode($item);

                EmployeeStatus::where('id', $id)->delete();
            }

            return response()->json([
                "status"=>200,
                "message"=>"Registro eliminado correctamente.",
                "success"=>true,
            ]);
        } 

        $id = Encrypt::decryptValue($request->id);

        EmployeeStatus::where('id', $id)->delete();

        return response()->json([
            "status"=>200,
            "message"=>"Registro eliminado correctamente.",
            "success"=>true,
        ]);
    }
}
