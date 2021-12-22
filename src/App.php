<?php
/**
 * Application Singleton
 *
 * @package           starter-kit-plugin
 * @author            SolidBunch
 */

namespace StarterKitPlugin;

use StarterKitPlugin\Base\Hooks;

defined( 'ABSPATH' ) || exit;

final class App extends AbstractSingleton {
	
	private array $config;
	
	/**
	 * Run the plugin
	 *
	 * @param array $config
	 */
	public function run( array $config ) {
		
		// Load config
		$this->config = $config;
		
		// Main Hooks functionality for the plugin
		Hooks::runHooks();
		
	}
	
	
	public function getConfig(): array {
		return $this->config;
	}
	
}
