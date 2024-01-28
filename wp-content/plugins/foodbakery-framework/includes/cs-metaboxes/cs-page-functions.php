<?php

/**
 * @Page options
 * @return html
 *
 */
if ( ! function_exists( 'foodbakery_subheader_element' ) ) {

    function foodbakery_subheader_element() {
        global $post, $foodbakery_var_form_fields, $foodbakery_var_html_fields, $foodbakery_var_frame_static_text;
        $page_subheader_no_image = '';

        $foodbakery_default_map = '[foodbakery_map foodbakery_var_map_element_title="Address Help" foodbakery_var_sub_element_title="Map info" foodbakery_var_map_height_title="300" foodbakery_var_map_latitude_title="-0.127758" foodbakery_var_map_longitude_title="51.507351" foodbakery_var_info_text_title="info text" foodbakery_var_info_width_title="300" foodbakery_var_info_height_title="100" foodbakery_var_map_zoom="9" foodbakery_var_map_types="HYBRID" foodbakery_var_show_marker="true" foodbakery_var_disable_map="true" foodbakery_var_drag_able="true" foodbakery_var_scrol_wheel="true" foodbakery_var_map_direction="true" ][/foodbakery_map]';

        $foodbakery_banner_style = get_post_meta( $post->ID, 'foodbakery_header_banner_style', true );

        $foodbakery_default_header = $foodbakery_breadcrumb_header = $foodbakery_custom_slider = $foodbakery_map = $foodbakery_no_header = 'hide';
        if ( isset( $foodbakery_banner_style ) && $foodbakery_banner_style == 'default_header' ) {
            $foodbakery_default_header = 'show';
        } else if ( isset( $foodbakery_banner_style ) && $foodbakery_banner_style == 'breadcrumb_header' ) {
            $foodbakery_breadcrumb_header = 'show';
        } else if ( isset( $foodbakery_banner_style ) && $foodbakery_banner_style == 'custom_slider' ) {
            $foodbakery_custom_slider = 'show';
        } else if ( isset( $foodbakery_banner_style ) && $foodbakery_banner_style == 'map' ) {
            $foodbakery_map = 'show';
        } else if ( isset( $foodbakery_banner_style ) && $foodbakery_banner_style == 'no-header' ) {
            $foodbakery_no_header = 'show';
        } else {
            $foodbakery_default_header = 'show';
        }

        $foodbakery_var_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_choose_subheader' ),
            'desc' => '',
            'hint_text' => '',
            'echo' => true,
            'field_params' => array(
                'std' => 'default_header',
                'id' => 'header_banner_style',
                'return' => true,
                'extra_atr' => 'onchange="foodbakery_header_element_toggle(this.value)"',
                'classes' => 'dropdown chosen-select',
                'options' => array(
                    'default_header' => foodbakery_var_frame_text_srt( 'foodbakery_var_default_subheader' ),
                    'breadcrumb_header' => foodbakery_var_frame_text_srt( 'foodbakery_var_custom_subheader' ),
                    'custom_slider' => foodbakery_var_frame_text_srt( 'foodbakery_var_rev_slider' ),
                    'map' => foodbakery_var_frame_text_srt( 'foodbakery_var_map' ),
                    'no-header' => foodbakery_var_frame_text_srt( 'foodbakery_var_no_subheader' )
                ),
            ),
        );

        $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_var_opt_array );


        $foodbakery_var_opt_array = array(
            'id' => 'custom_header',
            'enable_id' => 'foodbakery_var_header_banner_style',
            'enable_val' => 'breadcrumb_header',
        );

        $foodbakery_var_html_fields->foodbakery_var_division( $foodbakery_var_opt_array );

        $foodbakery_var_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_style' ),
            'desc' => '',
            'hint_text' => '',
            'echo' => true,
            'field_params' => array(
                'std' => 'simple',
                'id' => 'sub_header_style',
                'return' => true,
                'extra_atr' => 'onchange="foodbakery_var_page_subheader_style(this.value)"',
                'classes' => 'dropdown chosen-select',
                'options' => array(
                    'classic' => foodbakery_var_frame_text_srt( 'foodbakery_var_classic' ),
                    'with_bg' => foodbakery_var_frame_text_srt( 'foodbakery_var_with_image' ),
                ),
            ),
        );

        $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_var_opt_array );

        $foodbakery_var_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_padding_top' ),
            'desc' => '',
            'hint_text' => foodbakery_var_frame_text_srt( 'foodbakery_var_padding_top_hint' ),
            'echo' => true,
            'field_params' => array(
                'std' => '',
                'id' => 'subheader_padding_top',
                'return' => true,
            ),
        );

        $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_var_opt_array );

        $foodbakery_var_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_padding_bot' ),
            'desc' => '',
            'hint_text' => foodbakery_var_frame_text_srt( 'foodbakery_var_padding_bot_hint' ),
            'echo' => true,
            'field_params' => array(
                'std' => '',
                'id' => 'subheader_padding_bottom',
                'return' => true,
            ),
        );
        $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_var_opt_array );

        $foodbakery_var_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_margin_top' ),
            'desc' => '',
            'hint_text' => foodbakery_var_frame_text_srt( 'foodbakery_var_margin_top_hint' ),
            'echo' => true,
            'field_params' => array(
                'std' => '',
                'id' => 'subheader_margin_top',
                'return' => true,
            ),
        );

        $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_var_opt_array );

        $foodbakery_var_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_margin_bot' ),
            'desc' => '',
            'hint_text' => foodbakery_var_frame_text_srt( 'foodbakery_var_margin_bot_hint' ),
            'echo' => true,
            'field_params' => array(
                'std' => '',
                'id' => 'subheader_margin_bottom',
                'return' => true,
            ),
        );
        $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_var_opt_array );

        $foodbakery_var_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_page_title' ),
            'desc' => '',
            'hint_text' => '',
            'echo' => true,
            'field_params' => array(
                'std' => '',
                'id' => 'page_title_switch',
                'return' => true,
            ),
        );

        $foodbakery_var_html_fields->foodbakery_var_checkbox_field( $foodbakery_var_opt_array );

        $foodbakery_var_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_sub_header_align' ),
            'desc' => '',
            'hint_text' => '',
            'echo' => true,
            'field_params' => array(
                'std' => 'left',
                'id' => 'sub_header_align',
                'return' => true,
                'extra_atr' => '',
                'classes' => 'dropdown chosen-select',
                'options' => array(
                    'left' => foodbakery_var_frame_text_srt( 'foodbakery_var_align_left' ),
                    'center' => foodbakery_var_frame_text_srt( 'foodbakery_var_align_center' ),
                    'right' => foodbakery_var_frame_text_srt( 'foodbakery_var_align_right' ),
                ),
            ),
        );

        $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_var_opt_array );


        $foodbakery_var_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_text_color' ),
            'desc' => '',
            'hint_text' => foodbakery_var_frame_text_srt( 'foodbakery_var_text_color_hint' ),
            'echo' => true,
            'field_params' => array(
                'std' => '',
                'id' => 'page_subheader_text_color',
                'classes' => 'bg_color',
                'return' => true,
            ),
        );

        $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_var_opt_array );

        $foodbakery_var_opt_array = array(
            'id' => 'subheader_with_bc',
            'enable_id' => 'foodbakery_var_sub_header_style',
            'enable_val' => 'classic',
        );
        $foodbakery_var_html_fields->foodbakery_var_division( $foodbakery_var_opt_array );
        $foodbakery_var_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_breadcrumbs' ),
            'desc' => '',
            'hint_text' => '',
            'echo' => true,
            'field_params' => array(
                'std' => '',
                'id' => 'page_breadcrumbs',
                'return' => true,
            ),
        );
        $foodbakery_var_html_fields->foodbakery_var_checkbox_field( $foodbakery_var_opt_array );
        $foodbakery_var_html_fields->foodbakery_var_division_close( array() );

        $foodbakery_var_opt_array = array(
            'id' => 'subheader_with_bg',
            'enable_id' => 'foodbakery_var_sub_header_style',
            'enable_val' => 'with_bg',
        );
        $foodbakery_var_html_fields->foodbakery_var_division( $foodbakery_var_opt_array );

        $foodbakery_var_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_sub_heading' ),
            'desc' => '',
            'hint_text' => foodbakery_var_frame_text_srt( 'foodbakery_var_sub_heading_hint' ),
            'echo' => true,
            'field_params' => array(
                'std' => '',
                'id' => 'page_subheading_title',
                'return' => true,
            ),
        );

        $foodbakery_var_html_fields->foodbakery_var_textarea_field( $foodbakery_var_opt_array );

        $foodbakery_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_bg_image' ),
            'id' => 'header_banner_image',
            'main_id' => '',
            'std' => '',
            'desc' => '',
            'hint_text' => foodbakery_var_frame_text_srt( 'foodbakery_var_bg_image_hint' ),
            'prefix' => '',
            'echo' => true,
            'field_params' => array(
                'std' => '',
                'id' => 'header_banner_image',
                'prefix' => '',
                'return' => true,
            ),
        );

        $foodbakery_var_html_fields->foodbakery_var_upload_file_field( $foodbakery_opt_array );

        $foodbakery_var_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_parallax' ),
            'desc' => '',
            'hint_text' => foodbakery_var_frame_text_srt( 'foodbakery_var_parallax_hint' ),
            'echo' => true,
            'field_params' => array(
                'std' => '',
                'id' => 'page_subheader_parallax',
                'return' => true,
            ),
        );

        $foodbakery_var_html_fields->foodbakery_var_checkbox_field( $foodbakery_var_opt_array );

        $foodbakery_var_html_fields->foodbakery_var_division_close( array() );

        $foodbakery_var_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_bg_color' ),
            'desc' => '',
            'hint_text' => foodbakery_var_frame_text_srt( 'foodbakery_var_bg_color_hint' ),
            'echo' => true,
            'field_params' => array(
                'std' => '',
                'id' => 'page_subheader_color',
                'classes' => 'bg_color',
                'return' => true,
            ),
        );

        $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_var_opt_array );

        $foodbakery_var_html_fields->foodbakery_var_division_close( array() );

        $foodbakery_var_opt_array = array(
            'id' => 'rev_slider_header',
            'enable_id' => 'foodbakery_var_header_banner_style',
            'enable_val' => 'custom_slider',
        );

        $foodbakery_var_html_fields->foodbakery_var_division( $foodbakery_var_opt_array );

        $foodbakery_slider_value = get_post_meta( $post->ID, 'foodbakery_var_custom_slider_id', true );
        $foodbakery_slider_options = '<option value="">' . foodbakery_var_frame_text_srt( 'foodbakery_var_slider' ) . '</option>';

        if ( class_exists( 'RevSlider' ) && class_exists( 'foodbakery_var_RevSlider' ) ) {

            $slider = new foodbakery_var_RevSlider();
            $arrSliders = $slider->getAllSliderAliases();

            if ( is_array( $arrSliders ) ) {
                foreach ( $arrSliders as $key => $entry ) {
                    $foodbakery_slider_selected = '';
                    if ( $foodbakery_slider_value != '' ) {
                        if ( $foodbakery_slider_value == $entry['alias'] ) {
                            $foodbakery_slider_selected = ' selected="selected"';
                        }
                    }
                    $foodbakery_slider_options .= '<option ' . $foodbakery_slider_selected . ' value="' . $entry['alias'] . '">' . $entry['title'] . '</option>';
                }
            }
        }

        $foodbakery_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_slider' ),
            'desc' => '',
            'hint_text' => '',
            'echo' => true,
            'field_params' => array(
                'std' => '',
                'id' => 'custom_slider_id',
                'classes' => 'dropdown chosen-select',
                'return' => true,
                'options_markup' => true,
                'options' => $foodbakery_slider_options,
            ),
        );
        $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );



        $foodbakery_var_html_fields->foodbakery_var_division_close( array() );


        $foodbakery_var_opt_array = array(
            'id' => 'map_header',
            'enable_id' => 'foodbakery_var_header_banner_style',
            'enable_val' => 'map',
        );

        $foodbakery_var_html_fields->foodbakery_var_division( $foodbakery_var_opt_array );


        $foodbakery_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_map_sc' ),
            'desc' => '',
            'hint_text' => '',
            'echo' => true,
            'field_params' => array(
                'std' => $foodbakery_default_map,
                'id' => 'custom_map',
                'classes' => '',
                'return' => true,
            ),
        );
        $foodbakery_var_html_fields->foodbakery_var_textarea_field( $foodbakery_opt_array );


        $foodbakery_var_html_fields->foodbakery_var_division_close( array() );

        $foodbakery_var_opt_array = array(
            'id' => 'no_header',
            'enable_id' => 'foodbakery_var_header_banner_style',
            'enable_val' => 'no-header',
        );

        $foodbakery_var_html_fields->foodbakery_var_division( $foodbakery_var_opt_array );


