<?php
/**
 * Module class is an extension for Pagebox\Module
 * abstract class. It registeres new box into
 * Pagebox plugin
 *
 * Call to action module with slider
 */

namespace HorizonInvestments\Pagebox\Modules\side_tables;

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
			'slug'        => 'side_tables',
			// Human readable title of box. It will be displayed in all
			// backend functionalities
			'title'       => __(  'Side Tables', 'pagebox_blocks' ),
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
					'group'			=> __( 'First Tab', 'pagebox' ),
					'name'			=> 'first_tab_title',
					'label'			=> __( 'First tab title' ),
					'description' 	=> __( 'Type first tab title' )
				),
				array(
					'type'			=> 'text',
					'group'			=> __( 'First Tab', 'pagebox' ),
					'name'			=> 'first_tab_slug',
					'label'			=> __( 'First tab slug' ),
					'description' 	=> __( 'Type tab slug for links' )
				),
				array(
					'type'			=> 'colorpicker',
					'group'			=> __( 'First Tab', 'pagebox' ),
					'value'			=> '#E8E8E8',
					'name'			=> 'first_tab_color',
					'label'			=> __( 'First tab background color' ),
					'description' 	=> __( 'Select color' ),
					'sass'          => true
				),
				array(
					'type'			=> 'editor',
					'group'			=> __( 'First Tab', 'pagebox' ),
					'name'			=> 'first_tab_content',
					'label'			=> __( 'First tab content' ),
					'description' 	=> __( 'Type first tab content' )
				),
				array(
					'type'		=> 'repeater',
					'group'		=> __('First Tab', 'pagebox'),
					'name'		=> 'first_sub_nav',
					'labels'  => array(
						'singular' => __('Menu'),
						'plural'   => __('Menus'),
					),
					'buttons' => array(
						'add'		=> __('Add another submenu', 'pagebox'),
						'remove' => __('Remove this submenu', 'pagebox'),
					),
					'fields'	=> array(
						array(
							'type'          => 'text',
							'group'         => __( 'First Tab', 'pagebox' ),
							'name'          => 'sub',
							'label'         => __( 'Name' ),
							'description'   => __( 'Submenu navigation' )
						),
						array(
							'type'			=> 'editor',
							'group'			=> __( 'First Tab', 'pagebox' ),
							'name'			=> 'content',
							'label'			=> __( 'First left content' ),
							'description' 	=> __( 'Type first tab content' )
						),
						array(
							'type'          => 'editor',
							'group'         => __( 'First Tab', 'pagebox' ),
							'name'          => 'sidebar',
							'label'         => __( 'First sidebar' ),
							'description'   => __( 'Type first sidebar' )
						),
						array(
							'type'          => 'editor',
							'group'         => __( 'First Tab', 'pagebox' ),
							'name'          => 'full_content',
							'label'         => __( 'First full width content' ),
							'description'   => __( 'Type first full width content' )
						),
					),
				),






				array(
					'type'			=> 'text',
					'group'			=> __( 'Second Tab', 'pagebox' ),
					'name'			=> 'second_tab_title',
					'label'			=> __( 'Second tab title' ),
					'description' 	=> __( 'Type second tab title' )
				),
				array(
					'type'			=> 'text',
					'group'			=> __( 'Second Tab', 'pagebox' ),
					'name'			=> 'second_tab_slug',
					'label'			=> __( 'Second tab slug' ),
					'description' 	=> __( 'Type tab slug for links' )
				),
				array(
					'type'			=> 'colorpicker',
					'group'			=> __( 'Second Tab', 'pagebox' ),
					'value'			=> '#E8E8E8',
					'name'			=> 'second_tab_color',
					'label'			=> __( 'Second tab background color' ),
					'description' 	=> __( 'Select color' ),
					'sass'          => true
				),
				array(
					'type'			=> 'editor',
					'group'			=> __( 'Second Tab', 'pagebox' ),
					'name'			=> 'second_tab_content',
					'label'			=> __( 'Second tab content' ),
					'description' 	=> __( 'Type second tab content' )
				),

				array(
					'type'		=> 'repeater',
					'group'		=> __('Second Tab', 'pagebox'),
					'name'		=> 'second_sub_nav',
					'labels'  => array(
						'singular' => __('Menu'),
						'plural'   => __('Menus'),
					),
					'buttons' => array(
						'add'		=> __('Add another submenu', 'pagebox'),
						'remove' => __('Remove this submenu', 'pagebox'),
					),
					'fields'	=> array(
						array(
							'type'          => 'text',
							'group'         => __( 'Second Tab', 'pagebox' ),
							'name'          => 'sub',
							'label'         => __( 'Name' ),
							'description'   => __( 'Submenu navigation' )
						),
						array(
							'type'			=> 'editor',
							'group'			=> __( 'Second Tab', 'pagebox' ),
							'name'			=> 'content',
							'label'			=> __( 'Second left content' ),
							'description' 	=> __( 'Type second tab content' )
						),
						array(
							'type'          => 'editor',
							'group'         => __( 'Second Tab', 'pagebox' ),
							'name'          => 'sidebar',
							'label'         => __( 'Second sidebar' ),
							'description'   => __( 'Type second sidebar' )
						),
						array(
							'type'          => 'editor',
							'group'         => __( 'Second Tab', 'pagebox' ),
							'name'          => 'full_content',
							'label'         => __( 'Second full width content' ),
							'description'   => __( 'Type second full width content' )
						),
					),
				),






				array(
					'type'			=> 'text',
					'group'			=> __( 'Third Tab', 'pagebox' ),
					'name'			=> 'third_tab_title',
					'label'			=> __( 'Third tab title' ),
					'description' 	=> __( 'Type third tab title' )
				),
				array(
					'type'			=> 'text',
					'group'			=> __( 'Third Tab', 'pagebox' ),
					'name'			=> 'third_tab_slug',
					'label'			=> __( 'Third tab slug' ),
					'description' 	=> __( 'Type tab slug for links' )
				),
				array(
					'type'			=> 'colorpicker',
					'group'			=> __( 'Third Tab', 'pagebox' ),
					'value'			=> '#E8E8E8',
					'name'			=> 'third_tab_color',
					'label'			=> __( 'Third tab background color' ),
					'description' 	=> __( 'Select color' ),
					'sass'          => true
				),
				array(
					'type'			=> 'editor',
					'group'			=> __( 'Third Tab', 'pagebox' ),
					'name'			=> 'third_tab_content',
					'label'			=> __( 'Third tab content' ),
					'description' 	=> __( 'Type third tab content' )
				),

				array(
					'type'		=> 'repeater',
					'group'		=> __('Third Tab', 'pagebox'),
					'name'		=> 'third_sub_nav',
					'labels'  => array(
						'singular' => __('Menu'),
						'plural'   => __('Menus'),
					),
					'buttons' => array(
						'add'		=> __('Add another submenu', 'pagebox'),
						'remove' => __('Remove this submenu', 'pagebox'),
					),
					'fields'	=> array(
						array(
							'type'          => 'text',
							'group'         => __( 'Third Tab', 'pagebox' ),
							'name'          => 'sub',
							'label'         => __( 'Name' ),
							'description'   => __( 'Submenu navigation' )
						),
						array(
							'type'			=> 'editor',
							'group'			=> __( 'Third Tab', 'pagebox' ),
							'name'			=> 'content',
							'label'			=> __( 'Third left content' ),
							'description' 	=> __( 'Type Third tab content' )
						),
						array(
							'type'          => 'editor',
							'group'         => __( 'Third Tab', 'pagebox' ),
							'name'          => 'sidebar',
							'label'         => __( 'Third sidebar' ),
							'description'   => __( 'Type third sidebar' )
						),
						array(
							'type'          => 'editor',
							'group'         => __( 'Third Tab', 'pagebox' ),
							'name'          => 'full_content',
							'label'         => __( 'Third full width content' ),
							'description'   => __( 'Type third full width content' )
						),

					),
				),






				array(
					'type'			=> 'text',
					'group'			=> __( 'Fourth Tab', 'pagebox' ),
					'name'			=> 'fourth_tab_title',
					'label'			=> __( 'Fourth tab title' ),
					'description' 	=> __( 'Type fourth tab title' )
				),
				array(
					'type'			=> 'text',
					'group'			=> __( 'Fourth Tab', 'pagebox' ),
					'name'			=> 'fourth_tab_slug',
					'label'			=> __( 'Fourth tab slug' ),
					'description' 	=> __( 'Type tab slug for links' )
				),
				array(
					'type'			=> 'colorpicker',
					'group'			=> __( 'Fourth Tab', 'pagebox' ),
					'value'			=> '#E8E8E8',
					'name'			=> 'fourth_tab_color',
					'label'			=> __( 'Fourth tab background color' ),
					'description' 	=> __( 'Select color' ),
					'sass'          => true
				),
				array(
					'type'			=> 'editor',
					'group'			=> __( 'Fourth Tab', 'pagebox' ),
					'name'			=> 'fourth_tab_content',
					'label'			=> __( 'Fourth tab content' ),
					'description' 	=> __( 'Type fourth tab content' )
				),
				array(
					'type'		=> 'repeater',
					'group'		=> __('Fourth Tab', 'pagebox'),
					'name'		=> 'fourth_sub_nav',
					'labels'  => array(
						'singular' => __('Menu'),
						'plural'   => __('Menus'),
					),
					'buttons' => array(
						'add'		=> __('Add another submenu', 'pagebox'),
						'remove' => __('Remove this submenu', 'pagebox'),
					),
					'fields'	=> array(
						array(
							'type'          => 'text',
							'group'         => __( 'Fourth Tab', 'pagebox' ),
							'name'          => 'sub',
							'label'         => __( 'Name' ),
							'description'   => __( 'Submenu navigation' )
						),
						array(
							'type'			=> 'editor',
							'group'			=> __( 'Fourth Tab', 'pagebox' ),
							'name'			=> 'content',
							'label'			=> __( 'Fourth left content' ),
							'description' 	=> __( 'Type Fourth tab content' )
						),
						array(
							'type'          => 'editor',
							'group'         => __( 'Fourth Tab', 'pagebox' ),
							'name'          => 'sidebar',
							'label'         => __( 'Fourth sidebar' ),
							'description'   => __( 'Type fourth sidebar' )
						),
						array(
							'type'          => 'editor',
							'group'         => __( 'Fourth Tab', 'pagebox' ),
							'name'          => 'full_content',
							'label'         => __( 'Fourth full width content' ),
							'description'   => __( 'Type fourth full width content' )
						),
					)
				),

			)
		);
	}
}