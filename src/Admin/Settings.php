<?php

namespace Automex\OpenDataRDW\Admin;

use \Never5\WPCarManager as Core;

class Settings {

	/**
	 * Setup class
	 */
	public function setup() {
		add_filter( 'wpcm_fields', array( $this, 'add_fields' ) );
	}
	
	/**
	 * Add fields to settings
	 *
	 * @param $fields
	 *
	 * @return array
	 */
	public function add_fields( $fields ) {
		
		$tags = '<span class="amex-tag" tooltip="{{merk}}">' . __('Make', 'amex-opendata-rdw') . '</span><span class="amex-tag" tooltip="{{handelsbenaming}}">' . __('Trade name', 'amex-opendata-rdw') . '</span>';
				
		$anchor = esc_html_x( 'opendata.rdw.nl/en/signup', 'link text for opendata.rdw.nl', 'amex-opendata-rdw' );
		$domain = esc_url( __( 'https://opendata.rdw.nl/en/signup', 'amex-opendata-rdw' ) );  
		$link_rdw   = sprintf( '<a href="%s" target="_blank">%s</a>', $domain, $anchor );
		
		$fields['opendata-rdw'] = array(
			__( 'Opendata RDW', 'amex-wpcm-opendata-rdw' ),
			array(
				array(
					'name'     => 'amex_enable_opendata_rdw_admin',
					'label'    => __( 'Enable Opendata RDW', 'amex-opendata-rdw' ),
					'cb_label' => __( 'Enable Opendata RDW Dialog.', 'amex-opendata-rdw' ),
					'desc'     => __( 'Enable Opendata RDW in Add New Listing page (admin area).', 'amex-opendata-rdw' ),
					'type'     => 'checkbox',
				),
				array(
					'name'     => 'amex_socrata_app_token',
					'label'    => __( 'App Token', 'amex-opendata-rdw' ),
					'desc'     => sprintf( __( 'Create an account at %1$s for generating an App Token.', 'amex-opendata-rdw' ), $link_rdw ),
				),
				array(
					'name'     => 'amex_hide_credits',
					'label'    => __( 'Hide Credits', 'amex-opendata-rdw' ),
					'cb_label' => __( 'Hide the credits in the dialog.', 'amex-opendata-rdw' ),
					'desc'     => __( 'Hide the credits in the dialog "This extension is brought to you by Automex.website".', 'amex-opendata-rdw' ),
					'type'     => 'checkbox',
					'attributes' => array(
						'disabled' => 'disabled',
					),
				),
			),
		);

		return $fields;
	}

}