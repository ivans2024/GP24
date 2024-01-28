<?php

/*
 *
 * @Shortcode Name : Start function for Eitor shortcode/element front end view
 * @retrun
 *
 */

if ( ! function_exists( 'foodbakery_var_editor_shortocde' ) ) {

    function foodbakery_var_editor_shortocde( $atts, $content = "" ) {
        $html = '';
        $page_element_size  = isset( $atts['editor_element_size'] )? $atts['editor_element_size'] : 100;
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $html   .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
        $defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_var_editor_title' => '',
            'foodbakery_var_editor_align' => '',
        );
        extract( shortcode_atts( $defaults, $atts ) );
        $foodbakery_var_editor_align = isset( $foodbakery_var_editor_align ) ? $foodbakery_var_editor_align : '';
        
        if ( isset( $foodbakery_var_column_size ) && $foodbakery_var_column_size != '' ) {
            if ( function_exists( 'foodbakery_var_custom_column_class' ) ) {
                $column_class = foodbakery_var_custom_column_class( $foodbakery_var_column_size );
            }
        }
        if ( (isset( $foodbakery_var_editor_title ) && $foodbakery_var_editor_title <> "") || (isset( $content ) && $content <> "") ) {
            if ( isset( $column_class ) && $column_class <> '' ) {
                $html .= '<div class="' . esc_html( $column_class ) . '">';
            }
            ///// Editor Element Title
            if ( isset( $foodbakery_var_editor_title ) && $foodbakery_var_editor_title <> "" ) {
                $html .= '<div class="element-title '.$foodbakery_var_editor_align.'">';
                $html .= '<h2>' . esc_html( $foodbakery_var_editor_title ) . '</h2>';
                $html .= '</div>';
            }
            ///// Editor Content
            if ( isset( $content ) && $content <> "" ) {
                $content = nl2br( $content );
                $content = foodbakery_var_custom_shortcode_decode( $content );
                $html .= '<div class="foodbakery_editor">' . do_shortcode( $content ) . '</div>';
            }

            if ( isset( $column_class ) && $column_class <> '' ) {
                $html .= ' </div>';
            }
        }
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
           $html    .=  '</div>';
        }
        return $html;
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'foodbakery_editor', 'foodbakery_var_editor_shortocde' );
    }
}