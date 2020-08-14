@extends('khachHang.layout.master', ['isHomePage' => true])
@section('title_tab', 'Trang chủ')
@section('above_main_style')
    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="{{asset('rs-plugin/css/settings.css')}}" media="screen" />
@endsection
@section('stylesheets')
    <style>
        .movie-beta__item .movie-poster {
            height: 260px;
        }
        .movie .movie__images .movie-beta__link {
            height: 250px;
        }
    </style>
@endsection
@section('content')
    <div class="movie-best">
        <div class="col-sm-10 col-sm-offset-1 movie-best__rating">HAY NHẤT HÔM NAY</div>
        <div class="col-sm-12 change--col">
            @foreach($danhSachPhimHayNhatHomNay as $idx => $phim)
                @php
                    $extendClass = '';
                    switch ($idx) {
                        case 0: $extendClass = ''; break;
                        case 1: $extendClass = 'second--item'; break;
                        case 2: $extendClass = 'third--item'; break;
                        case 3: $extendClass = 'hidden-xs'; break;
                        default: $extendClass = 'hidden-xs hidden-sm'; break;
                    }
                @endphp
                <div class="movie-beta__item {{$extendClass}}">
                    <div class="movie-poster set-bg" data-bg="{{$phim['url_anh_bia']}}"></div>
                    <span class="best-rate">{{$phim['diem_danh_gia']}}</span>
                    <ul class="movie-beta__info">
                        <li><span class="best-voted">100 lượt bình chọn hôm nay</span></li>
                        <li>
                            <p class="movie__time">{{$phim['thoi_luong_chieu']}} phút</p>
                            <p>{{join(' | ', array_map(function ($theLoai) { return $theLoai['ten_the_loai']; }, $phim['danh_sach_the_loai']))}}</p>
                        </li>
                        <li class="last-block">
                            <a href="movie-page-left.html" class="slide__link">Chi tiết</a>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
        <div class="col-sm-10 col-sm-offset-1 movie-best__check">các phim đang chiếu</div>
    </div>
    <div class="col-sm-12">
        <div class="mega-select-present mega-select-top mega-select--full">
            <div class="mega-select-marker">
                <div class="marker-indecator cinema">
                    <p class="select-marker"><span>Tìm các </span> <br>rạp chiếu</p>
                </div>
                <div class="marker-indecator film-category">
                    <p class="select-marker"><span>Tìm phim theo thể loại </span> <br> yêu thích</p>
                </div>
            </div>

            <div class="mega-select pull-right">
                <span class="mega-select__point">Tìm theo</span>
                <ul class="mega-select__sort">
                    <li class="filter-wrap"><a href="#" class="mega-select__filter filter--active" data-filter='cinema'>Rạp</a></li>
                    <li class="filter-wrap"><a href="#" class="mega-select__filter" data-filter='film-category'>Thể loại</a></li>
                </ul>

                <input name="search-input" type='text' class="select__field">

                <div class="select__btn">
                    <a href="#" class="btn btn-md btn--danger cinema">Tìm <span class="hidden-exrtasm">rạp</span></a>
                    <a href="#" class="btn btn-md btn--danger film-category">Tìm <span class="hidden-exrtasm">theo thể loại</span></a>
                </div>

                <div class="select__dropdowns">
                    <ul class="select__group cinema">
                        <li class="select__variant" data-value='Cineworld'>Cineworld</li>
                        <li class="select__variant" data-value='Empire'>Empire</li>
                        <li class="select__variant" data-value='Everyman'>Everyman</li>
                        <li class="select__variant" data-value='Odeon'>Odeon</li>
                        <li class="select__variant" data-value='Picturehouse'>Picturehouse</li>
                    </ul>
                    <ul class="select__group film-category">
                        @foreach($theLoai as  $tt)
                            <li class="select__variant" data-value='{{$tt['id']}}'>{{$tt['ten_the_loai']}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <h2 id='target' class="page-heading heading--outcontainer">Phim đang chiếu</h2>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-8 col-md-9">
                <!-- Movie variant with time -->
                @foreach($danhSachPhimDangChieu as $idx => $phim)
                    <div class="movie movie--test movie--test--dark movie--test--{{intval(floor($idx/2)) % 2 == 0 ? 'left' : 'right'}}">
                        <div class="movie__images">
                            <a href="#" class="movie-beta__link set-bg" data-bg="{{$phim['url_anh_bia']}}">
                            </a>
                        </div>
                        <div class="movie__info">
                            <a href='#' class="movie__title">{{$phim['tieu_de_vi']}}</a>
                            <p class="movie__time">{{$phim['thoi_luong_chieu']}} phút</p>
                            <p class="movie__option">
                                {{join(' | ', array_map(function ($theLoai) { return $theLoai['ten_the_loai']; }, $phim['danh_sach_the_loai']))}}
                            </p>
                            <div class="movie__rate">
                                <div class="score"></div>
                                <span class="movie__rating">{{$phim['diem_danh_gia']}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <aside class="col-sm-4 col-md-3">
                <div class="sitebar first-banner--left">
                    <div class="banner-wrap first-banner--left">
                        <img alt='banner' src="http://placehold.it/500x500">
                    </div>

                    <div class="banner-wrap">
                        <img alt='banner' src="http://placehold.it/500x500">
                    </div>

                    <div class="banner-wrap banner-wrap--last">
                        <img alt='banner' src="http://placehold.it/500x500">
                    </div>

                    <div class="promo marginb-sm">
                        <div class="promo__head">A.Movie app</div>
                        <div class="promo__describe">for all smartphones<br> and tablets</div>
                        <div class="promo__content">
                            <ul>
                                <li class="store-variant"><a href="#"><img alt=''
                                                                           src="images/apple-store.svg"></a></li>
                                <li class="store-variant"><a href="#"><img alt=''
                                                                           src="images/google-play.svg"></a></li>
                                <li class="store-variant"><a href="#"><img alt=''
                                                                           src="images/windows-store.svg"></a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </aside>
        </div>
    </div>
{{--    <div class="col-sm-12">--}}
{{--        <h2 class="page-heading">Tin tức mới nhất</h2>--}}
{{--        <div class="col-sm-4 similar-wrap col--remove">--}}
{{--            <div class="post post--preview post--preview--wide">--}}
{{--                <div class="post__image">--}}
{{--                    <img alt='' src="http://placehold.it/270x330">--}}
{{--                    <div class="social social--position social--hide">--}}
{{--                        <span class="social__name">Share:</span>--}}
{{--                        <a href='#' class="social__variant social--first fa fa-facebook"></a>--}}
{{--                        <a href='#' class="social__variant social--second fa fa-twitter"></a>--}}
{{--                        <a href='#' class="social__variant social--third fa fa-vk"></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <p class="post__date">22 October 2013 </p>--}}
{{--                <a href="single-page-left.html" class="post__title">"Thor: The Dark World" - World Premiere</a>--}}
{{--                <a href="single-page-left.html" class="btn read-more post--btn">read more</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-sm-4 similar-wrap col--remove">--}}
{{--            <div class="post post--preview post--preview--wide">--}}
{{--                <div class="post__image">--}}
{{--                    <img alt='' src="http://placehold.it/270x330">--}}
{{--                    <div class="social social--position social--hide">--}}
{{--                        <span class="social__name">Share:</span>--}}
{{--                        <a href='#' class="social__variant social--first fa fa-facebook"></a>--}}
{{--                        <a href='#' class="social__variant social--second fa fa-twitter"></a>--}}
{{--                        <a href='#' class="social__variant social--third fa fa-vk"></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <p class="post__date">22 October 2013 </p>--}}
{{--                <a href="single-page-left.html" class="post__title">30th Annual Night Of Stars Presented By The Fashion Group International</a>--}}
{{--                <a href="single-page-left.html" class="btn read-more post--btn">read more</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-sm-4 similar-wrap col--remove">--}}
{{--            <div class="post post--preview post--preview--wide">--}}
{{--                <div class="post__image">--}}
{{--                    <img alt='' src="http://placehold.it/270x330">--}}
{{--                    <div class="social social--position social--hide">--}}
{{--                        <span class="social__name">Share:</span>--}}
{{--                        <a href='#' class="social__variant social--first fa fa-facebook"></a>--}}
{{--                        <a href='#' class="social__variant social--second fa fa-twitter"></a>--}}
{{--                        <a href='#' class="social__variant social--third fa fa-vk"></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <p class="post__date">22 October 2013 </p>--}}
{{--                <a href="single-page-left.html" class="post__title">Hollywood Film Awards 2013</a>--}}
{{--                <a href="single-page-left.html" class="btn read-more post--btn">read more</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
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
