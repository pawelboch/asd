<?php
/**
 * Templates class
 *
 * Loads, registers and handles Templates
 *
 * @author Kuba Mikita
 * @since 1.0.0
 *
 * @package pagebox/templates
 */

namespace Pagebox\Templates;

use \WPG_Pagebox;

class Templates {

	/**
	 * Parent class instance
	 *
	 * @access private
	 * @var    WPG_Pagebox
	 */
	private $pagebox;

	/**
	 * Directories list to load templates
	 * @uses filter pagebox/templates/directories
	 * @var array
	 */
	private $directories;

	/**
	 * Array of files which contains template classes
	 * @var array
	 */
	private $files;

	/**
	 * Array of template objects
	 * @var array
	 */
	public $templates;

	/**
	 * Constructor method which fires on WordPress init.
	 * It loads and then registers all available templates
	 * found in pagebox folder located in current theme
	 * directory and another directories set using 
	 * pagebox/templates/directories filter.
	 *
	 * @access  public
	 * @return  void
	 */
	public function __construct( WPG_Pagebox $pagebox ) {
 
		$this->pagebox = $pagebox;

		$default_directories = array(
			\get_stylesheet_directory() . '/pagebox/templates/',
			PAGEBOX_DIR . 'examples/templates/',
		);

		/**
		 * Directories filter. Please note to add trailing
		 * slash.
		 * @var  $default_directories  default directories to check
		 */
		$this->directories = apply_filters( 'pagebox/templates/directories', $default_directories );

		$this->scan_directories();
		$this->register_templates();

	}

	/**
	 * Method actually scans all directories form
	 * $this->directories variable to find existing templates.
	 * 
 	 * @access  public
	 * @return  this
	 */
	private function scan_directories() {

		$this->files = array();

		if ( ! is_array( $this->directories ) || empty ( $this->directories ) ) {
			return $this;
		}

		// scan through directories
		foreach ( $this->directories as $directory ) {
			$files = glob( $directory . '*/class-template.php', 0 );

			// if there were no files found continue to next directory
			if ( ! is_array( $files ) || empty( $files ) ) {
				continue;
			}

			// add all templates to array
			foreach ( $files as $file ) {
				$this->files[] = $file;
			}
		}

		return $this;

	}

	/**
	 * Method registers all valid templates
	 *
	 * @access  public
	 * 
	 * @return  this
	 */
	private function register_templates() {

		if ( ! is_array( $this->files ) || empty ( $this->files ) ) {
			return $this;
		}

		// check all files
		foreach ( $this->files as $file ) {

			// check if template were loaded before.
			if ( isset( $this->templates[ $file ] ) ) {
				continue;
			}

			include( $file );

			// get last included class name
			$classes = get_declared_classes();
			$class_name = end( $classes );

			if ( is_subclass_of( $class_name, 'Pagebox\Templates\Template' ) ) {
				$template_obj = new $class_name( $this->pagebox );
				$this->templates[ $template_obj->get_slug() ] = $template_obj;
			} else {
				\trigger_error( $file . ' is not subclass of Pagebox\\templates\\template \\Pagebox\\templates\\templates::register_templates()' );
			}
		}

	}

	/**
	 * Method returns all registered templates or false if there
	 * are no templates at all
	 *
	 * @access  public
	 *
	 * @return  mixed
	 */
	public function get_templates() {

		if ( ! is_array( $this->templates ) || empty ( $this->templates ) ) {
			return false;
		}
		
		return $this->templates;

	}

	/**
	 * Method returns template object or false if template cannot be found 
	 *
	 * @access  public
	 *
	 * @param   string  $slug  slug name of the template
	 * @return  mixed
	 */
	public function get_template( $slug ) {

		$templates = $this->get_templates();

		if ( isset( $templates[ $slug ] ) ) {
			return $templates[ $slug ];
		}

		return false;

	}

}