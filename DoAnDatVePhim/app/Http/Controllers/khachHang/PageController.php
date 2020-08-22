<?php

namespace App\Http\Controllers\khachHang;

use App\Http\Controllers\Controller;
use App\Models\DonDatVe;
use App\Models\Ghe;
use App\Models\SuatChieu;
use App\Models\TaiKhoan;
use App\Services\khachHang\GheService;
use App\Services\khachHang\PageService;
use App\Services\khachHang\RapService;
use App\Services\khachHang\SuatChieuService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private $pageService;
    private $suatChieuService;
    private $rapService;
    private $gheService;

    public function __construct(PageService $pageService, SuatChieuService $suatChieuService, RapService $rapService, GheService $gheService)
    {
        $this->pageService = $pageService;
        $this->suatChieuService = $suatChieuService;
        $this->rapService = $rapService;
        $this->gheService = $gheService;
        $this->middleware('auth')->only(['datGhePage', 'thanhToanPage', 'xacNhanThanhToanPage']);
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
        $danhSachRap = $this->rapService->danhSachRap();
        $danhSachSuatChieu = $this->suatChieuService->danhSachSuatChieu($id, null, null);
        return view('khachHang.pages.chiTietPhimPage', compact('thongTinPhim', 'danhSachRap', 'danhSachSuatChieu'));
    }

    public function datVePage(Request $request)
    {
        $phimId = $request->get('phim_id');
        $danhSachPhimDangChieu = $this->pageService->danhSachPhimDangChieu();
        $danhSachRap = $this->rapService->danhSachRap();
        return view('khachHang.pages.datVePage', compact(['danhSachPhimDangChieu', 'danhSachRap', 'phimId']));
    }

    public function datGhePage(Request $request)
    {
        $suatChieuId = $request->query('suat_chieu_id');
        if ($this->suatChieuService->kiemTraSuatChieuHopLe($suatChieuId)) {
            $suatChieu = $this->suatChieuService->thongTinSuatChieu($suatChieuId);
            $giaVe = env('DON_GIA_VE', 90000);
            $danhSachHangGhe = $this->gheService->danhSachGhe($suatChieuId);
            return view('khachHang.pages.datGhePage', compact(['suatChieuId', 'suatChieu', 'giaVe', 'danhSachHangGhe']));
        } else {
            return redirect()->route('khachHang.datVePage');
        }
    }

    public function thanhToanPage(Request $request)
    {
        $suatChieuId = $request->input('suat_chieu_id');
        $danhSachGheId = array_unique(json_decode($request->input('danh_sach_ghe_id')));
        if ($this->suatChieuService->kiemTraSuatChieuHopLe($suatChieuId)) {
            if (count($danhSachGheId) > 0 && $this->suatChieuService->kiemTraSuatChieuHopLe($suatChieuId)) {
                if ($this->gheService->kiemTraGheTrong($suatChieuId, $danhSachGheId)) {
                    $suatChieu = $this->suatChieuService->thongTinSuatChieu($suatChieuId);
                    $giaVe = env('DON_GIA_VE', 90000);
                    return view('khachHang.pages.thanhToanPage', compact(['suatChieuId', 'danhSachGheId', 'suatChieu', 'giaVe']));
                } else {
                    return redirect()->route('khachHang.datGhePage', ['suat_chieu_id' => $suatChieuId]);
                }
            } else {
                return redirect()->route('khachHang.datVePage');
            }
        } else {
            return redirect()->route('khachHang.datVePage');
        }
    }

    public function xacNhanThanhToanPage(Request $request)
    {
        $suatChieuId = $request->input('suat_chieu_id');
        $danhSachGheId = array_unique(json_decode($request->input('danh_sach_ghe_id')));
        if ($this->suatChieuService->kiemTraSuatChieuHopLe($suatChieuId)) {
            if (count($danhSachGheId) > 0 && $this->suatChieuService->kiemTraSuatChieuHopLe($suatChieuId)) {
                if ($this->gheService->kiemTraGheTrong($suatChieuId, $danhSachGheId)) {
                    // Tạo đơn đặt vé
                    $donDatVe = new DonDatVe();
                    $donDatVe->ma_don = strtoupper(uniqid('DV.'));
                    $donDatVe->suat_chieu_id = $suatChieuId;
                    $donDatVe->khach_hang_id = auth()->user()->id;
                    $donDatVe->nhan_vien_id = null;
                    $donDatVe->tinh_trang = 'CHUA_THANH_TOAN';


                    $suatChieu = $this->suatChieuService->thongTinSuatChieu($suatChieuId);
                    $giaVe = env('DON_GIA_VE', 90000);
                    dump($suatChieu);
                    return view('khachHang.pages.thanhToanPage', compact(['suatChieuId', 'danhSachGheId', 'suatChieu', 'giaVe']));
                } else {
                    return redirect()->route('khachHang.datGhePage', ['suat_chieu_id' => $suatChieuId]);
                }
            } else {
                return redirect()->route('khachHang.datVePage');
            }
        } else {
            return redirect()->route('khachHang.datVePage');
        }
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
