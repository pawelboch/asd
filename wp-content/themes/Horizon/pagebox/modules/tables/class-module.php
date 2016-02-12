<?php
/**
 * Module class is an extension for Pagebox\Module
 * abstract class. It registeres new box into
 * Pagebox plugin
 *
 * Call to action module with slider
 */

namespace HorizonInvestments\Pagebox\Modules\Tables;

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
			'slug'        => 'tables',
			// Human readable title of box. It will be displayed in all
			// backend functionalities
			'title'       => __(  'Table', 'pagebox_blocks' ),
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
					'group'		=> __('Slider background', 'pagebox'),
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
							'type'        => 'image',
							'group'		  => __( 'General', 'pagebox' ),
							'name'        => 'image',
							'label'       => __( 'Slide image', 'pagebox' ),
							'description' => __( 'Slide image', 'pagebox' )
						)
					)
				),
				array(
						'type'			=> 'text',
						'group'			=> __( 'Slides', 'pagebox' ),
						'name'			=> 'title',
						'option'	  	=> 'yes',
						'label'			=> __( 'Title' ),
						'description'	=> __( 'description' )
				),
				array(
					'type'			=> 'text',
					'group'			=> __( 'Slides', 'pagebox' ),
					'name'			=> 'title_highlight',
					'option'	  	=> 'yes',
					'label'			=> __( 'Title highlighted word' ),
					'description'	=> __( 'description' )
				),
				array(
					'type'			=> 'text',
					'group'			=> __( 'Slides', 'pagebox' ),
					'name'			=> 'description',
					'option'		=> 'no',
					'label'			=> __( 'Description' ),
					'description' 	=> __( 'description' )
				),
				array(
					'type'			=> 'SinglePage',
					'group'			=> __( 'Slides', 'pagebox' ),
					'name'			=> 'button',
					'option'		=> 'no',
					'label'			=> __( 'btn' ),
					'description' 	=> __( 'btn' )
				),
				array(
					'type'			=> 'image',
					'group'			=> __( 'Slides', 'pagebox' ),
					'name'			=> 'image',
					'option'		=> 'no',
					'label'			=> __( 'img' ),
					'description' 	=> __( 'img' ),
					'sass'          => true
				),
				array(
					'type'			=> 'text',
					'group'			=> __( 'First Tab', 'pagebox' ),
					'name'			=> 'first_tab_title',
					'option'		=> 'no',
					'label'			=> __( 'First tab title' ),
					'description' 	=> __( 'Type first tab title' )
				),
				array(
					'type'			=> 'editor',
					'group'			=> __( 'First Tab', 'pagebox' ),
					'name'			=> 'first_tab_content',
					'option'		=> 'no',
					'label'			=> __( 'First tab content' ),
					'description' 	=> __( 'Type first tab content' )
				),
				array(
					'type'			=> 'text',
					'group'			=> __( 'Second Tab', 'pagebox' ),
					'name'			=> 'second_tab_title',
					'option'		=> 'no',
					'label'			=> __( 'Second tab title' ),
					'description' 	=> __( 'Type second tab title' )
				),
				array(
					'type'			=> 'text',
					'group'			=> __( 'Third Tab', 'pagebox' ),
					'name'			=> 'third_tab_title',
					'option'		=> 'no',
					'label'			=> __( 'Third tab title' ),
					'description' 	=> __( 'Type third tab title' )
				),
				array(
					'type'			=> 'text',
					'group'			=> __( 'Fourth Tab', 'pagebox' ),
					'name'			=> 'fourth_tab_title',
					'option'		=> 'no',
					'label'			=> __( 'Fourth tab title' ),
					'description' 	=> __( 'Type fourth tab title' )
				),
			)
		);
	}
}