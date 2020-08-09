"use strict";
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

//4. Login window pop up
//Login pop up
$('.login-window').click(function (e) {
    e.preventDefault();
    $('.overlay').removeClass('close').addClass('open');
});

$('.overlay-close').click(function (e) {
    e.preventDefault;
    $('.overlay').removeClass('open').addClass('close');

    setTimeout(function () {
        $('.overlay').removeClass('close');
    }, 500);
});


// Gắn background-image
$('.set-bg[data-bg]').each(function (idx, item) {
    console.log(idx);
    $(item).css({
        backgroundImage: 'url("'+$(item).data('bg')+'")'
    })
});



