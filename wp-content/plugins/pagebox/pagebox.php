<?php
/*
Plugin Name: WPG Pagebox
Description: Custom Visual Page Builder by WPGeeks.co.uk
Author: WPGeeks.co.uk
Author URI: http://wpgeeks.co.uk
Version: 1.0.0
License: GPL2
Text Domain: pagebox
*/

/*

    Copyright (C) 2015  WPGeeks.co.uk info@wpgeeks.co.uk

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// Directories and urls definitions
define( 'PAGEBOX_URL', plugin_dir_url( __FILE__ ) );
define( 'PAGEBOX_DIR', plugin_dir_path( __FILE__ ) );

/**
* WPG Pagebox main class
* @since  1.0.0
* @author Kuba Mikita
*/
class WPG_Pagebox {

    /**
     * Class instance
     * @var object
     */
    private static $instance = null;
	
    /**
     * Class constructor
     * @author Kuba Mikita
     */
	public function __construct() {

        $this->load();

        //$predefined = new Pagebox\Predefined( $this );

        add_action( 'init', array( $this, 'instances' ), 10, 0 );
        add_action( 'init', array( $this, 'admin_instances' ), 20, 0 );
        
        register_activation_hook( __FILE__, array( 'WPG_Pagebox', 'install' ) );

	}

    /**
     * Register settings on activation
     * @author Kuba Mikita
     * @since  1.0.0
     * @return void
     */
    public static function install() {

        if ( version_compare( PHP_VERSION, '5.3.0', '<' ) ) {
            \deactivate_plugins( plugin_basename( __FILE__ ) );
            \wp_die( __( 'WPG Pagebox plugin requires at least PHP 5.3.0!', 'pagebox' ) );
        }

        \add_option( 'pagebox_settings', array(
            'post_types' => array( 'page' )
        ) );

    }

    /**
     * Loads necessary files
     * @author Kuba Mikita
     * @since  1.0.0
     * @return void
     */
    public function load() {

        // load Pagebox dependencies
        require_once( PAGEBOX_DIR . 'autoloader.php' );

        // load Forms library
        require_once( PAGEBOX_DIR . 'src/libs/form/autoload.php' );

        // load HTML helper library
        require_once( PAGEBOX_DIR . 'src/libs/utilities/HTML.php' );

        // global functions
        require_once( PAGEBOX_DIR . 'src/functions.php' );

        // integrations
        foreach ( glob( PAGEBOX_DIR . "src/integrations/*.php" ) as $integration ) {
            require_once( $integration );
        }

    }

    /**
     * Pageobox instance
     * @return object WPG_Pagebox instance
     */
    public static function instance() {

        if ( self::$instance === null ) {

            self::$instance = new WPG_Pagebox();

        }

        return self::$instance;
    }

    /**
     * Makes all instances
     * @author Kuba Mikita
     * @since  1.0.0
     * @return void
     */
    public function instances() {

        $this->modules   = new Pagebox\Modules\Modules( $this );
        $this->templates = new Pagebox\Templates\Templates( $this );

        $this->frontend = new Pagebox\Frontend( $this->templates, $this->modules );

    }

    /**
     * Makes only backend instances
     * @author Kuba Mikita
     * @since  1.0.0
     * @return void
     */
    public function admin_instances() {

        if ( ! is_admin() ) {
            return false; 
        }

        $admin = new Pagebox\Admin( $this );

        $metabox = new Pagebox\Metabox( $this );
        $settings = new Pagebox\Settings( $this );
        $generator = new Pagebox\Generator( $this, $settings );

    }

}

$pagebox = WPG_Pagebox::instance();
