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
            add_action('wp_ajax_foodbakery_acknowledge_order', array($this, 'foodbakery_acknowledge_order_callback'), 10);
        }

        /*
         * Orders Page Auto Refresh
         */

        public function foodbakery_dashboard_page_end_callback() {
            ?>
            <div class="foodbakery_play_new_order_alarm"></div>
            <audio id="foodbakery_new_order_sound" class="hide" loop>
                <source src="<?php echo FOODBAKERY_IVAN_PLUGIN_URL . '/assets/mp3/new_order.ogg'; ?>" type="audio/ogg">
                <source src="<?php echo FOODBAKERY_IVAN_PLUGIN_URL . '/assets/mp3/new_order.mp3'; ?>" type="audio/mpeg">
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
            
            if ($publisher_type == 'restaurant') {
                $foodbakery_new_order = get_option('foodbakery_new_order', true);
            }
            $foodbakery_new_order = 1;
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
            $company_id = foodbakery_company_id_form_user_id($user_id);
            $args = array(
                'post_type' => 'orders_inquiries',
                'post_status' => 'publish',
                'posts_per_page' => 1,
                'orderby' => 'ID',
                'order' => 'ASC',
                'fields' => 'ids',
                'meta_query' => array(
                    array(
                        'key' => 'foodbakery_new_order_notice',
                        'value' => 1,
                        'compare' => '=',
                    ),
                    array(
                        'key' => 'foodbakery_publisher_id',
                        'value' => $company_id,
                        'compare' => '=',
                    )
                ),
            );

            $order_query = new WP_Query($args);

            $order_box = '';

            if (isset($order_query->posts) && !empty($order_query->posts)) {
                foreach ($order_query->posts as $order_id) {

                    $order_subtotal_price = get_post_meta($order_id, 'order_subtotal_price', true);
                    $menu_order_fee = get_post_meta($order_id, 'menu_order_fee', true);
                    $foodbakery_order_user = get_post_meta($order_id, 'foodbakery_order_user', true);
                    $foodbakery_order_user = get_the_title($foodbakery_order_user);

                    $order_total_price = restaurant_menu_price_calc('defined', $order_subtotal_price, $menu_order_fee, true, false, false, '', true);

                    $new_orders = '<h6>'. __('Order ID', 'foodbakery-ivan') .' #' . $order_id . ' | ' . $foodbakery_order_user . ' | ' . $order_total_price . '</h6>';
                    
                    $order_box = '<div class="modal fade orders-notification" data-backdrop="static" data-keyboard="false" id="orders-notification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2>'. __('New Order', 'foodbakery-ivan') .'</h2>
                                    </div>
                                    <div class="modal-body">
                                        ' . $new_orders . '
                                        <button style="background-color: #c33332;border: none;display: block;border-radius: 3px;color: #fff;font-size: 12px;font-weight: 700;letter-spacing: 1px;line-height: normal;padding: 8px 10px;text-transform: uppercase;width: 100%;text-align: center;" class="acknowledge_btn" data-order_id="' . $order_id . '" style="display:block; margin:10px 0;">'. __('Acknowledge', 'foodbakery-ivan') .'</button>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
            }

            echo $order_box;
            wp_die();
        }

        /*
         * Acknowledge Order
         */
        public function foodbakery_acknowledge_order_callback() {
            $order_id = foodbakery_get_input('order_id');
            update_post_meta($order_id, 'foodbakery_new_order_notice', 0);
            update_option('foodbakery_new_order', 0);
            wp_die();
        }

    }

    new class_orders_notification_frontend();
}
?>