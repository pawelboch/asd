<?php
/**
 * Module class is an extension for Pagebox\Module
 * abstract class. It registeres new box into
 * Pagebox plugin
 *
 * Call to action module with slider
 */

namespace HorizonInvestments\Pagebox\Modules\Slider;

use \Pagebox\Modules\Module as Abstract_Module;

class Module extends Abstract_Module {

	/**
	 * Module constructor
	 * @access public
	 */
	public function __construct() {

		parent::__construct();

	}
	/**
	 * Template config
	 * @return void
	 */
	public function set_config() {

		$this->config = array(
			// Name of the box for plugin use. Only alphanumeric charactes 
			// and underscores are allowed
			'slug'        => 'slider',
			// Human readable title of box. It will be displayed in all
			// backend functionalities
			'title'       => __(  'Slider', 'pagebox_blocks' ),
			// Short description about what box outputs. It will be displayed
			// below the title in new box modal window.
			'description' => __(  '', 'pagebox_blocks' ),
			// Elements with higher priority will be displayed earlier in
			// new box modal window
			'priority'    => 95,
			// Custom path for image file. Default image (module.jpg) should be
			// located in the main folder of current box
			'image'       => '',
			'limit'       => array(
				'width'    => array( 0, 100 )
			),
			// minimum and maximum percent width that module fits in
			// WPGeeks_Forms
			'fields'      => array(
				array(
					'type'		=> 'repeater',
					'group'		=> __('Slider options', 'pagebox'),
					'name'		=> 'slider',
					'labels'  => array(
						'singular' => __('Slide'),
						'plural'   => __('Slides'),
					),
					'buttons' => array(
						'add'		=> __('Add another slide', 'pagebox'),
						'remove' => __('Remove this slide', 'pagebox'),
					),
					'fields'	=> array(
						array(
							'type'			=> 'text',
							'group'			=> __( 'Slides', 'pagebox' ),
							'name'			=> 'title',
							'label'			=> __( 'Title' ),
							'description'	=> __( 'Top title' )
						),
						array(
							'type'			=> 'text',
							'group'			=> __( 'Slides', 'pagebox' ),
							'name'			=> 'title_highlight',
							'label'			=> __( 'Title' ),
							'description'	=> __( 'Highlighted word' )
						),
						array(
							'type'			=> 'colorpicker',
							'group'			=> __( 'Style', 'pagebox' ),
							'name'			=> 'h2_bgc',
							'label'			=> __( 'Title background color' ),
							'description' 	=> __( 'Leave blank for default color' ),
							'sass'          => true
						),
						array(
							'type'			=> 'text',
							'group'			=> __( 'Style', 'pagebox' ),
							'name'			=> 'h2_opacity',
							'label'			=> __( 'Title background opacity' ),
							'description' 	=> __( '0-100 (color must be selected if you want opacity)' ),
							'sass'          => true
						),
						array(
							'type'			=> 'colorpicker',
							'group'			=> __( 'Style', 'pagebox' ),
							'name'			=> 'h2_color',
							'label'			=> __( 'Title color' ),
							'description' 	=> __( 'Leave blank for default color' ),
							'sass'          => true
						),
						array(
							'type'			=> 'text',
							'group'			=> __( 'Slides', 'pagebox' ),
							'name'			=> 'description',
							'label'			=> __( 'Description' ),
							'description' 	=> __( 'Description under title' )
						),
						array(
							'type'			=> 'switch',
							'group'			=> __( 'Slides', 'pagebox' ),
							'name'			=> 'btn_switch',
							'option'		=> 'yes',
							'label'			=> __( 'Button' ),
							'description' 	=> __( 'OFF / ON button' ),
							'sass'			=> true,
							'sass_filter'   => function( $value ) {
								return $value ? 'yes' : 'no';
							}
						),
						array(
							'type'			=> 'SinglePage',
							'group'			=> __( 'Slides', 'pagebox' ),
							'name'			=> 'btn',
							'label'			=> __( 'Page' ),
							'description' 	=> __( 'Select page for button' )
						),
						array(
							'type'			=> 'text',
							'group'			=> __( 'Slides', 'pagebox' ),
							'name'			=> 'btn_text',
							'value'			=> 'button',
							'label'			=> __( 'Button text' ),
							'description' 	=> __( 'Button text' )
						),
						array(
							'type'			=> 'colorpicker',
							'group'			=> __( 'Style', 'pagebox' ),
							'name'			=> 'btn_color',
							'label'			=> __( 'Button color' ),
							'description' 	=> __( '0-100 (color must be selected if you want opacity)' ),
							'sass'          => true
						),
						array(
							'type'			=> 'text',
							'group'			=> __( 'Style', 'pagebox' ),
							'name'			=> 'btn_opacity',
							'label'			=> __( 'Button opacity' ),
							'description' 	=> __( '0-100 (color must be selected if you want opacity)' ),
							'sass'          => true
						),
						array(
							'type'			=> 'image',
							'group'			=> __( 'Slides', 'pagebox' ),
							'name'			=> 'image',
							'label'			=> __( 'Image' ),
							'description' 	=> __( 'Select image from media or upload new' ),
							'sass'          => true,
							'sass_filter'   => function( $value ) {
								return wp_make_link_relative( wp_get_attachment_url( $value ));
							}
						),
					)
				),
			)
		);
	}
}