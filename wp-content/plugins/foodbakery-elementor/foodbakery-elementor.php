<?php

/**
 * Plugin Name: Foodbakery Elementor Addon
 * Plugin URI: http://themeforest.net/user/Chimpstudio/
 * Description: Foodbakery Elementor Addon
 * Version: 1.1
 * Author: ChimpStudio
 * Author URI: http://themeforest.net/user/Chimpstudio/
 *
 * @package Foodbakery
 * Text Domain: foodbakery-elementor
 */
// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Foodbakery_Elementor class.
 */
class Foodbakery_Elementor {

    public $admin_notices;

    /**
     * construct function.
     */
    public function __construct() {

        // Define constants
        define('FOODBAKERY_ELEMENTOR_PLUGIN_VERSION', '1.1');
        define('FOODBAKERY_ELEMENTOR_PLUGIN_DOMAIN', 'foodbakery-elementor');
        define('FOODBAKERY_ELEMENTOR_PLUGIN_URL', WP_PLUGIN_URL . '/foodbakery-elementor');
        define('FOODBAKERY_ELEMENTOR_CORE_DIR', WP_PLUGIN_DIR . '/foodbakery-elementor');
        define('FOODBAKERY_ELEMENTOR_LANGUAGES_DIR', FOODBAKERY_ELEMENTOR_CORE_DIR . '/languages');

        $this->admin_notices = array();
        //admin notices
        add_action('admin_notices', array($this, 'foodbakery_elementor_notices_callback'));
        if (!$this->check_dependencies()) {
            return false;
        }
        // Initialize Addon
        add_action('init', array($this, 'init'));

        add_filter('foodbakery_general_plugin_options_block', array($this, 'foodbakery_plugin_settings_general_tab_callback'));
    }

    /**
     * Add Field to Choose Frameworks
     *
     * @param $cs_setting_options
     * @return void
     */
    public function foodbakery_plugin_settings_general_tab_callback($foodbakery_setting_options) {

        if (class_exists('Elementor\Core\Settings\Manager')) {
            $foodbakery_setting_options[] = array(
                'name' => __('Framework', 'foodbakery-elementor'),
                "desc" => __("You will loose the content for all Pages by Swithing Framework.", "foodbakery-elementor"),
                "hint_text" => '',
                'id' => 'foodbakery_framework',
                "std" => "",
                "classes" => "chosen-select",
                "type" => "select",
                "options" => array(
                    'foodbakery_builtin' => esc_html__("Foodbakery Builtin", "foodbakery-elementor"),
                    'elementor' => esc_html__("Elementor", "foodbakery-elementor"),
                )
            );
        }

        return $foodbakery_setting_options;
    }

    /**
     *  Load text domain and enqueue style
     */
    public function init() {
        global $foodbakery_plugin_options;
        $cs_foodbakery_framework = isset($foodbakery_plugin_options['foodbakery_foodbakery_framework']) ? $foodbakery_plugin_options['foodbakery_foodbakery_framework'] : 'foodbakery_builtin';
        // Add Plugin textdomain
        $locale = apply_filters('plugin_locale', get_locale(), 'foodbakery-elementor');
        load_textdomain('foodbakery-elementor', FOODBAKERY_ELEMENTOR_LANGUAGES_DIR . '/foodbakery-elementor' . "-" . $locale . '.mo');
        load_plugin_textdomain('foodbakery-elementor', false, FOODBAKERY_ELEMENTOR_LANGUAGES_DIR);

        // Enqueue CSS
        wp_enqueue_style('foodbakery-elementor-styles', esc_url(FOODBAKERY_ELEMENTOR_PLUGIN_URL . '/assets/css/foodbakery-elementor-style.css'));

        if (isset($_GET['action']) && $_GET['action'] == 'elementor') {
            wp_enqueue_style('foodbakery-elementor-admin-styles', esc_url(FOODBAKERY_ELEMENTOR_PLUGIN_URL . '/assets/css/foodbakery-elementor-admin-style.css'));
        }

        if ($cs_foodbakery_framework == 'elementor') {
            // Include Classes
            require_once 'elements/elements_class.php';
        }


        $cpt_support = get_option('elementor_cpt_support');
        $cpt_support = [ 'page']; //create array of our default supported post types
        update_option('elementor_cpt_support', $cpt_support); //write it to the database
    }

