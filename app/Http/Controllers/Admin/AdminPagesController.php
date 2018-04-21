<?php

namespace App\Http\Controllers\Admin;

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
     */
    public function index() {
        return view('admin.index');
    }

    /**
     * Show Privileges and Roles mapping page.
     */
    public function privileges_roles_map() {
        return view('admin.p-role-map');
    }
    
    /**
     * Show Users list page.
     */
    public function users_list() {
        return view('admin.user');
    }

    /**
     * Show department-department tree mapping.
     */
    public function departmentTree() {
        return view('admin.dept-tree');
    }
    
    /**
     * Show family-family tree mapping.
     */
    public function familyTree() {
        return view('admin.family-tree');
    }

    /**
     * Show family-family tree mapping.
     */
    public function memberDeptMap() {
        return view('admin.m-dept-map');
    }
}
