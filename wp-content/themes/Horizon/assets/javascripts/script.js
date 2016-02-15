jQuery( document ).ready(function( $ ) {

    // Toggle mobile menu

    $( '.nav-toggle' ).click(function() {
        $( '.main-nav' ).toggleClass( "display-on" );
    });
    
    
    // Tab toggle

    $('.tables-module-fg23gh .head .title').on('click',function(){
        $('.tables-module-fg23gh .head .title').removeClass('active');
        $(this).addClass('active');
        $('.tables-module-fg23gh .tabs .row .content').hide();
        $('.'+$(this).attr('id')).fadeIn('fast');
    });


    // Slick slider enable

    $('.slider').slick({
        dots: false,
        arrows: true,
    });

    // Change Google Map pin

    var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: iconBase + 'schools_maps.png'
    });

});
