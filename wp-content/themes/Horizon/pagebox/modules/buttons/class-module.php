<?php
/**
 * Module class is an extension for Pagebox\Module
 * abstract class. It registeres new box into
 * Pagebox plugin
 *
 * Call to action module with slider
 */

namespace HorizonInvestments\Pagebox\Modules\Buttons;

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
			'slug'        => 'buttons',
			// Human readable title of box. It will be displayed in all
			// backend functionalities
			'title'       => __(  'Buttons', 'pagebox_blocks' ),
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
						'group'			=> __( 'Left button', 'pagebox'),
						'name'			=> 'switch1',
						'option'	  	=> 'yes',
						'label'			=> __( 'Left button switch' ),
						'description'	=> __( 'hide / show button')
				),
				array(
						'type'		  	=> 'SinglePage',
						'group'			=> __( 'Left button', 'pagebox' ),
						'name'			=> 'select1',
						'label'			=> __( 'Select page'),
						'description'	=> __( 'Select page to be displayed')
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Left button', 'pagebox' ),
						'name'			=> 'external1',
						'label'			=> __( 'Button name' ),
						'description'	=> __( 'Button name' )
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Left button', 'pagebox' ),
						'name'			=> 'name1',
						'label'			=> __( 'URL name' ),
						'description'	=> __( 'URL button name (leave empty if you want to display page)' )
				),
				array(
						'type'			=> 'image',
						'group' 		=> __( 'Left button', 'pagebox'),
						'name'			=> 'mediaURL1',
						'label'			=> __( 'Media file URL'),
						'description'	=> __( 'Media file URL')
				),
				array(
						'type'			=> 'switch',
						'group'			=> __( 'Middle button', 'pagebox'),
						'name'			=> 'switch2',
						'option'	  	=> 'yes',
						'label'			=> __( 'Middle button switch' ),
						'description'	=> __( 'hide / show button')
				),
				array(
						'type'		  	=> 'SinglePage',
						'group'			=> __( 'Middle button', 'pagebox' ),
						'name'			=> 'select2',
						'label'			=> __( 'Select page'),
						'description'	=> __( 'Select page to be displayed')
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Middle button', 'pagebox' ),
						'name'			=> 'external2',
						'label'			=> __( 'Button name' ),
						'description'	=> __( 'Button name' )
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Middle button', 'pagebox' ),
						'name'			=> 'name2',
						'label'			=> __( 'URL name' ),
						'description'	=> __( 'URL name (leave empty if you want to display page)' )
				),
				array(
						'type'			=> 'image',
						'group' 		=> __( 'Middle button', 'pagebox'),
						'name'			=> 'mediaURL2',
						'label'			=> __( 'Media file URL'),
						'description'	=> __( 'Media file URL')
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Middle button', 'pagebox' ),
						'name'			=> 'ks-team',
						'label'			=> __( 'Team'),
						'description'	=> __( 'Team name')
				),
				array(
						'type'			=> 'switch',
						'group'			=> __( 'Right button', 'pagebox'),
						'name'			=> 'switch3',
						'option'	  	=> 'yes',
						'label'			=> __( 'Right button switch' ),
						'description'	=> __( 'hide / show button')
				),
				array(
						'type'		  	=> 'SinglePage',
						'group'			=> __( 'Right button', 'pagebox' ),
						'name'			=> 'select3',
						'label'			=> __( 'Select page'),
						'description'	=> __( 'Select page to be displayed')
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Right button', 'pagebox' ),
						'name'			=> 'external3',
						'label'			=> __( 'Button name' ),
						'description'	=> __( 'Button name' )
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Right button', 'pagebox' ),
						'name'			=> 'name3',
						'label'			=> __( 'URL name' ),
						'description'	=> __( 'URL name (leave empty if you want to display page)' )
				),
				array(
						'type'			=> 'image',
						'group' 		=> __( 'Right button', 'pagebox'),
						'name'			=> 'mediaURL3',
						'label'			=> __( 'Media file URL'),
						'description'	=> __( 'Media file URL')
				)
			)
		);
	}
}