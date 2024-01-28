<?php
/*
 *
 * @File : Video
 * @retrun
 *
 */

if (!function_exists('foodbakery_var_page_builder_video')) {

    function foodbakery_var_page_builder_video($die = 0) {
	global $post, $foodbakery_node, $foodbakery_var_html_fields, $foodbakery_var_form_fields;

	if (function_exists('foodbakery_shortcode_names')) {
	    $shortcode_element = '';
	    $filter_element = 'filterdrag';
	    $shortcode_view = '';
	    $foodbakery_output = array();
	    $FOODBAKERY_PREFIX = 'foodbakery_video';
	    $counter = isset($_POST['counter']) ? $_POST['counter'] : '';
	    $foodbakery_counter = isset($_POST['counter']) ? $_POST['counter'] : '';
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
		'foodbakery_var_video_title' => '',
		'foodbakery_var_video_url' => '',
                'foodbakery_var_height' => '',
                'foodbakery_var_video_align' => '',
	    );
	    if (isset($foodbakery_output['0']['atts'])) {
		$atts = $foodbakery_output['0']['atts'];
	    } else {
		$atts = array();
	    }
	    if (isset($foodbakery_output['0']['content'])) {
		$video_text = $foodbakery_output['0']['content'];
	    } else {
		$video_text = '';
	    }
	    $video_element_size = '25';
	    foreach ($defaults as $key => $values) {
		if (isset($atts[$key])) {
		    $$key = $atts[$key];
		} else {
		    $$key = $values;
		}
	    }
	    $name = 'foodbakery_var_page_builder_video';
	    $coloumn_class = 'column_' . $video_element_size;
	    $foodbakery_var_video_title = isset($foodbakery_var_video_title) ? $foodbakery_var_video_title : '';
	    $foodbakery_var_video_url = isset($foodbakery_var_video_url) ? $foodbakery_var_video_url : '';
            $foodbakery_var_height = isset($foodbakery_var_height) ? $foodbakery_var_height : '';
            $foodbakery_var_video_align = isset($foodbakery_var_video_align) ? $foodbakery_var_video_align : '';
	    if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
		$shortcode_element = 'shortcode_element_class';
		$shortcode_view = 'cs-pbwp-shortcode';
		$filter_element = 'ajax-drag';
		$coloumn_class = '';
	    }
	    $stringsObj = new foodbakery_theme_all_strings;
	    $stringsObj->foodbakery_short_code_strings();
	    ?>
	    <div id="<?php echo esc_attr($name . $foodbakery_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?>
		 <?php echo esc_attr($shortcode_view); ?>" item="video" data="<?php echo foodbakery_element_size_data_array_index($video_element_size) ?>" >
		     <?php foodbakery_element_setting($name, $foodbakery_counter, $video_element_size) ?>
	        <div class="cs-wrapp-class-<?php echo intval($foodbakery_counter) ?>
		     <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $foodbakery_counter) ?>" data-shortcode-template="[foodbakery_video {{attributes}}]{{content}}[/foodbakery_video]" style="display: none;">
	    	<div class="cs-heading-area" data-counter="<?php echo esc_attr($foodbakery_counter) ?>">
	    	    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_edit_video_text')); ?></h5>
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
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_element_title'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_element_title_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => esc_attr($foodbakery_var_video_title),
				    'cust_id' => 'foodbakery_var_video_title' . $foodbakery_counter,
				    'classes' => '',
				    'cust_name' => 'foodbakery_var_video_title[]',
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
                                        'std' => $foodbakery_var_video_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_video_align',
                                        'cust_name' => 'foodbakery_var_video_align[]',
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
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_video_field_url'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_video_height_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => esc_attr($foodbakery_var_video_url),
				    'cust_id' => 'foodbakery_var_video_url' . $foodbakery_counter,
				    'classes' => '',
				    'cust_name' => 'foodbakery_var_video_url[]',
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
                            $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_video_height'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_video_field_url_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => esc_attr($foodbakery_var_height),
				    'cust_id' => 'foodbakery_var_height' . $foodbakery_counter,
				    'classes' => '',
				    'cust_name' => 'foodbakery_var_height[]',
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			    ?>
	    	    </div>
			<?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
			    <ul class="form-elements insert-bg">
				<li class="to-field">
				    <a class="insert-btn cs-main-btn" 
				       onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo str_replace('foodbakery_var_page_builder_', '', $name); ?>', '<?php echo esc_js($name . $foodbakery_counter) ?>',
								       '<?php echo esc_js($filter_element); ?>')" ><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_insert')); ?></a>
				</li>
			    </ul>
			    <div id="results-shortocde"></div>
			<?php
			} else {
			    $foodbakery_opt_array = array(
				'std' => 'video',
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
				'name' => '',
				'desc' => '',
				'hint_text' => '',
				'echo' => true,
				'field_params' => array(
				    'std' => foodbakery_var_theme_text_srt('foodbakery_var_save'),
				    'cust_id' => 'video_save' . $foodbakery_counter,
				    'cust_type' => 'button',
				    'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
				    'classes' => 'cs-foodbakery-admin-btn',
				    'cust_name' => 'video_save',
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

    add_action('wp_ajax_foodbakery_var_page_builder_video', 'foodbakery_var_page_builder_video');
}

if (!function_exists('foodbakery_save_page_builder_data_video_callback')) {

    /**
     * Save data for video shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_video_callback($args) {
	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	if ($widget_type == "video" || $widget_type == "cs_video") {
	    $shortcode = '';
            $page_element_size     =  $data['video_element_size'][$counters['foodbakery_global_counter_video']];
            $current_element_size  =  $data['video_element_size'][$counters['foodbakery_global_counter_video']];
            
	    if (isset($_POST['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $_POST['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes($_POST['shortcode']['video'][$counters['foodbakery_shortcode_counter_video']]);
		$element_settings   = 'video_element_size="'.$current_element_size.'"';
                $reg = '/video_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
                $counters['foodbakery_shortcode_counter_video'] ++;
	    } else {
                $shortcode = '[foodbakery_video video_element_size="'.htmlspecialchars( $data['video_element_size'][$counters['foodbakery_global_counter_video']] ).'" ';
		if (isset($_POST['foodbakery_var_video_title'][$counters['foodbakery_counter_video']]) && $_POST['foodbakery_var_video_title'][$counters['foodbakery_counter_video']] != '') {
		    $shortcode .='foodbakery_var_video_title="' . htmlspecialchars($_POST['foodbakery_var_video_title'][$counters['foodbakery_counter_video']], ENT_QUOTES) . '" ';
		}
                if (isset($_POST['foodbakery_var_video_align'][$counters['foodbakery_counter_video']]) && $_POST['foodbakery_var_video_align'][$counters['foodbakery_counter_video']] != '') {
		    $shortcode .='foodbakery_var_video_align="' . htmlspecialchars($_POST['foodbakery_var_video_align'][$counters['foodbakery_counter_video']], ENT_QUOTES) . '" ';
		}
		if (isset($_POST['foodbakery_var_video_url'][$counters['foodbakery_counter_video']]) && $_POST['foodbakery_var_video_url'][$counters['foodbakery_counter_video']] != '') {
		    $shortcode .='foodbakery_var_video_url="' . htmlspecialchars($_POST['foodbakery_var_video_url'][$counters['foodbakery_counter_video']], ENT_QUOTES) . '" ';
		}
                if (isset($_POST['foodbakery_var_height'][$counters['foodbakery_counter_video']]) && $_POST['foodbakery_var_height'][$counters['foodbakery_counter_video']] != '') {
		    $shortcode .='foodbakery_var_height="' . htmlspecialchars($_POST['foodbakery_var_height'][$counters['foodbakery_counter_video']], ENT_QUOTES) . '" ';
		}
		$shortcode .= ']';
		$shortcode_data .= $shortcode;
		$counters['foodbakery_counter_video'] ++;
	    }
	    $counters['foodbakery_global_counter_video'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_video', 'foodbakery_save_page_builder_data_video_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_video_callback')) {

    /**
     * Populate video shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_video_callback($counters) {
	$counters['foodbakery_global_counter_video'] = 0;
	$counters['foodbakery_shortcode_counter_video'] = 0;
	$counters['foodbakery_counter_video'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_video_callback');
}
if (!function_exists('foodbakery_shortcode_names_list_populate_video_callback')) {

    /**
     * Populate video shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_video_callback($shortcode_array) {
	$shortcode_array['video'] = array(
	    'title' => foodbakery_var_frame_text_srt('foodbakery_var_video'),
	    'name' => 'video',
	    'icon' => 'icon-video2',
	    'categories' => 'contentblocks',
	);
	return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_video_callback');
}

if (!function_exists('foodbakery_element_list_populate_video_callback')) {

    /**
     * Populate video shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_video_callback($element_list) {
	$element_list['video'] = foodbakery_var_frame_text_srt('foodbakery_var_video');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_video_callback');
}