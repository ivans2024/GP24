<?php
/*
 *
 * @File : Flex column
 * @retrun
 *
 */

if ( ! function_exists( 'foodbakery_var_page_builder_flex_column' ) ) {

    function foodbakery_var_page_builder_flex_column( $die = 0 ) {
        global $post, $foodbakery_node, $foodbakery_var_html_fields, $foodbakery_var_form_fields;

        if ( function_exists( 'foodbakery_shortcode_names' ) ) {
            $shortcode_element = '';
            $filter_element = 'filterdrag';
            $shortcode_view = '';
            $foodbakery_output = array();
            $FOODBAKERY_PREFIX = 'foodbakery_column';
            $counter = isset( $_POST['counter'] ) ? $_POST['counter'] : '';
            $foodbakery_counter = isset( $_POST['counter'] ) ? $_POST['counter'] : '';
            if ( isset( $_POST['action'] ) && ! isset( $_POST['shortcode_element_id'] ) ) {
                $FOODBAKERY_POSTID = '';
                $shortcode_element_id = '';
            } else {
                $FOODBAKERY_POSTID = isset( $_POST['POSTID'] ) ? $_POST['POSTID'] : '';
                $shortcode_element_id = isset( $_POST['shortcode_element_id'] ) ? $_POST['shortcode_element_id'] : '';
                $shortcode_str = stripslashes( $shortcode_element_id );
                $parseObject = new ShortcodeParse();
                $foodbakery_output = $parseObject->foodbakery_shortcodes( $foodbakery_output, $shortcode_str, true, $FOODBAKERY_PREFIX );
            }
            $defaults = array(
                'foodbakery_var_column_section_title' => '',
                'foodbakery_column_margin_left' => '',
                'foodbakery_column_margin_right' => '',
                'foodbakery_var_column_top_padding' => '',
                'foodbakery_var_column_bottom_padding' => '',
                'foodbakery_var_column_left_padding' => '',
                'foodbakery_var_column_right_padding' => '',
                'foodbakery_var_column_image_url_array' => '',
                'foodbakery_var_column_bg_color' => '',
                'foodbakery_var_column_title_color' => '',
                'foodbakery_var_flex_align' => '',
            );
            if ( isset( $foodbakery_output['0']['atts'] ) ) {
                $atts = $foodbakery_output['0']['atts'];
            } else {
                $atts = array();
            }
            if ( isset( $foodbakery_output['0']['content'] ) ) {
                $foodbakery_var_column_text = $foodbakery_output['0']['content'];
            } else {
                $foodbakery_var_column_text = '';
            }
            $flex_column_element_size = '25';
            foreach ( $defaults as $key => $values ) {
                if ( isset( $atts[$key] ) ) {
                    $$key = $atts[$key];
                } else {
                    $$key = $values;
                }
            }
            $name = 'foodbakery_var_page_builder_flex_column';
            $coloumn_class = 'column_' . $flex_column_element_size;

            $foodbakery_var_column_section_title = isset( $foodbakery_var_column_section_title ) ? $foodbakery_var_column_section_title : '';
            $foodbakery_column_margin_left = isset( $foodbakery_column_margin_left ) ? $foodbakery_column_margin_left : '';
            $foodbakery_column_margin_right = isset( $foodbakery_column_margin_right ) ? $foodbakery_column_margin_right : '';
            $foodbakery_var_column_top_padding = isset( $foodbakery_var_column_top_padding ) ? $foodbakery_var_column_top_padding : '';
            $foodbakery_var_column_bottom_padding = isset( $foodbakery_var_column_bottom_padding ) ? $foodbakery_var_column_bottom_padding : '';
            $foodbakery_var_column_left_padding = isset( $foodbakery_var_column_left_padding ) ? $foodbakery_var_column_left_padding : '';
            $foodbakery_var_column_right_padding = isset( $foodbakery_var_column_right_padding ) ? $foodbakery_var_column_right_padding : '';
            $foodbakery_var_column_image_url_array = isset( $foodbakery_var_column_image_url_array ) ? $foodbakery_var_column_image_url_array : '';
            $foodbakery_var_column_bg_color = isset( $foodbakery_var_column_bg_color ) ? $foodbakery_var_column_bg_color : '';
            $foodbakery_var_column_title_color = isset( $foodbakery_var_column_title_color ) ? $foodbakery_var_column_title_color : '';
            $foodbakery_var_flex_align = isset($foodbakery_var_flex_align) ? $foodbakery_var_flex_align : '';

            if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) {
                $shortcode_element = 'shortcode_element_class';
                $shortcode_view = 'cs-pbwp-shortcode';
                $filter_element = 'ajax-drag';
                $coloumn_class = '';
            }
            global $foodbakery_var_static_text;
            $strings = new foodbakery_theme_all_strings;
            $strings->foodbakery_short_code_strings();
            ?>
            <div id="<?php echo esc_attr( $name . $foodbakery_counter ) ?>_del" class="column  parentdelete <?php echo esc_attr( $coloumn_class ); ?>
                 <?php echo esc_attr( $shortcode_view ); ?>" item="flex_column" data="<?php echo foodbakery_element_size_data_array_index( $flex_column_element_size ) ?>" >
                     <?php foodbakery_element_setting( $name, $foodbakery_counter, $flex_column_element_size ) ?>
                <div class="cs-wrapp-class-<?php echo intval( $foodbakery_counter ) ?>
                     <?php echo esc_attr( $shortcode_element ); ?>" id="<?php echo esc_attr( $name . $foodbakery_counter ) ?>" data-shortcode-template="[foodbakery_column {{attributes}}]{{content}}[/foodbakery_column]" style="display: none;">
                    <div class="cs-heading-area" data-counter="<?php echo esc_attr( $foodbakery_counter ) ?>">
                        <h5><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_column_edit_options' ) ); ?></h5>
                        <a href="javascript:foodbakery_frame_removeoverlay('<?php echo esc_js( $name . $foodbakery_counter ) ?>','<?php echo esc_js( $filter_element ); ?>')" class="cs-btnclose">
                            <i class="icon-times"></i>
                        </a>
                    </div>
                    <div class="cs-pbwp-content">
                        <div class="cs-wrapp-clone cs-shortcode-wrapp">
                            <?php
                            if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) {
                                foodbakery_shortcode_element_size();
                            }

                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_column_field_title' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_column_field_title_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr( $foodbakery_var_column_section_title ),
                                    'cust_id' => 'foodbakery_var_column_section_title' . $foodbakery_counter,
                                    'classes' => '',
                                    'cust_name' => 'foodbakery_var_column_section_title[]',
                                    'return' => true,
                                ),
                            );
                            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_column_field_color_text' ),
                                'desc' => '',
                                'hint_text' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr( $foodbakery_var_column_title_color ),
                                    'cust_id' => 'foodbakery_var_column_title_color' . $foodbakery_counter,
                                    'classes' => 'bg_color',
                                    'cust_name' => 'foodbakery_var_column_title_color[]',
                                    'return' => true,
                                ),
                            );
                            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_title_alignment' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_title_alignment_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => $foodbakery_var_flex_align,
                                    'id' => '',
                                    'cust_id' => 'foodbakery_var_flex_align',
                                    'cust_name' => 'foodbakery_var_flex_align[]',
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
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_column_field_text' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_column_field_text_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr( $foodbakery_var_column_text ),
                                    'cust_id' => 'foodbakery_var_column_text' . $foodbakery_counter,
                                    'classes' => '',
                                    'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
                                    'cust_name' => 'foodbakery_var_column_text[]',
                                    'return' => true,
                                    'foodbakery_editor' => true,
                                ),
                            );
                            $foodbakery_var_html_fields->foodbakery_var_textarea_field( $foodbakery_opt_array );

                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_margin_left' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_margin_left_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr( $foodbakery_column_margin_left ),
                                    'cust_id' => 'foodbakery_column_margin_left' . $foodbakery_counter,
                                    'classes' => '',
                                    'cust_name' => 'foodbakery_column_margin_left[]',
                                    'return' => true,
                                ),
                            );
                            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_margin_right' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_margin_right_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr( $foodbakery_column_margin_right ),
                                    'cust_id' => 'foodbakery_column_margin_right' . $foodbakery_counter,
                                    'classes' => '',
                                    'cust_name' => 'foodbakery_column_margin_right[]',
                                    'return' => true,
                                ),
                            );
                            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_column_field_top_padding' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_column_field_top_padding_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr( $foodbakery_var_column_top_padding ),
                                    'cust_id' => 'foodbakery_var_column_top_padding' . $foodbakery_counter,
                                    'classes' => '',
                                    'cust_name' => 'foodbakery_var_column_top_padding[]',
                                    'return' => true,
                                ),
                            );
                            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_column_field_bottom_padding' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_column_field_bottom_padding_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr( $foodbakery_var_column_bottom_padding ),
                                    'cust_id' => 'foodbakery_var_column_bottom_padding' . $foodbakery_counter,
                                    'classes' => '',
                                    'cust_name' => 'foodbakery_var_column_bottom_padding[]',
                                    'return' => true,
                                ),
                            );
                            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_column_field_left_padding_text' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_column_field_left_padding_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr( $foodbakery_var_column_left_padding ),
                                    'cust_id' => 'foodbakery_var_column_left_padding' . $foodbakery_counter,
                                    'classes' => '',
                                    'cust_name' => 'foodbakery_var_column_left_padding[]',
                                    'return' => true,
                                ),
                            );
                            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_column_field_right_padding_text' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_column_field_right_padding_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr( $foodbakery_var_column_right_padding ),
                                    'cust_id' => 'foodbakery_var_column_right_padding' . $foodbakery_counter,
                                    'classes' => '',
                                    'cust_name' => 'foodbakery_var_column_right_padding[]',
                                    'return' => true,
                                ),
                            );
                            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                            $foodbakery_opt_array = array(
                                'std' => esc_attr( $foodbakery_var_column_image_url_array ),
                                'id' => 'column_image_url',
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_column_field_image_text' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_column_field_image_hint' ),
                                'echo' => true,
                                'array' => true,
                                'prefix' => '',
                                'field_params' => array(
                                    'std' => esc_attr( $foodbakery_var_column_image_url_array ),
                                    'id' => 'column_image_url',
                                    'return' => true,
                                    'array' => true,
                                    'array_txt' => false,
                                    'prefix' => '',
                                ),
                            );

                            $foodbakery_var_html_fields->foodbakery_var_upload_file_field( $foodbakery_opt_array );

                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_column_field_background_color_text' ),
                                'desc' => '',
                                'hint_text' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr( $foodbakery_var_column_bg_color ),
                                    'cust_id' => 'foodbakery_var_column_bg_color' . $foodbakery_counter,
                                    'classes' => 'bg_color',
                                    'cust_name' => 'foodbakery_var_column_bg_color[]',
                                    'return' => true,
                                ),
                            );
                            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );
                            ?>
                        </div>
                        <?php if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) { ?>
                            <ul class="form-elements insert-bg">
                                <li class="to-field">
                                    <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo str_replace( 'foodbakery_var_page_builder_', '', $name ); ?>', '<?php echo esc_js( $name . $foodbakery_counter ) ?>', '<?php echo esc_js( $filter_element ); ?>')" ><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_insert' ) ); ?></a>
                                </li>
                            </ul>
                            <div id="results-shortocde"></div>
                            <?php
                        } else {
                            $foodbakery_opt_array = array(
                                'std' => 'flex_column',
                                'id' => '',
                                'before' => '',
                                'after' => '',
                                'classes' => '',
                                'extra_atr' => '',
                                'cust_id' => 'foodbakery_orderby' . $foodbakery_counter,
                                'cust_name' => 'foodbakery_orderby[]',
                                'required' => false
                            );
                            $foodbakery_var_form_fields->foodbakery_var_form_hidden_render( $foodbakery_opt_array );

                            $foodbakery_opt_array = array(
                                'name' => '',
                                'desc' => '',
                                'hint_text' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => foodbakery_var_theme_text_srt( 'foodbakery_var_save' ),
                                    'cust_id' => 'flex_column_save' . $foodbakery_counter,
                                    'cust_type' => 'button',
                                    'classes' => 'cs-foodbakery-admin-btn',
                                    'cust_name' => 'flex_column_save',
                                    'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
                                    'return' => true,
                                ),
                            );

                            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );
                        }
                        ?>
                    </div>
                </div>
            </div>

            <?php
        }
        if ( $die <> 1 ) {
            die();
        }
    }

    add_action( 'wp_ajax_foodbakery_var_page_builder_flex_column', 'foodbakery_var_page_builder_flex_column' );
}

