<?php

namespace Automex\OpenDataRDW\Admin\MetaBox;

class Disclaimer extends MetaBox {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct( 'disclaimer', __( 'Disclaimer', 'wp-car-manager' ), 'normal', 'high' );
	}

	/**
	 * Actual meta box output
	 *
	 * @param \WP_Post $post
	 */
	public function meta_box_output( $post ) {
		echo __('Disclaimer placeholder', 'amex-opendata-rdw');
	}

}