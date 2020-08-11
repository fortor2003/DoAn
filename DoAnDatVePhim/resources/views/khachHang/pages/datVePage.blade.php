@extends('khachHang.layout.master', ['isHomePage' => false])
@section('title_tab', 'Thông tin phim')
@section('above_main_style')
    <!-- jQuery UI -->
    <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <!-- Swiper slider -->
    <link href="{{asset('css/external/idangerous.swiper.css')}}" rel="stylesheet" />
    <!-- Mobile menu -->
    <link href="{{asset('css/gozha-nav.css')}}" rel="stylesheet" />
    <!-- Select -->
    <link href="{{asset('css/external/jquery.selectbox.css')}}" rel="stylesheet" />
    <!-- Modernizr -->
    <script src="{{asset('js/external/modernizr.custom.js')}}"></script>
@endsection
@section('stylesheets')

@endsection
@section('content')
    <div class="order-container">
        <div class="order">
            <img class="order__images" alt='' src="images/tickets.png">
            <p class="order__title">Book a ticket <br><span class="order__descript">and have fun movie time</span></p>
            <div class="order__control">
                <a href="#" class="order__control-btn active">Purchase</a>
                <a href="#" class="order__control-btn">Reserve</a>
            </div>
        </div>
    </div>
    <div class="order-step-area">
        <div class="order-step first--step">1. What &amp; Where &amp; When</div>
    </div>

    <h2 class="page-heading heading--outcontainer">Choose a movie</h2>
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
                <span class="arrow__text arrow--next">next step</span>
                <span class="arrow__info">choose a sit</span>
            </a>
        </div>

    </form>
@endsection

@section('content1')
    <div class="choose-film">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <!--First Slide-->
                <div class="swiper-slide" data-film='The Fifth Estate'>
                    <div class="film-images">
                        <img alt='' src="http://placehold.it/380x600">
                    </div>
                    <p class="choose-film__title">The Fifth Estate</p>
                </div>

                <!--Second Slide-->
                <div class="swiper-slide" data-film='Ender’s Game'>
                    <div class="film-images">
                        <img alt='' src="http://placehold.it/380x600">
                    </div>
                    <p class="choose-film__title">Ender’s Game</p>
                </div>

                <!--Third Slide-->
                <div class="swiper-slide" data-film='About Time'>
                    <div class="film-images">
                        <img alt='' src="http://placehold.it/380x600">
                    </div>
                    <p class="choose-film__title">About Time</p>
                </div>

                <!--Four Slide-->
                <div class="swiper-slide" data-film='Last Vegas'>
                    <div class="film-images">
                        <img alt='' src="http://placehold.it/380x600">
                    </div>
                    <p class="choose-film__title">Last Vegas</p>
                </div>

                <!--Five Slide-->
                <div class="swiper-slide" data-film='The Hunger Games: Cathing Fire'>
                    <div class="film-images">
                        <img alt='' src="http://placehold.it/380x600">
                    </div>
                    <p class="choose-film__title">The Hunger Games: Cathing Fire</p>
                </div>

                <!--Six Slide-->
                <div class="swiper-slide" data-film='The Counselor'>
                    <div class="film-images">
                        <img alt='' src="http://placehold.it/380x600">
                    </div>
                    <p class="choose-film__title">The Counselor</p>
                </div>

                <!--Seven Slide-->
                <div class="swiper-slide" data-film='Free Birds'>
                    <div class="film-images">
                        <img alt='' src="http://placehold.it/380x600">
                    </div>
                    <p class="choose-film__title">Free Birds</p>
                </div>

                <!--Eight Slide-->
                <div class="swiper-slide" data-film='Thor: The Dark World'>
                    <div class="film-images">
                        <img alt='' src="http://placehold.it/380x600">
                    </div>
                    <p class="choose-film__title">Thor: The Dark World</p>
                </div>

                <!--Nine Slide-->
                <div class="swiper-slide" data-film='The Book Thief'>
                    <div class="film-images">
                        <img alt='' src="http://placehold.it/380x600">
                    </div>
                    <p class="choose-film__title">The Book Thief</p>
                </div>

                <!--Ten Slide-->
                <div class="swiper-slide" data-film='The Wolf of Wall Stree'>
                    <div class="film-images">
                        <img alt='' src="http://placehold.it/380x600">
                    </div>
                    <p class="choose-film__title">The Wolf of Wall Stree</p>
                </div>
            </div>
        </div>
    </div>

    <section class="container">
        <div class="col-sm-12">
            <div class="choose-indector choose-indector--film">
                <strong>Choosen: </strong><span class="choosen-area"></span>
            </div>

            <h2 class="page-heading">City &amp; Date</h2>

            <div class="choose-container choose-container--short">
                <form id='select' class="select" method='get'>
                    <select name="select_item" id="select-sort" class="select__sort" tabindex="0">
                        <option value="1" selected='selected'>London</option>
                        <option value="2">New York</option>
                        <option value="3">Paris</option>
                        <option value="4">Berlin</option>
                        <option value="5">Moscow</option>
                        <option value="3">Minsk</option>
                        <option value="4">Warsawa</option>
                        <option value="5">Kiev</option>
                    </select>
                </form>

                <div class="datepicker">
                    <span class="datepicker__marker"><i class="fa fa-calendar"></i>Date</span>
                    <input type="text" id="datepicker" value='03/10/2014' class="datepicker__input">
                </div>
            </div>

            <h2 class="page-heading">Pick time</h2>

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
                <strong>Choosen: </strong><span class="choosen-area"></span>
            </div>
        </div>

    </section>
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
                <span class="arrow__text arrow--next">next step</span>
                <span class="arrow__info">choose a sit</span>
            </a>
        </div>

    </form>
@endsection


@section('scripts')
    <!-- jQuery UI -->
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <!-- Swiper slider -->
    <script src="{{asset('js/external/idangerous.swiper.min.js')}}"></script>
    <!-- Page -->
    <script src="{{asset('js/pages/khachHang/datVePage.js')}}"></script>
    <script>

    </script>
@endsection
