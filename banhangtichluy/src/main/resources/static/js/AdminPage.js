var tbPoint='';
var tbBalance='';
var tbTransP='';
var tbTransG='';
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
    let timeSelect = '';
    let today = new Date();
    let date = today.getFullYear()+'-'+((today.getMonth()+1)<10?'0'+(today.getMonth()+1):(today.getMonth()+1))+'-'+today.getDate();
    tbTransP = $('#tbTransPoint').DataTable( {
        serverSide: true,
        ordering: false,
        searching: false,
        ajax: function ( data, callback, settings ) {
            let size = data.length;
            let page = ((data.start + size) / size) - 1;
            $.ajax({
                url:`api/v1/transactions?page=${page}&size=${size}&filter=amount.type:eq:POINT,createdAt:inc:${timeSelect?timeSelect:date}`,
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
                    if(xhr.status==400){
                        let aa='';
                        $.each(xhr.responseJSON.message, function( index, value ) {
                            aa+=' '+value;
                        });
                        Swal.fire({
                            icon: 'error',
                            title: xhr.status,
                            text: aa
                        })
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: xhr.status,
                            text: xhr.responseText
                        })
                    }
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
    tbTransG =  $('#tbTransGift').DataTable( {
        serverSide: true,
        ordering: false,
        searching: false,
        ajax: function ( data, callback, settings ) {
            let size = data.length;
            let page = ((data.start + size) / size) - 1;
            $.ajax({
                url:`api/v1/transactions?page=${page}&size=${size}&filter=amount.type:eq:GIFT,createdAt:inc:${timeSelect?timeSelect:date}`,
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
                    if(xhr.status==400){
                        let aa='';
                        $.each(xhr.responseJSON.message, function( index, value ) {
                            aa+=' '+value;
                        });
                        Swal.fire({
                            icon: 'error',
                            title: xhr.status,
                            text: aa
                        })
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: xhr.status,
                            text: xhr.responseText
                        })
                    }
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
    $('#btnSearchTrans').on("click",function () {
        timeSelect=$('#txtTimeTrans').val();
        console.log(timeSelect)
        tbTransP.ajax.reload();
        tbTransG.ajax.reload();
    });



    //endregion transaction

    //region set Point
    var urlP ='';
    tbPoint = $('#tbSetPoint').DataTable( {
        serverSide: true,
        ordering: false,
        searching: false,
        ajax: function ( data, callback, settings ) {
            let size = data.length;
            let page = ((data.start + size) / size) - 1;
            let urlPP = `api/v1/amounts?page=${page}&size=${size}&filter=type:eq:POINT${urlP ? ',' + urlP : ''}`;
            $.ajax({
                url:urlPP,
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
                    if(xhr.status==400){
                        let aa='';
                        $.each(xhr.responseJSON.message, function( index, value ) {
                            aa+=' '+value;
                        });
                        Swal.fire({
                            icon: 'error',
                            title: xhr.status,
                            text: aa
                        })
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: xhr.status,
                            text: xhr.responseText
                        })
                    }
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
                              <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">     
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" onclick="GanThongTinP(${row.code})" href="#">Chỉnh sửa</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" onclick="xoaThongTinP(${row.id})" href="#">Xóa</a>
                              </div>
                            </div>`;
                }
            },
            {
                "targets": 1,
                "render": function ( data, type, row ) {
                    return  `${row.firstName} ${row.lastName}`;
                }
            },
        ]
    } );
    $('#btnSearchP').on('click',function () {
        let chuoi =''
        const phoneFilter = $('#txtPhoneP').val();
        const fnameFilter = $('#txtFistNameP').val();
        const lnameFilter = $('#txtLastNameP').val();
        if(phoneFilter){
            chuoi+=`code:inc:${phoneFilter},`
        }
        if(fnameFilter){
            chuoi+=`firstName:inc:${fnameFilter},`
        }
        if(lnameFilter){
            chuoi+=`lastName:inc:${lnameFilter},`
        }
        urlP = chuoi;//ghép chuỗi
        tbPoint.ajax.reload();//load lại danh sách
    });
    $('#btnResetP').on('click',function () {
        ResetThongTinP();
    });
    $('#btnUpdateP').on('click',function () {
       let data ={
           "type": "POINT",
           "code": $('#txtPhoneP').val(),
           "value": $('#txtValueP').val(),
           "firstName": $('#txtFistNameP').val(),
           "lastName": $('#txtLastNameP').val(),
           "email": $('#txtEmailP').val(),
           "phone": $('#txtPhoneP').val(),
           "note": $('#txtNoteP').val()
       } ;
        $.ajax({
            url:`/api/v1/amounts/${$('#txtIdP').val()}`,
            type:"put",
            headers: {
                // "Accept" : "application/json; charset=utf-8;",
                // "Content-Type":"application/json;",
                "Authorization":"Bearer "+$('#hidToken').val()
            },
            contentType:"application/json; charset=utf-8",
            data:JSON.stringify(data),
            dataType:"json",
            success: function (dataResult) {//cập nhật thành công
                ResetThongTinP();
                tbPoint.ajax.reload();
            },
            error: function (xhr) {
                console.log(xhr)
                if(xhr.status==400){
                    let aa='';
                    $.each(xhr.responseJSON.message, function( index, value ) {
                        aa+=' '+value;
                    });
                    Swal.fire({
                        icon: 'error',
                        title: xhr.status,
                        text: aa
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: xhr.status,
                        text: xhr.responseText
                    })
                }
            }
        });
    });
    $('#btnCreateP').on('click',function () {
        if($("#txtPhoneP").val()){
            $.ajax({
                url:`api/v1/amounts/POINT/${$('#txtPhoneP').val()}`,
                type:"get",
                headers: {
                    "Accept" : "application/json; charset=utf-8;",
                    "Content-Type":"application/json;",
                    "Authorization":"Bearer "+$('#hidToken').val()
                },
                contentType:"application/json; charset=utf-8",
                data:null,
                dataType:"json",
                success: function (dataResult) {// thành công
                    $("#txtFistNameP").val(dataResult.firstName);
                    $("#txtLastNameP").val(dataResult.lastName);
                    $("#txtEmailP").val(dataResult.email);
                    $("#txtPhoneP").val(dataResult.code);
                    $("#txtValueP").val(dataResult.value);
                    $("#txtNoteP").val(dataResult.note);
                    $("#txtIdP").val(dataResult.id);
                    $('#btnUpdateP').show();
                    $('#btnCreateP').hide();
                },
                error: function (jqXHR) {
                    if(parseInt(jqXHR.status)===404){
                        Swal.fire({
                            title: 'New user',
                            text:'Do you want to create user ?',
                            showCancelButton: true,
                            confirmButtonText: `Save`,
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                let data = {
                                    "type":"POINT",
                                    "code":$("#txtPhoneP").val(),
                                    "value":$('#txtValueP').val()?parseInt($('#txtValueP').val()):0,
                                    "firstName": $("#txtFistNameP").val()?$("#txtFistNameP").val():"null",
                                    "lastName": $("#txtLastNameP").val()?$("#txtLastNameP").val():"null",
                                    "email":$("#txtEmailP").val()?$("#txtEmailP").val():"null@null.null",
                                    "phone":$("#txtPhoneP").val(),
                                    "note":$('#txtNoteP').val()?$("#txtNoteP").val():"null"
                                };
                                $.ajax({
                                    url:"api/v1/amounts",
                                    type:"POST",
                                    headers: {
                                        "Accept" : "application/json; charset=utf-8;",
                                        "Content-Type":"application/json;",
                                        "Authorization":"Bearer "+$('#hidToken').val()
                                    },
                                    contentType:"application/json; charset=utf-8",
                                    data:JSON.stringify(data),
                                    dataType:"json",
                                    success: function (result) {//tạo mới
                                        tbPoint.ajax.reload();
                                        ResetThongTinP();
                                    },
                                    error: function (xhr) {
                                        console.log(xhr)
                                        let aa='';
                                        $.each(xhr.responseJSON, function( index, value ) {
                                            aa+=' '+value.field;
                                        });
                                        Swal.fire({
                                            icon: 'error',
                                            title: xhr.status,
                                            text: aa
                                        })
                                    }
                                });
                                Swal.fire('Saved!', '', 'success')
                            }
                        })
                    }
                }
            });
        }else{ /// search value null
            Swal.fire({
                icon: 'warning',
                title: "Chưa nhập số điện thoại"
            })
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
                    callback( {
                        draw: data.draw,
                        data: dataResult.content,
                        recordsTotal: dataResult.totalElements,
                        recordsFiltered: dataResult.totalElements
                    });
                },
                error: function (xhr) {
                    if(xhr.status==400){
                        let aa='';
                        $.each(xhr.responseJSON.message, function( index, value ) {
                            aa+=' '+value;
                        });
                        Swal.fire({
                            icon: 'error',
                            title: xhr.status,
                            text: aa
                        })
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: xhr.status,
                            text: xhr.responseText
                        })
                    }
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

//region Point
function ResetThongTinP(){
    $('#frmSetPoint input').val('');
    $('#btnUpdateP').hide();
    $('#btnCreateP').show();
}
function GanThongTinP(code) {
    $.ajax({
        url:`api/v1/amounts/POINT/${code}`,
        type:"get",
        headers: {
            "Accept" : "application/json; charset=utf-8;",
            "Content-Type":"application/json;",
            "Authorization":"Bearer "+$('#hidToken').val()
        },
        contentType:"application/json; charset=utf-8",
        data:null,
        dataType:"json",
        success: function (dataResult) {// thành công
            $("#txtFistNameP").val(dataResult.firstName);
            $("#txtLastNameP").val(dataResult.lastName);
            $("#txtEmailP").val(dataResult.email);
            $("#txtPhoneP").val(dataResult.code);
            $("#txtValueP").val(dataResult.value);
            $("#txtNoteP").val(dataResult.note);
            $("#txtIdP").val(dataResult.id);
            $('#btnUpdateP').show();
            $('#btnCreateP').hide();
        },
        error: function (xhr) {
            if(xhr.status==400){
                let aa='';
                $.each(xhr.responseJSON.message, function( index, value ) {
                    aa+=' '+value;
                });
                Swal.fire({
                    icon: 'error',
                    title: xhr.status,
                    text: aa
                })
            }else{
                Swal.fire({
                    icon: 'error',
                    title: xhr.status,
                    text: xhr.responseText
                })
            }
        }
    });
}
function xoaThongTinP(id) {
    $.ajax({
        url:`api/v1/amounts/${id}`,
        type:"delete",
        headers: {
            "Accept" : "application/json; charset=utf-8;",
            "Content-Type":"application/json;",
            "Authorization":"Bearer "+$('#hidToken').val()
        },
        contentType:"application/json; charset=utf-8",
        data:null,
        dataType:"json",
        success: function (dataResult) {// thành công
           tbPoint.ajax.reload();
            Swal.fire('Xóa thành công!', '', 'success')
        },
        error: function (xhr) {
            if(xhr.status==400){
                let aa='';
                $.each(xhr.responseJSON.message, function( index, value ) {
                    aa+=' '+value;
                });
                Swal.fire({
                    icon: 'error',
                    title: xhr.status,
                    text: aa
                })
            }else{
                Swal.fire({
                    icon: 'error',
                    title: xhr.status,
                    text: xhr.responseText
                })
            }
        }
    });
}
//endregion Point

//region Balance
function XoaBanlace(id) {
    $.ajax({
        url:`api/v1/amounts/${id}`,
        type:"delete",
        headers: {
            "Accept" : "application/json; charset=utf-8;",
            "Content-Type":"application/json;",
            "Authorization":"Bearer "+$('#hidToken').val()
        },
        contentType:"application/json; charset=utf-8",
        data:null,
        dataType:"json",
        success: function (dataResult) {// thành công
            tbBalance.ajax.reload();
            Swal.fire('Xóa thành công!', '', 'success')
        },
        error: function (xhr) {
            if(xhr.status==400){
                let aa='';
                $.each(xhr.responseJSON.message, function( index, value ) {
                    aa+=' '+value;
                });
                Swal.fire({
                    icon: 'error',
                    title: xhr.status,
                    text: aa
                })
            }else{
                Swal.fire({
                    icon: 'error',
                    title: xhr.status,
                    text: xhr.responseText
                })
            }
        }
    });
}
//endregion Balance