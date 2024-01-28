<?php

// start Heading shortcode front end view function
if ( ! function_exists( 'foodbakery_var_heading' ) ) {

    function foodbakery_var_heading( $atts, $content = "" ) {
        $divider_div = '';
        $html = '';
        $page_element_size = isset( $atts['heading_element_size'] ) ? $atts['heading_element_size'] : 100;
        if ( function_exists( 'foodbakery_var_page_builder_element_sizes' ) ) {
            $html .= '<div class="' . foodbakery_var_page_builder_element_sizes( $page_element_size ) . ' ">';
        }
        $defaults = array(
            'column_size' => '1/1',
            'foodbakery_heading_title' => '',
            'foodbakery_heading_color' => '#000',
            'class' => 'cs-heading-shortcode',
            'foodbakery_heading_style' => '1',
            'foodbakery_heading_size' => '',
            'foodbakery_letter_space' => '',
            'foodbakery_line_height' => '',
            'foodbakery_heading_font_style' => '',
            'foodbakery_heading_view' => 'view-1',
            'foodbakery_heading_align' => 'center',
            'foodbakery_heading_divider' => '',
        );

        extract( shortcode_atts( $defaults, $atts ) );
        $column_class = foodbakery_var_custom_column_class( $column_size );
        $css = '';
        $he_font_style = '';

        $foodbakery_heading_title = isset( $foodbakery_heading_title ) ? $foodbakery_heading_title : '';
        $foodbakery_heading_color = isset( $foodbakery_heading_color ) ? $foodbakery_heading_color : '';
        $foodbakery_heading_style = isset( $foodbakery_heading_style ) ? $foodbakery_heading_style : '';
        $foodbakery_heading_size = isset( $foodbakery_heading_size ) ? $foodbakery_heading_size : '';
        $foodbakery_letter_space = isset( $foodbakery_letter_space ) ? $foodbakery_letter_space : '';
        $foodbakery_line_height = isset( $foodbakery_line_height ) ? $foodbakery_line_height : '';
        $foodbakery_heading_font_style = isset( $foodbakery_heading_font_style ) ? $foodbakery_heading_font_style : '';
        $foodbakery_heading_view = isset( $foodbakery_heading_view ) ? $foodbakery_heading_view : '';
        $foodbakery_heading_align = isset( $foodbakery_heading_align ) ? $foodbakery_heading_align : '';
        $foodbakery_heading_divider = isset( $foodbakery_heading_divider ) ? $foodbakery_heading_divider : '';
        if ( $foodbakery_heading_font_style <> '' ) {
            $he_font_style = ' font-style:' . $foodbakery_heading_font_style;
        }
        echo foodbakery_allow_special_char( $css, false );


        $foodbakery_stylish_heading_class = '';
        if ( $foodbakery_heading_style == 'stylish' ) {
            $foodbakery_stylish_heading_class = ' cs-stylish-heading';
        }
        if ( $foodbakery_heading_view == 'view-1' ) {
            $html .= '<div class="element-title' . esc_html( $foodbakery_stylish_heading_class ) . '">';
        } else {
            $html .= '<div class="section-title' . esc_html( $foodbakery_stylish_heading_class ) . '">';
        }
        if ( $foodbakery_heading_title != '' ) {
            if ( $foodbakery_heading_style == 'section_title' ) {
                $html .= '<div class="element-title"><h2 style="color:' . esc_html( $foodbakery_heading_color ) . ' !important; font-size: ' . esc_html( $foodbakery_heading_size ) . 'px !important; letter-spacing: ' . esc_html( $foodbakery_letter_space ) . 'px !important; line-height: ' . esc_html( $foodbakery_line_height ) . 'px !important; text-align:' . esc_html( $foodbakery_heading_align ) . ';' . esc_html( $he_font_style ) . ';">' . esc_html( $foodbakery_heading_title ) . '</h2></div>';
            } elseif ( $foodbakery_heading_style == 'fancy' ) {
                $html .= '<h3 class="cs-fancy" style="color:' . esc_html( $foodbakery_heading_color ) . ' !important; font-size: ' . esc_html( $foodbakery_heading_size ) . 'px !important; letter-spacing: ' . esc_html( $foodbakery_letter_space ) . 'px !important; line-height: ' . esc_html( $foodbakery_line_height ) . 'px !important; text-align:' . esc_html( $foodbakery_heading_align ) . ';' . esc_html( $he_font_style ) . ';">' . esc_html( $foodbakery_heading_title ) . '</h3>';
            } elseif ( $foodbakery_heading_style == 'stylish' ) {
                $html .= '<h2 style="color:' . esc_html( $foodbakery_heading_color ) . ' !important; font-size: ' . esc_html( $foodbakery_heading_size ) . 'px !important; letter-spacing: ' . esc_html( $foodbakery_letter_space ) . 'px !important; line-height: ' . esc_html( $foodbakery_line_height ) . 'px !important; text-align:' . esc_html( $foodbakery_heading_align ) . ';' . esc_html( $he_font_style ) . ';">' . esc_html( $foodbakery_heading_title ) . '</h2>';
            } elseif ( $foodbakery_heading_style == 'modern' ) {
                if ( $foodbakery_heading_title != '' ) {
                    $heading_title_words = explode( " ", $foodbakery_heading_title );
                    $heading_title_words[0] = isset( $heading_title_words[0] ) ? '<span class="cs-color">' . $heading_title_words[0] . '</span>' : '';
                    $foodbakery_heading_title = implode( ' ', $heading_title_words );
                    $html .= '<h3 style="color:' . esc_html( $foodbakery_heading_color ) . ' !important; font-size: ' . esc_html( $foodbakery_heading_size ) . 'px !important; letter-spacing: ' . esc_html( $foodbakery_letter_space ) . 'px !important; line-height: ' . esc_html( $foodbakery_line_height ) . 'px !important; text-align:' . esc_html( $foodbakery_heading_align ) . ';' . esc_html( $he_font_style ) . ';">' . esc_html( $foodbakery_heading_title ) . '</h3>';
                }
            } else {
                $html .= '<h' . $foodbakery_heading_style . ' style="color:' . esc_html( $foodbakery_heading_color ) . ' !important; font-size: ' . esc_html( $foodbakery_heading_size ) . 'px !important; letter-spacing: ' . esc_html( $foodbakery_letter_space ) . 'px !important; line-height: ' . esc_html( $foodbakery_line_height ) . 'px !important; text-align:' . esc_html( $foodbakery_heading_align ) . ';' . esc_html( $he_font_style ) . ';">' . esc_html( $foodbakery_heading_title ) . '</h' . $foodbakery_heading_style . '>';
            }
        }
        if ( $content != '' ) {
            $html .= nl2br( $content );
        }
        if ( isset( $foodbakery_heading_divider ) and $foodbakery_heading_divider == 'on' ) {
            $html .= '<div class="center">';
            $html .= '<div class="cs-spreator">';
            $html .= '<div class="cs-seprater" style="text-align:center;"> <span> <i class="icon-transport177"> </i> </span> </div>';
            $html .= '</div>';
            $html .= '</div>';
        }
        $html .= '</div>';
        if ( function_exists( 'foodbakery_var_page_builder_element_sizes' ) ) {
            $html .= '</div>';
        }
        return do_shortcode( $html );
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'foodbakery_heading', 'foodbakery_var_heading' );
    }
}