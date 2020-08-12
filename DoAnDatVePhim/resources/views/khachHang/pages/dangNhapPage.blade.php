@extends('khachHang.layout.master', ['isHomePage' => false])
@section('title_tab', 'Trang chủ')
@section('above_main_style')
@endsection
@section('stylesheets')
    <style>
        .login__control .wrap-link {
            margin-top: 50px;
        }
        .login__control .wrap-link a {
            margin: 10px 0;
        }
    </style>
@endsection
@section('content')

    <form id="login-form" class="login" method='post' novalidate='' action="{{route('khachHang.dangNhapPage')}}">
        @csrf
        <p class="login__title">Đăng nhập <br><span class="login-edition">Chào mừng đến với BKCinema</span></p>

        <div class="field-wrap">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type='email' placeholder='Email' name='email' class="login__input">
            <input type='password' placeholder='Mật khẩu' name='matKhau' class="login__input">
            <input type='checkbox' id='#informed' name="duyTriDangNhap" class='login__check styled'>
            <label for='#informed' class='login__check-info'>Duy trì đăng nhập</label>
        </div>
        <div class="login__control">
            <button type='submit' class="btn btn-md btn--warning btn--wider">Đăng nhập</button>
            <div class="wrap-link">
                <a href="#" class="login__tracker form__tracker">Bạn chưa có tài khoản ?</a>
                <a href="#" class="login__tracker form__tracker">Quên mật khẩu ?</a>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <!-- jQuery REVOLUTION Slider -->
    <script type="text/javascript" src="{{asset('rs-plugin/js/jquery.themepunch.plugins.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
    <!-- Page -->
    <script src="{{asset('js/pages/khachHang/trangChuPage.js')}}"></script>
    <script>

    </script>
@endsection
