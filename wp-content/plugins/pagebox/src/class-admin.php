<?php
/**
 * Class contains admin pages, functions and handlers.
 *
 * Class creates instance of Pagebox plugin in backend.
 * Registers metabox, handles save action and loads
 * js/css
 * 
 * @since 1.0.0
 *
 * @package pagebox
 */

namespace Pagebox;

use \WPG_pagebox; 

/**
 * Admin class
 * @author Kuba Mikita
 */
class Admin {

	/**
	 * Parent class instance
	 *
	 * @access private
	 * @var    WPG_Pagebox
	 */
	private $pagebox;

	/**
	 * Class constructor
	 * 
	 * @access public
	 * @param  WPG_Pagebox $pagebox Parent class instance
	 */
	public function __construct(WPG_Pagebox $pagebox) {

		$this->pagebox = $pagebox;

		add_action( 'init', array( $this, 'cleanup' ), 30, 0 );

		add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts_and_styles' ), 9, 1 );

	}

	/**
	 * Cleans all unused things
	 * @return void
	 */
	public function cleanup() {

		$this->settings = get_option( 'pagebox_settings' );

		if ( isset( $this->settings['post_types'] ) && ! empty( $this->settings['post_types'] ) ) {
			
			// remove content editor
			foreach ( $this->settings['post_types'] as $post_type ) {

				remove_post_type_support( $post_type, 'editor' );

			}

		}

	}

	/**
	 * Register all Pagebox scripts and styles
	 * @return void
	 */
	public function register_scripts_and_styles() {

		// register scripts

		\wp_register_script( 'pagebox/serializejson', PAGEBOX_URL . 'src/public/js/jquery.serializejson.min.js' );

		\wp_register_script( 'pagebox/form', PAGEBOX_URL . 'src/public/js/jquery.form.js', array(
			'wp-color-picker',
			'jquery-ui-sortable',
			'pagebox/codemirror',
			'pagebox/codemirror/css',
			'pagebox/codemirror/js',
			'pagebox/codemirror/html'
		) );

		\wp_register_script( 'pagebox/tabs', PAGEBOX_URL . 'src/public/js/jquery.tabs.min.js' );

		\wp_register_script( 'pagebox/featherlight', PAGEBOX_URL . 'src/public/js/featherlight.min.js' );

		\wp_register_script( 'pagebox/mustache', PAGEBOX_URL . 'src/public/js/mustache.min.js' );

		\wp_register_script( 'pagebox/frosty', PAGEBOX_URL . 'src/public/js/frosty.min.js' );

		\wp_register_script( 'pagebox/chosen', PAGEBOX_URL . 'src/libs/chosen/chosen.jquery.min.js', array( 
			'jquery' 
		), false, true );

		\wp_register_script( 'pagebox/admin', PAGEBOX_URL . 'src/public/js/jquery.admin.js', array( 
			'jquery', 
			'pagebox/chosen' 
		), false, true );


		/*
		* Codemirror
		*/
	
		// mode: css
		\wp_register_script( 'pagebox/codemirror/css', PAGEBOX_URL . 'src/libs/codemirror/mode/css.js', array( 
			'jquery',
			'pagebox/codemirror'
		), false, true );

		// mode: javascript
		\wp_register_script( 'pagebox/codemirror/js', PAGEBOX_URL . 'src/libs/codemirror/mode/js.js', array( 
			'jquery',
			'pagebox/codemirror'
		), false, true );

		// mode: text/html
		\wp_register_script( 'pagebox/codemirror/html', PAGEBOX_URL . 'src/libs/codemirror/mode/html.js', array( 
			'jquery',
			'pagebox/codemirror'
		), false, true );

		// core
		\wp_register_script( 'pagebox/codemirror', PAGEBOX_URL . 'src/libs/codemirror/codemirror.js', array( 
			'jquery'
		), false, true );


		// register styles
		
		\wp_register_style( 'pagebox/chosen', PAGEBOX_URL . 'src/libs/chosen/chosen.min.css' );

		\wp_register_style( 'pagebox/generator', PAGEBOX_URL . 'src/public/css/generator.css' );

		\wp_register_style( 'pagebox/predefined', PAGEBOX_URL . 'src/public/css/predefined.css' );

		\wp_register_style( 'pagebox/codemirror', PAGEBOX_URL . 'src/libs/codemirror/codemirror.css' );

	}

}