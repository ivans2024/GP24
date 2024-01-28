<?php

/*
 *
 * @Shortcode Name :  Team front end view
 * @retrun
 *
 */

if ( ! function_exists( 'foodbakery_var_team_shortcode' ) ) {

    function foodbakery_var_team_shortcode( $atts, $content = "" ) {
        $html = '';
        global $post, $foodbakery_var_team_column, $foodbakery_var_team_col;
        $page_element_size  = isset( $atts['team_element_size'] )? $atts['team_element_size'] : 100;
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $html   .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
        if ( ! function_exists( 'foodbakery_var_theme_demo' ) ) {

            function foodbakery_var_theme_demo( $str = '' ) {
                global $foodbakery_strings;
                if ( isset( $foodbakery_strings[$str] ) ) {
                    return $foodbakery_strings[$str];
                }
            }

        }
        $defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_var_team_title' => '',
            'foodbakery_var_team_sub_title' => '',
            'foodbakery_var_team_col' => '',
            'foodbakery_var_team_align' => '',
        );
        extract( shortcode_atts( $defaults, $atts ) );

        $foodbakery_var_column_size = isset( $foodbakery_var_column_size ) ? $foodbakery_var_column_size : '';
        $foodbakery_var_team_title = isset( $foodbakery_var_team_title ) ? $foodbakery_var_team_title : '';
        $foodbakery_var_team_sub_title = isset( $foodbakery_var_team_sub_title ) ? $foodbakery_var_team_sub_title : '';
        $foodbakery_var_team_col = isset( $foodbakery_var_team_col ) ? $foodbakery_var_team_col : '';
        $foodbakery_var_team_align = isset($foodbakery_var_team_align) ? $foodbakery_var_team_align : '';

        
        $foodbakery_section_title = '';

        if ( isset( $foodbakery_var_column_size ) && $foodbakery_var_column_size != '' ) {
            if ( function_exists( 'foodbakery_var_custom_column_class' ) ) {
                $column_class = foodbakery_var_custom_column_class( $foodbakery_var_column_size );
            }
        }
        if ( isset( $column_class ) && $column_class <> '' ) {
            $html .= '<div class="' . esc_html( $column_class ) . '">';
        }
        if ( trim( $foodbakery_var_team_title ) <> '' ) {
            $foodbakery_section_title .= '<div class="element-title '.$foodbakery_var_team_align.'">';
            $foodbakery_section_title .= '<h2>' . esc_attr( $foodbakery_var_team_title ) . '</h2>';
            $foodbakery_section_title .= '</div>';
        }
        $html .= $foodbakery_section_title;
        $html .= '<div class="row">';
        $html .= do_shortcode( $content );
        $html .= '</div>';

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
    foodbakery_var_short_code( 'foodbakery_team', 'foodbakery_var_team_shortcode' );

/*
 *
 * @List  Item  shortcode/element front end view
 * @retrun
 *
 */

if ( ! function_exists( 'foodbakery_var_team_item_shortcode' ) ) {

    function foodbakery_var_team_item_shortcode( $atts, $content = "" ) {
        global $post, $foodbakery_var_team_col;
        $defaults = array(
            'foodbakery_var_team_name' => '',
            'foodbakery_var_team_designation' => '',
            'foodbakery_var_team_link' => '',
            'foodbakery_var_team_image' => '',
            'foodbakery_var_team_text' => ''
        );
        extract( shortcode_atts( $defaults, $atts ) );

        $foodbakery_var_team_name = isset( $foodbakery_var_team_name ) ? $foodbakery_var_team_name : '';
        $foodbakery_var_team_designation = isset( $foodbakery_var_team_designation ) ? $foodbakery_var_team_designation : '';
        $foodbakery_var_team_link = isset( $foodbakery_var_team_link ) ? $foodbakery_var_team_link : '';
        $foodbakery_var_team_image = isset( $foodbakery_var_team_image ) ? $foodbakery_var_team_image : '';
        $foodbakery_var_team_text = isset( $foodbakery_var_team_text ) ? $foodbakery_var_team_text : '';
        $col_class = '';
        if ( isset( $foodbakery_var_team_col ) && $foodbakery_var_team_col != '' ) {
            $number_col = 12 / $foodbakery_var_team_col;
            $number_col_sm = 12;
            $number_col_xs = 12;
            if ( $number_col == 2 ) {
                $number_col_sm = 4;
                $number_col_xs = 6;
            }
            if ( $number_col == 3 ) {
                $number_col_sm = 6;
                $number_col_xs = 12;
            }
            if ( $number_col == 4 ) {
                $number_col_sm = 6;
                $number_col_xs = 12;
            }
            if ( $number_col == 6 ) {
                $number_col_sm = 12;
                $number_col_xs = 12;
            }
            $col_class = 'col-lg-' . $number_col . ' col-md-' . $number_col . ' col-sm-' . $number_col_sm . ' col-xs-' . $number_col_xs . '';
        }

        $html = '';

        $html .= '<div class="' . esc_html( $col_class ) . '">';

        $team_link = 'javascript:void(0)';
        if ( '' != $foodbakery_var_team_link ) {
            $team_link = esc_url( $foodbakery_var_team_link );
        }

        $html .= ' <div class="team team-grid scrollingeffect fadeInUp">';
        $html .= ' <div class="img-holder">';
        if ( $foodbakery_var_team_image <> '' ) {
            $html .= ' <figure><a href="' . $team_link . '"><img src="' . esc_url( $foodbakery_var_team_image ) . '" alt="foodbakery_var_team_image"></a><figcaption><a href="' . $team_link . '"><span class="icon-add_box"></span></a></figcaption></figure>';
        }
        $html .= ' </div>';

        $html .= '<div class="team-info">';

        $html .= ' <div class="post-title">';
        if ( $foodbakery_var_team_designation <> '' ) {
            $html .= ' <span class="position">' . esc_html( $foodbakery_var_team_designation ) . '</span>';
        }

        if ( $foodbakery_var_team_name <> '' ) {
            $html .= ' <h2><a href="' . $team_link . '">' . esc_html( $foodbakery_var_team_name ) . '</a></h2>';
        }
        $html .= ' </div>';

        $html .= '<div class="team-detail">';
        $html .= '<p>' . do_shortcode( $content ) . '</p>';
        $html .= '</div>';

        $html .= ' </div>';
        $html .= ' </div>';
        $html .= ' </div>';

        return do_shortcode( $html );
    }

}
if ( function_exists( 'foodbakery_var_short_code' ) )
    foodbakery_var_short_code( 'foodbakery_team_item', 'foodbakery_var_team_item_shortcode' );