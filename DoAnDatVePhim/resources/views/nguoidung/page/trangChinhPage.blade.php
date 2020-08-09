@extends('nguoidung.layout.master')

@section('slider')
    @include('nguoidung.layout.slider')
@endsection

@section('noiDung')
    <section class="container">
        <div class="movie-best">
            <div class="col-sm-10 col-sm-offset-1 movie-best__rating">HAY NHẤT HÔM NAY</div>
            <div class="col-sm-12 change--col">
                @foreach($danhSachPhimHayNhatHomNay as $phim)
                <div class="movie-beta__item ">
                    <img alt='' src="{{$phim['url_anh_bia']}}">
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
                    <div class="marker-indecator location">
                        <p class="select-marker"><span>Chọn nơi gần khu vực</span> <br>của bạn</p>
                    </div>

                    <div class="marker-indecator cinema">
                        <p class="select-marker"><span>Tìm các </span> <br>rạp chiếu</p>
                    </div>

                    <div class="marker-indecator film-category">
                        <p class="select-marker"><span>Tìm phim theo thể loại </span> <br> yêu thích</p>
                    </div>

                    <div class="marker-indecator actors">
                        <p class="select-marker"><span>Tìm phim theo </span><br> ngôi sao điện ảnh</p>
                    </div>

                    <div class="marker-indecator director">
                        <p class="select-marker"><span>Tìm phim theo </span> <br>đạo diễn</p>
                    </div>

                    <div class="marker-indecator country">
                        <p class="select-marker"><span>Tìm phim theo </span> <br>quốc gia</p>
                    </div>
                </div>

                <div class="mega-select pull-right">
                    <span class="mega-select__point">Tìm theo</span>
                    <ul class="mega-select__sort">
                        <li class="filter-wrap"><a href="#" class="mega-select__filter filter--active" data-filter='location'>Khu vực</a></li>
                        <li class="filter-wrap"><a href="#" class="mega-select__filter" data-filter='cinema'>Rạp</a></li>
                        <li class="filter-wrap"><a href="#" class="mega-select__filter" data-filter='film-category'>Thể loại</a></li>
                        <li class="filter-wrap"><a href="#" class="mega-select__filter" data-filter='actors'>Diễn viên</a></li>
                        <li class="filter-wrap"><a href="#" class="mega-select__filter" data-filter='director'>Đạo diễn</a></li>
                        <li class="filter-wrap"><a href="#" class="mega-select__filter" data-filter='country'>Quốc gia</a></li>
                    </ul>

                    <input name="search-input" type='text' class="select__field">

                    <div class="select__btn">
                        <a href="#" class="btn btn-md btn--danger location">find <span class="hidden-exrtasm"></span></a>
                        <a href="#" class="btn btn-md btn--danger cinema">find <span class="hidden-exrtasm">suitable cimema</span></a>
                        <a href="#" class="btn btn-md btn--danger film-category">find <span class="hidden-exrtasm">best category</span></a>
                        <a href="#" class="btn btn-md btn--danger actors">find <span class="hidden-exrtasm">talented actors</span></a>
                        <a href="#" class="btn btn-md btn--danger director">find <span class="hidden-exrtasm">favorite director</span></a>
                        <a href="#" class="btn btn-md btn--danger country">find <span class="hidden-exrtasm">produced country</span></a>
                    </div>

                    <div class="select__dropdowns">
                        <ul class="select__group location">
                            <li class="select__variant" data-value='London'>London</li>
                            <li class="select__variant" data-value='New York'>New York</li>
                            <li class="select__variant" data-value='Paris'>Paris</li>
                            <li class="select__variant" data-value='Berlin'>Berlin</li>
                            <li class="select__variant" data-value='Moscow'>Moscow</li>
                            <li class="select__variant" data-value='Minsk'>Minsk</li>
                            <li class="select__variant" data-value='Warsawa'>Warsawa</li>
                        </ul>

                        <ul class="select__group cinema">
                            <li class="select__variant" data-value='Cineworld'>Cineworld</li>
                            <li class="select__variant" data-value='Empire'>Empire</li>
                            <li class="select__variant" data-value='Everyman'>Everyman</li>
                            <li class="select__variant" data-value='Odeon'>Odeon</li>
                            <li class="select__variant" data-value='Picturehouse'>Picturehouse</li>
                        </ul>

                        <ul class="select__group film-category">
                            <li class="select__variant" data-value="Children's">Children's</li>
                            <li class="select__variant" data-value='Comedy'>Comedy</li>
                            <li class="select__variant" data-value='Drama'>Drama</li>
                            <li class="select__variant" data-value='Fantasy'>Fantasy</li>
                            <li class="select__variant" data-value='Horror'>Horror</li>
                            <li class="select__variant" data-value='Thriller'>Thriller</li>
                        </ul>

                        <ul class="select__group actors">
                            <li class="select__variant" data-value='Leonardo DiCaprio'>Leonardo DiCaprio</li>
                            <li class="select__variant" data-value='Johnny Depp'>Johnny Depp</li>
                            <li class="select__variant" data-value='Jack Nicholson'>Jack Nicholson</li>
                            <li class="select__variant" data-value='Robert De Niro'>Robert De Niro</li>
                            <li class="select__variant" data-value='Morgan Freeman'>Morgan Freeman</li>
                            <li class="select__variant" data-value='Jim Carrey'>Jim Carrey</li>
                            <li class="select__variant" data-value='Adam Sandler'>Adam Sandler</li>
                            <li class="select__variant" data-value='Ben Stiller'>Ben Stiller</li>
                        </ul>

                        <ul class="select__group director">
                            <li class="select__variant" data-value='Steven Spielberg'>Steven Spielberg</li>
                            <li class="select__variant" data-value='Martin Scorsese'>Martin Scorsese</li>
                            <li class="select__variant" data-value='Guy Ritchie'>Guy Ritchie</li>
                            <li class="select__variant" data-value='Christopher Nolan'>Christopher Nolan</li>
                            <li class="select__variant" data-value='Tim Burton'>Tim Burton</li>
                        </ul>

                        <ul class="select__group country">
                            <li class="select__variant" data-value='USA'>USA</li>
                            <li class="select__variant" data-value='Germany'>Germany</li>
                            <li class="select__variant" data-value='Australia'>Australia</li>
                            <li class="select__variant" data-value='UK'>UK</li>
                            <li class="select__variant" data-value='Japan'>Japan</li>
                            <li class="select__variant" data-value='Serbia'>Serbia</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <h2 id='target' class="page-heading heading--outcontainer">Phim đang chiếu</h2>

        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <!-- Movie variant with time -->
                    @foreach($danhSachPhimDangChieu as $idx => $phim)
                    <div class="movie movie--test movie--test--dark movie--test--{{intval(floor($idx/2)) % 2 == 0 ? 'left' : 'right'}}">
                        <div class="movie__images">
                            <a href="#" class="movie-beta__link">
                                <img alt='' src="{{$phim['url_anh_bia']}}" style="max-height: 425px; width: 100%">
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
            </div>
        </div>

        <div class="col-sm-12">
            <h2 class="page-heading">Tin tức mới nhất</h2>
            <div class="col-sm-4 similar-wrap col--remove">
                <div class="post post--preview post--preview--wide">
                    <div class="post__image">
                        <img alt='' src="http://placehold.it/270x330">
                        <div class="social social--position social--hide">
                            <span class="social__name">Share:</span>
                            <a href='#' class="social__variant social--first fa fa-facebook"></a>
                            <a href='#' class="social__variant social--second fa fa-twitter"></a>
                            <a href='#' class="social__variant social--third fa fa-vk"></a>
                        </div>
                    </div>
                    <p class="post__date">22 October 2013 </p>
                    <a href="single-page-left.html" class="post__title">"Thor: The Dark World" - World Premiere</a>
                    <a href="single-page-left.html" class="btn read-more post--btn">read more</a>
                </div>
            </div>
            <div class="col-sm-4 similar-wrap col--remove">
                <div class="post post--preview post--preview--wide">
                    <div class="post__image">
                        <img alt='' src="http://placehold.it/270x330">
                        <div class="social social--position social--hide">
                            <span class="social__name">Share:</span>
                            <a href='#' class="social__variant social--first fa fa-facebook"></a>
                            <a href='#' class="social__variant social--second fa fa-twitter"></a>
                            <a href='#' class="social__variant social--third fa fa-vk"></a>
                        </div>
                    </div>
                    <p class="post__date">22 October 2013 </p>
                    <a href="single-page-left.html" class="post__title">30th Annual Night Of Stars Presented By The Fashion Group International</a>
                    <a href="single-page-left.html" class="btn read-more post--btn">read more</a>
                </div>
            </div>
            <div class="col-sm-4 similar-wrap col--remove">
                <div class="post post--preview post--preview--wide">
                    <div class="post__image">
                        <img alt='' src="http://placehold.it/270x330">
                        <div class="social social--position social--hide">
                            <span class="social__name">Share:</span>
                            <a href='#' class="social__variant social--first fa fa-facebook"></a>
                            <a href='#' class="social__variant social--second fa fa-twitter"></a>
                            <a href='#' class="social__variant social--third fa fa-vk"></a>
                        </div>
                    </div>
                    <p class="post__date">22 October 2013 </p>
                    <a href="single-page-left.html" class="post__title">Hollywood Film Awards 2013</a>
                    <a href="single-page-left.html" class="btn read-more post--btn">read more</a>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('jscript')
    <script type="text/javascript">
        $(document).ready(function() {
            init_Home();
        });
    </script>
@endsection
