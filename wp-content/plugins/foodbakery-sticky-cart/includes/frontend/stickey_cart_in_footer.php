<?php
// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Stickey_cart_in_footer')) {
    /**
     * Class Stickey_cart_in_footer
     */
    class Stickey_cart_in_footer
    {
        public $foodbakery_restaurant_id;

        /**
         * Stickey_cart_in_footer constructor.
         */
        public function __construct($restaurant_id)
        {
            $this->foodbakery_restaurant_id = $restaurant_id;
            if (wp_is_mobile()) {
                add_action('wp_footer', array($this, 'add_stickey_cart_in_footer_callback'));
            }
        }

        /**
         * add sticky carts in footer
         */
        public function add_stickey_cart_in_footer_callback($post)
        {

            global $foodbakery_plugin_options, $current_user;

            $foodbakery_restaurant_id = $this->foodbakery_restaurant_id;

            /*$get_added_menus = unserialize(stripslashes($_COOKIE['add_menu_items_temp']));
            $first_key = key($get_added_menus); // First Element's Key
            if ($foodbakery_restaurant_id == '') {
                $foodbakery_restaurant_id = $first_key;
            }*/

            $foodbakery_currency_sign = foodbakery_get_currency_sign();
            $foodbakery_vat_switch = isset($foodbakery_plugin_options['foodbakery_vat_switch']) ? $foodbakery_plugin_options['foodbakery_vat_switch'] : '';

            $foodbakery_payment_vat = isset($foodbakery_plugin_options['foodbakery_payment_vat']) ? $foodbakery_plugin_options['foodbakery_payment_vat'] : '';

            $cover_padding_top = isset($foodbakery_plugin_options['foodbakery_restaurant_cover_pading_top']) ? $foodbakery_plugin_options['foodbakery_restaurant_cover_pading_top'] : '';
            $cover_padding_bottom = isset($foodbakery_plugin_options['foodbakery_restaurant_cover_pading_botom']) ? $foodbakery_plugin_options['foodbakery_restaurant_cover_pading_botom'] : '';

            $restaurant_table_booking = get_post_meta($foodbakery_restaurant_id, 'foodbakery_restaurant_table_booking', true);
            $restaurant_pickup_delivery = get_post_meta($foodbakery_restaurant_id, 'foodbakery_restaurant_pickup_delivery', true);
            $foodbakery_delivery_fee = get_post_meta($foodbakery_restaurant_id, 'foodbakery_delivery_fee', true);
            $foodbakery_pickup_fee = get_post_meta($foodbakery_restaurant_id, 'foodbakery_pickup_fee', true);
            $restaurant_menu_list = get_post_meta($foodbakery_restaurant_id, 'foodbakery_menu_items', true);

            $total_items = count($restaurant_menu_list);
            $total_menu = array();
            if (isset($restaurant_menu_list) && $restaurant_menu_list != '') {
                for ($menu_count = 0; $menu_count < $total_items; $menu_count++) {
                    if (isset($restaurant_menu_list[$menu_count]['restaurant_menu'])) {
                        $menu_exists = in_array($restaurant_menu_list[$menu_count]['restaurant_menu'], $total_menu);
                        if (!$menu_exists) {
                            $total_menu[] = $restaurant_menu_list[$menu_count]['restaurant_menu'];
                        }
                    }
                }
            }
            $extras_modal_boxes = '';
            $total_menu_count = count($total_menu);
            wp_enqueue_script('foodbakery-restaurant-single');


            if (isset($_GET['price']) && $_GET['price'] == 'yes') {
                echo foodbakery_all_currencies(foodbakery_get_base_currency());
                echo foodbakery_get_currency(100, true);
            }
            $foodbakery_minimum_order_value = get_post_meta($foodbakery_restaurant_id, 'foodbakery_minimum_order_value', true);
            $foodbakery_maximum_order_value = get_post_meta($foodbakery_restaurant_id, 'foodbakery_maximum_order_value', true);
            $foodbakery_restaurant_category = get_post_meta($foodbakery_restaurant_id, 'foodbakery_restaurant_category', true);
            $foodbakery_min_guests_per_order = get_post_meta($foodbakery_restaurant_id, 'foodbakery_min_guests_per_order', true);
            $foodbakery_max_guests_per_order = get_post_meta($foodbakery_restaurant_id, 'foodbakery_max_guests_per_order', true);
            $foodbakery_table_reservation = get_post_meta($foodbakery_restaurant_id, 'foodbakery_table_reservation', true);
            $foodbakery_reservation_fee = get_post_meta($foodbakery_restaurant_id, 'foodbakery_reservation_fee', true);
            $get_added_menus = '';

            $user_id = $current_user->ID;
            $publisher_id = foodbakery_company_id_form_user_id($user_id);
            $publisher_type = get_post_meta($publisher_id, 'foodbakery_publisher_profile_type', true);
            if ($publisher_id != '' && $publisher_type != '' && $publisher_type != 'restaurant') {
                $get_added_menus = get_transient('add_menu_items_' . $publisher_id);
            }
            if ($get_added_menus == '') {
                $get_added_menus = '';
                if (isset($_COOKIE['add_menu_items_temp'])) {
                    $get_added_menus = unserialize(stripslashes($_COOKIE['add_menu_items_temp']));
                }
            }

            $have_menu_orders = false;
            if (isset($get_added_menus[$foodbakery_restaurant_id]) && is_array($get_added_menus[$foodbakery_restaurant_id]) && sizeof($get_added_menus[$foodbakery_restaurant_id]) > 0) {
                $have_menu_orders = true;
            }

            update_post_meta($foodbakery_restaurant_id, 'foodbakery_restaurant_disable_cash', 'no');
            $foodbakery_cash_payments = get_post_meta($foodbakery_restaurant_id, 'foodbakery_restaurant_disable_cash', true);

            wp_enqueue_script('foodbakery-restaurant-single');
            ?>
            <div class="menu-orders-holder user-order footer-cart-bar bgcolor">
                <div class="dev-menu-orders-list-cart">
                    <h6><i class="icon-shopping-cart2"></i><?php esc_html_e('Your Order', 'foodbakery-sticky-cart') ?>
                        <a class="pull-right orders-list-close" href="javascript:void(0)"><i style="margin-right:0px;"
                                                                                             class="icon-close"></i></a>
                    </h6>
                    <?php
                    $restaurant_allow_pre_order = get_post_meta($foodbakery_restaurant_id, 'foodbakery_restaurant_pre_order', true);
                    if ($restaurant_allow_pre_order == 'yes') {
                        echo '<span class="error-message pre-order-msg" style="display: ' . ($have_menu_orders === false ? 'block' : 'none') . ';">' . esc_html__('This restaurant allows Pre orders.', 'foodbakery-sticky-cart') . '</span>';
                    }
                    $selected_fee_type = isset($get_added_menus[$foodbakery_restaurant_id . '_fee_type']) ? $get_added_menus[$foodbakery_restaurant_id . '_fee_type'] : 'reservation';
                    ?>
                    <span class="discount-info"
                          style="display: <?php echo($have_menu_orders === false ? 'block' : 'none') ?>;"><?php _e('If you have a discount code, you will be able to input it at the payments stage.', 'foodbakery-sticky-cart') ?></span>
                    <?php
                    if (($foodbakery_delivery_fee >= 0 && $foodbakery_pickup_fee >= 0)) {
                        ?>
                        <div class="select-option dev-select-fee-option sticky_cart"
                             data-rid="<?php echo esc_html($foodbakery_restaurant_id) ?>">
                            <ul>
                                <?php if (($restaurant_pickup_delivery == 'pickup' || $restaurant_pickup_delivery == 'delivery_and_pickup') && $foodbakery_pickup_fee >= 0) { ?>
                                    <li>
                                        <input id="sticky-order-pick-up-fee"
                                               type="radio" <?php echo(($restaurant_pickup_delivery == 'pickup' || $restaurant_pickup_delivery == 'delivery_and_pickup') ? 'checked="checked"' : '') ?>
                                               value="pickup"
                                               name="order_fee_type_cart"
                                               data-fee="<?php echo foodbakery_get_currency($foodbakery_pickup_fee, false, '', '', false); ?>"
                                               data-label="<?php esc_html_e('Pick-Up', 'foodbakery-sticky-cart') ?>"
                                               data-type="pickup"/>
                                        <label for="sticky-order-pick-up-fee"><?php esc_html_e('Pick-Up', 'foodbakery-sticky-cart') ?></label>
                                        <span><?php echo foodbakery_get_currency($foodbakery_pickup_fee, true); ?></span>
                                    </li>
                                <?php } ?>
                                <?php if (($restaurant_pickup_delivery == 'delivery' || $restaurant_pickup_delivery == 'delivery_and_pickup') && $foodbakery_delivery_fee >= 0) { ?>
                                    <li>
                                        <input id="sticky-order-delivery-fee" <?php echo($restaurant_pickup_delivery == 'delivery' ? 'checked="checked"' : '') ?>
                                               type="radio" name="order_fee_type_cart"
                                               value="delivery"
                                               data-fee="<?php echo foodbakery_get_currency($foodbakery_delivery_fee, false, '', '', false); ?>"
                                               data-label="<?php esc_html_e('Delivery', 'foodbakery-sticky-cart') ?>"
                                               data-type="delivery"/>
                                        <label for="sticky-order-delivery-fee"><?php esc_html_e('Delivery', 'foodbakery-sticky-cart') ?></label>
                                        <span><?php echo foodbakery_get_currency($foodbakery_delivery_fee, true); ?></span>
                                    </li>
                                <?php } ?>
                                <?php if ($foodbakery_table_reservation == 'on' && $foodbakery_reservation_fee >= 0) { ?>
                                    <li>
                                        <input id="sticky-order-reservation-fee" <?php echo($selected_fee_type == 'reservation' ? 'checked="checked"' : '') ?>
                                               type="radio" name="order_fee_type_cart"
                                               data-fee="<?php echo foodbakery_get_currency($foodbakery_reservation_fee, false, '', '', false); ?>"
                                               data-label="<?php esc_html_e('Reservation', 'foodbakery-sticky-cart') ?>"
                                               data-type="reservation"/>
                                        <label for="sticky-order-reservation-fee"><?php esc_html_e('Reservation', 'foodbakery-sticky-cart') ?></label>
                                        <span><?php echo foodbakery_get_currency($foodbakery_reservation_fee, true); ?></span>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php
                    }
                    $reservation_fields_display = 'block';

                    if ($selected_fee_type == 'reservation') {
                        $reservation_fields_display = 'block';
                    }
                    $item_count = 0;

                    ?>

                    <div class="dev-menu-orders-list" id="count_cart_items"
                         style="display: <?php echo($have_menu_orders === true ? 'block' : 'none') ?>;">
                        <ul class="categories-order" data-rid="<?php echo absint($foodbakery_restaurant_id) ?>">
                            <?php
                            if (isset($get_added_menus[$foodbakery_restaurant_id]) && is_array($get_added_menus[$foodbakery_restaurant_id]) && sizeof($get_added_menus[$foodbakery_restaurant_id]) > 0) {
                                $item_count_temp = 1;
                                $item_count = count($get_added_menus[$foodbakery_restaurant_id]);
                                $rand_numb_class = 10000001;
                                foreach ($get_added_menus[$foodbakery_restaurant_id] as $menu_key => $menu_ord_item) {
                                    if (isset($menu_ord_item['menu_id']) && isset($menu_ord_item['price'])) {
                                        $rand_numb = rand(10000000, 99999999);
                                        $menu_t_price = 0;
                                        $this_menu_cat_id = isset($menu_ord_item['menu_cat_id']) ? $menu_ord_item['menu_cat_id'] : '';
                                        $this_item_id = $menu_ord_item['menu_id'];
                                        $this_item_price = $menu_ord_item['price'];
                                        $this_item_extras = isset($menu_ord_item['extras']) ? $menu_ord_item['extras'] : '';

                                        $menu_t_price += floatval($this_item_price);
                                        $this_item_title = isset($restaurant_menu_list[$this_item_id]['menu_item_title']) ? $restaurant_menu_list[$this_item_id]['menu_item_title'] : '';

                                        $menu_extra_li = '';
                                        if (is_array($this_item_extras) && sizeof($this_item_extras) > 0) {
                                            $extra_m_counter = 0;
                                            $menu_extra_li .= '<ul>';
                                            foreach ($this_item_extras as $this_item_extra_at) {
                                                $this_item_heading = isset($restaurant_menu_list[$this_item_id]['menu_item_extra']['heading'][$extra_m_counter]) ? $restaurant_menu_list[$this_item_id]['menu_item_extra']['heading'][$extra_m_counter] : '';
                                                $item_extra_at_title = isset($this_item_extra_at['title']) ? $this_item_extra_at['title'] : '';
                                                $item_extra_at_price = isset($this_item_extra_at['price']) ? $this_item_extra_at['price'] : '';
                                                if ($item_extra_at_title != '' || $item_extra_at_price > 0) {
                                                    $menu_extra_li .= '<li>' . $this_item_heading . ' - ' . $item_extra_at_title . ' : <span class="category-price">' . foodbakery_get_currency($item_extra_at_price, true) . '</span></li>';
                                                }

                                                $menu_t_price += floatval($item_extra_at_price);
                                                $extra_m_counter++;
                                            }
                                            $menu_extra_li .= '</ul>';
                                            // $menu_extra_li .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#extras-' . $this_menu_cat_id . '-' . $this_item_id . '" data-id="' . $this_item_id . '" data-cid="' . $this_menu_cat_id . '" data-rand="' . $rand_numb . '" class="update-menu dev-update-menu-btn">' . esc_html__('Edit', 'foodbakery-sticky-cart') . '</a>';

                                            $popup_id = 'edit_extras-' . $this_menu_cat_id . '-' . $this_item_id;
                                            $data_id = $this_item_id;
                                            $data_cat_id = $this_menu_cat_id;
                                            $ajax_url = admin_url('admin-ajax.php');
                                            $unique_id = $get_added_menus[$foodbakery_restaurant_id][$menu_key]['unique_id'];
                                            $unique_menu_id = $get_added_menus[$foodbakery_restaurant_id][$menu_key]['unique_menu_id'];
                                            $extra_child_menu_id = isset($get_added_menus[$foodbakery_restaurant_id][$menu_key]['extra_child_menu_id']) ? $get_added_menus[$foodbakery_restaurant_id][$menu_key]['extra_child_menu_id'] : '';

                                            $menu_extra_li .= '<a href="javascript:void(0);" class="edit-menu-item update_menu_' . $rand_numb_class . '" onClick="foodbakery_edit_extra_menu_item(\'' . $popup_id . '\',\'' . $data_id . '\',\'' . $data_cat_id . '\',\'' . $rand_numb_class . '\',\'' . $ajax_url . '\',\'' . $foodbakery_restaurant_id . '\',\'' . $unique_id . '\',\'' . $unique_menu_id . '\',\'' . $extra_child_menu_id . '\');">' . esc_html__('Edit', 'foodbakery') . '</a>';
                                        }
                                        ?>

                                        <li class="menu-added-<?php echo $rand_numb_class; ?>"
                                            id="menu-added-<?php echo absint($rand_numb) ?>"
                                            class="item_count_<?php echo $item_count_temp; ?>"
                                            data-pr="<?php echo foodbakery_get_currency($menu_t_price, false, '', '', false); ?>"
                                            data-conpr="<?php echo foodbakery_get_currency($menu_t_price, false, '', '', true); ?>">
                                            <a href="javascript:void(0)" class="btn-cross dev-remove-menu-item"><i
                                                        class="icon-cross3"></i></a>
                                            <a><?php echo esc_html($this_item_title) ?></a>
                                            <span class="category-price"><?php echo foodbakery_get_currency($this_item_price, true, '', '', true); ?></span>
                                            <?php echo force_balance_tags($menu_extra_li) ?>
                                        </li>
                                        <?php
                                    }
                                    $item_count_temp++;
                                    $rand_numb_class++;
                                }
                            }
                            ?>
                        </ul>
                        <div class="price-area dev-menu-price-con"
                             data-vatsw="<?php echo esc_html($foodbakery_vat_switch) ?>"
                             data-vat="<?php echo floatval($foodbakery_payment_vat) ?>">
                            <ul>
                                <input type="hidden" id="order_subtotal_price" name="order_subtotal_price"
                                       value="<?php echo restaurant_menu_price_calc($get_added_menus, $foodbakery_restaurant_id, '', '', '', false) ?>">
                                <li><?php esc_html_e('Subtotal', 'foodbakery-sticky-cart') ?> 
                                           <span class="price"><?php echo currency_symbol_possitions_html('<em class="dev-menu-grtotal">' . restaurant_menu_price_calc($get_added_menus, $foodbakery_restaurant_id, false, false, false, true) . '</em>', foodbakery_get_currency_sign()); ?></span>     
                                                
                                                
                                </li>
                                <?php
                                $show_fee_type = '';
                                if ($selected_fee_type == 'delivery' && $foodbakery_delivery_fee > 0) {
                                    $show_fee_type = 'delivery';
                                } else if ($selected_fee_type == 'pickup' && $foodbakery_pickup_fee > 0) {
                                    $show_fee_type = 'pickup';
                                } else if ($selected_fee_type == 'reservation' && $foodbakery_reservation_fee > 0) {
                                    $show_fee_type = 'reservation';
                                } else {
                                    if ($foodbakery_reservation_fee > 0 && $foodbakery_table_reservation == 'on') {
                                        $show_fee_type = 'reservation';
                                    } else if ($foodbakery_delivery_fee > 0 && $restaurant_pickup_delivery != 'pickup') {
                                        $show_fee_type = 'delivery';
                                    } else if ($foodbakery_pickup_fee > 0 && $restaurant_pickup_delivery != 'delivery') {
                                        $show_fee_type = 'pickup';
                                    }
                                }
                                if ($show_fee_type == 'reservation') {
                                    ?>
                                    <li class="restaurant-fee-con"><span
                                                class="fee-title"><?php esc_html_e('Booking Fee', 'foodbakery-sticky-cart') ?></span>
                                                
                                        <span class="price"><?php echo currency_symbol_possitions_html('<em
                                                    class="dev-menu-charges"
                                                    data-confee="'.foodbakery_get_currency($foodbakery_reservation_fee, false, '', '', true).'"
                                                    data-fee="'.foodbakery_get_currency($foodbakery_reservation_fee, false, '', '', false).'">' . foodbakery_get_currency($foodbakery_reservation_fee, false, '', '', true) . '</em>', foodbakery_get_currency_sign()); ?></span>                                                        
                                        
                                    </li>
                                    <?php
                                } else if ($show_fee_type == 'delivery') {
                                    ?>
                                    <li class="restaurant-fee-con"><span
                                                class="fee-title"><?php esc_html_e('Delivery Fee', 'foodbakery-sticky-cart') ?></span>
                                                
                                                
                                         <span class="price"><?php echo currency_symbol_possitions_html('<em
                                                    class="dev-menu-charges"
                                                    data-confee="'.foodbakery_get_currency($foodbakery_delivery_fee, false, '', '', true).'"
                                                    data-fee="'.foodbakery_get_currency($foodbakery_delivery_fee, false, '', '', false).'">' . foodbakery_get_currency($foodbakery_delivery_fee, false, '', '', true) . '</em>', foodbakery_get_currency_sign()); ?></span>                                                
                                    </li>
                                    <?php
                                } else if ($show_fee_type == 'pickup') {
                                    ?>
                                    <li class="restaurant-fee-con"><span
                                                class="fee-title"><?php esc_html_e('Pickup Fee', 'foodbakery-sticky-cart') ?></span>
                                                
                                                
                                        <span class="price"><?php echo currency_symbol_possitions_html('<em
                                                    class="dev-menu-charges"
                                                    data-confee="'.foodbakery_get_currency($foodbakery_pickup_fee, false, '', '', true).'"
                                                    data-fee="'.foodbakery_get_currency($foodbakery_pickup_fee, false, '', '', false).'">' . foodbakery_get_currency($foodbakery_pickup_fee, false, '', '', true) . '</em>', foodbakery_get_currency_sign()); ?></span>        
                                       
                                    </li>
                                    <?php
                                }
                                if ($foodbakery_vat_switch == 'on' && $foodbakery_payment_vat > 0) {
                                    ?>
                                    <input type="hidden" id="order_vat_percent" name="order_vat_percent"
                                           value="<?php echo($foodbakery_payment_vat); ?>">
                                    <input type="hidden" id="order_vat_cal_price" name="order_vat_cal_price"
                                           value="<?php echo restaurant_menu_price_calc($get_added_menus, $foodbakery_restaurant_id, true, false, true); ?>">
                                    <li><?php printf(esc_html__('VAT (%s&#37;)', 'foodbakery-sticky-cart'), $foodbakery_payment_vat) ?>
                                        <span class="price"><?php echo currency_symbol_possitions_html('<em class="dev-menu-vtax">' . restaurant_menu_price_calc($get_added_menus, $foodbakery_restaurant_id, true, false, true, true) . '</em>', foodbakery_get_currency_sign()); ?></span>            
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <p class="total-price"><?php esc_html_e('Total', 'foodbakery-sticky-cart') ?> 
                                <span class="price"><?php echo currency_symbol_possitions_html('<em class="dev-menu-grtotal">' . restaurant_menu_price_calc($get_added_menus, $foodbakery_restaurant_id, true, true, false, true) . '</em>', foodbakery_get_currency_sign()); ?></span>
                            </p>
                        </div>
                    </div>
                    <div class="dev-no-menu-items-list"
                         style="display: <?php echo($have_menu_orders === false ? 'block' : 'none') ?>;">
                        <?php echo '<span class="success-message">' . esc_html__('There are no items in your basket.', 'foodbakery-sticky-cart') . '</span>' ?>
                    </div>
                    <?php
                    if ($foodbakery_cash_payments != 'yes') {
                        ?>
                        <div class="pay-option dev-order-pay-options">
                            <ul>
                                <?php
                                $foodbakery_restaurant_disable_cash = get_post_meta($foodbakery_restaurant_id, 'foodbakery_restaurant_disable_cash', true);
                                if (empty($foodbakery_restaurant_disable_cash) || $foodbakery_restaurant_disable_cash == '') {
                                    $foodbakery_restaurant_disable_cash = 'no';
                                }
                                if ($foodbakery_restaurant_disable_cash == 'no') {
                                    ?>
                                    <li>
                                        <input id="sticky-order-cash-payment" value="cash" type="radio" name="sticky-order_payment_method"
                                               data-type="cash"/>
                                        <label for="sticky-order-cash-payment">
                                            <i class="icon-coins"></i>
                                            <?php esc_html_e('Cash', 'foodbakery-sticky-cart') ?>
                                        </label>
                                    </li>
                                <?php }
                                ?>
                                <li>
                                    <input id="sticky-order-card-payment" value="card" type="radio" checked="checked"
                                           name="sticky-order_payment_method" data-type="card"/>
                                    <label for="sticky-order-card-payment">
                                        <i class="icon-credit-card4"></i>
                                        <?php esc_html_e('Card', 'foodbakery-sticky-cart') ?>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <?php
                    }
                    ?>
                    <a href="javascript:void(0)" class="menu-order-confirm" id="menu-order-confirm"
                       data-rid="<?php echo absint($foodbakery_restaurant_id) ?>"><?php esc_html_e('Confirm Order', 'foodbakery-sticky-cart') ?></a>
                </div>
                <ul>
                    <?php
                    if ($have_menu_orders == true) {
                        $grand_total = restaurant_menu_price_calc($get_added_menus, $foodbakery_restaurant_id, true, true, false, true);
                    } else {
                        $grand_total = number_format(0, 2);
                    }
                    ?>
                    <li class="cart-bar total-amount">
                        
                         <span><?php echo currency_symbol_possitions_html('<em
                                    id="cart-total-price">' . foodbakery_get_currency($grand_total, false, '', '', true) . '</em>', foodbakery_get_currency_sign()); ?></span>                                                            
                    </li>

                    <li class="cart-bar confirm-btn">
                        <a href="javascript:void(0)" class="menu-order-confirm text-color" id="menu-order-confirm"
                           data-rid="<?php echo absint($foodbakery_restaurant_id) ?>"><?php esc_html_e('Confirm Order', 'foodbakery-sticky-cart') ?></a>
                    </li>


                    <li class="cart-bar user-cart-btn">
                        <!--cart item count-->
                        <a href="javascript:void(0)" class="toggle-btn">
                            <span class="cart-count text-color"><?php echo $item_count; ?></span>
                            <i class="icon-shopping-cart2"></i>

                        </a>
                    </li>

                </ul>
            </div>

            <?php
        }
    }
}
?>