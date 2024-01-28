<?php

/*
 *
 * @Shortcode Name :  Start function for Progressbar  shortcode/element front end view
 * @retrun
 *
 */

if ( ! function_exists( 'foodbakery_var_progressbars_shortcode' ) ) {

    function foodbakery_var_progressbars_shortcode( $atts, $content = "" ) {

        $defaults = array(
            'column_size' => '1/1',
            'progressbars_element_title' => '',
            'foodbakery_var_progress_align' => '',
        );
        extract( shortcode_atts( $defaults, $atts ) );
        $column_class = foodbakery_var_custom_column_class( $column_size );
		
		$progressbars_element_title = isset( $progressbars_element_title ) ? $progressbars_element_title : '';
                $foodbakery_var_progress_align = isset($foodbakery_var_progress_align) ? $foodbakery_var_progress_align : '';

        $foodbakery_inline_script = '
		jQuery(document).ready(function () {
			jQuery(\'.progress .progress-bar\').css("width",
				function () {
					return $(this).attr("aria-valuenow") + "%";
				}
			)
		});';
        foodbakery_inline_enqueue_script( $foodbakery_inline_script, 'foodbakery-functions' );
        $page_element_size  = isset( $atts['progressbars_element_size'] )? $atts['progressbars_element_size'] : 100;
        $output = '';
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $output .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
        $output .= '<div class="element-title '.$foodbakery_var_progress_align.'">';
        $output .= '<h2> ' . esc_html( $progressbars_element_title ) . '</h2>';
        $output .= '</div>';
        $output .= do_shortcode( $content );
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
           $output .=  '</div>';
        }
        return $output;
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'foodbakery_progressbar', 'foodbakery_var_progressbars_shortcode' );
    }
}

/*
 *
 * @Shortcode Name :  Start function for Progressbar  item shortcode/element front end view
 * @retrun
 *
 */


if ( ! function_exists( 'foodbakery_var_progressbar_item_shortcode' ) ) {

    function foodbakery_var_progressbar_item_shortcode( $atts, $content = "" ) {

        $defaults = array( 'progressbars_title' => '', 'progressbars_color' => '', 'progressbars_percentage' => '50' );
        extract( shortcode_atts( $defaults, $atts ) );
        $progressbars_color = isset( $progressbars_color ) ? $progressbars_color : '';
        $output = '';
        $output .= '<div class="progress-info">';
        $output .= '<span>' . esc_html( $progressbars_title ) . '</span>';
        $output .= '<small>' . esc_html( $progressbars_percentage ) . '%</small>';
        
        $output .= '<div class="progress skill-bar" data-percent="' . $progressbars_percentage . '%">';
        $output .= '<div class="progress-bar progress-bar-success" style="background:' . esc_html( $progressbars_color ) . '; " ></div>';
        $output .= '</div>';
        $output .= '</div>';
        return $output;
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'progressbar_item', 'foodbakery_var_progressbar_item_shortcode' );
    }
}