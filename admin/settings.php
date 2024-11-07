<div class="wpfss-page-wrapper wrap">
	<div class="wpfss-page-header">
		<div class="wpfss-container wpfss-flex-box">
			<div class="wpfss-logo-wrapper wpfss-headline">
				<a href="#">
					<img src="<?php echo esc_url(WPFSS_PLUGIN_URI . '/assets/images/wp-full-screen-search-wordpress-plugin-thememantis.png'); ?>" class="wpfss-logo" alt="<?php esc_html_e('WP Full Screen Search', 'wp-full-screen-search'); ?>">
				</a>
			</div>
		</div>
	</div>
	<?php
	if ( isset($this->message) ) {
	?>
		<div class="updated fade">
			<p><?php echo esc_html($this->message); ?></p>
		</div>
	<?php
	}
	if ( isset($this->error_message) ) {
	?>
		<div class="error fade">
			<p><?php echo esc_html($this->error_message); ?></p>
		</div>
	<?php
	}
	?>

	<div class="wpfss-container wpfss-settings">
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<!-- Content -->
				<div id="post-body-content">
					<h1 class="screen-reader-text"><?php esc_html_e('WP Full Screen Search', 'wp-full-screen-search'); ?></h1>
					<form action="options-general.php?page=<?php echo esc_attr($this->plugin_name); ?>" method="post">
						<div class="postbox">
							<h3 class="hndle"><?php esc_html_e('Full Screen Settings', 'wp-full-screen-search'); ?></h3>
							<div class="inside">
								<div class="wpfss-row">
									<div class="wpfss-label"><label for="wpfss_full_screen_background"><?php esc_html_e('Full Screen Background', 'wp-full-screen-search'); ?></label></div>
									<div class="wpfss-field">
										<input type="text" value="<?php echo esc_attr($this->settings['wpfss_full_screen_background']); ?>" id="wpfss_full_screen_background" name="wpfss_full_screen_background" class="wpfss-colorpicker color-picker" data-alpha="true" data-default-color="rgba(255,255,255,0.95)" />
										<div class="wpfss-description">
											<p class="description"><?php esc_html_e('Choose full screen background color.', 'wp-full-screen-search'); ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="postbox">
							<h3 class="hndle"><?php esc_html_e('Search Box Settings', 'wp-full-screen-search'); ?></h3>
							<div class="inside">
								<div class="wpfss-row">
									<div class="wpfss-label"><label for="wpfss_search_box_background"><?php esc_html_e('Search Box Background', 'wp-full-screen-search'); ?></label></div>
									<div class="wpfss-field">
										<input type="text" value="<?php echo esc_attr($this->settings['wpfss_search_box_background']); ?>" id="wpfss_search_box_background" name="wpfss_search_box_background" class="wpfss-colorpicker" data-default-color="#eeeeee" />
										<div class="wpfss-description">
											<p class="description"><?php esc_html_e('Choose background color of search box.', 'wp-full-screen-search'); ?></p>
										</div>
									</div>
								</div>
								<div class="wpfss-row">
									<div class="wpfss-label"><label for="wpfss_search_box_placeholder_color"><?php esc_html_e('Search Box Placeholder Color', 'wp-full-screen-search'); ?></label></div>
									<div class="wpfss-field">
										<input type="text" value="<?php echo esc_attr($this->settings['wpfss_search_box_placeholder_color']); ?>" id="wpfss_search_box_placeholder_color" name="wpfss_search_box_placeholder_color" class="wpfss-colorpicker" data-default-color="#cccccc" />
										<div class="wpfss-description">
											<p class="description"><?php esc_html_e('Choose placeholder color of search box.', 'wp-full-screen-search'); ?></p>
										</div>
									</div>
								</div>
								<div class="wpfss-row">
									<div class="wpfss-label"><label for="wpfss_search_box_placeholder_text"><?php esc_html_e('Search Box Placeholder Text', 'wp-full-screen-search'); ?></label></div>
									<div class="wpfss-field">
										<input type="text" value="<?php echo esc_attr($this->settings['wpfss_search_box_placeholder_text']); ?>" id="wpfss_search_box_placeholder_text" name="wpfss_search_box_placeholder_text" class="wpfss-text" />
										<div class="wpfss-description">
											<p class="description"><?php esc_html_e('Enter placeholder text for search box.', 'wp-full-screen-search'); ?></p>
										</div>
									</div>
								</div>
								<div class="wpfss-row">
									<div class="wpfss-label"><label for="wpfss_search_box_text_color"><?php esc_html_e('Search Box Text Color', 'wp-full-screen-search'); ?></label></div>
									<div class="wpfss-field">
										<input type="text" value="<?php echo esc_attr($this->settings['wpfss_search_box_text_color']); ?>" id="wpfss_search_box_text_color" name="wpfss_search_box_text_color" class="wpfss-colorpicker" data-default-color="#666666" />
										<div class="wpfss-description">
											<p class="description"><?php esc_html_e('Choose text color of search box.', 'wp-full-screen-search'); ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="postbox">
							<h3 class="hndle"><?php esc_html_e('Close Button Settings Settings', 'wp-full-screen-search'); ?></h3>
							<div class="inside">
								<div class="wpfss-row">
									<div class="wpfss-label"><label for="wpfss_close_button_round_shape"><?php esc_html_e('Make Close Button Round Shape', 'wp-full-screen-search'); ?></label></div>
									<div class="wpfss-field">
										<input class="wpfss-switch-checkbox" name="wpfss_close_button_round_shape" type="checkbox" id="wpfss_close_button_round_shape" value="yes" <?php checked('yes', $this->settings['wpfss_close_button_round_shape']); ?> />
										<label for="wpfss_close_button_round_shape" class="wpfss-switch-toggle button-status"></label>
										<div class="wpfss-description">
											<p class="description"><?php esc_html_e('Enable / Disable round shape for close button background.', 'wp-full-screen-search'); ?></p>
										</div>
									</div>
								</div>
								<div class="wpfss-row">
									<div class="wpfss-label"><label for="wpfss_close_button_background"><?php esc_html_e('Close Button Background Color', 'wp-full-screen-search'); ?></label></div>
									<div class="wpfss-field">
										<input type="text" value="<?php echo esc_attr($this->settings['wpfss_close_button_background']); ?>" id="wpfss_close_button_background" name="wpfss_close_button_background" class="wpfss-colorpicker" data-default-color="rgba(255,255,255,0.95)" />
										<div class="wpfss-description">
											<p class="description"><?php esc_html_e('Choose background color of close button.', 'wp-full-screen-search'); ?></p>
										</div>
									</div>
								</div>
								<div class="wpfss-row">
									<div class="wpfss-label"><label for="wpfss_close_button_text_color"><?php esc_html_e('Close Button Text Color', 'wp-full-screen-search'); ?></label></div>
									<div class="wpfss-field">
										<input type="text" value="<?php echo esc_attr($this->settings['wpfss_close_button_text_color']); ?>" id="wpfss_close_button_text_color" name="wpfss_close_button_text_color" class="wpfss-colorpicker" data-default-color="#999999" />
										<div class="wpfss-description">
											<p class="description"><?php esc_html_e('Choose text color of close button.', 'wp-full-screen-search'); ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
						wp_nonce_field($this->plugin_name, $this->plugin_name . '_nonce');
						?>
						<p>
							<input name="submit" type="submit" name="Submit" class="button button-primary" value="<?php echo esc_attr__('Save WP Full Screen Search Settings', 'wp-full-screen-search'); ?>" />
						</p>
					</form>
				</div>
				<!-- Sidebar -->
				<div id="postbox-container-1" class="postbox-container">
					<?php require_once WPFSS_PLUGIN_DIR . '/admin/sidebar.php'; ?>
				</div>
				<!-- /postbox-container -->
			</div>
			<!-- /postbox -->
		</div>
		<!-- /post-body-content -->
	</div>
</div>
