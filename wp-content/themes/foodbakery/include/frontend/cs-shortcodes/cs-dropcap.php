<?php

/**
 * dropcap html form for page builder
 */
if ( ! function_exists( 'foodbakery_var_dropcap_shortcode' ) ) {

    function foodbakery_var_dropcap_shortcode( $atts, $content = "" ) {
         $html = '';
        $page_element_size  = isset( $atts['dropcap_element_size'] )? $atts['dropcap_element_size'] : 100;
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $html   .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
        $foodbakery_var_defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_dropcap_section_title' => '',
            'foodbakery_var_drop_align' => '',
        );
        $author_name = '';
        extract( shortcode_atts( $foodbakery_var_defaults, $atts ) );

        $foodbakery_dropcap_section_title = isset( $foodbakery_dropcap_section_title ) ? $foodbakery_dropcap_section_title : '';
        $foodbakery_var_drop_align = isset( $foodbakery_var_drop_align ) ? $foodbakery_var_drop_align : '';
        $dropcap_cite_url = isset( $dropcap_cite_url ) ? $dropcap_cite_url : '';
        $dropcap_cite = isset( $dropcap_cite ) ? $dropcap_cite : '';
        if ( isset( $dropcap_cite_url ) && $dropcap_cite_url <> '' ) {

            if ( isset( $dropcap_cite_url ) && $dropcap_cite_url <> '' ) {
                $author_name .= '<a href="' . esc_url( $dropcap_cite_url ) . '">';
            }
            $author_name .= '-- ' . $dropcap_cite;
            if ( isset( $dropcap_cite_url ) && $dropcap_cite_url <> '' ) {
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
        if ( $foodbakery_dropcap_section_title && trim( $foodbakery_dropcap_section_title ) != '' ) {
            $html .= '<div class="element-title '.$foodbakery_var_drop_align.'"><h2>' . esc_html( $foodbakery_dropcap_section_title ) . '</h2></div>';
        }
        $html .= '<div class="cs-dropcap">
		<p>' . do_shortcode( $content ) . '</p>
		</div>';
        if ( isset( $column_class ) && $column_class <> '' ) {
            $html .= '</div>';
        }
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
           $html    .=  '</div>';
        }
        return $html;
    }

    if ( function_exists( 'foodbakery_var_short_code' ) )
        foodbakery_var_short_code( 'foodbakery_dropcap', 'foodbakery_var_dropcap_shortcode' );
}