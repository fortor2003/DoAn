@extends('khachHang.layout.master', ['isHomePage' => false])
@section('title_tab', 'Thông tin phim')
@section('above_main_style')
    <!-- jQuery UI -->
    <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <!-- Mobile menu -->
    <link href="{{asset('css/gozha-nav.css')}}" rel="stylesheet"/>
    <!-- Select -->
    <link href="{{asset('css/external/jquery.selectbox.css')}}" rel="stylesheet"/>
    <!-- Modernizr -->
    <script src="{{asset('js/external/modernizr.custom.js')}}"></script>
@endsection
@section('stylesheets')
    <style>
        .choose-sits__info ul {
            margin-bottom: 0;
        }

        .main-info {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .sits .sits__checked .checked-place::-webkit-scrollbar {
            width: 5px;
        }

        /* Track */
        .sits .sits__checked .checked-place::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            border-radius: 8px;
        }

        /* Handle */
        .sits .sits__checked .checked-place::-webkit-scrollbar-thumb {
            background: #7783be;
            border-radius: 10px;
        }
    </style>
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
        <div class="order-step second--step">2. Chọn ghế</div>
    </div>
    <div class="choose-sits">
        <div class="row main-info">
            <div class="choose-sits__info choose-sits__info--first">
                <ul>
                    <li class=""><strong>Phim</strong></li>
                    <li class="">{{$suatChieu['phim']['tieu_de_vi']}}</li>
                </ul>
                <ul>
                    <li class=""><strong>Rạp</strong></li>
                    <li class="">{{$suatChieu['rap']['ten_rap']}}</li>
                </ul>
                <ul>
                    <li class=""><strong>Giờ chiếu</strong></li>
                    <li class="">{{$suatChieu['gio_bat_dau']['thoi_gian']}}</li>
                </ul>
            </div>
            <div class="choose-sits__info choose-sits__info--first">
                <ul>
                    <li class="sits-price marker--none"><strong>Giá vé</strong></li>
                    <li class="sits-price sits-price--middle">{{number_format($giaVe, 0, '.', ',')}} đ</li>
                </ul>
            </div>
            <div class="choose-sits__info">
                <ul>
                    <li class="sits-price marker--none"><strong>Trạng thái ghế</strong></li>
                    <li class="sits-state sits-state--sold">Đã bán</li>
                    <li class="sits-state sits-state--wait-for-pay">Chờ thanh toán</li>
                    <li class="sits-state sits-state--available">Có thể chọn</li>
                    <li class="sits-state sits-state--your">Bạn đang chọn</li>
                </ul>
            </div>
        </div>

        <div class="col-sm-12 col-lg-10 col-lg-offset-1">
            <div class="sits-area hidden-xs">
                @php
                    // $danhSachHang = array_map(function ($item) { return $item['ma_hang']; }, $danhSachGhe);
                    $soGheTrongHang = count($danhSachHangGhe) > 0 ? count($danhSachHangGhe[0]['danh_sach_ghe']) : 0;
                @endphp
                <div class="sits-anchor">Màn chiếu</div>
                <div class="sits">
                    <aside class="sits__line">
                        @foreach($danhSachHangGhe as $hangGhe)
                        <span class="sits__indecator">{{$hangGhe['ma_hang']}}</span>
                        @endforeach
                    </aside>
                    @foreach($danhSachHangGhe as $hangGhe)
                    <div class="sits__row">
                        @php
                            $maHang =  $hangGhe['ma_hang'];
                            $danhSachGheTrongHang = $hangGhe['danh_sach_ghe'];
                        @endphp
                        @foreach($danhSachGheTrongHang as $ghe)
                        <span class="sits__place sits-price--middle" data-ghe-id="{{$ghe['id']}}" data-place="{{$maHang.$ghe['thu_tu']}}" data-price="{{$giaVe}}">{{$maHang.$ghe['thu_tu']}}</span>
                        @endforeach
                    </div>
                    @endforeach
                    <aside class="sits__checked">
                        <div class="checked-place">

                        </div>
                        <div class="checked-result">
                            đ 0
                        </div>
                    </aside>
                    <footer class="sits__number">
                        @for($i = 1; $i <= $soGheTrongHang; $i++)
                        <span class="sits__indecator">{{$i}}</span>
                        @endfor
                    </footer>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <form id='formDatGhe' class="booking-form" method='post' action="{{route('khachHang.xacNhanThanhToanPage')}}">
        @csrf
        <input type='hidden' id="suatChieuId" name="suat_chieu_id" value="{{$suatChieuId}}">
        <input type='hidden' id="danhSachGheId" name="danh_sach_ghe_id" value="[]">
        <div class="booking-pagination booking-pagination--margin">
            <a href="{{route('khachHang.datVePage')}}" class="booking-pagination__prev">
                <span class="arrow__text arrow--prev">Bước trước</span>
                <span class="arrow__info">phim &amp; rạp &amp; giờ chiếu</span>
            </a>
            <a href="#" class="booking-pagination__next" onclick="event.preventDefault(); $(this).closest('form').submit();">
                <span class="arrow__text arrow--next">Bước kế tiếp</span>
                <span class="arrow__info">thanh toán</span>
            </a>
        </div>
    </form>
@endsection

@section('scripts')
    <!-- Page -->
    <script src="{{asset('js/pages/khachHang/datGhePage.js')}}"></script>
@endsection
