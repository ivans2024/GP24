<?php

// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Cash_Module_Disable_Backend')) {

    /**
     * Class Cash_Module_Disable_Backend
     */
    class Cash_Module_Disable_Backend {

        /**
         * Cash_Module_Disable_Backend constructor.
         */
        public function __construct() {
            add_filter('foodbakery_general_plugin_options_block', array($this, 'foodbakery_general_plugin_options_block_callback'), 10);
        }

        /*
         * Button for Enable/Disable Cash module in Plugin Options
         */

        public function foodbakery_general_plugin_options_block_callback($foodbakery_setting_options) {
            $on_off_option = array("show" => "on", "hide" => "off");

            $foodbakery_setting_options[] = array("name" => esc_html__("Cash Module", "foodbakery-ivan"),
                "desc" => "",
                "hint_text" => '',
                "id" => "user_cash_module",
                "std" => "on",
                "type" => "checkbox",
                "options" => $on_off_option
            );
            
            return $foodbakery_setting_options;
        }

    }

    new Cash_Module_Disable_Backend();
}
?>