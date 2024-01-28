<?php
/**display_name
 * Plugin Name: Foodbakery Time Format
 * Plugin URI: http://themeforest.net/user/Chimpstudio/
 * Description: Foodbakery Time Format Add on
 * Version: 1.0
 * Author: ChimpStudio
 * Author URI: http://themeforest.net/user/Chimpstudio/
 * @package Foodbakery
 * Text Domain: food_timeformat
 */

// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Foodbakery Customization class.
 */
class Foodbakery_timeformat
{

    public $admin_notices;

    /**
     * construct function.
     */
    public function __construct()
    {
        // Define constants
        define('TIMEFORMAT_CORE_DIR', WP_PLUGIN_DIR . '/foodbakery-timeformat');
        define('TIMEFORMAT_PLUGIN_URL', WP_PLUGIN_URL . '/foodbakery-timeformat');
        define('TIMEFORMAT_INCLUDES_DIR', TIMEFORMAT_CORE_DIR . '/includes');
        define('TIMEFORMAT_LANGUAGES_DIR', TIMEFORMAT_CORE_DIR . '/languages');
        $this->admin_notices = array();
        //admin notices
        add_action('admin_notices', array($this, 'foodbakery_timeformat_notices_callback'));
        // Initialize Addon
        add_action('init', array($this, 'init'));

        add_action('wp_enqueue_scripts', array($this, 'restaurant_dequeue_script_callback'));

        if (!$this->check_dependencies()) {
            return false;
        }
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
        $wp_foodbakery_is_active = in_array('wp-foodbakery/wp-foodbakery.php', $active_plugins);
        if (!$wp_foodbakery_is_active) {
            $this->admin_notices[] = '<div class="error">' . __('<em><b>Foodbakery Time Format</b></em> needs the <b>WP Foodbakery</b> plugin. Please install and activate it.', 'food_timeformat') . '</div>';
        }
        if (!$wp_foodbakery_is_active) {
            if ($disable) {
                include_once(ABSPATH . 'wp-admin/includes/plugin.php');
                deactivate_plugins(array(__FILE__));
            }
            $result = false;
        }
        return $result;
    }

    /**
     *  Initialize add on
     */
    public function init()
    {
        // Languages
        $locale = apply_filters('plugin_locale', get_locale(), 'foodbakery-zipcode');
        load_textdomain('food_timeformat', TIMEFORMAT_LANGUAGES_DIR . '/foodbakery-timeformat' . "-" . $locale . '.mo');
        load_plugin_textdomain('food_timeformat', false, TIMEFORMAT_LANGUAGES_DIR);

        $location_levels = array(
            esc_html__('country', 'food_timeformat'),
            esc_html__('state', 'food_timeformat'),
            esc_html__('county', 'food_timeformat'),
            esc_html__('city', 'food_timeformat'),
            esc_html__('town', 'food_timeformat'),
        );
        add_option('foodbakery_locations_levels', serialize($location_levels));
        if(is_admin()){
            // Enqueue CSS
            wp_enqueue_style('foodbakery-timeformat-admin-style', TIMEFORMAT_PLUGIN_URL . '/assets/css/foodbakery_timeformat_backend.css');
            // Enqueue JS
            wp_enqueue_script('foodbakery-timeformat-admin-script', TIMEFORMAT_PLUGIN_URL . '/assets/js/foodbakery_timeformat_admin.js', '', '', true);
        }else{
            // Enqueue JS
            wp_enqueue_script('foodbakery-timeformat-script', TIMEFORMAT_PLUGIN_URL . '/assets/js/foodbakery_timeformat.js', '', '', true);
            // Enqueue CSS
            wp_enqueue_style('foodbakery-timeformat-style', TIMEFORMAT_PLUGIN_URL . '/assets/css/foodbakery_timeformat.css');
        }

        require_once(TIMEFORMAT_INCLUDES_DIR . '/frontend/class-opening-hours-format.php');
        require_once(TIMEFORMAT_INCLUDES_DIR . '/backend/class-opening-hours-format-backend.php');
        require_once(TIMEFORMAT_INCLUDES_DIR . '/frontend/class-price-label.php');
        require_once(TIMEFORMAT_INCLUDES_DIR . '/backend/class-moh-back-fields.php');
        require_once(TIMEFORMAT_INCLUDES_DIR . '/frontend/class-moh-frontend.php');
        require_once(TIMEFORMAT_INCLUDES_DIR . '/frontend/class-moh-front-fields.php');
        
    }

    /**
     * Dequeue script
     */
    public function restaurant_dequeue_script_callback(){
        wp_deregister_style('bootstrap-datepicker');
        wp_deregister_script('bootstrap-datepicker');
        wp_deregister_script('datetimepicker');
        wp_enqueue_script('jquery_datetimepicker', trailingslashit(get_template_directory_uri()) . 'assets/backend/js/jquery_datetimepicker.js');
    }

    /**
     * Admin notices for Restaurant Customization
     */
    public function foodbakery_timeformat_notices_callback()
    {
        if (isset($this->admin_notices) && !empty($this->admin_notices)) {
            foreach ($this->admin_notices as $value) {
                echo $value;
            }
        }
    }

}

new Foodbakery_timeformat();
