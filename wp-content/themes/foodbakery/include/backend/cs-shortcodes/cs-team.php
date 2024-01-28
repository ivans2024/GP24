<?php
/*
 *
 * @Shortcode Name : Team
 * @retrun
 *
 * 
 */
if (!function_exists('foodbakery_var_page_builder_team')) {

    function foodbakery_var_page_builder_team($die = 0) {
	global $foodbakery_node, $count_node, $post, $foodbakery_var_html_fields, $foodbakery_var_form_fields;
	$shortcode_element = '';
	$filter_element = 'filterdrag';
	$shortcode_view = '';
	$output = array();
	$foodbakery_counter = $_POST['counter'];
	$team_num = 0;
	if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
	    $POSTID = '';
	    $shortcode_element_id = '';
	} else {
	    $POSTID = $_POST['POSTID'];
	    $shortcode_element_id = $_POST['shortcode_element_id'];
	    $shortcode_str = stripslashes($shortcode_element_id);
	    $PREFIX = 'foodbakery_team|foodbakery_team_item';
	    $parseObject = new ShortcodeParse();
	    $output = $parseObject->foodbakery_shortcodes($output, $shortcode_str, true, $PREFIX);
	}
	$defaults = array(
	    'foodbakery_var_team_title' => '',
	    'foodbakery_var_team_col' => '',
            'foodbakery_var_team_align' => '',
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
	    $team_num = count($atts_content);
	}
	$team_element_size = '25';
	foreach ($defaults as $key => $values) {
	    if (isset($atts[$key])) {
		$$key = $atts[$key];
	    } else {
		$$key = $values;
	    }
	}
	$name = 'foodbakery_var_page_builder_team';
	$coloumn_class = 'column_' . $team_element_size;
	$foodbakery_var_team_title = isset($foodbakery_var_team_title) ? $foodbakery_var_team_title : '';
	$foodbakery_var_team_col = isset($foodbakery_var_team_col) ? $foodbakery_var_team_col : '';
        $foodbakery_var_team_align = isset($foodbakery_var_team_align) ? $foodbakery_var_team_align : '';
	if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
	    $shortcode_element = 'shortcode_element_class';
	    $shortcode_view = 'cs-pbwp-shortcode';
	    $filter_element = 'ajax-drag';
	    $coloumn_class = '';
	}
	global $foodbakery_var_static_text;
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_short_code_strings();
	$strings->foodbakery_theme_option_field_strings();
	?>
	<div id="<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>_del" class="column  parentdelete <?php echo foodbakery_allow_special_char($coloumn_class); ?> <?php echo foodbakery_allow_special_char($shortcode_view); ?>" item="team" data="<?php echo foodbakery_element_size_data_array_index($team_element_size) ?>" >
	    <?php foodbakery_element_setting($name, $foodbakery_counter, $team_element_size, '', 'comments-o', $type = ''); ?>
	    <div class="cs-wrapp-class-<?php echo foodbakery_allow_special_char($foodbakery_counter) ?> <?php echo foodbakery_allow_special_char($shortcode_element); ?>" id="<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>" style="display: none;">
		<div class="cs-heading-area">
		    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_team_edit_options')); ?></h5>
		    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>','<?php echo foodbakery_allow_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
		</div>
		<div class="cs-clone-append cs-pbwp-content">
		    <div class="cs-wrapp-tab-box">
			<div id="shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>" data-shortcode-template="{{child_shortcode}} [/foodbakery_team]" data-shortcode-child-template="[foodbakery_team_item {{attributes}}] {{content}} [/foodbakery_team_item]">
			    <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[foodbakery_team {{attributes}}]">
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
					'std' => foodbakery_allow_special_char($foodbakery_var_team_title),
					'id' => 'team_title' . $foodbakery_counter,
					'cust_name' => 'foodbakery_var_team_title[]',
					'classes' => '',
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
                                        'std' => $foodbakery_var_team_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_team_align',
                                        'cust_name' => 'foodbakery_var_team_align[]',
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
				    'name' => foodbakery_var_theme_text_srt('foodbakery_var_col'),
				    'desc' => '',
				    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_sel_col_hint'),
				    'echo' => true,
				    'field_params' => array(
					'std' => $foodbakery_var_team_col,
					'id' => '',
					'cust_name' => 'foodbakery_var_team_col[]',
					'classes' => 'dropdown chosen-select',
					'options' => array(
					    '1' => foodbakery_var_theme_text_srt('foodbakery_var_one_col'),
					    '2' => foodbakery_var_theme_text_srt('foodbakery_var_two_col'),
					    '3' => foodbakery_var_theme_text_srt('foodbakery_var_three_col'),
					    '4' => foodbakery_var_theme_text_srt('foodbakery_var_four_col'),
					    '6' => foodbakery_var_theme_text_srt('foodbakery_var_six_col'),
					),
					'return' => true,
				    ),
				);
				$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
				?>
			    </div>
			    <?php
			    if (isset($team_num) && $team_num <> '' && isset($atts_content) && is_array($atts_content)) {
				foreach ($atts_content as $team) {
				    $rand_id = rand(3333, 99999);
				    $foodbakery_var_team_text = $team['content'];
				    $defaults = array(
					'foodbakery_var_team_name' => '',
					'foodbakery_var_team_designation' => '',
					'foodbakery_var_team_image' => '',
					'foodbakery_var_team_link' => ''
				    );
				    foreach ($defaults as $key => $values) {
					if (isset($team['atts'][$key]))
					    $$key = $team['atts'][$key];
					else
					    $$key = $values;
				    }
				    $foodbakery_var_team_name = isset($foodbakery_var_team_name) ? $foodbakery_var_team_name : '';
				    $foodbakery_var_team_designation = isset($foodbakery_var_team_designation) ? $foodbakery_var_team_designation : '';
				    $foodbakery_var_team_link = isset($foodbakery_var_team_link) ? $foodbakery_var_team_link : '';
				    $foodbakery_var_team_image = isset($foodbakery_var_team_image) ? $foodbakery_var_team_image : '';
				    ?>
				    <div class='cs-wrapp-clone cs-shortcode-wrapp  cs-pbwp-content'  id="foodbakery_infobox_<?php echo foodbakery_allow_special_char($rand_id); ?>">
					<header>
					    <h4><i class='icon-arrows'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_team_sc')); ?></h4>
					    <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_remove')); ?></a></header>
					<?php
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_team_sc_name'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_team_sc_name_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_html($foodbakery_var_team_name),
						'id' => 'team_name' . $foodbakery_counter,
						'cust_name' => 'foodbakery_var_team_name[]',
						'classes' => '',
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_team_sc_designation'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_team_sc_designation_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_html($foodbakery_var_team_designation),
						'id' => 'team_designation' . $foodbakery_counter,
						'cust_name' => 'foodbakery_var_team_designation[]',
						'classes' => '',
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_team_sc_link'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_team_sc_link_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_html($foodbakery_var_team_link),
						'id' => 'team_link' . $foodbakery_counter,
						'cust_name' => 'foodbakery_var_team_link[]',
						'classes' => '',
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'std' => $foodbakery_var_team_image,
					    'id' => 'team_image_array',
					    'main_id' => 'team_image_array',
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_team_sc_image'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_team_sc_image_hint'),
					    'echo' => true,
					    'array' => true,
					    'field_params' => array(
						'std' => $foodbakery_var_team_image,
						'cust_id' => '',
						'cust_name' => 'foodbakery_var_team_image[]',
						'id' => 'team_image_array',
						'return' => true,
						'array' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_upload_file_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_team_sc_content'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_team_sc_content_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => foodbakery_allow_special_char($foodbakery_var_team_text),
						'id' => 'team_text',
						'cust_name' => 'foodbakery_var_team_text[]',
						'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
						'return' => true,
						'classes' => '',
						'foodbakery_editor' => true
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_textarea_field($foodbakery_opt_array);
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
				'std' => $team_num,
				'id' => '',
				'before' => '',
				'after' => '',
				'classes' => 'fieldCounter',
				'extra_atr' => '',
				'cust_id' => '',
				'cust_name' => 'team_num[]',
				'return' => false,
				'required' => false
			    );
			    $foodbakery_var_form_fields->foodbakery_var_form_hidden_render($foodbakery_opt_array);
			    ?>
			</div>
			<div class="wrapptabbox">
			    <div class="opt-conts">
				<ul class="form-elements noborder">
				    <li class="to-field"> <a href="javascript:void(0);" class="add_servicesss cs-main-btn" onclick="foodbakery_shortcode_element_ajax_call('team', 'shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>', '<?php echo foodbakery_allow_special_char(admin_url('admin-ajax.php')); ?>')"><i class="icon-plus-circle"></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_team_sc_add_item')); ?></a> </li>
				    <div id="loading" class="shortcodeload"></div>
				</ul>
				<?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
	    			<ul class="form-elements insert-bg">
	    			    <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo esc_js(str_replace('foodbakery_var_page_builder_', '', $name)); ?>', 'shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>', '<?php echo foodbakery_allow_special_char($filter_element); ?>')" ><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_insert')); ?></a> </li>
	    			</ul>
	    			<div id="results-shortocde"></div>
				    <?php
				} else {
				    $foodbakery_opt_array = array(
					'std' => 'team',
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
	?>
	<?php
    }

    add_action('wp_ajax_foodbakery_var_page_builder_team', 'foodbakery_var_page_builder_team');
}

