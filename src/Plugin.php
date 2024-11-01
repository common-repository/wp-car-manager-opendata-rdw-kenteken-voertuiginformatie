<?php

namespace Automex\OpenDataRDW;

use \Never5\WPCarManager\Pimple;
use \Never5\WPCarManager as Core;

final class Plugin extends Pimple\Container {

	/** @var string */
	private $version = '1.0.0';

	/**
	 * Constructor
	 *
	 * @param string $version
	 * @param string $file
	 */
	public function __construct( $version, $file ) {

		// set version
		$this->version = $version;

		// Pimple Container construct
		parent::__construct();

		// register file service
		$this['file'] = function () use ( $file ) {
			return new Core\File( $file );
		};

		// register services early since some add-ons need 'm
		$this->register_services();

		// load the plugin
		$this->load();

	}

	/**
	 * Get plugin version
	 *
	 * @return string
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Register services
	 */
	private function register_services() {
		$provider = new PluginServiceProvider();
		$provider->register( $this );
	}

	/**
	 * Get service
	 *
	 * @param String $key
	 *
	 * @return mixed
	 */
	public function service( $key ) {
		return $this[ $key ];
	}

	/**
	 * Start loading classes on `plugins_loaded`, priority 30.
	 */
	private function load() {

		$container = $this;
		
		// Load plugin text domain
		load_plugin_textdomain( 'amex-opendata-rdw', false, $container['file']->dirname() . '/languages/' );
		
		// admin check
		if ( is_admin() ) {
			
			$settings = new Admin\Settings();
			$settings->setup();
			
			if ( get_option( 'wpcm_amex_enable_opendata_rdw_admin' ) == true ) {
				$dialog = new Admin\Dialog();
				$dialog->setup();	
			}
			
			add_action( 'admin_enqueue_scripts', array( 'Automex\\OpenDataRDW\\Assets', 'enqueue_backend' ), 1,1 );
			
			add_action( 'admin_init', function () {
				$disclaimer = new Admin\MetaBox\Disclaimer();
				$disclaimer->init();
			} );
			
		}

	}

}