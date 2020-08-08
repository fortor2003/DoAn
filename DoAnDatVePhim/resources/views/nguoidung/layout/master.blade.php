<!doctype html>
<html>
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <title>AMovie</title>
    <meta name="description" content="A Template by Gozha.net">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Gozha.net">

    <!-- Mobile Specific Metas-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="telephone=no" name="format-detection">

    @include('nguoidung.layout.header')

</head>

<body>
<div class="wrapper">
    <!-- Banner -->
    @include('nguoidung.layout.banner')

    <!-- Header section -->
    @include('nguoidung.layout.header_section')

    <!-- Slider -->
    @include('nguoidung.layout.slider')

    <!--end slider -->

    <!-- Main content -->
    @yield('noiDung')

    <div class="clearfix"></div>

    <!--footer-->
    @include('nguoidung.layout.footer')

</body>
</html>
