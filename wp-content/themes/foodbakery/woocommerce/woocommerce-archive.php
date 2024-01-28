<?php
/**
 * Shop Archive
 */
$var_arrays = array('post', 'foodbakery_var_options');
$page_global_vars = FOODBAKERY_VAR_GLOBALS()->globalizing($var_arrays);
extract($page_global_vars);

$foodbakery_layout = isset($foodbakery_var_options['foodbakery_var_woo_archive_layout']) ? $foodbakery_var_options['foodbakery_var_woo_archive_layout'] : '';
if ($foodbakery_layout == "sidebar_left" || $foodbakery_layout == "sidebar_right") {
    $foodbakery_col_class = "page-content col-lg-9 col-md-9 col-sm-12 col-xs-12";
} else {
    $foodbakery_col_class = "page-content-fullwidth col-lg-12 col-md-12 col-sm-12 col-xs-12";
}
$foodbakery_sidebar = isset($foodbakery_var_options['foodbakery_var_woo_archive_sidebar']) ? $foodbakery_var_options['foodbakery_var_woo_archive_sidebar'] : '';

?>   

<div class="main-section">
    <div class="page-section">
        <!-- Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <?php if ($foodbakery_layout == 'sidebar_left') { ?>
                    <div class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <?php
                        if (is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_sidebar))) {
                            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($foodbakery_sidebar)) : endif;
                        }
                        ?>
                    </div>
                <?php } ?>
                
                <div class="<?php echo esc_html($foodbakery_col_class); ?>">
                    <?php
                    if (function_exists('woocommerce_content')) {
                        woocommerce_content();
                    }
                    ?>
                </div>
                <?php if ($foodbakery_layout == 'sidebar_right') { ?>
                    <div class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12"><?php
                    if (is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_sidebar))) {
                        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($foodbakery_sidebar)) : endif;
                    }
                    ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>