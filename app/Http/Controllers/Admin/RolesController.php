<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

use App\Role;
use App\Privilege_Role_Map;
use App\Http\Services\Log\SystemLog;

class RolesController extends Controller {
    private $TABLE_NAME = "ROLES";

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function start() {
        return view('admin.role');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $roles = Role::orderBy('id', 'ASC')->get();
        $result = array("roles" => json_decode(json_encode($roles), true));
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        $input = $request->all();

        // Define rules
        $rules = [
            'txt' => 'required|max:50',
        ];

        //Define messages
        $messages = [
            'txt.required' => 'The role name field can not be blank.',
            'txt.max' => "The role name's length can't be over :max characters.",
        ];

        $validator = \Validator::make( $input, $rules, $messages );

        if ($validator->fails()) {
            return response()->json([ 'code' => 'validation', 'errors' => $validator->errors()->all() ], 200);
        } else {
            try {
                $result = Role::create($request->all());
                SystemLog::write(110003, $this->TABLE_NAME . ' [ID] ' . $result->id);
                return response()->json([ 'roles' => $result ], 200);
            } catch (Exception $e) {
                return response()->json([ 'code' => 'exception', 'errors' => $e->getMessage(), 'status' => $e->getCode() ], 200);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        // find a record from categories by id
        $roleUpdate  = Role::findOrFail($id);
        $input = $request->all();

        // Define rules
        $rules = [
            'txt' => 'required|max:50',
        ];

        //Define messages
        $messages = [
            'txt.required' => 'The role name field can not be blank.',
            'txt.max' => "The role name's length can't be over :max characters.",
        ];

        $validator = \Validator::make( $input, $rules, $messages );

        if ($validator->fails()) {
            return response()->json([ 'code' => 'validation', 'errors' => $validator->errors()->all() ], 200);
        } else {
            try {
                $detail = SystemLog::createLogForUpdatedFields($roleUpdate, $input, null); 
                $roles = $roleUpdate->fill($input)->save();
                SystemLog::write(110004, $this->TABLE_NAME . ' [ID] ' . $id . ' [DETAIL] ' . $detail);
                return response()->json([ 'roles' => $roles ], 200);
            } catch (Exception $e) {
                return response()->json([ 'code' => 'exception', 'errors' => $e->getMessage(), 'status' => $e->getCode() ], 200);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            Role::find($id)->delete();
            SystemLog::write(110005, $this->TABLE_NAME . ' [ID] ' . $id);
            return response()->json([ 'message' => 'DELETED!' ], 200);
        } catch (Exception $e) {
            return response()->json([ 'code' => 'exception', 'errors' => $e->getMessage(), 'status' => $e->getCode() ], 200);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function getroles_notin_map(Request $request) {
        // get role id that was already saved
        $p_roles_map = Privilege_Role_Map::where('privilege_id', $request->privilege_id)->pluck('role_id')->all();
        $roles = Role::whereNotIn('id', $p_roles_map)->get();
        return response()->json(array("roles" => json_decode(json_encode($roles), true)));
    }

}
