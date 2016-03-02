<?php

/**
 * Libs folder is for all external libraries (css, js, etc.)
 *
 * This file contains only wp_register_script() and wp_register_style() for vendor libs.
 * For enqueue this, use functions.php or pagebox module config.
 */

define( 'TEMPLATE_VENDOR_URI', get_template_directory_uri() . '/assets/libs' );

/**
 * JS files
 */
wp_register_script( 'bootstrap4', TEMPLATE_VENDOR_URI . '/bootstrap4/js/bootstrap.min.js', array( 'jquery' ), 'v4.0.0-alpha.2', true );

/**
 * CSS files
 */
//wp_register_style( 'test', TEMPLATE_VENDOR_URI . '/test/test.css', array(), false, true );