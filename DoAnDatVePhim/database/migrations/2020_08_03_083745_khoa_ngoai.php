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
            //khóa
            $table->foreign('phim_id')->references('id')->on('PHIM');
            $table->foreign('the_loai_id')->references('id')->on('THE_LOAI');
        });

        // Bảng suất chiếu
        Schema::table('SUAT_CHIEU', function (Blueprint $table) {
            $table->foreign('phim_id')->references('id')->on('PHIM');
            $table->foreign('phong_chieu_id')->references('id')->on('PHONG_CHIEU');
        });
        

        // Bảng tài khoản
        Schema::table('TAI_KHOAN', function (Blueprint $table) {
            $table->foreign('quyen_hang_id')->references('id')->on('QUYEN_HANG');
        });

        // Bảng vé
        Schema::table('VE', function (Blueprint $table) {
            $table->foreign('suat_chieu_id')->references('id')->on('SUAT_CHIEU');
            $table->foreign('ghe_id')->references('id')->on('GHE');
            $table->foreign('nguoi_mua_id')->references('id')->on('TAI_KHOAN');
            $table->foreign('nguoi_ban_id')->references('id')->on('TAI_KHOAN');
        });




    }

    public function down()
    {

    }
}
