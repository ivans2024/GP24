<?php
/*
 *
 * @File : Button
 * @retrun
 *
 */
if (!function_exists('foodbakery_var_page_builder_button')) {

    function foodbakery_var_page_builder_button($die = 0) {
	global $post, $foodbakery_node, $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;

	if (function_exists('foodbakery_shortcode_names')) {
	    $shortcode_element = '';
	    $filter_element = 'filterdrag';
	    $shortcode_view = '';
	    $foodbakery_output = array();
	    $FOODBAKERY_PREFIX = 'foodbakery_button';
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
		'foodbakery_var_column' => '1',
		'foodbakery_var_button_text' => '',
		'foodbakery_var_button_link' => '',
		'foodbakery_var_button_border' => '',
		'foodbakery_var_button_type' => '',
		'foodbakery_var_button_target' => '',
		'foodbakery_var_button_border_color' => '',
		'foodbakery_var_button_color' => '',
		'foodbakery_var_button_bg_color' => '',
		'foodbakery_var_button_align' => '',
		'foodbakery_button_icon' => '',
		'foodbakery_var_button_size' => '',
		'foodbakery_var_icon_view' => '',
		'foodbakery_var_button_alignment'=>''
	    );
	    if (isset($foodbakery_output['0']['atts'])) {
		$atts = $foodbakery_output['0']['atts'];
	    } else {
		$atts = array();
	    }
	    if (isset($foodbakery_output['0']['content'])) {
		$button_column_text = $foodbakery_output['0']['content'];
	    } else {
		$button_column_text = '';
	    }
	    $button_element_size = '25';
	    foreach ($defaults as $key => $values) {
		if (isset($atts[$key])) {
		    $$key = $atts[$key];
		} else {
		    $$key = $values;
		}
	    }
	    $name = 'foodbakery_var_page_builder_button';
	    $coloumn_class = 'column_' . $button_element_size;
	    $foodbakery_var_button_alignment = isset($foodbakery_var_button_alignment) ? $foodbakery_var_button_alignment : '';
	    $foodbakery_var_button_text = isset($foodbakery_var_button_text) ? $foodbakery_var_button_text : '';
	    $foodbakery_var_button_link = isset($foodbakery_var_button_link) ? $foodbakery_var_button_link : '';
	    $foodbakery_var_button_border = isset($foodbakery_var_button_border) ? $foodbakery_var_button_border : '';
	    $foodbakery_var_button_type = isset($foodbakery_var_button_type) ? $foodbakery_var_button_type : '';
	    $foodbakery_var_button_target = isset($foodbakery_var_button_target) ? $foodbakery_var_button_target : '';
	    $foodbakery_var_button_border_color = isset($foodbakery_var_button_border_color) ? $foodbakery_var_button_border_color : '';
	    $foodbakery_var_button_color = isset($foodbakery_var_button_color) ? $foodbakery_var_button_color : '';
	    $foodbakery_var_button_bg_color = isset($foodbakery_var_button_bg_color) ? $foodbakery_var_button_bg_color : '';
	    $foodbakery_var_button_align = isset($foodbakery_var_button_align) ? $foodbakery_var_button_align : '';
	    $foodbakery_button_icon = isset($foodbakery_button_icon) ? $foodbakery_button_icon : '';
	    $foodbakery_var_button_size = isset($foodbakery_var_button_size) ? $foodbakery_var_button_size : '';
	    $foodbakery_var_icon_view = isset($foodbakery_var_icon_view) ? $foodbakery_var_icon_view : '';
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
		 <?php echo esc_attr($shortcode_view); ?>" item="button" data="<?php echo foodbakery_element_size_data_array_index($button_element_size) ?>" >
		     <?php foodbakery_element_setting($name, $foodbakery_counter, $button_element_size) ?>
	        <div class="cs-wrapp-class-<?php echo intval($foodbakery_counter) ?>
		     <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $foodbakery_counter) ?>" data-shortcode-template="[foodbakery_button {{attributes}}]{{content}}[/foodbakery_button]" style="display: none;">
	    	<div class="cs-heading-area" data-counter="<?php echo esc_attr($foodbakery_counter) ?>">
	    	    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_button_edit_text')); ?></h5>
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
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_text'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_text_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => esc_attr($foodbakery_var_button_text),
				    'cust_id' => 'foodbakery_var_button_text' . $foodbakery_counter,
				    'classes' => '',
				    'cust_name' => 'foodbakery_var_button_text[]',
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			    $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_url'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_url_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => esc_attr($foodbakery_var_button_link),
				    'cust_id' => 'foodbakery_var_button_link' . $foodbakery_counter,
				    'classes' => '',
				    'cust_name' => 'foodbakery_var_button_link[]',
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			    $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_border'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_border_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => $foodbakery_var_button_border,
				    'id' => '',
				    'cust_name' => 'foodbakery_var_button_border[]',
				    'classes' => 'dropdown chosen-select',
				    'options' => array(
					'yes' => foodbakery_var_theme_text_srt('foodbakery_var_yes'),
					'no' => foodbakery_var_theme_text_srt('foodbakery_var_no'),
				    ),
				    'return' => true,
				),
			    );
			    $foodbakery_opt_array = array(
				'name' => 'Button Align',
				'desc' => '',
				'hint_text' => 'Select the button alignment',
				'echo' => true,
				'field_params' => array(
				    'std' => $foodbakery_var_button_alignment,
				    'id' => '',
				    'cust_name' => 'foodbakery_var_button_alignment[]',
				    'classes' => 'dropdown chosen-select',
				    'options' => array(
					'left' => 'Left',
					'right' => 'Right',
					'center' =>'Center'
				    ),
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
			    $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_border_color'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_border_color_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => esc_attr($foodbakery_var_button_border_color),
				    'cust_id' => 'foodbakery_var_button_border_color' . $foodbakery_counter,
				    'classes' => 'bg_color',
				    'cust_name' => 'foodbakery_var_button_border_color[]',
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			    $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_button_bg_color'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_button_bg_color_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => esc_attr($foodbakery_var_button_bg_color),
				    'cust_id' => 'foodbakery_var_button_bg_color' . $foodbakery_counter,
				    'classes' => 'bg_color',
				    'cust_name' => 'foodbakery_var_button_bg_color[]',
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			    $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_button_color'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_button_color_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => esc_attr($foodbakery_var_button_color),
				    'cust_id' => 'foodbakery_var_button_color' . $foodbakery_counter,
				    'classes' => 'bg_color',
				    'cust_name' => 'foodbakery_var_button_color[]',
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
			    $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_button_size'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_button_size_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => $foodbakery_var_button_size,
				    'id' => '',
				    'cust_name' => 'foodbakery_var_button_size[]',
				    'classes' => 'dropdown chosen-select',
				    'options' => array(
					'btn-lg' => foodbakery_var_theme_text_srt('foodbakery_var_button_large'),
					'medium-btn' => foodbakery_var_theme_text_srt('foodbakery_var_button_medium'),
					'btn-sml' => foodbakery_var_theme_text_srt('foodbakery_var_button_small'),
				    ),
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
			    $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_button_icon_on_off'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_button_icon_on_off_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => $foodbakery_var_icon_view,
				    'id' => '',
				    'cust_id' => 'foodbakery_var_icon_view',
				    'cust_name' => 'foodbakery_var_icon_view[]',
				    'classes' => 'dropdown chosen-select-no-single select-medium',
				    'options' => array(
					'on' => foodbakery_var_theme_text_srt('foodbakery_var_on'),
					'off' => foodbakery_var_theme_text_srt('foodbakery_var_off'),
				    ),
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
			    ?>
	    		<style type="text/css">
	    		    .icon_fields{ display: <?php echo esc_html($foodbakery_var_icon_view == 'off' ? 'none' : 'block' ) ?>; }
	    		</style>
	    		<script>
	    		    $(function () {
	    			$('#foodbakery_var_icon_view').change(function () {
	    			    var getValue = $("#foodbakery_var_icon_view option:selected").val();
	    			    if (getValue == 'on') {
	    				$('.icon_fields').css('display', 'block');
	    			    } else {
	    				$('.icon_fields').css('display', 'none');
	    			    }
	    			});
	    		    });
	    		</script>
	    		<div class="icon_fields">
	    		    <div class="form-elements" id="foodbakery_button_<?php echo esc_attr($foodbakery_counter); ?>">
	    			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
	    			    <label><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_button_icon')); ?></label>
					<?php
					if (function_exists('foodbakery_var_tooltip_helptext')) {
					    echo foodbakery_var_tooltip_helptext(foodbakery_var_theme_text_srt('foodbakery_var_button_icon_hint'));
					}
					?>
	    			</div>
	    			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<?php echo foodbakery_var_icomoon_icons_box(esc_html($foodbakery_button_icon), esc_attr($foodbakery_counter), 'foodbakery_button_icon'); ?>
	    			</div>
	    		    </div>
				<?php
				$foodbakery_opt_array = array(
				    'name' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_button_alignment'),
				    'desc' => '',
				    'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_button_alignment_hint'),
				    'echo' => true,
				    'field_params' => array(
					'std' => $foodbakery_var_button_align,
					'id' => '',
					'cust_name' => 'foodbakery_var_button_align[]',
					'classes' => 'dropdown chosen-select',
					'options' => array(
					    'left' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_button_alignment_left'),
					    'right' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_button_alignment_right'),
					),
					'return' => true,
				    ),
				);
				$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
				?>
	    		</div>
			    <?php
			    $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_button_type'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_button_type_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => $foodbakery_var_button_type,
				    'id' => '',
				    'cust_name' => 'foodbakery_var_button_type[]',
				    'classes' => 'dropdown chosen-select',
				    'options' => array(
					'square' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_button_type_square'),
					'rounded' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_button_type_rounded'),
				    ),
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
			    $foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_target'),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_target_hint'),
				'echo' => true,
				'field_params' => array(
				    'std' => $foodbakery_var_button_target,
				    'id' => '',
				    'cust_name' => 'foodbakery_var_button_target[]',
				    'classes' => 'dropdown chosen-select',
				    'options' => array(
					'_self' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_target_blank'),
					'_blank' => foodbakery_var_theme_text_srt('foodbakery_var_button_sc_target_self'),
				    ),
				    'return' => true,
				),
			    );
			    $foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
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
				'std' => 'button',
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
				    'cust_id' => 'button_save' . $foodbakery_counter,
				    'cust_type' => 'button',
				    'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
				    'classes' => 'cs-foodbakery-admin-btn',
				    'cust_name' => 'button_save',
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

    add_action('wp_ajax_foodbakery_var_page_builder_button', 'foodbakery_var_page_builder_button');
}
if (!function_exists('foodbakery_save_page_builder_data_button_callback')) {

    /**
     * Save data for button shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_button_callback($args) {
	$data = $args['data'];
	$counters = $args['counters'];
	$widget_type = $args['widget_type'];
	$column = $args['column'];
	if ($widget_type == "button" || $widget_type == "cs_button") {
	    $foodbakery_var_button = '';
            $page_element_size  =  $data['button_element_size'][$counters['foodbakery_global_counter_button']];
            $button_element_size  =  $data['button_element_size'][$counters['foodbakery_global_counter_button']];
	    
            if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
		$shortcode_str = stripslashes(( $data['shortcode']['button'][$counters['foodbakery_shortcode_counter_button']]));
                $element_settings   = 'button_element_size="'.$button_element_size.'"';
                $reg = '/button_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
                
                $counters['foodbakery_shortcode_counter_button'] ++;
	    } else {
                $foodbakery_var_button = '[foodbakery_button button_element_size="'.htmlspecialchars( $data['button_element_size'][$counters['foodbakery_global_counter_button']] ).'" ';
		if (isset($data['foodbakery_var_button_text'][$counters['foodbakery_counter_button']]) && $data['foodbakery_var_button_text'][$counters['foodbakery_counter_button']] != '') {
		    $foodbakery_var_button .= 'foodbakery_var_button_text="' . htmlspecialchars($data['foodbakery_var_button_text'][$counters['foodbakery_counter_button']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_button_alignment'][$counters['foodbakery_counter_button']]) && $data['foodbakery_var_button_alignment'][$counters['foodbakery_counter_button']] != '') {
		    $foodbakery_var_button .= 'foodbakery_var_button_alignment="' . htmlspecialchars($data['foodbakery_var_button_alignment'][$counters['foodbakery_counter_button']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_button_link'][$counters['foodbakery_counter_button']]) && $data['foodbakery_var_button_link'][$counters['foodbakery_counter_button']] != '') {
		    $foodbakery_var_button .= 'foodbakery_var_button_link="' . htmlspecialchars($data['foodbakery_var_button_link'][$counters['foodbakery_counter_button']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_button_size'][$counters['foodbakery_counter_button']]) && $data['foodbakery_var_button_size'][$counters['foodbakery_counter_button']] != '') {
		    $foodbakery_var_button .= 'foodbakery_var_button_size="' . htmlspecialchars($data['foodbakery_var_button_size'][$counters['foodbakery_counter_button']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_button_icon'][$counters['foodbakery_counter_button']]) && $data['foodbakery_button_icon'][$counters['foodbakery_counter_button']] != '') {
		    $foodbakery_var_button .= 'foodbakery_button_icon="' . htmlspecialchars($data['foodbakery_button_icon'][$counters['foodbakery_counter_button']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_icon_view'][$counters['foodbakery_counter_button']]) && $data['foodbakery_var_icon_view'][$counters['foodbakery_counter_button']] != '') {
		    $foodbakery_var_button .= 'foodbakery_var_icon_view="' . htmlspecialchars($data['foodbakery_var_icon_view'][$counters['foodbakery_counter_button']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_button_border'][$counters['foodbakery_counter_button']]) && $data['foodbakery_var_button_border'][$counters['foodbakery_counter_button']] != '') {
		    $foodbakery_var_button .= 'foodbakery_var_button_border="' . htmlspecialchars($data['foodbakery_var_button_border'][$counters['foodbakery_counter_button']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_button_type'][$counters['foodbakery_counter_button']]) && $data['foodbakery_var_button_type'][$counters['foodbakery_counter_button']] != '') {
		    $foodbakery_var_button .= 'foodbakery_var_button_type="' . htmlspecialchars($data['foodbakery_var_button_type'][$counters['foodbakery_counter_button']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_button_align'][$counters['foodbakery_counter_button']]) && $data['foodbakery_var_button_align'][$counters['foodbakery_counter_button']] != '') {
		    $foodbakery_var_button .= 'foodbakery_var_button_align="' . htmlspecialchars($data['foodbakery_var_button_align'][$counters['foodbakery_counter_button']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_button_target'][$counters['foodbakery_counter_button']]) && $data['foodbakery_var_button_target'][$counters['foodbakery_counter_button']] != '') {
		    $foodbakery_var_button .= 'foodbakery_var_button_target="' . htmlspecialchars($data['foodbakery_var_button_target'][$counters['foodbakery_counter_button']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_button_border_color'][$counters['foodbakery_counter_button']]) && $data['foodbakery_var_button_border_color'][$counters['foodbakery_counter_button']] != '') {
		    $foodbakery_var_button .= 'foodbakery_var_button_border_color="' . htmlspecialchars($data['foodbakery_var_button_border_color'][$counters['foodbakery_counter_button']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_button_color'][$counters['foodbakery_counter_button']]) && $data['foodbakery_var_button_color'][$counters['foodbakery_counter_button']] != '') {
		    $foodbakery_var_button .= 'foodbakery_var_button_color="' . htmlspecialchars($data['foodbakery_var_button_color'][$counters['foodbakery_counter_button']], ENT_QUOTES) . '" ';
		}
		if (isset($data['foodbakery_var_button_bg_color'][$counters['foodbakery_counter_button']]) && $data['foodbakery_var_button_bg_color'][$counters['foodbakery_counter_button']] != '') {
		    $foodbakery_var_button .= 'foodbakery_var_button_bg_color="' . htmlspecialchars($data['foodbakery_var_button_bg_color'][$counters['foodbakery_counter_button']], ENT_QUOTES) . '" ';
		}
		$foodbakery_var_button .= ']';
		if (isset($data['button_text'][$counters['foodbakery_counter_button']]) && $data['button_text'][$counters['foodbakery_counter_button']] != '') {
		    $foodbakery_var_button .= htmlspecialchars($data['button_text'][$counters['foodbakery_counter_button']], ENT_QUOTES) . ' ';
		}
		$foodbakery_var_button .= '[/foodbakery_button]';
                $shortcode_data .= $foodbakery_var_button;
                
		$counters['foodbakery_counter_button'] ++;
	    }
	    $counters['foodbakery_global_counter_button'] ++;
	}
	return array(
	    'data' => $data,
	    'counters' => $counters,
	    'widget_type' => $widget_type,
	    'column' => $shortcode_data,
	);
    }

    add_filter('foodbakery_save_page_builder_data_button', 'foodbakery_save_page_builder_data_button_callback');
}
if (!function_exists('foodbakery_load_shortcode_counters_button_callback')) {

    /**
     * Populate button shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_button_callback($counters) {
	$counters['foodbakery_global_counter_button'] = 0;
	$counters['foodbakery_shortcode_counter_button'] = 0;
	$counters['foodbakery_counter_button'] = 0;
	return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_button_callback');
}
if (!function_exists('foodbakery_shortcode_names_list_populate_button_callback')) {

    /**
     * Populate button shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_button_callback($shortcode_array) {
	$shortcode_array['button'] = array(
	    'title' => foodbakery_var_frame_text_srt('foodbakery_var_button'),
	    'name' => 'button',
	    'icon' => 'icon-support',
	    'categories' => 'typography',
	);
	return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_button_callback');
}
if (!function_exists('foodbakery_element_list_populate_button_callback')) {

    /**
     * Populate button shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_button_callback($element_list) {
	$element_list['button'] = foodbakery_var_frame_text_srt('foodbakery_var_button');
	return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_button_callback');
}