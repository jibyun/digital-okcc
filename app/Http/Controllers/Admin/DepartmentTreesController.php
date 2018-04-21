<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Code;
use App\Department_Tree;

class DepartmentTreesController extends Controller {
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $parent_id = $request->parent_id;
        // get all records of department_trees table with code table
        $result = Department_Tree::where('parent_id', $parent_id)->with(['codeByChildId'])->orderBy('id', 'ASC')->get();

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
        $result = Department_Tree::create($request->all());
        return response()
            ->json([
                'message' => 'The item was successfully created.',
                'result' => $result,
                'status' => 200
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            Department_Tree::find($id)->delete();
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
        $currentLists = Department_Tree::where('parent_id', $request->parent_id)->pluck('child_id')->all();
        $codes = Code::where('code_category_id', $request->category_id)->whereNotIn('id', $currentLists)->get();
        return response()->json(array("codes" => json_decode(json_encode($codes), true)));
    }

    /**
     * Return reinforced table after adding elements and the name converted by code
     */
    private function reinforceTable($value) {
        $temp['id'] = $value->id;
        $temp['child_id'] = $value->codeByChildId->id;
        $temp['child_txt'] = $value->codeByChildId->txt;
        $temp['child_memo'] = $value->codeByChildId->memo;
        return $temp;
    }
}
