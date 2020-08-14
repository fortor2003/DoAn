<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="telephone=no" name="format-detection">
    @include('khachHang.layout._stylesheets')
</head>
<body>
<div class="wrapper">
    <div class="error-wrapper">
        <a href='index.html' class="logo logo--dark">
            <img alt='logo' src="{{asset('images/logo-dark.png')}}">
            <p class="slogan--dark"></p>
        </a>

        <div class="error">
            <h1 class="error__text">{{$message}}</h1>
            <a href="{{route('khachHang.trangChuPage')}}" class="btn btn-md btn--warning">Quay về trang chủ</a>
        </div>
    </div>
    <div class="copy-bottom">
        <p class="copy">&copy; BKCinema, 2020</p>
    </div>
</div>
</body>
