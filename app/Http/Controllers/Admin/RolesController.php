<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Privilege_Role_Map;

class RolesController extends Controller {
    private $log;
    private $TABLE_NAME = "ROLES";

    public function __construct() {
        $this->middleware('auth');
        $this->log = new LogController();
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
            return response()
                ->json([
                    'errors' => $validator->errors()->all(),
                    'message' => 'Failed',
                    'status' => 422
                ], 200);
        } else {
            $result = Role::create($request->all());
            $this->log->createLog(110003, 'INSERT ' . $this->TABLE_NAME . ' [ID] ' . $result->id);
            return response()
                ->json([
                    'message' => 'The item was successfully created.',
                    'roles' => $result,
                    'status' => 200
                ], 200);
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
            return response()
                ->json([
                    'errors' => $validator->errors()->all(),
                    'message' => 'Failed',
                    'status' => 422
                ], 200);
        } else {
            $detail = $this->log->checkUpdatedFields($roleUpdate, $input, null); 
            $roles = $roleUpdate->fill($input)->save();
            $this->log->createLog(110004, 'UPDATE ' . $this->TABLE_NAME . ' [ID] ' . $id . ' [DETAIL] ' . $detail);
            return response()
                ->json([
                    'message' => 'The item was successfully updated.',
                    'roles' => $roles,
                    'status' => 200
                ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            Role::find($id)->delete();
            $this->log->createLog(110005, 'DELETE ' . $this->TABLE_NAME . ' [ID] ' . $id);
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
     * Display a listing of the resource.
     */
    public function getroles_notin_map(Request $request) {
        // get role id that was already saved
        $p_roles_map = Privilege_Role_Map::where('privilege_id', $request->privilege_id)->pluck('role_id')->all();
        $roles = Role::whereNotIn('id', $p_roles_map)->get();
        return response()->json(array("roles" => json_decode(json_encode($roles), true)));
    }

}
