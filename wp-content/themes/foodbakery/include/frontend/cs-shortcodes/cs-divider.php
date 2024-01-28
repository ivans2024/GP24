<?php

/**
 * @Divider html form for page builder
 */
if ( ! function_exists( 'foodbakery_var_foodbakery_divider_shortcode' ) ) {

    function foodbakery_var_foodbakery_divider_shortcode( $atts, $content = "" ) {
        $html = '';
        $page_element_size  = isset( $atts['divider_element_size'] )? $atts['divider_element_size'] : 100;
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $html   .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
        $foodbakery_var_defaults = array(
            'foodbakery_var_divider_padding_left' => '0',
            'foodbakery_var_divider_padding_right' => '0',
            'foodbakery_var_divider_margin_top' => '0',
            'foodbakery_var_divider_margin_buttom' => '0',
            'foodbakery_var_divider_align' => '',
	    'foodbakery_var_divider_style' => '',
        );
        extract( shortcode_atts( $foodbakery_var_defaults, $atts ) );


        $foodbakery_var_divider_padding_left = isset( $foodbakery_var_divider_padding_left ) ? $foodbakery_var_divider_padding_left : '';
        $foodbakery_var_divider_padding_right = isset( $foodbakery_var_divider_padding_right ) ? $foodbakery_var_divider_padding_right : '';
        $foodbakery_var_divider_margin_top = isset( $foodbakery_var_divider_margin_top ) ? $foodbakery_var_divider_margin_top : '';
        $foodbakery_var_divider_margin_buttom = isset( $foodbakery_var_divider_margin_buttom ) ? $foodbakery_var_divider_margin_buttom : '';
        $foodbakery_var_divider_align = isset( $foodbakery_var_divider_align ) ? $foodbakery_var_divider_align : '';
	$foodbakery_var_divider_style = isset( $foodbakery_var_divider_style ) ? $foodbakery_var_divider_style : '';
        $style_string = '';
        if ( $foodbakery_var_divider_padding_left != '' || $foodbakery_var_divider_padding_right != '' || $foodbakery_var_divider_margin_top != '' || $foodbakery_var_divider_margin_buttom != '' ) {
            $style_string .= ' ';
            if ( $foodbakery_var_divider_padding_left != '' ) {
                $style_string .= ' padding-left:' . esc_html( $foodbakery_var_divider_padding_left ) . 'px; ';
            }
            if ( $foodbakery_var_divider_padding_right != '' ) {
                $style_string .= ' padding-right:' . esc_html( $foodbakery_var_divider_padding_right ) . 'px; ';
            }
            if ( $foodbakery_var_divider_margin_top != '' ) {
                $style_string .= ' margin-top:' . esc_html( $foodbakery_var_divider_margin_top ) . 'px; ';
            }
            if ( $foodbakery_var_divider_margin_buttom != '' ) {
                $style_string .= ' margin-bottom:' . esc_html( $foodbakery_var_divider_margin_buttom ) . 'px; ';
            }

            $style_string .= ' ';
        }
        $html .= '<div class="' . esc_html( $foodbakery_var_divider_align ) . '">';
        $html .= '<div  style=" ' . esc_html( $style_string ) . '" class="cs-spreator '.$foodbakery_var_divider_style.'">';
        $html .= '<div class="cs-seprater" style="text-align:center;"> <span>';
	if(isset($foodbakery_var_divider_style) && $foodbakery_var_divider_style == 'simple'){
	$html .= '<i class="icon-transport177"> </i> ';
	} elseif($foodbakery_var_divider_style == 'fancy'){
	    $html .= '<img src="' . get_template_directory_uri() . '/assets/frontend/images/divider.png"  alt="divider" /> ';
	}elseif($foodbakery_var_divider_style == 'modern_new'){
	    $html .= '<img src="' . get_template_directory_uri() . '/assets/frontend/images/divider-img.png"  alt="divider-img" /> ';
	}
	$html .= '</span> </div>';
        $html .= '</div>';
        $html .= '</div>';
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
           $html    .=  '</div>';
        }


        return do_shortcode( $html );
    }

    if ( function_exists( 'foodbakery_var_short_code' ) )
        foodbakery_var_short_code( 'foodbakery_divider', 'foodbakery_var_foodbakery_divider_shortcode' );
}