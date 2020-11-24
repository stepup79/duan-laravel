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

Route::get('xin-chao', 'ExampleController@hello');
Route::get('tam-biet', 'ExampleController@goodbye');

Route::get('gioi-thieu', 'ExampleController@gioithieu');
Route::get('ds-nhanvien', 'ExampleController@danhsachnhanvien');

