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
            $table->string('tieu_de_goc', 255);
            $table->string('ten_phim', 255);
            $table->unsignedDecimal('diem_danh_gia', 2, 1);
            $table->unsignedInteger('thoi_luong_chieu')->comment('Thời lượng chiếu tính bằng phút');
            $table->string('quoc_gia_san_xuat', 100)->nullable();
            $table->string('nha_san_xuat', 100)->nullable();
            $table->string('dao_dien', 100)->nullable();
            $table->string('dien_vien', 1000)->nullable();
            $table->date('ngay_khoi_chieu');
            $table->date('ngay_ket_thuc')->nullable();
            $table->text('noi_dung_phim')->nullable();
            $table->string('anh_bia', 255);
            $table->string('url_trailer_video', 255)->nullable();
            $table->dateTime('thoi_diem_tao')->useCurrent();
            $table->dateTime('thoi_diem_cap_nhat')->useCurrent();
            $table->unique('tieu_de_goc', 'PHIM_UNQ_IDX');
        });
        // Tạo comment cho bảng
//        DB::statement("ALTER TABLE `$this->ten_bang` comment '$this->chu_thich_bang'");
    }

    public function down()
    {
        Schema::drop($this->ten_bang);
    }
}
