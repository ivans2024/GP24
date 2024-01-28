<?php
/**
 * @Google map html form for page builder start
 */
if (!function_exists('foodbakery_var_page_builder_map')) {

    function foodbakery_var_page_builder_map($die = 0) {
	global $foodbakery_node, $post, $foodbakery_var_html_fields, $foodbakery_var_form_fields;
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
	    $PREFIX = 'foodbakery_map';
	    $parseObject = new ShortcodeParse();
	    $output = $parseObject->foodbakery_shortcodes($output, $shortcode_str, true, $PREFIX);
	}
	$defaults = array(
	    'foodbakery_var_map_title' => '',
	    'foodbakery_var_map_height' => '',
	    'foodbakery_var_map_lat' => '40.7143528',
	    'foodbakery_var_map_lon' => '-74.0059731',
	    'foodbakery_var_map_zoom' => '',
	    'foodbakery_var_map_info' => '',
	    'foodbakery_var_map_info_width' => '',
	    'foodbakery_var_map_info_height' => '',
	    'foodbakery_var_map_marker_icon' => '',
	    'foodbakery_var_map_show_marker' => 'true',
	    'foodbakery_var_map_controls' => '',
	    'foodbakery_var_map_draggable' => '',
	    'foodbakery_var_map_scrollwheel' => '',
	    'foodbakery_var_map_border' => '',
	    'foodbakery_var_map_border_color' => '',
            'foodbakery_var_map_align' => '',
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
	$map_element_size = '25';
	foreach ($defaults as $key => $values) {
	    if (isset($atts[$key])) {
		$$key = $atts[$key];
	    } else {
		$$key = $values;
	    }
	}
	$foodbakery_var_map_title = isset($foodbakery_var_map_title) ? $foodbakery_var_map_title : '';
	$foodbakery_var_map_height = isset($foodbakery_var_map_height) ? $foodbakery_var_map_height : '';
	$foodbakery_var_map_lat = isset($foodbakery_var_map_lat) ? $foodbakery_var_map_lat : '';
	$foodbakery_var_map_lon = isset($foodbakery_var_map_lon) ? $foodbakery_var_map_lon : '';
	$foodbakery_var_map_zoom = isset($foodbakery_var_map_zoom) ? $foodbakery_var_map_zoom : '';
	$foodbakery_var_map_info = isset($foodbakery_var_map_info) ? $foodbakery_var_map_info : '';
	$foodbakery_var_map_info_width = isset($foodbakery_var_map_info_width) ? $foodbakery_var_map_info_width : '';
	$foodbakery_var_map_info_height = isset($foodbakery_var_map_info_height) ? $foodbakery_var_map_info_height : '';
	$foodbakery_var_map_marker_icon = isset($foodbakery_var_map_marker_icon) ? $foodbakery_var_map_marker_icon : '';
	$foodbakery_var_map_show_marker = isset($foodbakery_var_map_show_marker) ? $foodbakery_var_map_show_marker : '';
	$foodbakery_var_map_controls = isset($foodbakery_var_map_controls) ? $foodbakery_var_map_controls : '';
	$foodbakery_var_map_draggable = isset($foodbakery_var_map_draggable) ? $foodbakery_var_map_draggable : '';
	$foodbakery_var_map_scrollwheel = isset($foodbakery_var_map_scrollwheel) ? $foodbakery_var_map_scrollwheel : '';
	$foodbakery_var_map_border = isset($foodbakery_var_map_border) ? $foodbakery_var_map_border : '';
	$foodbakery_var_map_border_color = isset($foodbakery_var_map_border_color) ? $foodbakery_var_map_border_color : '';
        $foodbakery_var_map_align = isset($foodbakery_var_map_align) ? $foodbakery_var_map_align : '';
	$name = 'foodbakery_var_page_builder_map';
	$coloumn_class = 'column_' . $map_element_size;
	if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
	    $shortcode_element = 'shortcode_element_class';
	    $shortcode_view = 'cs-pbwp-shortcode';
	    $filter_element = 'ajax-drag';
	    $coloumn_class = '';
	}
	$rand_string = $foodbakery_counter . '' . foodbakery_generate_random_string(3);
	global $foodbakery_var_static_text;
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_short_code_strings();
	?>
	<div id="<?php echo esc_attr($name . $foodbakery_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="map" data="<?php echo foodbakery_element_size_data_array_index($map_element_size) ?>" >
	    <?php foodbakery_element_setting($name, $foodbakery_counter, $map_element_size, '', 'globe'); ?>
	    <div class="cs-wrapp-class-<?php echo esc_attr($foodbakery_counter); ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $foodbakery_counter) ?>" data-shortcode-template="[<?php echo esc_attr('foodbakery_map'); ?> {{attributes}}]" style="display: none;">
		<div class="cs-heading-area">
		    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_edit_map_options')); ?></h5>
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
				'std' => foodbakery_allow_special_char($foodbakery_var_map_title),
				'cust_id' => '',
				'classes' => '',
				'cust_name' => 'foodbakery_var_map_title[]',
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
                                        'std' => $foodbakery_var_map_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_map_align',
                                        'cust_name' => 'foodbakery_var_map_align[]',
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
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_map_height'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_map_height_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_attr($foodbakery_var_map_height),
				'cust_id' => '',
				'classes' => 'txtfield ',
				'cust_name' => 'foodbakery_var_map_height[]',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_latitude'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_latitude_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_attr($foodbakery_var_map_lat),
				'cust_id' => '',
				'classes' => 'txtfield',
				'cust_name' => 'foodbakery_var_map_lat[]',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_longitude'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_longitude_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_attr($foodbakery_var_map_lon),
				'cust_id' => '',
				'classes' => 'txtfield',
				'cust_name' => 'foodbakery_var_map_lon[]',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_zoom'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_zoom_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_attr($foodbakery_var_map_zoom),
				'cust_id' => '',
				'classes' => 'txtfield',
				'cust_name' => 'foodbakery_var_map_zoom[]',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_info_text'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_info_text_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_attr($foodbakery_var_map_info),
				'cust_id' => '',
				'classes' => 'txtfield',
				'cust_name' => 'foodbakery_var_map_info[]',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_info_text_width'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_info_text_width_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_attr($foodbakery_var_map_info_width),
				'cust_id' => '',
				'classes' => 'txtfield input-small',
				'cust_name' => 'foodbakery_var_map_info_width[]',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_info_text_height'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_info_text_height_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_attr($foodbakery_var_map_info_height),
				'cust_id' => '',
				'classes' => 'txtfield input-small',
				'cust_name' => 'foodbakery_var_map_info_height[]',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'std' => esc_url($foodbakery_var_map_marker_icon),
			    'id' => 'map_marker_icon',
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_marker_icon_path'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_marker_icon_path_hint'),
			    'echo' => true,
			    'array' => true,
			    'prefix' => '',
			    'field_params' => array(
				'std' => esc_url($foodbakery_var_map_marker_icon),
				'cust_id' => '',
				'id' => 'map_marker_icon',
				'return' => true,
				'array' => true,
				'array_txt' => false,
				'prefix' => '',
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_upload_file_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_show_marker'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_show_marker_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_html($foodbakery_var_map_show_marker),
				'id' => '',
				'cust_id' => '',
				'cust_name' => 'foodbakery_var_map_show_marker[]',
				'classes' => 'dropdown chosen-select',
				'options' => array(
				    'true' => foodbakery_var_theme_text_srt('foodbakery_var_on'),
				    'false' => foodbakery_var_theme_text_srt('foodbakery_var_off'),
				),
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_disable_map_controls'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_disable_map_controls_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_html($foodbakery_var_map_controls),
				'id' => '',
				'cust_id' => '',
				'cust_name' => 'foodbakery_var_map_controls[]',
				'classes' => 'dropdown chosen-select',
				'options' => array(
				    'true' => foodbakery_var_theme_text_srt('foodbakery_var_on'),
				    'false' => foodbakery_var_theme_text_srt('foodbakery_var_off'),
				),
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_drage_able'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_drage_able_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_html($foodbakery_var_map_draggable),
				'id' => '',
				'cust_id' => '',
				'cust_name' => 'foodbakery_var_map_draggable[]',
				'classes' => 'dropdown  chosen-select',
				'options' => array(
				    'true' => foodbakery_var_theme_text_srt('foodbakery_var_on'),
				    'false' => foodbakery_var_theme_text_srt('foodbakery_var_off'),
				),
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_scroll_wheel'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_scroll_wheel_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_html($foodbakery_var_map_scrollwheel),
				'id' => '',
				'cust_id' => '',
				'cust_name' => 'foodbakery_var_map_scrollwheel[]',
				'classes' => 'dropdown chosen-select',
				'options' => array(
				    'true' => foodbakery_var_theme_text_srt('foodbakery_var_on'),
				    'false' => foodbakery_var_theme_text_srt('foodbakery_var_off'),
				),
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_map_border'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_map_border_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_html($foodbakery_var_map_border),
				'id' => '',
				'cust_id' => '',
				'cust_name' => 'foodbakery_var_map_border[]',
				'classes' => 'dropdown chosen-select',
				'options' => array(
				    'yes' => foodbakery_var_theme_text_srt('foodbakery_var_yes'),
				    'no' => foodbakery_var_theme_text_srt('foodbakery_var_no'),
				),
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_border_color'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_border_color_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_attr($foodbakery_var_map_border_color),
				'cust_id' => '',
				'classes' => 'bg_color',
				'cust_name' => 'foodbakery_var_map_border_color[]',
				'return' => true,
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			?>
		    </div>
		    <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
			?>
	    	    <ul class="form-elements insert-bg">
	    		<li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo esc_js(str_replace('foodbakery_var_page_builder_', '', $name)); ?>', '<?php echo esc_js($name . $foodbakery_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_insert')); ?></a> </li>
	    	    </ul>
	    	    <div id="results-shortocde"></div>
			<?php
		    } else {
			$foodbakery_opt_array = array(
			    'std' => 'map',
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
				'classes' => 'cs-barber-admin-btn',
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

    add_action('wp_ajax_foodbakery_var_page_builder_map', 'foodbakery_var_page_builder_map');
}

if (!function_exists('foodbakery_save_page_builder_data_map_callback')) {

    /**
     * Save data for map shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_map_callback($args) {

	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	if ($widget_type == "map" || $widget_type == "cs_map") {
	    $foodbakery_var_map_shortcode = '';
	    $page_element_size  =  $data['map_element_size'][$counters['foodbakery_global_counter_map']];
            $current_element_size  =  $data['map_element_size'][$counters['foodbakery_global_counter_map']];
            
	    if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes(( $data['shortcode']['map'][$counters['foodbakery_shortcode_counter_map']]));
                
                $element_settings   = 'map_element_size="'.$current_element_size.'"';
                $reg = '/map_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
                
		$counters['foodbakery_shortcode_counter_map'] ++;
	    } else {
                $foodbakery_var_map_shortcode = '[foodbakery_map map_element_size="'.htmlspecialchars( $data['map_element_size'][$counters['foodbakery_global_counter_map']] ).'" ';
		if (isset($data['foodbakery_var_map_title'][$counters['foodbakery_counter_map']]) && $data['foodbakery_var_map_title'][$counters['foodbakery_counter_map']] != '') {
		    $foodbakery_var_map_shortcode .= 'foodbakery_var_map_title="' . stripslashes(htmlspecialchars(($data['foodbakery_var_map_title'][$counters['foodbakery_counter_map']]), ENT_QUOTES)) . '" ';
		}
                if (isset($data['foodbakery_var_map_align'][$counters['foodbakery_counter_map']]) && $data['foodbakery_var_map_align'][$counters['foodbakery_counter_map']] != '') {
		    $foodbakery_var_map_shortcode .= 'foodbakery_var_map_align="' . stripslashes(htmlspecialchars(($data['foodbakery_var_map_align'][$counters['foodbakery_counter_map']]), ENT_QUOTES)) . '" ';
		}
		if (isset($data['foodbakery_var_map_height'][$counters['foodbakery_counter_map']]) && $data['foodbakery_var_map_height'][$counters['foodbakery_counter_map']] != '') {
		    $foodbakery_var_map_shortcode .= 'foodbakery_var_map_height="' . htmlspecialchars($data['foodbakery_var_map_height'][$counters['foodbakery_counter_map']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_map_lat'][$counters['foodbakery_counter_map']]) && $data['foodbakery_var_map_lat'][$counters['foodbakery_counter_map']] != '') {
		    $foodbakery_var_map_shortcode .= 'foodbakery_var_map_lat="' . htmlspecialchars($data['foodbakery_var_map_lat'][$counters['foodbakery_counter_map']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_map_lon'][$counters['foodbakery_counter_map']]) && $data['foodbakery_var_map_lon'][$counters['foodbakery_counter_map']] != '') {
		    $foodbakery_var_map_shortcode .= 'foodbakery_var_map_lon="' . htmlspecialchars($data['foodbakery_var_map_lon'][$counters['foodbakery_counter_map']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_map_zoom'][$counters['foodbakery_counter_map']]) && $data['foodbakery_var_map_zoom'][$counters['foodbakery_counter_map']] != '') {
		    $foodbakery_var_map_shortcode .= 'foodbakery_var_map_zoom="' . htmlspecialchars($data['foodbakery_var_map_zoom'][$counters['foodbakery_counter_map']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_map_info'][$counters['foodbakery_counter_map']]) && $data['foodbakery_var_map_info'][$counters['foodbakery_counter_map']] != '') {
		    $foodbakery_var_map_shortcode .= 'foodbakery_var_map_info="' . htmlspecialchars($data['foodbakery_var_map_info'][$counters['foodbakery_counter_map']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_map_info_width'][$counters['foodbakery_counter_map']]) && $data['foodbakery_var_map_info_width'][$counters['foodbakery_counter_map']] != '') {
		    $foodbakery_var_map_shortcode .= 'foodbakery_var_map_info_width="' . htmlspecialchars($data['foodbakery_var_map_info_width'][$counters['foodbakery_counter_map']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_map_info_height'][$counters['foodbakery_counter_map']]) && $data['foodbakery_var_map_info_height'][$counters['foodbakery_counter_map']] != '') {
		    $foodbakery_var_map_shortcode .= 'foodbakery_var_map_info_height="' . htmlspecialchars($data['foodbakery_var_map_info_height'][$counters['foodbakery_counter_map']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_map_marker_icon_array'][$counters['foodbakery_counter_map']]) && $data['foodbakery_var_map_marker_icon_array'][$counters['foodbakery_counter_map']] != '') {
		    $foodbakery_var_map_shortcode .= 'foodbakery_var_map_marker_icon="' . htmlspecialchars($data['foodbakery_var_map_marker_icon_array'][$counters['foodbakery_counter_map']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_map_show_marker'][$counters['foodbakery_counter_map']]) && $data['foodbakery_var_map_show_marker'][$counters['foodbakery_counter_map']] != '') {
		    $foodbakery_var_map_shortcode .= 'foodbakery_var_map_show_marker="' . htmlspecialchars($data['foodbakery_var_map_show_marker'][$counters['foodbakery_counter_map']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_map_controls'][$counters['foodbakery_counter_map']]) && $data['foodbakery_var_map_controls'][$counters['foodbakery_counter_map']] != '') {
		    $foodbakery_var_map_shortcode .= 'foodbakery_var_map_controls="' . htmlspecialchars($data['foodbakery_var_map_controls'][$counters['foodbakery_counter_map']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_map_draggable'][$counters['foodbakery_counter_map']]) && $data['foodbakery_var_map_draggable'][$counters['foodbakery_counter_map']] != '') {
		    $foodbakery_var_map_shortcode .= 'foodbakery_var_map_draggable="' . htmlspecialchars($data['foodbakery_var_map_draggable'][$counters['foodbakery_counter_map']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_map_scrollwheel'][$counters['foodbakery_counter_map']]) && $data['foodbakery_var_map_scrollwheel'][$counters['foodbakery_counter_map']] != '') {
		    $foodbakery_var_map_shortcode .= 'foodbakery_var_map_scrollwheel="' . htmlspecialchars($data['foodbakery_var_map_scrollwheel'][$counters['foodbakery_counter_map']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_map_border'][$counters['foodbakery_counter_map']]) && $data['foodbakery_var_map_border'][$counters['foodbakery_counter_map']] != '') {
		    $foodbakery_var_map_shortcode .= 'foodbakery_var_map_border="' . htmlspecialchars($data['foodbakery_var_map_border'][$counters['foodbakery_counter_map']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_map_border_color'][$counters['foodbakery_counter_map']]) && $data['foodbakery_var_map_border_color'][$counters['foodbakery_counter_map']] != '') {
		    $foodbakery_var_map_shortcode .= 'foodbakery_var_map_border_color="' . htmlspecialchars($data['foodbakery_var_map_border_color'][$counters['foodbakery_counter_map']], ENT_QUOTES) . '" ';
		}
		$foodbakery_var_map_shortcode .= ']';
		if (isset($data['map_text'][$counters['foodbakery_counter_map']]) && $data['map_text'][$counters['foodbakery_counter_map']] != '') {
		    $foodbakery_var_map_shortcode .= htmlspecialchars($data['map_text'][$counters['foodbakery_counter_map']], ENT_QUOTES) . ' ';
		}
		$foodbakery_var_map_shortcode .= '[/foodbakery_map]';
                $shortcode_data .= $foodbakery_var_map_shortcode;
		$counters['foodbakery_counter_map'] ++;
	    }
	    $counters['foodbakery_global_counter_map'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_map', 'foodbakery_save_page_builder_data_map_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_map_callback')) {

    /**
     * Populate map shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_map_callback($counters) {
	$counters['foodbakery_global_counter_map'] = 0;
	$counters['foodbakery_shortcode_counter_map'] = 0;
	$counters['foodbakery_counter_map'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_map_callback');
}

if (!function_exists('foodbakery_shortcode_names_list_populate_map_callback')) {

    /**
     * Populate map shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_map_callback($shortcode_array) {
	$shortcode_array['map'] = array(
	    'title' => foodbakery_var_frame_text_srt('foodbakery_var_map'),
	    'name' => 'map',
	    'icon' => 'icon-location2',
	    'categories' => 'contentblocks',
	);
	return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_map_callback');
}

if (!function_exists('foodbakery_element_list_populate_map_callback')) {

    /**
     * Populate map shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_map_callback($element_list) {
	$element_list['map'] = foodbakery_var_frame_text_srt('foodbakery_var_map');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_map_callback');
}