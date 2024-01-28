<?php

/*
 *
 * @Shortcode Name : Start function for Table shortcode/element front end view
 * @retrun
 *
 */

if ( ! function_exists( 'foodbakery_var_table_shortcode' ) ) {

    function foodbakery_var_table_shortcode( $atts, $content = "" ) {
        $defaults = array( 'foodbakery_table_element_title' => '', 'foodbakery_var_column_size' => '','foodbakery_var_table_align' => '' );
        extract( shortcode_atts( $defaults, $atts ) );
        $foodbakery_var_table_align = isset($foodbakery_var_table_align) ? $foodbakery_var_table_align : '';
        if ( isset( $foodbakery_var_column_size ) && $foodbakery_var_column_size != '' ) {
            if ( function_exists( 'foodbakery_var_custom_column_class' ) ) {
                $column_class = foodbakery_var_custom_column_class( $foodbakery_var_column_size );
            }
        }
        $html = '';
        $page_element_size  = isset( $atts['table_element_size'] )? $atts['table_element_size'] : 100;
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $html   .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
        ////// Start Column Class
        if ( isset( $column_class ) && $column_class <> '' ) {
            $html .= '<div class="' . esc_html( $column_class ) . '">';
        }
        ////// Element Title
        if ( isset( $foodbakery_table_element_title ) && trim( $foodbakery_table_element_title ) <> '' ) {
            $html .= '<div class="element-title '.$foodbakery_var_table_align.'"><h2>' . esc_html( $foodbakery_table_element_title ) . '</h2></div>';
        }
        ////// Table Content
        $html .= '<div class="cs-pricing-table table-responsive">' . do_shortcode( $content ) . '</div>';
        ////// End Column Class
        if ( isset( $column_class ) && $column_class <> '' ) {
            $html .= ' </div>';
        }
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $html   .= '</div>';
        }
        return $html;
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'foodbakery_table', 'foodbakery_var_table_shortcode' );
    }
}
/*
 *
 * @Shortcode Name : Start function for Table shortcode/element front end view
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_table_shortcode' ) ) {

    function foodbakery_table_shortcode( $atts, $content = "" ) {
        $defaults = array( 'foodbakery_table_content' => '' );
        extract( shortcode_atts( $defaults, $atts ) );
        return '<table class="table ">' . do_shortcode( $content ) . '</table>';
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'table', 'foodbakery_table_shortcode' );
    }
}

/*
 *
 * @Shortcode Name : Start function for Table Body  shortcode/element front end view
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_table_body_shortcode' ) ) {

    function foodbakery_table_body_shortcode( $atts, $content = "" ) {
        $defaults = array();
        extract( shortcode_atts( $defaults, $atts ) );
        return '<tbody>' . do_shortcode( $content ) . '</tbody>';
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'tbody', 'foodbakery_table_body_shortcode' );
    }
}
/*
 *
 * @Shortcode Name : Start function for Table Head  shortcode/element front end view
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_table_head_shortcode' ) ) {

    function foodbakery_table_head_shortcode( $atts, $content = "" ) {
        $defaults = array();
        extract( shortcode_atts( $defaults, $atts ) );
        return '<thead>' . do_shortcode( $content ) . '</thead>';
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'thead', 'foodbakery_table_head_shortcode' );
    }
}
/*
 *
 * @Shortcode Name : Start function for Table Row  shortcode/element front end view
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_table_row_shortcode' ) ) {

    function foodbakery_table_row_shortcode( $atts, $content = "" ) {
        $defaults = array();
        extract( shortcode_atts( $defaults, $atts ) );
        return '<tr>' . do_shortcode( $content ) . '</tr>';
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'tr', 'foodbakery_table_row_shortcode' );
    }
}

/*
 *
 * @Shortcode Name :Start function for Table Heading  shortcode/element front end view
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_table_heading_shortcode' ) ) {

    function foodbakery_table_heading_shortcode( $atts, $content = "" ) {
        $defaults = array();
        extract( shortcode_atts( $defaults, $atts ) );
        $html = '';
        $html .= '<th>';
        $html .= do_shortcode( $content );
        $html .= '</th>';

        return $html;
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'th', 'foodbakery_table_heading_shortcode' );
    }
}

/*
 *
 * @Shortcode Name :  Start function for Table Data  shortcode/element front end view
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_table_data_shortcode' ) ) {

    function foodbakery_table_data_shortcode( $atts, $content = "" ) {
        $defaults = array();
        extract( shortcode_atts( $defaults, $atts ) );
        return '<td>' . do_shortcode( $content ) . '</td>';
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'td', 'foodbakery_table_data_shortcode' );
    }
}