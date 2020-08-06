<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PhongChieu extends Migration
{
    // Tên table trong cơ sở dữ liệu
    private $ten_bang = 'PHONG_CHIEU';
    private $chu_thich_bang = 'Phòng Chiếu';

    public function up()
    {
        // Tạo cấu trúc của bảng
        Schema::create($this->ten_bang, function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->unsignedBigInteger('rap_id')->comment('Xác định rạp mà phòng chiếu này thuộc về');
            $table->string('ten_phong', 100)->comment('Tên Phòng');
            $table->unsignedInteger('suc_chua')->comment('Sức chưa');
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
