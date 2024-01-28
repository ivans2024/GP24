<?php

/*
 *
 * @Shortcode Name : Image Frame
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_var_mail_chimp' ) ) {

    function foodbakery_var_mail_chimp( $atts, $content = "" ) {
        $page_element_size  = isset( $atts['mail_chimp_element_size'] )? $atts['mail_chimp_element_size'] : 100;
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            echo '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
        global $header_map, $post;
        $defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_var_mail_section_title' => '',
            'foodbakery_var_mail_sub_title' => '',
            'foodbakery_var_background_color' => '',
        );
        extract( shortcode_atts( $defaults, $atts ) );
        if ( isset( $foodbakery_var_column_size ) && $foodbakery_var_column_size != '' ) {
            if ( function_exists( 'foodbakery_var_custom_column_class' ) ) {
                $column_class = foodbakery_var_custom_column_class( $foodbakery_var_column_size );
            }
        }
        $foodbakery_var_mail_section_title = isset( $foodbakery_var_mail_section_title ) ? $foodbakery_var_mail_section_title : '';
        $foodbakery_var_mail_sub_title = isset( $foodbakery_var_mail_sub_title ) ? $foodbakery_var_mail_sub_title : '';
        $foodbakery_var_background_color = isset( $foodbakery_var_background_color ) ? $foodbakery_var_background_color : '';
        $foodbakery_var_mail_chimp = '';
        $background = '';
        if ( isset( $foodbakery_var_background_color ) && $foodbakery_var_background_color != '' ) {
            $background = 'style = "background-color:' . $foodbakery_var_background_color . '; "';
        }
        if ( isset( $column_class ) && $column_class <> '' ) {
            echo '<div class="' . esc_html( $column_class ) . '">';
        }
        echo '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="mailchimp-newsletter" ' .foodbakery_allow_special_char($background). '>';
        if ( isset( $foodbakery_var_mail_section_title ) && $foodbakery_var_mail_section_title != '' ) {
            echo '<div class="mailchimp_title"><h5>' . esc_html( $foodbakery_var_mail_section_title ) . '</h5>';
        }
        if ( isset( $foodbakery_var_mail_sub_title ) && $foodbakery_var_mail_sub_title != '' ) {
            echo '<span>' . esc_html( $foodbakery_var_mail_sub_title ) . '</span></div>';
        }
		
        $under_construction = '2';
        echo foodbakery_custom_mailchimp( $under_construction );
        if ( $content <> '' ) {
            echo do_shortcode( $content );
        }
        echo '</div></div></div>';
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
           echo  '</div>';
        }
        return $foodbakery_var_mail_chimp;
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'foodbakery_mail_chimp', 'foodbakery_var_mail_chimp' );
    }
}