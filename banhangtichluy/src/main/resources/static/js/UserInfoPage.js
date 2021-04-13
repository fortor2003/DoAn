
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
                console.log(data);
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
                        "fistName": $("#txtFirstNamePoint").val(),
                        "lastName": $("#txtLastNamePoint").val(),
                        "email":$("#txtEmailPoint").val(),
                        "phone":$("#txtPhonePoint").val(),
                        "note":""
                    };
                    console.log(JSON.stringify(data));
                    $.ajax({
                        url:"api/manager/amounts",
                        type:"POST",
                        headers: {
                            "Accept" : "application/json; charset=utf-8;",
                            "Content-Type":"application/json;"
                        },
                        contentType:"application/json; charset=utf-8",
                        data:JSON.stringify(data),
                        dataType:"json"
                    })

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

});