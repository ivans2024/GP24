<?php

/*
 *
 * @Shortcode Name :  tabs front end view
 * @retrun
 *
 */

if ( ! function_exists( 'foodbakery_var_tabs_shortcode' ) ) {


    function foodbakery_var_tabs_shortcode( $atts, $content = "" ) {

        global $post, $foodbakery_var_tabs_column;
        global $tabs_content;
        $tabs_content = '';
        $defaults = array(
            'foodbakery_var_element_title' => '',
            'foodbakery_var_tabs_view' => '',
            'foodbakery_var_tabs_align' => '',
        );

        extract( shortcode_atts( $defaults, $atts ) );
        $foodbakery_var_element_title = isset( $foodbakery_var_element_title ) ? $foodbakery_var_element_title : '';
        $foodbakery_var_tabs_view = isset( $foodbakery_var_tabs_view ) ? $foodbakery_var_tabs_view : '';
        $foodbakery_var_tabs_align = isset($foodbakery_var_tabs_align) ? $foodbakery_var_tabs_align : '';
        $html = '';
        $foodbakery_section_title = '';
        $foodbakery_section_sub_title = '';
        $page_element_size = isset( $atts['tabs_element_size'] ) ? $atts['tabs_element_size'] : 100;
        if ( function_exists( 'foodbakery_var_page_builder_element_sizes' ) ) {
            $html .= '<div class="' . foodbakery_var_page_builder_element_sizes( $page_element_size ) . ' ">';
        }
        if ( isset( $foodbakery_var_element_title ) && trim( $foodbakery_var_element_title ) <> '' ) {
            $foodbakery_section_title = '<div class="element-title '.$foodbakery_var_tabs_align.'"><h2>' . esc_attr( $foodbakery_var_element_title ) . '</h2></div>';
        }
        $html .= $foodbakery_section_title;

        if ( $foodbakery_var_tabs_view == "horizontal" ) {
            $html .= "<div class='cs-tabs full-width horizontal-tabs'>";
        } else {
            $html .= "<div class='cs-faq-tabs vertical-tabs'>";
        }
        $html .= '  <ul class="nav nav-tabs" role="tablist">';
        $html .= do_shortcode( $content );
        $html .= '</ul>';
        $html .= '<div class="tab-content">';
        $html .= $tabs_content;
        $html .= '</div>';
        $html .= '</div>';
        if ( function_exists( 'foodbakery_var_page_builder_element_sizes' ) ) {
            $html .= '</div>';
        }


        return do_shortcode( $html );
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'tabs', 'foodbakery_var_tabs_shortcode' );
    }
}


/*
 *
 * @List  Item  shortcode/element front end view
 * @retrun
 *
 */

if ( ! function_exists( 'foodbakery_var_tabs_item_shortcode' ) ) {

    function foodbakery_var_tabs_item_shortcode( $atts, $content = "" ) {
        global $post, $foodbakery_var_tabs_column, $tabs_content;
        $output = '';
        global $tabs_content;
        $defaults = array(
            'foodbakery_var_tabs_title' => '',
            'foodbakery_var_tabs_icon' => '',
            'foodbakery_var_tab_active' => ''
        );
        extract( shortcode_atts( $defaults, $atts ) );
        $foodbakery_var_tabs_column_str = '';
        if ( $foodbakery_var_tabs_column != 12 ) {
            $foodbakery_var_tabs_column_str = 'class = "col-md-' . esc_html( $foodbakery_var_tabs_column ) . '"';
        }
        $foodbakery_var_tabs_title = isset( $foodbakery_var_tabs_title ) ? $foodbakery_var_tabs_title : '';
        $foodbakery_var_tabs_color = isset( $foodbakery_var_tabs_color ) ? $foodbakery_var_tabs_color : '';
        $foodbakery_var_tabs_icon = isset( $foodbakery_var_tabs_icon ) ? $foodbakery_var_tabs_icon : '';
        $foodbakery_var_tab_active = isset( $foodbakery_var_tab_active ) ? $foodbakery_var_tab_active : '';
        ?>

        <?php

        $activeClass = "";
        if ( $foodbakery_var_tab_active == 'Yes' ) {
            $activeClass = 'active in';
        }

        $fa_icon = '';
        if ( $foodbakery_var_tabs_icon ) {
            $fa_icon = '<i class="' . sanitize_html_class( $foodbakery_var_tabs_icon ) . '"></i>  ';
        }
        $randid = rand( 877, 9999 );
        $output .= '<li  class="' . ($activeClass) . '"><a data-toggle="tab" href="#cs-tab-' . sanitize_title( $foodbakery_var_tabs_title ) . $randid . '"  aria-expanded="true">' . $fa_icon . $foodbakery_var_tabs_title . '</a></li>';
        $tabs_content .= '<div id="cs-tab-' . sanitize_title( $foodbakery_var_tabs_title ) . $randid . '" class="tab-pane fade ' . ($activeClass) . '">';
        $tabs_content .= do_shortcode( $content );
        $tabs_content .= '</div>';

        return do_shortcode( $output );
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'tabs_item', 'foodbakery_var_tabs_item_shortcode' );
    }
}