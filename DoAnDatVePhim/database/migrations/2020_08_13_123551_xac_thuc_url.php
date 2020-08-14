<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class XacThucUrl extends Migration
{

    // Tên table trong cơ sở dữ liệu
    private $ten_bang = 'XAC_THUC_URL';

    public function up()
    {
        // Tạo cấu trúc của bảng
        Schema::create($this->ten_bang, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tai_khoan_id');
            $table->enum('loai', ['VERIFY_EMAIL', 'RESET_PASSWORD']);
            $table->string('signature', 255);
            $table->dateTime('thoi_diem_tao')->useCurrent();
            $table->dateTime('thoi_diem_cap_nhat')->useCurrent();
        });
    }

    public function down()
    {
        Schema::drop($this->ten_bang);
    }
}
