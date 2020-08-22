@extends('khachHang.layout.master', ['isHomePage' => false])
@section('title_tab', 'Thông tin phim')
@section('above_main_style')
    <!-- jQuery UI -->
    <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <!-- Swiper slider -->
    <link href="{{asset('css/external/idangerous.swiper.css')}}" rel="stylesheet" />
    <!-- Mobile menu -->
    <link href="{{asset('css/gozha-nav.css')}}" rel="stylesheet" />
    <!-- select 2 -->
    <link href="{{asset('css/external/select2.min.css')}}" rel="stylesheet"/>
@endsection
@section('stylesheets')
    <style>
        .film-images {
            height: 280px;
        }
        .label-select {
            font-weight: bold;
            padding-right: 10px;
        }
        .label-select .fa {
            padding-right: 5px;
        }
    </style>
@endsection
@section('content')
    <div class="order-container">
        <div class="order">
            <img class="order__images" alt='' src="{{asset('images/ticket.png')}}">
            <p class="order__title">Đặt vé <br><span class="order__descript">và trải nghiệm</span></p>
        </div>
    </div>
    <div class="order-step-area">
        <div class="order-step first--step">1. Phim & Rạp & Giờ chiếu</div>
    </div>
    <h2 class="page-heading heading--outcontainer">Phim</h2>
    <div class="choose-film">
        <div class="swiper-container">
            <div class="swiper-wrapper">
            @foreach($danhSachPhimDangChieu as $phim)
                <!--First Slide-->
                    <div class="swiper-slide" data-film='{{$phim['tieu_de_vi']}}'>
                        <div class="film-images set-bg" data-bg="{{$phim['url_anh_bia']}}" data-phim-id="{{$phim['id']}}"></div>
                        <p class="choose-film__title">{{$phim['tieu_de_vi']}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <section class="container">
        <div class="col-sm-12">
            <div class="choose-indector choose-indector--film">
                <strong>Bạn đã chọn phim: </strong><span class="choosen-area"></span>
            </div>

            <h2 class="page-heading">Rạp &amp; Giờ chiếu</h2>

            <div class="choose-container choose-container--short">
                <span class="label-select"><i class="fa fa-location-arrow"></i>Rạp</span>
                <select id="chonRap" style="width: 150px">
                    <option value="0" selected='selected'>Tất cả</option>
                    @foreach($danhSachRap as $rap)
                        <option value="{{$rap['id']}}">{{$rap['ten_rap']}}</option>
                    @endforeach
                </select>

                <div class="datepicker">
                    <span class="datepicker__marker"><i class="fa fa-calendar"></i>Ngày chiếu</span>
                    <input type="text" id="ngayChieu" value='' class="datepicker__input">
                </div>
            </div>

            <h2 class="page-heading">Giờ chiếu</h2>

            <div class="time-select time-select--wide"></div>

            <div class="choose-indector choose-indector--time">
                <strong>Bạn đã chọn rạp: </strong><span class="choosen-location"></span><br/>
                <strong>Bạn đã chọn giờ chiếu: </strong><span class="choosen-time"></span>
            </div>
        </div>

    </section>
    <div class="clearfix"></div>
    <form id='formChonSuatChieu' method='get' action="{{route('khachHang.datGhePage')}}">
        <input type='hidden' id="phimId" class="choosen-movie" value="{{$phimId ?? null}}">
        <input type='hidden' id="suatChieuId" name="suat_chieu_id" class="choosen-movie">
        <div class="booking-pagination">
            <button type="submit" class="booking-pagination__next">
                <span class="arrow__text arrow--next">Bước kế tiếp</span>
                <span class="arrow__info">Chọn ghế</span>
            </button>
        </div>
    </form>
@endsection

@section('scripts')
    <!-- jQuery UI -->
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="{{asset('js/external/jquery.ui.datepicker-vi-VN.js')}}"></script>
    <!-- Swiper slider -->
    <script src="{{asset('js/external/idangerous.swiper.min.js')}}"></script>
    <!-- Select 2 -->
    <script src="{{asset('js/external/select2.min.js')}}"></script>
    <!--  Moment -->
    <script src="{{asset('js/external/moment-with-locales.min.js')}}"></script>
    <!-- Page -->
    <script src="{{asset('js/pages/khachHang/datVePage.js')}}"></script>
@endsection
