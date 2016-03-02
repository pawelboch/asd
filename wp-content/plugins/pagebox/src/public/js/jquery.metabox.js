/**
 * JavaScript handles all actions of metabox
 *
 * @author   Max Matloka (max@matloka.me)
 * @since    1.0.0
 * 
 * @package  pagebox/src/public/js
 */

(function( $ ) {
	'use strict';

	// set default featherlight config
	var featherlightConfig = {
		type      : 'html',
		closeIcon : ''
	};

	$( document ).ready( function() {

		var pagebox = $('#pagebox');

		// remove metabox header
		pagebox.find('h3.hndle').remove();
		pagebox.find('.handlediv').remove();

		// enable tooltips
		$('.tooltip').frosty({
			position  : 'top',
			attribute : 'data-tooltip'
		});

		// init sortable
		pagebox.find('.modules').sortable({
			items       : '.module',
			connectWith : '#pagebox .modules',
			placeholder : 'module-placeholder'
		});

		// select template
		$(document).on('click', '.pagebox[data-action="template"]', function(e) {
			e.preventDefault();

			$('.tooltip').frosty('hide');

			// check if section was already chosen
			if (pagebox.find('#sections [name="pagebox_template"]').length != 0 && !confirm(Pagebox.i18n.sure)) {
				return;
			}

			jQuery(this).parent('ul').find('li').removeClass('current-template');
			jQuery(this).addClass('current-template');

			jQuery('#pagebox .metabox #sections').html('<div class="loader"></div>');

			jQuery('.pagebox-navigation [href="#sections"]')[0].click();

			// get listing of all modules using ajax
			jQuery.ajax({
				url  : ajaxurl,
				type : 'post',
				data : {
					action   : 'pagebox_template',
					template : jQuery(this).attr('data-template')
				},
				success: function (data) {
					jQuery('#pagebox .metabox #sections').html(data);

					// enable modules sorting
					jQuery('#pagebox .modules').sortable({
						items       : '.module',
						connectWith : '#pagebox .modules',
						placeholder : 'module-placeholder'
					});
				}
			});
		});

		// enable metabox tabs
		jQuery(document).on('click', '.pagebox[data-action="metabox-tabs"]', function(e) {
			e.preventDefault();

			// change tabs
			var tabs = jQuery(this).parents('.inside').find('.metabox');

			if (jQuery(this).attr('href') == '#sections' && 
				!(jQuery('#sections [name="pagebox_template"]').length != 0 || jQuery('#sections .loader').length != 0)) {
				return;
			}

			if (jQuery(tabs).find(jQuery(this).attr('href')).hasClass('current')) {
				return;
			}

			// style buttons
			jQuery(this).siblings('.current').removeClass('current');
			jQuery(this).addClass('current');

			// change visible content
			jQuery(tabs).find('.current').slideUp('slow', function(){
				jQuery(this).removeClass('current');
			});

			jQuery(tabs).find(jQuery(this).attr('href')).slideDown('slow', function(){
				jQuery(this).addClass('current');
			});
		});

		// update input name on sortable update
		jQuery(document).on('sortupdate', '#pagebox .modules', function(event, ui) {
			
			var section = jQuery(ui.item).parents('.section').attr('id');

			jQuery(ui.item).find('input[type="hidden"]').attr('name', 'pagebox_modules[' + section + '][]');

		});

		// add new module action
		jQuery(document).on('click', '.pagebox[data-action="add"]', function(e) {
			e.preventDefault();

			var parent = jQuery(this).parents('.section'),
				button = jQuery(this);

			if (button.attr('data-disabled') == '1') {
				return;
			}

			button.attr('data-disabled', '1');

			// get listing of all modules using ajax
			jQuery.ajax({
				url  : ajaxurl,
				type : 'post',
				data : {
					action : 'pagebox_listing',
					target : {
						id    : parent.attr('id'),
						width : parent.attr('data-width')
					}
				},
				success: function (data) {
					var options = {
						afterContent: function() {
							$('[data-action="filter"]' ).focus();
						}
					};
					$.extend( options, featherlightConfig );
					jQuery.featherlight(data, options);

					jQuery('#pagebox-modal-listing .pagebox-tabs').pagebox_tabs();
				},
				complete: function () {
					button.attr('data-disabled', '0');
				}
			});
		});

		// edit existing module
		jQuery(document).on('click', '.pagebox[data-action="edit"]', function(e) {

			e.preventDefault();

			var parent   = jQuery(this).parents('.section'),
			    module   = jQuery(this).parents('.module');

			// get new module form using ajax
			jQuery.ajax({
				url     : ajaxurl,
				type    : 'post',
				data    : {
					action   : 'pagebox_edit',
					id       : module.attr('id'),
					module   : module.attr('data-module'),
					data     : module.find('input[type="hidden"]').val(),
					target   : parent.attr('id'),
				},
				success : function (data) {
					
					// open new window with new module settings
					jQuery.featherlight(data, featherlightConfig);

					jQuery('#pagebox-modal-edit form').pagebox_form();
					jQuery('#pagebox-modal-edit .pagebox-tabs').pagebox_tabs();
					
				}
			});

		});

		// add predefined module action
		jQuery(document).on('click', '.pagebox[data-action="predefined"]', function(e) {

			// get new module with predefined settings form using ajax
			jQuery.ajax({
				url: ajaxurl,
				type: 'post',
				data: {
					action : 'pagebox_edit',
					module : jQuery(this).attr('data-module'),
					target : jQuery(this).attr('data-target'),
					data   : jQuery(this).find('input[type="hidden"]').val(),
				},
				success: function (data) {

					// open new window with new module settings
					if (jQuery.featherlight.current() != null) {
						jQuery.featherlight.close();
					}

					jQuery.featherlight(data, featherlightConfig);

					jQuery('#pagebox-modal-edit form').pagebox_form();
					jQuery('#pagebox-modal-edit .pagebox-tabs').pagebox_tabs();

				}
			});

		});
		
		// remove existing module
		jQuery(document).on('click', '.pagebox[data-action="remove"]', function(e) {
			e.preventDefault();

			jQuery(this).parents('.module').slideUp('slow', function() {
				jQuery(this).remove();
			});
		});

		// create new module instance
		jQuery(document).on('click', '.pagebox[data-action="new"]', function() {

			// get new module form using ajax
			jQuery.ajax({
				url: ajaxurl,
				type: 'post',
				data: {
					action : 'pagebox_edit',
					module : jQuery(this).attr('data-module'),
					target : jQuery(this).attr('data-target')
				},
				success: function (data) {
					// open new window with new module settings
					if (jQuery.featherlight.current() != null) {
						jQuery.featherlight.close();
					}

					jQuery.featherlight(data, featherlightConfig);

					jQuery('#pagebox-modal-edit form').pagebox_form();
					jQuery('#pagebox-modal-edit .pagebox-tabs').pagebox_tabs();

				}
			});

		});

		// save settings of edited module
		jQuery(document).on('click', '.pagebox[data-action="save"]', function(e) {

			e.preventDefault();

			// serialize form
			var form     = jQuery(this).parents('form'),
			    settings = form.serializeJSON(),
			    edit     = false,
			    primary,
			    id;

			// generate new id if it does not exist
			if (typeof form.attr('data-id') === 'undefined') {
				id = Math.random().toString(36).substr(2, 8);
			} else {
				edit = true;
				id   = form.attr('data-id');
			}

			// if primary key exists
			if (jQuery(form).find('input.primary').length > 0) {
				primary = jQuery(form).find('input.primary:last').val();
			}

			// return output object to metabox
			var output   = {
					id		 : id,
					slug     : form.attr('data-slug'),
					title    : form.attr('data-title'),
					target   : form.attr('data-target'),
					data     : JSON.stringify({
						id       : id,
						slug     : form.attr('data-slug'),
						primary  : primary,
						settings : settings
					}),
					primary  : primary
				};

			jQuery(this).attr('disabled', 'disabled').addClass('loading');

			// get mustache module path
			$.get(Pagebox.path.module, function(template) {
				var rendered = Mustache.render(template, output);
				
				// replace existing box
				if (edit) {
					jQuery('#' + id).replaceWith(rendered);
				// add new one
				} else {
					jQuery('#pagebox .sections')
						.find('#' + form.attr('data-target'))
						.find('.modules')
						.append(rendered);
				}

				jQuery.featherlight.close();
				jQuery('#pagebox .modules').sortable('refresh');
			});
		});

		// filter modules
		jQuery(document).on('keyup', '.pagebox[data-action="filter"]', function() {
			
			// get parent window (it might be default one and with predefined settings)
			var parent = jQuery(this).parent().next();

			if ( typeof window.clone === 'undefined' ) {
				window.clone = jQuery(parent).clone();
			}
			
			jQuery(parent).html('');
			jQuery(parent).append(window.clone.html());

			// and display matching modules
			if (jQuery(this).val() != '') {
				jQuery(parent).find('.module').not('[data-title*="' + jQuery(this).val() + '"]').remove();
			}

		});

		// media buttons fix
		
		var activeTinyEditor = '';

		jQuery(document).on('click', '.insert-media', function(e) {

			var id = jQuery( this ).parents( '.wp-editor-wrap' ).children( '.wp-editor-container' ).children( 'textarea' ).attr( 'id' );

			var editor = tinyMCE.get( id );

			editor.focus();

			tinyMCE.activeEditor.windowManager.bookmark = tinyMCE.activeEditor.selection.getBookmark('simple');

		});

	});

})( jQuery );