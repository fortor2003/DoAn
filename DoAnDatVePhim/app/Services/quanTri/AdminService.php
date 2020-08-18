<?php

namespace App\Services\quanTri;


use App\Utils\StringUtil;
use App\Models\Rap;
use App\Models\PhongChieu;
use App\Models\Phim;
use App\Models\SuatChieu;

class AdminService
{
    /**
     * Trả về danh sách các rạp chiếu
     **/
    public function danhSachRap(): array
    {
        return Rap::select(['id', 'ten_rap'])->get()->toArray();
    }
    /**
     * Trả về danh sách các phòng
     **/
    public function danhSachPhong($idRap): array
    {

        return Rap::findOrFail($idRap)->danhSachPhongChieu()->toArray();
    }
    /**
     * Trả về danh sách các phim
     **/

    /**
     * Trả về danh sách các suất chiếu
     **/

}
