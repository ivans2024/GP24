<?php

/**
 * Foodbakery_Flickr Class
 *
 * @package Foodbakery
 */
if ( ! class_exists( 'Foodbakery_Ads' ) ) {

    /**
      Foodbakery_Ads class used to implement the custom ads widget.
     */
    class Foodbakery_Ads extends WP_Widget {

        /**
         * Sets up a new foodbakery ads widget instance.
         */
        public function __construct() {
            global $foodbakery_var_static_text;

            parent::__construct(
                    'foodbakery_ads', // Base ID.
                    foodbakery_var_theme_text_srt( 'foodbakery_var_ads' ), // Name.
                    array( 'classname' => 'widget-ad', 'description' => foodbakery_var_theme_text_srt( 'foodbakery_var_ads_description' ) )
            );
        }

        /**
         * Outputs the foodbakery ads widget settings form.
         *
         * @param array $instance current settings.
         */
        function form( $instance ) {
            global $foodbakery_var_form_fields, $foodbakery_var_html_fields, $foodbakery_var_static_text;

            $cs_rand_id = rand( 23789, 934578930 );
            $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'banner_code' => '' ) );
            $title = $instance['title'];
            $banner_style = isset( $instance['banner_style'] ) ? esc_attr( $instance['banner_style'] ) : '';
            $banner_code = $instance['banner_code'];
            $banner_view = isset( $instance['banner_view'] ) ? esc_attr( $instance['banner_view'] ) : '';
            $showcount = isset( $instance['showcount'] ) ? esc_attr( $instance['showcount'] ) : '';
            $has_border = isset( $instance['has_border'] ) ? esc_attr( $instance['has_border'] ) : '';

            $strings = new foodbakery_theme_all_strings;
            $strings->foodbakery_short_code_strings();

            $foodbakery_opt_array = array(
                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_title_field' ),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr( $title ),
                    'classes' => '',
                    'cust_id' => foodbakery_allow_special_char( $this->get_field_name( 'title' ) ),
                    'cust_name' => foodbakery_allow_special_char( $this->get_field_name( 'title' ) ),
                    'return' => true,
                    'required' => false,
                ),
            );
            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

            $foodbakery_opt_array = array(
                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_view' ),
                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_view_hint' ),
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr( $banner_view ),
                    'cust_id' => foodbakery_allow_special_char( $this->get_field_id( 'banner_view' ) ),
                    'cust_name' => foodbakery_allow_special_char( $this->get_field_name( 'banner_view' ) ),
                    'extra_atr' => 'onchange="javascript:banner_widget_toggle(this.value ,  \'' . $cs_rand_id . '\')"',
                    'desc' => '',
                    'classes' => '',
                    'options' => array(
                        'single' => foodbakery_var_theme_text_srt( 'foodbakery_var_single_banner' ),
                        'random' => foodbakery_var_theme_text_srt( 'foodbakery_var_random_banner' ),
                    ),
                    'return' => true,
                ),
            );

            $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );
            $display_single = foodbakery_allow_special_char( $banner_view ) == 'random' ? 'block' : 'none';
            echo '<div class="banner_style_field_' . esc_attr( $cs_rand_id ) . '" style="display:' . esc_html( $display_single ) . '">';

            $foodbakery_opt_array = array(
                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_style' ),
                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_style_hint' ),
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr( $banner_style ),
                    'cust_id' => foodbakery_allow_special_char( $this->get_field_id( 'banner_style' ) ),
                    'cust_name' => foodbakery_allow_special_char( $this->get_field_name( 'banner_style' ) ),
                    'desc' => '',
                    'classes' => '',
                    'options' => array(
                        'top_banner' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_type_top' ),
                        'bottom_banner' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_type_bottom' ),
                        'sidebar_banner' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_type_sidebar' ),
                        'vertical_banner' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_type_vertical' ),
                    ),
                    'return' => true,
                ),
            );
            $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );

            $foodbakery_opt_array = array(
                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_no_of_banner' ),
                'desc' => '',
                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_no_of_banner_hint' ),
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr( $showcount ),
                    'classes' => '',
                    'cust_id' => foodbakery_allow_special_char( $this->get_field_name( 'showcount' ) ),
                    'cust_name' => foodbakery_allow_special_char( $this->get_field_name( 'showcount' ) ),
                    'return' => true,
                    'required' => false,
                ),
            );
            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );
            echo '</div>';

            $display_random = foodbakery_allow_special_char( $banner_view ) == 'single' ? 'block' : 'none';
            if ( 'single' !== $banner_view && 'random' !== $banner_view ) {
                $display_random = 'block';
            }
            echo '<div class="banner_code_field_' . esc_attr( $cs_rand_id ) . '" style="display:' . esc_html( $display_random ) . '">';
            $foodbakery_opt_array = array(
                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_code' ),
                'desc' => '',
                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_code_hint' ),
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr( $banner_code ),
                    'classes' => '',
                    'cust_id' => foodbakery_allow_special_char( $this->get_field_name( 'banner_code' ) ),
                    'cust_name' => foodbakery_allow_special_char( $this->get_field_name( 'banner_code' ) ),
                    'return' => true,
                    'required' => false,
                ),
            );
            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );
            echo '</div>';

            $foodbakery_opt_array = array(
                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_border' ),
                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_border_desc' ),
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr( $has_border ),
                    'cust_id' => foodbakery_allow_special_char( $this->get_field_id( 'has_border' ) ),
                    'cust_name' => foodbakery_allow_special_char( $this->get_field_name( 'has_border' ) ),
                    'extra_atr' => 'onchange="javascript:banner_widget_toggle(this.value ,  \'' . $cs_rand_id . '\')"',
                    'desc' => '',
                    'classes' => '',
                    'options' => array(
                        'no' => foodbakery_var_theme_text_srt( 'foodbakery_var_no' ),
                        'yes' => foodbakery_var_theme_text_srt( 'foodbakery_var_yes' ),
                    ),
                    'return' => true,
                ),
            );
            $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );
        }

        /**
         * Handles updating settings for the current foodbakery ads widget instance.
         *
         * @param array $new_instance New settings for this instance as input by the user.
         * @param array $old_instance Old settings for this instance.
         * @return array Settings to save or bool false to cancel saving.
         */
        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['banner_style'] = esc_sql( $new_instance['banner_style'] );
            $instance['banner_code'] = $new_instance['banner_code'];
            $instance['banner_view'] = esc_sql( $new_instance['banner_view'] );
            $instance['showcount'] = esc_sql( $new_instance['showcount'] );
            $instance['has_border'] = esc_sql( $new_instance['has_border'] );
            return $instance;
        }

        /**
         * Outputs the content for the current foodbakery ads widget instance.
         *
         * @param array $args Display arguments including 'before_title', 'after_title',
         *                        'before_widget', and 'after_widget'.
         * @param array $instance Settings for the current ads widget instance.
         */
        function widget( $args, $instance ) {

            extract( $args, EXTR_SKIP );
            global $wpdb, $post, $foodbakery_var_options;
            $title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );

            $title = wp_specialchars_decode( stripslashes( $title ) );
            $banner_style = empty( $instance['banner_style'] ) ? ' ' : apply_filters( 'widget_title', $instance['banner_style'] );
            $banner_code = empty( $instance['banner_code'] ) ? ' ' : $instance['banner_code'];
            $banner_view = empty( $instance['banner_view'] ) ? ' ' : apply_filters( 'widget_title', $instance['banner_view'] );
            $showcount = empty( $instance['showcount'] ) ? ' ' : $instance['showcount'];
            $has_border = ( 'yes' === $instance['has_border'] ) ? 'has-border' : '';

            echo '<div class="widget widget-ad ' . esc_attr( $has_border ) . '">';
            if ( '' !== $title ) {
                echo foodbakery_allow_special_char( $args['before_title'] . $title . $args['after_title'] );
            }
            $showcount = ( '' !== $showcount || ! is_integer( $showcount ) ) ? $showcount : 2;

            if ( 'single' === $banner_view ) {
                echo do_shortcode( $banner_code );
            } else {

                $total_banners = ( is_integer( $showcount ) && $showcount > 10) ? 10 : $showcount;

                if ( isset( $foodbakery_var_options['foodbakery_var_banner_title'] ) ) {
                    $i = 0;
                    $d = 0;
                    $banner_array = array();
                    foreach ( $foodbakery_var_options['foodbakery_var_banner_title'] as $banner ) :
                        if ( $banner_style === $foodbakery_var_options['foodbakery_var_banner_style'][$i] ) {
                            $banner_array[] = $i;
                            $d ++;
                        }
                        if ( $total_banners === $d ) {
                            break;
                        }
                        $i ++;
                    endforeach;
                    if ( count( $banner_array ) > 0 ) {
                        $act_size = count( $banner_array ) - 1;
                        $rand_banner = rand( 0, $act_size );

                        $rand_banner = $banner_array[$rand_banner];
                        echo do_shortcode( '[foodbakery_ads id="' . $foodbakery_var_options['foodbakery_var_banner_field_code_no'][$rand_banner] . '"]' );
                    }
                }
            }
            echo '</div>';
        }

    }

}
if (function_exists('cs_widget_register')) {
    cs_widget_register("Foodbakery_Ads");
}



