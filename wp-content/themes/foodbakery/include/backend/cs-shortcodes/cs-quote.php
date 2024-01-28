<?php
/**
 * Quotes html form for page builder
 */
if (!function_exists('foodbakery_var_page_builder_quote')) {

    function foodbakery_var_page_builder_quote($die = 0) {
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
	    $FOODBAKERY_PREFIX = 'foodbakery_quote';
	    $parseObject = new ShortcodeParse();
	    $output = $parseObject->foodbakery_shortcodes($output, $shortcode_str, true, $FOODBAKERY_PREFIX);
	}
	$defaults = array(
	    'foodbakery_var_column_size' => '',
	    'foodbakery_quote_section_title' => '',
	    'foodbakery_quote_cite' => '',
	    'foodbakery_quote_cite_url' => '#',
	    'foodbakery_author_position' => '',
            'foodbakery_var_quote_align' => '',
	);
	if (isset($output['0']['atts'])) {
	    $atts = $output['0']['atts'];
	} else {
	    $atts = array();
	}

	if (isset($output['0']['content'])) {
	    $quotes_content = $output['0']['content'];
	} else {
	    $quotes_content = '';
	}
	
	$foodbakery_quote_section_title = isset($foodbakery_quote_section_title) ? $foodbakery_quote_section_title : '';
	$foodbakery_quote_cite = isset($quote_cite) ? $quote_cite : '';
	$foodbakery_quote_cite_url = isset($quote_cite_url) ? $quote_cite_url : '';
	$foodbakery_author_position = isset($author_position) ? $author_position : '';
        $foodbakery_var_quote_align = isset($foodbakery_var_quote_align) ? $foodbakery_var_quote_align : '';
	
	$quote_element_size = '100';
	foreach ($defaults as $key => $values) {
	    if (isset($atts[$key])) {
		$$key = $atts[$key];
	    } else {
		$$key = $values;
	    }
	}
	$name = 'foodbakery_var_page_builder_quote';
	$coloumn_class = 'column_' . $quote_element_size;
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
	     <?php echo esc_attr($shortcode_view); ?>" item="quote" data="<?php echo foodbakery_element_size_data_array_index($quote_element_size) ?>" >
		 <?php foodbakery_element_setting($name, $foodbakery_counter, $quote_element_size) ?>
	    <div class="cs-wrapp-class-<?php echo esc_attr($foodbakery_counter); ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $foodbakery_counter) ?>" data-shortcode-template="[foodbakery_quote {{attributes}}]{{content}}[/foodbakery_quote]" style="display: none;"">
		<div class="cs-heading-area">
		    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_quote_edit')); ?></h5>
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
				'std' => esc_html($foodbakery_quote_section_title),
				'id' => 'foodbakery_quote_section_title',
				'cust_name' => 'foodbakery_quote_section_title[]',
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
                                        'std' => $foodbakery_var_quote_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_quote_align',
                                        'cust_name' => 'foodbakery_var_quote_align[]',
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
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_author'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_author_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_html($foodbakery_quote_cite),
				'id' => 'foodbakery_quote_cite',
				'cust_name' => 'foodbakery_quote_cite[]',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_author_url'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_author_url_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_url($foodbakery_quote_cite_url),
				'id' => 'foodbakery_quote_cite_url',
				'cust_name' => 'foodbakery_quote_cite_url[]',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_testimonial_field_position'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_testimonial_field_position_hint'),
			    'echo' => true,
			    'classes' => 'txtfield',
			    'field_params' => array(
				'std' => esc_attr($foodbakery_author_position),
				'id' => 'foodbakery_author_position',
				'cust_name' => 'foodbakery_author_position[]',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_column_field_text'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_column_field_text_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_attr($quotes_content),
				'cust_id' => 'quotes_content',
				'classes' => '',
				'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
				'cust_name' => 'quotes_content[]',
				'return' => true,
				'foodbakery_editor' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_textarea_field($foodbakery_opt_array);
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
			    'std' => 'quote',
			    'id' => '',
			    'before' => '',
			    'after' => '',
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

    add_action('wp_ajax_foodbakery_var_page_builder_quote', 'foodbakery_var_page_builder_quote');
}


