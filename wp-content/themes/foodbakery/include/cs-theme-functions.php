<?php
/**
 * @Removing More... Link
 *
 */
if ( ! function_exists('foodbakery_remove_more_link_scroll') ) {

    function foodbakery_remove_more_link_scroll($link) {
        $link = preg_replace('|#more-[0-9]+|', '', $link);
        return $link;
    }

    add_filter('the_content_more_link', 'foodbakery_remove_more_link_scroll');
}
/**
 * @Header Settings
 *
 */
if ( ! function_exists('foodbakery_var_header_settings') ) {

    function foodbakery_var_header_settings() {
        global $foodbakery_var_options;
        $foodbakery_var_favicon = isset($foodbakery_var_options['foodbakery_var_custom_favicon']) ? $foodbakery_var_options['foodbakery_var_custom_favicon'] : '#';
        ?>
        <link rel="shortcut icon" href="<?php echo esc_url($foodbakery_var_favicon); ?>">
        <?php
    }

}


/* ----------------------------------------------------------------
  // @ Post Likes Counter
  /---------------------------------------------------------------- */
if ( ! function_exists('foodbakery_post_likes_count') ) {

    function foodbakery_post_likes_count() {
        $foodbakery_like_counter = get_post_meta($_POST['post_id'], "foodbakery_post_like_counter", true);
	if ( ! isset($foodbakery_like_counter) or empty($foodbakery_like_counter) ) {
            $foodbakery_like_counter = 0;
        }
        if ( ! isset($_COOKIE["foodbakery_post_like_counter" . $_POST['post_id']]) ) {
            setcookie("foodbakery_post_like_counter" . $_POST['post_id'], 'true', time() + 86400, '/');
            update_post_meta($_POST['post_id'], 'foodbakery_post_like_counter', $foodbakery_like_counter + 1);
        }
        $foodbakery_like_counter = get_post_meta($_POST['post_id'], "foodbakery_post_like_counter", true);
        if ( ! isset($foodbakery_like_counter) or empty($foodbakery_like_counter) ) {
            $foodbakery_like_counter = 0;
        }
        echo '<i class="icon-heart"></i>' . esc_html($foodbakery_like_counter);

        die(0);
    }

    add_action('wp_ajax_foodbakery_post_likes_count', 'foodbakery_post_likes_count');
    add_action('wp_ajax_nopriv_foodbakery_post_likes_count', 'foodbakery_post_likes_count');
}


if ( ! function_exists('foodbakery_get_cookie') ) {

    /**
     * Return an input variable from $_COOKIE if exists else default.
     *
     * @param	string $name name of the variable.
     * @param string $default default value.
     * @return string
     */
    function foodbakery_get_cookie($name, $default = null) {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : $default;
    }

}
/**
 * @Custom excerpt funciton
 *
 */
if ( ! function_exists('foodbakery_var_the_excerpt') ) {

    function foodbakery_var_the_excerpt() {
        add_filter('excerpt_length', 'foodbakery_var_the_excerpt_length', 30);
        the_excerpt();
    }

}

if ( ! function_exists('foodbakery_var_the_excerpt_length') ) {

    function foodbakery_var_the_excerpt_length($length) {
        global $foodbakery_var_options;
        $default_excerpt_length = isset($foodbakery_var_options['foodbakery_var_excerpt_length']) ? $foodbakery_var_options['foodbakery_var_excerpt_length'] : '50';
        return $default_excerpt_length;
    }

}

if ( ! function_exists('foodbakery_var_wpdofoodbakery_excerpt_more') ) {

    add_filter('excerpt_more', 'foodbakery_var_wpdofoodbakery_excerpt_more');

    function foodbakery_var_wpdofoodbakery_excerpt_more($more = '...') {
        return '...';
    }

}

/**
 * @Categories List by Post
 *
 */
if ( ! function_exists('foodbakery_var_cat_list') ):

    function foodbakery_var_cat_list($foodbakery_var_post_id) {
        if ( $foodbakery_var_post_id == '' ) {
            $foodbakery_var_post_id = get_the_id();
        }
        $foodbakery_var_cats_list = array();
        $foodbakery_var_cats = get_the_category($foodbakery_var_post_id);
        if ( $foodbakery_var_cats != '' ):
            foreach ( $foodbakery_var_cats as $foodbakery_var_cat ) {
                $foodbakery_var_term_link = get_category_link($foodbakery_var_cat->cat_ID);
                $foodbakery_var_cats_list[$foodbakery_var_cat->name] = $foodbakery_var_term_link;
            }
        endif;
        return $foodbakery_var_cats_list;
    }

