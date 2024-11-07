<?php

/**
 * Plugin Sidebar
 */
?>

<!-- WordPress Tutorials -->
<div class="postbox plugin-sidebar">
	<h3 class="hndle">
		<span><?php esc_html_e('Learn More About WordPress', 'wp-full-screen-search'); ?></span>
	</h3>

	<div class="inside">
		<p>
			<?php
			printf(
				/* translators: %s: Link to UnmaskWP blog */
				esc_html__('Want to learn more about WordPress? Check out our free WordPress tutorials on %s.', 'wp-full-screen-search'),
				sprintf(
					'<a href="https://unmaskwp.com/?utm_source=wpadmin&utm_medium=freeplugins&utm_campaign=wpup-free-plugin" target="_blank">%s</a>',
					esc_html__('UnmaskWP blog', 'wp-full-screen-search')
				)
			);
			?>
		</p>

		<p>
			<?php esc_html_e('Some of our popular guides:', 'wp-full-screen-search'); ?>
		</p>

		<ul>
			<li>
				<a href="https://unmaskwp.com/how-to-start-an-online-store/?utm_source=wpadmin&utm_medium=freeplugins&utm_campaign=wpup-free-plugin" target="_blank">
					<?php esc_html_e('[2024] How to Start an Online Store? (Step by Step)', 'wp-full-screen-search'); ?>
				</a>
			</li>
			<li>
				<a href="https://unmaskwp.com/connect-domain-name-to-web-hosting-service/?utm_source=wpadmin&utm_medium=freeplugins&utm_campaign=wpup-free-plugin" target="_blank">
					<?php esc_html_e('How to Connect Domain Name with Web Hosting Service? (Step-by-step)', 'wp-full-screen-search'); ?>
				</a>
			</li>
			<li>
				<a href="https://unmaskwp.com/best-contact-form-plugins-for-wordpress/?utm_source=wpadmin&utm_medium=freeplugins&utm_campaign=wpup-free-plugin" target="_blank">
					<?php esc_html_e('5 Best Contact Form Plugins for WordPress Compared [2024]', 'wp-full-screen-search'); ?>
				</a>
			</li>
		</ul>
	</div>
</div>

<!-- WordPress Themes -->
<div class="postbox plugin-sidebar">
	<h3 class="hndle">
		<span><?php esc_html_e('Looking for a WordPress Code Snippets?', 'wp-full-screen-search'); ?></span>
	</h3>
	<div class="inside">
		<p>
			<?php
			printf(
				/* translators: %s: Link to UnmaskWP blog */
				esc_html__('Check out our full collection of free WordPress Snippets on %s.', 'wp-full-screen-search'),
				sprintf(
					'<a href="https://unmaskwp.com/snippets/?utm_source=wpadmin&utm_medium=freeplugins&utm_campaign=wpup-free-plugin" target="_blank">%s</a>',
					esc_html__('UnmaskWP Code Snippet Library', 'wp-full-screen-search')
				)
			);
			?>
		</p>
		<ul>
			<li>
				<a href="https://unmaskwp.com/snippets/disable-repeat-purchase-for-woocommerce-product/?utm_source=wpadmin&utm_medium=freeplugins&utm_campaign=wpup-free-plugin" target="_blank">
					<?php esc_html_e('How to Disable Repeat Purchase for a WooCommerce Product?', 'wp-full-screen-search'); ?>
				</a>
			</li>
			<li>
				<a href="https://unmaskwp.com/snippets/remove-jetpack-unused-css-from-wordpress/?utm_source=wpadmin&utm_medium=freeplugins&utm_campaign=wpup-free-plugin" target="_blank">
					<?php esc_html_e('How to Remove Jetpack Unused CSS From WordPress Website?', 'wp-full-screen-search'); ?>
				</a>
			</li>
			<li>
				<a href="https://unmaskwp.com/snippets/hide-other-shipping-methods-except-free-shipping-and-local-pickup-woocommerce/?utm_source=wpadmin&utm_medium=freeplugins&utm_campaign=wpup-free-plugin" target="_blank">
					<?php esc_html_e('Hide All Shipping Methods Except “Free Shipping” and “Local Pickup” in WooCommerce', 'wp-full-screen-search'); ?>
				</a>
			</li>
		</ul>
	</div>
</div>
