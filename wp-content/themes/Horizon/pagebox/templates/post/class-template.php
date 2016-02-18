<?php
/**
 * post template class file
 *
 * post
 *
 * @author Pagebox Generator
 *
 * @package pagebox/templates
 */

namespace Pagebox\Templates;

use \WPG_Pagebox;
use Pagebox\Templates\Template as Template_Abstract;

class Post extends Template_Abstract {

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
			'post-100-up' => array( // template slug
				'label' => 'post-100-up', // label
				'size'  => 100, // size in %
				'limit' => -1 // limit of modules which can be added to this section. 0 for no limit.
			),
			'post-30-1' => array( // template slug
				'label' => 'post-30-1', // label
				'size'  => 29, // size in %
				'limit' => -1 // limit of modules which can be added to this section. 0 for no limit.
			),
			'post-70-1' => array( // template slug
				'label' => 'post-70-1', // label
				'size'  => 70, // size in %
				'limit' => -1 // limit of modules which can be added to this section. 0 for no limit.
			),
			'post-center' => array( // template slug
				'label' => 'post-center', // label
				'size'  => 100, // size in %
				'limit' => -1 // limit of modules which can be added to this section. 0 for no limit.
			),
			'post-30-2' => array( // template slug
				'label' => 'post-30-2', // label
				'size'  => 29, // size in %
				'limit' => -1 // limit of modules which can be added to this section. 0 for no limit.
			),
			'post-70-2' => array( // template slug
				'label' => 'post-70-2', // label
				'size'  => 70, // size in %
				'limit' => -1 // limit of modules which can be added to this section. 0 for no limit.
			),
			'post-100-down' => array( // template slug
				'label' => 'post-100-down', // label
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
			'name'        => 'post', // human readable name of template
			'description' => 'post', // human readable description of template
			'sections'    => $sections
		);

	}
	
}