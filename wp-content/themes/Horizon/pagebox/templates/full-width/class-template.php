<?php
/**
 * Full width template class file
 *
 * 100% width template
 *
 * @author Pagebox Generator
 *
 * @package pagebox/templates
 */

namespace Pagebox\Templates;

use \WPG_Pagebox;
use Pagebox\Templates\Template as Template_Abstract;

class Full_Width extends Template_Abstract {

	/**
	 * Template constructor
	 * @access public
	 */
	public function __construct( WPG_Pagebox $pagebox ) {

		parent::__construct( $pagebox );

	}

	/**
	 * Template config
	 * @return void
	 */
	public function set_config() {

		/**
		 * Contains array of sections available within template
		 * @var sections
		 */
		$sections = array(
			'full-width' => array( // template slug
				'label' => 'Full width', // label
				'size'  => 100, // size in %
				'limit' => -1 // limit of modules which can be added to this section. 0 for no limit.
			),
		);

		/**
		 * Entire config array
		 * @uses var sections
		 * @var config
		 */
		$this->config = array( 
			'name'        => 'Full width', // human readable name of template
			'description' => '100% width template', // human readable description of template
			'sections'    => $sections
		);

	}
	
}