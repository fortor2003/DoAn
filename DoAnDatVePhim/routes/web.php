<?php

use Illuminate\Support\Facades\Route;



////////////Người dùng
//Trang chủ
Route::get('/', 'khachHang\PageController@trangChu');
//đăng nhập
Route::get('/dang-nhap', function (){
    return view('nguoidung.page.dangNhapPage');
});
//Chi tiết phim
Route::get('/chi-tiet/{idPhim}', function ($idPhim){
    return view('nguoidung.page.chiTietPhimPage');
});
