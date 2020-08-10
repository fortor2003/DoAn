<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PageController@trangChuPage')->name('khachHang.trangChuPage');

Route::get('/dang-nhap', 'PageController@trangChuPage')->name('khachHang.dangNhapPage');

Route::get('/thong-tin-chi-tiet-phim/{id}', 'PageController@chiTietPhimPage')->name('khachHang.chiTietPhimPage');


Route::get('/test-login', function () {
    if (\Illuminate\Support\Facades\Auth::attempt(['email' => 'khachhang5@example.com', 'password' => 'khachhang5'])) {
        echo 'dang nhập thành công';
    }
    dump(\Illuminate\Support\Facades\Auth::check());
    dump(\Illuminate\Support\Facades\Auth::user());
});
Route::get('/test-logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    dump(\Illuminate\Support\Facades\Auth::check());
    dump(\Illuminate\Support\Facades\Auth::user());
});


Route::get('/test-profile', function () {
    dump(\Illuminate\Support\Facades\Auth::user());
    dump(\Illuminate\Support\Facades\Session::all());
});


