<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GheSeeder extends Seeder
{
    public function run()
    {
        DB::delete('delete from ghe');
        $danhSachPhongChieu = \App\Models\PhongChieu::all();  //lấy danh sach phòng

        foreach ($danhSachPhongChieu as $phong) { //loop phòng

            $danhSachGhe = [];
            for ($d = 0; $d < PhongChieuSeeder::SO_DAY_GHE; $d++) {
                $hang = chr(65 + $d);
                for ($i = 1; $i <= PhongChieuSeeder::SO_GHE_TRONG_DAY; $i++) {
                    $danhSachGhe[] = new \App\Models\Ghe([
                        'thu_tu_trong_hang' => $i,
                        'ma_hang' => $hang,
                        'loai_ghe' => 'VIP'
                    ]);
                }
            }
            $phong->danhSachGhe()->saveMany($danhSachGhe);
        }
    }
}
