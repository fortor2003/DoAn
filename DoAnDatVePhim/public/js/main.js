$(document).ready(function () {

//General function for all pages

//Modernizr touch detect
    Modernizr.load({
        test: Modernizr.touch,
        yep: ['css/touch.css?v=1'],
        nope: []
    });

//1. Scroll to top arrow
// Scroll to top
    var $block = $('<div/>', {'class': 'top-scroll'}).append('<a href="#"/>').hide().appendTo('body').click(function () {
        $('body,html').animate({scrollTop: 0}, 800);
        return false;
    });

//initialization
    var $window = $(window);

    if ($window.scrollTop() > 35) {
        showElem();
    } else {
        hideElem();
    }

//handlers
    $window.scroll(function () {
        if ($(this).scrollTop() > 35) {
            showElem();
        } else {
            hideElem();
        }
    });

//functions
    function hideElem() {
        $block.fadeOut();
    }

    function showElem() {
        $block.fadeIn();
    }

//2. Mobile menu
//Init mobile menu
    $('#navigation').mobileMenu({
        triggerMenu: '#navigation-toggle',
        subMenuTrigger: ".sub-nav-toggle",
        animationSpeed: 500
    });

//3. Search bar dropdown
//search bar
    $("#search-sort").selectbox({
        onChange: function (val, inst) {

            $(inst.input[0]).children().each(function (item) {
                $(this).removeAttr('selected');
            })
            $(inst.input[0]).find('[value="' + val + '"]').attr('selected', 'selected');
        }

    });

    //Dropdown for authorize button
    //user list option
    $('.auth__show').click(function (e) {
        e.preventDefault();
        $('.auth__function').toggleClass('open-function')
    })

    $('.btn--singin').click(function (e) {
        e.preventDefault();
        $('.auth__function').toggleClass('open-function')
    });

// Gắn background-image
    $('.set-bg[data-bg]').each(function (idx, item) {
        $(item).css({
            backgroundImage: 'url("' + $(item).data('bg') + '")'
        })
    });
    // Gắn header token
    window.Echo.connector.pusher.config.auth.headers['Authorization'] = 'Bearer ' + $('meta[name="api_token"]').attr('content');
});

function apiCall(url, method, data) {
    return new Promise((resolve, reject) => {
        jQuery.ajax({
            url: $('meta[name="url_api"]').attr('content') + '/' + url,
            data: data,
            method: method,
            contentType: 'application/json',
            headers: {
                'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content')
            },
            beforeSend: function () {
                $('.loading').show();
            },
            success: function (data) {
                resolve(data);
            },
            error: function (err) {
                console.log(err);
                reject(err);
            },
            complete: function () {
                $('.loading').hide();
            }
        });
    });
}
