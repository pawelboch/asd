<?php
/**
 * Module class is an extension for Pagebox\Module
 * abstract class. It registeres new box into
 * Pagebox plugin
 *
 * Call to action module with slider
 */

namespace HorizonInvestments\Pagebox\Modules\Post_title;

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
			'slug'        => 'post_title',
			// Human readable title of box. It will be displayed in all
			// backend functionalities
			'title'       => __(  'Post Title', 'pagebox_blocks' ),
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
						'type'			=> 'hidden',
						'group'			=> __( 'Main', 'pagebox' ),
						'name'			=> 'bgc_image',
						'label'			=> __( 'Post title' ),
						'description'	=> __( 'Post title will be automatically get from post title'),
				),
				array(
						'type'			=> 'colorpicker',
						'group'			=> __( 'Main', 'pagebox' ),
						'name'			=> 'cat_color',
						'label'			=> __( 'Category color' ),
						'description'	=> __( 'Select background color ' ),
						'sass'			=> true,
				)
			)
		);
	}
}