<?php

/*
 *
 * @Shortcode Name :  infobox front end view
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_var_infobox_shortcode' ) ) {

    function foodbakery_var_infobox_shortcode( $atts, $content = "" ) {
        global $post, $foodbakery_var_infobox_column, $foodbakery_var_infobox_title_color, $foodbakery_var_info_icon_color;
        $html = '';
        $page_element_size  = isset( $atts['infobox_element_size'] )? $atts['infobox_element_size'] : 100;
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $html   .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
        
        $defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_var_infobox_icon' => '',
            'foodbakery_var_infobox_main_title' => '',
            'foodbakery_var_info_icon_color' => '',
            'foodbakery_var_info_title_color' => '',
            'foodbakery_var_info_content_color' => '',
            'foodbakery_var_infobox_align' => '',
        );
        extract( shortcode_atts( $defaults, $atts ) );
        $foodbakery_var_column_size = isset( $foodbakery_var_column_size ) ? $foodbakery_var_column_size : '';
        $foodbakery_var_infobox_main_title = isset( $foodbakery_var_infobox_main_title ) ? $foodbakery_var_infobox_main_title : '';
        $foodbakery_var_info_icon_color = isset( $foodbakery_var_info_icon_color ) ? $foodbakery_var_info_icon_color : '';
        $foodbakery_var_info_title_color = isset( $foodbakery_var_info_title_color ) ? $foodbakery_var_info_title_color : '';
        $foodbakery_var_info_content_color = isset( $foodbakery_var_info_content_color ) ? $foodbakery_var_info_content_color : '';
        $foodbakery_var_infobox_align = isset($foodbakery_var_infobox_align) ? $foodbakery_var_infobox_align : '';
        
        $foodbakery_section_title = '';
        $foodbakery_section_sub_title = '';
        $column_class = '';
        $column_class = '';
        if ( isset( $foodbakery_var_column_size ) && $foodbakery_var_column_size != '' ) {
            if ( function_exists( 'foodbakery_var_custom_column_class' ) ) {
                $column_class = foodbakery_var_custom_column_class( $foodbakery_var_column_size );
            }
        }

        if ( isset( $column_class ) && $column_class <> '' ) {
            $html .= '<div class="' . esc_html( $column_class ) . '">';
        }
        if ( $foodbakery_var_infobox_main_title <> '' ) {
            $html .='<div class="element-title '.$foodbakery_var_infobox_align.'">
		          <h2>' . esc_html( $foodbakery_var_infobox_main_title ) . '</h2>
	 	        </div>';
        }
        $html .='<ul class="contact-info">';
        $html .= do_shortcode( $content );
        $html .='</ul>';
        if ( isset( $column_class ) && $column_class <> '' ) {
            $html .= '</div>';
        }
         if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $html .=  '</div>';
          }
        return do_shortcode( $html );
    }

}
if ( function_exists( 'foodbakery_var_short_code' ) )
    foodbakery_var_short_code( 'foodbakery_infobox', 'foodbakery_var_infobox_shortcode' );
/*
 *
 * @List  Item  shortcode/element front end view
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_var_infobox_item_shortcode' ) ) {

    function foodbakery_var_infobox_item_shortcode( $atts, $content = "" ) {
        global $post, $foodbakery_var_infobox_column, $foodbakery_var_infobox_title_color, $foodbakery_var_info_icon_color;
        $output = '';
        $defaults = array(
            'foodbakery_var_infobox_element_title' => '',
            'foodbakery_var_infobox_icon' => '',
            'foodbakery_var_icon_box' => '',
        );
        extract( shortcode_atts( $defaults, $atts ) );
        $foodbakery_var_infobox_column_str = '';
        $foodbakery_var_infobox_element_title = isset( $foodbakery_var_infobox_element_title ) ? $foodbakery_var_infobox_element_title : '';
        $foodbakery_var_icon_box = isset( $foodbakery_var_icon_box ) ? $foodbakery_var_icon_box : '';
        $title_color = '';
        $icon_color = '';
        if ( isset( $foodbakery_var_infobox_title_color ) && $foodbakery_var_infobox_title_color != '' ) {
            $title_color = 'style="color:' . esc_html( $foodbakery_var_infobox_title_color ) . '"';
        }
        if ( isset( $foodbakery_var_info_icon_color ) && $foodbakery_var_info_icon_color != '' ) {
            $icon_color = 'style="color:' . esc_html( $foodbakery_var_info_icon_color ) . ' !important"';
        }
        $output .= '
				<li>
					<i ' . $icon_color . ' class="' . esc_html( $foodbakery_var_icon_box ) . '"></i>
					<div class="address-text">' . do_shortcode( $content ) . '</div>
				</li>';
        $randid = rand( 877, 9999 );
        return foodbakery_allow_special_char($output);
    }

}
if ( function_exists( 'foodbakery_var_short_code' ) )
    foodbakery_var_short_code( 'infobox_item', 'foodbakery_var_infobox_item_shortcode' );