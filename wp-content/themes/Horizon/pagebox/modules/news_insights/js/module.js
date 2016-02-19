jQuery( document ).ready( function( $ ) {

     // Tab toggle

        $('.pagebox-tables-module .head .title').on('click',function(){
            $('.pagebox-tables-module .head .title').removeClass('active');
            $(this).addClass('active');
            $('.pagebox-tables-module .tabs .row .content').hide();
            $('.'+$(this).attr('id')).fadeIn('fast');
        });

});