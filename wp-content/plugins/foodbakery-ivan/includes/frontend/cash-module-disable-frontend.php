<?php

// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Cash_Module_Disable_Frontend')) {

    /**
     * Class Cash_Module_Disable_Frontend
     */
    class Cash_Module_Disable_Frontend {

        /**
         * Cash_Module_Disable_Frontend constructor.
         */
        public function __construct() {
            add_filter('foodbakery_cash_module_status', array($this, 'foodbakery_cash_module_status_callback'), 10);
        }

        /*
         * Button for Enable/Disable Cash module in Plugin Options
         */

        public function foodbakery_cash_module_status_callback($cash_module_status) {
            global $foodbakery_plugin_options;
            $foodbakery_user_cash_module    = isset( $foodbakery_plugin_options['foodbakery_user_cash_module'] )? $foodbakery_plugin_options['foodbakery_user_cash_module'] : 'off';
            $foodbakery_user_cash_module    = ( $foodbakery_user_cash_module == 'off')? 'yes' : 'no';
            return $foodbakery_user_cash_module;
        }

    }

    new Cash_Module_Disable_Frontend();
}
?>