<?php

/*
 * tgm class for 
 * (internal and WordPress repository) 
 * plugin activation start
 */

foodbakery_include_file(trailingslashit(get_template_directory()) . 'include/backend/cs-activation-plugins/class-tgm-plugin-activation.php');

if (!function_exists('foodbakery_var_register_required_plugins')) {
    add_action('tgmpa_register', 'foodbakery_var_register_required_plugins');

    function foodbakery_var_register_required_plugins() {
        global $foodbakery_var_static_text;
        $strings = new foodbakery_theme_all_strings;
        $strings->foodbakery_plugin_activation_strings();


        /*
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */

        $plugins = array(
            /*
             * This is an example of how to include a plugin from the WordPress Plugin Repository.
             */
            array(
                'name' => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_revolution_slider'),
                'slug' => 'revslider',
                'source' => 'https://chimpgroup.com/wp-demo/download-plugin/revslider.zip',
                'required' => true,
                'version' => '5.4.3',
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => '',
            ),
            array(
                'name' => foodbakery_var_theme_text_srt('foodbakery_var_framework'),
                'slug' => 'foodbakery-framework',
                'source' => 'https://chimpgroup.com/wp-demo/download-plugin/foodbakery/foodbakery-framework.zip',
                'required' => true,
                'version' => '1.3',
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => '',
            ),
            array(
                'name' => foodbakery_var_theme_text_srt('foodbakery_var_wp_foodbakery'),
                'slug' => 'wp-foodbakery',
                'source' => 'https://chimpgroup.com/wp-demo/download-plugin/foodbakery/wp-foodbakery.zip',
                'required' => true,
                'version' => '3.6',
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => '',
            ),
            array(
                'name' => foodbakery_var_theme_text_srt('foodbakery_var_sticky_cart'),
                'slug' => 'foodbakery-sticky-cart',
                'source' => 'https://chimpgroup.com/wp-demo/download-plugin/foodbakery/foodbakery-sticky-cart.zip',
                'required' => true,
                'version' => '1.0',
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => '',
            ),
            array(
                'name' => foodbakery_var_theme_text_srt('foodbakery_var_foodbakery_shortlists'),
                'slug' => 'foodbakery-shortlists',
                'source' => 'https://chimpgroup.com/wp-demo/download-plugin/foodbakery/foodbakery-shortlists.zip',
                'required' => true,
                'version' => '1.3',
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => '',
            ),
            array(
                'name' => foodbakery_var_theme_text_srt('foodbakery_var_foodbakery_email_templates'),
                'slug' => 'foodbakery-email-templates',
                'source' => 'https://chimpgroup.com/wp-demo/download-plugin/foodbakery/foodbakery-email-templates.zip',
                'required' => true,
                'version' => '1.3',
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => '',
            ),
            array(
                'name' => foodbakery_var_theme_text_srt('foodbakery_var_foodbakery_multi_opening_hours'),
                'slug' => 'foodbakery-multi-opening-hours',
                'source' => 'https://chimpgroup.com/wp-demo/download-plugin/foodbakery/foodbakery-multi-opening-hours.zip',
                'required' => true,
                'version' => '1.0',
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => '',
            ),
            array(
                'name' => foodbakery_var_theme_text_srt('foodbakery_var_foodbakery_orders_notification'),
                'slug' => 'foodbakery-orders-notification',
                'source' => 'https://chimpgroup.com/wp-demo/download-plugin/foodbakery/foodbakery-orders-notification.zip',
                'required' => true,
                'version' => '1.0',
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => '',
            ),
            array(
                'name' => foodbakery_var_theme_text_srt('foodbakery_var_foodbakery_disable_menu_ordering'),
                'slug' => 'foodbakery-disable-menu-order',
                'source' => 'https://chimpgroup.com/wp-demo/download-plugin/foodbakery/foodbakery-disable-menu-order.zip',
                'required' => false,
                'version' => '1.0',
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => '',
            ),
            array(
                'name' => foodbakery_var_theme_text_srt('foodbakery_var_loco_translate'),
                'slug' => 'loco-translate',
                'required' => true,
                'version' => '2.0.14',
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => '',
            ),
            array(
                'name' => foodbakery_var_theme_text_srt('foodbakery_var_foodbakery_woocommerce'),
                'slug' => 'woocommerce',
                'required' => true,
                'version' => '3.3.5',
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => '',
            ),
        ); 
        /*
         * Change this to your theme text domain, used for internationalising strings
         */
        $theme_text_domain = 'foodbakery';
        /**
         * Array of configuration settings. Amend each line as needed.
         * If you want the default strings to be available under your own theme domain,
         * leave the strings uncommented.
         * Some of the strings are added into a sprintf, so see the comments at the
         * end of each line for what each argument will be.
         */
        $config = array(
            'domain' => 'foodbakery', /* Text domain - likely want to be the same as your theme. */
            'default_path' => '', /* Default absolute path to pre-packaged plugins */
            'parent_slug' => 'themes.php', /* Default parent menu slug */
            //'parent_menu_slug' => 'themes.php', /* Default parent menu slug */
            //'parent_url_slug' => 'themes.php', /* Default parent URL slug */
            'menu' => 'install-required-plugins', /* Menu slug */
            'has_notices' => true, /* Show admin notices or not */
            'is_automatic' => true, /* Automatically activate plugins after installation or not */
            'message' => '', /* Message to output right before the plugins table */
            'strings' => array(
                'page_title' => foodbakery_var_theme_text_srt('foodbakery_var_install_require_plugins'),
                'menu_title' => foodbakery_var_theme_text_srt('foodbakery_var_install_plugins'),
                'installing' => foodbakery_var_theme_text_srt('foodbakery_var_installing_plugins'), /* %1$s = plugin name */
                'oops' => foodbakery_var_theme_text_srt('foodbakery_var_wrong'),
                'notice_can_install_required' => foodbakery_var_theme_text_srt('foodbakery_var_notice_can_install_required'), /* %1$s = plugin name(s) */
                'notice_can_install_recommended' => foodbakery_var_theme_text_srt('foodbakery_var_notice_can_install_recommended'), /* %1$s = plugin name(s) */
                'notice_cannot_install' => foodbakery_var_theme_text_srt('foodbakery_var_sorry'), /* %1$s = plugin name(s) */
                'notice_can_activate_required' => foodbakery_var_theme_text_srt('foodbakery_var_notice_can_activate_required'), /* %1$s = plugin name(s) */
                'notice_can_activate_recommended' => foodbakery_var_theme_text_srt('foodbakery_var_notice_can_activate_recommended'), /* %1$s = plugin name(s) */
                'notice_cannot_activate' => foodbakery_var_theme_text_srt('foodbakery_var_sorry_not_permission'), /* %1$s = plugin name(s) */
                'notice_ask_to_update' => foodbakery_var_theme_text_srt('foodbakery_var_notice_can_activate_recommended'), /* %1$s = plugin name(s) */
                'notice_cannot_update' => foodbakery_var_theme_text_srt('foodbakery_var_sorry_updated'), /* %1$s = plugin name(s) */
                'install_link' => foodbakery_var_theme_text_srt('foodbakery_var_install_link'),
                'activate_link' => foodbakery_var_theme_text_srt('foodbakery_var_activate_installed'),
                'return' => foodbakery_var_theme_text_srt('foodbakery_var_return'),
                'plugin_activated' => foodbakery_var_theme_text_srt('foodbakery_var_activation_success'),
                'complete' => foodbakery_var_theme_text_srt('foodbakery_var_complete'), /* %1$s = dashboard link */
                'nag_type' => foodbakery_var_theme_text_srt('foodbakery_var_updated'), /* Determines admin notice type - can only be 'updated' or 'error' */
            )
        );
        tgmpa($plugins, $config);
    }

}