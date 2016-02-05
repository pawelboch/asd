<?php
/**
 * Abstract template
 *
 * Contains abstract class for general template
 * 
 * @since 1.0.0
 *
 * @package pagebox/inc/abstract
 */

namespace Pagebox\Templates;

use \WPG_Pagebox;
use Pagebox\View;

/**
 * Abstract Template class
 * @author Kuba Mikita
 */
abstract class Template {

	/**
	 * Parent class instance
	 *
	 * @access private
	 * @var    WPG_Pagebox
	 */
	private $pagebox;

	/**
	 * Template path
	 * @var string
	 */
	private $path;

	/**
	 * Template classes generated automatically
	 * @var string
	 */
	public $template_classes;

	/**
	 * Array of section classes generated automatically
	 * @var string
	 */
	public $section_classes;

	/**
	 * Array of config
	 * @var array
	 */
	public $config;

	/**
	 * Class constructor
	 */
	public function __construct( WPG_Pagebox $pagebox ) {

		$this->pagebox = $pagebox;

		$this->set_config();
		$this->set_classes();

		// use reflection class to get template path
		$template = new \ReflectionClass( $this );
		$this->path = dirname( $template->getFileName() );

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
	 * @param   string  $name  name of the key to return
	 * @return  mixed          returns config array or if the settings
	 *          			   name was given returns value or false
	 *          			   (key not found)
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

	/**
	 * Sets template and section classes
	 * 
	 * @uses filter pagebox/templates/template_classes
	 * @uses filter pagebox/templates/section_classes
	 * @return void
	 */
	public function set_classes() {

		// section classes
		
		/**
		 * Contains informations about sections in template
		 * @var template_class_sections_info
		 */
		$template_class_sections_info = '';

		/**
		 * Classes for each section grouped in array where key is section slug
		 * @var sections_classes
		 */
		$section_classes = array();

		foreach ( $this->get_sections() as $section => $params ) {
			
			$template_class_sections_info .= ' has-section-' . $section;

			$section_classes[ $section ] = 'pagebox-section pagebox-section-' . $section . ' pagebox-section-width-' . $params['size'];

		}

		$this->section_classes = $section_classes;

		// template classes

		$this->template_classes = 'pagebox-template pagebox-template-' . $this->get_slug() . ' ' . trim( $template_class_sections_info );

	}

	/**
	 * Gets template HTML
	 * @param  array  $modules_data  modules data saved for post
	 * @return void
	 */
	public function get_template( $modules_data = array() ) {

		$view = new View;

		// set template HTML classes
		$template_classes = apply_filters( 'pagebox/templates/template_classes', $this->template_classes, $this );
		$view->set_variable( 'template_class', $template_classes );

		// set sections HTML classes
		$section_classes = apply_filters( 'pagebox/templates/section_classes', $this->section_classes, $this );
		foreach ($section_classes as $section => $classes) {
			$view->set_variable( $section . '_class', $classes );
		}

		// prepare modules data
		foreach ($this->get_sections() as $section => $params) {
			
			// if no modules set, skip to next
			if ( ! isset( $modules_data[ $section ] ) || empty( $modules_data[ $section ] ) ) {
				$view->set_variable( $section . '_modules', array() );
			} else {
				$view->set_variable( $section . '_modules', $modules_data[ $section ] );
			}

		}

		$view->get_file( $this->path . '/template.php' );

	}

	/**
	 * Gets template slug
	 *
	 * Can be used for variables, arrays, CSS classes (PHP and HTML sanitized)
	 * 
	 * @return string template slug
	 */
	public function get_slug() {

		$classname = get_class($this);

		// strip namespace
		if ( preg_match( '@\\\\([\w]+)$@', $classname, $matches) ) {
            $classname = $matches[1];
        }

		return strtolower( $classname );

	}

	/**
	 * Gets sections for template
	 *
	 * Method provides access to section which could
	 * be rendered using proper view file
	 * 
	 * @return  mixed
	 */
	public function get_sections() {

		return $this->get_config( 'sections' );

	}

	public function display_backend() {

		// display 
		global $post;

		// set default
		$contents = array();

		// get contents
		if ( isset( $post->ID ) ) {
			$contents = get_post_meta( $post->ID, 'pagebox_modules', true );
		}
		
		// render view file
		$view = new View;
		$view->set( 'template', $this );
		$view->set( 'modules' , $this->pagebox->modules );
		$view->set( 'contents', $contents );

		// load view file metabox-template-{$slug}.php or if it does 
		// not exist metabox-template.php
		$view->get_part( 'metabox/metabox-template', $this->get_slug() );

	}
}