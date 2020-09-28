<?php

namespace App\Http\Controllers\khachHang;

use App\Events\khachHang\TaoDonDatVeEvent;
use App\Http\Controllers\Controller;
use App\Jobs\KhachHang\XuLyDonDatVeJob;
use App\Models\DonDatVe;
use App\Services\khachHang\GheService;
use App\Services\khachHang\PageService;
use App\Services\khachHang\RapService;
use App\Services\khachHang\SuatChieuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $this->middleware('auth')->only(['datGhePage', 'thanhToanPage', 'xacNhanThanhToanPage', 'donDatVePage', 'chiTietDonDatVePage']);
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

    public function xacNhanThanhToanPage(Request $request)
    {
        $suatChieuId = $request->input('suat_chieu_id');
        $danhSachGheId = array_unique(json_decode($request->input('danh_sach_ghe_id')));
        if ($this->suatChieuService->kiemTraSuatChieuHopLe($suatChieuId)) {
            if (count($danhSachGheId) > 0 && $this->suatChieuService->kiemTraSuatChieuHopLe($suatChieuId)) {
                if ($this->gheService->kiemTraGheTrong($suatChieuId, $danhSachGheId)) {
                    $suatChieu = $this->suatChieuService->thongTinSuatChieu($suatChieuId);
                    $giaVe = env('DON_GIA_VE', 90000);
                    return view('khachHang.pages.xacNhanThanhToanPage', compact(['suatChieuId', 'danhSachGheId', 'suatChieu', 'giaVe']));
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

    public function taoDonDatVe(Request $request)
    {
        $suatChieuId = $request->input('suat_chieu_id');
        $danhSachGheId = array_unique(json_decode($request->input('danh_sach_ghe_id')));
        if ($this->suatChieuService->kiemTraSuatChieuHopLe($suatChieuId)) {
            if (count($danhSachGheId) > 0 && $this->suatChieuService->kiemTraSuatChieuHopLe($suatChieuId)) {
                if ($this->gheService->kiemTraGheTrong($suatChieuId, $danhSachGheId)) {
                    $redirect = DB::transaction(function () use ($suatChieuId, $danhSachGheId) {
                        // Tạo đơn đặt vé
                        $donDatVe = new DonDatVe();
                        $donDatVe->ma_don = strtoupper(uniqid('DV.'));
                        $donDatVe->suat_chieu_id = $suatChieuId;
                        $donDatVe->khach_hang_id = auth()->user()->id;
                        $donDatVe->nhan_vien_id = null;
                        $donDatVe->tinh_trang = 'CHUA_THANH_TOAN';
                        $donDatVe->save();
                        // Tạo vé
                        $donDatVe->danhSachVe()->createMany(array_map(function ($gheId) {
                            return [
                                'ma_ve' => strtoupper(uniqid('VE.')),
                                'ghe_id' => $gheId
                            ];
                        }, $danhSachGheId));
                        // Kích hoạt event tạo đơn đặt vé
                        broadcast(new TaoDonDatVeEvent($suatChieuId));
                        // Xử lý đơn đặt vé sau khi hết thời gian đếm ngược
                        XuLyDonDatVeJob::dispatch($donDatVe->id)->delay(now()->addMinutes(env('TIME_WAIT_FOR_PAY', 10)));
                        // Chuyển về trang xem thông tin đơn đặt vé
                        return redirect()->route('khachHang.chiTietDonDatVePage', ['donDatVe' => $donDatVe->id]);
                    });
                    return $redirect;
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

    public function donDatVePage(Request $request) {
        $danhSachDonDatVe = DonDatVe::where('khach_hang_id', auth()->user()->id)->get()->toArray();
//        dump($danhSachDonDatVe);
        return view('khachHang.pages.donDatVePage', compact(['danhSachDonDatVe']));
    }

    public function chiTietDonDatVePage(Request $request, DonDatVe $donDatVe) {
        if (auth()->user()->id == $donDatVe->khach_hang_id) {
            $suatChieu = $this->suatChieuService->thongTinSuatChieu($donDatVe->suat_chieu_id);
            $soLuongVe = $donDatVe->danhSachVe()->count();
            $giaVe = env('DON_GIA_VE', 90000);
            $thoiGianConLai = (env('TIME_WAIT_FOR_PAY', 10) * 60) - (strtotime(now()->format('Y-m-d H:i:s')) - strtotime($donDatVe->thoi_diem_tao));
            $thoiGianConLai = $thoiGianConLai > 0 ? $thoiGianConLai : 0;
            $donDatVe = $donDatVe->makeHidden(['id', 'suat_chieu_id', 'khach_hang_id', 'nhan_vien_id', 'thoi_diem_tao', 'thoi_diem_cap_nhat', 'thoi_diem_thanh_toan'])->toArray();
            return view('khachHang.pages.chiTietDonDatVePage', compact(['donDatVe', 'soLuongVe', 'suatChieu', 'giaVe', 'thoiGianConLai']));
        } else {
            abort(404);
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
