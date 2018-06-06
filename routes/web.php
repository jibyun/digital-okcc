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
// Change password Route
Route::get('/changePassword', 'Auth\ChangePasswordController@showChangePasswordForm')->name('changePasswordForm');
Route::post('/changePassword','Auth\ChangePasswordController@changePassword')->name('changePassword');

Route::get('/', 'MainController@index')->middleware('auth');
// memberList Landing page
Route::get('/memberList', 'MainController@memberList')->middleware('auth')->name('memberList');
Route::get('menu', 'MenuController@getMenu')->name('getmenu');

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
*/
Route::get('admin', 'Admin\AdminPagesController@index')->name('admin'); // Index page
Route::get('admin/users', 'Admin\AdminPagesController@users')->name('admin.users'); // Users landing page
Route::get('admin/members', 'Admin\AdminPagesController@members')->name('admin.members'); // Members landing page
Route::get('admin/finances', 'Admin\AdminPagesController@finances')->name('admin.finances'); // Finances landing page
Route::get('admin/inventories', 'Admin\AdminPagesController@inventories')->name('admin.inventories'); // Inventories landing page
Route::get('admin/tests', 'Admin\AdminPagesController@tests')->name('admin.tests'); // Inventories landing page


/*
|--------------------------------------------------------------------------
| Admin Subpages' Routes
|--------------------------------------------------------------------------
*/
// Categories CRUD
Route::get('admin/members/categoryStart', 'Admin\AdminPagesController@categoryStart')->name('admin.categories.start');
Route::get('admin/members/getCategories', 'Admin\Code_CategoriesController@get_categories')->name('admin.categories.getCategories');
Route::resource('admin/members/categories', 'Admin\Code_CategoriesController', [ 'except' => [ 'create', 'show', 'edit' ], 'as' => 'admin' ] );
// Codes CRUD
Route::get('admin/members/codeStart', 'Admin\AdminPagesController@codeStart')->name('admin.codes.start');
Route::get('admin/members/getCodes', 'Admin\CodesController@get_codes')->name('admin.code.getCodes');
Route::get('admin/members/getCodesByCategoryIds', 'Admin\CodesController@getCodesByCategoryIds')->name('admin.code.getCodesByCategoryIds');
Route::resource('admin/members/codes', 'Admin\CodesController', [ 'except' => [ 'create', 'show', 'edit' ], 'as' => 'admin' ] );
// Members CRUD
Route::get('admin/members/memberStart', 'Admin\AdminPagesController@memberStart')->name('admin.members.start');
Route::resource('admin/members/members', 'Admin\MembersController', [ 'except' => [ 'create', 'show', 'edit' ], 'as' => 'admin' ] );
// Privileges CRUD
Route::get('admin/users/privilegeStart', 'Admin\AdminPagesController@privilegeStart')->name('admin.privileges.start');
Route::resource('admin/users/privileges', 'Admin\PrivilegesController', [ 'except' => [ 'create', 'show', 'edit' ], 'as' => 'admin' ] );
// Roles CRUD
Route::get('admin/users/roleStart', 'Admin\AdminPagesController@roleStart')->name('admin.roles.start');
Route::get('admin/users/getRolesNotInMap', 'Admin\RolesController@getroles_notin_map')->name('admin.roles.getroles-notin-map');
Route::resource('admin/roles', 'Admin\RolesController', [ 'except' => [ 'create', 'show', 'edit' ], 'as' => 'admin' ] );
// Privileges and Roles Mapping
Route::get('admin/users/privileges-roles', 'Admin\AdminPagesController@privileges_roles_map')->name('admin.privileges-roles.map');
Route::resource('admin/users/p-role-map', 'Admin\Privilege_Role_MapsController', [ 'except' => [ 'create', 'edit', 'update', 'show' ], 'as' => 'admin' ] );
// Users Registration 
Route::get('admin/users/users-regist', 'Admin\AdminPagesController@users_list')->name('admin.users.regist');
Route::get('admin/users/get-users', 'Admin\UsersController@getUsers')->name('admin.users.get-users');
Route::get('admin/users/getCurrentUsers', 'Admin\UsersController@getCurrentUsers')->name('admin.users.get-current-users');
Route::resource('admin/users/users', 'Admin\UsersController', [ 'except' => [ 'store', 'create', 'edit', 'show' ], 'as' => 'admin' ] );
// Log View
Route::get('admin/users/log-view', 'Admin\AdminPagesController@logView')->name('admin.log.view');
Route::get('admin/users/getLog', 'Admin\LogController@getLog')->name('admin.log.get');
// Department code Tree mapping
Route::get('admin/members/dept-tree-map', 'Admin\AdminPagesController@departmentTree')->name('admin.dept-tree.map');
Route::get('admin/members/getCodesNotInChild', 'Admin\DepartmentTreesController@getcodes_notin_child')->name('admin.department-trees.getcodes-notin-child');
Route::resource('admin/members/department-trees', 'Admin\DepartmentTreesController', [ 'except' => [ 'create', 'edit', 'update', 'show' ], 'as' => 'admin' ] );
// Family Mapping
Route::get('admin/members/family-map', 'Admin\AdminPagesController@familyTree')->name('admin.family.map');
Route::get('admin/members/getCodesNotInChildByFamily', 'Admin\FamilyTreesController@getcodes_notin_child')->name('admin.family-trees.getcodes-notin-child');
Route::resource('admin/members/family-trees', 'Admin\FamilyTreesController', [ 'except' => [ 'create', 'edit', 'update', 'show' ], 'as' => 'admin' ] );
// Members and Departments Mapping
Route::get('admin/members/member-dept-map', 'Admin\AdminPagesController@memberDeptMap')->name('admin.member-dept.map');
Route::get('admin/members/getCodesNotInChildByMDMap', 'Admin\MemDeptMapsController@getcodes_notin_child')->name('admin.member-dept-trees.getcodes-notin-child');
Route::get('admin/members/getMembersByDepartmentId', 'Admin\MemDeptMapsController@getMembersByDepartmentId')->name('admin.member-dept-trees.getmembers-department');
Route::get('admin/members/getMembersNotAssignedCell', 'Admin\MemDeptMapsController@getMembersNotAssignedCell')->name('admin.member-dept-trees.getmembers-notassigned');
Route::get('admin/members/getMembersNotAssignedDept', 'Admin\MemDeptMapsController@getMembersNotAssignedDept')->name('admin.member-dept-trees.getmembers-notbelongin_dept');
Route::resource('admin/members/member-dept-trees', 'Admin\MemDeptMapsController', [ 'except' => [ 'create', 'edit', 'show' ], 'as' => 'admin' ] );
// Contact Email
Route::post('admin/sendContactEmail', 'Admin\AdminPagesController@sendContactEmail')->name('admin.send.contactemail'); 
// Tests
Route::get('admin/tests/toolbarTest', 'Admin\AdminPagesController@toolbarTest')->name('admin.tests.toolbar'); 
Route::get('admin/tests/searchTest', 'Admin\AdminPagesController@searchTest')->name('admin.tests.search'); 

