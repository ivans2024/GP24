<?php
/**
 * Plugin Name: Foodbakery Sticky Cart
 * Plugin URI: http://themeforest.net/user/Chimpstudio/
 * Description: Sticky Cart Customization Add on
 * Version: 3.2
 * Author: ChimpStudio
 * Author URI: http://themeforest.net/user/Chimpstudio/
 * @package Foodbakery
 * Text Domain: foodbakery-sticky-cart
 * @package	Foodbakery
 */
// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Foodbakery_Stikcy_Cart')) {
    /**
     * Class Foodbakery_Stikcy_Cart
     */
    class Foodbakery_Stikcy_Cart {

        public $admin_notices;

        /**
         * Start construct Functions
         */
        public function __construct() {
            // Define constants
            define('FOODBAKERY_STICKY_CART_PLUGIN_URL', WP_PLUGIN_URL . '/foodbakery-sticky-cart');
            define('FOODBAKERY_STICKY_CART_CORE_DIR', WP_PLUGIN_DIR . '/foodbakery-sticky-cart');
            define('FOODBAKERY_STICKY_CART_INCLUDES_DIR', FOODBAKERY_STICKY_CART_CORE_DIR . '/includes');
            define('FOODBAKERY_STICKY_CART_LANGUAGES_DIR', FOODBAKERY_STICKY_CART_CORE_DIR . '/languages');
            $this->admin_notices = array();
            //admin notices
            add_action('admin_notices', array($this, 'foodbakery_sticky_cart_notices_callback'));
            if (!$this->check_dependencies()) {
                return false;
            }

            // Include Classes
            require_once 'includes/backend/stickery_cart_backend.php';
            require_once 'includes/frontend/stickey_cart_in_footer.php';

            // enqueue script
            add_action('wp_enqueue_scripts', array($this, 'foodbakery_sticky_cart_scripts_callback'), 20);

            // Initialize Addon
            add_action('init', array($this, 'init'), 20);
        }

        /**
         * Initialize application, load text domain, enqueue scripts and bind hooks
         */
        public function init() {
            // Add Plugin textdomain
            $locale = apply_filters('plugin_locale', get_locale(), 'foodbakery-sticky-cart');
            load_textdomain('foodbakery-sticky-cart', FOODBAKERY_STICKY_CART_LANGUAGES_DIR . '/foodbakery-sticky-cart' . "-" . $locale . '.mo');
            load_plugin_textdomain('foodbakery-sticky-cart', false, FOODBAKERY_STICKY_CART_LANGUAGES_DIR);
        }

        /**
         *  enqueue script and style
         */
        public function foodbakery_sticky_cart_scripts_callback() {

            // Enqueue CSS
            wp_enqueue_style('foodbakery-sticky-cart', plugins_url('/assets/css/style.css', __FILE__));

            // Enqueue JS
            wp_enqueue_script('foodbakery-sticky-cart', plugins_url('/assets/js/functions.js', __FILE__), '', '', true);
        }

        /**
         * @param bool $disable
         * @return bool
         */
        public function check_dependencies($disable = false) {
            $result = true;
            $active_plugins = get_option('active_plugins', array());
            if (is_multisite()) {
                $active_sitewide_plugins = get_site_option('active_sitewide_plugins', array());
                $active_sitewide_plugins = array_keys($active_sitewide_plugins);
                $active_plugins = array_merge($active_plugins, $active_sitewide_plugins);
            }
            $foodbakery_is_active = in_array('wp-foodbakery/wp-foodbakery.php', $active_plugins);
            if (!$foodbakery_is_active) {
                $this->admin_notices[] = '<div class="error">' . __('<em><b>Foodbakery Sticky Cart</b></em> needs the <b>Foodbakery</b> plugin. Please install and activate it.', 'foodbakery-sticky-cart') . '</div>';
            }
            if (!$foodbakery_is_active) {
                if ($disable) {
                    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                    deactivate_plugins(array(__FILE__));
                }
                $result = false;
            }
            return $result;
        }

        /**
         * admin notifications
         */
        public function foodbakery_sticky_cart_notices_callback() {
            if (isset($this->admin_notices) && !empty($this->admin_notices)) {
                foreach ($this->admin_notices as $value) {
                    echo $value;
                }
            }
        }

    }

    new Foodbakery_Stikcy_Cart();
}
