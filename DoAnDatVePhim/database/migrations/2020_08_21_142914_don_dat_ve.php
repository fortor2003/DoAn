<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DonDatVe extends Migration
{
    // Tên table trong cơ sở dữ liệu
    private $ten_bang = 'DON_DAT_VE';
    private $chu_thich_bang = 'Đơn đặt vé';

    public function up()
    {
        // Tạo cấu trúc của bảng
        Schema::create($this->ten_bang, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ma_don', 100);
            $table->unsignedBigInteger('suat_chieu_id');
            $table->unsignedBigInteger('khach_hang_id')->nullable();
            $table->unsignedBigInteger('nhan_vien_id')->nullable();
            $table->enum('tinh_trang', ['CHUA_THANH_TOAN', 'DA_THANH_TOAN']);
            $table->dateTime('thoi_diem_thanh_toan')->nullable()->default(null);
            $table->dateTime('thoi_diem_tao')->useCurrent();
            $table->dateTime('thoi_diem_cap_nhat')->useCurrent();
            $table->unique('ma_don', 'DONDATVE_UNQ_IDX');
        });
    }

    public function down()
    {
        Schema::drop($this->ten_bang);
    }
}
