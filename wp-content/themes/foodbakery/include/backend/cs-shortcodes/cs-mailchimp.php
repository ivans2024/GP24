<?php
/*
 *
 * @File : Image Frame 
 * @retrun
 *
 */

if (!function_exists('foodbakery_var_page_builder_mail_chimp')) {

    function foodbakery_var_page_builder_mail_chimp($die = 0) {
	global $post, $foodbakery_node, $foodbakery_var_html_fields, $coloumn_class, $foodbakery_var_form_fields, $foodbakery_var_static_text;
	if (function_exists('foodbakery_shortcode_names')) {
	    $shortcode_element = '';
	    $filter_element = 'filterdrag';
	    $shortcode_view = '';
	    $foodbakery_output = array();
	    $FOODBAKERY_PREFIX = 'foodbakery_mail_chimp';
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
		'foodbakery_var_mail_section_title' => '',
		'foodbakery_var_mail_sub_title' => '',
		'foodbakery_var_background_color' => '',
	    );
	    if (isset($foodbakery_output['0']['atts'])) {
		$atts = $foodbakery_output['0']['atts'];
	    } else {
		$atts = array();
	    }
	    if (isset($foodbakery_output['0']['content'])) {
		$foodbakery_var_mail_description = $foodbakery_output['0']['content'];
	    } else {
		$foodbakery_var_mail_description = '';
	    }
	    $mail_chimp_element_size = '25';
	    foreach ($defaults as $key => $values) {
		if (isset($atts[$key])) {
		    $$key = $atts[$key];
		} else {
		    $$key = $values;
		}
	    }
	    $name = 'foodbakery_var_page_builder_mail_chimp';
	    $coloumn_class = 'column_' . $mail_chimp_element_size;
	    $foodbakery_var_mail_section_title = isset($foodbakery_var_mail_section_title) ? $foodbakery_var_mail_section_title : '';
	    $foodbakery_var_mail_sub_title = isset($foodbakery_var_mail_sub_title) ? $foodbakery_var_mail_sub_title : '';
	    $foodbakery_var_background_color = isset($foodbakery_var_background_color) ? $foodbakery_var_background_color : '';
	    if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
		$shortcode_element = 'shortcode_element_class';
		$shortcode_view = 'cs-pbwp-shortcode';
		$filter_element = 'ajax-drag';
		$coloumn_class = '';
	    }
	    $strings = new foodbakery_theme_all_strings;
	    $strings->foodbakery_short_code_strings();
	    ?>
	    <div id="<?php echo esc_attr($name . $foodbakery_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?>
		 <?php echo esc_attr($shortcode_view); ?>" item="mail_chimp" data="<?php echo foodbakery_element_size_data_array_index($mail_chimp_element_size) ?>" >
		     <?php foodbakery_element_setting($name, $foodbakery_counter, $mail_chimp_element_size) ?>
	        <div class="cs-wrapp-class-<?php echo intval($foodbakery_counter) ?>
		     <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $foodbakery_counter) ?>" data-shortcode-template="[foodbakery_mail_chimp {{attributes}}]{{content}}[/foodbakery_mail_chimp]" style="display: none;">
	    	<div class="cs-heading-area" data-counter="<?php echo esc_attr($foodbakery_counter) ?>">
	    	    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_mailchimp_edit_options')); ?></h5>
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
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_mail_title'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_mail_title_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => esc_attr($foodbakery_var_mail_section_title),
				    'cust_id' => 'foodbakery_var_mail_section_title' . $foodbakery_counter,
				    'classes' => '',
				    'cust_name' => 'foodbakery_var_mail_section_title[]',
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			    $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_mail_sub_title'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_mail_sub_title_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => esc_attr($foodbakery_var_mail_sub_title),
				    'cust_id' => '',
				    'classes' => 'txtfield',
				    'cust_name' => 'foodbakery_var_mail_sub_title[]',
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
                            
			    $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_mail_bgcolor'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_mail_bgcolor_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => esc_attr($foodbakery_var_background_color),
				    'cust_id' => 'foodbakery_var_background_color' . $foodbakery_counter,
				    'classes' => 'bg_color',
				    'cust_name' => 'foodbakery_var_background_color[]',
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			    $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_mail_description'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_mail_description_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => esc_textarea($foodbakery_var_mail_description),
				    'cust_id' => 'foodbakery_var_mail_description' . $foodbakery_counter,
				    'classes' => 'textarea',
				    'cust_name' => 'foodbakery_var_mail_description[]',
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
				'std' => 'mail_chimp',
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
				    'cust_id' => 'mail_chimp_save',
				    'cust_type' => 'button',
				    'classes' => 'cs-foodbakery-admin-btn',
				    'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
				    'cust_name' => 'mail_chimp_save' . $foodbakery_counter,
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

    add_action('wp_ajax_foodbakery_var_page_builder_mail_chimp', 'foodbakery_var_page_builder_mail_chimp');
}

