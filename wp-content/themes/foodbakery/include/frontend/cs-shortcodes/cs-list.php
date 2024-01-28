<?php

/*
 *
 * @Shortcode Name :  List front end view
 * @retrun
 *
 */

if ( ! function_exists( 'foodbakery_var_list_shortcode' ) ) {

    function foodbakery_var_list_shortcode( $atts, $content = "" ) {
        global $post, $foodbakery_var_list_column, $foodbakery_var_list_type, $foodbakery_var_list_item_icon_color, $foodbakery_var_list_item_icon_bg_color;
        $html = '';
        $page_element_size  = isset( $atts['list_element_size'] )? $atts['list_element_size'] : 100;
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $html   .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
        $defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_var_list_title' => '',
            'foodbakery_var_list_type' => '',
            'foodbakery_var_list_item_icon_color' => '',
            'foodbakery_var_list_item_icon_bg_color' => '',
            'foodbakery_var_list_align' => '',
        );


        extract( shortcode_atts( $defaults, $atts ) );

        $foodbakery_var_column_size = isset( $foodbakery_var_column_size ) ? $foodbakery_var_column_size : '';
        $foodbakery_var_list_title = isset( $foodbakery_var_list_title ) ? $foodbakery_var_list_title : '';
        $foodbakery_var_list_type = isset( $foodbakery_var_list_type ) ? $foodbakery_var_list_type : '';
        $foodbakery_var_list_item_icon_color = isset( $foodbakery_var_list_item_icon_color ) ? $foodbakery_var_list_item_icon_color : '';
        $foodbakery_var_list_item_icon_bg_color = isset( $foodbakery_var_list_item_icon_bg_color ) ? $foodbakery_var_list_item_icon_bg_color : '';
        $foodbakery_var_list_align = isset($foodbakery_var_list_align) ? $foodbakery_var_list_align : '';

        $foodbakery_section_title = '';



        if ( isset( $foodbakery_var_column_size ) && $foodbakery_var_column_size != '' ) {
            if ( function_exists( 'foodbakery_var_custom_column_class' ) ) {
                $column_class = foodbakery_var_custom_column_class( $foodbakery_var_column_size );
            }
        }
        if ( isset( $column_class ) && $column_class <> '' ) {
            $html .= '<div class="' . esc_html( $column_class ) . '">';
        }

        if ( isset( $foodbakery_var_list_title ) && trim( $foodbakery_var_list_title ) <> '' ) {
            $foodbakery_section_title .= '<div class="element-title '.$foodbakery_var_list_align.'">';
            $foodbakery_section_title .= '<h2>' . esc_attr( $foodbakery_var_list_title ) . '</h2>';
            $foodbakery_section_title .= '</div>';
        }

        $html .= $foodbakery_section_title;
        if ( $foodbakery_var_list_type == 'numeric-icon' ) {
            $html .= '<ol>';
        } elseif ( $foodbakery_var_list_type == 'alphabetic' ) {
            $html .= '<ol class="cs-alphabetic-list">';
        } elseif ( $foodbakery_var_list_type == 'built' ) {
            $html .= '<ul class="simple-liststyle">';
        } elseif ( $foodbakery_var_list_type == 'icon' ) {
            $html .= '<ul class="cs-icon-list">';
        } else {
            $html .= '<ul>';
        }

        $html .= do_shortcode( $content );

        if ( $foodbakery_var_list_type == 'numeric-icon' || $foodbakery_var_list_type == 'alphabetic' ) {
            $html .= '</ol>';
        } else {
            $html .= '</ul>';
        }
        if ( isset( $column_class ) && $column_class <> '' ) {
            $html .= '</div>';
        }
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
           $html    .=  '</div>';
        }
        return do_shortcode( $html );
    }

}
if ( function_exists( 'foodbakery_var_short_code' ) )
    foodbakery_var_short_code( 'foodbakery_list', 'foodbakery_var_list_shortcode' );

/*
 *
 * @List  Item  shortcode/element front end view
 * @retrun
 *
 */

if ( ! function_exists( 'foodbakery_var_list_item_shortcode' ) ) {

    function foodbakery_var_list_item_shortcode( $atts, $content = "" ) {
        global $post, $foodbakery_var_list_type, $foodbakery_var_list_item_icon_color, $foodbakery_var_list_item_icon_bg_color;
        $defaults = array( 'foodbakery_var_list_item_text' => '', 'foodbakery_var_list_item_icon' => '', );
        extract( shortcode_atts( $defaults, $atts ) );
        $foodbakery_var_list_item_text = isset( $foodbakery_var_list_item_text ) ? $foodbakery_var_list_item_text : '';
        $foodbakery_var_list_item_icon = isset( $foodbakery_var_list_item_icon ) ? $foodbakery_var_list_item_icon : '';

        $html = '';

        if ( isset( $foodbakery_var_list_type ) && $foodbakery_var_list_type == 'icon' ) {
            $icon_style = '';
            if ( $foodbakery_var_list_item_icon_color != '' || $foodbakery_var_list_item_icon_bg_color != '' ) {
                $icon_style .= ' style="';
                if ( $foodbakery_var_list_item_icon_color != '' ) {
                    $icon_style .= 'color: ' . esc_html( $foodbakery_var_list_item_icon_color ) . ' !important;';
                }
                if ( $foodbakery_var_list_item_icon_bg_color != '' ) {
                    $icon_style .= ' background-color: ' . esc_html( $foodbakery_var_list_item_icon_bg_color ) . ' !important;';
                }
                $icon_style .= '"';
            }
            $html .= '<li><i class="has-bg cs-color ' . esc_html( $foodbakery_var_list_item_icon ) . '" ' . $icon_style . ' ></i> ' . esc_html( $foodbakery_var_list_item_text ) . '</li>';
        } else
        if ( isset( $foodbakery_var_list_type ) && $foodbakery_var_list_type == 'default' ) {
            $html .= '<li style="list-style-type:none !important;">' . esc_html( $foodbakery_var_list_item_text ) . '</li>';
        } else
        if ( isset( $foodbakery_var_list_type ) && $foodbakery_var_list_type == 'built' ) {
            $html .= '<li>' . esc_html( $foodbakery_var_list_item_text ) . '</li>';
        } else
        if ( isset( $foodbakery_var_list_type ) && $foodbakery_var_list_type == 'numeric-icon' ) {
            $html .= '<li> ' . esc_html( $foodbakery_var_list_item_text ) . '</li>';
        } else
        if ( isset( $foodbakery_var_list_type ) && $foodbakery_var_list_type == 'alphabetic' ) {
            $html .= '<li style="list-style:lower-alpha !important;"> ' . esc_html( $foodbakery_var_list_item_text ) . '</li>';
        }
        return do_shortcode( $html );
    }

}
if ( function_exists( 'foodbakery_var_short_code' ) )
    foodbakery_var_short_code( 'foodbakery_list_item', 'foodbakery_var_list_item_shortcode' );