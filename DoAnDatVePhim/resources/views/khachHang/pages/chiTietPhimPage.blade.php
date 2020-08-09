@extends('khachHang.layout.master', ['isHomePage' => false])
@section('title_tab', 'Thông tin phim')
@section('above_main_style')
    <!-- jQuery UI -->
    <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <!-- Swiper slider -->
    <link href="{{asset('css/external/idangerous.swiper.css')}}" rel="stylesheet" />
    <!-- Magnific-popup -->
    <link href="{{asset('css/external/magnific-popup.css')}}" rel="stylesheet" />
@endsection
@section('stylesheets')
    <style>
        .movie__images .movie-poster {
            height: 360px;
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
{{--                        <img alt='' src="http://placehold.it/526x773">--}}
                        <div class="movie-poster set-bg" data-bg="{{$thongTinPhim['url_anh_bia']}}"></div>
                    </div>
                    <div class="movie__rate">Đánh giá: <div id='score' class="score"></div></div>
                </div>

                <div class="col-sm-8 col-md-9">
                    <p class="movie__time">{{$thongTinPhim['thoi_luong_chieu'] ?? '--'}} phút</p>

                    <p class="movie__option"><strong>Quốc gia: </strong>{{$thongTinPhim['quoc_gia_san_xuat'] ?? '--'}}</p>
                    <p class="movie__option"><strong>Thể loại: </strong>{{join(', ', array_map(function ($theLoai) { return $theLoai['ten_the_loai']; }, $thongTinPhim['danh_sach_the_loai']))}}</p>
                    <p class="movie__option"><strong>Ngày phát hành: </strong>{{\Carbon\Carbon::parse($thongTinPhim['ngay_phat_hanh'])->format('d/m/Y')}}</p>
                    <p class="movie__option"><strong>Đạo diễn: </strong>{{$thongTinPhim['dao_dien'] ?? '--'}}</p>
                    <p class="movie__option"><strong>Diễn viên: </strong>{{$thongTinPhim['dien_vien'] ?? '--'}}</p>
                    <p class="movie__option"><strong>Giới hạn độ tuổi: </strong>{{$thongTinPhim['gioi_han_do_tuoi'] ?? '--'}}</p>

                    <div class="movie__btns movie__btns--full">
                        <a href="#" class="btn btn-md btn--warning">Đặt vé</a>
                        <a href="#" class="watchlist">Thêm vào danh sách theo dõi</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <h2 class="page-heading">Tóm tắt nội dung phim</h2>

            <p class="movie__describe">{{$thongTinPhim['noi_dung_tom_tat'] ?? '--'}}</p>

            <h2 class="page-heading">Ảnh &amp; videos</h2>

            <div class="movie__media">
                <div class="movie__media-switch">
                    <a href="#" class="watchlist list--photo" data-filter='media-photo'>1 ảnh</a>
                    <a href="#" class="watchlist list--video" data-filter='media-video'>1 videos</a>
                </div>

                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <!-- Ảnh -->
                        <div class="swiper-slide media-photo">
                            <a href='{{$thongTinPhim['url_anh_phong_nen']}}' class="movie__media-item">
                                <img alt='' src="{{$thongTinPhim['url_anh_phong_nen']}}">
                            </a>
                        </div>
                        <!-- Video -->
                        <div class="swiper-slide media-video">
                            <a href='{{$thongTinPhim['url_trailer_video']}}' class="movie__media-item ">
                                <img alt='' src="{{\App\Utils\StringUtil::getUrlThumbnailVideoYoutube(\App\Utils\StringUtil::getParamValueOfQueryStringUrl($thongTinPhim['url_trailer_video'], 'v'))}}">
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <h2 class="page-heading">Các suất chiếu</h2>
        <div class="choose-container">
            <form id='select' class="select" method='get'>
                <select name="select_item" id="select-sort" class="select__sort" tabindex="0">
                    <option value="1" selected='selected'>Hồ Chí Minh</option>
                    <option value="2">Đà Nẵng</option>
                    <option value="3">Hà Nội</option>
                </select>
            </form>

            <div class="datepicker">
                <span class="datepicker__marker"><i class="fa fa-calendar"></i>Ngày</span>
                <input type="text" id="datepicker" value='03/10/2014' class="datepicker__input">
            </div>

            <a href="#" id="map-switch" class="watchlist watchlist--map watchlist--map-full"><span class="show-map">Hiển thị các rạp chiếu trên bản đồ</span><span  class="show-time">Hiển thị các rạp chiếu ở dạng bảng</span></a>

            <div class="clearfix"></div>

            <div class="time-select">
                <div class="time-select__group group--first">
                    <div class="col-sm-4">
                        <p class="time-select__place">Rạp 1</p>
                    </div>
                    <ul class="col-sm-8 items-wrap">
                        <li class="time-select__item" data-time='09:40'>09:40</li>
                        <li class="time-select__item" data-time='13:45'>13:45</li>
                        <li class="time-select__item active" data-time='15:45'>15:45</li>
                        <li class="time-select__item" data-time='19:50'>19:50</li>
                        <li class="time-select__item" data-time='21:50'>21:50</li>
                    </ul>
                </div>

                <div class="time-select__group">
                    <div class="col-sm-4">
                        <p class="time-select__place">Rạp 2</p>
                    </div>
                    <ul class="col-sm-8 items-wrap">
                        <li class="time-select__item" data-time='10:45'>10:45</li>
                        <li class="time-select__item" data-time='16:00'>16:00</li>
                        <li class="time-select__item" data-time='19:00'>19:00</li>
                        <li class="time-select__item" data-time='21:15'>21:15</li>
                        <li class="time-select__item" data-time='23:00'>23:00</li>
                    </ul>
                </div>

                <div class="time-select__group">
                    <div class="col-sm-4">
                        <p class="time-select__place">Rạp 3</p>
                    </div>
                    <ul class="col-sm-8 items-wrap">
                        <li class="time-select__item" data-time='09:00'>09:00</li>
                        <li class="time-select__item" data-time='11:00'>11:00</li>
                        <li class="time-select__item" data-time='13:00'>13:00</li>
                        <li class="time-select__item" data-time='15:00'>15:00</li>
                        <li class="time-select__item" data-time='17:00'>17:00</li>
                        <li class="time-select__item" data-time='19:0'>19:00</li>
                        <li class="time-select__item" data-time='21:0'>21:00</li>
                        <li class="time-select__item" data-time='23:0'>23:00</li>
                        <li class="time-select__item" data-time='01:0'>01:00</li>
                    </ul>
                </div>

                <div class="time-select__group">
                    <div class="col-sm-4">
                        <p class="time-select__place">Rạp 4</p>
                    </div>
                    <ul class="col-sm-8 items-wrap">
                        <li class="time-select__item" data-time='10:45'>10:45</li>
                        <li class="time-select__item" data-time='16:00'>16:00</li>
                        <li class="time-select__item" data-time='19:00'>19:00</li>
                        <li class="time-select__item" data-time='21:15'>21:15</li>
                        <li class="time-select__item" data-time='23:00'>23:00</li>
                    </ul>
                </div>

                <div class="time-select__group group--last">
                    <div class="col-sm-4">
                        <p class="time-select__place">Rạp 5</p>
                    </div>
                    <ul class="col-sm-8 items-wrap">
                        <li class="time-select__item" data-time='17:45'>17:45</li>
                        <li class="time-select__item" data-time='21:30'>21:30</li>
                        <li class="time-select__item" data-time='02:20'>02:20</li>
                    </ul>
                </div>
            </div>

            <!-- hiden maps with multiple locator-->
            <div  class="map">
                <div id='cimenas-map'></div>
            </div>

            <h2 class="page-heading">Bình luận (15)</h2>

            <div class="comment-wrapper">
                <form id="comment-form" class="comment-form" method='post'>
                    <textarea class="comment-form__text" placeholder='Viết bình luận ở đây'></textarea>
                    <label class="comment-form__info">Còn lại 250 ký tự</label>
                    <button type='submit' class="btn btn-md btn--danger comment-form__btn">Gửi bình luận</button>
                </form>

                <div class="comment-sets">

                    <div class="comment">
                        <div class="comment__images">
                            <img alt='' src="http://placehold.it/50x50">
                        </div>

                        <a href='#' class="comment__author"><span class="social-used fa fa-facebook"></span>Roberta Inetti</a>
                        <p class="comment__date">Hôm nay | 03:04</p>
                        <p class="comment__message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vitae enim sollicitudin, euismod erat id, fringilla lacus. Cras ut rutrum lectus. Etiam ante justo, volutpat at viverra a, mattis in velit. Morbi molestie rhoncus enim, vitae sagittis dolor tristique et.</p>
                        <a href='#' class="comment__reply">Phản hồi</a>
                    </div>

                    <div class="comment">
                        <div class="comment__images">
                            <img alt='' src="http://placehold.it/50x50">
                        </div>

                        <a href='#' class="comment__author"><span class="social-used fa fa-vk"></span>Olia Gozha</a>
                        <p class="comment__date">22.10.2013 | 14:40</p>
                        <p class="comment__message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vitae enim sollicitudin, euismod erat id, fringilla lacus. Cras ut rutrum lectus. Etiam ante justo, volutpat at viverra a, mattis in velit. Morbi molestie rhoncus enim, vitae sagittis dolor tristique et.</p>
                        <a href='#' class="comment__reply">Phản hồi</a>
                    </div>

                    <div class="comment comment--answer">
                        <div class="comment__images">
                            <img alt='' src="http://placehold.it/50x50">
                        </div>

                        <a href='#' class="comment__author"><span class="social-used fa fa-vk"></span>Dmitriy Pustovalov</a>
                        <p class="comment__date">Hôm nay | 10:19</p>
                        <p class="comment__message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vitae enim sollicitudin, euismod erat id, fringilla lacus. Cras ut rutrum lectus. Etiam ante justo, volutpat at viverra a, mattis in velit. Morbi molestie rhoncus enim, vitae sagittis dolor tristique et.</p>
                        <a href='#' class="comment__reply">Phản hồi</a>
                    </div>

                    <div class="comment comment--last">
                        <div class="comment__images">
                            <img alt='' src="http://placehold.it/50x50">
                        </div>

                        <a href='#' class="comment__author"><span class="social-used fa fa-facebook"></span>Sia Andrews</a>
                        <p class="comment__date"> 22.10.2013 | 12:31 </p>
                        <p class="comment__message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vitae enim sollicitudin, euismod erat id, fringilla lacus. Cras ut rutrum lectus. Etiam ante justo, volutpat at viverra a, mattis in velit. Morbi molestie rhoncus enim, vitae sagittis dolor tristique et.</p>
                        <a href='#' class="comment__reply">Phản hồi</a>
                    </div>

                    <div id='hide-comments' class="hide-comments">
                        <div class="comment">
                            <div class="comment__images">
                                <img alt='' src="http://placehold.it/50x50">
                            </div>

                            <a href='#' class="comment__author"><span class="social-used fa fa-facebook"></span>Roberta Inetti</a>
                            <p class="comment__date">Hôm nay | 03:04</p>
                            <p class="comment__message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vitae enim sollicitudin, euismod erat id, fringilla lacus. Cras ut rutrum lectus. Etiam ante justo, volutpat at viverra a, mattis in velit. Morbi molestie rhoncus enim, vitae sagittis dolor tristique et.</p>
                            <a href='#' class="comment__reply">Phản hồi</a>
                        </div>

                        <div class="comment">
                            <div class="comment__images">
                                <img alt='' src="http://placehold.it/50x50">
                            </div>

                            <a href='#' class="comment__author"><span class="social-used fa fa-vk"></span>Olia Gozha</a>
                            <p class="comment__date">22.10.2013 | 14:40</p>
                            <p class="comment__message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vitae enim sollicitudin, euismod erat id, fringilla lacus. Cras ut rutrum lectus. Etiam ante justo, volutpat at viverra a, mattis in velit. Morbi molestie rhoncus enim, vitae sagittis dolor tristique et.</p>
                            <a href='#' class="comment__reply">Phản hồi</a>
                        </div>
                    </div>

                    <div class="comment-more">
                        <a href="#" class="watchlist">Hiển thị thêm bình luận</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- jQuery UI -->
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <!-- Swiper slider -->
    <script src="{{asset('js/external/idangerous.swiper.min.js')}}"></script>
    <!-- Magnific-popup -->
    <script src="{{asset('js/external/jquery.magnific-popup.min.js')}}"></script>
    <!--*** Google map  ***-->
    <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
    <!--*** Google map infobox  ***-->
    <script src="{{asset('js/external/infobox.js')}}"></script>
    <!-- Share buttons -->
    <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
    <!-- Page -->
    <script src="{{asset('js/pages/khachHang/chiTietPhimPage.js')}}"></script>
    <script>

    </script>
@endsection
