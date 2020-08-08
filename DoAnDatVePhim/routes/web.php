<?php

use Illuminate\Support\Facades\Route;


Route::get('/aaaa', 'khachHang\PageController@trangChu');
////////////Người dùng
//Trang chủ
Route::get('/', function (){
    return view('nguoidung.page.trangChinhPage');
});
//đăng nhập
Route::get('/dang-nhap', function (){
    return view('nguoidung.page.dangNhapPage');
});
//Chi tiết phim
Route::get('/chi-tiet/{idPhim}', function ($idPhim){
    return view('nguoidung.page.chiTietPhimPage');
});
