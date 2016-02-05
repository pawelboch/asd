<?php
/**
 * Global Pagebox functions
 *
 * @author Kuba Mikita
 * @since 1.0.0
 *
 * @package pagebox
 */

/**
 * Outputs Pagebox templates and modules
 * @param  mixed $post WP_Post object or post ID
 * @return void
 */
function pagebox( $post = false ) {

	$pagebox = WPG_Pagebox::instance();

	$pagebox->frontend->display( $post );

}