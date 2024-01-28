<?php
/**
 * Plugin Name: Foodbakery Disable Menu Order
 * Plugin URI: http://themeforest.net/user/Chimpstudio/
 * Description: Foodbakery Disable Menu Order is an Addon for Foodbakery which disables the menu ordering system.
 * Version: 2.0
 * Author: ChimpStudio
 * Author URI: http://themeforest.net/user/Chimpstudio/
 * @package Foodbakery
 * Text Domain: foodbakery-disable-menu-order
 */
// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Foodbakery_Disable_Menu_Order')) {

    class Foodbakery_Disable_Menu_Order
    {

        public $admin_notices;

        /**
         * Start construct Functions
         */
        public function __construct()
        {
            // Define constants
            define('FOODBAKERY_DISABLE_MENU_ORDER_PLUGIN_VERSION', '1.6');
            define('FOODBAKERY_DISABLE_MENU_ORDER_PLUGIN_DOMAIN', 'foodbakery-disable-menu-order');
            define('FOODBAKERY_DISABLE_MENU_ORDER_PLUGIN_URL', WP_PLUGIN_URL . '/foodbakery-disable-menu-order');
            define('FOODBAKERY_DISABLE_MENU_ORDER_CORE_DIR', WP_PLUGIN_DIR . '/foodbakery-disable-menu-order');
            define('FOODBAKERY_DISABLE_MENU_ORDER_LANGUAGES_DIR', FOODBAKERY_DISABLE_MENU_ORDER_CORE_DIR . '/languages');

            $this->admin_notices = array();
            //admin notices
            add_action('admin_notices', array($this, 'foodbakery_disable_menu_order_notices_callback'));
            if (!$this->check_dependencies()) {
                return false;
            }
            
            // Initialize Addon
            add_action('init', array($this, 'init'), 500);
            
            // Include Classes
            require_once 'includes/frontend/class-disable-menu-order-frontend.php';
            require_once 'includes/backend/class-disable-menu-order-backend.php';

        }

        /**
         * Initialize application, load text domain, enqueue scripts and bind hooks
         */
        public function init()
        {
            global $foodbakery_plugin_options;
            // Add Plugin textdomain
            load_plugin_textdomain(FOODBAKERY_DISABLE_MENU_ORDER_PLUGIN_DOMAIN, false, FOODBAKERY_DISABLE_MENU_ORDER_LANGUAGES_DIR);
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
                $this->admin_notices[] = '<div class="error">' . esc_html__('<em><b>Foodbakery Disable Menu Order</b></em> needs the <b>Foodbakery</b> plugin. Please install and activate it.', 'foodbakery-disable-menu-order') . '</div>';
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

        public function foodbakery_disable_menu_order_notices_callback()
        {
            if (isset($this->admin_notices) && !empty($this->admin_notices)) {
                foreach ($this->admin_notices as $value) {
                    echo $value;
                }
            }
        }

    }

    global $foodbakery_disable_menu_orders;
    $foodbakery_disable_menu_orders = new Foodbakery_Disable_Menu_Order();
}
