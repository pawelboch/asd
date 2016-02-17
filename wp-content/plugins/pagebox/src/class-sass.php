<?php
/**
 * @author   Piotr Grzesiak
 * @since    1.0.0
 * 
 * @package  pagebox
 */

namespace Pagebox;

use WPG_Pagebox;

class Sass {

	private $pagebox;

	public function __construct( WPG_Pagebox $pagebox ) {
		$this->pagebox = $pagebox;
	}

	private function auto_quote( $value ) {
		if( is_numeric( $value )) {
			return $value;
		} else if( ! preg_match( "/^[\\w-#&]*$/", $value ) || strlen( $value ) == 0 ) {
			return "'" . $value . "'";
		} else {
			return $value;
		}
	}

	private function filter( $fields, $value ) {
		if( is_array( $fields ) && isset( $fields['sass_filter'] ) && is_callable( $fields['sass_filter'] )) {
			return $fields['sass_filter']( $value );
		}
		return $value;
	}

	private function parse_variables( array $variables ) {
		$out = <<<EOD
/**
 * !!! Attention !!!
 * This document is generated automatically when post is updated.
 * Content will be overwritten.
 **/
EOD;
		$out .= PHP_EOL . PHP_EOL;
		foreach( $variables as $key => $value ) {
			if( isset( $value ) && is_string( $value )) {
				$out .= '$' . $key . ': ' . $this->auto_quote( $value ) . ';' . PHP_EOL;
			} else if( is_array( $value )) {
				$value = array_map( function( $v ) {
					return $this->auto_quote( $v );
				}, $value);
				$out .= '$' . $key . ': ' . implode( ', ', $value ) . ';' . PHP_EOL;
			}
		}
		return $out;
	}

	public function compile( $modules ) {
		foreach( current( $modules ) as $data ) {
			$data = json_decode( stripslashes( $data ));
			$module = $this->pagebox->modules->get_module( $data->slug );

			if( $module !== false ) {

				$path = $module->get_path();
				$variables = array(
					'module-name'   => 'pagebox-' . $data->slug . '-module',
					'template-url'  => get_template_directory_uri()
				);

				$config = $module->get_config( 'fields' );
				if( $config !== false ) {
					foreach( $config as $field ) {
						if( isset( $field['sass'] )) {

							$name = is_string( $field['sass'] ) ? $field['sass'] : $field['name'];

							if( isset( $data->settings->{ $field['name'] } ) && ! empty( $data->settings->{ $field['name'] } )) {
								$variables[ $name ] = $this->filter( $field, $data->settings->{ $field['name'] } );
							} else if( isset( $field['value'] )) {
								$variables[ $name ] = $this->filter( $field, $field['value'] );
							} else {
								$variables[ $name ] = null;
							}
						} else if( $field['type'] === 'repeater' ) {
							if( isset( $field['fields'] ) && is_array( $field['fields'] )) {
								foreach( $field['fields'] as $field2 ) {
									if( isset( $field2['sass'] )) {

										$name = $field['name'] . '-' . (is_string( $field2['sass'] ) ? $field2['sass'] : $field2['name']);
										$variables[ $name ] = array();

										if( isset( $data->settings->{ $field['name'] } )) {
											foreach( $data->settings->{$field['name']} as $f ) {
												$variables[ $name ][] = isset( $f->{ $field2['name'] } ) ? $this->filter( $field2, $f->{ $field2['name'] }) : null;
											}
										}
									}
								}
							}
						}
					}
				}

				file_put_contents(
					$path . DIRECTORY_SEPARATOR . 'scss' . DIRECTORY_SEPARATOR . '_module-variables.scss',
					$this->parse_variables( $variables )
				);
			}
		}
	}

}