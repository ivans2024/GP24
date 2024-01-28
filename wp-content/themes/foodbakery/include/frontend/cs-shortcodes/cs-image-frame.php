<?php

/*
 *
 * @Shortcode Name : Image Frame
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_var_image_frame' ) ) {

    function foodbakery_var_image_frame( $atts, $content = "" ) {

        global $header_map, $post;
        
        $foodbakery_var_image_frame = '';
        $page_element_size  = isset( $atts['image_frame_element_size'] )? $atts['image_frame_element_size'] : 100;
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $foodbakery_var_image_frame   .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
        
        $defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_var_image_section_title' => '',
            'foodbakery_var_frame_image_url_array' => '',
            'foodbakery_var_image_title' => '',
            'foodbakery_var_img_align' => '',
            'foodbakery_var_imgframe_align' => '',
        );
        extract( shortcode_atts( $defaults, $atts ) );
        if ( isset( $foodbakery_var_column_size ) && $foodbakery_var_column_size != '' ) {
            if ( function_exists( 'foodbakery_var_custom_column_class' ) ) {
                $column_class = foodbakery_var_custom_column_class( $foodbakery_var_column_size );
            }
        }

        $foodbakery_var_image_section_title = isset( $foodbakery_var_image_section_title ) ? $foodbakery_var_image_section_title : '';
        $foodbakery_var_frame_image_url = isset( $foodbakery_var_frame_image_url_array ) ? $foodbakery_var_frame_image_url_array : '';
        $foodbakery_var_image_title = isset( $foodbakery_var_image_title ) ? $foodbakery_var_image_title : '';
        $foodbakery_var_img_align = isset( $foodbakery_var_img_align ) ? $foodbakery_var_img_align : '';
        $foodbakery_var_imgframe_align = isset($foodbakery_var_imgframe_align) ? $foodbakery_var_imgframe_align : '';

        if ( isset( $column_class ) && $column_class <> '' ) {
            $foodbakery_var_image_frame .= '<div class="' . esc_html( $column_class ) . '">';
        }
        if ( isset( $foodbakery_var_image_section_title ) && $foodbakery_var_image_section_title != '' ) {
            $foodbakery_var_image_frame .= '<div class="element-title '.$foodbakery_var_imgframe_align.'"> <h2>' . esc_html( $foodbakery_var_image_section_title ) . '</h2></div>';
        }

        $foodbakery_var_image_frame .= '<div class="main-post">';
        if ( $foodbakery_var_frame_image_url <> '' ) {
            $foodbakery_var_image_frame .= '<div class="media-holder ' . esc_html( $foodbakery_var_img_align ) . '">'
                    . '<figure><img alt = "' . esc_html( $foodbakery_var_image_title ) . '" src = "' . esc_url( $foodbakery_var_frame_image_url ) . '">'
                    . '</figure></div>';
        }
        if ( $content != '' || $foodbakery_var_image_title != '' ) {
            $foodbakery_var_image_frame .= '<div class="cs-text" >';
            if ( $foodbakery_var_image_title && trim( $foodbakery_var_image_title ) != '' ) {
                $foodbakery_var_image_frame .= '<h4>' . esc_html( $foodbakery_var_image_title ) . '</h4>';
            }
            if ( $content <> '' ) {
                $foodbakery_var_image_frame .= do_shortcode( $content );
            }
            $foodbakery_var_image_frame .= '</div>';
        }
        $foodbakery_var_image_frame .= '</div>';

        if ( isset( $column_class ) && $column_class <> '' ) {
            $foodbakery_var_image_frame .= '</div>';
        }
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
           $foodbakery_var_image_frame    .=  '</div>';
        }
        return $foodbakery_var_image_frame;
    }

    if ( function_exists( 'foodbakery_var_short_code' ) )
        foodbakery_var_short_code( 'foodbakery_image_frame', 'foodbakery_var_image_frame' );
}