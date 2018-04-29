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
Route::get('preregister', 'Auth\PreRegisterController@showRegistrationForm')->name('preregister');
Route::post('preregister', 'Auth\PreRegisterController@sendMail')->name('preregister');

Route::get('/', function () {
    return view('MemberList/memberList');
})->middleware('auth');

// memberList Landing page
Route::get('/memberList', function () {
    return view('MemberList/memberList');
})->middleware('auth')->name('memberList');
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
Route::get('admin/getCodesByCategoryIds', 'Admin\CodesController@getCodesByCategoryIds')->name('admin.code.getCodesByCategoryIds');
Route::resource('admin/codes', 'Admin\CodesController', [ 'except' => [ 'create', 'show', 'edit' ], 'as' => 'admin' ] );
// Members CRUD
Route::get('admin/memberStart', 'Admin\MembersController@start')->name('admin.members.start');
Route::resource('admin/members', 'Admin\MembersController', [ 'except' => [ 'create', 'show', 'edit', 'destroy' ], 'as' => 'admin' ] );
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
Route::get('admin/getCurrentUsers', 'Admin\UsersController@getCurrentUsers')->name('admin.users.get-current-users');
Route::resource('admin/users', 'Admin\UsersController', [ 'except' => [ 'store', 'create', 'edit', 'show' ], 'as' => 'admin' ] );
// Log View
Route::get('admin/log-view', 'Admin\AdminPagesController@logView')->name('admin.log.view');
Route::get('admin/getLog', 'Admin\LogController@getLog')->name('admin.log.get');
// Department code Tree mapping
Route::get('admin/dept-tree-map', 'Admin\AdminPagesController@departmentTree')->name('admin.dept-tree.map');
Route::get('admin/getCodesNotInChild', 'Admin\DepartmentTreesController@getcodes_notin_child')->name('admin.department-trees.getcodes-notin-child');
Route::resource('admin/department-trees', 'Admin\DepartmentTreesController', [ 'except' => [ 'create', 'edit', 'update', 'show' ], 'as' => 'admin' ] );
// Family Mapping
Route::get('admin/family-map', 'Admin\AdminPagesController@familyTree')->name('admin.family.map');
Route::get('admin/getCodesNotInChildByFamily', 'Admin\FamilyTreesController@getcodes_notin_child')->name('admin.family-trees.getcodes-notin-child');
Route::resource('admin/family-trees', 'Admin\FamilyTreesController', [ 'except' => [ 'create', 'edit', 'update', 'show' ], 'as' => 'admin' ] );
// Members and Departments Mapping
Route::get('admin/member-dept-map', 'Admin\AdminPagesController@memberDeptMap')->name('admin.member-dept.map');
Route::get('admin/getCodesNotInChildByMDMap', 'Admin\MemDeptMapsController@getcodes_notin_child')->name('admin.member-dept-trees.getcodes-notin-child');
Route::get('admin/getMembersByDepartmentId', 'Admin\MemDeptMapsController@getMembersByDepartmentId')->name('admin.member-dept-trees.getmembers-department');
Route::get('admin/getMembersNotAssignedCell', 'Admin\MemDeptMapsController@getMembersNotAssignedCell')->name('admin.member-dept-trees.getmembers-notassigned');
Route::get('admin/getMembersNotAssignedDept', 'Admin\MemDeptMapsController@getMembersNotAssignedDept')->name('admin.member-dept-trees.getmembers-notbelongin_dept');
Route::resource('admin/member-dept-trees', 'Admin\MemDeptMapsController', [ 'except' => [ 'create', 'edit', 'show' ], 'as' => 'admin' ] );
// Image Upload
Route::post('admin/photo-crop', 'Admin\AdminPagesController@photoCropPost')->name('admin.photo-crop.post');
// Cell, Department Organizer
Route::get('admin/cell-orginizer', 'Admin\AdminPagesController@cellOrginizer')->name('admin.cell.orginizer');
Route::get('admin/dept-orginizer', 'Admin\AdminPagesController@departmentOrginizer')->name('admin.dept.orginizer');
// Route for export/download tabledata to .csv, .xls or .xlsx
Route::get('admin/exportCategories', 'Admin\ExportsController@exportCategories')->name('admin.export.categories');
Route::get('admin/exportCodes', 'Admin\ExportsController@exportCodes')->name('admin.export.codes');
Route::get('admin/exportPrivileges', 'Admin\ExportsController@exportPrivileges')->name('admin.export.privileges');
Route::get('admin/exportRoles', 'Admin\ExportsController@exportRoles')->name('admin.export.roles');
Route::get('admin/exportUsers', 'Admin\ExportsController@exportUsers')->name('admin.export.users');
Route::get('admin/exportLogs', 'Admin\ExportsController@exportLogs')->name('admin.export.logs');
Route::get('admin/exportMembers', 'Admin\ExportsController@exportMembers')->name('admin.export.members');
Route::get('admin/exportPrivilegeRoleMaps', 'Admin\ExportsController@exportPrivilegeRoleMaps')->name('admin.export.privilegerolemaps');
Route::get('admin/exportDepartmentTrees', 'Admin\ExportsController@exportDepartmentTrees')->name('admin.export.departmenttrees');
Route::get('admin/exportFamilyTrees', 'Admin\ExportsController@exportFamilyTrees')->name('admin.export.familytrees');
Route::get('admin/exportMemDeptMaps', 'Admin\ExportsController@exportMemDeptMaps')->name('admin.export.memdeptmaps');

