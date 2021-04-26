var tbPoint='';
var tbTranGift='';
var tbTranPoint='';
var tbBalance='';

$( document ).ready(function() {

   //region on off conten
    $('div.content-wrapper > section.content').hide();
    $('#history').show();
    $('ul[role="menu"] a').on('click', function () {
        const selector = $(this).attr('href');
        $('div.content-wrapper > section.content').hide();
        $(selector).show();
    });
    //endregion on off conten
    //region transaction
    $('#btnSearchTrans').on("click",function () {
        console.log($('#txtTimeTrans').val());
        tbTranPoint = $('#tbTransPoint').DataTable( {
            serverSide: true,
            ordering: false,
            searching: false,
            ajax: function ( data, callback, settings ) {
                let size = data.length;
                let page = ((data.start + size) / size) - 1;
                $.ajax({
                    url:`api/v1/transactions?page=${page}&size=${size}&filter=amount.type:eq:POINT,createdAt:inc:${$('#txtTimeTrans').val()}`,
                    type:"get",
                    headers: {
                        "Accept" : "application/json; charset=utf-8;",
                        "Content-Type":"application/json;",
                        "Authorization":"Bearer "+$('#hidToken').val()
                    },
                    contentType:"application/json; charset=utf-8",
                    data:null,
                    dataType:"json",
                    success: function (dataResult) {//cập nhật thành công
                        callback( {
                            draw: data.draw,
                            data: dataResult.content,
                            recordsTotal: dataResult.totalElements,
                            recordsFiltered: dataResult.totalElements
                        });
                    },
                    error: function (xhr) {
                        let aa='';
                        $.each(xhr.responseJSON, function( index, value ) {
                            aa+=' '+value.defaultMessage;
                        });
                        Swal.fire({
                            icon: 'error',
                            title: xhr.status,
                            text: aa
                        })
                    }
                });
            },
            "columns": [
                {"data": "amount.code"},
                {"data": "beforeValue"},
                {"data": "afterValue"},
                {"data": "updatedAt", "defaultContent": ""},
                {"data": "updatedBy.username", "defaultContent": ""},
            ]
        } );
        tbTranGift = $('#tbTransGift').DataTable( {
            serverSide: true,
            ordering: false,
            searching: false,
            ajax: function ( data, callback, settings ) {
                let size = data.length;
                let page = ((data.start + size) / size) - 1;
                $.ajax({
                    url:`api/v1/transactions?page=${page}&size=${size}&filter=amount.type:eq:GIFT,createdAt:inc:${$('#txtTimeTrans').val()}`,
                    type:"get",
                    headers: {
                        "Accept" : "application/json; charset=utf-8;",
                        "Content-Type":"application/json;",
                        "Authorization":"Bearer "+$('#hidToken').val()
                    },
                    contentType:"application/json; charset=utf-8",
                    data:null,
                    dataType:"json",
                    success: function (dataResult) {//cập nhật thành công
                        callback( {
                            draw: data.draw,
                            data: dataResult.content,
                            recordsTotal: dataResult.totalElements,
                            recordsFiltered: dataResult.totalElements
                        });
                    },
                    error: function (xhr) {
                        let aa='';
                        $.each(xhr.responseJSON, function( index, value ) {
                            aa+=' '+value.defaultMessage;
                        });
                        Swal.fire({
                            icon: 'error',
                            title: xhr.status,
                            text: aa
                        })
                    }
                });
            },
            "columns": [
                {"data": "amount.code"},
                {"data": "beforeValue"},
                {"data": "afterValue"},
                {"data": "updatedAt", "defaultContent": ""},
                {"data": "updatedBy.username", "defaultContent": ""},
            ]
        } );
    });



    //endregion transaction

    //region set Point
    tbPoint = $('#tbSetPoint').DataTable( {
        serverSide: true,
        ordering: false,
        searching: false,
        ajax: function ( data, callback, settings ) {
            let size = data.length;
            let page = ((data.start + size) / size) - 1;
            $.ajax({
                url:`api/v1/amounts?page=${page}&size=${size}&filter=type:eq:POINT`,
                type:"get",
                headers: {
                    "Accept" : "application/json; charset=utf-8;",
                    "Content-Type":"application/json;",
                    "Authorization":"Bearer "+$('#hidToken').val()
                },
                contentType:"application/json; charset=utf-8",
                data:null,
                dataType:"json",
                success: function (dataResult) {//cập nhật thành công
                    callback( {
                        draw: data.draw,
                        data: dataResult.content,
                        recordsTotal: dataResult.totalElements,
                        recordsFiltered: dataResult.totalElements
                    });
                },
                error: function (xhr) {
                    let aa='';
                    $.each(xhr.responseJSON, function( index, value ) {
                        aa+=' '+value.defaultMessage;
                    });
                    Swal.fire({
                        icon: 'error',
                        title: xhr.status,
                        text: aa
                    })
                }
            });
        },
        "columns": [
            {"data": ""},
            {"data": ""},
            {"data": "code"},
            {"data": "value"},
            {"data": "email"},
        ],
        "columnDefs": [
            {
                "targets": 0,
                "render": function ( data, type, row ) {
                    return  `<div class="btn-group">
                    <button type="button" class="btn btn-success btn-xs dropdown-toggle"
                            data-toggle="dropdown">
                        <span class="caret"></span> <span class="sr-only">Tùy chọn</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#"><span>Chỉnh sửa</span></a>
                        <li class="divider"></li>
                         <li><a href="#"><span>Xóa</span></a>
                    </ul>
                </div>`;
                }
            },
            {
                "targets": 1,
                "render": function ( data, type, row ) {
                    return  `${row.lastName} ${row.firstName}`;
                }
            },
        ]
    } );
    $('#btnSearchP').on('click',function () {
        if($('#txtPhoneP').val()>0){

        }else{
            $('#tbSetPoint').DataTable( {
                serverSide: true,
                // ordering: false,
                // searching: false,
                ajax: function ( data, callback, settings ) {
                    // console.log(data)
                    let size = data.length;
                    let page = ((data.start + size) / size) - 1;
                    $.get( `api/manager/amounts?page=${page}&size=${size}&filter=type:eq:POINT`, function( dataResult ) {
                        callback( {
                            draw: data.draw,
                            data: dataResult.content,
                            recordsTotal: dataResult.totalElements,
                            recordsFiltered: dataResult.totalElements
                        });
                    });
                },
                dom:"<'row'<'col-sm-6'l><'col-sm-6'<'#searchInput'>>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                "columns": [
                    {"data": ""},
                    {"data": ""},
                    {"data": "code"},
                    {"data": "value"},
                    {"data": "email"},
                ],
                "columnDefs": [
                    {
                        "targets": 0,
                        "render": function ( data, type, row ) {
                            return  `<div class="btn-group">
                              <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Chỉnh sửa</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Xóa</a>
                              </div>
                            </div>`;
                        }
                    },
                    {
                        "targets": 1,
                        "render": function ( data, type, row ) {
                            return  `${row.lastName} ${row.firstName}`;
                        }
                    },
                ]
            } );
        }
    });
    //endregion set Point

    //region set Balance
    $('#tbSetBanlance tbody').empty();
    tbBalance = $('#tbSetBanlance').DataTable( {
        serverSide: true,
        ordering: false,
        searching: false,
        ajax: function ( data, callback, settings ) {
            let size = data.length;
            let page = ((data.start + size) / size) - 1;
            let url= $('#txtSearchBalance').val()?`api/v1/amounts?page=${page}&size=${size}&filter=type:eq:GIFT,code:inc:${$('#txtSearchBalance').val()}`:`api/v1/amounts?page=${page}&size=${size}&filter=type:eq:GIFT`;
            $.ajax({
                url:url,
                type:"get",
                headers: {
                    "Accept" : "application/json; charset=utf-8;",
                    "Content-Type":"application/json;",
                    "Authorization":"Bearer "+$('#hidToken').val()
                },
                contentType:"application/json; charset=utf-8",
                data:null,
                dataType:"json",
                success: function (dataResult) {//cập nhật thành công
                    console.log(dataResult)
                    callback( {
                        draw: data.draw,
                        data: dataResult.content,
                        recordsTotal: dataResult.totalElements,
                        recordsFiltered: dataResult.totalElements
                    });
                },
                error: function (xhr) {
                    let aa='';
                    $.each(xhr.responseJSON, function( index, value ) {
                        aa+=' '+value.defaultMessage;
                    });
                    Swal.fire({
                        icon: 'error',
                        title: xhr.status,
                        text: aa
                    })
                }
            });
        },
        "columns": [
            {"data": "", width: '6%'},
            {"data": "code", width: '47%'},
            {"data": "value", width: '47%'},
        ],
        "columnDefs": [
            {
                "targets": 0,
                "render": function ( data, type, row ) {
                    return  `<div class="btn-group">
                              <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Chỉnh sửa</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Xóa</a>
                              </div>
                            </div>`;
                }
            },
        ]
    } );
    $('#btnSearchBalance').on("click",function () {
        tbBalance.ajax.reload();
    });
    //endregion set Balance



});