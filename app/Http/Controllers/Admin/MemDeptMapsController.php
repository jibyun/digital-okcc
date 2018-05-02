<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Exception;
use Config;

use App\Code;
use App\Member_Department_Map;
use App\Member;
use App\User;
use App\Http\Services\Log\SystemLog;

class MemDeptMapsController extends Controller {
    private $TABLE_NAME = "MEMBER_DEPARTMENT_MAPS";

    public function __construct() {
        $this->middleware('auth');
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
            'manager' => 'required|boolean',
            'updated_by' => 'required',
        ];

        //Define messages
        $messages = [];

        $validator = \Validator::make( $input, $rules, $messages );

        if ($validator->fails()) {
            return response()->json([ 'code' => 'validation', 'errors' => $validator->errors()->all() ], 200);
        } else {
            try {
                $result = Member_Department_Map::create($request->all());
                SystemLog::write( Config::get('app.admin.logInsert'), $this->TABLE_NAME . ' [ID] ' . $result->id );
                return response()->json([ 'codes' => $result ], 200);
            } catch (Exception $e) {
                return response()->json([ 'code' => 'exception', 'errors' => $e->getMessage(), 'status' => $e->getCode() ], 200);
            }
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
            'manager' => 'required|boolean',
            'updated_by' => 'required',
        ];

        //Define messages
        $messages = [];

        $validator = \Validator::make( $input, $rules, $messages );

        if ($validator->fails()) {
            return response()->json([ 'code' => 'validation', 'errors' => $validator->errors()->all() ], 200);
        } else {
            try {
                $detail = SystemLog::createLogForUpdatedFields($previousRecord, $input, ['department_name', 'position_name', 'updated_by_name']); 
                $result = $previousRecord->fill($input)->save();
                SystemLog::write( config('app.admin.logUpdate'), $this->TABLE_NAME . ' [ID] ' . $id . ' [DETAIL] ' . $detail );
                return response()->json([ 'categories' => $result ], 200);
            } catch (Exception $e) {
                return response()->json([ 'code' => 'exception', 'errors' => $e->getMessage(), 'status' => $e->getCode() ], 200);
            }
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
            SystemLog::write( config('app.admin.logDelete'), $this->TABLE_NAME . ' [ID] ' . $id );
            return response()->json([ 'message' => 'DELETED!' ], 200);
        } catch (Exception $e) {
            return response()->json([ 'code' => 'exception', 'errors' => $e->getMessage(), 'status' => $e->getCode() ], 200);
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

    /**
     * Get members by department ids
     */
    public function getMembersByDepartmentId(Request $request) {

        $result = DB::table('members')
            ->join('member_department_maps', 'members.id', '=', 'member_department_maps.member_id')
            ->where('department_id', $request->department_id)
            ->orderBy('department_id', 'ASC')->get(['members.*', 'member_department_maps.id as xid', 'member_department_maps.manager as manager']);

        $result = array( "members" => json_decode(json_encode($result), true) );
        return response()->json($result);
    }

    public function getMembersNotAssignedCell() {
        $CELL_CATEGORY = 10;

        $exception = DB::table('members')
            ->join('member_department_maps', 'members.id', '=', 'member_department_maps.member_id')
            ->join('codes', 'member_department_maps.department_id', '=', 'codes.id')
            ->where('codes.code_category_id', '=', $CELL_CATEGORY)->pluck('members.id')->all();

        $result = Member::whereNotIn('id', $exception)->where('primary', 1)->get(['members.*']);
        $result = array( "members" => json_decode(json_encode($result), true) );
        return response()->json($result);
    }

    public function getMembersNotAssignedDept(Request $request) {
        $exception = DB::table('members')
            ->join('member_department_maps', 'members.id', '=', 'member_department_maps.member_id')
            ->join('codes', 'member_department_maps.department_id', '=', 'codes.id')
            ->where('codes.id', '=', $request->department_id)->pluck('members.id')->all();

        $result = Member::whereNotIn('id', $exception)->get(['members.*']);
        $result = array( "members" => json_decode(json_encode($result), true) );
        return response()->json($result);
    }
}
