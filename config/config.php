<?php
/**
 * Application config
 *
 * Return an array with predefined config values
 *
 * @package           starter-kit-plugin
 * @author            SolidBunch
 */

defined( 'ABSPATH' ) || exit;

return [
	'cache_time'      => '202112211846',
	'version'         => 10000,
	'settings_prefix' => 'skp_',
	'errors_silent'   => true,
	'vendor_dir'      => STARTER_KIT_PLUGIN_DIR . '/vendor/',
	'assets_uri'      => STARTER_KIT_PLUGIN_URL . '/assets/',
	
	'example_option' => [
		'array_option1' => 'value1',
		'array_option2' => 'value2',
	]
];
