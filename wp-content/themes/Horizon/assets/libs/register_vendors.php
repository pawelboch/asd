<?php

/**
 * Libs folder is for all external libraries (css, js, etc.)
 *
 * This file contains only wp_register_script() and wp_register_style() for vendor libs.
 * For enqueue this, use functions.php or pagebox module config.
 */

if( defined( 'TEMPLATE_DIR_URI' )) {
	define( 'TEMPLATE_VENDOR_URI', TEMPLATE_DIR_URI . '/assets/libs' );
} else {
	define( 'TEMPLATE_VENDOR_URI', get_template_directory_uri() . '/assets/libs' );
}

/**
 * JS files
 */
wp_register_script( 'bootstrap4', TEMPLATE_VENDOR_URI . '/bootstrap4/js/bootstrap.min.js', array( 'jquery' ), 'v4.0.0-alpha.2', true );
wp_register_script( 'parallax', TEMPLATE_VENDOR_URI . '/parallax.js-1.4.2/parallax.min.js', array( 'jquery' ), '1.4.2', true );

/**
 * CSS files
 */
//wp_register_style( 'test', TEMPLATE_VENDOR_URI . '/test/test.css', array(), false, true );
wp_register_style( 'font-awesome', TEMPLATE_VENDOR_URI . '/font-awesome-4.5.0/css/font-awesome.css', array( ), '4.5.0', true );