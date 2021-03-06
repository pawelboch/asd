<?php
/**
 * Module class is an extension for Pagebox\Module
 * abstract class. It registeres new box into
 * Pagebox plugin
 *
 * Call to action module with slider
 */

namespace HorizonInvestments\Pagebox\Modules\Whitepaper;

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
			'slug'        => 'whitepaper',
			// Human readable title of box. It will be displayed in all
			// backend functionalities
			'title'       => __(  'Whitepaper', 'pagebox_blocks' ),
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
						'group'			=> __( 'Main', 'pagebox'),
						'name'			=> 'title1',
						'value'			=> 'Title',
						'label'			=> __( 'Title' ),
						'description'	=> __( 'Title'),
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Main', 'pagebox'),
						'name'			=> 'title2',
						'value'			=> 'Title',
						'label'			=> __( 'Title' ),
						'description'	=> __( 'Title'),
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Main', 'pagebox'),
						'name'			=> 'title3',
						'value'			=> 'Title',
						'label'			=> __( 'Title' ),
						'description'	=> __( 'Title'),
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Main', 'pagebox'),
						'name'			=> 'download_btn',
						'value'			=> 'download',
						'label'			=> __( 'Download button' ),
						'description'	=> __( 'Title'),
				),
				array(
						'type'			=> 'colorpicker',
						'group'			=> __( 'Style', 'pagebox'),
						'name'			=> 'pagebox_bgc_color',
						'value'			=> '#e8e8e8',
						'label'			=> __( 'Background color' ),
						'description'	=> __( 'Title'),
						'sass'			=> true,
				),
				array(
						'type'			=> 'colorpicker',
						'group'			=> __( 'Style', 'pagebox'),
						'name'			=> 'bgc_color',
						'value'			=> '#2c3842',
						'label'			=> __( 'Background color' ),
						'description'	=> __( 'Title'),
						'sass'			=> true,
				),
			)
		);
	}
}