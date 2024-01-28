<?php

/*
 *
 * @File : Call to action
 * @retrun
 *
 */

if ( ! function_exists( 'foodbakery_var_call_to_action_shortcode' ) ) {

    function foodbakery_var_call_to_action_shortcode( $atts, $content = "" ) {
        $html = '';
        $page_element_size = isset( $atts['call_to_action_element_size'] ) ? $atts['call_to_action_element_size'] : 100;
        if ( function_exists( 'foodbakery_var_page_builder_element_sizes' ) ) {
            $html .= '<div class="' . foodbakery_var_page_builder_element_sizes( $page_element_size ) . ' ">';
        }
        $defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_var_call_to_action_title' => '',
            'foodbakery_var_call_action_subtitle' => '',
            'foodbakery_var_heading_color' => '#000',
            'foodbakery_var_call_to_action_icon_background_color' => '',
            'foodbakery_var_call_to_action_button_text' => '',
            'foodbakery_var_call_to_action_button_link' => '#',
            'foodbakery_var_contents_bg_color' => '',
            'foodbakery_var_call_to_action_img_array' => '',
            'foodbakery_var_call_action_text_align' => '',
            'foodbakery_var_call_action_img_align' => '',
            'foodbakery_var_button_bg_color' => '',
            'foodbakery_var_button_border_color' => '',
            'foodbakery_var_call_to_align' => '',
	    'foodbakery_var_call_to_icon' => '',
	    'foodbakery_var_call_to_view' => '',
        );

        extract( shortcode_atts( $defaults, $atts ) );
	
	 $foodbakery_var_call_to_view = isset( $foodbakery_var_call_to_view ) ? $foodbakery_var_call_to_view : '';
	 $foodbakery_var_call_to_icon = isset( $foodbakery_var_call_to_icon ) ? $foodbakery_var_call_to_icon : '';
	$foodbakery_var_column_size = isset( $foodbakery_var_column_size ) ? $foodbakery_var_column_size : '';
        $foodbakery_var_call_to_action_img_array = isset( $foodbakery_var_call_to_action_img_array ) ? $foodbakery_var_call_to_action_img_array : '';
        $foodbakery_var_call_action_img_align = isset( $foodbakery_var_call_action_img_align ) ? $foodbakery_var_call_action_img_align : '';
        $foodbakery_var_call_to_action_title = isset( $foodbakery_var_call_to_action_title ) ? $foodbakery_var_call_to_action_title : '';
        $foodbakery_var_call_action_text_align = isset( $foodbakery_var_call_action_text_align ) ? $foodbakery_var_call_action_text_align : '';
        $foodbakery_var_call_action_subtitle = isset( $foodbakery_var_call_action_subtitle ) ? $foodbakery_var_call_action_subtitle : '';
        $foodbakery_var_heading_color = isset( $foodbakery_var_heading_color ) ? $foodbakery_var_heading_color : '';
        $foodbakery_var_call_action_contents = $content;
        $foodbakery_var_call_to_action_button_text = isset( $foodbakery_var_call_to_action_button_text ) ? $foodbakery_var_call_to_action_button_text : '';
        $foodbakery_var_call_to_action_button_link = isset( $foodbakery_var_call_to_action_button_link ) ? $foodbakery_var_call_to_action_button_link : '';
        $foodbakery_var_button_bg_color = isset( $foodbakery_var_button_bg_color ) ? $foodbakery_var_button_bg_color : '';
        $foodbakery_var_button_border_color = isset( $foodbakery_var_button_border_color ) ? $foodbakery_var_button_border_color : '';
        $foodbakery_var_contents_bg_color = isset( $foodbakery_var_contents_bg_color ) ? $foodbakery_var_contents_bg_color : '';
        $foodbakery_var_call_to_action_icon_background_color = isset( $foodbakery_var_call_to_action_icon_background_color ) ? $foodbakery_var_call_to_action_icon_background_color : '';
        $foodbakery_var_call_to_align = isset( $foodbakery_var_call_to_align ) ? $foodbakery_var_call_to_align : '';
        $column_class = '';
	
	$view_class = ' simple';
	 if(isset($foodbakery_var_call_to_view) && $foodbakery_var_call_to_view == 'fancy'){
	    $view_class = ' fancy text-center';
	 }
	
        if ( isset( $foodbakery_var_column_size ) && $foodbakery_var_column_size != '' ) {
            if ( function_exists( 'foodbakery_var_custom_column_class' ) ) {
                $column_class = foodbakery_var_custom_column_class( $foodbakery_var_column_size );
            }
        }

        $style_string = $foodbakery_var_CustomId = '';
        if ( $foodbakery_var_call_to_action_img_array ) {
            $style_string .= ' background:url(' . esc_url( $foodbakery_var_call_to_action_img_array ) . ') ' . esc_html( $foodbakery_var_call_action_img_align ) . ' !important; background-color:#fff;';
        } else {
            $style_string .= ' background-color:' . esc_html( $foodbakery_var_contents_bg_color ) . ' !important;';
        }
        $style_string = ' style="' . $style_string . '"';
	$style_string = '';
	
	
	if ( $foodbakery_var_call_to_action_title <> '' ) {
            $html .= '<div class="element-title '.$foodbakery_var_call_to_align.'"><h2>' . esc_attr( $foodbakery_var_call_to_action_title ) . '</h2></div>';
        }
        

        if ( isset( $column_class ) && $column_class <> '' ) {
            $html .= '<div  class="' . esc_html( $column_class ) . '" >';
        }
        $html .= '<div class="cs-calltoaction'.$view_class.'">';
	if( (isset($foodbakery_var_call_to_view)&& $foodbakery_var_call_to_view == 'fancy') && (isset($foodbakery_var_call_to_icon) && $foodbakery_var_call_to_icon !='') ){
	    $html .= '<div class="img-holder">
		    <i class=" '.$foodbakery_var_call_to_icon.' "></i>
	    </div>';
	}
        $html .= '<div class="cs-text">';
	if ( isset( $foodbakery_var_call_action_subtitle ) && $foodbakery_var_call_action_subtitle <> '' ) {
            $color_string = '';
            if ( $foodbakery_var_heading_color != '' ) {
                $color_string = ' style="color:' . esc_html( $foodbakery_var_heading_color ) . ' !important;"';
            }
            $html .= '<strong ' . foodbakery_allow_special_char( $color_string ) . '>' . esc_html( $foodbakery_var_call_action_subtitle ) . '</strong>';
        }
        if ( $foodbakery_var_call_action_contents != '' ) {
            $color_string = '';
            $html .= do_shortcode( $foodbakery_var_call_action_contents );
        }
        if ( isset( $foodbakery_var_call_to_action_button_text ) and $foodbakery_var_call_to_action_button_text <> '' ) {
            $color_string = '';
            $button_text_color = '';
            if ( $foodbakery_var_call_to_action_icon_background_color != '' ) {
                $button_text_color = ' color:' . esc_attr( $foodbakery_var_call_to_action_icon_background_color ) . ' !important;';
            }
            $button_border_color = '';
            if ( $foodbakery_var_button_border_color != '' ) {
                $button_border_color = ' border: 2px solid ' . esc_html( $foodbakery_var_button_border_color ) . ' !important;';
            }
            if ( $foodbakery_var_button_bg_color != '' || $foodbakery_var_call_to_action_icon_background_color != '' ) {
                $color_string = ' style="background-color:' . esc_html( $foodbakery_var_button_bg_color ) . ' !important; ' . $button_text_color . '' . $button_border_color . '"';
            }

            $html .= '</div>';
            $html .= '<a href="' . esc_url( $foodbakery_var_call_to_action_button_link ) . '" class="csborder-color cs-color" ' . foodbakery_allow_special_char( $color_string ) . '>' . esc_html( $foodbakery_var_call_to_action_button_text ) . '</a>';
        }
        $html .= '</div>';

        if ( isset( $column_class ) && $column_class <> '' ) {
            $html .= '</div>';
        }
        
	
	
        if ( function_exists( 'foodbakery_var_page_builder_element_sizes' ) ) {
            $html .= '</div>';
        }
        return $html;
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'call_to_action', 'foodbakery_var_call_to_action_shortcode' );
    }
}