<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Code;

class CodesController extends Controller {
    private $log;
    private $TABLE_NAME = "CODES";

    public function __construct() {
        $this->middleware('auth');
        $this->log = new LogController();
    }

    /**
     * Display a listing of the resource.
     */
    public function start() {
        return view('admin.code');
    }

    public function get_codes() {
        return view('admin.includes.codes.get-codes-for-order');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $category_id = $request->category_id;
        
        $codes = Code::where('code_category_id', $category_id)->orderBy('order', 'ASC')->get();
        $max_order = Code::where('code_category_id', $category_id)->max('order');
        $max_id = Code::where('code_category_id', $category_id)->max('id');
        $result = array("max_id" => $max_id, "max_order" => $max_order, "codes" => json_decode(json_encode($codes),true));

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
            'kor_txt' => 'required|max:50',
            'enabled' => 'required|boolean',
            'sysmetic' => 'required|boolean',
        ];

        //Define messages
        $messages = [
            'txt.required' => 'The code name field can not be blank.',
            'kor_txt.required' => '코드명 필드는 공백일 수 없습니다.',
            'txt.max' => "The code name's length can't be over :max characters.",
            'kor_txt.max' => "The code name's length can't be over :max characters.",
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
            $result = Code::create($request->all());
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
        // find a record from codes by id
        $codeUpdate  = Code::findOrFail($id);
        $input = $request->all();

        // Define rules
        $rules = [
            'txt' => 'required|max:50',
            'kor_txt' => 'required|max:50',
            'enabled' => 'required|boolean',
            'sysmetic' => 'required|boolean',
        ];

        //Define messages
        $messages = [
            'txt.required' => 'The code name field can not be blank.',
            'kor_txt.required' => '코드명 필드는 공백일 수 없습니다.',
            'txt.max' => "The code name's length can't be over :max characters.",
            'kor_txt.max' => "The code name's length can't be over :max characters.",
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
            $detail = $this->log->checkUpdatedFields($codeUpdate, $input, null); 
            $codes = $codeUpdate->fill($input)->save();
            $this->log->createLog(110004, 'UPDATE ' . $this->TABLE_NAME . ' [ID] ' . $id . ' [DETAIL] ' . $detail);
            return response()
                ->json([
                    'message' => 'The item was successfully updated.',
                    'codes' => $codes,
                    'status' => 200
                ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            Code::find($id)->delete();
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

    public function getCodesByCategoryIds(Request $request) {
        $result = array();
        for ($i=0; $i < count($request->category_id); $i++) {
            $category_id = $request->category_id[$i];
            $codes = Code::where('code_category_id', $category_id)->orderBy('order', 'ASC')->get();
            array_push($result, $codes);
        }
        $result = array("codes" => json_decode(json_encode($result),true));
        return response()->json($result);
    }
}
