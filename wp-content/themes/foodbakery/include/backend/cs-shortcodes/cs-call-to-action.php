<?php
/*
 *
 * @File : Call to action
 * @retrun
 *
 */

if (!function_exists('foodbakery_var_page_builder_call_to_action')) {

    function foodbakery_var_page_builder_call_to_action($die = 0) {

	global $post, $foodbakery_node, $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;

	$shortcode_element = '';
	$filter_element = 'filterdrag';
	$shortcode_view = '';
	$output = array();
	$FOODBAKERY_BARBER_PREFIX = 'call_to_action';
	$foodbakery_counter = isset($_POST['counter']) ? $_POST['counter'] : '';
	$parseObject = new ShortcodeParse();
	if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
	    $FOODBAKERY_POSTID = '';
	    $shortcode_element_id = '';
	} else {
	    $FOODBAKERY_POSTID = $_POST['POSTID'];
	    $shortcode_element_id = $_POST['shortcode_element_id'];
	    $foodbakery_var_shortcode_str = stripslashes($shortcode_element_id);
	    $output = $parseObject->foodbakery_shortcodes($output, $foodbakery_var_shortcode_str, true, $FOODBAKERY_BARBER_PREFIX);
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
	    'foodbakery_var_button_bg_color' => '',
	    'foodbakery_var_call_to_icon' => '',
	    'foodbakery_var_call_to_view' => '',
	);
	if (isset($output['0']['atts'])) {
	    $atts = $output['0']['atts'];
	} else {
	    $atts = array();
	}
	if (isset($output['0']['content']))
	    $atts_content = $output['0']['content'];
	else
	    $atts_content = "";
	$call_to_action_element_size = '100';
	foreach ($defaults as $key => $values) {
	    if (isset($atts[$key])) {
		$$key = $atts[$key];
	    } else {
		$$key = $values;
	    }
	}

	$name = 'foodbakery_var_page_builder_call_to_action';
	$coloumn_class = 'column_' . $call_to_action_element_size;

	$foodbakery_var_call_to_action_title = isset($foodbakery_var_call_to_action_title) ? $foodbakery_var_call_to_action_title : '';
	$foodbakery_var_call_action_subtitle = isset($foodbakery_var_call_action_subtitle) ? $foodbakery_var_call_action_subtitle : '';
	$foodbakery_var_heading_color = isset($foodbakery_var_heading_color) ? $foodbakery_var_heading_color : '';
	$foodbakery_var_call_to_action_icon_background_color = isset($foodbakery_var_call_to_action_icon_background_color) ? $foodbakery_var_call_to_action_icon_background_color : '';
	$foodbakery_var_call_to_action_button_text = isset($foodbakery_var_call_to_action_button_text) ? $foodbakery_var_call_to_action_button_text : '';
	$foodbakery_var_call_to_action_button_link = isset($foodbakery_var_call_to_action_button_link) ? $foodbakery_var_call_to_action_button_link : '';
	$foodbakery_var_contents_bg_color = isset($foodbakery_var_contents_bg_color) ? $foodbakery_var_contents_bg_color : '';
	$foodbakery_var_call_to_action_img_array = isset($foodbakery_var_call_to_action_img_array) ? $foodbakery_var_call_to_action_img_array : '';
	$foodbakery_var_call_action_text_align = isset($foodbakery_var_call_action_text_align) ? $foodbakery_var_call_action_text_align : '';
	$foodbakery_var_call_action_img_align = isset($foodbakery_var_call_action_img_align) ? $foodbakery_var_call_action_img_align : '';
	$foodbakery_var_button_bg_color = isset($foodbakery_var_button_bg_color) ? $foodbakery_var_button_bg_color : '';
	$foodbakery_var_button_border_color = isset($foodbakery_var_button_border_color) ? $foodbakery_var_button_border_color : '';
	$foodbakery_var_call_to_align = isset($foodbakery_var_call_to_align) ? $foodbakery_var_call_to_align : '';

	if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
	    $shortcode_element = 'shortcode_element_class';
	    $shortcode_view = 'cs-pbwp-shortcode';
	    $filter_element = 'ajax-drag';
	    $coloumn_class = '';
	}
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_short_code_strings();
	?>
	<div id="<?php echo esc_attr($name . $foodbakery_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?>
	     <?php echo esc_attr($shortcode_view); ?>" item="call_to_action" data="<?php echo foodbakery_element_size_data_array_index($call_to_action_element_size) ?>" >
		 <?php foodbakery_element_setting($name, $foodbakery_counter, $call_to_action_element_size) ?>
	    <div class="cs-wrapp-class-<?php echo intval($foodbakery_counter) ?>
		 <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $foodbakery_counter) ?>" data-shortcode-template="[call_to_action {{attributes}}]{{content}}[/call_to_action]" style="display: none;">
		<div class="cs-heading-area" data-counter="<?php echo esc_attr($foodbakery_counter) ?>">
		    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_call_to_action_edit')); ?></h5>
		    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo esc_js($name . $foodbakery_counter) ?>','<?php echo esc_js($filter_element); ?>')" class="cs-btnclose">
			<i class="icon-times"></i>
		    </a>
		</div> 
		<div class="cs-pbwp-content">
		    <div class="cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content">
			<?php
			if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
			    foodbakery_shortcode_element_size();
			}

			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_element_title'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_element_title_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => foodbakery_allow_special_char($foodbakery_var_call_to_action_title),
				'cust_id' => '',
				'classes' => 'txtfield',
				'cust_name' => 'foodbakery_var_call_to_action_title[]',
				'return' => true,
			    ),
			);

			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_title'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_title_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => foodbakery_allow_special_char($foodbakery_var_call_action_subtitle),
				'cust_id' => '',
				'classes' => 'txtfield',
				'cust_name' => 'foodbakery_var_call_action_subtitle[]',
				'return' => true,
			    ),
			);

			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_title_color'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_title_color_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_attr($foodbakery_var_heading_color),
				'cust_id' => '',
				'classes' => 'bg_color',
				'cust_name' => 'foodbakery_var_heading_color[]',
				'return' => true,
			    ),
			);

			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_call_to_views'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_call_to_views_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => $foodbakery_var_call_to_view,
				'id' => '',
				'cust_id' => 'foodbakery_var_call_to_view',
				'cust_name' => 'foodbakery_var_call_to_view[]',
				'classes' => 'service_postion chosen-select-no-single select-medium',
				'extra_atr' => 'onchange="javascript:foodbakery_hide_show_call_to_action(this.value)"',
				'options' => array(
				    'fancy' => foodbakery_var_theme_text_srt('foodbakery_var_call_to_view_fancy'),
				    'simple' => foodbakery_var_theme_text_srt('foodbakery_var_call_to_view_simple'),
				),
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
			$view_style = '';
			if ($foodbakery_var_call_to_view == 'simple') {
			    $view_style = 'style="display:none;"';
			}
			?>
			<script>
			    function foodbakery_hide_show_call_to_action(view) {
				if (view == 'fancy') {
				    jQuery('.view-hide-show').show();
				} else {
				    jQuery('.view-hide-show').hide();
				}
			    }
			</script>
			<div class="view-hide-show" <?php echo foodbakery_allow_special_char($view_style); ?>>
			    <div class="form-elements">
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				    <label><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_multiple_counter_icon')); ?></label>
				    <?php
				    if (function_exists('foodbakery_var_tooltip_helptext')) {
					echo foodbakery_var_tooltip_helptext(foodbakery_var_theme_text_srt('foodbakery_var_multiple_counter_icon_tooltip'));
				    }
				    ?>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				    <?php echo foodbakery_var_icomoon_icons_box(esc_attr($foodbakery_var_call_to_icon), $rand_string, 'foodbakery_var_call_to_icon'); ?>
				</div>
			    </div>
			</div>	    
			<?php
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_short_description'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_short_description_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_textarea($atts_content),
				'cust_id' => 'atts_content' . $foodbakery_counter,
				'classes' => '',
				'cust_name' => 'atts_content[]',
				'return' => true,
				'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
				'foodbakery_editor' => true,
			    ),
			);

			$foodbakery_var_html_fields->foodbakery_var_textarea_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_button_text'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_button_text_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_attr($foodbakery_var_call_to_action_button_text),
				'cust_id' => '',
				'classes' => '',
				'cust_name' => 'foodbakery_var_call_to_action_button_text[]',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_button_color'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_button_color_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_attr($foodbakery_var_call_to_action_icon_background_color),
				'cust_id' => '',
				'classes' => 'bg_color',
				'cust_name' => 'foodbakery_var_call_to_action_icon_background_color[]',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);	
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_button_link'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_button_link_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_attr($foodbakery_var_call_to_action_button_link),
				'cust_id' => '',
				'classes' => '',
				'cust_name' => 'foodbakery_var_call_to_action_button_link[]',
				'return' => true,
			    ),
			);

			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_call_to_action_button_bg'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_call_to_action_button_bg_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_attr($foodbakery_var_button_bg_color),
				'cust_id' => '',
				'classes' => 'bg_color',
				'cust_name' => 'foodbakery_var_button_bg_color[]',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			
			
			
			?>

		    </div>
		    <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>

	    	    <ul class="form-elements insert-bg">
	    		<li class="to-field">
	    		    <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo str_replace('foodbakery_var_page_builder_', '', $name); ?>', '<?php echo esc_js($name . $foodbakery_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_insert')); ?></a>
	    		</li>
	    		<div id="results-shortocde"></div>
			    <?php
			} else {
			    $foodbakery_opt_array = array(
				'std' => 'call_to_action',
				'id' => '',
				'before' => '',
				'after' => '',
				'classes' => '',
				'extra_atr' => '',
				'cust_id' => 'foodbakery_orderby',
				'cust_name' => 'foodbakery_orderby[]',
				'return' => false,
				'required' => false
			    );
			    $foodbakery_var_form_fields->foodbakery_var_form_hidden_render($foodbakery_opt_array);

			    $foodbakery_opt_array = array(
				'name' => '',
				'desc' => '',
				'hint_text' => '',
				'echo' => true,
				'field_params' => array(
				    'std' => foodbakery_var_theme_text_srt('foodbakery_var_save'),
				    'cust_id' => '',
				    'cust_type' => 'button',
				    'classes' => 'cs-barber-admin-btn',
				    'cust_name' => '',
				    'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
				    'return' => true,
				),
			    );

			    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			}
			?>
		</div>
	    </div>
	</div>

	<?php
	if ($die <> 1) {
	    die();
	}
    }

    add_action('wp_ajax_foodbakery_var_page_builder_call_to_action', 'foodbakery_var_page_builder_call_to_action');
}

