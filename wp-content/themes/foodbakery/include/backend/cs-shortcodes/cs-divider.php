<?php
/**
 * @Divider html form for page builder
 */
if (!function_exists('foodbakery_var_page_builder_divider')) {

    function foodbakery_var_page_builder_divider($die = 0) {
	global $foodbakery_node, $count_node, $post, $foodbakery_var_html_fields, $foodbakery_var_form_fields;
	$shortcode_element = '';
	$filter_element = 'filterdrag';
	$shortcode_view = '';
	$output = array();
	$foodbakery_counter = $_POST['counter'];
	if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
	    $POSTID = '';
	    $shortcode_element_id = '';
	} else {
	    $POSTID = $_POST['POSTID'];
	    $shortcode_element_id = $_POST['shortcode_element_id'];
	    $shortcode_str = stripslashes($shortcode_element_id);
	    $FOODBAKERY_PREFIX = 'foodbakery_divider';
	    $parseObject = new ShortcodeParse();
	    $output = $parseObject->foodbakery_shortcodes($output, $shortcode_str, true, $FOODBAKERY_PREFIX);
	}
	$defaults = array(
	    'foodbakery_var_divider_padding_left' => '0',
	    'foodbakery_var_divider_padding_right' => '0',
	    'foodbakery_var_divider_margin_top' => '0',
	    'foodbakery_var_divider_margin_buttom' => '0',
	    'foodbakery_var_divider_align' => '',
	    'foodbakery_var_divider_style' => '',
	);
	if (isset($output['0']['atts'])) {
	    $atts = $output['0']['atts'];
	} else {
	    $atts = array();
	}
	$divider_element_size = '100';
	foreach ($defaults as $key => $values) {
	    if (isset($atts[$key])) {
		$$key = $atts[$key];
	    } else {
		$$key = $values;
	    }
	}
	$name = 'foodbakery_var_page_builder_divider';
	$coloumn_class = 'column_' . $divider_element_size;
	$foodbakery_var_divider_padding_left = isset($foodbakery_var_divider_padding_left) ? $foodbakery_var_divider_padding_left : '';
	$foodbakery_var_divider_padding_right = isset($foodbakery_var_divider_padding_right) ? $foodbakery_var_divider_padding_right : '';
	$foodbakery_var_divider_margin_top = isset($foodbakery_var_divider_margin_top) ? $foodbakery_var_divider_margin_top : '';
	$foodbakery_var_divider_margin_buttom = isset($foodbakery_var_divider_margin_buttom) ? $foodbakery_var_divider_margin_buttom : '';
	$foodbakery_var_divider_align = isset($foodbakery_var_divider_align) ? $foodbakery_var_divider_align : '';
	$foodbakery_var_divider_style = isset($foodbakery_var_divider_style) ? $foodbakery_var_divider_style : '';

	if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
	    $shortcode_element = 'shortcode_element_class';
	    $shortcode_view = 'cs-pbwp-shortcode';
	    $filter_element = 'ajax-drag';
	    $coloumn_class = '';
	}
	global $foodbakery_var_static_text;
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_short_code_strings();
	?>
	<div id="<?php echo esc_attr($name . $foodbakery_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?>
	     <?php echo esc_attr($shortcode_view); ?>" item="divider" data="<?php echo foodbakery_element_size_data_array_index($divider_element_size) ?>" >
		 <?php foodbakery_element_setting($name, $foodbakery_counter, $divider_element_size) ?>
	    <div class="cs-wrapp-class-<?php echo esc_attr($foodbakery_counter); ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $foodbakery_counter) ?>" data-shortcode-template="[foodbakery_divider {{attributes}}]{{content}}[/foodbakery_divider]" style="display: none;"">
		<div class="cs-heading-area">
		    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_divider_edit')); ?></h5>
		    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo esc_js($name . $foodbakery_counter) ?>','<?php echo esc_js($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
		<div class="cs-pbwp-content">
		    <div class="cs-wrapp-clone cs-shortcode-wrapp">

			<?php
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_divider_field_left_padding'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_divider_field_left_padding_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_html($foodbakery_var_divider_padding_left),
				'id' => 'divider_height',
				'cust_name' => 'foodbakery_var_divider_padding_left[]',
				'return' => true,
				'cs-range-input' => 'cs-range-input',
			    ),
			);

			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_divider_field_right_padding'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_divider_field_right_padding_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_html($foodbakery_var_divider_padding_right),
				'id' => 'divider_height',
				'cust_name' => 'foodbakery_var_divider_padding_right[]',
				'return' => true,
				'cs-range-input' => 'cs-range-input',
			    ),
			);

			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_divider_field_top_margin'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_divider_field_top_margin_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_html($foodbakery_var_divider_margin_top),
				'id' => 'divider_height',
				'cust_name' => 'foodbakery_var_divider_margin_top[]',
				'return' => true,
				'cs-range-input' => 'cs-range-input',
			    ),
			);

			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_divider_field_bottom_margin'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_divider_field_bottom_margin_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_html($foodbakery_var_divider_margin_buttom),
				'id' => 'divider_height',
				'cust_name' => 'foodbakery_var_divider_margin_buttom[]',
				'return' => true,
				'cs-range-input' => 'cs-range-input',
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_divider_field_align'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_divider_field_align_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => $foodbakery_var_divider_align,
				'id' => '',
				'cust_name' => 'foodbakery_var_divider_align[]',
				'classes' => 'dropdown chosen-select',
				'options' => array(
				    'center' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_center'),
				    'left' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_left'),
				    'right' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_right'),
				),
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
			// Divider Style
			$foodbakery_opt_array = array(
			    'name' => esc_html__("Divider View", 'foodbakery'),
			    'desc' => '',
			    'hint_text' => esc_html__("Choose Divider View", 'foodbakery'),
			    'echo' => true,
			    'field_params' => array(
				'std' => $foodbakery_var_divider_style,
				'id' => '',
				'cust_id' => '',
				'cust_name' => 'foodbakery_var_divider_style[]',
				'classes' => 'dropdown chosen-select-no-single select-medium',
				'options' => array(
				    'simple' => esc_html__("Simple", 'foodbakery'),
				    'fancy' => esc_html__("Fancy", 'foodbakery'),
				    'modern_new' => esc_html__("Modern", 'foodbakery'),

				),
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
			?>

		    </div>
	<?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
	    	    <ul class="form-elements insert-bg">
	    		<li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo esc_js(str_replace('foodbakery_var_page_builder_', '', $name)); ?>', '<?php echo esc_js($name . $foodbakery_counter); ?>', '<?php echo esc_js($filter_element); ?>')" ><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_insert')); ?></a> </li>
	    	    </ul>
	    	    <div id="results-shortocde"></div>
	    <?php
	} else {
	    $foodbakery_opt_array = array(
		'std' => 'divider',
		'id' => '',
		'before' => '',
		'after' => '',
		'classes' => '',
		'extra_atr' => '',
		'cust_id' => '',
		'cust_name' => 'foodbakery_orderby[]',
		'return' => false,
		'required' => false
	    );
	    $foodbakery_var_html_fields->foodbakery_var_form_hidden_render($foodbakery_opt_array);

	    $foodbakery_opt_array = array(
		'name' => '',
		'desc' => '',
		'hint_text' => '',
		'echo' => true,
		'field_params' => array(
		    'std' => foodbakery_var_theme_text_srt('foodbakery_var_save'),
		    'cust_id' => '',
		    'cust_type' => 'button',
		    'classes' => 'cs-foodbakery-admin-btn',
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

    add_action('wp_ajax_foodbakery_var_page_builder_divider', 'foodbakery_var_page_builder_divider');
}

if (!function_exists('foodbakery_save_page_builder_data_divider_callback')) {

    /**
     * Save data for divider shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_divider_callback($args) {
	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	if ($widget_type == "divider" || $widget_type == "cs_divider") {
	    $shortcode = '';
	    $page_element_size = $data['divider_element_size'][$counters['foodbakery_global_counter_divider']];
	    $divider_element_size = $data['divider_element_size'][$counters['foodbakery_global_counter_divider']];

	    if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes(( $data['shortcode']['divider'][$counters['foodbakery_shortcode_counter_divider']]));

		$element_settings = 'divider_element_size="' . $divider_element_size . '"';
		$reg = '/divider_element_size="(\d+)"/s';
		$shortcode_str = preg_replace($reg, $element_settings, $shortcode_str);
		$shortcode_data .= $shortcode_str;
		$counters['foodbakery_shortcode_counter_divider'] ++;
	    } else {
		$shortcode = '[foodbakery_divider divider_element_size="' . htmlspecialchars($data['divider_element_size'][$counters['foodbakery_global_counter_divider']]) . '" ';
		if (isset($data['foodbakery_var_divider_padding_left'][$counters['foodbakery_counter_divider']]) && $data['foodbakery_var_divider_padding_left'][$counters['foodbakery_counter_divider']] != '') {
		    $shortcode .= 'foodbakery_var_divider_padding_left="' . stripslashes(htmlspecialchars(($data['foodbakery_var_divider_padding_left'][$counters['foodbakery_counter_divider']]), ENT_QUOTES)) . '" ';
		}
		if (isset($data['foodbakery_var_divider_padding_right'][$counters['foodbakery_counter_divider']]) && $data['foodbakery_var_divider_padding_right'][$counters['foodbakery_counter_divider']] != '') {
		    $shortcode .= 'foodbakery_var_divider_padding_right="' . stripslashes(htmlspecialchars(($data['foodbakery_var_divider_padding_right'][$counters['foodbakery_counter_divider']]), ENT_QUOTES)) . '" ';
		}
		if (isset($data['foodbakery_var_divider_margin_top'][$counters['foodbakery_counter_divider']]) && $data['foodbakery_var_divider_margin_top'][$counters['foodbakery_counter_divider']] != '') {
		    $shortcode .= 'foodbakery_var_divider_margin_top="' . stripslashes(htmlspecialchars(($data['foodbakery_var_divider_margin_top'][$counters['foodbakery_counter_divider']]), ENT_QUOTES)) . '" ';
		}
		if (isset($data['foodbakery_var_divider_margin_buttom'][$counters['foodbakery_counter_divider']]) && $data['foodbakery_var_divider_margin_buttom'][$counters['foodbakery_counter_divider']] != '') {
		    $shortcode .= 'foodbakery_var_divider_margin_buttom="' . stripslashes(htmlspecialchars(($data['foodbakery_var_divider_margin_buttom'][$counters['foodbakery_counter_divider']]), ENT_QUOTES)) . '" ';
		}
		if (isset($data['foodbakery_var_divider_align'][$counters['foodbakery_counter_divider']]) && $data['foodbakery_var_divider_align'][$counters['foodbakery_counter_divider']] != '') {
		    $shortcode .= 'foodbakery_var_divider_align="' . stripslashes(htmlspecialchars(($data['foodbakery_var_divider_align'][$counters['foodbakery_counter_divider']]), ENT_QUOTES)) . '" ';
		}
		if (isset($data['foodbakery_var_divider_style'][$counters['foodbakery_counter_divider']]) && $data['foodbakery_var_divider_style'][$counters['foodbakery_counter_divider']] != '') {
		    $shortcode .= 'foodbakery_var_divider_style="' . stripslashes(htmlspecialchars(($data['foodbakery_var_divider_style'][$counters['foodbakery_counter_divider']]), ENT_QUOTES)) . '" ';
		}
		$shortcode .= ']';
		$shortcode .= '[/foodbakery_divider]';
		$shortcode_data .= $shortcode;
		$counters['foodbakery_counter_divider'] ++;
	    }
	    $counters['foodbakery_global_counter_divider'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_divider', 'foodbakery_save_page_builder_data_divider_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_divider_callback')) {

    /**
     * Populate divider shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_divider_callback($counters) {
	$counters['foodbakery_counter_divider'] = 0;
	$counters['foodbakery_shortcode_counter_divider'] = 0;
	$counters['foodbakery_global_counter_divider'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_divider_callback');
}
if (!function_exists('foodbakery_shortcode_names_list_populate_divider_callback')) {

    /**
     * Populate divider shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_divider_callback($shortcode_array) {
	$shortcode_array['divider'] = array(
	    'title' => foodbakery_var_frame_text_srt('foodbakery_var_divider'),
	    'name' => 'divider',
	    'icon' => 'icon-ellipsis-h',
	    'categories' => 'typography',
	);
	return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_divider_callback');
}

if (!function_exists('foodbakery_element_list_populate_divider_callback')) {

    /**
     * Populate divider shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_divider_callback($element_list) {
	$element_list['divider'] = foodbakery_var_frame_text_srt('foodbakery_var_divider');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_divider_callback');
}