<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ve extends Migration
{
    // Tên table trong cơ sở dữ liệu
    private $ten_bang = 'VE';
    private $chu_thich_bang = 'Vé';

    public function up()
    {
        // Tạo cấu trúc của bảng
        Schema::create($this->ten_bang, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ma_ve', 100);
            $table->unsignedBigInteger('suat_chieu_id');
            $table->unsignedBigInteger('ghe_id');
            $table->unsignedBigInteger('khach_hang_id');
            $table->unsignedBigInteger('nhan_vien_id');
            $table->dateTime('thoi_diem_tao')->useCurrent();
            $table->dateTime('thoi_diem_cap_nhat')->useCurrent();
        });
        // Tạo comment cho bảng
//        DB::statement("ALTER TABLE `$this->ten_bang` comment '$this->chu_thich_bang'");
    }

    public function down()
    {
        Schema::drop($this->ten_bang);
    }
}
