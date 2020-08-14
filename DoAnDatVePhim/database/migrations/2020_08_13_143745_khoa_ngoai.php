<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KhoaNgoai extends Migration
{


    public function up()
    {
        // Bảng phòng chiếu
        Schema::table('PHONG_CHIEU', function (Blueprint $table) {
            $table->foreign('rap_id')->references('id')->on('RAP');
        });

        // Bảng ghế
        Schema::table('GHE', function (Blueprint $table) {
            $table->foreign('phong_chieu_id')->references('id')->on('PHONG_CHIEU');
        });

        // Bảng phim thể loại
        Schema::table('PHIM_THE_LOAI', function (Blueprint $table) {
            $table->foreign('phim_id')->references('id')->on('PHIM');
            $table->foreign('the_loai_id')->references('id')->on('THE_LOAI');
        });

        // Bảng suất chiếu
        Schema::table('SUAT_CHIEU', function (Blueprint $table) {
            $table->foreign('phim_id')->references('id')->on('PHIM');
            $table->foreign('phong_chieu_id')->references('id')->on('PHONG_CHIEU');
            $table->foreign('gio_bat_dau_id')->references('id')->on('KHUNG_THOI_GIAN');
            $table->foreign('gio_ket_thuc_id')->references('id')->on('KHUNG_THOI_GIAN');
        });

        // Bảng vé
        Schema::table('VE', function (Blueprint $table) {
            $table->foreign('suat_chieu_id')->references('id')->on('SUAT_CHIEU');
            $table->foreign('ghe_id')->references('id')->on('GHE');
            $table->foreign('khach_hang_id')->references('id')->on('TAI_KHOAN');
            $table->foreign('nhan_vien_id')->references('id')->on('TAI_KHOAN');
        });

        // Bảng xác thục url
        Schema::table('XAC_THUC_URL', function (Blueprint $table) {
            $table->foreign('tai_khoan_id')->references('id')->on('TAI_KHOAN');
        });
    }

    public function down()
    {

    }
}
