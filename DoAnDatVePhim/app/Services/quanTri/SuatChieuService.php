<?php

namespace App\Services\quanTri;

use App\Models\Rap;
use App\Models\SuatChieu;
use App\Utils\StringUtil;

class SuatChieuService
{

    /**
     * Trả về danh sách các rạp chiếu có ít nhất 1 suất chiéu theo phim, ngày chiếu, rạp
     * @param int $phimId ID ở bảng phim
     * @param string $ngayChieu có dạng yyyy-mm-dd
     * @param int $rapId ID ở bảng rạp
     * @return array
     */
    public function danhSachSuatChieu($phimId, $ngayChieu, $rapId): array
    {
        $ngayChieu = $ngayChieu ?? now()->format('Y-m-d');
        if ($phimId && StringUtil::isValidDate($ngayChieu)) {
            $queryBuilder = SuatChieu::whereHas('rap', function ($q) use ($rapId) {
                $q->where('rap.id', $rapId);
            })->with('gioBatDau:slot,thoi_gian')->where('phim_id', $phimId)->whereDate('ngay_chieu', $ngayChieu);
            return $queryBuilder->get()->toArray();
        } else {
            return [];
        }
    }
}
