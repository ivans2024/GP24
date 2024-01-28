<?php
/*
 *
 * @File : Image Frame 
 * @retrun
 *
 */

if ( ! function_exists( 'foodbakery_var_page_builder_promobox' ) ) {

    function foodbakery_var_page_builder_promobox( $die = 0 ) {
        global $post, $foodbakery_node, $foodbakery_var_html_fields, $coloumn_class, $foodbakery_var_form_fields, $foodbakery_var_static_text;

        if ( function_exists( 'foodbakery_shortcode_names' ) ) {
            $shortcode_element = '';
            $filter_element = 'filterdrag';
            $shortcode_view = '';
            $foodbakery_output = array();
            $FOODBAKERY_PREFIX = 'foodbakery_promobox';
            $foodbakery_counter = isset( $_POST['foodbakery_counter'] ) ? $_POST['foodbakery_counter'] : '';
            $foodbakery_counter = ($foodbakery_counter == '') ? $_POST['counter'] : $foodbakery_counter;
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
                'foodbakery_var_column' => '',
                'foodbakery_var_image_section_title' => '',
                'foodbakery_promobox_select_background' => '',
                'foodbakery_var_promobox_button_title' => '',
                'foodbakery_var_frame_image_url_array' => '',
                'foodbakery_var_frame_promo_image_url_array' => '',
                'foodbakery_var_app_store_image_url_array' => '',
                'foodbakery_promobox_button_bg_color' => '',
                'foodbakery_promobox_bg_color' => '',
                'foodbakery_var_promobox_title' => '',
                'foodbakery_var_promobox_button_url' => '',
                'foodbakery_promobox_title_color' => '',
                'foodbakery_var_promo_box_view' => '',
                'foodbakery_var_app_store_url' => '',
                'foodbakery_var_google_store_image_url_array' => '',
                'foodbakery_var_google_store_url' => '',
                'foodbakery_var_email' => '',
                'foodbakery_var_promo_align' => '',
            );
            if ( isset( $foodbakery_output['0']['atts'] ) ) {
                $atts = $foodbakery_output['0']['atts'];
            } else {
                $atts = array();
            }
            if ( isset( $foodbakery_output['0']['content'] ) ) {
                $foodbakery_var_image_description = $foodbakery_output['0']['content'];
            } else {
                $foodbakery_var_image_description = '';
            }
            $promobox_element_size = '25';
            foreach ( $defaults as $key => $values ) {
                if ( isset( $atts[$key] ) ) {
                    $$key = $atts[$key];
                } else {
                    $$key = $values;
                }
            }
            $name = 'foodbakery_var_page_builder_promobox';
            $coloumn_class = 'column_' . $promobox_element_size;
            $foodbakery_var_image_section_title = isset( $foodbakery_var_image_section_title ) ? $foodbakery_var_image_section_title : '';
            $foodbakery_var_promobox_button_title = isset( $foodbakery_var_promobox_button_title ) ? $foodbakery_var_promobox_button_title : '';
            $foodbakery_promobox_select_background = isset( $foodbakery_promobox_select_background ) ? $foodbakery_promobox_select_background : '';
            $foodbakery_var_frame_image_url_array = isset( $foodbakery_var_frame_image_url_array ) ? $foodbakery_var_frame_image_url_array : '';
            $foodbakery_promobox_button_bg_color = isset( $foodbakery_promobox_button_bg_color ) ? $foodbakery_promobox_button_bg_color : '';
            $foodbakery_promobox_bg_color = isset( $foodbakery_promobox_bg_color ) ? $foodbakery_promobox_bg_color : '';
            $foodbakery_var_promobox_title = isset( $foodbakery_var_promobox_title ) ? $foodbakery_var_promobox_title : '';
            $foodbakery_var_promobox_button_url = isset( $foodbakery_var_promobox_button_url ) ? $foodbakery_var_promobox_button_url : '';
            $foodbakery_promobox_title_color = isset( $foodbakery_promobox_title_color ) ? $foodbakery_promobox_title_color : '';
            $foodbakery_var_frame_promo_image_url_array = isset( $foodbakery_var_frame_promo_image_url_array ) ? $foodbakery_var_frame_promo_image_url_array : '';
            $foodbakery_var_app_store_image_url_array = isset( $foodbakery_var_app_store_image_url_array ) ? $foodbakery_var_app_store_image_url_array : '';
            $foodbakery_var_app_store_url = isset( $foodbakery_var_app_store_url ) ? $foodbakery_var_app_store_url : '';
            $foodbakery_var_google_store_image_url_array = isset( $foodbakery_var_google_store_image_url_array ) ? $foodbakery_var_google_store_image_url_array : '';
            $foodbakery_var_google_store_url = isset( $foodbakery_var_google_store_url ) ? $foodbakery_var_google_store_url : '';
            $foodbakery_var_email = isset( $foodbakery_var_email ) ? $foodbakery_var_email : '';
            $foodbakery_var_promo_box_view = isset( $foodbakery_var_promo_box_view ) ? $foodbakery_var_promo_box_view : '';
            $foodbakery_var_promo_align = isset($foodbakery_var_promo_align) ? $foodbakery_var_promo_align : '';
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
                 <?php echo esc_attr( $shortcode_view ); ?>" item="promobox" data="<?php echo foodbakery_element_size_data_array_index( $promobox_element_size ) ?>" >
                     <?php foodbakery_element_setting( $name, $foodbakery_counter, $promobox_element_size ) ?>
                <div class="cs-wrapp-class-<?php echo intval( $foodbakery_counter ) ?>
                     <?php echo esc_attr( $shortcode_element ); ?>" id="<?php echo esc_attr( $name . $foodbakery_counter ) ?>" data-shortcode-template="[foodbakery_promobox {{attributes}}]{{content}}[/foodbakery_promobox]" style="display: none;">
                    <div class="cs-heading-area" data-counter="<?php echo esc_attr( $foodbakery_counter ) ?>">
                        <h5><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_promo_box_options' ) ); ?></h5>
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
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_image_field_name' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_image_field_name_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr( $foodbakery_var_image_section_title ),
                                    'cust_id' => 'foodbakery_var_image_section_title' . $foodbakery_counter,
                                    'classes' => '',
                                    'cust_name' => 'foodbakery_var_image_section_title[]',
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
                                        'std' => $foodbakery_var_promo_align,
                                        'id' => '',
                                        'cust_id' => 'foodbakery_var_promo_align',
                                        'cust_name' => 'foodbakery_var_promo_align[]',
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
                            
                            //select promobox background (Color/Image)
                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_background' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_background_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => $foodbakery_promobox_select_background,
                                    'id' => '',
                                    'cust_name' => 'foodbakery_promobox_select_background[]',
                                    'classes' => 'dropdown chosen-select',
                                    'extra_atr' => '',
                                    'options' => array(
                                        'image' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_background_image' ),
                                        'color' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_background_color' ),
                                    ),
                                    'return' => true,
                                ),
                            );
                            
							$foodbakery_opt_array = array(
                                'std' => esc_url( $foodbakery_var_frame_image_url_array ),
                                'id' => 'frame_image_url',
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_image_field_url' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_image_field_url_hint' ),
                                'echo' => true,
                                'array' => true,
                                'prefix' => '',
                                'field_params' => array(
                                    'std' => esc_url( $foodbakery_var_frame_image_url_array ),
                                    'id' => 'frame_image_url',
                                    'return' => true,
                                    'array' => true,
                                    'array_txt' => false,
                                    'prefix' => '',
                                ),
                            );
                            $foodbakery_var_html_fields->foodbakery_var_upload_file_field( $foodbakery_opt_array );
                            //background color
                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_bg_color_field' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_bg_color_field_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_html( $foodbakery_promobox_bg_color ),
                                    'id' => 'foodbakery_promobox_bg_color',
                                    'cust_name' => 'foodbakery_promobox_bg_color[]',
                                    'classes' => 'bg_color',
                                    'return' => true,
                                ),
                            );
                            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );
                            //image
                            $foodbakery_opt_array = array(
                                'std' => esc_url( $foodbakery_var_frame_promo_image_url_array ),
                                'id' => 'frame_promo_image_url',
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_select_image' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_select_image_hint' ),
                                'echo' => true,
                                'array' => true,
                                'prefix' => '',
                                'field_params' => array(
                                    'std' => esc_url( $foodbakery_var_frame_promo_image_url_array ),
                                    'id' => 'frame_promo_image_url',
                                    'return' => true,
                                    'array' => true,
                                    'array_txt' => false,
                                    'prefix' => '',
                                ),
                            );
                            $foodbakery_var_html_fields->foodbakery_var_upload_file_field( $foodbakery_opt_array );
                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_title' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_title_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr( $foodbakery_var_promobox_title ),
                                    'cust_id' => '',
                                    'classes' => 'txtfield',
                                    'cust_name' => 'foodbakery_var_promobox_title[]',
                                    'return' => true,
                                ),
                            );
                            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );
                            //promobox title color
                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_title_color' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_title_color_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_html( $foodbakery_promobox_title_color ),
                                    'id' => 'foodbakery_promobox_title_color',
                                    'cust_name' => 'foodbakery_promobox_title_color[]',
                                    'classes' => 'bg_color',
                                    'return' => true,
                                ),
                            );

                            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_promo_box_styles' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_promo_box_styles_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => $foodbakery_var_promo_box_view,
                                    'id' => '',
                                    'cust_id' => 'foodbakery_var_promo_box_view',
                                    'cust_name' => 'foodbakery_var_promo_box_view[]',
                                    'classes' => 'foodbakery_var_promo_box_view chosen-select select-medium view_class',
                                    //'extra_atr' => ' onclick="promobox_div_hide()"',
                                    'options' => array(
                                        'classic' => foodbakery_var_theme_text_srt( 'foodbakery_var_promo_box_style_classic' ),
                                        'fancy' => foodbakery_var_theme_text_srt( 'foodbakery_var_promo_box_style_fancy' ),
                                    ),
                                    'return' => true,
                                ),
                            );
                            $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );
                            $show_div = 'none';
                            if ( $foodbakery_var_promo_box_view == 'classic' ) {
                                $show_div = 'block';
                            } else {
                                $show_div = 'none';
                            }
                            ?>
                            <script type="text/javascript">
                                jQuery('.view_class').change(function ($) {
                                    var value = jQuery(this).val();
                                    var parentNode = jQuery(this).parent().parent().parent();
                                    if (value == 'fancy') {
                                        parentNode.find("#order_div").hide();
                                    } else {
                                        parentNode.find("#order_div").show();
                                    }
                                }
                                );
                            </script>
                            <div id="order_div" style="display:<?php echo esc_html( $show_div  ) ?>;">
                                <?php
                                $foodbakery_opt_array = array(
                                    'std' => esc_url( $foodbakery_var_app_store_image_url_array ),
                                    'id' => 'app_store_image_url',
                                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_app_store_image' ),
                                    'desc' => '',
                                    'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_app_store_image_hint' ),
                                    'echo' => true,
                                    'array' => true,
                                    'prefix' => '',
                                    'field_params' => array(
                                        'std' => esc_url( $foodbakery_var_app_store_image_url_array ),
                                        'id' => 'app_store_image_url',
                                        'return' => true,
                                        'array' => true,
                                        'array_txt' => false,
                                        'prefix' => '',
                                    ),
                                );
                                $foodbakery_var_html_fields->foodbakery_var_upload_file_field( $foodbakery_opt_array );

                                $foodbakery_opt_array = array(
                                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_app_store_url' ),
                                    'desc' => '',
                                    'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_app_store_url_hint' ),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => esc_attr( $foodbakery_var_app_store_url ),
                                        'cust_id' => 'foodbakery_var_app_store_url' . $foodbakery_counter,
                                        'classes' => '',
                                        'cust_name' => 'foodbakery_var_app_store_url[]',
                                        'return' => true,
                                    ),
                                );
                                $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                                $foodbakery_opt_array = array(
                                    'std' => esc_url( $foodbakery_var_google_store_image_url_array ),
                                    'id' => 'google_store_image_url',
                                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_google_play' ),
                                    'desc' => '',
                                    'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_google_play_hint' ),
                                    'echo' => true,
                                    'array' => true,
                                    'prefix' => '',
                                    'field_params' => array(
                                        'std' => esc_url( $foodbakery_var_google_store_image_url_array ),
                                        'id' => 'google_store_image_url',
                                        'return' => true,
                                        'array' => true,
                                        'array_txt' => false,
                                        'prefix' => '',
                                    ),
                                );
                                $foodbakery_var_html_fields->foodbakery_var_upload_file_field( $foodbakery_opt_array );

                                $foodbakery_opt_array = array(
                                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_google_store_url' ),
                                    'desc' => '',
                                    'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_google_store_url_hint' ),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => esc_attr( $foodbakery_var_google_store_url ),
                                        'cust_id' => 'foodbakery_var_google_store_url' . $foodbakery_counter,
                                        'classes' => '',
                                        'cust_name' => 'foodbakery_var_google_store_url[]',
                                        'return' => true,
                                    ),
                                );
                                $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

                                $foodbakery_opt_array = array(
                                    'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_email' ),
                                    'desc' => '',
                                    'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_email_hint' ),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => esc_attr( $foodbakery_var_email ),
                                        'cust_id' => 'foodbakery_var_email' . $foodbakery_counter,
                                        'classes' => '',
                                        'cust_name' => 'foodbakery_var_email[]',
                                        'return' => true,
                                    ),
                                );
                                $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );
                                ?>
                            </div>
                            <?php
                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_field_desc' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_field_desc_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_textarea( $foodbakery_var_image_description ),
                                    'cust_id' => 'foodbakery_var_image_description' . $foodbakery_counter,
                                    'classes' => 'textarea',
                                    'cust_name' => 'foodbakery_var_image_description[]',
                                    'return' => true,
                                    'foodbakery_editor' => true,
                                    'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
                                ),
                            );
                            $foodbakery_var_html_fields->foodbakery_var_textarea_field( $foodbakery_opt_array );
                            //button
                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_button_title' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_button_title_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr( $foodbakery_var_promobox_button_title ),
                                    'cust_id' => '',
                                    'classes' => 'txtfield',
                                    'cust_name' => 'foodbakery_var_promobox_button_title[]',
                                    'return' => true,
                                ),
                            );
                            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );
                            //button bg color
                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_button_bg_color' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_button_bg_color_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_html( $foodbakery_promobox_button_bg_color ),
                                    'id' => 'foodbakery_promobox_button_bg_color',
                                    'cust_name' => 'foodbakery_promobox_button_bg_color[]',
                                    'classes' => 'bg_color',
                                    'return' => true,
                                ),
                            );

                            $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );
                            $foodbakery_opt_array = array(
                                'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_button_url' ),
                                'desc' => '',
                                'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_promobox_button_url_hint' ),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr( $foodbakery_var_promobox_button_url ),
                                    'cust_id' => '',
                                    'classes' => 'txtfield',
                                    'cust_name' => 'foodbakery_var_promobox_button_url[]',
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
            <?php } else { ?>

                            <?php
                            $foodbakery_opt_array = array(
                                'std' => 'promobox',
                                'id' => '',
                                'before' => '',
                                'after' => '',
                                'classes' => '',
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
                                    'cust_id' => 'promobox_save',
                                    'cust_type' => 'button',
                                    'classes' => 'cs-foodbakery-admin-btn',
                                    'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
                                    'cust_name' => 'promobox_save' . $foodbakery_counter,
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

    add_action( 'wp_ajax_foodbakery_var_page_builder_promobox', 'foodbakery_var_page_builder_promobox' );
}

if ( ! function_exists( 'foodbakery_save_page_builder_data_promobox_callback' ) ) {

    /**
     * Save data for image frame shortcode.
     *
     * @param	array $args
     * @return	array
     */
    function foodbakery_save_page_builder_data_promobox_callback( $args ) {
        $data = $args['data'];
        $counters = $args['counters'];
        $widget_type = $args['widget_type'];
        $column = $args['column'];
        $shortcode_data ='';
        if ($widget_type == "promobox" || $widget_type == "cs_promobox") {
            $foodbakery_var_promobox = '';
            $page_element_size  =  $data['promobox_element_size'][$counters['foodbakery_global_counter_promobox']];
            $current_element_size  =  $data['promobox_element_size'][$counters['foodbakery_global_counter_promobox']];
            
            if ( isset( $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] ) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode' ) {
                $shortcode_str = stripslashes( ( $data['shortcode']['promobox'][$counters['foodbakery_shortcode_counter_promobox']] ) );
                
                $element_settings   = 'promobox_element_size="'.$current_element_size.'"';
                $reg = '/promobox_element_size="(\d+)"/s';
                $shortcode_str  = preg_replace( $reg, $element_settings, $shortcode_str );
                $shortcode_data .= $shortcode_str;
                $counters['foodbakery_shortcode_counter_promobox'] ++;
            } else {
                $foodbakery_var_promobox = '[foodbakery_promobox promobox_element_size="'.htmlspecialchars( $data['promobox_element_size'][$counters['foodbakery_global_counter_promobox']] ).'" ';
                if ( isset( $data['foodbakery_var_image_section_title'][$counters['foodbakery_counter_promobox']] ) && $data['foodbakery_var_image_section_title'][$counters['foodbakery_counter_promobox']] != '' ) {
                    $foodbakery_var_promobox .= 'foodbakery_var_image_section_title="' . htmlspecialchars( $data['foodbakery_var_image_section_title'][$counters['foodbakery_counter_promobox']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_promobox_title'][$counters['foodbakery_counter_promobox']] ) && $data['foodbakery_var_promobox_title'][$counters['foodbakery_counter_promobox']] != '' ) {
                    $foodbakery_var_promobox .= 'foodbakery_var_promobox_title="' . htmlspecialchars( $data['foodbakery_var_promobox_title'][$counters['foodbakery_counter_promobox']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_promo_align'][$counters['foodbakery_counter_promobox']] ) && $data['foodbakery_var_promo_align'][$counters['foodbakery_counter_promobox']] != '' ) {
                    $foodbakery_var_promobox .= 'foodbakery_var_promo_align="' . htmlspecialchars( $data['foodbakery_var_promo_align'][$counters['foodbakery_counter_promobox']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_promobox_title_color'][$counters['foodbakery_counter_promobox']] ) && $data['foodbakery_promobox_title_color'][$counters['foodbakery_counter_promobox']] != '' ) {
                    $foodbakery_var_promobox .= 'foodbakery_promobox_title_color="' . htmlspecialchars( $data['foodbakery_promobox_title_color'][$counters['foodbakery_counter_promobox']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_promobox_select_background'][$counters['foodbakery_counter_promobox']] ) && $data['foodbakery_promobox_select_background'][$counters['foodbakery_counter_promobox']] != '' ) {
                    $foodbakery_var_promobox .= 'foodbakery_promobox_select_background="' . htmlspecialchars( $data['foodbakery_promobox_select_background'][$counters['foodbakery_counter_promobox']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_promobox_button_title'][$counters['foodbakery_counter_promobox']] ) && $data['foodbakery_var_promobox_button_title'][$counters['foodbakery_counter_promobox']] != '' ) {
                    $foodbakery_var_promobox .= 'foodbakery_var_promobox_button_title="' . htmlspecialchars( $data['foodbakery_var_promobox_button_title'][$counters['foodbakery_counter_promobox']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_promo_box_view'][$counters['foodbakery_counter_promobox']] ) && $data['foodbakery_var_promo_box_view'][$counters['foodbakery_counter_promobox']] != '' ) {
                    $foodbakery_var_promobox .= 'foodbakery_var_promo_box_view="' . htmlspecialchars( $data['foodbakery_var_promo_box_view'][$counters['foodbakery_counter_promobox']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_frame_image_url_array'][$counters['foodbakery_counter_promobox']] ) && $data['foodbakery_var_frame_image_url_array'][$counters['foodbakery_counter_promobox']] != '' ) {
                    $foodbakery_var_promobox .= 'foodbakery_var_frame_image_url_array="' . htmlspecialchars( $data['foodbakery_var_frame_image_url_array'][$counters['foodbakery_counter_promobox']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_app_store_image_url_array'][$counters['foodbakery_counter_promobox']] ) && $data['foodbakery_var_app_store_image_url_array'][$counters['foodbakery_counter_promobox']] != '' ) {
                    $foodbakery_var_promobox .= 'foodbakery_var_app_store_image_url_array="' . htmlspecialchars( $data['foodbakery_var_app_store_image_url_array'][$counters['foodbakery_counter_promobox']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_app_store_url'][$counters['foodbakery_counter_promobox']] ) && $data['foodbakery_var_app_store_url'][$counters['foodbakery_counter_promobox']] != '' ) {
                    $foodbakery_var_promobox .= 'foodbakery_var_app_store_url="' . htmlspecialchars( $data['foodbakery_var_app_store_url'][$counters['foodbakery_counter_promobox']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_google_store_image_url_array'][$counters['foodbakery_counter_promobox']] ) && $data['foodbakery_var_google_store_image_url_array'][$counters['foodbakery_counter_promobox']] != '' ) {
                    $foodbakery_var_promobox .= 'foodbakery_var_google_store_image_url_array="' . htmlspecialchars( $data['foodbakery_var_google_store_image_url_array'][$counters['foodbakery_counter_promobox']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_google_store_url'][$counters['foodbakery_counter_promobox']] ) && $data['foodbakery_var_google_store_url'][$counters['foodbakery_counter_promobox']] != '' ) {
                    $foodbakery_var_promobox .= 'foodbakery_var_google_store_url="' . htmlspecialchars( $data['foodbakery_var_google_store_url'][$counters['foodbakery_counter_promobox']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_email'][$counters['foodbakery_counter_promobox']] ) && $data['foodbakery_var_email'][$counters['foodbakery_counter_promobox']] != '' ) {
                    $foodbakery_var_promobox .= 'foodbakery_var_email="' . htmlspecialchars( $data['foodbakery_var_email'][$counters['foodbakery_counter_promobox']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_frame_promo_image_url_array'][$counters['foodbakery_counter_promobox']] ) && $data['foodbakery_var_frame_promo_image_url_array'][$counters['foodbakery_counter_promobox']] != '' ) {
                    $foodbakery_var_promobox .= 'foodbakery_var_frame_promo_image_url_array="' . htmlspecialchars( $data['foodbakery_var_frame_promo_image_url_array'][$counters['foodbakery_counter_promobox']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_promobox_button_bg_color'][$counters['foodbakery_counter_promobox']] ) && $data['foodbakery_promobox_button_bg_color'][$counters['foodbakery_counter_promobox']] != '' ) {
                    $foodbakery_var_promobox .= 'foodbakery_promobox_button_bg_color="' . htmlspecialchars( $data['foodbakery_promobox_button_bg_color'][$counters['foodbakery_counter_promobox']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_var_promobox_button_url'][$counters['foodbakery_counter_promobox']] ) && $data['foodbakery_var_promobox_button_url'][$counters['foodbakery_counter_promobox']] != '' ) {
                    $foodbakery_var_promobox .= 'foodbakery_var_promobox_button_url="' . htmlspecialchars( $data['foodbakery_var_promobox_button_url'][$counters['foodbakery_counter_promobox']], ENT_QUOTES ) . '" ';
                }
                if ( isset( $data['foodbakery_promobox_bg_color'][$counters['foodbakery_counter_promobox']] ) && $data['foodbakery_promobox_bg_color'][$counters['foodbakery_counter_promobox']] != '' ) {
                    $foodbakery_var_promobox .= 'foodbakery_promobox_bg_color="' . htmlspecialchars( $data['foodbakery_promobox_bg_color'][$counters['foodbakery_counter_promobox']], ENT_QUOTES ) . '" ';
                }
                $foodbakery_var_promobox .= ']';
                if ( isset( $data['foodbakery_var_image_description'][$counters['foodbakery_counter_promobox']] ) && $data['foodbakery_var_image_description'][$counters['foodbakery_counter_promobox']] != '' ) {
                    $foodbakery_var_promobox .= htmlspecialchars( $data['foodbakery_var_image_description'][$counters['foodbakery_counter_promobox']], ENT_QUOTES ) . ' ';
                }
                $foodbakery_var_promobox .= '[/foodbakery_promobox]';

                $shortcode_data .= $foodbakery_var_promobox;
                $counters['foodbakery_counter_promobox'] ++;
            }
            $counters['foodbakery_global_counter_promobox'] ++;
        }
        return array(
            'data' => $data,
            'counters' => $counters,
            'widget_type' => $widget_type,
            'column' => $shortcode_data,
        );
    }

    add_filter( 'foodbakery_save_page_builder_data_promobox', 'foodbakery_save_page_builder_data_promobox_callback' );
}

if ( ! function_exists( 'foodbakery_load_shortcode_counters_promobox_callback' ) ) {

    /**
     * Populate image frame shortcode counter variables.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_load_shortcode_counters_promobox_callback( $counters ) {
        $counters['foodbakery_global_counter_promobox'] = 0;
        $counters['foodbakery_shortcode_counter_promobox'] = 0;
        $counters['foodbakery_counter_promobox'] = 0;
        return $counters;
    }

    add_filter( 'foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_promobox_callback' );
}
if ( ! function_exists( 'foodbakery_shortcode_names_list_populate_promobox_callback' ) ) {

    /**
     * Populate image frame shortcode names list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_shortcode_names_list_populate_promobox_callback( $shortcode_array ) {
        $shortcode_array['promobox'] = array(
            'title' => foodbakery_var_frame_text_srt( 'foodbakery_var_promobox' ),
            'name' => 'promobox',
            'icon' => 'icon-photo',
            'categories' => 'typography',
        );
        return $shortcode_array;
    }

    add_filter( 'foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_promobox_callback' );
}

if ( ! function_exists( 'foodbakery_element_list_populate_promobox_callback' ) ) {

    /**
     * Populate image frame shortcode strings list.
     *
     * @param	array $counters
     * @return	array
     */
    function foodbakery_element_list_populate_promobox_callback( $element_list ) {
        $element_list['promobox'] = foodbakery_var_frame_text_srt( 'foodbakery_var_promobox' );
        return $element_list;
    }

    add_filter( 'foodbakery_element_list_populate', 'foodbakery_element_list_populate_promobox_callback' );
}