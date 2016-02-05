<?php

function theme_enqueue_style() {
// wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', array(), false, false );
 wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/stylesheets/bootstrap.css', array(), false, false ); 
 wp_enqueue_style( 'normalize', get_template_directory_uri() . '/assets/stylesheets/normalize.css', array(), false, false ); 
// wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/assets/javascripts/slick-carousel/slick/slick.css', array(), false, false );
// wp_enqueue_style( 'pixelperfect-css', get_template_directory_uri() . '/assets/javascripts/pixelperfect/src/pixel-perfect.css', array(), false, false );
 wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array(), false, false );
    wp_enqueue_style( 'header', get_template_directory_uri() . '/assets/stylesheets/header.css', array(), false, false );
    wp_enqueue_style( 'footer', get_template_directory_uri() . '/assets/stylesheets/footer.css', array(), false, false );
}

function theme_enqueue_script() {
 wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/javascripts/jquery/dist/jquery.min.js', array(), false, true );
// wp_enqueue_script( 'prefixfree', get_template_directory_uri() . '/assets/javascripts/vendor/prefixfree/prefixfree.min.js', array(), false, false );
 wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/javascripts/bootstrap.min.js', array(), false, true );
// wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/assets/javascripts/slick-carousel/slick/slick.min.js' , array(), false, true);
// wp_enqueue_script( 'pixelperfect-js', get_template_directory_uri() . '/assets/javascripts/pixelperfect/src/pixel-perfect.js' , array(), false, true);
// wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key=&sensor=false&extension=.js', array(), false, true );
 wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/javascripts/script.js', array(), false, true );
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'theme_enqueue_script' );

add_theme_support( 'post-thumbnails' ); 

add_action( 'after_setup_theme', 'wppn_setup' );

function wppn_setup() {  
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'theme' ),
	) );
}

require_once get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

?>