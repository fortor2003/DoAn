@extends('khachHang.layout.master', ['isHomePage' => false])
@section('title_tab', 'Thông tin phim')
@section('above_main_style')
    <!-- jQuery UI -->
    <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <!-- Modernizr -->
    <script src="{{asset('js/external/modernizr.custom.js')}}"></script>
@endsection
@section('stylesheets')

@endsection
@section('content')
    <div class="order-container">
        <div class="order">
            <img class="order__images" alt='' src="images/tickets.png">
            <p class="order__title">Thank you <br><span class="order__descript">you have successfully purchased tickets</span></p>
        </div>

        <div class="ticket">
            <div class="ticket-position">
                <div class="ticket__indecator indecator--pre"><div class="indecator-text pre--text">online ticket</div> </div>
                <div class="ticket__inner">

                    <div class="ticket-secondary">
                        <span class="ticket__item">Ticket number <strong class="ticket__number">a126bym4</strong></span>
                        <span class="ticket__item ticket__date">25/10/2013</span>
                        <span class="ticket__item ticket__time">17:45</span>
                        <span class="ticket__item">Cinema: <span class="ticket__cinema">Cineworld</span></span>
                        <span class="ticket__item">Hall: <span class="ticket__hall">Visconti</span></span>
                        <span class="ticket__item ticket__price">price: <strong class="ticket__cost">$60</strong></span>
                    </div>

                    <div class="ticket-primery">
                        <span class="ticket__item ticket__item--primery ticket__film">Film<br><strong class="ticket__movie">The Fifth Estate (2013)</strong></span>
                        <span class="ticket__item ticket__item--primery">Sits: <span class="ticket__place">11F, 12F, 13F</span></span>
                    </div>


                </div>
                <div class="ticket__indecator indecator--post"><div class="indecator-text post--text">online ticket</div></div>
            </div>
        </div>

        <div class="ticket-control">
            <a href="#" class="watchlist list--download">Download</a>
            <a href="#" class="watchlist list--print">Print</a>
        </div>

    </div>
@endsection
@section('scripts')
    <!-- jQuery UI -->
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <!-- Page -->
{{--    <script src="{{asset('js/pages/khachHang/chiTietPhimPage.js')}}"></script>--}}
    <script>
        $(document).ready(function() {
            $('.top-scroll').parent().find('.top-scroll').remove();
        });
    </script>
@endsection
