<?php
/*
 *
 * @Shortcode Name : Progressbar
 * @retrun
 *
 */

if (!function_exists('foodbakery_var_page_builder_progressbars')) {

    function foodbakery_var_page_builder_progressbars($die = 0) {
	global $foodbakery_node, $post, $foodbakery_var_html_fields, $foodbakery_var_form_fields;
	$shortcode_element = '';
	$filter_element = 'filterdrag';
	$shortcode_view = '';
	$output = array();
	$foodbakery_counter = $_POST['counter'];
	$PREFIX = 'foodbakery_progressbar|progressbar_item';
	$parseObject = new ShortcodeParse();
	$progressbars_num = 0;
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
	    'column_size' => '1/1',
	    'progressbars_element_title' => '',
            'foodbakery_var_progress_align' => '',
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
	    $progressbars_num = count($atts_content);
	}
	$progressbars_element_size = '25';
	$progressbars_element_title = isset($progressbars_element_title) ? $progressbars_element_title : '';
        $foodbakery_var_progress_align = isset($foodbakery_var_progress_align) ? $foodbakery_var_progress_align : '';
	foreach ($defaults as $key => $values) {
	    if (isset($atts[$key])) {
		$$key = $atts[$key];
	    } else {
		$$key = $values;
	    }
	}
	$name = 'foodbakery_var_page_builder_progressbars';
	$coloumn_class = 'column_' . $progressbars_element_size;

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
	<div id="<?php echo esc_attr($name . $foodbakery_counter); ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="progressbars" data="<?php echo foodbakery_element_size_data_array_index($progressbars_element_size) ?>" >
	    <?php foodbakery_element_setting($name, $foodbakery_counter, $progressbars_element_size, '', 'list-alt'); ?>
	    <div class="cs-wrapp-class-<?php echo esc_attr($foodbakery_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $foodbakery_counter); ?>" style="display: none;">
		<div class="cs-heading-area">
		    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_progressbar_options')); ?></h5>
		    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo esc_js($name . $foodbakery_counter); ?>','<?php echo esc_js($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
		<div class="cs-clone-append cs-pbwp-content" >
		    <div class="cs-wrapp-tab-box">
			<div id="shortcode-item-<?php echo esc_attr($foodbakery_counter); ?>" data-shortcode-template="{{child_shortcode}} [/<?php echo esc_attr('foodbakery_progressbar'); ?>]" data-shortcode-child-template="[<?php echo esc_attr('progressbar_item'); ?> {{attributes}}] {{content}} [/<?php echo esc_attr('progressbar_item'); ?>]">
			    <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[<?php echo esc_attr('foodbakery_progressbar'); ?> {{attributes}}]">
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
					'std' => esc_html($progressbars_element_title),
					'id' => 'progressbars_element_title',
					'cust_name' => 'progressbars_element_title[]',
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
                                        'std' => $foodbakery_var_progress_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_progress_align',
                                        'cust_name' => 'foodbakery_var_progress_align[]',
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
			    </div>
			    <?php
			    if (isset($progressbars_num) && $progressbars_num <> '' && isset($atts_content) && is_array($atts_content)) {
				foreach ($atts_content as $progressbars) {
				    $rand_id = $foodbakery_counter . '' . foodbakery_generate_random_string(3);
				    $defaults = array('progressbars_title' => '', 'progressbars_color' => '#4d8b0c', 'progressbars_percentage' => '50');
				    foreach ($defaults as $key => $values) {
					if (isset($progressbars['atts'][$key])) {
					    $$key = $progressbars['atts'][$key];
					} else {
					    $$key = $values;
					}
				    }
				    echo '<div class="cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content" id="foodbakery_infobox_' . $rand_id . '">';
				    ?>
				    <header>
					<h4><i class='icon-arrows'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_progressbar')); ?></h4>
					<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_remove')); ?></a></header>
				    <?php
				    $foodbakery_opt_array = array(
					'name' => foodbakery_var_theme_text_srt('foodbakery_var_progressbar_title'),
					'desc' => '',
					'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_progressbar_title_hint'),
					'echo' => true,
					'field_params' => array(
					    'std' => esc_html($progressbars_title),
					    'id' => 'progressbars_title',
					    'cust_name' => 'progressbars_title[]',
					    'return' => true,
					),
				    );
				    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
				    $foodbakery_opt_array = array(
					'name' => foodbakery_var_theme_text_srt('foodbakery_var_progressbar_skill'),
					'desc' => '',
					'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_progressbar_skill_hint'),
					'echo' => true,
					'field_params' => array(
					    'std' => esc_html($progressbars_percentage),
					    'id' => 'progressbars_percentage',
					    'cust_name' => 'progressbars_percentage[]',
					    'return' => true,
					),
				    );
				    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
				    $foodbakery_opt_array = array(
					'name' => foodbakery_var_theme_text_srt('foodbakery_var_progressbar_color'),
					'desc' => '',
					'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_progressbar_color_hint'),
					'echo' => true,
					'field_params' => array(
					    'std' => esc_html($progressbars_color),
					    'id' => 'progressbars_color',
					    'cust_name' => 'progressbars_color[]',
					    'return' => true,
					    'classes' => 'bg_color',
					),
				    );
				    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
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
			    'std' => esc_attr($progressbars_num),
			    'id' => '',
			    'before' => '',
			    'after' => '',
			    'classes' => 'fieldCounter',
			    'extra_atr' => '',
			    'cust_id' => '',
			    'cust_name' => 'progressbars_num[]',
			    'return' => true,
			    'required' => false
			);
			echo foodbakery_allow_special_char($foodbakery_var_form_fields->foodbakery_var_form_hidden_render($foodbakery_opt_array));
			?>
		    </div>
		    <div class="wrapptabbox cs-zero-padding">
			<div class="opt-conts">
			    <ul class="form-elements noborder">
				<li class="to-field"> <a href="javascript:void(0);" class="add_servicesss cs-main-btn" onclick="foodbakery_shortcode_element_ajax_call('progressbars', 'shortcode-item-<?php echo esc_js($foodbakery_counter); ?>', '<?php echo esc_js(admin_url('admin-ajax.php')); ?>')"><i class="icon-plus-circle"></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_progressbar_add_button')); ?></a> </li>
				<div id="loading" class="shortcodeload"></div>
			    </ul>
			    <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
	    		    <ul class="form-elements insert-bg">
	    			<li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo esc_js(str_replace('foodbakery_var_page_builder_', '', $name)); ?>', 'shortcode-item-<?php echo esc_js($foodbakery_counter); ?>', '<?php echo esc_js($filter_element); ?>')" ><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_insert')); ?></a> </li>
	    		    </ul>
	    		    <div id="results-shortocde"></div>
				<?php
			    } else {
				$foodbakery_opt_array = array(
				    'std' => 'progressbars',
				    'id' => '',
				    'before' => '',
				    'after' => '',
				    'classes' => '',
				    'extra_atr' => '',
				    'cust_id' => '',
				    'cust_name' => 'foodbakery_orderby[]',
				    'return' => true,
				    'required' => false
				);
				echo foodbakery_allow_special_char($foodbakery_var_form_fields->foodbakery_var_form_hidden_render($foodbakery_opt_array));
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
	<script>

	    /*
	     * modern selection box function
	     */
	    jQuery(document).ready(function ($) {
		chosen_selectionbox();
		popup_over();
	    });
	    /*
	     * modern selection box function
	     */
	</script>
	<?php
	if ($die <> 1) {
	    die();
	}
    }

    add_action('wp_ajax_foodbakery_var_page_builder_progressbars', 'foodbakery_var_page_builder_progressbars');
}

