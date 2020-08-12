<?php

namespace App\Services\khachHang;

use App\Models\Phim;
use App\Models\TheLoai;
use  App\Models\Ghe;
use Illuminate\Support\Facades\DB;

class PageService
{

    public function danhSachTheLoai(): array {
        return TheLoai::all()->makeHidden(['thoi_diem_tao', 'thoi_diem_cap_nhat'])->toArray();
    }

    public function danhSachPhim(): array {
        return Phim::query()->select(['id','tieu_de_goc','tieu_de_vi', 'diem_danh_gia', 'thoi_luong_chieu', 'url_anh_bia', 'url_anh_phong_nen', 'url_trailer_video'])->orderBy('ngay_phat_hanh', 'desc')->paginate(16)->toArray();
    }

    public function danhSachPhimHayNhatHomNay(): array {
        return Phim::query()->select(['id','tieu_de_goc','tieu_de_vi', 'diem_danh_gia', 'thoi_luong_chieu', 'url_anh_bia', 'url_anh_phong_nen', 'url_trailer_video'])->where('trang_thai', 'DANG_CHIEU')->orderBy('diem_danh_gia', 'desc')->take(6)->with('danhSachTheLoai:ten_the_loai')->get()->toArray();
    }

    public function danhSachPhimDangChieu(): array {
        return Phim::query()->select(['id','tieu_de_goc','tieu_de_vi', 'diem_danh_gia', 'thoi_luong_chieu', 'url_anh_bia', 'url_anh_phong_nen', 'url_trailer_video'])->where('trang_thai', 'DANG_CHIEU')->orderBy('ngay_phat_hanh', 'desc')->with('danhSachTheLoai:ten_the_loai')->get()->toArray();
    }

    public function danhSachPhimSapChieu(): array {
        return Phim::query()->select(['id','tieu_de_goc','tieu_de_vi', 'diem_danh_gia', 'thoi_luong_chieu', 'url_anh_bia', 'url_anh_phong_nen', 'url_trailer_video'])->where('trang_thai', 'SAP_CHIEU')->orderBy('ngay_phat_hanh', 'desc')->with('danhSachTheLoai:ten_the_loai')->get()->toArray();
    }

    public function thongTinPhim($id): array {
        return Phim::with('danhSachTheLoai:ten_the_loai')->findOrFail($id)->makeHidden(['thoi_diem_tao', 'thoi_diem_cap_nhat'])->toArray();
    }

    public function danhSachGhe(): array {
        return Ghe::query()->select(['id','ma_hang','thu_tu_trong_hang'])->where('phong_chieu_id',10)->get()->toArray();
    }


}
