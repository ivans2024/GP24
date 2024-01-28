<?php
/**
 * Shortcode Name : Accordion
 *
 * @package	foodbakery 
 */
if ( ! function_exists('foodbakery_var_page_builder_accordion') ) {

	function foodbakery_var_page_builder_accordion($die = 0) {
		global $foodbakery_node, $count_node, $post, $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;
		$strings = new foodbakery_theme_all_strings;
		$strings->foodbakery_short_code_strings();
		$shortcode_element = '';
		$filter_element = 'filterdrag';
		$shortcode_view = '';
		$output = array();
		$foodbakery_counter = $_POST['counter'];
		$PREFIX = 'foodbakery_accordion|accordion_item';
		$parseObject = new ShortcodeParse();
		$accordion_num = 0;
		if ( isset($_POST['action']) && ! isset($_POST['shortcode_element_id']) ) {
			$POSTID = '';
			$shortcode_element_id = '';
		} else {
			$POSTID = $_POST['POSTID'];
			$shortcode_element_id = $_POST['shortcode_element_id'];
			$shortcode_str = stripslashes($shortcode_element_id);
			$output = $parseObject->foodbakery_shortcodes($output, $shortcode_str, true, $PREFIX);
		}
		$defaults = array(
			'foodbakery_var_accordion_view' => '',
			'foodbakery_var_accordion_icon' => '',
			'foodbakery_var_accordian_main_title' => '',
			'foodbakery_var_accordion_align' => '',
		);
		if ( isset($output['0']['atts']) ) {
			$atts = $output['0']['atts'];
		} else {
			$atts = array();
		}
		if ( isset($output['0']['content']) ) {
			$atts_content = $output['0']['content'];
		} else {
			$atts_content = array();
		}
		if ( is_array($atts_content) ) {
			$accordion_num = count($atts_content);
		}
		$accordion_element_size = '50';
		foreach ( $defaults as $key => $values ) {
			if ( isset($atts[$key]) ) {
				$$key = $atts[$key];
			} else {
				$$key = $values;
			}
		}
		$name = 'foodbakery_var_page_builder_accordion';
		$coloumn_class = 'column_' . $accordion_element_size;
		$foodbakery_var_accordion_view = isset($foodbakery_var_accordion_view) ? $foodbakery_var_accordion_view : '';
		$foodbakery_var_accordian_main_title = isset($foodbakery_var_accordian_main_title) ? $foodbakery_var_accordian_main_title : '';
		$foodbakery_var_accordion_icon = isset($foodbakery_var_accordion_icon) ? $foodbakery_var_accordion_icon : '';
		$foodbakery_var_accordion_align = isset($foodbakery_var_accordion_align) ? $foodbakery_var_accordion_align : '';
		if ( isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode' ) {
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
		?>
		<div id="<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>_del" class="column  parentdelete <?php echo foodbakery_allow_special_char($coloumn_class); ?> <?php echo foodbakery_allow_special_char($shortcode_view); ?>" item="accordion" data="<?php echo foodbakery_element_size_data_array_index($accordion_element_size) ?>" >
			<?php foodbakery_element_setting($name, $foodbakery_counter, $accordion_element_size, '', 'list-ul'); ?>
			<div class="cs-wrapp-class-<?php echo foodbakery_allow_special_char($foodbakery_counter) ?> <?php echo foodbakery_allow_special_char($shortcode_element); ?>" id="<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>" data-shortcode-template="[foodbakery_accordion {{attributes}}]" style="display: none;">
				<div class="cs-heading-area">
					<h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_accordion_edit_options')); ?></h5>
					<a href="javascript:foodbakery_frame_removeoverlay('<?php echo foodbakery_allow_special_char($name . $foodbakery_counter) ?>','<?php echo foodbakery_allow_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
				<div class="cs-clone-append cs-pbwp-content">
					<div class="cs-wrapp-tab-box">
						<div id="shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>" data-shortcode-template="{{child_shortcode}}[/<?php echo esc_attr('foodbakery_accordion'); ?>]" data-shortcode-child-template="[<?php echo esc_attr('accordion_item'); ?> {{attributes}}] {{content}} [/<?php echo esc_attr('accordion_item'); ?>]">
							<div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[<?php echo esc_attr('foodbakery_accordion'); ?> {{attributes}}]">
								<?php
								$foodbakery_opt_array = array(
									'name' => foodbakery_var_theme_text_srt('foodbakery_var_element_title'),
									'desc' => '',
									'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_element_title_hint'),
									'echo' => true,
									'field_params' => array(
										'std' => foodbakery_allow_special_char($foodbakery_var_accordian_main_title),
										'id' => 'foodbakery_var_accordian_main_title',
										'cust_name' => 'foodbakery_var_accordian_main_title[]',
										'classes' => '',
										'return' => true,
									),
								);
								$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

								$foodbakery_opt_array = array(
									'name' => foodbakery_var_theme_text_srt('foodbakery_var_title_alignment'),
									'desc' => '',
									'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_title_alignment_hint'),
									'echo' => true,
									'field_params' => array(
										'std' => $foodbakery_var_accordion_align,
										'id' => '',
										'cust_id' => 'foodbakery_var_accordion_align',
										'cust_name' => 'foodbakery_var_accordion_align[]',
										'classes' => 'service_postion chosen-select-no-single select-medium',
										'options' => array(
											'align-left' => foodbakery_var_theme_text_srt('foodbakery_var_align_left'),
											'align-right' => foodbakery_var_theme_text_srt('foodbakery_var_align_right'),
											'align-center' => foodbakery_var_theme_text_srt('foodbakery_var_align_center'),
										),
										'return' => true,
									),
								);
								$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);

								if ( isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode' ) {
									foodbakery_shortcode_element_size();
								}
								$foodbakery_opt_array = array(
									'name' => foodbakery_var_theme_text_srt('foodbakery_var_accordion_views'),
									'desc' => '',
									'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_accordion_view_hint'),
									'echo' => true,
									'field_params' => array(
										'std' => $foodbakery_var_accordion_view,
										'id' => '',
										'cust_id' => 'foodbakery_var_accordion_view',
										'cust_name' => 'foodbakery_var_accordion_view[]',
										'classes' => 'service_postion chosen-select-no-single select-medium',
										'options' => array(
											'simple' => foodbakery_var_theme_text_srt('foodbakery_var_accordion_simple'),
											'modern' => foodbakery_var_theme_text_srt('foodbakery_var_accordion_modern'),
										),
										'return' => true,
									),
								);
								$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
								?>
							</div>
							<?php
							if ( isset($accordion_num) && $accordion_num <> '' && isset($atts_content) && is_array($atts_content) ) {
								foreach ( $atts_content as $accordion ) {
									$rand_id = rand(3333, 99999);
									$foodbakery_var_accordion_text = $accordion['content'];
									$defaults = array( 'foodbakery_var_accordion_title' => 'Title', 'foodbakery_var_accordion_active' => 'yes', 'foodbakery_var_icon_box' => '' );
									foreach ( $defaults as $key => $values ) {
										if ( isset($accordion['atts'][$key]) )
											$$key = $accordion['atts'][$key];
										else
											$$key = $values;
									}
									$foodbakery_var_accordion_active = isset($foodbakery_var_accordion_active) ? $foodbakery_var_accordion_active : '';
									$foodbakery_var_accordion_title = isset($foodbakery_var_accordion_title) ? $foodbakery_var_accordion_title : '';
									?>
									<div class='cs-wrapp-clone cs-shortcode-wrapp  cs-pbwp-content'  id="foodbakery_infobox_<?php echo foodbakery_allow_special_char($rand_id); ?>">
										<header>
											<h4><i class='icon-arrows'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_accordion')); ?></h4>
											<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_remove')); ?></a></header>
										<div class="form-elements" id="foodbakery_infobox_<?php echo esc_attr($rand_id); ?>">
											<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
												<label><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_icon')); ?></label>
												<?php
												if ( function_exists('foodbakery_var_tooltip_helptext') ) {
													echo foodbakery_var_tooltip_helptext(foodbakery_var_theme_text_srt('foodbakery_var_icon_hint'));
												}
												?>
											</div>
											<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
												<?php echo foodbakery_var_icomoon_icons_box($foodbakery_var_icon_box, esc_attr($rand_id), 'foodbakery_var_icon_box'); ?>
											</div>
										</div>
										<?php
										$foodbakery_opt_array = array(
											'name' => foodbakery_var_theme_text_srt('foodbakery_var_accordian_active'),
											'desc' => '',
											'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_accordian_active_hint'),
											'echo' => true,
											'field_params' => array(
												'std' => $foodbakery_var_accordion_active,
												'id' => '',
												'cust_name' => 'foodbakery_var_accordion_active[]',
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
											'name' => foodbakery_var_theme_text_srt('foodbakery_var_accordian_title'),
											'desc' => '',
											'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_accordian_title_hint'),
											'echo' => true,
											'field_params' => array(
												'std' => foodbakery_allow_special_char($foodbakery_var_accordion_title),
												'id' => 'accordion_title',
												'cust_name' => 'foodbakery_var_accordion_title[]',
												'classes' => '',
												'return' => true,
											),
										);
										$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
										$foodbakery_opt_array = array(
											'name' => foodbakery_var_theme_text_srt('foodbakery_var_accordian_descr'),
											'desc' => '',
											'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_accordian_descr_hint'),
											'echo' => true,
											'field_params' => array(
												'std' => foodbakery_allow_special_char($foodbakery_var_accordion_text),
												'id' => 'foodbakery_var_accordion_text',
												'cust_name' => 'foodbakery_var_accordion_text[]',
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
								'std' => $accordion_num,
								'id' => '',
								'before' => '',
								'after' => '',
								'classes' => 'fieldCounter',
								'extra_atr' => '',
								'cust_id' => '',
								'cust_name' => 'accordion_num[]',
								'return' => false,
								'required' => false
							);
							$foodbakery_var_form_fields->foodbakery_var_form_hidden_render($foodbakery_opt_array);
							?>
						</div>
						<div class="wrapptabbox">
							<div class="opt-conts">
								<ul class="form-elements noborder">
									<li class="to-field"> <a href="javascript:void(0);" class="add_servicesss cs-main-btn" onclick="foodbakery_shortcode_element_ajax_call('accordion', 'shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>', '<?php echo foodbakery_allow_special_char(admin_url('admin-ajax.php')); ?>')"><i class="icon-plus-circle"></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_accordian_add_accordian')); ?></a> </li>
									<div id="loading" class="shortcodeload"></div>
								</ul>
								<?php if ( isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode' ) { ?>
									<ul class="form-elements insert-bg">
										<li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo esc_js(str_replace('foodbakery_var_page_builder_', '', $name)); ?>', 'shortcode-item-<?php echo foodbakery_allow_special_char($foodbakery_counter); ?>', '<?php echo foodbakery_allow_special_char($filter_element); ?>')" ><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_insert')); ?></a> </li>
									</ul>
									<div id="results-shortocde"></div>
									<?php
								} else {
									$foodbakery_opt_array = array(
										'std' => 'accordion',
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
		if ( $die <> 1 ) {
			die();
		}
	}

	add_action('wp_ajax_foodbakery_var_page_builder_accordion', 'foodbakery_var_page_builder_accordion');
}

