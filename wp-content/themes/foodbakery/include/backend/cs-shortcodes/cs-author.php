<?php
/*
 *
 * @File : author
 * @retrun
 *
 */
if (!function_exists('foodbakery_var_page_builder_author')) {

    function foodbakery_var_page_builder_author($die = 0) {
	global $foodbakery_var_node, $post, $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_short_code_strings();
	$strings->foodbakery_theme_option_strings();
	$shortcode_element = '';
	$filter_element = 'filterdrag';
	$shortcode_view = '';
	$output = array();
	$counter = $_POST['counter'];
	$foodbakery_counter = $_POST['counter'];
	if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
	    $POSTID = '';
	    $shortcode_element_id = '';
	} else {
	    $POSTID = $_POST['POSTID'];
	    $shortcode_element_id = $_POST['shortcode_element_id'];
	    $shortcode_str = stripslashes($shortcode_element_id);
	    $PREFIX = 'foodbakery_author';
	    $parseObject = new ShortcodeParse();
	    $output = $parseObject->foodbakery_shortcodes($output, $shortcode_str, true, $PREFIX);
	}
	$defaults = array(
	    'foodbakery_author_element_title' => '',
	    'foodbakery_author_orderby' => 'DESC',
	    'foodbakery_author_description' => 'yes',
	    'foodbakery_author_excerpt' => '30',
	    'foodbakery_author_num_post' => '5',
	    'author_pagination' => '',
            'foodbakery_var_author_tabs_align' => '',
	);
	if (isset($output['0']['atts'])) {
	    $atts = $output['0']['atts'];
	} else {
	    $atts = array();
	}
	$author_element_size = '50';
	foreach ($defaults as $key => $values) {
	    if (isset($atts[$key])) {
		$$key = $atts[$key];
	    } else {
		$$key = $values;
	    }
	}
	$name = 'author';
	$coloumn_class = 'column_' . $author_element_size;
	$foodbakery_author_element_title = isset($foodbakery_author_element_title) ? $foodbakery_author_element_title : '';
	$foodbakery_author_orderby = isset($foodbakery_author_orderby) ? $foodbakery_author_orderby : '';
	$foodbakery_author_description = isset($foodbakery_author_description) ? $foodbakery_author_description : '';
	$foodbakery_author_excerpt = isset($foodbakery_author_excerpt) ? $foodbakery_author_excerpt : '';
	$foodbakery_author_num_post = isset($foodbakery_author_num_post) ? $foodbakery_author_num_post : '';
        $foodbakery_var_author_tabs_align = isset($foodbakery_var_author_tabs_align) ? $foodbakery_var_author_tabs_align : '';
	$author_pagination = isset($author_pagination) ? $author_pagination : '';
	if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
	    $shortcode_element = 'shortcode_element_class';
	    $shortcode_view = 'cs-pbwp-shortcode';
	    $filter_element = 'ajax-drag';
	    $coloumn_class = '';
	}
	$foodbakery_rand_id = rand(13441324, 93441324);
	?>
	<div id="<?php echo esc_attr($name . $foodbakery_counter); ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="author" data="<?php echo foodbakery_element_size_data_array_index($author_element_size) ?>">
	    <?php foodbakery_element_setting($name, $foodbakery_counter, $author_element_size); ?>
	    <div class="cs-wrapp-class-<?php echo intval($foodbakery_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $foodbakery_counter) ?>" data-shortcode-template="[foodbakery_author {{attributes}}]"  style="display: none;">
		<div class="cs-heading-area">
		    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_edit_author_items')); ?></h5>
		    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo esc_js($name . $foodbakery_counter); ?>','<?php echo esc_js($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
		</div>
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
				'std' => esc_attr($foodbakery_author_element_title),
				'cust_id' => '',
				'cust_name' => 'foodbakery_author_element_title[]',
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
                                        'std' => $foodbakery_var_author_tabs_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_author_tabs_align',
                                        'cust_name' => 'foodbakery_var_author_tabs_align[]',
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
			<div id="Blog-listing<?php echo intval($foodbakery_counter); ?>" >
			    <?php
			    $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_author_post_order'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_author_post_order_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => $foodbakery_author_orderby,
				    'id' => '',
				    'cust_name' => 'foodbakery_author_orderby[]',
				    'classes' => 'dropdown chosen-select-no-single select-medium',
				    'options' => array(
					'ASC' => foodbakery_var_theme_text_srt('foodbakery_var_author_asc'),
					'DESC' => foodbakery_var_theme_text_srt('foodbakery_var_author_desc'),
				    ),
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
			    $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_author_description'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_author_description_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => $foodbakery_author_description,
				    'id' => '',
				    'cust_name' => 'foodbakery_author_description[]',
				    'classes' => 'dropdown chosen-select-no-single select-medium',
				    'options' => array(
					'yes' => foodbakery_var_theme_text_srt('foodbakery_var_yes'),
					'no' => foodbakery_var_theme_text_srt('foodbakery_var_no'),
				    ),
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
			    $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_length_author_excerpt'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_length_author_excerpt_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => esc_attr($foodbakery_author_excerpt),
				    'cust_id' => '',
				    'classes' => 'txtfield input-small',
				    'cust_name' => 'foodbakery_author_excerpt[]',
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			    ?>
			</div>
			<?php
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_author_per_page'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_author_per_page_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_attr($foodbakery_author_num_post),
				'cust_id' => '',
				'classes' => 'txtfield input-small',
				'cust_name' => 'foodbakery_author_num_post[]',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_author_pagination'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_author_pagination_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => $author_pagination,
				'id' => '',
				'cust_name' => 'author_pagination[]',
				'classes' => 'dropdown chosen-select-no-single select-medium',
				'options' => array(
				    'yes' => foodbakery_var_theme_text_srt('foodbakery_var_show_pagination'),
				    'no' => foodbakery_var_theme_text_srt('foodbakery_var_single_page'),
				),
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
			if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
			    ?>
	    		<ul class="form-elements insert-bg">
	    		    <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo esc_js(str_replace('foodbakery_', '', $name)); ?>', '<?php echo esc_js($name . $foodbakery_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_insert')); ?></a> </li>
	    		</ul>
	    		<div id="results-shortocde"></div>
			<?php
			} else {
			    $foodbakery_opt_array = array(
				'std' => 'author',
				'id' => '',
				'before' => '',
				'after' => '',
				'classes' => '',
				'extra_atr' => '',
				'cust_id' => 'foodbakery_orderby' . $foodbakery_counter,
				'cust_name' => 'foodbakery_orderby[]',
				'required' => false
			    );
			    $foodbakery_var_form_fields->foodbakery_var_form_hidden_render($foodbakery_opt_array);
			    $foodbakery_opt_array = array(
				'id' => '',
				'std' => absint($foodbakery_rand_id),
				'cust_id' => "",
				'cust_name' => "foodbakery_author_id[]",
			    );
			    $foodbakery_var_form_fields->foodbakery_var_form_hidden_render($foodbakery_opt_array);
			    $foodbakery_opt_array = array(
				'name' => '',
				'desc' => '',
				'hint_text' => '',
				'echo' => true,
				'field_params' => array(
				    'std' => 'Save',
				    'cust_id' => '',
				    'cust_type' => 'button',
				    'classes' => 'cs-foodbakery-admin-btn',
				    'cust_name' => 'button',
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

    add_action('wp_ajax_foodbakery_var_page_builder_author', 'foodbakery_var_page_builder_author');
}
if (!function_exists('foodbakery_save_page_builder_data_author_callback')) {

    /**
     * Save data for author shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_author_callback($args) {

	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	if ($widget_type == "author" || $widget_type == "cs_author") {
            
	    $foodbakery_var_author = '';
            $page_element_size  =  $data['author_element_size'][$counters['foodbakery_global_counter_author']];
            $author_element_size  =  $data['author_element_size'][$counters['foodbakery_global_counter_author']];
            
	    if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes(( $data['shortcode']['author'][$counters['foodbakery_shortcode_counter_author']]));
		$element_settings   = 'author_element_size="'.$author_element_size.'"';
                $reg = '/author_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
                $counters['foodbakery_shortcode_counter_author'] ++;
	    } else {
                $foodbakery_var_author = '[foodbakery_author author_element_size="'.htmlspecialchars( $data['author_element_size'][$counters['foodbakery_global_counter_author']] ).'" ';
		if (isset($data['foodbakery_author_element_title'][$counters['foodbakery_counter_author']]) && $data['foodbakery_author_element_title'][$counters['foodbakery_counter_author']] != '') {
		    $foodbakery_var_author .= 'foodbakery_author_element_title="' . htmlspecialchars($data['foodbakery_author_element_title'][$counters['foodbakery_counter_author']], ENT_QUOTES) . '" ';
		}
                if (isset($data['foodbakery_var_author_tabs_align'][$counters['foodbakery_counter_author']]) && $data['foodbakery_var_author_tabs_align'][$counters['foodbakery_counter_author']] != '') {
		    $foodbakery_var_author .= 'foodbakery_var_author_tabs_align="' . htmlspecialchars($data['foodbakery_var_author_tabs_align'][$counters['foodbakery_counter_author']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_author_id'][$counters['foodbakery_counter_author']]) && $data['foodbakery_author_id'][$counters['foodbakery_counter_author']] != '') {
		    $foodbakery_author_id = $data['foodbakery_author_id'][$counters['foodbakery_counter_author']];
		}
		if (isset($data['foodbakery_author_orderby'][$counters['foodbakery_counter_author']]) && $data['foodbakery_author_orderby'][$counters['foodbakery_counter_author']] != '') {
		    $foodbakery_var_author .= 'foodbakery_author_orderby="' . htmlspecialchars($data['foodbakery_author_orderby'][$counters['foodbakery_counter_author']], ENT_QUOTES) . '" ';
		}
		if (isset($data['orderby'][$counters['foodbakery_counter_author']]) && $data['orderby'][$counters['foodbakery_counter_author']] != '') {
		    $foodbakery_var_author .= 'orderby="' . htmlspecialchars($data['orderby'][$counters['foodbakery_counter_author']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_author_description'][$counters['foodbakery_counter_author']]) && $data['foodbakery_author_description'][$counters['foodbakery_counter_author']] != '') {
		    $foodbakery_var_author .= 'foodbakery_author_description="' . htmlspecialchars($data['foodbakery_author_description'][$counters['foodbakery_counter_author']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_author_excerpt'][$counters['foodbakery_counter_author']]) && $data['foodbakery_author_excerpt'][$counters['foodbakery_counter_author']] != '') {
		    $foodbakery_var_author .= 'foodbakery_author_excerpt="' . htmlspecialchars($data['foodbakery_author_excerpt'][$counters['foodbakery_counter_author']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_author_num_post'][$counters['foodbakery_counter_author']]) && $data['foodbakery_author_num_post'][$counters['foodbakery_counter_author']] != '') {
		    $foodbakery_var_author .= 'foodbakery_author_num_post="' . htmlspecialchars($data['foodbakery_author_num_post'][$counters['foodbakery_counter_author']], ENT_QUOTES) . '" ';
		}
		if (isset($data['author_pagination'][$counters['foodbakery_counter_author']]) && $data['author_pagination'][$counters['foodbakery_counter_author']] != '') {
		    $foodbakery_var_author .= 'author_pagination="' . htmlspecialchars($data['author_pagination'][$counters['foodbakery_counter_author']], ENT_QUOTES) . '" ';
		}
		$foodbakery_var_author .= ']';
		if (isset($data['author_text'][$counters['foodbakery_counter_author']]) && $data['author_text'][$counters['foodbakery_counter_author']] != '') {
		    $foodbakery_var_author .= htmlspecialchars($data['author_text'][$counters['foodbakery_counter_author']], ENT_QUOTES) . ' ';
		}
		$foodbakery_var_author .= '[/foodbakery_author]';
                $shortcode_data .= $foodbakery_var_author;

		$counters['foodbakery_counter_author'] ++;
	    }
	    $counters['foodbakery_global_counter_author'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_author', 'foodbakery_save_page_builder_data_author_callback');
}
if (!function_exists('foodbakery_load_shortcode_counters_author_callback')) {

    /**
     * Populate author shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_author_callback($counters) {
	$counters['foodbakery_global_counter_author'] = 0;
	$counters['foodbakery_shortcode_counter_author'] = 0;
	$counters['foodbakery_counter_author'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_author_callback');
}
if (!function_exists('foodbakery_shortcode_names_list_populate_author_callback')) {

    /**
     * Populate author shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_author_callback($shortcode_array) {
	$shortcode_array['author'] = array(
	    'title' => foodbakery_var_frame_text_srt('foodbakery_var_author'),
	    'name' => 'author',
	    'icon' => 'icon-user3',
	    'categories' => 'typography',
	);
	return $shortcode_array;
    }

//icon-support2
    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_author_callback');
}
if (!function_exists('foodbakery_element_list_populate_author_callback')) {

    /**
     * Populate author shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_author_callback($element_list) {
	$element_list['author'] = foodbakery_var_frame_text_srt('foodbakery_var_author');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_author_callback');
}