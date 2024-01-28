<?php
/*
 *
 * @Shortcode Name : Tabs
 * @retrun
 *
 * 
 */
if ( ! function_exists( 'foodbakery_var_page_builder_faqs_fancy' ) ) {

    function foodbakery_var_page_builder_faqs_fancy( $die = 0 ) {
        global $foodbakery_node, $count_node, $post, $foodbakery_var_html_fields, $foodbakery_var_form_fields;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $foodbakery_counter = $_POST['counter'];
        $faqs_fancy_num = 0;
        if ( isset( $_POST['action'] ) && ! isset( $_POST['shortcode_element_id'] ) ) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes( $shortcode_element_id );
            $PREFIX = 'foodbakery_faqs_fancy|foodbakery_faqs_fancy_item';
            $parseObject = new ShortcodeParse();
            $output = $parseObject->foodbakery_shortcodes( $output, $shortcode_str, true, $PREFIX );
        }
        $defaults = array(
            'foodbakery_var_faqs_fancy_title' => '',
            'foodbakery_var_faqs_title' => '',
            'foodbakery_var_fancy_faq_align' => '',
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
            $faqs_fancy_num = count( $atts_content );
        }
        $faqs_fancy_element_size = '25';
        foreach ( $defaults as $key => $values ) {
            if ( isset( $atts[$key] ) ) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }

        $exploded_data = explode( ",", $foodbakery_var_faqs_title );
        $name = 'foodbakery_var_page_builder_faqs_fancy';
        $coloumn_class = 'column_' . $faqs_fancy_element_size;
        $foodbakery_var_faqs_fancy_title = isset( $foodbakery_var_faqs_fancy_title ) ? $foodbakery_var_faqs_fancy_title : '';
        $foodbakery_var_fancy_faq_align = isset( $foodbakery_var_fancy_faq_align ) ? $foodbakery_var_fancy_faq_align : '';

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
        <div id="<?php echo foodbakery_allow_special_char( $name . $foodbakery_counter ) ?>_del" class="column  parentdelete <?php echo foodbakery_allow_special_char( $coloumn_class ); ?> <?php echo foodbakery_allow_special_char( $shortcode_view ); ?>" item="faqs_fancy" data="<?php echo foodbakery_element_size_data_array_index( $faqs_fancy_element_size ) ?>" >
            <?php foodbakery_element_setting( $name, $foodbakery_counter, $faqs_fancy_element_size, '', 'comments-o', $type = '' ); ?>
            <div class="cs-wrapp-class-<?php echo foodbakery_allow_special_char( $foodbakery_counter ) ?> <?php echo foodbakery_allow_special_char( $shortcode_element ); ?>" id="<?php echo foodbakery_allow_special_char( $name . $foodbakery_counter ) ?>" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_edit_options' ) ); ?></h5>
                    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo foodbakery_allow_special_char( $name . $foodbakery_counter ) ?>','<?php echo foodbakery_allow_special_char( $filter_element ); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
                </div>
                <div class="cs-clone-append cs-pbwp-content">
                    <div class="cs-wrapp-faq-box">
                        <div id="shortcode-item-<?php echo foodbakery_allow_special_char( $foodbakery_counter ); ?>" data-shortcode-template="{{child_shortcode}} [/foodbakery_faqs_fancy]" data-shortcode-child-template="[foodbakery_faqs_fancy_item {{attributes}}] {{content}} [/foodbakery_faqs_fancy_item]">
                            <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[foodbakery_faqs_fancy {{attributes}}]">
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
                                        'std' => foodbakery_allow_special_char( $foodbakery_var_faqs_fancy_title ),
                                        'id' => 'faqs_fancy_title' . $foodbakery_counter,
                                        'cust_name' => 'foodbakery_var_faqs_fancy_title[]',
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
                                        'std' => $foodbakery_var_fancy_faq_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_fancy_faq_align',
                                        'cust_name' => 'foodbakery_var_fancy_faq_align[]',
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

                                $counter = 0;
                                if ( $foodbakery_var_faqs_title == '' ) {

                                    echo '<div class="repeat_div">';

                                    $foodbakery_opt_array = array(
                                        'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_item_text' ),
                                        'desc' => '',
                                        'required' => true,
                                        'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_item_text_hint' ),
                                        'echo' => true,
                                        'field_params' => array(
                                            'std' => foodbakery_allow_special_char( $data_single ),
                                            'id' => 'faqs_fancy_title' . $foodbakery_counter,
                                            'cust_name' => 'foodbakery_var_faqs_title[]',
                                            'classes' => '',
                                            'return' => true,
                                        ),
                                    );
                                    $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                                    echo '</div>';
                                }
                                foreach ( $exploded_data as $data_single ) {
                                    if ( $data_single != '' ) {
                                        if ( $counter == 0 ) {

                                            echo '<div class="repeat_div">';
                                        }
                                        $foodbakery_opt_array = array(
                                            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_item_text' ),
                                            'desc' => '',
                                            'required' => true,
                                            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_item_text_hint' ),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => foodbakery_allow_special_char( $data_single ),
                                                'id' => 'faqs_fancy_title' . $foodbakery_counter,
                                                'cust_name' => 'foodbakery_var_faqs_title[]',
                                                'classes' => '',
                                                'return' => true,
                                            ),
                                        );
                                        $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );
                                        echo '<a href="#" class="delete-it btn-delete-it"><i class="icon-minus-circle"></i></a>';
                                        if ( $counter == 0 ) {
                                            echo '</div>';
                                        }
                                    }


                                    $counter ++;
                                }


                                echo '<div class="appened-data"></div>';
                                ?>
                                <div class="form-elements"><a href="javascript:void(0);" class="add_servicesss cs-main-btn" onclick="foodbakery_shortcode_add_duplicate()"><i class="icon-plus-circle"></i><?php echo foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_add_btn' ); ?></a></div>
                                <script>

                                    function foodbakery_shortcode_add_duplicate() {
                                        jQuery(".repeat_div").first().clone().append('<a href="#" class="delete-it btn-delete-it"><i class="icon-minus-circle"></i></a>').appendTo(".appened-data");
                                    }
                                    jQuery(document).on("click", ".delete-it", function () {
                                        $(this).prev('.form-elements').remove();
                                        (this).remove();
                                    });
                                </script>
                            </div>
        <?php
        if ( isset( $faqs_fancy_num ) && $faqs_fancy_num <> '' && isset( $atts_content ) && is_array( $atts_content ) ) {
            foreach ( $atts_content as $faqs_fancy ) {
                $foodbakery_var_faqs_fancy_text = $faqs_fancy['content'];
                $rand_id = rand( 3333, 99999 );
                $defaults = array(
                    'foodbakery_var_faqs_fancy_item_text' => 'Title',
                    'foodbakery_var_faqs_fancy_item_icon' => 'icon-list-ul',
                    'foodbakery_var_faqs_fancy_active' => '',
                );
                foreach ( $defaults as $key => $values ) {
                    if ( isset( $faqs_fancy['atts'][$key] ) )
                        $$key = $faqs_fancy['atts'][$key];
                    else
                        $$key = $values;
                }


                $foodbakery_var_faqs_fancy_item_text = isset( $foodbakery_var_faqs_fancy_item_text ) ? $foodbakery_var_faqs_fancy_item_text : '';
                $foodbakery_var_faqs_fancy_desc = $foodbakery_var_faqs_fancy_text;
                $foodbakery_var_faqs_fancy_item_icon = isset( $foodbakery_var_faqs_fancy_item_icon ) ? $foodbakery_var_faqs_fancy_item_icon : '';
                $foodbakery_var_faqs_fancy_active = isset( $foodbakery_var_faqs_fancy_active ) ? $foodbakery_var_faqs_fancy_active : '';
                ?>
                                    <div class='cs-wrapp-clone cs-shortcode-wrapp  cs-pbwp-content'  id="foodbakery_infobox_<?php echo foodbakery_allow_special_char( $rand_id ); ?>">
                                        <header>
                                            <h4><i class='icon-arrows'></i><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_faqs_fancy' ) ); ?></h4>
                                            <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_remove' ) ); ?></a></header>
                                    <?php
                                    $exploded_data = explode( ",", $foodbakery_var_faqs_title );

                                    $options_array = array();
                                    foreach ( $exploded_data as $data_single ) {
                                        if ( $data_single != '' ) {
                                            $options_array[$data_single] = $data_single;
                                        }
                                    }
                                    $foodbakery_opt_array = array(
                                        'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_item_text' ),
                                        'desc' => '',
                                        'required' => true,
                                        'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_item_text_hint' ),
                                        'echo' => true,
                                        'field_params' => array(
                                            'std' => foodbakery_allow_special_char( $foodbakery_var_faqs_fancy_item_text ),
                                            'id' => 'fancy_item_text',
                                            'cust_name' => 'foodbakery_var_faqs_fancy_item_text[]',
                                            'classes' => '',
                                            'return' => true,
                                        ),
                                    );
                                    $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                                    $foodbakery_opt_array = array(
                                        'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_active' ),
                                        'desc' => '',
                                        'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_active_hint' ),
                                        'echo' => true,
                                        'field_params' => array(
                                            'std' => esc_html( $foodbakery_var_faqs_fancy_active ),
                                            'id' => 'faqs_fancy_active',
                                            'cust_name' => 'foodbakery_var_faqs_fancy_active[]',
                                            'options' => $options_array,
                                            'classes' => 'chosen-select-no-single select-medium',
                                            'return' => true,
                                        ),
                                    );
                                    $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );
                                    ?>

                                        <?php
                                        $foodbakery_opt_array = array(
                                            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_descr' ),
                                            'desc' => '',
                                            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_descr_hint' ),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => foodbakery_allow_special_char( $foodbakery_var_faqs_fancy_desc ),
                                                'cust_id' => 'foodbakery_var_faqs_fancy_desc' . $foodbakery_counter,
                                                'cust_name' => 'foodbakery_var_faqs_fancy_desc[]',
                                                'return' => true,
                                                'classes' => '',
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
                                    'std' => $faqs_fancy_num,
                                    'id' => '',
                                    'before' => '',
                                    'after' => '',
                                    'classes' => 'fieldCounter',
                                    'extra_atr' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'faqs_fancy_num[]',
                                    'required' => false
                                );
                                $foodbakery_var_form_fields->foodbakery_var_form_hidden_render( $foodbakery_opt_array );
                                ?>
                        </div>
                        <div class="wrappfaqbox">
                            <div class="opt-conts">
                                <ul class="form-elements noborder">
                                    <li class="to-field"> <a href="javascript:void(0);" class="add_servicesss cs-main-btn" onclick="foodbakery_shortcode_element_ajax_call('faqs_fancy', 'shortcode-item-<?php echo foodbakery_allow_special_char( $foodbakery_counter ); ?>', '<?php echo foodbakery_allow_special_char( admin_url( 'admin-ajax.php' ) ); ?>')"><i class="icon-plus-circle"></i><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_add_faq' ) ); ?></a> </li>
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
                'std' => 'faqs_fancy',
                'id' => '',
                'before' => '',
                'after' => '',
                'classes' => '',
                'extra_atr' => '',
                'cust_id' => '',
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
        <script>
            /* modern selection box and help hover text function */
            jQuery(document).ready(function ($) {
                chosen_selectionbox();
                popup_over();
            });
            /* end modern selection box and help hover text function */
        </script>
        <?php
        if ( $die <> 1 ) {
            die();
        }
        ?>
        <?php
    }

    add_action( 'wp_ajax_foodbakery_var_page_builder_faqs_fancy', 'foodbakery_var_page_builder_faqs_fancy' );
}

