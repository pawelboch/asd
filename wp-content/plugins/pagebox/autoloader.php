<?php
/**
 * autoloader
 * 
 * @since 1.0.0
 *
 * @package pagebox
 */

function autoload( $className ) {
	$start = microtime( true );
	$tmp = $className;
	// remove left \ char
	$className = ltrim($className, '\\');

	// we just need to autoload classes from Pagebox namespace
	if (substr_compare($className, 'Pagebox', 0, 7) !== 0) {
		return;
	}

	$classElements = explode('\\', $className);
	$className     = strtolower(array_pop($classElements));

	// remove Pagebox prefix
	// e.g. Pagebox\Elements\Template will point to src/elements/template.php
	// not /src/pagebox/elements/template.php
	array_shift($classElements);

	// dirname(__FILE__) should point to mail plugin directory
	$path = dirname(__FILE__) . '/src/';

	// convert namespaces into directory
	$classPath = strtolower(implode(DIRECTORY_SEPARATOR, $classElements));

	// do we need trailing slash?
	if ($classPath) {
		$classPath .= '/';
	}

	$abstractPath = $path . $classPath . 'abstract-' . $className . '.php';
	$classPath    = $path . $classPath . 'class-' . $className . '.php';

	// check for class-{$name}
	if (file_exists($classPath)) {
		require $classPath;
	}

	// check for abstract-{$name}
	if (file_exists($abstractPath)) {
		require $abstractPath;
	}


	echo '<pre>'; printf("%s: %.4fms", $tmp, microtime( true ) - $start ); echo '</pre>';
}

spl_autoload_register('autoload');

/* Mustache autoloader */
require_once( PAGEBOX_DIR . 'src/libs/Mustache/Autoloader.php' );
Mustache_Autoloader::register();