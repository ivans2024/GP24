<?php
/*
 *
 * @Shortcode Name : icon_box
 * @retrun
 *
 */
if (!function_exists('foodbakery_var_page_builder_icon_box')) {

    function foodbakery_var_page_builder_icon_box($die = 0) {
	global $post, $foodbakery_node, $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;
	$string = new foodbakery_theme_all_strings;
	$string->foodbakery_short_code_strings();
	$shortcode_element = '';
	$filter_element = 'filterdrag';
	$shortcode_view = '';
	$output = array();
	$foodbakery_counter = $_POST['counter'];
	$icon_boxes_num = 0;
	if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
	    $FOODBAKERY_POSTID = '';
	    $shortcode_element_id = '';
	} else {
	    $FOODBAKERY_POSTID = $_POST['POSTID'];
	    $shortcode_element_id = $_POST['shortcode_element_id'];
	    $shortcode_str = stripslashes($shortcode_element_id);
	    $FOODBAKERY_PREFIX = 'icon_box|icon_boxes_item';
	    $parseObject = new ShortcodeParse();
	    $output = $parseObject->foodbakery_shortcodes($output, $shortcode_str, true, $FOODBAKERY_PREFIX);
	}
	$defaults = array(
	    'foodbakery_var_column_size' => '1/1',
	    'foodbakery_var_icon_boxes_title' => '',
	    'foodbakery_var_icon_boxes_sub_title' => '',
	    'foodbakery_var_icon_box_column' => '',
	    'foodbakery_var_icon_box_view' => '',
	    'foodbakery_title_color' => '',
	    'foodbakery_icon_box_content_color' => '',
	    'foodbakery_icon_box_icon_color' => '',
	    'foodbakery_var_icon_box_icon_size' => '',
	    'foodbakery_icon_box_content_align' => '',
            'foodbakery_var_iconbox_align' => '',
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
	    $icon_boxes_num = count($atts_content);
	}
	$icon_boxes_element_size = '100';
	foreach ($defaults as $key => $values) {
	    if (isset($atts[$key])) {
		$$key = $atts[$key];
	    } else {
		$$key = $values;
	    }
	}
	$foodbakery_var_icon_boxes_title = isset($foodbakery_var_icon_boxes_title) ? $foodbakery_var_icon_boxes_title : '';
	$foodbakery_var_icon_boxes_sub_title = isset($foodbakery_var_icon_boxes_sub_title) ? $foodbakery_var_icon_boxes_sub_title : '';
	$foodbakery_var_icon_box_column = isset($foodbakery_var_icon_box_column) ? $foodbakery_var_icon_box_column : '';
	$foodbakery_var_icon_box_view = isset($foodbakery_var_icon_box_view) ? $foodbakery_var_icon_box_view : '';
	$foodbakery_title_color = isset($foodbakery_title_color) ? $foodbakery_title_color : '';
	$foodbakery_icon_box_content_color = isset($foodbakery_icon_box_content_color) ? $foodbakery_icon_box_content_color : '';
	$foodbakery_icon_box_icon_color = isset($foodbakery_icon_box_icon_color) ? $foodbakery_icon_box_icon_color : '';
	$foodbakery_var_icon_box_icon_size = isset($foodbakery_var_icon_box_icon_size) ? $foodbakery_var_icon_box_icon_size : '';
	$foodbakery_icon_box_content_align = isset($foodbakery_icon_box_content_align) ? $foodbakery_icon_box_content_align : '';
        $foodbakery_var_iconbox_align = isset($foodbakery_var_iconbox_align) ? $foodbakery_var_iconbox_align : '';
	$name = 'foodbakery_var_page_builder_icon_box';
	$coloumn_class = 'column_' . $icon_boxes_element_size;
	if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
	    $shortcode_element = 'shortcode_element_class';
	    $shortcode_view = 'cs-pbwp-shortcode';
	    $filter_element = 'ajax-drag';
	    $coloumn_class = '';
	}
	?>
	<div id="<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>_del" class="column  parentdelete <?php echo foodbakery_allow_special_char($coloumn_class); ?> <?php echo foodbakery_allow_special_char($shortcode_view); ?>" item="icon_box" data="<?php echo foodbakery_element_size_data_array_index($icon_boxes_element_size) ?>" >
	    <?php foodbakery_element_setting($name, $foodbakery_counter, $icon_boxes_element_size, '', 'comments-o', $type = ''); ?>
	    <div class="cs-wrapp-class-<?php echo foodbakery_allow_special_char($foodbakery_counter) ?> <?php echo foodbakery_allow_special_char($shortcode_element); ?>" id="<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>" style="display: none;">
		<div class="cs-heading-area">
		    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_icon_box_edit')); ?></h5>
		    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>','<?php echo foodbakery_allow_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
		</div>
		<div class="cs-clone-append cs-pbwp-content">
		    <div class="cs-wrapp-tab-box">
			<div id="shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>" data-shortcode-template="{{child_shortcode}} [/icon_box]" data-shortcode-child-template="[icon_boxes_item {{attributes}}] {{content}} [/icon_boxes_item]">
			    <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[icon_box {{attributes}}]">
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
					'std' => esc_attr($foodbakery_var_icon_boxes_title),
					'cust_id' => '',
					'cust_name' => 'foodbakery_var_icon_boxes_title[]',
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
                                        'std' => $foodbakery_var_iconbox_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_iconbox_align',
                                        'cust_name' => 'foodbakery_var_iconbox_align[]',
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
				    'name' => foodbakery_var_theme_text_srt('foodbakery_var_icon_boxes_title_color'),
				    'desc' => '',
				    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_icon_boxes_title_color_hint'),
				    'echo' => true,
				    'field_params' => array(
					'std' => esc_html($foodbakery_icon_box_content_color),
					'id' => 'foodbakery_icon_box_content_color',
					'cust_name' => 'foodbakery_icon_box_content_color[]',
					'classes' => 'bg_color',
					'return' => true,
				    ),
				);
				$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
				$foodbakery_opt_array = array(
				    'name' => foodbakery_var_theme_text_srt('foodbakery_var_icon_boxes_text'),
				    'desc' => '',
				    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_icon_boxes_content_hint'),
				    'echo' => true,
				    'field_params' => array(
					'std' => esc_attr($foodbakery_var_icon_boxes_sub_title),
					'cust_id' => '',
					'cust_name' => 'foodbakery_var_icon_boxes_sub_title[]',
					'return' => true,
					'classes' => '',
					'foodbakery_editor' => true,
				    ),
				);
				$foodbakery_var_html_fields->foodbakery_var_textarea_field($foodbakery_opt_array);
				$foodbakery_opt_array = array(
				    'name' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_styles'),
				    'desc' => '',
				    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_styles_hint'),
				    'echo' => true,
				    'field_params' => array(
					'std' => $foodbakery_var_icon_box_view,
					'id' => '',
					'cust_id' => 'foodbakery_var_icon_box_view',
					'cust_name' => 'foodbakery_var_icon_box_view[]',
					'classes' => 'foodbakery_var_icon_box_view chosen-select select-medium',
					'extra_atr' => ' onchange=foodbakery_icon_box_style_change(this.value)',
					'options' => array(
					    'fancy' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_style_fancy'),
					    'has-border' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_style_has_border'),
					    'modern' => 'Modern',
					    'classic' => 'Classic',
					),
					'return' => true,
				    ),
				);
				$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
				$foodbakery_opt_array = array(
				    'name' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_alignment'),
				    'desc' => '',
				    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_alignment_hint'),
				    'echo' => true,
				    'field_params' => array(
					'std' => $foodbakery_icon_box_content_align,
					'id' => '',
					'cust_name' => 'foodbakery_icon_box_content_align[]',
					'classes' => 'dropdown chosen-select',
					'options' => array(
					    'left' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_alignment_left'),
					    'right' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_alignment_right'),
					    'top-center' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_alignment_center'),
					    'top-left' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_alignment_top_left'),
					    'top-right' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_alignment_top_right'),
						'left-right' => esc_html__('Left Right', 'foodbakery'),
					),
					'return' => true,
				    ),
				);
				$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
				$foodbakery_opt_array = array(
				    'name' => foodbakery_var_theme_text_srt('foodbakery_var_icon_boxes_sel_col'),
				    'desc' => '',
				    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_icon_boxes_sel_col_hint'),
				    'echo' => true,
				    'field_params' => array(
					'std' => esc_html($foodbakery_var_icon_box_column),
					'cust_id' => 'foodbakery_var_icon_box_column' . $foodbakery_counter,
					'cust_name' => 'foodbakery_var_icon_box_column[]',
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
				$foodbakery_opt_array = array(
				    'name' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_title_color'),
				    'desc' => '',
				    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_title_color_hint'),
				    'echo' => true,
				    'field_params' => array(
					'std' => esc_attr($foodbakery_title_color),
					'cust_id' => 'foodbakery_title_color',
					'classes' => 'bg_color',
					'cust_name' => 'foodbakery_title_color[]',
					'return' => true,
				    ),
				);
				$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
				$foodbakery_opt_array = array(
				    'name' => foodbakery_var_theme_text_srt('foodbakery_var_icon_boxes_Icon_color'),
				    'desc' => '',
				    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_icon_boxes_Icon_color_hint'),
				    'echo' => true,
				    'field_params' => array(
					'std' => esc_html($foodbakery_icon_box_icon_color),
					'id' => 'foodbakery_icon_box_icon_color',
					'cust_name' => 'foodbakery_icon_box_icon_color[]',
					'classes' => 'bg_color',
					'return' => true,
				    ),
				);
				$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
				$foodbakery_opt_array = array(
				    'name' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_icon_font_size'),
				    'desc' => '',
				    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_icon_font_size_hint'),
				    'echo' => true,
				    'field_params' => array(
					'std' => $foodbakery_var_icon_box_icon_size,
					'id' => '',
					'cust_id' => 'foodbakery_var_icon_box_icon_size',
					'cust_name' => 'foodbakery_var_icon_box_icon_size[]',
					'classes' => 'icon_box_postion chosen-select-no-single select-medium',
					'options' => array(
					    'icon-xs' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_icon_font_size_option_1'),
					    'icon-sm' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_icon_font_size_option_2'),
					    'icon-md' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_icon_font_size_option_3'),
					    'icon-ml' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_icon_font_size_option_4'),
					    'icon-lg' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_icon_font_size_option_5'),
					    'icon-xl' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_icon_font_size_option_6'),
					    'icon-xxl' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_icon_font_size_option_7'),
					),
					'return' => true,
				    ),
				);
				$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
				?>
			    </div>
			    <?php
			    if (isset($icon_boxes_num) && $icon_boxes_num <> '' && isset($atts_content) && is_array($atts_content)) {
				foreach ($atts_content as $icon_boxes) {
				    $rand_string = rand(123456, 987654);
				    $foodbakery_var_icon_boxes_text = $icon_boxes['content'];
				    $defaults = array(
					'foodbakery_var_icon_box_title' => '',
					'foodbakery_var_icon_boxes_icon' => '',
					'foodbakery_var_link_url' => '',
					'foodbakery_var_icon_box_icon_type' => '',
					'foodbakery_var_icon_box_image' => ''
				    );
				    foreach ($defaults as $key => $values) {
					if (isset($icon_boxes['atts'][$key])) {
					    $$key = $icon_boxes['atts'][$key];
					} else {
					    $$key = $values;
					}
				    }
				    $foodbakery_var_icon_boxes_text = isset($foodbakery_var_icon_boxes_text) ? $foodbakery_var_icon_boxes_text : '';
				    $foodbakery_var_icon_box_title = isset($foodbakery_var_icon_box_title) ? $foodbakery_var_icon_box_title : '';
				    $foodbakery_var_icon_boxes_icon = isset($foodbakery_var_icon_boxes_icon) ? $foodbakery_var_icon_boxes_icon : '';
				    $foodbakery_var_icon_box_icon_color = isset($foodbakery_var_icon_box_icon_color) ? $foodbakery_var_icon_box_icon_color : '';
				    $foodbakery_var_link_url = isset($foodbakery_var_link_url) ? $foodbakery_var_link_url : '';
				    $foodbakery_var_icon_box_icon_type = isset($foodbakery_var_icon_box_icon_type) ? $foodbakery_var_icon_box_icon_type : '';
				    $foodbakery_var_icon_box_image = isset($foodbakery_var_icon_box_image) ? $foodbakery_var_icon_box_image : '';
				    ?>
				    <div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content' id="foodbakery_infobox_<?php echo foodbakery_allow_special_char($rand_string); ?>">
					<header>
					    <h4><i class='icon-arrows'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_icon_boxes')); ?></h4>
					    <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_tabs_remove')); ?></a>
					</header>
					<?php
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_title'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_title_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => foodbakery_allow_special_char($foodbakery_var_icon_box_title),
						'cust_id' => 'foodbakery_var_icon_box_title',
						'classes' => '',
						'cust_name' => 'foodbakery_var_icon_box_title[]',
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_icon_boxes_link_url'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_icon_boxes_link_url_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_attr($foodbakery_var_link_url),
						'cust_id' => 'foodbakery_var_link_url',
						'classes' => '',
						'cust_name' => 'foodbakery_var_link_url[]',
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_icon_type'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_icon_type_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_html($foodbakery_var_icon_box_icon_type),
						'id' => 'foodbakery_var_icon_box_icon_type',
						'cust_name' => 'foodbakery_var_icon_box_icon_type[]',
						'classes' => 'chosen-select-no-single select-medium function-class',
						'options' => array(
						    'icon' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_icon_type_1'),
						    'image' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_icon_type_2'),
						),
						'return' => true,
					    ),
					);
					$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
					?>
					<div class="cs-sh-icon_box-image-area" style="display:<?php echo esc_html($foodbakery_var_icon_box_icon_type == 'image' ? 'block' : 'none' ) ?>;">
					    <?php
					    $foodbakery_opt_array = array(
						'std' => $foodbakery_var_icon_box_image,
						'id' => 'icon_box_image_array',
						'main_id' => 'icon_box_image_array',
						'name' => foodbakery_var_theme_text_srt('foodbakery_var_image_field'),
						'desc' => '',
						'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_image_hint'),
						'echo' => true,
						'array' => true,
						'field_params' => array(
						    'std' => $foodbakery_var_icon_box_image,
						    'cust_id' => '',
						    'cust_name' => 'foodbakery_var_icon_box_image[]',
						    'id' => 'icon_box_image_array',
						    'return' => true,
						    'array' => true,
						),
					    );
					    $foodbakery_var_html_fields->foodbakery_var_upload_file_field($foodbakery_opt_array);
					    $rand_id = rand(1111111, 9999999);
					    ?>
					</div>
					<div class="cs-sh-icon_box-icon-area" style="display:<?php echo esc_html($foodbakery_var_icon_box_icon_type != 'image' ? 'block' : 'none' ) ?>;">
					    <div class="form-elements" id="foodbakery_infobox_<?php echo esc_attr($rand_id); ?>">
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						    <label><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_icon_boxes_icon')); ?></label>
						    <?php
						    if (function_exists('foodbakery_var_tooltip_helptext')) {
							echo foodbakery_var_tooltip_helptext(foodbakery_var_theme_text_srt('foodbakery_var_icon_boxes_icon_hint'));
						    }
						    ?>
						</div>
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
						    <?php echo foodbakery_var_icomoon_icons_box($foodbakery_var_icon_boxes_icon, esc_attr($rand_id), 'foodbakery_var_icon_boxes_icon'); ?>
						</div>
					    </div>
					</div>
					<?php
					$foodbakery_opt_array = array(
					    'name' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_icon_content'),
					    'desc' => '',
					    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_icon_box_icon_content_hint'),
					    'echo' => true,
					    'field_params' => array(
						'std' => esc_attr($foodbakery_var_icon_boxes_text),
						'cust_id' => '',
						'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
						'cust_name' => 'foodbakery_var_icon_boxes_text[]',
						'return' => true,
						'classes' => '',
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
			    <script type="text/javascript">
				jQuery('.function-class').change(function ($) {
				    var value = jQuery(this).val();
				    var parentNode = jQuery(this).parent().parent().parent();
				    if (value == 'image') {
					parentNode.find(".cs-sh-icon_box-image-area").show();
					parentNode.find(".cs-sh-icon_box-icon-area").hide();
				    } else {
					parentNode.find(".cs-sh-icon_box-image-area").hide();
					parentNode.find(".cs-sh-icon_box-icon-area").show();
				    }
				}
				);
			    </script>
			</div>
			<div class="hidden-object">
			    <?php
			    $foodbakery_opt_array = array(
				'std' => foodbakery_allow_special_char($icon_boxes_num),
				'id' => '',
				'before' => '',
				'after' => '',
				'classes' => 'fieldCounter',
				'extra_atr' => '',
				'cust_id' => '',
				'cust_name' => 'icon_boxes_num[]',
				'return' => false,
				'required' => false
			    );
			    $foodbakery_var_form_fields->foodbakery_var_form_hidden_render($foodbakery_opt_array);
			    ?>
			</div>
			<div class="wrapptabbox cs-pbwp-content cs-zero-padding">
			    <div class="opt-conts">
				<ul class="form-elements">
				    <li class="to-field"> <a href="javascript:void(0);" class="add_icon_boxesss cs-main-btn" onclick="foodbakery_shortcode_element_ajax_call('icon_box', 'shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>', '<?php echo admin_url('admin-ajax.php'); ?>')"><i class="icon-plus-circle"></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_icon_box_add')); ?></a> </li>
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
					'std' => 'icon_box',
					'id' => '',
					'before' => '',
					'after' => '',
					'classes' => '',
					'extra_atr' => '',
					'cust_id' => 'foodbakery_orderby' . $foodbakery_counter,
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
					    'cust_id' => 'icon_boxes_save' . $foodbakery_counter,
					    'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
					    'cust_type' => 'button',
					    'classes' => 'cs-foodbakery-admin-btn',
					    'cust_name' => 'icon_boxes_save',
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

    add_action('wp_ajax_foodbakery_var_page_builder_icon_box', 'foodbakery_var_page_builder_icon_box');
}

if (!function_exists('foodbakery_save_page_builder_data_icon_box_callback')) {

    /**
     * Save data for icon_box shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_icon_box_callback($args) {
	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	if ($widget_type == "icon_box" || $widget_type == "cs_icon_box") {
	    $shortcode = $shortcode_item = '';
            
            $page_element_size  =  $data['icon_box_element_size'][$counters['foodbakery_global_counter_icon_boxes']];
            $current_element_size  =  $data['icon_box_element_size'][$counters['foodbakery_global_counter_icon_boxes']];
            
	    if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes($data['shortcode']['icon_box'][$counters['foodbakery_shortcode_counter_icon_boxes']]);
                
                $element_settings   = 'icon_box_element_size="'.$current_element_size.'"';
                $reg = '/icon_box_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
                $counters['foodbakery_shortcode_counter_icon_boxes'] ++;
	    } else {
		if (isset($data['icon_boxes_num'][$counters['foodbakery_counter_icon_boxes']]) && $data['icon_boxes_num'][$counters['foodbakery_counter_icon_boxes']] > 0) {
		    for ($i = 1; $i <= $data['icon_boxes_num'][$counters['foodbakery_counter_icon_boxes']]; $i ++) {
			$shortcode_item .= '[icon_boxes_item ';

			if (isset($data['foodbakery_var_icon_box_title'][$counters['foodbakery_counter_icon_boxes_node']]) && $data['foodbakery_var_icon_box_title'][$counters['foodbakery_counter_icon_boxes_node']] != '') {
			    $shortcode_item .= 'foodbakery_var_icon_box_title="' . htmlspecialchars($data['foodbakery_var_icon_box_title'][$counters['foodbakery_counter_icon_boxes_node']], ENT_QUOTES) . '" ';
			}
			if (isset($data['foodbakery_var_link_url'][$counters['foodbakery_counter_icon_boxes_node']]) && $data['foodbakery_var_link_url'][$counters['foodbakery_counter_icon_boxes_node']] != '') {
			    $shortcode_item .= 'foodbakery_var_link_url="' . htmlspecialchars($data['foodbakery_var_link_url'][$counters['foodbakery_counter_icon_boxes_node']], ENT_QUOTES) . '" ';
			}
			if (isset($data['foodbakery_var_icon_boxes_icon'][$counters['foodbakery_counter_icon_boxes_node']]) && $data['foodbakery_var_icon_boxes_icon'][$counters['foodbakery_counter_icon_boxes_node']] != '') {
			    $shortcode_item .= 'foodbakery_var_icon_boxes_icon="' . htmlspecialchars($data['foodbakery_var_icon_boxes_icon'][$counters['foodbakery_counter_icon_boxes_node']], ENT_QUOTES) . '" ';
			}
			if (isset($data['foodbakery_var_icon_box_icon_type'][$counters['foodbakery_counter_icon_boxes_node']]) && $data['foodbakery_var_icon_box_icon_type'][$counters['foodbakery_counter_icon_boxes_node']] != '') {
			    $shortcode_item .= 'foodbakery_var_icon_box_icon_type="' . htmlspecialchars($data['foodbakery_var_icon_box_icon_type'][$counters['foodbakery_counter_icon_boxes_node']], ENT_QUOTES) . '" ';
			}
			if (isset($data['foodbakery_var_icon_box_image'][$counters['foodbakery_counter_icon_boxes_node']]) && $data['foodbakery_var_icon_box_image'][$counters['foodbakery_counter_icon_boxes_node']] != '') {
			    $shortcode_item .= 'foodbakery_var_icon_box_image="' . htmlspecialchars($data['foodbakery_var_icon_box_image'][$counters['foodbakery_counter_icon_boxes_node']], ENT_QUOTES) . '" ';
			}
			$shortcode_item .= ']';
			if (isset($data['foodbakery_var_icon_boxes_text'][$counters['foodbakery_counter_icon_boxes_node']]) && $data['foodbakery_var_icon_boxes_text'][$counters['foodbakery_counter_icon_boxes_node']] != '') {
			    $shortcode_item .= htmlspecialchars($data['foodbakery_var_icon_boxes_text'][$counters['foodbakery_counter_icon_boxes_node']], ENT_QUOTES);
			}
			$shortcode_item .= '[/icon_boxes_item]';
			$counters['foodbakery_counter_icon_boxes_node'] ++;
		    }
		}
		$section_title = '';
		if (isset($data['foodbakery_var_icon_boxes_title'][$counters['foodbakery_counter_icon_boxes']]) && $data['foodbakery_var_icon_boxes_title'][$counters['foodbakery_counter_icon_boxes']] != '') {
		    $section_title .= 'foodbakery_var_icon_boxes_title="' . htmlspecialchars($data['foodbakery_var_icon_boxes_title'][$counters['foodbakery_counter_icon_boxes']], ENT_QUOTES) . '" ';
		}
                if (isset($data['foodbakery_var_iconbox_align'][$counters['foodbakery_counter_icon_boxes']]) && $data['foodbakery_var_iconbox_align'][$counters['foodbakery_counter_icon_boxes']] != '') {
		    $section_title .= 'foodbakery_var_iconbox_align="' . htmlspecialchars($data['foodbakery_var_iconbox_align'][$counters['foodbakery_counter_icon_boxes']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_title_color'][$counters['foodbakery_counter_icon_boxes']]) && $data['foodbakery_title_color'][$counters['foodbakery_counter_icon_boxes']] != '') {
		    $section_title .= 'foodbakery_title_color="' . htmlspecialchars($data['foodbakery_title_color'][$counters['foodbakery_counter_icon_boxes']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_icon_box_content_color'][$counters['foodbakery_counter_icon_boxes']]) && $data['foodbakery_icon_box_content_color'][$counters['foodbakery_counter_icon_boxes']] != '') {
		    $section_title .= 'foodbakery_icon_box_content_color="' . htmlspecialchars($data['foodbakery_icon_box_content_color'][$counters['foodbakery_counter_icon_boxes']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_icon_box_icon_color'][$counters['foodbakery_counter_icon_boxes']]) && $data['foodbakery_icon_box_icon_color'][$counters['foodbakery_counter_icon_boxes']] != '') {
		    $section_title .= 'foodbakery_icon_box_icon_color="' . htmlspecialchars($data['foodbakery_icon_box_icon_color'][$counters['foodbakery_counter_icon_boxes']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_icon_box_icon_size'][$counters['foodbakery_counter_icon_boxes']]) && $data['foodbakery_var_icon_box_icon_size'][$counters['foodbakery_counter_icon_boxes']] != '') {
		    $section_title .= 'foodbakery_var_icon_box_icon_size="' . htmlspecialchars($data['foodbakery_var_icon_box_icon_size'][$counters['foodbakery_counter_icon_boxes']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_icon_box_view'][$counters['foodbakery_counter_icon_boxes']]) && $data['foodbakery_var_icon_box_view'][$counters['foodbakery_counter_icon_boxes']] != '') {
		    $section_title .= 'foodbakery_var_icon_box_view="' . htmlspecialchars($data['foodbakery_var_icon_box_view'][$counters['foodbakery_counter_icon_boxes']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_icon_box_content_align'][$counters['foodbakery_counter_icon_boxes']]) && $data['foodbakery_icon_box_content_align'][$counters['foodbakery_counter_icon_boxes']] != '') {
		    $section_title .= 'foodbakery_icon_box_content_align="' . htmlspecialchars($data['foodbakery_icon_box_content_align'][$counters['foodbakery_counter_icon_boxes']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_icon_boxes_sub_title'][$counters['foodbakery_counter_icon_boxes']]) && $data['foodbakery_var_icon_boxes_sub_title'][$counters['foodbakery_counter_icon_boxes']] != '') {
		    $section_title .= 'foodbakery_var_icon_boxes_sub_title="' . htmlspecialchars(str_replace('"', '\'', foodbakery_custom_shortcode_encode($data['foodbakery_var_icon_boxes_sub_title'][$counters['foodbakery_counter_icon_boxes']]))) . '" ';
		}
		if (isset($data['foodbakery_var_icon_box_column'][$counters['foodbakery_counter_icon_boxes']]) && $data['foodbakery_var_icon_box_column'][$counters['foodbakery_counter_icon_boxes']] != '') {
		    $section_title .= 'foodbakery_var_icon_box_column="' . htmlspecialchars($data['foodbakery_var_icon_box_column'][$counters['foodbakery_counter_icon_boxes']], ENT_QUOTES) . '" ';
		}
                $element_settings   = 'icon_box_element_size="'.htmlspecialchars( $data['icon_box_element_size'][$counters['foodbakery_global_counter_icon_boxes']] ).'"';
		$shortcode = '[icon_box ' . $element_settings. ' '. $section_title . ' ]' . $shortcode_item . '[/icon_box]';
		$shortcode_data .= $shortcode;
		$counters['foodbakery_counter_icon_boxes'] ++;
	    }
	    $counters['foodbakery_global_counter_icon_boxes'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_icon_box', 'foodbakery_save_page_builder_data_icon_box_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_icon_box_callback')) {

    /**
     * Populate spacer shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_icon_box_callback($counters) {
	$counters['foodbakery_counter_icon_boxes'] = 0;
	$counters['foodbakery_counter_icon_boxes_node'] = 0;
	$counters['foodbakery_shortcode_counter_icon_boxes'] = 0;
	$counters['foodbakery_global_counter_icon_boxes'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_icon_box_callback');
}

if (!function_exists('foodbakery_shortcode_names_list_populate_icon_box_callback')) {

    /**
     * Populate icon box shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_icon_box_callback($shortcode_array) {
	$shortcode_array['icon_box'] = array(
	    'title' => foodbakery_var_frame_text_srt('foodbakery_var_icon_boxs_title'),
	    'name' => 'icon_box',
	    'icon' => 'icon-database2',
	    'categories' => 'loops',
	);
	return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_icon_box_callback');
}

if (!function_exists('foodbakery_element_list_populate_icon_box_callback')) {

    /**
     * Populate icon box shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_icon_box_callback($element_list) {
	$element_list['icon_box'] = foodbakery_var_frame_text_srt('foodbakery_var_icon_boxs_title');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_icon_box_callback');
}

if (!function_exists('foodbakery_shortcode_sub_element_ui_icon_box_callback')) {

    /**
     * Render UI for sub element in icon box settings.
     *
     * @param	array $args
     */
    function foodbakery_shortcode_sub_element_ui_icon_box_callback($args) {
	$type = $args['type'];
	$foodbakery_var_html_fields = $args['html_fields'];

	if ($type == 'icon_box') {
	    $icon_boxes_count = 'icon_boxes_' . rand(455345, 23454390);
	    if (isset($foodbakery_var_icon_boxes_text) && $foodbakery_var_icon_boxes_text != '') {
		$foodbakery_var_icon_boxes_text = $foodbakery_var_icon_boxes_text;
	    } else {
		$foodbakery_var_icon_boxes_text = '';
	    }
	    ?>
	    <div class='cs-wrapp-clone cs-shortcode-wrapp' id="foodbakery_infobox_<?php echo foodbakery_allow_special_char($icon_boxes_count); ?>">
	        <header>
	    	<h4><i class='icon-arrows'></i><?php echo foodbakery_var_frame_text_srt('foodbakery_var_icon_boxs_title'); ?></h4>
	    	<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo foodbakery_var_frame_text_srt('foodbakery_var_remove'); ?></a>
	        </header>
		<?php
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_frame_text_srt('foodbakery_var_icon_boxes_content_title'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_icon_boxes_content_title_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => '',
			'cust_id' => 'foodbakery_var_icon_box_title',
			'classes' => '',
			'cust_name' => 'foodbakery_var_icon_box_title[]',
			'return' => true,
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_frame_text_srt('foodbakery_var_icon_boxes_link_url'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_icon_boxes_link_url_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => '',
			'cust_id' => 'foodbakery_var_link_url',
			'classes' => '',
			'cust_name' => 'foodbakery_var_link_url[]',
			'return' => true,
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_frame_text_srt('foodbakery_var_icon_box_icon_type'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_icon_box_icon_type_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => '',
			'id' => 'foodbakery_var_icon_box_icon_type',
			'cust_name' => 'foodbakery_var_icon_box_icon_type[]',
			'classes' => 'chosen-select-no-single select-medium function-class',
			'options' => array(
			    'icon' => foodbakery_var_frame_text_srt('foodbakery_var_icon_box_icon_type_1'),
			    'image' => foodbakery_var_frame_text_srt('foodbakery_var_icon_box_icon_type_2'),
			),
			'return' => true,
		    ),
		);
		$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
		$rand_id = rand(123450, 854987);
		?>	 				

	        <div class="cs-sh-icon_box-image-area" style="display:none;">
		    <?php
		    $foodbakery_opt_array = array(
			'std' => '',
			'id' => 'icon_box_image_array',
			'main_id' => 'icon_box_image_array',
			'name' => foodbakery_var_frame_text_srt('foodbakery_var_icon_box_image'),
			'desc' => '',
			'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_icon_box_image_hint'),
			'echo' => true,
			'array' => true,
			'field_params' => array(
			    'std' => '',
			    'cust_id' => '',
			    'cust_name' => 'foodbakery_var_icon_box_image[]',
			    'id' => 'icon_box_image_array',
			    'return' => true,
			    'array' => true,
			),
		    );
		    $foodbakery_var_html_fields->foodbakery_var_upload_file_field($foodbakery_opt_array);

		    $rand_id = rand(1111111, 9999999);
		    ?>
	        </div>
	        <div class="cs-sh-icon_box-icon-area" style="display:block;">
	    	<div class="form-elements" id="<?php echo esc_attr($rand_id); ?>">
	    	    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
	    		<label><?php echo foodbakery_var_frame_text_srt('foodbakery_var_icon_boxes_Icon'); ?></label>
			    <?php
			    if (function_exists('foodbakery_var_tooltip_helptext')) {
				echo foodbakery_var_tooltip_helptext(foodbakery_var_frame_text_srt('foodbakery_var_icon_boxes_Icon_hint'));
			    }
			    ?>
	    	    </div>
	    	    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
	    <?php echo foodbakery_var_icomoon_icons_box('', $rand_id, 'foodbakery_var_icon_boxes_icon'); ?>
	    	    </div>
	    	</div>

	        </div>
		<?php
		$foodbakery_opt_array = array(
		    'name' => foodbakery_var_frame_text_srt('foodbakery_var_icon_boxes_text'),
		    'desc' => '',
		    'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_icon_boxes_text_hint'),
		    'echo' => true,
		    'field_params' => array(
			'std' => '',
			'cust_id' => '',
			'cust_name' => 'foodbakery_var_icon_boxes_text[]',
			'return' => true,
			'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
			'classes' => '',
			'foodbakery_editor' => true,
		    ),
		);

		$foodbakery_var_html_fields->foodbakery_var_textarea_field($foodbakery_opt_array);
		?>
	    </div>
	    <script type="text/javascript">
	        jQuery('.function-class').change(function ($) {
	    	var value = jQuery(this).val();

	    	var parentNode = jQuery(this).parent().parent().parent();
	    	if (value == 'image') {
	    	    parentNode.find(".cs-sh-icon_box-image-area").show();
	    	    parentNode.find(".cs-sh-icon_box-icon-area").hide();
	    	} else {
	    	    parentNode.find(".cs-sh-icon_box-image-area").hide();
	    	    parentNode.find(".cs-sh-icon_box-icon-area").show();
	    	}

	        }
	        );
	    </script>
	    <?php
	}
    }

    add_action('foodbakery_shortcode_sub_element_ui', 'foodbakery_shortcode_sub_element_ui_icon_box_callback');
}