//        $foodbakery_var_opt_array = array(
//            'name' => foodbakery_var_frame_text_srt('foodbakery_var_header_border'),
//            'desc' => '',
//            'hint_text' => foodbakery_var_frame_text_srt('foodbakery_var_header_hint'),
//            'echo' => true,
//            'field_params' => array(
//                'std' => '',
//                'id' => 'main_header_border_color',
//                'classes' => 'bg_color',
//                'return' => true,
//            ),
//        );
//
//        $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_var_opt_array);
        $foodbakery_var_html_fields->foodbakery_var_division_close( array() );
        ?>
        <script>
            jQuery(document).ready(function () {
                chosen_selectionbox();
            });
        </script>
        <?php

    }

}

/**
 * @Sidebar Layout setting start
 * @return
 *
 */
if ( class_exists( 'RevSlider' ) && ! class_exists( 'foodbakery_var_RevSlider' ) ) {

    class foodbakery_var_RevSlider extends RevSlider {
        /*
         * Get sliders alias, Title, ID
         */

        public function getAllSliderAliases() {
            $where = "";
            $response = $this->db->fetch( GlobalsRevSlider::$table_sliders, $where, "id" );
            $arrAliases = array();
            $slider_array = array();
            foreach ( $response as $arrSlider ) {
                $arrAliases['id'] = $arrSlider["id"];
                $arrAliases['title'] = $arrSlider["title"];
                $arrAliases['alias'] = $arrSlider["alias"];
                $slider_array[] = $arrAliases;
            }
            return($slider_array);
        }

    }

}


