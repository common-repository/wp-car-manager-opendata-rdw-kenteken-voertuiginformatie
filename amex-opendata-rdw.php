<?php
/*
    Plugin Name: WP Car Manager - OpenData RDW Kenteken Voertuiginformatie
    Plugin URI: https//www.github.com/automex/amex-opendata-rdw
    Description: Opendata RDW Kenteken Voertuiginformatie from Automex is an extension for WP Car Manager for requesting vehicle data by dutch license plate.
    Version: 1.0.0
    Author: Automex
    Author URI: http://www.automex.website
    License: GPL v2
	Text Domain: amex-opendata-rdw
	Domain Path: /languages

	Copyright 2020 - Automex

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

// autoloader
require 'vendor/autoload.php';

/**
 * @return \Automex\OpenDataRDW\Plugin
 */
function amex_opendata_rdw() {

	static $instance;
	if ( is_null( $instance ) ) {
		$instance = new \Automex\OpenDataRDW\Plugin( '1.0.0', __FILE__ );
	}

	return $instance;

}

function wpcm_load_amex_opendata_rdw() {
	if ( in_array( 'wp-car-manager/wp-car-manager.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		amex_opendata_rdw();
	}
}

// check PHP version
$updatePhp = new WPUpdatePhp( '5.6.0' );
if ( $updatePhp->does_it_meet_required_php_version( PHP_VERSION ) ) {

	// create plugin object
	add_action( 'plugins_loaded', 'wpcm_load_amex_opendata_rdw', 30 );

	// install
	function amex_opendata_rdw_activate_plugin() {
		register_uninstall_hook( __FILE__, 'amex_opendata_rdw_delete_plugin' );
		\Automex\OpenDataRDW\Installer::install();
	}
	
	function amex_opendata_rdw_delete_plugin() {
		\Automex\OpenDataRDW\Uninstaller::uninstall();
	}

	// installer
	register_activation_hook( __FILE__, 'amex_opendata_rdw_activate_plugin' );
}
?>