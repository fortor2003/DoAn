@extends('quanTri.layout.master')

@section('above_main_style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('quanTri/plugins/select2/css/select2.min.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('quanTri/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">--}}
    <style>
        .sits-area{

            margin-left: 15%;
            margin-right: 15%;


        }
    </style>
@endsection

@section('noiDung')
    {{-- tìm kiếm theo    Rạp phòng chiếu phim xuất chiếu--}}
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Tìm kiếm</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form id="frmTimKiemSoGhe">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Rạp</label>
                            <select class="form-control select2 thaydoi" id="slRap" style="width: 100%;">
                                <option selected="selected" value="0">Chọn rạp</option>
                                @foreach($danhSachRap as  $rap)
                                    <option value="{{$rap['id']}}">{{$rap['ten_rap']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->

                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Phim</label>
                            <select class="form-control select2 thaydoi" id="slPhim" style="width: 100%;">
                                <option selected="selected"  value="0">Chọn phim</option>
                                @foreach($danhSachPhim as  $phim)
                                    <option value="{{$phim['id']}}">{{$phim['tieu_de_vi']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Ngày chiếu:</label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input thaydoi" id="dtNgayChieu"   data-target="#dtNgayChieu"/>
                                <div class="input-group-append" data-target="#dtNgayChieu" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.form group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Suất chiếu</label>
                            <select class="form-control select2" id="slSuatChieu"  style="width: 100%;" disabled>
                                <option selected="selected" value="0">Chọn Suất chiếu</option>
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <input type="submit" class="btn btn-success" value="Tìm kiếm" style="float: right">
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    {{-- danh sách phòng ghế chiếu theo phim   --}}
    <div class="card card-blue">
        <div class="card-header">
            <h3 class="card-title">Rạp 1 - Phim aaaa aaaaa - Danh sách Ghế đã đặt</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="col-md-12 ">
                <div class="sits-area">
                    <div class="sits-anchor">screen</div>

                    <div class="sits">
                        <aside class="sits__line">
                            <span class="sits__indecator">A</span>
                            <span class="sits__indecator">B</span>
                            <span class="sits__indecator">C</span>
                            <span class="sits__indecator">D</span>
                            <span class="sits__indecator">E</span>
                            <span class="sits__indecator">F</span>
                            <span class="sits__indecator">G</span>
                            <span class="sits__indecator">I</span>
                            <span class="sits__indecator additional-margin">J</span>
                            <span class="sits__indecator">K</span>
                            <span class="sits__indecator">L</span>
                        </aside>
                        <!--A-->
                        <div class="sits__row">
                            <span class="sits__place sits-price--middle" data-place='A1' data-price='20'>A1</span>
                            <span class="sits__place sits-price--middle" data-place='A2' data-price='20'>A2</span>
                            <span class="sits__place sits-price--middle" data-place='A3' data-price='20'>A3</span>
                            <span class="sits__place sits-price--middle" data-place='A4' data-price='20'>A4</span>
                            <span class="sits__place sits-price--middle" data-place='A5' data-price='20'>A5</span>
                            <span class="sits__place sits-price--middle" data-place='A6' data-price='20'>A6</span>
                            <span class="sits__place sits-price--middle" data-place='A7' data-price='20'>A7</span>
                            <span class="sits__place sits-price--middle" data-place='A8' data-price='20'>A8</span>
                            <span class="sits__place sits-price--middle" data-place='A9' data-price='20'>A9</span>
                            <span class="sits__place sits-price--middle" data-place='A10' data-price='20'>A10</span>
                            <span class="sits__place sits-price--middle" data-place='A11' data-price='20'>A11</span>
                            <span class="sits__place sits-price--middle" data-place='A12' data-price='20'>A12</span>
                            <span class="sits__place sits-price--middle" data-place='A13' data-price='20'>A13</span>
                            <span class="sits__place sits-price--middle" data-place='A14' data-price='20'>A14</span>
                            <span class="sits__place sits-price--middle" data-place='A15' data-price='20'>A15</span>
                            <span class="sits__place sits-price--middle" data-place='A16' data-price='20'>A16</span>
                            <span class="sits__place sits-price--middle" data-place='A17' data-price='20'>A17</span>
                            <span class="sits__place sits-price--middle" data-place='A18' data-price='20'>A18</span>
                        </div>
                        <!--B-->
                        <div class="sits__row">
                            <span class="sits__place sits-price--middle" data-place='B1' data-price='20'>B1</span>
                            <span class="sits__place sits-price--middle" data-place='B2' data-price='20'>B2</span>
                            <span class="sits__place sits-price--middle" data-place='B3' data-price='20'>B3</span>
                            <span class="sits__place sits-price--middle" data-place='B4' data-price='20'>B4</span>
                            <span class="sits__place sits-price--middle" data-place='B5' data-price='20'>B5</span>
                            <span class="sits__place sits-price--middle" data-place='B6' data-price='20'>B6</span>
                            <span class="sits__place sits-price--middle" data-place='B7' data-price='20'>B7</span>
                            <span class="sits__place sits-price--middle" data-place='B8' data-price='20'>B8</span>
                            <span class="sits__place sits-price--middle" data-place='B9' data-price='20'>B9</span>
                            <span class="sits__place sits-price--middle" data-place='B10' data-price='20'>B10</span>
                            <span class="sits__place sits-price--middle" data-place='B11' data-price='20'>B11</span>
                            <span class="sits__place sits-price--middle" data-place='B12' data-price='20'>B12</span>
                            <span class="sits__place sits-price--middle" data-place='B13' data-price='20'>B13</span>
                            <span class="sits__place sits-price--middle" data-place='B14' data-price='20'>B14</span>
                            <span class="sits__place sits-price--middle" data-place='B15' data-price='20'>B15</span>
                            <span class="sits__place sits-price--middle" data-place='B16' data-price='20'>B16</span>
                            <span class="sits__place sits-price--middle" data-place='B17' data-price='20'>B17</span>
                            <span class="sits__place sits-price--middle" data-place='B18' data-price='20'>B18</span>
                        </div>
                        <!--C-->
                        <div class="sits__row">
                            <span class="sits__place sits-price--middle" data-place='C1' data-price='20'>C1</span>
                            <span class="sits__place sits-price--middle" data-place='C2' data-price='20'>C2</span>
                            <span class="sits__place sits-price--middle" data-place='C3' data-price='20'>C3</span>
                            <span class="sits__place sits-price--middle" data-place='C4' data-price='20'>C4</span>
                            <span class="sits__place sits-price--middle" data-place='C5' data-price='20'>C5</span>
                            <span class="sits__place sits-price--middle" data-place='C6' data-price='20'>C6</span>
                            <span class="sits__place sits-price--middle" data-place='C7' data-price='20'>C7</span>
                            <span class="sits__place sits-price--middle" data-place='C8' data-price='20'>C8</span>
                            <span class="sits__place sits-price--middle" data-place='C9' data-price='20'>C9</span>
                            <span class="sits__place sits-price--middle" data-place='C10' data-price='20'>C10</span>
                            <span class="sits__place sits-price--middle" data-place='C11' data-price='20'>C11</span>
                            <span class="sits__place sits-price--middle" data-place='C12' data-price='20'>C12</span>
                            <span class="sits__place sits-price--middle" data-place='C13' data-price='20'>C13</span>
                            <span class="sits__place sits-price--middle" data-place='C14' data-price='20'>C14</span>
                            <span class="sits__place sits-price--middle" data-place='C15' data-price='20'>C15</span>
                            <span class="sits__place sits-price--middle" data-place='C16' data-price='20'>C16</span>
                            <span class="sits__place sits-price--middle" data-place='C17' data-price='20'>C17</span>
                            <span class="sits__place sits-price--middle" data-place='C18' data-price='20'>C18</span>
                        </div>
                        <!--D-->
                        <div class="sits__row">
                            <span class="sits__place sits-price--middle" data-place='D1' data-price='20'>D1</span>
                            <span class="sits__place sits-price--middle" data-place='D2' data-price='20'>D2</span>
                            <span class="sits__place sits-price--middle" data-place='D3' data-price='20'>D3</span>
                            <span class="sits__place sits-price--middle" data-place='D4' data-price='20'>D4</span>
                            <span class="sits__place sits-price--middle" data-place='D5' data-price='20'>D5</span>
                            <span class="sits__place sits-price--middle" data-place='D6' data-price='20'>D6</span>
                            <span class="sits__place sits-price--middle" data-place='D7' data-price='20'>D7</span>
                            <span class="sits__place sits-price--middle" data-place='D8' data-price='20'>D8</span>
                            <span class="sits__place sits-price--middle" data-place='D9' data-price='20'>D9</span>
                            <span class="sits__place sits-price--middle" data-place='D10' data-price='20'>D10</span>
                            <span class="sits__place sits-price--middle" data-place='D11' data-price='20'>D11</span>
                            <span class="sits__place sits-price--middle" data-place='D12' data-price='20'>D12</span>
                            <span class="sits__place sits-price--middle" data-place='D13' data-price='20'>D13</span>
                            <span class="sits__place sits-price--middle" data-place='D14' data-price='20'>D14</span>
                            <span class="sits__place sits-price--middle" data-place='D15' data-price='20'>D15</span>
                            <span class="sits__place sits-price--middle" data-place='D16' data-price='20'>D16</span>
                            <span class="sits__place sits-price--middle" data-place='D17' data-price='20'>D17</span>
                            <span class="sits__place sits-price--middle" data-place='D18' data-price='20'>D18</span>
                        </div>
                        <!--E-->
                        <div class="sits__row">
                            <span class="sits__place sits-price--middle" data-place='E1' data-price='20'>E1</span>
                            <span class="sits__place sits-price--middle" data-place='E2' data-price='20'>E2</span>
                            <span class="sits__place sits-price--middle" data-place='E3' data-price='20'>E3</span>
                            <span class="sits__place sits-price--middle" data-place='E4' data-price='20'>E4</span>
                            <span class="sits__place sits-price--middle" data-place='E5' data-price='20'>E5</span>
                            <span class="sits__place sits-price--middle" data-place='E6' data-price='20'>E6</span>
                            <span class="sits__place sits-price--middle" data-place='E7' data-price='20'>E7</span>
                            <span class="sits__place sits-price--middle" data-place='E8' data-price='20'>E8</span>
                            <span class="sits__place sits-price--middle" data-place='E9' data-price='20'>E9</span>
                            <span class="sits__place sits-price--middle" data-place='E10' data-price='20'>E10</span>
                            <span class="sits__place sits-price--middle" data-place='E11' data-price='20'>E11</span>
                            <span class="sits__place sits-price--middle" data-place='E12' data-price='20'>E12</span>
                            <span class="sits__place sits-price--middle" data-place='E13' data-price='20'>E13</span>
                            <span class="sits__place sits-price--middle" data-place='E14' data-price='20'>E14</span>
                            <span class="sits__place sits-price--middle" data-place='E15' data-price='20'>E15</span>
                            <span class="sits__place sits-price--middle" data-place='E16' data-price='20'>E16</span>
                            <span class="sits__place sits-price--middle" data-place='E17' data-price='20'>E17</span>
                            <span class="sits__place sits-price--middle" data-place='E18' data-price='20'>E18</span>
                        </div>
                        <!--F-->
                        <div class="sits__row">
                            <span class="sits__place sits-price--middle" data-place='F1' data-price='20'>F1</span>
                            <span class="sits__place sits-price--middle" data-place='F2' data-price='20'>F2</span>
                            <span class="sits__place sits-price--middle" data-place='F3' data-price='20'>F3</span>
                            <span class="sits__place sits-price--middle" data-place='F4' data-price='20'>F4</span>
                            <span class="sits__place sits-price--middle" data-place='F5' data-price='20'>F5</span>
                            <span class="sits__place sits-price--middle" data-place='F6' data-price='20'>F6</span>
                            <span class="sits__place sits-price--middle" data-place='F7' data-price='20'>F7</span>
                            <span class="sits__place sits-price--middle" data-place='F8' data-price='20'>F8</span>
                            <span class="sits__place sits-price--middle" data-place='F9' data-price='20'>F9</span>
                            <span class="sits__place sits-price--middle" data-place='F10' data-price='20'>F10</span>
                            <span class="sits__place sits-price--middle" data-place='F11' data-price='20'>F11</span>
                            <span class="sits__place sits-price--middle" data-place='F12' data-price='20'>F12</span>
                            <span class="sits__place sits-price--middle" data-place='F13' data-price='20'>F13</span>
                            <span class="sits__place sits-price--middle" data-place='F14' data-price='20'>F14</span>
                            <span class="sits__place sits-price--middle" data-place='F15' data-price='20'>F15</span>
                            <span class="sits__place sits-price--middle" data-place='F16' data-price='20'>F16</span>
                            <span class="sits__place sits-price--middle" data-place='F17' data-price='20'>F17</span>
                            <span class="sits__place sits-price--middle" data-place='F18' data-price='20'>F18</span>
                        </div>
                        <!--G-->
                        <div class="sits__row">
                            <span class="sits__place sits-price--middle sits-state--not" data-place='G1' data-price='20'>G1</span>
                            <span class="sits__place sits-price--middle" data-place='G2' data-price='20'>G2</span>
                            <span class="sits__place sits-price--middle" data-place='G3' data-price='20'>G3</span>
                            <span class="sits__place sits-price--middle" data-place='G4' data-price='20'>G4</span>
                            <span class="sits__place sits-price--middle" data-place='G5' data-price='20'>G5</span>
                            <span class="sits__place sits-price--middle" data-place='G6' data-price='20'>G6</span>
                            <span class="sits__place sits-price--middle" data-place='G7' data-price='20'>G7</span>
                            <span class="sits__place sits-price--middle" data-place='G8' data-price='20'>G8</span>
                            <span class="sits__place sits-price--middle" data-place='G9' data-price='20'>G9</span>
                            <span class="sits__place sits-price--middle" data-place='G10' data-price='20'>G10</span>
                            <span class="sits__place sits-price--middle" data-place='G11' data-price='20'>G11</span>
                            <span class="sits__place sits-price--middle" data-place='G12' data-price='20'>G12</span>
                            <span class="sits__place sits-price--middle" data-place='G13' data-price='20'>G13</span>
                            <span class="sits__place sits-price--middle" data-place='G14' data-price='20'>G14</span>
                            <span class="sits__place sits-price--middle" data-place='G15' data-price='20'>G15</span>
                            <span class="sits__place sits-price--middle" data-place='G16' data-price='20'>G16</span>
                            <span class="sits__place sits-price--middle" data-place='G17' data-price='20'>G17</span>
                            <span class="sits__place sits-price--middle" data-place='G18' data-price='20'>G18</span>
                        </div>
                        <!--I-->
                        <div class="sits__row">
                            <span class="sits__place sits-price--middle" data-place='I1' data-price='20'>I1</span>
                            <span class="sits__place sits-price--middle" data-place='I2' data-price='20'>I2</span>
                            <span class="sits__place sits-price--middle" data-place='I3' data-price='20'>I3</span>
                            <span class="sits__place sits-price--middle" data-place='I4' data-price='20'>I4</span>
                            <span class="sits__place sits-price--middle" data-place='I5' data-price='20'>I5</span>
                            <span class="sits__place sits-price--middle" data-place='I6' data-price='20'>I6</span>
                            <span class="sits__place sits-price--middle" data-place='I7' data-price='20'>I7</span>
                            <span class="sits__place sits-price--middle" data-place='I8' data-price='20'>I8</span>
                            <span class="sits__place sits-price--middle" data-place='I9' data-price='20'>I9</span>
                            <span class="sits__place sits-price--middle" data-place='I10' data-price='20'>I10</span>
                            <span class="sits__place sits-price--middle" data-place='I11' data-price='20'>I11</span>
                            <span class="sits__place sits-price--middle" data-place='I12' data-price='20'>I12</span>
                            <span class="sits__place sits-price--middle" data-place='I13' data-price='20'>I13</span>
                            <span class="sits__place sits-price--middle" data-place='I14' data-price='20'>I14</span>
                            <span class="sits__place sits-price--middle" data-place='I15' data-price='20'>I15</span>
                            <span class="sits__place sits-price--middle" data-place='I16' data-price='20'>I16</span>
                            <span class="sits__place sits-price--middle" data-place='I17' data-price='20'>I17</span>
                            <span class="sits__place sits-price--middle" data-place='I18' data-price='20'>I18</span>
                        </div>
                        <!--J-->
                        <div class="sits__row additional-margin">
                            <span class="sits__place sits-price--middle" data-place='J1' data-price='20'>J1</span>
                            <span class="sits__place sits-price--middle" data-place='J2' data-price='20'>J2</span>
                            <span class="sits__place sits-price--middle" data-place='J3' data-price='20'>J3</span>
                            <span class="sits__place sits-price--middle" data-place='J4' data-price='20'>J4</span>
                            <span class="sits__place sits-price--middle" data-place='J5' data-price='20'>J5</span>
                            <span class="sits__place sits-price--middle" data-place='J6' data-price='20'>J6</span>
                            <span class="sits__place sits-price--middle" data-place='J7' data-price='20'>J7</span>
                            <span class="sits__place sits-price--middle" data-place='J8' data-price='20'>J8</span>
                            <span class="sits__place sits-price--middle" data-place='J9' data-price='20'>J9</span>
                            <span class="sits__place sits-price--middle" data-place='J10' data-price='20'>J10</span>
                            <span class="sits__place sits-price--middle" data-place='J11' data-price='20'>J11</span>
                            <span class="sits__place sits-price--middle" data-place='J12' data-price='20'>J12</span>
                            <span class="sits__place sits-price--middle" data-place='J13' data-price='20'>J13</span>
                            <span class="sits__place sits-price--middle" data-place='J14' data-price='20'>J14</span>
                            <span class="sits__place sits-price--middle" data-place='J15' data-price='20'>J15</span>
                            <span class="sits__place sits-price--middle" data-place='J16' data-price='20'>J16</span>
                            <span class="sits__place sits-price--middle" data-place='J17' data-price='20'>J17</span>
                            <span class="sits__place sits-price--middle" data-place='J18' data-price='20'>J18</span>
                        </div>
                        <!--K-->
                        <div class="sits__row">
                            <span class="sits__place sits-price--middle" data-place='K1' data-price='20'>K1</span>
                            <span class="sits__place sits-price--middle" data-place='K2' data-price='20'>K2</span>
                            <span class="sits__place sits-price--middle" data-place='K3' data-price='20'>K3</span>
                            <span class="sits__place sits-price--middle" data-place='K4' data-price='20'>K4</span>
                            <span class="sits__place sits-price--middle" data-place='K5' data-price='20'>K5</span>
                            <span class="sits__place sits-price--middle" data-place='K6' data-price='20'>K6</span>
                            <span class="sits__place sits-price--middle" data-place='K7' data-price='20'>K7</span>
                            <span class="sits__place sits-price--middle" data-place='K8' data-price='20'>K8</span>
                            <span class="sits__place sits-price--middle" data-place='K9' data-price='20'>K9</span>
                            <span class="sits__place sits-price--middle" data-place='K10' data-price='20'>K10</span>
                            <span class="sits__place sits-price--middle" data-place='K11' data-price='20'>K11</span>
                            <span class="sits__place sits-price--middle" data-place='K12' data-price='20'>K12</span>
                            <span class="sits__place sits-price--middle" data-place='K13' data-price='20'>K13</span>
                            <span class="sits__place sits-price--middle" data-place='K14' data-price='20'>K14</span>
                            <span class="sits__place sits-price--middle" data-place='K15' data-price='20'>K15</span>
                            <span class="sits__place sits-price--middle" data-place='K16' data-price='20'>K16</span>
                            <span class="sits__place sits-price--middle" data-place='K17' data-price='20'>K17</span>
                            <span class="sits__place sits-price--middle" data-place='K18' data-price='20'>K18</span>
                        </div>
                        <!--L-->
                        <div class="sits__row">
                            <span class="sits__place sits-price--middle" data-place='L1' data-price='20'>L1</span>
                            <span class="sits__place sits-price--middle" data-place='L2' data-price='20'>L2</span>
                            <span class="sits__place sits-price--middle" data-place='L3' data-price='20'>L3</span>
                            <span class="sits__place sits-price--middle" data-place='L4' data-price='20'>L4</span>
                            <span class="sits__place sits-price--middle" data-place='L5' data-price='20'>L5</span>
                            <span class="sits__place sits-price--middle" data-place='L6' data-price='20'>L6</span>
                            <span class="sits__place sits-price--middle" data-place='L7' data-price='20'>L7</span>
                            <span class="sits__place sits-price--middle" data-place='L8' data-price='20'>L8</span>
                            <span class="sits__place sits-price--middle" data-place='L9' data-price='20'>L9</span>
                            <span class="sits__place sits-price--middle" data-place='L10' data-price='20'>L10</span>
                            <span class="sits__place sits-price--middle" data-place='L11' data-price='20'>L11</span>
                            <span class="sits__place sits-price--middle" data-place='L12' data-price='20'>L12</span>
                            <span class="sits__place sits-price--middle" data-place='L13' data-price='20'>L13</span>
                            <span class="sits__place sits-price--middle" data-place='L14' data-price='20'>L14</span>
                            <span class="sits__place sits-price--middle" data-place='L15' data-price='20'>L15</span>
                            <span class="sits__place sits-price--middle" data-place='L16' data-price='20'>L16</span>
                            <span class="sits__place sits-price--middle" data-place='L17' data-price='20'>L17</span>
                            <span class="sits__place sits-price--middle" data-place='L18' data-price='20'>L18</span>
                        </div>

                        <aside class="sits__checked">
                            <div class="checked-place">

                            </div>
                            <div class="checked-result">
                                $0
                            </div>
                        </aside>
                        <footer class="sits__number">
                            <span class="sits__indecator">1</span>
                            <span class="sits__indecator">2</span>
                            <span class="sits__indecator">3</span>
                            <span class="sits__indecator">4</span>
                            <span class="sits__indecator">5</span>
                            <span class="sits__indecator">6</span>
                            <span class="sits__indecator">7</span>
                            <span class="sits__indecator">8</span>
                            <span class="sits__indecator">9</span>
                            <span class="sits__indecator">10</span>
                            <span class="sits__indecator">11</span>
                            <span class="sits__indecator">12</span>
                            <span class="sits__indecator">13</span>
                            <span class="sits__indecator">14</span>
                            <span class="sits__indecator">15</span>
                            <span class="sits__indecator">16</span>
                            <span class="sits__indecator">17</span>
                            <span class="sits__indecator">18</span>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection

@section('import_bottom_script')
    <!-- Select2 -->
    <script src="{{asset('quanTri/plugins/select2/js/select2.full.min.js')}}"></script>

@endsection

@section('inside_script')
    <script>
        $( document ).ready(function() {
            //Initialize Select2 Elements
            $('.select2').select2();
            //Date range picker
            $('#dtNgayChieu').datetimepicker({
                format: 'DD/MM/YYYY',
                useCurrent: true
            });


            //region event
                //sự kiện thay dổi select vs input
            $('#frmTimKiemSoGhe .thaydoi').on('change',function (){
                if($('#slRap').val()&&$('#slPhim').val() && $('#dtNgayChieu').val())
                {
                    danhSachSuatChieu();
                }
            });
            $('#dtNgayChieu').on('hide.datetimepicker', function() {
                if($('#slRap').val()&&$('#slPhim').val() && $('#dtNgayChieu').val())
                {
                    danhSachSuatChieu();
                }
            });
                //sự kiện submit frmTimKiemSoGhe
            $('#frmTimKiemSoGhe').on('submit',function (e){
                e.preventDefault();
            });
            //endregion


        });

        function danhSachSuatChieu(){
            jQuery.ajax({
                url: 'http://bkcinema.local/admin/api/suat_chieu?phim_id=' + $('#slPhim').val() + '&rap_id=' + $('#slRap').val() + '&ngay_chieu=' + $('#dtNgayChieu').datetimepicker('viewDate').format('YYYY-MM-DD'),
                data: null,
                method: 'get',
                success: function (danhSachSuatChieu) {
                    // console.log(danhSachSuatChieu.map(item => ({text: item.gio_bat_dau.thoi_gian, id: item.id})));
                    $('#slSuatChieu').select2({
                        placeholder: "--Chọn Suất chiếu--",
                        allowClear: true,
                        data: danhSachSuatChieu.map(item => ({text: item.gio_bat_dau.thoi_gian, id: item.id}))
                    });
                    $('#slSuatChieu').prop("disabled",false);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }
    </script>
@endsection
