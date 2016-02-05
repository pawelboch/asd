<?php
/**
 * Generator for templates and modules
 * 
 * @since 1.0.0
 *
 * @package pagebox
 */

namespace Pagebox;

use \WPG_pagebox; 
use Pagebox\View;
use Pagebox\Settings;

/**
 * Generator class
 * @author Kuba Mikita
 */
class Generator {

	/**
	 * Parent class instance
	 *
	 * @access private
	 * @var    WPG_Pagebox
	 */
	private $pagebox;

	/**
	 * Settings class instance
	 *
	 * @access private
	 * @var    Pagebox\Settings
	 */
	private $settings;

	/**
	 * Settings page hook
	 *
	 * @access public
	 */
	public $page_hook;

	/**
	 * Current generator tab
	 *
	 * @access public
	 */
	public $current_tab;

	/**
	 * Fields object
	 *
	 * @access public
	 */
	public $fields;

	/**
	 * Generator file name
	 *
	 * @access public
	 */
	public $filename = 'generator.zip';

	/**
	 * Class constructor
	 * 
	 * @access  public
	 * 
	 * @param   WPG_Pagebox $pagebox Parent class instance
	 */
	public function __construct(WPG_Pagebox $pagebox, Settings $settings) {

		$this->pagebox = $pagebox;
		$this->settings = $settings;

		$this->set_current_tab();

		add_action( 'admin_menu', array( $this, 'register_pages' ), 9, 0 );

		add_action( 'admin_enqueue_scripts', array( $this, 'scripts_and_styles' ), 10, 1 );

		add_action( 'admin_init', array( $this, 'generate_template' ) );

		add_action( 'admin_init', array( $this, 'generate_fields' ) );

		add_action( 'admin_notices', array( $this, 'notices' ) );

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

		$this->page_hook = add_submenu_page(
			'pagebox',
			__( 'Pageox Generator', 'pagebox' ),
			__( 'Generator', 'pagebox' ),
			'manage_options',
			'pagebox-generator',
			array( $this, 'display_generator_page' )
		);

	}

	/**
	 * Displays Pagebox generator page
	 * 
	 * @access  public
	 * @author  Kuba Mikita
	 * 
	 * @return  void
	 */
	public function display_generator_page() {

		// header
		$header = new View();
		$header->set( 'current_tab', $this->current_tab );
		$header->get_part( 'page/generator/header' );

		// form
		$form = new View();

		$this->fields = call_user_func( array( $this, 'create_' . $this->current_tab . '_form_fields' ) );

		$form->set( 'fields', $this->fields );

		$form->get_part( 'page/generator/form/' . $this->current_tab );

		// footer
		$footer = new View( 'page/generator/footer' );

	}

	/**
	 * Sets current tab
	 * 
	 * @access  public
	 * @author  Kuba Mikita
	 * 
	 * @return  void
	 */
	public function set_current_tab() {

		if ( isset( $_GET['tab'] ) ) {
			$this->current_tab = $_GET['tab'];
		} else {
			$this->current_tab = 'templates';
		}

	}

	/**
	 * Generates fields
	 * 
	 * @access  public
	 * @author  Kuba Mikita
	 * 
	 * @return  void
	 */
	public function generate_fields() {

		if ( isset( $_GET['page'] ) && $_GET['page'] == 'pagebox-generator' ) {
			$this->fields = call_user_func( array( $this, 'create_' . $this->current_tab . '_form_fields' ) );
		}

	}

	/**
	 * Template generator fields
	 * 
	 * @access  public
	 * @author  Kuba Mikita
	 * 
	 * @return  object  WPGeeks_Form_Factory
	 */
	public function create_templates_form_fields() {

		return new \WPGeeks_Form_Factory( array(
			array(
				'label' => __( 'Name', 'pagebox' ),
				'name' => 'name',
				'class' => 'regular-text',
				'type' => 'text',
				'description' => __( 'Human readable, capitalized. Must be unique across entire WordPress installation', 'pagebox' ),
				'placeholder' => __( 'Template Name Example', 'pagebox' ),
				'validators' => array(
					new \WPGeeks_Form_Validator_Required()
				)
			),
			array(
				'label' => __( 'Description', 'pagebox' ),
				'name' => 'description',
				'class' => 'regular-text',
				'type' => 'textarea'
			),
			array(
				'label' => __( 'Sections', 'pagebox' ),
				'name' => 'sections',
				'type' => 'repeater',
				'buttons' => array(
					'add'    => __('Add section', 'pagebox'),
					'remove' => __('Remove section', 'pagebox'),
				),
				'fields' => array(
					array(
						'label' => __( 'ID', 'pagebox' ),
						'name' => 'ID',
						'placeholder' => 'section_id',
						'description' => __( 'Unique section ID', 'pagebox' ),
						'type' => 'text',
						'validators' => array(
							new \WPGeeks_Form_Validator_Required()
						)
					),
					array(
						'label' => __( 'Label', 'pagebox' ),
						'name' => 'label',
						'type' => 'text'
					),
					array(
						'label' => __( 'Size', 'pagebox' ),
						'name' => 'size',
						'description' => __( 'In %', 'pagebox' ),
						'type' => 'number',
						'min' => '10',
						'max' => '100',
						'step' => '1'
					),
					array(
						'label' => __( 'Modules limit', 'pagebox' ),
						'name' => 'limit',
						'value' => '-1',
						'description' => __( '-1 for unlimited number of modules in section', 'pagebox' ),
						'type' => 'number',
						'min' => '-1',
						'step' => '1'
					),
				)
			),
		) );

	}

