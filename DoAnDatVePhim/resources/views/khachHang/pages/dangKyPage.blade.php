@extends('khachHang.layout.master', ['isHomePage' => false])
@section('title_tab', 'Trang chủ')
@section('above_main_style')
@endsection
@section('stylesheets')
    <style>
        .login__control {
            margin-top: 40px;
        }

        .login__control .wrap-link {
            margin-top: 50px;
        }

        .login__control .wrap-link a {
            margin: 10px 0;
        }
    </style>
@endsection
@section('content')
    <form id="signup-form" class="login" method='post' novalidate='' action="{{route('khachHang.dangKy')}}">
        @csrf
        <p class="login__title">Đăng ký tài khoản <br><span class="login-edition">Chào mừng đến với BKCinema</span></p>
        <div class="field-wrap">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    <ul>
                        <li>{{ session()->get('message') }}</li>
                    </ul>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type='text' placeholder='Họ tên' id="hoTen" name='hoTen' class="login__input">
            <input type='email' placeholder='Email' id="email" name='email' class="login__input">
            <input type='password' placeholder='Mật khẩu' id="matKhau" name='matKhau' class="login__input">
            <input type='password' placeholder='Nhập lại mật khẩu' id="nhapLaiMatKhau" name='nhapLaiMatKhau'
                   class="login__input">
        </div>
        <div class="login__control">
            <button type='submit' class="btn btn-md btn--warning btn--wider">Đăng ký</button>
            <div class="wrap-link">
                <a href="{{route('khachHang.dangNhapPage')}}" class="login__tracker form__tracker">Bạn đã có tài khoản ?
                    Đăng nhập</a>
                <a href="{{route('khachHang.quenMatKhauPage')}}" class="login__tracker form__tracker">Quên mật khẩu ?</a>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        $('#signup-form').submit(function (e) {
            var error = 0;
            var self = $(this);

            var $fullName = self.find('#hoTen');
            var $email = self.find('#email');
            var $pass = self.find('#matKhau');
            var $retypePass = self.find('#nhapLaiMatKhau');

            if ($fullName.val().length === 0) {
                createErrTult("Họ tên không được bỏ trống", $fullName)
                error++;
            }

            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

            if (!emailRegex.test($email.val())) {
                createErrTult("Email không hợp lệ", $email)
                error++;
            }

            if ($pass.val().length >= 6) {
                $pass.removeClass('invalid_field');
            } else {
                createErrTult('Mật khẩu phải có ít nhất 6 ký tự', $pass)
                error++;
            }

            if ($retypePass.val() !== $pass.val()) {
                createErrTult('Nhập lại mật khẩu chưa đúng', $retypePass)
                error++;
            } else {
                $retypePass.removeClass('invalid_field');
            }

            if (error != 0) {
                e.preventDefault();
                return;
            }
        }); // end submit
    </script>
@endsection
