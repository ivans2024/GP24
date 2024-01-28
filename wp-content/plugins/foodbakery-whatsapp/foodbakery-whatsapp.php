<?php
/**
 * Plugin Name: Foodbakery Whatsapp
 * Plugin URI: http://themeforest.net/user/Chimpstudio/
 * Description: Foodbakery Whatsapp is an Addon for Foodbakery.
 * Version: 1.0
 * Author: ChimpStudio
 * Author URI: http://themeforest.net/user/Chimpstudio/
 * @package Foodbakery
 * Text Domain: foodbakery-whatsapp
 */
// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Foodbakery_Whatsapp')) {

    class Foodbakery_Whatsapp
    {

        public $admin_notices;

        /**
         * Start construct Functions
         */
        public function __construct()
        {
            // Define constants
            define('FOODBAKERY_WHATSAPP_PLUGIN_VERSION', '1.6');
            define('FOODBAKERY_WHATSAPP_PLUGIN_DOMAIN', 'foodbakery-whatsapp');
            define('FOODBAKERY_WHATSAPP_PLUGIN_URL', WP_PLUGIN_URL . '/foodbakery-whatsapp');
            define('FOODBAKERY_WHATSAPP_CORE_DIR', WP_PLUGIN_DIR . '/foodbakery-whatsapp');
            define('FOODBAKERY_WHATSAPP_LANGUAGES_DIR', FOODBAKERY_WHATSAPP_CORE_DIR . '/languages');

            $this->admin_notices = array();
            //admin notices
            add_action('admin_notices', array($this, 'foodbakery_whatsapp_notices_callback'));
            if (!$this->check_dependencies()) {
                return false;
            }
            
            // Initialize Addon
            add_action('init', array($this, 'init'), 500);
            add_action('wp_enqueue_scripts', array($this, 'foodbakery_whatsapp_enqueue'), 20);
            // Include Classes
            require_once 'library/ultramsg/vendor/autoload.php';
            require_once 'includes/backend/class-whatsapp-settings-backend.php';
            require_once 'includes/frontend/class-whatsapp-frontend.php';
            
            
            
            
            //require_once 'includes/frontend/class-resutaurants-map-frontend.php';

        }
        
         /**
         *  enqueue script and style
         */
        public function foodbakery_whatsapp_enqueue()
        {
            $rand_id    = rand(99,9999);
            
            wp_enqueue_style('foodbakery_map_css', plugins_url('/assets/css/foodbakery-whatsapp.css', __FILE__));
            
            wp_enqueue_script('foodbakery_whatsapp_function_js', plugins_url('/assets/js/functions.js', __FILE__), '', $rand_id, true);
            wp_localize_script('foodbakery_whatsapp_function_js', 'foodbakery_whatsapp_function_js', array(
                'ajax_url' => admin_url( 'admin-ajax.php'),
                )
            );
           
        }

        /**
         * Initialize application, load text domain, enqueue scripts and bind hooks
         */
        public function init()
        {
            global $foodbakery_plugin_options;
            if( isset( $_GET['whatsapp_test'])){
                do_action('foodbakery_received_order_email_before', 49486);
            }
            
            // Add Plugin textdomain
            load_plugin_textdomain(FOODBAKERY_WHATSAPP_PLUGIN_DOMAIN, false, FOODBAKERY_WHATSAPP_LANGUAGES_DIR);
        }

        /**
         * Check plugin dependencies (Foodbakery), nag if missing.
         *
         * @param boolean $disable disable the plugin if true, defaults to false.
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
                $this->admin_notices[] = '<div class="error">' . esc_html__('<em><b>Foodbakery Whatsapp</b></em> needs the <b>Foodbakery</b> plugin. Please install and activate it.', 'foodbakery-whatsapp') . '</div>';
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

        public function foodbakery_whatsapp_notices_callback()
        {
            if (isset($this->admin_notices) && !empty($this->admin_notices)) {
                foreach ($this->admin_notices as $value) {
                    echo $value;
                }
            }
        }

    }

    global $foodbakery_whatsapps;
    $foodbakery_whatsapps = new Foodbakery_Whatsapp();
}