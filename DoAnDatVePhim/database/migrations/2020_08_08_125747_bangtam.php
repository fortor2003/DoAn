<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bangtam extends Migration
{
    // Tên table trong cơ sở dữ liệu
    private $ten_bang = 'AAAA';
    private $chu_thich_bang = 'Thể loại';

    public function up()
    {
        // Tạo cấu trúc của bảng
        Schema::create($this->ten_bang, function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->unsignedInteger('external_id')->nullable();
            $table->string('ten_the_loai', 150);
            $table->dateTime('thoi_diem_tao')->useCurrent();
            $table->dateTime('thoi_diem_cap_nhat')->useCurrent();
            $table->unique('ten_the_loai', 'THE_LOAI_UNQ_IDX_1');
            $table->unique('external_id', 'THE_LOAI_UNQ_IDX_2');
        });
        // Tạo comment cho bảng
//        DB::statement("ALTER TABLE `$this->ten_bang` comment '$this->chu_thich_bang'");
    }

    public function down()
    {
        Schema::drop($this->ten_bang);
    }
}
