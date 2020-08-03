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
            $table->bigInteger('rap_id')->nullable()->comment('Mã Rạp');
            $table->string('ten_phong')->nullable()->comment('Tên Phòng');
            $table->string('suc_chua')->nullable()->comment('Sức chưa');
            $table->dateTime('thoiDiemTao')->useCurrent()->comment('Thời điểm tạo');
            $table->dateTime('thoiDiemCapNhat')->useCurrent()->comment('Thời điểm cập nhật');


        });
        // Tạo comment cho bảng
//        DB::statement("ALTER TABLE `$this->ten_bang` comment '$this->chu_thich_bang'");
    }

    public function down()
    {
        Schema::drop($this->ten_bang);
    }
}