if (!function_exists('foodbakery_save_page_builder_data_mail_chimp_callback')) {

    /**
     * Save data for image frame shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_mail_chimp_callback($args) {
	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	if ($widget_type == "mail_chimp" || $widget_type == "cs_mail_chimp") {
	    $foodbakery_var_mail_chimp = '';
            
            $page_element_size  =  $data['mail_chimp_element_size'][$counters['foodbakery_global_counter_mail_chimp']];
            $current_element_size  =  $data['mail_chimp_element_size'][$counters['foodbakery_global_counter_mail_chimp']];
	    
            if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes(( $data['shortcode']['mail_chimp'][$counters['foodbakery_shortcode_counter_mail_chimp']]));
                
                $element_settings   = 'mail_chimp_element_size="'.$current_element_size.'"';
                $reg = '/mail_chimp_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
                
		$counters['foodbakery_shortcode_counter_mail_chimp'] ++;
	    } else {
                $foodbakery_var_mail_chimp = '[foodbakery_mail_chimp mail_chimp_element_size="'.htmlspecialchars( $data['mail_chimp_element_size'][$counters['foodbakery_global_counter_mail_chimp']] ).'" ';
		if (isset($data['foodbakery_var_mail_section_title'][$counters['foodbakery_counter_mail_chimp']]) && $data['foodbakery_var_mail_section_title'][$counters['foodbakery_counter_mail_chimp']] != '') {
		    $foodbakery_var_mail_chimp .= 'foodbakery_var_mail_section_title="' . htmlspecialchars($data['foodbakery_var_mail_section_title'][$counters['foodbakery_counter_mail_chimp']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_mail_sub_title'][$counters['foodbakery_counter_mail_chimp']]) && $data['foodbakery_var_mail_sub_title'][$counters['foodbakery_counter_mail_chimp']] != '') {
		    $foodbakery_var_mail_chimp .= 'foodbakery_var_mail_sub_title="' . htmlspecialchars($data['foodbakery_var_mail_sub_title'][$counters['foodbakery_counter_mail_chimp']], ENT_QUOTES) . '" ';
		}
                if (isset($data['foodbakery_var_mail_align'][$counters['foodbakery_counter_mail_chimp']]) && $data['foodbakery_var_mail_align'][$counters['foodbakery_counter_mail_chimp']] != '') {
		    $foodbakery_var_mail_chimp .= 'foodbakery_var_mail_align="' . htmlspecialchars($data['foodbakery_var_mail_align'][$counters['foodbakery_counter_mail_chimp']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_background_color'][$counters['foodbakery_counter_mail_chimp']]) && $data['foodbakery_var_background_color'][$counters['foodbakery_counter_mail_chimp']] != '') {
		    $foodbakery_var_mail_chimp .= 'foodbakery_var_background_color="' . htmlspecialchars($data['foodbakery_var_background_color'][$counters['foodbakery_counter_mail_chimp']], ENT_QUOTES) . '" ';
		}
		$foodbakery_var_mail_chimp .= ']';
		if (isset($data['foodbakery_var_mail_description'][$counters['foodbakery_counter_mail_chimp']]) && $data['foodbakery_var_mail_description'][$counters['foodbakery_counter_mail_chimp']] != '') {
		    $foodbakery_var_mail_chimp .= htmlspecialchars($data['foodbakery_var_mail_description'][$counters['foodbakery_counter_mail_chimp']], ENT_QUOTES) . ' ';
		}
		$foodbakery_var_mail_chimp .= '[/foodbakery_mail_chimp]';
		$shortcode_data .= $foodbakery_var_mail_chimp;
		$counters['foodbakery_counter_mail_chimp'] ++;
	    }
	    $counters['foodbakery_global_counter_mail_chimp'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_mail_chimp', 'foodbakery_save_page_builder_data_mail_chimp_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_mail_chimp_callback')) {

    /**
     * Populate image frame shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_mail_chimp_callback($counters) {
	$counters['foodbakery_global_counter_mail_chimp'] = 0;
	$counters['foodbakery_shortcode_counter_mail_chimp'] = 0;
	$counters['foodbakery_counter_mail_chimp'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_mail_chimp_callback');
}
if (!function_exists('foodbakery_shortcode_names_list_populate_mail_chimp_callback')) {

    /**
     * Populate image frame shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_mail_chimp_callback($shortcode_array) {
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_short_code_strings();
	$shortcode_array['mail_chimp'] = array(
	    'title' => foodbakery_var_theme_text_srt('foodbakery_var_mail_chimp'),
	    'name' => 'mail_chimp',
	    'icon' => 'icon-photo',
	    'categories' => 'typography',
	);
	return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_mail_chimp_callback');
}

if (!function_exists('foodbakery_element_list_populate_mail_chimp_callback')) {

    /**
     * Populate image frame shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_mail_chimp_callback($element_list) {
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_short_code_strings();
	$element_list['mail_chimp'] = foodbakery_var_theme_text_srt('foodbakery_var_mail_chimp');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_mail_chimp_callback');
}