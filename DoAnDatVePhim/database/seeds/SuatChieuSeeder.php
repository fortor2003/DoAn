<?php

use Illuminate\Database\Seeder;

class SuatChieuSeeder extends Seeder
{

    public function run()
    {
        $danhSachNgayChieu = new DatePeriod(now(), new DateInterval('P1D'), now()->addDays(5));
        $danhSachPhimDangChieu = \App\Models\Phim::where('trang_thai', 'DANG_CHIEU')->select(['id', 'thoi_luong_chieu', 'diem_danh_gia', 'tieu_de_vi'])->orderBy('diem_danh_gia', 'desc')->get()->toArray();
        \App\Models\SuatChieu::query()->delete();
        if (count($danhSachPhimDangChieu) === 6) {
            $danhSachRap = \App\Models\Rap::with('danhSachPhongChieu:id,rap_id,ten_phong')->select(['id', 'ten_rap'])->get()->toArray();
            foreach ($danhSachNgayChieu as $ngayChieu) {
//            echo '----------------------------------------- Lịch chiếu ngày ' . $ngayChieu->format('Y-m-d') . ' -----------------------------------------<br>';
                foreach ($danhSachRap as $rap) {
//                echo '--------------------------- ' . $rap['ten_rap'] . ' ---------------------------<br>';
                    $danhSachPhongChieu = $rap['danh_sach_phong_chieu'];
                    if (count($danhSachPhongChieu) === 6) {
                        foreach ($danhSachPhongChieu as $idx => $phongChieu) {
//                        echo '-------------- ' . $phongChieu['ten_phong'] . ' --------------<br>';
                            $slotBatDau = 108;
                            $slotKetThuc = 287;
                            $thoiGianTruHao = 2; // tính bằng slot. 2 => 10 phút
                            $phim = $danhSachPhimDangChieu[$idx];
                            $thoiLuongChieu = ceil($phim['thoi_luong_chieu'] / 5);
                            while ($slotBatDau < $slotKetThuc && ($slotBatDau + $thoiLuongChieu) < $slotKetThuc) {
                                \App\Models\SuatChieu::create([
                                    'phim_id' => $phim['id'],
                                    'phong_chieu_id' => $phongChieu['id'],
                                    'ngay_chieu' => $ngayChieu,
                                    'gio_bat_dau_slot' => $slotBatDau,
                                    'gio_ket_thuc_slot' => ($slotBatDau + $thoiLuongChieu),
                                    'giao_ngay' => false
                                ]);
                                $slotBatDau += $thoiLuongChieu + $thoiGianTruHao;
                            }
                        }
                    }
                }
            }
            return 'Hoàn tất';
        }
    }
}
