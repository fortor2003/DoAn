<?php

namespace App\Http\Controllers\khachHang;

use App\Http\Controllers\Controller;
use App\Models\TaiKhoan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Support\Facades\Auth;


class XacThucController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->only(['dangNhapPage', 'dangNhap', 'dangKyPage', 'dangKy', 'quenMatKhauPage', 'quenMatKhauPage']);
        $this->middleware('auth')->only(['dangXuat']);
        $this->middleware('signed')->only(['kichHoatTaiKhoan', 'taoLaiMatKhauPage', 'taoLaiMatKhau']);
    }

    public function dangNhapPage()
    {
        return view('khachHang.pages.dangNhapPage');
    }

    public function dangNhap(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
            'matKhau' => ['required'],
            'duyTriDangNhap' => []
        ], [
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Định dạng email không hợp lệ',
            'matKhau.required' => 'Mật khẩu không được bỏ trống',
        ]);
        if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['matKhau'], 'loai_vai_tro' => 'KHACH_HANG'], isset($validatedData['duyTriDangNhap']))) {
            $taiKhoan = Auth::user();
            if ($taiKhoan->hasVerifiedEmail()) {
                return redirect()->intended(route('khachHang.trangChuPage'));
            } else {
                $taiKhoan->sendEmailVerificationNotification();
                Auth::logout();
                return redirect()->back()->withErrors(['message' => 'Tài khoản của bạn chưa được kích hoạt, một thư kích hoạt tài khoản đã được gửi tới email của bạn']);
            }
        }
        return redirect()->back()->withErrors(['message' => 'Sai thông tin đăng nhập'])->withInput();
    }

    public function dangXuat()
    {
        Auth::logout();
        return redirect()->route('khachHang.trangChuPage');
    }

    public function dangKyPage()
    {
        return view('khachHang.pages.dangKyPage');
    }

    public function dangKy(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
            'hoTen' => ['required'],
            'matKhau' => ['required', 'min:6'],
            'nhapLaiMatKhau' => ['required', 'same:matKhau']
        ], [
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Định dạng email không hợp lệ',
            'hoTen.required' => 'Họ tên không được bỏ trống',
            'matKhau.required' => 'Mật khẩu không được bỏ trống',
            'matKhau.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'nhapLaiMatKhau.required' => 'Bạn phải nhập lại mật khẩu',
            'nhapLaiMatKhau.same' => 'Nhập lại mật khẩu chưa đúng',
        ]);
        if (TaiKhoan::where(['email' => $validatedData['email'], 'loai_vai_tro' => 'KHACH_HANG'])->count() > 0) {
            return redirect()->back()->withErrors(['message' => 'Email này đã được đăng ký, vui lòng dùng email khác']);
        }
        $taiKhoan = TaiKhoan::create(['email' => $validatedData['email'], 'mat_khau' => bcrypt($validatedData['matKhau']), 'ho_ten' => $validatedData['hoTen'], 'loai_vai_tro' => 'KHACH_HANG']);
        $taiKhoan->sendEmailVerificationNotification();
        return redirect()->back()->with('message', 'Đã tạo tài khoản thành công. Một email kích hoạt tài khoản đã được gửi tới địa chỉ email của bạn');
    }

    function kichHoatTaiKhoan(Request $request)
    {
        $params = $request->input();
        try {
            $taiKhoan = TaiKhoan::findOrFail($params['tai_khoan']);
            if ($taiKhoan->danhSachXacThucUrl()->where(['loai' => 'VERIFY_EMAIL', 'signature' => $params['signature']])->count() > 0) {
                $taiKhoan->markEmailAsVerified();
                $taiKhoan->danhSachXacThucUrl()->where('loai', 'VERIFY_EMAIL')->delete();
                return redirect()->route('khachHang.thongDiepPage', ['message' => 'Bạn đã kích hoạt tài khoản thành công, bây giờ bạn đã có thể đăng nhập để trải nghiệm dịch vụ của chúng tôi']);
            } else {
                throw new InvalidSignatureException();
            }
        } catch (ModelNotFoundException $ex) {
            throw new InvalidSignatureException();
        }
    }

    public function quenMatKhauPage()
    {
        return view('khachHang.pages.quenMatKhauPage');
    }

    public function quenMatKhau(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email']
        ], [
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Định dạng email không hợp lệ'
        ]);
        $taiKhoan = TaiKhoan::where(['email' => $validatedData['email'], 'loai_vai_tro' => ['KHACH_HANG']])->first();
        if ($taiKhoan) {
            $taiKhoan->sendEmailResetPasswordNotification();
            return redirect()->back()->with('message', 'Chúng tôi đã gửi link tạo lại mật khẩu đến email của bạn, hãy kiểm tra email');
        } else {
            return redirect()->back()->withErrors(['message' => 'Email bạn cung cấp không tồn tại trong hệ thống của chúng tôi']);
        }
        return redirect()->back()->withErrors(['message' => 'Sai thông tin đăng nhập']);
    }

    public function taoLaiMatKhauPage(Request $request)
    {
        $params = $request->query();
        try {
            $taiKhoan = TaiKhoan::findOrFail($params['tai_khoan']);
            if ($taiKhoan->danhSachXacThucUrl()->where(['loai' => 'RESET_PASSWORD', 'signature' => $params['signature']])->count() > 0) {
                return view('khachHang.pages.taoLaiMatKhauPage');
            } else {
                throw new InvalidSignatureException();
            }
        } catch (ModelNotFoundException $ex) {
            throw new InvalidSignatureException();
        }
    }

    public function taoLaiMatKhau(Request $request)
    {
        $params = $request->query();
        $validatedData = $request->validate([
            'matKhau' => ['required', 'min:6'],
            'nhapLaiMatKhau' => ['required', 'same:matKhau']
        ], [
            'matKhau.required' => 'Mật khẩu không được bỏ trống',
            'matKhau.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'nhapLaiMatKhau.required' => 'Bạn phải nhập lại mật khẩu',
            'nhapLaiMatKhau.same' => 'Nhập lại mật khẩu chưa đúng',
        ]);
        $taiKhoan = TaiKhoan::find($params['tai_khoan']);
        if ($taiKhoan) {
            $taiKhoan->mat_khau = bcrypt($validatedData['matKhau']);
            $taiKhoan->save();
            if (!$taiKhoan->hasVerifiedEmail()) {
                $taiKhoan->markEmailAsVerified();
            }
            $taiKhoan->danhSachXacThucUrl()->where('loai', 'RESET_PASSWORD')->delete();
            return redirect()->route('khachHang.thongDiepPage', ['message' => 'Bạn đã hoàn tất đặt lại mật khẩu, bây giờ bạn đã có thể đăng nhập để trải nghiệm dịch vụ của chúng tôi']);
        } else {
            throw new InvalidSignatureException();
        }
    }
}
