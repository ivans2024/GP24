<?php
/**
 * @Spacer html form for page builder
 */
if (!function_exists('foodbakery_var_page_builder_spacer')) {

    function foodbakery_var_page_builder_spacer($die = 0) {
	global $foodbakery_node, $count_node, $post, $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;
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
	    $FOODBAKERY_PREFIX = 'spacer';
	    $parseObject = new ShortcodeParse();
	    $output = $parseObject->foodbakery_shortcodes($output, $shortcode_str, true, $FOODBAKERY_PREFIX);
	}
	$defaults = array(
	    'foodbakery_var_spacer_height' => '25'
	);
	if (isset($output['0']['atts'])) {
	    $atts = $output['0']['atts'];
	} else {
	    $atts = array();
	}
	$spacer_element_size = '25';
	foreach ($defaults as $key => $values) {
	    if (isset($atts[$key])) {
		$$key = $atts[$key];
	    } else {
		$$key = $values;
	    }
	}
	$name = 'foodbakery_var_page_builder_spacer';
	$coloumn_class = 'column_' . $spacer_element_size;
	$foodbakery_var_spacer_height = isset($foodbakery_var_spacer_height) ? $foodbakery_var_spacer_height : '';
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
	     <?php echo esc_attr($shortcode_view); ?>" item="spacer" data="<?php echo foodbakery_element_size_data_array_index($spacer_element_size) ?>" >
		 <?php foodbakery_element_setting($name, $foodbakery_counter, $spacer_element_size) ?>
	    <div class="cs-wrapp-class-<?php echo esc_attr($foodbakery_counter); ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $foodbakery_counter) ?>" data-shortcode-template="[spacer {{attributes}}]{{content}}[/spacer]" style="display: none;"">
		<div class="cs-heading-area">
		    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_edit_spacer_options')); ?></h5>
		    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo esc_js($name . $foodbakery_counter) ?>','<?php echo esc_js($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
		<div class="cs-pbwp-content">
		    <div class="cs-wrapp-clone cs-shortcode-wrapp">
			<?php
			$foodbakery_opt_array = array(
			    'name' => foodbakery_var_theme_text_srt('foodbakery_var_spacer_height'),
			    'desc' => '',
			    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_spacer_height_hint'),
			    'echo' => true,
			    'field_params' => array(
				'std' => esc_html($foodbakery_var_spacer_height),
				'id' => 'spacer_height',
				'cust_name' => 'foodbakery_var_spacer_height[]',
				'return' => true,
				'cs-range-input' => 'cs-range-input',
			    ),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
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
			    'std' => 'spacer',
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

    add_action('wp_ajax_foodbakery_var_page_builder_spacer', 'foodbakery_var_page_builder_spacer');
}

if (!function_exists('foodbakery_save_page_builder_data_spacer_callback')) {

    /**
     * Save data for spacer shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_spacer_callback($args) {

	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	if ($widget_type == "spacer" || $widget_type == "cs_spacer") {
	    $shortcode = '';
            $page_element_size  =  $data['spacer_element_size'][$counters['foodbakery_global_counter_spacer']];
            $current_element_size  =  $data['spacer_element_size'][$counters['foodbakery_global_counter_spacer']];
                        
	    if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes(( $data['shortcode']['spacer'][$counters['foodbakery_shortcode_counter_spacer']]));
                $element_settings   = 'spacer_element_size="'.$current_element_size.'"';
                $reg = '/spacer_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
		$counters['foodbakery_shortcode_counter_spacer'] ++;
	    } else {
                $shortcode = '[spacer spacer_element_size="'.htmlspecialchars( $data['spacer_element_size'][$counters['foodbakery_global_counter_spacer']] ).'" ';
		if (isset($data['foodbakery_var_spacer_height'][$counters['foodbakery_counter_spacer']]) && $data['foodbakery_var_spacer_height'][$counters['foodbakery_counter_spacer']] != '') {
		    $shortcode .= 'foodbakery_var_spacer_height="' . stripslashes(htmlspecialchars(($data['foodbakery_var_spacer_height'][$counters['foodbakery_counter_spacer']]), ENT_QUOTES)) . '" ';
		}
		$shortcode .= ']';
		$shortcode .= '[/spacer]';
		$shortcode_data .= $shortcode;
		$counters['foodbakery_counter_spacer'] ++;
	    }
	    $counters['foodbakery_global_counter_spacer'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_spacer', 'foodbakery_save_page_builder_data_spacer_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_spacer_callback')) {

    /**
     * Populate spacer shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_spacer_callback($counters) {
	$counters['foodbakery_counter_spacer'] = 0;
	$counters['foodbakery_shortcode_counter_spacer'] = 0;
	$counters['foodbakery_global_counter_spacer'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_spacer_callback');
}
if (!function_exists('foodbakery_shortcode_names_list_populate_spacer_callback')) {

    /**
     * Populate spacer shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_spacer_callback($shortcode_array) {
	$shortcode_array['spacer'] = array(
	    'title' => foodbakery_var_frame_text_srt('foodbakery_var_spacer'),
	    'name' => 'spacer',
	    'icon' => 'icon-ellipsis-h',
	    'categories' => 'contentblocks',
	);
	return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_spacer_callback');
}

if (!function_exists('foodbakery_element_list_populate_spacer_callback')) {

    /**
     * Populate spacer shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_spacer_callback($element_list) {
	$element_list['spacer'] = foodbakery_var_frame_text_srt('foodbakery_var_spacer');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_spacer_callback');
}