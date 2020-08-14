<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="telephone=no" name="format-detection">
    @include('khachHang.layout._stylesheets')
    <style>
        #resetpassword-form {
            margin-top: 100px;
        }
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
</head>
<body>
<div class="wrapper">
    <div class="error-wrapper">
        <a href="{{route('khachHang.trangChuPage')}}" class="logo logo--dark">
            <img alt='logo' src="{{asset('images/logo-dark.png')}}">
            <p class="slogan--dark"></p>
        </a>
        <form id="resetpassword-form" class="login" method='post' novalidate='' action="{{route('khachHang.taoLaiMatKhau', request()->query())}}">
            @csrf
            <p class="login__title">Tạo lại mật khẩu <br><span class="login-edition">Chào mừng đến với BKCinema</span></p>
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
                <input type='password' placeholder='Mật khẩu mới' id="matKhau" name='matKhau' class="login__input">
                <input type='password' placeholder='Nhập lại mật khẩu mới' id="nhapLaiMatKhau" name='nhapLaiMatKhau'
                       class="login__input">
            </div>
            <div class="login__control">
                <button type='submit' class="btn btn-md btn--warning btn--wider">Đặt lại mật khẩu</button>
            </div>
        </form>
    </div>
    <div class="copy-bottom">
        <p class="copy">&copy; BKCinema, 2020</p>
    </div>
</div>
@include('khachHang.layout._scripts')
<script>
    $('#resetpassword-form').submit(function (e) {
        var error = 0;
        var self = $(this);

        var $pass = self.find('#matKhau');
        var $retypePass = self.find('#nhapLaiMatKhau');

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
</body>
