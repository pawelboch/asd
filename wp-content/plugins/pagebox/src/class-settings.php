<?php
/**
 * Class registers settings page and handles all its actions
 * 
 * @since 1.0.0
 *
 * @package pagebox
 */

namespace Pagebox;

use \WPG_pagebox; 
use Pagebox\Template;
use Pagebox\View;

/**
 * Settings class
 * @author Kuba Mikita
 */
class Settings {

	/**
	 * Parent class instance
	 *
	 * @access private
	 * @var    WPG_Pagebox
	 */
	private $pagebox;

	/**
	 * Pagebox settings
	 *
	 * @access private
	 */
	private $settings;

	/**
	 * Settings page hook
	 *
	 * @access public
	 */
	public $page_hook;

	/**
	 * Default post types
	 *
	 * @access public
	 */
	public $default_post_types = array( 'page' );

	/**
	 * Class constructor
	 * 
	 * @access  public
	 * 
	 * @param   WPG_Pagebox $pagebox Parent class instance
	 */
	public function __construct(WPG_Pagebox $pagebox) {

		$this->pagebox = $pagebox;

		add_action( 'admin_menu', array( $this, 'register_pages' ), 8, 0 );
		add_action( 'admin_init', array( $this, 'register_settings' ), 10, 0 );
		add_action( 'admin_enqueue_scripts', array( $this, 'scripts_and_styles' ), 10, 1 );

	}

	/**
	 * Registers Pagebox admin pages
	 * 
	 * @access  public
	 * @author  Kuba Mikita
	 * 
	 * @return  void
	 */
	public function register_pages() {

		add_menu_page( 
			__( 'Pagebox', 'pagebox' ),
			__( 'Pagebox', 'pagebox' ),
			'manage_options',
			'pagebox',
			array( $this, 'display_pagebox_settings_page' ),
			'dashicons-screenoptions',
			100.2369
		);

		$this->page_hook = add_submenu_page(
			'pagebox',
			__( 'Settings', 'pagebox' ),
			__( 'Settings', 'pagebox' ),
			'manage_options',
			'pagebox',
			array( $this, 'display_pagebox_settings_page' )
		);

	}

	/**
	 * Displays Pagebox settings page
	 * 
	 * @access  public
	 * @author  Kuba Mikita
	 * 
	 * @return  void
	 */
	public function display_pagebox_settings_page() {
		
		new View( 'page/settings' );

	}

	/**
	 * Register and enqueue all admin styles
	 *
	 * @access  public
	 * 
	 * @param   string  $hook  current page hook
	 * @return  void
	 */
	public function scripts_and_styles( $hook ) {

		if ( $hook != $this->page_hook && ! in_array( get_post_type(), $this->get_enabled_post_types() ) ) {
			return false;
		}

		\wp_enqueue_style( 'pagebox/chosen' );

		\wp_enqueue_script( 'pagebox/admin' );

	}
	
	/**
	 * Gets post types for which Pagebox is enabled
	 *
	 * @access  public
	 * @author  Kuba Mikita
	 * 
	 * @return  array  post types
	 */
	public function get_enabled_post_types() {

		// if settings are not populated
		if ( empty( $this->settings ) ) {
			$this->settings = get_option( 'pagebox_settings' );
		}

		if ( empty( $this->settings[ 'post_types' ] ) ) {
			return $this->default_post_types;
		} else {
			return $this->settings[ 'post_types' ];
		}

	}

	/**
	 * Settings
	 * 
	 * Registers settings 
	 * 
	 * @access public
	 * @author Kuba Mikita
	 * 
	 * @return void
	 */
	public function register_settings() {

		$this->settings = get_option( 'pagebox_settings' );

		\register_setting( 'pagebox_settings', 'pagebox_settings' );
		
		\add_settings_section(
			'pb_general',
			__( 'General Settings', 'pagebox' ),
			null,
			'pagebox'
		);
	 	
	 	\add_settings_field(
			'post_types',
			__( 'Post types', 'pagebox' ),
			array( $this, 'settings_post_type_field' ),
			'pagebox',
			'pb_general'
		);

	}

	/**
	 * Settings fields
	 * 
	 * Post type field output
	 *
	 * @access  public
	 *
	 * @return  void
	 */
	public function settings_post_type_field() {

		if ( ! isset( $this->settings['post_types'] ) || empty( $this->settings['post_types'] ) ) {
			$this->settings['post_types'] = $this->default_post_types;
		}

		echo '<select multiple="multiple" name="pagebox_settings[post_types][]" id="post_types" class="chosen-select">';

			foreach ( get_post_types( array( 'public' => true ) ) as $post_type ) {
				$selected = in_array( $post_type, $this->settings['post_types'] ) ? 'selected="selected"' : '';
				echo '<option value="' . $post_type . '" ' . $selected . '>' . $post_type . '</option>';
			}

		echo '</select>';

		echo '<p class="description">'.__( 'Apply Pageboxes to these post types', 'pagebox' ).'</p>';

	}

}