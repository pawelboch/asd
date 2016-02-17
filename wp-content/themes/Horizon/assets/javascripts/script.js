jQuery( document ).ready(function( $ ) {

    // Toggle mobile menu

    $( '.nav-toggle' ).click(function() {
        $( '.main-nav' ).toggleClass( "display-on" );
    });
    
    
    // Tab toggle

    $('.pagebox-module-hd39fa12 .head .title').on('click',function(){
        $('.pagebox-module-hd39fa12 .head .title').removeClass('active');
        $(this).addClass('active');
        $('.pagebox-module-hd39fa12 .tabs .row .content').hide();
        $('.'+$(this).attr('id')).fadeIn('fast');
    });


    // Slick slider enable

    $('.slider').slick({
        dots: false,
        arrows: true,
    });

});
