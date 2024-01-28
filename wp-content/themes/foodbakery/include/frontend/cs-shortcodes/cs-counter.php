<?php

/*
 * @Shortcode Name :   Start function for Counter shortcode/element front end view
 */
if ( ! function_exists( 'foodbakery_counters_shortcode' ) ) {

    function foodbakery_counters_shortcode( $atts, $content = null ) {
        global $post, $foodbakery_var_counter_col, $foodbakery_var_icon_color, $foodbakery_var_count_color,$foodbakery_var_text_color, $foodbakery_var_content_color;
        $defaults = array(
            'foodbakery_var_column_size' => '1/1',
            'foodbakery_multi_counter_title' => '',
            'foodbakery_var_counter_col' => '',
            'foodbakery_var_icon_color' => '',
            'foodbakery_var_count_color' => '',
	    'foodbakery_var_text_color' => '',
            'foodbakery_var_content_color' => '',
            'foodbakery_var_counters_view' => '',
            'foodbakery_var_counter_align' => '',
        );
        extract( shortcode_atts( $defaults, $atts ) );
        $foodbakery_section_title = '';
        $foodbakery_var_column_size = '';
        $foodbakery_multi_counter_title = isset( $foodbakery_multi_counter_title ) ? $foodbakery_multi_counter_title : '';
        $foodbakery_var_counter_col = isset( $foodbakery_var_counter_col ) ? $foodbakery_var_counter_col : '';
        $foodbakery_var_counter_align = isset($foodbakery_var_counter_align) ? $foodbakery_var_counter_align : '';
	if ( isset( $foodbakery_var_column_size ) && $foodbakery_var_column_size != '' ) {
            if ( function_exists( 'foodbakery_var_custom_column_class' ) ) {
                $column_class = foodbakery_var_custom_column_class( $foodbakery_var_column_size );
            }
        }

        $foodbakery_var_counter = '';
        
        $page_element_size  = isset( $atts['counter_element_size'] )? $atts['counter_element_size'] : 100;
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $foodbakery_var_counter   .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
        
        if ( isset( $column_class ) && $column_class <> '' ) {
            $foodbakery_var_counter .= '<div class="' . esc_html( $column_class ) . '">';
        }

        if ( trim( $foodbakery_multi_counter_title ) <> '' ) {
            $foodbakery_section_title .= '<div class="element-title '.$foodbakery_var_counter_align.'">';
            $foodbakery_section_title .= '<h2>' . esc_attr( $foodbakery_multi_counter_title ) . '</h2>';
            $foodbakery_section_title .= '</div>';
        }
        $foodbakery_var_counter .= $foodbakery_section_title;

        $foodbakery_var_counter .=' <div class="counter-sec counter-shortcode">';
        $foodbakery_var_counter .='<div class="row">';
        $foodbakery_var_counter .= do_shortcode( $content );
        $foodbakery_var_counter .=' </div>';
        $foodbakery_var_counter .=' </div>';

        if ( isset( $column_class ) && $column_class <> '' ) {
            $foodbakery_var_counter .= '</div>';
        }
        
         if (function_exists('foodbakery_var_page_builder_element_sizes')) {
           $foodbakery_var_counter    .=  '</div>';
        }

        return $foodbakery_var_counter;
    }

}

if ( function_exists( 'foodbakery_var_short_code' ) )
    foodbakery_var_short_code( 'counter', 'foodbakery_counters_shortcode' );

/*
 * @Shortcode Name :  Start function for counter Item
 */
if ( ! function_exists( 'foodbakery_counter_item' ) ) {

    function foodbakery_counter_item( $atts, $content = null ) {
        global $post, $foodbakery_var_counter_col, $foodbakery_var_icon_color, $foodbakery_var_count_color,$foodbakery_var_text_color, $foodbakery_var_content_color;
        $col_class = '';
        if ( isset( $foodbakery_var_counter_col ) && $foodbakery_var_counter_col != '' ) {
            $number_col = 12 / $foodbakery_var_counter_col;
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
        $foodbakery_var_counter_item = '';
        $defaults = array(
            'foodbakery_var_icon' => '',
            'foodbakery_var_count' => '',
            'foodbakery_var_title' => ''
        );

        extract( shortcode_atts( $defaults, $atts ) );
        $foodbakery_var_icon = isset( $foodbakery_var_icon ) ? $foodbakery_var_icon : '';
        $foodbakery_var_count = isset( $foodbakery_var_count ) ? $foodbakery_var_count : '';
        $foodbakery_var_icon_color = isset( $foodbakery_var_icon_color ) ? $foodbakery_var_icon_color : '';
        $foodbakery_var_count_color = isset( $foodbakery_var_count_color ) ? $foodbakery_var_count_color : '';
	$foodbakery_var_text_color = isset( $foodbakery_var_text_color ) ? $foodbakery_var_text_color : '';
        $foodbakery_var_content_color = isset( $foodbakery_var_content_color ) ? $foodbakery_var_content_color : '';
        $foodbakery_var_title = isset($foodbakery_var_title) ? $foodbakery_var_title : '';
        $foodbakery_var_content = $content;
	
	$text_color = '';
	if(isset($foodbakery_var_text_color) && $foodbakery_var_text_color !=''){
	    $text_color = 'style="color:'.$foodbakery_var_text_color.' !important"';
	}
	
	
        $foodbakery_var_counter_item .='<div class="' . esc_html( $col_class ) . '">';
        $foodbakery_var_counter_item .='<div class="counter-holder">';
        $foodbakery_var_counter_item .='<div class="text-holder">';
        if ( isset( $foodbakery_var_icon ) && $foodbakery_var_icon != '' ) {
            $foodbakery_var_counter_item .='<i style="color:' . esc_html( $foodbakery_var_icon_color ) . ' !important" class="' . esc_html( $foodbakery_var_icon ) . '"></i>';
        }
        $foodbakery_var_counter_item .='<strong style="color:' . esc_html( $foodbakery_var_count_color ) . ' !important" class="count">' . esc_html( ($foodbakery_var_count ) ) . '</strong>';
        if ( $foodbakery_var_title <> '' ) {
            $foodbakery_var_counter_item .='<span '.$text_color.' >' . $foodbakery_var_title . '</span>';
        }
        $foodbakery_var_counter_item .='</div>';
        $foodbakery_var_counter_item .='</div>';
        $foodbakery_var_counter_item .='</div>';
        return $foodbakery_var_counter_item;
    }

    if ( function_exists( 'foodbakery_var_short_code' ) )
        foodbakery_var_short_code( 'counter_item', 'foodbakery_counter_item' );
}
