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
            $danhSachMaHang = ['A', 'B', 'C','D','E','F','G','I','J','K','L'];
            $soLuongGheTrongHang = 18;
            $danhSachGhe=[];
            foreach ($danhSachMaHang as $hang){
                for ($i=1;$i<=$soLuongGheTrongHang;$i++){
                    $danhSachGhe[] = new \App\Models\Ghe([
                        'thu_tu_trong_hang'=>$i,
                        'ma_hang' => $hang,
                        'loai_ghe' => 'VIP',
                        'thoi_diem_tao' => now(),
                        'thoi_diem_cap_nhat' => now()
                    ]);
                }
            }

            $phong->danhSachGhe()->saveMany($danhSachGhe);
        }
    }
}