if ( ! function_exists( 'foodbakery_save_page_builder_data_flex_column_callback' ) ) {

    /**
     * Save data for flex column shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_flex_column_callback( $args ) {
        $shortcode_data = '';
        $data = $args['data'];
        $counters = $args['counters'];
        $widget_type = $args['widget_type'];
        $column = $args['column'];
        if ( $widget_type == "flex_column" || $widget_type == "cs_flex_column" ) {
            $shortcode = '';
            $page_element_size = $data['flex_column_element_size'][$counters['foodbakery_global_counter_column']];
            $current_element_size = $data['flex_column_element_size'][$counters['foodbakery_global_counter_column']];

            if ( isset( $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] ) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode' ) {
                $shortcode_str = stripslashes( ( $data['shortcode']['flex_column'][$counters['foodbakery_shortcode_counter_column']] ) );
                $element_settings = 'flex_column_element_size="' . $current_element_size . '"';
                $reg = '/flex_column_element_size="(\d+)"/s';
                $shortcode_str = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
                $counters['foodbakery_shortcode_counter_column'] ++;
            } else {
                $shortcode = '[foodbakery_column flex_column_element_size="' . htmlspecialchars( $data['flex_column_element_size'][$counters['foodbakery_global_counter_column']] ) . '" ';
                if ( isset( $data['foodbakery_var_column_section_title'][$counters['foodbakery_counter_column']] ) && $data['foodbakery_var_column_section_title'][$counters['foodbakery_counter_column']] != '' ) {
                    $shortcode .= 'foodbakery_var_column_section_title="' . stripslashes( htmlspecialchars( ($data['foodbakery_var_column_section_title'][$counters['foodbakery_counter_column']] ), ENT_QUOTES ) ) . '" ';
                }
                if ( isset( $data['foodbakery_var_flex_align'][$counters['foodbakery_counter_column']] ) && $data['foodbakery_var_flex_align'][$counters['foodbakery_counter_column']] != '' ) {
                    $shortcode .= 'foodbakery_var_flex_align="' . stripslashes( htmlspecialchars( ($data['foodbakery_var_flex_align'][$counters['foodbakery_counter_column']] ), ENT_QUOTES ) ) . '" ';
                }
                if ( isset( $data['foodbakery_column_margin_left'][$counters['foodbakery_counter_column']] ) && $data['foodbakery_column_margin_left'][$counters['foodbakery_counter_column']] != '' ) {
                    $shortcode .= 'foodbakery_column_margin_left="' . stripslashes( htmlspecialchars( ($data['foodbakery_column_margin_left'][$counters['foodbakery_counter_column']] ), ENT_QUOTES ) ) . '" ';
                }
                if ( isset( $data['foodbakery_column_margin_right'][$counters['foodbakery_counter_column']] ) && $data['foodbakery_column_margin_right'][$counters['foodbakery_counter_column']] != '' ) {
                    $shortcode .= 'foodbakery_column_margin_right="' . stripslashes( htmlspecialchars( ($data['foodbakery_column_margin_right'][$counters['foodbakery_counter_column']] ), ENT_QUOTES ) ) . '" ';
                }
                if ( isset( $data['foodbakery_var_column_top_padding'][$counters['foodbakery_counter_column']] ) && $data['foodbakery_var_column_top_padding'][$counters['foodbakery_counter_column']] != '' ) {
                    $shortcode .= 'foodbakery_var_column_top_padding="' . stripslashes( htmlspecialchars( ($data['foodbakery_var_column_top_padding'][$counters['foodbakery_counter_column']] ), ENT_QUOTES ) ) . '" ';
                }
                if ( isset( $data['foodbakery_var_column_bottom_padding'][$counters['foodbakery_counter_column']] ) && $data['foodbakery_var_column_bottom_padding'][$counters['foodbakery_counter_column']] != '' ) {
                    $shortcode .= 'foodbakery_var_column_bottom_padding="' . stripslashes( htmlspecialchars( ($data['foodbakery_var_column_bottom_padding'][$counters['foodbakery_counter_column']] ), ENT_QUOTES ) ) . '" ';
                }
                if ( isset( $data['foodbakery_var_column_left_padding'][$counters['foodbakery_counter_column']] ) && $data['foodbakery_var_column_left_padding'][$counters['foodbakery_counter_column']] != '' ) {
                    $shortcode .= 'foodbakery_var_column_left_padding="' . stripslashes( htmlspecialchars( ($data['foodbakery_var_column_left_padding'][$counters['foodbakery_counter_column']] ), ENT_QUOTES ) ) . '" ';
                }
                if ( isset( $data['foodbakery_var_column_right_padding'][$counters['foodbakery_counter_column']] ) && $data['foodbakery_var_column_right_padding'][$counters['foodbakery_counter_column']] != '' ) {
                    $shortcode .= 'foodbakery_var_column_right_padding="' . stripslashes( htmlspecialchars( ($data['foodbakery_var_column_right_padding'][$counters['foodbakery_counter_column']] ), ENT_QUOTES ) ) . '" ';
                }
                if ( isset( $data['foodbakery_var_column_image_url_array'][$counters['foodbakery_counter_column']] ) && $data['foodbakery_var_column_image_url_array'][$counters['foodbakery_counter_column']] != '' ) {
                    $shortcode .= 'foodbakery_var_column_image_url_array="' . htmlspecialchars( $data['foodbakery_var_column_image_url_array'][$counters['foodbakery_counter_column']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_column_title_color'][$counters['foodbakery_counter_column']] ) && $data['foodbakery_var_column_title_color'][$counters['foodbakery_counter_column']] != '' ) {
                    $shortcode .= 'foodbakery_var_column_title_color="' . htmlspecialchars( $data['foodbakery_var_column_title_color'][$counters['foodbakery_counter_column']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_column_bg_color'][$counters['foodbakery_counter_column']] ) && $data['foodbakery_var_column_bg_color'][$counters['foodbakery_counter_column']] != '' ) {
                    $shortcode .= 'foodbakery_var_column_bg_color="' . htmlspecialchars( $data['foodbakery_var_column_bg_color'][$counters['foodbakery_counter_column']], ENT_QUOTES ) . '" ';
                }
                $shortcode .= ']';
                if ( isset( $data['foodbakery_var_column_text'][$counters['foodbakery_counter_column']] ) && $data['foodbakery_var_column_text'][$counters['foodbakery_counter_column']] != '' ) {
                    $shortcode .= htmlspecialchars( $data['foodbakery_var_column_text'][$counters['foodbakery_counter_column']], ENT_QUOTES ) . ' ';
                }
                $shortcode .= '[/foodbakery_column]';
                $shortcode_data .= $shortcode;
                $counters['foodbakery_counter_column'] ++;
            }
            $counters['foodbakery_global_counter_column'] ++;
        }
        return array(
            'data' => $data,
            'counters' => $counters,
            'widget_type' => $widget_type,
            'column' => $shortcode_data,
        );
    }

    add_filter( 'foodbakery_save_page_builder_data_flex_column', 'foodbakery_save_page_builder_data_flex_column_callback' );
}

if ( ! function_exists( 'foodbakery_load_shortcode_counters_flex_column_callback' ) ) {

    /**
     * Populate flex column shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_flex_column_callback( $counters ) {
        $counters['foodbakery_global_counter_column'] = 0;
        $counters['foodbakery_shortcode_counter_column'] = 0;
        $counters['foodbakery_counter_column'] = 0;
        return $counters;
    }

    add_filter( 'foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_flex_column_callback' );
}

if ( ! function_exists( 'foodbakery_shortcode_names_list_populate_flex_column_callback' ) ) {

    /**
     * Populate flex column shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_flex_column_callback( $shortcode_array ) {
        $shortcode_array['flex_column'] = array(
            'title' => foodbakery_var_frame_text_srt( 'foodbakery_var_column' ),
            'name' => 'flex_column',
            'icon' => 'icon-columns',
            'categories' => 'typography',
        );
        return $shortcode_array;
    }

    add_filter( 'foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_flex_column_callback' );
}

if ( ! function_exists( 'foodbakery_element_list_populate_flex_column_callback' ) ) {

    /**
     * Populate flex column shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_flex_column_callback( $element_list ) {
        $element_list['flex_column'] = foodbakery_var_frame_text_srt( 'foodbakery_var_column' );
        return $element_list;
    }

    add_filter( 'foodbakery_element_list_populate', 'foodbakery_element_list_populate_flex_column_callback' );
}