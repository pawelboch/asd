<?php
/**
 * @author   Piotr Grzesiak
 * @since    1.0.0
 *
 * @package  pagebox
 */

namespace Pagebox;

use Leafo\ScssPhp\Compiler;
use Pagebox\Sass\Console;
use Pagebox\Sass\Permission;
use WPG_Pagebox;

class Sass {

	private $pagebox;
	private $console = '';
	private $template_directory;
	private $debug = false;
	private $last_post_id = 0;

	public function __construct( WPG_Pagebox $pagebox ) {
		$this->pagebox = $pagebox;
		$this->template_directory = get_template_directory();

		$this->console = Console::getInstance();

		add_action( 'admin_bar_menu', array( $this, 'addMenuBar' ), 999 );
		add_action( 'admin_menu', array( $this, 'addAdminPage' ) );
		add_action( 'admin_print_scripts', array( $this, 'addStyles' ) );

		if ( ! wp_next_scheduled( 'pagebox-sass-permission-test' ) ) {
			wp_schedule_event( time(), 'daily', 'pagebox-sass-permission-test' );
		}

		add_action( 'pagebox-sass-permission-test', array( $this, 'cronTask' ));
	}

	public function cronTask() {
		if( ! is_admin() ) return;
		$this->debug = false;
		update_option( 'pagebox-sass-permission-test', $this->permissionsTest() );
	}

	public function getPermissionTestStatus() {
		return (bool) get_option( 'pagebox-sass-permission-test', false );
	}

	public function addStyles() {
		wp_enqueue_style( 'pagebox-sass', plugin_dir_url( __DIR__ ) . 'src/public/css/sass.css');
	}

