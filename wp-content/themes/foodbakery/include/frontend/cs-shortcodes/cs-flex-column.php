<?php

/*
 *
 * @Shortcode Name : Map
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_var_column' ) ) {

    function foodbakery_var_column( $atts, $content = "" ) {
        global $header_map;
        $defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_var_column_section_title' => '',
            'foodbakery_var_column_text' => '',
            'foodbakery_column_margin_left' => '',
            'foodbakery_column_margin_right' => '',
            'foodbakery_var_column_top_padding' => '',
            'foodbakery_var_column_bottom_padding' => '',
            'foodbakery_var_column_left_padding' => '',
            'foodbakery_var_column_right_padding' => '',
            'foodbakery_var_column_image_url_array' => '',
            'foodbakery_var_column_bg_color' => '',
            'foodbakery_var_column_title_color' => '',
            'foodbakery_var_flex_align' => '',
        );
        extract( shortcode_atts( $defaults, $atts ) );

        $foodbakery_var_column_section_title = isset( $foodbakery_var_column_section_title ) ? $foodbakery_var_column_section_title : '';
        $foodbakery_var_column_title_color = isset( $foodbakery_var_column_title_color ) ? $foodbakery_var_column_title_color : '';
        $foodbakery_column_margin_left = isset( $foodbakery_column_margin_left ) ? $foodbakery_column_margin_left : '';
        $foodbakery_column_margin_right = isset( $foodbakery_column_margin_right ) ? $foodbakery_column_margin_right : '';
        $foodbakery_var_column_top_padding = isset( $foodbakery_var_column_top_padding ) ? $foodbakery_var_column_top_padding : '';
        $foodbakery_var_column_bottom_padding = isset( $foodbakery_var_column_bottom_padding ) ? $foodbakery_var_column_bottom_padding : '';
        $foodbakery_var_column_left_padding = isset( $foodbakery_var_column_left_padding ) ? $foodbakery_var_column_left_padding : '';
        $foodbakery_var_column_right_padding = isset( $foodbakery_var_column_right_padding ) ? $foodbakery_var_column_right_padding : '';
        $foodbakery_var_column_image_url = isset( $atts['foodbakery_var_column_image_url_array'] ) ? $atts['foodbakery_var_column_image_url_array'] : '';
        $foodbakery_var_column_bg_color = isset( $foodbakery_var_column_bg_color ) ? $foodbakery_var_column_bg_color : '';
        $foodbakery_var_flex_align = isset($foodbakery_var_flex_align) ? $foodbakery_var_flex_align : '';

        $column_class = '';
        if ( isset( $atts['flex_column_element_size'] ) && $atts['flex_column_element_size'] != '' ) {
            if ( function_exists( 'foodbakery_var_custom_column_class' ) ) {
                   $column_class = foodbakery_var_custom_column_class( $atts['flex_column_element_size'] );
            }
        }

        $style_string = '';
        if ( $foodbakery_var_column_top_padding != '' || $foodbakery_var_column_bottom_padding != '' || $foodbakery_var_column_left_padding != '' || $foodbakery_var_column_right_padding != '' || $foodbakery_column_margin_left != '' || $foodbakery_column_margin_right != '' ) {
            $style_string .= 'style=" ';
            if ( $foodbakery_var_column_top_padding != '' ) {
                $style_string .= ' padding-top:' . $foodbakery_var_column_top_padding . 'px; ';
            }
            if ( $foodbakery_var_column_bottom_padding != '' ) {
                $style_string .= ' padding-bottom:' . $foodbakery_var_column_bottom_padding . 'px; ';
            }
            if ( $foodbakery_var_column_left_padding != '' ) {
                $style_string .= ' padding-left:' . $foodbakery_var_column_left_padding . 'px; ';
            }
            if ( $foodbakery_var_column_right_padding != '' ) {
                $style_string .= ' padding-right:' . $foodbakery_var_column_right_padding . 'px; ';
            }
            if ( $foodbakery_column_margin_left != '' ) {
                $style_string .= ' margin-left:' . $foodbakery_column_margin_left . 'px; ';
            }
            if ( $foodbakery_column_margin_right != '' ) {
                $style_string .= ' margin-right:' . $foodbakery_column_margin_right . 'px; ';
            }
            if ( $foodbakery_var_column_image_url != '' ) {
                $style_string .= ' background-image: url(' . esc_url( $foodbakery_var_column_image_url ) . ');';
            }
            if ( $foodbakery_var_column_bg_color != '' ) {
                $style_string .= ' background-color:' . $foodbakery_var_column_bg_color . '; ';
            }
            $style_string .= '" ';
        }
        $html_column = '';
        $page_element_size = isset( $atts['accordion_element_size'] ) ? $atts['accordion_element_size'] : 100;
        if ( function_exists( 'foodbakery_var_page_builder_element_sizes' ) ) {
            //$html_column .= '<div class="' . foodbakery_var_page_builder_element_sizes( $page_element_size ) . ' ">';
        }
        if ( isset( $column_class ) && $column_class <> '' ) {
            $html_column .= '<div class="' . foodbakery_allow_special_char( $column_class ) . '">';
        }
        $foodbakery_column_bg_class = '';
        if ( isset( $foodbakery_var_column_bg_color ) && $foodbakery_var_column_bg_color != '' ) {
            $foodbakery_column_bg_class = ' has-bg';
        }
        if ( isset( $foodbakery_var_column_section_title ) && $foodbakery_var_column_section_title != '' ) {
            $title_style = '';
            if ( $foodbakery_var_column_title_color ) {
                $title_style = 'style="color:' . esc_attr( $foodbakery_var_column_title_color ) . ' !important;"';
            }
            $html_column .= '<div class="element-title '.$foodbakery_var_flex_align.'"><h2 ' . $title_style . '>' . esc_html( $foodbakery_var_column_section_title ) . '</h2></div>';
        }
        $html_column .= '<div  class="column-content ' . esc_html( $foodbakery_column_bg_class ) . '" ' . foodbakery_allow_special_char( $style_string ) . '>';
        $html_column .= do_shortcode( $content );
        $html_column .= '</div>';
        if ( isset( $column_class ) && $column_class <> '' ) {
            $html_column .= '</div>';
        }
        if ( function_exists( 'foodbakery_var_page_builder_element_sizes' ) ) {
            //$html_column .= '</div>';
        }
        return $html_column;
    }

    if ( function_exists( 'foodbakery_var_short_code' ) )
        foodbakery_var_short_code( 'foodbakery_column', 'foodbakery_var_column' );
}