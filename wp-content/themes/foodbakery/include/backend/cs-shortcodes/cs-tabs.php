<?php
/*
 *
 * @Shortcode Name : tabs
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_var_page_builder_tabs' ) ) {

    function foodbakery_var_page_builder_tabs( $die = 0 ) {
        global $post, $foodbakery_node, $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;
        $string = new foodbakery_theme_all_strings;
        $string->foodbakery_short_code_strings();
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $foodbakery_counter = $_POST['counter'];
        $tabs_num = 0;
        if ( isset( $_POST['action'] ) && ! isset( $_POST['shortcode_element_id'] ) ) {
            $FOODBAKERY_POSTID = '';
            $shortcode_element_id = '';
        } else {
            $FOODBAKERY_POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes( $shortcode_element_id );
            $FOODBAKERY_PREFIX = 'tabs|tabs_item';
            $parseObject = new ShortcodeParse();
            $output = $parseObject->foodbakery_shortcodes( $output, $shortcode_str, true, $FOODBAKERY_PREFIX );
        }
        $defaults = array(
            'foodbakery_var_column_size' => '1/1',
            'foodbakery_var_element_title' => '',
            'foodbakery_var_tabs_view' => '',
            'foodbakery_var_tabs_align' => '',
            
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
            $tabs_num = count( $atts_content );
        }
        $tabs_element_size = '100';
        foreach ( $defaults as $key => $values ) {
            if ( isset( $atts[$key] ) ) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $foodbakery_var_element_title = isset( $foodbakery_var_element_title ) ? $foodbakery_var_element_title : '';
        $foodbakery_var_tabs_view = isset( $foodbakery_var_tabs_view ) ? $foodbakery_var_tabs_view : '';
        $foodbakery_var_tabs_align = isset($foodbakery_var_tabs_align) ? $foodbakery_var_tabs_align : '';
        
        $name = 'foodbakery_var_page_builder_tabs';
        $coloumn_class = 'column_' . $tabs_element_size;
        if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo foodbakery_allow_special_char( $name . $foodbakery_counter ) ?>_del" class="column  parentdelete <?php echo foodbakery_allow_special_char( $coloumn_class ); ?> <?php echo foodbakery_allow_special_char( $shortcode_view ); ?>" item="tabs" data="<?php echo foodbakery_element_size_data_array_index( $tabs_element_size ) ?>" >
            <?php foodbakery_element_setting( $name, $foodbakery_counter, $tabs_element_size, '', 'comments-o', $type = '' ); ?>
            <div class="cs-wrapp-class-<?php echo foodbakery_allow_special_char( $foodbakery_counter ) ?> <?php echo foodbakery_allow_special_char( $shortcode_element ); ?>" id="<?php echo foodbakery_allow_special_char( $name . $foodbakery_counter ) ?>" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_tabs_edit' ) ); ?></h5>
                    <a href="javascript:foodbakery_frame_removeoverlay('<?php echo foodbakery_allow_special_char( $name . $foodbakery_counter ) ?>','<?php echo foodbakery_allow_special_char( $filter_element ); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
                </div>
                <div class="cs-clone-append cs-pbwp-content">
                    <div class="cs-wrapp-tab-box">
                        <div id="shortcode-item-<?php echo foodbakery_allow_special_char( $foodbakery_counter ); ?>" data-shortcode-template="{{child_shortcode}} [/tabs]" data-shortcode-child-template="[tabs_item {{attributes}}] {{content}} [/tabs_item]">
                            <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[tabs {{attributes}}]">
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
                                        'std' => esc_attr( $foodbakery_var_element_title ),
                                        'cust_id' => '',
                                        'cust_name' => 'foodbakery_var_element_title[]',
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
                                        'std' => $foodbakery_var_tabs_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_tabs_align',
                                        'cust_name' => 'foodbakery_var_tabs_align[]',
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
                                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_tabs_styles' ),
                                    'desc' => '',
                                    'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_tabs_styles_hint' ),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $foodbakery_var_tabs_view,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_tabs_view',
                                        'cust_name' => 'foodbakery_var_tabs_view[]',
                                        'classes' => 'foodbakery_var_tabs_view chosen-select select-medium',
                                        'options' => array(
                                            'vertical' => foodbakery_var_theme_text_srt( 'foodbakery_var_tabs_style_vertical' ),
                                            'horizontal' => foodbakery_var_theme_text_srt( 'foodbakery_var_tabs_style_horizontal' ),
                                        ),
                                        'return' => true,
                                    ),
                                );
                                $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );
                                ?>
                            </div>
                            <?php
                            if ( isset( $tabs_num ) && $tabs_num <> '' && isset( $atts_content ) && is_array( $atts_content ) ) {
                                foreach ( $atts_content as $tabs ) {
                                    $rand_string = rand( 123456, 987654 );
                                    $foodbakery_var_tabs_text = $tabs['content'];
                                    $defaults = array(
                                        'foodbakery_var_tabs_title' => '',
                                        'foodbakery_var_tabs_icon' => '',
                                        'foodbakery_var_link_url' => '',
                                        'foodbakery_var_tabs_icon_type' => '',
                                        'foodbakery_var_tabs_image' => '',
                                        'foodbakery_var_tab_active' => '',
                                    );
                                    foreach ( $defaults as $key => $values ) {
                                        if ( isset( $tabs['atts'][$key] ) ) {
                                            $$key = $tabs['atts'][$key];
                                        } else {
                                            $$key = $values;
                                        }
                                    }
                                    $foodbakery_var_tabs_text = isset( $foodbakery_var_tabs_text ) ? $foodbakery_var_tabs_text : '';
                                    $foodbakery_var_tabs_title = isset( $foodbakery_var_tabs_title ) ? $foodbakery_var_tabs_title : '';
                                    $foodbakery_var_tabs_icon = isset( $foodbakery_var_tabs_icon ) ? $foodbakery_var_tabs_icon : '';
                                    $foodbakery_var_tabs_icon_color = isset( $foodbakery_var_tabs_icon_color ) ? $foodbakery_var_tabs_icon_color : '';
                                    $foodbakery_var_link_url = isset( $foodbakery_var_link_url ) ? $foodbakery_var_link_url : '';
                                    $foodbakery_var_tabs_icon_type = isset( $foodbakery_var_tabs_icon_type ) ? $foodbakery_var_tabs_icon_type : '';
                                    $foodbakery_var_tabs_image = isset( $foodbakery_var_tabs_image ) ? $foodbakery_var_tabs_image : '';
                                    $foodbakery_var_tab_active = isset( $foodbakery_var_tab_active ) ? $foodbakery_var_tab_active : '';
                                    ?>
                                    <div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content' id="foodbakery_infobox_<?php echo foodbakery_allow_special_char( $rand_string ); ?>">
                                        <header>
                                            <h4><i class='icon-arrows'></i><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_tabss_title' ) ); ?></h4>
                                            <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_remove' ) ); ?></a>
                                        </header>
                                        <?php
                                        $foodbakery_opt_array = array(
                                            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_tabs_active' ),
                                            'desc' => '',
                                            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_tabs_active_hint' ),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => $foodbakery_var_tab_active,
                                                'id' => '',
                                                'cust_id' => 'foodbakery_var_tab_active',
                                                'cust_name' => 'foodbakery_var_tab_active[]',
                                                'classes' => 'foodbakery_var_tab_active chosen-select select-medium',
                                                'options' => array(
                                                    'yes' => foodbakery_var_theme_text_srt( 'foodbakery_var_yes' ),
                                                    'no' => foodbakery_var_theme_text_srt( 'foodbakery_var_no' ),
                                                ),
                                                'return' => true,
                                            ),
                                        );
                                        $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );



                                        $foodbakery_opt_array = array(
                                            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_tab_title' ),
                                            'desc' => '',
                                            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_tab_title_hint' ),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => foodbakery_allow_special_char( $foodbakery_var_tabs_title ),
                                                'cust_id' => 'foodbakery_var_tabs_title',
                                                'classes' => '',
                                                'cust_name' => 'foodbakery_var_tabs_title[]',
                                                'return' => true,
                                            ),
                                        );
                                        $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );
                                        ?>

                                        <div class="cs-sh-tabs-icon-area" style="display:<?php echo esc_html( $foodbakery_var_tabs_icon_type != 'image' ? 'block' : 'none'  ) ?>;">
                                            <div class="form-elements" id="foodbakery_infobox_<?php echo esc_attr( $rand_id ); ?>">
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <label><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_tabs_icon' ) ); ?></label>
                                                    <?php
                                                    if ( function_exists( 'foodbakery_var_tooltip_helptext' ) ) {
                                                        echo foodbakery_var_tooltip_helptext( foodbakery_var_theme_text_srt( 'foodbakery_var_tabs_icon_hint' ) );
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                    <?php echo foodbakery_var_icomoon_icons_box( $foodbakery_var_tabs_icon, esc_attr( $rand_id ), 'foodbakery_var_tabs_icon' ); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $foodbakery_opt_array = array(
                                            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_tabs_icon_content' ),
                                            'desc' => '',
                                            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_tabs_icon_content_hint' ),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_attr( $foodbakery_var_tabs_text ),
                                                'cust_id' => '',
                                                'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
                                                'cust_name' => 'foodbakery_var_tabs_text[]',
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
                            <script type="text/javascript">
                                jQuery('.function-class').change(function ($) {
                                    var value = jQuery(this).val();
                                    var parentNode = jQuery(this).parent().parent().parent();
                                    if (value == 'image') {
                                        parentNode.find(".cs-sh-tabs-image-area").show();
                                        parentNode.find(".cs-sh-tabs-icon-area").hide();
                                    } else {
                                        parentNode.find(".cs-sh-tabs-image-area").hide();
                                        parentNode.find(".cs-sh-tabs-icon-area").show();
                                    }
                                }
                                );
                            </script>
                        </div>
                        <div class="hidden-object">
                            <?php
                            $foodbakery_opt_array = array(
                                'std' => foodbakery_allow_special_char( $tabs_num ),
                                'id' => '',
                                'before' => '',
                                'after' => '',
                                'classes' => 'fieldCounter',
                                'extra_atr' => '',
                                'cust_id' => '',
                                'cust_name' => 'tabs_num[]',
                                'return' => false,
                                'required' => false
                            );
                            $foodbakery_var_form_fields->foodbakery_var_form_hidden_render( $foodbakery_opt_array );
                            ?>
                        </div>
                        <div class="wrapptabbox cs-pbwp-content cs-zero-padding">
                            <div class="opt-conts">
                                <ul class="form-elements">
                                    <li class="to-field"> <a href="javascript:void(0);" class="add_tabsss cs-main-btn" onclick="foodbakery_shortcode_element_ajax_call('tabs', 'shortcode-item-<?php echo foodbakery_allow_special_char( $foodbakery_counter ); ?>', '<?php echo admin_url( 'admin-ajax.php' ); ?>')"><i class="icon-plus-circle"></i><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_tabs_add' ) ); ?></a> </li>
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
                                        'std' => 'tabs',
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
                                            'cust_id' => 'tabs_save' . $foodbakery_counter,
                                            'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
                                            'cust_type' => 'button',
                                            'classes' => 'cs-foodbakery-admin-btn',
                                            'cust_name' => 'tabs_save',
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

    add_action( 'wp_ajax_foodbakery_var_page_builder_tabs', 'foodbakery_var_page_builder_tabs' );
}

if ( ! function_exists( 'foodbakery_save_page_builder_data_tabs_callback' ) ) {

    /**
     * Save data for tabs shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_tabs_callback( $args ) {
        $shortcode_data = '';
        $data = $args['data'];
        $counters = $args['counters'];
        $widget_type = $args['widget_type'];
        $column = $args['column'];
        if ( $widget_type == "tabs" || $widget_type == "cs_tabs" ) {
            $shortcode = $shortcode_item = '';

            $page_element_size = $data['tabs_element_size'][$counters['foodbakery_global_counter_tabs']];
            $current_element_size = $data['tabs_element_size'][$counters['foodbakery_global_counter_tabs']];

            if ( isset( $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] ) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode' ) {
                $shortcode_str = stripslashes( $data['shortcode']['tabs'][$counters['foodbakery_shortcode_counter_tabs']] );

                $element_settings = 'tabs_element_size="' . $current_element_size . '"';
                $reg = '/tabs_element_size="(\d+)"/s';
                $shortcode_str = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
                $counters['foodbakery_shortcode_counter_tabs'] ++;
            } else {
                if ( isset( $data['tabs_num'][$counters['foodbakery_counter_tabs']] ) && $data['tabs_num'][$counters['foodbakery_counter_tabs']] > 0 ) {
                    for ( $i = 1; $i <= $data['tabs_num'][$counters['foodbakery_counter_tabs']]; $i ++ ) {
                        $shortcode_item .= '[tabs_item ';

                        if ( isset( $data['foodbakery_var_tabs_title'][$counters['foodbakery_counter_tabs_node']] ) && $data['foodbakery_var_tabs_title'][$counters['foodbakery_counter_tabs_node']] != '' ) {
                            $shortcode_item .= 'foodbakery_var_tabs_title="' . htmlspecialchars( $data['foodbakery_var_tabs_title'][$counters['foodbakery_counter_tabs_node']], ENT_QUOTES ) . '" ';
                        }
                        if ( isset( $data['foodbakery_var_link_url'][$counters['foodbakery_counter_tabs_node']] ) && $data['foodbakery_var_link_url'][$counters['foodbakery_counter_tabs_node']] != '' ) {
                            $shortcode_item .= 'foodbakery_var_link_url="' . htmlspecialchars( $data['foodbakery_var_link_url'][$counters['foodbakery_counter_tabs_node']], ENT_QUOTES ) . '" ';
                        }
                        if ( isset( $data['foodbakery_var_tab_active'][$counters['foodbakery_counter_tabs_node']] ) && $data['foodbakery_var_tab_active'][$counters['foodbakery_counter_tabs_node']] != '' ) {
                            $shortcode_item .= 'foodbakery_var_tab_active="' . htmlspecialchars( $data['foodbakery_var_tab_active'][$counters['foodbakery_counter_tabs_node']], ENT_QUOTES ) . '" ';
                        }
                        if ( isset( $data['foodbakery_var_tabs_icon'][$counters['foodbakery_counter_tabs_node']] ) && $data['foodbakery_var_tabs_icon'][$counters['foodbakery_counter_tabs_node']] != '' ) {
                            $shortcode_item .= 'foodbakery_var_tabs_icon="' . htmlspecialchars( $data['foodbakery_var_tabs_icon'][$counters['foodbakery_counter_tabs_node']], ENT_QUOTES ) . '" ';
                        }
                        if ( isset( $data['foodbakery_var_tabs_icon_type'][$counters['foodbakery_counter_tabs_node']] ) && $data['foodbakery_var_tabs_icon_type'][$counters['foodbakery_counter_tabs_node']] != '' ) {
                            $shortcode_item .= 'foodbakery_var_tabs_icon_type="' . htmlspecialchars( $data['foodbakery_var_tabs_icon_type'][$counters['foodbakery_counter_tabs_node']], ENT_QUOTES ) . '" ';
                        }
                        if ( isset( $data['foodbakery_var_tabs_image'][$counters['foodbakery_counter_tabs_node']] ) && $data['foodbakery_var_tabs_image'][$counters['foodbakery_counter_tabs_node']] != '' ) {
                            $shortcode_item .= 'foodbakery_var_tabs_image="' . htmlspecialchars( $data['foodbakery_var_tabs_image'][$counters['foodbakery_counter_tabs_node']], ENT_QUOTES ) . '" ';
                        }
                        $shortcode_item .= ']';
                        if ( isset( $data['foodbakery_var_tabs_text'][$counters['foodbakery_counter_tabs_node']] ) && $data['foodbakery_var_tabs_text'][$counters['foodbakery_counter_tabs_node']] != '' ) {
                            $shortcode_item .= htmlspecialchars( $data['foodbakery_var_tabs_text'][$counters['foodbakery_counter_tabs_node']], ENT_QUOTES );
                        }
                        $shortcode_item .= '[/tabs_item]';
                        $counters['foodbakery_counter_tabs_node'] ++;
                    }
                }
                $section_title = '';
                if ( isset( $data['foodbakery_var_element_title'][$counters['foodbakery_counter_tabs']] ) && $data['foodbakery_var_element_title'][$counters['foodbakery_counter_tabs']] != '' ) {
                    $section_title .= 'foodbakery_var_element_title="' . htmlspecialchars( $data['foodbakery_var_element_title'][$counters['foodbakery_counter_tabs']], ENT_QUOTES ) . '" ';
                }
                 if ( isset( $data['foodbakery_var_tabs_align'][$counters['foodbakery_counter_tabs']] ) && $data['foodbakery_var_tabs_align'][$counters['foodbakery_counter_tabs']] != '' ) {
                    $section_title .= 'foodbakery_var_tabs_align="' . htmlspecialchars( $data['foodbakery_var_tabs_align'][$counters['foodbakery_counter_tabs']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_title_color'][$counters['foodbakery_counter_tabs']] ) && $data['foodbakery_title_color'][$counters['foodbakery_counter_tabs']] != '' ) {
                    $section_title .= 'foodbakery_title_color="' . htmlspecialchars( $data['foodbakery_title_color'][$counters['foodbakery_counter_tabs']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_tabs_content_color'][$counters['foodbakery_counter_tabs']] ) && $data['foodbakery_tabs_content_color'][$counters['foodbakery_counter_tabs']] != '' ) {
                    $section_title .= 'foodbakery_tabs_content_color="' . htmlspecialchars( $data['foodbakery_tabs_content_color'][$counters['foodbakery_counter_tabs']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_tabs_icon_color'][$counters['foodbakery_counter_tabs']] ) && $data['foodbakery_tabs_icon_color'][$counters['foodbakery_counter_tabs']] != '' ) {
                    $section_title .= 'foodbakery_tabs_icon_color="' . htmlspecialchars( $data['foodbakery_tabs_icon_color'][$counters['foodbakery_counter_tabs']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_tabs_icon_size'][$counters['foodbakery_counter_tabs']] ) && $data['foodbakery_var_tabs_icon_size'][$counters['foodbakery_counter_tabs']] != '' ) {
                    $section_title .= 'foodbakery_var_tabs_icon_size="' . htmlspecialchars( $data['foodbakery_var_tabs_icon_size'][$counters['foodbakery_counter_tabs']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_tabs_view'][$counters['foodbakery_counter_tabs']] ) && $data['foodbakery_var_tabs_view'][$counters['foodbakery_counter_tabs']] != '' ) {
                    $section_title .= 'foodbakery_var_tabs_view="' . htmlspecialchars( $data['foodbakery_var_tabs_view'][$counters['foodbakery_counter_tabs']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_tabs_content_align'][$counters['foodbakery_counter_tabs']] ) && $data['foodbakery_tabs_content_align'][$counters['foodbakery_counter_tabs']] != '' ) {
                    $section_title .= 'foodbakery_tabs_content_align="' . htmlspecialchars( $data['foodbakery_tabs_content_align'][$counters['foodbakery_counter_tabs']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_tabs_sub_title'][$counters['foodbakery_counter_tabs']] ) && $data['foodbakery_var_tabs_sub_title'][$counters['foodbakery_counter_tabs']] != '' ) {
                    $section_title .= 'foodbakery_var_tabs_sub_title="' . htmlspecialchars( str_replace( '"', '\'', foodbakery_custom_shortcode_encode( $data['foodbakery_var_tabs_sub_title'][$counters['foodbakery_counter_tabs']] ) ) ) . '" ';
                }
                if ( isset( $data['foodbakery_var_tabs_column'][$counters['foodbakery_counter_tabs']] ) && $data['foodbakery_var_tabs_column'][$counters['foodbakery_counter_tabs']] != '' ) {
                    $section_title .= 'foodbakery_var_tabs_column="' . htmlspecialchars( $data['foodbakery_var_tabs_column'][$counters['foodbakery_counter_tabs']], ENT_QUOTES ) . '" ';
                }
                $element_settings = 'tabs_element_size="' . htmlspecialchars( $data['tabs_element_size'][$counters['foodbakery_global_counter_tabs']] ) . '"';
                $shortcode = '[tabs ' . $element_settings . ' ' . $section_title . ' ]' . $shortcode_item . '[/tabs]';
                $shortcode_data .= $shortcode;
                $counters['foodbakery_counter_tabs'] ++;
            }
            $counters['foodbakery_global_counter_tabs'] ++;
        }
        return array(
            'data' => $data,
            'counters' => $counters,
            'widget_type' => $widget_type,
            'column' => $shortcode_data,
        );
    }

    add_filter( 'foodbakery_save_page_builder_data_tabs', 'foodbakery_save_page_builder_data_tabs_callback' );
}

if ( ! function_exists( 'foodbakery_load_shortcode_counters_tabs_callback' ) ) {

    /**
     * Populate spacer shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_tabs_callback( $counters ) {
        $counters['foodbakery_counter_tabs'] = 0;
        $counters['foodbakery_counter_tabs_node'] = 0;
        $counters['foodbakery_shortcode_counter_tabs'] = 0;
        $counters['foodbakery_global_counter_tabs'] = 0;
        return $counters;
    }

    add_filter( 'foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_tabs_callback' );
}

if ( ! function_exists( 'foodbakery_shortcode_names_list_populate_tabs_callback' ) ) {

    /**
     * Populate icon box shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_tabs_callback( $shortcode_array ) {
        $shortcode_array['tabs'] = array(
            'title' => 'Tabs',
            'name' => 'tabs',
            'icon' => 'icon-database2',
            'categories' => 'loops',
        );
        return $shortcode_array;
    }

    add_filter( 'foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_tabs_callback' );
}

if ( ! function_exists( 'foodbakery_element_list_populate_tabs_callback' ) ) {

    /**
     * Populate icon box shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_tabs_callback( $element_list ) {
        $element_list['tabs'] = 'Tabs';
        return $element_list;
    }

    add_filter( 'foodbakery_element_list_populate', 'foodbakery_element_list_populate_tabs_callback' );
}

if ( ! function_exists( 'foodbakery_shortcode_sub_element_ui_tabs_callback' ) ) {

    /**
     * Render UI for sub element in icon box settings.
     *
     * @param	array $args
     */
    function foodbakery_shortcode_sub_element_ui_tabs_callback( $args ) {
        $type = $args['type'];
        $foodbakery_var_html_fields = $args['html_fields'];

        if ( $type == 'tabs' ) {
            $tabs_count = 'tabs_' . rand( 455345, 23454390 );
            if ( isset( $foodbakery_var_tabs_text ) && $foodbakery_var_tabs_text != '' ) {
                $foodbakery_var_tabs_text = $foodbakery_var_tabs_text;
            } else {
                $foodbakery_var_tabs_text = '';
            }
            ?>
            <div class='cs-wrapp-clone cs-shortcode-wrapp' id="foodbakery_infobox_<?php echo foodbakery_allow_special_char( $tabs_count ); ?>">
                <header>
                    <h4><i class='icon-arrows'></i><?php echo foodbakery_var_theme_text_srt( 'foodbakery_var_tabss_title' ); ?></h4>
                    <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php echo foodbakery_var_theme_text_srt( 'foodbakery_var_remove' ); ?></a>
                </header>
                <?php
                $foodbakery_opt_array = array(
                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_tabs_active' ),
                    'desc' => '',
                    'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_tabs_active_hint' ),
                    'echo' => true,
                    'field_params' => array(
                        'std' => $foodbakery_var_tab_active,
                        'id' => '',
                        'cust_id' => 'foodbakery_var_tab_active',
                        'cust_name' => 'foodbakery_var_tab_active[]',
                        'classes' => 'foodbakery_var_tab_active chosen-select select-medium',
                        'options' => array(
                            'yes' => foodbakery_var_theme_text_srt( 'foodbakery_var_yes' ),
                            'no' => foodbakery_var_theme_text_srt( 'foodbakery_var_no' ),
                        ),
                        'return' => true,
                    ),
                );
                $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );

                $foodbakery_opt_array = array(
                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_tab_title' ),
                    'desc' => '',
                    'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_tab_title_hint' ),
                    'echo' => true,
                    'field_params' => array(
                        'std' => foodbakery_allow_special_char( $foodbakery_var_tabs_title ),
                        'cust_id' => 'foodbakery_var_tabs_title',
                        'classes' => '',
                        'cust_name' => 'foodbakery_var_tabs_title[]',
                        'return' => true,
                    ),
                );
                $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );


                $rand_id = rand( 123450, 854987 );
                ?>	 				


                <div class="cs-sh-tabs-icon-area" style="display:<?php echo esc_html( $foodbakery_var_tabs_icon_type != 'image' ? 'block' : 'none'  ) ?>;">
                    <div class="form-elements" id="foodbakery_infobox_<?php echo esc_attr( $rand_id ); ?>">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_tabs_icon' ) ); ?></label>
                            <?php
                            if ( function_exists( 'foodbakery_var_tooltip_helptext' ) ) {
                                echo foodbakery_var_tooltip_helptext( foodbakery_var_theme_text_srt( 'foodbakery_var_tabs_icon_hint' ) );
                            }
                            ?>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <?php echo foodbakery_var_icomoon_icons_box( '', esc_attr( $rand_id ), 'foodbakery_var_tabs_icon' ); ?>
                        </div>
                    </div>
                </div>
                <?php
                $foodbakery_opt_array = array(
                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_tabs_icon_content' ),
                    'desc' => '',
                    'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_tabs_icon_content_hint' ),
                    'echo' => true,
                    'field_params' => array(
                        'std' => esc_attr( $foodbakery_var_tabs_text ),
                        'cust_id' => '',
                        'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
                        'cust_name' => 'foodbakery_var_tabs_text[]',
                        'return' => true,
                        'classes' => '',
                        'foodbakery_editor' => true,
                    ),
                );
                $foodbakery_var_html_fields->foodbakery_var_textarea_field( $foodbakery_opt_array );
                ?>
            </div>
            <script type="text/javascript">
                jQuery('.function-class').change(function ($) {
                    var value = jQuery(this).val();

                    var parentNode = jQuery(this).parent().parent().parent();
                    if (value == 'image') {
                        parentNode.find(".cs-sh-tabs-image-area").show();
                        parentNode.find(".cs-sh-tabs-icon-area").hide();
                    } else {
                        parentNode.find(".cs-sh-tabs-image-area").hide();
                        parentNode.find(".cs-sh-tabs-icon-area").show();
                    }

                }
                );
            </script>
            <?php
        }
    }

    add_action( 'foodbakery_shortcode_sub_element_ui', 'foodbakery_shortcode_sub_element_ui_tabs_callback' );
}