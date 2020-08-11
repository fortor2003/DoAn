<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PageController@trangChuPage')->name('khachHang.trangChuPage');

Route::get('/dang-nhap', 'XacThucController@dangNhapPage')->name('khachHang.dangNhapPage');

Route::get('/thong-tin-chi-tiet-phim/{id}', 'PageController@chiTietPhimPage')->name('khachHang.chiTietPhimPage');

Route::get('/dat-ve', 'PageController@datVePage')->name('khachHang.datVePage');

Route::get('/dat-ghe', 'PageController@datGhePage')->name('khachHang.datGhePage');

Route::get('/thanh-toan', 'PageController@thanhToanPage')->name('khachHang.thanhToanPage');

Route::get('/hien-thi-ve', 'PageController@hienThiVePage')->name('khachHang.hienThiVePage');


