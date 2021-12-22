<?php
/**
 * Starter Kit Plugin Uninstall
 *
 * Uninstalling Starter Kit Plugin and deleting database data.
 *
 * @package           starter-kit-plugin
 * @author            SolidBunch
 */

use StarterKitPlugin\Helper\Utils;

defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

//define plugin path and url without slash
define( 'STARTER_KIT_PLUGIN_DIR', __DIR__ );
define( 'STARTER_KIT_PLUGIN_FILE', __FILE__ );
define( 'STARTER_KIT_PLUGIN_URL', plugins_url( '', __FILE__ ) );

// Autoload
require_once STARTER_KIT_PLUGIN_DIR . '/autoload.php';

$settings_prefix = Utils::getConfigSetting( 'settings_prefix', '', true );

// Add "_" to settings prefix if we use Carbon Fields
//$settings_prefix = "_{$settings_prefix}";

/**
 * Delete plugin options from database
 *
 * @param string $settings_prefix
 */
function uninstall_delete_data( string $settings_prefix ) {
	
	global $wpdb;

	$plugin_options = $wpdb->get_results( "SELECT option_name FROM  {$wpdb->prefix}options WHERE option_name LIKE '{$settings_prefix}%' " );
	
	foreach ( $plugin_options as $plugin_option ) {
		delete_option( $plugin_option->option_name );
	}
}

if ( is_multisite() ) {
	$sites = get_sites();
	
	foreach ( $sites as $site ) {
		switch_to_blog( $site->blog_id );
		uninstall_delete_data( $settings_prefix );
		restore_current_blog();
	}
} else {
	uninstall_delete_data( $settings_prefix );
}

wp_cache_flush();