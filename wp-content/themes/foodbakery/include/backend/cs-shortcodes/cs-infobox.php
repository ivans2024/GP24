<?php
/*
 *
 * @Shortcode Name : Button
 * @retrun
 *
 */

if (!function_exists('foodbakery_var_page_builder_infobox')) {

    function foodbakery_var_page_builder_infobox($die = 0) {
	global $foodbakery_node, $count_node, $post, $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_short_code_strings();
	$shortcode_element = '';
	$filter_element = 'filterdrag';
	$shortcode_view = '';
	$output = array();
	$foodbakery_counter = $_POST['counter'];
	$PREFIX = 'foodbakery_infobox|infobox_item';
	$parseObject = new ShortcodeParse();
	$infobox_num = 0;
	if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
	    $POSTID = '';
	    $shortcode_element_id = '';
	} else {
	    $POSTID = $_POST['POSTID'];
	    $shortcode_element_id = $_POST['shortcode_element_id'];
	    $shortcode_str = stripslashes($shortcode_element_id);
	    $output = $parseObject->foodbakery_shortcodes($output, $shortcode_str, true, $PREFIX);
	}
	$defaults = array(
	    'foodbakery_var_column_size' => '',
	    'foodbakery_var_infobox_main_title' => '',
	    'foodbakery_var_info_icon_color' => '',
            'foodbakery_var_infobox_align' => '',
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
	    $infobox_num = count($atts_content);
	}
	$infobox_element_size = '50';
	foreach ($defaults as $key => $values) {
	    if (isset($atts[$key])) {
		$$key = $atts[$key];
	    } else {
		$$key = $values;
	    }
	}
	$name = 'foodbakery_var_page_builder_infobox';
	$coloumn_class = 'column_' . $infobox_element_size;
	$foodbakery_var_infobox_main_title = isset($foodbakery_var_infobox_main_title) ? $foodbakery_var_infobox_main_title : '';
	$foodbakery_var_info_icon_color = isset($foodbakery_var_info_icon_color) ? $foodbakery_var_info_icon_color : '';
        $foodbakery_var_infobox_align = isset($foodbakery_var_infobox_align) ? $foodbakery_var_infobox_align : '';
	if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
	    $shortcode_element = 'shortcode_element_class';
	    $shortcode_view = 'cs-pbwp-shortcode';
	    $filter_element = 'ajax-drag';
	    $coloumn_class = '';
	}
	?>
	<div id="<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>_del" class="column  parentdelete <?php echo foodbakery_allow_special_char($coloumn_class); ?> <?php echo foodbakery_allow_special_char($shortcode_view); ?>" item="infobox" data="<?php echo foodbakery_element_size_data_array_index($infobox_element_size) ?>" >
	    <?php foodbakery_element_setting($name, $foodbakery_counter, $infobox_element_size, '', 'list-ul'); ?>
	    <div class="cs-wrapp-class-<?php echo foodbakery_allow_special_char($foodbakery_counter) ?> <?php echo foodbakery_allow_special_char($shortcode_element); ?>" id="<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>" data-shortcode-template="[foodbakery_infobox {{attributes}}]" style="display: none;">
		<div class="cs-heading-area">
		    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_infobox_edit_options')); ?></h5>
		    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>','<?php echo foodbakery_allow_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
		<div class="cs-clone-append cs-pbwp-content">
		    <div class="cs-wrapp-tab-box">
			<div id="shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>" data-shortcode-template="{{child_shortcode}}[/<?php echo esc_attr('foodbakery_infobox'); ?>]" data-shortcode-child-template="[<?php echo esc_attr('infobox_item'); ?> {{attributes}}] {{content}} [/<?php echo esc_attr('infobox_item'); ?>]">
			    <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[<?php echo esc_attr('foodbakery_infobox'); ?> {{attributes}}]">
				<?php
				$foodbakery_opt_array = array(
				    'name' => foodbakery_var_theme_text_srt('foodbakery_var_element_title'),
				    'desc' => '',
				    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_element_title_hint'),
				    'echo' => true,
				    'field_params' => array(
					'std' => foodbakery_allow_special_char($foodbakery_var_infobox_main_title),
					'id' => 'foodbakery_var_infobox_main_title',
					'cust_name' => 'foodbakery_var_infobox_main_title[]',
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
                                        'std' => $foodbakery_var_infobox_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_infobox_align',
                                        'cust_name' => 'foodbakery_var_infobox_align[]',
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
                                
				if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
				    foodbakery_shortcode_element_size();
				}
				$foodbakery_opt_array = array(
				    'name' => foodbakery_var_theme_text_srt('foodbakery_var_infobox_icon_color'),
				    'desc' => '',
				    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_infobox_icon_color_hint'),
				    'echo' => true,
				    'field_params' => array(
					'std' => esc_attr($foodbakery_var_info_icon_color),
					'cust_id' => 'foodbakery_var_info_icon_color' . $foodbakery_counter,
					'classes' => 'bg_color',
					'cust_name' => 'foodbakery_var_info_icon_color[]',
					'return' => true,
				    ),
				);
				$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
				?>
			    </div>
			    <?php
			    if (isset($infobox_num) && $infobox_num <> '' && isset($atts_content) && is_array($atts_content)) {
				foreach ($atts_content as $infobox) {
				    $rand_id = rand(3333, 99999);
				    $foodbakery_var_infobox_text = $infobox['content'];
				    $defaults = array('foodbakery_var_infobox_title' => 'Title', 'foodbakery_var_infobox_active' => 'yes', 'foodbakery_var_icon_box' => '');
				    foreach ($defaults as $key => $values) {
					if (isset($infobox['atts'][$key]))
					    $$key = $infobox['atts'][$key];
					else
					    $$key = $values;
				    }
				    $foodbakery_var_infobox_active = isset($foodbakery_var_infobox_active) ? $foodbakery_var_infobox_active : '';
				    $foodbakery_var_infobox_title = isset($foodbakery_var_infobox_title) ? $foodbakery_var_infobox_title : '';
				    ?>
				    <div class='cs-wrapp-clone cs-shortcode-wrapp  cs-pbwp-content'  id="foodbakery_infobox_<?php echo foodbakery_allow_special_char($rand_id); ?>">
					<header>
					    <h4><i class='icon-arrows'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_infobox')); ?></h4>
					    <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_remove')); ?></a></header>
					<div class="form-elements" id="foodbakery_infobox_<?php echo esc_attr($rand_id); ?>">
					    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_infobox_icon')); ?></label>
						<?php
						if (function_exists('foodbakery_var_tooltip_helptext')) {
						    echo foodbakery_var_tooltip_helptext(foodbakery_var_theme_text_srt('foodbakery_var_infobox_icon_hint'));
						}
						?>
					    </div>
					    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
						<?php echo foodbakery_var_icomoon_icons_box($foodbakery_var_icon_box, esc_attr($rand_id), 'foodbakery_var_icon_box'); ?>
					    </div>
					</div>
					<?php
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_infobox_content'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_infobox_content_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => foodbakery_allow_special_char($foodbakery_var_infobox_text),
						'id' => 'foodbakery_var_infobox_text',
						'cust_name' => 'foodbakery_var_infobox_text[]',
						'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
						'classes' => '',
						'return' => true,
						'foodbakery_editor' => true,
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
				'std' => $infobox_num,
				'id' => '',
				'before' => '',
				'after' => '',
				'classes' => 'fieldCounter',
				'extra_atr' => '',
				'cust_id' => '',
				'cust_name' => 'infobox_num[]',
				'return' => false,
				'required' => false
			    );
			    $foodbakery_var_form_fields->foodbakery_var_form_hidden_render($foodbakery_opt_array);
			    ?>
			</div>
			<div class="wrapptabbox">
			    <div class="opt-conts">
				<ul class="form-elements noborder">
				    <li class="to-field"> <a href="javascript:void(0);" class="add_servicesss cs-main-btn" onclick="foodbakery_shortcode_element_ajax_call('infobox', 'shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>', '<?php echo foodbakery_allow_special_char(admin_url('admin-ajax.php')); ?>')"><i class="icon-plus-circle"></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_add_infobox')); ?></a> </li>
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
					'std' => 'infobox',
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
    }

    add_action('wp_ajax_foodbakery_var_page_builder_infobox', 'foodbakery_var_page_builder_infobox');
}


