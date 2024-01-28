<?php
/**
 * @Sitemap html form for page builder
 */
if (!function_exists('foodbakery_var_page_builder_sitemap')) {

    function foodbakery_var_page_builder_sitemap($die = 0) {
	global $post, $foodbakery_node, $foodbakery_var_html_fields, $foodbakery_var_form_fields;
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_short_code_strings();
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
	    $PREFIX = 'foodbakery_sitemap';
	    $parseObject = new ShortcodeParse();
	    $output = $parseObject->foodbakery_shortcodes($output, $shortcode_str, true, $PREFIX);
	}
	$defaults = array(
	    'foodbakery_sitemap_section_title' => '',
            'foodbakery_var_sitemap_align' => '',
	);
	if (isset($output['0']['atts'])) {
	    $atts = $output['0']['atts'];
	} else {
	    $atts = array();
	}

	foreach ($defaults as $key => $values) {
	    if (isset($atts[$key])) {
		$$key = $atts[$key];
	    } else {
		$$key = $values;
	    }
	}
	$name = 'foodbakery_var_page_builder_sitemap';
	$coloumn_class = 'column_100';
	$foodbakery_sitemap_section_title = isset($foodbakery_sitemap_section_title) ? $foodbakery_sitemap_section_title : '';
        $foodbakery_var_sitemap_align = isset($foodbakery_var_sitemap_align) ? $foodbakery_var_sitemap_align : '';
	if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
	    $shortcode_element = 'shortcode_element_class';
	    $shortcode_view = 'cs-pbwp-shortcode';
	    $filter_element = 'ajax-drag';
	    $coloumn_class = '';
	}
	?>
	<div id="<?php echo esc_attr($name . $foodbakery_counter) ?>_del" class="column  parentdelete column_100 column_100 <?php echo esc_attr($shortcode_view); ?>" item="sitemap" data="0" >
	    <?php foodbakery_element_setting($name, $foodbakery_counter, 'column_100', '', 'arrows-v'); ?>
	    <div class="cs-wrapp-class-<?php echo esc_attr($foodbakery_counter); ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $foodbakery_counter) ?>" data-shortcode-template="[<?php echo esc_attr('foodbakery_sitemap'); ?> {{attributes}}]" style="display: none;">
		<div class="cs-heading-area">
		    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_edit_sitemap')); ?></h5>
		    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo esc_js($name . $foodbakery_counter) ?>','<?php echo esc_js($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
		<div class="cs-pbwp-content">
		    <div class="cs-wrapp-clone cs-shortcode-wrapp">
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
				'std' => esc_html($foodbakery_sitemap_section_title),
				'id' => 'foodbakery_sitemap_section_title',
				'cust_name' => 'foodbakery_sitemap_section_title[]',
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
                                        'std' => $foodbakery_var_sitemap_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_sitemap_align',
                                        'cust_name' => 'foodbakery_var_sitemap_align[]',
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
                        
			?>
		    </div>
		    <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
	    	    <ul class="form-elements insert-bg">
	    		<li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo esc_js(str_replace('foodbakery_var_page_builder_', '', $name)); ?>', '<?php echo esc_js($name . $foodbakery_counter); ?>', '<?php echo esc_js($filter_element); ?>')" ><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_insert')); ?></a> </li>
	    	    </ul>
	    	    <div id="results-shortocde"></div>
		    <?php } else {
			$foodbakery_opt_array = array(
			    'std' => 'sitemap',
			    'id' => '',
			    'before' => '',
			    'after' => '',
			    'classes' => '',
			    'extra_atr' => '',
			    'cust_id' => '',
			    'cust_name' => 'foodbakery_orderby[]',
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
				'classes' => 'cs-admin-btn',
				'cust_name' => '',
				'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			} ?>
		</div>
	    </div>
	</div>
	
	<?php
	if ($die <> 1) {
	    die();
	}
    }

    add_action('wp_ajax_foodbakery_var_page_builder_sitemap', 'foodbakery_var_page_builder_sitemap');
}

if (!function_exists('foodbakery_save_page_builder_data_sitemap_callback')) {

    /**
     * Save data for sitemap shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_sitemap_callback($args) {

	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	if ($widget_type == "sitemap" || $widget_type == "cs_sitemap") {
	    $shortcode = '';
            $page_element_size     =  $data['sitemap_element_size'][$counters['foodbakery_global_counter_sitemap']];
            $current_element_size  =  $data['sitemap_element_size'][$counters['foodbakery_global_counter_sitemap']];
	    if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes($data['shortcode']['sitemap'][$counters['foodbakery_shortcode_counter_sitemap']]);
                $element_settings   = 'sitemap_element_size="'.$current_element_size.'"';
                $reg = '/sitemap_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
		$counters['foodbakery_shortcode_counter_sitemap'] ++;
	    } else {
                $shortcode = '[foodbakery_sitemap sitemap_element_size="'.htmlspecialchars( $data['sitemap_element_size'][$counters['foodbakery_global_counter_sitemap']] ).'" ';
		if (isset($data['foodbakery_sitemap_section_title'][$counters['foodbakery_counter_sitemap']]) && $data['foodbakery_sitemap_section_title'][$counters['foodbakery_counter_sitemap']] != '') {
		    $shortcode .= 'foodbakery_sitemap_section_title="' . htmlspecialchars($data['foodbakery_sitemap_section_title'][$counters['foodbakery_counter_sitemap']]) . '" ';
		}
                if (isset($data['foodbakery_var_sitemap_align'][$counters['foodbakery_counter_sitemap']]) && $data['foodbakery_var_sitemap_align'][$counters['foodbakery_counter_sitemap']] != '') {
		    $shortcode .= 'foodbakery_var_sitemap_align="' . htmlspecialchars($data['foodbakery_var_sitemap_align'][$counters['foodbakery_counter_sitemap']]) . '" ';
		}
		$shortcode .= ']';
		$shortcode_data .= $shortcode;
		$counters['foodbakery_counter_sitemap'] ++;
	    }
	    $counters['foodbakery_global_counter_sitemap'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_sitemap', 'foodbakery_save_page_builder_data_sitemap_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_sitemap_callback')) {

    /**
     * Populate sitemap shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_sitemap_callback($counters) {
	$counters['foodbakery_global_counter_sitemap'] = 0;
	$counters['foodbakery_shortcode_counter_sitemap'] = 0;
	$counters['foodbakery_counter_sitemap'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_sitemap_callback');
}
if (!function_exists('foodbakery_shortcode_names_list_populate_sitemap_callback')) {

    /**
     * Populate sitemap shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_sitemap_callback($shortcode_array) {
	$shortcode_array['sitemap'] = array(
	    'title' => foodbakery_var_frame_text_srt('foodbakery_var_sitemap'),
	    'name' => 'sitemap',
	    'icon' => 'icon-arrows-v',
	    'categories' => 'typography',
	);
	return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_sitemap_callback');
}

if (!function_exists('foodbakery_element_list_populate_sitemap_callback')) {

    /**
     * Populate sitemap shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_sitemap_callback($element_list) {
	$element_list['sitemap'] = foodbakery_var_frame_text_srt('foodbakery_var_sitemap');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_sitemap_callback');
}