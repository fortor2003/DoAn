<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Phim extends Migration
{
    // Tên table trong cơ sở dữ liệu
    private $ten_bang = 'PHIM';
    private $chu_thich_bang = 'phim';

    public function up()
    {
        // Tạo cấu trúc của bảng
        Schema::create($this->ten_bang, function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->string('ten_phim')->nullable();
            $table->bigInteger('phim_the_loai_id')->nullable();
            $table->dateTime('ngay_khoi_chieu')->nullable();
            $table->dateTime('ngay_ket_thuc')->nullable();
            $table->string('mo_ta')->nullable();

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