if (!function_exists('foodbakery_save_page_builder_data_infobox_callback')) {

    /**
     * Save data for infobox shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_infobox_callback($args) {
	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	if ($widget_type == "infobox" || $widget_type == "cs_infobox") {
	    $shortcode = $shortcode_item = '';
            $page_element_size     =  $data['infobox_element_size'][$counters['foodbakery_global_counter_infobox']];
            $current_element_size  =  $data['infobox_element_size'][$counters['foodbakery_global_counter_infobox']];
	    if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes($data['shortcode']['infobox'][$counters['foodbakery_shortcode_counter_infobox']]);
		
                $element_settings   = 'infobox_element_size="'.$current_element_size.'"';
                $reg = '/infobox_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
                $counters['foodbakery_shortcode_counter_infobox'] ++;
	    } else {
		if (isset($data['infobox_num'][$counters['foodbakery_counter_infobox']]) && $data['infobox_num'][$counters['foodbakery_counter_infobox']] > 0) {
		    for ($i = 1; $i <= $data['infobox_num'][$counters['foodbakery_counter_infobox']]; $i ++) {
			$shortcode_item .= '[infobox_item ';
			if (isset($data['foodbakery_var_icon_box'][$counters['foodbakery_counter_infobox_node']]) && $data['foodbakery_var_icon_box'][$counters['foodbakery_counter_infobox_node']] != '') {
			    $shortcode_item .= 'foodbakery_var_icon_box="' . htmlspecialchars($data['foodbakery_var_icon_box'][$counters['foodbakery_counter_infobox_node']], ENT_QUOTES) . '" ';
			}
			$shortcode_item .= ']';
			if (isset($data['foodbakery_var_infobox_text'][$counters['foodbakery_counter_infobox_node']]) && $data['foodbakery_var_infobox_text'][$counters['foodbakery_counter_infobox_node']] != '') {
			    $shortcode_item .= htmlspecialchars($data['foodbakery_var_infobox_text'][$counters['foodbakery_counter_infobox_node']], ENT_QUOTES);
			}
			$shortcode_item .= '[/infobox_item]';
			$counters['foodbakery_counter_infobox_node'] ++;
		    }
		}
		$section_title = '';
		if (isset($data['foodbakery_var_infobox_main_title'][$counters['foodbakery_counter_infobox']]) && $data['foodbakery_var_infobox_main_title'][$counters['foodbakery_counter_infobox']] != '') {
		    $section_title .= 'foodbakery_var_infobox_main_title="' . htmlspecialchars($data['foodbakery_var_infobox_main_title'][$counters['foodbakery_counter_infobox']], ENT_QUOTES) . '" ';
		}
                if (isset($data['foodbakery_var_infobox_align'][$counters['foodbakery_counter_infobox']]) && $data['foodbakery_var_infobox_align'][$counters['foodbakery_counter_infobox']] != '') {
		    $section_title .= 'foodbakery_var_infobox_align="' . htmlspecialchars($data['foodbakery_var_infobox_align'][$counters['foodbakery_counter_infobox']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_info_icon_color'][$counters['foodbakery_counter_infobox']]) && $data['foodbakery_var_info_icon_color'][$counters['foodbakery_counter_infobox']] != '') {
		    $section_title .= 'foodbakery_var_info_icon_color="' . htmlspecialchars($data['foodbakery_var_info_icon_color'][$counters['foodbakery_counter_infobox']], ENT_QUOTES) . '" ';
		}
                $element_settings   = 'infobox_element_size="'.htmlspecialchars( $data['infobox_element_size'][$counters['foodbakery_global_counter_infobox']] ).'"';
		$shortcode = '[foodbakery_infobox ' . $element_settings.' '.$section_title . ' ]' . $shortcode_item . '[/foodbakery_infobox]';
		$shortcode_data .= $shortcode;
		$counters['foodbakery_counter_infobox'] ++;
	    }
	    $counters['foodbakery_global_counter_infobox'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_infobox', 'foodbakery_save_page_builder_data_infobox_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_infobox_callback')) {

    /**
     * Populate infobox shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_infobox_callback($counters) {
	$counters['foodbakery_global_counter_infobox'] = 0;
	$counters['foodbakery_shortcode_counter_infobox'] = 0;
	$counters['foodbakery_counter_infobox_node'] = 0;
	$counters['foodbakery_counter_infobox'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_infobox_callback');
}

if (!function_exists('foodbakery_shortcode_names_list_populate_infobox_callback')) {

    /**
     * Populate infobox shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_infobox_callback($shortcode_array) {
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_short_code_strings();
	$shortcode_array['infobox'] = array(
	    'title' => foodbakery_var_theme_text_srt('foodbakery_var_infobox'),
	    'name' => 'infobox',
	    'icon' => 'fa icon-info-circle',
	    'categories' => 'contentblocks',
	);
	return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_infobox_callback');
}

if (!function_exists('foodbakery_element_list_populate_infobox_callback')) {

    /**
     * Populate infobox shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_infobox_callback($element_list) {
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_short_code_strings();
	$element_list['infobox'] = foodbakery_var_theme_text_srt('foodbakery_var_infobox');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_infobox_callback');
}

if (!function_exists('foodbakery_shortcode_sub_element_ui_infobox_callback')) {

    /**
     * Render UI for sub element in infobox settings.
     *
     * @param	array $args
     */
    function foodbakery_shortcode_sub_element_ui_infobox_callback($args) {
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_short_code_strings();
	$type = $args['type'];
	$foodbakery_var_html_fields = $args['html_fields'];
	if ($type == 'infobox') {
	    $foodbakery_var_active = foodbakery_var_theme_text_srt('foodbakery_var_active');
	    $foodbakery_var_infobox_active_hint = foodbakery_var_theme_text_srt('foodbakery_var_infobox_active_hint');
	    $foodbakery_var_infobox_title = foodbakery_var_theme_text_srt('foodbakery_var_infobox_title');
	    $foodbakery_var_infobox_title_hint = foodbakery_var_theme_text_srt('foodbakery_var_infobox_title_hint');
	    $foodbakery_var_infobox_text = foodbakery_var_theme_text_srt('foodbakery_var_infobox_content');
	    $foodbakery_var_infobox_text_hint = foodbakery_var_theme_text_srt('foodbakery_var_infobox_content_hint');
	    $rand_id = rand(324235, 993249);
	    ?>
	    <div class='cs-wrapp-clone cs-shortcode-wrapp'  id="foodbakery_infobox_<?php echo intval($rand_id); ?>">
	        <header>
	    	<h4><i class='icon-arrows'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_infobox')); ?></h4>
	    	<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_remove')); ?></a>
	        </header>
	        <div class="form-elements" id="foodbakery_infobox_<?php echo esc_attr($rand_id); ?>">
	    	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
	    	    <label><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_infobox_icon')); ?></label>
			<?php
			if (function_exists('foodbakery_var_tooltip_helptext')) {
			    echo foodbakery_var_tooltip_helptext(foodbakery_var_theme_text_srt('foodbakery_var_infobox_icon_hint'));
			}
			?>
	    	</div>
	    	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
		<?php echo foodbakery_var_icomoon_icons_box('', esc_attr($rand_id), 'foodbakery_var_icon_box'); ?>
	    	</div>
	        </div>                                   
		<?php
		$foodbakery_opt_array = array(
		    'name' => $foodbakery_var_infobox_text,
		    'desc' => '',
		    'hint_text' => $foodbakery_var_infobox_text_hint,
		    'echo' => true,
		    'field_params' => array(
			'std' => '',
			'id' => 'foodbakery_var_infobox_text',
			'cust_name' => 'foodbakery_var_infobox_text[]',
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

    add_action('foodbakery_shortcode_sub_element_ui', 'foodbakery_shortcode_sub_element_ui_infobox_callback');
}