// Image Upload
Route::post('admin/members/photo-crop', 'Admin\AdminPagesController@photoCropPost')->name('admin.photo-crop.post');
// Cell, Department Organizer
Route::get('admin/members/cell-orginizer', 'Admin\AdminPagesController@cellOrginizer')->name('admin.cell.orginizer');
Route::get('admin/members/dept-orginizer', 'Admin\AdminPagesController@departmentOrginizer')->name('admin.dept.orginizer');
// Route for export/download tabledata to .csv, .xls or .xlsx
Route::get('admin/members/exportCategories', 'Admin\ExportsController@exportCategories')->name('admin.export.categories');
Route::get('admin/members/exportCodes', 'Admin\ExportsController@exportCodes')->name('admin.export.codes');
Route::get('admin/members/exportPrivileges', 'Admin\ExportsController@exportPrivileges')->name('admin.export.privileges');
Route::get('admin/members/exportRoles', 'Admin\ExportsController@exportRoles')->name('admin.export.roles');
Route::get('admin/members/exportUsers', 'Admin\ExportsController@exportUsers')->name('admin.export.users');
Route::get('admin/members/exportLogs', 'Admin\ExportsController@exportLogs')->name('admin.export.logs');
Route::get('admin/members/exportMembers', 'Admin\ExportsController@exportMembers')->name('admin.export.members');
Route::get('admin/members/exportPrivilegeRoleMaps', 'Admin\ExportsController@exportPrivilegeRoleMaps')->name('admin.export.privilegerolemaps');
Route::get('admin/members/exportDepartmentTrees', 'Admin\ExportsController@exportDepartmentTrees')->name('admin.export.departmenttrees');
Route::get('admin/members/exportFamilyTrees', 'Admin\ExportsController@exportFamilyTrees')->name('admin.export.familytrees');
Route::get('admin/members/exportMemDeptMaps', 'Admin\ExportsController@exportMemDeptMaps')->name('admin.export.memdeptmaps');

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
 * URL: /okcc/memberList/export: Export table data
 * Body : JSON
 *        filename: Save file name
 *        type : excel/pdf - We support excel only
 *        tablename: table name to export
 *        field: field name to export
 * 
 */
Route::get('okcc/memberList/export', 'Rest\MemberList\ExportController@export')->middleware('auth')->name('memberlist.export');

/**
 * Method: GET/POST/PUT/DELETE
 * URL: /okcc/memberList/memberHistory: 
 * 
 */
Route::get('okcc/memberList/memberHistory/{memberid}', 'Rest\MemberList\MemberHistoryController@list')->middleware('auth');
Route::resource('okcc/memberList/memberHistory', 'Rest\MemberList\MemberHistoryController')->middleware('auth')->only(['store', 'update', 'destroy']);

/**
 * Method: GET/POST/PUT/DELETE
 * URL: /okcc/memberList/memberVisit: 
 * 
 */
Route::get('okcc/memberList/memberVisit/{memberid}', 'Rest\MemberList\MemberVisitController@list')->middleware('auth');
Route::resource('okcc/memberList/memberVisit', 'Rest\MemberList\MemberVisitController')->middleware('auth')->only(['store', 'update', 'destroy']);

/**
 * Method: GET
 * URL: /okcc/util/adduser/{id}/{password}: Add new user
 * This temporary restful api, and it will be removed later
 * 
 */
Route::get('okcc/util/adduser/{id}/{password}', 'Rest\Util\UtilsController@addUser');


/*
* Method: GET
* URL: /okcc/member/getMembers: Retrieve member
*/
Route::get('okcc/member/getMember/{id}', 'Rest\MemberList\MemberController@show')->middleware('auth');

/*
* Method: GET
* URL: /okcc/member/getCategory: Retrieve category+code
*/
Route::get('okcc/member/getCategory', 'Rest\MemberList\MemberController@getCategory')->middleware('auth');

/*
* Method: POST
* URL: /okcc/member/edit: edit member
*/
Route::post('okcc/member/edit/{id}', 'Rest\MemberList\MemberController@edit')->middleware('auth');


/*
|--------------------------------------------------------------------------
| Localization for Javascript
| This code is from 
| https://medium.com/@serhii.matrunchyk/using-laravel-localization-with-javascript-and-vuejs-23064d0c210e
|--------------------------------------------------------------------------
*/
Route::get('/js/lang.js', 'MainController@language')->name('assets.lang');

