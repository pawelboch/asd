jQuery( document ).ready(function( $ ) {

    // Toggle mobile menu

    $( '.nav-toggle' ).click(function() {
        $( '.main-nav' ).toggleClass( "display-on" );
    });

    // Search input toggle

    $( '.search-ico' ).click(function() {
       $( '.search-input-cont' ).toggle(300);

    });

    // Slick slider enable

    $('.slider').slick({
        dots: false,
        arrows: true,
    });

    // Header mobile menu
    var nav = $('#nav');
    if($(window).width() < 992){
        nav.find('li:has(".sub-menu")').append('<span class="expand">+</span>');
    }

    nav.find('li .expand').on('click',function(){
        var subMenu = $(this).siblings('.sub-menu');

        if($(this).hasClass('expanded')) {
            $(this).siblings('a').removeClass('expanded');
            $(this).removeClass('expanded').text('+');

            subMenu.fadeOut('fast');
        } else {
            $(this).siblings('a').addClass('expanded');
            $(this).addClass('expanded').text('-');

            subMenu.fadeIn('slow');
        }

    });

    // Header menu resizing

    $( window ).resize(function() {
        var expand = $('.expand');
        if($(window).width() >= 992){
            $('.main-nav').removeClass('display-on');
            if(expand.length > 0) {
                expand.hide();
            }
        } else {
            if(expand.length <= 0 ) {
                nav.find('li:has(".sub-menu")').append('<span class="expand">+</span>');
            } else {
                expand.show();
            }
        }
    });

    var actWindow = $(window);
    var headerBanner = $('header.banner-header');
    var previousScroll = 0;

    // Header menu compress on load

    if(actWindow.scrollTop() > 10) {
        headerBanner.css({
            'position': 'fixed',
            'box-shadow': '0 0 5px rgba(0,0,0,.5)'
        });
        if ($(this).scrollTop() >= 300) {
            headerBanner.addClass('smaller');
        } else {
            headerBanner.removeClass('smaller');
        }
    }

    // Header menu on scroll animation

    actWindow.scroll(function() {
        if(actWindow.scrollTop() > 10) {
            headerBanner.css({
                'position' : 'fixed',
                'box-shadow' : '0 0 5px rgba(0,0,0,.5)'
            });
            var currentScroll = $(this).scrollTop();
            if (currentScroll > previousScroll) {
                if ($(this).scrollTop() >= 300) {
                    headerBanner.addClass('smaller');
                }
            } else {
                if ($(this).scrollTop() < 300) {
                    headerBanner.removeClass('smaller');
                }
            }
            previousScroll = currentScroll;
        } else {
            headerBanner.css({
                'position' : 'absolute',
                'box-shadow' : 'none'
            });
        }
    });

});
