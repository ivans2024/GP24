<?php
/*
 *
 * @Shortcode Name : Button
 * @retrun
 *
 */

if ( ! function_exists( 'foodbakery_var_page_builder_faq' ) ) {

    function foodbakery_var_page_builder_faq( $die = 0 ) {
        global $foodbakery_node, $count_node, $post, $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;
        $strings = new foodbakery_theme_all_strings;
        $strings->foodbakery_short_code_strings();
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $foodbakery_counter = $_POST['counter'];
        $PREFIX = 'foodbakery_faq|faq_item';
        $parseObject = new ShortcodeParse();
        $faq_num = 0;
        if ( isset( $_POST['action'] ) && ! isset( $_POST['shortcode_element_id'] ) ) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes( $shortcode_element_id );
            $output = $parseObject->foodbakery_shortcodes( $output, $shortcode_str, true, $PREFIX );
        }
        $defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_var_faq_view' => '',
            'foodbakery_var_faq_align' => '',
            'foodbakery_var_faq_icon' => '',
            'foodbakery_var_faq_main_title' => '',
        );

        if ( isset( $output['0']['atts'] ) ) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }
        if ( isset( $output['0']['content'] ) ) {
            $atts_content = $output['0']['content'];
        } else {
            $atts_content = array();
        }

        if ( is_array( $atts_content ) ) {
            $faq_num = count( $atts_content );
        }
        $faq_element_size = '50';
        foreach ( $defaults as $key => $values ) {
            if ( isset( $atts[$key] ) ) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }

        $name = 'foodbakery_var_page_builder_faq';
        $coloumn_class = 'column_' . $faq_element_size;
        $foodbakery_var_faq_view = isset( $foodbakery_var_faq_view ) ? $foodbakery_var_faq_view : '';
        $foodbakery_var_faq_main_title = isset( $foodbakery_var_faq_main_title ) ? $foodbakery_var_faq_main_title : '';
        $foodbakery_var_faq_align = isset($foodbakery_var_faq_align) ? $foodbakery_var_faq_align : '';
        if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo foodbakery_allow_special_char( $name . $foodbakery_counter ) ?>_del" class="column  parentdelete <?php echo foodbakery_allow_special_char( $coloumn_class ); ?> <?php echo foodbakery_allow_special_char( $shortcode_view ); ?>" item="faq" data="<?php echo foodbakery_element_size_data_array_index( $faq_element_size ) ?>" >
            <?php foodbakery_element_setting( $name, $foodbakery_counter, $faq_element_size, '', 'list-ul' ); ?>
            <div class="cs-wrapp-class-<?php echo foodbakery_allow_special_char( $foodbakery_counter ) ?> <?php echo foodbakery_allow_special_char( $shortcode_element ); ?>" id="<?php echo foodbakery_allow_special_char( $name . $foodbakery_counter ) ?>" data-shortcode-template="[foodbakery_faq {{attributes}}]" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_faq_edit_options' ) ); ?></h5>
                    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo foodbakery_allow_special_char( $name . $foodbakery_counter ) ?>','<?php echo foodbakery_allow_special_char( $filter_element ); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-clone-append cs-pbwp-content">
                    <div class="cs-wrapp-tab-box">
                        <div id="shortcode-item-<?php echo foodbakery_allow_special_char( $foodbakery_counter ); ?>" data-shortcode-template="{{child_shortcode}}[/<?php echo esc_attr( 'foodbakery_faq' ); ?>]" data-shortcode-child-template="[<?php echo esc_attr( 'faq_item' ); ?> {{attributes}}] {{content}} [/<?php echo esc_attr( 'faq_item' ); ?>]">
                            <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[<?php echo esc_attr( 'foodbakery_faq' ); ?> {{attributes}}]">
                                <?php
                                $foodbakery_opt_array = array(
                                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_element_title' ),
                                    'desc' => '',
                                    'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_element_title_hint' ),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => foodbakery_allow_special_char( $foodbakery_var_faq_main_title ),
                                        'id' => 'foodbakery_var_faq_main_title',
                                        'cust_name' => 'foodbakery_var_faq_main_title[]',
                                        'classes' => '',
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
                                        'std' => $foodbakery_var_faq_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_faq_align',
                                        'cust_name' => 'foodbakery_var_faq_align[]',
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

                                if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) {
                                    foodbakery_shortcode_element_size();
                                }
                                ?>

                            </div>
                            <?php
                            if ( isset( $faq_num ) && $faq_num <> '' && isset( $atts_content ) && is_array( $atts_content ) ) {
                                foreach ( $atts_content as $faq ) {

                                    $rand_id = rand( 3333, 99999 );
                                    $foodbakery_var_faq_text = $faq['content'];
                                    $defaults = array( 'foodbakery_var_faq_title' => 'Title', 'foodbakery_var_faq_active' => 'yes', 'foodbakery_var_icon_box' => '' );
                                    foreach ( $defaults as $key => $values ) {
                                        if ( isset( $faq['atts'][$key] ) )
                                            $$key = $faq['atts'][$key];
                                        else
                                            $$key = $values;
                                    }

                                    $foodbakery_var_faq_active = isset( $foodbakery_var_faq_active ) ? $foodbakery_var_faq_active : '';
                                    $foodbakery_var_faq_title = isset( $foodbakery_var_faq_title ) ? $foodbakery_var_faq_title : '';
                                    $foodbakery_var_icon_box = isset( $foodbakery_var_icon_box ) ? $foodbakery_var_icon_box : '';
                                    ?>
                                    <div class='cs-wrapp-clone cs-shortcode-wrapp  cs-pbwp-content'  id="foodbakery_infobox_<?php echo foodbakery_allow_special_char( $rand_id ); ?>">
                                        <header>
                                            <h4><i class='icon-arrows'></i><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_faq' ) ); ?></h4>
                                            <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_remove' ) ); ?></a>
                                        </header>
                                        <div class="form-elements" id="foodbakery_infobox_<?php echo esc_attr( $rand_id ); ?>">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <label><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_icon' ) ); ?></label>
                                                <?php
                                                if ( function_exists( 'foodbakery_var_tooltip_helptext' ) ) {
                                                    echo foodbakery_var_tooltip_helptext( foodbakery_var_theme_text_srt( 'foodbakery_var_icon_hint' ) );
                                                }
                                                ?>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                <?php echo foodbakery_var_icomoon_icons_box( $foodbakery_var_icon_box, esc_attr( $rand_id ), 'foodbakery_var_icon_box' ); ?>
                                            </div>
                                        </div>

                                        <?php
                                        $foodbakery_opt_array = array(
                                            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_accordian_active' ),
                                            'desc' => '',
                                            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_faq_active_hint' ),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => $foodbakery_var_faq_active,
                                                'id' => '',
                                                'cust_name' => 'foodbakery_var_faq_active[]',
                                                'classes' => 'dropdown chosen-select',
                                                'options' => array(
                                                    'yes' => foodbakery_var_theme_text_srt( 'foodbakery_var_yes' ),
                                                    'no' => foodbakery_var_theme_text_srt( 'foodbakery_var_no' ),
                                                ),
                                                'return' => true,
                                            ),
                                        );

                                        $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );

                                        $foodbakery_opt_array = array(
                                            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_accordian_title' ),
                                            'desc' => '',
                                            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_faq_title_hint' ),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => foodbakery_allow_special_char( $foodbakery_var_faq_title ),
                                                'id' => 'faq_title',
                                                'cust_name' => 'foodbakery_var_faq_title[]',
                                                'classes' => '',
                                                'return' => true,
                                            ),
                                        );
                                        $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                                        $foodbakery_opt_array = array(
                                            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_accordian_descr' ),
                                            'desc' => '',
                                            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_faq_descr_hint' ),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => foodbakery_allow_special_char( $foodbakery_var_faq_text ),
                                                'id' => 'foodbakery_var_faq_text',
                                                'cust_name' => 'foodbakery_var_faq_text[]',
                                                'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
                                                'classes' => '',
                                                'return' => true,
                                                'foodbakery_editor' => true,
                                            ),
                                        );
                                        $foodbakery_var_html_fields->foodbakery_var_textarea_field( $foodbakery_opt_array );
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
                                'std' => $faq_num,
                                'id' => '',
                                'before' => '',
                                'after' => '',
                                'classes' => 'fieldCounter',
                                'extra_atr' => '',
                                'cust_id' => '',
                                'cust_name' => 'faq_num[]',
                                'return' => false,
                                'required' => false
                            );
                            $foodbakery_var_form_fields->foodbakery_var_form_hidden_render( $foodbakery_opt_array );
                            ?>
                        </div>
                        <div class="wrapptabbox">
                            <div class="opt-conts">
                                <ul class="form-elements noborder">
                                    <li class="to-field"> <a href="javascript:void(0);" class="add_servicesss cs-main-btn" onclick="foodbakery_shortcode_element_ajax_call('faq', 'shortcode-item-<?php echo foodbakery_allow_special_char( $foodbakery_counter ); ?>', '<?php echo foodbakery_allow_special_char( admin_url( 'admin-ajax.php' ) ); ?>')"><i class="icon-plus-circle"></i><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_add_faq' ) ); ?></a> </li>
                                    <div id="loading" class="shortcodeload"></div>
                                </ul>
                                <?php if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) { ?>
                                    <ul class="form-elements insert-bg">
                                        <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo esc_js( str_replace( 'foodbakery_var_page_builder_', '', $name ) ); ?>', 'shortcode-item-<?php echo foodbakery_allow_special_char( $foodbakery_counter ); ?>', '<?php echo foodbakery_allow_special_char( $filter_element ); ?>')" ><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_insert' ) ); ?></a> </li>
                                    </ul>
                                    <div id="results-shortocde"></div>
                                    <?php
                                } else {
                                    $foodbakery_opt_array = array(
                                        'std' => 'faq',
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
                                    $foodbakery_var_form_fields->foodbakery_var_form_hidden_render( $foodbakery_opt_array );

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
                </div>
            </div>
        </div>

        <?php
        if ( $die <> 1 ) {
            die();
        }
    }

    add_action( 'wp_ajax_foodbakery_var_page_builder_faq', 'foodbakery_var_page_builder_faq' );
}
if ( ! function_exists( 'foodbakery_save_page_builder_data_faq_callback' ) ) {

    /**
     * Save data for faq shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_faq_callback( $args ) {

        $data = $args['data'];
        $counters = $args['counters'];
        $widget_type = $args['widget_type'];
        $column = $args['column'];
        if ( $widget_type == "faq" || $widget_type == "cs_faq" ) {
            $shortcode = $shortcode_item = '';
            $page_element_size = $data['faq_element_size'][$counters['foodbakery_global_counter_faq']];
            $current_element_size = $data['faq_element_size'][$counters['foodbakery_global_counter_faq']];

            if ( isset( $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] ) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode' ) {
                $shortcode_str = stripslashes( $data['shortcode']['faq'][$counters['foodbakery_shortcode_counter_faq']] );
                $element_settings = 'faq_element_size="' . $current_element_size . '"';
                $reg = '/faq_element_size="(\d+)"/s';
                $shortcode_str = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
                $counters['foodbakery_shortcode_counter_faq'] ++;
            } else {
                if ( isset( $data['faq_num'][$counters['foodbakery_counter_faq']] ) && $data['faq_num'][$counters['foodbakery_counter_faq']] > 0 ) {
                    for ( $i = 1; $i <= $data['faq_num'][$counters['foodbakery_counter_faq']]; $i ++ ) {
                        $shortcode_item .= '[faq_item ';

                        if ( isset( $data['foodbakery_var_faq_active'][$counters['foodbakery_counter_faq_node']] ) && $data['foodbakery_var_faq_active'][$counters['foodbakery_counter_faq_node']] != '' ) {
                            $shortcode_item .= 'foodbakery_var_faq_active="' . htmlspecialchars( $data['foodbakery_var_faq_active'][$counters['foodbakery_counter_faq_node']], ENT_QUOTES ) . '" ';
                        }
                        if ( isset( $data['foodbakery_var_faq_title'][$counters['foodbakery_counter_faq_node']] ) && $data['foodbakery_var_faq_title'][$counters['foodbakery_counter_faq_node']] != '' ) {
                            $shortcode_item .= 'foodbakery_var_faq_title="' . htmlspecialchars( $data['foodbakery_var_faq_title'][$counters['foodbakery_counter_faq_node']], ENT_QUOTES ) . '" ';
                        }
                        if ( isset( $data['foodbakery_var_icon_box'][$counters['foodbakery_counter_faq_node']] ) && $data['foodbakery_var_icon_box'][$counters['foodbakery_counter_faq_node']] != '' ) {
                            $shortcode_item .= 'foodbakery_var_icon_box="' . htmlspecialchars( $data['foodbakery_var_icon_box'][$counters['foodbakery_counter_faq_node']], ENT_QUOTES ) . '" ';
                        }
                        $shortcode_item .= ']';
                        if ( isset( $data['foodbakery_var_faq_text'][$counters['foodbakery_counter_faq_node']] ) && $data['foodbakery_var_faq_text'][$counters['foodbakery_counter_faq_node']] != '' ) {
                            $shortcode_item .= htmlspecialchars( $data['foodbakery_var_faq_text'][$counters['foodbakery_counter_faq_node']], ENT_QUOTES );
                        }
                        $shortcode_item .= '[/faq_item]';
                        $counters['foodbakery_counter_faq_node'] ++;
                    }
                }
                $section_title = '';

                if ( isset( $data['foodbakery_var_faq_view'][$counters['foodbakery_counter_faq']] ) && $data['foodbakery_var_faq_view'][$counters['foodbakery_counter_faq']] != '' ) {
                    $section_title .= 'foodbakery_var_faq_view="' . htmlspecialchars( $data['foodbakery_var_faq_view'][$counters['foodbakery_counter_faq']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_faq_align'][$counters['foodbakery_counter_faq']] ) && $data['foodbakery_var_faq_align'][$counters['foodbakery_counter_faq']] != '' ) {
                    $section_title .= 'foodbakery_var_faq_align="' . htmlspecialchars( $data['foodbakery_var_faq_align'][$counters['foodbakery_counter_faq']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_faq_main_title'][$counters['foodbakery_counter_faq']] ) && $data['foodbakery_var_faq_main_title'][$counters['foodbakery_counter_faq']] != '' ) {
                    $section_title .= 'foodbakery_var_faq_main_title="' . htmlspecialchars( $data['foodbakery_var_faq_main_title'][$counters['foodbakery_counter_faq']], ENT_QUOTES ) . '" ';
                }
                $element_settings = 'faq_element_size="' . htmlspecialchars( $data['faq_element_size'][$counters['foodbakery_global_counter_faq']] ) . '"';
                $shortcode = '[foodbakery_faq ' . $element_settings . ' ' . $section_title . ' ]' . $shortcode_item . '[/foodbakery_faq]';
                $shortcode_data .= $shortcode;
                $counters['foodbakery_counter_faq'] ++;
            }
            $counters['foodbakery_global_counter_faq'] ++;
        }
        return array(
            'data' => $data,
            'counters' => $counters,
            'widget_type' => $widget_type,
            'column' => $shortcode_data,
        );
    }

    add_filter( 'foodbakery_save_page_builder_data_faq', 'foodbakery_save_page_builder_data_faq_callback' );
}

if ( ! function_exists( 'foodbakery_load_shortcode_counters_faq_callback' ) ) {

    /**
     * Populate faq shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_faq_callback( $counters ) {
        $counters['foodbakery_global_counter_faq'] = 0;
        $counters['foodbakery_shortcode_counter_faq'] = 0;
        $counters['foodbakery_counter_faq_node'] = 0;
        $counters['foodbakery_counter_faq'] = 0;
        return $counters;
    }

    add_filter( 'foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_faq_callback' );
}

if ( ! function_exists( 'foodbakery_shortcode_names_list_populate_faq_callback' ) ) {

    /**
     * Populate faq shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_faq_callback( $shortcode_array ) {
        $shortcode_array['faq'] = array(
            'title' => foodbakery_var_frame_text_srt( 'foodbakery_var_faq' ),
            'name' => 'faq',
            'icon' => 'icon-list-ul',
            'categories' => 'contentblocks',
        );
        return $shortcode_array;
    }

    add_filter( 'foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_faq_callback' );
}

if ( ! function_exists( 'foodbakery_element_list_populate_faq_callback' ) ) {

    /**
     * Populate faq shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_faq_callback( $element_list ) {
        $element_list['faq'] = foodbakery_var_frame_text_srt( 'foodbakery_var_faq' );
        return $element_list;
    }

    add_filter( 'foodbakery_element_list_populate', 'foodbakery_element_list_populate_faq_callback' );
}

if ( ! function_exists( 'foodbakery_shortcode_sub_element_ui_faq_callback' ) ) {

    /**
     * Render UI for sub element in faq settings.
     *
     * @param	array $args
     */
    function foodbakery_shortcode_sub_element_ui_faq_callback( $args ) {
        $type = $args['type'];
        $foodbakery_var_html_fields = $args['html_fields'];

        if ( $type == 'faq' ) {
            $foodbakery_var_active = foodbakery_var_frame_text_srt( 'foodbakery_var_active' );
            $foodbakery_var_faq_active_hint = foodbakery_var_frame_text_srt( 'foodbakery_var_faq_active_hint' );
            $foodbakery_var_faq_title = foodbakery_var_frame_text_srt( 'foodbakery_var_faq_title' );
            $foodbakery_var_faq_title_hint = foodbakery_var_frame_text_srt( 'foodbakery_var_faq_title_hint' );
            $foodbakery_var_faq_text = foodbakery_var_frame_text_srt( 'foodbakery_var_faq_text' );
            $foodbakery_var_faq_text_hint = foodbakery_var_frame_text_srt( 'foodbakery_var_faq_text_hint' );

            $rand_id = rand( 324235, 993249 );
            ?>
            <div class='cs-wrapp-clone cs-shortcode-wrapp'  id="foodbakery_infobox_<?php echo intval( $rand_id ); ?>">
                <header>
                    <h4><i class='icon-arrows'></i><?php echo foodbakery_var_frame_text_srt( 'foodbakery_var_faq' ); ?></h4>
                    <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo foodbakery_var_frame_text_srt( 'foodbakery_var_remove' ); ?></a>
                </header>

                <div class="form-elements" id="foodbakery_infobox_<?php echo esc_attr( $rand_id ); ?>">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <label><?php echo foodbakery_var_frame_text_srt( 'foodbakery_var_faq_icon' ); ?></label>
                        <?php
                        if ( function_exists( 'foodbakery_var_tooltip_helptext' ) ) {
                            echo foodbakery_var_tooltip_helptext( foodbakery_var_frame_text_srt( 'foodbakery_var_faq_icon_hint' ) );
                        }
                        ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <?php echo foodbakery_var_icomoon_icons_box( '', esc_attr( $rand_id ), 'foodbakery_var_icon_box' ); ?>
                    </div>
                </div>                                   
                <?php
                $foodbakery_opt_array = array(
                    'name' => $foodbakery_var_active,
                    'desc' => '',
                    'hint_text' => $foodbakery_var_faq_active_hint,
                    'echo' => true,
                    'field_params' => array(
                        'std' => '',
                        'id' => '',
                        'cust_name' => 'foodbakery_var_faq_active[]',
                        'classes' => 'dropdown chosen-select',
                        'options' => array(
                            'yes' => foodbakery_var_frame_text_srt( 'foodbakery_var_yes' ),
                            'no' => foodbakery_var_frame_text_srt( 'foodbakery_var_no' ),
                        ),
                        'return' => true,
                    ),
                );

                $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );

                $foodbakery_opt_array = array(
                    'name' => $foodbakery_var_faq_title,
                    'desc' => '',
                    'hint_text' => $foodbakery_var_faq_title_hint,
                    'echo' => true,
                    'field_params' => array(
                        'std' => '',
                        'id' => 'faq_title',
                        'cust_name' => 'foodbakery_var_faq_title[]',
                        'classes' => '',
                        'return' => true,
                    ),
                );
                $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                $foodbakery_opt_array = array(
                    'name' => $foodbakery_var_faq_text,
                    'desc' => '',
                    'hint_text' => $foodbakery_var_faq_text_hint,
                    'echo' => true,
                    'field_params' => array(
                        'std' => '',
                        'id' => 'foodbakery_var_faq_text',
                        'cust_name' => 'foodbakery_var_faq_text[]',
                        'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
                        'return' => true,
                        'classes' => '',
                        'foodbakery_editor' => true
                    ),
                );
                $foodbakery_var_html_fields->foodbakery_var_textarea_field( $foodbakery_opt_array );
                ?>

            </div>

            <?php
        }
    }

    add_action( 'foodbakery_shortcode_sub_element_ui', 'foodbakery_shortcode_sub_element_ui_faq_callback' );
}