if ( ! function_exists( 'foodbakery_sidebar_layout_options' ) ) {

    function foodbakery_sidebar_layout_options() {
        global $post, $pagenow, $foodbakery_var_options, $foodbakery_var_form_fields, $foodbakery_var_html_fields, $foodbakery_var_frame_static_text;

        // if (isset($post->post_type) && $post->post_type == 'page') {
//            $foodbakery_var_opt_array = array(
//                'name' => foodbakery_var_frame_text_srt('foodbakery_var_header_style'),
//                'desc' => '',
//                'hint_text' => '',
//                'echo' => true,
//                'field_params' => array(
//                    'std' => 'default_header_style',
//                    'id' => 'header_style',
//                    'return' => true,
//                    'classes' => 'dropdown chosen-select',
//                    'extra_atr' => 'onclick="foodbakery_header_element_toggle(this.value)"',
//                    'options' => array(
//                        'modern_header_style' => foodbakery_var_frame_text_srt('foodbakery_var_modern_header'),
//                        'default_header_style' => foodbakery_var_frame_text_srt('foodbakery_var_default_header')
//                    ),
//                ),
//            );
//
//
//            $foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_var_opt_array);
//        }
        $foodbakery_sidebars_array = array( '' => foodbakery_var_frame_text_srt( 'foodbakery_var_side_bar' ) );
        if ( isset( $foodbakery_var_options['foodbakery_var_sidebar'] ) && is_array( $foodbakery_var_options['foodbakery_var_sidebar'] ) && sizeof( $foodbakery_var_options['foodbakery_var_sidebar'] ) > 0 ) {
            foreach ( $foodbakery_var_options['foodbakery_var_sidebar'] as $key => $sidebar ) {
                $foodbakery_sidebars_array[sanitize_title( $sidebar )] = $sidebar;
            }
        }
        $bg_color = get_post_meta( get_the_id(), 'foodbakery_var_page_bg_color', true );
        $page_pg_val = isset( $bg_color[0] ) ? $bg_color[0] : '';
        $foodbakery_var_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_page_bg_color' ),
            'desc' => '',
            'hint_text' => '',
            'echo' => true,
            'field_params' => array(
                'std' => $page_pg_val,
                'id' => 'page_bg_color',
                'classes' => 'bg_color',
                'cust_name' => 'foodbakery_var_page_bg_color',
                'return' => true,
            ),
        );
        $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_var_opt_array );
        
        $foodbakery_var_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_page_margin' ),
            'desc' => '',
            'hint_text' => '',
            'echo' => true,
            'field_params' => array(
                'std' => '',
                'id' => 'page_margin_switch',
                'return' => true,
            ),
        );
        $foodbakery_var_html_fields->foodbakery_var_checkbox_field( $foodbakery_var_opt_array );
        
        $foodbakery_var_opt_array = array(
            'name' =>  esc_html__( 'Page Container', 'foodbakery' ),
            'desc' => '',
            'hint_text' => '',
            'echo' => true,
            'field_params' => array(
                'std' => '',
                'id' => 'page_container_switch',
                'return' => true,
            ),
        );

        $foodbakery_var_html_fields->foodbakery_var_checkbox_field( $foodbakery_var_opt_array );

        $foodbakery_var_html_fields->foodbakery_form_layout_render(
                array( 'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_choose_sidebar' ),
                    'id' => 'page_layout',
                    'std' => 'none',
                    'classes' => '',
                    'description' => '',
                    'onclick' => '',
                    'status' => '',
                    'meta' => '',
                    'help_text' => foodbakery_var_frame_text_srt( 'foodbakery_var_sidebar_hint' )
                )
        );

        $foodbakery_var_opt_array = array(
            'id' => 'left_layout',
            'enable_id' => 'foodbakery_var_page_layout',
            'enable_val' => 'left',
        );

        $foodbakery_var_html_fields->foodbakery_var_division( $foodbakery_var_opt_array );


        $foodbakery_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_left_sidebar' ),
            'desc' => '',
            'hint_text' => '',
            'echo' => true,
            'field_params' => array(
                'std' => '',
                'id' => 'page_sidebar_left',
                'classes' => 'dropdown chosen-select',
                'return' => true,
                'options' => $foodbakery_sidebars_array,
            ),
        );
        $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );


        $foodbakery_var_html_fields->foodbakery_var_division_close( array() );


        $foodbakery_var_opt_array = array(
            'id' => 'right_layout',
            'enable_id' => 'foodbakery_var_page_layout',
            'enable_val' => 'right',
        );

        $foodbakery_var_html_fields->foodbakery_var_division( $foodbakery_var_opt_array );


        $foodbakery_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_right_sidebar' ),
            'desc' => '',
            'hint_text' => '',
            'echo' => true,
            'field_params' => array(
                'std' => '',
                'id' => 'page_sidebar_right',
                'classes' => 'dropdown chosen-select',
                'return' => true,
                'options' => $foodbakery_sidebars_array,
            ),
        );
        $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );
        $foodbakery_var_html_fields->foodbakery_var_division_close( array() );

        // Extra Layouts
        $cs_extra_layouts = false;
        if ( $pagenow == 'post.php' && get_post_type() == 'page' ) {
            $cs_extra_layouts = true;
        }
        ?>
        <script>
            jQuery(document).ready(function () {
                chosen_selectionbox();
            });
        </script>
        <?php

    }

}

if ( ! function_exists( 'foodbakery_header_element' ) ) {

    function foodbakery_header_element() {
        global $post, $foodbakery_var_form_fields, $foodbakery_var_html_fields, $foodbakery_var_frame_static_text;
        $page_header_no_image = '';

        $foodbakery_var_opt_array = array(
            'name' => foodbakery_var_frame_text_srt( 'foodbakery_var_choose_header' ),
            'desc' => '',
            'hint_text' => '',
            'echo' => true,
            'field_params' => array(
                'std' => 'simple_header',
				'id' => 'simple_header',
                'return' => true,
                'classes' => 'dropdown chosen-select',
                'options' => array(
                    'simple_header' => foodbakery_var_frame_text_srt( 'foodbakery_var_default_header' ),
                    'transparennt_header' => foodbakery_var_frame_text_srt( 'foodbakery_var_transparent_header' ),
                ),
            ),
        );

        $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_var_opt_array );

        ?>
        <script>
            jQuery(document).ready(function () {
                chosen_selectionbox();
            });
        </script>
        <?php

    }

}
