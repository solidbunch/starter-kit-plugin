<?php

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

// nice dump function

if ( ! function_exists( 'wp_dump' ) ) {
	function wp_dump( ...$params ) {
		echo '<pre style="text-align: left; font-family: \'Courier New\'; font-size: 12px;line-height: 20px;background: #efefef;border: 1px solid #777;border-radius: 5px;color: #333;padding: 10px;margin:0;overflow: auto;overflow-y: hidden;">';
		var_dump( $params );
		echo '</pre>';
	}
}


// logger

if ( ! function_exists( 'wlog' ) ) {
	function wlog( $var, $desc = ' >> ', $clear_log = false ) {
		$upload     = wp_upload_dir();
		$upload_dir = $upload['basedir'];
		$upload_dir .= '/starter_kit_plugin';
		
		if ( ! file_exists( $upload_dir ) ) {
			$upload_dir_created = mkdir( $upload_dir, 0775, true );
			if ( ! $upload_dir_created ) {
				return false;
			}
		}
		
		$log_file_destination = $upload_dir . '/starter_kit_plugin.log';
		
		if ( $clear_log || ! file_exists( $log_file_destination ) ) {
			file_put_contents( $log_file_destination, '' );
		}
		error_log( '[' . gmdate( 'H:i:s' ) . ']-------------------------' . PHP_EOL, 3, $log_file_destination );
		error_log( '[' . gmdate( 'H:i:s' ) . ']' . $desc . ' : ' . print_r( $var, true ) . PHP_EOL, 3, $log_file_destination );
	}
}
