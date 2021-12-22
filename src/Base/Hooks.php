<?php
/**
 * Hooks functionality for the plugin
 *
 * Run hook handlers
 *
 * @package           starter-kit-plugin
 * @author            SolidBunch
 */

namespace StarterKitPlugin\Base;

use StarterKitPlugin\Handlers;

defined( 'ABSPATH' ) || exit;

class Hooks {

	public static function runHooks() {

		/************************************
		 *            Activation
		 ************************************/

		register_activation_hook( STARTER_KIT_PLUGIN_DIR, [ Handlers\PluginActivation::class, '_activate' ] );
		register_deactivation_hook( STARTER_KIT_PLUGIN_DIR, [ Handlers\PluginActivation::class, '_deactivate' ] );


		/************************************
		 *            Frontend
		 ************************************/

		// load front assets
		add_action( 'wp_enqueue_scripts', [ Handlers\Front::class, 'load_front_styles' ] );
		add_action( 'wp_enqueue_scripts', [ Handlers\Front::class, 'load_front_scripts' ] );

	}
}
