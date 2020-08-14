<?php

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
/** PageController  */
Route::get('/', 'PageController@trangChuPage')->name('khachHang.trangChuPage');
Route::get('/thong-tin-chi-tiet-phim/{id}', 'PageController@chiTietPhimPage')->name('khachHang.chiTietPhimPage');
Route::get('/dat-ve', 'PageController@datVePage')->name('khachHang.datVePage');
Route::get('/dat-ghe', 'PageController@datGhePage')->name('khachHang.datGhePage');
Route::get('/thanh-toan', 'PageController@thanhToanPage')->name('khachHang.thanhToanPage');
Route::get('/hien-thi-ve', 'PageController@hienThiVePage')->name('khachHang.hienThiVePage');
Route::get('/thong-diep', 'PageController@thongDiepPage')->name('khachHang.thongDiepPage');


Route::get('/test', function () {
    return redirect(\route('khachHang.thongDiepPage', ['message' => 'avascascasc']));
    dump(\route('khachHang.thongDiepPage', ['message' => 'avascascasc']));
//    return (new \App\Mail\khachHang\KichHoatTaiKhoanMail('http://example.com'))->to('abc@gmail.com');
});
