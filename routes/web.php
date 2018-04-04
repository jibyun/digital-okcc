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
});


/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for Admin OCO application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/
Route::get('admin', 'AdminPagesController@index')->name('admin'); // Index page

