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
            $table->string('ten_rap')->nullable();
            $table->string('dia_chi')->nullable();
            $table->string('phone')->nullable();
            $table->string('mo_ta')->nullable();
            $table->dateTime('thoiDiemTao')->useCurrent();
            $table->dateTime('thoiDiemCapNhat')->useCurrent();
        });
    }

    public function down()
    {
        Schema::drop($this->ten_bang);
    }
}
