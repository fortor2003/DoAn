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
    <form id="forgetpassword-form" class="login" method='post' novalidate='' action="{{route('khachHang.quenMatKhau')}}">
        @csrf
        <p class="login__title">Quên mật khẩu <br><span class="login-edition">Chào mừng đến với BKCinema</span></p>
        <p class="text-center">Hãy cung cấp cho chúng tôi email mà bạn đã dùng để đăng ký tài khoản, chúng tôi sẽ gửi link cấp lại mật khẩu đến email của bạn</p>
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
            <input type='email' placeholder='Email' id="email" name='email' class="login__input">
        </div>
        <div class="login__control">
            <button type='submit' class="btn btn-md btn--warning btn--wider">cấp lại mật khẩu</button>
            <div class="wrap-link">
                <a href="{{route('khachHang.dangNhapPage')}}" class="login__tracker form__tracker">Bạn đã có tài khoản ?
                    Đăng nhập</a>
                <a href="{{route('khachHang.dangKyPage')}}" class="login__tracker form__tracker">Bạn chưa có tài khoản ?
                    Đăng ký ngay bây giờ</a>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        $('#forgetpassword-form').submit(function (e) {
            var error = 0;
            var self = $(this);
            var $email = self.find('#email');
            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (!emailRegex.test($email.val())) {
                createErrTult("Email không hợp lệ", $email)
                error++;
            }

            if (error != 0) {
                e.preventDefault();
                return;
            }
        }); // end submit
    </script>
@endsection
