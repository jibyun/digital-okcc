<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Config;

use App\Code_Category;
use App\Http\Services\Log\SystemLog;

class Code_CategoriesController extends Controller {
    private $TABLE_NAME = "CODE_CATEGORIES";

    public function __construct() {
        $this->middleware('auth');
    }

    public function get_categories() {
        return view('admin.members.includes.categories.get-categories-for-order');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $categories = Code_Category::orderBy('order', 'ASC')->get();
        $max_order = Code_Category::max('order');
        $result = array("max_order" => $max_order, "categories" => json_decode(json_encode($categories),true));

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
        ];

        //Define messages
        $messages = [
            'txt.required' => 'The category name field can not be blank.',
            'kor_txt.required' => '카테고리명 필드는 공백일 수 없습니다.',
            'txt.max' => "The category name's length can't be over :max characters.",
            'kor_txt.max' => "The category name's length can't be over :max characters.",
        ];

        $validator = \Validator::make( $input, $rules, $messages );

        if ($validator->fails()) {
            return response()->json([ 'code' => 'validation', 'errors' => $validator->errors()->all() ], 200);
        } else {
            try {
                $result = Code_Category::create( $request->all() );
                SystemLog::write(Config::get('app.admin.logInsert'), $this->TABLE_NAME . ' [ID] ' . $result->id);
                return response()->json([ 'categories' => $result ], 200);
            } catch (Exception $e) {
                return response()->json([ 'code' => 'exception', 'errors' => $e->getMessage(), 'status' => $e->getCode() ], 200);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        // find a record from categories by id
        $categoryUpdate  = Code_Category::findOrFail($id);
        $input = $request->all();

        // Define rules
        $rules = [
            'txt' => 'required|max:50',
            'kor_txt' => 'required|max:50',
            'enabled' => 'required|boolean',
        ];

        //Define messages
        $messages = [
            'txt.required' => 'The category name field can not be blank.',
            'kor_txt.required' => '카테고리명 필드는 공백일 수 없습니다.',
            'txt.max' => "The category name's length can't be over :max characters.",
            'kor_txt.max' => "The category name's length can't be over :max characters.",
        ];

        $validator = \Validator::make( $input, $rules, $messages );

        if ($validator->fails()) {
            return response()->json([ 'code' => 'validation', 'errors' => $validator->errors()->all() ], 200);
        } else {
            try {
                $detail = SystemLog::createLogForUpdatedFields($categoryUpdate, $input, null); 
                $categories = $categoryUpdate->fill($input)->save();
                SystemLog::write(Config::get('app.admin.logUpdate'), $this->TABLE_NAME . ' [ID] ' . $id . ' [DETAIL] ' . $detail);
                return response()->json([ 'categories' => $categories ], 200);
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
            Code_Category::find($id)->delete();
            SystemLog::write(Config::get('app.admin.logDelete'), $this->TABLE_NAME . ' [ID] ' . $id);
            return response()->json([ 'message' => 'DELETED!' ], 200);
        } catch (Exception $e) {
            return response()->json([ 'code' => 'exception', 'errors' => $e->getMessage(), 'status' => $e->getCode() ], 200);
        }
    }
}