/*
|--------------------------------------------------------------------------
| MEMBER LIST RESTFUL API
|--------------------------------------------------------------------------
*/
/**
 * Method: GET
 * URL: /okcc/memberList/categories: Retrieve search categories
 */
Route::resource('okcc/memberList/categories', 'Rest\MemberList\CategoryController')->only([
    'index'
])->middleware('auth');

/**
 * Method: GET
 * URL: /okcc/memberList/member/{id}: Retrieve all information for the given member
 * 
 */
Route::resource('okcc/memberList/member', 'Rest\MemberList\MemberController')->only([
    'show'
])->middleware('auth');
/**
 * Method: GET
 * URL: /okcc/memberList/memberList: Retrieve all members
 * URL: /okcc/memberList/memberList/{code}: Retrieve members who matched the code
 * 
 */
Route::resource('okcc/memberList/memberList', 'Rest\MemberList\MemberListController')->only([
    'index', 'show'
])->middleware('auth');

/**
 * Method: GET
 * URL: /okcc/memberList/search/{searchString}: Retrieve members who matched the string
 * 
 */
Route::resource('okcc/memberList/search', 'Rest\MemberList\SearchController')->only([
    'show'
])->middleware('auth');

/**
 * Method: GET
 * URL: /okcc/memberList/settings: Retrieve memberList settings (landing page bookmark,
 *                                 table column info)
 * 
 */
Route::get('okcc/memberList/settings', 'Rest\MemberList\MemberListController@getSettings')->middleware('auth');

/**
 * Method: GET
 * URL: /okcc/util/adduser/{id}/{password}: Add new user
 * This temporary restful api, and it will be removed later
 * 
 */
Route::get('okcc/util/adduser/{id}/{password}', 'Rest\Util\UtilsController@addUser');

/*
|--------------------------------------------------------------------------
| Localization for Javascript
| This code is from 
| https://medium.com/@serhii.matrunchyk/using-laravel-localization-with-javascript-and-vuejs-23064d0c210e
|--------------------------------------------------------------------------
*/
Route::get('/js/lang.js', function () {
    $strings = Cache::rememberForever('lang.js', function () {
        $lang = config('app.locale');

        $files   = glob(resource_path('lang/' . $lang . '/*.php'));
        $strings = [];

        foreach ($files as $file) {
            $name           = basename($file, '.php');
            $strings[$name] = require $file;
        }

        return $strings;
    });

    header('Content-Type: text/javascript');
    echo('window.i18n = ' . json_encode($strings) . ';');
    exit();
})->name('assets.lang');
