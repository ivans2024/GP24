<?php
/*
 *
 * @Shortcode Name : Start function for Section shortcode/element front end view
 * @retrun
 *
 */

if (!function_exists('foodbakery_var_section_shortocde')) {

    function foodbakery_var_section_shortocde($atts, $content = "") {
        global $post;
        $foodbakery_section_titlt_color = $foodbakery_section_subtitlt_color = $foodbakery_section_bg_image = $foodbakery_var_section_title = $foodbakery_var_section_subtitle = $title_sub_title_alignment = $foodbakery_section_bg_image_position = $foodbakery_section_bg_image_repeat = $foodbakery_section_bg_color = $foodbakery_section_padding_top = $foodbakery_section_padding_bottom = $foodbakery_section_custom_style = $foodbakery_section_css_id = $foodbakery_layout = $foodbakery_sidebar_left = $foodbakery_sidebar_right = $css_bg_image = '';
        $section_style_elements = '';
        $foodbakery_page_layout = '';
        $section_container_style_elements = '';
        $foodbakery_section_nopadding = '';
        $foodbakery_section_nomargin = '';
        if (isset($post->ID)) {
            $foodbakery_page_layout = get_post_meta($post->ID, 'foodbakery_var_page_layout', true);
        }
        $foodbakery_page_inline_style = '';
        $section_video_element = '';
        $foodbakery_section_bg_color = '';
        $foodbakery_section_view = 'container';
        $foodbakery_section_rand_id = rand(123456, 987654);
        $column_container = '';
        //pre($atts, false);
        extract($atts);

        if (isset($column_container)) {
            $column_class = isset($class) ? $class : '';
            $parallax_class = '';
            $parallax_data_type = '';
            if (isset($foodbakery_section_parallax) && (string) $foodbakery_section_parallax == 'yes' && isset($foodbakery_section_background_option) && $foodbakery_section_background_option == 'section-custom-background-image') {
                $parallax_class = ($foodbakery_section_parallax == 'yes') ? 'parallex-bg' : '';
                $parallax_data_type = ' data-type="background"';
            }

            if (isset($foodbakery_section_border_color) && $foodbakery_section_border_color != '') {
                $section_style_elements .= '';
            }
            if (isset($foodbakery_section_margin_top) && $foodbakery_section_margin_top != '') {
                $section_style_elements .= 'margin-top: ' . $foodbakery_section_margin_top . 'px;';
            }
            if (isset($foodbakery_section_padding_top) && $foodbakery_section_padding_top != '') {
                $section_style_elements .= 'padding-top: ' . $foodbakery_section_padding_top . 'px;';
            }
            if (isset($foodbakery_section_padding_bottom) && $foodbakery_section_padding_bottom != '') {
                $section_style_elements .= 'padding-bottom: ' . $foodbakery_section_padding_bottom . 'px;';
            }
            if (isset($foodbakery_section_margin_bottom) && $foodbakery_section_margin_bottom != '') {
                $section_style_elements .= 'margin-bottom: ' . $foodbakery_section_margin_bottom . 'px;';
            }
            if (isset($foodbakery_section_border_top) && $foodbakery_section_border_top != '') {
                $section_style_elements .= 'border-top: ' . $foodbakery_section_border_top . 'px ' . $foodbakery_section_border_color . ' solid;';
            }
            if (isset($foodbakery_section_border_bottom) && $foodbakery_section_border_bottom != '') {
                $section_style_elements .= 'border-bottom: ' . $foodbakery_section_border_bottom . 'px ' . $foodbakery_section_border_color . ' solid;';
            }
            if (isset($foodbakery_section_background_option) && $foodbakery_section_background_option == 'section-custom-background-image') {
                $foodbakery_section_bg_imageg = '';
                if (isset($foodbakery_section_bg_image) && $foodbakery_section_bg_image != '') {
                    if (isset($foodbakery_section_parallax) && (string) $foodbakery_section_parallax == 'yes') {
                        $foodbakery_paralax_str = false !== strpos($foodbakery_section_bg_image_position, 'fixed') ? '' : ' fixed';
                        $foodbakery_section_bg_imageg = 'url(' . $foodbakery_section_bg_image . ') ' . $foodbakery_section_bg_image_position . ' ' . $foodbakery_paralax_str;
                    } else {
                        $foodbakery_section_bg_imageg = 'url(' . $foodbakery_section_bg_image . ') ' . $foodbakery_section_bg_image_position . ' ';
                    }
                }
                global $is_safari;

                if ($is_safari) {
                    if (isset($foodbakery_section_bg_image) && $foodbakery_section_bg_image != '') {
                        if (isset($foodbakery_section_parallax) && (string) $foodbakery_section_parallax == 'yes') {
                            $foodbakery_paralax_str =' fixed';
                            $foodbakery_section_bg_imageg = 'url(' . $foodbakery_section_bg_image . ') ';
                        } else {
                            $foodbakery_section_bg_imageg = 'url(' . $foodbakery_section_bg_image . ') ';
                        }
                    }
                    $background_repeat = strtok($foodbakery_section_bg_image_position, ' ');
                    if (strpos($foodbakery_section_bg_image_position, 'cover') !== false) {
                        $foodbakery_background_size = 'cover';
                    }
                    if ($foodbakery_background_size == '') {
                        $foodbakery_background_size = 'cover';
                    }
                    $foodbakery_section_bg_image_position = str_replace('no-repeat', '', $foodbakery_section_bg_image_position);
                    $foodbakery_section_bg_image_position = str_replace('repeat', '', $foodbakery_section_bg_image_position);
                    $foodbakery_section_bg_image_position = str_replace(' / cover', '', $foodbakery_section_bg_image_position);
                    $foodbakery_section_bg_image_position = str_replace('fixed', '', $foodbakery_section_bg_image_position);
                    $section_style_elements .= 'background-color: ' . $foodbakery_section_bg_color . '; background-image: ' . $foodbakery_section_bg_imageg . '; background-position: ' . $foodbakery_section_bg_image_position . '; background-attachment: ' . $foodbakery_paralax_str . '; background-size: ' . $foodbakery_background_size . '; background-repeat: ' . $background_repeat;
                    ';';
                } else {
                    $section_style_elements .= 'background: ' . $foodbakery_section_bg_imageg . ' ' . $foodbakery_section_bg_color . ';';
                }
            } else if (isset($foodbakery_section_background_option) && $foodbakery_section_background_option == 'section_background_video') {
                $mute_flag = $mute_control = '';
                $mute_flag = 'true';
                if ($foodbakery_section_video_mute == 'yes') {
                    $mute_flag = 'false';
                    $mute_control = 'controls muted ';
                }
                $foodbakery_video_autoplay = 'autoplay';
                if ($foodbakery_section_video_autoplay == 'yes') {
                    $foodbakery_video_autoplay = 'autoplay';
                } else {
                    $foodbakery_video_autoplay = '';
                }
                $section_video_class = 'video-parallex';
                $url = parse_url($foodbakery_section_video_url);
                if ($url['host'] == cs_get_server_data("SERVER_NAME")) {
                    $file_type = wp_check_filetype($foodbakery_section_video_url);
                    if (isset($file_type['type']) && $file_type['type'] <> '') {
                        $file_type = $file_type['type'];
                    } else {
                        $file_type = 'video/mp4';
                    }
                    $rand_player_id = rand(6, 555);
                    ?>
                    <script>
                        jQuery(document).ready(function ($) {
                            document.getElementById("player<?php echo foodbakery_allow_special_char($rand_player_id); ?>").controls = false;
                        });
                    </script>
                    <?php
                    $section_video_element = '<video id="player' . foodbakery_allow_special_char($rand_player_id) . '" width="100%" height="100%" ' . foodbakery_allow_special_char($foodbakery_video_autoplay) . ' loop="true" preload="none" volume="false" class="nectar-video-bg   cs-video-element"  ' . foodbakery_allow_special_char($mute_control) . ' >
                                                    <source src="' . esc_url($foodbakery_section_video_url) . '" type="' . foodbakery_allow_special_char($file_type) . '">
                                                </video>';
                } else {
                    if (isset($foodbakery_section_video_url) && !empty($foodbakery_section_video_url)) {

                        $url_parts = parse_url($foodbakery_section_video_url);
                        $url_vid = '';
                        if (isset($url_parts['query']) && !empty($url_parts['query'])) {
                            $url_vid = $url_parts['query'];
                            $url_vid = str_replace('v=', '', $url_vid);
                        }
                        $player_string_exists = strpos($foodbakery_section_video_url, 'vimeo.com');
                        if ($player_string_exists === true) {
                            $video_path_exists = strpos($url_parts['path'], 'video');
                            if ($video_path_exists === true) {
                                $foodbakery_section_video_url = 'https://player.vimeo.com/' . $url_parts['path'] . '';
                            } else {
                                $foodbakery_section_video_url = 'https://player.vimeo.com/video/' . $url_parts['path'] . '';
                            }
                        }
                        $section_video_element = wp_oembed_get($foodbakery_section_video_url, array('height' => '1083'));
                        $fram_str = 'i' . 'fr' . 'ame';
                        if ($foodbakery_section_video_autoplay == 'yes') {
                            $string_exists = '';
                            $string_exists = strpos($section_video_element, 'vimeo');
                            if ($string_exists === false) {
                                $section_video_element = str_replace('feature=oembed', 'feature=oembed&enablejsapi=1&showinfo=0&controls=0&autoplay=1&loop=1&playlist=' . $url_vid . '', $section_video_element); // youtube autoplay
                                if ($foodbakery_section_video_mute == 'yes') {
                                    $section_video_element = str_replace('<' . $fram_str . '', '<' . $fram_str . ' id="ytplayer" ', $section_video_element); // youtube autoplay
                                    ?>
                                    <script>
                                        // 2. This code loads the IFrame Player API code asynchronously.
                                        var tag = document.createElement('script');
                                        var freme_api = '<?php echo foodbakery_allow_special_char($fram_str . '_api'); ?>';
                                        tag.src = "https://www.youtube.com/" + freme_api + "";
                                        var firstScriptTag = document.getElementsByTagName('script')[0];
                                        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                                        var player;
                                        function onYouTubeIframeAPIReady() {
                                            player = new YT.Player('ytplayer', {
                                                events: {
                                                    'onReady': onPlayerReady
                                                }
                                            });
                                        }
                                        function onPlayerReady() {
                                            player.playVideo();
                                            // Mute!
                                            player.mute();
                                        }
                                    </script>
                                    <?php
                                }
                            } else {
                                $doc = new DOMDocument();
                                $doc->loadHTML($section_video_element);
                                $src = $doc->getElementsByTagName($fram_str)->item(0)->getAttribute('src');
                                $section_video_element = str_replace($src, $src . '?autoplay=1&loop=1', $section_video_element); // vimeo autoplay
                                $section_video_element = str_replace('<' . $fram_str . '', '<' . $fram_str . ' frameborder="0" id="myvideo" ', $section_video_element); // youtube autoplay
                            }
                        }
                    }
                }
            } else {
                if (isset($foodbakery_section_bg_color) && $foodbakery_section_bg_color != '') {
                    $section_style_elements .= 'background: ' . esc_attr($foodbakery_section_bg_color) . ';';
                }
            }
            if (isset($foodbakery_section_padding_top) && $foodbakery_section_padding_top != '') {
                $section_container_style_elements .= 'padding-top: ' . $foodbakery_section_padding_top . 'px; ';
            }
            if (isset($foodbakery_section_padding_bottom) && $foodbakery_section_padding_bottom != '') {
                $section_container_style_elements .= 'padding-bottom: ' . $foodbakery_section_padding_bottom . 'px; ';
            }
            if (isset($foodbakery_section_css_id) && trim($foodbakery_section_css_id) != '') {
                $foodbakery_section_css_id = 'id="' . $foodbakery_section_css_id . '"';
            }

            $page_element_size = 'section-fullwidth';
            if (!isset($foodbakery_layout) || $foodbakery_layout == '' || $foodbakery_layout == 'none') {
                $foodbakery_layout = "none";
                $page_element_size = 'section-fullwidth col-lg-12 col-md-12 col-sm-12 col-xs-12';
            } else {
                $page_element_size = 'section-content col-lg-8 col-md-8 col-sm-12 col-xs-12 ';
            }
        }
        if (isset($foodbakery_section_bg_image) && $foodbakery_section_bg_image <> '' && $foodbakery_section_background_option == 'section-custom-background-image') {
            $css_bg_image = 'url(' . $foodbakery_section_bg_image . ')';
        }

        $section_style_element = '';
        if ($section_style_elements) {
            $section_style_element = 'style="' . $section_style_elements . '"';
            $foodbakery_page_inline_style .= ".cs-page-sec-{$foodbakery_section_rand_id}{{$section_style_elements}}";
        }
        if ($section_container_style_elements) {
            $section_container_style_elements = 'style="' . $section_container_style_elements . '"';
        }
        ?>
        <!-- Page Section 2121-->
        <?php
        $paddingClass = ($foodbakery_section_nopadding == 'yes') ? 'nopadding' : '';
        $marginClass = ($foodbakery_section_nomargin == 'yes') ? 'cs-nomargin' : '';

        /*
         * Addind class for backgroung slider/video functionality
         */
        $custom_bacground_option_class = '';
        
        
        if (isset($foodbakery_section_background_option) && $foodbakery_section_background_option == 'section-gallery-slider') {

            if (isset($foodbakery_section_custom_slider) && !empty($foodbakery_section_custom_slider)) {
                $custom_bacground_option_class = ' has-bg-custom-slider';
            }
        }
        
        if (isset($foodbakery_section_background_option) && $foodbakery_section_background_option == 'section-custom-slider') {

            if (isset($foodbakery_section_custom_slider) && !empty($foodbakery_section_custom_slider)) {
                $custom_bacground_option_class = ' has-bg-custom-slider';
            }
        }
        if (isset($foodbakery_section_background_option) && $foodbakery_section_background_option == 'section_background_video') {

            if (isset($section_video_element) && !empty($section_video_element)) {
                $custom_bacground_option_class = ' has-bg-custom-video';
            }
        }
        
        if (isset($foodbakery_section_background_option) && $foodbakery_section_background_option == 'section-gallery-slider') {
            if( $foodbakery_section_images_url != ''){
                $custom_bacground_option_class .= ' has-caption';
            }
        }
        
        ?>
        <div <?php echo foodbakery_allow_special_char($foodbakery_section_css_id); ?> class="page-section <?php echo foodbakery_allow_special_char($custom_bacground_option_class); ?> cs-page-sec-<?php echo absint($foodbakery_section_rand_id) ?> <?php echo sanitize_html_class($parallax_class); ?> <?php echo sanitize_html_class($paddingClass); ?> <?php echo sanitize_html_class($marginClass); ?>" <?php echo foodbakery_allow_special_char($parallax_data_type); ?>  <?php //echo foodbakery_allow_special_char($section_style_element);             ?> >
            <?php
            if (isset($foodbakery_section_background_option) && $foodbakery_section_background_option == 'section_background_video') {

                if (isset($section_video_element) && !empty($section_video_element)) {
                    echo '<div class="custom-video-holder">';
                    echo foodbakery_allow_special_char($section_video_element);
                    echo '</div>';
                }
            }

            if (isset($foodbakery_section_background_option) && $foodbakery_section_background_option == 'section-custom-slider') {
                if (isset($foodbakery_section_custom_slider) && $foodbakery_section_custom_slider != '') {
                    echo '<div class="custom-slider-holder">';
                    echo do_shortcode('[rev_slider alias="' . $foodbakery_section_custom_slider . '"]');
                    echo '</div>';
                }
            }
            
            
            
            
            
            if ($foodbakery_page_layout == '' || $foodbakery_page_layout == 'none') {
                if ($foodbakery_section_view == 'container') {
                    $foodbakery_section_view = 'container';
                } else {
                    $foodbakery_section_view = 'wide';
                }
            } else {
                $foodbakery_section_view = '';
            }
            ?>
            <!-- Container Start -->

            <div class="<?php echo sanitize_html_class($foodbakery_section_view); ?> "> 
                <?php
                if (isset($foodbakery_layout) && ( $foodbakery_layout != '' || $foodbakery_layout != 'none' )) {
                    ?>
                    <div class="row">
                        <?php
                    }
                    
                    if (isset($foodbakery_section_background_option) && $foodbakery_section_background_option == 'section-gallery-slider') {
                            if( $foodbakery_section_images_url != ''){
                                $page_element_size .= ' gallery-caption';
                                do_action('foodbakery_gallery_shortcode', array('foodbakery_images_url' => $foodbakery_section_images_url));
                            }
                        }
                    // start page section
                    if ($foodbakery_var_section_title != '' || $foodbakery_var_section_subtitle != '') {
                        $title_align = '';
                        if ($title_sub_title_alignment <> '') {
                            $title_align = ' style="text-align:' . $title_sub_title_alignment . '!important;"';
                        }
                        
                        
                        
                        
                        ?>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="cs-section-title" <?php echo foodbakery_allow_special_char($title_align); ?>>
                                <?php if ($foodbakery_var_section_title != '') { ?>
                                    <h2 style="color:<?php echo foodbakery_allow_special_char($foodbakery_section_titlt_color); ?> !important;"><?php echo esc_html($foodbakery_var_section_title);
                                    ?></h2>
                                <?php } if ($foodbakery_var_section_subtitle != '') { ?>
                                    <span style="color:<?php echo foodbakery_allow_special_char($foodbakery_section_subtitlt_color); ?>;"><?php echo do_shortcode($foodbakery_var_section_subtitle) ?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                    } // end page section
                    if (isset($foodbakery_layout) && $foodbakery_layout == "left" && $foodbakery_sidebar_left <> '') {
                        echo '<aside class="section-sidebar left col-lg-4 col-md-4 col-sm-12 col-xs-12">';
                        if (is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_sidebar_left))) {
                            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($foodbakery_sidebar_left)) : endif;
                        }
                        echo '</aside>';
                    }
                    $foodbakery_node_id = 0;

                    echo '<div class="' . ($page_element_size) . '">';
                    echo '<div class="row">';

                    echo do_shortcode($content);

                    echo '</div><!-- end section row -->';
                    echo '</div>';
                    if (isset($foodbakery_layout) && $foodbakery_layout == "right" && $foodbakery_sidebar_right <> '') {
                        echo '<aside class="section-sidebar right col-lg-4 col-md-4 col-sm-12 col-xs-12">';
                        if (is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_sidebar_right))) {
                            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($foodbakery_sidebar_right)) : endif;
                        }
                        echo '</aside>';
                    }
                    if (isset($foodbakery_layout) && ( $foodbakery_layout != '' || $foodbakery_layout != 'none' )) {
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>  <!-- End Container Start -->
        </div> <!-- End Page Section -->

        <?php
        $column_no = 0;

        if ($foodbakery_page_inline_style != '') {
            ?>
            <script type="text/javascript">
                if (jQuery("#inline-style-functions-inline-css").length == 0) {
                    jQuery("head").append('<style id="inline-style-functions-inline-css" type="text/css"></style>');
                }
            </script>
            <?php
            //foodbakery_inline_enqueue_style( $foodbakery_page_inline_style, 'inline-style-functions' );
            echo '<script type="text/javascript">
            jQuery("#inline-style-functions-inline-css").append("' . $foodbakery_page_inline_style . '");
        </script>';
        }
    }

    if (function_exists('foodbakery_var_short_code') && !is_admin())
        foodbakery_var_short_code('section', 'foodbakery_var_section_shortocde');
}