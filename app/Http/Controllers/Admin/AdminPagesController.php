<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPagesController extends Controller {
    /**
     * Create a new controller instance.
     */
    public function __construct() {
        //$this->middleware('guest')->only('users_list');
        $this->middleware('auth')->except('users_list');
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
     * Show member and department mapping.
     */
    public function memberDeptMap() {
        return view('admin.m-dept-map');
    }

    /**
     * Show log view.
     */
    public function logView() {
        return view('admin.logview');
    }

    /**
     * upload an image
     */
    public function photoCropPost(Request $request) {
        $data = $request->image;
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);

        $image_name = 'photo'.time().'.png';
        $path = public_path() . '/uploads/' . $image_name;

        file_put_contents($path, $data);
        return response()->json([ 'success'=>'done', 'filename'=>$image_name ]);
    }

    /**
     * Show Cell Organizer.
     */
    public function cellOrginizer() {
        return view('admin.cell');
    }
}
