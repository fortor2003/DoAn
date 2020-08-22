<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/** XacThucController  */
Route::get('/dang-nhap', 'XacThucController@dangNhapPage')->name('khachHang.dangNhapPage');
Route::post('/dang-nhap', 'XacThucController@dangNhap')->name('khachHang.dangNhap');
Route::post('/dang-xuat', 'XacThucController@dangXuat')->name('khachHang.dangXuat');
Route::get('/dang-ky', 'XacThucController@dangKyPage')->name('khachHang.dangKyPage');
Route::post('/dang-ky', 'XacThucController@dangKy')->name('khachHang.dangKy');
Route::get('/kich-hoat-tai-khoan', 'XacThucController@kichHoatTaiKhoan')->name('khachHang.kichHoatTaiKhoan');
Route::get('/quen-mat-khau', 'XacThucController@quenMatKhauPage')->name('khachHang.quenMatKhauPage');
Route::post('/quen-mat-khau', 'XacThucController@quenMatKhau')->name('khachHang.quenMatKhau');
Route::get('/tao-lai-mat-khau', 'XacThucController@taoLaiMatKhauPage')->name('khachHang.taoLaiMatKhauPage');
Route::post('/tao-lai-mat-khau', 'XacThucController@taoLaiMatKhau')->name('khachHang.taoLaiMatKhau');
/** PageController  */
Route::get('/', 'PageController@trangChuPage')->name('khachHang.trangChuPage');
Route::get('/thong-tin-chi-tiet-phim/{id}', 'PageController@chiTietPhimPage')->name('khachHang.chiTietPhimPage');
Route::get('/dat-ve', 'PageController@datVePage')->name('khachHang.datVePage');
Route::get('/dat-ghe', 'PageController@datGhePage')->name('khachHang.datGhePage');
Route::post('/thanh-toan', 'PageController@thanhToanPage')->name('khachHang.thanhToanPage');
Route::post('/xac-nhan-thanh-toan', 'PageController@xacNhanThanhToanPage')->name('khachHang.xacNhanThanhToanPage');
Route::get('/hien-thi-ve', 'PageController@hienThiVePage')->name('khachHang.hienThiVePage');
Route::get('/thong-diep', 'PageController@thongDiepPage')->name('khachHang.thongDiepPage');

Route::get('/test', function () {

    dump();
    return view('khachHang.pages.testPage');
});

Route::get('/trigger-event', function () {
//    broadcast(new \App\Events\khachHang\TaoDonDatVeEvent());
    \App\Jobs\KhachHang\XuLyDonDatVeJob::dispatch()->delay(now()->addSeconds(10));
    return 'Ok';
});
