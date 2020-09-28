@extends('khachHang.layout.master', ['isHomePage' => false])
@section('title_tab', 'Thanh toán')
@section('above_main_style')
@endsection
@section('stylesheets')
    <!-- select 2 -->
    <link href="{{asset('css/external/select2.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="order-container">
        <div class="order">
            <img class="order__images" alt='' src="{{asset('images/ticket.png')}}">
            <p class="order__title">Đặt vé <br><span class="order__descript">và trải nghiệm</span></p>
        </div>
    </div>
    <div class="order-step-area">
        <div class="order-step first--step order-step--disable ">1. Phim &amp; Rạp &amp; Suất chiếu</div>
        <div class="order-step second--step order-step--disable">2. Chọn ghế</div>
        <div class="order-step third--step">3. Thanh toán</div>
    </div>
    <div class="col-sm-12">
        <form id='formThanhToan' method='post' class="form contact-info"
              action="{{route('khachHang.taoDonDatVe')}}">
            @csrf
            <div class="checkout-wrapper">
                <h2 class="page-heading">Phim</h2>
                <ul class="book-result">
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
                            class="book-result__count booking-ticket">{{count($danhSachGheId)}}</span></li>
                    <li class="book-result__item">Đơn giá vé: <span class="book-result__count booking-price">{{number_format($giaVe, 0, '.', ',')}} đ</span>
                    </li>
                    <li class="book-result__item">Thành tiền: <span class="book-result__count booking-cost">{{number_format(count($danhSachGheId) * $giaVe, 0, '.', ',')}} đ</span>
                    </li>
                </ul>
                @php $taiKhoan = auth()->user(); @endphp

                <input id="suatChieuId" name="suat_chieu_id" type="hidden" value="{{$suatChieuId}}">
                <input id="danhSachGheId" name="danh_sach_ghe_id" type="hidden" value="{{json_encode($danhSachGheId)}}">
                <h2 class="page-heading">Chọn phương thức thanh toán</h2>
                <div class="payment">
                    <select id="phuongThucThanhToan" name="phuong_thuc_thanh_toan" style="width: 100%">
                        <option value="momo">Ví Momo</option>
                    </select>
                </div>
                <h2 class="page-heading">Thông tin liên hệ</h2>
                <div class="contact-info__field contact-info__field-mail">
                    <input type='email' id="email" name='email' placeholder='Email' class="form__mail"
                           value="{{$taiKhoan->email}}">
                </div>
                <div class="contact-info__field contact-info__field-tel">
                    <input type='text' id="soDienThoai" name='so_dien_thoai' placeholder='Số điện thoại' class="form__mail"
                           value="{{$taiKhoan->so_dien_thoai}}">
                </div>
            </div>
            <div class="order">
                <button type="submit" class="btn btn-md btn--warning btn--wide">Xác nhận</button>
            </div>
        </form>
        <div class="clearfix"></div>
        <div class="booking-pagination">
            <a href="{{route('khachHang.datGhePage', ['suat_chieu_id' => $suatChieuId])}}"
               class="booking-pagination__prev">
                <p class="arrow__text arrow--prev">Bước trước</p>
                <span class="arrow__info">chọn ghế</span>
            </a>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Select 2-->
    <script src="{{asset('js/external/select2.min.js')}}"></script>
    <!-- page -->
    <script src="{{asset('js/pages/khachHang/xacNhanThanhToanPage.js')}}"></script>
@endsection
