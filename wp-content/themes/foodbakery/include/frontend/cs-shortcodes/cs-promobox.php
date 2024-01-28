<?php

/*
 *
 * @Shortcode Name : Image Frame
 * @retrun
 *
 */
if (!function_exists('foodbakery_var_promobox')) {

    function foodbakery_var_promobox($atts, $content = "") {

	global $header_map, $post;
	$defaults = array(
	    'foodbakery_var_column_size' => '',
	    'foodbakery_var_image_section_title' => '',
	    'foodbakery_var_frame_image_url_array' => '',
	    'foodbakery_promobox_bg_color' => '',
	    'foodbakery_var_promobox_title' => '',
	    'foodbakery_var_frame_promo_image_url_array' => '',
	    'foodbakery_var_app_store_image_url_array' => '',
	    'foodbakery_promobox_button_bg_color' => '',
	    'foodbakery_var_promobox_button_title' => '',
	    'foodbakery_var_promobox_button_url' => '',
	    'foodbakery_promobox_title_color' => '',
	    'foodbakery_var_promo_box_view' => '',
	    'foodbakery_var_app_store_url' => '',
	    'foodbakery_var_google_store_image_url_array' => '',
	    'foodbakery_var_google_store_url' => '',
            'foodbakery_var_promo_align' => '',
	);
	extract(shortcode_atts($defaults, $atts));
	if (isset($foodbakery_var_column_size) && $foodbakery_var_column_size != '') {
	    if (function_exists('foodbakery_var_custom_column_class')) {
		$column_class = foodbakery_var_custom_column_class($foodbakery_var_column_size);
	    }
	}

	$foodbakery_var_image_section_title = isset($foodbakery_var_image_section_title) ? $foodbakery_var_image_section_title : '';
	$foodbakery_var_frame_image_url = isset($foodbakery_var_frame_image_url_array) ? $foodbakery_var_frame_image_url_array : '';
	$foodbakery_var_frame_promo_image_url_array = isset($foodbakery_var_frame_promo_image_url_array) ? $foodbakery_var_frame_promo_image_url_array : '';
	$foodbakery_var_promobox_button_title = isset($foodbakery_var_promobox_button_title) ? $foodbakery_var_promobox_button_title : '';
	$foodbakery_var_promobox_button_url = isset($foodbakery_var_promobox_button_url) ? $foodbakery_var_promobox_button_url : '';
	$foodbakery_promobox_button_bg_color = isset($foodbakery_promobox_button_bg_color) ? $foodbakery_promobox_button_bg_color : '';
	$foodbakery_promobox_bg_color = isset($foodbakery_promobox_bg_color) ? $foodbakery_promobox_bg_color : '';
	$foodbakery_var_promobox_title = isset($foodbakery_var_promobox_title) ? $foodbakery_var_promobox_title : '';
	$foodbakery_promobox_title_color = isset($foodbakery_promobox_title_color) ? $foodbakery_promobox_title_color : '';
	$foodbakery_var_promo_box_view = isset($foodbakery_var_promo_box_view) ? $foodbakery_var_promo_box_view : '';
	$foodbakery_var_app_store_image_url_array = isset($foodbakery_var_app_store_image_url_array) ? $foodbakery_var_app_store_image_url_array : '';
	$foodbakery_var_app_store_url = isset($foodbakery_var_app_store_url) ? $foodbakery_var_app_store_url : '';
	$foodbakery_var_google_store_image_url_array = isset($foodbakery_var_google_store_image_url_array) ? $foodbakery_var_google_store_image_url_array : '';
	$foodbakery_var_google_store_url = isset($foodbakery_var_google_store_url) ? $foodbakery_var_google_store_url : '';
        $foodbakery_var_promo_align = isset($foodbakery_var_promo_align) ? $foodbakery_var_promo_align : '';


	$foodbakery_var_promobox = '';
        $page_element_size  = isset( $atts['promobox_element_size'] )? $atts['promobox_element_size'] : 100;
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $foodbakery_var_promobox .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
	if (isset($column_class) && $column_class <> '') {
	    $foodbakery_var_promobox .= '<div class="' . esc_html($column_class) . '">';
	}
	if (isset($foodbakery_var_image_section_title) && $foodbakery_var_image_section_title != '') {
	    $foodbakery_var_promobox .= '<div class="element-title '.$foodbakery_var_promo_align.'"> <h2>' . esc_html($foodbakery_var_image_section_title) . '</h2></div>';
	}
	$image_url = '';
	$promobox_bg_color = '';
        if (isset($foodbakery_promobox_bg_color) && $foodbakery_promobox_bg_color <> '') {
	    $promobox_bg_color = '' . $foodbakery_promobox_bg_color;
	}

	if (isset($image_url) && $image_url <> '' || isset($promobox_bg_color) && $promobox_bg_color <> '') {
	    $foodbakery_var_frame_image_url = 'style="background:' . $image_url . ' ' . $promobox_bg_color . ';"';
	}
	$title_color = '';
	if (isset($foodbakery_promobox_title_color) && $foodbakery_promobox_title_color <> '') {
	    $title_color = 'style="color:' . esc_html($foodbakery_promobox_title_color) . ' !important;"';
	}
	if (isset($foodbakery_var_frame_image_url) && $foodbakery_var_frame_image_url <> '') {
	    $image_url = 'url(' . $foodbakery_var_frame_image_url . ') right bottom no-repeat';
	}
	

	if ($foodbakery_var_promo_box_view == 'fancy') {
	    $foodbakery_var_promobox .= '<div class="image-frame fancy align-left">';
	    if ($foodbakery_var_frame_promo_image_url_array <> '') {
		$foodbakery_var_promobox .= '<div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12"><div class="img-holder">'
			. '<figure><img alt = "' . esc_html($foodbakery_var_promobox_title) . '" src = "' . esc_url($foodbakery_var_frame_promo_image_url_array) . '">'
			. '</figure></div></div>';
	    }
	    if ($content != '' || $foodbakery_var_promobox_title != '') {
		$foodbakery_var_promobox .= '<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12"><div class="text-holder" >';
		if ($foodbakery_var_promobox_title && trim($foodbakery_var_promobox_title) != '') {
		    $foodbakery_var_promobox .= '<h2 ' . $title_color . ' >' . esc_html($foodbakery_var_promobox_title) . '</h2>';
		}
		if ($content <> '') {
		    $foodbakery_var_promobox .= do_shortcode($content);
		}
		if (isset($foodbakery_var_promobox_button_url) && $foodbakery_var_promobox_button_url == '') {
		    $foodbakery_var_promobox_button_url = 'javascript:void(0)';
		}
		$button_bg_color = '';
		if (isset($foodbakery_promobox_button_bg_color) && $foodbakery_promobox_button_bg_color <> '') {
		    $button_bg_color = 'style="background-color:' . esc_html($foodbakery_promobox_button_bg_color) . ' !important;"';
		}
		if (isset($foodbakery_var_promobox_button_title) && $foodbakery_var_promobox_button_title <> '') {
		    $foodbakery_var_promobox .='<div class="default-btn"><a class="bgcolor" ' . $button_bg_color . ' href="' . esc_url($foodbakery_var_promobox_button_url) . '">' . esc_html($foodbakery_var_promobox_button_title) . '</a></div>';
		}
		$foodbakery_var_promobox .= '</div></div>';
	    }
	    $foodbakery_var_promobox .= '</div></div></div>';
	} else {
	    $foodbakery_var_promobox .= '<div class="main-post promo-box">';
	    if ($foodbakery_var_frame_promo_image_url_array <> '') {
		$foodbakery_var_promobox .= '<div class="img-frame">';
		$foodbakery_var_promobox .= '<figure>';
		$foodbakery_var_promobox .= '<img src="' . esc_url($foodbakery_var_frame_promo_image_url_array) . '" alt="' . esc_html($foodbakery_var_promobox_title) . '">';
		$foodbakery_var_promobox .= '</figure>';
		$foodbakery_var_promobox .= '</div>';
	    }
	    $foodbakery_var_promobox .= '<div class="column-text">';
	    $foodbakery_var_promobox .= '<h3 ' . $title_color . '>' . esc_html($foodbakery_var_promobox_title) . '</h3>';
            
            if ($content <> '') {
                $foodbakery_var_promobox .= '<div class="promo-content">'.do_shortcode($content).'</div>';
            }

	    if (isset($foodbakery_var_app_store_image_url_array) && !empty($foodbakery_var_app_store_image_url_array)) {
		$foodbakery_var_promobox .= '<a class="app-btn" href="' . esc_url($foodbakery_var_app_store_url) . '">';
		$foodbakery_var_promobox .= '<img src="' . esc_url($foodbakery_var_app_store_image_url_array) . '" alt="foodbakery_var_app_store_image_url_array">';
		$foodbakery_var_promobox .= '</a>';
	    }
	    if (isset($foodbakery_var_google_store_image_url_array) && !empty($foodbakery_var_google_store_image_url_array)) {
		$foodbakery_var_promobox .= '<a class="app-btn" href="' . esc_url($foodbakery_var_google_store_url) . '">';
		$foodbakery_var_promobox .= '<img src="' . esc_url($foodbakery_var_google_store_image_url_array) . '" alt="foodbakery_var_google_store_image_url_array">';
		$foodbakery_var_promobox .= '</a>';
	    }
	    $foodbakery_var_promobox .= '<form>';
	    $foodbakery_var_promobox .= '<div class="field-holder">';
	    $foodbakery_var_promobox .= '<input class="field-input" type="email" placeholder="Your Email">';
            $button_bg_color = '';
            if (isset($foodbakery_promobox_button_bg_color) && $foodbakery_promobox_button_bg_color <> '') {
                $button_bg_color = 'style="background-color:' . esc_html($foodbakery_promobox_button_bg_color) . ' !important;"';
            }
	    $foodbakery_var_promobox .= '<label class="field-label-btn">';
	    $foodbakery_var_promobox .= '<input class="field-btn" type="submit" value="Send Link" '.$button_bg_color.'>';
	    $foodbakery_var_promobox .= '</label>';
	    $foodbakery_var_promobox .= '</div>';
	    $foodbakery_var_promobox .= '</form>';
	    $foodbakery_var_promobox .= '</div>';
	    $foodbakery_var_promobox .= '</div>';
	}
	if (isset($column_class) && $column_class <> '') {
	    $foodbakery_var_promobox .= '</div>';
	}
        
        
        if ($foodbakery_var_promo_box_view != 'fancy') {
            if (function_exists('foodbakery_var_page_builder_element_sizes')) {
                $foodbakery_var_promobox .= '</div>';
            }
        }

	return $foodbakery_var_promobox;
    }

    if (function_exists('foodbakery_var_short_code'))
	foodbakery_var_short_code('foodbakery_promobox', 'foodbakery_var_promobox');
}