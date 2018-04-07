<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Code_Category;

class Code_CategoriesController extends Controller
{
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
        return view('admin.category');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $categories = Code_Category::get();
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
            return response()
                ->json([
                    'errors' => $validator->errors()->all(),
                    'message' => 'Failed',
                    'status' => 422
                ], 200);
        } else {
            $categories = Code_Category::create($request->all());
            return response()
                ->json([
                    'message' => 'The item was successfully created.',
                    'categories' => $categories,
                    'status' => 200
                ], 200);
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
            return response()
                ->json([
                    'errors' => $validator->errors()->all(),
                    'message' => 'Failed',
                    'status' => 422
                ], 200);
        } else {
            $categories = $categoryUpdate->fill($input)->save();
            return response()
                ->json([
                    'message' => 'The item was successfully updated.',
                    'categories' => $categories,
                    'status' => 200
                ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            Code_Category::find($id)->delete();
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