if (!function_exists('foodbakery_save_page_builder_data_call_to_action_callback')) {

    /**
     * Save data for call to action shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_call_to_action_callback($args) {

	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	if ($widget_type == "call_to_action" || $widget_type == "cs_call_to_action") {

	    $shortcode = '';

	    $page_element_size = $data['call_to_action_element_size'][$counters['foodbakery_global_counter_call_to_action']];
	    $cta_element_size = $data['call_to_action_element_size'][$counters['foodbakery_global_counter_call_to_action']];

	    if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes(( $data['shortcode']['call_to_action'][$counters['foodbakery_shortcode_counter_call_to_action']]));

		$element_settings = 'call_to_action_element_size="' . $cta_element_size . '"';
		$reg = '/call_to_action_element_size="(\d+)"/s';
		$shortcode_str = preg_replace($reg, $element_settings, $shortcode_str);
		$shortcode_data .= $shortcode_str;

		$counters['foodbakery_shortcode_counter_call_to_action'] ++;
	    } else {
		$shortcode = '[call_to_action call_to_action_element_size="' . htmlspecialchars($data['call_to_action_element_size'][$counters['foodbakery_global_counter_call_to_action']]) . '" ';
		if (isset($data['foodbakery_var_call_to_action_title'][$counters['foodbakery_counter_call_to_action']]) && $data['foodbakery_var_call_to_action_title'][$counters['foodbakery_counter_call_to_action']] != '') {
		    $shortcode .= 'foodbakery_var_call_to_action_title="' . stripslashes(htmlspecialchars(($data['foodbakery_var_call_to_action_title'][$counters['foodbakery_counter_call_to_action']]), ENT_QUOTES)) . '" ';
		}
		if (isset($data['foodbakery_var_call_action_subtitle'][$counters['foodbakery_counter_call_to_action']]) && $data['foodbakery_var_call_action_subtitle'][$counters['foodbakery_counter_call_to_action']] != '') {
		    $shortcode .= 'foodbakery_var_call_action_subtitle="' . stripslashes(htmlspecialchars(($data['foodbakery_var_call_action_subtitle'][$counters['foodbakery_counter_call_to_action']]), ENT_QUOTES)) . '" ';
		}
		if (isset($data['foodbakery_var_call_to_icon'][$counters['foodbakery_counter_call_to_action']]) && $data['foodbakery_var_call_to_icon'][$counters['foodbakery_counter_call_to_action']] != '') {
		    $shortcode .= 'foodbakery_var_call_to_icon="' . stripslashes(htmlspecialchars(($data['foodbakery_var_call_to_icon'][$counters['foodbakery_counter_call_to_action']]), ENT_QUOTES)) . '" ';
		}
		if (isset($data['foodbakery_var_call_to_view'][$counters['foodbakery_counter_call_to_action']]) && $data['foodbakery_var_call_to_view'][$counters['foodbakery_counter_call_to_action']] != '') {
		    $shortcode .= 'foodbakery_var_call_to_view="' . stripslashes(htmlspecialchars(($data['foodbakery_var_call_to_view'][$counters['foodbakery_counter_call_to_action']]), ENT_QUOTES)) . '" ';
		}
		if (isset($data['foodbakery_var_button_bg_color'][$counters['foodbakery_counter_call_to_action']]) && $data['foodbakery_var_button_bg_color'][$counters['foodbakery_counter_call_to_action']] != '') {
		    $shortcode .= 'foodbakery_var_button_bg_color="' . htmlspecialchars($data['foodbakery_var_button_bg_color'][$counters['foodbakery_counter_call_to_action']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_heading_color'][$counters['foodbakery_counter_call_to_action']]) && $data['foodbakery_var_heading_color'][$counters['foodbakery_counter_call_to_action']] != '') {
		    $shortcode .= 'foodbakery_var_heading_color="' . stripslashes(htmlspecialchars(($data['foodbakery_var_heading_color'][$counters['foodbakery_counter_call_to_action']]), ENT_QUOTES)) . '" ';
		}
		if (isset($data['foodbakery_var_call_to_action_icon_background_color'][$counters['foodbakery_counter_call_to_action']]) && $data['foodbakery_var_call_to_action_icon_background_color'][$counters['foodbakery_counter_call_to_action']] != '') {
		    $shortcode .= 'foodbakery_var_call_to_action_icon_background_color="' . stripslashes(htmlspecialchars(($data['foodbakery_var_call_to_action_icon_background_color'][$counters['foodbakery_counter_call_to_action']]), ENT_QUOTES)) . '" ';
		}
		if (isset($data['foodbakery_var_call_to_action_button_text'][$counters['foodbakery_counter_call_to_action']]) && $data['foodbakery_var_call_to_action_button_text'][$counters['foodbakery_counter_call_to_action']] != '') {
		    $shortcode .= 'foodbakery_var_call_to_action_button_text="' . stripslashes(htmlspecialchars(($data['foodbakery_var_call_to_action_button_text'][$counters['foodbakery_counter_call_to_action']]), ENT_QUOTES)) . '" ';
		}
		if (isset($data['foodbakery_var_call_to_action_button_link'][$counters['foodbakery_counter_call_to_action']]) && $data['foodbakery_var_call_to_action_button_link'][$counters['foodbakery_counter_call_to_action']] != '') {
		    $shortcode .= 'foodbakery_var_call_to_action_button_link="' . stripslashes(htmlspecialchars(($data['foodbakery_var_call_to_action_button_link'][$counters['foodbakery_counter_call_to_action']]), ENT_QUOTES)) . '" ';
		}
		if (isset($data['foodbakery_var_contents_bg_color'][$counters['foodbakery_counter_call_to_action']]) && $data['foodbakery_var_contents_bg_color'][$counters['foodbakery_counter_call_to_action']] != '') {
		    $shortcode .= 'foodbakery_var_contents_bg_color="' . stripslashes(htmlspecialchars(($data['foodbakery_var_contents_bg_color'][$counters['foodbakery_counter_call_to_action']]), ENT_QUOTES)) . '" ';
		}
		$shortcode .= '] ';
		if (isset($data['atts_content'][$counters['foodbakery_counter_call_to_action']]) && $data['atts_content'][$counters['foodbakery_counter_call_to_action']] != '') {
		    $shortcode .= htmlspecialchars($data['atts_content'][$counters['foodbakery_counter_call_to_action']], ENT_QUOTES) . ' ';
		}
		$shortcode .= '[/call_to_action]';
		$shortcode_data .= $shortcode;
		$counters['foodbakery_counter_call_to_action'] ++;
	    }
	    $counters['foodbakery_global_counter_call_to_action'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_call_to_action', 'foodbakery_save_page_builder_data_call_to_action_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_call_to_action_callback')) {

    /**
     * Populate call to action shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_call_to_action_callback($counters) {
	$counters['foodbakery_counter_call_to_action'] = 0;
	$counters['foodbakery_shortcode_counter_call_to_action'] = 0;
	$counters['foodbakery_global_counter_call_to_action'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_call_to_action_callback');
}
if (!function_exists('foodbakery_shortcode_names_list_populate_call_to_action_callback')) {

    /**
     * Populate call_to_action shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_call_to_action_callback($shortcode_array) {
	$shortcode_array['call_to_action'] = array(
	    'title' => foodbakery_var_frame_text_srt('foodbakery_var_call_action'),
	    'name' => 'call_to_action',
	    'icon' => 'fa icon-info-circle',
	    'categories' => 'typography',
	);
	return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_call_to_action_callback');
}

if (!function_exists('foodbakery_element_list_populate_call_to_action_callback')) {

    /**
     * Populate call_to_action shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_call_to_action_callback($element_list) {
	$element_list['call_to_action'] = foodbakery_var_frame_text_srt('foodbakery_var_call_action');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_call_to_action_callback');
}