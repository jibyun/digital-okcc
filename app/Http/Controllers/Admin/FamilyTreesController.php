<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Code;
use App\Family_Map;
use App\Member;

class FamilyTreesController extends Controller {
    private $log;
    private $TABLE_NAME = "FAMILY_MAPS";

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
        $result = Family_Map::where('member_pri_id', $parent_id)->with(['memberByChildId'])->with(['codeByRelationId'])->orderBy('id', 'ASC')->get();

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
            'member_pri_id' => 'required',
            'member_sub_id' => 'required',
            'relation_id' => 'required',
        ];

        //Define messages
        $messages = [
            'member_pri_id.required' => 'The parent member field can not be blank.',
            'member_sub_id.required' => 'The child member field can not be blank.',
            'relation_id.required' => 'The relation code field can not be blank.',
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
            $result = Family_Map::create($request->all());
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
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            Family_Map::find($id)->delete();
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
     * get code lists except codes already registered as children of a parent in department tree.
     */
    public function getcodes_notin_child(Request $request) {
        // get code records that was already saved
        $currentLists = Family_Map::where('member_pri_id', $request->parent_id)->pluck('member_sub_id')->all();
        // add parent id in exception list
        array_push($currentLists, $request->parent_id);
        $members = Member::whereNotIn('id', $currentLists)->orderBy('first_name', 'ASC')->orderBy('last_name', 'ASC')->get();
        return response()->json(array("members" => json_decode(json_encode($members), true)));
    }

    /**
     * Return reinforced table after adding elements and the name converted by code
     */
    private function reinforceTable($v) {
        $temp['id'] = $v->id;
        $temp['child_id'] = $v->memberByChildId->id;
        if (!trim($v->memberByChildId->first_name) && !trim($v->memberByChildId->last_name)) {
            $temp['child_name'] = $v->memberByChildId->kor_name;
        } else {
            $temp['child_name'] = !trim($v->memberByChildId->first_name) ? trim($v->memberByChildId->last_name) : trim($v->memberByChildId->first_name . ' ' . trim($v->memberByChildId->last_name));
        }
        $temp['child_birth'] = $v->memberByChildId->dob;
        $temp['child_gender'] = $v->memberByChildId->gender;
        $temp['child_email'] = $v->memberByChildId->email;
        $temp['child_relation_id'] = $v->codeByRelationId->id;
        $temp['child_relation_name'] = $v->codeByRelationId->txt;

        return $temp;
    }
}
