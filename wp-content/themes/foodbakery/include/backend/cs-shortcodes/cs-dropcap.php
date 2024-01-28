<?php
/**
 * dropcaps html form for page builder
 */
if ( ! function_exists( 'foodbakery_var_page_builder_dropcap' ) ) {

    function foodbakery_var_page_builder_dropcap( $die = 0 ) {
        global $foodbakery_node, $count_node, $post, $foodbakery_var_html_fields, $foodbakery_var_form_fields;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $foodbakery_counter = $_POST['counter'];
        if ( isset( $_POST['action'] ) && ! isset( $_POST['shortcode_element_id'] ) ) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes( $shortcode_element_id );
            $FOODBAKERY_PREFIX = 'foodbakery_dropcap';
            $parseObject = new ShortcodeParse();
            $output = $parseObject->foodbakery_shortcodes( $output, $shortcode_str, true, $FOODBAKERY_PREFIX );
        }
        $defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_dropcap_section_title' => '',
            'foodbakery_var_drop_align' => '',
        );
        if ( isset( $output['0']['atts'] ) ) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }

        if ( isset( $output['0']['content'] ) ) {
            $dropcaps_content = $output['0']['content'];
        } else {
            $dropcaps_content = '';
        }

        $dropcap_element_size = '100';
        foreach ( $defaults as $key => $values ) {
            if ( isset( $atts[$key] ) ) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'foodbakery_var_page_builder_dropcap';
        $coloumn_class = 'column_' . $dropcap_element_size;
        $foodbakery_dropcap_section_title = isset( $foodbakery_dropcap_section_title ) ? $foodbakery_dropcap_section_title : '';
        $foodbakery_var_drop_align = isset( $foodbakery_var_drop_align ) ? $foodbakery_var_drop_align : '';

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
             <?php echo esc_attr( $shortcode_view ); ?>" item="dropcap" data="<?php echo foodbakery_element_size_data_array_index( $dropcap_element_size ) ?>" >
                 <?php foodbakery_element_setting( $name, $foodbakery_counter, $dropcap_element_size ) ?>
            <div class="cs-wrapp-class-<?php echo esc_attr( $foodbakery_counter ); ?> <?php echo esc_attr( $shortcode_element ); ?>" id="<?php echo esc_attr( $name . $foodbakery_counter ) ?>" data-shortcode-template="[foodbakery_dropcap {{attributes}}]{{content}}[/foodbakery_dropcap]" style="display: none;"">
                <div class="cs-heading-area">
                    <h5><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_dropcap_edit' ) ); ?></h5>
                    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo esc_js( $name . $foodbakery_counter ) ?>','<?php echo esc_js( $filter_element ); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp">

                        <?php
                        if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) {
                            foodbakery_shortcode_element_size();
                        }
                        $foodbakery_opt_array = array(
                            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_element_title' ),
                            'desc' => '',
                            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_element_title_hint' ),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html( $foodbakery_dropcap_section_title ),
                                'id' => 'foodbakery_dropcap_section_title',
                                'cust_name' => 'foodbakery_dropcap_section_title[]',
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
                                'std' => $foodbakery_var_drop_align,
                                'id' => '',
                                'cust_id' => 'foodbakery_var_drop_align',
                                'cust_name' => 'foodbakery_var_drop_align[]',
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
                            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_dropcaps_content_field_text' ),
                            'desc' => '',
                            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_dropcaps_content_field_hint' ),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr( $dropcaps_content ),
                                'cust_id' => 'dropcaps_content',
                                'classes' => '',
                                'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
                                'cust_name' => 'dropcaps_content[]',
                                'return' => true,
                                'foodbakery_editor' => true,
                            ),
                        );
                        $foodbakery_var_html_fields->foodbakery_var_textarea_field( $foodbakery_opt_array );
                        ?>

                    </div>
                    <?php if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) { ?>
                        <ul class="form-elements insert-bg">
                            <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo esc_js( str_replace( 'foodbakery_var_page_builder_', '', $name ) ); ?>', '<?php echo esc_js( $name . $foodbakery_counter ); ?>', '<?php echo esc_js( $filter_element ); ?>')" ><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_insert' ) ); ?></a> </li>
                        </ul>
                        <div id="results-shortocde"></div>
                    <?php } else { ?>
                        <?php
                        $foodbakery_opt_array = array(
                            'std' => 'dropcap',
                            'id' => '',
                            'before' => '',
                            'after' => '',
                            'extra_atr' => '',
                            'cust_id' => '',
                            'cust_name' => 'foodbakery_orderby[]',
                            'return' => false,
                            'required' => false
                        );
                        $foodbakery_var_html_fields->foodbakery_var_form_hidden_render( $foodbakery_opt_array );

                        $foodbakery_opt_array = array(
                            'name' => '',
                            'desc' => '',
                            'hint_text' => '',
                            'echo' => true,
                            'field_params' => array(
                                'std' => foodbakery_var_theme_text_srt( 'foodbakery_var_save' ),
                                'cust_id' => '',
                                'cust_type' => 'button',
                                'classes' => 'cs-foodbakery-admin-btn',
                                'cust_name' => '',
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
        if ( $die <> 1 ) {
            die();
        }
    }

    add_action( 'wp_ajax_foodbakery_var_page_builder_dropcap', 'foodbakery_var_page_builder_dropcap' );
}

if ( ! function_exists( 'foodbakery_save_page_builder_data_dropcap_callback' ) ) {

    /**
     * Save data for dropcap shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_dropcap_callback( $args ) {

        $data = $args['data'];
        $counters = $args['counters'];
        $widget_type = $args['widget_type'];
        $column = $args['column'];
        if ( $widget_type == "dropcap" || $widget_type == "cs_dropcap" ) {

            $shortcode = '';
            $page_element_size = $data['dropcap_element_size'][$counters['foodbakery_global_counter_dropcap']];
            $current_element_size = $data['dropcap_element_size'][$counters['foodbakery_global_counter_dropcap']];

            if ( isset( $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] ) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode' ) {
                $shortcode_str = stripslashes( ( $data['shortcode']['dropcap'][$counters['foodbakery_shortcode_counter_dropcap']] ) );
                $element_settings = 'dropcap_element_size="' . $current_element_size . '"';
                $reg = '/dropcap_element_size="(\d+)"/s';
                $shortcode_str = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
                $counters['foodbakery_shortcode_counter_dropcap'] ++;
            } else {
                $shortcode = '[foodbakery_dropcap dropcap_element_size="' . htmlspecialchars( $data['dropcap_element_size'][$counters['foodbakery_global_counter_dropcap']] ) . '" ';
                if ( isset( $data['foodbakery_dropcap_section_title'][$counters['foodbakery_counter_dropcap']] ) && $data['foodbakery_dropcap_section_title'][$counters['foodbakery_counter_dropcap']] != '' ) {
                    $shortcode .= 'foodbakery_dropcap_section_title="' . stripslashes( htmlspecialchars( ($data['foodbakery_dropcap_section_title'][$counters['foodbakery_counter_dropcap']] ), ENT_QUOTES ) ) . '" ';
                }
                if ( isset( $data['foodbakery_var_drop_align'][$counters['foodbakery_counter_dropcap']] ) && $data['foodbakery_var_drop_align'][$counters['foodbakery_counter_dropcap']] != '' ) {
                    $shortcode .= 'foodbakery_var_drop_align="' . stripslashes( htmlspecialchars( ($data['foodbakery_var_drop_align'][$counters['foodbakery_counter_dropcap']] ), ENT_QUOTES ) ) . '" ';
                }
                $shortcode .= ']';
                if ( isset( $data['dropcaps_content'][$counters['foodbakery_counter_dropcap']] ) && $data['dropcaps_content'][$counters['foodbakery_counter_dropcap']] != '' ) {
                    $shortcode .= htmlspecialchars( $data['dropcaps_content'][$counters['foodbakery_counter_dropcap']], ENT_QUOTES ) . ' ';
                }
                $shortcode .= '[/foodbakery_dropcap]';
                $shortcode_data .= $shortcode;
                $counters['foodbakery_counter_dropcap'] ++;
            }
            $counters['foodbakery_global_counter_dropcap'] ++;
        }
        return array(
            'data' => $data,
            'counters' => $counters,
            'widget_type' => $widget_type,
            'column' => $shortcode_data,
        );
    }

    add_filter( 'foodbakery_save_page_builder_data_dropcap', 'foodbakery_save_page_builder_data_dropcap_callback' );
}

if ( ! function_exists( 'foodbakery_load_shortcode_counters_dropcap_callback' ) ) {

    /**
     * Populate dropcap shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_dropcap_callback( $counters ) {
        $counters['foodbakery_counter_dropcap'] = 0;
        $counters['foodbakery_shortcode_counter_dropcap'] = 0;
        $counters['foodbakery_global_counter_dropcap'] = 0;
        return $counters;
    }

    add_filter( 'foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_dropcap_callback' );
}
if ( ! function_exists( 'foodbakery_shortcode_names_list_populate_dropcap_callback' ) ) {

    /**
     * Populate dropcap shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_dropcap_callback( $shortcode_array ) {
        $shortcode_array['dropcap'] = array(
            'title' => foodbakery_var_frame_text_srt( 'foodbakery_var_dropcap' ),
            'name' => 'dropcap',
            'icon' => 'icon-comments-o',
            'categories' => 'typography',
        );
        return $shortcode_array;
    }

    add_filter( 'foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_dropcap_callback' );
}

if ( ! function_exists( 'foodbakery_element_list_populate_dropcap_callback' ) ) {

    /**
     * Populate dropcap shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_dropcap_callback( $element_list ) {
        $element_list['dropcap'] = foodbakery_var_frame_text_srt( 'foodbakery_var_dropcap' );
        return $element_list;
    }

    add_filter( 'foodbakery_element_list_populate', 'foodbakery_element_list_populate_dropcap_callback' );
}