<?php

// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Whatsapp_Settings_Backend')) {

    /**
     * Class Whatsapp_Settings_Backend
     */
    class Whatsapp_Settings_Backend {

        /**
         * Restaurants_Element_Backend constructor.
         */
        public function __construct() {
            add_filter('foodbakery_settings_after_api', array($this, 'foodbakery_settings_after_api_callback'), 10);
        }

        /*
         * API Settings for Whatsapp
         */

        public function foodbakery_settings_after_api_callback($foodbakery_setting_options) {
            $foodbakery_setting_options[] = array(
                "name" => esc_html__("Whatsapp", 'foodbakery-whatsapp'),
                "id" => "Whatsapp",
                "std" => "Whatsapp",
                "type" => "section",
                "options" => ""
            );
            $foodbakery_setting_options[] = array(
                "name" => esc_html__("Instance ID", 'foodbakery-whatsapp'),
                "desc" => "",
                "hint_text" => esc_html__("Add Ultramsg Instance ID. To get your Ultramsg Instance ID, go to your Ultramsg Dashboard", "foodbakery-whatsapp"),
                "id" => "whatsapp_instance_id",
                "std" => "",
                "type" => "text"
            );
            $foodbakery_setting_options[] = array(
                "name" => esc_html__("Token", 'foodbakery-whatsapp'),
                "desc" => '',
                "hint_text" => esc_html__("Put your Ultramsg Token here. You can find it in your Ultramsg Dashboard", 'foodbakery-whatsapp'),
                "id" => "whatsapp_token",
                "std" => "",
                "type" => "text"
            );
            
            return $foodbakery_setting_options;
        }

    }

    new Whatsapp_Settings_Backend();
}
?>