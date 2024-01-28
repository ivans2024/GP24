<?php
/**
 * Template part for displaying post detail view 1.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package foodbakery
 */
$foodbakery_page_sidebar_right = '';
$foodbakery_page_sidebar_left = '';
$foodbakery_var_layout = '';
$left_sidebar_flag = false;
$right_sidebar_flag = false;
$foodbakery_def_sidebar = false;

$cs_views_counter = get_post_meta($post->ID, "foodbakery_post_views_counter", true);
if ( $cs_views_counter == '' ) {
    $cs_views_counter = '0';
}
$image_url = foodbakery_get_post_img_src($post->ID, 960, 540);
$foodbakery_section_bg = ( '' !== $image_url ) ? esc_url($image_url) : '';
$foodbakery_var_layout = get_post_meta($post->ID, 'foodbakery_var_page_layout', true);
$foodbakery_var_post_social_sharing = get_post_meta($post->ID, 'foodbakery_var_post_social_sharing', true);
$foodbakery_var_post_tags_show = get_post_meta($post->ID, 'foodbakery_var_post_tags_show', true);
if ( $foodbakery_var_post_tags_show == '' ) {
    $foodbakery_var_post_tags_show = 'on';
}
$foodbakery_var_feature_image = get_post_meta($post->ID, 'foodbakery_var_feature_image', true);
$foodbakery_var_article_banner = get_post_meta($post->ID, 'foodbakery_var_article_banner', true);
$foodbakery_var_post_about_author_show = get_post_meta($post->ID, 'foodbakery_var_post_about_author_show', true);
$foodbakery_var_related_post = get_post_meta($post->ID, 'foodbakery_var_related_post', true);

$foodbakery_sidebar_right = get_post_meta($post->ID, 'foodbakery_var_page_sidebar_right', true);
$foodbakery_sidebar_left = get_post_meta($post->ID, 'foodbakery_var_page_sidebar_left', true);
$foodbakery_views_counter = get_post_meta($post->ID, 'foodbakery_post_views_counter', true);
$foodbakery_var_author_id = get_post_field('post_author', $post->ID);
$foodbakery_var_post_format = get_post_meta($post->ID, 'foodbakery_var_post_format', true);
$rating_template = get_post_meta($post->ID, 'selected_rating_template', true);
$foodbakery_var_format_video_url = get_post_meta($post->ID, 'foodbakery_var_format_video_url', true);
$foodbakery_var_soundcloud_url = get_post_meta($post->ID, 'foodbakery_var_soundcloud_url', true);
$gallery_images = get_post_meta($post->ID, 'foodbakery_var_post_detail_page_gallery', true);

//get theme options for default layout
global $foodbakery_var_options;
$foodbakery_default_layout = isset($foodbakery_var_options['foodbakery_var_default_page_layout']) ? $foodbakery_var_options['foodbakery_var_default_page_layout'] : '';
$foodbakery_var_page_title_switch = isset($foodbakery_var_options['foodbakery_var_page_title_switch']) ? $foodbakery_var_options['foodbakery_var_page_title_switch'] : '';

if ( 'left' === $foodbakery_var_layout ) {
    $foodbakery_var_layout = 'page-content col-lg-8 col-md-8 col-sm-12 col-xs-12';
    $left_sidebar_flag = true;
} else if ( 'right' === $foodbakery_var_layout ) {
    $foodbakery_var_layout = 'page-content col-lg-8 col-md-8 col-sm-12 col-xs-12';
    $right_sidebar_flag = true;
} else {
    $foodbakery_var_layout = 'page-content-fullwidth col-lg-12 col-md-12 col-sm-12 col-xs-12';
}

if ( ! get_option('foodbakery_var_options') && is_active_sidebar('sidebar-1') ) {
    $foodbakery_var_layout = "page-content col-lg-8 col-md-8 col-sm-12 col-xs-12";
    $foodbakery_def_sidebar = true;
}

// plugin active or not 
$plugins = get_option('active_plugins');
$required_plugin = 'foodbakery-ratings/foodbakery-ratings.php';
$plugin_status = FALSE;
if ( in_array($required_plugin, $plugins) ) {
    $plugin_status = TRUE; // Example for yes, it's active
}

