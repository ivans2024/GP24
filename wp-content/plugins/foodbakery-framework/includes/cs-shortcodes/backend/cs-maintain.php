<?php
/*
 *
 * @File : Call to action
 * @retrun
 *
 */

if ( ! function_exists( 'foodbakery_var_page_builder_maintenance' ) ) {

    function foodbakery_var_page_builder_maintenance( $die = 0 ) {

        global $post, $foodbakery_node, $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;

        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $FOODBAKERY_BARBER_PREFIX = 'maintenance';
        $foodbakery_counter = isset( $_POST['counter'] ) ? $_POST['counter'] : '';
        $parseObject = new ShortcodeParse();
        foodbakery_var_date_picker();
        if ( isset( $_POST['action'] ) && ! isset( $_POST['shortcode_element_id'] ) ) {
            $FOODBAKERY_POSTID = '';
            $shortcode_element_id = '';
        } else {
            $FOODBAKERY_POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $foodbakery_var_shortcode_str = stripslashes( $shortcode_element_id );
            $output = $parseObject->foodbakery_shortcodes( $output, $foodbakery_var_shortcode_str, true, $FOODBAKERY_BARBER_PREFIX );
        }
        $defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_var_maintenance_time_left' => '',
            'foodbakery_var_maintainance_logo_array' => '',
            'foodbakery_var_maintainance_image_array' => '',
            'foodbakery_var_lunch_date' => '',
        );
        if ( isset( $output['0']['atts'] ) ) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }
        if ( isset( $output['0']['content'] ) )
            $maintenance_column_text = $output['0']['content'];
        else
            $maintenance_column_text = "";
        $maintenance_element_size = '100';
        foreach ( $defaults as $key => $values ) {
            if ( isset( $atts[$key] ) ) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }

        $name = 'foodbakery_var_page_builder_maintenance';
        $coloumn_class = 'column_' . $maintenance_element_size;

        $foodbakery_var_maintenance_image_url_array = isset( $foodbakery_var_maintenance_image_url_array ) ? $foodbakery_var_maintenance_image_url_array : '';
        $foodbakery_var_call_action_subtitle = isset( $foodbakery_var_call_action_subtitle ) ? $foodbakery_var_call_action_subtitle : '';
        $foodbakery_var_heading_color = isset( $foodbakery_var_heading_color ) ? $foodbakery_var_heading_color : '';
        $foodbakery_var_maintenance_icon_background_color = isset( $foodbakery_var_maintenance_icon_background_color ) ? $foodbakery_var_maintenance_icon_background_color : '';
        $foodbakery_var_maintenance_button_text = isset( $foodbakery_var_maintenance_button_text ) ? $foodbakery_var_maintenance_button_text : '';
        $foodbakery_var_maintenance_button_link = isset( $foodbakery_var_maintenance_button_link ) ? $foodbakery_var_maintenance_button_link : '';
        $foodbakery_var_contents_bg_color = isset( $foodbakery_var_contents_bg_color ) ? $foodbakery_var_contents_bg_color : '';
        $foodbakery_var_maintenance_img_array = isset( $foodbakery_var_maintenance_img_array ) ? $foodbakery_var_maintenance_img_array : '';
        $foodbakery_var_call_action_text_align = isset( $foodbakery_var_call_action_text_align ) ? $foodbakery_var_call_action_text_align : '';
        $foodbakery_var_call_action_img_align = isset( $foodbakery_var_call_action_img_align ) ? $foodbakery_var_call_action_img_align : '';
        $foodbakery_var_button_bg_color = isset( $foodbakery_var_button_bg_color ) ? $foodbakery_var_button_bg_color : '';
        $foodbakery_var_button_border_color = isset( $foodbakery_var_button_border_color ) ? $foodbakery_var_button_border_color : '';

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
             <?php echo esc_attr( $shortcode_view ); ?>" item="maintenance" data="<?php echo foodbakery_element_size_data_array_index( $maintenance_element_size ) ?>" >
                 <?php foodbakery_element_setting( $name, $foodbakery_counter, $maintenance_element_size ) ?>
            <div class="cs-wrapp-class-<?php echo intval( $foodbakery_counter ) ?>
                 <?php echo esc_attr( $shortcode_element ); ?>" id="<?php echo esc_attr( $name . $foodbakery_counter ) ?>" data-shortcode-template="[maintenance {{attributes}}]{{content}}[/maintenance]" style="display: none;">
                <div class="cs-heading-area" data-counter="<?php echo esc_attr( $foodbakery_counter ) ?>">
                    <h5><?php echo esc_html( foodbakery_var_frame_text_srt( 'foodbakery_var_edit_maintenance_page' ) ); ?></h5>
                    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo esc_js( $name . $foodbakery_counter ) ?>','<?php echo esc_js( $filter_element ); ?>')" class="cs-btnclose">
                        <i class="icon-times"></i>
                    </a>
                </div> 
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content">
                        <?php
                        if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) {
                            foodbakery_shortcode_element_size();
                        }

                        $foodbakery_opt_array = array(
                            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_sc_text' ),
                            'desc' => '',
                            'hint_text' => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_sc_text_hint' ),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr( $maintenance_column_text ),
                                'cust_id' => 'maintenance_column_text' . $foodbakery_counter,
                                'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
                                'classes' => '',
                                'cust_name' => 'maintenance_column_text[]',
                                'return' => true,
                                'foodbakery_editor' => true
                            ),
                        );
                        $foodbakery_var_html_fields->foodbakery_var_textarea_field( $foodbakery_opt_array );

                        $foodbakery_opt_array = array(
                            'std' => $foodbakery_var_maintainance_logo_array,
                            'id' => 'maintainance_logo',
                            'main_id' => 'maintainance_logo_id',
                            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_logo' ),
                            'desc' => '',
                            'hint_text' => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_sc_logo_hint' ),
                            'echo' => true,
                            'array' => true,
                            'field_params' => array(
                                'std' => $foodbakery_var_maintainance_logo_array,
                                'cust_id' => '',
                                'id' => 'maintainance_logo',
                                'return' => true,
                                'array' => true,
                                'array_txt' => false,
                            ),
                        );
                        $foodbakery_var_html_fields->foodbakery_var_upload_file_field( $foodbakery_opt_array );
                        
                        $foodbakery_opt_array = array(
                            'std' => $foodbakery_var_maintainance_image_array,
                            'id' => 'maintainance_image',
                            'main_id' => 'maintainance_image_id',
                            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_image' ),
                            'desc' => '',
                            'hint_text' => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_sc_image_hint' ),
                            'echo' => true,
                            'array' => true,
                            'field_params' => array(
                                'std' => $foodbakery_var_maintainance_image_array,
                                'cust_id' => '',
                                'id' => 'maintainance_image',
                                'return' => true,
                                'array' => true,
                                'array_txt' => false,
                            ),
                        );
                        $foodbakery_var_html_fields->foodbakery_var_upload_file_field( $foodbakery_opt_array );

                        $foodbakery_opt_array = array(
                            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_sc_launch_date' ),
                            'desc' => '',
                            'hint_text' => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_sc_launch_date_hint' ),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $foodbakery_var_lunch_date,
                                'cust_id' => 'foodbakery_var_lunch_date' . $foodbakery_counter,
                                'classes' => '',
                                'id' => 'lunch_date',
                                'cust_name' => 'foodbakery_var_lunch_date[]',
                                'return' => true,
                            ),
                        );

                        $foodbakery_var_html_fields->foodbakery_var_date_field( $foodbakery_opt_array );
                        ?>

                    </div>
                    <?php if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) { ?>

                        <ul class="form-elements insert-bg">
                            <li class="to-field">
                                <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo str_replace( 'foodbakery_var_page_builder_', '', $name ); ?>', '<?php echo esc_js( $name . $foodbakery_counter ) ?>', '<?php echo esc_js( $filter_element ); ?>')" ><?php echo esc_html( foodbakery_var_frame_text_srt( 'foodbakery_var_insert' ) ); ?></a>
                            </li>
                            <div id="results-shortocde"></div>
                            <?php
                        } else {
                            $foodbakery_opt_array = array(
                                'std' => 'maintenance',
                                'id' => '',
                                'before' => '',
                                'after' => '',
                                'classes' => '',
                                'extra_atr' => '',
                                'cust_id' => 'foodbakery_orderby',
                                'cust_name' => 'foodbakery_orderby[]',
                                'return' => false,
                                'required' => false
                            );
                            $foodbakery_var_form_fields->foodbakery_var_form_hidden_render( $foodbakery_opt_array );

                            $foodbakery_opt_array = array(
                                'name' => '',
                                'desc' => '',
                                'hint_text' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_sc_save' ),
                                    'cust_id' => '',
                                    'cust_type' => 'button',
                                    'classes' => 'cs-barber-admin-btn',
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

    add_action( 'wp_ajax_foodbakery_var_page_builder_maintenance', 'foodbakery_var_page_builder_maintenance' );
}

if ( ! function_exists( 'foodbakery_save_page_builder_data_maintenance_callback' ) ) {

    /**
     * Save data for call to action shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_maintenance_callback( $args ) {

        $data = $args['data'];
        $counters = $args['counters'];
        $widget_type = $args['widget_type'];
        $column = $args['column'];
        if ( $widget_type == "maintenance" || $widget_type == "cs_maintenance" ) {

            $shortcode = '';

            $page_element_size = $data['maintenance_element_size'][$counters['foodbakery_global_counter_maintenance']];
            $cta_element_size = $data['maintenance_element_size'][$counters['foodbakery_global_counter_maintenance']];

            if ( isset( $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] ) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode' ) {
                $shortcode_str = stripslashes( ( $data['shortcode']['maintenance'][$counters['foodbakery_shortcode_counter_maintenance']] ) );

                $element_settings = 'maintenance_element_size="' . $cta_element_size . '"';
                $reg = '/maintenance_element_size="(\d+)"/s';
                $shortcode_str = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;

                $counters['foodbakery_shortcode_counter_maintenance'] ++;
            } else {
                $shortcode = '[maintenance maintenance_element_size="' . htmlspecialchars( $data['maintenance_element_size'][$counters['foodbakery_global_counter_maintenance']] ) . '" ';

                if ( isset( $data['foodbakery_var_maintenance_time_left'][$counters['foodbakery_counter_maintenance']] ) && $data['foodbakery_var_maintenance_time_left'][$counters['foodbakery_counter_maintenance']] != '' ) {
                    $shortcode .= 'foodbakery_var_maintenance_time_left="' . htmlspecialchars( $data['foodbakery_var_maintenance_time_left'][$counters['foodbakery_counter_maintenance']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_maintainance_logo_array'][$counters['foodbakery_counter_maintenance']] ) && $data['foodbakery_var_maintainance_logo_array'][$counters['foodbakery_counter_maintenance']] != '' ) {
                    $shortcode .= 'foodbakery_var_maintainance_logo_array="' . stripslashes( htmlspecialchars( ($data['foodbakery_var_maintainance_logo_array'][$counters['foodbakery_counter_maintenance']] ), ENT_QUOTES ) ) . '" ';
                }
                if ( isset( $data['foodbakery_var_maintainance_image_array'][$counters['foodbakery_counter_maintenance']] ) && $data['foodbakery_var_maintainance_image_array'][$counters['foodbakery_counter_maintenance']] != '' ) {
                    $shortcode .= 'foodbakery_var_maintainance_image_array="' . stripslashes( htmlspecialchars( ($data['foodbakery_var_maintainance_image_array'][$counters['foodbakery_counter_maintenance']] ), ENT_QUOTES ) ) . '" ';
                }
                if ( isset( $data['foodbakery_var_lunch_date'][$counters['foodbakery_counter_maintenance']] ) && $data['foodbakery_var_lunch_date'][$counters['foodbakery_counter_maintenance']] != '' ) {
                    $shortcode .= 'foodbakery_var_lunch_date="' . htmlspecialchars( $data['foodbakery_var_lunch_date'][$counters['foodbakery_counter_maintenance']], ENT_QUOTES ) . '" ';
                }

                $shortcode .= '] ';
                if ( isset( $data['maintenance_column_text'][$counters['foodbakery_counter_maintenance']] ) && $data['maintenance_column_text'][$counters['foodbakery_counter_maintenance']] != '' ) {
                    $shortcode .= htmlspecialchars( $data['maintenance_column_text'][$counters['foodbakery_counter_maintenance']], ENT_QUOTES ) . ' ';
                }
                $shortcode .= '[/maintenance]';
                $shortcode_data .= $shortcode;
                $counters['foodbakery_counter_maintenance'] ++;
            }
            $counters['foodbakery_global_counter_maintenance'] ++;
        }
        return array(
            'data' => $data,
            'counters' => $counters,
            'widget_type' => $widget_type,
            'column' => $shortcode_data,
        );
    }

    add_filter( 'foodbakery_save_page_builder_data_maintenance', 'foodbakery_save_page_builder_data_maintenance_callback' );
}

if ( ! function_exists( 'foodbakery_load_shortcode_counters_maintenance_callback' ) ) {

    /**
     * Populate call to action shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_maintenance_callback( $counters ) {
        $counters['foodbakery_counter_maintenance'] = 0;
        $counters['foodbakery_shortcode_counter_maintenance'] = 0;
        $counters['foodbakery_global_counter_maintenance'] = 0;
        return $counters;
    }

    add_filter( 'foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_maintenance_callback' );
}
if ( ! function_exists( 'foodbakery_shortcode_names_list_populate_maintenance_callback' ) ) {

    /**
     * Populate maintenance shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_maintenance_callback( $shortcode_array ) {
        $shortcode_array['maintenance'] = array(
            'title' => 'Maintenance',
            'name' => 'maintenance',
            'icon' => 'fa icon-info-circle',
            'categories' => 'typography',
        );
        return $shortcode_array;
    }

    add_filter( 'foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_maintenance_callback' );
}

if ( ! function_exists( 'foodbakery_element_list_populate_maintenance_callback' ) ) {

    /**
     * Populate maintenance shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_maintenance_callback( $element_list ) {
        $element_list['maintenance'] = 'Maintenance';
        return $element_list;
    }

    add_filter( 'foodbakery_element_list_populate', 'foodbakery_element_list_populate_maintenance_callback' );
}