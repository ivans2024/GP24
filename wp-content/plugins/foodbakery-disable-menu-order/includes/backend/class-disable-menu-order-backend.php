<?php

// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Disable_Menu_Order_Backend')) {

    /**
     * Class Disable_Menu_Order_Backend
     */
    class Disable_Menu_Order_Backend {

        /**
         * Disable_Menu_Order_Backend constructor.
         */
        public function __construct() {
            add_action('foodbakery_restaurant_field_backend', array($this, 'foodbakery_restaurant_field_backend_callback'), 10);
        }

        /*
         * Backend Fields in Restaurant Settings
         */

        public function foodbakery_restaurant_field_backend_callback($html) {
            global $foodbakery_html_fields;
            
            
            $foodbakery_opt_array = array(
		'name' => esc_html__('Menu Ordering', 'foodbakery-disable-menu-order'),
		'desc' => '',
		'hint_text' => '',
		'id' => 'restaurant_menu_ordering',
		'std' => '',
		'field_params' => array(
		    'id' => 'restaurant_menu_ordering',
                    'classes' => 'chosen-select',
                    'options' => array(
			'enabled' => esc_html__('Enable', 'foodbakery-disable-menu-order'),
                        'disabled' => esc_html__('Disable', 'foodbakery-disable-menu-order'),
		    ),
		    'return' => true,
		),
	    );

	    $html .= $foodbakery_html_fields->foodbakery_select_field($foodbakery_opt_array);
            
            return $html;
        }

    }

    new Disable_Menu_Order_Backend();
}
?>