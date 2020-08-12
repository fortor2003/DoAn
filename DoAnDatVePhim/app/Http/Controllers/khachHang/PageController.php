<?php

namespace App\Http\Controllers\khachHang;

use App\Http\Controllers\Controller;
use App\Services\khachHang\PageService;

class PageController extends Controller
{
    public function trangChuPage(PageService $pageService) {
        $danhSachPhimHayNhatHomNay = $pageService->danhSachPhimHayNhatHomNay();
        $danhSachPhimDangChieu = $pageService->danhSachPhimDangChieu();
        $theLoai = $pageService->danhSachTheLoai();
        return view('khachHang.pages.trangChuPage', compact(['danhSachPhimHayNhatHomNay', 'danhSachPhimDangChieu','theLoai']));
    }
    public function dangNhapPage(PageService $pageService) {
        return view('nguoidung.page.dangNhapPage');
    }
    public function chiTietPhimPage($id, PageService $pageService) {
        $thongTinPhim = $pageService->thongTinPhim($id);
       return view('khachHang.pages.chiTietPhimPage', compact('thongTinPhim'));
    }

    public function datVePage (PageService $pageService){
        return view('khachHang.pages.datVePage');
    }

    public function datGhePage (PageService $pageService){
        $danhSachGhe = $pageService->danhSachGhe();
//        dd($danhSachGhe);
        return view('khachHang.pages.datGhePage', compact('danhSachGhe'));
    }
    public function thanhToanPage (PageService $pageService){
        return view('khachHang.pages.thanhToanPage');
    }

    public function hienThiVePage (PageService $pageService){
        return view('khachHang.pages.hienThiVePage');
    }

}
