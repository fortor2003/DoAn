@extends('khachHang.layout.master', ['isHomePage' => false])
@section('title_tab', 'Thanh toán')
@section('above_main_style')
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
                <a href="" class="order__control-btn active">Purchase</a>
                <a href="book3-reserve.html" class="order__control-btn">Reserve</a>
            </div>
        </div>
    </div>
    <div class="order-step-area">
        <div class="order-step first--step order-step--disable ">1. What &amp; Where &amp; When</div>
        <div class="order-step second--step order-step--disable">2. Choose a sit</div>
        <div class="order-step third--step">3. Check out</div>
    </div>

    <div class="col-sm-12">
        <div class="checkout-wrapper">
            <h2 class="page-heading">price</h2>
            <ul class="book-result">
                <li class="book-result__item">Tickets: <span class="book-result__count booking-ticket">3</span></li>
                <li class="book-result__item">One item price: <span class="book-result__count booking-price">$20</span></li>
                <li class="book-result__item">Total: <span class="book-result__count booking-cost">$60</span></li>
            </ul>

            <h2 class="page-heading">Choose payment method</h2>
            <div class="payment">
                <a href="#" class="payment__item">
                    <img alt='' src="images/payment/pay1.png">
                </a>
                <a href="#" class="payment__item">
                    <img alt='' src="images/payment/pay2.png">
                </a>
                <a href="#" class="payment__item">
                    <img alt='' src="images/payment/pay3.png">
                </a>
                <a href="#" class="payment__item">
                    <img alt='' src="images/payment/pay4.png">
                </a>
                <a href="#" class="payment__item">
                    <img alt='' src="images/payment/pay5.png">
                </a>
                <a href="#" class="payment__item">
                    <img alt='' src="images/payment/pay6.png">
                </a>
                <a href="#" class="payment__item">
                    <img alt='' src="images/payment/pay7.png">
                </a>
            </div>

            <h2 class="page-heading">Contact information</h2>

            <form id='contact-info' method='post' novalidate="" class="form contact-info">
                <div class="contact-info__field contact-info__field-mail">
                    <input type='email' name='user-mail' placeholder='Your email' class="form__mail">
                </div>
                <div class="contact-info__field contact-info__field-tel">
                    <input type='tel' name='user-tel' placeholder='Phone number' class="form__mail">
                </div>
            </form>


        </div>

        <div class="order">
            <a href="book-final.html" class="btn btn-md btn--warning btn--wide">purchase</a>
        </div>

    </div>
@endsection

@section('pagination')
    <div class="booking-pagination">
        <a href="book2.html" class="booking-pagination__prev">
            <p class="arrow__text arrow--prev">prev step</p>
            <span class="arrow__info">choose a sit</span>
        </a>
        <a href="#" class="booking-pagination__next hide--arrow">
            <p class="arrow__text arrow--next">next step</p>
            <span class="arrow__info"></span>
        </a>
    </div>
@endsection

@section('scripts')
{{--    <!-- jQuery UI -->--}}
{{--    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>--}}
{{--    <!-- Swiper slider -->--}}
{{--    <script src="{{asset('js/external/idangerous.swiper.min.js')}}"></script>--}}
{{--    <!-- Magnific-popup -->--}}
{{--    <script src="{{asset('js/external/jquery.magnific-popup.min.js')}}"></script>--}}
{{--    <!--*** Google map  ***-->--}}
{{--    <script src="https://maps.google.com/maps/api/js?sensor=true"></script>--}}
{{--    <!--*** Google map infobox  ***-->--}}
{{--    <script src="{{asset('js/external/infobox.js')}}"></script>--}}
{{--    <!-- Share buttons -->--}}
{{--    <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>--}}
{{--    <!-- Page -->--}}
{{--    <script src="{{asset('js/pages/khachHang/chiTietPhimPage.js')}}"></script>--}}
{{--    <script>--}}

{{--    </script>--}}
@endsection
