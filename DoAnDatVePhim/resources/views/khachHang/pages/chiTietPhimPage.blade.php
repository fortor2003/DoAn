@extends('khachHang.layout.master', ['isHomePage' => false])
@section('title_tab', 'Thông tin phim')
@section('above_main_style')
    <!-- jQuery UI -->
    <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <!-- Swiper slider -->
    <link href="{{asset('css/external/idangerous.swiper.css')}}" rel="stylesheet"/>
    <!-- Magnific-popup -->
    <link href="{{asset('css/external/magnific-popup.css')}}" rel="stylesheet"/>
    <!-- select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('stylesheets')
    <style>
        .movie__media {
            padding-top: 20px !important;
        }

        .movie__media .swiper-container .swiper-wrapper {
            width: 100% !important;
        }

        .swiper-slide {
            margin-right: 10px;
            width: 200px !important;
        }

        .swiper-slide a.movie__media-item {
            width: 200px;
            height: 120px;
            margin-right: 10px;
            position: relative;
        }

        .swiper-slide a.movie__media-item .icon-play {
            width: 55px;
            height: 55px;
            position: absolute;
            top: 35px;
            left: 70px;
        }

        .movie__images .movie-poster {
            height: 300px;
        }

        .label-select {
            font-weight: bold;
            padding-right: 10px;
        }
        .label-select .fa {
            padding-right: 5px;
        }
        .time-select {
            margin-top: 20px;
        }
    </style>
@endsection
@section('content')
    <div class="col-sm-12">
        <div class="movie">
            <h2 class="page-heading">{{$thongTinPhim['tieu_de_vi'] ?? '--'}}</h2>
            <div class="movie__info">
                <div class="col-sm-4 col-md-3 movie-mobile">
                    <div class="movie__images">
                        <span class="movie__rating">{{$thongTinPhim['diem_danh_gia'] ?? '--'}}</span>
                        <div class="movie-poster set-bg" data-bg="{{$thongTinPhim['url_anh_bia']}}"></div>
                    </div>
                </div>

                <div class="col-sm-8 col-md-9">
                    <p class="movie__time">{{$thongTinPhim['thoi_luong_chieu'] ?? '--'}} phút</p>
                    <p class="movie__option"><strong>Quốc gia: </strong>{{$thongTinPhim['quoc_gia_san_xuat'] ?? '--'}}
                    </p>
                    <p class="movie__option"><strong>Thể
                            loại: </strong>{{join(', ', array_map(function ($theLoai) { return $theLoai['ten_the_loai']; }, $thongTinPhim['danh_sach_the_loai']))}}
                    </p>
                    <p class="movie__option"><strong>Ngày phát
                            hành: </strong>{{\Carbon\Carbon::parse($thongTinPhim['ngay_phat_hanh'])->format('d/m/Y')}}
                    </p>
                    <p class="movie__option"><strong>Đạo diễn: </strong>{{$thongTinPhim['dao_dien'] ?? '--'}}</p>
                    <p class="movie__option"><strong>Diễn viên: </strong>{{$thongTinPhim['dien_vien'] ?? '--'}}</p>
                    <p class="movie__option"><strong>Giới hạn độ
                            tuổi: </strong>{{$thongTinPhim['gioi_han_do_tuoi'] ?? '--'}}</p>
                    @if($thongTinPhim['trang_thai'] === 'DANG_CHIEU')
                        <div class="movie__btns movie__btns--full">
                            <a href="#" class="btn btn-md btn--warning">Đặt vé</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="clearfix"></div>
            <h2 class="page-heading">Tóm tắt nội dung phim</h2>

            <p class="movie__describe">{{$thongTinPhim['noi_dung_tom_tat'] ?? '--'}}</p>

            <h2 class="page-heading">Ảnh &amp; videos</h2>

            <div class="movie__media">
                <div class="movie__media-switch">
                    <a href="#" class="watchlist list--photo"
                       data-filter='media-photo'>{{$thongTinPhim['url_anh_phong_nen'] ? '1 ảnh' : '0 ảnh'}}</a>
                    <a href="#" class="watchlist list--video"
                       data-filter='media-video'>{{$thongTinPhim['url_trailer_video'] ? '1 videos' : '0 videos'}}</a>
                </div>

                <div class="swiper-container">
                    <div class="swiper-wrapper">
                    @if($thongTinPhim['url_anh_phong_nen'])
                        <!-- Ảnh -->
                            <div class="swiper-slide media-photo">
                                <a href='{{$thongTinPhim['url_anh_phong_nen']}}' class="movie__media-item set-bg"
                                   data-bg="{{$thongTinPhim['url_anh_phong_nen']}}">
                                </a>
                            </div>
                    @endif
                    @if($thongTinPhim['url_trailer_video'])
                        <!-- Video -->
                            <div class="swiper-slide media-video">
                                <a href='{{$thongTinPhim['url_trailer_video']}}' class="movie__media-item set-bg"
                                   data-bg="{{\App\Utils\StringUtil::getUrlThumbnailVideoYoutube(\App\Utils\StringUtil::getParamValueOfQueryStringUrl($thongTinPhim['url_trailer_video'], 'v'))}}">
                                    <div class="set-bg icon-play" data-bg="{{asset('images/button-play.png')}}"></div>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if($thongTinPhim['trang_thai'] === 'DANG_CHIEU')
            <h2 class="page-heading">Các suất chiếu</h2>
            <div class="choose-container">

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

                <div class="clearfix"></div>

                <div class="time-select">
                    @foreach($danhSachSuatChieu as $rap)
                        @php $danhSachGioChieu = $rap['danh_sach_suat_chieu']; @endphp
                        <div class="time-select__group group--first">
                            <div class="col-sm-4">
                                <p class="time-select__place">{{$rap['ten_rap']}}</p>
                            </div>
                            <ul class="col-sm-8 items-wrap">
                                @foreach($danhSachGioChieu as $gioChieu)
                                    <li class="time-select__item" data-id="{{$gioChieu['id']}}" data-time='{{$gioChieu['gio_bat_dau']['thoi_gian']}}'>{{$gioChieu['gio_bat_dau']['thoi_gian']}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
            <input type="hidden" id="txtPhimId" value="{{$thongTinPhim['id']}}">
        @endsection
    @section('scripts')
        <!-- jQuery UI -->
            <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
            <script src="{{asset('js/external/jquery.ui.datepicker-vi-VN.js')}}"></script>
            <!-- Swiper slider -->
            <script src="{{asset('js/external/idangerous.swiper.min.js')}}"></script>
            <!-- Magnific-popup -->
            <script src="{{asset('js/external/jquery.magnific-popup.min.js')}}"></script>
            <!-- Select 2 -->
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
            <!--  Moment -->
            <script src="{{asset('js/external/moment-with-locales.min.js')}}"></script>
            <!-- Page -->
            <script src="{{asset('js/pages/khachHang/chiTietPhimPage.js')}}"></script>
@endsection
