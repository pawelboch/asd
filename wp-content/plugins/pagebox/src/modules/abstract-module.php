<?php
/**
 * Abstract module
 *
 * Contains default methods for each module
 *
 * @author   Max Matloka (max@matloka.me)
 * @since    1.0.0
 *
 * @package  pagebox/modules
 */

namespace Pagebox\Modules;

use Pagebox\View;

abstract class Module {

	protected $config;
	private $form;

	private $path;

	public $data;

	/**
	 * Constructor method gets path of module and
	 * include config
	 *
	 * @access  public
	 */
	public function __construct() {

		$this->set_config();

		// use reflection class to get module path
		$module     = new \ReflectionClass( $this );
		$this->path = dirname( $module->getFileName() );

	}

	/**
	 * Required config method which must set class $config property
	 * @return void
	 */
	abstract function set_config();

	/**
	 * Returns config array
	 *
	 * @access  public
	 *
	 * @param   string $name name of the key to return
	 *
	 * @return  mixed          returns config array or if the settings
	 *                       name was given returns value or false
	 *                       (key not found)
	 */
	public function get_config( $name = null ) {

		if ( isset( $name ) ) {
			if ( isset( $this->config[ $name ] ) ) {
				return $this->config[ $name ];
			} else {
				return false;
			}
		}

		return $this->config;

	}

	public function get_path() {
		return $this->path;
	}

	/**
	 * Gets module slug slug
	 *
	 * Can be used for variables, arrays, CSS classes
	 *
	 * @return  string  template slug
	 */
	public function get_slug() {

		return $this->get_config( 'slug' );

	}

	/**
	 * Set up module edit form based on config file
	 *
	 * @access  public
	 *
	 * @return  this
	 */
	public function set_form() {

		if ( isset( $this->config['fields'] ) && is_array( $this->config['fields'] ) ) {
			$this->form = new \WPGeeks_Form_Factory( $this->config['fields'] );
		}

		return $this;

	}

	/**
	 * Sets values in edit form. Value array syntax must be valid
	 * with WPGeeks_Form requirements
	 *
	 * @access  public
	 *
	 * @param   array $values array containing form values
	 *
	 * @return  WPGeeks_Form
	 */
	public function set_form_values( $values = array() ) {

		$this->form->setValues( $values );

		return $this;

	}

	/**
	 * Returns edit form object (instance of
	 * WPGeeks_Form)for current module.
	 *
	 * @access  public
	 *
	 * @return  WPGeeks_Form
	 */
	public function get_form() {

		return $this->form;

	}

	/**
	 * Sets current module data
	 *
	 * @access  public
	 *
	 * @param   array $data data
	 *
	 * @return  void
	 */
	public function set_data( $data ) {

		$this->data = $data;

	}

	/**
	 * Get module view to use in skeleton
	 *
	 * @access  public
	 *
	 * @return  WPGeeks_Form
	 */
	public function get_backend( $id, $json_data, $section_name ) {

		$data = json_decode( $json_data );

		$mustache = new \Mustache_Engine( array(
			'loader' => new \Mustache_Loader_FilesystemLoader( PAGEBOX_DIR . 'src/public/partials/metabox' )
		) );

		return $mustache->render( 'module', array(
			'id'      => $data->id,
			'slug'    => $this->get_config( 'slug' ),
			'title'   => $this->get_config( 'title' ),
			'primary' => ( isset( $data->primary ) ) ? $data->primary : false,
			'target'  => 'section-' . $section_name,
			'data'    => str_replace( "'", "&#39;", $json_data )
		) );

	}

	public function display_backend( $id, $json_data, $section_name ) {

		echo $this->get_backend( $id, $json_data, $section_name );

	}

	/**
	 * Displays frontend module template
	 * @uses filter pagebox/modules/css_classes
	 * @return void
	 */
	public function display_frontend() {

		/**
		 * @todo handle for custom styles and scripts
		 */

		$view = new View;

		// set module CSS classes
		$css_class = 'pagebox-' . $this->data->slug . '-module pagebox-module-' . $this->data->id;

		$view->set_variable( 'css_class', apply_filters( 'pagebox/modules/css_class', $css_class, $this ) );

		// logic method exists so pass all settings to it
		if ( method_exists( $this, 'logic' ) ) {

			$settings = $this->logic( $this->data->settings );

			foreach ( $settings as $setting => $value ) {
				$view->set_variable( $setting, $value );
			}

		} else { // or pass raw data

			// set module data
			foreach ( $this->data->settings as $setting => $value ) {
				$view->set_variable( $setting, $value );
			}

		}

		// view method exists so use it instead of default one
		if ( method_exists( $this, 'view' ) ) {

			$view_method = $this->view( $this->data->settings, $this->path );

			$view->get_file( $view_method );

		} else {

			$view->get_file( $this->path . '/views/default.php' );

		}

		// Add module javascript in footer if exists
		if( is_file( $this->path . '/js/module.js' ) ) {
			wp_enqueue_script(
				'pagebox-' . $this->data->slug . '-module',
				get_template_directory_uri() . '/pagebox/modules/' . $this->data->slug . '/js/module.js',
				array( 'jquery' ),
				false,
				true
			);
		}

	}

	/**
	 * Alias for display_frontend()
	 */
	public function display() {

		$this->display_frontend();

	}

}