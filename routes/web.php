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

Route::get('test-dataloai', 'LoaiController@getdataloai');
Route::get('test-datavanchuyen', 'VanchuyenController@getdatavanchuyen');
Route::get('test-datasanpham', 'LoaiController@getdatasanpham');

Route::get('test-layoutbackend', function () {
    return view('example.layoutsbackend');
});

// Chức năng Loại
Route::get('admin/loai', 'Backend\LoaiController@index') ->name('admin.loai.index');
Route::get('admin/loai/create', 'Backend\LoaiController@create') ->name('admin.loai.create');
Route::post('admin/loai/store', 'Backend\LoaiController@store') ->name('admin.loai.store');

Route::get('admin/loai/edit/{id}', 'Backend\LoaiController@edit') ->name('admin.loai.edit');
Route::put('admin/loai/edit/{id}', 'Backend\LoaiController@update') ->name('admin.loai.update');
Route::delete('admin/loai/delete/{id}', 'Backend\LoaiController@destroy') ->name('admin.loai.destroy');
Route::get('admin/loai/pdf', 'Backend\LoaiController@pdf') ->name('admin.loai.pdf');

//Tạo các route CRUD
Route::get('admin/sanpham/print', 'Backend\SanPhamController@print') ->name('admin.sanpham.print');
Route::get('admin/sanpham/excel', 'Backend\SanPhamController@excel') ->name('admin.sanpham.excel');
Route::get('admin/sanpham/pdf', 'Backend\SanPhamController@pdf') ->name('admin.sanpham.pdf');
Route::resource('/admin/sanpham', 'Backend\SanPhamController', ['as' => 'admin']);//đặt tên admin

// Gọi hàm đăng ký các route dành cho Quản lý Xác thực tài khoản (Đăng nhập, Đăng xuất, Đăng ký)
// các route trong file `vendor\laravel\framework\src\Illuminate\Routing\Router.php`, hàm auth()
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/testbcrypt', function () {
    return bcrypt('123456');
});


