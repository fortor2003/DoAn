$(document).ready(function () {
    //1. Buttons for choose order method
//order factor
    $('.order__control-btn').click(function (e) {
        e.preventDefault();

        $('.order__control-btn').removeClass('active');
        $(this).addClass('active');
    })

//2. Init vars for order data
// var for booking;
    var movie = $('.choosen-movie'),
        city = $('.choosen-city'),
        date = $('.choosen-date'),
        cinema = $('.choosen-cinema'),
        time = $('.choosen-time');

//3. Swiper slider
//init employee sliders
    var mySwiper = new Swiper('.swiper-container',{
        slidesPerView:10,
        loop:true
    });

    $('.swiper-slide-active').css({'marginLeft':'-2px'});
//media swipe visible slide
//Onload detect
    if ($(window).width() > 1930 ){
        mySwiper.params.slidesPerView=13;
        mySwiper.resizeFix();
    }else

    if ($(window).width() >993 & $(window).width() <  1199  ){
        mySwiper.params.slidesPerView=6;
        mySwiper.resizeFix();
    }
    else
    if ($(window).width() >768 & $(window).width() <  992  ){
        mySwiper.params.slidesPerView=5;
        mySwiper.resizeFix();
    }

    else
    if ($(window).width() < 767 & $(window).width() > 481){
        mySwiper.params.slidesPerView=4;
        mySwiper.resizeFix();

    } else
    if ($(window).width() < 480){
        mySwiper.params.slidesPerView=2;
        mySwiper.resizeFix();
    }

    else{
        mySwiper.params.slidesPerView=10;
        mySwiper.resizeFix();
    }

//Resize detect
    $(window).resize(function(){
        if ($(window).width() > 1930 ){
            mySwiper.params.slidesPerView=13;
            mySwiper.reInit();
        }

        if ($(window).width() >993 & $(window).width() <  1199  ){
            mySwiper.params.slidesPerView=6;
            mySwiper.reInit();
        }
        else
        if ($(window).width() >768 & $(window).width() <  992  ){
            mySwiper.params.slidesPerView=5;
            mySwiper.reInit();
        }

        else
        if ($(window).width() < 767 & $(window).width() > 481){
            mySwiper.params.slidesPerView=4;
            mySwiper.reInit();

        } else
        if ($(window).width() < 480){
            mySwiper.params.slidesPerView=2;
            mySwiper.reInit();
        }

        else{
            mySwiper.params.slidesPerView=10;
            mySwiper.reInit();
        }
    });

//4. Dropdown init
//select
    $("#select-sort").selectbox({
        onChange: function (val, inst) {

            $(inst.input[0]).children().each(function(item){
                $(this).removeAttr('selected');
            })
            $(inst.input[0]).find('[value="'+val+'"]').attr('selected','selected');
        }

    });

    // $(document).click(function(e) {
    //     var ele = $(e.target);
    //     if (!ele.hasClass("datepicker__input") && !ele.hasClass("ui-datepicker") && !ele.hasClass("ui-icon") && !$(ele).parent().parents(".ui-datepicker").length){
    //         $(".datepicker__input").datepicker("hide");
    //     }
    // });

//6. Choose variant proccess
//choose film
    $('.film-images').click(function (e) {
        //visual iteractive for choose
        $('.film-images').removeClass('film--choosed');
        $(this).addClass('film--choosed');

        //data element init
        var chooseFilm = $(this).parent().attr('data-film');
        $('.choose-indector--film').find('.choosen-area').text(chooseFilm);

        //data element set
        movie.val(chooseFilm);

    })

//choose time
    $('.time-select').on('click', '.time-select__item', function (){
        //visual iteractive for choose
        $('.time-select__item').removeClass('active');
        $(this).addClass('active');

        //data element init
        var chooseTime = $(this).attr('data-time');
        $('.choose-indector--time').find('.choosen-time').text(chooseTime);

        //data element init
        var chooseCinema = $(this).parent().parent().find('.time-select__place').text();
        $('.choose-indector--time').find('.choosen-location').text(chooseCinema);

        //data element set
        // time.val(chooseTime);
        // cinema.val(chooseCinema);
    });

// choose (change) city and date for film

//data element init (default)
    var chooseCity = $('.select .sbSelector').text();
    var chooseDate = $('.datepicker__input').val();

//data element set (default)
    city.val(chooseCity);
    date.val(chooseDate);


    $('.select .sbOptions').click(function (){
        //data element change
        var chooseCity = $('.select .sbSelector').text();
        //data element set change
        city.val(chooseCity);
    });

    $('.datepicker__input').change(function () {
        //data element change
        var chooseDate = $('.datepicker__input').val();
        //data element set change
        date.val(chooseDate);
    });

// --- Step for data - serialize and send to next page---//
    $('.booking-form').submit( function () {
        var bookData = $(this).serialize();
        $.get( $(this).attr('action'), bookData );
    })

//7. Visibility block on page control
//control block display on page
    $('.choose-indector--film').click(function (e) {
        e.preventDefault();
        $(this).toggleClass('hide-content');
        $('.choose-film').slideToggle(400);
    })

    $('.choose-indector--time').click(function (e) {
        e.preventDefault();
        $(this).toggleClass('hide-content');
        $('.time-select').slideToggle(400);
    })

    $('#chonRap').select2();

    $('#chonRap').on('select2:select', function (e) {
        // timSuatChieu();
    });

    $('#ngayChieu').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        showAnim: "fade",
        dateFormat: 'dd/mm/yy',
        onSelect: function (dateText) {
            // timSuatChieu();
        }
    }).datepicker("setDate", new Date());
});
