<?php


/**
 * Don't show page before login
 */

function personal_message_when_logged_in() {
$show = isset( $_GET['show'] ) ? $_GET['show'] : false;
if ( !is_user_logged_in() && $show != 'pokaz'  ){
  $currnet_url = urlencode("//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
  wp_redirect( home_url()."/wp-login.php?redirect_to=".$currnet_url);
  die();
  }
}
if( !defined('PROD') || !PROD ){
  add_action( 'wp', 'personal_message_when_logged_in' );
}

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
		wp_enqueue_style( 'fonts-sass', TEMPLATE_DIR_URI . '/assets/stylesheets/css/fonts.css', array(), $version_hash, false );
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
	wp_enqueue_script( 'scripts', TEMPLATE_DIR_URI . '/assets/javascripts/script.js', array( 'jquery-ui-core' ), false, true );
	wp_enqueue_script( 'slick', TEMPLATE_DIR_URI . '/assets/javascripts/slick.js', array(), false, true);
	wp_enqueue_script("jquery-effects-core");
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

/**
 * Pagebox get excerpt
 */

function wppb_excerpt( $id, $words = 55) {
	//global $boxes;

	$post = get_post($id);

	if ($post->post_type == 'fund')
		return $post->post_content;


	//Do naprawienia
	//print_r(get_post_meta($post->ID, 'pagebox_modules', true));


	$sections = get_post_meta($post->ID, 'pagebox_modules', true);

	if ( !empty( $post->post_content ) ){
		return wp_trim_words( $post->post_content, $words);
	}

	if (empty($sections)){
		return $post->post_excerpt;
	}

	$break = false;
	foreach ($sections as $id => $modules) {
		foreach($modules as $module){
			$module_decode = json_decode(stripslashes($module));
			if(!$module_decode){
				$module_decode = json_decode($module);
			}
			//echo '<pre>'; print_r( $module_decode ); echo '</pre>';
			if($module_decode->slug =='post_text'){
				$content = $module_decode->settings->post_content;
				$break = true;
				break;
			}
		}
		//print_r($content);
		if($break) break;


	}

	if( isset( $content ) ){
		return wp_trim_words($content, $words);
	}else{
		return $post->post_excerpt;
	}

	return '';
}

/**
 * Enable description in menu
 */

//class Menu_With_Description extends Walker_Nav_Menu {
//	function start_el(&$output, $item, $depth, $args) {
//		global $wp_query;
//		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
//
//		$class_names = $value = '';
//
//		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
//
//		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
//		$class_names = ' class="' . esc_attr( $class_names ) . '"';
//
//		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
//
//		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
//		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
//		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
//		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
//
//		$item_output = $args->before;
//		$item_output .= '<a'. $attributes .'>';
//		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
//		$item_output .= '<span class="description">' . $item->description . '</span>';
//		$item_output .= '</a>';
//		$item_output .= $args->after;
//
//		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
//	}
//}