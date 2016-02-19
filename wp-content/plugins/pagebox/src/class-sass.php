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

		add_action( 'admin_bar_menu', array( $this, 'addMenuBar' ), 999 );
		add_action( 'admin_menu', array( $this, 'addAdminPage' ) );
	}

	public function addMenuBar( $wp_admin_bar ) {
		if ( !is_super_admin() || !is_admin_bar_showing() )
			return;

		$wp_admin_bar->add_node( array(
			'id'    => 'pagebox_sass_menu',
			'title' => '<span class="ab-icon dashicons dashicons-update" style="padding:6px 0;font-size:20px"></span><span class="ab-label">Recompile Scss</span>',
			'href'  => ''
		));
		$wp_admin_bar->add_node( array(
			'parent' => 'pagebox_sass_menu',
			'id'    => 'pagebox_sass_menu_theme',
			'title' => 'Recompile theme',
			'href'  => ''
		));
		$wp_admin_bar->add_node( array(
			'parent' => 'pagebox_sass_menu',
			'id'    => 'pagebox_sass_menu_modules',
			'title' => 'Recompile modules',
			'href'  => ''
		));
	}

	public function addAdminPage() {
		add_submenu_page(
			'pagebox',
			'Sass Compiler',
			'Sass Compiler',
			'manage_options',
			'pagebox-sass-compiler',
			array( $this, 'sassCompilePage' )
		);
	}

	public function sassCompilePage() {
	?>
	<div class="wrap">

		<h2>Pagebox Sass Compiler</h2>

		<form method="post">
			<p class="submit">
				<input type="submit" name="save" id="save" class="button button-primary" value="Recompile all styles">
				<input type="submit" name="save" id="save" class="button" value="Recompile theme (with bootstrap)">
				<input type="submit" name="save" id="save" class="button" value="Recompile pagebox modules">
			</p>
		</form>

		<textarea readonly style="width:100%;font-size:12px;font-family:monospace;background:#23282d;color:#eee" rows="24">
Running "watch" task
Waiting...
>> File "pagebox\modules\title_three_sections\scss\_module-variables.scss" changed.
>> File "pagebox\modules\two_images\scss\_module-variables.scss" changed.
>> File "pagebox\modules\tables\scss\_module-variables.scss" changed.
>> File "pagebox\modules\contact\scss\_module-variables.scss" changed.
>> File "pagebox\modules\news_insights\scss\_module-variables.scss" changed.
>> File "pagebox\modules\slider\scss\_module-variables.scss" changed.
>> File "pagebox\modules\text\scss\_module-variables.scss" changed.
		</textarea>

	</div>
	<?php
	}

	public function loadMap( $path ) {
		$file = $path . DIRECTORY_SEPARATOR . 'compiler.map';
		if( is_file( $file )) {
			return unserialize( file_get_contents( $file ));
		}
		return array(
			'module'        => '',
			'template-url'  => '',
			'ids'           => array()
		);
	}

	public function saveMap( $path, array $array ) {
		file_put_contents( $path . DIRECTORY_SEPARATOR . 'compiler.map', serialize( $array ), LOCK_EX );
	}

	public function saveModuleVariables( $path, array $map ) {
		file_put_contents(
			$path . DIRECTORY_SEPARATOR . 'scss' . DIRECTORY_SEPARATOR . '_module-variables.scss',
			$this->parseMapToScss( $map ),
			LOCK_EX
		);
	}

	public function getCompiler() {
		require_once( 'libs/scssphp/scss.inc.php' );
		return new \Leafo\ScssPhp\Compiler();
	}

	private function autoQuote( $value ) {
		$value = trim( $value );
		if( is_numeric( $value )) {
			return +$value;
		} else if( ! preg_match( "/^[\\w-#&]*$/", $value ) || strlen( $value ) == 0 ) {
			return "'" . $value . "'";
		} else {
			return $value;
		}
	}

	private function filter( $fields, $value ) {
		if( is_array( $fields ) && isset( $fields['sass_filter'] ) && is_callable( $fields['sass_filter'] )) {
			$value = $fields['sass_filter']( $value );
		}
		return $this->autoQuote( $value );
	}

	public function getVariablesFromModule( $module, $data ) {
		if( $module !== false ) {

			$variables = array();

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
									$tmp = array();

									if( isset( $data->settings->{ $field['name'] } )) {
										foreach( $data->settings->{$field['name']} as $f ) {
											$tmp[] = isset( $f->{ $field2['name'] } ) ? $this->filter( $field2, $f->{ $field2['name'] }) : "''";
										}
									}
									$variables[ $name ] = '(' . implode(', ', $tmp) . ')';
								}
							}
						}
					}
				}
			}
			return $variables;
		}
		return false;
	}

	private function parseMapToScss( array $map, $offset = '', $flat = false ) {
		if( $flat ) {
			$out = '';
		} else {
			$out = <<<EOD
// This document is generated automatically when post is updated.
// Content will be overwritten.
EOD;
			$user = wp_get_current_user();
			$out .= PHP_EOL . '// Generated: ' . date("r") . ' by ' . $user->nickname . PHP_EOL . PHP_EOL;
		}
		foreach( $map as $key => $value ) {
			if( !is_array( $value ) && !is_object( $value )) {
				$out .= $offset . ($flat ? '' : '$') . $key . ': ' . ( $flat ? $value : $this->autoQuote( $value )) . ($flat ? ',' : ';') . PHP_EOL;
			} else if( $key === 'ids' && is_array( $value )) {
				$out .= '$ids: (' . PHP_EOL;
				foreach( $value as $id => $values ) {
					$out .= "\t" . $id . ': (' . PHP_EOL;
					$out .= $this->parseMapToScss( $values, "\t\t", true );
					$out .= "\t" . '),' . PHP_EOL;
				}
				$out .= ');' . PHP_EOL;
			}
		}
		return $out;
	}

	public function compile( array $sections ) {
		foreach( $sections as $section ) {
			foreach ( $section as $data ) {
				$data   = json_decode( stripslashes( $data ) );
				$module = $this->pagebox->modules->get_module( $data->slug );
				$path   = $module->get_path();

				d( $module );
				d( $data );
				d( $path );

				$map = $this->loadMap( $path );
				$map['module'] = '.pagebox-' . $data->slug . '-module';
				$map['template-url'] = get_template_directory_uri();
				$map['ids'][ 'pagebox-module-' . $data->id ] = $this->getVariablesFromModule( $module, $data );
				$this->saveMap( $path, $map );
				$this->saveModuleVariables( $path, $map );

//			try {
//				$scss = $this->getCompiler();
//				$scss->setNumberPrecision( 10 );
//				$scss->setVariables( $variables );
//				$scss->setFormatter('Leafo\ScssPhp\Formatter\Expanded');
//
//				$css = $scss->compile( file_get_contents( $module->get_path() . '/scss/module.scss' ));
//				file_put_contents( $module->get_path() . '/css/module-'.$data->id.'.css', $css );
//			} catch( \Exception $e ) {
//				d( $e->getMessage() );
//			}
			}
		}
		die;
	}

}