<?php

/*
 *
 * @Shortcode Name :  Start function for Multiple icon_box shortcode/element front end view
 * @retrun
 *
 */
if (!function_exists('foodbakery_var_icon_boxes_shortcode')) {

    function foodbakery_var_icon_boxes_shortcode($atts, $content = "") {
	global $post,$counter_variable, $icon_box_counter, $foodbakery_var_icon_box_column, $foodbakery_icon_box_icon_color, $foodbakery_title_color, $foodbakery_var_link_url, $foodbakery_var_icon_box_view, $foodbakery_var_icon_box_icon_size, $foodbakery_icon_box_content_align;
	$html = '';
	$page_element_size = isset($atts['icon_box_element_size']) ? $atts['icon_box_element_size'] : 100;
	if (function_exists('foodbakery_var_page_builder_element_sizes')) {
	    $html .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
	}
	$counter_variable = 1;
	$defaults = array(
	    'foodbakery_var_column_size' => '',
	    'foodbakery_var_icon_boxes_title' => '',
	    'foodbakery_var_icon_boxes_sub_title' => '',
	    'foodbakery_var_icon_box_column' => '',
	    'foodbakery_icon_box_content_color' => '',
	    'foodbakery_title_color' => '',
	    'foodbakery_var_icon_box_view' => '',
	    'foodbakery_icon_box_icon_color' => '',
	    'foodbakery_var_icon_box_icon_size' => '',
	    'foodbakery_icon_box_content_align' => '',
	    'foodbakery_var_iconbox_align' => '',
	);
	extract(shortcode_atts($defaults, $atts));
	$icon_box_counter = 1;
	$foodbakery_var_column_size = isset($foodbakery_var_column_size) ? $foodbakery_var_column_size : '';
	$foodbakery_var_icon_boxes_title = isset($foodbakery_var_icon_boxes_title) ? $foodbakery_var_icon_boxes_title : '';
	$foodbakery_var_icon_boxes_sub_title = isset($foodbakery_var_icon_boxes_sub_title) ? $foodbakery_var_icon_boxes_sub_title : '';
	$foodbakery_var_icon_box_column = isset($foodbakery_var_icon_box_column) ? $foodbakery_var_icon_box_column : '';
	$foodbakery_var_link_url = isset($foodbakery_var_link_url) ? $foodbakery_var_link_url : '';
	$foodbakery_var_icon_box_view = isset($foodbakery_var_icon_box_view) ? $foodbakery_var_icon_box_view : '';
	$foodbakery_title_color = isset($foodbakery_title_color) ? $foodbakery_title_color : '';
	$foodbakery_icon_box_icon_color = isset($foodbakery_icon_box_icon_color) ? $foodbakery_icon_box_icon_color : '';
	$foodbakery_var_icon_box_icon_size = isset($foodbakery_var_icon_box_icon_size) ? $foodbakery_var_icon_box_icon_size : '';
	$foodbakery_icon_box_content_align = isset($foodbakery_icon_box_content_align) ? $foodbakery_icon_box_content_align : '';
	$foodbakery_icon_box_content_color = isset($foodbakery_icon_box_content_color) ? $foodbakery_icon_box_content_color : '';
	$foodbakery_var_iconbox_align = isset($foodbakery_var_iconbox_align) ? $foodbakery_var_iconbox_align : '';

	$column_class = '';
	if (isset($foodbakery_var_column_size) && $foodbakery_var_column_size != '') {
	    if (function_exists('foodbakery_var_custom_column_class')) {
		$column_class = foodbakery_var_custom_column_class($foodbakery_var_column_size);
	    }
	}
	$foodbakery_section_title = '';
	$title_subtitle_style = '';
	if (isset($foodbakery_icon_box_content_color) && $foodbakery_icon_box_content_color != '') {

	    $title_subtitle_style = 'style="color:' . esc_html($foodbakery_icon_box_content_color) . ' !important;"';
	}
	if ($foodbakery_var_icon_boxes_title <> '' || $foodbakery_var_icon_boxes_sub_title <> '') {
	    $foodbakery_section_title .= '<div class="element-title ' . $foodbakery_var_iconbox_align . '">';
	    if ($foodbakery_var_icon_boxes_title <> '') {
		$foodbakery_section_title .= '<h2 ' . $title_subtitle_style . '>' . esc_attr($foodbakery_var_icon_boxes_title) . '</h2>';
	    }
	    if ($foodbakery_var_icon_boxes_sub_title <> '') {
		$foodbakery_section_title .= do_shortcode($foodbakery_var_icon_boxes_sub_title);
	    }
	    $foodbakery_section_title .= '</div>';
	}
	if ($foodbakery_section_title != '' || $content != '') {
	    if (isset($column_class) && $column_class <> '') {
		$html .= '<div class="' . esc_html($column_class) . '">';
	    }
	    if ($foodbakery_section_title != '') {
		$html .= $foodbakery_section_title;
	    }
	    if ($content != '') {
		if (isset($foodbakery_var_icon_box_view) && $foodbakery_var_icon_box_view == 'classic') {

		
		$html .= '<div class="cs-icon-boxes-list classic-view ' . $foodbakery_icon_box_content_align . '">'
			. '<div class="row">';
		} else{
		  $html .= '<div class="cs-icon-boxes-list' . $foodbakery_icon_box_content_align . '">'
			. '<div class="row">';  
		    
		}
		$html .= do_shortcode($content);
		$html .= '</div></div>';
	    }
	    if (isset($column_class) && $column_class <> '') {
		$html .= '</div>';
	    }
	}
	if (function_exists('foodbakery_var_page_builder_element_sizes')) {
	    $html .= '</div>';
	}
	return do_shortcode(do_shortcode($html));
    }

    if (function_exists('foodbakery_var_short_code')) {
	foodbakery_var_short_code('icon_box', 'foodbakery_var_icon_boxes_shortcode');
    }
}
/*
 *
 * @Multiple  Start function for Multiple icon_box Item  shortcode/element front end view
 * @retrun
 *
 */
