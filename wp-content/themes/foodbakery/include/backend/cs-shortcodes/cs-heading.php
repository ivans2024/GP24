<?php
/* *
 * @Shortcode Name : Heading
 * @retrun
 * */
if (!function_exists('foodbakery_var_page_builder_heading')) {

    function foodbakery_var_page_builder_heading($die = 0) {
        global $foodbakery_node, $post, $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $counter = $_POST['counter'];
        $foodbakery_counter = $_POST['counter'];
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $PREFIX = 'foodbakery_heading';
            $parseObject = new ShortcodeParse();
            $output = $parseObject->foodbakery_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array(
            'foodbakery_heading_title' => '',
            'foodbakery_heading_color' => '#000',
            'class' => 'cs-heading-shortcode',
            'foodbakery_heading_style' => '1',
            'foodbakery_heading_option' => '',
            'foodbakery_heading_size' => '',
            'foodbakery_letter_space' => '',
            'foodbakery_line_height' => '',
            'foodbakery_heading_font_style' => '',
            'foodbakery_heading_view' => 'view-1',
            'foodbakery_heading_align' => 'center',
            'foodbakery_heading_divider' => '',
            'foodbakery_var_heading_align' => '',
        );
        if (isset($output['0']['atts'])) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }
        if (isset($output['0']['content'])) {
            $heading_content = $output['0']['content'];
        } else {
            $heading_content = '';
        }
        $heading_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key]))
                $$key = $atts[$key];
            else
                $$key = $values;
        }
        $name = 'foodbakery_var_page_builder_heading';
        $coloumn_class = 'column_' . $heading_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        $strings = new foodbakery_theme_all_strings;
        $strings->foodbakery_short_code_strings();
        $foodbakery_heading_title = isset($foodbakery_heading_title) ? $foodbakery_heading_title : '';
        $foodbakery_heading_color = isset($foodbakery_heading_color) ? $foodbakery_heading_color : '';
        $foodbakery_heading_style = isset($foodbakery_heading_style) ? $foodbakery_heading_style : '';
        $foodbakery_heading_option = isset($foodbakery_heading_option) ? $foodbakery_heading_option : '';
        $foodbakery_heading_size = isset($foodbakery_heading_size) ? $foodbakery_heading_size : '';
        $foodbakery_letter_space = isset($foodbakery_letter_space) ? $foodbakery_letter_space : '';
        $foodbakery_line_height = isset($foodbakery_line_height) ? $foodbakery_line_height : '';
        $foodbakery_heading_font_style = isset($foodbakery_heading_font_style) ? $foodbakery_heading_font_style : '';
        $foodbakery_heading_view = isset($foodbakery_heading_view) ? $foodbakery_heading_view : '';
        $foodbakery_heading_align = isset($foodbakery_heading_align) ? $foodbakery_heading_align : '';
        $foodbakery_heading_divider = isset($foodbakery_heading_divider) ? $foodbakery_heading_divider : '';
        $foodbakery_var_heading_align = isset($foodbakery_var_heading_align) ? $foodbakery_var_heading_align : '';
        ?>
        <div id="<?php echo esc_attr($name . $foodbakery_counter) ?>_del" class="column parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="heading" data="<?php echo foodbakery_element_size_data_array_index($heading_element_size) ?>" >
            <?php foodbakery_element_setting($name, $foodbakery_counter, $heading_element_size, '', 'h-square', $type = ''); ?>
            <div class="cs-wrapp-class-<?php echo intval($foodbakery_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $foodbakery_counter) ?>"  data-shortcode-template="[foodbakery_heading {{attributes}}]{{content}}[/foodbakery_heading]" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_heading_edit_options')); ?></h5>
                    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo esc_js($name . $foodbakery_counter) ?>','<?php echo esc_js($filter_element); ?>')"
                       class="cs-btnclose"><i class="icon-times"></i>
                    </a>
                </div>
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp">
                        <?php
                        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                            foodbakery_shortcode_element_size();
                        }
                        $foodbakery_opt_array = array(
                            'name' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_title'),
                            'desc' => '',
                            'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_title_hint'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => foodbakery_allow_special_char($foodbakery_heading_title),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'foodbakery_heading_title[]',
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
                                'std' => $foodbakery_var_heading_align,
                                'id' => '',
                                'cust_id' => 'foodbakery_var_heading_align',
                                'cust_name' => 'foodbakery_var_heading_align[]',
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

                        $foodbakery_opt_array = array(
                            'name' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_content'),
                            'desc' => '',
                            'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_content_hint'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_textarea($heading_content),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'heading_content[]',
                                'return' => true,
                                'foodbakery_editor' => true,
                                'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
                            ),
                        );
                        $foodbakery_var_html_fields->foodbakery_var_textarea_field($foodbakery_opt_array);
                        $foodbakery_opt_array = array(
                            'name' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_type'),
                            'desc' => '',
                            'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_type_hint'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $foodbakery_heading_style,
                                'id' => '',
                                'cust_id' => '',
                                'cust_name' => 'foodbakery_heading_style[]',
                                'classes' => 'chosen-select select-medium',
                                'options' => array(
                                    '1' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_h1'),
                                    '2' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_h2'),
                                    '3' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_h3'),
                                    '4' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_h4'),
                                    '5' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_h5'),
                                    '6' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_h6'),
                                ),
                                'return' => true,
                            ),
                        );
                        $foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
                        $foodbakery_opt_array = array(
                            'name' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_type'),
                            'desc' => '',
                            'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_type_hint'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $foodbakery_heading_option,
                                'id' => '',
                                'cust_id' => '',
                                'cust_name' => 'foodbakery_heading_option[]',
                                'classes' => 'chosen-select select-medium',
                                'extra_atr' => ' onchange=automobile_inv_elem_view_change(this.value)',
                                'options' => array(
                                    'default' => foodbakery_var_theme_text_srt('foodbakery_var_heading_default'),
                                    'icon' => foodbakery_var_theme_text_srt('foodbakery_var_heading_icon'),
                                ),
                                'return' => true,
                            ),
                        );
                        $foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
                        
                        
                        echo '<div class="cs-not-slider-view-area-inv" style="display:' . ($foodbakery_heading_option != 'icon' ? 'none' : 'display') . ';">';
                        $foodbakery_opt_array = array(
                            'name' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_title'),
                            'desc' => '',
                            'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_title_hint'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => foodbakery_allow_special_char($foodbakery_heading_title),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'foodbakery_heading_title[]',
                                'return' => true,
                            ),
                        );
                        $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
                        $foodbakery_opt_array = array(
                            'name' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_title'),
                            'desc' => '',
                            'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_title_hint'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => foodbakery_allow_special_char($foodbakery_heading_title),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'foodbakery_heading_title[]',
                                'return' => true,
                            ),
                        );
                        $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
                        $foodbakery_opt_array = array(
                            'name' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_title'),
                            'desc' => '',
                            //'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_title_hint'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => foodbakery_allow_special_char($foodbakery_heading_title),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'foodbakery_heading_title[]',
                                'return' => true,
                            ),
                        );
                        $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
                        
                        
                 
