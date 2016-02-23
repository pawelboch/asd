<?php
/**
 * Module class is an extension for Pagebox\Module
 * abstract class. It registeres new box into
 * Pagebox plugin
 *
 * Call to action module with slider
 */

namespace HorizonInvestments\Pagebox\Modules\title_three_sections;

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
			'slug'        => 'title_three_sections',
			// Human readable title of box. It will be displayed in all
			// backend functionalities
			'title'       => __(  'Title | Three Sections', 'pagebox_blocks' ),
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
						'type'			=> 'switch',
						'group'			=> __( 'Two / Three columns', 'pagebox'),
						'name'			=> 'switch',
						'option'		=> 'yes',
						'label'			=> __( 'Switch' ),
						'description'	=> __( 'Two / Three columns')
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Title', 'pagebox'),
						'name'			=> 'title',
						'label'			=> __( 'Title' ),
						'description'	=> __( 'Title at the top center')
				),
				array(
						'type'			=> 'image',
						'group'			=> __( 'First part', 'pagebox'),
						'name'			=> 'first_image',
						'label'			=> __( 'Image' ),
						'description'	=> __( 'Select first image from media or upload new')
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'First part', 'pagebox'),
						'name'			=> 'first_title',
						'label'			=> __( 'Title' ),
						'description'	=> __( 'Title under first image')
				),
				array(
						'type'			=> 'colorpicker',
						'group'			=> __( 'First part', 'pagebox'),
						'name'			=> 'first_title_color',
						'label'			=> __( 'Title color' ),
						'description'	=> __( 'Title color under first image'),
						'sass'			=> true,
				),
				array(
						'type'			=> 'editor',
						'group'			=> __( 'First part', 'pagebox'),
						'name'			=> 'first_description',
						'label'			=> __( 'Description' ),
						'description'	=> __( 'Description under first image')
				),
				array(
						'type'			=> 'image',
						'group'			=> __( 'Second part', 'pagebox'),
						'name'			=> 'second_image',
						'label'			=> __( 'Image' ),
						'description'	=> __( 'Select second image from media or upload new')
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Second part', 'pagebox'),
						'name'			=> 'second_title',
						'label'			=> __( 'Title' ),
						'description'	=> __( 'Title under second image')
				),
				array(
						'type'			=> 'colorpicker',
						'group'			=> __( 'Second part', 'pagebox'),
						'name'			=> 'second_title_color',
						'label'			=> __( 'Title color' ),
						'description'	=> __( 'Title color under second image'),
						'sass'			=> true,
				),
				array(
						'type'			=> 'editor',
						'group'			=> __( 'Second part', 'pagebox'),
						'name'			=> 'second_description',
						'label'			=> __( 'Title' ),
						'description'	=> __( 'Description under second image')
				),
				array(
						'type'			=> 'image',
						'group'			=> __( 'Third part', 'pagebox'),
						'name'			=> 'third_image',
						'label'			=> __( 'Image' ),
						'description'	=> __( 'Select third image from media or upload new')
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Third part', 'pagebox'),
						'name'			=> 'third_title',
						'label'			=> __( 'Title' ),
						'description'	=> __( 'Title under third image')
				),
				array(
						'type'			=> 'colorpicker',
						'group'			=> __( 'Third part', 'pagebox'),
						'name'			=> 'third_title_color',
						'label'			=> __( 'Title color' ),
						'description'	=> __( 'Title color under third image'),
						'sass'			=> true,
				),
				array(
						'type'			=> 'editor',
						'group'			=> __( 'Third part', 'pagebox'),
						'name'			=> 'third_description',
						'label'			=> __( 'Title' ),
						'description'	=> __( 'Description under third image')
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Style', 'pagebox'),
						'name'			=> 'border',
						'value'			=> '1px',
						'label'			=> __( 'Border size' ),
						'description'	=> __( 'Border style (default: 1px solid #c2c2c2)'),
						'sass'			=> true,
				),
				array(
					'type'			=> 'colorpicker',
					'group'			=> __( 'Style', 'pagebox' ),
					'name'			=> 'border_color',
					'value'			=> '#c2c2c2',
					'label'			=> __( 'Border color' ),
					'description' 	=> __( '0-100 (color must be selected if you want opacity)' ),
					'sass'          => true,
				),
			)
		);
	}
}