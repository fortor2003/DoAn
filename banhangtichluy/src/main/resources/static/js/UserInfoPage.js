
$( document ).ready(function() {
    $('#btnGift').on("click",function () {
        $('#mdGift').modal('show');
    });
    $('#btnPoint').on("click",function () {
        $('#mdPoint').modal('show');
    });
    $("#btnSearchPoint").on("click",function () {
        if($("#txtPhonePoint").val()){
            $.get(`api/manager/amounts/POINT/${$('#txtPhonePoint').val()}`, function(data){
                $("#idThe").val(data.id);
                $("#txtFirstNamePoint").val(data.firstName);
                $("#txtLastNamePoint").val(data.lastName);
                $("#txtEmailPoint").val(data.email);
                $("#spPoint").html(data.value);
            }).fail(function( jqXHR) { //ko tìm thấy dử liệu
                if(parseInt(jqXHR.status)===404){
                    let data = {
                        "type":"POINT",
                        "code":$("#txtPhonePoint").val(),
                        "value":0,
                        "firstName": $("#txtFirstNamePoint").val()?$("#txtFirstNamePoint").val():"null",
                        "lastName": $("#txtLastNamePoint").val()?$("#txtLastNamePoint").val():"null",
                        "email":$("#txtEmailPoint").val()?$("#txtEmailPoint").val():"null@null.null",
                        "phone":$("#txtPhonePoint").val(),
                        "note":""
                    };
                    $.ajax({
                        url:"api/manager/amounts",
                        type:"POST",
                        headers: {
                            "Accept" : "application/json; charset=utf-8;",
                            "Content-Type":"application/json;"
                        },
                        contentType:"application/json; charset=utf-8",
                        data:JSON.stringify(data),
                        dataType:"json",
                        success: function (result) {//tạo mới
                            $("#idThe").val(result.id);
                            $("#txtFirstNamePoint").val(result.firstName);
                            $("#txtLastNamePoint").val(result.lastName);
                            $("#txtEmailPoint").val(result.email);
                            $("#txtPhonePoint").val(result.code);
                            $("#spPoint").html(result.value);
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
                }
            });
        }else{ /// search value null
            $("#idThe").val(0);
            $("#txtFirstNamePoint").val("");
            $("#txtLastNamePoint").val("");
            $("#txtEmailPoint").val("");
            $("#txtPhonePoint").val("");
            $("#spPoint").html(0);
        }
    });
    $("#btnAddPoint").on("click",function () {
        if($("#idThe").val()>0){
            Swal.fire({
                title: 'Do you want to add Point?',
                showCancelButton: true,
                confirmButtonText: `Save`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    let data = {
                        "value":1 ,
                        "note":""
                    }
                    $.ajax({
                        url:`api/manager/amounts/${$("#idThe").val()}/add-value`,
                        type:"PUT",
                        headers: {
                            "Accept" : "application/json; charset=utf-8;",
                            "Content-Type":"application/json;"
                        },
                        contentType:"application/json; charset=utf-8",
                        data:JSON.stringify(data),
                        dataType:"json",
                        success: function (result) {//cập nhật thành công
                            $("#idThe").val(result.id);
                            $("#txtFirstNamePoint").val(result.firstName);
                            $("#txtLastNamePoint").val(result.lastName);
                            $("#txtEmailPoint").val(result.email);
                            $("#txtPhonePoint").val(result.code);
                            $("#spPoint").html(result.value);
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
                    Swal.fire('Saved!', '', 'success')
                }
            })
        }else {
            Swal.fire({
                icon: 'error',
                title: "User cannot be found!"
            })
        }
    });

    $("#btnRedeemPoint").on("click",function () {
        if($("#idThe").val()>0){
            Swal.fire({
                title: 'Do you want to redeem Point?',
                showCancelButton: true,
                confirmButtonText: `Save`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    let data = {
                        "value":-10 ,
                        "note":""
                    }
                    $.ajax({
                        url:`api/manager/amounts/${$("#idThe").val()}/add-value`,
                        type:"PUT",
                        headers: {
                            "Accept" : "application/json; charset=utf-8;",
                            "Content-Type":"application/json;"
                        },
                        contentType:"application/json; charset=utf-8",
                        data:JSON.stringify(data),
                        dataType:"json",
                        success: function (result) {//cập nhật thành công
                            $("#idThe").val(result.id);
                            $("#txtFirstNamePoint").val(result.firstName);
                            $("#txtLastNamePoint").val(result.lastName);
                            $("#txtEmailPoint").val(result.email);
                            $("#txtPhonePoint").val(result.code);
                            $("#spPoint").html(result.value);
                        },
                        error: function (xhr) {
                            if(xhr.status==500){
                                Swal.fire({
                                    icon: 'error',
                                    title: xhr.status,
                                    text: xhr.responseText
                                })
                            }else{
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
                        }
                    });
                    Swal.fire('Saved!', '', 'success')
                }
            })
        }else {
            Swal.fire({
                icon: 'error',
                title: "User cannot be found!"
            })
        }
    });

});