<?php

use Illuminate\Database\Seeder;

class PhongChieuSeeder extends Seeder
{

    public function run()
    {
        DB::delete('delete from phong_chieu');
        $danhSachRap = \App\Models\Rap::all();
        foreach ($danhSachRap as $rap) {
            $danhSachPhongChieu = [];
            for ($i=0; $i<3; $i++) {
                $danhSachPhongChieu[] = new \App\Models\PhongChieu([
                    'ten_phong' => "Phòng $i",
                    'suc_chua' => 166,
                    'thoi_diem_tao' => now(),
                    'thoi_diem_cap_nhat' => now()
                ]);
            }
            $rap->danhSachPhongChieu()->saveMany($danhSachPhongChieu);
        }
    }
}
