<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PageController@trangChuPage')->name('khachHang.trangChuPage');

Route::get('/dang-nhap', 'PageController@trangChuPage')->name('khachHang.dangNhapPage');

Route::get('/thong-tin-chi-tiet-phim/{id}', 'PageController@chiTietPhimPage')->name('khachHang.chiTietPhimPage');

Route::get('/test', function () {
    return view('khachHang.pages.testPage');
});
