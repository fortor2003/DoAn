<?php

namespace App\Services\khachHang;

use App\Models\Phim;
use App\Models\TheLoai;
use Illuminate\Support\Facades\DB;

class PageService
{

    public function danhSachTheLoai(): array {
        return TheLoai::all()->makeHidden(['thoi_diem_tao', 'thoi_diem_cap_nhat'])->toArray();
    }

    public function danhSachPhim(): array {
        return Phim::query()->select(['id','tieu_de_goc','tieu_de_vi', 'diem_danh_gia', 'thoi_luong_chieu', 'url_anh_bia', 'url_anh_phong_nen', 'url_trailer_video'])->orderBy('ngay_phat_hanh', 'desc')->paginate(16)->toArray();
    }

    public function thongTinPhim($id): array {
        return Phim::findOrFail($id)->makeHidden(['thoi_diem_tao', 'thoi_diem_cap_nhat'])->toArray();
    }
}
