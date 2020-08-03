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
            $table->bigIncrements('id')->comment('ID');
            $table->bigInteger('phong_chieu_id')->nullable();
            $table->string('ma_hang')->nullable();
            $table->string('ma_cot')->nullable();
            $table->string('loai_ghe')->nullable();

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
