<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Config;

use App\Code;
use App\Http\Services\Log\SystemLog;

class CodesController extends Controller {
    private $TABLE_NAME = "CODES";

    public function __construct() {
        $this->middleware('auth');
    }

    public function get_codes() {
        return view('admin.members.includes.codes.get-codes-for-order');
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
            return response()->json([ 'code' => 'validation', 'errors' => $validator->errors()->all() ], 200);
        } else {
            try {
                $result = Code::create($request->all());
                SystemLog::write(Config::get('app.admin.logInsert'), $this->TABLE_NAME . ' [ID] ' . $result->id);
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
            return response()->json([ 'code' => 'validation', 'errors' => $validator->errors()->all() ], 200);
        } else {
            try {
                $detail = SystemLog::createLogForUpdatedFields($codeUpdate, $input, null); 
                $codes = $codeUpdate->fill($input)->save();
                SystemLog::write(Config::get('app.admin.logUpdate'), $this->TABLE_NAME . ' [ID] ' . $id . ' [DETAIL] ' . $detail);
                return response()->json([ 'categories' => $codes ], 200);
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
            Code::find($id)->delete();
            SystemLog::write(Config::get('app.admin.logDelete'), $this->TABLE_NAME . ' [ID] ' . $id);
            return response()->json([ 'message' => 'DELETED!' ], 200);
        } catch (Exception $e) {
            return response()->json([ 'code' => 'exception', 'errors' => $e->getMessage(), 'status' => $e->getCode() ], 200);
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
