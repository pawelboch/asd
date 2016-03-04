/**
 * JavaScript handles all form actions
 *
 * @author   Max Matloka (max@matloka.me)
 * @since    1.0.0
 *
 * @package  pagebox/src/public/js
 */

(function( $ ) {
	'use strict';

	var editor;

	jQuery.fn.pagebox_post = function() {

		return this.each(function() {

			// prevent multiple instances on one element
			if (jQuery.data(this, 'pagebox_post')) {
				return;
			}

			jQuery.data(this, 'pagebox_post', true);
			// start fn logic
			// set basic variables
			var post = jQuery(this),
				timer;

			// set form inputs
			var type     = jQuery('[data-setting="type"]', post),
				post_id  = jQuery('[data-setting="post"]', post),
				page_id  = jQuery('[data-setting="page"]', post),
				category = jQuery('[data-setting="category"]', post),
				tag      = jQuery('[data-setting="tag"]', post),
				order    = jQuery('[data-setting="order"]', post),
				orderby  = jQuery('[data-setting="orderby"]', post),
				offset   = jQuery('[data-setting="offset"]', post);

			// add chosen support
			post_id.chosen({
				allow_single_deselect : true,
				width : '100%'
			});

			category.chosen({
				width : '100%'
			});

			tag.chosen({
				width : '100%'
			});

			var typeSelect = function() {

			    	// display only elements connected to selected post type

					jQuery(post).find('tr').not('.subelement-type').hide();

					if (type.val() == 'post') {
						jQuery(post).find('[data-type="post"]').show();
					} else if (type.val() == 'page') {
						jQuery(post).find('[data-type="page"]').show();
					}

				},
				postTitle = function() {

					// display additional post settings
					// 
					jQuery(post).find('[data-type="post"]').not('.subelement-post').hide();

					if (post_id.val() == '') {
						jQuery(post).find('[data-type="post"]').not('.subelement-post').show();
					}

				},
				throttle = function(f) {

					// delay ajax request to 2000ms

			        clearTimeout(timer);
			        timer = window.setTimeout(function() {
			            f.apply();
			        }, 2000);

				},
				countResults = function() {

					throttle(function(){
						var data = {
							action   : 'count_posts',

							type     : type.val(),
							post 	 : post_id.val(),
							page     : page_id.val(),
							category : category.val(),
							tag      : tag.val(),
							order    : order.val(),
							orderby  : orderby.val(),
							offset   : offset.val(),
						};

						jQuery.ajax({
							url  : ajaxurl,
							type : 'post',
							data : data,
							success: function (response) {
								jQuery('.found', post).html(response);
							}
						});
					});

				};

			jQuery(post).on('change', '.subelement-post', function(){
				postTitle();
			});

			jQuery(post).on('change', '.subelement-type', function(){
				typeSelect();
			});

			jQuery(post).on('change', '[data-type="post"]', function(){
				// count number of posts
				countResults();

			});

			// perform some actions on init
			typeSelect();
			postTitle();
			countResults();

		});
	}

	jQuery.fn.pagebox_colorpicker = function() {

		return this.each(function() {

			// prevent multiple instances on one element
			if (jQuery.data(this, 'pagebox_colorpicker')) {
				return;
			}

			jQuery.data(this, 'pagebox_colorpicker', true);

			// start fn logic
			var colorpicker = jQuery(this).find('input');

			jQuery(colorpicker).wpColorPicker();
		});

	}

	jQuery.fn.pagebox_repeater = function() {

		return this.each( function() {

			// prevent multiple instances on one element
			if( $.data( this, 'pagebox_repeater' )) {
				return;
			}

			$.data( this, 'pagebox_repeater', true );

			// start fn logic
			var repeater    = $( this ),
				iterator 	= repeater.find( '.iterator' ),
				updateIndex = function() {

					hideRemove();

					// update groups indexes to display them in right order in the future
					var re     = /([a-zA-Z0-9-_]+)\[(\d{0,3})\]\[([a-zA-Z0-9-_]+)\]/gm;
					iterator.children('table').each( function( i ) {
						var substr = '$1[' + i + '][$3]';

					    $( this ).find('.subelement').each( function() {
							var self = $( this );
					    	var name = self.attr( 'name' ).replace( re, substr );
					    	self.attr( 'name', name );
					    });

					});

				},
				hideRemove  = function() {
					// hide remove button if there is only one item
					if( iterator.children('table').length === 1) {
						iterator.find('[data-action="repeater_remove"]').hide();
					} else {
						iterator.find('[data-action="repeater_remove"]').show();
					}
				};

			// make items sortable
			iterator.sortable({
				items : '> table',
				handle: 'tr.header',
				axis: "y",
				update : function(event, ui) {
					updateIndex();
					repeater.parents('form').pagebox_form();
				},
				start: function(event, ui) {
			        ui.placeholder.height( ui.item.height() );
			    }
			});

			hideRemove();

			// enable add button
			repeater.on('click', '[data-action="repeater_add"]', function( e ) {

				e.preventDefault();

				var self = $( this ),
					boilerplate = self.parents('.element-repeater').find('[data-action="repeater_boilerplate"]'),
				    group       = $.parseJSON( $( boilerplate ).val() ),
					count       = iterator.children('table').length;


				var re     = /([a-zA-Z0-9-_]+)\[(\d{0,3})\]\[([a-zA-Z0-9-_]+)\]/gm,
				    substr = '$1[' + count + '][$3]';

				group = group.replace( re, substr );

				self.parents().eq(3).after('<table>' + group + '</table>');

				updateIndex();

				$('.my-color-field').wpColorPicker();

				iterator.sortable('refresh');

				repeater.parents('form').pagebox_form();

			});

			// enable remove button
			repeater.on('click', '[data-action="repeater_remove"]', function( e ) {

				e.preventDefault();

				$(this).parents().eq(3).wrap('<div style="display: block;" />').parent().slideUp('slow', function() {
					$(this).remove();

					updateIndex();
				});

			});

		});

	}
	jQuery.fn.pagebox_file = function() {
		//console.log('0.1');
		return this.each(function() {
			//console.log('1');
			// prevent multiple instances on one element
			if (jQuery.data(this, 'pagebox_file')) {
				return;
			}

			jQuery.data(this, 'pagebox_file', true);

			// start fn logic
			var fileFrame;

			// Handle image input
			jQuery(this).on('click', '.pagebox[data-action="file_upload"]', function(e){

				e.preventDefault();

				var button  = jQuery(this),
					preview = jQuery(this).prev(),
					input   = jQuery(this).next();

				if (fileFrame) {
					fileFrame.open();
					return;
				}

				// Create the media frame.
				fileFrame = wp.media.frames.fileFrame = wp.media({
					multiple: false

				});

				fileFrame.on( 'select', function() {

					var attachment = fileFrame.state().get('selection').first().toJSON();
					jQuery(input).val(attachment.id);
					jQuery(preview).html('<a href="' + attachment.url + '" alt="" target="_blank">'+attachment.title+'</a>');
					//button .removeClass('file_upload');
					button.attr('data-action','remove_file');
					button.text('Remove File');
				});

				// Open the modal
				fileFrame.open();

			});
			jQuery(this).on('click', '.pagebox[data-action="remove_file"]', function(e){
				var button = jQuery(this);
				var preview = jQuery(this).prev();
				var input   = jQuery(this).next();

				button.text('Upload File');
				button.attr('data-action','file_upload');
				preview.html('');
				input.attr('value','');

			});

		});

	}

	jQuery.fn.pagebox_image = function() {

		return this.each(function() {

			// prevent multiple instances on one element
			if (jQuery.data(this, 'pagebox_image')) {
				return;
			}

			jQuery.data(this, 'pagebox_image', true);

			// start fn logic
			var fileFrame;

			// Handle image input
			jQuery(this).on('click', '.pagebox[data-action="image_upload"]', function(e){

				e.preventDefault();

				var button  = jQuery(this),
					preview = jQuery(this).prev(),
				    input   = jQuery(this).next();

				if (fileFrame) {
					fileFrame.open();
					return;
				}

				// Create the media frame.
				fileFrame = wp.media.frames.fileFrame = wp.media({
					multiple: false
				});

				fileFrame.on( 'select', function() {

					var attachment = fileFrame.state().get('selection').first().toJSON();
					jQuery(input).val(attachment.id);
					jQuery(preview).html('<img src="' + attachment.sizes.thumbnail.url + '" alt="" />');
					button.attr('data-action','remove_image');
					button.text('Remove Image');

				});

				// Open the modal
				fileFrame.open();

			});
			jQuery(this).on('click', '.pagebox[data-action="remove_image"]', function(e){
				var button = jQuery(this);
				var preview = jQuery(this).prev();
				var input   = jQuery(this).next();

				button.text('Select Image');
				button.attr('data-action','image_upload');
				preview.html('<img src="http://placehold.it/150x150" alt="">');

				input.attr('value','');

			});		});

	}

	jQuery.fn.pagebox_editor = function() {

		return this.each(function() {

			var id = jQuery(this).find('textarea').attr('id');

			tinyMCE.execCommand('mceRepaint', false, id);

			// prevent multiple instances on one element
			if (jQuery.data(this, 'pagebox_editor')) {
				return;
			}

			jQuery.data(this, 'pagebox_editor', true);

			// set random id to new editors
			if (jQuery('.element-editor').length > 1) {
				id = 'element-editor_' + Math.floor(Math.random() * 10000);
				jQuery(this).find('textarea').attr('id', id);
			}

			// init tinymce
			tinyMCE.execCommand('mceAddEditor', false, id);

			var editor = tinyMCE.get(id);

			// keep textarea updated
			editor.on('change', function(e) {
            	jQuery('#' + id).val(editor.getContent());
        	});

			// and remove tinymce instance on lightbox close
			jQuery.featherlight.current().beforeClose = function() {
				tinyMCE.execCommand('mceRemoveEditor', false, id);
			}

			// enable visual/text menu
			var container = jQuery(this).find('.wp-editor-container');
			jQuery(this).find('.editor-tabs').detach().prependTo(container).show();

			// textarea to tinymce tabs change
			jQuery(this).on('click', '.editor-tabs a:first-child', function(e) {

				e.preventDefault();
				editor.show();

				jQuery(this).parent().find('a').removeClass('current');
				jQuery(this).addClass('current');

				jQuery('.mce-tinymce').show();
				jQuery('.pagebox-editor.wp-editor-area').hide();
				tinyMCE.execCommand('mceRepaint', false, id);

			});

			// tinymce to textarea tabs change
			jQuery(this).on('click', '.editor-tabs a:last-child', function(e) {

				e.preventDefault();
				editor.hide();
				jQuery(this).parent().find('a').removeClass('current');
				jQuery(this).addClass('current');

				jQuery('.pagebox-editor.wp-editor-area').show();
				jQuery('.mce-tinymce').hide();

			});

			// start fn logic
			var fileFrame;

			// Handle image input
			jQuery(this).on('click', '.add-image', function(e){

				e.preventDefault();

				var button = jQuery(this);

				if (fileFrame) {
					fileFrame.open();
					return;
				}

				var customFrame = wp.media.view.MediaFrame.Select.extend({
					createStates: function() {
						var options = this.options;

						this.states.add([
							new wp.media.controller.Library({
                                library             : wp.media.query( options.library ),
                                multiple            : false,
                                priority            : 20,
                                allowLocalEdits     : true,
                                displaySettings     : true,
                                displayUserSettings : true
                            })
						]);
					}
				});

				// Create the media frame.
				fileFrame = wp.media.frames.fileFrame = new customFrame();

				fileFrame.on( 'select', function() {

					var attachment = fileFrame.state().get('selection').first().toJSON(),
						size = attachment['sizes'][getUserSetting('imgsize')],
					    output = '<img class="align' + getUserSetting('align') + ' size-' + getUserSetting('imgsize') + ' wp-image-' + attachment.id + '" src="' + attachment.url + '" alt="' + attachment.title + '" width="' + attachment.width + '" height="' + attachment.height + '" />';

					editor.execCommand('mceInsertContent', false, output);

				});

				// Open the modal
				fileFrame.open();

			});

		});

	}

	jQuery.fn.pagebox_codemirror = function() {

		return this.each(function() {

			// prevent multiple instances on one element
			if (jQuery.data(this, 'pagebox_codemirror')) {
				return;
			}

			jQuery.data(this, 'pagebox_codemirror', true);

			var element = jQuery(this).find('textarea.codemirror');

			var mode = jQuery(element).data('mode');

			if ( ! mode ) {
				mode = 'text/html';
			}

			var editor = CodeMirror.fromTextArea(element[0], {
				lineWrapping: true,
				lineNumbers: true,
				indentUnit: 4,
				mode: mode
			});

			editor.on('change', function(){
				editor.save();
			});

		});

	}

	jQuery.fn.pagebox_chosen = function() {

		return this.each(function() {

			jQuery(this).find('select').each(function(index, element) {

				if ( jQuery(element).hasClass('make-chosen') ) {

					jQuery(element).chosen({
						allow_single_deselect: true,
						width: '100%',
					});

				}

			});

		});

	}

	jQuery.fn.pagebox_form = function() {

		jQuery('.element-repeater', this).pagebox_repeater();
		jQuery('.element-post', this).pagebox_post();
		jQuery('.element-image', this).pagebox_image();
		jQuery('.element-file', this).pagebox_file();
		jQuery('.element-colorpicker', this).pagebox_colorpicker();
		jQuery('.element-editor', this).pagebox_editor();
		jQuery('.element-codemirror', this).pagebox_codemirror();
		jQuery('.row', this).pagebox_chosen();

	}

})( jQuery );