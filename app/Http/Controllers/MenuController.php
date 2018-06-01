<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function getMenu(Request $request) {
        $id = $request->id;
        if ($id === "admin") {
            $menu = array(
                [ 'key' => 'users', 'data' => $this->getUsersMenu(), ],
                [ 'key' => 'members', 'data' => $this->getMembersMenu(), ],
                [ 'key' => 'finances', 'data'=> $this->getFinancesMenu(), ],
                [ 'key' => 'inventories', 'data'=> $this->getInventoriesMenu(), ],
                [ 'key' => 'tests', 'data' => $this->getTestsMenu(), ],
            );
        } else {
            $menu = array(
                [ 'key' => 'memberList', 'data' => $this->getMainMembersMenu(), ],
                [ 'key' => 'finances', 'data'=> $this->getMainFinancesMenu(), ],
                [ 'key' => 'inventories', 'data'=> $this->getMainInventoriesMenu(), ],
            );
        }
        $result = array( "menu" => json_decode( json_encode($menu), true ) );
        return response()->json( $result );
    }

    // Admin User Menu
    private function getUsersMenu() {
        return array([
            'icon' => 'fa-user',
            'text' => trans('messages.adm_layout.header_menu_user'),
            'route' => route('admin.users'),
            'isOpened' => true,
            'roles' => 'ADMIN_USER_ROLE',
            'sub_menu' => array(
                [
                    'icon' => 'fa-eye',
                    'text' => trans('messages.adm_layout.side_pri_role'),
                    'route' => null,
                    'isOpened' => true,
                    'roles' => 'ADMIN_USER_ROLE',
                    'sub_menu' => array(
                        [
                            'icon' => 'fa-angle-right',
                            'text' => trans('messages.adm_title.title', ['title' => 'Privilege']),
                            'route' => route('admin.privileges.start'),
                            'isOpened' => false,
                            'roles' => 'ADMIN_USER_ROLE',
                            'sub_menu' => null,
                        ],
                        [
                            'icon' => 'fa-angle-right',
                            'text' => trans('messages.adm_title.title', ['title' => 'Role']),
                            'route' => route('admin.roles.start'),
                            'isOpened' => false,
                            'roles' => 'ADMIN_USER_ROLE',
                            'sub_menu' => null,
                        ],
                        [
                            'icon' => 'fa-angle-right',
                            'text' => trans('messages.adm_title.title', ['title' => 'Privilege Mapping']),
                            'route' => route('admin.privileges-roles.map'),
                            'isOpened' => false,
                            'roles' => 'ADMIN_USER_ROLE',
                            'sub_menu' => null,
                        ],
                    ),
                ],
                [
                    'icon' => 'fa-registered',
                    'text' => trans('messages.adm_title.title', ['title' => 'User']),
                    'route' => route('admin.users.regist'),
                    'isOpened' => false,
                    'roles' => 'ADMIN_SUPER_ROLE',
                    'sub_menu' => null,
                ],
                [
                    'icon' => 'fa-file-text-o',
                    'text' => trans('messages.adm_title.title', ['title' => 'Log']),
                    'route' => route('admin.log.view'),
                    'isOpened' => false,
                    'roles' => 'ADMIN_SUPER_ROLE',
                    'sub_menu' => null,
                ],
            ),
        ]);
    }

    private function getMembersMenu() {
        return array([
            'icon' => 'fa-users',
            'text' => trans('messages.adm_layout.header_menu_member'),
            'route' => route('admin.members'),
            'isOpened' => true,
            'roles' => 'ADMIN_MEMBER_ROLE',
            'sub_menu' => array(
                [
                    'icon' => 'fa-list-alt',
                    'text' =>  trans('messages.adm_title.title', ['title' => 'Category']),
                    'route' => route('admin.categories.start'),
                    'isOpened' => false,
                    'roles' => 'ADMIN_SUPER_ROLE',
                    'sub_menu' => null,
                ],
                [
                    'icon' => 'fa-key',
                    'text' =>  trans('messages.adm_title.title', ['title' => 'Code']),
                    'route' => route('admin.codes.start'),
                    'isOpened' => false,
                    'roles' => 'ADMIN_SUPER_ROLE',
                    'sub_menu' => null,
                ],
                [
                    'icon' => 'fa-link',
                    'text' =>  trans('messages.adm_title.title', ['title' => 'Department Tree']),
                    'route' => route('admin.dept-tree.map'),
                    'isOpened' => false,
                    'roles' => 'ADMIN_SUPER_ROLE',
                    'sub_menu' => null,
                ],
                [
                    'icon' => 'fa-anchor',
                    'text' =>  trans('messages.adm_title.title', ['title' => 'Member']),
                    'route' => route('admin.members.start'),
                    'isOpened' => false,
                    'roles' => 'ADMIN_MEMBER_ROLE',
                    'sub_menu' => null,
                ],
                [
                    'icon' => 'fa-sitemap',
                    'text' =>  trans('messages.adm_title.title', ['title' => 'Family Tree']),
                    'route' => route('admin.family.map'),
                    'isOpened' => false,
                    'roles' => 'ADMIN_MEMBER_ROLE',
                    'sub_menu' => null,
                ],
                [
                    'icon' => 'fa-files-o',
                    'text' =>  trans('messages.adm_title.title', ['title' => 'Department Enrollment']),
                    'route' => route('admin.member-dept.map'),
                    'isOpened' => false,
                    'roles' => 'ADMIN_MEMBER_ROLE',
                    'sub_menu' => null,
                ],
                [
                    'icon' => 'fa-cubes',
                    'text' =>  trans('messages.adm_title.cell_organizer'),
                    'route' => route('admin.cell.orginizer'),
                    'isOpened' => false,
                    'roles' => 'ADMIN_MEMBER_ROLE',
                    'sub_menu' => null,
                ],
                [
                    'icon' => 'fa-cubes',
                    'text' =>  trans('messages.adm_title.dept_organizer'),
                    'route' => route('admin.dept.orginizer'),
                    'isOpened' => false,
                    'roles' => 'ADMIN_MEMBER_ROLE',
                    'sub_menu' => null,
                ],
            ),
        ]);
    }

    private function getFinancesMenu() {
        return array([
            'icon' => 'fa-usd',
            'text' => trans('messages.adm_layout.header_menu_finance'),
            'route' => route('admin.finances'),
            'isOpened' => false,
            'roles' => 'ADMIN_FINANCE_ROLE',
            'sub_menu' => null,
        ]);
    }

    private function getInventoriesMenu() {
        return array([
            'icon' => 'fa-server',
            'text' => trans('messages.adm_layout.header_menu_inventory'),
            'route' => route('admin.inventories'),
            'isOpened' => false,
            'roles' => 'ADMIN_INVENTORY_ROLE',
            'sub_menu' => null,
        ]);
    }

    private function getTestsMenu() {
        return array([
            'icon' => 'fa-crosshairs',
            'text' => trans('messages.adm_layout.header_menu_test'),
            'route' => route('admin.tests'),
            'isOpened' => true,
            'roles' => 'ADMIN_SUPER_ROLE',
            'sub_menu' => array(
                [
                    'icon' => 'fa-angle-right',
                    'text' =>  'Toolbar Test',
                    'route' => route('admin.tests.toolbar'),
                    'isOpened' => false,
                    'roles' => 'ADMIN_SUPER_ROLE',
                    'sub_menu' => null,
                ],
                [
                    'icon' => 'fa-angle-right',
                    'text' =>  'Dynamic Search Test',
                    'route' => route('admin.tests.search'),
                    'isOpened' => false,
                    'roles' => 'ADMIN_SUPER_ROLE',
                    'sub_menu' => null,
                ],
            ),
        ]);
    }

    private function getMainMembersMenu() {
        return array([
            'icon' => 'fa-users',
            'id' => 'menu_members',
            'text' => trans('messages.top_menu.members'),
            'route' => route('memberList'),
            'isOpened' => true,
            'roles' => 'MEMBER_ACCESS_ROLE',
            'sub_menu' => null,
        ]);
    }

    private function getMainFinancesMenu() {
        return array([
            'icon' => 'fa-usd',
            'id' => 'menu_finance',
            'text' => trans('messages.top_menu.finance'),
            'route' => null,
            'isOpened' => false,
            'roles' => 'FINANCE_ACCESS_ROLE',
            'sub_menu' => null,
        ]);
    }

    private function getMainInventoriesMenu() {
        return array([
            'icon' => 'fa-server',
            'id' => 'menu_inventory',
            'text' => trans('messages.top_menu.inventory'),
            'route' => null,
            'isOpened' => false,
            'roles' => 'INVENTORY_ACCESS_ROLE',
            'sub_menu' => null,
        ]);
    }
}
