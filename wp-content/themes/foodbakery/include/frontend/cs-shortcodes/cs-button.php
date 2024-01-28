<?php

/*
 *
 * @Shortcode Name : Button
 * @retrun
 *
 */
if ( ! function_exists('foodbakery_var_button') ) {

	function foodbakery_var_button($atts, $content = "") {
		$html = '';
		$page_element_size = isset($atts['button_element_size']) ? $atts['button_element_size'] : 100;
		if ( function_exists('foodbakery_var_page_builder_element_sizes') ) {
			$html .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
		}
		$defaults = array(
			'foodbakery_var_column_size' => '',
			'foodbakery_var_column' => '1',
			'foodbakery_var_button_text' => '',
			'foodbakery_var_button_link' => '#',
			'foodbakery_var_button_border' => '',
			'foodbakery_var_button_icon_position' => '',
			'foodbakery_var_button_type' => 'rounded',
			'foodbakery_var_button_target' => '_self',
			'foodbakery_var_button_border_color' => '',
			'foodbakery_var_button_color' => '#fff',
			'foodbakery_var_button_bg_color' => '',
			'foodbakery_var_button_align' => '',
			'foodbakery_button_icon' => '',
			'foodbakery_var_button_size' => 'btn-lg',
			'foodbakery_var_icon_view' => '',
			'foodbakery_var_button_alignment' => ''
		);
		extract(shortcode_atts($defaults, $atts));
		$foodbakery_var_column = isset($foodbakery_var_column) ? $foodbakery_var_column : '';
		$foodbakery_var_button_text = isset($foodbakery_var_button_text) ? $foodbakery_var_button_text : '';
		$foodbakery_var_button_alignment = isset($foodbakery_var_button_alignment) ? $foodbakery_var_button_alignment : '';
		$foodbakery_var_button_link = isset($foodbakery_var_button_link) ? $foodbakery_var_button_link : '';
		$foodbakery_var_button_border = isset($foodbakery_var_button_border) ? $foodbakery_var_button_border : '';
		$foodbakery_var_button_icon_position = isset($foodbakery_var_button_icon_position) ? $foodbakery_var_button_icon_position : '';
		$foodbakery_var_button_type = isset($foodbakery_var_button_type) ? $foodbakery_var_button_type : '';
		$foodbakery_var_button_border_color = isset($foodbakery_var_button_border_color) ? $foodbakery_var_button_border_color : '';
		$foodbakery_var_button_bg_color = isset($foodbakery_var_button_bg_color) ? $foodbakery_var_button_bg_color : '';
		$foodbakery_var_button_color = isset($foodbakery_var_button_color) ? $foodbakery_var_button_color : '';
		$foodbakery_var_button_target = isset($foodbakery_var_button_target) ? $foodbakery_var_button_target : '';
		$foodbakery_button_icon = isset($foodbakery_button_icon) ? $foodbakery_button_icon : '';
		$button_size = isset($foodbakery_var_button_size) ? $foodbakery_var_button_size : '';
		$foodbakery_var_icon_view = isset($foodbakery_var_icon_view) ? $foodbakery_var_icon_view : '';
		$column_class = '';

		if ( isset($column_class) && $column_class <> '' ) {
			$html .= '<div  class="' . esc_html($column_class) . '" >';
		}
		$button_type_class = 'no_circle';
		$foodbakery_var_button_align = isset($foodbakery_var_button_align) ? $foodbakery_var_button_align : '';
		$border = '';
		$has_icon = '';

		if ( $button_size == 'btn-lg' ) {
			$button_size = ' large-btn';
		} elseif ( $button_size == ' medium-btn' ) {
			$button_size = ' medium-btn';
		} elseif ( $button_size == 'btn-sml' ) {
			$button_size = ' small-btn';
		}
		if ( isset($foodbakery_var_button_border_color) && $foodbakery_var_button_border_color <> '' ) {
			$border = ' border: 2px solid ' . esc_attr($foodbakery_var_button_border_color) . ' !important;';
		}
		if ( isset($foodbakery_var_button_type) && $foodbakery_var_button_type == 'rounded' ) {
			$button_type_class = 'circle';
		}
		if ( isset($foodbakery_var_button_type) && $foodbakery_var_button_type == 'three-d' ) {
			$button_type_class = 'has-shadow';
			$border = '';
		}
		if ( isset($foodbakery_button_icon) && $foodbakery_button_icon <> '' ) {
			$has_icon = 'has_icon';
		}
		$button_class_position = (isset($foodbakery_var_button_align) and $foodbakery_var_button_align == 'left') ? 'icon-left' : 'icon-right';
		$has_border = '';
		if ( $foodbakery_var_button_border == 'yes' ) {
			$has_border = 'has-border';
		}
		if ( isset($foodbakery_var_button_target) && $foodbakery_var_button_target == '_blank' ) {
			$foodbakery_var_button_target = ' target=' . $foodbakery_var_button_target . '';
		} else {
			$foodbakery_var_button_target = ' target=' . $foodbakery_var_button_target . '';
		}
		$button_alignment = '';
		if ( $foodbakery_var_button_alignment == 'center' ) {
			$button_alignment = ' btn-center';
		} elseif ( $foodbakery_var_button_alignment == 'left' ) {
			$button_alignment = ' btn-left';
		} elseif ( $foodbakery_var_button_alignment == 'right' ) {
			$button_alignment = ' btn-right';
		}

		$html .= '<div class="button_style cs-button' . $button_alignment . '">';
		$html .= '<a href="  ' . esc_url($foodbakery_var_button_link) . '" class="csborder-color ' . esc_attr($has_border) . ' custom-btn ' . esc_attr($button_size) . ' ' . sanitize_html_class($button_type_class) . ' bg-color  ' . $has_icon . ' button-icon-' . esc_attr($foodbakery_var_button_align) . '" style="' . esc_attr($border) . '  background-color: ' . esc_attr($foodbakery_var_button_bg_color) . '; color:' . esc_attr($foodbakery_var_button_color) . ' ! important;"' . esc_html($foodbakery_var_button_target) . '>';
		if ( isset($foodbakery_button_icon) && $foodbakery_button_icon <> '' && isset($foodbakery_var_icon_view) && $foodbakery_var_icon_view == 'on' ) {
			$html .= '<i class="' . esc_attr($foodbakery_button_icon) . '"></i>';
		}
		if ( isset($foodbakery_var_button_text) && $foodbakery_var_button_text <> '' ) {
			$html .= $foodbakery_var_button_text;
		}
		$html .= '</a>';
		$html .= '</div>';
		if ( isset($column_class) && $column_class <> '' ) {
			$html .= '</div>';
		}
		if ( function_exists('foodbakery_var_page_builder_element_sizes') ) {
			$html .= '</div>';
		}
		return do_shortcode($html);
	}

	if ( function_exists('foodbakery_var_short_code') ) {
		foodbakery_var_short_code('foodbakery_button', 'foodbakery_var_button');
	}
}