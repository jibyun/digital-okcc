<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MembersController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function start() {
        return view('admin.member');
    }

    public function index() {
        //
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }
    
    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }
}
