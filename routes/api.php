<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/**
 * Method: GET
 * URL: /api/okcc/memberList/categories: Retrieve search categories
 */
Route::apiResource('okcc/memberList/categories', 'API\MemberList\CategoryController')->only([
    'index'
]);
/**
 * Method: GET
 * URL: /api/okcc/memberList/member/{id}: Retrieve all information for the given member
 * 
 */
Route::apiResource('okcc/memberList/member', 'API\MemberList\MemberController')->only([
    'show'
]);;
/**
 * Method: GET
 * URL: /api/okcc/memberList/memberList: Retrieve all members
 * URL: /api/okcc/memberList/memberList/{code}: Retrieve members who matched the code
 * 
 */
Route::apiResource('okcc/memberList/memberList', 'API\MemberList\MemberListController')->only([
    'index', 'show'
]);
/**
 * Method: GET
 * URL: /api/okcc/memberList/search/{searchString}: Retrieve members who matched the string
 * 
 */
Route::apiResource('okcc/memberList/search', 'API\MemberList\SearchController')->only([
    'show'
]);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
