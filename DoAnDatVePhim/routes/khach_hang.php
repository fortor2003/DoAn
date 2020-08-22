<?php

use App\Models\DonDatVe;
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
Route::post('/xac-nhan-thanh-toan', 'PageController@xacNhanThanhToanPage')->name('khachHang.xacNhanThanhToanPage');
Route::post('/tao-don-dat-ve', 'PageController@taoDonDatVe')->name('khachHang.taoDonDatVe');
Route::get('/don-dat-ve', 'PageController@donDatVePage')->name('khachHang.donDatVePage');
Route::get('/don-dat-ve/{donDatVe}', 'PageController@chiTietDonDatVePage')->name('khachHang.chiTietDonDatVePage');


Route::get('/hien-thi-ve', 'PageController@hienThiVePage')->name('khachHang.hienThiVePage');
Route::get('/thong-diep', 'PageController@thongDiepPage')->name('khachHang.thongDiepPage');

Route::get('/test', function () {
    broadcast(new \App\Events\khachHang\TaoDonDatVeEvent(457));
    return view('khachHang.pages.testPage');
});

Route::get('/trigger-event', function () {
//    broadcast(new \App\Events\khachHang\TaoDonDatVeEvent());
    \App\Jobs\KhachHang\XuLyDonDatVeJob::dispatch()->delay(now()->addSeconds(10));
    return 'Ok';
});
