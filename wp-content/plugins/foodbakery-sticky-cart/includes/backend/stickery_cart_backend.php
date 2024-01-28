<?php
// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Stickery_cart_backend')) {
    /**
     * Class Stickery_cart_backend
     */
    class Stickery_cart_backend
    {
        /**
         * Stickery_cart_backend constructor.
         */
        public function __construct()
        {
            add_action('call_class_obj_sticky_cart', array($this, 'call_class_obj_sticky_cart_callback'), 20, 1);
        }

        /**
         * @param $foodbakery_restaurant_id
         */
        public function call_class_obj_sticky_cart_callback($foodbakery_restaurant_id)
        {
            new Stickey_cart_in_footer($foodbakery_restaurant_id);
        }
    }

    new Stickery_cart_backend();
}

?>