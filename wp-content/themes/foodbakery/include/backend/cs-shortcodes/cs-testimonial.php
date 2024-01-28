<?php
/*
 *
 * @Shortcode Name : Testimonial
 * @retrun
 *
 */
if (!function_exists('foodbakery_var_page_builder_testimonial')) {

    function foodbakery_var_page_builder_testimonial($die = 0) {
	global $post, $foodbakery_node, $foodbakery_var_html_fields, $foodbakery_var_form_fields;
	$shortcode_element = '';
	$filter_element = 'filterdrag';
	$shortcode_view = '';
	$output = array();
	$foodbakery_counter = $_POST['counter'];
	$testimonial_num = 0;
	if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
	    $FOODBAKERY_POSTID = '';
	    $shortcode_element_id = '';
	} else {
	    $FOODBAKERY_POSTID = $_POST['POSTID'];
	    $shortcode_element_id = $_POST['shortcode_element_id'];
	    $shortcode_str = stripslashes($shortcode_element_id);
	    $FOODBAKERY_PREFIX = 'foodbakery_testimonial|testimonial_item';
	    $parseObject = new ShortcodeParse();
	    $output = $parseObject->foodbakery_shortcodes($output, $shortcode_str, true, $FOODBAKERY_PREFIX);
	}
	$defaults = array(
	    'foodbakery_var_column_size' => '',
	    'foodbakery_var_testimonial_title' => '',
	    'foodbakery_var_author_color' => '',
            'foodbakery_var_testimonial_align' => '',
	    'foodbakery_var_testimonial_style' => '',
	);
	if (isset($output['0']['atts'])) {
	    $atts = $output['0']['atts'];
	} else {
	    $atts = array();
	}
	if (isset($output['0']['content'])) {
	    $atts_content = $output['0']['content'];
	} else {
	    $atts_content = array();
	}
	if (is_array($atts_content)) {
	    $testimonial_num = count($atts_content);
	}
	$testimonial_element_size = '100';
	foreach ($defaults as $key => $values) {
	    if (isset($atts[$key])) {
		$$key = $atts[$key];
	    } else {
		$$key = $values;
	    }
	}
	$foodbakery_var_testimonial_title = isset($foodbakery_var_testimonial_title) ? $foodbakery_var_testimonial_title : '';
	$foodbakery_var_author_color = isset($foodbakery_var_author_color) ? $foodbakery_var_author_color : '';
        $foodbakery_var_testimonial_align = isset($foodbakery_var_testimonial_align) ? $foodbakery_var_testimonial_align : '';
	$foodbakery_var_testimonial_style = isset($foodbakery_var_testimonial_style) ? $foodbakery_var_testimonial_style : '';
	
	$name = 'foodbakery_var_page_builder_testimonial';
	$coloumn_class = 'column_' . $testimonial_element_size;
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
	<div id="<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>_del" class="column  parentdelete <?php echo foodbakery_allow_special_char($coloumn_class); ?> <?php echo foodbakery_allow_special_char($shortcode_view); ?>" item="testimonial" data="<?php echo foodbakery_element_size_data_array_index($testimonial_element_size) ?>" >
	    <?php foodbakery_element_setting($name, $foodbakery_counter, $testimonial_element_size, '', 'comments-o', $type = ''); ?>
	    <div class="cs-wrapp-class-<?php echo foodbakery_allow_special_char($foodbakery_counter) ?> <?php echo foodbakery_allow_special_char($shortcode_element); ?>" id="<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>" style="display: none;">
		<div class="cs-heading-area">
		    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_testimonial_edit')); ?></h5>
		    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>','<?php echo foodbakery_allow_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
		</div>
		<div class="cs-clone-append cs-pbwp-content">
		    <div class="cs-wrapp-tab-box">
			<div id="shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>" data-shortcode-template="{{child_shortcode}} [/foodbakery_testimonial]" data-shortcode-child-template="[testimonial_item {{attributes}}] {{content}} [/testimonial_item]">
			    <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[foodbakery_testimonial {{attributes}}]">
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
					'std' => esc_attr($foodbakery_var_testimonial_title),
					'cust_id' => '',
					'cust_name' => 'foodbakery_var_testimonial_title[]',
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
                                        'std' => $foodbakery_var_testimonial_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_testimonial_align',
                                        'cust_name' => 'foodbakery_var_testimonial_align[]',
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
                                     'name' => esc_html__( 'Style', 'foodbakery' ),
                                    'desc' => '',
                                    'hint_text' =>  esc_html__( 'Choose Style', 'foodbakery' ),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $foodbakery_var_testimonial_style,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_testimonial_style',
                                        'cust_name' => 'foodbakery_var_testimonial_style[]',
                                        'classes' => 'service_postion chosen-select-no-single select-medium',
                                        'options' => array(
                                            'default' => 'Default',
					    'fancy' => 'Fancy',
                                            'simple' => 'Simple',
                                        ),
                                        'return' => true,
                                    ),
                                );
                                $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );
				
				$foodbakery_opt_array = array(
				    'name' => foodbakery_var_theme_text_srt('foodbakery_var_testimonial_author_color'),
				    'desc' => '',
				    'hint_text' => '',
				    'echo' => true,
				    'field_params' => array(
					'std' => esc_attr($foodbakery_var_author_color),
					'cust_id' => 'foodbakery_var_author_color' . $foodbakery_counter,
					'classes' => 'bg_color',
					'cust_name' => 'foodbakery_var_author_color[]',
					'return' => true,
				    ),
				);
				$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
				?>
			    </div>
			    <?php
			    if (isset($testimonial_num) && $testimonial_num <> '' && isset($atts_content) && is_array($atts_content)) {
				foreach ($atts_content as $testimonial) {
				    $rand_string = rand(123456, 987654);
				    $foodbakery_var_testimonial_content = $testimonial['content'];
				    $defaults = array(
					'foodbakery_var_testimonial_author' => '',
					'foodbakery_var_testimonial_author_image_array' => '',
				    );
				    foreach ($defaults as $key => $values) {
					if (isset($testimonial['atts'][$key])) {
					    $$key = $testimonial['atts'][$key];
					} else {
					    $$key = $values;
					}
				    }
				    $foodbakery_var_testimonial_author = isset($foodbakery_var_testimonial_author) ? $foodbakery_var_testimonial_author : '';
				    $foodbakery_var_testimonial_author_image_array = isset($foodbakery_var_testimonial_author_image_array) ? $foodbakery_var_testimonial_author_image_array : '';
				    $foodbakery_var_testimonial_content = isset($foodbakery_var_testimonial_content) ? $foodbakery_var_testimonial_content : '';
				    ?>
				    <div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content' id="foodbakery_infobox_<?php echo foodbakery_allow_special_char($rand_string); ?>">
					<header>
					    <h4><i class='icon-arrows'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_testimonial')); ?></h4>
					    <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_tabs_remove')); ?></a>
					</header>
					<?php
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_testimonial_field_text'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_testimonial_field_text_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_attr($foodbakery_var_testimonial_content),
						'cust_id' => '',
						'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
						'cust_name' => 'foodbakery_var_testimonial_content[]',
						'return' => true,
						'classes' => '',
						'foodbakery_editor' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_textarea_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_testimonial_field_author'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_testimonial_field_author_hint'),
					    'echo' => true,
					    'classes' => 'txtfield',
					    'field_params' => array(
						'std' => esc_attr($foodbakery_var_testimonial_author),
						'cust_id' => '',
						'cust_name' => 'foodbakery_var_testimonial_author[]',
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'std' => esc_url($foodbakery_var_testimonial_author_image_array),
					    'id' => 'testimonial_author_image',
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_testimonial_field_image'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_testimonial_field_image_hint'),
					    'echo' => true,
					    'array' => true,
					    'prefix' => '',
					    'field_params' => array(
						'std' => esc_url($foodbakery_var_testimonial_author_image_array),
						'id' => 'testimonial_author_image',
						'return' => true,
						'array' => true,
						'array_txt' => false,
						'prefix' => '',
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_upload_file_field($foodbakery_opt_array);
					?>
				    </div>
				    <?php
				}
			    }
			    ?>
			</div>
			<div class="hidden-object">
			    <?php
			    $foodbakery_opt_array = array(
				'std' => foodbakery_allow_special_char($testimonial_num),
				'id' => '',
				'before' => '',
				'after' => '',
				'classes' => 'fieldCounter',
				'extra_atr' => '',
				'cust_id' => '',
				'cust_name' => 'testimonial_num[]',
				'return' => false,
				'required' => false
			    );
			    $foodbakery_var_form_fields->foodbakery_var_form_hidden_render($foodbakery_opt_array);
			    ?>
			</div>
			<div class="wrapptabbox cs-pbwp-content cs-zero-padding">
			    <div class="opt-conts">
				<ul class="form-elements">
				    <li class="to-field"> <a href="javascript:void(0);" class="add_servicesss cs-main-btn" onclick="foodbakery_shortcode_element_ajax_call('testimonial', 'shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>', '<?php echo admin_url('admin-ajax.php'); ?>')"><i class="icon-plus-circle"></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_add_testimonial')); ?></a> </li>
				    <div id="loading" class="shortcodeload"></div>
				</ul>
				<?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
	    			<ul class="form-elements insert-bg noborder">
	    			    <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo str_replace('foodbakery_var_page_builder_', '', $name); ?>', 'shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>', '<?php echo foodbakery_allow_special_char($filter_element); ?>')" ><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_insert')); ?></a> </li>
	    			</ul>
	    			<div id="results-shortocde"></div>
				    <?php
				} else {
				    $foodbakery_opt_array = array(
					'std' => 'testimonial',
					'id' => '',
					'before' => '',
					'after' => '',
					'classes' => '',
					'extra_atr' => '',
					'cust_id' => 'foodbakery_orderby' . $foodbakery_counter,
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
					    'cust_id' => 'testimonial_save' . $foodbakery_counter,
					    'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
					    'cust_type' => 'button',
					    'classes' => 'cs-foodbakery-admin-btn',
					    'cust_name' => 'testimonial_save',
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
	    </div>
	</div>

	<?php
	if ($die <> 1) {
	    die();
	}
    }

    add_action('wp_ajax_foodbakery_var_page_builder_testimonial', 'foodbakery_var_page_builder_testimonial');
}

