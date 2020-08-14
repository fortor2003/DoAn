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
        @yield('content')
    </div>
    @yield('scripts')
</body>
