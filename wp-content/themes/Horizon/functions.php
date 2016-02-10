<?php

define( 'TEMPLATE_DIR_PATH', get_template_directory() );
define( 'TEMPLATE_DIR_URI', get_template_directory_uri() );

function theme_enqueue_style() {
	$version_hash = uniqid();
	if( defined('WP_DEBUG') && WP_DEBUG === true ) {
		wp_enqueue_style( 'bootstrap',  TEMPLATE_DIR_URI . '/assets/stylesheets/css/bootstrap.css', array(), $version_hash, false );
		wp_enqueue_style( 'style-sass', TEMPLATE_DIR_URI . '/assets/stylesheets/css/style.css',     array(), $version_hash, false );
	} else {
		wp_enqueue_style( 'main',  	TEMPLATE_DIR_URI . '/assets/stylesheets/css/main.min.css',      array(), false, false );
	}
    wp_enqueue_style( 'text',						TEMPLATE_DIR_URI . '/pagebox/modules/text/css/module.css',          				array(), $version_hash, false );
    wp_enqueue_style( 'slider',						TEMPLATE_DIR_URI . '/pagebox/modules/slider/css/module.css',        				array(), $version_hash, false );
	wp_enqueue_style( 'two_images',					TEMPLATE_DIR_URI . '/pagebox/modules/two_images/css/module.css',					array(), $version_hash, false );
	wp_enqueue_style( 'title_three_sections',		TEMPLATE_DIR_URI . '/pagebox/modules/title_three_sections.css/css/module.css',		array(), $version_hash, false );
}

function theme_enqueue_script() {
	wp_enqueue_script( 'jQuery', 		TEMPLATE_DIR_URI . '/assets/javascripts/jquery-2.2.0.min.js',		array(), false, true );
	wp_enqueue_script( 'scripts',   	TEMPLATE_DIR_URI . '/assets/javascripts/script.js',					array(), false, true );

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

// Disable wp emojis
function disable_wp_emojicons() {

	// all actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	// filter to remove TinyMCE emojis
	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );