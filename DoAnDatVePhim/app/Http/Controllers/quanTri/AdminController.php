<?php

namespace App\Http\Controllers\quanTri;

use App\Http\Controllers\Controller;
use App\Services\quanTri\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function trangChuPage()
    {
        $danhSachRap = $this->adminService->danhSachRap();
        $danhSachPhim = $this->adminService->danhSachPhim();
//        dump($danhSachPhim);
        return view('QuanTri.pages.trangChinhPage',compact(['danhSachRap', 'danhSachPhim']));
    }

}
