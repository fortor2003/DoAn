var tbPoint='';
$( document ).ready(function() {
   //region on off conten
   $('.content section').hide();
   $('#his').on("click",function () {
       $('.content section').hide();
       $('.content section[data-name="his"]').show();
   })
    $('#setbalance').on("click",function () {
        $('.content section').hide();
        $('.content section[data-name="setbalance"]').show();
    })
    $('#setpoint').on("click",function () {
        $('.content section').hide();
        $('.content section[data-name="setpoint"]').show();
    })
    $('.nav a').click(function() {//active menu
        $('.nav a').removeClass('active');
        $(this).addClass('active');
    });
    //endregion on off conten

    //region set Point
    tbPoint = $('#tbSetPoint').DataTable( {
        serverSide: true,
        // ordering: false,
        // searching: false,
        ajax: function ( data, callback, settings ) {
            console.log(data)
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
                    console.log(data)
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
        }
    });
    //endregion set Point

    //region set Balance
    $('#tbSetBanlance tbody').empty();
    $('#tbSetBanlance').DataTable( {
        serverSide: true,
        ordering: false,
        searching: false,
        ajax: function ( data, callback, settings ) {
            let size = data.length;
            let page = ((data.start + size) / size) - 1;
            $.get( `api/manager/amounts?page=${page}&size=${size}&filter=type:eq:GIFT`, function( dataResult ) {
                callback( {
                    draw: data.draw,
                    data: dataResult.content,
                    recordsTotal: dataResult.totalElements,
                    recordsFiltered: dataResult.totalElements
                });
            });
        },
        "columns": [
            {"data": ""},
            {"data": "code"},
            {"data": "value"},
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
        ]
    } );
    //endregion set Balance


    // "api/manager/amounts?page=0&size=10&filter=code:eq:012146571827523"
    $.get( "api/manager/transactions?page=0&size=10", function( data ) {
        console.log(data);
    });
    // $.get( "api/manager/amounts/create-example-data", function( data ) {
    //     console.log(data);
    // });
});