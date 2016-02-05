<?php
/* 
 * WordPress SEO by Yoast plugin integration
*/

function pagebox_wp_seo_integration() {

	if ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) :

		/**
		 * Renders post content from all modules
		 * @param  string $content content html
		 * @param  object $post    post object
		 * @return string          rendered html
		 */
		function wpgpb_render_post_content( $content, $post ) {

			ob_start(); 

			pagebox( $post->ID );

			$string = ob_get_clean();

			if ( ! empty( $string ) ) return $string;
			else return $content;

		}
		add_filter( 'wpseo_pre_analysis_post_content', 'wpgpb_render_post_content', 10, 2 );

	endif;
	
}
add_action( 'admin_init', 'pagebox_wp_seo_integration' );