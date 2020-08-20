<?php

namespace App\Http\Controllers\khachHang;

use App\Http\Controllers\Controller;
use App\Models\Phim;
use App\Services\khachHang\SuatChieuService;
use Illuminate\Http\Request;


class ApiController extends Controller
{

    private $suatChieuService;

    public function __construct(SuatChieuService $suatChieuService)
    {
        $this->suatChieuService = $suatChieuService;
        $this->middleware('auth:sanctum')->only(['thongTinTaiKhoan']);
    }

    public function danhSachSuatChieu(Request $request, Phim $phim)
    {
        $queryParams = $request->query();
        return $this->suatChieuService->danhSachSuatChieu($phim['id'], $queryParams['ngay_chieu'] ?? null, $queryParams['rap_id'] ?? null);
    }

    public function thongTinTaiKhoan(Request $request) {
        return $request->user()->tokens()->get();
    }
}