if (!function_exists('foodbakery_var_icon_boxes_item_shortcode')) {

    function foodbakery_var_icon_boxes_item_shortcode($atts, $content = "") {
	$defaults = array(
	    'icon_boxes_style' => '',
	    'foodbakery_var_icon_box_title' => '',
	    'foodbakery_var_icon_boxes_icon' => '',
	    'foodbakery_var_link_url' => '',
	    'foodbakery_var_icon_box_icon_type' => '',
	    'foodbakery_var_icon_box_image' => '',
	);
	global $post,$counter_variable, $icon_box_counter, $foodbakery_var_icon_box_column, $foodbakery_var_link_url, $foodbakery_title_color, $foodbakery_icon_box_icon_color, $foodbakery_var_icon_box_icon_size, $foodbakery_var_icon_box_view, $foodbakery_icon_box_content_align;
	
	extract(shortcode_atts($defaults, $atts));
	$html = '';
	$foodbakery_var_icon_box_view = isset($foodbakery_var_icon_box_view) ? $foodbakery_var_icon_box_view : '';
	$foodbakery_var_icon_boxes_icon = isset($foodbakery_var_icon_boxes_icon) ? $foodbakery_var_icon_boxes_icon : '';
	$foodbakery_var_icon_box_title = isset($foodbakery_var_icon_box_title) ? $foodbakery_var_icon_box_title : '';
	$foodbakery_var_link_url = isset($foodbakery_var_link_url) ? $foodbakery_var_link_url : '';
	$foodbakery_var_icon_box_icon_type = isset($foodbakery_var_icon_box_icon_type) ? $foodbakery_var_icon_box_icon_type : '';
	$foodbakery_var_icon_box_image = isset($foodbakery_var_icon_box_image) ? $foodbakery_var_icon_box_image : '';
	$col_class = '';
	if (isset($foodbakery_var_icon_box_column) && $foodbakery_var_icon_box_column != '') {
	    $number_col = 12 / $foodbakery_var_icon_box_column;
	    $number_col_sm = 12;
	    $number_col_xs = 12;
	    if ($number_col == 2) {
		$number_col_sm = 4;
		$number_col_xs = 6;
	    }
	    if ($number_col == 3) {
		$number_col_sm = 6;
		$number_col_xs = 12;
	    }
	    if ($number_col == 4) {
		$number_col_sm = 6;
		$number_col_xs = 12;
	    }
	    if ($number_col == 6) {
		$number_col_sm = 12;
		$number_col_xs = 12;
	    }
	    $col_class = 'col-lg-' . $number_col . ' col-md-' . $number_col . ' col-sm-' . $number_col_sm . ' col-xs-' . $number_col_xs . '';
	}

	$box_col_plus_class = '';
	if ($foodbakery_icon_box_content_align == 'left-right') {
	    if (fmod($icon_box_counter, 2) == 0) {
		$box_col_plus_class = ' box-right';
	    } else {
		$box_col_plus_class = ' box-left';
	    }
	}
	$link_start = '';
	$link_end = '';
	if ($foodbakery_var_link_url != '') {
		    $link_start = '<a href="' . esc_url($foodbakery_var_link_url) . '">';
		    $link_end   = '</a>';
		}
	
	
	if ($foodbakery_var_icon_boxes_icon != '' || $foodbakery_var_icon_box_title != '' || $content != '') {
	    $html .= '<div class="' . esc_html($col_class) . $box_col_plus_class . '">';

	    if ($foodbakery_icon_box_content_align == 'left-right') {
		$html .= '<div class="icon-boxes ' . esc_html($foodbakery_var_icon_box_view) . ' top-left">';
	    } else {
		$html .= '<div class="icon-boxes ' . esc_html($foodbakery_var_icon_box_view) . ' ' . esc_html($foodbakery_icon_box_content_align) . '">';
	    }

	    if ($foodbakery_var_icon_boxes_icon != '' && $foodbakery_var_icon_box_icon_type == 'icon') {
		$html .= '<div class="img-holder">';
		$html .= '<figure>'.$link_start.'<i class="cs-color ' . esc_attr($foodbakery_var_icon_boxes_icon) . ' ' . $foodbakery_var_icon_box_icon_size . '" style="color:' . $foodbakery_icon_box_icon_color . ' !important;line-height:50px;">
				</i>'.$link_end.'</figure>';
		$html .= '</div>';
	    } elseif ($foodbakery_var_icon_box_image != '' && $foodbakery_var_icon_box_icon_type == 'image') {
		$html .= '<div class="img-holder">';
		$html .= '<figure>'.$link_start.'<img src="' . esc_url($foodbakery_var_icon_box_image) . '" alt="' . esc_html($foodbakery_var_icon_box_title) . '">'.$link_end.'</figure>';
		$html .= '</div>';
	    }
	    if ($foodbakery_var_icon_box_title != '' || $content != '') {
		$html .= '<div class="text-holder">';
		if ($foodbakery_var_icon_box_title != '') {
		    $html .= '<h3 style="color:' . esc_html($foodbakery_title_color) . ' !important;">';
		    if ($foodbakery_var_link_url != '') {
			$html .= '<a href="' . esc_url($foodbakery_var_link_url) . '" style="color:' . esc_html($foodbakery_title_color) . ' !important;">';
		    }
		    $html .= $foodbakery_var_icon_box_title;
		    if ($foodbakery_var_link_url != '') {
			$html .= '</a>';
		    }
		    $html .= '</h3>';
		}
		if ($content != '') {
		    $html .='<span>';
		    $html .= do_shortcode($content);
		    $html .='</span>';
		}
		
		if (isset($foodbakery_var_icon_box_view) && $foodbakery_var_icon_box_view == 'modern') {
		    //$html .= '<span class="circular-steps"> '.$counter_variable.' </span>';
		    $counter_variable++; 
		}
		
		if ($foodbakery_var_link_url != '' && $foodbakery_var_icon_box_view == 'has-border') {
		   // $html .= '<a href="' . esc_url($foodbakery_var_link_url) . '" class="view-more-btn text-color">View More <i class="icon-caret-right"></i></a>';
		}
		$html .= '</div>';
	    }
	    $html .= '</div>';
	    $html .= '</div>';
	}
	$icon_box_counter ++;
	return do_shortcode($html);
    }

    if (function_exists('foodbakery_var_short_code')) {
	foodbakery_var_short_code('icon_boxes_item', 'foodbakery_var_icon_boxes_item_shortcode');
    }
}