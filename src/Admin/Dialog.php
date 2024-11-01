<?php

namespace Automex\OpenDataRDW\Admin;

class Dialog {

	/**
	 * Setup custom columns
	 */
	public function setup() {
		add_action('admin_head-post-new.php', array( $this, 'render_new_licenseplate_dialog' ) );
	}

	public function render_new_licenseplate_dialog() {
			
		global $pagenow;
			
		if (( $pagenow == 'post-new.php' ) || (get_post_type() == 'wpcm_vehicle')) {

		?>
		<div id="amex-dialog" class="hidden">
			<?php echo __('Your listing is automatically enriched with the characteristics of your car. Enter the license plate and click on Use license plate.', 'amex-opendata-rdw'); ?>
			<form action="<?php ?>" method="get" id="getVehicleData">
				<span class="kenteken">
					<span class="blue">
						<img src="<?php echo plugins_url('wp-car-manager-opendata-rdw-kenteken-voertuiginformatie/assets/images/stars.svg'); ?>" alt="" />
					</span>
					<input type="text" class="nl dialog-licenseplate" name="amex_licenseplate" id="amex_licenseplate" placeholder="XP-004-T" spellcheck="false" autocomplete="off" maxlength="8" />		
				</span>
				<p class="submitbox">
					<button type="button" id="skip" class="button"><?php _e('Skip', 'amex-opendata-rdw'); ?></button>
					<button type="button" id="dialog-submit" class="button button-primary" id="create-new-log-submit" disabled><?php _e('Use license plate', 'amex-opendata-rdw'); ?></button>
				</p>
				<?php if ( get_option('wpcm_amex_hide_credits') == false ) { ?>
					<p class="footnote">
						<?php
							$link = sprintf( '<a href="https://automex.website" class="amex-link" target="_blank"><span class="amex">Auto<span>mex</span><small>.website</small></span></a>' );
							echo sprintf( esc_html__('This extenstion is brought to you by %1$s', "amex-opendata-rdw"), $link );
						?>
					</p>
				<?php } ?>
			</form>
			<script type="text/javascript">
			document.querySelectorAll('.dialog-licenseplate').forEach(function(element){
				element.addEventListener('kentekenplaat.valid', function(e) {
					document.getElementById("dialog-submit").removeAttribute("disabled", "disabled");
				});
				element.addEventListener('kentekenplaat.invalid', function(e) {
					document.getElementById("dialog-submit").setAttribute("disabled", "disabled");
				});
			});
			</script>
		</div>
		<?php } 
		
	}		

} ?>