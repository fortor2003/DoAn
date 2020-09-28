@extends('khachHang.layout.master', ['isHomePage' => false])
@section('title_tab', 'Đơn đặt vé')
@section('above_main_style')
@endsection
@section('stylesheets')
    <style>
        .thumbnail {
            border: 1px solid #aba9a9;
        }
    </style>
@endsection
@section('content')
    <div class="col-sm-12">
        <div class="checkout-wrapper">
            <h2 class="page-heading">Danh sách các đơn đặt vé của bạn</h2>
            <div class="row">
                @foreach($danhSachDonDatVe as $donDatVe)
                <div class="col-sm-3 col-md-3">
                    <a href="{{route('khachHang.chiTietDonDatVePage', ['donDatVe' => $donDatVe['id']])}}" class="btn btn-warning">{{$donDatVe['ma_don']}}</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
