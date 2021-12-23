<?php
/**
 * Utilities
 *
 * Helper functions
 *
 * @package           starter-kit-plugin
 * @author            SolidBunch
 */

namespace StarterKitPlugin\Helper;

use StarterKitPlugin\App;

defined( 'ABSPATH' ) || exit;

class Utils {

	/**
	 * Get settings from App configuration array
	 *
	 * @param $name
	 * @param $default
	 * @param bool $direct
	 *
	 * @return mixed
	 */
	public static function getConfigSetting( $name, $default = null, $direct = false ) {
		$parts = explode( '/', $name );

		$config = $direct
			? apply_filters( 'starter-kit-plugin/config', require STARTER_KIT_PLUGIN_DIR . '/config/config.php' )
			: App::getInstance()->getConfig();

		if ( ! isset( $config[ $parts[0] ] ) ) {
			return $default;
		}

		$value = $config[ array_shift( $parts ) ];

		foreach ( $parts as $part ) {
			if ( is_array( $value ) && isset( $value[ $part ] ) ) {
				$value = $value[ $part ];
			} else {
				return $default;
			}
		}

		return $value;
	}
	
	public static function errorHandler( $throwable ) {
	
		$error_message = 'Starter Kit Plugin PHP error: ' . $throwable->getMessage();
		$error_message .=  ' in ' . $throwable->getFile();
		$error_message .=  ' on line ' . $throwable->getLine();
		$error_message .=  PHP_EOL . $throwable->getTraceAsString ();
		
		error_log( $error_message );
		
		$errors_silent = self::getConfigSetting( 'errors_silent', '', true );
	
		if ( empty( $errors_silent ) ) {
			wp_die( __( 'Starter Kit Plugin Error. Look to log file for details.' ) );
		}
	}

}
