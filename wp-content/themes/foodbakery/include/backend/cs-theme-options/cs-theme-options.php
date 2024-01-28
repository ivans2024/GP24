<?php
/**
 * Foodbakery Theme Options
 *
 * @package WordPress
 * @subpackage foodbakery
 * @since Auto Mobile 1.0
 */
if (!function_exists('foodbakery_var_settings_page')) {

    /**
     * Foodbakery setting page
     */
    function foodbakery_var_settings_page() {

	global $foodbakery_var_options, $foodbakery_var_settings, $foodbakery_var_form_fields, $foodbakery_var_html_fields, $foodbakery_var_static_text;
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_theme_option_strings();
	?>
	<div class="theme-wrap fullwidth">
	    <div class="inner">
		<div class="outerwrapp-layer">
		    <div class="loading_div"> 
			<i class="icon-circle-o-notch icon-spin"></i> <br>
			<?php
			echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_theme_option_save_msg'));
			?>
		    </div>
		    <div class="form-msg"> 
			<i class="icon-check-circle-o"></i>
			<div class="innermsg"></div>
		    </div>
		</div>
		<div class="row">
		    <form id="frm" method="post">
			<?php
			$foodbakery_var_fields = new foodbakery_var_fields();
			$return = $foodbakery_var_fields->foodbakery_var_fields($foodbakery_var_settings);
			?>
			<div class="col1">
			    <nav class="admin-navigtion">
				<div class="logo"> <a href="<?php echo esc_url(home_url('/')) ?>" class="logo1"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/backend/images/logo-themeoption.png') ?>" /></a> <a href="#" class="nav-button"><i class="icon-align-justify"></i></a> </div>
				<ul>
				    <?php echo tags_balnce_func_theme($return[1]); ?>
				</ul>
			    </nav>
			</div>

			<div class="col2">
			    <?php echo tags_balnce_func_theme($return[0]); ?>
			</div>
			<?php
			$foodbakery_inline_script = '
			jQuery(document).ready(function () {
				chosen_selectionbox();
			});';
			foodbakery_admin_inline_enqueue_script($foodbakery_inline_script, 'foodbakery-custom-functions');
			?>
			<div class="clear"></div>
			<div class="footer">
			    <?php
			    $foodbakery_opt_array = array(
				'std' => foodbakery_var_theme_text_srt('foodbakery_var_save_msg'),
				'cust_id' => 'submit_btn',
				'cust_name' => 'submit_btn',
				'cust_type' => 'button',
				'extra_atr' => 'onclick="javascript:theme_option_save(\'' . esc_js(admin_url('admin-ajax.php')) . '\', \'' . esc_js(get_template_directory_uri()) . '\');"',
				'classes' => 'bottom_btn_save',
			    );
			    $foodbakery_var_form_fields->foodbakery_var_form_text_render($foodbakery_opt_array);

			    $foodbakery_opt_array = array(
				'std' => 'theme_option_save',
				'cust_id' => 'action',
				'cust_name' => 'action',
				'classes' => '',
			    );
			    $foodbakery_var_form_fields->foodbakery_var_form_hidden_render($foodbakery_opt_array);

			    $foodbakery_opt_array = array(
				'std' => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_reset_msg'),
				'cust_id' => 'reset',
				'cust_name' => 'reset',
				'cust_type' => 'button',
				'extra_atr' => 'onclick="javascript:foodbakery_var_rest_all_options(\'' . esc_js(admin_url('admin-ajax.php')) . '\', \'' . esc_js(get_template_directory_uri()) . '\');"',
				'classes' => 'bottom_btn_reset',
			    );
			    $foodbakery_var_form_fields->foodbakery_var_form_text_render($foodbakery_opt_array);
			    ?>
			</div>
		    </form>
		</div>
	    </div>
	</div>
	<div class="clear"></div>
	<?php
    }

}

/**
 * @Background Count function
 * @return
 *
 */
if (!function_exists('foodbakery_var_bgcount')) {

    function foodbakery_var_bgcount($name, $count) {

	$pattern = array();
	for ($i = 0; $i <= $count; $i ++) {
	    $pattern['option' . $i] = $name . $i;
	}
	return $pattern;
    }

}




/**
 * @Theme Options array
 * @return
 *
 */
