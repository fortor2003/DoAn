@extends('khachHang.layout.master', ['isHomePage' => false])
@section('title_tab', 'Thông tin thanh toán')
@section('above_main_style')
@endsection
@section('stylesheets')
    <style>
        .order__countdown {
            font-weight: bold;
            color: orange;
            font-size: 20px;
        }
    </style>
@endsection
@section('content')
    <div class="order-container">
        <div class="order">
            <img class="order__images" alt='' src="{{asset('images/ticket.png')}}">
            <p class="order__title">thông tin thanh toán</p>
            <p id="countdown" class="order__countdown" data-count-down-from="{{$thoiGianConLai}}"></p>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="checkout-wrapper">
            <h2 class="page-heading">Thông tin đơn đặt vé</h2>
            <ul class="book-result">
                <li class="book-result__item">Mã đơn vé: <span
                        class="book-result__count booking-ticket">{{$donDatVe['ma_don']}}</span></li>
                <li class="book-result__item">Phim: <span
                        class="book-result__count booking-ticket">{{$suatChieu['phim']['tieu_de_vi']}}</span></li>
                <li class="book-result__item">Rạp: <span
                        class="book-result__count booking-ticket">{{$suatChieu['rap']['ten_rap']}}</span></li>
                <li class="book-result__item">Suất chiếu: <span
                        class="book-result__count booking-ticket">{{$suatChieu['gio_bat_dau']['thoi_gian']}}</span>
                </li>
            </ul>
            <h2 class="page-heading">Giá</h2>
            <ul class="book-result">
                <li class="book-result__item">Số lượng vé: <span
                        class="book-result__count booking-ticket">{{$soLuongVe}}</span></li>
                <li class="book-result__item">Đơn giá vé: <span class="book-result__count booking-price">{{number_format($giaVe, 0, '.', ',')}} đ</span>
                </li>
                <li class="book-result__item">Thành tiền: <span class="book-result__count booking-cost">{{number_format($soLuongVe * $giaVe, 0, '.', ',')}} đ</span>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="order">
            <a href="{{route('khachHang.trangChuPage')}}" class="btn btn-md btn--warning btn--wide">Quay về trang chủ</a>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            let el = $('#countdown')
            let soGiayConLai = el.data('count-down-from');
            if (soGiayConLai) {
                soGiayConLai = parseInt(soGiayConLai);
                el.html(soGiayConLai-- + ' s');
                let timer = setInterval(function () {
                    if (soGiayConLai > 0) {
                        el.html(soGiayConLai-- + ' s');
                    } else {
                        el.html('Đã hết thời gian thanh toán, đơn đặt vé của bạn đã bị xóa');
                        clearInterval(timer);
                    }
                }, 1000);
            }
        });
    </script>
@endsection
