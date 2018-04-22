<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Code;
use App\Member_Department_Map;
use App\Member;
use App\User;

class MemDeptMapsController extends Controller {
    private $log;
    private $TABLE_NAME = "MEMBER_DEPARTMENT_MAPS";

    public function __construct() {
        $this->middleware('auth');
        $this->log = new LogController();
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $parent_id = $request->parent_id;
        // get all records of department_trees table with code table
        $result = Member_Department_Map::where('member_id', $parent_id)->with(['codeByDepartmentId'])
            ->with(['codeByPositionId'])->with(['userByUpdatedById'])->orderBy('id', 'ASC')->get();

        $lists = array();
        foreach ($result as $value) {
            array_push($lists, $this->reinforceTable($value));
        }

        $result = array("result" => $lists);
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $input = $request->all();

        // Define rules
        $rules = [
            'member_id' => 'required',
            'department_id' => 'required',
            'position_id' => 'required',
            'enabled' => 'required|boolean',
            'updated_by' => 'required',
        ];

        //Define messages
        $messages = [
            'member_id.required' => 'The member field can not be blank.',
            'department_id.required' => 'The department code field can not be blank.',
            'position_id.required' => 'The positon code field can not be blank.',
            'updated_by.required' => 'The user code field for updated_by field can not be blank.',
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
            $result = Member_Department_Map::create($request->all());
            $this->log->createLog(110003, 'INSERT ' . $this->TABLE_NAME . ' [ID] ' . $result->id);
            return response()
                ->json([
                    'message' => 'The item was successfully created.',
                    'codes' => $result,
                    'status' => 200
                ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {

        $previousRecord  = Member_Department_Map::findOrFail($id);
        $input = $request->all();

        // Define rules
        $rules = [
            'member_id' => 'required',
            'department_id' => 'required',
            'position_id' => 'required',
            'enabled' => 'required|boolean',
            'updated_by' => 'required',
        ];

        //Define messages
        $messages = [
            'member_id.required' => 'The member field can not be blank.',
            'department_id.required' => 'The department code field can not be blank.',
            'position_id.required' => 'The positon code field can not be blank.',
            'updated_by.required' => 'The user code field for updated_by field can not be blank.',
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
            $detail = $this->log->checkUpdatedFields($previousRecord, $input, ['department_name', 'position_name', 'updated_by_name']); 
            $result = $previousRecord->fill($input)->save();
            $this->log->createLog(110004, 'UPDATE ' . $this->TABLE_NAME . ' [ID] ' . $id . ' [DETAIL] ' . $detail);
            return response()
                ->json([
                    'message' => 'The item was successfully updated.',
                    'categories' => $result,
                    'status' => 200
                ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            Member_Department_Map::find($id)->delete();
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
     * Return reinforced table after adding elements and the name converted by code
     */
    private function reinforceTable($v) {
        $temp['id'] = $v->id;
        $temp['department_id'] = $v->department_id;
        $temp['department_name'] = $v->codeByDepartmentId->txt;
        $temp['position_id'] = $v->position_id;
        $temp['position_name'] = $v->codeByPositionId->txt;
        $temp['enabled'] = $v->enabled;
        $temp['started_at'] = $v->started_at;
        $temp['finished_at'] = $v->finished_at;
        $temp['updated_by'] = $v->updated_by;
        $temp['updated_by_name'] = $v->userByUpdatedById->name;

        return $temp;
    }
}
