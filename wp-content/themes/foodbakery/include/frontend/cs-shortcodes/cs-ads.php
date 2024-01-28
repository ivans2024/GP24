<?php

/**
 * Ads html view for page builder
 *
 * @package Foodbakery
 */
if ( ! function_exists( 'foodbakery_var_foodbakery_ads' ) ) {

    /**
     * Display ads shortcode html.
     *
     * @param array  $atts ads shortcode attributes.
     * @param string $content ads shortcode content.
     */
    function foodbakery_var_foodbakery_ads( $atts = '', $content = '' ) {

        global $foodbakery_var_options;
        $defaults = array( 'id' => '0' );
        extract( shortcode_atts( $defaults, $atts ) );
        $html = '';
        $page_element_size  = isset( $atts['ads_element_size'] )? $atts['ads_element_size'] : 100;
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $html   .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
        if ( isset( $foodbakery_var_options['foodbakery_var_banner_field_code_no'] ) && is_array( $foodbakery_var_options['foodbakery_var_banner_field_code_no'] ) ) {
            $i = 0;
            foreach ( $foodbakery_var_options['foodbakery_var_banner_field_code_no'] as $banner ) :
                if ( $foodbakery_var_options['foodbakery_var_banner_field_code_no'][$i] === $id ) {
                    break;
                }
                $i ++;
            endforeach;

            $foodbakery_var_banner_title = isset( $foodbakery_var_options['foodbakery_var_banner_title'][$i] ) ? $foodbakery_var_options['foodbakery_var_banner_title'][$i] : '';
            $foodbakery_var_banner_style = isset( $foodbakery_var_options['foodbakery_var_banner_style'][$i] ) ? $foodbakery_var_options['foodbakery_var_banner_style'][$i] : '';
            $foodbakery_var_banner_type = isset( $foodbakery_var_options['foodbakery_var_banner_type'][$i] ) ? $foodbakery_var_options['foodbakery_var_banner_type'][$i] : '';
            $foodbakery_var_banner_image = isset( $foodbakery_var_options['foodbakery_var_banner_image_array'][$i] ) ? $foodbakery_var_options['foodbakery_var_banner_image_array'][$i] : '';
            $foodbakery_var_banner_url = isset( $foodbakery_var_options['foodbakery_var_banner_field_url'][$i] ) ? $foodbakery_var_options['foodbakery_var_banner_field_url'][$i] : '';
            $foodbakery_var_banner_url_target = isset( $foodbakery_var_options['foodbakery_var_banner_target'][$i] ) ? $foodbakery_var_options['foodbakery_var_banner_target'][$i] : '';
            $foodbakery_var_banner_adsense_code = isset( $foodbakery_var_options['foodbakery_var_adsense_code'][$i] ) ? $foodbakery_var_options['foodbakery_var_adsense_code'][$i] : '';
            $foodbakery_var_banner_code_no = isset( $foodbakery_var_options['foodbakery_var_banner_field_code_no'][$i] ) ? $foodbakery_var_options['foodbakery_var_banner_field_code_no'][$i] : '';

            if ( 'image' === $foodbakery_var_banner_type ) {
                $banner_cookie = foodbakery_get_cookie( 'banner_clicks_' . $foodbakery_var_banner_code_no, false );

                if ( ! isset( $banner_cookie ) || $banner_cookie == '' ) {

                    $html .= '<div class="cs-media ad-banner ' . esc_html( $foodbakery_var_banner_style ) . '"><figure><a onclick="foodbakery_var_banner_click_count_plus(\'' . admin_url( 'admin-ajax.php' ) . '\', \'' . $foodbakery_var_banner_code_no . '\')" id="banner_clicks' . $foodbakery_var_banner_code_no . '" href="' . esc_url( $foodbakery_var_banner_url ) . '" target="_blank"><img src="' . esc_url( $foodbakery_var_banner_image ) . '" alt="' . $foodbakery_var_banner_title . '" /></a></figure></div>';
                } else {
                    $html .= '<div class="cs-media ad-banner ' . esc_html( $foodbakery_var_banner_style ) . '"><figure><a href="' . esc_url( $foodbakery_var_banner_url ) . '" target="' . $foodbakery_var_banner_url_target . '"><img src="' . esc_url( $foodbakery_var_banner_image ) . '" alt="' . $foodbakery_var_banner_title . '" /></a></figure></div>';
                }
            } else {
                $html .= wp_specialchars_decode( stripslashes( $foodbakery_var_banner_adsense_code ) );
            }
        }

        $foodbakery_inline_script = '
		function foodbakery_var_banner_click_count_plus(ajax_url, id) {
			"use strict";
			var dataString = "code_id=" + id + "&action=foodbakery_var_banner_click_count_plus";
			jQuery.ajax({
				type: "POST",
				url: ajax_url,
				data: dataString,
				success: function (response) {
				if (response != "error") {
						jQuery("#banner_clicks" + id).removeAttr("onclick");
					}
				}
			});
			return false;
		}';
        foodbakery_inline_enqueue_script( $foodbakery_inline_script, 'foodbakery-functions' );
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
           $html    .=  '</div>';
        }
       return $html;

        return do_shortcode( $html );
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'foodbakery_ads', 'foodbakery_var_foodbakery_ads' );
    }
}