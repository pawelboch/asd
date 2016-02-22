jQuery( document ).ready( function( $ ) {
    // Tab toggle
       $('.pagebox-tables-module .head .title').on('click',function(){
           $('.pagebox-tables-module .head .title').removeClass('active');
           $(this).addClass('active');
           $('.pagebox-tables-module .tabs .row .content').hide();
           $('.'+$(this).attr('id')).fadeIn('fast');
       });

    // Tab mobile toggle
        var tabAmount = $('.pagebox-tables-module .head .title').length;
        var actualTab = 1;
        $('.arrow').on('click', function() {

            if($(this).hasClass('.navigation-up')) {
                actualTab++;

                if(actualTab > tabAmount){
                    actualTab = 1;
                }
            } else {
                actualTab--;

                if(actualTab < 1){
                    actualTab = 4;
                }
            }

            $('.pagebox-tables-module .head .title').removeClass('active');

            var showTab = $('.pagebox-tables-module .head .title:nth-child('+actualTab+')');

            showTab.addClass('active');

            $('.pagebox-tables-module .tabs .row .content').hide();

            $('.'+showTab.attr('id')).fadeIn('fast');
        });

});