<?php
/**
 * Module class is an extension for Pagebox\Module
 * abstract class. It registeres new box into
 * Pagebox plugin
 *
 * Call to action module with slider
 */

namespace HorizonInvestments\Pagebox\Modules\Text;

use \Pagebox\Modules\Module as Abstract_Module;
use \WPGeeks_HTML;

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
			'slug'        => 'text',
			// Human readable title of box. It will be displayed in all
			// backend functionalities
			'title'       => __(  'Text', 'pagebox_blocks' ),
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
						'type'			=> 'editor',
						'group'			=> __( 'Main', 'pagebox'),
						'name'			=> 'text',
						'label'			=> __( 'Editor' ),
						'description'	=> __( 'Type your text')
				),
				array(
						'type'			=> 'switch',
						'group'			=> __( 'Main', 'pagebox' ),
						'name'			=> 'btn_switch',
						'option'		=> 'yes',
						'label'			=> __( 'Button switch' ),
						'description'	=> __( 'Off / On switch')
				),
				array(
						'type'			=> 'SinglePage',
						'group'			=> __( 'Main', 'pagebox'),
						'name'			=> 'button',
						'label'			=> __( 'Select page' ),
						'description'	=> __( 'Select page for button')
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Main', 'pagebox'),
						'name'			=> 'button_text',
						'label'			=> __( 'Button text' ),
						'description'	=> __( 'Button text')
				),
				array(
						'type'			=> 'switch',
						'group'			=> __( 'Style', 'pagebox' ),
						'name'			=> 'border_switch',
						'option'		=> 'yes',
						'label'			=> __( 'Border bottom' ),
						'description'	=> __( 'OFF / ON switch'),
						'sass'			=> true,
						'sass_filter'   => function( $value ) {
							return $value ? 'yes' : 'no';
						}
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Style', 'pagebox' ),
						'name'			=> 'border_weight',
						'label'			=> __( 'Border weight' ),
						'description'	=> __( 'Border weight in px'),
						'sass'			=> true
				),
				array(
						'type'			=> 'colorpicker',
						'group'			=> __( 'Style', 'pagebox' ),
						'name'			=> 'border_color',
						'label'			=> __( 'Border color' ),
						'description'	=> __( 'Select color for border'),
						'sass'			=> true
				),
			)
		);
	}
}