    public function export_elementor_data() {

        $args = array(
            'post_type' => 'any',
            'fields' => 'ids',
            'posts_per_page' => -1,
            'post_status' => 'any',
            'meta_query' => array(
                array(
                    'key' => '_elementor_data',
                    'value' => '',
                    'compare' => '!=',
                ),
            ),
        );
        $query = new WP_Query($args);
        $posts_array = isset($query->posts) ? $query->posts : array();

        $elementor_demo_data = array();

        if (!empty($posts_array)) {
            foreach ($posts_array as $post_id) {
                //if( $post_id == 18162){

                $post = get_post($post_id);
                $post_slug = $post->post_name;
                $post_elementor_data = get_post_meta($post_id, '_elementor_data', true);
                $post_elementor_data = htmlspecialchars($post_elementor_data, ENT_QUOTES);
                $post_elementor_data = htmlspecialchars($post_elementor_data);
                $post_elementor_data = addslashes($post_elementor_data);
                //$post_elementor_data    = serialize($post_elementor_data);

                $elementor_demo_data[$post_slug] = $post_elementor_data;
                //}
            }
        }
        $elementor_demo_data = json_encode($elementor_demo_data);
        echo $elementor_demo_data;
        exit;
    }

    /**
     * Check plugin dependencies (Foodbakery), nag if missing.
     *
     * @param boolean $disable disable the plugin if true, defaults to false.
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
            $this->admin_notices[] = '<div class="error">' . __('<em><b>Foodbakery Elementor</b></em> needs the <b>WP Foodbakery</b> plugin. Please install and activate it.', 'foodbakery-elementor') . '</div>';
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

    public function foodbakery_elementor_notices_callback() {
        foreach ($this->admin_notices as $value) {
            echo $value;
        }
    }

    public static function plugin_path() {
        return untrailingslashit(plugin_dir_path(__FILE__));
    }

    public static function template_path() {
        return apply_filters('wp_pb_elementor_template_path', 'wp-pinboard/');
    }

    public static function foodbakery_elementor_get_template_part($slug = '', $name = '', $ext_template = '') {
        $template = '';

        if ($ext_template != '') {
            $ext_template = trailingslashit($ext_template);
        }
        if ($name) {
            $template = locate_template(array("{$slug}-{$name}.php", Foodbakery_Elementor::template_path() . "{$ext_template}{$slug}-{$name}.php"));
        }
        if (!$template && $name && file_exists(Foodbakery_Elementor::plugin_path() . "/elements/frontend/templates/{$ext_template}{$slug}-{$name}.php")) {

            $template = Foodbakery_Elementor::plugin_path() . "/elements/frontend/templates/{$ext_template}{$slug}-{$name}.php";
        }
        if (!$template) {

            $template = locate_template(array("{$slug}.php", Foodbakery_Elementor::template_path() . "{$ext_template}{$slug}.php"));
        }
        if ($template) {
            echo load_template($template, false);
        }
    }

    /*
     * Get Pages List
     */

    public static function get_pages_list() {
        $args = array(
            'post_type' => 'page', // Set post type to 'page'
            'posts_per_page' => -1, // Retrieve all pages
            'fields' => 'ids', // Retrieve only post IDs
        );

        $query = new WP_Query($args);
        $pages_list = array();

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $pages_list[get_the_ID()]   = get_the_title();
            }
        }
        return $pages_list;
    }

}

new Foodbakery_Elementor();