endif;

/**
 * @Tag List by Post
 *
 */
if ( ! function_exists('foodbakery_var_tag_list') ) {

    function foodbakery_var_tag_list($foodbakery_var_post_id) {
        if ( $foodbakery_var_post_id == '' ) {
            $foodbakery_var_post_id = get_the_id();
        }
        $foodbakery_var_tags_list = array();
        $foodbakery_var_tags = get_the_tags($foodbakery_var_post_id);
        if ( $foodbakery_var_tags != '' ) {
            foreach ( $foodbakery_var_tags as $foodbakery_var_tag ) {
                $foodbakery_var_tag_link = get_tag_link($foodbakery_var_tag->term_id);
                $foodbakery_var_tags_list[$foodbakery_var_tag->name] = $foodbakery_var_tag_link;
            }
        }
        return $foodbakery_var_tags_list;
    }

}


/**
 * @Getting child Comments
 *
 */
if ( ! function_exists('foodbakery_var_comment') ):

    function foodbakery_var_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        global $wpdb, $foodbakery_var_static_text;
        $foodbakery_var_childs = $wpdb->get_var($wpdb->prepare("SELECT COUNT(comment_parent) FROM $wpdb->comments WHERE comment_parent = %d", $comment->comment_ID));
        $GLOBALS['comment'] = $comment;
        $args['reply_text'] = '<i class="icon-reply5"></i> ' . foodbakery_var_theme_text_srt('foodbakery_var_reply') . '<span><em>' . foodbakery_allow_special_char($foodbakery_var_childs) . '</em>' . foodbakery_var_theme_text_srt('foodbakery_var_comments') . '</span>';
        $args['after'] = '';

        switch ( $comment->comment_type ) :
            case 'comment' :
                ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <div class="thumb-list" id="comment-<?php comment_ID(); ?>">
                        <div class="img-holder">
                            <figure><?php echo get_avatar($comment, 59); ?></figure>
                        </div>
                        <div class="text-holder">
                            <h6><?php comment_author(); ?></h6>
                            <?php comment_reply_link(array_merge($args, array( 'depth' => $depth, 'reply_text' => esc_html__('Reply', 'foodbakery'), ))); ?>
                            <span><?php echo get_comment_date() . ' ' . get_comment_time(); ?></span>
                            <?php if ( $comment->comment_approved == '0' ) : ?>
                                <p><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_comment_awaiting')); ?></p>
                            <?php endif; ?>
                            <?php comment_text(); ?>
                        </div>
                    </div>
                    <?php
                    break;
                case 'pingback' :
                case 'trackback' :
                    ?>
                <li class="post pingback">
                    <p><?php comment_author_link(); ?><?php edit_comment_link(foodbakery_var_theme_text_srt('foodbakery_var_edit'), ' '); ?></p>
                    <?php
                    break;
            endswitch;
        }

    endif;


    /**
     * @Replacing Reply Link Classes
     *
     */
    if ( ! function_exists('foodbakery_replace_reply_link_class') ) {


        function foodbakery_replace_reply_link_class($class) {
            $class = str_replace("class='comment-reply-link", "class='reply-btn text-color br-color", $class);
            return $class;
        }

        add_filter('comment_reply_link', 'foodbakery_replace_reply_link_class');
    }

    /**
     * @Generating Random String
     *
     */
    if ( ! function_exists('foodbakery_generate_random_string') ) {

        function foodbakery_generate_random_string($length = 3) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ( $i = 0; $i < $length; $i ++ ) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
        }

    }

    if ( ! function_exists('foodbakery_allow_special_char') ) {

        function foodbakery_allow_special_char($input = '') {
            $output = $input;
            return $output;
        }

    }


    if ( ! function_exists('foodbakery_section') ) {

        function foodbakery_section($class, $title, $csheading) {
            if ( $title <> '' ) {
                $foodbakery_html = '';
                $foodbakery_html .= '<div class="' . $class . '">
                                        <h' . $csheading . '>' . esc_html($title) . '</h' . $csheading . '>
                                        <div class="stripe-line"></div>
                                    </div>';
                return $foodbakery_html;
            }
        }

    }

    /**
     * @Getting Image Source by Post
     *
     */
    if ( ! function_exists('foodbakery_get_post_img_src') ) {

        function foodbakery_get_post_img_src($post_id, $width, $height, $fixed_size = true) {
            global $post;
            if ( has_post_thumbnail() ) {
                $image_id = get_post_thumbnail_id($post_id);
                $image_url = wp_get_attachment_image_src($image_id, array( $width, $height ), true);
                if ( ( $image_url[1] == $width and $image_url[2] == $height ) || true !== $fixed_size ) {
                    return $image_url[0];
                } else {
                    $image_url = wp_get_attachment_image_src($image_id, "full", true);
                    return $image_url[0];
                }
            }
        }

    }
    /**
     * @Getting Image Source by Post
     *
     */
    if ( ! function_exists('foodbakery_get_post_img_src_search') ) {

        function foodbakery_get_post_img_src_search($post_id, $width, $height) {
            global $post;
            if ( has_post_thumbnail() ) {
                $image_id = get_post_thumbnail_id($post_id);
                $image_url = wp_get_attachment_image_src($image_id, array( $width, $height ), true);
                if ( $image_url[1] == $width && $image_url[2] == $height ) {
                    return $image_url[0];
                } else {
                    $image_url = wp_get_attachment_image_src($image_id, "thumbnail", true);
                    return $image_url[0];
                }
            }
        }

    }

    /**
     * @Flex Slider
     *
     */
    if ( ! function_exists('foodbakery_post_flex_slider') ) {

        function foodbakery_post_flex_slider($width, $height, $postid, $view) {
            global $post, $foodbakery_node, $foodbakery_theme_options, $foodbakery_counter_node;
            $foodbakery_post_counter = rand(40, 9999999);
            $foodbakery_counter_node ++;

            if ( $view == 'post-list' ) {
                $viewMeta = 'foodbakery_post_list_gallery';
            } else {
                $viewMeta = $view;
            }

            $foodbakery_meta_slider_options = get_post_meta("$postid", $viewMeta, true);
            $totaImages = '';
            ?>

            <div id="flexslider<?php echo esc_attr($foodbakery_post_counter); ?>" class="flexslider">
                <div class="flex-viewport">
                    <ul class="slides slides-1">
                        <?php
                        $foodbakery_counter = 1;

                        if ( $view == 'post' ) {
                            $sliderData = get_post_meta($post->ID, 'foodbakery_post_detail_gallery_ids', true);
                            $sliderData = explode(',', $sliderData);
                            $totaImages = count($sliderData);
                        } else if ( $view == 'post-list' ) {
                            $sliderData = get_post_meta($post->ID, 'foodbakery_post_list_gallery', true);
                            $sliderData = explode(',', $sliderData);
                            $totaImages = count($sliderData);
                        } else {
                            $sliderData = get_post_meta($post->ID, 'foodbakery_post_list_gallery', true);
                            $sliderData = explode(',', $sliderData);
                            $totaImages = count($sliderData);
                        }

                        foreach ( $sliderData as $as_node ) {
                            $image_url = foodbakery_attachment_image_src((int) $as_node, $width, $height);
                            echo '<li>
                                    <figure>
                                        <img class="lazyload no-src" src="' . esc_url($image_url) . '" alt="image_url">';
                            if ( isset($as_node['title']) && $as_node['title'] != '' ) {
                                ?>         
                                <figcaption>
                                    <div class="container">
                                        <?php
                                        if ( $as_node['title'] <> '' ) {
                                            ?>
                                            <h2 class="colr">
                                                <?php
                                                if ( $as_node['link_url'] <> '' ) {
                                                    
                                                } else {

                                                    echo esc_attr($as_node['title']);
                                                }
                                                ?>
                                            </h2>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </figcaption>
                                <?php
                            }
                            echo '
							</figure>
							</li>';

                            $foodbakery_counter ++;
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <?php
        }

    }

    /**
     * @Getting Attachment Source by ID
     *
     */
    if ( ! function_exists('foodbakery_attachment_image_src') ) {

        function foodbakery_attachment_image_src($attachment_id, $width, $height) {
            $image_url = wp_get_attachment_image_src($attachment_id, array( $width, $height ), true);
            if ( $image_url[1] == $width and $image_url[2] == $height )
                return $image_url[0];
            else
                $image_url = wp_get_attachment_image_src($attachment_id, "full", true);
            $parts = explode('/uploads/', $image_url[0]);
            if ( count($parts) > 1 )
                return $image_url[0];
        }

    }

    /**
     * @Comment Form Submit Button Filter
     *
     */
    if ( ! function_exists('foodbakery_comment_form_submit_button') ) {

        function foodbakery_comment_form_submit_button($button) {
            $button = '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="field-holder"><label><input name="submit" type="submit" class="button bgcolor" tabindex="5" value="' . foodbakery_var_theme_text_srt('foodbakery_var_comment_submit_button') . '" /></label>
                            </div>
                        </div>';
            return $button;
        }

        add_filter('comment_form_submit_button', 'foodbakery_comment_form_submit_button');
    }

    /**
     * @Social Media Sharing Function
     *
     */
    if ( ! function_exists('foodbakery_social_share_blog') ) {

        function foodbakery_social_share_blog($default_icon = 'false', $title = 'true', $post_social_sharing_text = '') {

            global $foodbakery_var_options;
            $html = '';
            $foodbakery_var_twitter = isset($foodbakery_var_options['foodbakery_var_twitter_share']) ? $foodbakery_var_options['foodbakery_var_twitter_share'] : '';
            $foodbakery_var_facebook = isset($foodbakery_var_options['foodbakery_var_facebook_share']) ? $foodbakery_var_options['foodbakery_var_facebook_share'] : '';
            $foodbakery_var_google_plus = isset($foodbakery_var_options['foodbakery_var_google_plus_share']) ? $foodbakery_var_options['foodbakery_var_google_plus_share'] : '';
            $foodbakery_var_tumblr = isset($foodbakery_var_options['foodbakery_var_tumblr_share']) ? $foodbakery_var_options['foodbakery_var_tumblr_share'] : '';
            $foodbakery_var_dribbble = isset($foodbakery_var_options['foodbakery_var_dribbble_share']) ? $foodbakery_var_options['foodbakery_var_dribbble_share'] : '';
            $foodbakery_var_share = isset($foodbakery_var_options['foodbakery_var_stumbleupon_share']) ? $foodbakery_var_options['foodbakery_var_stumbleupon_share'] : '';
            $foodbakery_var_stumbleupon = isset($foodbakery_var_options['foodbakery_var_stumbleupon_share']) ? $foodbakery_var_options['foodbakery_var_stumbleupon_share'] : '';
            $foodbakery_var_sharemore = isset($foodbakery_var_options['foodbakery_var_share_share']) ? $foodbakery_var_options['foodbakery_var_share_share'] : '';
            foodbakery_addthis_script_init_method();
            $html = '';

            $single = false;
            if ( is_single() ) {
                $single = true;
            }

            $path = trailingslashit(get_template_directory_uri()) . "include/assets/images/";
            if ( $foodbakery_var_twitter == 'on' or $foodbakery_var_facebook == 'on' or $foodbakery_var_google_plus == 'on' or $foodbakery_var_tumblr == 'on' or $foodbakery_var_dribbble == 'on' or $foodbakery_var_share == 'on' or $foodbakery_var_stumbleupon == 'on' or $foodbakery_var_sharemore == 'on' ) {

                if ( isset($foodbakery_var_facebook) && $foodbakery_var_facebook == 'on' ) {
                    if ( $single == true ) {
                        $html .='<li><a class="addthis_button_facebook" data-original-title="facebook"><i class="icon-facebook"></i></a></li>';
                    } else {
                        $html .='<li><a class="addthis_button_facebook" data-original-title="facebook"><i class="icon-facebook"></i></a></li>';
                    }
                }
                if ( isset($foodbakery_var_twitter) && $foodbakery_var_twitter == 'on' ) {

                    if ( $single == true ) {
                        $html .='<li><a class="addthis_button_twitter"  data-original-title="twitter"><i class="icon-twitter"></i></a></li>';
                    } else {
                        $html .='<li><a class="addthis_button_twitter"  data-original-title="twitter"><i class="icon-twitter"></i></a></li>';
                    }
                }
                if ( isset($foodbakery_var_google_plus) && $foodbakery_var_google_plus == 'on' ) {

                    if ( $single == true ) {
                        $html .='<li><a class="addthis_button_google" data-original-title="google+"><i class="icon-google"></i></a></li>';
                    } else {
                        $html .='<li><a class="addthis_button_google" data-original-title="google+"><i class="icon-google"></i></a></li>';
                    }
                }
                if ( isset($foodbakery_var_tumblr) && $foodbakery_var_tumblr == 'on' ) {

                    if ( $single == true ) {
                        $html .='<li><a class="addthis_button_tumblr" data-original-title="tumbler"><i class="icon-tumblr"></i></a></li>';
                    } else {
                        $html .='<li><a class="addthis_button_tumblr" data-original-title="tumbler"><i class="icon-tumblr""></i></a></li>';
                    }
                }

                if ( isset($foodbakery_var_dribbble) && $foodbakery_var_dribbble == 'on' ) {
                    if ( $single == true ) {
                        $html .='<li><a class="addthis_button_dribbble" data-original-title="dribble"><i class="icon-dribbble3"></i></a></li>';
                    } else {
                        $html .='<li><a class="addthis_button_dribbble" data-original-title="dribble"><i class="icon-dribbble3"></i></a></li>';
                    }
                }
                if ( isset($foodbakery_var_stumbleupon) && $foodbakery_var_stumbleupon == 'on' ) {
                    if ( $single == true ) {
                        $html .='<li><a class="addthis_button_stumbleupon" data-original-title="stumbleupon"><i class="icon-stumbleupon"></i></a></li>';
                    } else {
                        $html .='<li><a class="addthis_button_stumbleupon" data-original-title="stumbleupon"><i class="icon-stumbleupon"></i></a></li>';
                    }
                }
                if ( isset($foodbakery_var_sharemore) && $foodbakery_var_sharemore == 'on' ) {

                    $html .='<li><a class="cs-more addthis_button_compact"><i class="icon-share"></i></a></li>';
                }
            }
            echo foodbakery_allow_special_char($html, true);
        }

    }

    /**
     * @Getting Attachment ID by URL
     *
     */
    if ( ! function_exists('foodbakery_var_get_image_id') ) {

        function foodbakery_var_get_image_id($attachment_url) {
            global $wpdb;
            $attachment_id = false;
            //  If there is no url, return. 
            if ( '' == $attachment_url )
                return;
            // Get the upload foodbakery paths 
            $upload_dir_paths = wp_upload_dir();
            if ( false !== strpos($attachment_url, $upload_dir_paths['baseurl']) ) {
                //  If this is the URL of an auto-generated thumbnail, get the URL of the original image 
                $attachment_url = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url);
                // Remove the upload path base foodbakery from the attachment URL 
                $attachment_url = str_replace($upload_dir_paths['baseurl'] . '/', '', $attachment_url);

                $attachment_id = $wpdb->get_var($wpdb->prepare("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url));
            }
            return $attachment_id;
        }

    }
    if ( ! function_exists('foodbakery_post_views_count') ) {

        function foodbakery_post_views_count($postID) {
            $foodbakery_views_counter = get_post_meta($postID, "foodbakery_post_views_counter", true);
	    if( $foodbakery_views_counter == ''){
                 $foodbakery_views_counter = 0;
            }
            if ( ! isset($_COOKIE["foodbakery_post_views_counter" . $postID]) ) {
                setcookie("foodbakery_post_views_counter" . $postID, time() + 86400);
                update_post_meta($postID, 'foodbakery_post_views_counter', $foodbakery_views_counter + 1);
            }
        }

    }

    if ( ! function_exists('foodbakery_get_post_categories') ) {

        function foodbakery_get_post_categories($post_id = '', $seprator = ',') {
            global $post;
            if ( $post_id == '' ) {
                $post_id = $post->ID;
            }
            $category_ids = get_the_category($post_id);
            $post_cats = '';
            if ( is_array($category_ids) && ! empty($category_ids) ) {
                $i = 1;
                $total_cats = count($category_ids);
                foreach ( $category_ids as $category ) {
                    if ( ! empty($category) ) {
                        $comma = '';
                        if ( $i != $total_cats ) {
                            $comma = $seprator;
                        }
                        $post_cats .= '<a class="post-category" href="' . esc_url(get_category_link($category->term_id)) . '">' . $category->name . $comma . '</a>';
                        $i ++;
                    }
                }
            }
            return $post_cats;
        }

    }