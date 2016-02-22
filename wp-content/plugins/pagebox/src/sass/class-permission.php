<?php

namespace Pagebox\Sass;

/**
 * Class Permission
 * @package Pagebox\Sass
 * @author Piotr Grzesiak
 */
class Permission {

	/**
	 * Check file is exists and writable.
	 *
	 * @param string $path File path
	 * @return int status
	 */
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

	/**
	 * Check dir is exists and writable.
	 * If not exists, try to create.
	 *
	 * @param string $path Dir path
	 * @return bool
	 */
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