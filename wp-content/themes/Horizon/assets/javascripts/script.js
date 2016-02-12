jQuery( document ).ready(function( $ ) {

    // Toggle mobile menu

    $( '.nav-toggle' ).click(function() {
        $( '.main-nav' ).toggleClass( "display-on" );
    });


    // Slick slider enable

    $('.slider').slick({
        dots: false,
        arrows: true,
    });

});
