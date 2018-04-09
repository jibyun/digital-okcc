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

Route::get('/', function () {
    return view('index');
})->middleware('auth');;



/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
*/
Route::get('admin', 'AdminPagesController@index')->name('admin'); // Index page

/*
|--------------------------------------------------------------------------
| Admin Subpages' Routes
|--------------------------------------------------------------------------
*/
Route::get('categoryStart', 'Admin\Code_CategoriesController@start')->name('categoryStart');
Route::get('getCategories', 'Admin\Code_CategoriesController@get_categories')->name('getCategories');
Route::resource('categories', 'Admin\Code_CategoriesController', [ 'only' => [ 'start', 'index', 'store', 'update', 'destroy' ] ] );