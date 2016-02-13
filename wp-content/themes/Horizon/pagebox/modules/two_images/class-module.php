<?php
/**
 * Module class is an extension for Pagebox\Module
 * abstract class. It registeres new box into
 * Pagebox plugin
 *
 * Call to action module with slider
 */

namespace HorizonInvestments\Pagebox\Modules\two_images;

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
			'slug'        => 'two_images',
			// Human readable title of box. It will be displayed in all
			// backend functionalities
			'title'       => __(  'One / Two images', 'pagebox_blocks' ),
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
						'group'			=> __( 'General', 'pagebox'),
						'name'			=> 'switch',
						'label'			=> __( 'Switch' ),
						'description'	=> __( 'Switch between one or two images')
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Left part', 'pagebox'),
						'name'			=> 'title_left',
						'label'			=> __( 'Left title' ),
						'description'	=> __( 'Left title')
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Left part', 'pagebox'),
						'name'			=> 'description_left',
						'label'			=> __( 'Left description' ),
						'description'	=> __( 'Left description')
				),
				array(
						'type'			=> 'image',
						'group'			=> __( 'Left part', 'pagebox'),
						'name'			=> 'background',
						'label'			=> __( 'Left description' ),
						'description'	=> __( 'Left description')
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Left part', 'pagebox'),
						'name'			=> 'border_left',
						'label'			=> __( 'Border' ),
						'description'	=> __( 'Border uder image')
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Right part', 'pagebox'),
						'name'			=> 'title_right',
						'label'			=> __( 'Left title' ),
						'description'	=> __( 'Left title')
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Right part', 'pagebox'),
						'name'			=> 'description_right',
						'label'			=> __( 'Left description' ),
						'description'	=> __( 'Left description')
				),
			)
		);
	}
}