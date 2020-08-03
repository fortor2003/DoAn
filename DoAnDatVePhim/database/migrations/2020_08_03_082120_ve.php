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
            $table->bigIncrements('id')->comment('ID');
            $table->char('ma_ve')->unique()->nullable()->comment('Mã barcode');
            $table->bigInteger('suat_chieu_id')->nullable();
            $table->bigInteger('ghe_id')->nullable();
            $table->bigInteger('nguoi_mua_id')->nullable();
            $table->bigInteger('nguoi_ban_id')->nullable();


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