if ( ! function_exists( 'foodbakery_save_page_builder_data_faqs_fancy_callback' ) ) {

    /**
     * Save data for faqs_fancy shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_faqs_fancy_callback( $args ) {
        $data = $args['data'];
        $foodbakery_var_faqs_title = $data['foodbakery_var_faqs_title'];

        if ( isset( $foodbakery_var_faqs_title ) && count( $foodbakery_var_faqs_title ) > 0 ) {
            foreach ( $foodbakery_var_faqs_title as $title ) {
                if ( $title != '' ) {
                    $foodbakery_var_faqs_title_actual .=$title . ',';
                }
            }
        }


        $counters = $args['counters'];
        $widget_type = $args['widget_type'];
        $column = $args['column'];
        if ( $widget_type == "faqs_fancy" || $widget_type == "cs_faqs_fancy" ) {
            $shortcode = $shortcode_item = '';

            $page_element_size = $data['faqs_fancy_element_size'][$counters['foodbakery_global_counter_faqs_fancy']];
            $current_element_size = $data['faqs_fancy_element_size'][$counters['foodbakery_global_counter_faqs_fancy']];

            if ( isset( $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] ) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode' ) {
                $shortcode_str = stripslashes( $data['shortcode']['faqs_fancy'][$counters['foodbakery_shortcode_counter_faqs_fancy']] );

                $element_settings = 'faqs_fancy_element_size="' . $current_element_size . '"';
                $reg = '/faqs_fancy_element_size="(\d+)"/s';
                $shortcode_str = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
                $counters['foodbakery_shortcode_counter_faqs_fancy'] ++;
            } else {
                if ( isset( $data['faqs_fancy_num'][$counters['foodbakery_counter_faqs_fancy']] ) && $data['faqs_fancy_num'][$counters['foodbakery_counter_faqs_fancy']] > 0 ) {
                    for ( $i = 1; $i <= $data['faqs_fancy_num'][$counters['foodbakery_counter_faqs_fancy']]; $i ++  ) {
                        $shortcode_item .= '[foodbakery_faqs_fancy_item ';
                        if ( isset( $data['foodbakery_var_faqs_fancy_item_text'][$counters['foodbakery_counter_faqs_fancy_node']] ) && $data['foodbakery_var_faqs_fancy_item_text'][$counters['foodbakery_counter_faqs_fancy_node']] != '' ) {
                            $shortcode_item .= 'foodbakery_var_faqs_fancy_item_text="' . htmlspecialchars( $data['foodbakery_var_faqs_fancy_item_text'][$counters['foodbakery_counter_faqs_fancy_node']], ENT_QUOTES ) . '" ';
                        }

                        if ( isset( $data['foodbakery_var_faqs_fancy_active'][$counters['foodbakery_counter_faqs_fancy_node']] ) && $data['foodbakery_var_faqs_fancy_active'][$counters['foodbakery_counter_faqs_fancy_node']] != '' ) {
                            $shortcode_item .= 'foodbakery_var_faqs_fancy_active="' . htmlspecialchars( $data['foodbakery_var_faqs_fancy_active'][$counters['foodbakery_counter_faqs_fancy_node']], ENT_QUOTES ) . '" ';
                        }
                        $shortcode_item .= ']';
                        if ( isset( $data['foodbakery_var_faqs_fancy_desc'][$counters['foodbakery_counter_faqs_fancy_node']] ) && $data['foodbakery_var_faqs_fancy_desc'][$counters['foodbakery_counter_faqs_fancy_node']] != '' ) {
                            $shortcode_item .= htmlspecialchars( $data['foodbakery_var_faqs_fancy_desc'][$counters['foodbakery_counter_faqs_fancy_node']], ENT_QUOTES );
                        }
                        $shortcode_item .= '[/foodbakery_faqs_fancy_item]';
                        $counters['foodbakery_counter_faqs_fancy_node'] ++;
                    }
                }
                $section_title = '';
                if ( isset( $data['foodbakery_var_faqs_fancy_title'][$counters['foodbakery_counter_faqs_fancy']] ) && $data['foodbakery_var_faqs_fancy_title'][$counters['foodbakery_counter_faqs_fancy']] != '' ) {
                    $section_title .= 'foodbakery_var_faqs_fancy_title="' . htmlspecialchars( $data['foodbakery_var_faqs_fancy_title'][$counters['foodbakery_counter_faqs_fancy']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_fancy_faq_align'][$counters['foodbakery_counter_faqs_fancy']] ) && $data['foodbakery_var_fancy_faq_align'][$counters['foodbakery_counter_faqs_fancy']] != '' ) {
                    $section_title .= 'foodbakery_var_fancy_faq_align="' . htmlspecialchars( $data['foodbakery_var_fancy_faq_align'][$counters['foodbakery_counter_faqs_fancy']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_faqs_title'][$counters['foodbakery_counter_faqs_fancy']] ) && $foodbakery_var_faqs_title_actual != '' ) {
                    $section_title .= 'foodbakery_var_faqs_title="' . $foodbakery_var_faqs_title_actual . '" ';
                }

                $element_settings = 'faqs_fancy_element_size="' . htmlspecialchars( $data['faqs_fancy_element_size'][$counters['foodbakery_global_counter_faqs_fancy']] ) . '"';
                $shortcode = '[foodbakery_faqs_fancy ' . $element_settings . ' ' . $section_title . ' ]' . $shortcode_item . '[/foodbakery_faqs_fancy]';

                $shortcode_data .= $shortcode;
                $counters['foodbakery_counter_faqs_fancy'] ++;
            }
            $counters['foodbakery_global_counter_faqs_fancy'] ++;
        }
        return array(
            'data' => $data,
            'counters' => $counters,
            'widget_type' => $widget_type,
            'column' => $shortcode_data,
        );
    }

    add_filter( 'foodbakery_save_page_builder_data_faqs_fancy', 'foodbakery_save_page_builder_data_faqs_fancy_callback' );
}

if ( ! function_exists( 'foodbakery_load_shortcode_counters_faqs_fancy_callback' ) ) {

    /**
     * Populate faqs_fancy shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_faqs_fancy_callback( $counters ) {
        $counters['foodbakery_counter_faqs_fancy'] = 0;
        $counters['foodbakery_counter_faqs_fancy_node'] = 0;
        $counters['foodbakery_shortcode_counter_faqs_fancy'] = 0;
        $counters['foodbakery_global_counter_faqs_fancy'] = 0;
        return $counters;
    }

    add_filter( 'foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_faqs_fancy_callback' );
}

if ( ! function_exists( 'foodbakery_shortcode_names_list_populate_faqs_fancy_callback' ) ) {

    /**
     * Populate faqs_fancy shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_faqs_fancy_callback( $shortcode_array ) {
        $shortcode_array['faqs_fancy'] = array(
            'title' => 'Fancy faqs',
            'name' => 'faqs_fancy',
            'icon' => 'icon-list-ul',
            'categories' => 'contentblocks',
            'desc' => foodbakery_var_frame_text_srt( 'foodbakery_var_faqs_fancy_desc' ),
        );
        return $shortcode_array;
    }

    add_filter( 'foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_faqs_fancy_callback' );
}

if ( ! function_exists( 'foodbakery_element_list_populate_faqs_fancy_callback' ) ) {

    /**
     * Populate faqs_fancy shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_faqs_fancy_callback( $element_list ) {
        $element_list['faqs_fancy'] = 'Facny Faqs';
        return $element_list;
    }

    add_filter( 'foodbakery_element_list_populate', 'foodbakery_element_list_populate_faqs_fancy_callback' );
}

if ( ! function_exists( 'foodbakery_shortcode_sub_element_ui_faqs_fancy_callback' ) ) {

    /**
     * Render UI for sub element in faqs_fancy settings.
     *
     * @param	array $args
     */
    function foodbakery_shortcode_sub_element_ui_faqs_fancy_callback( $args ) {
        $type = $args['type'];
        $foodbakery_var_html_fields = $args['html_fields'];
        if ( $type == 'faqs_fancy' ) {
            $rand_id = rand( 23, 45453 );
            ?>
            <div class='cs-wrapp-clone cs-shortcode-wrapp'  id="foodbakery_faqs_fancy_<?php echo intval( $rand_id ); ?>">
                <header>
                    <h4><i class='icon-arrows'></i><?php echo foodbakery_var_frame_text_srt( 'foodbakery_var_faq' ); ?></h4>
                    <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo foodbakery_var_frame_text_srt( 'foodbakery_var_remove' ); ?></a>
                </header>
            <?php
            $foodbakery_opt_array = array(
                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_item_text' ),
                'desc' => '',
                'required' => true,
                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_item_text_hint' ),
                'echo' => true,
                'field_params' => array(
                    'std' => '',
                    'id' => 'fancy_item_text',
                    'cust_name' => 'foodbakery_var_faqs_fancy_item_text[]',
                    'classes' => '',
                    'return' => true,
                ),
            );
            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );
            $foodbakery_opt_array = array(
                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_active' ),
                'desc' => '',
                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_active_hint' ),
                'echo' => true,
                'field_params' => array(
                    'std' => '',
                    'id' => 'faqs_fancy_item_text',
                    'cust_name' => 'foodbakery_var_faqs_fancy_active[]',
                    'classes' => 'dropdown chosen-select-no-single select-medium',
                    'options' => array(),
                    'return' => true,
                ),
            );
            $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );
            ?>

                <?php
                $foodbakery_opt_array = array(
                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_descr' ),
                    'desc' => '',
                    'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_faqs_fancy_descr_hint' ),
                    'echo' => true,
                    'field_params' => array(
                        'std' => '',
                        'id' => 'foodbakery_var_faqs_fancy_desc',
                        'cust_name' => 'foodbakery_var_faqs_fancy_desc[]',
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

        add_action( 'foodbakery_shortcode_sub_element_ui', 'foodbakery_shortcode_sub_element_ui_faqs_fancy_callback' );
    }