	public function addMenuBar( $wp_admin_bar ) {
		if ( !is_super_admin() || !is_admin_bar_showing() )
			return;

		$class = '';
		if( $this->getPermissionTestStatus() === false ) {
			$class = ' blink-error';
		}

		$wp_admin_bar->add_node( array(
			'id'    => 'pagebox_sass_menu',
			'title' => '<span class="ab-icon dashicons dashicons-update" style="padding:6px 0;font-size:20px"></span><span class="ab-label">Recompile Scss</span>',
			'href'  => admin_url( 'admin.php?page=pagebox-sass-compiler&task=recompile' ),
			'meta'  => array(
				'class' => 'pagebox-sass-compiler-bar' . $class,
				'onclick' => 'return confirm("Are You sure?");'
			)
		));
		$wp_admin_bar->add_node( array(
			'parent' => 'pagebox_sass_menu',
			'id'    => 'pagebox_sass_menu_theme',
			'title' => 'Recompile theme',
			'href'  => admin_url( 'admin.php?page=pagebox-sass-compiler&task=recompile_theme' ),
			'meta'  => array(
				'onclick' => 'return confirm("Are You sure?");'
			)
		));
		$wp_admin_bar->add_node( array(
			'parent' => 'pagebox_sass_menu',
			'id'    => 'pagebox_sass_menu_modules',
			'title' => 'Recompile modules',
			'href'  => admin_url( 'admin.php?page=pagebox-sass-compiler&task=recompile_modules' ),
			'meta'  => array(
				'onclick' => 'return confirm("Are You sure?");'
			)
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

	public function getModulesPathsArray() {
		static $cache = null;
		if( $cache === null ) {
			$cache = glob( $this->template_directory . '/pagebox/modules/*', GLOB_ONLYDIR );
		}
		return $cache;
	}

	private function permissionsTest() {
		$path = $this->template_directory;
		$test = true;

		if( $this->debug ) {
			$this->console->time('permission')->addHeader( 'Permission tests' );
		}

		$file = $path . '/assets/stylesheets/css/';
		if( Permission::dir( $file ) ) {
			if( $this->debug ) $this->console->addSuccess( $file, 'is writable.' );
		} else {
			if( $this->debug ) $this->console->addError( $file, 'is not writable.' );
			$test = false;
		}

		function checkFile( Console $console, $debug, $file, $test ) {
			$p = Permission::file( $file );
			if( $p === 1 ) {
				if( $debug ) $console->addSuccess( $file, 'is exist and writable.' );
			} else if( $p == -1 ) {
				if( $debug ) $console->addWarning( $file, 'is not exists jet.' );
			} else {
				if( $debug ) $console->addError( $file, 'is not writable.' );
				$test = false;
			}
			return $test;
		}

		$test = checkFile( $this->console, $this->debug, $path . '/assets/stylesheets/css/style.css', $test );
		$test = checkFile( $this->console, $this->debug, $path . '/assets/stylesheets/css/bootstrap.css', $test );
		$test = checkFile( $this->console, $this->debug, $path . '/assets/stylesheets/css/style.min.css', $test );

		foreach( $this->getModulesPathsArray() as $dir ) {
			$dir_test = true;
			if( ! Permission::dir( $dir ) ) {
				if( $this->debug ) $this->console->addError( $dir, 'is not writable.' );
				$dir_test = false;
			}
			if( ! Permission::dir( $dir . '/css' ) ) {
				if( $this->debug ) $this->console->addError( $dir . '/css', 'is not writable.' );
				$dir_test = false;
			}
			if( ! Permission::dir( $dir . '/scss' ) ) {
				if( $this->debug ) $this->console->addError( $dir . '/scss', 'is not writable.' );
				$dir_test = false;
			}
			$p = Permission::file( $dir . '/compiler.map' );
			if( $p == -1 ) {
				if( $this->debug ) $this->console->addWarning( $dir . '/compiler.map', 'is not exists jet.' );
			} else if( $p === 0 ) {
				if( $this->debug ) $this->console->addError( $dir . '/compiler.map', 'is not writable.' );
				$dir_test = false;
			}
			$p = Permission::file( $dir . '/css/module.css' );
			if( $p == -1 ) {
				if( $this->debug ) $this->console->addWarning( $dir . '/css/module.css', 'is not exists jet.' );
			} else if( $p === 0 ) {
				if( $this->debug ) $this->console->addError( $dir . '/css/module.css', 'is not writable.' );
				$dir_test = false;
			}
			$p = Permission::file( $dir . '/scss/_module-variables.scss' );
			if( $p == -1 ) {
				if( $this->debug ) $this->console->addWarning( $dir . '/scss/_module-variables.scss', 'is not exists jet.' );
			} else if( $p === 0 ) {
				if( $this->debug ) $this->console->addError( $dir . '/scss/_module-variables.scss', 'is not writable.' );
				$dir_test = false;
			}
			if( $dir_test ) {
				if( $this->debug ) $this->console->addSuccess( $dir, 'is writable.' );
			} else {
				$test = false;
			}
		}

		if( $this->debug ) $this->console->timeEnd('permission');
		return $test;
	}

	private function compileTo( Compiler $sass, $from, $to ) {
		if( $this->debug ) $this->console->time('compile')->addHeader( 'Compile ' . str_replace( $this->template_directory, '', $from ));
		if( ! is_file( $from ) ) {
			if( $this->debug ) $this->console->addError( $from, 'not exists!' );
			return;
		}
		if( ! is_readable( $from ) ) {
			if( $this->debug ) $this->console->addError( $from, 'is not readable!' );
			return;
		}
		$source = file_get_contents( $from );
		if( $source === false ) {
			if( $this->debug ) $this->console->addError( $from, 'read error!' );
			return;
		}
		$error = false;
		try {
			ob_start();
			$output = $sass->compile( $source );
			$error_output = ob_get_clean();
		} catch ( \Exception $e ) {
			$error = true;
			if( $this->debug ) $this->console->addStyled( $e->getMessage(), 'error' );
		}
		if( $error_output ) {
			foreach( explode( "\n", $error_output ) as $warning ) {
				if( strlen( $warning) > 0 )
					if( $this->debug ) $this->console->addStyled( $warning, 'warning' );
			}
		}
		if( $error ) {
			if( $this->debug ) $this->console->addStyled( '<span>Compilation failed.</span>', 'error' );
		} else {
			if( $this->debug ) $this->console->addStyled( '<span>Compilation success.</span>', 'success' );
			if( file_put_contents( $to, $output, LOCK_EX )) {
				if( $this->debug ) $this->console->addSuccess( $to, 'saved successfully.' );
			} else {
				if( $this->debug ) $this->console->addError( $to, 'error when saving!' );
			}
		}
		if( $this->debug ) $this->console->timeEnd('compile');
	}

	public function compileTheme() {
		$path = $this->template_directory;
		$sass = $this->getCompiler();
		$sass->addImportPath( $path . '/assets/stylesheets/scss' );
		$this->compileTo(
			$sass,
			$path . '/assets/stylesheets/scss/bootstrap.scss',
			$path . '/assets/stylesheets/css/bootstrap.css'
		);
		$this->compileTo(
			$sass,
			$path . '/assets/stylesheets/scss/style.scss',
			$path . '/assets/stylesheets/css/style.css'
		);
	}

	public function compileModules() {
		$path = $this->template_directory;

		$this->console->time('clear_cache')->addHeader('Clear compiler cache');
		foreach( $this->getModulesPathsArray() as $dir ) {
			$file = $dir . '/compiler.map';
			if( is_file( $file )) {
				if( unlink( $file )) {
					$this->console->addSuccess( $file, 'removed successfully.' );
				} else {
					$this->console->addError( $file, 'error when removing!' );
				}
			} else {
				$this->console->addWarning( $file, 'not exists.' );
			}
		}
		$this->console->timeEnd('clear_cache');

		$this->console->time('search')->addHeader('Search for posts and pages');
		$settings = get_option( 'pagebox_settings' );
		$posts = get_posts( array(
			'posts_per_page'    => -1,
			'post_type'         => $settings['post_types'],
			'post_status'       => 'any'
		));
		$this->console->addStyled( 'Finded <span>' . count( $posts ) . '</span>', 'success' )->timeEnd('search');

		foreach( $posts as $post ) {
			$this->console->time('regenerate');
			$modules = get_post_meta( $post->ID, 'pagebox_modules' )[0];
			if( is_array( $modules )) {
				$this->last_post_id = $post->ID;
				$this->console->addHeader( sprintf('%s (%d): "%s"', ucfirst($post->post_type), $post->ID, $post->post_title ) );
				$this->regenerateCompilerCache( $modules );
				$this->console->timeEnd('regenerate');
			}
		}

		$this->console->time('module_variables')->addHeader( 'Generate module variables file for Sass' );
		foreach( $this->getModulesPathsArray() as $dir ) {
			$this->saveModuleVariables( $dir, $this->loadMap( $dir ));
		}
		$this->console->timeEnd('module_variables');

		$sass = $this->getCompiler();
		foreach( $this->getModulesPathsArray() as $dir ) {
			$sass->setImportPaths( array(
				$dir . '/scss',
				$path . '/assets/stylesheets/scss'
			));
			$this->compileTo(
				$sass,
				$dir . '/scss/module.scss',
				$dir . '/css/module.css'
			);
		}
	}

	public function router( $task ) {
		switch( $task ) {
			case 'recompile':
				$this->compileTheme();
				$this->compileModules();
				break;
			case 'recompile_theme':
				$this->compileTheme();
				break;
			case 'recompile_modules':
				$this->compileModules();
				break;
			case 'minify':

				break;
		}
	}

	public function sassCompilePage() {
		$this->debug = true;
		$this->console->time('all');
		$permission_test = $this->permissionsTest();

		if( $permission_test ) {
			if ( isset( $_GET['task'] ) && in_array( $_GET['task'], array(
					'recompile',
					'recompile_theme',
					'recompile_modules',
					'minify'
				) )
			) {
				$this->console->clear()->addStyled( 'Permission tests: <span>OK</span>', 'success' );
				$this->router( $_GET['task'] );
			}
		}
		$this->console->addHeader('Summary')->timeEnd('all');
		$this->debug = false;
		include( plugin_dir_path( __DIR__ ) . 'src/public/partials/sass/compiler.php' );
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
		$file = $path . DIRECTORY_SEPARATOR . 'compiler.map';
		file_put_contents( $file, serialize( $array ), LOCK_EX );
	}

	public function saveModuleVariables( $path, array $map ) {
		$path = $path . '/scss/_module-variables.scss';
		if( file_put_contents(
			$path,
			$this->parseMapToScss( $map ),
			LOCK_EX
		)) {
			$this->console->addSuccess( $path, 'saved successfully.' );
		} else {
			$this->console->addError( $path, 'error when saving!' );
		}
	}

	public function getCompiler() {
		require_once( 'libs/scssphp/scss.inc.php' );
		$scss = new \Leafo\ScssPhp\Compiler();
		$scss->setNumberPrecision( 10 );
		$scss->setEncoding( 'UTF-8' );
		$scss->setFormatter( 'Leafo\ScssPhp\Formatter\Expanded' );
		return $scss;
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
		return $value ? $this->autoQuote( $value ) : null;
	}

	private function getPostID() {
		return $this->last_post_id > 0 ? $this->last_post_id : get_the_ID();
	}

	public function getVariablesFromModule( $module, $data ) {
		if( $module !== false ) {

			$ID = $this->getPostID();
			$variables = array(
				'_comment' => ucfirst( get_post_type( $ID )) . '('.$ID.'): ' . get_the_title( $ID )
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
							$variables[ $name ] = $this->filter( $field, null );
						}
					} else if( $field['type'] === 'repeater' ) {
						if( isset( $field['fields'] ) && is_array( $field['fields'] )) {
							foreach( $field['fields'] as $field2 ) {
								if( isset( $field2['sass'] )) {

									$name = $field['name'] . '-' . (is_string( $field2['sass'] ) ? $field2['sass'] : $field2['name']);
									$tmp = array();

									if( isset( $data->settings->{ $field['name'] } )) {
										foreach( $data->settings->{ $field['name'] } as $f ) {
											if( is_object( $f ) && property_exists( $f, $field2['name'] )) {
												$val = $this->filter( $field2, $f->{$field2['name']} );
											} else {
												$val = null;
											}
											$tmp[] = $val ? $val : "''";
										}
									}
									$variables[ $name ] = '(' . implode( ', ', $tmp ) . ')';
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
			if( !is_array( $value ) && !is_object( $value ) && !is_null( $value )) {
				$out .= $offset . ($flat ? '' : '$') . $key . ': ' . ( $flat ? $value : $this->autoQuote( $value )) . ($flat ? ',' : ';') . PHP_EOL;
			} else if( $key === 'ids' && is_array( $value )) {
				$out .= '$ids: (' . PHP_EOL;
				foreach( $value as $id => $values ) {
					if( isset( $values['_comment']) ) {
						$out .= "\t// " . $values['_comment'] . PHP_EOL;
						unset( $values['_comment'] );
					}
					$out .= "\t" . $id . ': (' . PHP_EOL;
					$out .= $this->parseMapToScss( $values, "\t\t", true );
					$out .= "\t" . '),' . PHP_EOL;
				}
				$out .= ');' . PHP_EOL;
			}
		}
		return $out;
	}

	public function json_safe_decode( $string ) {
		if( is_array( $string ) || is_object( $string ) ) {
			return $string;
		}
		$decoded = json_decode( $string );
		if( json_last_error() !== JSON_ERROR_NONE ) {
			$decoded = json_decode( stripslashes( $string ));
		}
		return $decoded;
	}

	public function regenerateCompilerCache( array $sections ) {
		foreach( $sections as $section ) {
			foreach ( $section as $data ) {
				$data = $this->json_safe_decode( $data );
				$module = $this->pagebox->modules->get_module( $data->slug );
				if( $module ) {
					$this->console->addStyled( $data->slug . ' <span>module added.</span>', 'success' );
					$path = $module->get_path();

					$map = $this->loadMap( $path );
					$map['module'] = '.pagebox-' . $data->slug . '-module';
					$map['template-url'] = get_template_directory_uri();
					$map['ids'][ 'pagebox-module-' . $data->id ] = $this->getVariablesFromModule( $module, $data );
					$this->saveMap( $path, $map );
				}
			}
		}
	}

	public function compile( array $sections ) {
		foreach( $sections as $section ) {
			foreach ( $section as $data ) {
				$data = $this->json_safe_decode( $data );
				$module = $this->pagebox->modules->get_module( $data->slug );
				if( $module ) {
					$path = $module->get_path();

					$map = $this->loadMap( $path );
					$map['module'] = '.pagebox-' . $data->slug . '-module';
					$map['template-url'] = get_template_directory_uri();
					$map['ids'][ 'pagebox-module-' . $data->id ] = $this->getVariablesFromModule( $module, $data );
					$this->saveMap( $path, $map );
					$this->saveModuleVariables( $path, $map );
				}
			}
		}
	}

}