	/**
	 * Module generator fields
	 * 
	 * @access  public
	 * @author  Kuba Mikita
	 * 
	 * @return  object  WPGeeks_Form_Factory
	 */
	public function create_modules_form_fields() {

		return new \WPGeeks_Form_Factory( array(
			array(
				'label' => __( 'Name', 'pagebox' ),
				'name' => 'name',
				'class' => 'regular-text',
				'type' => 'text',
				'description' => __( 'Human readable, capitalized. Must be unique across entire WordPress installation', 'pagebox' ),
				'placeholder' => __( 'Class Name Example', 'pagebox' ),
				'validators' => array(
					new \WPGeeks_Form_Validator_Required()
				)
			),
			array(
				'label' => __( 'Description', 'pagebox' ),
				'name' => 'description',
				'class' => 'regular-text',
				'type' => 'textarea'
			),
			array(
				'label' => __( 'Sections', 'pagebox' ),
				'name' => 'sections',
				'type' => 'repeater',
				'buttons' => array(
					'add'    => __('Add section', 'pagebox'),
					'remove' => __('Remove section', 'pagebox'),
				),
				'validators' => array(
					new \WPGeeks_Form_Validator_Required()
				),
				'fields' => array(
					array(
						'label' => __( 'ID', 'pagebox' ),
						'name' => 'ID',
						'placeholder' => 'section_id',
						'description' => __( 'Unique section ID', 'pagebox' ),
						'type' => 'text',
						'validators' => array(
							new \WPGeeks_Form_Validator_Required()
						)
					),
					array(
						'label' => __( 'Label', 'pagebox' ),
						'name' => 'label',
						'type' => 'text'
					),
					array(
						'label' => __( 'Size', 'pagebox' ),
						'name' => 'size',
						'description' => __( 'In %', 'pagebox' ),
						'type' => 'text',
					),
					array(
						'label' => __( 'Modules limit', 'pagebox' ),
						'name' => 'limit',
						'value' => '-1',
						'description' => __( '-1 for unlimited number of modules in section', 'pagebox' ),
						'type' => 'text',
					),
				)
			),
		) );

	}

	/**
	 * Displays admin notices for generator
	 *
	 * @access  public
	 * 
	 * @return  void
	 */
	public function notices() {

		if ( isset( $_GET['generated'] ) ) {
			
			echo '<div class="updated"><p><strong>' . __( 'Files created.', 'pagebox' ) . '</strong></p></div>';

		} else if ( isset( $_GET['error'] ) ) {
			
			if ( $_GET['error'] == 'mkdir' ) {

				echo '<div class="error"><p><strong>' . __( 'Generator couldn\'t created /wp-content/plugins/pagebox/tmp/ directory. Please check the WordPress file writing permissions.', 'pagebox' ) . '</strong></p></div>';
			
			} else if ( $_GET['error'] == 'zip' ) {

				echo '<div class="error"><p><strong>' . __( 'Generator couldn\'t created the zip file.', 'pagebox' ) . '</strong></p></div>';
			
			} else if ( $_GET['error'] == 'chmod' ) {

				echo '<div class="error"><p><strong>' . __( 'Pagebox directory is not writable. Check permissions.', 'pagebox' ) . '</strong></p></div>';
			
			}

			if ( ! $this->fields->isValid() ) {
				
				foreach ( $this->fields->getMessages() as $error ) {

					echo '<div class="error"><p><strong>' .$error . '</strong></p></div>';

				}

			}

		}

	}

	/**
	 * Generates the template
	 *
	 * @access  public
	 * 
	 * @return  void
	 */
	public function generate_template() {

		$data = $_REQUEST;

		if ( ! isset( $data['generate-template-request'] ) ) {
			return;
		}

		if ( empty( $data['name'] ) || empty( $data['sections'] ) ) {
			$this->redirect( 'error' );
		}

		if ( ! $this->create_template_files() ) {
			
			$this->create_template_archive();

		} else {

			$this->redirect();

		}

	}

