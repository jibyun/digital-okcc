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
        $categories = Code_Category::create($request->all());
        return response()->json($categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $categories = Code_Category::find($id)->update($request->all());
        return response()->json($categories);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        Code_Category::find($id)->delete();
        return response()->json(['done']);
    }
}
