<?php
/**
 * Plugin Name: Foodbakery IVAN
 * Plugin URI: http://themeforest.net/user/Chimpstudio/
 * Description: Foodbakery IVAN Add on
 * Version: 1.0
 * Author: ChimpStudio
 * Author URI: http://themeforest.net/user/Chimpstudio/
 * @package Foodbakery
 * Text Domain: foodbakery-ivan
 */
// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Foodbakery_Time_Zones')) {

    class Foodbakery_Time_Zones
    {

        public $admin_notices;

        /**
         * Start construct Functions
         */
        public function __construct()
        {
            // Define constants
            define('FOODBAKERY_IVAN_PLUGIN_VERSION', '1.6');
            define('FOODBAKERY_IVAN_PLUGIN_DOMAIN', 'foodbakery-ivan');
            define('FOODBAKERY_IVAN_PLUGIN_URL', WP_PLUGIN_URL . '/foodbakery-ivan');
            define('FOODBAKERY_IVAN_CORE_DIR', WP_PLUGIN_DIR . '/foodbakery-ivan');
            define('FOODBAKERY_IVAN_LANGUAGES_DIR', FOODBAKERY_IVAN_CORE_DIR . '/languages');

            $this->admin_notices = array();
            //admin notices
            add_action('admin_notices', array($this, 'foodbakery_ivan_notices_callback'));
            if (!$this->check_dependencies()) {
                return false;
            }
            
            // Initialize Addon
            add_action('init', array($this, 'init'), 500);
            
            add_action('wp_footer', array($this, 'wp_footer_callback'), 20);
            
            // Include Classes
            require_once 'includes/frontend/class_orders_notification_frontend.php';
            require_once 'includes/backend/orders-checks.php';
            require_once 'includes/backend/cash-module-disable-backend.php';
            require_once 'includes/frontend/cash-module-disable-frontend.php';
            require_once 'includes/frontend/time_zones_frontend.php';

        }

        /**
         * Initialize application, load text domain, enqueue scripts and bind hooks
         */
        public function init()
        {
            global $foodbakery_plugin_options;
            // Add Plugin textdomain
            load_plugin_textdomain(FOODBAKERY_IVAN_PLUGIN_DOMAIN, false, FOODBAKERY_IVAN_LANGUAGES_DIR);
            
            
            //wp_register_style('foodbakery-ivan-style', plugins_url('/assets/css/foodbakery-ivan.css', __FILE__));
            
            // Enqueue JS
            wp_enqueue_script('foodbakery-ivan-script', esc_url(FOODBAKERY_IVAN_PLUGIN_URL . '/assets/js/functions.js'), '', FOODBAKERY_IVAN_PLUGIN_DOMAIN, true);
            
            wp_localize_script('foodbakery-ivan-script', 'foodbakery_ivan', array(
                'ajax_url' => esc_url(admin_url('admin-ajax.php')),
            ));
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
            $foodbakery_notifications_is_active = in_array('foodbakery-orders-notification/foodbakery-orders-notification.php', $active_plugins);
            
            if (!$foodbakery_is_active) {
                $this->admin_notices[] = '<div class="error">' . esc_html__('<em><b>Foodbakery IVAN</b></em> needs the <b>Foodbakery</b> plugin. Please install and activate it.', 'foodbakery-ivan') . '</div>';
            }
            if (!$foodbakery_is_active) {
                if ($disable) {
                    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
                    deactivate_plugins(array(__FILE__));
                }
                $result = false;
            }
            
            if ($foodbakery_notifications_is_active) {
                include_once(ABSPATH . 'wp-admin/includes/plugin.php');
                deactivate_plugins(array('foodbakery-orders-notification/foodbakery-orders-notification.php'));
            }
            
            return $result;
        }

        public function foodbakery_ivan_notices_callback()
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
            
            echo "<script type='text/javascript'>
                jQuery(function () {
                    jQuery('#datetimepicker_cust').datetimepicker({
                        format: 'H:i',
                        timepicker: true,
                        startDate: false,
                        datepicker: false,
                        step: 30
                    });
                    var isMobile = false;
                    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                         isMobile = true;
                        }
                    if( isMobile == false){
                    	jQuery('#datetimepicker_cust').focus();
                    	jQuery('#mc_email1').focus();
                    }
                });
            </script>";
        }

    }

    global $foodbakery_ivans;
    $foodbakery_ivans = new Foodbakery_Time_Zones();
}