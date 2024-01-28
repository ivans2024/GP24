<?php
/*
 *
 * @File : Image Frame 
 * @retrun
 *
 */

if (!function_exists('foodbakery_var_page_builder_image_frame')) {

    function foodbakery_var_page_builder_image_frame($die = 0) {
	global $post, $foodbakery_node, $foodbakery_var_html_fields, $coloumn_class, $foodbakery_var_form_fields, $foodbakery_var_static_text;

	if (function_exists('foodbakery_shortcode_names')) {
	    $shortcode_element = '';
	    $filter_element = 'filterdrag';
	    $shortcode_view = '';
	    $foodbakery_output = array();
	    $FOODBAKERY_PREFIX = 'foodbakery_image_frame';

	    $foodbakery_counter = isset($_POST['foodbakery_counter']) ? $_POST['foodbakery_counter'] : '';
	    $foodbakery_counter = ($foodbakery_counter == '') ? $_POST['counter'] : $foodbakery_counter;

	    if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
		$FOODBAKERY_POSTID = '';
		$shortcode_element_id = '';
	    } else {
		$FOODBAKERY_POSTID = isset($_POST['POSTID']) ? $_POST['POSTID'] : '';
		$shortcode_element_id = isset($_POST['shortcode_element_id']) ? $_POST['shortcode_element_id'] : '';
		$shortcode_str = stripslashes($shortcode_element_id);
		$parseObject = new ShortcodeParse();
		$foodbakery_output = $parseObject->foodbakery_shortcodes($foodbakery_output, $shortcode_str, true, $FOODBAKERY_PREFIX);
	    }
	    $defaults = array(
		'foodbakery_var_column' => '',
		'foodbakery_var_image_section_title' => '',
		'foodbakery_var_image_title' => '',
		'foodbakery_var_img_align' => '',
		'foodbakery_var_frame_image_url_array' => '',
                'foodbakery_var_imgframe_align' => '',
	    );
	    if (isset($foodbakery_output['0']['atts'])) {
		$atts = $foodbakery_output['0']['atts'];
	    } else {
		$atts = array();
	    }
	    if (isset($foodbakery_output['0']['content'])) {
		$foodbakery_var_image_description = $foodbakery_output['0']['content'];
	    } else {
		$foodbakery_var_image_description = '';
	    }
	    $image_frame_element_size = '25';
	    foreach ($defaults as $key => $values) {
		if (isset($atts[$key])) {
		    $$key = $atts[$key];
		} else {
		    $$key = $values;
		}
	    }
	    $name = 'foodbakery_var_page_builder_image_frame';
	    $coloumn_class = 'column_' . $image_frame_element_size;
	    if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
		$shortcode_element = 'shortcode_element_class';
		$shortcode_view = 'cs-pbwp-shortcode';
		$filter_element = 'ajax-drag';
		$coloumn_class = '';
	    }

	    $strings = new foodbakery_theme_all_strings;
	    $strings->foodbakery_short_code_strings();
	    $foodbakery_var_image_section_title = isset($foodbakery_var_image_section_title) ? $foodbakery_var_image_section_title : '';
	    $foodbakery_var_image_title = isset($foodbakery_var_image_title) ? $foodbakery_var_image_title : '';
	    $foodbakery_var_img_align = isset($foodbakery_var_img_align) ? $foodbakery_var_img_align : '';
	    $foodbakery_var_frame_image_url_array = isset($foodbakery_var_frame_image_url_array) ? $foodbakery_var_frame_image_url_array : '';
            $foodbakery_var_imgframe_align = isset($foodbakery_var_imgframe_align) ? $foodbakery_var_imgframe_align : '';
	    ?>
	    <div id="<?php echo esc_attr($name . $foodbakery_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?>
		 <?php echo esc_attr($shortcode_view); ?>" item="image_frame" data="<?php echo foodbakery_element_size_data_array_index($image_frame_element_size) ?>" >
		     <?php foodbakery_element_setting($name, $foodbakery_counter, $image_frame_element_size) ?>
	        <div class="cs-wrapp-class-<?php echo intval($foodbakery_counter) ?>
		     <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $foodbakery_counter) ?>" data-shortcode-template="[foodbakery_image_frame {{attributes}}]{{content}}[/foodbakery_image_frame]" style="display: none;">
	    	<div class="cs-heading-area" data-counter="<?php echo esc_attr($foodbakery_counter) ?>">
	    	    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_image_edit_options')); ?></h5>
	    	    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo esc_js($name . $foodbakery_counter) ?>','<?php echo esc_js($filter_element); ?>')" class="cs-btnclose">
	    		<i class="icon-times"></i>
	    	    </a>
	    	</div>
	    	<div class="cs-pbwp-content">
	    	    <div class="cs-wrapp-clone cs-shortcode-wrapp">
			    <?php
			    if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
				foodbakery_shortcode_element_size();
			    }
			    $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_image_field_name'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_image_field_name_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => esc_attr($foodbakery_var_image_section_title),
				    'cust_id' => 'foodbakery_var_image_section_title' . $foodbakery_counter,
				    'classes' => '',
				    'cust_name' => 'foodbakery_var_image_section_title[]',
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
                                        'std' => $foodbakery_var_imgframe_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_imgframe_align',
                                        'cust_name' => 'foodbakery_var_imgframe_align[]',
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
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_image_title'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_image_title_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => esc_attr($foodbakery_var_image_title),
				    'cust_id' => '',
				    'classes' => 'txtfield',
				    'cust_name' => 'foodbakery_var_image_title[]',
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
                            
			    $foodbakery_opt_array = array(
				'std' => esc_url($foodbakery_var_frame_image_url_array),
				'id' => 'frame_image_url',
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_image_field_url'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_image_field_url_hint'),
				'echo' => true,
				'array' => true,
				'prefix' => '',
				'field_params' => array(
				    'std' => esc_url($foodbakery_var_frame_image_url_array),
				    'id' => 'frame_image_url',
				    'return' => true,
				    'array' => true,
				    'array_txt' => false,
				    'prefix' => '',
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_upload_file_field($foodbakery_opt_array);
                            
			    $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_image_field_alignment'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_image_field_alignment_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => $foodbakery_var_img_align,
				    'id' => '',
				    'cust_name' => 'foodbakery_var_img_align[]',
				    'classes' => 'dropdown chosen-select',
				    'options' => array(
					'left' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_left'),
					'right' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_right'),
					'center' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_center'),
				    ),
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
                            
			    $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_image_field_desc'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_image_field_desc_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => esc_textarea($foodbakery_var_image_description),
				    'cust_id' => 'foodbakery_var_image_description' . $foodbakery_counter,
				    'classes' => 'textarea',
				    'cust_name' => 'foodbakery_var_image_description[]',
				    'return' => true,
				    'foodbakery_editor' => true,
				    'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_textarea_field($foodbakery_opt_array);
			    ?>
	    	    </div>
			<?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
			    <ul class="form-elements insert-bg">
				<li class="to-field">
				    <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo str_replace('foodbakery_var_page_builder_', '', $name); ?>', '<?php echo esc_js($name . $foodbakery_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_insert')); ?></a>
				</li>
			    </ul>
			    <div id="results-shortocde"></div>
			    <?php
			} else {
			    $foodbakery_opt_array = array(
				'std' => 'image_frame',
				'id' => '',
				'before' => '',
				'after' => '',
				'classes' => '',
				'cust_id' => 'foodbakery_orderby' . $foodbakery_counter,
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
				    'cust_id' => 'image_frame_save',
				    'cust_type' => 'button',
				    'classes' => 'cs-foodbakery-admin-btn',
				    'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
				    'cust_name' => 'image_frame_save' . $foodbakery_counter,
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
	}
	if ($die <> 1) {
	    die();
	}
    }
    add_action('wp_ajax_foodbakery_var_page_builder_image_frame', 'foodbakery_var_page_builder_image_frame');
}

