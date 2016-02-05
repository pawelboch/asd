<?php
/**
 * Class handles vie files.
 *
 * It can load both frontend and backend views. Basic 
 * bakend usage need only __conctruct method.
 * new View( 'example' ) will include file located in
 * /src/partials/example.php.
 * Including frontend, and backend templates with
 * extra data to use inside the view file requires to use
 * __constructor method without any parameters.
 * $view = new View;
 *
 * @author   Max Matloka (max@matloka.me)
 * @since    1.0.0
 * 
 * @package  pagebox
 */

namespace Pagebox;

class View {

	/**
	 * Constructor method
	 *
	 * One line solution to include view file. If slug
	 * variable is given it fires directly get_part method.
	 *
	 * @access public
	 *
	 * @param   string  $slug  The slug name for the generic template
	 * @param   string  $name  The name of the specialised template
	 */
	public function __construct( $slug = null, $name = null ) {
		if ( isset( $slug ) ) {
			$this->get_part( $slug, $name );
			return;
		}

		$this->variables = new \stdClass;
	}

	/**
	 * Renders view file from partials folder. Method uses
	 * default get_template_part function syntax.
	 *
	 * By default method includes /partials/{slug}.php file.
	 * If $name variable was given it looks for specialised part
	 * /partials/{slug}-{name}.php. In case specialised file is missing
	 * generic template will be loaded.
	 * 
	 * Slug variable can contain directories. E.g. slug admin/admin
	 * includes /partials/admin/admin.php file.
	 *
	 * @access public
	 * 
	 * @param   string  $slug  The slug name for the generic template
	 * @param   string  $name  The name of the specialised template
	 * @return  bool           status
	 */
	public function get_part( $slug, $name = null ) {

		$path = PAGEBOX_DIR . '/src/public/partials/';

		// try to load specialised file first
		if ( file_exists( $path . $slug . '-' . $name . '.php' ) ) {
			return $this->get_file( $path . $slug . '-' . $name . '.php' );

		// then generic one
		} else if ( file_exists( $path . $slug . '.php' ) ) {
			return $this->get_file( $path . $slug . '.php' );
		}

		\trigger_error( 'Generic file (slug:' . $slug . ') cannot be found in \\Pagebox\\View::get_part()' );
		return false;

	}

	/**
	 * Renders view file from modules folder called pagebox (located in 
	 * current Wordpress template). Method uses default get_template_part
	 * function syntax.
	 *
	 * See \get_template_part() for further details
	 * 
	 * @access public
	 * 
	 * @param   string  $slug  The slug name for the generic template
 	 * @param   string  $name  The name of the specialised template
 	 * @return  void
	 */
	public function get_module_part( $slug, $name = null ) {

		\get_template_part( 'pagebox/' . $slug, $name );

	}

	/**
	 * Renders view using absolute path to file
	 *
	 * @access public
	 *
	 * @param   string  $file  absolute path to file 
	 * @return  this
	 */
	public function get_file( $file = '' ) {

		if ( empty( $file ) ) {
			\trigger_error( $file . ' cannot be empty in \\Pagebox\\View::get_file()' );
			return false;
		}

		if ( !file_exists( $file ) ) {
			\trigger_error( $file . ' cannot be found in \\Pagebox\\View::get_file()' );
			return false;
		}

		include( $file );

	}

	/**
	 * Adds variable with given slug and value to $this->variables
	 * object, which could be used in current view file.
	 *
	 * @access public
	 *
	 * @param   string  $slug   name of the variable
	 * @param   string  $value  value of the variable
	 * @return  this
	 */
	public function set_variable( $slug, $value ) {
		$this->variables->$slug = $value;

		return $this;
	}

	/**
	 * Alias for set_variable method
	 *
	 * @access public
	 *
	 * @param   string  $slug   name of the variable
	 * @param   string  $value  value of the variable
	 * @return  this
	 */
	public function set( $slug, $value ) {
		$this->set_variable( $slug, $value );

		return $this;
	}

	/**
	 * Returns variable with given slug to use inside
	 * view file.
	 *
	 * @access public
	 *
	 * @param   string  $slug   name of the variable to return
	 * @return  mixed           slug or false if it does not exist
	 */
	public function get_variable( $slug ) {
		if ( isset( $this->variables->$slug ) ) {
			return $this->variables->$slug;
		} else {
			return false;
		}
	}

	/**
	 * Alias for get_variable
	 *
	 * @access public
	 *
	 * @param   string  $slug   name of the variable to return
	 * @return  mixed           slug or false if it does not exist
	 */
	public function get( $slug ) {
		return $this->get_variable( $slug );
	}

}