<?php
/**
 * Front-end class
 *
 * Used to output templates and modules
 *
 * @author  Kuba Mikita
 * 
 * @since 1.0.0
 *
 * @package pagebox
 */

namespace Pagebox;

use Pagebox\View;
use Pagebox\Modules\Modules;
use Pagebox\Templates\Templates;

/**
 * Front-end class
 * @author Kuba Mikita
 */
class Frontend {

	/**
	 * Current post ID
	 * @var int
	 */
	private $post_id;

	/**
	 * Class constructor
	 * @param   object  $templates  instance of templates
	 * @param   object  $modules    instance of modules
	 * @access  public
	 */
	public function __construct( Templates $templates, Modules $modules ) {

		$this->templates = $templates;
		$this->modules = $modules;

	}

	/**
	 * Prepares class vars
	 * @param  mixed $post WP_Post object or post ID
	 * @return void
	 */
	public function prepare( $post ) {

		if ( is_numeric( $post ) ) {

			$this->post_id = absint( $post );

		} else if ( $post instanceof \WP_Post ) {

			$this->post_id = absint( $post->ID );

		} else {

			if ( $post === false ) {
				
				global $post;

				if ( isset( $post->ID ) ) {
					
					$this->post_id = $post->ID;

				} else {

					\trigger_error( '$post parameter passed to pagebox() function should be instance of WP_Post or post ID or function should be called when global $post is available' );

				}

			}

		}

		$this->post_template = get_post_meta( $this->post_id, 'pagebox_template', true );
		$this->post_modules = $this->get_post_modules( $this->post_id );

	}

	/**
	 * Gets post modules and parse them
	 * @param  int    $post_id  post ID
	 * @return array            parsed array of modules
	 */
	public function get_post_modules( $post_id ) {

		$modules_json = get_post_meta( $this->post_id, 'pagebox_modules', true );

		$modules = array();

		if ( ! is_array( $modules_json ) || empty( $modules_json ) ) {
			return $modules;
		}

		foreach ($modules_json as $section_name => $modules_data) {

			$section = str_replace( 'section-', '', $section_name );

			$modules[ $section ] = array();

			if ( ! is_array( $modules_data ) || empty( $modules_data ) ) {
				continue;
			}

			foreach ($modules_data as $key => $value) {

				$data = json_decode( $value );

				if( isset( $this->modules->modules[ $data->slug ] )) {
					$module_obj = clone $this->modules->modules[ $data->slug ];

					$module_obj->set_data( $data );

					$modules[ $section ][ $key ] = $module_obj;
				}
			}
			
		}

		return $modules;

	}


	/**
	 * Displays templates and modules
	 * @param  mixed $post WP_Post object or post ID
	 * @return void
	 */
	public function display( $post ) {

		$this->prepare( $post );

		if ( isset( $this->templates->templates[ $this->post_template ] ) ) {

			/**
			 * Current post template
			 * @var object
			 */
			$template = $this->templates->templates[ $this->post_template ];

			$template->get_template( $this->post_modules );

		} else {

			\trigger_error( 'This page has defined use of pagebox but seems to have not picked template in the page settings.' );

		}

	}

}