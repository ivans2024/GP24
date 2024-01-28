<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$var_arrays = array('wp_query');
$page_global_vars = FOODBAKERY_VAR_GLOBALS()->globalizing($var_arrays);
extract($page_global_vars);

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}

$woo_pagination = paginate_links( array(
	'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
	'format'       => '',
	'add_args'     => '',
	'current'      => max( 1, get_query_var( 'paged' ) ),
	'total'        => $wp_query->max_num_pages,
	'prev_text'    => '<i class="icon-angle-left"></i> '.esc_html__('Previous', 'foodbakery'),
	'next_text'    => esc_html__('Next', 'foodbakery').' <i class="icon-angle-right"></i>',
	'type'         => 'array',
	'end_size'     => 3,
	'mid_size'     => 3
) );

$foodbakery_pages = '';
if (is_array($woo_pagination) && sizeof($woo_pagination) > 0) {
    $foodbakery_pages .= '<ul class="pagination">';
    foreach ($woo_pagination as $foodbakery_link) {
        if (strpos($foodbakery_link, 'current') !== false) {
            $foodbakery_pages .= '<li><a class="active">' . preg_replace("/[^0-9]/", "", $foodbakery_link) . '</a></li>';
        } else {
            $foodbakery_pages .= '<li>' . $foodbakery_link . '</li>';
        }
    }
    $foodbakery_pages .= '</ul>';
}
echo foodbakery_allow_special_char($foodbakery_pages);

