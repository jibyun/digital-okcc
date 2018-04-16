<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
// Pre-Registration Routes...
$this->get('preregister', 'Auth\PreRegisterController@showRegistrationForm')->name('register');
$this->post('preregister', 'Auth\PreRegisterController@sendMail');

Route::get('/', function () {
    return view('index');
})->middleware('auth');

Route::post('apply', 'GuestController@apply')->name('apply'); 

// memberList Landing page
Route::get('/memberList', function () {
    return view('MemberList\memberList');
});
/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
*/
Route::get('admin', 'Admin\AdminPagesController@index')->name('admin'); // Index page

/*
|--------------------------------------------------------------------------
| Admin Subpages' Routes
|--------------------------------------------------------------------------
*/
// Categories CRUD
Route::get('admin/categoryStart', 'Admin\Code_CategoriesController@start')->name('admin.categories.start');
Route::get('admin/getCategories', 'Admin\Code_CategoriesController@get_categories')->name('admin.categories.getCategories');
Route::resource('admin/categories', 'Admin\Code_CategoriesController', [ 'except' => [ 'create', 'show', 'edit' ], 'as' => 'admin' ] );
// Codes CRUD
Route::get('admin/codeStart', 'Admin\CodesController@start')->name('admin.codes.start');
Route::get('admin/getCodes', 'Admin\CodesController@get_codes')->name('admin.code.getCodes');
Route::resource('admin/codes', 'Admin\CodesController', [ 'except' => [ 'create', 'show', 'edit' ], 'as' => 'admin' ] );
// Members CRUD
Route::get('admin/memberStart', 'Admin\MembersController@start')->name('admin.members.start');
Route::resource('admin/members', 'Admin\MembersController', [ 'except' => [ 'create', 'show', 'edit' ], 'as' => 'admin' ] );
//Privileges CRUD
Route::get('admin/privilegeStart', 'Admin\PrivilegesController@start')->name('admin.privileges.start');
Route::resource('admin/privileges', 'Admin\PrivilegesController', [ 'except' => [ 'create', 'show', 'edit' ], 'as' => 'admin' ] );
// Roles CRUD
Route::get('admin/roleStart', 'Admin\RolesController@start')->name('admin.roles.start');
Route::get('admin/getRolesNotInMap', 'Admin\RolesController@getroles_notin_map')->name('admin.roles.getroles-notin-map');
Route::resource('admin/roles', 'Admin\RolesController', [ 'except' => [ 'create', 'show', 'edit' ], 'as' => 'admin' ] );
// Privileges and Roles Mapping
Route::get('admin/privileges-roles', 'Admin\AdminPagesController@privileges_roles_map')->name('admin.privileges-roles.map');
Route::resource('admin/p-role-map', 'Admin\Privilege_Role_MapsController', [ 'except' => [ 'create', 'edit', 'update', 'show' ], 'as' => 'admin' ] );
// Users Registration 
Route::get('admin/users-regist', 'Admin\AdminPagesController@users_list')->name('admin.users.regist');
Route::get('admin/get-users', 'Admin\UsersController@getUsers')->name('admin.users.get-users');
Route::resource('admin/users', 'Admin\UsersController', [ 'except' => [ 'store', 'create', 'edit', 'show' ], 'as' => 'admin' ] );
// Log View
Route::get('admin/log-view', 'Admin\AdminPagesController@index')->name('admin.log.view');
// Department code Tree mapping
Route::get('admin/dept-tree-map', 'Admin\AdminPagesController@departmentTree')->name('admin.dept-tree.map');
Route::get('admin/getCodesNotInChild', 'Admin\DepartmentTreesController@getcodes_notin_child')->name('admin.department-trees.getcodes-notin-child');
Route::resource('admin/department-trees', 'Admin\DepartmentTreesController', [ 'except' => [ 'create', 'edit', 'update', 'show' ], 'as' => 'admin' ] );
// Family Mapping
Route::get('admin/family-map', 'Admin\AdminPagesController@familyTree')->name('admin.family.map');
// Members and Departments Mapping
Route::get('admin/member-dept-map', 'Admin\AdminPagesController@memberDeptMap')->name('admin.member-dept.map');
