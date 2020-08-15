<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KhungThoiGian extends Migration
{
    // Tên table trong cơ sở dữ liệu
    private $ten_bang = 'KHUNG_THOI_GIAN';
    private $chu_thich_bang = 'Từ điển khung thời gian trong ngày';

    public function up()
    {
        // Tạo cấu trúc của bảng
        Schema::create($this->ten_bang, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('thoi_gian', 5);
            $table->unsignedInteger('slot');
            $table->dateTime('thoi_diem_tao')->useCurrent();
            $table->dateTime('thoi_diem_cap_nhat')->useCurrent();
            $table->unique('thoi_gian', 'KHUNG_THOI_GIAN_UNQ_IDX_1');
            $table->unique('slot', 'KHUNG_THOI_GIAN_UNQ_IDX_2');
        });
    }

    public function down()
    {
        Schema::drop($this->ten_bang);
    }
}
