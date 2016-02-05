/**
 * JavaScript handles all actions of predefined
 * modules subpage
 *
 * @author   Max Matloka (max@matloka.me)
 * @since    1.0.0
 * 
 * @package  pagebox/src/public/js
 */

(function( $ ) {
	'use strict';

	jQuery(document).ready(function(){

		// remove default metabox behaviour
		jQuery('#pagebox_predefined_listing h3.hndle').remove();
		jQuery('#pagebox_predefined_listing .handlediv').remove();

		jQuery('#pagebox-modules').unwrap().unwrap().unwrap();
		jQuery('#pagebox_predefined_settings h3.hndle').removeClass('hndle');
		jQuery('#pagebox_predefined_settings .handlediv').remove();

		jQuery('#pagebox_predefined_settings .pagebox-form').pagebox_form();

		// handle select module action
		jQuery(document).on('click', '.pagebox[data-action="select"]', function(e){

			e.preventDefault();

			if (jQuery('#pagebox_predefined_settings [name="pagebox_module"]').length != '0' &&
				!confirm(Pagebox.i18n.sure)) {
				return;
			}

			var module = jQuery(this).attr('data-module');

			jQuery.ajax({
				url  : ajaxurl,
				type : 'post',
				data : {
					action : 'pagebox_select',
					module : module
				},
				success: function (response) {
					jQuery('#pagebox_predefined_settings .inside').html('').append(response);

					jQuery('#pagebox_predefined_settings .pagebox-form').pagebox_form();

					jQuery('#pagebox_predefined_settings [name="pagebox_module"]').val(module);
				}
			});
		});
	});
	
})( jQuery );