if (!function_exists('foodbakery_save_page_builder_data_image_frame_callback')) {

    /**
     * Save data for image frame shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_image_frame_callback($args) {
	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	if ($widget_type == "image_frame" || $widget_type == "cs_image_frame") {
	    $foodbakery_var_image_frame = '';
            $page_element_size  =  $data['image_frame_element_size'][$counters['foodbakery_global_counter_image_frame']];
            $current_element_size  =  $data['image_frame_element_size'][$counters['foodbakery_global_counter_image_frame']];
            
	    if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes(( $data['shortcode']['image_frame'][$counters['foodbakery_shortcode_counter_image_frame']]));
                
                $element_settings   = 'image_frame_element_size="'.$current_element_size.'"';
                $reg = '/image_frame_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;

		$counters['foodbakery_shortcode_counter_image_frame'] ++;
	    } else {
                $foodbakery_var_image_frame = '[foodbakery_image_frame image_frame_element_size="'.htmlspecialchars( $data['image_frame_element_size'][$counters['foodbakery_global_counter_image_frame']] ).'" ';
		if (isset($data['foodbakery_var_image_section_title'][$counters['foodbakery_counter_image_frame']]) && $data['foodbakery_var_image_section_title'][$counters['foodbakery_counter_image_frame']] != '') {
		    $foodbakery_var_image_frame .= 'foodbakery_var_image_section_title="' . htmlspecialchars($data['foodbakery_var_image_section_title'][$counters['foodbakery_counter_image_frame']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_image_title'][$counters['foodbakery_counter_image_frame']]) && $data['foodbakery_var_image_title'][$counters['foodbakery_counter_image_frame']] != '') {
		    $foodbakery_var_image_frame .= 'foodbakery_var_image_title="' . htmlspecialchars($data['foodbakery_var_image_title'][$counters['foodbakery_counter_image_frame']], ENT_QUOTES) . '" ';
		}
                if (isset($data['foodbakery_var_imgframe_align'][$counters['foodbakery_counter_image_frame']]) && $data['foodbakery_var_imgframe_align'][$counters['foodbakery_counter_image_frame']] != '') {
		    $foodbakery_var_image_frame .= 'foodbakery_var_imgframe_align="' . htmlspecialchars($data['foodbakery_var_imgframe_align'][$counters['foodbakery_counter_image_frame']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_img_align'][$counters['foodbakery_counter_image_frame']]) && $data['foodbakery_var_img_align'][$counters['foodbakery_counter_image_frame']] != '') {
		    $foodbakery_var_image_frame .= 'foodbakery_var_img_align="' . htmlspecialchars($data['foodbakery_var_img_align'][$counters['foodbakery_counter_image_frame']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_frame_image_url_array'][$counters['foodbakery_counter_image_frame']]) && $data['foodbakery_var_frame_image_url_array'][$counters['foodbakery_counter_image_frame']] != '') {
		    $foodbakery_var_image_frame .= 'foodbakery_var_frame_image_url_array="' . htmlspecialchars($data['foodbakery_var_frame_image_url_array'][$counters['foodbakery_counter_image_frame']], ENT_QUOTES) . '" ';
		}
		$foodbakery_var_image_frame .= ']';
		if (isset($data['foodbakery_var_image_description'][$counters['foodbakery_counter_image_frame']]) && $data['foodbakery_var_image_description'][$counters['foodbakery_counter_image_frame']] != '') {
		    $foodbakery_var_image_frame .= htmlspecialchars($data['foodbakery_var_image_description'][$counters['foodbakery_counter_image_frame']], ENT_QUOTES) . ' ';
		}
		$foodbakery_var_image_frame .= '[/foodbakery_image_frame]';
                $shortcode_data .= $foodbakery_var_image_frame;
		$counters['foodbakery_counter_image_frame'] ++;
	    }
	    $counters['foodbakery_global_counter_image_frame'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }
    add_filter('foodbakery_save_page_builder_data_image_frame', 'foodbakery_save_page_builder_data_image_frame_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_image_frame_callback')) {

    /**
     * Populate image frame shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_image_frame_callback($counters) {
	$counters['foodbakery_global_counter_image_frame'] = 0;
	$counters['foodbakery_shortcode_counter_image_frame'] = 0;
	$counters['foodbakery_counter_image_frame'] = 0;
	return $counters;
    }
    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_image_frame_callback');
}
if (!function_exists('foodbakery_shortcode_names_list_populate_image_frame_callback')) {

    /**
     * Populate image frame shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_image_frame_callback($shortcode_array) {
	$shortcode_array['image_frame'] = array(
	    'title' => foodbakery_var_frame_text_srt('foodbakery_var_image_frame'),
	    'name' => 'image_frame',
	    'icon' => 'icon-photo',
	    'categories' => 'typography',
	);
	return $shortcode_array;
    }
    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_image_frame_callback');
}

if (!function_exists('foodbakery_element_list_populate_image_frame_callback')) {

    /**
     * Populate image frame shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_image_frame_callback($element_list) {
	$element_list['image_frame'] = foodbakery_var_frame_text_srt('foodbakery_var_image_frame');
	return $element_list;
    }
    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_image_frame_callback');
}