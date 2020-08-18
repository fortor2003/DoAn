$(document).ready(function () {
    //1. Rating scrore init
    //Rating star
    $('.score').raty({
        width: 130,
        score: 5,
        path: '../images/rate/',
        starOff: 'star-off.svg',
        starOn: 'star-on.svg'
    });

    //2. Swiper slider
    //Media slider
    //init employee sliders
    var mySwiper = new Swiper('.swiper-container', {
        slidesPerView: 4,
    });

    $('.swiper-slide-active').css({'marginLeft': '-1px'});

    //Media switch
    $('.list--photo').click(function (e) {
        e.preventDefault();

        var mediaFilter = $(this).attr('data-filter');

        $('.swiper-slide').hide();
        $('.' + mediaFilter).show();

        $('.swiper-wrapper').css('transform', 'translate3d(0px, 0px, 0px)')
        mySwiper.params.slideClass = mediaFilter;

        mySwiper.reInit();
        $('.swiper-slide-active').css({'marginLeft': '-1px'});
    })

    $('.list--video').click(function (e) {
        e.preventDefault();

        var mediaFilter = $(this).attr('data-filter');
        $('.swiper-slide').hide();
        $('.' + mediaFilter).show();

        $('.swiper-wrapper').css('transform', 'translate3d(0px, 0px, 0px)')
        mySwiper.params.slideClass = mediaFilter;

        mySwiper.reInit();
        $('.swiper-slide-active').css({'marginLeft': '-1px'});
    });

    //media swipe visible slide
    //Onload detect

    if ($(window).width() > 760 & $(window).width() < 992) {
        mySwiper.params.slidesPerView = 2;
        mySwiper.resizeFix();
    } else if ($(window).width() < 767 & $(window).width() > 481) {
        mySwiper.params.slidesPerView = 3;
        mySwiper.resizeFix();

    } else if ($(window).width() < 480 & $(window).width() > 361) {
        mySwiper.params.slidesPerView = 2;
        mySwiper.resizeFix();
    } else if ($(window).width() < 360) {
        mySwiper.params.slidesPerView = 1;
        mySwiper.resizeFix();
    } else {
        mySwiper.params.slidesPerView = 4;
        mySwiper.resizeFix();
    }

    if ($('.swiper-container').width() > 900) {
        mySwiper.params.slidesPerView = 5;
        mySwiper.resizeFix();
    }

    //Resize detect
    $(window).resize(function () {

        if ($(window).width() > 760 & $(window).width() < 992) {
            mySwiper.params.slidesPerView = 2;
            mySwiper.reInit();
        } else if ($(window).width() < 767 & $(window).width() > 481) {
            mySwiper.params.slidesPerView = 3;
            mySwiper.reInit();

        } else if ($(window).width() < 480 & $(window).width() > 361) {
            mySwiper.params.slidesPerView = 2;
            mySwiper.reInit();
        } else if ($(window).width() < 360) {
            mySwiper.params.slidesPerView = 1;
            mySwiper.reInit();
        } else {
            mySwiper.params.slidesPerView = 4;
            mySwiper.reInit();
        }


    });

    //3. Slider item pop up
    //boolian var
    var toggle = true;

    //pop up video media element
    $('.media-video .movie__media-item').magnificPopup({
        //disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,

        fixedContentPos: false,

        gallery: {
            enabled: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },

        disableOn: function () {
            return toggle;
        }
    });

    //pop up photo media element
    $('.media-photo .movie__media-item').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-fade',
        image: {
            verticalFit: true
        },

        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },

        disableOn: function () {
            return toggle;
        }

    });

    //detect if was move after click
    $('.movie__media .swiper-slide').on('mousedown', function (e) {
        toggle = true;
        $(this).on('mousemove', function testMove() {
            toggle = false;
        });
    });

    //7. Timetable active element
    $('.time-select').on('click', '.time-select__item', function () {
        $('.time-select__item').removeClass('active');
        $(this).addClass('active');
    });


    $('.swiper-slide-active').css({'marginLeft': '-1px'});

    //Media switch
    $('.list--photo').click(function (e) {
        e.preventDefault();

        var mediaFilter = $(this).attr('data-filter');

        $('.swiper-slide').hide();
        $('.' + mediaFilter).show();

        $('.swiper-wrapper').css('transform', 'translate3d(0px, 0px, 0px)')
        mySwiper.params.slideClass = mediaFilter;

        mySwiper.reInit();
        $('.swiper-slide-active').css({'marginLeft': '-1px'});
    })

    $('.list--video').click(function (e) {
        e.preventDefault();

        var mediaFilter = $(this).attr('data-filter');
        $('.swiper-slide').hide();
        $('.' + mediaFilter).show();

        $('.swiper-wrapper').css('transform', 'translate3d(0px, 0px, 0px)')
        mySwiper.params.slideClass = mediaFilter;

        mySwiper.reInit();
        $('.swiper-slide-active').css({'marginLeft': '-1px'});
    });
    //media swipe visible slide
    //Onload detect

    if ($(window).width() > 768 & $(window).width() < 992) {
        mySwiper.params.slidesPerView = 3;
        mySwiper.resizeFix();
    } else if ($(window).width() < 767 & $(window).width() > 481) {
        mySwiper.params.slidesPerView = 3;
        mySwiper.resizeFix();

    } else if ($(window).width() < 480 & $(window).width() > 361) {
        mySwiper.params.slidesPerView = 2;
        mySwiper.resizeFix();
    } else if ($(window).width() < 360) {
        mySwiper.params.slidesPerView = 1;
        mySwiper.resizeFix();
    } else {
        mySwiper.params.slidesPerView = 5;
        mySwiper.resizeFix();
    }

    if ($('.swiper-container').width() > 900) {
        mySwiper.params.slidesPerView = 5;
        mySwiper.resizeFix();
    }

    //Resize detect
    $(window).resize(function () {
        if ($(window).width() > 993 & $('.swiper-container').width() > 900) {
            mySwiper.params.slidesPerView = 5;
            mySwiper.reInit();
        }
        if ($(window).width() > 768 & $(window).width() < 992) {
            mySwiper.params.slidesPerView = 3;
            mySwiper.reInit();
        } else if ($(window).width() < 767 & $(window).width() > 481) {
            mySwiper.params.slidesPerView = 3;
            mySwiper.reInit();
        } else if ($(window).width() < 480 & $(window).width() > 361) {
            mySwiper.params.slidesPerView = 2;
            mySwiper.reInit();
        } else if ($(window).width() < 360) {
            mySwiper.params.slidesPerView = 1;
            mySwiper.reInit();
        } else {
            mySwiper.params.slidesPerView = 5;
            mySwiper.reInit();
        }
    });

    //select
    $('#chonRap').select2();

    $('#chonRap').on('select2:select', function (e) {
        timSuatChieu();
    });

    //5. Datepicker init
    $('#ngayChieu').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        showAnim: "fade",
        dateFormat: 'dd/mm/yy',
        onSelect: function (dateText) {
            timSuatChieu();
        }
    }).datepicker("setDate", new Date());

});

function timSuatChieu() {
    const rapId = $('#chonRap').select2('data')[0].id;
    const ngayChieu = moment($('#ngayChieu').datepicker('getDate')).format('YYYY-MM-DD');
    console.log(rapId, ngayChieu);
    jQuery.ajax({
        url: 'http://bkcinema.local/api/phim/' + $('#txtPhimId').val() + '/suat_chieu?rap_id=' + rapId + '&ngay_chieu=' + ngayChieu,
        data: null,
        method: 'get',
        success: function (danhSachRap) {
            console.log(danhSachRap);
            let html = '';
            danhSachRap.forEach(rap => {
                html += '<div class="time-select__group"><div class="col-sm-4"><p class="time-select__place">' + rap.ten_rap + '</p></div><ul class="col-sm-8 items-wrap">';
                rap.danh_sach_suat_chieu.forEach(suatChieu => {
                    html += '<li class="time-select__item" data-id="' + suatChieu.id + '" data-time="' + suatChieu.gio_bat_dau.thoi_gian + '">' + suatChieu.gio_bat_dau.thoi_gian + '</li>';
                });
                html += '</ul></div>';
            });
            $('.time-select').html(html);
        },
        error: function (err) {
            console.log(err);
        }
    })
}