if ( ! function_exists('foodbakery_save_page_builder_data_accordion_callback') ) {

	/**
	 * Save data for accordion shortcode.
	 *
	 * @param	array $args
	 * @return	array
	 */
	function foodbakery_save_page_builder_data_accordion_callback($args) {

		$data = $args['data'];
		$counters = $args['counters'];
		$widget_type = $args['widget_type'];
		$column = $args['column'];
		if ( $widget_type == "accordion" || $widget_type == "cs_accordion" ) {
			$shortcode = $shortcode_item = '';

			$page_element_size = $data['accordion_element_size'][$counters['foodbakery_global_counter_accordion']];
			$current_element_size = $data['accordion_element_size'][$counters['foodbakery_global_counter_accordion']];

			if ( isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode' ) {
				$shortcode_str = stripslashes($data['shortcode']['accordion'][$counters['foodbakery_shortcode_counter_accordion']]);

				$element_settings = 'accordion_element_size="' . $current_element_size . '"';
				$reg = '/accordion_element_size="(\d+)"/s';
				$shortcode_str = preg_replace($reg, $element_settings, $shortcode_str);
				$shortcode_data .= $shortcode_str;
				$counters['foodbakery_shortcode_counter_accordion'] ++;
			} else {
				if ( isset($data['accordion_num'][$counters['foodbakery_counter_accordion']]) && $data['accordion_num'][$counters['foodbakery_counter_accordion']] > 0 ) {
					for ( $i = 1; $i <= $data['accordion_num'][$counters['foodbakery_counter_accordion']]; $i ++ ) {
						$shortcode_item .= '[accordion_item ';
						if ( isset($data['foodbakery_var_accordion_active'][$counters['foodbakery_counter_accordion_node']]) && $data['foodbakery_var_accordion_active'][$counters['foodbakery_counter_accordion_node']] != '' ) {
							$shortcode_item .= 'foodbakery_var_accordion_active="' . htmlspecialchars($data['foodbakery_var_accordion_active'][$counters['foodbakery_counter_accordion_node']], ENT_QUOTES) . '" ';
						}
						if ( isset($data['foodbakery_var_accordion_title'][$counters['foodbakery_counter_accordion_node']]) && $data['foodbakery_var_accordion_title'][$counters['foodbakery_counter_accordion_node']] != '' ) {
							$shortcode_item .= 'foodbakery_var_accordion_title="' . htmlspecialchars($data['foodbakery_var_accordion_title'][$counters['foodbakery_counter_accordion_node']], ENT_QUOTES) . '" ';
						}
						if ( isset($data['foodbakery_var_icon_box'][$counters['foodbakery_counter_accordion_node']]) && $data['foodbakery_var_icon_box'][$counters['foodbakery_counter_accordion_node']] != '' ) {
							$shortcode_item .= 'foodbakery_var_icon_box="' . htmlspecialchars($data['foodbakery_var_icon_box'][$counters['foodbakery_counter_accordion_node']], ENT_QUOTES) . '" ';
						}
						$shortcode_item .= ']';
						if ( isset($data['foodbakery_var_accordion_text'][$counters['foodbakery_counter_accordion_node']]) && $data['foodbakery_var_accordion_text'][$counters['foodbakery_counter_accordion_node']] != '' ) {
							$shortcode_item .= htmlspecialchars($data['foodbakery_var_accordion_text'][$counters['foodbakery_counter_accordion_node']], ENT_QUOTES);
						}
						$shortcode_item .= '[/accordion_item]';
						$counters['foodbakery_counter_accordion_node'] ++;
					}
				}
				$section_title = '';
				if ( isset($data['foodbakery_var_accordion_view'][$counters['foodbakery_counter_accordion']]) && $data['foodbakery_var_accordion_view'][$counters['foodbakery_counter_accordion']] != '' ) {
					$section_title .= 'foodbakery_var_accordion_view="' . htmlspecialchars($data['foodbakery_var_accordion_view'][$counters['foodbakery_counter_accordion']], ENT_QUOTES) . '" ';
				}
				if ( isset($data['foodbakery_var_accordion_align'][$counters['foodbakery_counter_accordion']]) && $data['foodbakery_var_accordion_align'][$counters['foodbakery_counter_accordion']] != '' ) {
					$section_title .= 'foodbakery_var_accordion_align="' . htmlspecialchars($data['foodbakery_var_accordion_align'][$counters['foodbakery_counter_accordion']], ENT_QUOTES) . '" ';
				}
				if ( isset($data['foodbakery_var_accordian_main_title'][$counters['foodbakery_counter_accordion']]) && $data['foodbakery_var_accordian_main_title'][$counters['foodbakery_counter_accordion']] != '' ) {
					$section_title .= 'foodbakery_var_accordian_main_title="' . htmlspecialchars($data['foodbakery_var_accordian_main_title'][$counters['foodbakery_counter_accordion']], ENT_QUOTES) . '" ';
				}
				$element_settings = 'accordion_element_size="' . htmlspecialchars($data['accordion_element_size'][$counters['foodbakery_global_counter_accordion']]) . '"';
				$shortcode = '[foodbakery_accordion ' . $element_settings . ' ' . $section_title . ' ]' . $shortcode_item . '[/foodbakery_accordion]';
				$shortcode_data .= $shortcode;
				$counters['foodbakery_counter_accordion'] ++;
			}
			$counters['foodbakery_global_counter_accordion'] ++;
		}
		return array(
			'data' => $data,
			'counters' => $counters,
			'widget_type' => $widget_type,
			'column' => $shortcode_data,
		);
	}

	add_filter('foodbakery_save_page_builder_data_accordion', 'foodbakery_save_page_builder_data_accordion_callback');
}

