<?php

namespace App\Services\khachHang;

use App\Models\SuatChieu;
use Illuminate\Support\Facades\DB;

class GheService
{

    /**
     * Trả về danh sách các ghế của 1 suất chiếu (nhóm theo mã dãy)
     * @param int $suatChieuId ID ở bảng suất chiếu
     * @return array
     */
    public function danhSachGhe($suatChieuId): array
    {
        SuatChieu::findOrFail($suatChieuId);
        $result = DB::table('suat_chieu sc')
            ->select(['g.ma_hang', DB::raw("JSON_ARRAYAGG(JSON_OBJECT(key 'id' is g.id format json, key 'thu_tu' is g.THU_TU_TRONG_HANG format json) order by g.THU_TU_TRONG_HANG) as danh_sach_ghe")])
            ->join('phong_chieu pc', 'sc.phong_chieu_id', '=', 'pc.id')
            ->leftJoin('ghe g', 'pc.id', '=', 'g.phong_chieu_id')
            ->where('sc.id', '=', $suatChieuId)
            ->groupBy('g.ma_hang')
            ->orderBy('g.ma_hang', 'asc')->get()->toArray();
        return array_map(function ($item) {
            return [
                'ma_hang' => $item->ma_hang,
                'danh_sach_ghe' => json_decode($item->danh_sach_ghe, true)
            ];
        }, $result);
    }

    /**
     * Trả về danh sách các ghế nhóm theo tình trạng đã thanh toán hoặc chờ thanh toán
     * @param int $suatChieuId ID ở bảng suất chiếu
     * @return array
     */
    public function danhSachGheTheoTinhTrang($suatChieuId): array
    {
        SuatChieu::findOrFail($suatChieuId);
        // Chờ thanh toán
        $danhSachGheChoThanhToan = DB::table('don_dat_ve ddv')
            ->select('v.ghe_id', 'ddv.thoi_diem_tao')
            ->leftJoin('suat_chieu sc', 'ddv.suat_chieu_id', '=', 'sc.id')
            ->leftJoin('phong_chieu pc', 'sc.phong_chieu_id', '=', 'pc.id')
            ->leftJoin('ve v', 'ddv.id', '=', 'v.don_dat_ve_id')
            ->leftJoin('ghe g', function ($join) {
                $join->on('pc.id', '=', 'g.phong_chieu_id');
                $join->on('v.ghe_id', '=', 'g.id');
            })
            ->where('ddv.suat_chieu_id', '=', $suatChieuId)
            ->where('ddv.tinh_trang', '=', 'CHUA_THANH_TOAN')->get()->toArray();
//        (env('TIME_WAIT_FOR_PAY', 10) * 60) - (strtotime(now()->format('Y-m-d H:i:s')) - strtotime($donDatVe->thoi_diem_tao))
        $strTimeNow = strtotime(now()->format('Y-m-d H:i:s'));
        $danhSachGheChoThanhToan = array_map(function ($item) use ($strTimeNow) {
            return [
                'ghe_id' => (int)$item->ghe_id,
                'so_giay_dem_nguoc' => (env('TIME_WAIT_FOR_PAY', 10) * 60) - ($strTimeNow - strtotime($item->thoi_diem_tao))
            ];
        }, $danhSachGheChoThanhToan);
        // Đã thanh toán
        $danhSachGheDaThanhToan = DB::table('don_dat_ve ddv')
            ->select('v.ghe_id')
            ->leftJoin('suat_chieu sc', 'ddv.suat_chieu_id', '=', 'sc.id')
            ->leftJoin('phong_chieu pc', 'sc.phong_chieu_id', '=', 'pc.id')
            ->leftJoin('ve v', 'ddv.id', '=', 'v.don_dat_ve_id')
            ->leftJoin('ghe g', function ($join) {
                $join->on('pc.id', '=', 'g.phong_chieu_id');
                $join->on('v.ghe_id', '=', 'g.id');
            })
            ->where('ddv.suat_chieu_id', '=', $suatChieuId)
            ->where('ddv.tinh_trang', '=', 'DA_THANH_TOAN')->get()->toArray();
        $danhSachGheDaThanhToan = array_map(function ($item) {
            return [
                'ghe_id' => (int)$item->ghe_id
            ];
        }, $danhSachGheDaThanhToan);
        return [
            'ghe_cho_thanh_toan' => $danhSachGheChoThanhToan,
            'ghe_da_thanh_toan' => $danhSachGheDaThanhToan
        ];
    }

    /**
     * Trả về danh sách các ghế đã thanh toán của 1 suất chiếu
     * @param int $suatChieuId ID ở bảng suất chiếu
     * @return array
     */
    public function danhSachGheDaThanhToan($suatChieuId): array
    {
        SuatChieu::findOrFail($suatChieuId);


        return array_map(function ($item) {
            return [
                'ghe_id' => (int)$item->ghe_id
            ];
        }, $result);
    }

    /**
     * Trả về true nếu danh sách ghế id truyền vào hợp lệ và đang ở trạng thái rảnh
     * @param int $suatChieuId ID ở bảng suất chiếu
     * @param array $danhSachGheId ID ở bảng ghế
     * @return bool
     */
    public function kiemTraGheTrong(int $suatChieuId, array $danhSachGheId): bool
    {
        $danhSachGheId = array_unique($danhSachGheId);
        $result =  DB::table('suat_chieu sc')
            ->select('g.id')
            ->leftJoin('phong_chieu pc', 'sc.phong_chieu_id', '=', 'pc.id')
            ->leftJoin('ghe g', function ($join) use ($suatChieuId, $danhSachGheId) {
                $join->on('pc.id', '=', 'g.phong_chieu_id')
                    ->whereIn('g.id', $danhSachGheId)
                    ->whereNotIn('g.id',
                        DB::table('don_dat_ve ddv')
                            ->select('v.ghe_id')
                            ->leftJoin('ve v', 'ddv.id', '=', 'v.don_dat_ve_id')
                            ->where('ddv.suat_chieu_id', '=', $suatChieuId)
                    );
            })
            ->where('sc.id', '=', $suatChieuId)
            ->orderBy('g.id', 'asc')
            ->get()->toArray();
        $result = array_map(function ($item) { return $item->id; }, $result);
        return count(array_diff($danhSachGheId, $result)) === 0;
    }
}
