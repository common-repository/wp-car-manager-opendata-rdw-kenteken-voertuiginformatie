<?php

namespace Automex\OpenDataRDW;

abstract class Installer {

	/**
	 * Installer, add default options
	 */
	public static function install() {	
		add_option( 'amex_enable_opendata_rdw_admin', '1' );
		add_option( 'amex_socrata_app_token', '' );
		add_option( 'amex_hide_credits', '0' );
	}

}