echo '</div>';
                        
                        ?>
                        <div class="form-elements">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_font_size')); ?></label>
                                <?php
                                if (function_exists('foodbakery_var_tooltip_helptext')) {
                                    echo foodbakery_var_tooltip_helptext(foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_font_size_hint'));
                                }
                                ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <?php
                                $foodbakery_opt_array = array(
                                    'std' => esc_attr($foodbakery_heading_size),
                                    'id' => '',
                                    'classes' => 'cs-range-input input-small',
                                    'extra_atr' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'foodbakery_heading_size[]',
                                    'extra_atr' => ' placeholder="' . foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_font_size') . '"',
                                    'return' => true,
                                    'required' => false,
                                    'rang' => true,
                                    'min' => 0,
                                    'max' => 50,
                                );
                                echo foodbakery_allow_special_char($foodbakery_var_form_fields->foodbakery_var_form_text_render($foodbakery_opt_array));
                                ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_letter_spacing')); ?></label>
                                <?php
                                if (function_exists('foodbakery_var_tooltip_helptext')) {
                                    echo foodbakery_var_tooltip_helptext(foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_letter_spacing_hint'));
                                }
                                ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <?php
                                $foodbakery_opt_array = array(
                                    'std' => esc_attr($foodbakery_letter_space),
                                    'id' => '',
                                    'classes' => 'cs-range-input input-small',
                                    'extra_atr' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'foodbakery_letter_space[]',
                                    'extra_atr' => ' placeholder="' . foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_letter_spacing') . '"',
                                    'return' => true,
                                    'required' => false,
                                    'rang' => true,
                                    'min' => 0,
                                    'max' => 50,
                                );
                                echo foodbakery_allow_special_char($foodbakery_var_form_fields->foodbakery_var_form_text_render($foodbakery_opt_array));
                                ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_line_height')); ?></label>
                                <?php
                                if (function_exists('foodbakery_var_tooltip_helptext')) {
                                    echo foodbakery_var_tooltip_helptext(foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_line_height_hint'));
                                }
                                ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <?php
                                $foodbakery_opt_array = array(
                                    'std' => esc_attr($foodbakery_line_height),
                                    'id' => '',
                                    'classes' => 'cs-range-input input-small',
                                    'extra_atr' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'foodbakery_line_height[]',
                                    'extra_atr' => ' placeholder="' . foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_line_height') . '"',
                                    'return' => true,
                                    'required' => false,
                                    'rang' => true,
                                    'min' => 0,
                                    'max' => 50,
                                );
                                echo foodbakery_allow_special_char($foodbakery_var_form_fields->foodbakery_var_form_text_render($foodbakery_opt_array));
                                ?>
                            </div>
                        </div>
                        <?php
                        $foodbakery_opt_array = array(
                            'name' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_heading_align'),
                            'desc' => '',
                            'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_heading_align_hint'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $foodbakery_heading_align,
                                'id' => '',
                                'cust_id' => '',
                                'cust_name' => 'foodbakery_heading_align[]',
                                'classes' => 'chosen-select select-medium',
                                'options' => array(
                                    'left' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_left'),
                                    'right' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_right'),
                                    'Center' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_center'),
                                ),
                                'return' => true,
                            ),
                        );
                        $foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);

                        $foodbakery_opt_array = array(
                            'name' => foodbakery_var_theme_text_srt('foodbakery_var_heading_color'),
                            'desc' => '',
                            'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_heading_color_hint'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => foodbakery_allow_special_char($foodbakery_heading_color),
                                'cust_id' => '',
                                'classes' => 'bg_color',
                                'cust_name' => 'foodbakery_heading_color[]',
                                'return' => true,
                            ),
                        );
                        $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

                        $foodbakery_opt_array = array(
                            'name' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_divider'),
                            'desc' => '',
                            'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_divider_hint'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $foodbakery_heading_divider,
                                'id' => '',
                                'cust_id' => '',
                                'cust_name' => 'foodbakery_heading_divider[]',
                                'classes' => 'dropdown chosen-select-no-single select-medium',
                                'options' => array(
                                    'on' => foodbakery_var_theme_text_srt('foodbakery_var_on'),
                                    'off' => foodbakery_var_theme_text_srt('foodbakery_var_off'),
                                ),
                                'return' => true,
                            ),
                        );
                        $foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);

                        $foodbakery_opt_array = array(
                            'name' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_font_style'),
                            'desc' => '',
                            'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_font_style_hint'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $foodbakery_heading_font_style,
                                'id' => '',
                                'cust_id' => '',
                                'cust_name' => 'foodbakery_heading_font_style[]',
                                'classes' => 'dropdown chosen-select-no-single select-medium',
                                'options' => array(
                                    'normal' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_normal'),
                                    'italic' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_italic'),
                                    'oblique' => foodbakery_var_theme_text_srt('foodbakery_var_heading_sc_oblique'),
                                ),
                                'return' => true,
                            ),
                        );
                        $foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
                        ?>

                    </div>
                    <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                        <ul class="form-elements insert-bg">
                            <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo str_replace('foodbakery_var_page_builder_', '', $name); ?>', '<?php echo esc_js($name . $foodbakery_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_insert')); ?></a> </li>
                        </ul>
                        <div id="results-shortocde"></div>
                        <?php
                    } else {
                        $foodbakery_opt_array = array(
                            'std' => 'heading',
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
        <?php
        if ($die <> 1) {
            die();
        }
    }

    add_action('wp_ajax_foodbakery_var_page_builder_heading', 'foodbakery_var_page_builder_heading');
}

