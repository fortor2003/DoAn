<?php

use Illuminate\Database\Seeder;

class RapSeeder extends Seeder
{

    public function run()
    {
        $danhSachRap = [];
        for ($i=0; $i<5; $i++) {
            $danhSachRap[] = [
                'ten_rap' => "Rạp $i",
                'dia_chi' => "Địa chỉ $i",
                'so_dien_thoai' => '123456789',
                'mo_ta' => null,
                'thoi_diem_tao' => now(),
                'thoi_diem_cap_nhat' => now()
            ];
        }
        DB::delete('delete from rap');
        DB::table('rap')->insert($danhSachRap);
    }
}