if (!function_exists('foodbakery_save_page_builder_data_quote_callback')) {

    /**
     * Save data for quote shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_quote_callback($args) {

	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	if ($widget_type == "quote" || $widget_type == "cs_quote") {
	    $shortcode = '';
            $page_element_size  =  $data['quote_element_size'][$counters['foodbakery_global_counter_quote']];
            $current_element_size  =  $data['quote_element_size'][$counters['foodbakery_global_counter_quote']];
            
	    if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes(( $data['shortcode']['quote'][$counters['foodbakery_shortcode_counter_quote']]));
                $element_settings   = 'quote_element_size="'.$current_element_size.'"';
                $reg = '/quote_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
		$counters['foodbakery_shortcode_counter_quote'] ++;
	    } else {
                $shortcode = '[foodbakery_quote quote_element_size="'.htmlspecialchars( $data['quote_element_size'][$counters['foodbakery_global_counter_quote']] ).'" ';
		if (isset($data['foodbakery_quote_section_title'][$counters['foodbakery_counter_quote']]) && $data['foodbakery_quote_section_title'][$counters['foodbakery_counter_quote']] != '') {
		    $shortcode .= 'foodbakery_quote_section_title="' . stripslashes(htmlspecialchars(($data['foodbakery_quote_section_title'][$counters['foodbakery_counter_quote']]), ENT_QUOTES)) . '" ';
		}
                if (isset($data['foodbakery_var_quote_align'][$counters['foodbakery_counter_quote']]) && $data['foodbakery_var_quote_align'][$counters['foodbakery_counter_quote']] != '') {
		    $shortcode .= 'foodbakery_var_quote_align="' . stripslashes(htmlspecialchars(($data['foodbakery_var_quote_align'][$counters['foodbakery_counter_quote']]), ENT_QUOTES)) . '" ';
		}
		if (isset($data['foodbakery_quote_cite'][$counters['foodbakery_counter_quote']]) && $data['foodbakery_quote_cite'][$counters['foodbakery_counter_quote']] != '') {
		    $shortcode .= 'foodbakery_quote_cite="' . htmlspecialchars($data['foodbakery_quote_cite'][$counters['foodbakery_counter_quote']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_quote_cite_url'][$counters['foodbakery_counter_quote']]) && $data['foodbakery_quote_cite_url'][$counters['foodbakery_counter_quote']] != '') {
		    $shortcode .= 'foodbakery_quote_cite_url="' . htmlspecialchars($data['foodbakery_quote_cite_url'][$counters['foodbakery_counter_quote']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_author_position'][$counters['foodbakery_counter_quote']]) && $data['foodbakery_author_position'][$counters['foodbakery_counter_quote']] != '') {
		    $shortcode .= 'foodbakery_author_position="' . htmlspecialchars($data['foodbakery_author_position'][$counters['foodbakery_counter_quote']], ENT_QUOTES) . '" ';
		}
		$shortcode .= ']';
		if (isset($data['quotes_content'][$counters['foodbakery_counter_quote']]) && $data['quotes_content'][$counters['foodbakery_counter_quote']] != '') {
		    $shortcode .= htmlspecialchars($data['quotes_content'][$counters['foodbakery_counter_quote']], ENT_QUOTES) . ' ';
		}
		$shortcode .= '[/foodbakery_quote]';
		$shortcode_data .= $shortcode;
		$counters['foodbakery_counter_quote'] ++;
	    }
	    $counters['foodbakery_global_counter_quote'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_quote', 'foodbakery_save_page_builder_data_quote_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_quote_callback')) {

    /**
     * Populate quote shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_quote_callback($counters) {
	$counters['foodbakery_counter_quote'] = 0;
	$counters['foodbakery_shortcode_counter_quote'] = 0;
	$counters['foodbakery_global_counter_quote'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_quote_callback');
}
if (!function_exists('foodbakery_shortcode_names_list_populate_quote_callback')) {

    /**
     * Populate quote shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_quote_callback($shortcode_array) {
	$shortcode_array['quote'] = array(
	    'title' => foodbakery_var_frame_text_srt('foodbakery_var_quote'),
	    'name' => 'quote',
	    'icon' => 'icon-comments-o',
	    'categories' => 'typography',
	);
	return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_quote_callback');
}

if (!function_exists('foodbakery_element_list_populate_quote_callback')) {

    /**
     * Populate quote shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_quote_callback($element_list) {
	$element_list['quote'] = foodbakery_var_frame_text_srt('foodbakery_var_quote');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_quote_callback');
}