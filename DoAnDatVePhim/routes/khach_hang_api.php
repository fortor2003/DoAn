<?php

use Illuminate\Support\Facades\Route;

/**
 * @urlParam phim required id của phim
 * @queryParam rap_id Lọc theo id của rạp, nếu để trống thì lấy tất cả rạp
 * @queryParam ngay_chieu Lọc theo ngày chiếu, nếu để trống thì lấy ngày hiện tại [có dạng yyyy-mm-dd]
 * @response [
 *  {
 *      "id": 3,
 *      "ten_rap": "Rạp 0",
 *      "danh_sach_suat_chieu": [
 *          {
 *              "id": 26,
 *              "gio_bat_dau_slot": "108",
 *              "laravel_through_key": "3",
 *              "khung_thoi_gian_gio_bat_dau": {
 *                  "slot": "108",
 *                  "thoi_gian": "09:00"
 *               }
 *          }
 *      ]
 *  }]
 */
Route::get('phim/{phim}/suat-chieu', 'ApiController@danhSachSuatChieu');
Route::get('suat-chieu/{suatChieu}/ghe', 'ApiController@danhSachGheTheoSuatChieu');




Route::get('test-dang-nhap', function () {
    $taiKhoan = \App\Models\TaiKhoan::findOrFail(1);
    return $taiKhoan->createToken('KHACHHANG_DANGNHAP')->plainTextToken;
});