if (!function_exists('foodbakery_save_page_builder_data_heading_callback')) {

    /**
     * Save data for heading shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_heading_callback($args) {

        $data = $args['data'];
        $shortcode_data = '';
        $counters = $args['counters'];
        $widget_type = $args['widget_type'];
        $column = $args['column'];
        if ($widget_type == "heading" || $widget_type == "cs_heading") {

            $foodbakery_var_heading = '';
            $page_element_size = $data['heading_element_size'][$counters['foodbakery_global_counter_heading']];
            $current_element_size = $data['heading_element_size'][$counters['foodbakery_global_counter_heading']];

            if (isset($data['foodbakery_widget_element_num'][$counters['foodbakery_counter']]) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode') {
                $shortcode_str = stripslashes(( $data['shortcode']['heading'][$counters['foodbakery_shortcode_counter_heading']]));
                $element_settings = 'heading_element_size="' . $current_element_size . '"';
                $reg = '/heading_element_size="(\d+)"/s';
                $shortcode_str = preg_replace($reg, $element_settings, $shortcode_str);
                $shortcode_data .= $shortcode_str;
                $counters['foodbakery_shortcode_counter_heading'] ++;
            } else {
                $foodbakery_var_heading = '[foodbakery_heading heading_element_size="' . htmlspecialchars($data['heading_element_size'][$counters['foodbakery_global_counter_heading']]) . '" ';
                if (isset($data['foodbakery_heading_title'][$counters['foodbakery_counter_heading']]) && $data['foodbakery_heading_title'][$counters['foodbakery_counter_heading']] != '') {
                    $foodbakery_var_heading .= 'foodbakery_heading_title="' . htmlspecialchars($data['foodbakery_heading_title'][$counters['foodbakery_counter_heading']], ENT_QUOTES) . '" ';
                }
                if (isset($data['foodbakery_heading_style'][$counters['foodbakery_counter_heading']]) && $data['foodbakery_heading_style'][$counters['foodbakery_counter_heading']] != '') {
                    $foodbakery_var_heading .= 'foodbakery_heading_style="' . htmlspecialchars($data['foodbakery_heading_style'][$counters['foodbakery_counter_heading']]) . '" ';
                }
                 if (isset($data['foodbakery_heading_option'][$counters['foodbakery_counter_heading']]) && $data['foodbakery_heading_option'][$counters['foodbakery_counter_heading']] != '') {
                    $foodbakery_var_heading .= 'foodbakery_heading_option="' . htmlspecialchars($data['foodbakery_heading_option'][$counters['foodbakery_counter_heading']]) . '" ';
                }
                if (isset($data['foodbakery_var_heading_align'][$counters['foodbakery_counter_heading']]) && $data['foodbakery_var_heading_align'][$counters['foodbakery_counter_heading']] != '') {
                    $foodbakery_var_heading .= 'foodbakery_var_heading_align="' . htmlspecialchars($data['foodbakery_var_heading_align'][$counters['foodbakery_counter_heading']]) . '" ';
                }
                if (isset($data['foodbakery_heading_size'][$counters['foodbakery_counter_heading']]) && $data['foodbakery_heading_size'][$counters['foodbakery_counter_heading']] != '') {
                    $foodbakery_var_heading .= 'foodbakery_heading_size="' . htmlspecialchars($data['foodbakery_heading_size'][$counters['foodbakery_counter_heading']], ENT_QUOTES) . '" ';
                }
                if (isset($data['foodbakery_letter_space'][$counters['foodbakery_counter_heading']]) && $data['foodbakery_letter_space'][$counters['foodbakery_counter_heading']] != '') {
                    $foodbakery_var_heading .= 'foodbakery_letter_space="' . htmlspecialchars($data['foodbakery_letter_space'][$counters['foodbakery_counter_heading']], ENT_QUOTES) . '" ';
                }
                if (isset($data['foodbakery_line_height'][$counters['foodbakery_counter_heading']]) && $data['foodbakery_line_height'][$counters['foodbakery_counter_heading']] != '') {
                    $foodbakery_var_heading .= 'foodbakery_line_height="' . htmlspecialchars($data['foodbakery_line_height'][$counters['foodbakery_counter_heading']], ENT_QUOTES) . '" ';
                }
                if (isset($data['foodbakery_heading_align'][$counters['foodbakery_counter_heading']]) && $data['foodbakery_heading_align'][$counters['foodbakery_counter_heading']] != '') {
                    $foodbakery_var_heading .= 'foodbakery_heading_align="' . htmlspecialchars($data['foodbakery_heading_align'][$counters['foodbakery_counter_heading']], ENT_QUOTES) . '" ';
                }
                if (isset($data['foodbakery_heading_view'][$counters['foodbakery_counter_heading']]) && $data['foodbakery_heading_view'][$counters['foodbakery_counter_heading']] != '') {
                    $foodbakery_var_heading .= 'foodbakery_heading_view="' . htmlspecialchars($data['foodbakery_heading_view'][$counters['foodbakery_counter_heading']], ENT_QUOTES) . '" ';
                }
                if (isset($data['foodbakery_heading_font_style'][$counters['foodbakery_counter_heading']]) && $data['foodbakery_heading_font_style'][$counters['foodbakery_counter_heading']] != '') {
                    $foodbakery_var_heading .= 'foodbakery_heading_font_style="' . htmlspecialchars($data['foodbakery_heading_font_style'][$counters['foodbakery_counter_heading']], ENT_QUOTES) . '" ';
                }
                if (isset($data['foodbakery_heading_divider'][$counters['foodbakery_counter_heading']]) && $data['foodbakery_heading_divider'][$counters['foodbakery_counter_heading']] != '') {
                    $foodbakery_var_heading .= 'foodbakery_heading_divider="' . htmlspecialchars($data['foodbakery_heading_divider'][$counters['foodbakery_counter_heading']]) . '" ';
                }
                if (isset($data['foodbakery_heading_color'][$counters['foodbakery_counter_heading']]) && $data['foodbakery_heading_color'][$counters['foodbakery_counter_heading']] != '') {
                    $foodbakery_var_heading .= 'foodbakery_heading_color="' . htmlspecialchars($data['foodbakery_heading_color'][$counters['foodbakery_counter_heading']], ENT_QUOTES) . '" ';
                }
                $foodbakery_var_heading .= ']';
                if (isset($data['heading_content'][$counters['foodbakery_counter_heading']]) && $data['heading_content'][$counters['foodbakery_counter_heading']] != '') {
                    $foodbakery_var_heading .= htmlspecialchars($data['heading_content'][$counters['foodbakery_counter_heading']], ENT_QUOTES);
                }
                $foodbakery_var_heading .= '[/foodbakery_heading]';
                $shortcode_data .= $foodbakery_var_heading;
                $counters['foodbakery_counter_heading'] ++;
            }
            $counters['foodbakery_global_counter_heading'] ++;
        }
        return array(
            'data' => $data,
            'counters' => $counters,
            'widget_type' => $widget_type,
            'column' => $shortcode_data,
        );
    }

    add_filter('foodbakery_save_page_builder_data_heading', 'foodbakery_save_page_builder_data_heading_callback');
}

if (!function_exists('foodbakery_load_shortcode_counters_heading_callback')) {

    /**
     * Populate heading shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_heading_callback($counters) {
        $counters['foodbakery_global_counter_heading'] = 0;
        $counters['foodbakery_shortcode_counter_heading'] = 0;
        $counters['foodbakery_counter_heading'] = 0;
        return $counters;
    }

    add_filter('foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_heading_callback');
}
if (!function_exists('foodbakery_shortcode_names_list_populate_heading_callback')) {

    /**
     * Populate heading shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_heading_callback($shortcode_array) {
        $shortcode_array['heading'] = array(
            'title' => foodbakery_var_frame_text_srt('foodbakery_var_heading'),
            'name' => 'heading',
            'icon' => 'icon-header',
            'categories' => 'contentblocks',
        );
        return $shortcode_array;
    }

    add_filter('foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_heading_callback');
}

if (!function_exists('foodbakery_element_list_populate_heading_callback')) {

    /**
     * Populate heading shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_heading_callback($element_list) {
        $element_list['heading'] = foodbakery_var_frame_text_srt('foodbakery_var_heading');
        return $element_list;
    }

    add_filter('foodbakery_element_list_populate', 'foodbakery_element_list_populate_heading_callback');
}
?>
