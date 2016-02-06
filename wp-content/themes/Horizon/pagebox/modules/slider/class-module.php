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
						'type'			=> 'text',
						'group'			=> __( 'main', 'pagebox' ),
						'name'			=> 'title',
						'option'	  	=> 'yes',
						'label'			=> __( 'Title' ),
						'description'	=> __( 'description' )
				),
				array(
					'type'			=> 'text',
					'group'			=> __( 'main', 'pagebox' ),
					'name'			=> 'title_highlight',
					'option'	  	=> 'yes',
					'label'			=> __( 'Title highlighted word' ),
					'description'	=> __( 'description' )
				),
				array(
					'type'			=> 'text',
					'group'			=> __( 'main', 'pagebox' ),
					'name'			=> 'description',
					'option'		=> 'no',
					'label'			=> __( 'Description' ),
					'description' 	=> __( 'description' )
				),
				array(
					'type'			=> 'SinglePage',
					'group'			=> __( 'main', 'pagebox' ),
					'name'			=> 'button',
					'option'		=> 'no',
					'label'			=> __( 'btn' ),
					'description' 	=> __( 'btn' )
				)
			)
		);
	}
}