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

Route::get('index', 'Manage\IndexController@index');

Route::get('cate', 'Manage\CateController@index');
Route::get('cate/add/{id?}', 'Manage\CateController@add');
Route::get('cate/test', 'Manage\CateController@test');