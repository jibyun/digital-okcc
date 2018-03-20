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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/test', 'TestController@index')->name('test');

Route::get('/test/test2', 'TestController@test2')->name('test.test2');


Route::get('/abc', 'AbcController@index')->name('abc');



