<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package foodbakery
 */
get_header();
$var_arrays = array( 'foodbakery_var_static_text', 'foodbakery_var_form_fields', 'foodbakery_var_html_fields' );
$error_page_global_vars = FOODBAKERY_VAR_GLOBALS()->globalizing($var_arrays);
extract($error_page_global_vars);
$foodbakery_var_options = FOODBAKERY_VAR_GLOBALS()->theme_options();
$page_margin_class = '';
$foodbakery_var_page_margin = isset($foodbakery_var_options['foodbakery_var_page_margin']) ? $foodbakery_var_options['foodbakery_var_page_margin'] : '';
if ( $foodbakery_var_page_margin == 'on' ) {
    $page_margin_class = 'page-margin';
}
?>

<div class="main-section <?php esc_attr($page_margin_class); ?>">
    <div class="page-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-not-found">
                        <div class="cs-text"> <span class="cs-error"><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_404_title')); ?></span> <span><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_404_sub_title')); ?></span>
                            <p><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_404_desc')); ?></p>
                        </div>
                        <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
                            <div class="input-holder"><i class="icon-search"></i>
                                <?php
                                $foodbakery_opt_array = array(
                                    'std' => '',
                                    'id' => '',
                                    'classes' => 'form-control txt-bar',
                                    'extra_atr' => 'onfocus="if (this.value == \'' . foodbakery_var_theme_text_srt('foodbakery_var_search_by_keyword') . '\') {
                                    this.value = \'\';
                                        }" 
                                    onblur="if (this.value == \'\') {
                                            this.value = \'' . foodbakery_var_theme_text_srt('foodbakery_var_search_by_keyword') . '\';
                                    }" 
                                    placeholder="' . foodbakery_var_theme_text_srt('foodbakery_var_search_by_keyword') . '"',
                                    'cust_id' => 's',
                                    'cust_name' => 's',
                                    'return' => true,
                                    'required' => false
                                );
                                echo foodbakery_allow_special_char($foodbakery_var_form_fields->foodbakery_var_form_text_render($foodbakery_opt_array));
                                $foodbakery_opt_array = array(
                                    'std' => foodbakery_var_theme_text_srt('foodbakery_var_search_button'),
                                    'id' => '',
                                    'before' => '',
                                    'after' => '',
                                    'classes' => 'bgcolor',
                                    'extra_atr' => '',
                                    'cust_id' => '',
                                    'cust_name' => '',
                                    'return' => true,
                                    'required' => false
                                );
                                echo foodbakery_allow_special_char($foodbakery_var_form_fields->foodbakery_var_form_submit_render($foodbakery_opt_array));
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
