<?php

/*
 *
 * @Shortcode Name : Accordion
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_accordion_shortcode' ) ) {

    function foodbakery_accordion_shortcode( $atts, $content = "" ) {

        $html = '';
        $page_element_size  = isset( $atts['accordion_element_size'] )? $atts['accordion_element_size'] : 100;
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $html   .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
        global $acc_counter, $foodbakery_var_accordion_column;
        $acc_counter = rand( 40, 9999999 );

        $defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_var_accordion_view' => '',
            'foodbakery_var_accordion_column' => '',
            'foodbakery_var_accordian_sub_title' => '',
            'foodbakery_var_accordian_main_title' => '',
            'foodbakery_var_accordion_align' => '',
        );
        extract( shortcode_atts( $defaults, $atts ) );

        $column_class = '';
        $foodbakery_var_accordion_view = isset( $foodbakery_var_accordion_view ) ? $foodbakery_var_accordion_view : '';
        $foodbakery_var_column_size = isset( $foodbakery_var_column_size ) ? $foodbakery_var_column_size : '';
        $foodbakery_var_accordian_main_title = isset( $foodbakery_var_accordian_main_title ) ? $foodbakery_var_accordian_main_title : '';
        $foodbakery_var_accordian_sub_title = isset( $foodbakery_var_accordian_sub_title ) ? $foodbakery_var_accordian_sub_title : '';
        $foodbakery_var_counter_col = isset( $foodbakery_var_accordion_column ) ? $foodbakery_var_accordion_column : '';
        $foodbakery_var_accordion_align = isset($foodbakery_var_accordion_align) ? $foodbakery_var_accordion_align : '';

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
        if ( isset( $foodbakery_var_column_size ) && $foodbakery_var_column_size != '' ) {
            if ( function_exists( 'foodbakery_var_custom_column_class' ) ) {
                $column_class = foodbakery_var_custom_column_class( $foodbakery_var_column_size );
            }
        }
        if ( isset( $column_class ) && $column_class <> '' ) {
            $html .= '<div class="' . esc_html( $column_class ) . '">';
        }
        $boxex_class = ' simple';
        if ( isset( $foodbakery_var_accordion_view ) && $foodbakery_var_accordion_view == 'modern' ) {
            $boxex_class = ' modern';
        }

        if ( isset( $foodbakery_var_accordian_main_title ) && trim( $foodbakery_var_accordian_main_title ) <> '' ) {
            $html .= '<div class="element-title '.$foodbakery_var_accordion_align.'">
                <h2>' . esc_attr( $foodbakery_var_accordian_main_title ) . '</h2>
            </div>';
        }
        $html .= '<div class="panel-group ' . $boxex_class . '" id="accordion_' . absint( $acc_counter ) . '" role="tablist" aria-multiselectable="true">';
        $html .= do_shortcode( $content );
        $html .= '</div>';



        if ( isset( $column_class ) && $column_class <> '' ) {
            $html .= '</div>';
        }
         if (function_exists('foodbakery_var_page_builder_element_sizes')) {
           $html    .=  '</div>';
        }
        return $html;
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'foodbakery_accordion', 'foodbakery_accordion_shortcode' );
    }
}

/*
 *
 * @Accordion Item
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_accordion_item_shortcode' ) ) {

    function foodbakery_accordion_item_shortcode( $atts, $content = "" ) {
        global $acc_counter;
        $strings = new foodbakery_theme_all_strings;
        $strings->foodbakery_short_code_strings();
        $defaults = array(
            'foodbakery_var_accordion_title' => 'Title',
            'foodbakery_var_icon_box' => '',
            'foodbakery_var_accordion_active' => 'yes',
        );
        extract( shortcode_atts( $defaults, $atts ) );
        $foodbakery_var_acc_icon = '';
        $foodbakery_var_accordion_title = isset( $foodbakery_var_accordion_title ) ? $foodbakery_var_accordion_title : '';
        $foodbakery_var_icon_box = isset( $foodbakery_var_icon_box ) ? $foodbakery_var_icon_box : '';
        $foodbakery_var_accordion_active = isset( $foodbakery_var_accordion_active ) ? $foodbakery_var_accordion_active : '';

        if ( isset( $foodbakery_var_icon_box ) && $foodbakery_var_icon_box != '' ) {
            $foodbakery_var_acc_icon = '<i class="' . $foodbakery_var_icon_box . '"></i>';
        }

        $accordion_count = 0;
        $accordion_count = rand( 4045, 99999 );
        $html = '';
        $active_in = '';
        $active_class = '';
        $styleColapse = 'collapsed';
        if ( isset( $foodbakery_var_accordion_active ) && $foodbakery_var_accordion_active == 'yes' ) {
            $active_in = 'in';
            $styleColapse = '';
        } else {
            $active_class = 'collapsed';
        }
        $html .= ' <div class="panel panel-default">';
        $html .= '  <div class="panel-heading" role="tab" id="heading_' . absint( $accordion_count ) . '">';
        $html .= '   <h6 class="panel-title">';
        $html .= '<a  role="button" class="' . esc_html( $active_class ) . '" data-toggle="collapse" data-parent="#accordion_' . absint( $acc_counter ) . '" href="#collapse' . absint( $accordion_count ) . '">' . $foodbakery_var_acc_icon . esc_html( $foodbakery_var_accordion_title ) . '</a>';
        $html .= '   </h6>';
        $html .= ' </div>';
        $html .= '  <div id="collapse' . absint( $accordion_count ) . '" class="panel-collapse collapse ' . esc_html( $active_in ) . '"	role="tabpanel" aria-labelledby="heading_' . absint( $accordion_count ) . '">';
        $html .= '     <div class="panel-body">' . do_shortcode( $content ) . '</div>';
        $html .= ' </div>';
        $html .= '</div>
		';
        return $html;
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'accordion_item', 'foodbakery_accordion_item_shortcode' );
    }
}