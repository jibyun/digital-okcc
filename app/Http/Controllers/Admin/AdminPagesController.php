<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

    public function getMenu(Request $request) {
        $menu = array();
        switch ($request->name) {
            case "users":       $menu = $this->getUsersMenu();          break;
            case "members":     $menu = $this->getMembersMenu();        break;
            case "finances":    $menu = $this->getFinancesMenu();       break;
            default:            $menu = $this->getInventoriesMenu();
        }
        $result = array( "menu" => json_decode( json_encode($menu), true ) );
        return response()->json( $result );
    }

    private function getUsersMenu() {
        return array([
            'icon' => 'fa-user',
            'text' => trans('messages.adm_layout.header_menu_user'),
            'route' => null,
            'isOpened' => true,
            'sub_menu' => array(
                [
                    'icon' => 'fa-eye',
                    'text' => trans('messages.adm_layout.side_pri_role'),
                    'route' => null,
                    'isOpened' => true,
                    'sub_menu' => array(
                        [
                            'icon' => 'fa-angle-right',
                            'text' => trans('messages.adm_title.title', ['title' => 'Privilege']),
                            'route' => route('admin.privileges.start'),
                            'isOpened' => false,
                            'sub_menu' => null,
                        ],
                        [
                            'icon' => 'fa-angle-right',
                            'text' => trans('messages.adm_title.title', ['title' => 'Role']),
                            'route' => route('admin.roles.start'),
                            'isOpened' => false,
                            'sub_menu' => null,
                        ],
                        [
                            'icon' => 'fa-angle-right',
                            'text' => trans('messages.adm_title.title', ['title' => 'Privilege Mapping']),
                            'route' => route('admin.privileges-roles.map'),
                            'isOpened' => false,
                            'sub_menu' => null,
                        ],
                    ),
                ],
                [
                    'icon' => 'fa-registered',
                    'text' => trans('messages.adm_title.title', ['title' => 'User']),
                    'route' => route('admin.users.regist'),
                    'isOpened' => false,
                    'sub_menu' => null,
                ],
                [
                    'icon' => 'fa-file-text-o',
                    'text' => trans('messages.adm_title.title', ['title' => 'Log']),
                    'route' => route('admin.log.view'),
                    'isOpened' => false,
                    'sub_menu' => null,
                ],
            ),
        ]);
    }

    private function getMembersMenu() {
        return array([
            'icon' => 'fa-users',
            'text' => trans('messages.adm_layout.header_menu_member'),
            'route' => null,
            'isOpened' => true,
            'sub_menu' => array(
                [
                    'icon' => 'fa-list-alt',
                    'text' =>  trans('messages.adm_title.title', ['title' => 'Category']),
                    'route' => route('admin.categories.start'),
                    'isOpened' => false,
                    'sub_menu' => null,
                ],
                [
                    'icon' => 'fa-key',
                    'text' =>  trans('messages.adm_title.title', ['title' => 'Code']),
                    'route' => route('admin.codes.start'),
                    'isOpened' => false,
                    'sub_menu' => null,
                ],
                [
                    'icon' => 'fa-link',
                    'text' =>  trans('messages.adm_title.title', ['title' => 'Department Tree']),
                    'route' => route('admin.dept-tree.map'),
                    'isOpened' => false,
                    'sub_menu' => null,
                ],
                [
                    'icon' => 'fa-anchor',
                    'text' =>  trans('messages.adm_title.title', ['title' => 'Member']),
                    'route' => route('admin.members.start'),
                    'isOpened' => false,
                    'sub_menu' => null,
                ],
                [
                    'icon' => 'fa-sitemap',
                    'text' =>  trans('messages.adm_title.title', ['title' => 'Family Tree']),
                    'route' => route('admin.family.map'),
                    'isOpened' => false,
                    'sub_menu' => null,
                ],
                [
                    'icon' => 'fa-files-o',
                    'text' =>  trans('messages.adm_title.title', ['title' => 'Department Enrollment']),
                    'route' => route('admin.member-dept.map'),
                    'isOpened' => false,
                    'sub_menu' => null,
                ],
                [
                    'icon' => 'fa-cubes',
                    'text' =>  trans('messages.adm_title.cell_organizer'),
                    'route' => route('admin.cell.orginizer'),
                    'isOpened' => false,
                    'sub_menu' => null,
                ],
                [
                    'icon' => 'fa-cubes',
                    'text' =>  trans('messages.adm_title.dept_organizer'),
                    'route' => route('admin.dept.orginizer'),
                    'isOpened' => false,
                    'sub_menu' => null,
                ],
            ),
        ]);
    }

    private function getFinancesMenu() {
        return array([
            'icon' => 'fa-usd',
            'text' => trans('messages.adm_layout.header_menu_finance'),
            'route' => null,
            'isOpened' => false,
        ]);
    }

    private function getInventoriesMenu() {
        return array([
            'icon' => 'fa-server',
            'text' => trans('messages.adm_layout.header_menu_inventory'),
            'route' => null,
            'isOpened' => false,
        ]);
    }

}