if (!function_exists('foodbakery_save_page_builder_data_progressbar_callback')) {

    /**
     * Save data for progressbar shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_progressbar_callback($args) {

	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	if ($widget_type == "progressbars" || $widget_type == "cs_progressbars") {
	    $shortcode = $shortcode_item = '';
            
            $page_element_size  =  $data['progressbars_element_size'][$counters['foodbakery_global_counter_progressbars']];
            $current_element_size  =  $data['progressbars_element_size'][$counters['foodbakery_global_counter_progressbars']];
            
	    if (isset($_POST['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $_POST['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes($_POST['shortcode']['progressbars'][$counters['foodbakery_shortcode_counter_progressbars']]);
                
                $element_settings   = 'progressbars_element_size="'.$current_element_size.'"';
                $reg = '/progressbars_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
		$counters['foodbakery_shortcode_counter_progressbars'] ++;
	    } else {
		if (isset($_POST['progressbars_num'][$counters['foodbakery_counter_progressbars']]) && $_POST['progressbars_num'][$counters['foodbakery_counter_progressbars']] > 0) {
		    for ($i = 1; $i <= $_POST['progressbars_num'][$counters['foodbakery_counter_progressbars']]; $i ++) {
			$shortcode_item .= '[progressbar_item ';
			if (isset($_POST['progressbars_title'][$counters['foodbakery_counter_progressbars_node']]) && $_POST['progressbars_title'][$counters['foodbakery_counter_progressbars_node']] != '') {
			    $shortcode_item .= 'progressbars_title="' . htmlspecialchars($_POST['progressbars_title'][$counters['foodbakery_counter_progressbars_node']], ENT_QUOTES) . '" ';
			}
			if (isset($_POST['progressbars_percentage'][$counters['foodbakery_counter_progressbars_node']]) && $_POST['progressbars_percentage'][$counters['foodbakery_counter_progressbars_node']] != '') {
			    $shortcode_item .= 'progressbars_percentage="' . htmlspecialchars($_POST['progressbars_percentage'][$counters['foodbakery_counter_progressbars_node']], ENT_QUOTES) . '" ';
			}
			if (isset($_POST['progressbars_color'][$counters['foodbakery_counter_progressbars_node']]) && $_POST['progressbars_color'][$counters['foodbakery_counter_progressbars_node']] != '') {
			    $shortcode_item .= 'progressbars_color="' . htmlspecialchars($_POST['progressbars_color'][$counters['foodbakery_counter_progressbars_node']], ENT_QUOTES) . '" ';
			}
			$shortcode_item .=']';
			$counters['foodbakery_counter_progressbars_node'] ++;
		    }
		}
                $element_settings   = 'progressbars_element_size="'.htmlspecialchars( $data['progressbars_element_size'][$counters['foodbakery_global_counter_progressbars']] ).'"';
		$shortcode .= '[foodbakery_progressbar '.$element_settings.' ';
		if (isset($_POST['progressbars_element_title'][$counters['foodbakery_counter_progressbars']]) && $_POST['progressbars_element_title'][$counters['foodbakery_counter_progressbars']] != '') {
		    $shortcode .= 'progressbars_element_title="' . htmlspecialchars($_POST['progressbars_element_title'][$counters['foodbakery_counter_progressbars']], ENT_QUOTES) . '" ';
		}
                if (isset($_POST['foodbakery_var_progress_align'][$counters['foodbakery_counter_progressbars']]) && $_POST['foodbakery_var_progress_align'][$counters['foodbakery_counter_progressbars']] != '') {
		    $shortcode .= 'foodbakery_var_progress_align="' . htmlspecialchars($_POST['foodbakery_var_progress_align'][$counters['foodbakery_counter_progressbars']], ENT_QUOTES) . '" ';
		}
		$shortcode .= ']' . $shortcode_item . '[/foodbakery_progressbar]';
		$shortcode_data .= $shortcode;
		$counters['foodbakery_counter_progressbars'] ++;
	    }
	    $counters['foodbakery_global_counter_progressbars'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_progressbars', 'foodbakery_save_page_builder_data_progressbar_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_progressbar_callback')) {

    /**
     * Populate progressbar shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_progressbar_callback($counters) {
	$counters['foodbakery_counter_progressbars'] = 0;
	$counters['foodbakery_counter_progressbars_node'] = 0;
	$counters['foodbakery_global_counter_progressbars'] = 0;
	$counters['foodbakery_shortcode_counter_progressbars'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_progressbar_callback');
}
if (!function_exists('foodbakery_shortcode_names_list_populate_progressbars_callback')) {

    /**
     * Populate progressbars shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_progressbars_callback($shortcode_array) {
	$shortcode_array['progressbars'] = array(
	    'title' => foodbakery_var_frame_text_srt('foodbakery_var_progressbars'),
	    'name' => 'progressbars',
	    'icon' => 'icon-list-alt',
	    'categories' => ' loops',
	);
	return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_progressbars_callback');
}

if (!function_exists('foodbakery_element_list_populate_progressbars_callback')) {

    /**
     * Populate progressbars shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_progressbars_callback($element_list) {
	$element_list['progressbars'] = foodbakery_var_frame_text_srt('foodbakery_var_progressbars');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_progressbars_callback');
}

if (!function_exists('foodbakery_shortcode_sub_element_ui_progressbars_callback')) {

    /**
     * Render UI for sub element in progressbars settings.
     *
     * @param	array $args
     */
    function foodbakery_shortcode_sub_element_ui_progressbars_callback($args) {
	$type = $args['type'];
	$foodbakery_var_html_fields = $args['html_fields'];

	if ($type == 'progressbars') {
	    $rand_id = rand(40, 9999999);
	    ?>
	    <div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content' id="foodbakery_infobox_<?php echo intval($rand_id); ?>">
	        <header>
	    	<h4><i class='icon-arrows'></i><?php echo foodbakery_var_frame_text_srt('foodbakery_var_progressbar'); ?></h4>
	    	<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo foodbakery_var_frame_text_srt('foodbakery_var_remove'); ?></a>
	        </header>
		<?php
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_frame_text_srt('foodbakery_var_progressbar_title'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_progressbar_title_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => '',
			'id' => 'progressbars_title',
			'cust_name' => 'progressbars_title[]',
			'return' => true,
		    ),
		);

		$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);


		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_frame_text_srt('foodbakery_var_progressbar_skill'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_progressbar_skill_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => '50',
			'id' => 'progressbars_percentage',
			'cust_name' => 'progressbars_percentage[]',
			'return' => true,
		    ),
		);

		$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);


		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_frame_text_srt('foodbakery_var_progressbar_color'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_progressbar_color_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => '#4d8b0c',
			'id' => 'progressbars_color',
			'cust_name' => 'progressbars_color[]',
			'return' => true,
			'classes' => 'bg_color',
		    ),
		);

		$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
		?>

	    </div>

	    <?php
	}
    }

    add_action('foodbakery_shortcode_sub_element_ui', 'foodbakery_shortcode_sub_element_ui_progressbars_callback');
}