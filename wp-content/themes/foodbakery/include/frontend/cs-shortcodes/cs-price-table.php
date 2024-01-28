<?php

/*
 *
 * @Shortcode Name :   Start function for Price Plan shortcode/element front end view
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_price_table_shortcode' ) ) {

    function foodbakery_price_table_shortcode( $atts, $content = null ) {
        global $foodbakery_multi_price_col, $foodbakery_price_plan_counter, $foodbakery_price_table_style;
        $foodbakery_price_plan_counter == 0;
        $foodbakery_var_price_table = '';
        $page_element_size  = isset( $atts['price_table_element_size'] )? $atts['price_table_element_size'] : 100;
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $foodbakery_var_price_table   .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
        $defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_multi_price_table_section_title' => '',
            'foodbakery_price_table_style' => '',
            'foodbakery_multi_price_col' => '',
            'foodbakery_var_price_align' => '',
        );
        extract( shortcode_atts( $defaults, $atts ) );

        $foodbakery_var_column_size = isset( $foodbakery_var_column_size ) ? $foodbakery_var_column_size : '';
        $foodbakery_multi_price_table_section_title = isset( $foodbakery_multi_price_table_section_title ) ? $foodbakery_multi_price_table_section_title : '';
        $foodbakery_price_table_style = isset( $foodbakery_price_table_style ) ? $foodbakery_price_table_style : '';
        $foodbakery_var_price_table_text = isset( $foodbakery_var_price_table_text ) ? $foodbakery_var_price_table_text : '';
        $foodbakery_var_price_align = isset($foodbakery_var_price_align) ? $foodbakery_var_price_align : '';


        if ( isset( $foodbakery_var_column_size ) && $foodbakery_var_column_size != '' ) {
            if ( function_exists( 'foodbakery_var_custom_column_class' ) ) {
                $column_class = foodbakery_var_custom_column_class( $foodbakery_var_column_size );
            }
        }

        if ( isset( $column_class ) && $column_class <> '' ) {

            $foodbakery_var_price_table .= '<div class="' . esc_html( $column_class ) . '">';
        }
        $foodbakery_var_price_table .='<div class="row">';
        if ( $foodbakery_multi_price_table_section_title <> '' ) {
            $foodbakery_var_price_table .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
            $foodbakery_var_price_table .= '<div class="element-title '.$foodbakery_var_price_align.'"><h2>' . esc_html( $foodbakery_multi_price_table_section_title ) . '</h2></div>';
            $foodbakery_var_price_table .= '</div>';
        }
        $foodbakery_var_price_table .= '' . do_shortcode( $content ) . '';

        $foodbakery_inline_script = '(function($){ $(".price-items-wrapper > div").last().find(".pricetable-holder").addClass("last-element"); })(jQuery);';
        foodbakery_inline_enqueue_script( $foodbakery_inline_script, 'foodbakery-functions' );

        $foodbakery_var_price_table .='</div>';

        if ( isset( $column_class ) && $column_class <> '' ) {
            $foodbakery_var_price_table .= '</div>';
        }
        
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
           $foodbakery_var_price_table    .=  '</div>';
        }

        return $foodbakery_var_price_table;
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'foodbakery_price_table', 'foodbakery_price_table_shortcode' );
    }
}

/*
 *
 * @Shortcode Name :  Start function for Price Plan Item shortcode/element front end view
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_price_table_item' ) ) {

    function foodbakery_price_table_item( $atts, $content = null ) {
        global $foodbakery_multi_price_col, $foodbakery_price_plan_counter, $foodbakery_price_table_style;
        $defaults = array(
            'foodbakery_price_table_text' => '',
            'foodbakery_price_table_title_color' => '',
            'foodbakery_price_table_price' => '',
            'foodbakery_price_table_currency' => '',
            'foodbakery_price_table_time_duration' => '',
            'foodbakery_button_link' => '',
            'foodbakery_price_table_button_text' => '',
            'foodbakery_price_table_button_color' => '',
            'foodbakery_price_table_button_color_bg' => '',
            'foodbakery_price_table_featured' => '',
            'foodbakery_price_table_column_bgcolor' => '',
        );

        extract( shortcode_atts( $defaults, $atts ) );

        if ( $foodbakery_price_plan_counter == 0 ) {
            $first = 'first-element';
        } else {
            $first = '';
        }

        $foodbakery_multi_price_col = isset( $foodbakery_multi_price_col ) ? $foodbakery_multi_price_col : '';

        $foodbakery_price_table_text = isset( $foodbakery_price_table_text ) ? $foodbakery_price_table_text : '';
        $foodbakery_price_table_title_color = isset( $foodbakery_price_table_title_color ) ? $foodbakery_price_table_title_color : '';
        $foodbakery_price_table_price = isset( $foodbakery_price_table_price ) ? $foodbakery_price_table_price : '';
        $foodbakery_price_table_currency = isset( $foodbakery_price_table_currency ) ? $foodbakery_price_table_currency : '';
        $foodbakery_price_table_time_duration = isset( $foodbakery_price_table_time_duration ) ? $foodbakery_price_table_time_duration : '';
        $foodbakery_button_link = isset( $foodbakery_button_link ) ? $foodbakery_button_link : '';
        $foodbakery_price_table_button_text = isset( $foodbakery_price_table_button_text ) ? $foodbakery_price_table_button_text : '';
        $foodbakery_price_table_button_color = isset( $foodbakery_price_table_button_color ) ? $foodbakery_price_table_button_color : '';
        $foodbakery_price_table_button_color_bg = isset( $foodbakery_price_table_button_color_bg ) ? $foodbakery_price_table_button_color_bg : '';
        $foodbakery_price_table_featured = isset( $foodbakery_price_table_featured ) ? $foodbakery_price_table_featured : '';
        $foodbakery_price_table_column_bgcolor = isset( $foodbakery_price_table_column_bgcolor ) ? 'style="background-color:' . $foodbakery_price_table_column_bgcolor . ' !important;" ' : '';
        $active_class = '';
        $featured_text = '';
        if ( $foodbakery_price_table_featured == 'Yes' ) {
            $active_class = 'active';
            $featured_text = '
			<div class="category bgcolor">
				<em>' . esc_html__( 'Featured', 'foodbakery' ) . '</em>
			</div>';
        }

        if ( isset( $foodbakery_multi_price_col ) && $foodbakery_multi_price_col != '' ) {
            $number_col = 12 / $foodbakery_multi_price_col;
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
        $advance_class = '';
        if ( $foodbakery_price_table_style == 'advance' ) {
            $advance_class = 'advance';
        }

        $foodbakery_var_price_table_item = '';
        $foodbakery_var_price_table_item .= '<div class="' . esc_html( $col_class ) . ' ' . $advance_class . '">';
        //simple view
        if ( $foodbakery_price_table_style == 'classic' ) {

            $foodbakery_var_price_table_item .= '<div class="pricetable-holder center ' . esc_html( $active_class ) . '" ' . foodbakery_allow_special_char( $foodbakery_price_table_column_bgcolor ) . '>';

            $foodbakery_var_price_table_item .= '<div class="price-holder">';
            $foodbakery_var_price_table_item .= '<div class="cs-price">';

            $foodbakery_var_price_table_item .= $featured_text;
            if ( $foodbakery_price_table_text <> '' ) {
                $foodbakery_var_price_table_item .= '<h2 class="text-color">' . esc_html( $foodbakery_price_table_text ) . '</h2>';
            }

            $foodbakery_var_price_table_item .= '
			<span style="color:' . foodbakery_allow_special_char( $foodbakery_price_table_title_color ) . '!important;">';
            if ( $foodbakery_price_table_currency <> '' ) {
                $foodbakery_var_price_table_item .= '<small>' . esc_html( $foodbakery_price_table_currency ) . '</small>';
            }
            if ( $foodbakery_price_table_price <> '' ) {
                $foodbakery_var_price_table_item .= esc_html( $foodbakery_price_table_price );
            }

            if ( $foodbakery_price_table_time_duration <> '' ) {
                $foodbakery_var_price_table_item .= '<em>' . esc_html( $foodbakery_price_table_time_duration ) . '</em>';
            }
            $foodbakery_var_price_table_item .= '</span>';

            $foodbakery_var_price_table_item .= '</div>';

            $foodbakery_var_price_table_item .= do_shortcode( $content );

            if ( $foodbakery_price_table_button_text <> '' ) {
                $foodbakery_var_price_table_item    .= '<div class="button-holder">';
                $foodbakery_var_price_table_item .= '<a style="background-color:' . foodbakery_allow_special_char( $foodbakery_price_table_button_color_bg ) . '!important; color:' . foodbakery_allow_special_char( $foodbakery_price_table_button_color ) . ' !important" href="' . esc_url( $foodbakery_button_link ) . '" class="text-color">' . esc_html( $foodbakery_price_table_button_text ) . ' <i class="icon-controller-play"></i></a>';
                $foodbakery_var_price_table_item    .= '</div>';
            }
            $foodbakery_var_price_table_item .= '</div>';
            $foodbakery_var_price_table_item .= '</div>';
        } else
        //classic view
        if ( $foodbakery_price_table_style == 'advance' ) {
            $foodbakery_var_price_table_item .= '<div class="pricetable-holder center '.$active_class.' ">';
            $foodbakery_var_price_table_item .= '<div class="price-holder">';
            if ( $foodbakery_price_table_featured == 'Yes' ) {
                $foodbakery_var_price_table_item .= '<div class="category"><em>Recommended</em></div>';
            }
            $foodbakery_var_price_table_item .= ' <div class="cs-price">';
            $foodbakery_var_price_table_item .= '<span ' . foodbakery_allow_special_char( $foodbakery_price_table_column_bgcolor ) . '>';
            $foodbakery_var_price_table_item .= '<small>' . esc_html( $foodbakery_price_table_currency ) . '</small>';
            if ( $foodbakery_price_table_price <> '' ) {
                $foodbakery_var_price_table_item .= esc_html( $foodbakery_price_table_price );
            }
            $foodbakery_var_price_table_item .= '<strong style="color:' . foodbakery_allow_special_char( $foodbakery_price_table_title_color ) . '!important;">' . esc_html( $foodbakery_price_table_text ) . '</strong>';

            $foodbakery_var_price_table_item .= '</span>';
            $foodbakery_var_price_table_item .= '<div class="advance-duration">  <em>' . esc_html( $foodbakery_price_table_time_duration ) . '</em></div>';
            $foodbakery_var_price_table_item .= '</div>';
            $foodbakery_var_price_table_item .= do_shortcode( $content );
            if ( $foodbakery_price_table_button_text <> '' ) {
                $foodbakery_var_price_table_item    .= '<div class="button-holder">';
                $foodbakery_var_price_table_item .= '<a style="background-color:' . foodbakery_allow_special_char( $foodbakery_price_table_button_color_bg ) . '!important; color:' . foodbakery_allow_special_char( $foodbakery_price_table_button_color ) . ' !important" href="' . esc_url( $foodbakery_button_link ) . '" class="text-color">' . esc_html( $foodbakery_price_table_button_text ) . ' <i class="icon-controller-play"></i></a>';
                $foodbakery_var_price_table_item    .= '</div>';
            }

            $foodbakery_var_price_table_item .= ' </div>';
            $foodbakery_var_price_table_item .= ' </div>';
        }

        $foodbakery_var_price_table_item .= '</div>';

        $foodbakery_price_plan_counter ++;


        return $foodbakery_var_price_table_item;
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'price_table_item', 'foodbakery_price_table_item' );
    }
}