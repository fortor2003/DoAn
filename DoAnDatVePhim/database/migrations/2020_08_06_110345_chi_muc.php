<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChiMuc extends Migration
{

    public function up()
    {
        /*****************      Chỉ mục Unique      ********************/
        // RAP
        Schema::table('RAP', function (Blueprint $table) {
            $table->unique('ten_rap');
        });
        // PHONG_CHIEU
        Schema::table('PHONG_CHIEU', function (Blueprint $table) {
            $table->unique(['rap_id', 'ten_phong']);
        });
        // GHE
        Schema::table('GHE', function (Blueprint $table) {
            $table->unique(['phong_chieu_id', 'ma_hang', 'thu_tu_trong_hang']);
        });
        // THE_LOAI
        Schema::table('THE_LOAI', function (Blueprint $table) {
            $table->unique('ten_the_loai');
        });
        // PHIM
        Schema::table('PHIM', function (Blueprint $table) {
            $table->unique('ten_phim');
        });
        // PHIM_THE_LOAI
        Schema::table('PHIM_THE_LOAI', function (Blueprint $table) {
            $table->unique(['phim_id', 'the_loai_id']);
        });
        // KHUNG_THOI_GIAN
        Schema::table('KHUNG_THOI_GIAN', function (Blueprint $table) {
            $table->unique('thoi_gian');
        });
        // KHUNG_THOI_GIAN
        Schema::table('KHUNG_THOI_GIAN', function (Blueprint $table) {
            $table->unique('thoi_gian');
        });
        // SUAT_CHIEU
        Schema::table('SUAT_CHIEU', function (Blueprint $table) {
            $table->unique(['phim_id', 'phong_chieu_id', 'ngay_chieu', 'gio_bat_dau_id']);
        });
        // VAI_TRO
        Schema::table('VAI_TRO', function (Blueprint $table) {
            $table->unique('ma_vai_tro');
        });
        // TAI_KHOAN
        Schema::table('TAI_KHOAN', function (Blueprint $table) {
            $table->unique(['email', 'vai_tro_id']);
        });
        // VE
        Schema::table('VE', function (Blueprint $table) {
            $table->unique('ma_ve');
            $table->unique(['suat_chieu_id', 'ghe_id']);
        });
    }

    public function down()
    {
        //
    }
}
