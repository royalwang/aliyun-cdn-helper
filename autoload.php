<?php
/**
 * An example of a project-specific implementation.
 *
 * After registering this autoload function with SPL, the following line
 * would cause the function to attempt to load the \Foo\Bar\Baz\Qux class
 * from /path/to/project/src/Baz/Qux.php:
 *
 *      new \Foo\Bar\Baz\Qux;
 *
 * @param string $class The fully-qualified class name.
 *
 * @return void
 */
defined( 'ALIYUN_CDN_PATH' ) OR exit();
require( ALIYUN_CDN_PATH . '/vendor/autoload.php' );
spl_autoload_register( function ( $class ) {
	$auto_load_class = array(
		'CDN\\WP\\' => '/src/'
	);
	foreach ( $auto_load_class as $prefix => $base_dir ) {
		$len = strlen( $prefix );
		if ( strncmp( $prefix, $class, $len ) == 0 ) {
			$relative_class = substr( $class, $len );
			$file           = ALIYUN_CDN_PATH . $base_dir . str_replace( '\\', '/', $relative_class ) . '.php';
			if ( file_exists( $file ) ) {
				require $file;
			}
		}
	}
} );
