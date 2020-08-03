<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SuatChieu extends Migration
{
    // Tên table trong cơ sở dữ liệu
    private $ten_bang = 'SUAT_CHIEU';
    private $chu_thich_bang = 'suất chieu';

    public function up()
    {
        // Tạo cấu trúc của bảng
        Schema::create($this->ten_bang, function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->bigInteger('phim_id')->nullable();
            $table->bigInteger('phong_chieu_id')->nullable();
            $table->dateTime('gio_bat_dau')->nullable();
            $table->dateTime('gio_ket_thuc')->nullable();

            $table->dateTime('thoiDiemTao')->useCurrent();
            $table->dateTime('thoiDiemCapNhat')->useCurrent();


        });
        // Tạo comment cho bảng
//        DB::statement("ALTER TABLE `$this->ten_bang` comment '$this->chu_thich_bang'");
    }

    public function down()
    {
        Schema::drop($this->ten_bang);
    }
}
