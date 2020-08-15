<?php

namespace App\Http\Controllers\khachHang;

use App\Http\Controllers\Controller;
use App\Models\Ghe;
use App\Models\TaiKhoan;
use App\Services\khachHang\PageService;
use App\Services\khachHang\SuatChieuService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private $pageService;
    private $suatChieuService;

    public function __construct(PageService $pageService, SuatChieuService $suatChieuService)
    {
        $this->pageService = $pageService;
        $this->suatChieuService = $suatChieuService;
    }

    public function trangChuPage()
    {
        $danhSachPhimHayNhatHomNay = $this->pageService->danhSachPhimHayNhatHomNay();
        $danhSachPhimDangChieu = $this->pageService->danhSachPhimDangChieu();
        $theLoai = $this->pageService->danhSachTheLoai();
        return view('khachHang.pages.trangChuPage', compact(['danhSachPhimHayNhatHomNay', 'danhSachPhimDangChieu', 'theLoai']));
    }

    public function dangNhapPage()
    {
        return view('nguoidung.page.dangNhapPage');
    }

    public function chiTietPhimPage($id)
    {
        $thongTinPhim = $this->pageService->thongTinPhim($id);
        return view('khachHang.pages.chiTietPhimPage', compact('thongTinPhim'));
    }

    public function datVePage()
    {
        return view('khachHang.pages.datVePage');
    }

    public function datGhePage()
    {
        $danhSachGhe = $this->pageService->danhSachGhe();
        return view('khachHang.pages.datGhePage', compact('danhSachGhe'));
    }

    public function thanhToanPage()
    {
        return view('khachHang.pages.thanhToanPage');
    }

    public function hienThiVePage()
    {
        return view('khachHang.pages.hienThiVePage');
    }

    public function thongDiepPage(Request $request)
    {
        $message = $request->query('message');
        if ($message) {
            return view('khachHang.pages.thongDiepPage', compact('message'));
        } else {
            abort(404);
        }
    }
}
