<?php

/**
 * Defines configurations for Theme, Framework Plugin and rating plugin
 *
 * @since	1.0
 * @package	WordPress
 */

define('DEMO_DATA_HOME_URL', 'http://foodbakery.chimpgroup.com/{{{demo_data_name}}}');
if ( ! defined('CS_HOME_BASE') ) {
    define('CS_HOME_BASE', get_home_url());
}
/*
 * THEME_ENVATO_ID contains theme unique id at envator
 */
if ( ! defined('THEME_ENVATO_ID') ) {
    define('THEME_ENVATO_ID', '18970331');
}

/*
 * THEME_NAME contains the name of the current theme
 */
if ( ! defined('THEME_NAME') ) {
    define('THEME_NAME', 'foodbakery');
}

/*
 * THEME_TEXT_DOMAIN contains the text domain name used for this theme
 */
if ( ! defined('THEME_TEXT_DOMAIN') ) {
    define('THEME_TEXT_DOMAIN', 'foodbakery');
}

/*
 * THEME_OPTIONS_PAGE_SLUG contains theme optinos main page slug
 */
if ( ! defined('THEME_OPTIONS_PAGE_SLUG') ) {
    define('THEME_OPTIONS_PAGE_SLUG', 'foodbakery_theme_options_constructor');
}

/*
 * CS_JOB_HUNT_STABLE_VERSION contains job hunt stable version compitble with this theme version
 */
if ( ! defined('CS_FOODBAKERY_RATINGS_STABLE_VERSION') ) {
    define('CS_FOODBAKERY_RATINGS_STABLE_VERSION', '1.0');
}

/*
 * CS_FRAMEWORK_STABLE_VERSION contains cs framework stable version compitble with this theme version
 */
if ( ! defined('CS_FOODBAKERY_FRAMEWORK_STABLE_VERSION') ) {
    define('CS_FOODBAKERY_FRAMEWORK_STABLE_VERSION', '1.0');
}

/*
 * CS_BASE contains the root server path of the framework that is loaded
 */
if ( ! defined('CS_BASE') ) {
    define('CS_BASE', get_template_directory() . '/');
}

/*
 * CS_BASE_URL contains the http url of the framework that is loaded
 */
if ( ! defined('CS_BASE_URL') ) {
    define('CS_BASE_URL', get_template_directory_uri() . '/');
}

/*
 * DEFAULT_DEMO_DATA_NAME contains the default demo data name used by CS importer
 */
if ( ! defined('DEFAULT_DEMO_DATA_NAME') ) {
    define('DEFAULT_DEMO_DATA_NAME', 'foodbakery');
}

if ( ! defined('DEFAULT_THEME_NAME') ) {
    define('DEFAULT_THEME_NAME', 'foodbakery');
}

/*
 * DEFAULT_DEMO_DATA_URL contains the default demo data url used by CS importer
 */
if ( ! defined('DEFAULT_DEMO_DATA_URL') ) {
    define('DEFAULT_DEMO_DATA_URL', 'http://foodbakery.chimpgroup.com/wp-content/uploads/');
}

/*
 * DEMO_DATA_URL contains the demo data url used by CS importer
 */
if ( ! defined('DEMO_DATA_URL') ) {
    define('DEMO_DATA_URL', 'http://foodbakery.chimpgroup.com/{{{demo_data_name}}}/wp-content/uploads/');
}

/*
 * REMOTE_API_URL contains the api url used for envator purchase key verification
 */
if ( ! defined('REMOTE_API_URL') ) {
    define('REMOTE_API_URL', 'http://chimpgroup.com/wp-demo/webservice/');
}

/*
 * ATTACHMENTS_REPLACE_URL contains the URL to be replaced in WP content XML attachments
 */
if ( ! defined('ATTACHMENTS_REPLACE_URL') ) {
    define('ATTACHMENTS_REPLACE_URL', 'http://foodbakery.chimpgroup.com/wp-content/uploads/');
}

/*
 * Theme Backup Foodbakery Path
 */
