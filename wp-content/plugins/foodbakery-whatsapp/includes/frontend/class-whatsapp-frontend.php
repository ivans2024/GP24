<?php
// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Whatsapp_Frontend')) {

    /**
     * Class Whatsapp_Frontend
     */
    class Whatsapp_Frontend {

        /**
         * Whatsapp_Frontend constructor.
         */
        public function __construct() {
            add_action('foodbakery_received_order_email_before', array($this, 'foodbakery_received_order_email_before_callback'), 10, 1);
            add_action('foodbakery_order_status_updated_email_before', array($this, 'foodbakery_order_status_updated_email_before_callback'), 10, 1);
            
        }
        
        /*
         * Send Whatsapp Message on Order Receive
         */
        public function foodbakery_received_order_email_before_callback($order_id){
            global $foodbakery_plugin_options;
            $restaurant_id = get_post_meta($order_id, 'foodbakery_restaurant_id', true);
            $order_user = get_post_meta($order_id, 'foodbakery_order_user', true);
            $customer_phone_number = get_post_meta($order_user, 'foodbakery_phone_number', true);
            $customer_phone_number = str_replace(" ", "", $customer_phone_number);
            $restaurant_phone_number = get_post_meta($restaurant_id, 'foodbakery_restaurant_contact_phone', true);
            $order_link = '';
            $publisher_dashboard = isset($foodbakery_plugin_options['foodbakery_publisher_dashboard']) ? $foodbakery_plugin_options['foodbakery_publisher_dashboard'] : '';
            if ($publisher_dashboard != '') {
                $order_link = esc_url(get_permalink($publisher_dashboard)) . '?dashboard=orders&order_id='.$order_id;
            } else {
                $order_link = esc_url(site_url('/dashboard/?dashboard=orders'));
            }
            
            $order_details = $this->get_order_detail($order_id);
            
            $whatsapp_instance_id = isset($foodbakery_plugin_options['foodbakery_whatsapp_instance_id']) ? $foodbakery_plugin_options['foodbakery_whatsapp_instance_id'] : '';
            $whatsapp_token = isset($foodbakery_plugin_options['foodbakery_whatsapp_token']) ? $foodbakery_plugin_options['foodbakery_whatsapp_token'] : '';
            $client = new UltraMsg\WhatsAppApi($whatsapp_token,$whatsapp_instance_id);

            
            $restaurant_sms_template = esc_html__('New order received on ', 'foodbakery-whatsapp').esc_html(get_the_title($restaurant_id))."\n";
            $restaurant_sms_template .= $order_details;
            
            
            $customer_sms_template = esc_html__('Your order has been sent successfully on ', 'foodbakery-whatsapp').esc_html(get_the_title($restaurant_id))."\n";
            $customer_sms_template .= $order_details;
            $customer_sms_template .= "\n\n".$order_link;
            if( $restaurant_phone_number != ''){
                $to     = $restaurant_phone_number;
                $body   = $restaurant_sms_template;
                $api    = $client->sendChatMessage($to, $body);
            }
            if( $customer_phone_number != ''){
                $to     = $customer_phone_number;
                $body   = $customer_sms_template;
                $api    = $client->sendChatMessage($to, $body);
            }
        }
        
        
        public function foodbakery_order_status_updated_email_before_callback($order_id){
            global $foodbakery_plugin_options;
            $restaurant_id  = get_post_meta($order_id, 'foodbakery_restaurant_id', true);
            $order_user     = get_post_meta($order_id, 'foodbakery_order_user', true);
            $order_status   = get_post_meta( $order_id, 'foodbakery_order_status', true );
            $order_status   = esc_html( $order_status );
            $customer_phone_number = get_post_meta($order_user, 'foodbakery_phone_number', true);
            $customer_phone_number = str_replace(" ", "", $customer_phone_number);
            $order_link = '';
            $publisher_dashboard = isset($foodbakery_plugin_options['foodbakery_publisher_dashboard']) ? $foodbakery_plugin_options['foodbakery_publisher_dashboard'] : '';
            if ($publisher_dashboard != '') {
                $order_link = esc_url(get_permalink($publisher_dashboard)) . '?dashboard=orders&order_id='.$order_id;
            } else {
                $order_link = esc_url(site_url('/dashboard/?dashboard=orders'));
            }
            
            $whatsapp_instance_id = isset($foodbakery_plugin_options['foodbakery_whatsapp_instance_id']) ? $foodbakery_plugin_options['foodbakery_whatsapp_instance_id'] : '';
            $whatsapp_token = isset($foodbakery_plugin_options['foodbakery_whatsapp_token']) ? $foodbakery_plugin_options['foodbakery_whatsapp_token'] : '';
            $client = new UltraMsg\WhatsAppApi($whatsapp_token,$whatsapp_instance_id);
            
            $customer_sms_template = 'Your order# *'.$order_id.'* is *'. $order_status .'* on *'.esc_html(get_the_title($restaurant_id)).'* restaurant.';
            
            $customer_sms_template .= "\n\n".$order_link."";
            
            if( $customer_phone_number != ''){
                $to     = $customer_phone_number;
                $body   = $customer_sms_template;
                $api    = $client->sendChatMessage($to, $body);
            }
        }
        
        
        public function get_order_detail($order_id)
        {
            global $foodbakery_plugin_options;
            $order_type = get_post_meta($order_id, 'foodbakery_order_type', true);
            $order_menu_list = get_post_meta($order_id, 'menu_items_list', true);

            $menu_order_fee = get_post_meta($order_id, 'menu_order_fee', true);
            $menu_order_fee_type = get_post_meta($order_id, 'menu_order_fee_type', true);

            $foodbakery_vat_switch = isset($foodbakery_plugin_options['foodbakery_vat_switch']) ? $foodbakery_plugin_options['foodbakery_vat_switch'] : '';
            $foodbakery_payment_vat = isset($foodbakery_plugin_options['foodbakery_payment_vat']) ? $foodbakery_plugin_options['foodbakery_payment_vat'] : '';

            $restaurant_id = get_post_meta($order_id, 'foodbakery_restaurant_id', true);
            $html = "";
            $html .= '*Order ID#* ' .$order_id."\n";

            if ($order_type == 'order' && is_array($order_menu_list)) {
                $order_m_total = 0;

                $html .= '';
                $html .= apply_filters('restaurant_order_extra_details', '', $order_id);
                $html .= '';
                foreach ($order_menu_list as $_menu_list) {
                    $title_item = isset($_menu_list['title']) ? $_menu_list['title'] : '';
                    $price_item = isset($_menu_list['price']) ? $_menu_list['price'] : '';
                    $extras_item = isset($_menu_list['extras']) ? $_menu_list['extras'] : '';

                    $order_m_total += floatval($price_item);
                    $html .= '*' . $title_item . '* ' . foodbakery_get_currency($price_item, true, '', '', true) . "\n";
                    $html .= apply_filters('order_item_detail_after_title', '', $_menu_list);
                    if (is_array($extras_item) && sizeof($extras_item) > 0) {
                        $html .= '';
                        foreach ($extras_item as $extra_item) {
                            $heading_extra_item = isset($extra_item['heading']) ? $extra_item['heading'] : '';
                            $title_extra_item = isset($extra_item['title']) ? $extra_item['title'] : '';
                            $price_extra_item = isset($extra_item['price']) ? $extra_item['price'] : '';
                            if ($title_extra_item != '') {
                                $html .= '*' . $heading_extra_item . '- ' . $title_extra_item . ' :* ' . foodbakery_get_currency($price_extra_item, true, '', '', true) . "\n";
                            }
                            $order_m_total += floatval($price_extra_item);
                        }
                        $html .= '';
                    }
                    $html .= '';
                }
                $html .= "\n";

                if ($order_m_total > 0) {
                    $html .= '';
                    $html .= '*' . esc_html__('Subtotal', 'foodbakery-whatsapp') . ':* ' . foodbakery_get_currency($order_m_total, true, '', '', true) .  "\n";

                    $html .= apply_filters('restaurant_order_send_to_buyer', '', $order_id);
                    $check_addon = apply_filters('foodbakery_check_delivery_tax', false);
                    if (!$check_addon) {
                        $order_m_total = foodbakery_get_currency($order_m_total, false, '', '', true);
                        if ($menu_order_fee_type == 'delivery') {
                            $html .= '*' . esc_html__('Delivery fee', 'foodbakery-whatsapp') . ':* ' . foodbakery_get_currency($menu_order_fee, true, '', '', false) . "\n";
                        } else if ($menu_order_fee_type == 'pickup') {
                            $html .= '*' . esc_html__('Pickup fee', 'foodbakery-whatsapp') . ':* ' . foodbakery_get_currency($menu_order_fee, true, '', '', false) . "\n";
                        }
                        if ($foodbakery_vat_switch == 'on' && $foodbakery_payment_vat > 0) {
                            $html .= '*' . sprintf(esc_html__('VAT', 'foodbakery-whatsapp'), $foodbakery_payment_vat) . ':* ' . restaurant_menu_price_calc('defined', $order_m_total, $menu_order_fee, true, true, false, '', true) . "\n";
                        }
                    }

                    $html .= '';
                    if ($check_addon) {
                        $html .= apply_filters('restaurant_order_calculation_for_buyer', '', $order_id, $order_m_total);
                    } else {
                        $html .= '*' . esc_html__('Total', 'foodbakery-whatsapp') . ':* ' . restaurant_menu_price_calc('defined', $order_m_total, $menu_order_fee, true, false, false, '', true) . '';
                    }
                    $html .= '';
                }
                $html .= '';
            }

            return $html;
        }

    }

    new Whatsapp_Frontend();
}
?>