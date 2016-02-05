<?php
/**
 * Class registers metabox and handles all metabox actions
 * such as displaying menu with available block or rendering
 * block edit form.
 * 
 * @since 1.0.0
 *
 * @package pagebox
 */

namespace Pagebox;

use \WPG_pagebox;
use Pagebox\View;

class Metabox {

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
	 * Default post types
	 *
	 * @access public
	 */
	public $default_post_types = array( 'page' );

	/**
	 * Class constructor
	 * 
	 * @access  public
	 * @author  Kuba Mikita
	 */
	public function __construct(WPG_Pagebox $pagebox) {

		$this->pagebox = $pagebox;

		// register metabox
		add_action( 'add_meta_boxes', array( $this, 'register_metabox' ), 10, 1 );

		// enqueue scripts
		add_action( 'admin_print_scripts-post-new.php', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_print_scripts-post.php', array( $this, 'enqueue_scripts' ) );

		// enqueue styles
		add_action( 'admin_print_styles-post-new.php', array( $this, 'enqueue_styles' ) );
		add_action( 'admin_print_styles-post.php', array( $this, 'enqueue_styles' ) );

		// set ajax actions
		add_action( 'wp_ajax_pagebox_listing', array( $this, 'ajax_listing' ) );
		add_action( 'wp_ajax_pagebox_edit', array( $this, 'ajax_edit' ) );
		add_action( 'wp_ajax_pagebox_template', array( $this, 'ajax_template' ) );
		add_action( 'wp_ajax_count_posts', array( $this, 'ajax_count_posts' ) );

		// perform save action
		add_action( 'save_post', array( $this, 'save' ), 10, 3 );

	}

	/**
	 * Gets post types for which Pagebox metabox is enabled
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
	 * Registers Metabox for Pagebox use
	 * 
	 * @access  public
	 * @author  Kuba Mikita
	 * 
	 * @return  void
	 */
	public function register_metabox() {

		foreach ( $this->get_enabled_post_types() as $post_type ) {

			add_meta_box(
				'pagebox',
				__( 'Pagebox', 'pagebox' ),
				array( $this, 'display_metabox' ),
				$post_type,
				'normal',
				'high'
			);

		}

	}

	/**
	 * Display Pagebox Metabox content
	 * 
	 * @access  public
	 * @author  Max Matloka (max@matloka.me)
	 * 
	 * @return  void
	 */
	public function display_metabox() {

		// register metabox view
		$metabox  = new View();

		// get registered templates
		$metabox->set( 'templates', $this->pagebox->templates );

		// get saved data
		global $post;
		$template = get_post_meta( $post->ID, 'pagebox_template', true );

		// if template is set to false no data were saved (new post/page)
		if ( $template != false ) {

			$metabox->set( 'template_name', $template );

			$template = $this->pagebox->templates->get_template( $template );

			ob_start();
            	$template->display_backend();
        	$template = ob_get_clean();

        	$metabox->set( 'template', $template );
			
		}

		$metabox->get_part( 'metabox/metabox', 'templates' );

	}

	/**
	 * AJAX action to list all available modules in modal
	 * 
	 * @access  public
	 * @author  Max Matloka (max@matloka.me)
	 * 
	 * @return  void
	 */
	public function ajax_listing() {

		$view = new View;

		// get modules list
		$view->set_variable( 'modules', $this->pagebox->modules->get_modules() );

		// get predefined modules
		$query = new \WP_Query( array(
			'post_type'      => 'pagebox_predefined',
			'posts_per_page' => -1
		) );

		$view->set_variable( 'predefined', $query );

		// load and display view file
		$view->get_part( 'metabox/modal/listing' );

		die();
		
	}

	/**
	 * AJAX action to edit/add module
	 * 
	 * @access  public
	 * @author  Max Matloka (max@matloka.me)
	 * 
	 * @return  void
	 */
	public function ajax_edit() {

		// get module data and create form to handle module edits
		$module = $this->pagebox->modules->get_module( $_REQUEST[ 'module' ] );
		$module->set_form();

		// load view file
		$view = new View;
		$view->set_variable( 'module', $module );

		// if there is data variable in request, current module is edited
		if ( isset( $_REQUEST[ 'data' ] ) ) {

			$data = json_decode( stripslashes( $_REQUEST[ 'data' ] ), true );

			if ( isset( $data[ 'settings' ] ) ) {
				$module->set_form_values( $data[ 'settings' ] );
			} else {
				$module->set_form_values( $data );
			}

		}

		// prepare <form> http attribute with required attributes
		$form = new \WPGeeks_HTML( 'form', array(
			'data-slug'   => $module->get_config( 'slug' ),
			'data-title'  => $module->get_config( 'title' ),
			'data-target' => $_REQUEST[ 'target' ]
		) );

		// if current module is edited add current module ID
		if ( isset( $_REQUEST[ 'id' ] ) && !empty( $_REQUEST[ 'id' ] ) ) {
			$view->set_variable( 'edit', '1' );
			$form->setAttribute( 'data-id', $_REQUEST[ 'id' ] );
		}

		// set extra variables and load view file
		$view->set_variable( 'form', $form );
		$view->get_part( 'metabox/modal/edit' );

		die();
		
	}

	/**
	 * Render template skeleton
	 * 
	 * Renders backend skeleton of template in which
	 * we can add some modules using provided interface.
	 *
	 * @access  public
	 * @author  Max Matloka (max@matloka.me)
	 * 
	 * @return  void
	 */
	public function ajax_template() {

		// get template info
		$template = $this->pagebox->templates->get_template( $_REQUEST[ 'template' ] );

		if ( $template == false ) {
			die();
		} 

		$template->display_backend();

		die();

	}

	public function ajax_count_posts() {

		$args = array(
			'posts_per_page' => 1,
			'post_type'      => $_REQUEST[ 'type' ],
		);

		if ( $_REQUEST[ 'type' ] == 'page' ) {

			die();

		}

		// check post settings

		// check id
		if ( isset( $_REQUEST[ 'id' ] ) && !empty( $_REQUEST[ 'id' ] ) ) {

			$args[ 'p' ] = $_REQUEST[ 'id' ];

		} else {

			// check categories
			if ( isset( $_REQUEST[ 'category' ] ) && !empty( $_REQUEST[ 'category' ] ) ) {

				if ( is_array( $_REQUEST[ 'category' ] ) ) {
					$args[ 'category__in' ] = $_REQUEST[ 'category' ];
				} else {
					$args[ 'cat' ] = $_REQUEST[ 'category' ];
				}

			}

			// check tags
			if ( isset( $_REQUEST[ 'tag' ] ) && !empty( $_REQUEST[ 'tag' ] ) ) {

				if ( is_array( $_REQUEST[ 'tag' ] ) ) {
					$args[ 'tag__and' ] = $_REQUEST[ 'tag' ];
				} else {
					$args[ 'tag_id' ] = $_REQUEST[ 'tag' ];
				}

			}

			// set order settings
			if ( isset( $_REQUEST[ 'orderby' ] ) ) {
				$args[ 'orderby' ] = $_REQUEST[ 'orderby' ];
			}

			if ( isset( $_REQUEST[ 'order' ] ) ) {
				$args[ 'order' ]   = $_REQUEST[ 'order' ];
			}

			// set additional offset
			if ( isset( $_REQUEST[ 'offset' ] ) && !empty( $_REQUEST[ 'offset' ] ) ) {
				$args[ 'offset' ] = $_REQUEST[ 'offset' ];
			}

		}


		$query = new \WP_Query( $args );

		// get number of found posts
		echo $query->found_posts;
		die();

	}

	/**
	 * Save post metadata when a post is saved.
	 *
	 * @param  int   $post_id The post ID.
	 * @param  post  $post The post object.
	 * @param  bool  $update Whether this is an existing post being updated or not.
	 */
	public function save( $post_id, $post, $update ) {

		$this->settings = get_option( 'pagebox_settings' );

		// check if post type is enabled in settings
	    if ( ! in_array( $post->post_type, $this->settings['post_types'] ) ) {
	        return false;
	    }

	    // verify nonce
	    if ( ! isset( $_REQUEST['pagebox-nonce'] ) ) {
	    	return false;
	    }

	    /*if ( ! wp_verify_nonce( $_REQUEST['pagebox-nonce'], 'pagebox-actions-' . $post_id ) ) {
	        return false;
	    }@todo*/

	    // save the template information
	    $template = false;

	    if ( isset( $_REQUEST[ 'pagebox_template' ] ) ) {
			$template = $_REQUEST[ 'pagebox_template' ];
	    }

	    update_post_meta( $post_id, 'pagebox_template', $template );

	    // save the modules informations
	    $modules = false;

	    if ( isset( $_REQUEST[ 'pagebox_modules' ] ) ) {
			$modules = $_REQUEST[ 'pagebox_modules' ];
	    }
	    
	    update_post_meta( $post_id, 'pagebox_modules', $modules );

	}

	/**
	 * Enqueue styles for metabox
	 * 
	 * @access  public
	 * @author  Max Matloka (max@matloka.me)
	 * 
	 * @return  void
	 */
	public function enqueue_styles() {

		global $post_type;

		// check if metabox is enabled for current post type
		if ( !in_array( $post_type, $this->get_enabled_post_types() ) ) {
			return;
		}

		\wp_enqueue_style( 'wp-color-picker' );
		\wp_enqueue_style( 'pagebox/metabox', PAGEBOX_URL . 'src/public/css/metabox.css' );
		\wp_enqueue_style( 'pagebox/featherlight', PAGEBOX_URL . 'src/public/css/featherlight.min.css' );
		\wp_enqueue_style( 'pagebox/frosty', PAGEBOX_URL . 'src/public/css/frosty.min.css' );
		\wp_enqueue_style( 'pagebox/codemirror' );

	}

	/**
	 * Enqueue scripts for metabox
	 * 
	 * @access  public
	 * @author  Max Matloka (max@matloka.me)
	 * 
	 * @return  void
	 */
	public function enqueue_scripts() {

		global $post_type;

		// check if metabox is enabled for current post type
		if ( !in_array( $post_type, $this->get_enabled_post_types() ) ) {
			return;
		}

		// enqueue scripts
		\wp_enqueue_script( 'pagebox/metabox', PAGEBOX_URL . 'src/public/js/jquery.metabox.js', array( 
			'pagebox/serializejson',
			'pagebox/tabs',
			'pagebox/form',
			'pagebox/codemirror/css',
			'pagebox/codemirror/js',
			'pagebox/codemirror/html',
			'pagebox/featherlight', 
			'pagebox/mustache', 
			'pagebox/frosty', 
			'jquery-ui-sortable' 
		) );

		// send some data to js file
		$metabox_array = array(
			'path' => array( 
				'module' => PAGEBOX_URL . 'src/public/partials/metabox/module.mustache',
			),
			'i18n' => array(
				'sure' => __('Are you sure? Current progress will be lost.', 'pagebox')
			)
		);
		\wp_localize_script( 'pagebox/mustache', 'Pagebox', $metabox_array );
	}

}