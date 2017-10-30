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

Route::get('/monitor/index', 'Index\MonitorController@index');

/*后台*/
Route::get('manage/index', 'Manage\IndexController@index');
Route::post('manage/login', 'Manage\IndexController@login');

Route::get('manage/news', 'Manage\NewsController@index');
Route::post('manage/news', 'Manage\NewsController@index');

Route::get('manage/manager', 'Manage\ManagerController@index');
Route::post('manage/manager', 'Manage\ManagerController@index');

Route::get('manage/setting', 'Manage\SettingController@index');
Route::post('manage/setting', 'Manage\SettingController@index');

Route::post('manage/upload', 'Manage\UploadController@index');