if (!function_exists('foodbakery_save_page_builder_data_team_callback')) {

    /**
     * Save data for team shortcode.
     * @param	array $args
     * @return	array
     */
    
    function foodbakery_save_page_builder_data_team_callback($args) {

	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	if ($widget_type == "team" || $widget_type == "cs_team") {
	    $shortcode = $shortcode_item = '';
            $page_element_size    =  $data['team_element_size'][$counters['foodbakery_global_counter_team']];
            $team_element_size  =  $data['team_element_size'][$counters['foodbakery_global_counter_team']];
	    if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes($data['shortcode']['team'][$counters['foodbakery_shortcode_counter_team']]);
                $element_settings   = 'team_element_size="'.$team_element_size.'"';
                $reg = '/team_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
		$counters['foodbakery_shortcode_counter_team'] ++;
	    } else {
		if (isset($data['team_num'][$counters['foodbakery_counter_team']]) && $data['team_num'][$counters['foodbakery_counter_team']] > 0) {
		    for ($i = 1; $i <= $data['team_num'][$counters['foodbakery_counter_team']]; $i ++) {
			$shortcode_item .= '[foodbakery_team_item ';
			if (isset($data['foodbakery_var_team_name'][$counters['foodbakery_counter_team_node']]) && $data['foodbakery_var_team_name'][$counters['foodbakery_counter_team_node']] != '') {
			    $shortcode_item .= 'foodbakery_var_team_name="' . htmlspecialchars($data['foodbakery_var_team_name'][$counters['foodbakery_counter_team_node']], ENT_QUOTES) . '" ';
			}
			if (isset($data['foodbakery_var_team_designation'][$counters['foodbakery_counter_team_node']]) && $data['foodbakery_var_team_designation'][$counters['foodbakery_counter_team_node']] != '') {
			    $shortcode_item .= 'foodbakery_var_team_designation="' . htmlspecialchars($data['foodbakery_var_team_designation'][$counters['foodbakery_counter_team_node']], ENT_QUOTES) . '" ';
			}
			if (isset($data['foodbakery_var_team_link'][$counters['foodbakery_counter_team_node']]) && $data['foodbakery_var_team_link'][$counters['foodbakery_counter_team_node']] != '') {
			    $shortcode_item .= 'foodbakery_var_team_link="' . htmlspecialchars($data['foodbakery_var_team_link'][$counters['foodbakery_counter_team_node']], ENT_QUOTES) . '" ';
			}
			if (isset($data['foodbakery_var_team_image'][$counters['foodbakery_counter_team_node']]) && $data['foodbakery_var_team_image'][$counters['foodbakery_counter_team_node']] != '') {
			    $shortcode_item .= 'foodbakery_var_team_image="' . htmlspecialchars($data['foodbakery_var_team_image'][$counters['foodbakery_counter_team_node']], ENT_QUOTES) . '" ';
			}
			$shortcode_item .= ']';
			if (isset($data['foodbakery_var_team_text'][$counters['foodbakery_counter_team_node']]) && $data['foodbakery_var_team_text'][$counters['foodbakery_counter_team_node']] != '') {
			    $shortcode_item .= htmlspecialchars($data['foodbakery_var_team_text'][$counters['foodbakery_counter_team_node']], ENT_QUOTES);
			}
			$shortcode_item .= '[/foodbakery_team_item]';
			$counters['foodbakery_counter_team_node'] ++;
		    }
		}
		$section_title = '';
		if (isset($data['foodbakery_var_team_title'][$counters['foodbakery_counter_team']]) && $data['foodbakery_var_team_title'][$counters['foodbakery_counter_team']] != '') {
		    $section_title .= 'foodbakery_var_team_title="' . htmlspecialchars($data['foodbakery_var_team_title'][$counters['foodbakery_counter_team']], ENT_QUOTES) . '" ';
		}
                if (isset($data['foodbakery_var_team_align'][$counters['foodbakery_counter_team']]) && $data['foodbakery_var_team_align'][$counters['foodbakery_counter_team']] != '') {
		    $section_title .= 'foodbakery_var_team_align="' . htmlspecialchars($data['foodbakery_var_team_align'][$counters['foodbakery_counter_team']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_team_col'][$counters['foodbakery_counter_team']]) && $data['foodbakery_var_team_col'][$counters['foodbakery_counter_team']] != '') {
		    $section_title .= 'foodbakery_var_team_col="' . htmlspecialchars($data['foodbakery_var_team_col'][$counters['foodbakery_counter_team']], ENT_QUOTES) . '" ';
		}
		$shortcode = '[foodbakery_team team_element_size="'.htmlspecialchars( $data['team_element_size'][$counters['foodbakery_global_counter_team']] ).'" ' . $section_title . ' ]' . $shortcode_item . '[/foodbakery_team]';
                $shortcode_data .= $shortcode;
		$counters['foodbakery_counter_team'] ++;
	    }
	    $counters['foodbakery_global_counter_team'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_team', 'foodbakery_save_page_builder_data_team_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_team_callback')) {

    /**
     * Populate team shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_team_callback($counters) {
	$counters['foodbakery_shortcode_counter_team'] = 0;
	$counters['foodbakery_global_counter_team'] = 0;
	$counters['foodbakery_counter_team'] = 0;
	$counters['foodbakery_counter_team_node'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_team_callback');
}

if (!function_exists('foodbakery_shortcode_names_list_populate_team_callback')) {

    /**
     * Populate team shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_team_callback($shortcode_array) {
	$shortcode_array['team'] = array(
	    'title' => foodbakery_var_frame_text_srt('foodbakery_var_team'),
	    'name' => 'team',
	    'icon' => 'icon-user',
	    'categories' => 'loops',
	);
	return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_team_callback');
}

if (!function_exists('foodbakery_element_list_populate_team_callback')) {

    /**
     * Populate team shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_team_callback($element_list) {
	$element_list['team'] = foodbakery_var_frame_text_srt('foodbakery_var_team');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_team_callback');
}

if (!function_exists('foodbakery_shortcode_sub_element_ui_team_callback')) {

    /**
     * Render UI for sub element in team settings.
     *
     * @param	array $args
     */
    function foodbakery_shortcode_sub_element_ui_team_callback($args) {
	$type = $args['type'];
	$foodbakery_var_html_fields = $args['html_fields'];
	if ($type == 'team') {
	    $rand_id = 'multiple_team_' . rand(455345, 23454390);
	    ?>
	    <div class='cs-wrapp-clone cs-shortcode-wrapp  cs-pbwp-content'  id="foodbakery_infobox_<?php echo foodbakery_allow_special_char($rand_id); ?>">
	        <header>
	    	<h4><i class='icon-arrows'></i><?php echo foodbakery_var_frame_text_srt('foodbakery_var_team_sc'); ?></h4>
	    	<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo foodbakery_var_frame_text_srt('foodbakery_var_remove'); ?></a></header>
			<?php
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_frame_text_srt('foodbakery_var_team_sc_name'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_team_sc_name_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => '',
				'id' => 'team_name',
				'cust_name' => 'foodbakery_var_team_name[]',
				'classes' => '',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_frame_text_srt('foodbakery_var_team_sc_designation'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_team_sc_designation_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => '',
				'id' => 'team_designation',
				'cust_name' => 'foodbakery_var_team_designation[]',
				'classes' => '',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_team_sc_link'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_team_sc_link_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_html($foodbakery_var_team_link),
				'id' => 'team_link' . $foodbakery_counter,
				'cust_name' => 'foodbakery_var_team_link[]',
				'classes' => '',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

			$foodbakery_opt_array = array(
			    'std' => '',
			    'id' => 'team_image_array',
			    'main_id' => 'team_image_array',
			    'name' => foodbakery_var_frame_text_srt('foodbakery_var_team_sc_image'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_team_sc_image_hint'),
			    'echo' => true,
			    'array' => true,
			    'field_params' => array(
				'std' => '',
				'cust_id' => '',
				'cust_name' => 'foodbakery_var_team_image[]',
				'id' => 'team_image_array',
				'return' => true,
				'array' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_upload_file_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_team_sc_content'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_team_sc_content_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => '',
				'id' => 'team_text',
				'cust_name' => 'foodbakery_var_team_text[]',
				'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
				'return' => true,
				'classes' => '',
				'foodbakery_editor' => true
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_textarea_field($foodbakery_opt_array);
			?>
	    </div>
	    <?php
	}
    }

    add_action('foodbakery_shortcode_sub_element_ui', 'foodbakery_shortcode_sub_element_ui_team_callback');
}