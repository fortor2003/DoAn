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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
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
            <img class="order__images" alt='' src="images/tickets.png">
            <p class="order__title">Đặt vé <br><span class="order__descript">và trải nghiệm</span></p>
            <div class="order__control">
                <a href="#" class="order__control-btn active">Thanh toán</a>
                <a href="#" class="order__control-btn">Quay lại</a>
            </div>
        </div>
    </div>
    <div class="order-step-area">
        <div class="order-step first--step">1. Chọn Phim & Rạp & Giờ chiếu</div>
    </div>

    <h2 class="page-heading heading--outcontainer">Chọn phim</h2>
@endsection

@section('pagination')
    <form id='film-and-time' class="booking-form" method='get' action='book2.html'>
        <input type='text' name='choosen-movie' class="choosen-movie">

        <input type='text' name='choosen-city' class="choosen-city">
        <input type='text' name='choosen-date' class="choosen-date">

        <input type='text' name='choosen-cinema' class="choosen-cinema">
        <input type='text' name='choosen-time' class="choosen-time">


        <div class="booking-pagination">
            <a href="#" class="booking-pagination__prev hide--arrow">
                <span class="arrow__text arrow--prev"></span>
                <span class="arrow__info"></span>
            </a>
            <a href="book2.html" class="booking-pagination__next">
                <span class="arrow__text arrow--next">Bước kế tiếp</span>
                <span class="arrow__info">Chọn ghế</span>
            </a>
        </div>

    </form>
@endsection

@section('content1')
    <div class="choose-film">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($danhSachPhimDangChieu as $phim)
                <!--First Slide-->
                <div class="swiper-slide" data-film='{{$phim['tieu_de_vi']}}'>
                    <div class="film-images set-bg" data-bg="{{$phim['url_anh_bia']}}"></div>
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

            <h2 class="page-heading">Chọn giờ chiếu</h2>

            <div class="time-select time-select--wide">
                <div class="time-select__group group--first">
                    <div class="col-sm-3">
                        <p class="time-select__place">Cineworld</p>
                    </div>
                    <ul class="col-sm-6 items-wrap">
                        <li class="time-select__item" data-time='09:40'>09:40</li>
                        <li class="time-select__item" data-time='13:45'>13:45</li>
                        <li class="time-select__item" data-time='15:45'>15:45</li>
                        <li class="time-select__item" data-time='19:50'>19:50</li>
                        <li class="time-select__item" data-time='21:50'>21:50</li>
                    </ul>
                </div>

                <div class="time-select__group">
                    <div class="col-sm-3">
                        <p class="time-select__place">Empire</p>
                    </div>
                    <ul class="col-sm-6 items-wrap">
                        <li class="time-select__item" data-time='10:45'>10:45</li>
                        <li class="time-select__item" data-time='16:00'>16:00</li>
                        <li class="time-select__item" data-time='19:00'>19:00</li>
                        <li class="time-select__item" data-time='21:15'>21:15</li>
                        <li class="time-select__item" data-time='23:00'>23:00</li>
                    </ul>
                </div>

                <div class="time-select__group">
                    <div class="col-sm-3">
                        <p class="time-select__place">Curzon</p>
                    </div>
                    <ul class="col-sm-6 items-wrap">
                        <li class="time-select__item" data-time='09:00'>09:00</li>
                        <li class="time-select__item" data-time='11:00'>11:00</li>
                        <li class="time-select__item" data-time='13:00'>13:00</li>
                        <li class="time-select__item" data-time='15:00'>15:00</li>
                        <li class="time-select__item" data-time='17:00'>17:00</li>
                        <li class="time-select__item" data-time='19:00'>19:00</li>
                        <li class="time-select__item" data-time='21:00'>21:00</li>
                        <li class="time-select__item" data-time='23:00'>23:00</li>
                        <li class="time-select__item" data-time='01:00'>01:00</li>
                    </ul>
                </div>

                <div class="time-select__group">
                    <div class="col-sm-3">
                        <p class="time-select__place">Odeon</p>
                    </div>
                    <ul class="col-sm-6 items-wrap">
                        <li class="time-select__item" data-time='10:45'>10:45</li>
                        <li class="time-select__item" data-time='16:00'>16:00</li>
                        <li class="time-select__item" data-time='19:00'>19:00</li>
                        <li class="time-select__item" data-time='21:15'>21:15</li>
                        <li class="time-select__item" data-time='23:00'>23:00</li>
                    </ul>
                </div>

                <div class="time-select__group group--last">
                    <div class="col-sm-3">
                        <p class="time-select__place">Picturehouse</p>
                    </div>
                    <ul class="col-sm-6 items-wrap">
                        <li class="time-select__item" data-time='17:45'>17:45</li>
                        <li class="time-select__item" data-time='21:30'>21:30</li>
                        <li class="time-select__item" data-time='02:20'>02:20</li>
                    </ul>
                </div>
            </div>

            <div class="choose-indector choose-indector--time">
                <strong>Bạn đã chọn rạp: </strong><span class="choosen-location"></span><br/>
                <strong>Bạn đã chọn giờ chiếu: </strong><span class="choosen-time"></span>
            </div>
        </div>

    </section>
@endsection

@section('pagination')
    <form id='formDatVe' class="booking-form" method='get' action='book2.html'>
        <input type='text' id="txtSuatChieuId">

        <div class="booking-pagination">
            <a href="#" class="booking-pagination__prev hide--arrow">
                <span class="arrow__text arrow--prev"></span>
                <span class="arrow__info"></span>
            </a>
            <a href="book2.html" class="booking-pagination__next">
                <span class="arrow__text arrow--next">next step</span>
                <span class="arrow__info">choose a sit</span>
            </a>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!--  Moment -->
    <script src="{{asset('js/external/moment-with-locales.min.js')}}"></script>
    <!-- Page -->
    <script src="{{asset('js/pages/khachHang/datVePage.js')}}"></script>
@endsection
