<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;

class RolesController extends Controller {
    /* 
    TODO: After developed login process
    Create a new controller instance. 
    
    public function __construct() {
        $this->middleware('auth');
    }
    */

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
            $roles = Role::create($request->all());
            return response()
                ->json([
                    'message' => 'The item was successfully created.',
                    'roles' => $roles,
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
            $roles = $roleUpdate->fill($input)->save();
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
}
