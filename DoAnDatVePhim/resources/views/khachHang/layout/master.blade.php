<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title_tab', '--')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="telephone=no" name="format-detection">
    @include('khachHang.layout._stylesheets')
    @yield('stylesheets')
</head>
<body>
    <div class="wrapper">
        @include('khachHang.layout._banner')
        @include('khachHang.layout._header')
        @if($isHomePage)
            @include('khachHang.layout._slide_banner_home_page')
        @else
            @include('khachHang.layout._searchbar')
        @endif
        <section class="container">
            @yield('content')
        </section>

        @yield('content1')

        <div class="clearfix"></div>

        @yield('pagination')

        @include('khachHang.layout._footer')
    </div>
    @include('khachHang.layout._sign_in_popup')
    @include('khachHang.layout._scripts')
    @yield('scripts')
</body>
