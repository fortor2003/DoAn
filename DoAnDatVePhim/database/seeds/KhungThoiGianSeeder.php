<?php

use Illuminate\Database\Seeder;
use App\Models\KhungThoiGian;

class KhungThoiGianSeeder extends Seeder
{

    public function run()
    {
        $danhSachKhungThoiGian = [];
        $soThuTu = 1;
        for ($h = 0; $h <= 23; $h++) {
            for ($m = 0; $m <= 55; $m += 5) {
                $danhSachKhungThoiGian[] = [
                    'thoi_gian' => sprintf('%02d', $h).':'.sprintf('%02d', $m),
                    'so_thu_tu' => $soThuTu,
                    'thoi_diem_tao' => now(),
                    'thoi_diem_cap_nhat' => now()
                ];
                $soThuTu++;
            }
        }
        DB::delete('delete from khung_thoi_gian');
        KhungThoiGian::insert($danhSachKhungThoiGian);
    }
}
