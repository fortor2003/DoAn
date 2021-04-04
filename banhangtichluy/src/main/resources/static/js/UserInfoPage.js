
$( document ).ready(function() {
    $('#btnGift').on("click",function () {
        $('#mdGift').modal('show');
    });
    $('#btnPoint').on("click",function () {
        $('#mdPoint').modal('show');
    });
    $("#btnSearchPoint").on("click",function () {
        $.get(`api/the/${$('#txtPhonePoint').val()}/v1`, function(data){
            console.log(data);
            if (data.data){
                let point =data.data;
                $("#idThe").val(point.id);
                $("#txtNamePoint").val(point.ten);
                $("#spPoint").html(point.diem);
            }else{
                $('#idThe').val("");
                $("#txtNamePoint").val("");
                $("#idThe").val(0);
                $("#spPoint").html(0);
            }
        });
    });

});