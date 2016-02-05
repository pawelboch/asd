<?php
/**
 * Modules class
 *
 * Loads and register all modules from theme folder
 * 
 * @author   Max Matloka (max@matloka.me)
 * @since    1.0.0
 * 
 * @package  pagebox/modules
 */

namespace Pagebox\Modules;

use \WPG_Pagebox;

class Modules {

	/**
	 * Parent class instance
	 *
	 * @access private
	 * @var    WPG_Pagebox
	 */
	private $pagebox;

	private $directories;
	private $files;
	public $modules;

	/**
	 * Constructor method which fires on Wordpress init.
	 * It loads and then registers all available modules
	 * found in pagebox folder located in current theme
	 * directory and another directories set using 
	 * Pagebox/modules/directories filter.
	 *
	 * @access  public
	 * @return  void
	 */
	public function __construct() {

		$default_directories = array(
			\get_stylesheet_directory() . '/pagebox/modules/',
			PAGEBOX_DIR . 'examples/modules/'
		);

		/**
		 * Directories filter. Please note to add trailing
		 * slash.
		 * @var  $default_directories  default directories to check
		 */
		$this->directories = apply_filters( 'pagebox/modules/directories', $default_directories );

		$this->scan_directories();
		$this->register_modules();

	}

	/**
	 * Method actually scans all directories form
	 * $this->directories variable to find existing modules.
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
			$files = glob($directory . '*/class-module.php', 0);

			// if there were no files found continue to next directory
			if ( ! is_array( $files ) || empty( $files ) ) {
				continue;
			}

			// add all modules to array
			foreach ( $files as $file ) {
				$this->files[] = $file;
			}
		}

		return $this;

	}

	/**
	 * Method registers all valid modules
	 *
	 * @access  public
	 * 
	 * @return  this
	 */
	private function register_modules() {

		if ( ! is_array( $this->files ) || empty ( $this->files ) ) {
			return $this;
		}

		// check all files
		foreach ( $this->files as $file ) {

			include_once( $file );

			// get last included class name
			$classes = get_declared_classes();
			$class_name = end( $classes );

			if ( is_subclass_of( $class_name, 'Pagebox\Modules\Module' ) ) {
				
				$module = new $class_name;

				// slug field is required
				if ( !$module->get_config( 'slug' ) ) {
					\trigger_error( $file . ': Config: slug field is required \\Pagebox\\Modules\\Modules::register_modules()' );
					continue;
				}

				// title field is also required
				if ( !$module->get_config( 'title' ) ) {
					\trigger_error( $file . ': Config: title field is required \\Pagebox\\Modules\\Modules::register_modules()' );
					continue;
				}

				// if module is already registered
				if ( isset( $this->modules[ $module->get_config( 'slug' ) ] ) ) {
					continue;
				}
				
				$this->modules[ $module->get_config('slug') ] = $module;
			} else {
				\trigger_error( $file . ' is not subclass of Pagebox\\Modules\\Module \\Pagebox\\Modules\\Modules::register_modules()' );
			}
		}

	}

	/**
	 * Method returns all registered modules or false if there
	 * are no modules at all
	 *
	 * @access  public
	 *
	 * @return  mixed
	 */
	public function get_modules() {

		if ( ! is_array( $this->modules ) || empty ( $this->modules ) ) {
			return false;
		}

		uasort( $this->modules, function ( $a, $b ) { return $b->get_config( 'priority' ) - $a->get_config( 'priority' ); } );
		
		return $this->modules;

	}

	/**
	 * Method returns module object or false if module cannot be found 
	 *
	 * @access  public
	 *
	 * @param   string  $slug  slug name of the module
	 * @return  mixed
	 */
	public function get_module( $slug ) {

		if ( ! is_array( $this->modules ) || empty ( $this->modules ) ) {
			return false;
		}

		// get all registered modules
		foreach ( $this->modules as $file => $module ) {

			// compare given slug to slug from module config 
			if ( $module->get_config( 'slug' ) == $slug ) {
				return $module;
			}

		}

		return false;

	}

}