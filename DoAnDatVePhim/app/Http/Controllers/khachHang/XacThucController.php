<?php

namespace App\Http\Controllers\khachHang;

use App\Http\Controllers\Controller;
use App\Services\khachHang\PageService;

class XacThucController extends Controller
{
    public function dangNhapPage() {
        return view('khachHang.pages.dangNhapPage');
    }

    public function dangNhap(Request $request) {

        return view('khachHang.pages.dangNhapPage');
    }
}
