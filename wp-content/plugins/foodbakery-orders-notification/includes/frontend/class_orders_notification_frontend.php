<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('class_orders_notification_frontend')) {

    /**
     * Class class_orders_notification_frontend
     */
    class class_orders_notification_frontend {

        /**
         * class_orders_notification_frontend constructor.
         */
        public function __construct() {
            add_action('foodbakery_dashboard_page_end', array($this, 'foodbakery_dashboard_page_end_callback'));
            add_action('wp_ajax_foodbakery_new_order', array($this, 'foodbakery_new_order_callback'));
            add_action('foodbakery_order_confirmation', array($this, 'foodbakery_order_confirmation_callback'), 10);
            add_action('foodbakery_after_order_status_updated', array($this, 'foodbakery_order_confirmation_callback'), 10);
            add_action('wp_ajax_show_orders_notification', array($this, 'show_orders_notification_callback'), 10);
        }

        /*
         * Orders Page Auto Refresh
         */

        public function foodbakery_dashboard_page_end_callback() {
            ?>
            <div class="foodbakery_play_new_order_alarm"></div>
            <audio id="foodbakery_new_order_sound" class="hide">
                <source src="<?php echo FOODBAKERY_ORDERS_NOTIFICATION_PLUGIN_URL . '/assets/mp3/new_order.ogg'; ?>" type="audio/ogg">
                <source src="<?php echo FOODBAKERY_ORDERS_NOTIFICATION_PLUGIN_URL . '/assets/mp3/new_order.mp3'; ?>" type="audio/mpeg">
            </audio>
            <script type="text/javascript">
                jQuery(document).ready(function () {
                    var intervalId = window.setInterval(function () {
                        foodbakery_refresh_order_listing_page();
                    }, 10000);


                });
            </script>

            <?php
        }

        /*
         * Check for new order
         */

        public function foodbakery_new_order_callback() {
            global $current_user;
            $user_id = $current_user->ID;
            $publisher_id = foodbakery_company_id_form_user_id($user_id);
            $publisher_type = get_post_meta($publisher_id, 'foodbakery_publisher_profile_type', true);
            $foodbakery_new_order = 0;
            if ($publisher_type == 'restaurant') {
                $foodbakery_new_order = get_option('foodbakery_new_order', true);
            }
            echo $foodbakery_new_order;
            exit;
        }

        /*
         * Order Confirmation
         */

        public function foodbakery_order_confirmation_callback() {
            update_option('foodbakery_new_order', 1);
        }

        /*
         * Show Orders Notification Popup
         */

        public function show_orders_notification_callback() {
            global $current_user;
            $user_id = $current_user->ID;
            $args = array(
                'post_type' => 'orders_inquiries',
                'post_status' => 'publish',
                'fields' => 'ids',
                'meta_query' => array(
                    array(
                        'key' => 'foodbakery_new_order_notice',
                        'value' => 1,
                        'compare' => '=',
                    ),
                    array(
                        'key' => 'foodbakery_restaurant_user',
                        'value' => $user_id,
                        'compare' => '=',
                    )
                ),
            );

            $order_query = new WP_Query($args);

            $new_orders = array();
            update_option('foodbakery_new_order', 0);

            if (isset($order_query->posts) && !empty($order_query->posts)) {
                foreach ($order_query->posts as $order_id) {

                    $order_subtotal_price = get_post_meta($order_id, 'order_subtotal_price', true);
                    $menu_order_fee = get_post_meta($order_id, 'menu_order_fee', true);

                    $order_total_price = restaurant_menu_price_calc('defined', $order_subtotal_price, $menu_order_fee, true, false, false, '', true);

                    $new_orders[] = '<a style="color:#ffffff" href="' . site_url('user-dashboard/?dashboard=received_orders') . '">New Order Reiceved - Order ID #' . $order_id . ' | ' . $order_total_price . '</a>';
                    update_post_meta($order_id, 'foodbakery_new_order_notice', 0);
                }
            }
            echo json_encode($new_orders);

            wp_die();
        }

    }

    new class_orders_notification_frontend();
}
?>