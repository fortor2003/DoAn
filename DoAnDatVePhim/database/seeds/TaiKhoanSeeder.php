<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TaiKhoanSeeder extends Seeder
{

    public function run()
    {
        $danhSachTaiKhoan = [];
        for ($i=0; $i<5; $i++) {
            $danhSachTaiKhoan[] = [
                'email' => "khachhang$i@example.com",
                'mat_khau' => bcrypt("khachhang$i"),
                'loai_vai_tro' => 'KHACH_HANG',
                'ho_ten' => "Khách hàng $i",
                'thoi_diem_kich_hoat' => now(),
                'thoi_diem_tao' => now(),
                'thoi_diem_cap_nhat' => now()
            ];
        }
        DB::delete('delete from tai_khoan');
        DB::table('tai_khoan')->insert($danhSachTaiKhoan);
    }
}
