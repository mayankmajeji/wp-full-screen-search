<?php

/**
 * Plugin Name: WP Full Screen Search
 * Plugin URI: https://wordpress.org/plugins/wp-full-screen-search/
 * Version: 1.0.0
 * Author: Mayank Majeji, ThemeMantis
 * Author URI: https://thememantis.com/
 * Description: Converts default WordPress search to full screen search overlay
 * License: GPL2
 * Text Domain: wp-full-screen-search
 * Domain Path: languages
 *
 * WP Full Screen Search is distributed under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * WP Full Screen Search is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WP Full Screen Search. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package WP Full Screen Search
 * @author Mayank Majeji,ThemeMantis
 * @version 1.0.1
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

define('WPFSS_PLUGIN_DIR', trailingslashit(plugin_dir_path(__FILE__)));
define('WPFSS_PLUGIN_URI', plugins_url('', __FILE__));
define('WPFSS_PLUGIN_VERSION', '1.0.0');

/**
 * WP_Full_Screen_Search
 *
 * @package    WP_Full_Screen_Search
 * @author     Mayank Majeji, ThemeMantis
 */
if (!class_exists('WP_Full_Screen_Search')) {

    class WP_Full_Screen_Search
    {

        var $plugin_name;
        var $plugin_display_name;
        var $db_welcome_dismissed_key;

        /**
         * Init.
         */
        public function __construct()
        {

            // Plugin Variables
            $this->plugin_name = 'wp-full-screen-search';
            $this->plugin_display_name = 'WP Full Screen Search';
            $this->db_welcome_dismissed_key = $this->plugin_name . '_welcome_dismissed_key';

            // Admin Hooks
            add_action('admin_init', array(&$this, 'wpfss_register_settings'));
            add_action('admin_menu', array(&$this, 'wpfss_register_menu'));
            add_action('admin_notices', array(&$this, 'wpfss_dashboard_notices'));
            add_action('wp_ajax_' . $this->plugin_name . '_dismiss_dashboard_notices', array(&$this, 'wpfss_dismiss_dashboard_notices'));

            // Hooks
            add_action('admin_enqueue_scripts', array(&$this, 'wpfss_admin_assets'));
            add_action('wp_enqueue_scripts', array(&$this, 'wpfss_assets'));

            // Add actions if we're not in the WordPress Administration to load CSS, JS and the Full Screen Search HTML
            if (!is_admin()) {
                add_action('wp_footer', array($this, 'wpfss_output_full_screen_search'));
            }
        }

        /**
         * Show relevant notices for the plugin
         */
        function wpfss_dashboard_notices()
        {
            global $pagenow;

            if (!get_option($this->db_welcome_dismissed_key)) {
                if (!($pagenow == 'options-general.php' && isset($_GET['page']) && $_GET['page'] == 'wp-full-screen-search')) {
                    $setting_page = admin_url('options-general.php?page=' . $this->plugin_name);

                    // load the notices view
                    include_once(WPFSS_PLUGIN_DIR . '/admin/dashboard-notices.php');
                }
            }
        }

        /**
         * Dismiss the welcome notice for the plugin
         */
        function wpfss_dismiss_dashboard_notices()
        {

            check_ajax_referer($this->plugin_name . '-nonce', 'nonce');

            // user has dismissed the welcome notice
            update_option($this->db_welcome_dismissed_key, 1);
            exit;
        }

        /**
         * Register the plugin settings panel
         */
        function wpfss_register_menu()
        {
            add_submenu_page('options-general.php', $this->plugin_display_name, $this->plugin_display_name, 'manage_options', $this->plugin_name, array(&$this, 'wpfss_settings_page'));
        }

        /**
         * Register Settings
         */
        function wpfss_register_settings()
        {

            $wpfss_hex_args = array(
                'type' => 'string',
                'sanitize_callback' => 'sanitize_hex_color',
            );

            $wpfss_text_args = array(
                'type' => 'string',
                'sanitize_callback' => 'sanitize_text_field',
            );

            register_setting($this->plugin_name, 'wpfss_full_screen_background', $wpfss_hex_args);
            register_setting($this->plugin_name, 'wpfss_search_box_background', $wpfss_hex_args);
            register_setting($this->plugin_name, 'wpfss_search_box_placeholder_color', $wpfss_hex_args);
            register_setting($this->plugin_name, 'wpfss_search_box_placeholder_text', $wpfss_text_args);
            register_setting($this->plugin_name, 'wpfss_search_box_text_color', $wpfss_hex_args);
            register_setting($this->plugin_name, 'wpfss_close_button_round_shape');
            register_setting($this->plugin_name, 'wpfss_close_button_background', $wpfss_hex_args);
            register_setting($this->plugin_name, 'wpfss_close_button_text_color', $wpfss_hex_args);
        }

        /**
         * Output the Administration Panel
         * Save POSTed data from the Administration Panel into a WordPress option
         */
        function wpfss_settings_page()
        {

            // only admin user can access this page
            if (!current_user_can('administrator')) {
                echo '<p>' . esc_html__('Sorry, you are not allowed to access this page.', 'wp-full-screen-search') . '</p>';
                return;
            }

            // Save Settings
            if (isset($_REQUEST['submit'])) {

                // Check nonce
                if (!isset($_REQUEST[$this->plugin_name . '_nonce'])) {

                    // Missing nonce
                    $this->errorMessage = esc_html__('nonce field is missing. Settings NOT saved.', 'wp-full-screen-search');
                } elseif (!wp_verify_nonce($_REQUEST[$this->plugin_name . '_nonce'], $this->plugin_name)) {

                    // Invalid nonce
                    $this->errorMessage = esc_html__('Invalid nonce specified. Settings NOT saved.', 'wp-full-screen-search');
                } else {

                    update_option('wpfss_full_screen_background', isset($_REQUEST['wpfss_full_screen_background']) ? sanitize_hex_color($_REQUEST['wpfss_full_screen_background']) : 'rgba(255,255,255,0.95);');
                    update_option('wpfss_search_box_background', isset($_REQUEST['wpfss_search_box_background']) ? sanitize_hex_color($_REQUEST['wpfss_search_box_background']) : '#eeeeee');
                    update_option('wpfss_search_box_placeholder_color', isset($_REQUEST['wpfss_search_box_placeholder_color']) ? sanitize_hex_color($_REQUEST['wpfss_search_box_placeholder_color']) : '#cccccc');
                    update_option('wpfss_search_box_placeholder_text', isset($_REQUEST['wpfss_search_box_placeholder_text']) ? sanitize_text_field($_REQUEST['wpfss_search_box_placeholder_text']) : 'Search');
                    update_option('wpfss_search_box_text_color', isset($_REQUEST['wpfss_search_box_text_color']) ? sanitize_hex_color($_REQUEST['wpfss_search_box_text_color']) : '#666666');
                    update_option('wpfss_close_button_round_shape', isset($_REQUEST['wpfss_close_button_round_shape']) ? sanitize_text_field($_REQUEST['wpfss_close_button_round_shape']) : 0);
                    update_option('wpfss_close_button_background', isset($_REQUEST['wpfss_close_button_background']) ? sanitize_hex_color($_REQUEST['wpfss_close_button_background']) : 'rgba(255,255,255,0.95)');
                    update_option('wpfss_close_button_text_color', isset($_REQUEST['wpfss_close_button_text_color']) ? sanitize_hex_color($_REQUEST['wpfss_close_button_text_color']) : '#999999');
                    update_option($this->db_welcome_dismissed_key, 1);
                    $this->message = esc_html__('Settings Saved.', 'wp-full-screen-search');
                }
            }

            // Get latest settings
            $this->settings = array(
                'wpfss_full_screen_background' => esc_html(wp_unslash(get_option('wpfss_full_screen_background'))),
                'wpfss_search_box_background' => esc_html(wp_unslash(get_option('wpfss_search_box_background'))),
                'wpfss_search_box_placeholder_text' => esc_html(wp_unslash(get_option('wpfss_search_box_placeholder_text'))),
                'wpfss_search_box_placeholder_color' => esc_html(wp_unslash(get_option('wpfss_search_box_placeholder_color'))),
                'wpfss_search_box_text_color' => esc_html(wp_unslash(get_option('wpfss_search_box_text_color'))),
                'wpfss_close_button_round_shape' => esc_html(wp_unslash(get_option('wpfss_close_button_round_shape'))),
                'wpfss_close_button_background' => esc_html(wp_unslash(get_option('wpfss_close_button_background'))),
                'wpfss_close_button_text_color' => esc_html(wp_unslash(get_option('wpfss_close_button_text_color'))),
            );

            // Load Settings Form
            include_once(WPFSS_PLUGIN_DIR . 'admin/settings.php');
        }

        /**
         * Enqueue plugin admin assets.
         *
         * @return void
         */
        public function wpfss_admin_assets()
        {

            // Enqueue colorpicker styles
            wp_enqueue_style('wp-color-picker');

            wp_enqueue_script('wp-color-picker-alpha', WPFSS_PLUGIN_URI . '/assets/js/wpfss-wp-color-picker-alpha.js', array('wp-color-picker'), '1.0.0', true);

            // Enqueue admin styles
            wp_enqueue_style('wpfss-admin-style', WPFSS_PLUGIN_URI . '/assets/css/wpfss-admin-style.css', array(), false, false);

            wp_enqueue_script('wpfss-admin-script', WPFSS_PLUGIN_URI . '/assets/js/wpfss-admin-script.js', array('wp-color-picker'), false, true);
        }

        /**
         * Enqueue plugin assets.
         *
         * @return void
         */
        public function wpfss_assets()
        {

            // Enqueue admin styles
            wp_enqueue_style('wpfss-style', WPFSS_PLUGIN_URI . '/assets/css/wpfss-style.css', array(), (WPFSS_PLUGIN_URI . 'assets/css/wpfss-style.css'), false);

            $border_radius = get_option('wpfss_close_button_round_shape') ? '50%' : 0;
            $wpfss_custom_css = "
                #wpfss_form_wrapper{
                    background: " . get_option('wpfss_full_screen_background', 'rgba(255,255,255,0.95)') . "
                }
                #wpfss_form_wrapper form div input{
                    background: " . get_option('wpfss_search_box_background', '#eeeeee') . ";
                    color: " . get_option('wpfss_search_box_text_color', '#666666') . ";
                }
                #wpfss_form_wrapper button.close {
                    background: " . get_option('wpfss_close_button_background', 'rgba(255,255,255,0.95)') . ";
                    color: " . get_option('wpfss_close_button_text_color', '#999999') . ";
                    border-radius: " . $border_radius . ";
                }
                #wpfss_form_wrapper form div input:placeholder{
                    color: " . get_option('wpfss_search_box_placeholder_color', '#cccccc') . ";
                }
                #wpfss_form_wrapper form div input::-webkit-input-placeholder{
                    color: " . get_option('wpfss_search_box_placeholder_color', '#cccccc') . ";
                }
                #wpfss_form_wrapper form div input::-moz-placeholder{
                    color: " . get_option('wpfss_search_box_placeholder_color', '#cccccc') . ";
                }
                #wpfss_form_wrapper form div input:-ms-input-placeholder {
                    color: " . get_option('wpfss_search_box_placeholder_color', '#cccccc') . ";
                }
                ";

            // Add the above custom CSS via wp_add_inline_style
            // Pass the variable into the plugin main style sheet ID
            wp_add_inline_style('wpfss-style', $wpfss_custom_css);

            // Enqueue jQuery if not enqueued
            if (!wp_script_is('jquery', 'enqueued')) {
                wp_enqueue_script('jquery');
            }

            // Enqueue admin scripts
            wp_enqueue_script('wpfss-script', WPFSS_PLUGIN_URI . '/assets/js/wpfss-script.js', array('jquery'), false, true);
        }

        /**
         * Outputs the HTML markup for our Full Screen Search
         * CSS hides this by default, and Javascript displays it when the user
         * interacts with any WordPress search field
         *
         * @since 1.0.0
         */
        public function wpfss_output_full_screen_search()
        {
?>
            <div id="wpfss_form_wrapper">
                <button type="button" class="close" id="wpfss_close_button">X</button>
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" id="wpfss_search_form">
                    <div id="wpfss_container">
                        <input type="text" name="s" placeholder="<?php echo esc_attr(get_option('wpfss_search_box_placeholder_text', 'Search')); ?>" id="wpfss_input_text" />
                    </div>
                </form>
            </div>
<?php
        }
    }
}

new WP_Full_Screen_Search();