	/**
	 * Creates the template files
	 *
	 * @access  public
	 * 
	 * @return  boolean  files was created or not
	 */
	public function create_template_files() {

		$data = $_REQUEST;

		$mustache = new \Mustache_Engine( array(
			'loader' => new \Mustache_Loader_FilesystemLoader( PAGEBOX_DIR . 'src/public/partials/page/generator/templates' )
		) );

		$sections_iterator = new \ArrayIterator( $data['sections'] );

		$out_class_template = $mustache->render( 'class-template', array(
			'name'        => $data['name'],
			'class_name'  => $this->sanitize_class_name( $data['name'] ),
			'description' => $data['description'],
			'sections'    => $sections_iterator
		) );

		$out_template = $mustache->render( 'template', array(
			'name'        => $data['name'],
			'sections'    => $sections_iterator
		) );

		// create array of files
		$this->files = array(
			'class-template' => $out_class_template,
			'template'       => $out_template
		);

		// try to save them
		
		$template_path = get_stylesheet_directory() . '/pagebox/templates/' . $this->sanitize_string( $data['name'] ) . '/' . $data['name'];

		// create directories if these doesn't exists
		$parts = explode( '/', $template_path );
        $file = array_pop( $parts );
        $dir = '';

        foreach( $parts as $part ) {

        	$dir .= $part . DIRECTORY_SEPARATOR;

            if( ! is_dir( $dir ) ) {
            	mkdir( $dir );
            }

        }

		foreach ( $this->files as $file => $template ) {
			
			$saved = file_put_contents( $dir . $file . '.php', $template );

			if ( $saved === false ) {
				return false;
			}

		}

		return true;

	}

	/**
	 * Creates the template .zip archive
	 *
	 * @access  public
	 * 
	 * @return  void
	 */
	public function create_template_archive() {

		$data = $_REQUEST;

		if ( ! class_exists('ZipArchive') ) {

			$this->redirect( 'error', 'zip' );

		}

		$file = tempnam( 'tmp', 'zip' );

		if ( $file === false ) {

			$this->redirect( 'error', 'zip' );

		}

		$zip = new \ZipArchive();

		if ( $zip->open( $file, \ZipArchive::OVERWRITE ) === true ) {

			$sanitized_name = $this->sanitize_string( $data['name'] );

			if( $zip->addEmptyDir( $sanitized_name ) ) {

				// reset internal pointer
				reset( $this->files );

				foreach ( $this->files as $file_name => $template ) {
					$zip->addFromString( $sanitized_name . '/' . $file_name . '.php', $template );
				}

			} else {
			    
				$this->redirect( 'error', 'zip' );

			}

			$zip->close();

			header( 'Content-Type: application/zip' );
			header( 'Content-Length: ' . filesize( $file ) );
			header( 'Content-Disposition: attachment; filename="' . $this->filename . '"' );

			readfile( $file );
			unlink( $file ); 

		} else {

			$this->redirect( 'error', 'zip' );

		}

	}

	/**
	 * Sanitizes the string
	 *
	 * @access  public
	 *
	 * @param   string  $strig     string to sanitize
	 * 
	 * @return  string  sanitized  string
	 */
	public function sanitize_string( $string ) {

		$string = trim( $string );
		$string = str_replace( ' ', '-', $string );
		$string = preg_replace( '/[^A-Za-z0-9\-]/', '', $string );
		$string = strtolower( $string );
		return preg_replace( '/-+/', '-', $string );

	}

	/**
	 * Redirects to the form
	 * @param  string $type    generated || error
	 * @param  string $details detailed info
	 * @return void
	 */
	public function redirect( $type = 'generated', $details = 'true' ) {

		$cleaned_url = remove_query_arg( array( 'generated', 'error'), $_REQUEST['_wp_http_referer'] );

		wp_redirect( add_query_arg( $type, $details, $cleaned_url ) );

		die();

	}

	/**
	 * Sanitizes the class name out of string
	 *
	 * @access  public
	 *
	 * @param   string  $strig     string to sanitize
	 * 
	 * @return  string  sanitized  string
	 */
	public function sanitize_class_name( $string ) {

		$string = trim( $string );
		$string = ucwords( $string );
		$string = str_replace( ' ', '_', $string );
		$string = preg_replace( '/[^A-Za-z0-9\-\_]/', '', $string );
		return preg_replace( '/-+/', '-', $string );

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

		if ( $hook != $this->page_hook ) {
			return false;
		}

		wp_enqueue_style( 'pagebox/generator' );

		wp_enqueue_script( 'pagebox/form' );

		wp_enqueue_script( 'pagebox/admin' );

	}

}