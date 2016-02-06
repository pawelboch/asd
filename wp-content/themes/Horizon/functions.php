<?php

function theme_enqueue_style() {
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/stylesheets/bootstrap.min.css', array(), false, false );
    wp_enqueue_style( 'normalize', get_template_directory_uri() . '/assets/stylesheets/normalize.css', array(), false, false );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array(), false, false );
    wp_enqueue_style( 'style-sass', get_template_directory_uri() . '/assets/stylesheets/style.css', array(), false, false );
    wp_enqueue_style( 'text', get_template_directory_uri() . '/pagebox/modules/text/text.css', array(), false, false );
    wp_enqueue_style( 'slider', get_template_directory_uri() . '/pagebox/modules/slider/slider.css', array(), false, false );
}

function theme_enqueue_script() {
 wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/javascripts/script.js', array(), false, true );
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

require_once get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

?>