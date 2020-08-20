<?php

namespace App\Http\Controllers\quanTri;

use App\Http\Controllers\Controller;
use App\Models\Phim;
use App\Services\quanTri\SuatChieuService;
use Illuminate\Http\Request;


class ApiAdminController extends Controller
{

    private $suatChieuService;

    public function __construct(SuatChieuService $suatChieuService)
    {
        $this->suatChieuService = $suatChieuService;
    }

    public function danhSachSuatChieu(Request $request)
    {
        $queryParams = $request->query();
        return $this->suatChieuService->danhSachSuatChieu($queryParams['phim_id'] ?? null, $queryParams['ngay_chieu'] ?? null, $queryParams['rap_id'] ?? null);
    }
}

