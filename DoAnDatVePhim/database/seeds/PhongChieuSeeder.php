<?php

use Illuminate\Database\Seeder;

class PhongChieuSeeder extends Seeder
{
    const SO_PHONG_CHIEU = 6;
    const SO_DAY_GHE = 10; // A->J
    const SO_GHE_TRONG_DAY = 15; // 1->15

    public function run()
    {
        DB::delete('delete from phong_chieu');
        $danhSachRap = \App\Models\Rap::all();
        foreach ($danhSachRap as $rap) {
            $danhSachPhongChieu = [];
            for ($i = 1; $i <= self::SO_PHONG_CHIEU; $i++) {
                $danhSachPhongChieu[] = new \App\Models\PhongChieu([
                    'ten_phong' => "Phòng $i",
                    'suc_chua' => self::SO_DAY_GHE * self::SO_GHE_TRONG_DAY
                ]);
            }
            $rap->danhSachPhongChieu()->saveMany($danhSachPhongChieu);
        }
    }
}
