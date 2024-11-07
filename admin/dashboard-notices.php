<?php

/**
 * Notices template
 */
?>
<div class="notice notice-success is-dismissible <?php echo esc_attr($this->plugin_name); ?>-notice-welcome">
	<p>
		<?php
		printf(
			/* translators: %s: Name of this plugin */
			esc_html__('Thank you for installing %1$s!', 'wp-full-screen-search'),
			esc_html($this->plugin_display_name)
		);
		?>
		<a href="<?php echo esc_url($setting_page); ?>"><?php esc_html_e('Click here', 'wp-full-screen-search'); ?></a> <?php esc_html_e('to configure the plugin.', 'wp-full-screen-search'); ?>
	</p>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(document).on('click', '.<?php echo esc_html($this->plugin_name); ?>-notice-welcome button.notice-dismiss', function(event) {
			event.preventDefault();
			$.post(ajaxurl, {
				action: '<?php echo esc_html($this->plugin_name) . '_dismiss_dashboard_notices'; ?>',
				nonce: '<?php echo esc_html(wp_create_nonce($this->plugin_name) . '-nonce'); ?>'
			});
			$('.<?php echo esc_html($this->plugin_name); ?>-notice-welcome').remove();
		});
	});
</script>
