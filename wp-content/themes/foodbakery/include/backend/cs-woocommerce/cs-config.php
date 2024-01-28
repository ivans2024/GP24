<?php

/**
 * woocommerce custom settings
 * and hooks
 */
if (!function_exists('foodbakery_woocommerce_enabled')) {

    function foodbakery_woocommerce_enabled() {
        if (class_exists('WooCommerce')) {
            return true;
        }
        return false;
    }

}

/**
 * check if the plugin is enabled, 
 * otherwise stop the script
 */
if (!foodbakery_woocommerce_enabled()) {
    return false;
}

/**
 * @Woocommerce Support Theme
 *
 */
add_theme_support('woocommerce');

add_filter('woocommerce_enqueue_styles', '__return_false');

if (!function_exists('child_manage_woocommerce_styles')) {

    add_action('wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99);

    function child_manage_woocommerce_styles() {
        //remove generator meta tag
        remove_action('wp_head', array($GLOBALS['woocommerce'], 'generator'));
        //first check that woo exists to prevent fatal errors
        if (function_exists('is_woocommerce')) {
            //dequeue scripts and styles
            if (!is_woocommerce() && !is_cart() && !is_checkout() && !is_shop()) {
                wp_dequeue_script('wc_price_slider');
                wp_dequeue_script('wc-single-product');
                //wp_dequeue_script('wc-add-to-cart');
                wp_dequeue_script('wc-cart-fragments');
                wp_dequeue_script('wc-checkout');
                wp_dequeue_script('wc-add-to-cart-variation');
                wp_dequeue_script('wc-single-product');
                //wp_dequeue_script('wc-cart');
                wp_dequeue_script('wc-chosen');
                //wp_dequeue_script('woocommerce');
                wp_dequeue_script('prettyPhoto');
                wp_dequeue_script('prettyPhoto-init');
                //wp_dequeue_script('jquery-blockui');
                wp_dequeue_script('jquery-placeholder');
                wp_dequeue_script('fancybox');
                wp_dequeue_script('jqueryui');
            }
        }
    }

}
/**
 * @Remove Woocommerce Default
 * @Remove Sidebar
 * @Breadcrumb
 *
 */
if (!function_exists('foodbakery_shop_title')) {

    function foodbakery_shop_title() {
        $title = '';
        return $title;
    }

    add_filter('woocommerce_show_page_title', 'foodbakery_shop_title');
}

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);


/**
 * @Define Image Sizes
 *
 */
$var_arrays = array('pagenow');
$congig_global_vars = FOODBAKERY_VAR_GLOBALS()->globalizing($var_arrays);
extract($congig_global_vars);

if (!function_exists('foodbakery_woocommerce_image_dimensions')) {

    if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php')
        add_action('init', 'foodbakery_woocommerce_image_dimensions', 1);

    function foodbakery_woocommerce_image_dimensions() {
        $catalog = array(
            'width' => '350', // px
            'height' => '350', // px
            'crop' => 1 // true
        );
        $single = array(
            'width' => '350', // px
            'height' => '350', // px
            'crop' => 1 // true
        );
        $thumbnail = array(
            'width' => '350', // px
            'height' => '350', // px
            'crop' => 1 // false
        );
        // Image sizes
        update_option('shop_catalog_image_size', $catalog); // Product category thumbs
        update_option('shop_single_image_size', $single); // Single product image
        update_option('shop_thumbnail_image_size', $thumbnail); // Image gallery thumbs
    }

}


/**
 * @Removing Shop Default Title
 *
 */
if (!function_exists('foodbakery_woocommerce_shop_title')) {

    function foodbakery_woocommerce_shop_title() {
        $foodbakery_shop_title = '';
        return $foodbakery_shop_title;
    }

    add_filter('woocommerce_show_page_title', 'foodbakery_woocommerce_shop_title');
}


/**
 * @Adding Add to Cart
 * @ Custom Text
 *
 */
//remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

if (!function_exists('foodbakery_loop_add_to_cart')) {

    function foodbakery_loop_add_to_cart() {
        global $product, $foodbakery_var_static_text;
        $strings = new foodbakery_theme_all_strings;
        $strings->foodbakery_theme_option_strings();

        echo apply_filters('woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="cs-color btn btn-flat button product_type_simple add_to_cart_button ajax_add_to_cart %s product_type_%s">%s</a>', esc_url($product->add_to_cart_url()), esc_attr($product->id), esc_attr($product->get_sku()), esc_attr(isset($quantity) ? $quantity : 1 ), $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '', esc_attr($product->product_type), '<i class="icon-shopping-cart2 cs-bgcolor"></i> ' . foodbakery_var_theme_text_srt('foodbakery_var_woocommerce_add_to_cart') . ''), $product);
    }

}

/**
 * adding flash sale
 * custom text
 */
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);

if (!function_exists('foodbakery_sale_flash_icon')) {

    add_filter('woocommerce_sale_flash', 'foodbakery_sale_flash_icon', 10, 3);

    function foodbakery_sale_flash_icon() {
        $icon = '<span class="featured-product"><i class="icon-star"></i></span>';
        echo foodbakery_allow_special_char($icon);
    }

}

/**
 * Product single page
 * customize Title
 */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 12);




if (!function_exists('foodbakery_single_product_stock_status')) {

    add_filter('woocommerce_single_product_summary', 'foodbakery_single_product_stock_status', 5);

    function foodbakery_single_product_stock_status() {
        global $foodbakery_var_static_text;

        $foodbakery_prod_sale = get_post_meta(get_the_id(), '_stock_status', true);
        if ($foodbakery_prod_sale == 'instock') {
            echo '<span class="stock_wrapper">' . foodbakery_var_theme_text_srt('foodbakery_var_availability') . ': <span class="stock cs-color"><b>' . foodbakery_var_theme_text_srt('foodbakery_var_in_stock') . '</b></span></span>';
        } else {
            echo '<span class="stock_wrapper">' . foodbakery_var_theme_text_srt('foodbakery_var_availability') . ': <span class="stock cs-color"><b>' . foodbakery_var_theme_text_srt('foodbakery_var_out_stock') . '</b></span></span>';
        }
    }

}


if (!function_exists('foodbakery_single_product_title')) {

    add_filter('woocommerce_single_product_summary', 'foodbakery_single_product_title', 10);

    function foodbakery_single_product_title() {
        global $foodbakery_var_static_text;
        $foodbakery_prod_title = get_the_title();
        if ($foodbakery_prod_title) {
            echo '<h3>' . get_the_title() . '</h3>';
        }
    }

}

/**
 * @Removing Product Image Dimensions
 *
 */
if (!function_exists('foodbakery_remove_thumbnail_dimensions')) {

    add_filter('post_thumbnail_html', 'foodbakery_remove_thumbnail_dimensions', 10, 3);

    function foodbakery_remove_thumbnail_dimensions($html, $post_id, $post_image_id) {
        $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
        return $html;
    }

}
