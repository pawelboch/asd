jQuery( document ).ready( function( $ ) {
    $('.print').click(function(){
        window.print();
    });

    $('.social').click(function() {

        $('.social-toggle').toggle('normal','swing');
    });
});