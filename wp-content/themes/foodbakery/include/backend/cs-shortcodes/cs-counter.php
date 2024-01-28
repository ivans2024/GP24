<?php
/*
 *
 * @Shortcode Name : counter
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_var_page_builder_counter' ) ) {

    function foodbakery_var_page_builder_counter( $die = 0 ) {
        global $post, $foodbakery_node, $foodbakery_var_html_fields, $foodbakery_var_form_fields;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $foodbakery_counter = $_POST['counter'];
        $counter_num = 0;
        if ( isset( $_POST['action'] ) && ! isset( $_POST['shortcode_element_id'] ) ) {
            $FOODBAKERY_POSTID = '';
            $shortcode_element_id = '';
        } else {
            $FOODBAKERY_POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes( $shortcode_element_id );
            $FOODBAKERY_PREFIX = 'counter|counter_item';
            $parseObject = new ShortcodeParse();
            $output = $parseObject->foodbakery_shortcodes( $output, $shortcode_str, true, $FOODBAKERY_PREFIX );
        }

        $defaults = array(
            'foodbakery_var_column_size' => '1/1',
            'foodbakery_counter_title' => '',
            'foodbakery_var_counter_col' => '',
            'foodbakery_var_icon_color' => '',
            'foodbakery_var_count_color' => '',
	    'foodbakery_var_text_color' => '',
            'foodbakery_var_counters_view' => '',
            'foodbakery_var_counter_align' => '',
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
            $counter_num = count( $atts_content );
        }
        $counter_element_size = '100';
        foreach ( $defaults as $key => $values ) {
            if ( isset( $atts[$key] ) ) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }

        $foodbakery_counter_title = isset( $foodbakery_counter_title ) ? $foodbakery_counter_title : '';
        $foodbakery_var_counter_col = isset( $foodbakery_var_counter_col ) ? $foodbakery_var_counter_col : '';
        $foodbakery_var_icon_color = isset( $foodbakery_var_icon_color ) ? $foodbakery_var_icon_color : '';
        $foodbakery_var_count_color = isset( $foodbakery_var_count_color ) ? $foodbakery_var_count_color : '';
	$foodbakery_var_text_color = isset( $foodbakery_var_text_color ) ? $foodbakery_var_text_color : '';
	$foodbakery_var_counters_view = isset( $foodbakery_var_counters_view ) ? $foodbakery_var_counters_view : '';
        $foodbakery_var_counter_align = isset($foodbakery_var_counter_align) ? $foodbakery_var_counter_align : '';

        $name = 'foodbakery_var_page_builder_counter';
        $coloumn_class = 'column_' . $counter_element_size;
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
        <div id="<?php echo foodbakery_allow_special_char( $name . $foodbakery_counter ) ?>_del" class="column  parentdelete <?php echo foodbakery_allow_special_char( $coloumn_class ); ?> <?php echo foodbakery_allow_special_char( $shortcode_view ); ?>" item="counter" data="<?php echo foodbakery_element_size_data_array_index( $counter_element_size ) ?>" >
            <?php foodbakery_element_setting( $name, $foodbakery_counter, $counter_element_size, '', 'comments-o', $type = '' ); ?>
            <div class="cs-wrapp-class-<?php echo foodbakery_allow_special_char( $foodbakery_counter ) ?> <?php echo foodbakery_allow_special_char( $shortcode_element ); ?>" id="<?php echo foodbakery_allow_special_char( $name . $foodbakery_counter ) ?>" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_counter_edit_options' ) ); ?></h5>
                    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo foodbakery_allow_special_char( $name . $foodbakery_counter ) ?>','<?php echo foodbakery_allow_special_char( $filter_element ); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
                </div>
                <div class="cs-clone-append cs-pbwp-content">
                    <div class="cs-wrapp-tab-box">
                        <div id="shortcode-item-<?php echo foodbakery_allow_special_char( $foodbakery_counter ); ?>" data-shortcode-template="{{child_shortcode}} [/counter]" data-shortcode-child-template="[multiple_counter_item {{attributes}}] {{content}} [/multiple_counter_item]">
                            <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[counter {{attributes}}]">
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
                                        'std' => esc_attr( $foodbakery_counter_title ),
                                        'cust_id' => '',
                                        'cust_name' => 'foodbakery_counter_title[]',
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
                                        'std' => $foodbakery_var_counter_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_counter_align',
                                        'cust_name' => 'foodbakery_var_counter_align[]',
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
                                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_style' ),
                                    'desc' => '',
                                    'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_style_hint' ),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $foodbakery_var_counters_view,
                                        'id' => '',
                                        'cust_name' => 'foodbakery_var_counters_view[]',
                                        'classes' => 'dropdown chosen-select',
                                        'options' => array(
                                            'default' => foodbakery_var_theme_text_srt( 'foodbakery_var_default' ),
                                        ),
                                        'return' => true,
                                    ),
                                );

                                $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );

                                $foodbakery_opt_array = array(
                                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_sel_col' ),
                                    'desc' => '',
                                    'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_sel_col_hint' ),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $foodbakery_var_counter_col,
                                        'id' => '',
                                        'cust_name' => 'foodbakery_var_counter_col[]',
                                        'classes' => 'dropdown chosen-select',
                                        'options' => array(
                                            '1' => foodbakery_var_theme_text_srt( 'foodbakery_var_one_col' ),
                                            '2' => foodbakery_var_theme_text_srt( 'foodbakery_var_two_col' ),
                                            '3' => foodbakery_var_theme_text_srt( 'foodbakery_var_three_col' ),
                                            '4' => foodbakery_var_theme_text_srt( 'foodbakery_var_four_col' ),
                                            '6' => foodbakery_var_theme_text_srt( 'foodbakery_var_six_col' ),
                                        ),
                                        'return' => true,
                                    ),
                                );

                                $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );

                                $foodbakery_opt_array = array(
                                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_multiple_counter_icon_color' ),
                                    'desc' => '',
                                    'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_multiple_counter_icon_color_tooltip' ),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => esc_attr( $foodbakery_var_icon_color ),
                                        'cust_id' => 'foodbakery_var_icon_color',
                                        'classes' => 'bg_color',
                                        'cust_name' => 'foodbakery_var_icon_color[]',
                                        'return' => true,
                                    ),
                                );

                                $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                                $foodbakery_opt_array = array(
                                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_multiple_counter_count_color' ),
                                    'desc' => '',
                                    'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_multiple_counter_count_color_tooltip' ),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => esc_attr( $foodbakery_var_count_color ),
                                        'cust_id' => 'foodbakery_var_count_color',
                                        'classes' => 'bg_color',
                                        'cust_name' => 'foodbakery_var_count_color[]',
                                        'return' => true,
                                    ),
                                );

                                $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );
				 $foodbakery_opt_array = array(
                                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_multiple_counter_text_color' ),
                                    'desc' => '',
                                    'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_multiple_counter_text_color_tooltip' ),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => esc_attr( $foodbakery_var_text_color ),
                                        'cust_id' => 'foodbakery_var_text_color',
                                        'classes' => 'bg_color',
                                        'cust_name' => 'foodbakery_var_text_color[]',
                                        'return' => true,
                                    ),
                                );

                                $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );
                                ?>

                            </div>
                            <?php
                            if ( isset( $counter_num ) && $counter_num <> '' && isset( $atts_content ) && is_array( $atts_content ) ) {
                                foreach ( $atts_content as $counter ) {
                                    $rand_string = rand( 123456, 987654 );
                                    $foodbakery_var_counter_text = $counter['content'];
                                    $defaults = array(
                                        'foodbakery_var_icon' => '',
                                        'foodbakery_var_title' => '',
                                        'foodbakery_var_count' => '',
                                    );
                                    foreach ( $defaults as $key => $values ) {
                                        if ( isset( $counter['atts'][$key] ) ) {
                                            $$key = $counter['atts'][$key];
                                        } else {
                                            $$key = $values;
                                        }
                                    }
                                    $foodbakery_var_icon = isset( $foodbakery_var_icon ) ? $foodbakery_var_icon : '';
                                    $foodbakery_var_title = isset( $foodbakery_var_title ) ? $foodbakery_var_title : '';
                                    $foodbakery_var_count = isset( $foodbakery_var_count ) ? $foodbakery_var_count : '';
                                    ?>
                                    <div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content' id="foodbakery_counter_<?php echo foodbakery_allow_special_char( $rand_string ); ?>">
                                        <header>
                                            <h4><i class='icon-arrows'></i><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_multiple_counter' ) ); ?></h4>
                                            <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_remove' ) ); ?></a>
                                        </header>
                                        <div class="form-elements" id="<?php echo esc_attr( $rand_string ); ?>">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <label><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_multiple_counter_icon' ) ); ?></label>
                                                <?php
                                                if ( function_exists( 'foodbakery_var_tooltip_helptext' ) ) {
                                                    echo foodbakery_var_tooltip_helptext( foodbakery_var_theme_text_srt( 'foodbakery_var_multiple_counter_icon_tooltip' ) );
                                                }
                                                ?>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                <?php echo foodbakery_var_icomoon_icons_box( esc_attr( $foodbakery_var_icon ), $rand_string, 'foodbakery_var_icon' ); ?>
                                            </div>
                                        </div>
                                        <?php
                                        $foodbakery_opt_array = array(
                                            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_multiple_counter_title' ),
                                            'desc' => '',
                                            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_multiple_counter_title_hint' ),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_attr( $foodbakery_var_title ),
                                                'cust_id' => 'foodbakery_var_title',
                                                'classes' => '',
                                                'cust_name' => 'foodbakery_var_title[]',
                                                'return' => true,
                                            ),
                                        );

                                        $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                                        $foodbakery_opt_array = array(
                                            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_multiple_counter_count' ),
                                            'desc' => '',
                                            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_multiple_counter_count_tooltip' ),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_attr( $foodbakery_var_count ),
                                                'cust_id' => 'foodbakery_var_count',
                                                'classes' => '',
                                                'cust_name' => 'foodbakery_var_count[]',
                                                'return' => true,
                                            ),
                                        );
                                        $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                                        $foodbakery_opt_array = array(
                                            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_multiple_counter_content' ),
                                            'desc' => '',
                                            'hint_text' => foodbakery_var_frame_text_srt( 'foodbakery_var_multiple_counter_content_tooltip' ),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_attr( $foodbakery_var_counter_text ),
                                                'cust_id' => '',
                                                'cust_name' => 'foodbakery_var_counter_text[]',
                                                'return' => true,
                                                'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
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
                                'std' => foodbakery_allow_special_char( $counter_num ),
                                'id' => '',
                                'before' => '',
                                'after' => '',
                                'classes' => 'fieldCounter',
                                'extra_atr' => '',
                                'cust_id' => '',
                                'cust_name' => 'counter_num[]',
                                'return' => false,
                                'required' => false
                            );
                            $foodbakery_var_form_fields->foodbakery_var_form_hidden_render( $foodbakery_opt_array );
                            ?>

                        </div>
                        <div class="wrapptabbox cs-pbwp-content cs-zero-padding">
                            <div class="opt-conts">
                                <ul class="form-elements">
                                    <li class="to-field"> <a href="javascript:void(0);" class="add_counterss cs-main-btn" onclick="foodbakery_shortcode_element_ajax_call('counter', 'shortcode-item-<?php echo foodbakery_allow_special_char( $foodbakery_counter ); ?>', '<?php echo admin_url( 'admin-ajax.php' ); ?>')"><i class="icon-plus-circle"></i><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_add_counter' ) ); ?></a> </li>
                                    <div id="loading" class="shortcodeload"></div>
                                </ul>
                                <?php if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) { ?>
                                    <ul class="form-elements insert-bg noborder">
                                        <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo str_replace( 'foodbakery_var_page_builder_', '', $name ); ?>', 'shortcode-item-<?php echo foodbakery_allow_special_char( $foodbakery_counter ); ?>', '<?php echo foodbakery_allow_special_char( $filter_element ); ?>')" ><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_insert' ) ); ?></a> </li>
                                    </ul>
                                    <div id="results-shortocde"></div>
                                    <?php
                                } else {
                                    $foodbakery_opt_array = array(
                                        'std' => 'counter',
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
                                    $foodbakery_var_form_fields->foodbakery_var_form_hidden_render( $foodbakery_opt_array );

                                    $foodbakery_opt_array = array(
                                        'name' => '',
                                        'desc' => '',
                                        'hint_text' => '',
                                        'echo' => true,
                                        'field_params' => array(
                                            'std' => foodbakery_var_theme_text_srt( 'foodbakery_var_save' ),
                                            'cust_id' => 'counter_save' . $foodbakery_counter,
                                            'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
                                            'cust_type' => 'button',
                                            'classes' => 'cs-foodbakery-admin-btn',
                                            'cust_name' => 'counter_save',
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

    add_action( 'wp_ajax_foodbakery_var_page_builder_counter', 'foodbakery_var_page_builder_counter' );
}

if ( ! function_exists( 'foodbakery_save_page_builder_data_counter_callback' ) ) {

    /**
     * Save data for counter shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_counter_callback( $args ) {

        $data = $args['data'];
        $counters = $args['counters'];
        $widget_type = $args['widget_type'];
        $column = $args['column'];
        if ( $widget_type == "counter" || $widget_type == "cs_counter" ) {

            $shortcode = $shortcode_item = '';
            $page_element_size = $data['counter_element_size'][$counters['foodbakery_global_counter_counter']];
            $current_element_size = $data['counter_element_size'][$counters['foodbakery_global_counter_counter']];

            if ( isset( $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] ) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode' ) {
                $shortcode_str = stripslashes( $data['shortcode']['counter'][$counters['foodbakery_shortcode_counter_counter']] );

                $element_settings = 'counter_element_size="' . $current_element_size . '"';
                $reg = '/counter_element_size="(\d+)"/s';
                $shortcode_str = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
                $counters['foodbakery_shortcode_counter_counter'] ++;
            } else {

                if ( isset( $data['counter_num'][$counters['foodbakery_counter_counter']] ) && $data['counter_num'][$counters['foodbakery_counter_counter']] > 0 ) {

                    for ( $i = 1; $i <= $data['counter_num'][$counters['foodbakery_counter_counter']]; $i ++ ) {
                        $shortcode_item .= '[counter_item ';
                        if ( isset( $data['foodbakery_var_icon'][$counters['foodbakery_counter_counter_node']] ) && $data['foodbakery_var_icon'][$counters['foodbakery_counter_counter_node']] != '' ) {
                            $shortcode_item .= 'foodbakery_var_icon="' . htmlspecialchars( $data['foodbakery_var_icon'][$counters['foodbakery_counter_counter_node']], ENT_QUOTES ) . '" ';
                        }
                        if ( isset( $data['foodbakery_var_title'][$counters['foodbakery_counter_counter_node']] ) && $data['foodbakery_var_title'][$counters['foodbakery_counter_counter_node']] != '' ) {
                            $shortcode_item .= 'foodbakery_var_title="' . $data['foodbakery_var_title'][$counters['foodbakery_counter_counter_node']] . '" ';
                        }
                        if ( isset( $data['foodbakery_var_count'][$counters['foodbakery_counter_counter_node']] ) && $data['foodbakery_var_count'][$counters['foodbakery_counter_counter_node']] != '' ) {
                            $shortcode_item .= 'foodbakery_var_count="' . $data['foodbakery_var_count'][$counters['foodbakery_counter_counter_node']] . '" ';
                        }
                        $shortcode_item .= ']';
                        if ( isset( $data['foodbakery_var_counter_text'][$counters['foodbakery_counter_counter_node']] ) && $data['foodbakery_var_counter_text'][$counters['foodbakery_counter_counter_node']] != '' ) {
                            $shortcode_item .= htmlspecialchars( $data['foodbakery_var_counter_text'][$counters['foodbakery_counter_counter_node']], ENT_QUOTES );
                        }
                        $shortcode_item .= '[/counter_item]';
                        $counters['foodbakery_counter_counter_node'] ++;
                    }
                }

                $section_title = '';
                if ( isset( $data['foodbakery_counter_title'][$counters['foodbakery_counter_counter']] ) && $data['foodbakery_counter_title'][$counters['foodbakery_counter_counter']] != '' ) {
                    $section_title .= 'foodbakery_counter_title="' . htmlspecialchars( $data['foodbakery_counter_title'][$counters['foodbakery_counter_counter']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_counter_align'][$counters['foodbakery_counter_counter']] ) && $data['foodbakery_var_counter_align'][$counters['foodbakery_counter_counter']] != '' ) {
                    $section_title .= 'foodbakery_var_counter_align="' . htmlspecialchars( $data['foodbakery_var_counter_align'][$counters['foodbakery_counter_counter']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_counter_col'][$counters['foodbakery_counter_counter']] ) && $data['foodbakery_var_counter_col'][$counters['foodbakery_counter_counter']] != '' ) {
                    $section_title .= 'foodbakery_var_counter_col="' . htmlspecialchars( $data['foodbakery_var_counter_col'][$counters['foodbakery_counter_counter']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_icon_color'][$counters['foodbakery_counter_counter']] ) && $data['foodbakery_var_icon_color'][$counters['foodbakery_counter_counter']] != '' ) {
                    $section_title .= 'foodbakery_var_icon_color="' . htmlspecialchars( $data['foodbakery_var_icon_color'][$counters['foodbakery_counter_counter']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_count_color'][$counters['foodbakery_counter_counter']] ) && $data['foodbakery_var_count_color'][$counters['foodbakery_counter_counter']] != '' ) {
                    $section_title .= 'foodbakery_var_count_color="' . htmlspecialchars( $data['foodbakery_var_count_color'][$counters['foodbakery_counter_counter']], ENT_QUOTES ) . '" ';
                }
		if ( isset( $data['foodbakery_var_text_color'][$counters['foodbakery_counter_counter']] ) && $data['foodbakery_var_text_color'][$counters['foodbakery_counter_counter']] != '' ) {
                    $section_title .= 'foodbakery_var_text_color="' . htmlspecialchars( $data['foodbakery_var_text_color'][$counters['foodbakery_counter_counter']], ENT_QUOTES ) . '" ';
                }
		if ( isset( $data['foodbakery_var_counters_view'][$counters['foodbakery_counter_counter']] ) && $data['foodbakery_var_counters_view'][$counters['foodbakery_counter_counter']] != '' ) {
                    $section_title .= 'foodbakery_var_counters_view="' . htmlspecialchars( $data['foodbakery_var_counters_view'][$counters['foodbakery_counter_counter']], ENT_QUOTES ) . '" ';
                }
                $element_settings = 'counter_element_size="' . htmlspecialchars( $data['counter_element_size'][$counters['foodbakery_global_counter_counter']] ) . '"';
                $shortcode = '[counter ' . $element_settings . ' ' . $section_title . ' ]' . $shortcode_item . '[/counter]';
                $shortcode_data .= $shortcode;
                $counters['foodbakery_counter_counter'] ++;
            }
            $counters['foodbakery_global_counter_counter'] ++;
        }
        return array(
            'data' => $data,
            'counters' => $counters,
            'widget_type' => $widget_type,
            'column' => $shortcode_data,
        );
    }

    add_filter( 'foodbakery_save_page_builder_data_counter', 'foodbakery_save_page_builder_data_counter_callback' );
}

if ( ! function_exists( 'foodbakery_load_shortcode_counters_counter_callback' ) ) {

    /**
     * Populate counter shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_counter_callback( $counters ) {
        $counters['foodbakery_counter_counter'] = 0;
        $counters['foodbakery_counter_counter_node'] = 0;
        $counters['foodbakery_shortcode_counter_counter'] = 0;
        $counters['foodbakery_global_counter_counter'] = 0;
        return $counters;
    }

    add_filter( 'foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_counter_callback' );
}
if ( ! function_exists( 'foodbakery_shortcode_names_list_populate_counter_callback' ) ) {

    /**
     * Populate list shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_counter_callback( $shortcode_array ) {
        $shortcode_array['counter'] = array(
            'title' => foodbakery_var_frame_text_srt( 'foodbakery_var_multiple_counter' ),
            'name' => 'counter',
            'icon' => 'icon-clock-o',
            'categories' => 'loops',
        );
        return $shortcode_array;
    }

    add_filter( 'foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_counter_callback' );
}

if ( ! function_exists( 'foodbakery_element_list_populate_counter_callback' ) ) {

    /**
     * Populate counter shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_counter_callback( $element_list ) {
        $element_list['counter'] = foodbakery_var_frame_text_srt( 'foodbakery_var_multiple_counter' );
        return $element_list;
    }

    add_filter( 'foodbakery_element_list_populate', 'foodbakery_element_list_populate_counter_callback' );
}

if ( ! function_exists( 'foodbakery_shortcode_sub_element_ui_counter_callback' ) ) {

    /**
     * Render UI for sub element in list settings.
     *
     * @param	array $args
     */
    function foodbakery_shortcode_sub_element_ui_counter_callback( $args ) {
        $type = $args['type'];
        $foodbakery_var_html_fields = $args['html_fields'];

        if ( $type == 'counter' ) {

            $multiple_counter_count = 'multiple_counter_' . rand( 455345, 23454390 );
            if ( isset( $foodbakery_var_counter_text ) && $foodbakery_var_counter_text != '' ) {
                $foodbakery_var_counter_text = $foodbakery_var_counter_text;
            } else {
                $foodbakery_var_counter_text = '';
            }
            ?>
            <div class='cs-wrapp-clone cs-shortcode-wrapp' id="foodbakery_counter_<?php echo foodbakery_allow_special_char( $multiple_counter_count ); ?>">
                <header>
                    <h4><i class='icon-arrows'></i><?php echo foodbakery_var_frame_text_srt( 'foodbakery_var_multiple_counter' ); ?></h4>
                    <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php
                        echo foodbakery_var_frame_text_srt( 'foodbakery_var_remove' );
                        ?></a>
                </header>

                <div class="form-elements" id="<?php echo esc_attr( $multiple_counter_count ); ?>">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <label><?php echo foodbakery_var_frame_text_srt( 'foodbakery_var_multiple_counter_icon' ); ?></label>
                        <?php
                        if ( function_exists( 'foodbakery_var_tooltip_helptext' ) ) {
                            echo foodbakery_var_tooltip_helptext( foodbakery_var_frame_text_srt( 'foodbakery_var_multiple_counter_icon_tooltip' ) );
                        }
                        ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <?php echo foodbakery_var_icomoon_icons_box( '', $multiple_counter_count, 'foodbakery_var_icon' ); ?>
                    </div>
                </div>

                <?php
                $foodbakery_opt_array = array(
                    'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_multiple_counter_title' ),
                    'desc' => '',
                    'hint_text' => foodbakery_var_frame_text_srt( 'foodbakery_var_multiple_counter_title_hint' ),
                    'echo' => true,
                    'field_params' => array(
                        'std' => '',
                        'cust_id' => 'foodbakery_var_title',
                        'classes' => '',
                        'cust_name' => 'foodbakery_var_title[]',
                        'return' => true,
                    ),
                );

                $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                $foodbakery_opt_array = array(
                    'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_multiple_counter_count' ),
                    'desc' => '',
                    'hint_text' => foodbakery_var_frame_text_srt( 'foodbakery_var_multiple_counter_count_tooltip' ),
                    'echo' => true,
                    'field_params' => array(
                        'std' => '',
                        'cust_id' => 'foodbakery_var_count',
                        'classes' => '',
                        'cust_name' => 'foodbakery_var_count[]',
                        'return' => true,
                    ),
                );

                $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                $foodbakery_opt_array = array(
                    'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_multiple_counter_content' ),
                    'desc' => '',
                    'hint_text' => foodbakery_var_frame_text_srt( 'foodbakery_var_multiple_counter_content_tooltip' ),
                    'echo' => true,
                    'field_params' => array(
                        'std' => '',
                        'cust_id' => '',
                        'cust_name' => 'foodbakery_var_counter_text[]',
                        'return' => true,
                        'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
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

    add_action( 'foodbakery_shortcode_sub_element_ui', 'foodbakery_shortcode_sub_element_ui_counter_callback' );
}