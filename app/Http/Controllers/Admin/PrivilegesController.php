<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Privilege;

class PrivilegesController extends Controller {
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
        return view('admin.privilege');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $privileges = Privilege::orderBy('id', 'ASC')->get();
        $result = array("privileges" => json_decode(json_encode($privileges), true));
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
            'txt.required' => 'The privilege name field can not be blank.',
            'txt.max' => "The privilege name's length can't be over :max characters.",
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
            $privileges = Privilege::create($request->all());
            return response()
                ->json([
                    'message' => 'The item was successfully created.',
                    'privileges' => $privileges,
                    'status' => 200
                ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        // find a record from categories by id
        $privilegeUpdate  = Privilege::findOrFail($id);
        $input = $request->all();

        // Define rules
        $rules = [
            'txt' => 'required|max:50',
        ];

        //Define messages
        $messages = [
            'txt.required' => 'The privilege name field can not be blank.',
            'txt.max' => "The privilege name's length can't be over :max characters.",
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
            $privileges = $privilegeUpdate->fill($input)->save();
            return response()
                ->json([
                    'message' => 'The item was successfully updated.',
                    'privileges' => $privileges,
                    'status' => 200
                ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            Privilege::find($id)->delete();
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