<?php

namespace App\Http\Controllers\khachHang;

use App\Http\Controllers\Controller;
use App\Models\Phim;
use App\Models\SuatChieu;
use App\Services\khachHang\GheService;
use App\Services\khachHang\SuatChieuService;
use Illuminate\Http\Request;


class ApiController extends Controller
{

    private $suatChieuService;
    private $gheService;

    public function __construct(SuatChieuService $suatChieuService, GheService $gheService)
    {
        $this->suatChieuService = $suatChieuService;
        $this->gheService = $gheService;
        $this->middleware('auth:sanctum')->only(['danhSachGheTheoSuatChieu']);
    }

    public function danhSachSuatChieu(Request $request, Phim $phim)
    {
        $queryParams = $request->query();
        return $this->suatChieuService->danhSachSuatChieu($phim['id'], $queryParams['ngay_chieu'] ?? null, $queryParams['rap_id'] ?? null);
    }

    public function danhSachGheTheoSuatChieu(Request $request, SuatChieu $suatChieu) {
        return $this->gheService->danhSachGheTheoTinhTrang($suatChieu->id);
    }

}

