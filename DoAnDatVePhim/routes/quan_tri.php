<?php

use Illuminate\Support\Facades\Route;


/** PageController  */
Route::get('/', 'AdminController@trangChuPage')->name('quanTri.trangChuPage');
Route::get('/tim-kiem', 'AdminController@timKiemPage')->name('quanTri.timKiemPage');
