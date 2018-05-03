<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminPagesController extends Controller {
    /**
     * Create a new controller instance.
     */
    public function __construct() {
        //$this->middleware('guest')->only('users_list');
        $this->middleware('auth')->except('users_list');
    }

    public function index() { return view('admin.index'); }

    public function users() { return view('admin.users'); }
    public function members() { return view('admin.members'); }
    public function finances() { return view('admin.finances'); }
    public function inventories() { return view('admin.inventories'); }

    public function categoryStart() { return view('admin.members.category'); }
    public function codeStart() { return view('admin.members.code'); }
    public function memberStart() { return view('admin.members.member'); }
    public function privilegeStart() { return view('admin.users.privilege'); }
    public function roleStart() { return view('admin.users.role'); }
    public function privileges_roles_map() { return view('admin.users.p-role-map'); }
    public function users_list() {return view('admin.users.user'); }
    public function departmentTree() { return view('admin.members.dept-tree'); }
    public function familyTree() { return view('admin.members.family-tree'); }
    public function memberDeptMap() { return view('admin.members.m-dept-map'); }
    public function logView() { return view('admin.users.logview'); }
    public function cellOrginizer() { return view('admin.members.cell'); }
    public function departmentOrginizer() { return view('admin.members.department'); }

    public function photoCropPost(Request $request) {
        $data = $request->image;
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);

        $image_name = 'photo'.time().'.png';
        $result = Storage::disk('uploads')->put($image_name, $data);
 
        return response()->json([ 'success'=>'done', 'filename'=>$image_name ]);
    }

}
