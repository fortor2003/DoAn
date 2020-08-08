<?php

namespace App\Http\Controllers\khachHang;

use App\Http\Controllers\Controller;
use App\Services\khachHang\PageService;


class PageController extends Controller
{
    public function trangChuPage(PageService $pageService) {
        return view('nguoidung.page.trangChinhPage');
    }
    public function dangNhapPage(PageService $pageService) {
        return view('nguoidung.page.dangNhapPage');
    }
    public function chiTietPhimPage(PageService $pageService) {
        return view('nguoidung.page.chiTietPhimPage');
    }
}
