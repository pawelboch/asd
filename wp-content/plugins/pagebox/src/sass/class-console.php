<?php

namespace Pagebox\Sass;

/**
 * Class Console
 * @package Pagebox\Sass
 * @author Piotr Grzesiak
 */
class Console {

	/**
	 * @var Console|null Singleton.
	 */
	private static $_instance = null;

	/**
	 * @var array Console lines.
	 */
	private $_lines = array();

	/**
	 * @var array Time breakpoints.
	 */
	private $_times = array();

	/**
	 * @var int Template directory path length.
	 */
	private $_theme_path_length = 0;

	/**
	 * Console constructor.
	 */
	private function __construct() {
		$this->_theme_path_length = strlen( get_template_directory() );
	}

	/**
	 * Singleton
	 * @return Console
	 */
	public static function getInstance() {
		if( self::$_instance === null ) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}

	/**
	 * Add raw html to console array.
	 * @param string $string One line HTML code without end of line
	 * @return Console
	 */
	private function push( $string ) {
		$this->_lines[] = $string;
		return $this;
	}

	/**
	 * Add vertical space.
	 * @return Console
	 */
	public function space() {
		if( isset( $this->_lines[0] )) {
			$this->push('');
		}
		return $this;
	}

	/**
	 * Clear console.
	 */
	public function clear() {
		$this->_lines = array();
		return $this;
	}

	/**
	 * Return all console lines.
	 * @return string Console HTML
	 */
	public function getHtml() {
		return implode( '<br>', $this->_lines );
	}

	/**
	 * Add time breakpoint.
	 * @param string $key Time breakpoint
	 *
	 * @return Console
	 */
	public function time( $key ) {
		$this->_times[ $key ] = microtime( true );
		return $this;
	}

	/**
	 * Print time breakpoint in console if exists.
	 * @param string $key Time breakpoint
	 *
	 * @return $this
	 */
	public function timeEnd( $key ) {
		if( isset( $this->_times[ $key ] )) {
			$this->push( sprintf( 'Total in %.2fs', microtime( true ) - $this->_times[ $key ]));
		}
		return $this;
	}

	/**
	 * Add raw html.
	 * @param string $text Html string
	 *
	 * @return Console
	 */
	public function add( $text ) {
		return $this->push( $text );
	}

	/**
	 * Add header, text with underline.
	 * @param string $text Header text
	 *
	 * @return Console
	 */
	public function addHeader( $text ) {
		return $this->space()->push( '<u>' . $text . ':</u>' );
	}

	/**
	 * Add styled line.
	 * @param string $text Text
	 * @param string $class Text class
	 *
	 * @return Console
	 */
	public function addStyled( $text, $class ) {
		return $this->push( '<span class="'.$class.'">' . $text . '</span>' );
	}

	/**
	 * Print colorized file info.
	 * @param string $file File path
	 * @param string $text Text result
	 * @param string $class CSS style
	 *
	 * @return Console
	 */
	public function addFile( $file, $text, $class = '' ) {
		return $this->push( '<span class="'.$class.'"><span>&gt;&gt; </span>' .substr( $file, $this->_theme_path_length ). ' <span>' . $text . '</span></span>' );
	}

	/**
	 * Print success file info.
	 * @param string $file File path
	 * @param string $text Text result
	 *
	 * @return Console
	 */
	public function addSuccess( $file, $text ) {
		return $this->addFile( $file, $text, 'success' );
	}

	/**
	 * Print error file info.
	 * @param string $file File path
	 * @param string $text Text result
	 *
	 * @return Console
	 */
	public function addError( $file, $text ) {
		return $this->addFile( $file, $text, 'error' );
	}

	/**
	 * Print warning file info.
	 * @param string $file File path
	 * @param string $text Text result
	 *
	 * @return Console
	 */
	public function addWarning( $file, $text ) {
		return $this->addFile( $file, $text, 'warning' );
	}

}