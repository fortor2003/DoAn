@extends('khachHang.layout.message')
@section('title_tab', config('app.name'))
@section('stylesheets')

@endsection
@section('content')
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
@endsection
@section('scripts')
@endsection
