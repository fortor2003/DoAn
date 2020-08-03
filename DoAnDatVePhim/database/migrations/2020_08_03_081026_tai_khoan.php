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
            $table->String('email')->nullable();
            $table->String('mat_khau')->nullable();
            $table->bigInteger('quyen_hang_id')->nullable();
            $table->String('ho_ten')->nullable();
            $table->String('phone')->nullable();
            $table->unsignedDecimal('point')->nullable();

            $table->dateTime('thoiDiemTao')->useCurrent();
            $table->dateTime('thoiDiemCapNhat')->useCurrent();

        });
        // Tạo comment cho bảng
//        DB::statement("ALTER TABLE `$this->ten_bang` comment '$this->chu_thich_bang'");
    }

    public function down()
    {
        Schema::drop($this->ten_bang);
    }
}
