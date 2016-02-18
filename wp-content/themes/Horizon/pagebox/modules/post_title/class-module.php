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
						'type'			=> 'image',
						'group'			=> __( 'Main', 'pagebox'),
						'name'			=> 'bgc_image',
						'label'			=> __( 'Background image' ),
						'description'	=> __( 'Select background image'),

						'sass'          => true,
						'sass_filter'   => function( $value ) {
						return wp_get_attachment_url( $value );
						}
				),
				array(
						'type'			=> 'switch',
						'group'			=> __( 'Switches', 'pagebox'),
						'name'			=> 'category',
						'option'		=> 'yes',
						'label'			=> __( 'Category' ),
						'description'	=> __( 'Disable / enable category')
				),
				array(
						'type'			=> 'switch',
						'group'			=> __( 'Switches', 'pagebox'),
						'name'			=> 'title',
						'option'		=> 'yes',
						'label'			=> __( 'Title' ),
						'description'	=> __( 'Disable / enable title')
				)
			)
		);
	}
}