if (!function_exists('foodbakery_var_options_array')) {

    add_action('init', 'foodbakery_var_options_array');

    function foodbakery_var_options_array() {

	global $foodbakery_var_settings, $foodbakery_var_options, $foodbakery_var_static_text;
	$banner_fields = array('banner_field_title' => array('Banner 1'), 'banner_field_style' => array('top_banner'), 'banner_field_type' => array('code'), 'banner_field_image' => array(''), 'banner_field_url' => array('#'), 'banner_field_url_target' => array('_self'), 'banner_adsense_code' => array(''), 'banner_field_code_no' => array('0'));
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_theme_strings();
	$strings->foodbakery_theme_option_strings();
	$on_off_option = array(
	    "show" => "on",
	    "hide" => "off",
	);
	$navigation_style = array(
	    "left" => "left",
	    "center" => "center",
	    "right" => "right"
	);

	$social_network = array(
	    'foodbakery_var_social_net_icon_path' => array('', '', '', '', ''),
	    'foodbakery_var_social_net_awesome' => array('icon-facebook9', 'icon-dribbble7', 'icon-twitter2', 'icon-behance2'),
	    'foodbakery_var_social_net_url' => array('https://www.facebook.com/', 'https://dribbble.com/', 'https://www.twitter.com/', 'https://www.behance.net/'),
	    'foodbakery_var_social_net_tooltip' => array('Facebook', 'Dribbble', 'Twitter', 'Behance'),
	    'foodbakery_var_social_icon_color' => array('#cccccc', '#cccccc', '#cccccc', '#cccccc')
	);

	$foodbakery_var_sidebar = array(
	    'sidebar' => array(
	    )
	);

	$foodbakery_var_footer_sidebar = array(
	    'foodbakery_var_footer_sidebar' => array(
		'' => foodbakery_var_theme_text_srt('foodbakery_var_please_select'),
	    )
	);

	$deafult_sub_header = array(
	    'breadcrumbs_sub_header' => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_breadcrumbs_sub_header'),
	    'slider' => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_revolution_slider'),
	    'no_header' => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_no_sub_header'),
	);

	$sizee = array($foodbakery_var_options['foodbakery_var_sidebar']);
	if (isset($foodbakery_var_options['foodbakery_var_sidebar']) && count($sizee) > 0) {
	    $foodbakery_var_sidebar = array('sidebar' => $foodbakery_var_options['foodbakery_var_sidebar']);
	}

	// google fonts array
	$foodbakery_var_fonts = foodbakery_var_googlefont_list();
	$foodbakery_var_fonts_atts = foodbakery_var_get_google_font_attribute();

	if (isset($foodbakery_var_options) and isset($foodbakery_var_options['foodbakery_var_footer_sidebar'])) {
	    if (is_array($foodbakery_var_options['foodbakery_var_footer_sidebar']) and count($foodbakery_var_options['foodbakery_var_footer_sidebar']) > 0) {
		$foodbakery_footer_sidebar = array('foodbakery_var_footer_sidebar' => $foodbakery_var_options['foodbakery_var_footer_sidebar']);
	    } else {
		$foodbakery_footer_sidebar = array('foodbakery_var_footer_sidebar' => array());
	    }
	} else {
	    $foodbakery_footer_sidebar = $foodbakery_var_footer_sidebar;
	}

	$footer_sidebar_list[''] = foodbakery_var_theme_text_srt('foodbakery_var_please_select');
	if (isset($foodbakery_footer_sidebar['foodbakery_var_footer_sidebar']) && is_array($foodbakery_footer_sidebar['foodbakery_var_footer_sidebar'])) {
	    foreach ($foodbakery_footer_sidebar['foodbakery_var_footer_sidebar'] as $footer_sidebar_var => $footer_sidebar_val) {
		$footer_sidebar_list[$footer_sidebar_var] = $footer_sidebar_val;
	    }
	}
	$foodbakery_footer_sidebar['foodbakery_var_footer_sidebar'] = $footer_sidebar_list;
	//Set the Options Array
	$foodbakery_var_settings = array();
	//general setting options
	$foodbakery_var_settings[] = array(
	    "name" => foodbakery_var_theme_text_srt('foodbakery_var_general'),
	    "fontawesome" => 'icon-cog3',
	    "type" => "heading",
	    "options" => array(
		'tab-global-setting' => foodbakery_var_theme_text_srt('foodbakery_var_global'),
		'tab-header-options' => foodbakery_var_theme_text_srt('foodbakery_var_header'),
		'tab-sub-header-options' => foodbakery_var_theme_text_srt('foodbakery_var_sub_header'),
		'tab-footer-options' => foodbakery_var_theme_text_srt('foodbakery_var_footer'),
		'tab-social-setting' => foodbakery_var_theme_text_srt('foodbakery_var_social_icons'),
		'tab-social-network' => foodbakery_var_theme_text_srt('foodbakery_var_social_sharing'),
	    )
	);
	$foodbakery_var_settings[] = array(
	    "name" => foodbakery_var_theme_text_srt('foodbakery_var_color'),
	    "fontawesome" => 'icon-magic',
	    "hint_text" => "",
	    "type" => "heading",
	    "options" => array(
		'tab-general-color' => foodbakery_var_theme_text_srt('foodbakery_var_general'),
		'tab-header-color' => foodbakery_var_theme_text_srt('foodbakery_var_header'),
		'tab-footer-color' => foodbakery_var_theme_text_srt('foodbakery_var_footer'),
		'tab-heading-color' => foodbakery_var_theme_text_srt('foodbakery_var_heading'),
	    )
	);
	$foodbakery_var_settings[] = array(
	    "name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_typo_font'),
	    "fontawesome" => 'icon-font',
	    "desc" => "",
	    "hint_text" => "",
	    "type" => "heading",
	    "options" => array(
		'tab-custom-font' => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_custom_font'),
		'tab-font-family' => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_google_font'),
	    )
	);
	$foodbakery_var_settings[] = array(
	    "name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_sidebar'),
	    "fontawesome" => 'icon-columns',
	    "id" => "tab-sidebar",
	    "std" => "",
	    "type" => "main-heading",
	    "options" => ''
	);
	$foodbakery_var_settings[] = array(
	    "name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_footer_sidebar'),
	    "fontawesome" => 'icon-columns',
	    "id" => "tab-footer-sidebar",
	    "std" => "",
	    "type" => "main-heading",
	    "options" => ''
	);
	$foodbakery_var_settings[] = array(
	    "name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_api_setting'),
	    "fontawesome" => 'icon-columns',
	    "id" => "tab-api-setting",
	    "std" => "",
	    "type" => "main-heading",
	    "options" => ''
	);
	$foodbakery_var_settings[] = array(
	    "name" => foodbakery_var_theme_text_srt('foodbakery_var_global'),
	    "id" => "tab-global-setting",
	    "type" => "sub-heading"
	);
	$foodbakery_var_settings[] = array(
	    "name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_layout'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_layout_type'),
	    "id" => "layout",
	    "std" => "full_width",
	    "options" => array(
		"boxed" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_box'),
		"full_width" => foodbakery_var_theme_text_srt('foodbakery_var_full_width'),
	    ),
	    "type" => "layout",
	);
	$foodbakery_var_settings[] = array(
	    "name" => "",
	    "id" => "horizontal_tab",
	    "class" => "horizontal_tab",
	    "type" => "horizontal_tab",
	    "std" => "",
	    "options" => array(
		foodbakery_var_theme_text_srt('foodbakery_var_background') => 'background_tab',
		foodbakery_var_theme_text_srt('foodbakery_var_bgcolor') => 'background_tab_color',
		foodbakery_var_theme_text_srt('foodbakery_var_theme_option_pattern') => 'pattern_tab',
		foodbakery_var_theme_text_srt('foodbakery_var_theme_option_custom_image') => 'custom_image_tab'
	    )
	);
	$foodbakery_var_layout = isset($foodbakery_var_options['foodbakery_var_layout']) ? $foodbakery_var_options['foodbakery_var_layout'] : '';
	$foodbakery_var_bg_image = isset($foodbakery_var_options['foodbakery_var_bg_image']) ? $foodbakery_var_options['foodbakery_var_bg_image'] : '';
	$foodbakery_var_bg_color = isset($foodbakery_var_options['foodbakery_var_bg_color']) ? $foodbakery_var_options['foodbakery_var_bg_color'] : '';
	$foodbakery_var_pattern_image = isset($foodbakery_var_options['foodbakery_var_pattern_image']) ? $foodbakery_var_options['foodbakery_var_pattern_image'] : '';
	$foodbakery_var_custom_bgimage = isset($foodbakery_var_options['foodbakery_var_custom_bgimage']) ? $foodbakery_var_options['foodbakery_var_custom_bgimage'] : '';
	if ($foodbakery_var_layout == 'full_width') {
	    $bg_image_display = "none";
	} else {
	    $bg_image_display = "block";
	}
	$bg_color_display = $pattern_image_display = $custom_bgimage_display = $custom_bgimage_position_display = "none";
	if ($foodbakery_var_custom_bgimage <> '') {
	    $custom_bgimage_display = "block";
	    $custom_bgimage_position_display = "block";
	    $bg_image_display = "none";
	} elseif ($foodbakery_var_pattern_image <> '' && $foodbakery_var_pattern_image <> 0) {
	    $pattern_image_display = "block";
	    $bg_image_display = "none";
	} elseif ($foodbakery_var_bg_color <> '') {
	    $bg_color_display = "block";
	    $bg_image_display = "none";
	}
	$foodbakery_var_settings[] = array(
	    "name" => foodbakery_var_theme_text_srt('foodbakery_var_background_image'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_bg_image_hint'),
	    "id" => "bg_image",
	    "class" => "foodbakery_var_background_",
	    "path" => "background",
	    "tab" => "background_tab",
	    "std" => "bg1",
	    "type" => "layout_body",
	    "display" => $bg_image_display,
	    "options" => foodbakery_var_bgcount('bg', '10')
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_bg_pattern'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_bg_pattern_hint'),
	    "id" => "pattern_image",
	    "class" => "foodbakery_var_background_",
	    "path" => "patterns",
	    "tab" => "pattern_tab",
	    "std" => "bg7",
	    "type" => "layout_body",
	    "display" => $pattern_image_display,
	    "options" => foodbakery_var_bgcount('pattern', '27')
	);
	$foodbakery_var_settings[] = array(
	    "name" => foodbakery_var_theme_text_srt('foodbakery_var_bgcolor'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_bgcolor_hint'),
	    "id" => "bg_color",
	    "std" => "#f3f3f3",
	    "tab" => "background_tab_color",
	    "display" => $bg_color_display,
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array(
	    "name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_custom_image'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_layout_hint'),
	    "id" => "custom_bgimage",
	    "std" => "",
	    "tab" => "custom_image_tab",
	    "display" => $custom_bgimage_display,
	    "type" => "upload logo"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_bg_image_position'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_bg_image_position_hint'),
	    "id" => "bgimage_position",
	    "std" => foodbakery_var_theme_text_srt('foodbakery_var_repeat_center'),
	    "type" => "select",
	    "tab" => "custom_image_position",
	    "display" => $custom_bgimage_position_display,
	    'classes' => 'chosen-select',
	    "options" => array(
		"no-repeat center top" => foodbakery_var_theme_text_srt('foodbakery_var_no_repeat_center_top'),
		"repeat center top" => foodbakery_var_theme_text_srt('foodbakery_var_repeat_center_top'),
		"no-repeat center" => foodbakery_var_theme_text_srt('foodbakery_var_no_repeat_center'),
		"Repeat Center" => foodbakery_var_theme_text_srt('foodbakery_var_repeat_center'),
		"no-repeat left top" => foodbakery_var_theme_text_srt('foodbakery_var_no_repeat_left_top'),
		"repeat left top" => foodbakery_var_theme_text_srt('foodbakery_var_repeat_left_top'),
		"no-repeat fixed center" => foodbakery_var_theme_text_srt('foodbakery_var_no_repeat_fixed_center'),
		"no-repeat fixed center / cover" => foodbakery_var_theme_text_srt('foodbakery_var_no_repeat_fixed_center_cover'),
	    )
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_responsive'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_responsive_hint'),
	    "id" => "responsive",
	    "std" => "on",
	    "type" => "checkbox",
	    "options" => $on_off_option
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_excerpt'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_excerpt_hint'),
	    "id" => "excerpt_length",
	    "std" => "120",
	    "type" => "text"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_map_style'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_map_style_hint'),
	    "id" => "def_map_style",
	    "std" => "",
	    "type" => "select",
	    'classes' => 'chosen-select-no-single',
	    "options" => array(
		'map-box' => foodbakery_var_theme_text_srt('foodbakery_var_map_style_1'),
		'blue-water' => foodbakery_var_theme_text_srt('foodbakery_var_map_style_2'),
		'icy-blue' => foodbakery_var_theme_text_srt('foodbakery_var_map_style_3'),
		'bluish' => foodbakery_var_theme_text_srt('foodbakery_var_map_style_4'),
		'light-blue-water' => foodbakery_var_theme_text_srt('foodbakery_var_map_style_5'),
		'clad-me' => foodbakery_var_theme_text_srt('foodbakery_var_map_style_6'),
		'chilled' => foodbakery_var_theme_text_srt('foodbakery_var_map_style_7'),
		'two-tone' => foodbakery_var_theme_text_srt('foodbakery_var_map_style_8'),
		'light-and-dark' => foodbakery_var_theme_text_srt('foodbakery_var_map_style_9'),
		'ilustracao' => foodbakery_var_theme_text_srt('foodbakery_var_map_style_10'),
		'flat-pale' => foodbakery_var_theme_text_srt('foodbakery_var_map_style_11'),
		'title' => foodbakery_var_theme_text_srt('foodbakery_var_map_style_12'),
		'moret' => foodbakery_var_theme_text_srt('foodbakery_var_map_style_13'),
	    )
	);
	// filter to add custom fields in themes options using addons
	$all_pages = get_pages();
	$pages_array = array();
	foreach ($all_pages as $page) {
	    if ($page->post_type == 'page') {
		$pages_array[$page->ID] = $page->post_name;
	    }
	}
	$foodbakery_var_settings = apply_filters('foodbakery_theme_options_general', $foodbakery_var_settings);
	$currPage = '';
	
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_logo_width'),
	    "type" => "division_close"
	);
	$foodbakery_var_settings[] = array("col_heading" => '',
	    "type" => "col-right-text",
	    "help_text" => '',
	);
	// Header options start
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_header'),
	    "id" => "tab-header-options",
	    "type" => "sub-heading"
	);

	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('header_preview_area'),
	    "id" => "header_top_strip",
	    "std" => foodbakery_var_theme_text_srt('header_preview_area'),
	    "type" => "section",
	    "options" => ""
	);
	$header_options = array(
	    'default' => esc_html__('Header Default', 'foodbakery'),
	    'fancy' => esc_html__('Header Fancy', 'foodbakery'),
             'court' => esc_html__('Header foodcourt', 'foodbakery'),
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_header_options'),
	    "name" => esc_html__('Header Views', 'foodbakery'),
	    "desc" => "",
	    "hint_text" => '',
	    "id" => "header_options",
	    'classes' => 'chosen-select-no-single',
	    "std" => foodbakery_var_theme_text_srt('foodbakery_var_header_options'),
	    "type" => "select",
	    "options" => $header_options
	);
	$foodbakery_var_settings[] = array(
	    "name" => foodbakery_var_theme_text_srt('header_sticky_switch'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('header_sticky_switch_hint'),
	    "id" => "sticky_header",
	    "std" => "on",
	    "type" => "checkbox"
	);
	
	$foodbakery_var_settings[] = array(
	    "name" => esc_html__('Header Full Width', 'foodbakery'),
	    "desc" => "",
	    "hint_text" => '',
	    "id" => "full_header",
	    "std" => "",
	    "type" => "checkbox"
	);
	$foodbakery_var_settings[] = array(
	    "name" => esc_html__('Transparent Header', 'foodbakery'),
	    "desc" => "",
	    "hint_text" => '',
	    "id" => "transparent_header",
	    "std" => "",
	    "type" => "checkbox"
	);
	
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_logo'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_logo_hint'),
	    "id" => "custom_logo",
	    "std" => "",
	    "type" => "upload logo"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_logo_height'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_logo_height_hint'),
	    "id" => "logo_height",
	    "min" => '0',
	    "max" => '100',
	    "std" => "67",
	    "type" => "range"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_logo_width'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_logo_width_hint'),
	    "id" => "logo_width",
	    "min" => '0',
	    "max" => '210',
	    "std" => "142",
	    "type" => "range"
	);
	
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_sticky_logo'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_logo_hint'),
	    "id" => "sticky_logo",
	    "std" => "",
	    "type" => "upload logo"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_logo_height'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_logo_height_hint'),
	    "id" => "sticky_logo_height",
	    "min" => '0',
	    "max" => '100',
	    "std" => "",
	    "type" => "range"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_logo_width'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_logo_width_hint'),
	    "id" => "sticky_logo_width",
	    "min" => '0',
	    "max" => '210',
	    "std" => "",
	    "type" => "range"
	);
        
        $menu_options = array(
	    'default' => esc_html__('Default', 'foodbakery'),
	    'fancy' => esc_html__('Fancy', 'foodbakery'),
	);
	$foodbakery_var_settings[] = array(
            "name" => esc_html__('Menu Style', 'foodbakery'),
	    "desc" => "",
	    "hint_text" => '',
	    "id" => "menu_style",
	    'classes' => 'chosen-select-no-single',
	    "std" => '',
	    "type" => "select",
	    "options" => $menu_options
	);
        
        $foodbakery_var_settings[] = array(
	    "type" => "division",
	    "enable_id" => "foodbakery_var_menu_style",
	    "enable_val" => "fancy",
	    "extra_atts" => 'id="foodbakery-fancy-many-fields"',
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_menu_hide_height'),
	    "desc" => "",
	    "hint_text" => '',
	    "id" => "menu_hide_height",
	    "std" => "",
	    "type" => "text",
            "cust_type" => "number",
	);
	$foodbakery_var_settings[] = array(
	    "type" => "division_close",
	);
        
        
        
        
        
	// sub header element settings 
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_sub_header'),
	    "id" => "tab-sub-header-options",
	    "type" => "sub-heading"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_default_sub_header'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_default_sub_header_hint'),
	    "id" => "default_header",
	    "std" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_breadcrumbs_sub_header'),
	    'classes' => 'chosen-select',
	    "type" => "default_header",
	    "options" => $deafult_sub_header
	);
	$foodbakery_var_settings[] = array(
	    "type" => "division",
	    "enable_id" => "foodbakery_var_default_header",
	    "enable_val" => "no_header",
	    "extra_atts" => 'id="cs-no-headerfields"',
	);

	$foodbakery_var_settings[] = array(
	    "type" => "division_close",
	);
	$foodbakery_var_settings[] = array(
	    "type" => "division",
	    "enable_id" => "foodbakery_var_default_header",
	    "enable_val" => "slider",
	    "extra_atts" => 'id="cs-rev-slider-fields"',
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_revolution_slider'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_revolution_slider_hint'),
	    "id" => "custom_slider",
	    "std" => "",
	    "type" => "slider_code",
	    "options" => ''
	);
	$foodbakery_var_settings[] = array(
	    "type" => "division_close",
	);

	$foodbakery_var_settings[] = array(
	    "type" => "division",
	    "enable_id" => "foodbakery_var_default_header",
	    "enable_val" => "breadcrumbs_sub_header",
	    "extra_atts" => 'id="cs-breadcrumbs-fields"',
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_style'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_subheader_style_hint'),
	    "id" => "sub_header_style",
	    "std" => "simple",
	    'classes' => 'chosen-select',
	    "type" => "select",
	    "extra_att" => " onchange=foodbakery_var_subheader_style(this.value)",
	    "options" => array(
		'classic' => foodbakery_var_theme_text_srt('foodbakery_var_classic'),
		'with_bg' => foodbakery_var_theme_text_srt('foodbakery_var_with_background_image'),
	    ),
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_padding_top'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_sub_header_padding_top_hint'),
	    "id" => "sh_paddingtop",
	    "min" => '0',
	    "max" => '200',
	    "std" => "0",
	    "type" => "range"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_padding_bottom'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_sub_header_padding_bottom_hint'),
	    "id" => "sh_paddingbottom",
	    "min" => '0',
	    "max" => '200',
	    "std" => "0",
	    "type" => "range"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_margin_top'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_sub_header_margin_top_hint'),
	    "id" => "sh_margintop",
	    "min" => '0',
	    "max" => '200',
	    "std" => "0",
	    "type" => "range"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_margin_bottom'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_margin_bottom_hint'),
	    "id" => "sh_marginbottom",
	    "min" => '0',
	    "max" => '200',
	    "std" => "0",
	    "type" => "range"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_page_title'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_page_title_hint'),
	    "id" => "page_title_switch",
	    "std" => "on",
	    "type" => "checkbox"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_text_color'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_subheader_text_color_hint'),
	    "id" => "sub_header_text_color",
	    "std" => "#ffffff",
	    "type" => "color"
	);

	$foodbakery_var_settings[] = array(
	    "name" => foodbakery_var_theme_text_srt('foodbakery_var_breadcrumbs'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_breadcrumbs_hint'),
	    "id" => "breadcrumbs_switch",
	    "std" => "on",
	    "type" => "checkbox"
	);
	$foodbakery_var_settings[] = array(
	    "type" => "division_close",
	); 
	$foodbakery_var_settings[] = array(
	    "type" => "division",
	    "enable_id" => "foodbakery_var_default_header",
	    "enable_val" => "breadcrumbs_sub_header",
	    "extra_atts" => 'id="cs-breadcrumbs_sub_header_fields"',
	);
	$foodbakery_var_settings[] = array(
	    "type" => "division",
	    "enable_id" => "foodbakery_var_sub_header_style",
	    "enable_val" => "with_bg",
	    "extra_atts" => 'id="cs-subheader-with-bg"',
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_sub_heading'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "sub_header_sub_hdng",
	    "std" => "",
	    "type" => "textarea"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_background_image'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_bg_image_hint'),
	    "id" => "sub_header_bg_img",
	    "std" => "",
	    "type" => "upload logo"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_parallax'),
	    "desc" => "",
	    "hint_text" => '',
	    "id" => "sub_header_parallax",
	    "std" => "",
	    "type" => "checkbox",
	    "options" => $on_off_option
	);
	$foodbakery_var_settings[] = array(
	    "type" => "division_close",
	);
	$foodbakery_var_settings[] = array(
	    "type" => "division_close",
	);
	$foodbakery_var_settings[] = array(
	    "type" => "division",
	    "enable_id" => "foodbakery_var_default_header",
	    "enable_val" => "breadcrumbs_sub_header",
	    "extra_atts" => 'id="sub_header_bg_clr"',
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_bgcolor'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_bgcolor_hint'),
	    "id" => "sub_header_bg_clr",
	    "std" => "",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array(
	    "type" => "division_close",
	);
	$foodbakery_var_settings[] = array(
	    "type" => "division_close",
	);
	// start footer options    
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_footer_options'),
	    "id" => "tab-footer-options",
	    "type" => "sub-heading"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_footer_section'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_footer_section_hint'),
	    "id" => "footer_switch",
	    "std" => "on",
	    "type" => "checkbox"
	);
	
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_footer_style'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_footer_style_hint'),
	    "id" => "footer_style",
	    "std" => "",
	    "type" => "select",
	    'classes' => 'chosen-select-no-single',
	    "options" => array(
		'footer-style-1' => foodbakery_var_theme_text_srt('foodbakery_var_footer_style_1'),
		'footer-style-2' => foodbakery_var_theme_text_srt('foodbakery_var_footer_style_2'),
		'footer-style-3' => foodbakery_var_theme_text_srt('foodbakery_var_footer_style_3'),
                'footer-style-4' => foodbakery_var_theme_text_srt('foodbakery_var_footer_style_4'),
	    )
	);
	
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_footer_widgets'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_footer_widgets_hint'),
	    "id" => "footer_widget",
	    "std" => "on",
	    "type" => "checkbox"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_copy_write_section'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_copy_write_section_hint'),
	    "id" => "copy_write_section",
	    "std" => "on",
	    "type" => "checkbox");

	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_copyright_text'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_copyright_text_hint'),
	    "id" => "copy_right",
	    "std" => foodbakery_var_theme_text_srt('foodbakery_var_copyright_text_value'),
	    "type" => "textarea"
	);
	
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_right_logos_section'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_footer_right_logos_hint'),
	    "id" => "right_logos_section",
	    "std" => "on",
	    "type" => "checkbox");
	
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_footer_right_logos'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_footer_right_logos_hint'),
	    "id" => "right_logos",
	    "std" => '',
	    "type" => "textarea"
	);
	
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_back_to_top'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_back_to_top_hint'),
	    "id" => "back_to_top",
	    "std" => "on",
	    "type" => "checkbox",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_footer_background'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_footer_background_hint'),
	    "id" => "custom_footer_background",
	    "std" => "",
	    "type" => "upload logo"
	);
		$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_footer_img'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_footer_img_hint'),
	    "id" => "custom_footer_image",
	    "std" => "",
	    "type" => "upload logo"
	);
	// End footer tab setting
	// general colors 
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_general_color'),
	    "id" => "tab-general-color",
	    "type" => "sub-heading"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_color'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_color_hint'),
	    "id" => "theme_color",
	    "std" => "#ed413f",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_text_color'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_text_color_hint'),
	    "id" => "text_color",
	    "std" => "#555555",
	    "type" => "color"
	);
	// start top strip tab options
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_header_color'),
	    "id" => "tab-header-color",
	    "type" => "sub-heading"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_bgcolor'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_default_header_colors_hint'),
	    "id" => "header_bgcolor",
	    "std" => "#ffffff",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_menu_link_color'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_menu_link_color_hint'),
	    "id" => "menu_color",
	    "std" => "#282828",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_menu_hover_color'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_menu_hover_color_hint'),
	    "id" => "menu_active_color",
	    "std" => "#ed413f ",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_menu_hover_bg_color'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_menu_hover_bg_color_hint'),
	    "id" => "menu_hover_bg_color",
	    "std" => "#ed413f ",
	    "type" => "color"
	);

	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_submenu_2nd_level_color'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_submenu_2nd_level_color_hint'),
	    "id" => "submenu_2nd_level_color",
	    "std" => "#282828",
	    "type" => "color"
	);
	//DropDown 2nd Level Background-Color
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_submenu_2nd_level_bgcolor'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_submenu_2nd_level_bgcolor_hint'),
	    "id" => "submenu_2nd_level_bgcolor",
	    "std" => "#ed413f",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_submenu_hover_color'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_submenu_hover_color_hint'),
	    "id" => "submenu_hover_color",
	    "std" => "#ed413f",
	    "type" => "color"
	);
	
	// footer colors 
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_footer_color'),
	    "id" => "tab-footer-color",
	    "type" => "sub-heading"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_footer_bg_color'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_footer_bg_color_hint'),
	    "id" => "footerbg_color",
	    "std" => "#333333",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_footer_text_color'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_footer_text_color_hint'),
	    "id" => "footer_text_color",
	    "std" => "#999999",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_footer_link_color'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_footer_link_color_hint'),
	    "id" => "link_color",
	    "std" => "#999999",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_copyright_bg_color'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_copyright_bg_color_hint'),
	    "id" => "copyright_bg_color",
	    "std" => "#999999",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_copyright_text_color'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_copyright_text_color_hint'),
	    "id" => "copyright_text_color",
	    "std" => "#999999",
	    "type" => "color"
	);
	// heading colors 
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_heading_color'),
	    "id" => "tab-heading-color",
	    "type" => "sub-heading"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_heading_h1'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_h1_color",
	    "std" => "#333333",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_heading_h2'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_h2_color",
	    "std" => "#333333",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_heading_h3'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_h3_color",
	    "std" => "#333333",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_heading_h4'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_h4_color",
	    "std" => "#333333",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_heading_h5'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_h5_color",
	    "std" => "#333333",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_heading_h6'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_h6_color",
	    "std" => "#333333",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_section_title'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "section_title_color",
	    "std" => "#333333",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_post_title'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "post_title_color",
	    "std" => "#333333",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_page_title'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "page_title_color",
	    "std" => "#333333",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_widget_title'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "widget_title_color",
	    "std" => "#333333",
	    "type" => "color"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_footer_widget_title'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "footer_widget_title_color",
	    "std" => "#333333",
	    "type" => "color"
	);
	// start font family 
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_custom_font'),
	    "id" => "tab-custom-font",
	    "type" => "sub-heading"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_custom_font_woff'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_custom_font_woff_hint'),
	    "id" => "custom_font_woff",
	    'class' => 'input-medium',
	    "std" => "",
	    "type" => "upload font"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_custom_font_ttf'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_custom_font_ttf_hint'),
	    "id" => "custom_font_ttf",
	    'class' => 'input-medium',
	    "std" => "",
	    "type" => "upload font"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_custom_font_svg'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_custom_font_svg_hint'),
	    "id" => "custom_font_svg",
	    'class' => 'input-medium',
	    "std" => "",
	    "type" => "upload font"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_custom_font_eot'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_custom_font_eot_hint'),
	    "id" => "custom_font_eot",
	    'class' => 'input-medium',
	    "std" => "",
	    "type" => "upload font"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_google_font'),
	    "id" => "tab-font-family",
	    "type" => "sub-heading"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_content_font'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_content_font_discription'),
	    "id" => "content_font",
	    "std" => "Raleway",
	    "type" => "gfont_select",
	    'classes' => 'chosen-select',
	    "options" => $foodbakery_var_fonts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute'),
	    "desc" => "",
	    "hint_text" =>  foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute_hint'),
	    "id" => "content_font_att",
	    "std" => "500",
	    'classes' => 'chosen-select',
	    "type" => "gfont_att_select",
	    "options" => $foodbakery_var_fonts_atts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_size'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "content_size",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_line_height'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "content_lh",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_text_transform'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "content_textr",
	    "std" => "none",
	    "type" => "select_ftext",
	    'classes' => 'chosen-select',
	    "options" => array(
		'none' => foodbakery_var_theme_text_srt('foodbakery_var_none'),
		'capitalize' => foodbakery_var_theme_text_srt('foodbakery_var_capitalize'),
		'uppercase' => foodbakery_var_theme_text_srt('foodbakery_var_uppercase'),
		'lowercase' => foodbakery_var_theme_text_srt('foodbakery_var_lowercase'),
		'initial' => foodbakery_var_theme_text_srt('foodbakery_var_initial'),
		'inherit' => foodbakery_var_theme_text_srt('foodbakery_var_inherit')
	    ),
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_letter_spacing'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "content_spc",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_main_menu_font'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_main_menu_font_hint'),
	    "id" => "mainmenu_font",
	    "std" => "Raleway",
	    'classes' => 'chosen-select',
	    "type" => "gfont_select",
	    "options" => $foodbakery_var_fonts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute_hint'),
	    "id" => "mainmenu_font_att",
	    "std" => "700",
	    'classes' => 'chosen-select',
	    "type" => "gfont_att_select",
	    "options" => $foodbakery_var_fonts_atts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_size'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "mainmenu_size",
	    "min" => '6',
	    "max" => '50',
	    "std" => "14",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_line_height'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "mainmenu_lh",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_text_transform'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "mainmenu_textr",
	    "std" => "none",
	    "type" => "select_ftext",
	    'classes' => 'chosen-select',
	    "options" => array(
		'none' => foodbakery_var_theme_text_srt('foodbakery_var_none'),
		'capitalize' => foodbakery_var_theme_text_srt('foodbakery_var_capitalize'),
		'uppercase' => foodbakery_var_theme_text_srt('foodbakery_var_uppercase'),
		'lowercase' => foodbakery_var_theme_text_srt('foodbakery_var_lowercase'),
		'initial' => foodbakery_var_theme_text_srt('foodbakery_var_initial'),
		'inherit' => foodbakery_var_theme_text_srt('foodbakery_var_inherit')
	    ),
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_letter_spacing'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "mainmenu_spc",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_Heading1_font'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_Heading_font_hint'),
	    "id" => "heading1_font",
	    "std" => "Montserrat",
	    'classes' => 'chosen-select',
	    "type" => "gfont_select",
	    "options" => $foodbakery_var_fonts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute_hint'),
	    "id" => "heading1_font_att",
	    "std" => "700",
	    'classes' => 'chosen-select',
	    "type" => "gfont_att_select",
	    "options" => $foodbakery_var_fonts_atts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_size'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_1_size",
	    "min" => '6',
	    "max" => '50',
	    "std" => "36",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_line_height'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_1_lh",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_text_transform'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_1_textr",
	    "std" => "none",
	    "type" => "select_ftext",
	    'classes' => 'chosen-select',
	    "options" => array(
		'none' => foodbakery_var_theme_text_srt('foodbakery_var_none'),
		'capitalize' => foodbakery_var_theme_text_srt('foodbakery_var_capitalize'),
		'uppercase' => foodbakery_var_theme_text_srt('foodbakery_var_uppercase'),
		'lowercase' => foodbakery_var_theme_text_srt('foodbakery_var_lowercase'),
		'initial' => foodbakery_var_theme_text_srt('foodbakery_var_initial'),
		'inherit' => foodbakery_var_theme_text_srt('foodbakery_var_inherit')
	    ),
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_letter_spacing'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_1_spc",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_Heading2_font'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_Heading_font_hint'),
	    "id" => "heading2_font",
	    "std" => "",
	    'classes' => 'chosen-select',
	    "type" => "gfont_select",
	    "options" => $foodbakery_var_fonts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute_hint'),
	    "id" => "heading2_font_att",
	    "std" => "",
	    'classes' => 'chosen-select',
	    "type" => "gfont_att_select",
	    "options" => $foodbakery_var_fonts_atts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_size'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_2_size",
	    "min" => '6',
	    "max" => '50',
	    "std" => "30",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_line_height'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_2_lh",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_text_transform'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_2_textr",
	    "std" => "none",
	    "type" => "select_ftext",
	    'classes' => 'chosen-select',
	    "options" => array(
		'none' => foodbakery_var_theme_text_srt('foodbakery_var_none'),
		'capitalize' => foodbakery_var_theme_text_srt('foodbakery_var_capitalize'),
		'uppercase' => foodbakery_var_theme_text_srt('foodbakery_var_uppercase'),
		'lowercase' => foodbakery_var_theme_text_srt('foodbakery_var_lowercase'),
		'initial' => foodbakery_var_theme_text_srt('foodbakery_var_initial'),
		'inherit' => foodbakery_var_theme_text_srt('foodbakery_var_inherit')
	    ),
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_letter_spacing'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_2_spc",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_Heading3_font'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_Heading_font_hint'),
	    "id" => "heading3_font",
	    'classes' => 'chosen-select',
	    "std" => "",
	    "type" => "gfont_select",
	    "options" => $foodbakery_var_fonts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute_hint'),
	    "id" => "heading3_font_att",
	    "std" => "",
	    'classes' => 'chosen-select',
	    "type" => "gfont_att_select",
	    "options" => $foodbakery_var_fonts_atts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_size'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_3_size",
	    "min" => '6',
	    "max" => '50',
	    "std" => "26",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_line_height'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_3_lh",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_text_transform'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_3_textr",
	    "std" => "none",
	    'classes' => 'chosen-select',
	    "type" => "select_ftext",
	    "options" => array(
		'none' => foodbakery_var_theme_text_srt('foodbakery_var_none'),
		'capitalize' => foodbakery_var_theme_text_srt('foodbakery_var_capitalize'),
		'uppercase' => foodbakery_var_theme_text_srt('foodbakery_var_uppercase'),
		'lowercase' => foodbakery_var_theme_text_srt('foodbakery_var_lowercase'),
		'initial' => foodbakery_var_theme_text_srt('foodbakery_var_initial'),
		'inherit' => foodbakery_var_theme_text_srt('foodbakery_var_inherit')
	    ),
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_letter_spacing'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_3_spc",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_Heading4_font'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_Heading_font_hint'),
	    "id" => "heading4_font",
	    "std" => "",
	    'classes' => 'chosen-select',
	    "type" => "gfont_select",
	    "options" => $foodbakery_var_fonts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute_hint'),
	    "id" => "heading4_font_att",
	    "std" => "",
	    'classes' => 'chosen-select',
	    "type" => "gfont_att_select",
	    "options" => $foodbakery_var_fonts_atts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_size'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_4_size",
	    "min" => '6',
	    "max" => '50',
	    "std" => "20",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_line_height'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_4_lh",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_text_transform'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_4_textr",
	    "std" => "none",
	    'classes' => 'chosen-select',
	    "type" => "select_ftext",
	    "options" => array(
		'none' => foodbakery_var_theme_text_srt('foodbakery_var_none'),
		'capitalize' => foodbakery_var_theme_text_srt('foodbakery_var_capitalize'),
		'uppercase' => foodbakery_var_theme_text_srt('foodbakery_var_uppercase'),
		'lowercase' => foodbakery_var_theme_text_srt('foodbakery_var_lowercase'),
		'initial' => foodbakery_var_theme_text_srt('foodbakery_var_initial'),
		'inherit' => foodbakery_var_theme_text_srt('foodbakery_var_inherit')
	    ),
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_letter_spacing'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_4_spc",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_Heading5_font'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_Heading_font_hint'),
	    "id" => "heading5_font",
	    'classes' => 'chosen-select',
	    "std" => "",
	    "type" => "gfont_select",
	    "options" => $foodbakery_var_fonts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute_hint'),
	    "id" => "heading5_font_att",
	    "std" => "",
	    'classes' => 'chosen-select',
	    "type" => "gfont_att_select",
	    "options" => $foodbakery_var_fonts_atts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_size'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_5_size",
	    "min" => '6',
	    "max" => '50',
	    "std" => "18",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_line_height'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_5_lh",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_text_transform'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_5_textr",
	    "std" => "none",
	    'classes' => 'chosen-select',
	    "type" => "select_ftext",
	    "options" => array(
		'none' => foodbakery_var_theme_text_srt('foodbakery_var_none'),
		'capitalize' => foodbakery_var_theme_text_srt('foodbakery_var_capitalize'),
		'uppercase' => foodbakery_var_theme_text_srt('foodbakery_var_uppercase'),
		'lowercase' => foodbakery_var_theme_text_srt('foodbakery_var_lowercase'),
		'initial' => foodbakery_var_theme_text_srt('foodbakery_var_initial'),
		'inherit' => foodbakery_var_theme_text_srt('foodbakery_var_inherit')
	    ),
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_letter_spacing'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_5_spc",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);

	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_Heading6_font'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_Heading_font_hint'),
	    "id" => "heading6_font",
	    'classes' => 'chosen-select',
	    "std" => "",
	    "type" => "gfont_select",
	    "options" => $foodbakery_var_fonts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute_hint'),
	    "id" => "heading6_font_att",
	    "std" => "",
	    'classes' => 'chosen-select',
	    "type" => "gfont_att_select",
	    "options" => $foodbakery_var_fonts_atts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_size'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_6_size",
	    "min" => '6',
	    "max" => '50',
	    "std" => "16",
	    "type" => "range_font",
	);

	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_line_height'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_6_lh",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_text_transform'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_6_textr",
	    'classes' => 'chosen-select',
	    "std" => "none",
	    "type" => "select_ftext",
	    "options" => array(
		'none' => foodbakery_var_theme_text_srt('foodbakery_var_none'),
		'capitalize' => foodbakery_var_theme_text_srt('foodbakery_var_capitalize'),
		'uppercase' => foodbakery_var_theme_text_srt('foodbakery_var_uppercase'),
		'lowercase' => foodbakery_var_theme_text_srt('foodbakery_var_lowercase'),
		'initial' => foodbakery_var_theme_text_srt('foodbakery_var_initial'),
		'inherit' => foodbakery_var_theme_text_srt('foodbakery_var_inherit')
	    ),
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_letter_spacing'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "heading_6_spc",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);

	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_section_title_font'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_section_title_font_hint'),
	    "id" => "section_title_font",
	    "std" => "",
	    'classes' => 'chosen-select',
	    "type" => "gfont_select",
	    "options" => $foodbakery_var_fonts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute_hint'),
	    "id" => "section_title_font_att",
	    "std" => "",
	    'classes' => 'chosen-select',
	    "type" => "gfont_att_select",
	    "options" => $foodbakery_var_fonts_atts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_size'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "section_title_size",
	    "min" => '6',
	    "max" => '50',
	    "std" => "20",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_line_height'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "section_title_lh",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_text_transform'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "section_title_textr",
	    "std" => "none",
	    'classes' => 'chosen-select',
	    "type" => "select_ftext",
	    "options" => array(
		'none' => foodbakery_var_theme_text_srt('foodbakery_var_none'),
		'capitalize' => foodbakery_var_theme_text_srt('foodbakery_var_capitalize'),
		'uppercase' => foodbakery_var_theme_text_srt('foodbakery_var_uppercase'),
		'lowercase' => foodbakery_var_theme_text_srt('foodbakery_var_lowercase'),
		'initial' => foodbakery_var_theme_text_srt('foodbakery_var_initial'),
		'inherit' => foodbakery_var_theme_text_srt('foodbakery_var_inherit')
	    ),
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_letter_spacing'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "section_title_spc",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_page_title_font'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_page_title_hint'),
	    "id" => "page_title_font",
	    "std" => "",
	    'classes' => 'chosen-select',
	    "type" => "gfont_select",
	    "options" => $foodbakery_var_fonts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute_hint'),
	    "id" => "page_title_font_att",
	    "std" => "",
	    'classes' => 'chosen-select',
	    "type" => "gfont_att_select",
	    "options" => $foodbakery_var_fonts_atts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_size'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "page_title_size",
	    "min" => '6',
	    "max" => '50',
	    "std" => "20",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_line_height'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "page_title_lh",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_text_transform'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "page_title_textr",
	    "std" => "none",
	    'classes' => 'chosen-select',
	    "type" => "select_ftext",
	    "options" => array(
		'none' => foodbakery_var_theme_text_srt('foodbakery_var_none'),
		'capitalize' => foodbakery_var_theme_text_srt('foodbakery_var_capitalize'),
		'uppercase' => foodbakery_var_theme_text_srt('foodbakery_var_uppercase'),
		'lowercase' => foodbakery_var_theme_text_srt('foodbakery_var_lowercase'),
		'initial' => foodbakery_var_theme_text_srt('foodbakery_var_initial'),
		'inherit' => foodbakery_var_theme_text_srt('foodbakery_var_inherit')
	    ),
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_letter_spacing'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "page_title_spc",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_post_title_font'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_post_title_hint'),
	    "id" => "post_title_font",
	    "std" => "",
	    'classes' => 'chosen-select',
	    "type" => "gfont_select",
	    "options" => $foodbakery_var_fonts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute_hint'),
	    "id" => "post_title_font_att",
	    "std" => "",
	    'classes' => 'chosen-select',
	    "type" => "gfont_att_select",
	    "options" => $foodbakery_var_fonts_atts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_size'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "post_title_size",
	    "min" => '6',
	    "max" => '50',
	    "std" => "20",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_line_height'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "post_title_lh",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_text_transform'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "post_title_textr",
	    "std" => "none",
	    'classes' => 'chosen-select',
	    "type" => "select_ftext",
	    "options" => array(
		'none' => foodbakery_var_theme_text_srt('foodbakery_var_none'),
		'capitalize' => foodbakery_var_theme_text_srt('foodbakery_var_capitalize'),
		'uppercase' => foodbakery_var_theme_text_srt('foodbakery_var_uppercase'),
		'lowercase' => foodbakery_var_theme_text_srt('foodbakery_var_lowercase'),
		'initial' => foodbakery_var_theme_text_srt('foodbakery_var_initial'),
		'inherit' => foodbakery_var_theme_text_srt('foodbakery_var_inherit')
	    ),
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_letter_spacing'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "post_title_spc",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_sidebar_widget_font'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_sidebar_widget_font_hint'),
	    "id" => "widget_heading_font",
	    "std" => "",
	    'classes' => 'chosen-select',
	    "type" => "gfont_select",
	    "options" => $foodbakery_var_fonts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute_hint'),
	    "id" => "widget_heading_font_att",
	    "std" => "",
	    'classes' => 'chosen-select',
	    "type" => "gfont_att_select",
	    "options" => $foodbakery_var_fonts_atts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_size'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "widget_heading_size",
	    "min" => '6',
	    "max" => '50',
	    "std" => "18",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_line_height'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "widget_heading_lh",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_text_transform'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "widget_heading_textr",
	    "std" => "none",
	    'classes' => 'chosen-select',
	    "type" => "select_ftext",
	    "options" => array(
		'none' => foodbakery_var_theme_text_srt('foodbakery_var_none'),
		'capitalize' => foodbakery_var_theme_text_srt('foodbakery_var_capitalize'),
		'uppercase' => foodbakery_var_theme_text_srt('foodbakery_var_uppercase'),
		'lowercase' => foodbakery_var_theme_text_srt('foodbakery_var_lowercase'),
		'initial' => foodbakery_var_theme_text_srt('foodbakery_var_initial'),
		'inherit' => foodbakery_var_theme_text_srt('foodbakery_var_inherit')
	    ),
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_letter_spacing'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "widget_heading_spc",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);

	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_footer_widget_font'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_footer_widget_font_hint'),
	    "id" => "ft_widget_heading_font",
	    "std" => "",
	    'classes' => 'chosen-select',
	    "type" => "gfont_select",
	    "options" => $foodbakery_var_fonts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_font_attribute_hint'),
	    "id" => "ft_widget_heading_font_att",
	    "std" => "",
	    'classes' => 'chosen-select',
	    "type" => "gfont_att_select",
	    "options" => $foodbakery_var_fonts_atts
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_size'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "ft_widget_heading_size",
	    "min" => '6',
	    "max" => '50',
	    "std" => "18",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_line_height'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "ft_widget_heading_lh",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_text_transform'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "ft_widget_heading_textr",
	    "std" => "none",
	    'classes' => 'chosen-select',
	    "type" => "select_ftext",
	    "options" => array(
		'none' => foodbakery_var_theme_text_srt('foodbakery_var_none'),
		'capitalize' => foodbakery_var_theme_text_srt('foodbakery_var_capitalize'),
		'uppercase' => foodbakery_var_theme_text_srt('foodbakery_var_uppercase'),
		'lowercase' => foodbakery_var_theme_text_srt('foodbakery_var_lowercase'),
		'initial' => foodbakery_var_theme_text_srt('foodbakery_var_initial'),
		'inherit' => foodbakery_var_theme_text_srt('foodbakery_var_inherit')
	    ),
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_letter_spacing'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "ft_widget_heading_spc",
	    "min" => '6',
	    "max" => '50',
	    "std" => "13",
	    "type" => "range_font",
	);
	/* social icons setting */
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_social_icons'),
	    "id" => "tab-social-setting",
	    "type" => "sub-heading"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_social_network'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "social_network",
	    "std" => "",
	    "type" => "networks",
	    "options" => $social_network
	);
	// social Network setting 
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_social_sharing'),
	    "id" => "tab-social-network",
	    "type" => "sub-heading"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_fb'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "facebook_share",
	    "std" => "on",
	    "type" => "checkbox"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_twitter'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "twitter_share",
	    "std" => "on",
	    "type" => "checkbox"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_g_plus'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "google_plus_share",
	    "std" => "off",
	    "type" => "checkbox"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_tumblr'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "tumblr_share",
	    "std" => "on",
	    "type" => "checkbox"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_dribbble'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "dribbble_share",
	    "std" => "on",
	    "type" => "checkbox"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_stumbleupon'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "stumbleupon_share",
	    "std" => "on",
	    "type" => "checkbox"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_share_more'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "share_share",
	    "std" => "on",
	    "type" => "checkbox"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_sidebar'),
	    "id" => "tab-sidebar",
	    "type" => "sub-heading"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_sidebar'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_sidebar_hint'),
	    "id" => "sidebar",
	    "std" => $foodbakery_var_sidebar,
	    "type" => "sidebar",
	    "options" => $foodbakery_var_sidebar
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_default_pages'),
	    "id" => "default_pages",
	    "std" => foodbakery_var_theme_text_srt('foodbakery_var_default_pages_sidebar'),
	    "type" => "section",
	    "options" => ""
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_default_pages_layout'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_default_pages_layout_hint'),
	    "id" => "default_page_layout",
	    "std" => "sidebar_right",
	    "type" => "layout",
	    "options" => array(
		"sidebar_left" => foodbakery_var_theme_text_srt('foodbakery_var_sidebar_left'),
		"sidebar_right" => foodbakery_var_theme_text_srt('foodbakery_var_sidebar_right'),
		"no_sidebar" => foodbakery_var_theme_text_srt('foodbakery_var_full_width'),
	    )
	);
        
        $foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_default_page_margin'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "page_margin",
	    "std" => "on",
	    "type" => "checkbox"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_sidebar'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_default_pages_sidebar_hint'),
	    "id" => "default_layout_sidebar",
	    "std" => "",
	    "type" => "select_sidebar",
	    "options" => $foodbakery_var_sidebar
	);
	if (class_exists('WooCommerce')) {

	    $foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_wc_archive_sidebar'),
		"id" => "woo_archive_pages",
		"std" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_wc_archive_sidebar'),
		"type" => "section",
		"options" => ""
	    );
	    $foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_layout'),
		"desc" => "",
		"hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_wc_archive_sidebar_discription'),
		"id" => "woo_archive_layout",
		"std" => "sidebar_right",
		"type" => "layout",
		"options" => array(
		    "sidebar_left" => foodbakery_var_theme_text_srt('foodbakery_var_sidebar_left'),
		    "sidebar_right" => foodbakery_var_theme_text_srt('foodbakery_var_sidebar_right'),
		    "no_sidebar" => foodbakery_var_theme_text_srt('foodbakery_var_full_width'),
		)
	    );
	    $foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_sidebar'),
		"desc" => "",
		"hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_wc_archive_sidebar_hint'),
		"id" => "woo_archive_sidebar",
		"std" => "",
		"type" => "select_sidebar",
		"options" => $foodbakery_var_sidebar
	    );
	}
	// Footer sidebar tab 
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_footer_sidebar'),
	    "id" => "tab-footer-sidebar",
	    "type" => "sub-heading"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_footer_sidebar'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_sidebar_hint'),
	    "id" => "foodbakery_footer_sidebar",
	    "std" => $foodbakery_var_footer_sidebar,
	    "type" => "foodbakery_var_footer_sidebar",
	    "options" => $foodbakery_var_footer_sidebar
	);
	//Mailchimp List
        $mail_chimp_list = array();
	$mail_chimp_list[] = '';
	if (isset($foodbakery_var_options['foodbakery_var_mailchimp_key'])) {
	    $mailchimp_option = $foodbakery_var_options['foodbakery_var_mailchimp_key'];
	    if ($mailchimp_option <> '') {

		if (function_exists('foodbakery_mailchimp_list')) {
		    $mc_list = foodbakery_mailchimp_list($mailchimp_option);

		    if (is_array($mc_list) && isset($mc_list['data'])) {
			foreach ($mc_list['data'] as $list) {
			    $mail_chimp_list[$list['id']] = $list['name'];
			}
		    }
		}
	    }
	}
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_api_setting'),
	    "id" => "tab-api-setting",
	    "type" => "sub-heading"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_mailchimp_key'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_mailchimp_key_hint'),
	    "id" => "mailchimp_key",
	    "std" => "",
	    "type" => "text");
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_mailchimp_list'),
	    "desc" => "",
	    "hint_text" => "",
	    "id" => "mailchimp_list",
	    "std" => "on",
	    "type" => "mailchimp",
	    "classes" => 'chosen-select',
	    "options" => $mail_chimp_list
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_flickr_api_setting'),
	    "id" => "flickr_api_setting",
	    "std" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_flickr_api_setting'),
	    "type" => "section",
	    "options" => ""
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_flickr_key'),
	    "desc" => "",
	    "hint_text" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_flickr_key_hint'),
	    "id" => "flickr_key",
	    "std" => "",
	    "type" => "text");
	
	/*
	 *  Twitter API Settings
	 */
	include_once ABSPATH . 'wp-admin/includes/plugin.php';
	if(!class_exists('wp_foodbakery')){
	
	$foodbakery_var_settings[] = array( "name" => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_api_setting' ),
            "id" => "Twitter",
            "std" => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_api_setting' ),
            "type" => "section",
            "options" => ""
        );
        $foodbakery_var_settings[] = array(
            "name" => foodbakery_var_theme_text_srt( 'foodbakery_var_twitter' ),
            "desc" => "",
            "hint_text" => foodbakery_var_theme_text_srt( 'foodbakery_var_twitter_hint' ),
            "id" => "twitter_api_switch",
            "std" => "on",
            "type" => "checkbox",
            "options" => $on_off_option
        );
        $foodbakery_var_settings[] = array( "name" => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_consumer_key' ),
            "desc" => "",
            "hint_text" => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_consumer_key_hint' ),
            "id" => "consumer_key",
            "std" => "",
            "type" => "text" );
        $foodbakery_var_settings[] = array( "name" => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_cache_time_limit' ),
            "desc" => "",
            "hint_text" => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_cache_time_limit_hint' ),
            "id" => "cache_limit_time",
            "std" => "",
            "type" => "text" );

        $foodbakery_var_settings[] = array( "name" => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_num' ),
            "desc" => "",
            "hint_text" => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_num_hint' ),
            "id" => "tweet_num_post",
            "std" => "",
            "type" => "text" );

        $foodbakery_var_settings[] = array( "name" => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_date_time_formate' ),
            "desc" => "",
            "hint_text" => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_date_time_formate_hint' ),
            "id" => "twitter_datetime_formate",
            "std" => "",
            'classes' => 'chosen-select-no-single',
            "type" => "select",
            "options" => array(
                'default' => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_date_time_formate_1' ),
                'eng_suff' => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_date_time_formate_2' ),
                'ddmm' => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_date_time_formate_3' ),
                'ddmmyy' => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_date_time_formate_4' ),
                'full_date' => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_date_time_formate_5' ),
                'time_since' => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_date_time_formate_6' ),
            )
        );
        $foodbakery_var_settings[] = array( "name" => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_consumer_secret' ),
            "desc" => "",
            "hint_text" => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_consumer_secret_hint' ),
            "id" => "consumer_secret",
            "std" => "",
            "type" => "text" );
        $foodbakery_var_settings[] = array( "name" => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_access_token' ),
            "desc" => "",
            "hint_text" => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_access_token_hint' ),
            "id" => "access_token",
            "std" => "",
            "type" => "text" );
        $foodbakery_var_settings[] = array( "name" => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_access_token_secret' ),
            "desc" => "",
            "hint_text" => foodbakery_var_theme_text_srt( 'foodbakery_var_theme_option_twitter_access_token_secret_hint' ),
            "id" => "access_token_secret",
            "std" => "",
            "type" => "text" );
	
    }
	   
	
	
	
	/*
	 * End twitter Api settings
	 */
	
	$foodbakery_var_settings[] = array("col_heading" => foodbakery_var_theme_text_srt('foodbakery_var_api_setting'),
	    "type" => "col-right-text",
	    "help_text" => ""
	);

	/*  Automatic Updater */
	$foodbakery_var_settings[] = array("name" => esc_html__("Auto Update", 'foodbakery'),
	    "fontawesome" => 'icon-tasks',
	    "id" => "tab-auto-updater",
	    "std" => "",
	    "type" => "main-heading",
	    "options" => ""
	);
	$foodbakery_var_settings[] = array("name" => esc_html__("Auto Update Theme", 'foodbakery'),
	    "id" => "tab-auto-updater",
	    "type" => "sub-heading"
	);
	$foodbakery_var_settings[] = array("name" => esc_html__("Automatic Upgrade", 'foodbakery'),
	    "desc" => "",
	    "hint_text" => esc_html__("", 'foodbakery'),
	    "id" => "cs_backup_options",
	    "std" => "",
	    "type" => "automatic_upgrade"
	);
	$foodbakery_var_settings[] = array("name" => esc_html__("Marketplace Username", 'foodbakery'),
	    "desc" => "",
	    "hint_text" => esc_html__("Enter your Marketplace Username.", 'foodbakery'),
	    "id" => "cs_marketplace_username",
	    "std" => "",
	    "type" => "text");
	$foodbakery_var_settings[] = array("name" => esc_html__("Secret API Key", 'foodbakery'),
	    "desc" => "",
	    "hint_text" => esc_html__("Enter your Secret API key.", 'foodbakery'),
	    "id" => "cs_secret_api_key",
	    "std" => "",
	    "type" => "text");
	$foodbakery_var_settings[] = array("name" => esc_html__("Skip Theme Backup", 'foodbakery'),
	    "desc" => "",
	    "hint_text" => esc_html__("Do you want to skip theme backup?", 'foodbakery'),
	    "id" => "cs_skip_theme_backup",
	    "std" => "on",
	    "type" => "checkbox",
	);
	$foodbakery_var_settings[] = array("col_heading" => '',
	    "type" => "col-right-text",
	    "help_text" => ''
	);

	/* Import & Export */
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_import_export'),
	    "fontawesome" => 'icon-database',
	    "id" => "tab-import-export-options",
	    "std" => "",
	    "type" => "main-heading",
	    "options" => ""
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_import_export'),
	    "id" => "tab-import-export-options",
	    "type" => "sub-heading"
	);

	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_backup_option'),
	    "std" => foodbakery_var_theme_text_srt('foodbakery_var_theme_backup_option'),
	    "id" => "theme-bakups-options",
	    "type" => "section"
	);
	$foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_theme_option_backup'),
	    "desc" => "",
	    "hint_text" => '',
	    "id" => "foodbakery_backup_options",
	    "std" => "",
	    "type" => "generate_backup"
	);

	if (class_exists('foodbakery_var_widget_data')) {

	    $foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_widgets_backup_options'),
		"std" => foodbakery_var_theme_text_srt('foodbakery_var_widgets_backup_options'),
		"id" => "widgets-bakups-options",
		"type" => "section"
	    );

	    $foodbakery_var_settings[] = array("name" => foodbakery_var_theme_text_srt('foodbakery_var_widgets_backup'),
		"desc" => "",
		"hint_text" => '',
		"id" => "foodbakery_widgets_backup",
		"std" => "",
		"type" => "widgets_backup"
	    );
	}
        $foodbakery_var_settings = apply_filters( 'foodbakery_maintenance_options', $foodbakery_var_settings );
	$foodbakery_var_settings[] = array(
	    "id" => "theme_option_save_flag",
	    "std" => md5(uniqid(rand(), true)),
	    "type" => "hidden_field"
	);
        
    }

}