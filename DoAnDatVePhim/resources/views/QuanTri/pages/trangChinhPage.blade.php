@extends('quanTri.layout.master')

@section('above_main_style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('quanTri/plugins/select2/css/select2.min.css')}}">
{{--    <link rel="stylesheet" href="{{asset('quanTri/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">--}}
@endsection

@section('noiDung')
{{-- tìm kiếm theo    Rạp phòng chiếu phim xuất chiếu--}}
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Tìm kiếm</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form >
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Rạp</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>
                        </div>
                        <!-- /.form-group -->

                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Phòng chiếu</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>
                        </div>
                        <!-- /.form-group -->

                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Phim</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>
                        </div>
                        <!-- /.form-group -->

                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Suất chiếu</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>
                        </div>
                        <!-- /.form-group -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <input type="submit" class="btn btn-success" value="Tìm kiếm" style="float: right" >
                    </div>
                </div>
            </form>
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
        //Initialize Select2 Elements
        $('.select2').select2()
    </script>
@endsection