// get author data
$auth = get_post($post->ID); // gets author from post
$authid = $auth->post_author; // gets author id for the post
$user_nickname = get_the_author_meta('nickname', $authid); // retrieve user nickname
$user_display_name = get_the_author_meta('display_name', $authid); // retrieve user nickname
$author_avatar = get_avatar($authid, apply_filters('foodbakery_author_bio_avatar_size', 40));
$author_avatar_detail_page = get_avatar($authid, apply_filters('foodbakery_author_bio_avatar_size', 92));
$author_meta = get_user_meta($authid);
$author_first_name = $author_meta['first_name'][0];
$author_last_name = $author_meta['last_name'][0];
$author_descreption = $author_meta['description'][0];
if ( $user_display_name == '' ) {
    $author_data = get_userdata($authid);
    $user_display_name = $author_data->user_login;
}
// get categories data
$cat = '';
$cat = get_the_category($post->ID);
$cat_id = isset($cat[0]->cat_ID) ? $cat[0]->cat_ID : '';
$cat_meta = get_term_meta($cat_id, 'cat_meta_data', true);
$cat_icon = isset($cat_meta['cat_icon']) ? $cat_meta['cat_icon'] : '';
?>
<div class="page-section">
    <div class="container">
        <div class="row">
            <?php if ( true === $left_sidebar_flag ) { ?>
                <div class="page-sidebar col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="widget-holder">
                        <?php
                        if ( is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_sidebar_left)) ) {
                            if ( ! function_exists('dynamic_sidebar') || ! dynamic_sidebar($foodbakery_sidebar_left) ) :
                                echo '';
                            endif;
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>

            <?php if ( isset($foodbakery_var_layout) && $foodbakery_var_layout == 'page-content-fullwidth col-lg-12 col-md-12 col-sm-12 col-xs-12' ) {
                ?>
                <div class="blog-detail-holder">
                <?php } ?>
                <div class="<?php echo esc_html($foodbakery_var_layout); ?>">
                    <div class="blog-detail">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <div class="author-info">
                                    <?php if ( isset($author_avatar) && $author_avatar <> '' ) { ?>
                                        <figure>
                                            <?php echo foodbakery_allow_special_char($author_avatar); ?>
                                        </figure>
                                    <?php } ?>
                                    <div class="text-holder">
                                        <?php if ( isset($user_display_name) && $user_display_name <> '' ) { ?>
                                            <p><?php esc_html_e('Posted by', 'foodbakery'); ?> <span class="name"><a href="<?php echo get_author_posts_url($authid); ?>"><?php echo esc_html($user_display_name); ?></a></p>
                                        <?php } ?>
                                        <ul class="post-options">
                                            <li>
                                                <i class="icon-clock"></i>
                                                <span class="date"><a href="<?php echo esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))); ?>"><?php echo get_the_date('M j, Y'); ?></a></span>
                                            </li>
                                            <li>
                                                <i class="icon-eye4"></i>
                                                <span><?php echo esc_html($cs_views_counter); ?></span>
                                            </li>
                                            <li>
                                                <?php
                                                $foodbakery_post_like_counter = get_post_meta($post->ID, 'foodbakery_post_like_counter', true);
                                                if ( ! isset($foodbakery_post_like_counter) or empty($foodbakery_post_like_counter) ) {
                                                    $foodbakery_post_like_counter = 0;
                                                }
                                                if ( 'true' === foodbakery_get_cookie('foodbakery_post_like_counter' . $post->ID) ) {
                                                    $post_liked = '';
                                                    $post_liked = '<span><a href="javascript:void(0)" ><i class=" icon-heart"></i>' . $foodbakery_post_like_counter . '</a></span>';
                                                    echo foodbakery_allow_special_char($post_liked);
                                                } else {
                                                    ?>

                                                    <span>
                                                        <a href="javascript:void(0)" id="post_likes<?php echo esc_html($post->ID); ?>" onclick="foodbakery_post_likes_count('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', '<?php echo esc_html($post->ID) ?>', this)"><i class="icon-heart-outlined"></i><?php echo esc_html($foodbakery_post_like_counter); ?></a>
                                                    </span>
                                                    <?php
                                                }
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="title-area">
                                    
                                    <?php if ($foodbakery_var_page_title_switch != "on") { ?>
                                        <h2><?php the_title(); ?></h2>
                                    <?php } ?>
                                    <?php if ( has_excerpt() ) { ?>
                                        <span><?php echo foodbakery_get_excerpt(); ?></span>
                                    <?php } ?>
                                </div>
                                <?php if ( isset($foodbakery_var_post_social_sharing) && 'on' === $foodbakery_var_post_social_sharing ) { ?>
                                    <ul class="social-media">
                                        <?php echo foodbakery_social_share_blog(); ?>
                                    </ul>
                                <?php } ?>
                                <div class="main-post">
                                    <?php if ( isset($foodbakery_var_post_format) && $foodbakery_var_post_format == 'format-thumbnail' ) { ?>
                                        <figure>
                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('foodbakery_media_1'); ?></a>
                                            <?php if ( isset($cat_icon) && $cat_icon != '' ) { ?>
                                                <figcaption>
                                                    <i class = "<?php echo esc_attr($cat_icon); ?>"></i>
                                                </figcaption>
                                            <?php } ?>									
                                        </figure>
                                    <?php } else if ( isset($foodbakery_var_post_format) && $foodbakery_var_post_format == 'format-video' ) { ?>
                                        <?php
                                        echo wp_oembed_get(esc_url($foodbakery_var_format_video_url));
                                    } else if ( isset($foodbakery_var_post_format) && $foodbakery_var_post_format == 'format-sound' ) {
                                        ?>
                                        <?php echo wp_oembed_get(esc_url($foodbakery_var_soundcloud_url), array( 'width' => 960, 'height' => 540 )); ?>
                                    <?php } else if ( isset($foodbakery_var_post_format) && $foodbakery_var_post_format == 'format-slider' ) { ?>
                                        <div class="blog blog-large">
                                            <div class="img-holder">
                                                <div class="swiper-container">
                                                    <div class="swiper-wrapper">
                                                        <?php
                                                        foreach ( $gallery_images as $key => $gallery_image_id ) {
                                                            if ( '' != $gallery_image_id ) {
                                                                $foodbakery_var_src = wp_get_attachment_image_src($gallery_image_id, 'foodbakery_media_1');
                                                                $image_alt = get_post_meta($gallery_image_id, '_wp_attachment_image_alt', true);
                                                                echo '	<figure class="swiper-slide">
                                                                        <a href="javascript:void(0)"><img src="' . esc_url($foodbakery_var_src[0]) . '"></a>
                                                                </figure>';
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <!-- Add Arrows -->
                                                    <div class="swiper-button-next"><i class="icon-arrow_forward"></i></div>
                                                    <div class="swiper-button-prev"> <i class="icon-arrow_back"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <figure>
                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('foodbakery_media_1'); ?></a>
                                            <?php if ( isset($cat_icon) && $cat_icon != '' ) { ?>
                                                <figcaption>
                                                    <i class="<?php echo esc_attr($cat_icon); ?>"></i>
                                                </figcaption>
                                            <?php } ?>									
                                        </figure>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="rich-editor-text">
                                    <p><?php the_content(); ?></p>
                                    <?php wp_link_pages(array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'foodbakery') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' )); ?>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?php if ( isset($foodbakery_var_post_tags_show) && 'on' === $foodbakery_var_post_tags_show ) { ?>
                                        <?php the_tags('<div class="tags-list"> <h6>'. esc_html(foodbakery_var_theme_text_srt('foodbakery_var_tags')) .'</h6><ul><li>', '</li><li>', '</li></ul></div>'); ?>
                                <?php } ?>
                            </div>
                            <?php
                            if ( isset($foodbakery_var_related_post) && 'on' === $foodbakery_var_related_post ) {
                                if ( function_exists('foodbakery_related_posts') ) {
                                    foodbakery_related_posts();
                                }
                            }
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                            ?>		
                        </div>
                    </div>

                </div>
                <?php if ( isset($foodbakery_var_layout) && $foodbakery_var_layout == 'page-content-fullwidth col-lg-12 col-md-12 col-sm-12 col-xs-12' ) { ?>
                </div>
            <?php } ?>
            <?php
            if ( true === $right_sidebar_flag ) {
                if ( is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_sidebar_right)) ) {
                    ?>
                    <div class="page-sidebar col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="widget-holder">
                            <?php
                            if ( ! function_exists('dynamic_sidebar') || ! dynamic_sidebar($foodbakery_sidebar_right) ) : endif;
                            ?>
                        </div>
                    </div>
                    <?php
                }
            }
            if ( is_active_sidebar('sidebar-1') ) {
                ?>
                <div class="page-sidebar col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="widget-holder">
                        <?php
                        if ( ! function_exists('dynamic_sidebar') || ! dynamic_sidebar('sidebar-1') ) : endif;
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