if (!function_exists('foodbakery_save_page_builder_data_testimonial_callback')) {

    /**
     * Save data for testimonial shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_testimonial_callback($args) {
	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	$shortcode_data ='';
	if ($widget_type == "testimonial" || $widget_type == "cs_testimonial") {
	    $shortcode = $shortcode_item = '';
	    $page_element_size  =  $data['testimonial_element_size'][$counters['foodbakery_global_counter_testimonial']];
            $current_element_size  =  $data['testimonial_element_size'][$counters['foodbakery_global_counter_testimonial']];
	    if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes($data['shortcode']['testimonial'][$counters['foodbakery_shortcode_counter_testimonial']]);
                $element_settings   = 'testimonial_element_size="'.$current_element_size.'"';
                $reg = '/testimonial_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
                
		$counters['foodbakery_shortcode_counter_testimonial'] ++;
	    } else {
		if (isset($data['testimonial_num'][$counters['foodbakery_counter_testimonial']]) && $data['testimonial_num'][$counters['foodbakery_counter_testimonial']] > 0) {
		    for ($i = 1; $i <= $data['testimonial_num'][$counters['foodbakery_counter_testimonial']]; $i ++) {
			$shortcode_item .= '[testimonial_item ';
			if (isset($data['foodbakery_var_testimonial_author'][$counters['foodbakery_counter_testimonial_node']]) && $data['foodbakery_var_testimonial_author'][$counters['foodbakery_counter_testimonial_node']] != '') {
			    $shortcode_item .= 'foodbakery_var_testimonial_author="' . htmlspecialchars($data['foodbakery_var_testimonial_author'][$counters['foodbakery_counter_testimonial_node']], ENT_QUOTES) . '" ';
			}
			if (isset($data['foodbakery_var_testimonial_author_image_array'][$counters['foodbakery_counter_testimonial_node']]) && $data['foodbakery_var_testimonial_author_image_array'][$counters['foodbakery_counter_testimonial_node']] != '') {
			    $shortcode_item .= 'foodbakery_var_testimonial_author_image_array="' . $data['foodbakery_var_testimonial_author_image_array'][$counters['foodbakery_counter_testimonial_node']] . '" ';
			}
			$shortcode_item .= ']';
			if (isset($data['foodbakery_var_testimonial_content'][$counters['foodbakery_counter_testimonial_node']]) && $data['foodbakery_var_testimonial_content'][$counters['foodbakery_counter_testimonial_node']] != '') {
			    $shortcode_item .= htmlspecialchars($data['foodbakery_var_testimonial_content'][$counters['foodbakery_counter_testimonial_node']], ENT_QUOTES);
			}
			$shortcode_item .= '[/testimonial_item]';
			$counters['foodbakery_counter_testimonial_node'] ++;
		    }
		}
		$section_title = '';
		if (isset($data['foodbakery_var_testimonial_title'][$counters['foodbakery_counter_testimonial']]) && $data['foodbakery_var_testimonial_title'][$counters['foodbakery_counter_testimonial']] != '') {
		    $section_title .= 'foodbakery_var_testimonial_title="' . htmlspecialchars($data['foodbakery_var_testimonial_title'][$counters['foodbakery_counter_testimonial']], ENT_QUOTES) . '" ';
		}
                if (isset($data['foodbakery_var_testimonial_align'][$counters['foodbakery_counter_testimonial']]) && $data['foodbakery_var_testimonial_align'][$counters['foodbakery_counter_testimonial']] != '') {
		    $section_title .= 'foodbakery_var_testimonial_align="' . htmlspecialchars($data['foodbakery_var_testimonial_align'][$counters['foodbakery_counter_testimonial']], ENT_QUOTES) . '" ';
		}
		 if (isset($data['foodbakery_var_testimonial_style'][$counters['foodbakery_counter_testimonial']]) && $data['foodbakery_var_testimonial_style'][$counters['foodbakery_counter_testimonial']] != '') {
		    $section_title .= 'foodbakery_var_testimonial_style="' . htmlspecialchars($data['foodbakery_var_testimonial_style'][$counters['foodbakery_counter_testimonial']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_author_color'][$counters['foodbakery_counter_testimonial']]) && $data['foodbakery_var_author_color'][$counters['foodbakery_counter_testimonial']] != '') {
		    $section_title .= 'foodbakery_var_author_color="' . htmlspecialchars($data['foodbakery_var_author_color'][$counters['foodbakery_counter_testimonial']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_position_color'][$counters['foodbakery_counter_testimonial']]) && $data['foodbakery_var_position_color'][$counters['foodbakery_counter_testimonial']] != '') {
		    $section_title .= 'foodbakery_var_position_color="' . htmlspecialchars($data['foodbakery_var_position_color'][$counters['foodbakery_counter_testimonial']], ENT_QUOTES) . '" ';
		}
                $element_settings   = 'testimonial_element_size="'.htmlspecialchars( $data['testimonial_element_size'][$counters['foodbakery_global_counter_testimonial']] ).'"';
		$shortcode = '[foodbakery_testimonial ' . $element_settings.' '.$section_title . ' ]' . $shortcode_item . '[/foodbakery_testimonial]';
		$shortcode_data .= $shortcode;
		$counters['foodbakery_counter_testimonial'] ++;
	    }
	    $counters['foodbakery_global_counter_testimonial'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_testimonial', 'foodbakery_save_page_builder_data_testimonial_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_testimonial_callback')) {

    /**
     * Populate testimonial shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_testimonial_callback($counters) {
	$counters['foodbakery_counter_testimonial'] = 0;
	$counters['foodbakery_counter_testimonial_node'] = 0;
	$counters['foodbakery_shortcode_counter_testimonial'] = 0;
	$counters['foodbakery_global_counter_testimonial'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_testimonial_callback');
}

if (!function_exists('foodbakery_shortcode_names_list_populate_testimonial_callback')) {

    /**
     * Populate testimonial shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_testimonial_callback($shortcode_array) {
	$shortcode_array['testimonial'] = array(
	    'title' => foodbakery_var_frame_text_srt('foodbakery_var_testimonial'),
	    'name' => 'testimonial',
	    'icon' => 'icon-comments-o',
	    'categories' => 'loops',
	);
	return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_testimonial_callback');
}

if (!function_exists('foodbakery_element_list_populate_testimonial_callback')) {

    /**
     * Populate testimonial shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_testimonial_callback($element_list) {
	$element_list['testimonial'] = foodbakery_var_frame_text_srt('foodbakery_var_testimonial');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_testimonial_callback');
}

if (!function_exists('foodbakery_shortcode_sub_element_ui_testimonial_callback')) {

    /**
     * Render UI for sub element in testimonial settings.
     *
     * @param	array $args
     */
    function foodbakery_shortcode_sub_element_ui_testimonial_callback($args) {
	$type = $args['type'];
	$foodbakery_var_html_fields = $args['html_fields'];
	if ($type == 'testimonial') {
	    $rand_id = rand(324335, 9234299);
	    ?>
	    <div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content'  id="foodbakery_infobox_<?php echo intval($rand_id); ?>">
	        <header>
	    	<h4><i class='icon-arrows'></i><?php echo esc_html(foodbakery_var_frame_text_srt('foodbakery_var_testimonial')); ?></h4>
	    	<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo esc_html(foodbakery_var_frame_text_srt('foodbakery_var_remove')); ?></a>
	        </header>
		<?php
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_frame_text_srt('foodbakery_var_testimonial_text'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_text_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => '',
			'cust_id' => '',
			'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
			'cust_name' => 'foodbakery_var_testimonial_content[]',
			'return' => true,
			'classes' => '',
			'foodbakery_editor' => true,
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_textarea_field($foodbakery_opt_array);
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_frame_text_srt('foodbakery_var_author'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_author_hint'),
		    'echo' => true,
		    'classes' => 'txtfield',
		    'field_params' => array(
			'std' => '',
			'cust_id' => '',
			'cust_name' => 'foodbakery_var_testimonial_author[]',
			'return' => true,
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
		$foodbakery_opt_array = array(
		    'std' => '',
		    'id' => 'testimonial_author_image',
		    'name' => foodbakery_var_frame_text_srt('foodbakery_var_image'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_image_hint'),
		    'echo' => true,
		    'array' => true,
		    'prefix' => '',
		    'field_params' => array(
			'std' => '',
			'id' => 'testimonial_author_image',
			'return' => true,
			'array' => true,
			'array_txt' => false,
			'prefix' => '',
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_upload_file_field($foodbakery_opt_array);
		?>
	    </div>
	    <?php
	}
    }

    add_action('foodbakery_shortcode_sub_element_ui', 'foodbakery_shortcode_sub_element_ui_testimonial_callback');
}