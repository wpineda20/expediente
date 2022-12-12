<?php

namespace App\Http\Controllers;

use App\Models\Dependence;
use App\Models\Direction;

use Illuminate\Http\Request;
use Encrypt;

class DependenceController extends Controller
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
            $itemsPerPage =  Dependence::count();
            $skip = 0;
        }

        $sortBy = (isset($request->sortBy[0])) ? $request->sortBy[0] : 'id';
        $sort = (isset($request->sortDesc[0])) ? "asc" : 'desc';

        $search = (isset($request->search)) ? "%$request->search%" : '%%';

        $dependence = Dependence::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);
        $dependence = Encrypt::encryptObject($dependence, "id");

        $total = Dependence::counterPagination($search);

        return response()->json([
            "status" => 200,
            "message"=>"Registros obtenidos correctamente.",
            "records" => $dependence,
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
        $dependence = new Dependence;

		$dependence->unit_name = $request->unit_name;
		$dependence->direction_id = Direction::where('direction_name', $request->direction_name)->first()->id;
		$dependence->deleted_at = $request->deleted_at;

        $dependence->save();

        return response()->json([
            "status"=>200,
            "message"=>"Registro creado correctamente.",
            "success"=>true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dependence  dependence
     * @return \Illuminate\Http\Response
     */
    public function show(Dependence $dependence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dependence  $dependence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = Encrypt::decryptArray($request->all(), 'id');

        $dependence = Dependence::where('id', $data['id'])->first();
		$dependence->unit_name = $request->unit_name;
		$dependence->direction_id = Direction::where('direction_name', $request->direction_name)->first()->id;
		$dependence->deleted_at = $request->deleted_at;

        $dependence->save();

        return response()->json([
            "status"=>200,
            "message"=>"Registro modificado correctamente.",
            "success"=>true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dependence  $dependence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = isset($request->selected) ? $request->selected : [];

        if (count($data) > 0) {
            foreach ($data as $item) {
                $item = json_decode($item);

                Dependence::where('id', $id)->delete();
            }

            return response()->json([
                "status"=>200,
                "message"=>"Registro eliminado correctamente.",
                "success"=>true,
            ]);
        }

        $id = Encrypt::decryptValue($request->id);

        Dependence::where('id', $id)->delete();

        return response()->json([
            "status"=>200,
            "message"=>"Registro eliminado correctamente.",
            "success"=>true,
        ]);
    }

    /**
     * Search All Dependencies By Direction Name
     *
     * @param  \App\Models\Dependence  $dependence
     * @return \Illuminate\Http\Response
     */
     public function byDirectionName(Request $request)
    {
        $dependencies = Dependence::select('*')
        ->join('direction', 'dependence.direction_id', '=', 'direction.id')
        ->where('direction.direction_name', $request->direction)
        ->get();

        return response()->json(['message' => 'success', 'dependencies'=>$dependencies]);
    }
}
