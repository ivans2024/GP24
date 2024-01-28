<?php
/*
 * Remove WordPress 
 * default comment 
 * filter
 */
//remove_filter('comment_form_field_comment', 'foodbakery_filter_comment_form_field_comment', 10, 1);
//remove_action('comment_form_logged_in_after', 'foodbakery_comment_tut_fields');
//remove_action('comment_form_after_fields', 'foodbakery_comment_tut_fields');
/**
 * The template for 
 * product detail
 */
get_header();
$foodbakery_page_sidebar_right = '';
$foodbakery_page_sidebar_left = '';
$foodbakery_var_layout = '';
$leftSidebarFlag = false;
$rightSidebarFlag = false;
$foodbakery_var_layout = get_post_meta($post->ID, 'foodbakery_var_page_layout', true);
$foodbakery_sidebar_right = get_post_meta($post->ID, 'foodbakery_var_page_sidebar_right', true);
$foodbakery_sidebar_left = get_post_meta($post->ID, 'foodbakery_var_page_sidebar_left', true);

if ($foodbakery_var_layout == 'left') {
    $foodbakery_var_layout = "page-content col-lg-9 col-md-9 col-sm-12 col-xs-12";
    $leftSidebarFlag = true;
} else if ($foodbakery_var_layout == 'right') {
    $foodbakery_var_layout = "page-content col-lg-9 col-md-9 col-sm-12 col-xs-12";
    $rightSidebarFlag = true;
} else {
    $foodbakery_var_layout = "page-content-fullwidth col-lg-12 col-md-12 col-sm-12 col-xs-12";
}
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <!-- .entry -header -->
        <div class="main-section"> 
            <div class="page-section">
                <div class="container">
                    <div class="row">
                        <?php if ($leftSidebarFlag == true) { ?>
                            <div class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <?php
                                if (is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_sidebar_left))) {
                                    if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($foodbakery_sidebar_left)) : endif;
                                }
                                ?>
                            </div>
                        <?php } ?>

                        <div class="<?php echo foodbakery_allow_special_char($foodbakery_var_layout) ?>">
                            <div class="cs-shop-wrap">
                                <?php
                                if (function_exists('woocommerce_content')) {
                                    woocommerce_content();
                                } 
                                ?>
                            </div>
                        </div>
                        <?php if ($rightSidebarFlag == true) { ?>
                            <div class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <?php
                                if (is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_sidebar_right))) {
                                    if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($foodbakery_sidebar_right)) : endif;
                                }
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- .Site Main start -->
</div><!-- .content-area -->
<?php get_footer(); ?>
