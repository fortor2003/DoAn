$( document ).ready(function() {
   $('.content section').hide();
   $('#his').on("click",function () {
        $('.content section').hide();
       $('.content section[data-name="his"]').show();
   })
    $('#allpoint').on("click",function () {
        $('.content section').hide();
        $('.content section[data-name="allpoint"]').show();
    })
    $('#setpoint').on("click",function () {
        $('.content section').hide();
        $('.content section[data-name="setpoint"]').show();
    })
    $('#addredeem').on("click",function () {
        $('.content section').hide();
        $('.content section[data-name="addredeem"]').show();
    })
});