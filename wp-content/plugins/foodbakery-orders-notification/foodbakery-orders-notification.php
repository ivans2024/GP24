<?php
/**
 * Plugin Name: Foodbakery Orders Notification
 * Plugin URI: http://themeforest.net/user/Chimpstudio/
 * Description: Foodbakery Orders Notification Add on
 * Version: 3.2
 * Author: ChimpStudio
 * Author URI: http://themeforest.net/user/Chimpstudio/
 * @package Foodbakery
 * Text Domain: fb_orders_notification
 */

// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('foodbakery_orders_notification')) {
    /**
     * Class foodbakery_orders_notification
     */
    class foodbakery_orders_notification
    {
        public $admin_notices; // Explicit property declaration

        /**
         * foodbakery_orders_notification constructor.
         */
        public function __construct()
        {
            // Define constants
            define('FOODBAKERY_ORDERS_NOTIFICATION_PLUGIN_URL', WP_PLUGIN_URL . '/foodbakery-orders-notification');
            define('FOODBAKERY_ORDERS_NOTIFICATION_CORE_DIR', WP_PLUGIN_DIR . '/foodbakery-orders-notification');
            define('FOODBAKERY_ORDERS_NOTIFICATION_INCLUDES_DIR', FOODBAKERY_ORDERS_NOTIFICATION_CORE_DIR . '/includes');
            define('FOODBAKERY_ORDERS_NOTIFICATION_LANGUAGES_DIR', FOODBAKERY_ORDERS_NOTIFICATION_CORE_DIR . '/languages');
            $this->admin_notices = array();
            // admin notices
            add_action('admin_notices', array($this, 'foodbakery_orders_notification_notices_callback'));
            if (!$this->check_dependencies()) {
                return false;
            }

            // enqueue script frontend
            add_action('wp_enqueue_scripts', array($this, 'foodbakery_orders_notification_enqueue'), 20);
            add_action('wp_footer', array($this, 'wp_footer_callback'), 20);
            // include files
            $this->fb_orders_notification_includes();
            /* initialize the text domain for multiple languages */
            add_action( 'init', array( $this, 'init' ), 0 );

        }

        /**
         * enqueue script admin
         */
        public function admin_styles_enqueue(){
            //$rand_id = rand(0001, 1000);
            // Enqueue CSS
            //wp_enqueue_style('foodbakery_orders_notification_style_custom_admin', plugins_url('/assets/css/style_custom_admin.css', __FILE__));
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
                $this->admin_notices[] = '<div class="error">' . __('<em><b>Foodbakery Orders Notification</b></em> needs the <b>Foodbakery</b> plugin. Please install and activate it.', 'fb_orders_notification') . '</div>';
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
            $locale = apply_filters('plugin_locale', get_locale(), 'fb_orders_notification');
            load_textdomain('fb_orders_notification', FOODBAKERY_ORDERS_NOTIFICATION_LANGUAGES_DIR . '/fb_orders_notification' . "-" . $locale . '.mo');
            load_plugin_textdomain('fb_orders_notification', false, FOODBAKERY_ORDERS_NOTIFICATION_LANGUAGES_DIR);
        }

        /**
         * includes the file from front end and backend
         */
        public function fb_orders_notification_includes()
        {
            // Include Classes
            require_once 'includes/frontend/class_orders_notification_frontend.php';
        }

        /**
         *  enqueue script and style
         */
        public function foodbakery_orders_notification_enqueue()
        {
            $rand_id    = rand(99,9999);
            wp_enqueue_script('foodbakery_orders_notification_js', plugins_url('/assets/js/functions.js', __FILE__), '', $rand_id, true);
            wp_localize_script('foodbakery_orders_notification_js', 'foodbakery_customization', array(
                'ajax_url' => admin_url( 'admin-ajax.php'),
                'plugin_url' => content_url().'/plugins/',
                )
            );
        }

        /**
         * admin notifications
         */
        public function foodbakery_orders_notification_notices_callback()
        {
            if (isset($this->admin_notices) && !empty($this->admin_notices)) {
                foreach ($this->admin_notices as $value) {
                    echo $value;
                }
            }
        }
        
        public function wp_footer_callback(){
             global $current_user;

            $user_id = $current_user->ID;
            $publisher_id = foodbakery_company_id_form_user_id($user_id);
            $publisher_type = get_post_meta($publisher_id, 'foodbakery_publisher_profile_type', true);
            if ($publisher_type == 'restaurant') {
                do_action('foodbakery_dashboard_page_end');
            }
        }
    }

    new foodbakery_orders_notification();
}
?>