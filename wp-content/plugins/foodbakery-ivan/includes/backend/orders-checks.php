<?php

// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Foodbakery_Orders_Checks')) {

    /**
     * Class Foodbakery_Orders_Checks
     */
    class Foodbakery_Orders_Checks {

        /**
         * Foodbakery_Orders_Checks constructor.
         */
        public function __construct() {
            add_action('foodbakery_order_confirmation_woocommerce', array(&$this, 'foodbakery_order_confirmation_woocommerce_callback'));
            add_filter('pre_get_posts', array(&$this, 'pre_get_posts_callback'));
        }
        
        public function foodbakery_order_confirmation_woocommerce_callback($trans_order_id){
            update_post_meta($trans_order_id, 'foodbakery_order_show', 0);
        }

        /*
         * Not show the orders if paymnt is not processed completely
         */

         public function pre_get_posts_callback($query) {
            if (isset($query->query['post_type']) && $query->query['post_type'] == 'orders_inquiries') {
                $metaquery = (array) $query->get('meta_query');
                $metaquery[] = array(
                    array(
                        'key' => 'foodbakery_order_show',
                        'value' => 1,
                        'compare' => '='
                    )
                );
                $query->set('meta_query', $metaquery);
            }
            return $query;
        }

    }

    new Foodbakery_Orders_Checks();
}
?>