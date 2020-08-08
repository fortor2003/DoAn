<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PageController@trangChuPage')->name('khachHang.trangChuPage');

Route::get('/dang-nhap', 'PageController@trangChuPage')->name('khachHang.dangNhapPage');

Route::get('/chi-tiet/{id}', 'PageController@chiTietPhimPage')->name('khachHang.chiTietPhimPage');
