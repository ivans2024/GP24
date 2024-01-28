<?php
/*
 *
 * @Shortcode Name : Table
 * @retrun
 *
 */
if (!function_exists('foodbakery_var_page_builder_table')) {

    function foodbakery_var_page_builder_table($die = 0) {
	global $foodbakery_node, $foodbakery_count_node, $post, $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;
	$shortcode_element = '';
	$filter_element = 'filterdrag';
	$shortcode_view = '';
	$output = array();
	$PREFIX = 'foodbakery_table';
	$defaultAttributes = false;
	$parseObject = new ShortcodeParse();
	$foodbakery_counter = $_POST['counter'];
	if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
	    $POSTID = '';
	    $shortcode_element_id = '';
	    $defaultAttributes = true;
	} else {
	    $POSTID = $_POST['POSTID'];
	    $shortcode_element_id = $_POST['shortcode_element_id'];
	    $shortcode_str = stripslashes($shortcode_element_id);
	    $output = $parseObject->foodbakery_shortcodes($output, $shortcode_str, true, $PREFIX);
	}
	$defaults = array(
	    'foodbakery_var_column_size' => '1/2',
	    'foodbakery_table_element_title' => '',
	    'foodbakery_table_content' => '',
            'foodbakery_var_table_align' => '',
	);
	if (isset($output['0']['atts'])) {
	    $atts = $output['0']['atts'];
	} else {
	    $atts = array();
	}
	$atts_content = '[table]
                            [thead]
                              [tr]
                                [th]Column 1[/th]
                                [th]Column 2[/th]
                                [th]Column 3[/th]
                                [th]Column 4[/th]
                              [/tr]
                            [/thead]
                            [tbody]
                              [tr]
                                [td]Item 1[/td]
                                [td]Item 2[/td]
                                [td]Item 3[/td]
                                [td]Item 4[/td]
                              [/tr]
                              [tr]
                                [td]Item 11[/td]
                                [td]Item 22[/td]
                                [td]Item 33[/td]
                                [td]Item 44[/td]
                              [/tr]
                            [/tbody]
                        [/table]';

	if ($defaultAttributes) {
	    $atts_content = $atts_content;
	} else {
	    if (isset($output['0']['content'])) {
		$atts_content = $output['0']['content'];
	    } else {
		$atts_content = "";
	    }
	}
	$table_element_size = '25';
	foreach ($defaults as $key => $values) {
	    if (isset($atts[$key])) {
		$$key = $atts[$key];
	    } else {
		$$key = $values;
	    }
	}
	$name = 'foodbakery_var_page_builder_table';
	$foodbakery_table_element_title = isset($foodbakery_table_element_title) ? $foodbakery_table_element_title : '';
	$foodbakery_table_content = isset($foodbakery_table_content) ? $foodbakery_table_content : '';
        $foodbakery_var_table_align = isset($foodbakery_var_table_align) ? $foodbakery_var_table_align : '';
	$foodbakery_count_node ++;
	$coloumn_class = 'column_' . $table_element_size;
	if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
	    $shortcode_element = 'shortcode_element_class';
	    $shortcode_view = 'cs-pbwp-shortcode';
	    $filter_element = 'ajax-drag';
	    $coloumn_class = '';
	}
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_short_code_strings();
	?>
	<div id="<?php echo esc_attr($name . $foodbakery_counter); ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="table" data="<?php echo foodbakery_element_size_data_array_index($table_element_size) ?>" >
	    <?php foodbakery_element_setting($name, $foodbakery_counter, $table_element_size, '', 'th'); ?>
	    <div class="cs-wrapp-class-<?php echo esc_attr($foodbakery_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $foodbakery_counter) ?>"  data-shortcode-template="[foodbakery_table {{attributes}}] {{content}} [/foodbakery_table]"  style="display: none;">
		<div class="cs-heading-area">
		    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_table_options')); ?></h5>
		    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo esc_attr($name . $foodbakery_counter) ?>','<?php echo esc_attr($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
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
				'std' => foodbakery_allow_special_char($foodbakery_table_element_title),
				'cust_id' => '',
				'classes' => 'txtfield',
				'cust_name' => 'foodbakery_table_element_title[]',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
                        
                        $foodbakery_opt_array = array(
                                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_title_alignment' ),
                                    'desc' => '',
                                    'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_title_alignment_hint' ),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $foodbakery_var_table_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_table_align',
                                        'cust_name' => 'foodbakery_var_table_align[]',
                                        'classes' => 'service_postion chosen-select-no-single select-medium',
                                        'options' => array(
                                            'align-left' => foodbakery_var_theme_text_srt( 'foodbakery_var_align_left' ),
                                            'align-right' => foodbakery_var_theme_text_srt( 'foodbakery_var_align_right' ),
                                            'align-center' => foodbakery_var_theme_text_srt( 'foodbakery_var_align_center' ),
                                        ),
                                        'return' => true,
                                    ),
                                );
                                $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );
                        
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_table_content'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_table_content_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_textarea($atts_content),
				'cust_id' => '',
				'classes' => '',
				'cust_name' => 'foodbakery_table_content[]',
				'return' => true,
				'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_textarea_field($foodbakery_opt_array);
			if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
			    ?>
			    <ul class="form-elements insert-bg noborder cs-insert-noborder">
				<li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo esc_js(str_replace('foodbakery_var_page_builder_', '', $name)); ?>', '<?php echo esc_js($name . $foodbakery_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_insert')); ?></a> </li>
			    </ul>
			    <div id="results-shortocde"></div>
			    <?php
			} else {
			    $foodbakery_opt_array = array(
				'std' => 'table',
				'id' => '',
				'before' => '',
				'after' => '',
				'classes' => '',
				'extra_atr' => '',
				'cust_id' => '',
				'cust_name' => 'foodbakery_orderby[]',
				'return' => true,
				'required' => false
			    );
			    echo foodbakery_allow_special_char($foodbakery_var_form_fields->foodbakery_var_form_hidden_render($foodbakery_opt_array));
			    $foodbakery_opt_array = array(
				'name' => '',
				'desc' => '',
				'hint_text' => '',
				'echo' => true,
				'field_params' => array(
				    'std' => foodbakery_var_theme_text_srt('foodbakery_var_save'),
				    'cust_id' => '',
				    'cust_type' => 'button',
				    'classes' => 'cs-admin-btn',
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
	</div>
	<?php
	if ($die <> 1) {
	    die();
	}
    }

    add_action('wp_ajax_foodbakery_var_page_builder_table', 'foodbakery_var_page_builder_table');
}
if (!function_exists('foodbakery_save_page_builder_data_table_callback')) {

    /**
     * Save data for table shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_table_callback($args) {
	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	if ($widget_type == "table" || $widget_type == "cs_table") {
	    $shortcode = '';
            $page_element_size  =  $data['table_element_size'][$counters['foodbakery_global_counter_table']];
            $current_element_size  =  $data['table_element_size'][$counters['foodbakery_global_counter_table']];
	    
            if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes($data['shortcode']['table'][$counters['foodbakery_shortcode_counter_table']]);
                $element_settings   = 'table_element_size="'.$current_element_size.'"';
                $reg = '/table_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
		$counters['foodbakery_shortcode_counter_table'] ++;
	    } else {
                $shortcode = '[foodbakery_table table_element_size="'.htmlspecialchars( $data['table_element_size'][$counters['foodbakery_global_counter_table']] ).'" ';
		if (isset($data['foodbakery_table_element_title'][$counters['foodbakery_counter_table']]) && $data['foodbakery_table_element_title'][$counters['foodbakery_counter_table']] != '') {
		    $shortcode .= ' foodbakery_table_element_title="' . htmlspecialchars($data['foodbakery_table_element_title'][$counters['foodbakery_counter_table']], ENT_QUOTES) . '" ';
		}
                if (isset($data['foodbakery_var_table_align'][$counters['foodbakery_counter_table']]) && $data['foodbakery_var_table_align'][$counters['foodbakery_counter_table']] != '') {
		    $shortcode .= ' foodbakery_var_table_align="' . htmlspecialchars($data['foodbakery_var_table_align'][$counters['foodbakery_counter_table']], ENT_QUOTES) . '" ';
		}
		$shortcode .= ']';
		if (isset($data['foodbakery_table_content'][$counters['foodbakery_counter_table']]) && $data['foodbakery_table_content'][$counters['foodbakery_counter_table']] != '') {
		    $shortcode .= htmlspecialchars($data['foodbakery_table_content'][$counters['foodbakery_counter_table']], ENT_QUOTES);
		}
		$shortcode .='[/foodbakery_table]';
		$shortcode_data .= $shortcode;
		$counters['foodbakery_counter_table'] ++;
	    }
	    $counters['foodbakery_global_counter_table'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_table', 'foodbakery_save_page_builder_data_table_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_table_callback')) {

    /**
     * Populate spacer shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_table_callback($counters) {
	$counters['foodbakery_counter_table'] = 0;
	$counters['foodbakery_global_counter_table'] = 0;
	$counters['foodbakery_shortcode_counter_table'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_table_callback');
}
if (!function_exists('foodbakery_shortcode_names_list_populate_table_callback')) {

    /**
     * Populate table shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_table_callback($shortcode_array) {
	$shortcode_array['table'] = array(
	    'title' => foodbakery_var_frame_text_srt('foodbakery_var_table'),
	    'name' => 'table',
	    'icon' => 'icon-th',
	    'categories' => 'contentblocks',
	);
	return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_table_callback');
}

if (!function_exists('foodbakery_element_list_populate_table_callback')) {

    /**
     * Populate table shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_table_callback($element_list) {
	$element_list['table'] = foodbakery_var_frame_text_srt('foodbakery_var_table');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_table_callback');
}