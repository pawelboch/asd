<?php

/**
 * Defined constants
 */
define( 'TEMPLATE_DIR_PATH', get_template_directory() );
define( 'TEMPLATE_DIR_URI', get_template_directory_uri() );

/**
 * Theme styles (CSS)
 */
function theme_enqueue_style() {

	/**
	 * Load css styles for development
	 */
	if ( defined( 'WP_DEBUG' ) && WP_DEBUG === true ) {
		$version_hash = uniqid();
		wp_enqueue_style( 'bootstrap', TEMPLATE_DIR_URI . '/assets/stylesheets/css/bootstrap.css', array(), $version_hash, false );
		wp_enqueue_style( 'style-sass', TEMPLATE_DIR_URI . '/assets/stylesheets/css/style.css', array(), $version_hash, false );

		/**
		 * Modules autoload css files.
		 */
		foreach ( glob( TEMPLATE_DIR_PATH . '/pagebox/modules/*', GLOB_ONLYDIR ) as $dir ) {
			$dirname = basename( $dir );
			wp_enqueue_style( "{$dirname}-module", TEMPLATE_DIR_URI . "/pagebox/modules/{$dirname}/css/module.css", array(), $version_hash, false );
		}
	} else {
		/**
		 * Load only one, compressed file for production
		 */
		wp_enqueue_style( 'theme-style', TEMPLATE_DIR_URI . '/assets/stylesheets/css/style.min.css' );
	}
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_style' );

/**
 * Theme scripts (JavaScript)
 */
function theme_enqueue_script() {
	wp_enqueue_script( 'scripts', TEMPLATE_DIR_URI . '/assets/javascripts/script.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'slick', TEMPLATE_DIR_URI . '/assets/javascripts/slick.js', array(), false, true);
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_script' );

/**
 * Enabled post-thumbnail support
 */
add_theme_support( 'post-thumbnails' );

/**
 * Register default menus
 */
function wppn_setup() {
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'theme' ),
		'footer'  => __( 'Footer Menu', 'theme' )
	) );
}

add_action( 'after_setup_theme', 'wppn_setup' );

/**
 * Bootstrap navwalker
 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.
 */
require_once TEMPLATE_DIR_PATH . '/inc/wp_bootstrap_navwalker.php';

/**
 * Disable wp emojis
 */
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
	add_filter( 'teeny_mce_plugins', 'disable_emojicons_tinymce' );
}

add_action( 'init', 'disable_wp_emojicons' );


/**
 * SVG Support
 */

function cc_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'cc_mime_types' );