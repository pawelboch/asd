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

	$.fn.pagebox_tabs = function() {

		var wrap     = $(this),
			router   = wrap.find('.pagebox-router'),
			tabs     = wrap.find('.pagebox-tab'),
			index;

		// hide not active slides
		router.find('a').wrapInner('<span/>').eq(0).addClass('current');
		tabs.hide();
		tabs.eq(0).show();
		
		// click action
		wrap.on('click', '.pagebox-router a', function(e) {

			e.preventDefault();

			var self = $(this);
			index = self.index();

			if (self.hasClass('current')) {
				return;
			}

			router.find('a').removeClass('current');
			self.addClass('current');

			tabs.removeClass('current').slideUp();
			tabs.eq(index).addClass('current').slideDown();
		});

	}

})( jQuery );