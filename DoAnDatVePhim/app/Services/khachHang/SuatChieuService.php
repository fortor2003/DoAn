<?php

namespace App\Services\khachHang;

use App\Models\Rap;
use App\Models\SuatChieu;
use App\Utils\StringUtil;

class SuatChieuService
{

    /**
     * Trả về danh sách các rạp chiếu có ít nhất 1 suất chiéu theo phim, ngày chiếu, rạp
     * @param int $phimId ID ở bảng phim
     * @param string $ngayChieu có dạng yyyy-mm-dd, nếu để null thì sẽ lấy ngày hiện tại
     * @param int $rapId ID ở bảng rạp, nếu để null thì lấy hết tất cả các rạp
     * @return array
     */
    public function danhSachSuatChieu($phimId, $ngayChieu, $rapId): array
    {
        $ngayChieu = $ngayChieu ?? now()->format('Y-m-d');
        if ($phimId && StringUtil::isValidDate($ngayChieu) && (int)now()->diff(new \DateTime('2020-08-23'))->format('%r%a') >= 0) {
            $queryBuilder = Rap::whereHas('danhSachSuatChieu', function ($query) use ($phimId, $ngayChieu) {
                $query->where('phim_id', $phimId)->whereDate('ngay_chieu', $ngayChieu);
            })->whereHas('danhSachSuatChieu.gioBatDau', function($q) {
                $q->where('thoi_gian', '>=', now()->format('H:i'));
            })->with(['danhSachSuatChieu' => function ($query) use ($phimId, $ngayChieu) {
                $query->whereHas('gioBatDau', function ($q) {
                    $q->where('thoi_gian', '>=', now()->format('H:i'));
                })->with('gioBatDau:slot,thoi_gian')->where('phim_id', $phimId)->whereDate('ngay_chieu', $ngayChieu)->orderBy('gio_bat_dau_slot', 'asc')->select(['suat_chieu.id', 'suat_chieu.gio_bat_dau_slot']);
            }])->select(['id', 'ten_rap']);
            if ($rapId) {
                $queryBuilder = $queryBuilder->where('id', $rapId);
            }
            return $queryBuilder->get()->toArray();
        } else {
            return [];
        }
    }

    public function thongTinSuatChieu($suatChieuId): array
    {
        return SuatChieu::with(['gioBatDau:slot,thoi_gian', 'phim:id,tieu_de_vi,url_anh_bia', 'rap:ten_rap'])->findOrFail($suatChieuId)->toArray();
    }
}
