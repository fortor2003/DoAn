<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Rap extends Migration
{
    // Tên table trong cơ sở dữ liệu
    private $ten_bang = 'RAP';

    public function up()
    {
        // Tạo cấu trúc của bảng
        Schema::create($this->ten_bang, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten_rap', 100);
            $table->string('dia_chi', 255)->nullable();
            $table->string('so_dien_thoai', 15)->nullable();
            $table->string('mo_ta', 255)->nullable();
            $table->dateTime('thoi_diem_tao')->useCurrent();
            $table->dateTime('thoi_diem_cap_nhat')->useCurrent();
            $table->unique('ten_rap', 'RAP_UNQ_IDX');
        });
    }

    public function down()
    {
        Schema::drop($this->ten_bang);
    }
}
