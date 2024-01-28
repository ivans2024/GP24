<?php

/**
 * Quote html form for page builder
 */
if ( ! function_exists( 'foodbakery_var_quote_shortcode' ) ) {

    function foodbakery_var_quote_shortcode( $atts, $content = "" ) {
        $html = '';
        $page_element_size  = isset( $atts['quote_element_size'] )? $atts['quote_element_size'] : 100;
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $html   .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
        $foodbakery_var_defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_quote_section_title' => '',
            'foodbakery_quote_cite' => '',
            'foodbakery_quote_cite_url' => '#',
            'foodbakery_author_position' => '',
            'foodbakery_var_quote_align' => '',
        );
        $author_name = '';
        extract( shortcode_atts( $foodbakery_var_defaults, $atts ) );
        $foodbakery_quote_section_title = isset( $foodbakery_quote_section_title ) ? $foodbakery_quote_section_title : '';
        $foodbakery_quote_cite_url = isset( $foodbakery_quote_cite_url ) ? $foodbakery_quote_cite_url : '';
        $foodbakery_quote_cite = isset( $foodbakery_quote_cite ) ? $foodbakery_quote_cite : '';
		$foodbakery_author_position = isset( $foodbakery_author_position ) ? $foodbakery_author_position : '';
                $foodbakery_var_quote_align = isset($foodbakery_var_quote_align) ? $foodbakery_var_quote_align : '';
	
        if ( isset( $foodbakery_quote_cite_url ) && $foodbakery_quote_cite_url <> '' ) {

            if ( isset( $foodbakery_quote_cite_url ) && $foodbakery_quote_cite_url <> '' ) {
                $author_name .= '<a class="text-color" href="' . esc_url( $foodbakery_quote_cite_url ) . '">';
            }
            $author_name .= $foodbakery_quote_cite;
            if ( isset( $foodbakery_quote_cite_url ) && $foodbakery_quote_cite_url <> '' ) {
                $author_name .= '</a>';
            }
        }
        $column_class = '';
        if ( isset( $foodbakery_var_column_size ) && $foodbakery_var_column_size != '' ) {
            if ( function_exists( 'foodbakery_var_custom_column_class' ) ) {
                $column_class = foodbakery_var_custom_column_class( $foodbakery_var_column_size );
            }
        }
        if ( isset( $column_class ) && $column_class <> '' ) {
            $html .= '<div  class="' . esc_html( $column_class ) . '" >';
        }
        $html .= '<div class="blockquote-hloder">';
        if ( $foodbakery_quote_section_title && trim( $foodbakery_quote_section_title ) != '' ) {
            $html .= '<div class="element-title '.$foodbakery_var_quote_align.'"><h2 class="">' . esc_html( $foodbakery_quote_section_title ) . '</h2></div>';
        }
        $html .= '<blockquote>';
        $html .= '<p>' . do_shortcode( $content ) . '</p>';
        
        $html .= '</blockquote>';
        if ( $author_name || $foodbakery_author_position ) {
            $html .= '<div class="author-info">';
            
            if ( $author_name && $foodbakery_author_position ) {
                $html .= '<p>';
                $html .= $author_name;
                $html .= '</p>';
            }
            $html .= $foodbakery_author_position;
            $html .= '</div>';
        }
        $html .= '</div>';
        if ( isset( $column_class ) && $column_class <> '' ) {
            $html .= '</div>';
        }
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
           $html    .=  '</div>';
        }
        return $html;
    }
    if ( function_exists( 'foodbakery_var_short_code' ) )
        foodbakery_var_short_code( 'foodbakery_quote', 'foodbakery_var_quote_shortcode' );
}