if ( ! defined('AUTO_UPGRADE_BACKUP_DIR') ) {
    define('AUTO_UPGRADE_BACKUP_DIR', WP_CONTENT_DIR . '/' . THEME_NAME . '-backups/');
}

if ( ! function_exists('get_demo_data_structure') ) {

    /**
     * Return Demo datas available
     *
     * @return	array	details of demo datas available
     */
    function get_demo_data_structure() {
        $demo_data_structure = array(
            'foodbakery' => array(
                'slug' => 'foodbakery',
                'name' => 'Food Bakery',
                'image_url' => 'http://chimpgroup.com/wp-demo/webservice/demo_images/foodbakery/foodbakery.png',
            ),
            'homev1' => array(
                'slug' => 'homev1',
                'name' => 'Mexican Restaurant',
                'image_url' => 'http://chimpgroup.com/wp-demo/webservice/demo_images/foodbakery/homev1.png',
            ),
            'foodstop' => array(
                'slug' => 'foodstop',
                'name' => 'Food Stop',
                'image_url' => 'http://chimpgroup.com/wp-demo/webservice/demo_images/foodbakery/foodstop.png',
            ),
            'foodcourt' => array(
                'slug' => 'foodcourt',
                'name' => 'Food Court',
                'image_url' => 'http://chimpgroup.com/wp-demo/webservice/demo_images/foodbakery/foodcourt.png',
            ),
            'single-restaurant' => array(
                'slug' => 'single-restaurant',
                'name' => 'Single Restaurant',
                'image_url' => 'http://chimpgroup.com/wp-demo/webservice/demo_images/foodbakery/single-restaurant.png',
            ),
            'le-delicious' => array(
                'slug' => 'le-delicious',
                'name' => 'Le Delicious',
                'image_url' => 'http://chimpgroup.com/wp-demo/webservice/demo_images/foodbakery/le-delicious.png',
            ),
            'grocbakery' => array(
                'slug' => 'grocbakery',
                'name' => 'GROCBAKERY',
                //'image_url' => 'http://chimpgroup.com/wp-demo/webservice/demo_images/foodbakery/le-delicious.png',
                'image_url' => 'http://chimpgroup.com/wp-demo/webservice/demo_images/foodbakery/grocbakery.png',
            ),
            'rtl' => array(
                'slug' => 'rtl',
                'name' => 'RTL Demo',
                'image_url' => 'http://chimpgroup.com/wp-demo/webservice/demo_images/foodbakery/rtl.jpg',
            ),
        );
        return $demo_data_structure;
    }

}

