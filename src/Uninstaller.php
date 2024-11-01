<?php

namespace Automex\OpenDataRDW;

abstract class Uninstaller {

	/**
	 * Uninstaller, delete options
	 */
	public static function uninstall() {	
		delete_option( 'amex_enable_opendata_rdw_admin' );
		delete_option( 'amex_socrata_app_token' );
		delete_option( 'amex_hide_credits' );
	}

}