if ( ! function_exists('foodbakery_load_shortcode_counters_accordion_callback') ) {

	/**
	 * Populate accordion shortcode counter variables.
	 *
	 * @param	array $counters
	 * @return	array
	 */
	function foodbakery_load_shortcode_counters_accordion_callback($counters) {
		$counters['foodbakery_counter_accordion'] = 0;
		$counters['foodbakery_counter_accordion_node'] = 0;
		$counters['foodbakery_shortcode_counter_accordion'] = 0;
		$counters['foodbakery_global_counter_accordion'] = 0;
		return $counters;
	}

	add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_accordion_callback');
}

if ( ! function_exists('foodbakery_shortcode_sub_element_ui_accordion_callback') ) {

	/**
	 * Render UI for sub element in accordion settings.
	 *
	 * @param	array $args
	 */
	function foodbakery_shortcode_sub_element_ui_accordion_callback($args) {
		$type = $args['type'];
		$foodbakery_var_html_fields = $args['html_fields'];
		if ( $type == 'accordion' ) {
			$foodbakery_var_active = foodbakery_var_frame_text_srt('foodbakery_var_active');
			$foodbakery_var_active_hint = foodbakery_var_frame_text_srt('foodbakery_var_active_hint');
			$foodbakery_var_accordion_title = foodbakery_var_frame_text_srt('foodbakery_var_accordion_title');
			$foodbakery_var_accordion_title_hint = foodbakery_var_frame_text_srt('foodbakery_var_accordion_title_hint');
			$foodbakery_var_accordion_text = foodbakery_var_frame_text_srt('foodbakery_var_accordion_text');
			$foodbakery_var_accordion_text_hint = foodbakery_var_frame_text_srt('foodbakery_var_accordion_text_hint');
			$rand_id = rand(324235, 993249);
			?>
			<div class='cs-wrapp-clone cs-shortcode-wrapp'  id="foodbakery_infobox_<?php echo intval($rand_id); ?>">
				<header>
					<h4><i class='icon-arrows'></i><?php echo foodbakery_var_frame_text_srt('foodbakery_var_accordion'); ?></h4>
					<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo foodbakery_var_frame_text_srt('foodbakery_var_remove'); ?></a>
				</header>

				<div class="form-elements" id="foodbakery_infobox_<?php echo esc_attr($rand_id); ?>">
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label><?php echo foodbakery_var_frame_text_srt('foodbakery_var_accordion_icon'); ?></label>
						<?php
						if ( function_exists('foodbakery_var_tooltip_helptext') ) {
							echo foodbakery_var_tooltip_helptext(foodbakery_var_frame_text_srt('foodbakery_var_accordion_icon_hint'));
						}
						?>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
						<?php echo foodbakery_var_icomoon_icons_box('', esc_attr($rand_id), 'foodbakery_var_icon_box'); ?>
					</div>
				</div>
				<?php
				$foodbakery_opt_array = array(
					'name' => $foodbakery_var_active,
					'desc' => '',
					'hint_text' => $foodbakery_var_active_hint,
					'echo' => true,
					'field_params' => array(
						'std' => '',
						'id' => '',
						'cust_name' => 'foodbakery_var_accordion_active[]',
						'classes' => 'dropdown chosen-select',
						'options' => array(
							'yes' => foodbakery_var_frame_text_srt('foodbakery_var_yes'),
							'no' => foodbakery_var_frame_text_srt('foodbakery_var_no'),
						),
						'return' => true,
					),
				);
				$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
				$foodbakery_opt_array = array(
					'name' => $foodbakery_var_accordion_title,
					'desc' => '',
					'hint_text' => $foodbakery_var_accordion_title_hint,
					'echo' => true,
					'field_params' => array(
						'std' => '',
						'id' => 'accordion_title',
						'cust_name' => 'foodbakery_var_accordion_title[]',
						'classes' => '',
						'return' => true,
					),
				);
				$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
				$foodbakery_opt_array = array(
					'name' => $foodbakery_var_accordion_text,
					'desc' => '',
					'hint_text' => $foodbakery_var_accordion_text_hint,
					'echo' => true,
					'field_params' => array(
						'std' => '',
						'id' => 'foodbakery_var_accordion_text',
						'cust_name' => 'foodbakery_var_accordion_text[]',
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

	add_action('foodbakery_shortcode_sub_element_ui', 'foodbakery_shortcode_sub_element_ui_accordion_callback');
}

if ( ! function_exists('foodbakery_element_list_populate_accordion_callback') ) {

	/**
	 * Populate accordion shortcode strings list.
	 *
	 * @param	array $counters
	 * @return	array
	 */
	function foodbakery_element_list_populate_accordion_callback($element_list) {
		$element_list['accordion'] = foodbakery_var_frame_text_srt('foodbakery_var_accordion');
		return $element_list;
	}

	add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_accordion_callback');
}

if ( ! function_exists('foodbakery_shortcode_names_list_populate_accordion_callback') ) {

	/**
	 * Populate accordion shortcode names list.
	 *
	 * @param	array $counters
	 * @return	array
	 */
	function foodbakery_shortcode_names_list_populate_accordion_callback($shortcode_array) {
		$shortcode_array['accordion'] = array(
			'title' => foodbakery_var_frame_text_srt('foodbakery_var_accordian'),
			'name' => 'accordion',
			'icon' => 'icon-list-ul',
			'categories' => 'contentblocks',
		);
		return $shortcode_array;
	}

	add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_accordion_callback');
}
