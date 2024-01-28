<?php
/*
 *
 * @Shortcode Name : Price Plan
 * @retrun
 *
 */

if (!function_exists('foodbakery_var_page_builder_price_table')) {

    function foodbakery_var_page_builder_price_table($die = 0) {
	global $post, $foodbakery_node, $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;
	$shortcode_element = '';
	$filter_element = 'filterdrag';
	$shortcode_view = '';
	$output = array();
	$foodbakery_counter = $_POST['counter'];
	$price_table_num = 0;
	if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
	    $FOODBAKERY_POSTID = '';
	    $shortcode_element_id = '';
	} else {
	    $FOODBAKERY_POSTID = $_POST['POSTID'];
	    $shortcode_element_id = $_POST['shortcode_element_id'];
	    $shortcode_str = stripslashes($shortcode_element_id);
	    $FOODBAKERY_PREFIX = 'foodbakery_price_table|price_table_item';
	    $parseObject = new ShortcodeParse();
	    $output = $parseObject->foodbakery_shortcodes($output, $shortcode_str, true, $FOODBAKERY_PREFIX);
	}
	$defaults = array(
	    'column_size' => '1/1',
	    'foodbakery_multi_price_table_section_title' => '',
	    'foodbakery_price_table_style' => '',
	    'foodbakery_multi_price_col' => '',
            'foodbakery_var_price_align' => '',
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
	    $price_table_num = count($atts_content);
	}
	$price_table_element_size = '100';
	foreach ($defaults as $key => $values) {
	    if (isset($atts[$key])) {
		$$key = $atts[$key];
	    } else {
		$$key = $values;
	    }
	}
	$name = 'foodbakery_var_page_builder_price_table';
	$coloumn_class = 'column_' . $price_table_element_size;
	$foodbakery_multi_price_table_section_title = isset($foodbakery_multi_price_table_section_title) ? $foodbakery_multi_price_table_section_title : '';
	$foodbakery_var_price_align = isset($foodbakery_var_price_align) ? $foodbakery_var_price_align : '';
	$foodbakery_multi_price_col = isset($foodbakery_multi_price_col) ? $foodbakery_multi_price_col : '';
	if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
	    $shortcode_element = 'shortcode_element_class';
	    $shortcode_view = 'cs-pbwp-shortcode';
	    $filter_element = 'ajax-drag';
	    $coloumn_class = '';
	}
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_short_code_strings();
	?>
	<div id="<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>_del" class="column  parentdelete <?php echo foodbakery_allow_special_char($coloumn_class); ?> <?php echo foodbakery_allow_special_char($shortcode_view); ?>" item="price_table" data="<?php echo foodbakery_element_size_data_array_index($price_table_element_size) ?>" >
	    <?php foodbakery_element_setting($name, $foodbakery_counter, $price_table_element_size, '', 'comments-o', $type = ''); ?>
	    <div class="cs-wrapp-class-<?php echo foodbakery_allow_special_char($foodbakery_counter) ?> <?php echo foodbakery_allow_special_char($shortcode_element); ?>" id="<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>" style="display: none;">
		<div class="cs-heading-area">
		    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_price_table_edit_option')); ?></h5>
		    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>','<?php echo foodbakery_allow_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
		</div>
		<div class="cs-clone-append cs-pbwp-content">
		    <div class="cs-wrapp-tab-box">
			<div id="shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>" data-shortcode-template="{{child_shortcode}} [/foodbakery_price_table]" data-shortcode-child-template="[price_table_item {{attributes}}] {{content}} [/price_table_item]">
			    <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[foodbakery_price_table {{attributes}}]">
				<?php
				if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
				    foodbakery_shortcode_element_size();
				}
				$foodbakery_price_table_style = isset($foodbakery_price_table_style) ? $foodbakery_price_table_style : '';
				$foodbakery_opt_array = array(
				    'name' => foodbakery_var_theme_text_srt('foodbakery_var_element_title'),
				    'desc' => '',
				    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_element_title_hint'),
				    'echo' => true,
				    'field_params' => array(
					'std' => esc_attr($foodbakery_multi_price_table_section_title),
					'id' => 'foodbakery_multi_price_table_section_title',
					'cust_name' => 'foodbakery_multi_price_table_section_title[]',
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
                                        'std' => $foodbakery_var_price_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_price_align',
                                        'cust_name' => 'foodbakery_var_price_align[]',
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
				    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_plan_style'),
				    'desc' => '',
				    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_plan_style_hint'),
				    'echo' => true,
				    'field_params' => array(
					'std' => $foodbakery_price_table_style,
					'id' => '',
					'cust_name' => 'foodbakery_price_table_style[]',
					'classes' => 'dropdown chosen-select',
					'options' => array(
					    'classic' => foodbakery_var_theme_text_srt('foodbakery_var_price_plan_style_classic'),
					    'advance' => foodbakery_var_theme_text_srt('foodbakery_var_price_plan_style_modren'),
					),
					'return' => true,
				    ),
				);
				$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
				$foodbakery_opt_array = array(
				    'name' => foodbakery_var_theme_text_srt('foodbakery_var_accordian_select_col'),
				    'desc' => '',
				    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_accordian_select_col_hint'),
				    'echo' => true,
				    'field_params' => array(
					'std' => esc_html($foodbakery_multi_price_col),
					'cust_id' => 'foodbakery_multi_price_col',
					'cust_name' => 'foodbakery_multi_price_col[]',
					'classes' => 'dropdown chosen-select',
					'options' => array(
					    '1' => foodbakery_var_theme_text_srt('foodbakery_var_accordian_one_column'),
					    '2' => foodbakery_var_theme_text_srt('foodbakery_var_accordian_two_column'),
					    '3' => foodbakery_var_theme_text_srt('foodbakery_var_accordian_three_column'),
					    '4' => foodbakery_var_theme_text_srt('foodbakery_var_accordian_four_column'),
					    '6' => foodbakery_var_theme_text_srt('foodbakery_var_accordian_six_column'),
					),
					'return' => true,
				    ),
				);
				$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
				?>
			    </div>
			    <?php
			    if (isset($price_table_num) && $price_table_num <> '' && isset($atts_content) && is_array($atts_content)) {
				foreach ($atts_content as $price_table) {
				    $rand_string = rand(1234, 7894563);
				    $foodbakery_var_price_table_text = $price_table['content'];
				    $defaults = array(
					'foodbakery_price_table_price' => '',
					'foodbakery_price_table_text' => '',
					'foodbakery_price_table_title_color' => '',
					'foodbakery_price_table_currency' => '$',
					'foodbakery_price_table_time_duration' => '',
					'foodbakery_price_table_button_text' => 'Sign Up',
					'foodbakery_price_table_pricing_detail' => '',
					'foodbakery_price_table_featured' => '',
					'foodbakery_price_table_button_color' => '',
					'foodbakery_price_table_button_color_bg' => '',
					'foodbakery_price_table_button_column_color' => '',
					'foodbakery_price_table_column_bgcolor' => '',
					'foodbakery_price_table_button_link' => ''
				    );
				    foreach ($defaults as $key => $values) {
					if (isset($price_table['atts'][$key])) {
					    $$key = $price_table['atts'][$key];
					} else {
					    $$key = $values;
					}
				    }

				    $foodbakery_price_table_price = isset($foodbakery_price_table_price) ? $foodbakery_price_table_price : '';
				    $foodbakery_price_table_text = isset($foodbakery_price_table_text) ? $foodbakery_price_table_text : '';
				    $foodbakery_price_table_title_color = isset($foodbakery_price_table_title_color) ? $foodbakery_price_table_title_color : '';
				    $foodbakery_price_table_currency = isset($foodbakery_price_table_currency) ? $foodbakery_price_table_currency : '';
				    $foodbakery_price_table_time_duration = isset($foodbakery_price_table_time_duration) ? $foodbakery_price_table_time_duration : '';
				    $foodbakery_price_table_button_text = isset($foodbakery_price_table_button_text) ? $foodbakery_price_table_button_text : '';
				    $foodbakery_price_table_pricing_detail = isset($foodbakery_price_table_pricing_detail) ? $foodbakery_price_table_pricing_detail : '';
				    $foodbakery_price_table_featured = isset($foodbakery_price_table_featured) ? $foodbakery_price_table_featured : '';
				    $foodbakery_price_table_button_color = isset($foodbakery_price_table_button_color) ? $foodbakery_price_table_button_color : '';
				    $foodbakery_price_table_button_color_bg = isset($foodbakery_price_table_button_color_bg) ? $foodbakery_price_table_button_color_bg : '';
				    $foodbakery_price_table_button_column_color = isset($foodbakery_price_table_button_column_color) ? $foodbakery_price_table_button_column_color : '';
				    $foodbakery_price_table_column_bgcolor = isset($foodbakery_price_table_column_bgcolor) ? $foodbakery_price_table_column_bgcolor : '';
				    $foodbakery_price_table_button_link = isset($foodbakery_price_table_button_link) ? $foodbakery_price_table_button_link : '';
				    ?>
				    <div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content' id="foodbakery_infobox_<?php echo foodbakery_allow_special_char($rand_string); ?>">
					<header>
					    <h4><i class='icon-arrows'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_price_table_sc')); ?></h4>
					    <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_remove')); ?></a>
					</header>
					<?php
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_title'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_title_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_attr($foodbakery_price_table_text),
						'id' => 'foodbakery_price_table_text',
						'cust_name' => 'foodbakery_price_table_text[]',
						'classes' => '',
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_price_color'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_price_color_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_html($foodbakery_price_table_title_color),
						'id' => 'foodbakery_price_table_title_color',
						'cust_name' => 'foodbakery_price_table_title_color[]',
						'classes' => 'bg_color',
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_price'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_price_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_attr($foodbakery_price_table_price),
						'id' => 'foodbakery_price_table_price',
						'cust_name' => 'foodbakery_price_table_price[]',
						'classes' => 'txtfield',
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_currency'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_currency_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_attr($foodbakery_price_table_currency),
						'id' => 'foodbakery_price_table_currency',
						'cust_name' => 'foodbakery_price_table_currency[]',
						'classes' => 'txtfield  input-small',
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_time'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_time_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_attr($foodbakery_price_table_time_duration),
						'id' => 'foodbakery_price_table_time_duration',
						'cust_name' => 'foodbakery_price_table_time_duration[]',
						'classes' => 'txtfield  input-small',
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_button_link'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_button_link_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_url($foodbakery_price_table_button_link),
						'id' => 'foodbakery_price_table_button_link',
						'cust_name' => 'foodbakery_price_table_button_link[]',
						'classes' => 'txtfield  input-small',
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_button_text'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_button_text_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_html($foodbakery_price_table_button_text),
						'id' => 'foodbakery_price_table_button_text',
						'cust_name' => 'foodbakery_price_table_button_text[]',
						'classes' => 'txtfield  input-small',
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_button_color'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_button_color_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_html($foodbakery_price_table_button_color),
						'id' => 'foodbakery_price_table_button_color',
						'cust_name' => 'foodbakery_price_table_button_color[]',
						'classes' => 'bg_color',
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_button_bg_color'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_button_bg_color_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_html($foodbakery_price_table_button_color_bg),
						'id' => 'foodbakery_price_table_button_color_bg',
						'cust_name' => 'foodbakery_price_table_button_color_bg[]',
						'classes' => 'bg_color',
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_featured'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_featured_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => $foodbakery_price_table_featured,
						'id' => '',
						'cust_name' => 'foodbakery_price_table_featured[]',
						'classes' => 'dropdown chosen-select',
						'options' => array(
						    'Yes' => foodbakery_var_theme_text_srt('foodbakery_var_yes'),
						    'No' => foodbakery_var_theme_text_srt('foodbakery_var_no'),
						),
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_frame_text_srt('foodbakery_var_price_table_description'),
					    'desc' => '',
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_attr($foodbakery_var_price_table_text),
						'cust_id' => '',
						'cust_name' => 'foodbakery_var_price_table_text[]',
						'return' => true,
						'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
						'classes' => '',
						'foodbakery_editor' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_textarea_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_column_color'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_column_color_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_attr($foodbakery_price_table_column_bgcolor),
						'id' => 'foodbakery_price_table_column_bgcolor',
						'cust_name' => 'foodbakery_price_table_column_bgcolor[]',
						'classes' => 'bg_color',
						'return' => true,
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
				'std' => foodbakery_allow_special_char($price_table_num),
				'id' => '',
				'before' => '',
				'after' => '',
				'classes' => 'fieldCounter',
				'extra_atr' => '',
				'cust_id' => '',
				'cust_name' => 'price_table_num[]',
				'return' => true,
				'required' => false
			    );
			    echo foodbakery_allow_special_char($foodbakery_var_form_fields->foodbakery_var_form_hidden_render($foodbakery_opt_array));
			    ?>
			</div>
			<div class="wrapptabbox cs-pbwp-content cs-zero-padding">
			    <div class="opt-conts">
				<ul class="form-elements">
				    <li class="to-field"> <a href="javascript:void(0);" class="add_servicesss cs-main-btn" onclick="foodbakery_shortcode_element_ajax_call('price_table', 'shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>', '<?php echo admin_url('admin-ajax.php'); ?>')"><i class="icon-plus-circle"></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_price_table_add')); ?></a> </li>
				    <div id="loading" class="shortcodeload"></div>
				</ul>
				<?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
	    			<ul class="form-elements insert-bg noborder">
	    			    <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo str_replace('foodbakery_var_page_builder_', '', $name); ?>', 'shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>', '<?php echo foodbakery_allow_special_char($filter_element); ?>')" ><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_insert')); ?></a> </li>
	    			</ul>
	    			<div id="results-shortocde"></div>
				    <?php
				} else {
				    $foodbakery_opt_array = array(
					'std' => 'price_table',
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
					    'cust_id' => 'price_table_save' . $foodbakery_counter,
					    'cust_type' => 'button',
					    'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
					    'classes' => 'cs-foodbakery-admin-btn',
					    'cust_name' => 'price_table_save',
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

    add_action('wp_ajax_foodbakery_var_page_builder_price_table', 'foodbakery_var_page_builder_price_table');
}

if (!function_exists('foodbakery_save_page_builder_data_price_table_callback')) {

    /**
     * Save data for price table shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_price_table_callback($args) {
	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	if ($widget_type == "price_table" || $widget_type == "cs_price_table") {
	    $shortcode = $shortcode_item = '';
            
            $page_element_size  =  $data['price_table_element_size'][$counters['foodbakery_global_counter_price_table']];
            $current_element_size  =  $data['price_table_element_size'][$counters['foodbakery_global_counter_price_table']];
            
	    if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes($data['shortcode']['price_table'][$counters['foodbakery_shortcode_counter_price_table']]);
                
                $element_settings   = 'price_table_element_size="'.$current_element_size.'"';
                $reg = '/price_table_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
		$counters['foodbakery_shortcode_counter_price_table'] ++;
	    } else {
		if (isset($data['price_table_num'][$counters['foodbakery_counter_price_table']]) && $data['price_table_num'][$counters['foodbakery_counter_price_table']] > 0) {
		    for ($i = 1; $i <= $data['price_table_num'][$counters['foodbakery_counter_price_table']]; $i ++) {
			$shortcode_item .= '[price_table_item ';
			if (isset($data['foodbakery_price_table_text'][$counters['foodbakery_counter_price_table_node']]) && $data['foodbakery_price_table_text'][$counters['foodbakery_counter_price_table_node']] != '') {
			    $shortcode_item .= 'foodbakery_price_table_text="' . htmlspecialchars($data['foodbakery_price_table_text'][$counters['foodbakery_counter_price_table_node']], ENT_QUOTES) . '" ';
			}
			if (isset($data['foodbakery_price_table_title_color'][$counters['foodbakery_counter_price_table_node']]) && $data['foodbakery_price_table_title_color'][$counters['foodbakery_counter_price_table_node']] != '') {
			    $shortcode_item .= 'foodbakery_price_table_title_color="' . $data['foodbakery_price_table_title_color'][$counters['foodbakery_counter_price_table_node']] . '" ';
			}
			if (isset($data['foodbakery_price_table_price'][$counters['foodbakery_counter_price_table_node']]) && $data['foodbakery_price_table_price'][$counters['foodbakery_counter_price_table_node']] != '') {
			    $shortcode_item .= 'foodbakery_price_table_price="' . $data['foodbakery_price_table_price'][$counters['foodbakery_counter_price_table_node']] . '" ';
			}
			if (isset($data['foodbakery_price_table_currency'][$counters['foodbakery_counter_price_table_node']]) && $data['foodbakery_price_table_currency'][$counters['foodbakery_counter_price_table_node']] != '') {
			    $shortcode_item .= 'foodbakery_price_table_currency="' . htmlspecialchars($data['foodbakery_price_table_currency'][$counters['foodbakery_counter_price_table_node']], ENT_QUOTES) . '" ';
			}
			if (isset($data['foodbakery_price_table_time_duration'][$counters['foodbakery_counter_price_table_node']]) && $data['foodbakery_price_table_time_duration'][$counters['foodbakery_counter_price_table_node']] != '') {
			    $shortcode_item .= 'foodbakery_price_table_time_duration="' . htmlspecialchars($data['foodbakery_price_table_time_duration'][$counters['foodbakery_counter_price_table_node']], ENT_QUOTES) . '" ';
			}
			if (isset($data['foodbakery_price_table_button_link'][$counters['foodbakery_counter_price_table_node']]) && $data['foodbakery_price_table_button_link'][$counters['foodbakery_counter_price_table_node']] != '') {
			    $shortcode_item .= 'foodbakery_price_table_button_link="' . htmlspecialchars($data['foodbakery_price_table_button_link'][$counters['foodbakery_counter_price_table_node']], ENT_QUOTES) . '" ';
			}
			if (isset($data['foodbakery_price_table_button_text'][$counters['foodbakery_counter_price_table_node']]) && $data['foodbakery_price_table_button_text'][$counters['foodbakery_counter_price_table_node']] != '') {
			    $shortcode_item .= 'foodbakery_price_table_button_text="' . htmlspecialchars($data['foodbakery_price_table_button_text'][$counters['foodbakery_counter_price_table_node']], ENT_QUOTES) . '" ';
			}
			if (isset($data['foodbakery_price_table_button_color'][$counters['foodbakery_counter_price_table_node']]) && $data['foodbakery_price_table_button_color'][$counters['foodbakery_counter_price_table_node']] != '') {
			    $shortcode_item .= 'foodbakery_price_table_button_color="' . htmlspecialchars($data['foodbakery_price_table_button_color'][$counters['foodbakery_counter_price_table_node']], ENT_QUOTES) . '" ';
			}
			if (isset($data['foodbakery_price_table_button_color_bg'][$counters['foodbakery_counter_price_table_node']]) && $data['foodbakery_price_table_button_color_bg'][$counters['foodbakery_counter_price_table_node']] != '') {
			    $shortcode_item .= 'foodbakery_price_table_button_color_bg="' . htmlspecialchars($data['foodbakery_price_table_button_color_bg'][$counters['foodbakery_counter_price_table_node']], ENT_QUOTES) . '" ';
			}
			if (isset($data['foodbakery_price_table_featured'][$counters['foodbakery_counter_price_table_node']]) && $data['foodbakery_price_table_featured'][$counters['foodbakery_counter_price_table_node']] != '') {
			    $shortcode_item .= 'foodbakery_price_table_featured="' . htmlspecialchars($data['foodbakery_price_table_featured'][$counters['foodbakery_counter_price_table_node']], ENT_QUOTES) . '" ';
			}
			if (isset($data['foodbakery_price_table_column_bgcolor'][$counters['foodbakery_counter_price_table_node']]) && $data['foodbakery_price_table_column_bgcolor'][$counters['foodbakery_counter_price_table_node']] != '') {
			    $shortcode_item .= 'foodbakery_price_table_column_bgcolor="' . htmlspecialchars($data['foodbakery_price_table_column_bgcolor'][$counters['foodbakery_counter_price_table_node']], ENT_QUOTES) . '" ';
			}
			$shortcode_item .= ']';
			if (isset($data['foodbakery_var_price_table_text'][$counters['foodbakery_counter_price_table_node']]) && $data['foodbakery_var_price_table_text'][$counters['foodbakery_counter_price_table_node']] != '') {
			    $shortcode_item .= htmlspecialchars($data['foodbakery_var_price_table_text'][$counters['foodbakery_counter_price_table_node']], ENT_QUOTES);
			}
			$shortcode_item .= '[/price_table_item]';
			$counters['foodbakery_counter_price_table_node'] ++;
		    }
		}
		$section_title = '';
		if (isset($data['foodbakery_multi_price_table_section_title'][$counters['foodbakery_counter_price_table']]) && $data['foodbakery_multi_price_table_section_title'][$counters['foodbakery_counter_price_table']] != '') {
		    $section_title .= 'foodbakery_multi_price_table_section_title="' . htmlspecialchars($data['foodbakery_multi_price_table_section_title'][$counters['foodbakery_counter_price_table']], ENT_QUOTES) . '" ';
		}
                if (isset($data['foodbakery_var_price_align'][$counters['foodbakery_counter_price_table']]) && $data['foodbakery_var_price_align'][$counters['foodbakery_counter_price_table']] != '') {
		    $section_title .= 'foodbakery_var_price_align="' . htmlspecialchars($data['foodbakery_var_price_align'][$counters['foodbakery_counter_price_table']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_price_table_style'][$counters['foodbakery_counter_price_table']]) && $data['foodbakery_price_table_style'][$counters['foodbakery_counter_price_table']] != '') {
		    $section_title .= 'foodbakery_price_table_style="' . htmlspecialchars($data['foodbakery_price_table_style'][$counters['foodbakery_counter_price_table']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_multi_price_col'][$counters['foodbakery_counter_price_table']]) && $data['foodbakery_multi_price_col'][$counters['foodbakery_counter_price_table']] != '') {
		    $section_title .= 'foodbakery_multi_price_col="' . htmlspecialchars($data['foodbakery_multi_price_col'][$counters['foodbakery_counter_price_table']], ENT_QUOTES) . '" ';
		}
                $element_settings   = 'price_table_element_size="'.htmlspecialchars( $data['price_table_element_size'][$counters['foodbakery_global_counter_price_table']] ).'"';
		$shortcode = '[foodbakery_price_table ' . $element_settings.' '.$section_title . ' ]' . $shortcode_item . '[/foodbakery_price_table]';
		$shortcode_data .= $shortcode;
		$counters['foodbakery_counter_price_table'] ++;
	    }
	    $counters['foodbakery_global_counter_price_table'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_price_table', 'foodbakery_save_page_builder_data_price_table_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_price_table_callback')) {

    /**
     * Populate price table shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_price_table_callback($counters) {
	$counters['foodbakery_counter_price_table'] = 0;
	$counters['foodbakery_counter_price_table_node'] = 0;
	$counters['foodbakery_shortcode_counter_price_table'] = 0;
	$counters['foodbakery_global_counter_price_table'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_price_table_callback');
}

if (!function_exists('foodbakery_shortcode_names_list_populate_price_table_callback')) {

    /**
     * Populate price table shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_price_table_callback($shortcode_array) {
	$shortcode_array['price_table'] = array(
	    'title' => foodbakery_var_frame_text_srt('foodbakery_var_price_plan'),
	    'name' => 'price_table',
	    'icon' => 'icon-briefcase',
	    'categories' => 'contentblocks',
	);
	return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_price_table_callback');
}

if (!function_exists('foodbakery_element_list_populate_price_table_callback')) {

    /**
     * Populate price table shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_price_table_callback($element_list) {
	$element_list['price_table'] = foodbakery_var_frame_text_srt('foodbakery_var_price_plan');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_price_table_callback');
}

if (!function_exists('foodbakery_shortcode_sub_element_ui_price_table_callback')) {

    /**
     * Render UI for sub element in price table settings.
     *
     * @param	array $args
     */
    function foodbakery_shortcode_sub_element_ui_price_table_callback($args) {
	$type = $args['type'];
	$foodbakery_var_html_fields = $args['html_fields'];
	if ($type == 'price_table') {
	    $rand_id = rand(1234, 7894563);
	    ?>
	    <div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content'  id="foodbakery_infobox_<?php echo intval($rand_id); ?>">
	        <header>
	    	<h4><i class='icon-arrows'></i><?php echo foodbakery_var_frame_text_srt('foodbakery_var_price_plan'); ?></h4>
	    	<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo foodbakery_var_frame_text_srt('foodbakery_var_remove'); ?></a>
	        </header>
		<?php
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_title'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_title_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => esc_attr($foodbakery_price_table_text),
			'id' => 'foodbakery_price_table_text',
			'cust_name' => 'foodbakery_price_table_text[]',
			'classes' => '',
			'return' => true,
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_price_color'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_price_color_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => esc_html($foodbakery_price_table_title_color),
			'id' => 'foodbakery_price_table_title_color',
			'cust_name' => 'foodbakery_price_table_title_color[]',
			'classes' => 'bg_color',
			'return' => true,
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_price'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_price_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => esc_attr($foodbakery_price_table_price),
			'id' => 'foodbakery_price_table_price',
			'cust_name' => 'foodbakery_price_table_price[]',
			'classes' => 'txtfield',
			'return' => true,
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_currency'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_currency_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => esc_attr($foodbakery_price_table_currency),
			'id' => 'foodbakery_price_table_currency',
			'cust_name' => 'foodbakery_price_table_currency[]',
			'classes' => 'txtfield  input-small',
			'return' => true,
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_time'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_time_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => esc_attr($foodbakery_price_table_time_duration),
			'id' => 'foodbakery_price_table_time_duration',
			'cust_name' => 'foodbakery_price_table_time_duration[]',
			'classes' => 'txtfield  input-small',
			'return' => true,
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_button_link'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_button_link_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => esc_url($foodbakery_price_table_button_link),
			'id' => 'foodbakery_price_table_button_link',
			'cust_name' => 'foodbakery_price_table_button_link[]',
			'classes' => 'txtfield  input-small',
			'return' => true,
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_button_text'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_button_text_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => esc_html($foodbakery_price_table_button_text),
			'id' => 'foodbakery_price_table_button_text',
			'cust_name' => 'foodbakery_price_table_button_text[]',
			'classes' => 'txtfield  input-small',
			'return' => true,
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_button_color'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_button_color_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => esc_html($foodbakery_price_table_button_color),
			'id' => 'foodbakery_price_table_button_color',
			'cust_name' => 'foodbakery_price_table_button_color[]',
			'classes' => 'bg_color',
			'return' => true,
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_button_bg_color'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_button_bg_color_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => esc_html($foodbakery_price_table_button_color_bg),
			'id' => 'foodbakery_price_table_button_color_bg',
			'cust_name' => 'foodbakery_price_table_button_color_bg[]',
			'classes' => 'bg_color',
			'return' => true,
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_featured'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_featured_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => $foodbakery_price_table_featured,
			'id' => '',
			'cust_name' => 'foodbakery_price_table_featured[]',
			'classes' => 'dropdown chosen-select',
			'options' => array(
			    'Yes' => foodbakery_var_theme_text_srt('foodbakery_var_yes'),
			    'No' => foodbakery_var_theme_text_srt('foodbakery_var_no'),
			),
			'return' => true,
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_frame_text_srt('foodbakery_var_price_table_description'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_price_table_description_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => esc_attr($foodbakery_var_price_table_text),
			'cust_id' => '',
			'cust_name' => 'foodbakery_var_price_table_text[]',
			'return' => true,
			'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
			'classes' => '',
			'foodbakery_editor' => true,
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_textarea_field($foodbakery_opt_array);
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_column_color'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_price_table_column_color_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => esc_attr($foodbakery_price_table_column_bgcolor),
			'id' => 'foodbakery_price_table_column_bgcolor',
			'cust_name' => 'foodbakery_price_table_column_bgcolor[]',
			'classes' => 'bg_color',
			'return' => true,
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
		?>
	    </div>
	    <?php
	}
    }

    add_action('foodbakery_shortcode_sub_element_ui', 'foodbakery_shortcode_sub_element_ui_price_table_callback');
}
