/**
 * Tabs support
 *
 * @author   Max Matloka (max@matloka.me)
 * @since    1.0.0
 * 
 * @package  pagebox/src/public/js
 */

(function( $ ) {
	'use strict';

	jQuery.fn.pagebox_tabs = function() {

		var wrap     = jQuery(this),
			router   = jQuery(this).find('.pagebox-router'),
			tabs     = jQuery(this).find('.pagebox-tab'),
			index;

		// hide not active slides
		jQuery(router).find('a').wrapInner('<span/>');
		jQuery(router).find('a:eq(0)').addClass('current');
		jQuery(tabs).hide();
		jQuery(tabs).eq(0).show();
		
		// click action
		jQuery(wrap).on('click', '.pagebox-router a', function(e){

			e.preventDefault();

			index = jQuery(this).index();

			if (jQuery(this).hasClass('current')) {
				return;
			}

			jQuery(router).find('a').removeClass('current');
			jQuery(this).addClass('current');

			jQuery(tabs).removeClass('current').slideUp();
			jQuery(tabs).eq(index).addClass('current').slideDown();
		});

	}

})( jQuery );