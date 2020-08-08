<?php

namespace App\Http\Controllers\khachHang;

use App\Http\Controllers\Controller;
use App\Services\khachHang\PageService;


class PageController extends Controller
{
    public function trangChu(PageService $pageService) {
        dump($pageService->thongTinPhim(187));
        return view('nguoidung.page.trangChinhPage');
    }
}
