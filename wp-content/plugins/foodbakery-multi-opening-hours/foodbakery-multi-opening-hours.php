<?php
/**
 * Plugin Name: Foodbakery Multi Opening Hours
 * Plugin URI: http://themeforest.net/user/Chimpstudio/
 * Description: Foodbakery Multi Opening Hours Add on
 * Version: 3.3
 * Author: ChimpStudio
 * Author URI: http://themeforest.net/user/Chimpstudio/
 * @package Foodbakery
 * Text Domain: foodbakery_multi_opening_hours
 */

// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('foodbakery_multi_opening_hours')) {
    /**
     * Class foodbakery_multi_opening_hours
     */
    class foodbakery_multi_opening_hours
    {
        public $admin_notices; // Explicit property declaration

        /**
         * foodbakery_multi_opening_hours constructor.
         */
        public function __construct()
        {
            // Define constants
            define('FOODBAKERY_MULTI_OPENING_HOURS_PLUGIN_URL', WP_PLUGIN_URL . '/foodbakery-multi-opening-hours');
            define('FOODBAKERY_MULTI_OPENING_HOURS_CORE_DIR', WP_PLUGIN_DIR . '/foodbakery-multi-opening-hours');
            define('FOODBAKERY_MULTI_OPENING_HOURS_INCLUDES_DIR', FOODBAKERY_MULTI_OPENING_HOURS_CORE_DIR . '/includes');
            define('FOODBAKERY_MULTI_OPENING_HOURS_LANGUAGES_DIR', FOODBAKERY_MULTI_OPENING_HOURS_CORE_DIR . '/languages');
            $this->admin_notices = array();
            // Admin notices
            add_action('admin_notices', array($this, 'foodbakery_multi_opening_hours_notices_callback'));
            if (!$this->check_dependencies()) {
                return false;
            }

            // enqueue script frontend
            add_action('wp_enqueue_scripts', array($this, 'foodbakery_multi_opening_hours_enqueue'), 20);
            // Include files
            $this->foodbakery_multi_opening_hours_includes();
            // Initialize the text domain for multiple languages
            add_action( 'init', array( $this, 'init' ), 0 );

        }

        /**
         * enqueue script admin
         */
        public function admin_styles_enqueue(){
            $rand_id = rand(0001, 1000);
            // Enqueue CSS
            wp_enqueue_style('foodbakery_multi_opening_hours_style_custom_admin', plugins_url('/assets/css/style_custom_admin.css', __FILE__));
        }

        /**
         * @param bool $disable
         * @return bool
         */
        public function check_dependencies($disable = false)
        {
            $result = true;
            $active_plugins = get_option('active_plugins', array());
            if (is_multisite()) {
                $active_sitewide_plugins = get_site_option('active_sitewide_plugins', array());
                $active_sitewide_plugins = array_keys($active_sitewide_plugins);
                $active_plugins = array_merge($active_plugins, $active_sitewide_plugins);
            }
            $foodbakery_is_active = in_array('wp-foodbakery/wp-foodbakery.php', $active_plugins);
            if (!$foodbakery_is_active) {
                $this->admin_notices[] = '<div class="error">' . __('<em><b>Foodbakery Multi Opening Hours</b></em> needs the <b>Foodbakery</b> plugin. Please install and activate it.', 'foodbakery_multi_opening_hours') . '</div>';
            }
            if (!$foodbakery_is_active) {
                if ($disable) {
                    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
                    deactivate_plugins(array(__FILE__));
                }
                $result = false;
            }
            return $result;
        }

        /**
         * Initialize application, load text domain, enqueue scripts and bind hooks
         */
        public function init()
        {

            // Add Plugin textdomain
            $locale = apply_filters('plugin_locale', get_locale(), 'foodbakery_multi_opening_hours');
            load_textdomain('foodbakery_multi_opening_hours', FOODBAKERY_MULTI_OPENING_HOURS_LANGUAGES_DIR . '/foodbakery_multi_opening_hours' . "-" . $locale . '.mo');
            load_plugin_textdomain('foodbakery_multi_opening_hours', false, FOODBAKERY_MULTI_OPENING_HOURS_LANGUAGES_DIR);
        }

        /**
         * includes the file from front end and backend
         */
        public function foodbakery_multi_opening_hours_includes()
        {
            // Include Classes
            require_once 'includes/backend/class-multiple-opening-hours-backend.php';
            
            
            require_once 'includes/frontend/class-multi-opening-hours-frontend.php';
            require_once 'includes/frontend/class-multi-opening-hours-front-fields.php';
        }

        /**
         *  enqueue script and style
         */
        public function foodbakery_multi_opening_hours_enqueue()
        {
            $rand_id = rand(99,99999);
            wp_enqueue_script('foodbakery_multi_opening_hours_js', plugins_url('/assets/js/functions.js', __FILE__), '', $rand_id, true);
            wp_localize_script('foodbakery_multi_opening_hours_js', 'foodbakery_customization', array(
                'ajax_url' => admin_url( 'admin-ajax.php'),
                'plugin_url' => content_url().'/plugins/',
                )
            );
            wp_enqueue_style('foodbakery_multi_opening_hours_css', plugins_url('/assets/css/foodbakery-multi-opening-hours.css', __FILE__));
        }

        /**
         * admin notifications
         */
        public function foodbakery_multi_opening_hours_notices_callback()
        {
            if (isset($this->admin_notices) && !empty($this->admin_notices)) {
                foreach ($this->admin_notices as $value) {
                    echo $value;
                }
            }
        }
    }

    new foodbakery_multi_opening_hours();
}
?>