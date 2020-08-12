<?php

namespace App\Http\Controllers\khachHang;

use App\Http\Controllers\Controller;
use App\Services\khachHang\PageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class XacThucController extends Controller
{
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
        dump($validatedData);
//        if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['matKhau']])) {
//            return redirect()->intended(route('khachHang.trangChuPage'));
//        }
//        return redirect()->back()->withErrors(['message' => 'Sai thông tin đăng nhập']);
    }
}
