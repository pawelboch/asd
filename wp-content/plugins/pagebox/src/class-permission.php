<?php
/**
 *
 * @since 1.0.0
 *
 * @package pagebox
 */

namespace Pagebox;

/**
 * Permission class
 * @author Piotr Grzesiak
 */
class Permission {

	public static function file( $path ) {
		if ( is_file( $path ) ) {
			if ( is_writable( $path ) ) {
				return 1;
			} else {
				return 0;
			}
		} else {
			return -1;
		}
	}

	public static function dir( $path ) {
		if ( is_dir( $path ) ) {
			if ( is_writable( $path ) ) {
				return true;
			} else {
				return false;
			}
		} else {
			if ( mkdir( $path ) && is_writable( $path ) ) {
				return true;
			} else {
				return false;
			}
		}
	}

}