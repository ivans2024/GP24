<?php
/*
 *
 * @Shortcode Name : List
 * @retrun
 *
 * 
 */
if (!function_exists('foodbakery_var_page_builder_list')) {

    function foodbakery_var_page_builder_list($die = 0) {
	global $foodbakery_node, $count_node, $post, $foodbakery_var_html_fields, $foodbakery_var_form_fields;
	$shortcode_element = '';
	$filter_element = 'filterdrag';
	$shortcode_view = '';
	$output = array();
	$foodbakery_counter = $_POST['counter'];
	$list_num = 0;
	if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
	    $POSTID = '';
	    $shortcode_element_id = '';
	} else {
	    $POSTID = $_POST['POSTID'];
	    $shortcode_element_id = $_POST['shortcode_element_id'];
	    $shortcode_str = stripslashes($shortcode_element_id);
	    $PREFIX = 'foodbakery_list|foodbakery_list_item';
	    $parseObject = new ShortcodeParse();
	    $output = $parseObject->foodbakery_shortcodes($output, $shortcode_str, true, $PREFIX);
	}
	$defaults = array(
	    'foodbakery_var_list_title' => '',
	    'foodbakery_var_list_type' => '',
	    'foodbakery_var_list_item_icon_color' => '',
	    'foodbakery_var_list_item_icon_bg_color' => '',
            'foodbakery_var_list_align' => '',
	);
	$foodbakery_var_list_item_icon_color = isset($foodbakery_var_list_item_icon_color) ? $foodbakery_var_list_item_icon_color : '';
	$foodbakery_var_list_item_icon_bg_color = isset($foodbakery_var_list_item_icon_bg_color) ? $foodbakery_var_list_item_icon_bg_color : '';
	$foodbakery_var_list_title = isset($foodbakery_var_list_title) ? $foodbakery_var_list_title : '';
        $foodbakery_var_list_align = isset($foodbakery_var_list_align) ? $foodbakery_var_list_align : '';
	$foodbakery_var_list_type = isset($foodbakery_var_list_type) ? $foodbakery_var_list_type : '';
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
	    $list_num = count($atts_content);
	}
	$list_element_size = '25';
	foreach ($defaults as $key => $values) {
	    if (isset($atts[$key])) {
		$$key = $atts[$key];
	    } else {
		$$key = $values;
	    }
	}
	$name = 'foodbakery_var_page_builder_list';
	$coloumn_class = 'column_' . $list_element_size;
	$foodbakery_var_list_main_title = isset($foodbakery_var_list_main_title) ? $foodbakery_var_list_main_title : '';
	$foodbakery_var_list_sub_title = isset($foodbakery_var_list_sub_title) ? $foodbakery_var_list_sub_title : '';
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
	<div id="<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>_del" class="column  parentdelete <?php echo foodbakery_allow_special_char($coloumn_class); ?> <?php echo foodbakery_allow_special_char($shortcode_view); ?>" item="list" data="<?php echo foodbakery_element_size_data_array_index($list_element_size) ?>" >
	    <?php foodbakery_element_setting($name, $foodbakery_counter, $list_element_size, '', 'comments-o', $type = ''); ?>
	    <div class="cs-wrapp-class-<?php echo foodbakery_allow_special_char($foodbakery_counter) ?> <?php echo foodbakery_allow_special_char($shortcode_element); ?>" id="<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>" style="display: none;">
		<div class="cs-heading-area">
		    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_list_edit_option')); ?></h5>
		    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>','<?php echo foodbakery_allow_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
		</div>
		<div class="cs-clone-append cs-pbwp-content">
		    <div class="cs-wrapp-tab-box">
			<div id="shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>" data-shortcode-template="{{child_shortcode}} [/foodbakery_list]" data-shortcode-child-template="[foodbakery_list_item {{attributes}}] {{content}} [/foodbakery_list_item]">
			    <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[foodbakery_list {{attributes}}]">
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
					'std' => foodbakery_allow_special_char($foodbakery_var_list_title),
					'id' => 'list_title' . $foodbakery_counter,
					'cust_name' => 'foodbakery_var_list_title[]',
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
                                        'std' => $foodbakery_var_list_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_list_align',
                                        'cust_name' => 'foodbakery_var_list_align[]',
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
				    'name' => foodbakery_var_theme_text_srt('foodbakery_var_list_style'),
				    'desc' => '',
				    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_list_style_hint'),
				    'echo' => true,
				    'field_params' => array(
					'std' => $foodbakery_var_list_type,
					'id' => '',
					'cust_id' => 'foodbakery_var_list_type',
					'cust_name' => 'foodbakery_var_list_type[]',
					'classes' => 'dropdown chosen-select-no-single select-medium',
					'options' => array(
					    'default' => foodbakery_var_theme_text_srt('foodbakery_var_list_style_default'),
					    'numeric-icon' => foodbakery_var_theme_text_srt('foodbakery_var_list_style_numeric'),
					    'built' => foodbakery_var_theme_text_srt('foodbakery_var_list_bullet'),
					    'icon' => foodbakery_var_theme_text_srt('foodbakery_var_list_icon'),
					    'alphabetic' => foodbakery_var_theme_text_srt('foodbakery_var_list_alphabetic'),
					),
					'return' => true,
				    ),
				);
				$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
				?>
				<style type="text/css">
				    .icon_fields{ display: <?php echo esc_html($foodbakery_var_list_type == 'icon' ? 'block' : 'none' ) ?>; }
				</style>
				<div class="icon_fields">   
				    <?php
				    $foodbakery_opt_array = array(
					'name' => foodbakery_var_theme_text_srt('foodbakery_var_list_sc_icon_color'),
					'desc' => '',
					'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_list_sc_icon_color_hint'),
					'echo' => true,
					'field_params' => array(
					    'std' => $foodbakery_var_list_item_icon_color,
					    'id' => 'foodbakery_var_list_item_icon_color' . $foodbakery_counter,
					    'cust_name' => 'foodbakery_var_list_item_icon_color[]',
					    'classes' => 'bg_color',
					    'return' => true,
					),
				    );
				    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
				    $foodbakery_opt_array = array(
					'name' => foodbakery_var_theme_text_srt('foodbakery_var_list_sc_icon_bg_color'),
					'desc' => '',
					'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_list_sc_icon_bg_color_hint'),
					'echo' => true,
					'field_params' => array(
					    'std' => foodbakery_allow_special_char($foodbakery_var_list_item_icon_bg_color),
					    'id' => 'foodbakery_var_list_item_icon_bg_color' . $foodbakery_counter,
					    'cust_name' => 'foodbakery_var_list_item_icon_bg_color[]',
					    'classes' => 'bg_color',
					    'return' => true,
					),
				    );
				    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
				    ?>
				</div>
				<style type="text/css">
				    .icon_fields{ display: <?php echo esc_html($foodbakery_var_list_type == 'icon' ? 'block' : 'none' ) ?>; }
				</style>
				<script>
				    $(function () {
					$('#foodbakery_var_list_type').change(function () {
					    var getValue = $("#foodbakery_var_list_type option:selected").val();
					    if (getValue == 'icon') {
						$('.icon_fields').css('display', 'block');
					    } else {
						$('.icon_fields').css('display', 'none');
					    }
					});
				    });

				</script>
			    </div>
			    <?php
			    if (isset($list_num) && $list_num <> '' && isset($atts_content) && is_array($atts_content)) {
				foreach ($atts_content as $list) {
				    $rand_id = rand(3333, 99999);
				    $foodbakery_var_list_text = $list['content'];
				    $defaults = array('foodbakery_var_list_item_text' => '', 'foodbakery_var_list_item_icon' => '');
				    foreach ($defaults as $key => $values) {
					if (isset($list['atts'][$key]))
					    $$key = $list['atts'][$key];
					else
					    $$key = $values;
				    }
				    $foodbakery_var_list_item_text = isset($foodbakery_var_list_item_text) ? $foodbakery_var_list_item_text : '';
				    $foodbakery_var_list_item_icon = isset($foodbakery_var_list_item_icon) ? $foodbakery_var_list_item_icon : '';
				    ?>
				    <div class='cs-wrapp-clone cs-shortcode-wrapp  cs-pbwp-content'  id="foodbakery_infobox_<?php echo foodbakery_allow_special_char($rand_id); ?>">
					<header>
					    <h4><i class='icon-arrows'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_list_sc')); ?></h4>
					    <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_remove')); ?></a></header>
					<?php
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_list_sc_item'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_list_sc_item_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_html($foodbakery_var_list_item_text),
						'id' => 'list_item_text' . $foodbakery_counter,
						'cust_name' => 'foodbakery_var_list_item_text[]',
						'classes' => '',
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
					?>	 				
					<div class="icon_fields">
					    <div class="form-elements" id="foodbakery_infobox_<?php echo esc_attr($rand_id); ?>">
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						    <label><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_list_sc_icon')); ?></label>
						    <?php
						    if (function_exists('foodbakery_var_tooltip_helptext')) {
							echo foodbakery_var_tooltip_helptext(foodbakery_var_theme_text_srt('foodbakery_var_list_sc_icon_hint'));
						    }
						    ?>
						</div>
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
						    <?php echo foodbakery_var_icomoon_icons_box(esc_html($foodbakery_var_list_item_icon), esc_attr($rand_id), 'foodbakery_var_list_item_icon'); ?>
						</div>
					    </div>
					    <?php
					    ?>
					</div>
				    </div>
				    <?php
				}
			    }
			    ?>
			</div>
			<div class="hidden-object">
			    <?php
			    $foodbakery_opt_array = array(
				'std' => $list_num,
				'id' => '',
				'before' => '',
				'after' => '',
				'classes' => 'fieldCounter',
				'extra_atr' => '',
				'cust_id' => '',
				'cust_name' => 'list_num[]',
				'return' => false,
				'required' => false
			    );
			    $foodbakery_var_form_fields->foodbakery_var_form_hidden_render($foodbakery_opt_array);
			    ?>
			</div>
			<div class="wrapptabbox">
			    <div class="opt-conts">
				<ul class="form-elements noborder">
				    <li class="to-field"> <a href="javascript:void(0);" class="add_servicesss cs-main-btn" onclick="foodbakery_shortcode_element_ajax_call('list', 'shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>', '<?php echo foodbakery_allow_special_char(admin_url('admin-ajax.php')); ?>')"><i class="icon-plus-circle"></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_list_sc_add_item')); ?></a> </li>
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
					'std' => 'list',
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

    add_action('wp_ajax_foodbakery_var_page_builder_list', 'foodbakery_var_page_builder_list');
}
if (!function_exists('foodbakery_save_page_builder_data_list_callback')) {

    /**
     * Save data for list shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_list_callback($args) {
	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	if ($widget_type == "list" || $widget_type == "cs_list") {
	    $shortcode = $shortcode_item = '';
            
            $page_element_size     =  $data['list_element_size'][$counters['foodbakery_global_counter_list']];
            $current_element_size  =  $data['list_element_size'][$counters['foodbakery_global_counter_list']];
	    
	    if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes($data['shortcode']['list'][$counters['foodbakery_shortcode_counter_list']]);
                
                $element_settings   = 'list_element_size="'.$current_element_size.'"';
                $reg = '/list_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
		$counters['foodbakery_shortcode_counter_list'] ++;
	    } else {
		if (isset($data['list_num'][$counters['foodbakery_counter_list']]) && $data['list_num'][$counters['foodbakery_counter_list']] > 0) {
		    for ($i = 1; $i <= $data['list_num'][$counters['foodbakery_counter_list']]; $i ++) {
			$shortcode_item .= '[foodbakery_list_item ';
			if (isset($data['foodbakery_var_list_item_text'][$counters['foodbakery_counter_list_node']]) && $data['foodbakery_var_list_item_text'][$counters['foodbakery_counter_list_node']] != '') {
			    $shortcode_item .= 'foodbakery_var_list_item_text="' . htmlspecialchars($data['foodbakery_var_list_item_text'][$counters['foodbakery_counter_list_node']], ENT_QUOTES) . '" ';
			}
			if (isset($data['foodbakery_var_list_item_icon'][$counters['foodbakery_counter_list_node']]) && $data['foodbakery_var_list_item_icon'][$counters['foodbakery_counter_list_node']] != '') {
			    $shortcode_item .= 'foodbakery_var_list_item_icon="' . htmlspecialchars($data['foodbakery_var_list_item_icon'][$counters['foodbakery_counter_list_node']], ENT_QUOTES) . '" ';
			}
			$shortcode_item .= ']';
			$shortcode_item .= '[/foodbakery_list_item]';
			$counters['foodbakery_counter_list_node'] ++;
		    }
		}
		$section_title = '';
		if (isset($data['foodbakery_var_list_title'][$counters['foodbakery_counter_list']]) && $data['foodbakery_var_list_title'][$counters['foodbakery_counter_list']] != '') {
		    $section_title .= 'foodbakery_var_list_title="' . htmlspecialchars($data['foodbakery_var_list_title'][$counters['foodbakery_counter_list']], ENT_QUOTES) . '" ';
		}
                if (isset($data['foodbakery_var_list_align'][$counters['foodbakery_counter_list']]) && $data['foodbakery_var_list_align'][$counters['foodbakery_counter_list']] != '') {
		    $section_title .= 'foodbakery_var_list_align="' . htmlspecialchars($data['foodbakery_var_list_align'][$counters['foodbakery_counter_list']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_list_type'][$counters['foodbakery_counter_list']]) && $data['foodbakery_var_list_type'][$counters['foodbakery_counter_list']] != '') {
		    $section_title .= 'foodbakery_var_list_type="' . htmlspecialchars($data['foodbakery_var_list_type'][$counters['foodbakery_counter_list']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_list_item_icon_color'][$counters['foodbakery_counter_list']]) && $data['foodbakery_var_list_item_icon_color'][$counters['foodbakery_counter_list']] != '') {
		    $section_title .= 'foodbakery_var_list_item_icon_color="' . htmlspecialchars($data['foodbakery_var_list_item_icon_color'][$counters['foodbakery_counter_list']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_list_item_icon_bg_color'][$counters['foodbakery_counter_list']]) && $data['foodbakery_var_list_item_icon_bg_color'][$counters['foodbakery_counter_list']] != '') {
		    $section_title .= 'foodbakery_var_list_item_icon_bg_color="' . htmlspecialchars($data['foodbakery_var_list_item_icon_bg_color'][$counters['foodbakery_counter_list']], ENT_QUOTES) . '" ';
		}
                $element_settings   = 'list_element_size="'.htmlspecialchars( $data['list_element_size'][$counters['foodbakery_global_counter_list']] ).'"';
		$shortcode = '[foodbakery_list ' . $element_settings. ' '. $section_title . ' ]' . $shortcode_item . '[/foodbakery_list]';
		$shortcode_data .= $shortcode;
		$counters['foodbakery_counter_list'] ++;
	    }
	    $counters['foodbakery_global_counter_list'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_list', 'foodbakery_save_page_builder_data_list_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_list_callback')) {

    /**
     * Populate list shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_list_callback($counters) {
	$counters['foodbakery_global_counter_list'] = 0;
	$counters['foodbakery_shortcode_counter_list'] = 0;
	$counters['foodbakery_counter_list_node'] = 0;
	$counters['foodbakery_counter_list'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_list_callback');
}

if (!function_exists('foodbakery_shortcode_names_list_populate_list_callback')) {

    /**
     * Populate list shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_list_callback($shortcode_array) {
	$shortcode_array['list'] = array(
	    'title' => foodbakery_var_frame_text_srt('foodbakery_var_list'),
	    'name' => 'list',
	    'icon' => 'icon-newspaper',
	    'categories' => 'typography',
	);
	return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_list_callback');
}

if (!function_exists('foodbakery_element_list_populate_list_callback')) {

    /**
     * Populate list shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_list_callback($element_list) {
	$element_list['list'] = foodbakery_var_frame_text_srt('foodbakery_var_list');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_list_callback');
}

if (!function_exists('foodbakery_shortcode_sub_element_ui_list_callback')) {

    /**
     * Render UI for sub element in list settings.
     *
     * @param	array $args
     */
    function foodbakery_shortcode_sub_element_ui_list_callback($args) {
	$type = $args['type'];
	$foodbakery_var_html_fields = $args['html_fields'];
	if ($type == 'list') {
	    $rand_id = rand(23, 45453);
	    ?>
	    <div class='cs-wrapp-clone cs-shortcode-wrapp'  id="foodbakery_list_<?php echo intval($rand_id); ?>">
	        <header>
	    	<h4><i class='icon-arrows'></i><?php echo foodbakery_var_frame_text_srt('foodbakery_var_list'); ?></h4>
	    	<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo foodbakery_var_frame_text_srt('foodbakery_var_remove'); ?></a>
	        </header>
		<?php
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_frame_text_srt('foodbakery_var_list_Item'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_list_Item_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => '',
			'id' => 'list_item_text',
			'cust_name' => 'foodbakery_var_list_item_text[]',
			'classes' => '',
			'return' => true,
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
		?>	 				
	        <div class="icon_fields">
	    	<div class="form-elements" id="foodbakery_infobox_<?php echo esc_attr($rand_id); ?>">
	    	    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
	    		<label><?php echo foodbakery_var_frame_text_srt('foodbakery_var_icon'); ?></label>
			    <?php
			    if (function_exists('foodbakery_var_tooltip_helptext')) {
				echo foodbakery_var_tooltip_helptext(foodbakery_var_frame_text_srt('foodbakery_var_icon_tooltip'));
			    }
			    ?>
	    	    </div>
	    	    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			    <?php echo foodbakery_var_icomoon_icons_box('', $rand_id, 'foodbakery_var_list_item_icon'); ?>
	    	    </div>
	    	</div>
	        </div>
	    </div>
	    <script>
	        popup_over();
	        jQuery(document).ready(function ($) {
	    	var getValue = $("#foodbakery_var_list_type option:selected").val();
	    	$('.icon_fields').css('display', 'none');
	    	if (getValue == 'icon') {
	    	    $('.icon_fields').css('display', 'block');
	    	} else {
	    	    $('.icon_fields').css('display', 'none');
	    	}
	        });
	    </script> 

	    <?php
	}
    }

    add_action('foodbakery_shortcode_sub_element_ui', 'foodbakery_shortcode_sub_element_ui_list_callback');
}