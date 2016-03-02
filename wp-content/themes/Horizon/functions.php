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
	 * Load vendor libs.
	 */
	if( is_file( TEMPLATE_DIR_PATH . '/assets/libs/register_vendors.php' )) {
		include_once TEMPLATE_DIR_PATH . '/assets/libs/register_vendors.php';
	}

	/**
	 * Load css styles for development.
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
		 * Load only one, compressed file for production.
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
	//wp_enqueue_script('bootstrap4');
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_script' );

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

// Add post thumbnails support

add_theme_support( 'post-thumbnails' );

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

/**
 * Display pagination - used in search page
 *
 * @param string $pages
 * @param int $range
 * @param bool $ajax
 * @param string $paged
 */
function pagination($pages = '', $range = 4, $ajax = false, $paged = '')
{
	$showItems = ($range * 2 ) + 1;

	if( $paged == '' ) {
		global $paged;
		if( empty($paged)) $paged = 1;
	}

	if( $pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;

		if( !$pages ) {
			$pages = 1;
		}
	}

	if( $pages != 1 ) {
		if( $ajax ) {
			echo '<div class="wpg-filter-by-pager ajax-pagination">';

			if( $paged > 1 ) {
				echo "<div class=\"block-prev\"><a href='".get_pagenum_link($paged - 1)."'>previous</a></div>";
			}

			echo '<div class="pages">';

			for( $i=1; $i <= $pages; $i++ ) {
				if( $pages != 1 && ( !($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showItems) ) {
					echo ($paged == $i)? "<div class='actual-page'>".$i."</div>":"<div class='other-pages'><a href='#' data-page='".$i."' class=\"inactive\">".$i."</a></div>";
				}
			}

			echo '</div>';

			if ($paged < $pages) {
				echo "<div class=\"block-next\"><a href=\"".get_pagenum_link($paged + 1)."\">next</a></div>";
			}

			echo '</div>';
		} else {
			echo '<div class="wpg-filter-by-pager">';

			if( $paged > 1 ) {
				echo "<div class=\"block-prev\"><a href='".get_pagenum_link($paged - 1)."'>previous</a></div>";
			}

			echo '<div class="pages">';

			for ( $i=1; $i <= $pages; $i++ ) {
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showItems ) ) {
					echo ($paged == $i)? "<div class='actual-page'>".$i."</div>":"<div class='other-pages'><a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></div>";
				}
			}

			echo '</div>';

			if( $paged < $pages ) {
				echo "<div class=\"block-next\"><a href=\"".get_pagenum_link($paged + 1)."\">next</a></div>";
			}

			echo '</div> ';
		}
	}
}

/**
 * Return number for post in results with pagination
 *
 * @param $paged
 * @param $i
 * @return string
 */
function numberResultPagination($paged, $i)
{
	$perPage = get_option('posts_per_page ');
	if( $paged < 2 ) {
		return $i . '. ';
	} else {
		return ($i + (($paged-1) * $perPage)) . '. ';
	}
}

/**
 * Add team taxonomy - Team Departmen and Team Web Departmen
 */
function team_taxonomy() {
	register_taxonomy(
		't_category',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'team',   		 //post type name
		$team_category = array(
			'hierarchical' 		=> true,
			'label' 			=> 'Team Department',  //Display name
			'query_var' 		=> true,
			'rewrite'			=> array(
				'slug' 			=> 'Team', // This controls the base slug that will display before each term
				'with_front' 	=> false // Don't display the category base before
			)
		)
	);
	register_taxonomy(
		't_category_web',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'team',   		 //post type name
		$team_category = array(
			'hierarchical' 		=> true,
			'label' 			=> 'Team Web Department',  //Display name
			'query_var' 		=> true,
			'rewrite'			=> array(
				'slug' 			=> 'team_web', // This controls the base slug that will display before each term
				'with_front' 	=> false // Don't display the category base before
			)
		)
	);
}
add_action( 'init', 'team_taxonomy', 1);


/**
 * Add custom post type 'Team'
 */
add_action( 'init', 'create_team_member_type', 1 );
function create_team_member_type() {
	register_post_type( 'team_member',
		array(
			'labels' => array(
				'name' => __( 'Team' ),
				'singular_name' => __( 'Team' )
			),
			'taxonomies' => array('t_category','t_category_web'),
			'public' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'publicly_queryable' => false,
			'supports'    => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )
		)
	);
}

function team_member_func( $atts )
{
	$args = array(
		'post_type'=> 'team_member',
		'order'    => 'DESC',
		'posts_per_page' => '-1',
//		't_category_web' => $this->get('team_member')
	);

	$teamMembers = get_posts( $args );

	$returnString ='<div class="team-module"><div class="persons">';

	foreach($teamMembers as $team) {
		$taxonomy_objects = get_the_terms( $team->ID, 't_category' );
		$taxonomy_objects_web = get_the_terms( $team->ID, 't_category_web' );

		$returnString .= '<div class="person"><div class="picture"><img src="'.((get_post_thumbnail_id($team->ID)) ? wp_get_attachment_image_src( get_post_thumbnail_id($team->ID), 'medium')[0] : 'https://placeholdit.imgix.net/~text?txtsize=33&txt=&w=284&h=398').'" alt=""></div>';
		$returnString .= '<div class="description"><h2>'.$team->post_title.'</h2><p>'.(($taxonomy_objects) ? $taxonomy_objects[0]->name : '').'</p></div><div class="expand">Expand</div></div>';
		$returnString .= '<div class="team-desc">'.$team->post_content.'</div>';
	}

	$returnString .= '</div></div>';

	return $returnString;
}
add_shortcode( 'team_member', 'team_member_func' );