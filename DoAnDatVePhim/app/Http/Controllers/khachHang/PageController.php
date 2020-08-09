<?php

namespace App\Http\Controllers\khachHang;

use App\Http\Controllers\Controller;
use App\Models\TheLoai;
use App\Services\khachHang\PageService;


class PageController extends Controller
{
    public function trangChuPage(PageService $pageService) {
        $danhSachPhimHayNhatHomNay = $pageService->danhSachPhimHayNhatHomNay();
        $danhSachPhimDangChieu = $pageService->danhSachPhimDangChieu();
        return view('nguoidung.page.trangChinhPage', compact(['danhSachPhimHayNhatHomNay', 'danhSachPhimDangChieu']));
    }
    public function dangNhapPage(PageService $pageService) {
        return view('nguoidung.page.dangNhapPage');
    }
    public function chiTietPhimPage(PageService $pageService) {
       dump(TheLoai::all());
       return view('nguoidung.page.chiTietPhimPage');
    }
}
