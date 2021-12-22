<?php
/**
 * Starter Kit Plugin
 *
 * @package           starter-kit-plugin
 * @author            SolidBunch
 * @link              https://github.com/solidbunch/starter-kit-plugin
 * @license           https://github.com/solidbunch/starter-kit-plugin/blob/master/LICENSE.md MIT
 *
 * @wordpress-plugin
 * Plugin Name:       Starter Kit Plugin
 * Plugin URI:        https://github.com/solidbunch/starter-kit-plugin
 * Description:       WordPress starter plugin with a modern development stack for launching projects faster and easily
 * Version:           1.4.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            SolidBunch
 * Author URI:        https://solidbunch.com
 * Text Domain:       starter-kit-plugin
 * Domain Path:       /languages
 * License:           MIT
 * License URI:       https://github.com/solidbunch/starter-kit-plugin/blob/master/LICENSE.md
 */

use StarterKitPlugin\App;
use StarterKitPlugin\Helper\Utils;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

//define plugin path and url without slash
define( 'STARTER_KIT_PLUGIN_DIR', __DIR__ );
define( 'STARTER_KIT_PLUGIN_FILE', __FILE__ );
define( 'STARTER_KIT_PLUGIN_URL', plugins_url( '', __FILE__ ) );

if ( PHP_VERSION_ID < 70400 ) {
	wp_die( sprintf( __( 'Starter Kit Plugin require at least PHP 7.4.0 ( You are using PHP %s ) ' ), PHP_VERSION ) );
}

// Helper functions for develop
require_once STARTER_KIT_PLUGIN_DIR . '/dev.php';

// Autoload
require_once STARTER_KIT_PLUGIN_DIR . '/autoload.php';

// Run App Singleton
$app    = App::getInstance();
$config = apply_filters( 'starter-kit-plugin/config', require STARTER_KIT_PLUGIN_DIR . '/config/config.php' );

try {
	$app->run( $config );
} catch ( Throwable $throwable ) {
	//Utils::setErrorHandler();
	Utils::errorHandler( $throwable );
}