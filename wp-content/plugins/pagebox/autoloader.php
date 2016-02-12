<?php
/**
 * autoloader
 *
 * @since 1.0.0
 *
 * @package pagebox
 */

function d( $d ) {
	echo '<pre>';
	var_dump( $d );
	echo '</pre>';
}

define('PAGEBOX_AUTOLOAD_DIRECTORY_PATH', dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR);

function autoload( $className ) {
	$start = microtime( true );
	$tmp   = $className;

	// remove left \ char
	if ( $className[0] === '\\' ) {
		$className = substr( $className, 1 );
	}

	// we just need to autoload classes from Pagebox namespace
	if ( substr_compare( $className, 'Pagebox', 0, 7 ) !== 0 ) {
		return;
	}

	$class = str_replace( 'pagebox\\', '', strtolower( $className ) );

	$lastDash = strrpos( $class, '\\' );
	if ( $lastDash ) {
		$p            = PAGEBOX_AUTOLOAD_DIRECTORY_PATH . substr( $class, 0, $lastDash ++ ) . DIRECTORY_SEPARATOR;
		$n            = substr( $class, $lastDash ) . '.php';
		$abstractPath = $p . 'abstract-' . $n;
		$classPath    = $p . 'class-' . $n;
	} else {
		$abstractPath = PAGEBOX_AUTOLOAD_DIRECTORY_PATH . 'abstract-' . $class . '.php';
		$classPath    = PAGEBOX_AUTOLOAD_DIRECTORY_PATH . 'class-' . $class . '.php';
	}

	$c = microtime( true );
	echo '</pre>';

	// check for class-{$name}
	if ( is_file( $classPath ) ) {
		require $classPath;
	}

	// check for abstract-{$name}
	if ( is_file( $abstractPath ) ) {
		require $abstractPath;
	}

	echo '<pre>';
	printf( "%s: %.4fms %.4fms", $tmp, $c - $start, microtime( true ) - $start );
	echo '</pre>';
}

spl_autoload_register( 'autoload' );

/* Mustache autoloader */
require_once( PAGEBOX_DIR . 'src/libs/Mustache/Autoloader.php' );
Mustache_Autoloader::register();