if ( ! function_exists('get_server_requirements') ) {

    /**
     * Return server requirements for importer
     *
     * @return	array	server resources requirements for importer
     */
    function get_server_requirements() {
        $post_max_size = ini_get('post_max_size');
        $post_max_size_val = str_replace('M', '', $post_max_size);
        $upload_max_filesize = ini_get('upload_max_filesize');
        $upload_max_filesize_val = str_replace('M', '', $upload_max_filesize);
        $memory_limit = ini_get('memory_limit');
        $memory_limit_val = str_replace('M', '', $memory_limit);
        $max_input_time = ini_get('max_input_time');
        $max_execution_time = ini_get('max_execution_time');
        $max_input_vars = ini_get('max_input_vars');
        $safe_mode = ini_get('safe_mode');
        $safe_mode = ( $safe_mode == '')? 'OFF' : 'ON';
        
        
        $recommended_php_version = '7.0';
        $recommended_post_max_size = 256;
        $recommended_post_max_size_unit = 'M';
        $recommended_upload_max_filesize = 256;
        $recommended_upload_max_filesize_unit = 'M';
        $recommended_memory_limit = 256;
        
        $recommended_max_input_time = '300 or -1';
        $recommended_max_execution_time = '300 or 0';
        $recommended_max_input_vars = '5000 or above';
        $recommended_safe_mode = 'OFF';
        
        $recommended_memory_limit_unit = 'M';

        $server_requirements = array(
            array(
                'title' => 'Minimum PHP Version = ' . $recommended_php_version . ' ( Available ' . phpversion() . ' )',
                'description' => esc_html__('To run this theme properly, mentioned min. php version is required.', 'foodbakery'),
                'version' => '',
                'is_met' => ( version_compare(phpversion(), $recommended_php_version, '>') ),
            ),
            array(
                'title' => 'post_max_size = ' . $recommended_post_max_size . $recommended_post_max_size_unit . ' ( Available ' . $post_max_size . ' )',
                'description' => esc_html__('Sets max. size of post data allowed. This setting also affects file upload.', 'foodbakery'),
                'version' => '',
                'is_met' => ( $recommended_post_max_size <= $post_max_size_val ),
            ),
            array(
                'title' => 'upload_max_filesize = ' . $recommended_upload_max_filesize . $recommended_upload_max_filesize_unit . ' ( Available ' . $upload_max_filesize . ' )',
                'description' => esc_html__('The max. size of a file that can be uploaded.', 'foodbakery'),
                'version' => '',
                'is_met' => ( $recommended_upload_max_filesize <= $upload_max_filesize_val ),
            ),
            array(
                'title' => 'memory_limit = ' . $recommended_memory_limit . $recommended_memory_limit_unit . ' ( Available ' . $memory_limit . ' )',
                'description' => esc_html__('This sets the max. memory that a script is allowed to allocate.', 'foodbakery'),
                'version' => '',
                'is_met' => ( $recommended_memory_limit <= $memory_limit_val ),
            ),
            
            
            
            array(
                'title' => 'max_input_time = ' . $recommended_max_input_time . ' ( Available ' . $max_input_time . ' )',
                'description' => esc_html__('This sets the max. input time that a script is allowed to allocate.', 'foodbakery'),
                'version' => '',
                'is_met' => ( $max_input_time == -1 || $max_input_time >= 300 ),
            ),
            
            array(
                'title' => 'max_execution_time = ' . $recommended_max_execution_time . ' ( Available ' . $max_execution_time . ' )',
                'description' => esc_html__('This sets the max. execution time that a script is allowed to allocate.', 'foodbakery'),
                'version' => '',
                'is_met' => ( $max_execution_time == 0 || $max_execution_time >= 300 ),
            ),
            
            array(
                'title' => 'max_input_vars = ' . $recommended_max_input_vars . ' ( Available ' . $max_input_vars . ' )',
                'description' => esc_html__('This sets the max. vars that a script is allowed to allocate.', 'foodbakery'),
                'version' => '',
                'is_met' => ( $max_input_vars >= 5000 ),
            ),
            array(
                'title' => 'safe_mode = ' . $recommended_safe_mode . ' ( Available ' . $safe_mode . ' )',
                'description' => esc_html__('Ask hosting provider to disable safe mode.', 'foodbakery'),
                'version' => '',
                'is_met' => ( $safe_mode == 'OFF' ),
            ),
            
            
            
            
            
            array(
                'title' => 'allow_url_fopen should be enabled in php.ini',
                'description' => esc_html__('This allows php to retrieve data remotely.', 'foodbakery'),
                'version' => '',
                'is_met' => ini_get('allow_url_fopen'),
            ),
        );
        return $server_requirements;
    }

}

