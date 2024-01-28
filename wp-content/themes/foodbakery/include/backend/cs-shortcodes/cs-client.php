<?php
/*
 *
 * @Shortcode Name : Clients
 * @retrun
 *
 */

if (!function_exists('foodbakery_var_page_builder_clients')) {

    function foodbakery_var_page_builder_clients($die = 0) {
	global $post, $foodbakery_node, $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;
	$shortcode_element = '';
	$filter_element = 'filterdrag';
	$shortcode_view = '';
	$output = array();
	$foodbakery_counter = $_POST['counter'];
	$clients_num = 0;
	
	if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
	    $FOODBAKERY_POSTID = '';
	    $shortcode_element_id = '';
	} else {
	    $FOODBAKERY_POSTID = $_POST['POSTID'];
	    $shortcode_element_id = $_POST['shortcode_element_id'];
	    $shortcode_str = stripslashes($shortcode_element_id);
	    $FOODBAKERY_PREFIX = 'foodbakery_clients|clients_item';
	    $parseObject = new ShortcodeParse();
	    $output = $parseObject->foodbakery_shortcodes($output, $shortcode_str, true, $FOODBAKERY_PREFIX);
	}
	$defaults = array(
	    'column_size' => '1/1',
	    'foodbakery_var_clients_text_color' => '',
	    'foodbakery_var_clients_element_title' => '',
	    'foodbakery_clients_class' => '',
	    'clients_style' => '',
	    'clients_text_color' => '',
	    'foodbakery_var_client_view'=>'',
            'foodbakery_var_client_align' => '',
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
	    $clients_num = count($atts_content);
	}
	$clients_element_size = '100';
	foreach ($defaults as $key => $values) {
	    if (isset($atts[$key])) {
		$$key = $atts[$key];
	    } else {
		$$key = $values;
	    }
	}
	$name = 'foodbakery_var_page_builder_clients';
	$coloumn_class = 'column_' . $clients_element_size;

	if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
	    $shortcode_element = 'shortcode_element_class';
	    $shortcode_view = 'cs-pbwp-shortcode';
	    $filter_element = 'ajax-drag';
	    $coloumn_class = '';
	}
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_short_code_strings();
        $foodbakery_var_clients_element_title = isset($foodbakery_var_clients_element_title) ? $foodbakery_var_clients_element_title : '';
	$foodbakery_var_client_view = isset($foodbakery_var_client_view) ? $foodbakery_var_client_view : '';
	$foodbakery_var_clients_text_color = isset($foodbakery_var_clients_text_color) ? $foodbakery_var_clients_text_color : '';
	$foodbakery_var_clients_position = isset($foodbakery_var_clients_position) ? $foodbakery_var_clients_position : '';
        $foodbakery_var_client_align = isset($foodbakery_var_client_align) ? $foodbakery_var_client_align : '';
	$clients_img_user = isset($clients_img_user) ? $clients_img_user : '';
	?>
	<div id="<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>_del" class="column  parentdelete <?php echo foodbakery_allow_special_char($coloumn_class); ?> <?php echo foodbakery_allow_special_char($shortcode_view); ?>" item="clients" data="<?php echo foodbakery_element_size_data_array_index($clients_element_size) ?>" >
	    <?php foodbakery_element_setting($name, $foodbakery_counter, $clients_element_size, '', 'comments-o', $type = ''); ?>
	    <div class="cs-wrapp-class-<?php echo foodbakery_allow_special_char($foodbakery_counter) ?> <?php echo foodbakery_allow_special_char($shortcode_element); ?>" id="<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>" style="display: none;">
		<div class="cs-heading-area">
		    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_client_edit_options')); ?></h5>
		    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>','<?php echo foodbakery_allow_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
		</div>
		<div class="cs-clone-append cs-pbwp-content">
		    <div class="cs-wrapp-tab-box">
			<div id="shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>" data-shortcode-template="{{child_shortcode}} [/foodbakery_clients]" data-shortcode-child-template="[clients_item {{attributes}}] {{content}} [/clients_item]">
			    <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[foodbakery_clients {{attributes}}]">
				<?php
				if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
				    foodbakery_shortcode_element_size();
				}
				$foodbakery_clients_style = isset($foodbakery_clients_style) ? $foodbakery_clients_style : '';
				$foodbakery_opt_array = array(
				    'name' => foodbakery_var_theme_text_srt('foodbakery_var_client_element_title'),
				    'desc' => '',
				    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_client_title_hint_text'),
				    'echo' => true,
				    'field_params' => array(
					'std' => esc_attr($foodbakery_var_clients_element_title),
					'cust_id' => '',
					'cust_id' => 'foodbakery_var_clients_element_title' . $foodbakery_counter,
					'cust_name' => 'foodbakery_var_clients_element_title[]',
					'return' => true,
				    ),
				);
				$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
                        	$foodbakery_opt_array = array(
                                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_call_to_views' ),
                                    'desc' => '',
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $foodbakery_var_client_view,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_client_view',
                                        'cust_name' => 'foodbakery_var_client_view[]',
                                        'classes' => 'service_postion chosen-select-no-single select-medium',
                                        'options' => array(
                                            'simple' => foodbakery_var_theme_text_srt( 'foodbakery_var_client_simple' ),
                                            'fancy' => foodbakery_var_theme_text_srt( 'foodbakery_var_client_fancy' ),
                                        ),
                                        'return' => true,
                                    ),
                                );
                                $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );
				$foodbakery_opt_array = array(
                                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_title_alignment' ),
                                    'desc' => '',
                                    'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_title_alignment_hint' ),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $foodbakery_var_client_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_client_align',
                                        'cust_name' => 'foodbakery_var_client_align[]',
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
			    if (isset($clients_num) && $clients_num <> '' && isset($atts_content) && is_array($atts_content)) {
				foreach ($atts_content as $clients) {
				    $rand_string = rand(1234, 7894563);
				    $foodbakery_var_clients_text = $clients['content'];
				    $defaults = array('foodbakery_var_clients_text' => '', 'foodbakery_var_clients_img_user_array' => '', 'foodbakery_var_clients_position' => '');
				    foreach ($defaults as $key => $values) {
					if (isset($clients['atts'][$key])) {
					    $$key = $clients['atts'][$key];
					} else {
					    $$key = $values;
					}
				    }
				    ?>
				    <div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content' id="foodbakery_infobox_<?php echo foodbakery_allow_special_char($rand_string); ?>">
					<header>
					    <h4><i class='icon-arrows'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_client_counter')); ?></h4>
					    <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_remove')); ?></a>
					</header>
					<?php
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_client_url'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_client_url_hint_text'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_attr($foodbakery_var_clients_text),
						'cust_id' => '',
						'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
						'cust_name' => 'foodbakery_var_clients_text[]',
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'std' => $foodbakery_var_clients_img_user_array,
					    'id' => 'clients_img_user',
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_client_image'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_client_url_image_hint_text'),
					    'echo' => true,
					    'array' => true,
					    'prefix' => '',
					    'field_params' => array(
						'std' => $foodbakery_var_clients_img_user_array,
						'id' => 'clients_img_user',
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
				'std' => foodbakery_allow_special_char($clients_num),
				'id' => '',
				'before' => '',
				'after' => '',
				'classes' => 'fieldCounter',
				'extra_atr' => '',
				'cust_id' => '',
				'cust_name' => 'clients_num[]',
				'return' => true,
				'required' => false
			    );
			    echo foodbakery_allow_special_char($foodbakery_var_form_fields->foodbakery_var_form_hidden_render($foodbakery_opt_array));
			    ?>
			</div>
			<div class="wrapptabbox cs-pbwp-content cs-zero-padding">
			    <div class="opt-conts">
				<ul class="form-elements">
				    <li class="to-field"> <a href="javascript:void(0);" class="add_servicesss cs-main-btn" onclick="foodbakery_shortcode_element_ajax_call('clients', 'shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>', '<?php echo admin_url('admin-ajax.php'); ?>')"><i class="icon-plus-circle"></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_client_url_add_clients')); ?></a> </li>
				    <div id="loading" class="shortcodeload"></div>
				</ul>
				<?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
	    			<ul class="form-elements insert-bg noborder">
	    			    <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo str_replace('foodbakery_var_page_builder_', '', $name); ?>', 'shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>', '<?php echo foodbakery_allow_special_char($filter_element); ?>')" ><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_client_url_add_insert')); ?></a> </li>
	    			</ul>
	    			<div id="results-shortocde"></div>
				    <?php
				} else {
				    $foodbakery_opt_array = array(
					'std' => 'clients',
					'id' => '',
					'before' => '',
					'after' => '',
					'classes' => '',
					'extra_atr' => '',
					'cust_id' => 'foodbakery_orderby' . $foodbakery_counter,
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
					    'cust_id' => 'clients_save' . $foodbakery_counter,
					    'cust_type' => 'button',
					    'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
					    'classes' => 'cs-foodbakery-admin-btn',
					    'cust_name' => 'clients_save',
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

    add_action('wp_ajax_foodbakery_var_page_builder_clients', 'foodbakery_var_page_builder_clients');
}

if (!function_exists('foodbakery_save_page_builder_data_clients_callback')) {

    /**
     * Save data for clients shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_clients_callback($args) {
	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	$shortcode_data ='';
	if ($widget_type == "clients" || $widget_type == "cs_clients") {
	    $shortcode = $shortcode_item = '';
            $page_element_size  =  $data['clients_element_size'][$counters['foodbakery_global_counter_clients']];
            $current_element_size  =  $data['clients_element_size'][$counters['foodbakery_global_counter_clients']];
            
	    if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes($data['shortcode']['clients'][$counters['foodbakery_shortcode_counter_clients']]);
                $element_settings   = 'clients_element_size="'.$current_element_size.'"';
                $reg = '/clients_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
		$counters['foodbakery_shortcode_counter_clients'] ++;
	    } else {
		if (isset($data['clients_num'][$counters['foodbakery_counter_clients']]) && $data['clients_num'][$counters['foodbakery_counter_clients']] > 0) {
		    for ($i = 1; $i <= $data['clients_num'][$counters['foodbakery_counter_clients']]; $i ++) {
			$shortcode_item .= '[clients_item ';
			if (isset($data['foodbakery_var_clients_img_user_array'][$counters['foodbakery_counter_clients_node']]) && $data['foodbakery_var_clients_img_user_array'][$counters['foodbakery_counter_clients_node']] != '') {
			    $shortcode_item .= 'foodbakery_var_clients_img_user_array="' . $data['foodbakery_var_clients_img_user_array'][$counters['foodbakery_counter_clients_node']] . '" ';
			}
			if (isset($data['foodbakery_var_clients_text'][$counters['foodbakery_counter_clients_node']]) && $data['foodbakery_var_clients_text'][$counters['foodbakery_counter_clients_node']] != '') {
			    $shortcode_item .= 'foodbakery_var_clients_text="' . $data['foodbakery_var_clients_text'][$counters['foodbakery_counter_clients_node']] . '" ';
			}
			$shortcode_item .= ']';

			$shortcode_item .= '[/clients_item]';
			$counters['foodbakery_counter_clients_node'] ++;
		    }
		}
		$section_title = '';
		if (isset($data['foodbakery_var_clients_element_title'][$counters['foodbakery_counter_clients']]) && $data['foodbakery_var_clients_element_title'][$counters['foodbakery_counter_clients']] != '') {
		    $section_title .= 'foodbakery_var_clients_element_title="' . htmlspecialchars($data['foodbakery_var_clients_element_title'][$counters['foodbakery_counter_clients']], ENT_QUOTES) . '" ';
		}
                if (isset($data['foodbakery_var_client_align'][$counters['foodbakery_counter_clients']]) && $data['foodbakery_var_client_align'][$counters['foodbakery_counter_clients']] != '') {
		    $section_title .= 'foodbakery_var_client_align="' . htmlspecialchars($data['foodbakery_var_client_align'][$counters['foodbakery_counter_clients']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_client_view'][$counters['foodbakery_counter_clients']]) && $data['foodbakery_var_client_view'][$counters['foodbakery_counter_clients']] != '') {
		    $section_title .= 'foodbakery_var_client_view="' . htmlspecialchars($data['foodbakery_var_client_view'][$counters['foodbakery_counter_clients']], ENT_QUOTES) . '" ';
		}
		
                $element_settings   = 'clients_element_size="'.htmlspecialchars( $data['clients_element_size'][$counters['foodbakery_global_counter_clients']] ).'"';
		$shortcode = '[foodbakery_clients ' . $element_settings. ' '. $section_title . ' ]' . $shortcode_item . '[/foodbakery_clients]';
		$shortcode_data .= $shortcode;
		$counters['foodbakery_counter_clients'] ++;
	    }
	    $counters['foodbakery_global_counter_clients'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_clients', 'foodbakery_save_page_builder_data_clients_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_clients_callback')) {

    /**
     * Populate clients shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_clients_callback($counters) {
	$counters['foodbakery_counter_clients'] = 0;
	$counters['foodbakery_counter_clients_node'] = 0;
	$counters['foodbakery_shortcode_counter_clients'] = 0;
	$counters['foodbakery_global_counter_clients'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_clients_callback');
}

if (!function_exists('foodbakery_shortcode_names_list_populate_clients_callback')) {

    /**
     * Populate clients shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_clients_callback($shortcode_array) {
	$shortcode_array['clients'] = array(
	    'title' => foodbakery_var_frame_text_srt('foodbakery_var_clients'),
	    'name' => 'clients',
	    'icon' => 'icon-user3',
	    'categories' => 'loops',
	);
	return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_clients_callback');
}

if (!function_exists('foodbakery_element_list_populate_clients_callback')) {

    /**
     * Populate clients shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_clients_callback($element_list) {
	$element_list['clients'] = foodbakery_var_frame_text_srt('foodbakery_var_clients');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_clients_callback');
}

if (!function_exists('foodbakery_shortcode_sub_element_ui_clients_callback')) {

    /**
     * Render UI for sub element in clients settings.
     *
     * @param	array $args
     */
    function foodbakery_shortcode_sub_element_ui_clients_callback($args) {
	$type = $args['type'];
	$foodbakery_var_html_fields = $args['html_fields'];

	if ($type == 'clients') {

	    $rand_id = rand(1234, 7894563);
	    ?>
	    <div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content'  id="foodbakery_infobox_<?php echo intval($rand_id); ?>">
	        <header>
	    	<h4><i class='icon-arrows'></i><?php echo foodbakery_var_frame_text_srt('foodbakery_var_clients'); ?></h4>
	    	<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo foodbakery_var_frame_text_srt('foodbakery_var_remove'); ?></a>
	        </header>
		<?php
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_frame_text_srt('foodbakery_var_image_url'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_image_url_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => '',
			'cust_id' => '',
			'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
			'cust_name' => 'foodbakery_var_clients_text[]',
			'return' => true,
		    ),
		);

		$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

		$foodbakery_opt_array = array(
		    'std' => '',
		    'id' => 'clients_img_user',
		    'name' => foodbakery_var_frame_text_srt('foodbakery_var_image'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_image_hint'),
		    'echo' => true,
		    'array' => true,
		    'prefix' => '',
		    'field_params' => array(
			'std' => '',
			'id' => 'clients_img_user',
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

    add_action('foodbakery_shortcode_sub_element_ui', 'foodbakery_shortcode_sub_element_ui_clients_callback');
}