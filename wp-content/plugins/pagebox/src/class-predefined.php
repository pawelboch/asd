<?php
/**
 * Predefined modules class
 *
 * Loads and register predefined modules custom post type
 * and
 * 
 * @author   Max Matloka (max@matloka.me)
 * @since    1.0.0
 * 
 * @package  pagebox/modules
 */

namespace Pagebox;

use \WPG_Pagebox;

class Predefined {

	/**
	 * Parent class instance
	 *
	 * @access private
	 * @var    WPG_Pagebox
	 */
	private $pagebox;
	
	/**
	 * Class constructor
	 */
	public function __construct( WPG_Pagebox $pagebox ) {

		$this->pagebox = $pagebox;

		// Hook into the 'init' action
		add_action( 'init', array( $this, 'register' ) );

		// register metabox
		add_action( 'add_meta_boxes', array( $this, 'register_metaboxes' ), 10, 1 );

		// add ajax action
		add_action( 'wp_ajax_pagebox_select', array( $this, 'ajax_select' ) );

		// enqueue scripts
		add_action( 'admin_print_scripts-post-new.php', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_print_scripts-post.php', array( $this, 'enqueue_scripts' ) );

		// enqueue styles
		add_action( 'admin_print_styles-post-new.php', array( $this, 'enqueue_styles' ) );
		add_action( 'admin_print_styles-post.php', array( $this, 'enqueue_styles' ) );

		// perform save action
		add_action( 'save_post', array( $this, 'save' ), 10, 3 );

	}

	public function register() {

		$labels = array(
			'name'                => _x( 'Predefined Modules', 'Post Type General Name', 'pagebox' ),
			'singular_name'       => _x( 'Predefined Module', 'Post Type Singular Name', 'pagebox' ),
			'menu_name'           => __( 'Predefined Modules', 'pagebox' ),
			'parent_item_colon'   => __( 'Parent Item:', 'pagebox' ),
			'all_items'           => __( 'Predefined Modules', 'pagebox' ),
			'view_item'           => __( 'View Item', 'pagebox' ),
			'add_new_item'        => __( 'Add New Item', 'pagebox' ),
			'add_new'             => __( 'Add New', 'pagebox' ),
			'edit_item'           => __( 'Edit Item', 'pagebox' ),
			'update_item'         => __( 'Update Item', 'pagebox' ),
			'search_items'        => __( 'Search Item', 'pagebox' ),
			'not_found'           => __( 'Not found', 'pagebox' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'pagebox' ),
		);

		$args = array(
			'label'               => __( 'pagebox_predefined', 'pagebox' ),
			'description'         => __( 'Pagebox Predefined Modules', 'pagebox' ),
			'labels'              => $labels,
			'supports'            => array( 'title', ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => 'pagebox',
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => false,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'rewrite'             => false,
			'capability_type'     => 'page',
		);

		register_post_type( 'pagebox_predefined', $args );

	}

	/**
	 * Registers Metaboxes for predefined modules generator use
	 * 
	 * @access  public
	 * 
	 * @return  void
	 */
	public function register_metaboxes() {
		
		global $post;

		add_meta_box(
			'pagebox_predefined_listing',
			__( 'Predefined module', 'pagebox' ),
			array( $this, 'display_listing_metabox' ),
			'pagebox_predefined',
			'normal',
			'high'
		);

		add_meta_box(
			'pagebox_predefined_settings',
			__( 'Predefined module', 'pagebox' ),
			array( $this, 'display_settings_metabox' ),
			'pagebox_predefined',
			'normal',
			'high'
		);

	}

	/**
	 * Displays metabox with modules listing
	 * 
	 * @access  public
	 * 
	 * @return  void
	 */
	public function display_listing_metabox() {

		global $post;

		// load and display view file
		$view = new View;

		$view->set_variable( 'modules', $this->pagebox->modules->get_modules() );
		$view->set_variable( 'module', get_post_meta( $post->ID, 'pagebox_module', true ) );

		$view->get_part( 'predefined/listing' );

	}

	/**
	 * Displays metabox with modules settings
	 * 
	 * @access  public
	 * 
	 * @return  void
	 */
	public function display_settings_metabox() {

		global $post;

		// load and display view file
		$view     = new View;
		$module   = get_post_meta( $post->ID, 'pagebox_module', true );
		$settings = get_post_meta( $post->ID, 'pagebox_modules', true );

		if ( $module != false && $settings != false ) {

			$module = $this->pagebox->modules->get_module( $module );

			$module->set_form();
			$module->set_form_values( get_post_meta( $post->ID, 'pagebox_modules', true ) );

			$view->set_variable( 'module', $module );

		}

		$view->get_part( 'predefined/settings' );

	}

	/**
	 * Save post metadata when a post is saved.
	 *
	 * @param  int   $post_id The post ID.
	 * @param  post  $post The post object.
	 * @param  bool  $update Whether this is an existing post being updated or not.
	 */
	public function save( $post_id, $post, $update ) {

		// check if post type is enabled in settings
	    if ( $post->post_type != 'pagebox_predefined' ) {
	        return false;
	    }

	    if ( ! isset( $_REQUEST[ 'pagebox_module' ] ) ) {
	    	return false;
	    }

	    $modules = array();

	    // get only post prefixed pagebox_module_
	    foreach ( $_REQUEST as $key => $value ) {

	    	if ( substr( $key, 0, 15 ) != 'pagebox_module_' ) {
	    		continue;
	    	}

	    	$modules[ substr( $key, 15 ) ] = $value;

	    }

	    // update predefined module settings
	    update_post_meta( $post_id, 'pagebox_module', $_REQUEST[ 'pagebox_module' ] );
	    update_post_meta( $post_id, 'pagebox_modules', $modules );

	}

	/**
	 * AJAX action to get setting for selected module
	 * 
	 * @access  public
	 * 
	 * @return  void
	 */
	public function ajax_select() {

		// get required module
		$module = $this->pagebox->modules->get_module( $_REQUEST[ 'module' ] );

		if ( ! $module ) {
			die();
		}

		// get config
		$config = $module->get_config();

		// add pagebox_module_ prefix to fields name to avoid conflicts
		if ( is_array( $config[ 'fields' ] ) && ! empty( $config[ 'fields' ] ) ) {
			$i = 0;
			while ( $i <= count( $config[ 'fields' ] ) - 1 ) {
				
				$config[ 'fields' ][ $i ][ 'name' ] = 'pagebox_module_' . $config[ 'fields' ][ $i ][ 'name' ];
				$i++;

			}

			$module->set_config( $config );
		}

		// set module form
		$module->set_form();

		// and load view file
		$view = new View;
		$view->set_variable( 'module', $module );

		$view->get_part( 'predefined/settings' );

		die();
		
	}

	/**
	 * Enqueue styles for metabox
	 * 
	 * @access  public
	 * 
	 * @return  void
	 */
	public function enqueue_styles() {

		global $post_type;

		// check if metabox is enabled for current post type
		if ( $post_type != 'pagebox_predefined' ) {
			return;
		}

		\wp_enqueue_style( 'pagebox/metabox', PAGEBOX_URL . 'src/public/css/metabox.css' );
		\wp_enqueue_style( 'pagebox/featherlight', PAGEBOX_URL . 'src/public/css/featherlight.min.css' );
		\wp_enqueue_style( 'pagebox/frosty', PAGEBOX_URL . 'src/public/css/frosty.min.css' );

		\wp_enqueue_style( 'pagebox/predefined' );

	}

	/**
	 * Enqueue scripts for metabox
	 * 
	 * @access  public
	 * 
	 * @return  void
	 */
	public function enqueue_scripts() {

		global $post_type;

		// check if metabox is enabled for current post type
		if ( $post_type != 'pagebox_predefined' ) {
			return;
		}

		// enqueue scripts
		\wp_enqueue_script( 'pagebox/serializejson', PAGEBOX_URL . 'src/public/js/jquery.serializejson.min.js' );
		\wp_enqueue_script( 'pagebox/form', PAGEBOX_URL . 'src/public/js/jquery.form.js', array(
			'wp-color-picker'
		) );

		\wp_enqueue_script( 'pagebox/predefined', PAGEBOX_URL . 'src/public/js/jquery.predefined.js', array(
			'pagebox/form'
		) );

		$l18n_array = array(
			'i18n' => array(
				'sure' => __('Are you sure? Current progress will be lost.', 'pagebox')
			)
		);
		\wp_localize_script( 'pagebox/predefined', 'Pagebox', $l18n_array );
	}
}