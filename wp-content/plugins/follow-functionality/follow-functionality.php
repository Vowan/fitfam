<?php

/**
 * The plugin bootstrap file
 *
 *
 * @wordpress-plugin
 * Plugin Name:       User follow functionality
 * Plugin URI:        
 * Description:       
 * Version:           1.0.0
 * Author:            Vladimir
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       
 * Domain Path:       
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

define( 'UFF_NAME',                 'UFF Plugin' );
define( 'UFF_REQUIRED_PHP_VERSION', '5.3' );                          // because of get_called_class()
define( 'UFF_REQUIRED_WP_VERSION',  '3.1' );                          // because of esc_textarea()

/**
 * Checks if the system requirements are met
 *
 * @return bool True if system requirements are met, false if not
 */
function uff_requirements_met() {
	global $wp_version;

	if ( version_compare( PHP_VERSION, UFF_REQUIRED_PHP_VERSION, '<' ) ) {
		return false;
	}

	if ( version_compare( $wp_version, UFF_REQUIRED_WP_VERSION, '<' ) ) {
		return false;
	}

	return true;
}

/**
 * Prints an error that the system requirements weren't met.
 */
function uff_requirements_error() {
	global $wp_version;

	require_once( dirname( __FILE__ ) . '/views/uff-requirements-error.php' ); //defines admin notice message
}

/*
 * Check requirements and load main class
 * The main program needs to be in a separate file that only gets loaded if the plugin requirements are met. Otherwise older PHP installations could crash when trying to parse it.
 */
if ( uff_requirements_met() ) {
    
    require_once( __DIR__ . '/classes/UFF_Basic.php' );
    
    if ( class_exists( 'UFF_Basic' ) ) {
		$GLOBALS['uff_plug'] = UFF_Basic::instance();
		
		
	}
    
}else {
	add_action( 'admin_notices', 'uff_requirements_error' );
}
