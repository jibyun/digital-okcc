<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Privilege_Role_Map;
use App\Http\Services\Log\SystemLog;

class Privilege_Role_MapsController extends Controller {
    private $TABLE_NAME = "PRIVILEGE_ROLE_MAPS";

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $privilege_id = $request->privilege_id;
        // get all records of privilege_role_maps table with roles table
        $result = Privilege_Role_Map::where('privilege_id', $privilege_id)->with(['role'])->orderBy('id', 'ASC')
            ->get();

        $p_role_maps = array();
        foreach ($result as $value) {
            array_push($p_role_maps, $this->reinforceTable($value));
        }

        $result = array("result" => $p_role_maps);
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $result = Privilege_Role_Map::create($request->all());
        SystemLog::write(110003, $this->TABLE_NAME . ' [ID] ' . $result->id);
        return response()
            ->json([
                'message' => 'The item was successfully created.',
                'result' => $result,
                'status' => 200
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            Privilege_Role_Map::find($id)->delete();
            SystemLog::write(110005, $this->TABLE_NAME . ' [ID] ' . $id);
            return response()
                ->json([
                    'message' => 'The item was successfully deleted.',
                    'status' => 200
                ], 200);
        } catch (\Exception $e) {
            return response()
                ->json([
                    'errors' => $e->getMessage(),
                    'message' => 'Failed',
                    'status' => 422
                ], 200);
        }
    }

    /**
     * Return reinforced table after adding elements and the name converted by code
     */
    private function reinforceTable($value) {
        $temp['id'] = $value->id;
        $temp['role_id'] = $value->role->id;
        $temp['role_txt'] = $value->role->txt;
        $temp['role_memo'] = $value->role->memo;
        return $temp;
    }
}
