jQuery( document ).ready(function( $ ) {

    // Toggle mobile menu

    $( '.nav-toggle' ).click(function() {
        $( '.main-nav' ).toggleClass( "display-on" );
    });

    // Search input toggle

    $( '.search-ico' ).click(function() {
       $( '.search-ico > .search-input' ).toggle(300);
    });

    // Slick slider enable

    $('.slider').slick({
        dots: false,
        arrows: true,
    });

});
