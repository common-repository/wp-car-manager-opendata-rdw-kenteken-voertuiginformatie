<?php

namespace Automex\OpenDataRDW;

abstract class Assets {
	
	/**
	 * Enqueue backend(admin) assets
	 */
	public static function enqueue_backend() {
		
		$screen = get_current_screen();
		
		if ( 'wpcm_vehicle' == $screen->post_type && 'add' == $screen->action ) {
						
			wp_enqueue_script( 'jquery-ui-dialog' );
			wp_enqueue_style( 'wp-jquery-ui-dialog' );
			
			/* Dialog script */
			wp_register_script( 'dialogLicenseplate', plugins_url( 'wp-car-manager-opendata-rdw-kenteken-voertuiginformatie/assets/js/dialog.js' ), array( ), '1.0.0', true);
			wp_enqueue_script( 'dialogLicenseplate' );
			
			/* Settings */
			$app_token = get_option('wpcm_amex_socrata_app_token');
			
			/* Translations */
			$amex_dialog_title = __('Enter your license plate number', 'amex-opendata-rdw');
			$amex_dialog_close = __('Close', 'amex-opendata-rdw');
			$amex_dialog_text = __('Your entry is automatically enriched with the characteristics of your car. Enter the license plate and click on Use license plate.', 'amex-opendata-rdw');

			$link = sprintf( '<a href="https://automex.website" class="amex-link" target="_blank"><span class="amex">Auto<span>mex</span><small>.website</small></span></a>' );
			$amex_dialog_credit = sprintf( esc_html__('This extenstion is brought to you by %1$s', "amex-opendata-rdw"), $link );
			
			$amex_dialog_skip_btn = __('Skip', 'amex-opendata-rdw');
			$amex_dialog_submit_btn = __('Use license plate', 'amex-opendata-rdw');
			$amex_dialog_wait_btn = __('Please wait', 'amex-opendata-rdw');
			
			/* Passing options to script*/
			$data = array( 
				'app_token' => $app_token, 
				'amex_dialog_title' => $amex_dialog_title,
				'amex_dialog_close' => $amex_dialog_close,
				'amex_dialog_wait_btn' => $amex_dialog_wait_btn,
			);
			wp_localize_script( 'dialogLicenseplate', 'amex_opendata_rdw', $data );
					
					
			wp_enqueue_style( 'amex_style', plugins_url( 'wp-car-manager-opendata-rdw-kenteken-voertuiginformatie/assets/css/style.css' ), array(), '1.0.0' );
			
			wp_enqueue_script('amex_kentekenplaat_js', plugins_url( 'wp-car-manager-opendata-rdw-kenteken-voertuiginformatie/assets/js/kentekenplaat.min.js' ), array( 'jquery' ), '1.0.0', true );
			
			wp_enqueue_script('amex_main', plugins_url( 'wp-car-manager-opendata-rdw-kenteken-voertuiginformatie/assets/js/main.js' ), array( 'jquery' ), '1.0.0', true );			
		}
		
		if ( 'wpcm_vehicle' == $screen->post_type ) {
			
			wp_enqueue_style( 'amex_style_fix', plugins_url( 'wp-car-manager-opendata-rdw-kenteken-voertuiginformatie/assets/css/style.fix.css' ), array(), '1.0.0' );
			
		}

	}

}

?>