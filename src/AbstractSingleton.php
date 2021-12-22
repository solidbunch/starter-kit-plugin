<?php
/**
 * Abstract Class for creating Singleton Classes
 *
 * @package           starter-kit-plugin
 * @author            SolidBunch
 */

namespace StarterKitPlugin;

defined( 'ABSPATH' ) || exit;

abstract class AbstractSingleton {
	
	/**
	 * Call this method to get singleton
	 */
	public static function getInstance() {
		static $instance = false;
		if ( $instance === false ) {
			$instance = new static();
		}
		
		return $instance;
	}
	
	/**
	 * Make constructor private, so nobody can call "new Class".
	 */
	private function __construct() {
	}
	
	/**
	 * Make clone magic method private, so nobody can clone instance.
	 */
	private function __clone() {
	}
}
