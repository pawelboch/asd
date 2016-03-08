jQuery( document ).ready( function( $ ) {
    // Tab toggle
    //   $('.pagebox-side_tables-module .tabs .row .content .left .sub-menu .content').removeClass('active');
       $('.pagebox-side_tables-module .head .title').on('click',function(){
           $('.pagebox-side_tables-module .head .title').removeClass('active');
           $(this).addClass('active');
           $('.pagebox-side_tables-module .tabs .row .content').hide();
           $('.pagebox-side_tables-module .tabs .row .content .sidebar').hide();
           $('.pagebox-side_tables-module .tabs .row .content .left .single-0').show();
           $('.pagebox-side_tables-module .tabs .row .content .left .sub-menu-tabs > div').removeClass('active');
           $('.pagebox-side_tables-module .tabs .row .content .left #single-0').addClass('active');
           $('.pagebox-side_tables-module .tabs .row .content .sidebar.single-0').show();
           $('.'+$(this).attr('id')).show();
           window.location.hash = $(this).attr('data-hash');
       });

    $('.pagebox-side_tables-module .tabs .row .content .left .single-0').show();
    $('.pagebox-side_tables-module .tabs .row .content .left #single-0').addClass('active');

    $('.pagebox-side_tables-module .left .single-menu').on('click',function(){
            $('.pagebox-side_tables-module .left .single-menu').removeClass('active');
            $(this).addClass('active');
            $('.pagebox-side_tables-module .tabs .row .content .sidebar').hide();
            $('.pagebox-side_tables-module .tabs .row .content .left .content').hide();
            $('.'+$(this).attr('id')).show();
    });

    // Tab mobile toggle
        var tabAmount = $('.pagebox-side_tables-module .head .title').length;
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
                    actualTab = tabAmount;
                }
            }

            $('.pagebox-side_tables-module .head .title').removeClass('active');

            var showTab = $('.pagebox-side_tables-module .head .title:nth-child('+actualTab+')');

            showTab.addClass('active');

            $('.pagebox-side_tables-module .tabs .row > .content').hide();

            $('.'+showTab.attr('id')).fadeIn('fast');
        });

    // When eneter from external link
    if(window.location.hash != "") {
        var hash = window.location.hash.substring(1);

        $('.'+hash).trigger('click');
    }

    //On change hash trigger correct title click
    window.onhashchange = function () {
        var hash = window.location.hash.substring(1);

        $('.'+hash).trigger('click');
    }


    // Display description

    $('.expand').click(function(e) {
        e.preventDefault();

        if($(this).text() == 'Expand'){
            $('.expand').text('Expand');
            $(this).text('Collapse');
            $('.person').removeClass('active');
            $(this).parent().addClass('active');
            $('.team-desc').hide();
            $(this).parents('.person').next().show();
        }else {
            $(this).parent().removeClass('active');
            $(this).text('Expand');
            $(this).parents('.person').next().hide();
        }
    });

    jQuery('.ex').click(function (e) {
        e.preventDefault();

        if(jQuery(this).text() == 'Expand'){
            jQuery('.ccd .ex').text('Expand');
            jQuery(this).text('Collapse');
            jQuery('.ccd div').removeClass('active');
            jQuery(this).parent().addClass('active');
            jQuery('.team_capt').hide();
            jQuery(this).parents('.ccd').next().show();
        }else{
            jQuery(this).parent().removeClass('active');
            jQuery(this).text('Expand');
            jQuery(this).parents('.ccd').next().hide();
        }
    });


});