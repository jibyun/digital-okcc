<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Privilege;

class PrivilegesController extends Controller {
    private $log;
    private $TABLE_NAME = "PRIVILEGES";

    public function __construct() {
        $this->middleware('auth');
        $this->log = new LogController();
    }

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
            $result = Privilege::create($request->all());
            $this->log->createLog(110003, 'INSERT ' . $this->TABLE_NAME . ' [ID] ' . $result->id);
            return response()
                ->json([
                    'message' => 'The item was successfully created.',
                    'privileges' => $result,
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
            $detail = $this->log->checkUpdatedFields($privilegeUpdate, $input, null); 
            $privileges = $privilegeUpdate->fill($input)->save();
            $this->log->createLog(110004, 'UPDATE ' . $this->TABLE_NAME . ' [ID] ' . $id . ' [DETAIL] ' . $detail);
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
}
