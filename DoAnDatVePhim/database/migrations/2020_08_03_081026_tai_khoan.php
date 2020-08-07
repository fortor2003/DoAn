<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaiKhoan extends Migration
{
    // Tên table trong cơ sở dữ liệu
    private $ten_bang = 'TAI_KHOAN';
    private $chu_thich_bang = 'Tài khoản';

    public function up()
    {
        // Tạo cấu trúc của bảng
        Schema::create($this->ten_bang, function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->String('email');
            $table->String('mat_khau');
            $table->unsignedBigInteger('vai_tro_id');
            $table->String('ho_ten');
            $table->String('so_dien_thoai')->nullable();
            $table->unsignedBigInteger('diem_thuong')->default(0);
            $table->dateTime('thoi_diem_tao')->useCurrent();
            $table->dateTime('thoi_diem_cap_nhat')->useCurrent();
            $table->unique(['email', 'vai_tro_id'], 'TAI_KHOAN_UNQ_IDX');
        });
        // Tạo comment cho bảng
//        DB::statement("ALTER TABLE `$this->ten_bang` comment '$this->chu_thich_bang'");
    }

    public function down()
    {
        Schema::drop($this->ten_bang);
    }
}
