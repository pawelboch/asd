<?php

define( 'TEMPLATE_DIR_PATH', get_template_directory() );
define( 'TEMPLATE_DIR_URI', get_template_directory_uri() );

function theme_enqueue_style() {
	if( defined('WP_DEBUG') && WP_DEBUG === true ) {
		wp_enqueue_style( 'bootstrap',  TEMPLATE_DIR_URI . '/assets/stylesheets/bootstrap.css', array(), false, false );
		wp_enqueue_style( 'style-sass', TEMPLATE_DIR_URI . '/assets/stylesheets/style.css',     array(), false, false );
	} else {
		wp_enqueue_style( 'bootstrap',  TEMPLATE_DIR_URI . '/assets/stylesheets/main.min.css',  array(), false, false );
	}
    wp_enqueue_style( 'text',       TEMPLATE_DIR_URI . '/pagebox/modules/text/text.css',        array(), false, false );
    wp_enqueue_style( 'slider',     TEMPLATE_DIR_URI . '/pagebox/modules/slider/slider.css',    array(), false, false );
}

function theme_enqueue_script() {
	wp_enqueue_script( 'scripts',   TEMPLATE_DIR_URI . '/assets/javascripts/script.js',         array(), false, true );
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'theme_enqueue_script' );

add_theme_support( 'post-thumbnails' ); 

add_action( 'after_setup_theme', 'wppn_setup' );

function wppn_setup() {  
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'theme' ),
        'footer' => __('Footer Menu', 'theme')
	) );
}

require_once TEMPLATE_DIR_PATH . '/inc/wp_bootstrap_navwalker.php';