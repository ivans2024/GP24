<?php
/*
 *
 * @File : Flex column
 * @retrun
 *
 */

if ( ! function_exists( 'foodbakery_var_page_builder_editor' ) ) {

    function foodbakery_var_page_builder_editor( $die = 0 ) {
        global $foodbakery_node, $post, $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $PREFIX = 'foodbakery_editor';
        $counter = $_POST['counter'];
        $foodbakery_counter = $_POST['counter'];
        if ( isset( $_POST['action'] ) && ! isset( $_POST['shortcode_element_id'] ) ) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes( $shortcode_element_id );
            $parseObject = new ShortcodeParse();
            $output = $parseObject->foodbakery_shortcodes( $output, $shortcode_str, true, $PREFIX );
        }
        $defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_var_editor_title' => '',
            'foodbakery_var_editor_align' => '',
        );
        if ( isset( $output['0']['atts'] ) ) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }
        if ( isset( $output['0']['content'] ) ) {
            $foodbakery_var_editor_content = $output['0']['content'];
        } else {
            $foodbakery_var_editor_content = '';
        }
        $editor_element_size = '25';
        foreach ( $defaults as $key => $values ) {
            if ( isset( $atts[$key] ) )
                $$key = $atts[$key];
            else
                $$key = $values;
        }
        $name = 'foodbakery_var_page_builder_editor';
        $coloumn_class = 'column_' . $editor_element_size;
        $foodbakery_var_editor_title = isset( $foodbakery_var_editor_title ) ? $foodbakery_var_editor_title : '';
        $foodbakery_var_editor_align = isset( $foodbakery_var_editor_align ) ? $foodbakery_var_editor_align : '';

        if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        $strings = new foodbakery_theme_all_strings;
        $strings->foodbakery_short_code_strings();
        ?>
        <div id="<?php echo esc_attr( $name . $foodbakery_counter ) ?>_del" class="column  parentdelete <?php echo esc_attr( $coloumn_class ); ?>
             <?php echo esc_attr( $shortcode_view ); ?>" item="editor" data="<?php echo foodbakery_element_size_data_array_index( $editor_element_size ) ?>" >
                 <?php foodbakery_element_setting( $name, $foodbakery_counter, $editor_element_size, '', 'columns', $type = '' ); ?>
            <div class="cs-wrapp-class-<?php echo intval( $foodbakery_counter ) ?>
                 <?php echo esc_attr( $shortcode_element ); ?>" id="<?php echo esc_attr( $name . $foodbakery_counter ) ?>" data-shortcode-template="[foodbakery_editor {{attributes}}]{{content}}[/foodbakery_editor]" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_editor_options' ) ); ?></h5>
                    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo esc_js( $name . $foodbakery_counter ) ?>','<?php echo esc_js( $filter_element ); ?>')"
                       class="cs-btnclose"><i class="icon-times"></i>
                    </a>
                </div>
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
                                'std' => foodbakery_allow_special_char( $foodbakery_var_editor_title ),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'foodbakery_var_editor_title[]',
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
                                'std' => $foodbakery_var_editor_align,
                                'id' => '',
                                'cust_id' => 'foodbakery_var_editor_align',
                                'cust_name' => 'foodbakery_var_editor_align[]',
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
                            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_short_text' ),
                            'desc' => '',
                            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_short_text_hint' ),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_textarea( $foodbakery_var_editor_content ),
                                'cust_id' => '',
                                'classes' => 'textarea',
                                'cust_name' => 'foodbakery_var_editor_content[]',
                                'foodbakery_editor' => true,
                                'return' => true,
                                'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
                            ),
                        );

                        $foodbakery_var_html_fields->foodbakery_var_textarea_field( $foodbakery_opt_array );
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
                            'std' => 'editor',
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
                        echo foodbakery_allow_special_char( $foodbakery_var_form_fields->foodbakery_var_form_hidden_render( $foodbakery_opt_array ) );

                        $foodbakery_opt_array = array(
                            'name' => '',
                            'desc' => '',
                            'hint_text' => '',
                            'echo' => true,
                            'field_params' => array(
                                'std' => foodbakery_var_theme_text_srt( 'foodbakery_var_save' ),
                                'cust_id' => '',
                                'cust_type' => 'button',
                                'classes' => 'cs-admin-btn',
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

    add_action( 'wp_ajax_foodbakery_var_page_builder_editor', 'foodbakery_var_page_builder_editor' );
}

if ( ! function_exists( 'foodbakery_save_page_builder_data_editor_callback' ) ) {

    /**
     * Save data for editor shortcode.
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_editor_callback( $args ) {

        $data = $args['data'];
        $widget_type = $args['widget_type'];
        $counters = $args['counters'];
        $column = $args['column'];
        if ( $widget_type == "editor" || $widget_type == "cs_editor" ) {
            $page_element_size = $data['editor_element_size'][$counters['foodbakery_global_counter_editor']];
            $editor_element_size = $data['editor_element_size'][$counters['foodbakery_global_counter_editor']];

            if ( isset( $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] ) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode' ) {
                $shortcode_str = stripslashes( $data['shortcode']['editor'][$counters['foodbakery_shortcode_counter_editor']] );
                $element_settings = 'editor_element_size="' . $editor_element_size . '"';
                $reg = '/editor_element_size="(\d+)"/s';
                $shortcode_str = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
                $counters['foodbakery_shortcode_counter_editor'] ++;
            } else {
                $shortcode = '[foodbakery_editor editor_element_size="' . htmlspecialchars( $data['editor_element_size'][$counters['foodbakery_global_counter_editor']] ) . '" ';
                if ( isset( $data['foodbakery_var_editor_title'][$counters['foodbakery_counter_editor']] ) && $data['foodbakery_var_editor_title'][$counters['foodbakery_counter_editor']] != '' ) {
                    $shortcode .= 'foodbakery_var_editor_title="' . stripslashes( htmlspecialchars( ($data['foodbakery_var_editor_title'][$counters['foodbakery_counter_editor']] ), ENT_QUOTES ) ) . '" ';
                }
                if ( isset( $data['foodbakery_var_editor_align'][$counters['foodbakery_counter_editor']] ) && $data['foodbakery_var_editor_align'][$counters['foodbakery_counter_editor']] != '' ) {
                    $shortcode .= 'foodbakery_var_editor_align="' . stripslashes( htmlspecialchars( ($data['foodbakery_var_editor_align'][$counters['foodbakery_counter_editor']] ), ENT_QUOTES ) ) . '" ';
                }
                $shortcode .= ']';
                if ( isset( $data['foodbakery_var_editor_content'][$counters['foodbakery_counter_editor']] ) && $data['foodbakery_var_editor_content'][$counters['foodbakery_counter_editor']] != '' ) {
                    $shortcode .= htmlspecialchars( $data['foodbakery_var_editor_content'][$counters['foodbakery_counter_editor']], ENT_QUOTES ) . ' ';
                }
                $shortcode .= '[/foodbakery_editor]';
                $shortcode_data .= $shortcode;
                $counters['foodbakery_counter_editor'] ++;
            }
            $counters['foodbakery_global_counter_editor'] ++;
        }
        $return_data = array(
            'data' => $data,
            'counters' => $counters,
            'widget_type' => $widget_type,
            'column' => $shortcode_data,
        );
        return $return_data;
    }

    add_filter( 'foodbakery_save_page_builder_data_editor', 'foodbakery_save_page_builder_data_editor_callback' );
}

if ( ! function_exists( 'foodbakery_load_shortcode_counters_editor_callback' ) ) {

    /**
     * Populate editor shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_editor_callback( $counters ) {
        $counters['foodbakery_counter_editor'] = 0;
        $counters['foodbakery_shortcode_counter_editor'] = 0;
        $counters['foodbakery_global_counter_editor'] = 0;
        return $counters;
    }

    add_filter( 'foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_editor_callback' );
}
if ( ! function_exists( 'foodbakery_shortcode_names_list_populate_editor_callback' ) ) {

    /**
     * Populate editor shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_editor_callback( $shortcode_array ) {
        $shortcode_array['editor'] = array(
            'title' => foodbakery_var_frame_text_srt( 'foodbakery_var_editor' ),
            'name' => 'editor',
            'icon' => 'icon-clock-o',
            'categories' => 'typography',
        );
        return $shortcode_array;
    }

    add_filter( 'foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_editor_callback' );
}

if ( ! function_exists( 'foodbakery_element_list_populate_editor_callback' ) ) {

    /**
     * Populate editor shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_editor_callback( $element_list ) {
        $element_list['editor'] = foodbakery_var_frame_text_srt( 'foodbakery_var_editor' );
        return $element_list;
    }

    add_filter( 'foodbakery_element_list_populate', 'foodbakery_element_list_populate_editor_callback' );
}