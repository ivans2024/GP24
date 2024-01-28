<?php
/*
  Plugin Name: Foodbakery Framework
  Plugin URI: http://themeforest.net/user/Chimpstudio/
  Description: Foodbakery Framework.
  Version: 4.1
  Author: ChimpStudio
  Author URI: http://themeforest.net/user/Chimpstudio/
  Requires at least: 4.0
  Tested up to: 4.9
  Text Domain: cs-framework
  Domain Path: /languages/

  Copyright: 2015 chimpgroup (email : info@chimpstudio.co.uk)
  License: GNU General Public License v3.0
  License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$theme = wp_get_theme();
if ( $theme->Template != 'foodbakery') {
    return;
}

if ( ! class_exists( 'wp_foodbakery_framework' ) ) {

    class wp_foodbakery_framework {


        protected static $_instance = null;
        static $theme_identify = '';
        public $admin_notice = '';

        /**
         * Main Plugin Instance
         *
         */
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * Initiate Plugin Actions
         *
         */
        public function __construct() {

            define( 'CSFRAME_DOMAIN', 'frame-foodbakery' );
            add_action('admin_init', array( $this, 'foodbakery_theme_identifier' ), 0);
            $this->plugin_actions();
            $this->includes();
            add_action( 'wp_ajax_foodbakery_admin_dismiss_notice', array( $this, 'foodbakery_admin_dismiss_notice' ) );
        }
		
		public function foodbakery_theme_identifier() {
            if ( wp_foodbakery_framework::$theme_identify != 'wp-foodbakery-theme' ) {
                deactivate_plugins(plugin_basename(__FILE__));
                $this->admin_notice = foodbakery_var_frame_text_srt( 'foodbakery_plugin_error' );
                add_action('admin_notices', array($this, 'foodbakery_admin_notices_callback'));
            }
        }
		
		public function foodbakery_admin_notices_callback(){
            echo '<div class="error">' . $this->admin_notice . '</div>';
        }

        /**
         * Fetch and return version of the current plugin
         *
         * @return	string	version of this plugin
         */
        public static function get_plugin_version() {
            $plugin_data = get_plugin_data( __FILE__ );
            return $plugin_data['Version'];
        }

        /**
         * Initiate Plugin 
         * Text Domain
         * @return
         */
        public function load_plugin_textdomain() {
            $locale = apply_filters( 'plugin_locale', get_locale(), 'cs-framework' );

            load_textdomain( 'cs-framework', WP_PLUGIN_DIR . 'foodbakery-framework/languages/cs-framework-' . $locale . '.mo' );
            load_plugin_textdomain( 'cs-framework', false, WP_PLUGIN_DIR . 'foodbakery-framework/languages' );

        }

        /**
         * Checking the Request Type
         * string $type ajax, frontend or admin
         * @return bool
         */
        public function is_request( $type ) {
            switch ( $type ) {
                case 'admin' :
                    return is_admin();
                case 'ajax' :
                    return defined( 'DOING_AJAX' );
                case 'cron' :
                    return defined( 'DOING_CRON' );
                case 'frontend' :
                    return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
            }
        }

        /**
         * Include required core files 
         * used in admin and on the frontend.
         */
        public function includes() {

            // Theme Domain Name
            require_once 'includes/cs-framework-config.php';
            require_once 'includes/cs-helpers.php';
            require_once 'assets/translate/cs-strings.php';
           
            require_once 'includes/cs-frame-functions.php';
            require_once 'includes/cs-mailchimp/cs-class.php';
            require_once 'includes/cs-mailchimp/cs-functions.php';
            require_once 'includes/cs-page-builder.php';

            // Post and Page Meta Boxes
            require_once 'includes/cs-metaboxes/cs-page-functions.php';
            require_once 'includes/cs-metaboxes/cs-page.php';
            require_once 'includes/cs-metaboxes/cs-post.php';
            require_once 'includes/cs-metaboxes/cs-product.php';
            // Shortcodes
            require_once 'includes/cs-shortcodes/frontend/cs-maintenance.php';
            require_once 'includes/cs-shortcodes/backend/cs-maintain.php';
            
            // Importer
            require_once 'includes/cs-importer/api-functions.php';
            require_once 'includes/cs-importer/theme-importer.php';
            //  require_once 'includes/cs-importer/class-widget-data.php';
            // Auto Update Theme
            require_once 'includes/cs-importer/auto-update-theme.php';
            // Widgets
            require_once 'includes/cs-widgets/cs-social-media.php';
        }

        /**
         * Set plugin actions.
         * @return
         */
        public function plugin_actions() {

            add_action( 'init', array( $this, 'load_plugin_textdomain' ), 0 );
            add_action( 'foodbakery_before_header', array( $this, 'under_construction' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'admin_plugin_files_enqueue' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'frontend_files_enqueue' ), 6 );
            add_filter( 'foodbakery_maintenance_options', array( $this, 'create_foodbakery_maintenance_options' ), 10, 1 );
        }

        /**
         * Get the plugin url.
         * @return string
         */
        public static function plugin_url() {
            return trailingslashit( plugins_url( '/', __FILE__ ) );
        }

        public static function plugin_dir() {
            return plugin_dir_path( __FILE__ );
        }

        /**
         * Get the plugin path.
         * @return string
         */
        public static function plugin_path() {
            return untrailingslashit( plugin_dir_path( __FILE__ ) );
        }

        /**
         * Default plugin 
         * admin files enqueue.
         * @return
         */
        public function admin_plugin_files_enqueue() {

            if ( $this->is_request( 'admin' ) ) {
                // admin js files
                $foodbakery_scripts_path = plugins_url( '/assets/js/cs-page-builder-functions.js', __FILE__ );
                wp_enqueue_script( 'cs-frame-admin', $foodbakery_scripts_path, array( 'jquery' ) );
                wp_localize_script(
                    'cs-frame-admin', 'foodbakery_globals', array(
                    'ajax_url' => admin_url( 'admin-ajax.php' ),
                )
            );
            }
        }

        /**
         * Default plugin 
         * front files enqueue.
         * @return
         */
        public function frontend_files_enqueue() {

            if ( $this->is_request( 'frontend' ) ) {
                wp_enqueue_script( 'foodbakery-countdown', plugins_url( '/assets/js/jquery.countdown.js', __FILE__ ), '', '', true );
		
            }
        }

        public function under_construction() {
            global $foodbakery_var_options;


            if ( get_option( 'foodbakery_underconstruction_redirecting' ) != 1 ) {
                if ( isset( $foodbakery_var_options['foodbakery_var_maintenance_switch'] ) && $foodbakery_var_options['foodbakery_var_maintenance_switch'] == 'on' && isset( $foodbakery_var_options['foodbakery_var_maintinance_mode_page'] ) && ! is_user_logged_in() ) {

                    if ( $foodbakery_var_options['foodbakery_var_maintinance_mode_page'] != '' && $foodbakery_var_options['foodbakery_var_maintinance_mode_page'] != '0' ) {
                        update_option( 'foodbakery_underconstruction_redirecting', '1' );
                        wp_redirect( get_permalink( $foodbakery_var_options['foodbakery_var_maintinance_mode_page'] ) );
                        exit;
                    } else {
                        echo '
                        <script>
                            alert("' . foodbakery_var_frame_text_srt( 'foodbakery_var_please_select_maintinance' ) . '");
                        </script>';
                    }
                }
            }
        }

        public function create_foodbakery_maintenance_options( $foodbakery_var_settings ) {
            global $foodbakery_var_frame_static_text, $foodbakery_var_options;
            $on_off_option = array(
                "show" => "on",
                "hide" => "off",
            );

            $foodbakery_var_settings[] = array( "name" => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_field_name' ),
                "fontawesome" => 'icon-gears',
                "id" => "tab-maintenanace-mode",
                "std" => "",
                "type" => "main-heading",
                "options" => ""
            );
            $foodbakery_var_settings[] = array( "name" => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_field_name' ),
                "id" => "tab-maintenanace-mode",
                "type" => "sub-heading"
            );
            $foodbakery_var_settings[] = array( "name" => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_field_name' ),
                "desc" => "",
                "hint_text" => '',
                "id" => "foodbakery_maintenance_options",
                "std" => "",
                "type" => "maintenance_mode"
            );
            $foodbakery_var_settings[] = array( "name" => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_field_name' ),
                "desc" => "",
                "hint_text" => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_field_mode_hint' ),
                "id" => "maintenance_switch",
                "std" => "off",
                "type" => "checkbox",
                "options" => $on_off_option
            );

            $foodbakery_var_settings[] = array( "name" => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_field_logo' ),
                "desc" => "",
                "hint_text" => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_field_logo_hint' ),
                "id" => "maintenance_logo_switch",
                "std" => "off",
                "type" => "checkbox",
                "options" => $on_off_option
            );
            $foodbakery_var_settings[] = array( "name" => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_field_social' ),
                "desc" => "",
                "hint_text" => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_field_social_hint' ),
                "id" => "maintenance_social_switch",
                "std" => "off",
                "type" => "checkbox",
                "options" => $on_off_option
            );

            $foodbakery_var_settings[] = array( "name" => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_field_newsletter' ),
                "desc" => "",
                "hint_text" => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_field_newsletter_hint' ),
                "id" => "maintenance_newsletter_switch",
                "std" => "off",
                "type" => "checkbox",
                "options" => $on_off_option
            );

            

            $foodbakery_var_options_array = array();
            $foodbakery_var_options_array[] = foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_field_select_page' );
            $maintinance_mode_page = isset($foodbakery_var_options['foodbakery_var_maintinance_mode_page']) ? $foodbakery_var_options['foodbakery_var_maintinance_mode_page'] : '';
			if( $maintinance_mode_page != '' && is_numeric($maintinance_mode_page) && $maintinance_mode_page > 0){
				$foodbakery_var_options_array[$maintinance_mode_page] = get_the_title($maintinance_mode_page);
			}

            $foodbakery_var_settings[] = array( "name" => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_field_mode_page' ),
                "desc" => "",
                "hint_text" => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_field_mode_page_hint' ),
                "id" => "maintinance_mode_page",
                "std" => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_select_page' ),
                "type" => "custom_page_select",
                'classes' => 'chosen-select',
                "options" => $foodbakery_var_options_array
            );
            $foodbakery_var_settings[] = array( "col_heading" => '',
                "type" => "col-right-text",
                "help_text" => ''
            );

            return $foodbakery_var_settings;
        }

        public function foodbakery_admin_dismiss_notice() {
            set_transient( 'admin_dismiss_notice', '1', 60 * 60 * 24 * 7 );
            die;
        }

    }

}

/**
 *
 * @login popup script files
 */
if ( ! function_exists( 'foodbakery_google_recaptcha_scripts' ) ) {

    function foodbakery_google_recaptcha_scripts() {
        wp_enqueue_script( 'google_recaptcha_scripts', 'https://www.google.com/recaptcha/api.js', '', '' );
    }

}

/**
 * Framework Instance
 * @return
 *
 */
if ( ! function_exists( 'foodbakery_var_frame' ) ) {

    function foodbakery_var_frame() {
        return wp_foodbakery_framework::instance();
    }

}

// Global for backwards compatibility.
$GLOBALS['wp_foodbakery_framework'] = foodbakery_var_frame();
