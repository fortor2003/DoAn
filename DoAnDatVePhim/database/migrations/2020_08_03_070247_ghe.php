<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ghe extends Migration
{
    // Tên table trong cơ sở dữ liệu
    private $ten_bang = 'GHE';
    private $chu_thich_bang = 'Ghế';

    public function up()
    {
        // Tạo cấu trúc của bảng
        Schema::create($this->ten_bang, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('phong_chieu_id');
            $table->string('ma_hang', 2);
            $table->unsignedInteger('thu_tu_trong_hang');
            $table->enum('loai_ghe', [ 'STANDARD', 'VIP'])->default('STANDARD');
            $table->dateTime('thoi_diem_tao')->useCurrent();
            $table->dateTime('thoi_diem_cap_nhat')->useCurrent();
            $table->unique(['phong_chieu_id', 'ma_hang', 'thu_tu_trong_hang'], 'GHE_UNQ_IDX');
        });
        // Tạo comment cho bảng
//        DB::statement("ALTER TABLE `$this->ten_bang` comment '$this->chu_thich_bang'");
    }

    public function down()
    {
        Schema::drop($this->ten_bang);
    }
}