if ( ! function_exists('get_plugin_requirements') ) {

    /**
     * Return plugin requirements for importer
     *
     * @return	array	plugin requirements for importer
     */
    function get_plugin_requirements() {
        // Default compatible plugin versions.
        $compatible_plugin_versions = array(
            'cs_foodbakery_framework' => CS_FOODBAKERY_FRAMEWORK_STABLE_VERSION,
            'foodbakery_ratings' => CS_FOODBAKERY_RATINGS_STABLE_VERSION,
        );
        // Check if there is a need to prompt user to install theme.
        $is_cs_foodbakery_framework = class_exists('wp_foodbakery_framework');
        $current_version_cs_foodbakery_framework = '0.0';
        $have_new_version_cs_foodbakery_framework = false;
        if ( $is_cs_foodbakery_framework ) {
            $current_version_cs_foodbakery_framework = wp_foodbakery_framework::get_plugin_version();
            $new_version_cs_foodbakery_framework = $compatible_plugin_versions['cs_foodbakery_framework'];
            if ( version_compare($current_version_cs_foodbakery_framework, $new_version_cs_foodbakery_framework) < 0 ) {
                $is_cs_foodbakery_foodbakery_framework = false;
                $have_new_version_cs_foodbakery_framework = true;
            }
        }
        // Check if there is a need to prompt user to install theme.
        $is_foodbakery = class_exists('Foodbakery_Ratings');
        $current_version_foodbakery_ratings = '0.0';
        $have_new_version_foodbakery = false;
        if ( $is_foodbakery ) {
            $current_version_foodbakery_ratings = wp_foodbakery::get_plugin_version();
            $new_version_foodbakery = $compatible_plugin_versions['cs_wp_foodbakery'];
            if ( version_compare($current_version_foodbakery_ratings, $new_version_foodbakery) < 0 ) {
                $is_foodbakery = false;
                $have_new_version_foodbakery = true;
            }
        }



        $is_cs_foodbakery = class_exists('wp_foodbakery');

        // Check if there is a need to prompt user to install theme.
        $is_rev_slider = class_exists('RevSlider');
        $have_new_version_rev_slider = false;
        $current_version_rev_slider = '0.0';
        if ( $is_rev_slider ) {
            $current_version_rev_slider = RevSliderGlobals::SLIDER_REVISION;
            $new_version_rev_slider = get_option('revslider-latest-version', RevSliderGlobals::SLIDER_REVISION);
            if ( empty($new_version_rev_slider) ) {
                $new_version_rev_slider = '5.2.5';
            }

            if ( version_compare($current_version_rev_slider, $new_version_rev_slider) < 0 ) {
                $is_rev_slider = false;
                $have_new_version_rev_slider = true;
            }
        }
        
        $foodbakery_class =new wp_foodbakery();
        
        
        $plugin_requirements = array(
            'cs_foodbakery_framework' => array(
                'title' => esc_html__('CS Foodbakery Framework', 'foodbakery'),
                'description' => esc_html__('This plugin is required as this handles the core functionality of the theme.', 'foodbakery'),
                'version' => $current_version_cs_foodbakery_framework,
                'new_version' => ( true == $have_new_version_cs_foodbakery_framework ) ? $new_version_cs_foodbakery_framework : '',
                'is_installed' => $is_cs_foodbakery_framework,
            ),
            'foodbakery_var' => array(
                'title' => esc_html__('Foodbakery Plugin', 'foodbakery'),
                'description' => esc_html__('This plugin is required as this handles the core functionality of the theme.', 'foodbakery'),
                'version' => $foodbakery_class->get_plugin_version(),
                'is_installed' => $is_cs_foodbakery,
            ),
            'rev_slider' => array(
                'title' => esc_html__('Revolution Slider', 'foodbakery'),
                'description' => esc_html__('This plugin is required to import Revolution sliders from demo data.', 'foodbakery'),
                'version' => $current_version_rev_slider,
                'new_version' => ( true == $have_new_version_rev_slider ) ? $new_version_rev_slider : '',
                'is_installed' => $is_rev_slider,
            ),
        );
        return $plugin_requirements;
    }

}

if ( ! function_exists('get_mandaory_plugins') ) {

    /**
     * Give a list of the plugins pluings need to be updated (used Auto Theme Upgrader)
     *
     * @return	array	a list of plugins which will be updated on Auto Theme update
     */
    function get_plugins_to_be_updated() {
        return array(
            array(
                'name' => esc_html__('CS Foodbakery Framework', 'foodbakery'),
                'slug' => 'foodbakery-framework',
                'source' => trailingslashit(get_template_directory_uri()) . 'include/backend/cs-activation-plugins/foodbakery-framework.zip',
                'required' => true,
                'version' => '',
                'force_activation' => true,
                'force_deactivation' => true,
                'external_url' => '',
            ),
        );
    }

}