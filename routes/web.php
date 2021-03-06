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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', 'Index\IndexController@index');

Route::get('manage/index', 'Manage\IndexController@index');
Route::get('manage/login', 'Manage\IndexController@login');
Route::post('manage/dologin', 'Manage\IndexController@doLogin');

Route::get('manage/news', 'Manage\NewsController@index');
Route::get('manage/news/add/{id?}', 'Manage\NewsController@add');
Route::get('manage/news/data', 'Manage\NewsController@data');

Route::get('manage/cate', 'Manage\CateController@index');
Route::get('manage/cate/add/{id?}', 'Manage\CateController@add');
Route::get('manage/cate/data', 'Manage\CateController@data');
Route::post('manage/cate/add', 'Manage\CateController@add');

Route::post('manage/upload', 'Manage\UploadController@index');