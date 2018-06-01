<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Validator;
use Mail;

class AdminPagesController extends Controller {
    public function __construct() {
        //$this->middleware('guest')->only('users_list');
        $this->middleware('auth')->except('users_list');
    }

    public function index() { return view('admin.index'); }

    public function users() { return view('admin.users'); }
    public function members() { return view('admin.members'); }
    public function finances() { return view('admin.finances'); }
    public function inventories() { return view('admin.inventories'); }
    public function tests() { return view('admin.tests'); }

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

    public function toolbarTest() { return view('admin.tests.toolbar'); }
    public function searchTest() { return view('admin.tests.search'); }

    public function photoCropPost(Request $request) {
        $data = $request->image;
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);

        $image_name = 'photo'.time().'.png';
        $result = Storage::disk('uploads')->put($image_name, $data);
 
        return response()->json([ 'success'=>'done', 'filename'=>$image_name ]);
    }

    public function sendContactEmail(Request $request) {
        $validator = Validator::make( $request->all(), [
            'full_name'         => 'required',
            'email'             => 'required|email',
            'content'           => 'required',
        ], []);
        
        if ($validator->fails()) {
            return response()->json([ 'code' => 'validation', 'errors' => $validator->errors()->all() ], 200);
        } else {
            try {
                Mail::send( 'admin.contact', [ 'msg' => $request->content ], function($mail) use($request) {
                    $mail->from( $request->email, $request->full_name );
                    $mail->to( env('MAIL_FROM_ADDRESS', 'it.help@okcc.ca'), env('MAIL_FROM_NAME', 'OCO Admin') );
                    $mail->subject( 'Contact Message' );
                });
                return response()->json([ 'message' => 'Thank you for your message.' ], 200);
            } catch (Exception $e) {
                return response()->json([ 'code' => 'exception', 'errors' => $e->getMessage(), 'status' => $e->getCode() ], 200);
            }
        }
    }
  
}
