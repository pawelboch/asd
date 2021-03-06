<?php
/**
 * Module class is an extension for Pagebox\Module
 * abstract class. It registeres new box into
 * Pagebox plugin
 *
 * Call to action module with slider
 */

namespace HorizonInvestments\Pagebox\Modules\Post_image;

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
			'slug'        => 'post_image',
			// Human readable title of box. It will be displayed in all
			// backend functionalities
			'title'       => __(  'Post Image', 'pagebox_blocks' ),
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
						'group'			=> __( 'Post image', 'pagebox'),
						'name'			=> 'image',
						'label'			=> __( 'Post info module' ),
						'description'	=> __( 'Remove this module to disable' )
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Post image', 'pagebox'),
						'name'			=> 'alt',
						'label'			=> __( 'Post image alt' ),
						'description'	=> __( 'Set post image alt' )
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Post image', 'pagebox'),
						'name'			=> 'height',
						'label'			=> __( 'Post image height' ),
						'description'	=> __( 'Set image height' ),
						'sass'          => true,
						'sass_filter'   => function( $value ) {
							return  ( $value ) ;
						}
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Post image', 'pagebox'),
						'name'			=> 'width',
						'label'			=> __( 'Post image width' ),
						'value'			=> '100%',
						'description'	=> __( 'Set image width' )
				)
			)
		);
	}
}