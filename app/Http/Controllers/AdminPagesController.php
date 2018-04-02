<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPagesController extends Controller {
    /**
     * Create a new controller instance.
     */
    public function __construct() {
        // TODO 로그인이 구현된 후 사용할 예정임 
        // $this->middleware('guest')->only('index');
        // $this->middleware('auth')->except('index');
    }

    /**
     * Show Admin Index page.
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.index');
    }
}
