<?php

use Illuminate\Support\Facades\Route;


Route::get('/aaaa', 'khachHang\PageController@trangChu');
////////////Người dùng
//Trang chủ
Route::get('/', function (){
    return view('nguoidung.page.trangChinhPage');
});
