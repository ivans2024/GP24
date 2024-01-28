<?php
/**
 * Foodbakery functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package foodbakery
 */

if (!function_exists('pre')){
        function pre($data, $is_exit = true){
            echo '<pre>';
                print_r( $data );
            echo '</pre>';
            if( $is_exit == true){
                exit;
            }
        }
    }
    
require_once trailingslashit(get_template_directory()) . 'assets/frontend/translate/cs-strings.php';
require_once trailingslashit(get_template_directory()) . 'include/cs-global-functions.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-global-variables.php';
include(get_template_directory() . '/include/cs-theme-functions.php');
require_once(get_template_directory() . '/include/cs-helpers.php');

if( isset( $_REQUEST['location'] )){
    $_REQUEST['location'] = filter_var($_REQUEST['location'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $_GET['location'] = filter_var($_REQUEST['location'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    foreach( $_REQUEST as $request_key => $request_data){
        $_REQUEST[$request_key] = str_replace('alert', '', $_REQUEST[$request_key]);
        $_REQUEST[$request_key] = str_replace('prompt', '', $_REQUEST[$request_key]);
        $_REQUEST[$request_key] = str_replace('document.', '', $_REQUEST[$request_key]);
        $_REQUEST[$request_key] = ( !is_array($_REQUEST[$request_key]) )? strip_tags($_REQUEST[$request_key]): $_REQUEST[$request_key];
    }
}


/**
 * Sets up theme defaults and registers support for various WordPress features.     *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
if (!function_exists('foodbakery_setup')) {

    function foodbakery_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ foodbakery.
	 * If you're building a theme based on foodbakery, use a find and replace
	 * to change 'foodbakery' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('foodbakery', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(array(
	    'primary' => esc_html__('Primary', 'foodbakery'),
	    'strip_menu' => esc_html__('Top Strip Menu', 'foodbakery'),
	    'fancy_left_menu' => esc_html__('Fancy Left Menu', 'foodbakery'),
	    'fancy_right_menu' => esc_html__('Fancy Right Menu', 'foodbakery'),
	    'header_mobile_menu' => esc_html__('Header Mobile Menu', 'foodbakery'),
	));

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support('html5', array(
	    'search-form',
	    'comment-form',
	    'comment-list',
	    'gallery',
	    'caption',
	));
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');
	// Set up the WordPress core custom background feature.
	add_theme_support('custom-background', apply_filters('foodbakery_custom_background_args', array(
	    'default-color' => 'ffffff',
	    'default-image' => '',
	)));
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style('assets/backend/css/editor-style.css');
	add_filter('the_password_form', 'foodbakery_password_form');

	// theme unique identifier
	if (class_exists('wp_foodbakery_framework')) {
	    wp_foodbakery_framework::$theme_identify = 'wp-foodbakery-theme';
	}
        add_theme_support('woocommerce');
    }

    add_action('after_setup_theme', 'foodbakery_setup');
}

add_filter('comment_form_field_comment', 'foodbakery_form_field_comment', 10, 1);
add_action('comment_form_logged_in_after', 'foodbakery_comment_tut_fields');
add_action('comment_form_after_fields', 'foodbakery_comment_tut_fields');

function foodbakery_form_field_comment($field) {

    return '';
}

function foodbakery_comment_tut_fields() {

    $cs_msg_class = ' cs-message';
    if (is_user_logged_in()) {
	$cs_msg_class = ' cs-message';
    }
    $comment_field = '<textarea name="comment" class="commenttextarea" rows="55" cols="15"></textarea>';
    $html = '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12' . $cs_msg_class . '"><div class="field-holder"><label>' . $comment_field . '</label></div></div>';
    echo foodbakery_allow_special_char($html);
}

/*
 * Include file function
 */
if (!function_exists('foodbakery_include_file')) {

    function foodbakery_include_file($file_path = '', $inc = false) {
	if ($file_path != '') {
	    if ($inc == true) {
		include $file_path;
	    } else {
		require_once $file_path;
	    }
	}
    }

}

/*
 * Add images sizes for complete site
 *
 */

add_image_size('foodbakery_media_1', 750, 422, true); //Blog Large / Blog Detail
add_image_size('foodbakery_media_2', 213, 143, true); //Blog medium 16 x 9
/* Thumb size On Blogs On slider, blogs on restaurant, Candidate Detail Portfolio */
add_image_size('foodbakery_media_3', 236, 168, true);
add_image_size('foodbakery_media_4', 200, 200, true);
/* Thumb size On BEmployer Restaurant, Employer Restaurant View 2,Candidate Detail ,User Resume, company profile */
add_image_size('foodbakery_media_5', 180, 135, true);

if (function_exists('foodbakery_plugin_image_sizes')) {
    foodbakery_plugin_image_sizes();
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if (!function_exists('foodbakery_content_width')) {

    function foodbakery_content_width() {
	$GLOBALS['content_width'] = apply_filters('foodbakery_content_width', 640);
    }

    add_action('after_setup_theme', 'foodbakery_content_width', 0);
}

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Auto Mobile 1.0
 */
if (!function_exists('foodbakery_widgets_init')) {

    function foodbakery_widgets_init() {

	global $foodbakery_var_options, $foodbakery_var_static_text;

	/**
	 * @If Theme Activated
	 */
	if (get_option('foodbakery_var_options')) {
	    if (isset($foodbakery_var_options['foodbakery_var_sidebar']) && !empty($foodbakery_var_options['foodbakery_var_sidebar'])) {
		foreach ($foodbakery_var_options['foodbakery_var_sidebar'] as $sidebar) {
		    $sidebar_id = sanitize_title($sidebar);

		    $foodbakery_widget_start = '<div class="widget %2$s">';
		    $foodbakery_widget_end = '</div>';
		    if (isset($foodbakery_var_options['foodbakery_var_footer_widget_sidebar']) && $foodbakery_var_options['foodbakery_var_footer_widget_sidebar'] == $sidebar) {

			$foodbakery_widget_start = '<aside class="widget col-lg-4 col-md-4 col-sm-6 col-xs-12 %2$s">';
			$foodbakery_widget_end = '</aside>';
		    }
		    register_sidebar(array(
			'name' => $sidebar,
			'id' => $sidebar_id,
			'description' => esc_html(foodbakery_var_theme_text_srt('foodbakery_var_widget_display_text')),
			'before_widget' => $foodbakery_widget_start,
			'after_widget' => $foodbakery_widget_end,
			'before_title' => '<div class="widget-title"><h5>',
			'after_title' => '</h5></div>'
		    ));
		}
	    }

	    $sidebar_name = '';
	    if (isset($foodbakery_var_options['foodbakery_var_footer_sidebar']) && !empty($foodbakery_var_options['foodbakery_var_footer_sidebar'])) {
		$i = 0;
		foreach ($foodbakery_var_options['foodbakery_var_footer_sidebar'] as $foodbakery_var_footer_sidebar) {

		    $footer_sidebar_id = sanitize_title($foodbakery_var_footer_sidebar);
		    $sidebar_name = isset($foodbakery_var_options['foodbakery_var_footer_width']) ? $foodbakery_var_options['foodbakery_var_footer_width'] : '';
		    $foodbakery_sidebar_name = isset($sidebar_name[$i]) ? $sidebar_name[$i] : '';
		    $custom_width = str_replace('(', ' - ', $foodbakery_sidebar_name);
		    $foodbakery_widget_start = '<div class="widget %2$s">';
		    $foodbakery_widget_end = '</div>';

		    if (isset($foodbakery_var_options['foodbakery_var_footer_widget_sidebar']) && $foodbakery_var_options['foodbakery_var_footer_widget_sidebar'] == $foodbakery_var_footer_sidebar) {

			$foodbakery_widget_start = '<aside class="widget col-lg-4 col-md-4 col-sm-6 col-xs-12 %2$s">';
			$foodbakery_widget_end = '</aside>';
		    }

		    register_sidebar(array(
			'name' => foodbakery_var_theme_text_srt('foodbakery_var_footer') . $foodbakery_var_footer_sidebar . ' ' . '(' . $custom_width . ' ',
			'id' => $footer_sidebar_id,
			'description' => foodbakery_var_theme_text_srt('foodbakery_var_widget_display_text'),
			'before_widget' => $foodbakery_widget_start,
			'after_widget' => $foodbakery_widget_end,
			'before_title' => '<div class="widget-title"><h5>',
			'after_title' => '</h5></div>'
		    ));
		    $i ++;
		}
	    }
	} else {
	    register_sidebar(array(
		'name' => foodbakery_var_theme_text_srt('foodbakery_var_widgets'),
		'id' => 'sidebar-1',
		'description' => foodbakery_var_theme_text_srt('foodbakery_var_widget_display_right_text'),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h6>',
		'after_title' => '</h6></div>'
	    ));
	}
    }

    add_action('widgets_init', 'foodbakery_widgets_init');
}
/**
 * Add meta tag in head.
 */
if (!function_exists('foodbakery_add_meta_tags')) {

    function foodbakery_add_meta_tags() {

	echo '<meta http-equiv="X-UA-Compatible" content="IE=edge" />';
    }

    add_action('wp_head', 'foodbakery_add_meta_tags', 2);
}

/**
 * Enqueue scripts and styles.
 */
if (!function_exists('foodbakery_scripts_1')) {

    function foodbakery_scripts_1() {
	global $foodbakery_var_options;
	$foodbakery_responsive_site = isset($foodbakery_var_options['foodbakery_var_responsive']) ? $foodbakery_var_options['foodbakery_var_responsive'] : '';

	$theme_version = foodbakery_get_theme_version();
	wp_enqueue_style('iconmoon', trailingslashit(get_template_directory_uri()) . 'assets/common/icomoon/css/iconmoon.css');
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/frontend/css/bootstrap.css');
	wp_enqueue_style('bootstrap-theme', get_template_directory_uri() . '/assets/frontend/css/bootstrap-theme.css');
	wp_enqueue_style('chosen', trailingslashit(get_template_directory_uri()) . 'assets/frontend/css/chosen.css');
	wp_enqueue_style('swiper', trailingslashit(get_template_directory_uri()) . 'assets/frontend/css/swiper.css');
	wp_enqueue_style('animate', trailingslashit(get_template_directory_uri()) . 'assets/frontend/css/animate.css');
	wp_enqueue_style('foodbakery-style', get_stylesheet_uri());
	wp_enqueue_style('foodbakery-widget', get_template_directory_uri() . '/assets/frontend/css/widget.css');
	wp_enqueue_style('foodbakery-google-font', 'https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600&subset=latin,cyrillic-ext');
	wp_enqueue_style('foodbakery-social-network', get_template_directory_uri() . '/assets/backend/css/social-network.css');

	wp_register_style('inline-style-functions', trailingslashit(get_template_directory_uri()) . 'assets/frontend/css/inline-style-functions.css');
	if (is_singular() && comments_open() && get_option('thread_comments')) {
	    wp_enqueue_script('comment-reply');
	}
	wp_enqueue_script('bootstrap-min', get_template_directory_uri() . '/assets/common/js/bootstrap.min.js', array('jquery'), $theme_version);
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/assets/frontend/js/modernizr.js', array('jquery'), $theme_version, true);
	if ($foodbakery_responsive_site == 'on') {
	    wp_enqueue_script('responsive-menu', get_template_directory_uri() . '/assets/frontend/js/responsive.menu.js', '', $theme_version, true);
	}
	//wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/frontend/js/wow.js', '', $theme_version, true );
	wp_enqueue_script('chosen', get_template_directory_uri() . '/assets/common/js/chosen.select.js', '', $theme_version);
	wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/frontend/js/swiper.min.js', '', $theme_version, true);
	wp_enqueue_script('counter', get_template_directory_uri() . '/assets/frontend/js/counter.js', '', $theme_version, true);
	wp_enqueue_script('fliters', get_template_directory_uri() . '/assets/frontend/js/fliters.js', '', $theme_version, true);
	wp_enqueue_script('foodbakery-maps-styles', trailingslashit(get_template_directory_uri()) . 'assets/backend/js/cs-map_styles.js', '', $theme_version, true);
	wp_enqueue_script('fitvids', get_template_directory_uri() . '/assets/frontend/js/jquery.fitvids.js', '', $theme_version, true);
	wp_enqueue_script('matchHeight', get_template_directory_uri() . '/assets/frontend/js/jquery.matchHeight-min.js', '', $theme_version, true);
	wp_enqueue_script('foodbakery-functions', get_template_directory_uri() . '/assets/frontend/js/functions.js', '', $theme_version, true);
	wp_enqueue_script('skills-progress', get_template_directory_uri() . '/assets/frontend/js/skills-progress.js', '', $theme_version, true);
	wp_enqueue_script('masonry', get_template_directory_uri() . '/assets/frontend/js/masonry.pkgd.js', '', $theme_version, true);
	wp_register_script('growls', get_template_directory_uri() . '/assets/frontend/js/jquery.growl.js', '', $theme_version, true);
	if (class_exists('WooCommerce')) {
	    if (is_woocommerce() || is_cart() || is_checkout()) {
		wp_enqueue_style('custom-woocommerce', trailingslashit(get_template_directory_uri()) . 'assets/frontend/css/woocommerce.css');
	    }
	}

	if (!function_exists('foodbakery_enqueue_google_map')) {

	    function foodbakery_enqueue_google_map() {
		wp_enqueue_script('foodbakery-google-map-script', 'https://maps.googleapis.com/maps/api/js', '', '');
	    }

	}

	if (!function_exists('foodbakery_addthis_script_init_method')) {

	    function foodbakery_addthis_script_init_method() {
		wp_enqueue_script('addthis', 'https://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e4412d954dccc64', '', '', true);
	    }

	}

	if (!function_exists('foodbakery_inline_enqueue_script')) {

	    function foodbakery_inline_enqueue_script($script = '', $script_handler = 'foodbakery-custom-inline') {
		wp_register_script('foodbakery-custom-inline', trailingslashit(get_template_directory_uri()) . 'assets/common/js/custom-inline.js', '', '', true);
		wp_enqueue_script($script_handler);
		wp_add_inline_script($script_handler, $script);
	    }

	}

	if (!function_exists('foodbakery_var_dynamic_scripts')) {

	    function foodbakery_var_dynamic_scripts($foodbakery_js_key, $foodbakery_arr_key, $foodbakery_js_code) {
		// Register the script
		wp_register_script('foodbakery-dynamic-scripts', trailingslashit(get_template_directory_uri()) . 'assets/frontend/js/inline-scripts-functions.js', '', '', true);
		// Localize the script
		$foodbakery_code_array = array(
		    $foodbakery_arr_key => $foodbakery_js_code
		);
		wp_localize_script('foodbakery-dynamic-scripts', $foodbakery_js_key, $foodbakery_code_array);
		wp_enqueue_script('foodbakery-dynamic-scripts');
	    }

	}
    }

    add_action('wp_enqueue_scripts', 'foodbakery_scripts_1', 1);
}

/**
 * Enqueue Google Fonts.
 */
if (!function_exists('foodbakery_var_load_google_font_families')) {

    function foodbakery_var_load_google_font_families() {
	if (foodbakery_var_is_fonts_loaded()) {
	    $fonts_array = foodbakery_var_is_fonts_loaded();
	    $fonts_url = foodbakery_var_get_font_families($fonts_array);
	    if ($fonts_url) {
		$font_url = add_query_arg('family', urlencode($fonts_url), "//fonts.googleapis.com/css");
		wp_enqueue_style('foodbakery-google-fonts', $font_url, array(), '');
	    }
	}
    }

    add_action('wp_enqueue_scripts', 'foodbakery_var_load_google_font_families', 0);
}

if (!function_exists('foodbakery_inline_enqueue_style')) {

    function foodbakery_inline_enqueue_style($script = '', $script_handler = 'inline-style-functions') {
	wp_enqueue_style($script_handler);
	wp_add_inline_style($script_handler, $script);
    }

}

if (!function_exists('foodbakery_header_color_styles')) {

    function foodbakery_header_color_styles() {
	global $foodbakery_var_options;
	$custom_style_ver = (isset($foodbakery_var_options['foodbakery_var_theme_option_save_flag'])) ? $foodbakery_var_options['foodbakery_var_theme_option_save_flag'] : '';
	wp_enqueue_style('foodbakery-default-element-style', trailingslashit(get_template_directory_uri()) . '/assets/frontend/css/default-element.css', '', $custom_style_ver);
    }

    add_action('wp_enqueue_scripts', 'foodbakery_header_color_styles', 9);
}

/**
 * Enqueue scripts and styles.
 */
if (!function_exists('foodbakery_scripts_10')) {

    function foodbakery_scripts_10() {
	global $foodbakery_var_options;
	$foodbakery_responsive_site = isset($foodbakery_var_options['foodbakery_var_responsive']) ? $foodbakery_var_options['foodbakery_var_responsive'] : '';
	if (is_rtl()) {
	    wp_enqueue_style('foodbakery-rtl', get_template_directory_uri() . '/assets/frontend/css/rtl.css');
	}
	if ($foodbakery_responsive_site == 'on') {
	    $theme_version = foodbakery_get_theme_version();
	    wp_enqueue_style('foodbakery_responsive_css', get_template_directory_uri() . '/assets/frontend/css/responsive.css', '', $theme_version);
	}
    }

    add_action('wp_enqueue_scripts', 'foodbakery_scripts_10', 10);
}

if (!function_exists('foodbakery_google_fonts')) {

    function foodbakery_google_fonts() {
	$query_args = array(
	    'family' => 'Montserrat:400,700|Open+Sans:300,400,600,700,800',
	    'subset' => '',
	);
	wp_register_style('foodbakery-google-fonts', add_query_arg($query_args, "//fonts.googleapis.com/css"), array(), null);
    }

    add_action('wp_enqueue_scripts', 'foodbakery_google_fonts');
}

/**
 * Add Admin Page for
 * Theme Options Menu
 */
if (!function_exists('foodbakery_var_options')) {

    add_action('admin_menu', 'foodbakery_var_options');

    function foodbakery_var_options() {
	global $foodbakery_var_static_text;
	$foodbakery_var_theme_options = foodbakery_var_theme_text_srt('foodbakery_var_theme_options');
	if (current_user_can('administrator')) {
	    add_theme_page($foodbakery_var_theme_options, $foodbakery_var_theme_options, 'read', 'foodbakery_var_settings_page', 'foodbakery_var_settings_page');
	}
    }

}
/*
 * admin Enque Scripts
 */
if (!function_exists('foodbakery_var_admin_scripts_enqueue')) {

    function foodbakery_var_admin_scripts_enqueue() {
	$theme_version = foodbakery_get_theme_version();
	if (is_admin()) {
	    global $foodbakery_var_template_path;
	    $foodbakery_var_template_path = trailingslashit(get_template_directory_uri()) . 'assets/backend/js/cs-media-upload.js';
	    wp_enqueue_style('fonticonpicker', trailingslashit(get_template_directory_uri()) . 'assets/common/icomoon/css/jquery.fonticonpicker.min.css', array(), $theme_version);
	    wp_enqueue_style('fonticonpicker');
	    wp_enqueue_style('iconmoon', trailingslashit(get_template_directory_uri()) . 'assets/common/icomoon/css/iconmoon.css');
	    wp_enqueue_style('fonticonpicker-bootstrap', trailingslashit(get_template_directory_uri()) . 'assets/common/icomoon/theme/bootstrap-theme/jquery.fonticonpicker.bootstrap.css');
	    wp_enqueue_style('chosen', trailingslashit(get_template_directory_uri()) . 'assets/backend/css/chosen.css');
	    wp_enqueue_style('bootstrap', trailingslashit(get_template_directory_uri()) . 'assets/backend/css/bootstrap.css');
	    wp_enqueue_style('foodbakery-admin-lightbox', trailingslashit(get_template_directory_uri()) . 'assets/backend/css/lightbox.css');
	    wp_enqueue_style('foodbakery-admin-style', trailingslashit(get_template_directory_uri()) . 'assets/backend/css/admin-style.css');
	    wp_enqueue_style('wp-color-picker');

	    // all js script
	    wp_enqueue_media();
	    wp_enqueue_script('admin-upload', $foodbakery_var_template_path, array('jquery', 'media-upload', 'thickbox', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-slider', 'wp-color-picker'));
	    wp_enqueue_script('fonticonpicker', trailingslashit(get_template_directory_uri()) . 'assets/common/icomoon/js/jquery.fonticonpicker.min.js');
	    wp_enqueue_script('bootstrap', trailingslashit(get_template_directory_uri()) . 'assets/common/js/bootstrap.min.js', '', '', true);
	    wp_enqueue_style('jquery_datetimepicker', trailingslashit(get_template_directory_uri()) . 'assets/backend/css/jquery_datetimepicker.css');
	    wp_enqueue_style('datepicker', trailingslashit(get_template_directory_uri()) . 'assets/backend/css/datepicker.css');
	    wp_enqueue_style('jquery_ui_datepicker_theme', trailingslashit(get_template_directory_uri()) . 'assets/backend/css/jquery_ui_datepicker_theme.css');
	    wp_enqueue_script('jquery_datetimepicker', trailingslashit(get_template_directory_uri()) . 'assets/backend/js/jquery_datetimepicker.js');
	    wp_enqueue_script('foodbakery-light-box-js', trailingslashit(get_template_directory_uri()) . 'assets/backend/js/light-box.js', '', '', true);
	    wp_enqueue_script('foodbakery-theme-options', trailingslashit(get_template_directory_uri()) . 'assets/backend/js/cs-theme-option-fucntions.js', '', '', true);
	    $foodbakery_theme_options_vars = array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'theme_url' => get_template_directory_uri(),
	    );
	    wp_localize_script('foodbakery-theme-options', 'foodbakery_theme_options_vars', $foodbakery_theme_options_vars);
	    wp_enqueue_script('chosen', trailingslashit(get_template_directory_uri()) . 'assets/common/js/chosen.select.js', '', '');
	    wp_enqueue_script('foodbakery-custom-functions', trailingslashit(get_template_directory_uri()) . 'assets/backend/js/cs-fucntions.js', '', $theme_version, true);

	    ////editor script
	    wp_enqueue_script('jquery-te', trailingslashit(get_template_directory_uri()) . 'assets/backend/editor/js/jquery-te-1.4.0.min.js');
	    wp_enqueue_style('jquery-te', trailingslashit(get_template_directory_uri()) . 'assets/backend/editor/css/jquery-te-1.4.0.css');
	    
	}
    }

    add_action('admin_enqueue_scripts', 'foodbakery_var_admin_scripts_enqueue');
}

if (!function_exists('foodbakery_admin_inline_enqueue_script')) {

    function foodbakery_admin_inline_enqueue_script($script = '', $script_handler = 'custom') {
        wp_enqueue_script($script_handler);
        wp_add_inline_script($script_handler, $script);
    }

}

if (!function_exists('foodbakery_var_date_picker')) {

    function foodbakery_var_date_picker() {
	global $foodbakery_var_template_path;
	wp_enqueue_script('foodbakery-admin-upload', $foodbakery_var_template_path, array('jquery', 'media-upload'));
    }

}

/*
 * Get current theme version
 */
if (!function_exists('foodbakery_get_theme_version')) {

    function foodbakery_get_theme_version() {
	$my_theme = wp_get_theme();
	$theme_version = $my_theme->get('Version');
	return $theme_version;
    }

}

/**
 * Default Pages title.
 *
 * @since Auto Mobile 1.0
 */
if (!function_exists('foodbakery_post_page_title')) {

    function foodbakery_post_page_title() {

	$foodbakery_var_search_result = foodbakery_var_theme_text_srt('foodbakery_var_search_result');
	$foodbakery_var_author = foodbakery_var_theme_text_srt('foodbakery_var_author');
	$foodbakery_var_archives = foodbakery_var_theme_text_srt('foodbakery_var_archives');
	$foodbakery_var_daily_archives = foodbakery_var_theme_text_srt('foodbakery_var_daily_archives');
	$foodbakery_var_monthly_archives = foodbakery_var_theme_text_srt('foodbakery_var_monthly_archives');
	$foodbakery_var_yearly_archives = foodbakery_var_theme_text_srt('foodbakery_var_yearly_archives');
	$foodbakery_var_tags = foodbakery_var_theme_text_srt('foodbakery_var_tags');
	$foodbakery_var_category = foodbakery_var_theme_text_srt('foodbakery_var_category');
	$foodbakery_var_error_404 = foodbakery_var_theme_text_srt('foodbakery_var_error_404');
	$foodbakery_var_home = foodbakery_var_theme_text_srt('foodbakery_var_home');

	if (!is_page() && !is_singular() && !is_search() && !is_404() && !is_front_page()) {
	    if (function_exists('is_shop') && !is_shop()) {
		the_archive_title();
	    } else {
		the_archive_title();
	    }
	} elseif (is_search()) {
	    printf($foodbakery_var_search_result, '<span>' . get_search_query() . '</span>');
	} elseif (is_404()) {
	    echo esc_attr($foodbakery_var_error_404);
	} elseif (is_home()) {
	    echo esc_html($foodbakery_var_home);
	} elseif (is_page() || is_singular()) {
	    echo get_the_title();
	} elseif (function_exists('is_shop') && is_shop()) {
	    $foodbakery_var_post_ID = wc_get_page_id('shop');
	    echo get_the_title($foodbakery_var_post_ID);
	}
    }

}

/**
 * @Breadcrumb Function
 *
 */
if (!function_exists('foodbakery_breadcrumbs')) {

    function foodbakery_breadcrumbs($foodbakery_border = '') {
	global $wp_query, $foodbakery_var_options, $post, $foodbakery_var_static_text;
	/* === OPTIONS === */
	$foodbakery_var_current_page = foodbakery_var_theme_text_srt('foodbakery_var_current_page');
	$foodbakery_var_error_404 = foodbakery_var_theme_text_srt('foodbakery_var_error_404');
	$foodbakery_var_home = foodbakery_var_theme_text_srt('foodbakery_var_home');
	$text['home'] = esc_html($foodbakery_var_home); // text for the 'Home' link
	$text['category'] = '%s'; // text for a category page
	$text['search'] = '%s'; // text for a search results page
	$text['tag'] = '%s'; // text for a tag page
	$text['author'] = '%s'; // text for an author page
	$text['404'] = esc_attr($foodbakery_var_error_404); // text for the 404 page
	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$showOnHome = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter = ''; // delimiter between crumbs
	$before = '<li class="active">'; // tag before the current crumb
	$after = '</li>'; // tag after the current crumb
	/* === END OF OPTIONS === */
	$current_page = $foodbakery_var_current_page;
	$homeLink = home_url() . '/';
	$linkBefore = '<li>';
	$linkAfter = '</li>';
	$linkAttr = '';
	$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
	$linkhome = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
	$foodbakery_border_style = $foodbakery_border != '' ? ' style="border-top: 1px solid ' . $foodbakery_border . ';"' : '';
	if (is_home() || is_front_page()) {
	    if ($showOnHome == "1")
		echo '<div' . foodbakery_allow_special_char($foodbakery_border_style) . ' class="breadcrumbs align-left"><div class="container"><div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><ul>' . foodbakery_allow_special_char($before) . '<a href="' . esc_url($homeLink) . '">' . esc_html($text['home']) . '</a>' . foodbakery_allow_special_char($after) . '</ul></div></div></div></div>';
	} else {
	    echo '<div' . foodbakery_allow_special_char($foodbakery_border_style) . ' class="breadcrumbs align-left"><div class="container"><div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <ul>' . sprintf($linkhome, $homeLink, $text['home']) . foodbakery_allow_special_char($delimiter);
	    if (is_category()) {
		$thisCat = get_category(get_query_var('cat'), false);
		if ($thisCat->parent != 0) {
		    $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
		    $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
		    $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
		    echo foodbakery_allow_special_char($cats);
		}
		echo foodbakery_allow_special_char($before) . sprintf($text['category'], single_cat_title('', false)) . foodbakery_allow_special_char($after);
	    } elseif (is_search()) {
		echo foodbakery_allow_special_char($before) . sprintf($text['search'], get_search_query()) . foodbakery_allow_special_char($after);
	    } elseif (is_day()) {
		echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . foodbakery_allow_special_char($delimiter);
		echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . foodbakery_allow_special_char($delimiter);
		echo foodbakery_allow_special_char($before) . get_the_time('d') . foodbakery_allow_special_char($after);
	    } elseif (is_month()) {
		echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . foodbakery_allow_special_char($delimiter);
		echo foodbakery_allow_special_char($before) . get_the_time('F') . foodbakery_allow_special_char($after);
	    } elseif (is_year()) {
		echo foodbakery_allow_special_char($before) . get_the_time('Y') . foodbakery_allow_special_char($after);
	    } elseif (is_single() && !is_attachment()) {
		if (function_exists("is_shop") && get_post_type() == 'product') {
		    $foodbakery_shop_page_id = wc_get_page_id('shop');
		    $current_page = get_the_title(get_the_id());
		    $foodbakery_shop_page = "<li><a href='" . esc_url(get_permalink($foodbakery_shop_page_id)) . "'>" . get_the_title($foodbakery_shop_page_id) . "</a></li>";
		    echo foodbakery_allow_special_char($foodbakery_shop_page);
		    if ($showCurrent == 1)
			echo foodbakery_allow_special_char($before) . esc_html($current_page) . foodbakery_allow_special_char($after);
		}
		else if (get_post_type() != 'post') {
		    $post_type = get_post_type_object(get_post_type());
		    $slug = $post_type->rewrite;
		    printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
		    if ($showCurrent == 1)
			echo foodbakery_allow_special_char($delimiter) . foodbakery_allow_special_char($before) . esc_html($current_page) . foodbakery_allow_special_char($after);
		} else {
		    $cat = get_the_category();
		    $cat = isset($cat[0])? $cat[0] : '';
                    if( $cat != ''){
                        $cats = get_category_parents($cat, TRUE, $delimiter);
                        if ($showCurrent == 0)
                            $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                        $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                        $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                        echo foodbakery_allow_special_char($cats);
                    }
		    if ($showCurrent == 1)
			echo foodbakery_allow_special_char($before) . esc_html($current_page) . foodbakery_allow_special_char($after);
		}
	    } elseif (!is_single() && !is_page() && get_post_type() <> '' && get_post_type() != 'post' && !is_404()) {
		$post_type = get_post_type_object(get_post_type());
		echo foodbakery_allow_special_char($before) . $post_type->labels->singular_name . foodbakery_allow_special_char($after);
	    } elseif (isset($wp_query->query_vars['taxonomy']) && !empty($wp_query->query_vars['taxonomy'])) {
		$taxonomy = $taxonomy_category = '';
		$taxonomy = $wp_query->query_vars['taxonomy'];
		echo foodbakery_allow_special_char($before) . esc_html($taxonomy) . foodbakery_allow_special_char($after);
	    } elseif (is_page() && !$post->post_parent) {
		if ($showCurrent == 1)
		    echo foodbakery_allow_special_char($before) . get_the_title() . foodbakery_allow_special_char($after);
	    } elseif (is_page() && $post->post_parent) {
		$parent_id = $post->post_parent;
		$breadcrumbs = array();
		while ($parent_id) {
		    $page = get_page($parent_id);
		    $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
		    $parent_id = $page->post_parent;
		}
		$breadcrumbs = array_reverse($breadcrumbs);
		for ($i = 0; $i < count($breadcrumbs); $i ++) {
		    echo foodbakery_allow_special_char($breadcrumbs[$i]);
		    if ($i != count($breadcrumbs) - 1)
			echo foodbakery_allow_special_char($delimiter);
		}
		if ($showCurrent == 1)
		    echo foodbakery_allow_special_char($delimiter . $before . get_the_title() . $after);
	    } elseif (is_tag()) {

		echo foodbakery_allow_special_char($before) . sprintf($text['tag'], single_tag_title('', false)) . foodbakery_allow_special_char($after);
	    } elseif (is_author()) {
		global $author;
		$userdata = get_userdata($author);
		echo foodbakery_allow_special_char($before) . sprintf($text['author'], $userdata->display_name) . foodbakery_allow_special_char($after);
	    } elseif (is_404()) {
		echo foodbakery_allow_special_char($before) . esc_html($text['404']) . foodbakery_allow_special_char($after);
	    }
	    echo '</ul></div></div></div></div>';
	}
    }

}

/**
 * Including the required files
 *
 * @since Foodbakery 1.0
 */
if (!function_exists('foodbakery_require_theme_files')) {

    function foodbakery_require_theme_files($foodbakery_path = '') {
	global $wp_filesystem;
	$backup_url = '';
	if (false === ($creds = request_filesystem_credentials($backup_url, '', false, false, array()) )) {
	    return true;
	}
	if (!WP_Filesystem($creds)) {
	    request_filesystem_credentials($backup_url, '', true, false, array());
	    return true;
	}
	$foodbakery_sh_front_dir = trailingslashit(get_template_directory()) . $foodbakery_path;
	$foodbakery_sh_front_dir = str_replace(ABSPATH, $wp_filesystem->abspath(), $foodbakery_sh_front_dir);
	$foodbakery_all_f_list = $wp_filesystem->dirlist($foodbakery_sh_front_dir);
	if (is_array($foodbakery_all_f_list) && sizeof($foodbakery_all_f_list) > 0) {
	    foreach ($foodbakery_all_f_list as $file_key => $file_val) {
		if (isset($file_val['name'])) {
		    $foodbakery_file_name = $file_val['name'];
		    $foodbakery_ext = pathinfo($foodbakery_file_name, PATHINFO_EXTENSION);
		    if ($foodbakery_ext == 'php') {
			require_once trailingslashit(get_template_directory()) . $foodbakery_path . $foodbakery_file_name;
		    }
		}
	    }
	}
    }

}
/**
 * @Custom CSS
 *
 */
if (!function_exists('foodbakery_write_stylesheet_content')) {

    function foodbakery_write_stylesheet_content() {
	global $wp_filesystem, $foodbakery_var_options;
	require_once get_template_directory() . '/include/frontend/cs-theme-styles.php';
	$foodbakery_export_options = foodbakery_var_custom_style_theme_options();
	$fileStr = $foodbakery_export_options;
	$regex = array(
	    "`^([\t\s]+)`ism"=>'',
            "`^\/\*(.+?)\*\/`ism"=>"",
            //"`([\n\A;]+)\/\*(.+?)\*\/`ism"=>"$1",
            //"`([\n\A;\s]+)\/(.+?)[\n\r]`ism"=>"$1\n",
            "`(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+`ism"=>"\n"
	);
	$newStr = preg_replace(array_keys($regex), $regex, $fileStr);

	$foodbakery_option_fields = $newStr;
	$backup_url = wp_nonce_url('themes.php?page=foodbakery_var_settings_page');
	if (false === ($creds = request_filesystem_credentials($backup_url, '', false, false, array()) )) {
	    return true;
	}
	if (!WP_Filesystem($creds)) {
	    request_filesystem_credentials($backup_url, '', true, false, array());
	    return true;
	}
	$foodbakery_upload_dir = get_template_directory() . '/assets/frontend/css/';
	$foodbakery_filename = trailingslashit($foodbakery_upload_dir) . 'default-element.css';
	if (!$wp_filesystem->put_contents($foodbakery_filename, $foodbakery_option_fields, FS_CHMOD_FILE)) {

	}
    }

}




/**
 * stripslashes string
 *
 * @since Auto Mobile 1.0
 */
if (!function_exists('foodbakery_var_stripslashes_htmlspecialchars')) {

    function foodbakery_var_stripslashes_htmlspecialchars($value) {
	$value = is_array($value) ? array_map('foodbakery_var_stripslashes_htmlspecialchars', $value) : stripslashes(htmlspecialchars($value));
	return $value;
    }

}

require_once ABSPATH . '/wp-admin/includes/file.php';

/**
 * Mega Menu.
 */
require_once trailingslashit(get_template_directory()) . 'include/mega-menu/custom-walker.php';
require_once trailingslashit(get_template_directory()) . 'include/mega-menu/edit-custom-walker.php';
require_once trailingslashit(get_template_directory()) . 'include/mega-menu/menu-functions.php';


/**
 * Implement the Custom Header feature.
 */
require_once trailingslashit(get_template_directory()) . 'include/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once trailingslashit(get_template_directory()) . 'include/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require_once trailingslashit(get_template_directory()) . 'include/extras.php';

/*
 * Inlcude themes required files for theme options
 */
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-custom-fields/cs-form-fields.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-custom-fields/cs-html-fields.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-admin-functions.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/importer-hooks.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-googlefont/cs-fonts-array.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-googlefont/cs-fonts.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-googlefont/cs-fonts-functions.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-widgets/import/cs-class-widget-data.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-theme-options/cs-theme-options.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-theme-options/cs-theme-options-functions.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-theme-options/cs-theme-options-fields.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-theme-options/cs-theme-options-arrays.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-activation-plugins/cs-require-plugins.php';
require_once trailingslashit(get_template_directory()) . 'include/cs-class-parse.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/theme-config.php';
require_once trailingslashit(get_template_directory()) . 'include/frontend/cs-header.php';
require_once trailingslashit(get_template_directory()) . 'include/frontend/class-pagination.php';
require_once trailingslashit(get_template_directory()) . 'template-parts/blog/blog_element.php';
require_once trailingslashit(get_template_directory()) . 'template-parts/blog/blog_functions.php';
/*
 * Inlcude theme classes files
 */
require_once trailingslashit(get_template_directory()) . 'include/backend/classes/class-category-meta.php';
/*
 * Inlcude theme required files for widgets
 */
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-widgets/cs-custom-menu.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-widgets/cs-flickr.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-widgets/cs-author.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-widgets/cs-ads.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-widgets/cs-mailchimp.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-widgets/cs-twitter.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-widgets/cs-facebook.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-widgets/cs-recent-posts.php';
require_once trailingslashit(get_template_directory()) . 'include/backend/cs-widgets/cs-contact-info.php';
if (class_exists('woocommerce')) {
    require_once trailingslashit(get_template_directory()) . 'include/backend/cs-woocommerce/cs-config.php';
}

/*
 * Include Top Strip File
 */
require_once trailingslashit(get_template_directory()) . 'include/frontend/cs-top-strip.php';
if (!function_exists('foodbakery_include_shortcodes')) {

    /**
     * Include shortcodes backend and frontend as well.
     */
    function foodbakery_include_shortcodes() {
	/* shortcodes files */
	foodbakery_require_theme_files('include/backend/cs-shortcodes/');
	foodbakery_require_theme_files('include/frontend/cs-shortcodes/');
    }

    add_action('init', 'foodbakery_include_shortcodes', 1);
}


/**
 * Social Networks Detail
 *
 * @param string $icon_type Icon Size.
 * @param string $tooltip Description.
 *
 */
if (!function_exists('foodbakery_social_network')) {

    function foodbakery_social_network($header9, $icon_type = '', $tooltip = '', $ul_class = '', $no_title = true) {
	global $foodbakery_var_options;
	$html = '';
	$tooltip_data = '';
	if ($icon_type == 'large') {
	    $icon = 'icon-2x';
	} else {

	    $icon = '';
	}
	if (isset($tooltip) && $tooltip <> '') {
	    $tooltip_data = 'data-placement-tooltip="tooltip"';
	}
	if (isset($foodbakery_var_options['foodbakery_var_social_net_url']) and count($foodbakery_var_options['foodbakery_var_social_net_url']) > 0) {
	    $i = 0;

	    $html .= '<ul class="' . $ul_class . '">';
	    if (is_array($foodbakery_var_options['foodbakery_var_social_net_url'])):
		foreach ($foodbakery_var_options['foodbakery_var_social_net_url'] as $val) {
		    if ('' !== $val) {
			if ($no_title == false) {
			    $data_original_title = '';
			} else {
			    $data_original_title = $foodbakery_var_options['foodbakery_var_social_net_tooltip'][$i];
			}
			$html .= '<li>';
			$html .= '<a href="' . $val . '" data-original-title="' . $data_original_title . '" data-placement="top" ' . foodbakery_allow_special_char($tooltip_data, false) . ' class="colrhover"  target="_blank">';
			if ($foodbakery_var_options['foodbakery_var_social_net_awesome'][$i] <> '' && isset($foodbakery_var_options['foodbakery_var_social_net_awesome'][$i])) {
			    $html .= '<i class="' . $foodbakery_var_options['foodbakery_var_social_net_awesome'][$i] . $icon . '"></i>';
			} else {
			    $html .= '<img title="' . $foodbakery_var_options['foodbakery_var_social_net_tooltip'][$i] . '" src="' . $foodbakery_var_options['foodbakery_var_social_icon_path_array'][$i] . '" alt="' . $foodbakery_var_options['foodbakery_var_social_net_tooltip'][$i] . '" />';
			}
			$html .= '</a>
                            </li>';
		    }
		    $i ++;
		}
	    endif;
	    $html .= '</ul>';
	}
	if ($header9 == 1) {
	    return $html;
	} else {
	    echo foodbakery_allow_special_char($html);
	}
    }

}
/**
 * @Get sidebar name id
 *
 */
if (!function_exists('foodbakery_get_sidebar_id')) {

    function foodbakery_get_sidebar_id($foodbakery_page_sidebar_left = '') {

	return sanitize_title($foodbakery_page_sidebar_left);
    }

}
//if (class_exists('RevSlider')) {
//
//    class foodbakery_var_RevSlider extends RevSlider {
//	/*
//	 * Get sliders alias, Title, ID
//	 */
//	public function getAllSliderAliases() {
//	    $where = "";
//	    $response = $this->db->fetch(GlobalsRevSlider::$table_sliders, $where, "id");
//	    $arrAliases = array();
//	    $slider_array = array();
//	    foreach ($response as $arrSlider) {
//		$arrAliases['id'] = $arrSlider["id"];
//		$arrAliases['title'] = $arrSlider["title"];
//		$arrAliases['alias'] = $arrSlider["alias"];
//		$slider_array[] = $arrAliases;
//	    }
//	    return($slider_array);
//	}
//
//    }
//
//}

/* Start function for RevSlider Extend Class
 */
if (class_exists('RevSlider')) {

    class foodbakery_var_RevSlider extends RevSlider {
        /*
         * Get sliders alias, Title, ID
         */

        public function getAllSliderAliases() {
            $arrAliases = array();
            $slider_array = array();

            $slider = new RevSlider();

            if (method_exists($slider, "get_sliders")) {
                $slider = new RevSlider();
                $objSliders = $slider->get_sliders();

                foreach ($objSliders as $arrSlider) {
                    $arrAliases['id'] = $arrSlider->id;
                    $arrAliases['title'] = $arrSlider->title;
                    $arrAliases['alias'] = $arrSlider->alias;
                    $slider_array[] = $arrAliases;
                }
            } else {
                $where = "";
                $response = $this->db->fetch(GlobalsRevSlider::$table_sliders, $where, "id");
                foreach ($response as $arrSlider) {
                    $arrAliases['id'] = $arrSlider["id"];
                    $arrAliases['title'] = $arrSlider["title"];
                    $arrAliases['alias'] = $arrSlider["alias"];
                    $slider_array[] = $arrAliases;
                }
            }
            return($slider_array);
        }

    }

}

/**
 * Start Function Allow Special Character
 */
if (!function_exists('foodbakery_allow_special_char')) {

    function foodbakery_allow_special_char($input = '') {
	$output = $input;
	return $output;
    }

}

if (!function_exists('foodbakery_get_excerpt')) {

    function foodbakery_get_excerpt($wordslength = '', $readmore = 'true', $readmore_text = 'Read More') {
	global $post, $foodbakery_var_options;
	if ($wordslength == '') {
	    $wordslength = $foodbakery_var_options['foodbakery_var_excerpt_length'] ? $foodbakery_var_options['foodbakery_var_excerpt_length'] : '30';
	}
	$excerpt = trim(preg_replace('/<a[^>]*>(.*)<\/a>/iU', '', get_the_content()));

	if ($readmore == 'true') {
	    $more = ' <a href="' . esc_url(get_permalink($post->ID)) . '">' . esc_html($readmore_text) . '</a>';
	} else {
	    $more = '...';
	}
	$excerpt_new = wp_trim_words($excerpt, $wordslength, $more);
	return $excerpt_new;
    }

}

//Posts title limit count

if (!function_exists('foodbakery_get_post_excerpt')) {

    function foodbakery_get_post_excerpt($string, $wordslength = '') {
	global $post;
	if ($wordslength == '') {
	    $wordslength = '500';
	}
	$excerpt = trim(preg_replace('/<a[^>]*>(.*)<\/a>/iU', '', $string));
	$excerpt_new = wp_trim_words($excerpt, $wordslength, ' ...');
	return $excerpt_new;
    }

}

if (!function_exists('foodbakery_var_get_pagination')) {

    function foodbakery_var_get_pagination($total_pages = 1, $page = 1, $shortcode_paging = '') {
	global $foodbakery_var_static_text;
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_short_code_strings();
	$query_string = cs_get_server_data('QUERY_STRING');
	$base = get_permalink() . '?' . remove_query_arg($shortcode_paging, $query_string) . '%_%';
	$foodbakery_var_pagination = paginate_links(array(
	    'base' => @add_query_arg($shortcode_paging, '%#%'),
	    'format' => '&' . $shortcode_paging . '=%#%', // this defines the query parameter that will be used, in this case "p"
	    'prev_text' => '<i class="icon-long-arrow-left"></i> ' . esc_html(foodbakery_var_theme_text_srt('foodbakery_var_prev')), // text for previous page
	    'next_text' => esc_html(foodbakery_var_theme_text_srt('foodbakery_var_next')) . ' <i class="icon-long-arrow-right"></i>', // text for next page
	    'total' => $total_pages, // the total number of pages we have
	    'current' => $page, // the current page
	    'end_size' => 1,
	    'mid_size' => 2,
	    'type' => 'array',
		));
	$foodbakery_var_pages = '';
	if (is_array($foodbakery_var_pagination) && sizeof($foodbakery_var_pagination) > 0) {
	    $foodbakery_var_pages .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
	    $foodbakery_var_pages .= '<nav>';
	    $foodbakery_var_pages .= '<ul class="pagination">';
	    foreach ($foodbakery_var_pagination as $foodbakery_var_link) {
		if (strpos($foodbakery_var_link, 'current') !== false) {
		    $foodbakery_var_pages .= '<li><a class="active">' . preg_replace("/[^0-9]/", "", $foodbakery_var_link) . '</a></li>';
		} else {
		    $foodbakery_var_pages .= '<li>' . $foodbakery_var_link . '</li>';
		}
	    }
	    $foodbakery_var_pages .= '</ul>';
	    $foodbakery_var_pages .= ' </nav>';
	    $foodbakery_var_pages .= '</div>';
	}
	echo foodbakery_allow_special_char($foodbakery_var_pages);
    }

}

if (!function_exists('foodbakery_get_posts_ajax_callback')) {

    function foodbakery_get_posts_ajax_callback() {
	$category = isset($_POST['category']) ? $_POST['category'] : '';
	$posts = array();
	if ($category != '') {

	}
	echo json_encode(array('status' => true, 'posts' => $posts));
	wp_die();
    }

    add_action("wp_ajax_foodbakery_get_posts", 'foodbakery_get_posts_ajax_callback');
}

function foodbakery_var_get_attachment_id($attachment_url) {
    global $wpdb;
    $attachment_id = false;
    // If there is no url, return.
    if ('' == $attachment_url)
	return;
    // Get the upload foodbakery paths
    $upload_dir_paths = wp_upload_dir();
    if (false !== strpos($attachment_url, $upload_dir_paths['baseurl'])) {
	// If this is the URL of an auto-generated thumbnail, get the URL of the original image
	$attachment_url = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url);
	// Remove the upload path base foodbakery from the attachment URL
	$attachment_url = str_replace($upload_dir_paths['baseurl'] . '/', '', $attachment_url);

	$attachment_id = $wpdb->get_var($wpdb->prepare("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url));
    }
    return $attachment_id;
}

/*
 * Wordpress default gallery customization
 */
if (!function_exists('foodbakery_custom_format_gallery')) {
    add_filter('post_gallery', 'foodbakery_custom_format_gallery', 10, 2);

    function foodbakery_custom_format_gallery($string, $attr) {
	$output = "";
	if (isset($attr['ids'])) {
	    $output = "<div class='post-gallery'>";
	    $posts = get_posts(array('include' => $attr['ids'], 'post_type' => 'attachment'));
	    foreach ($posts as $imagePost) {
		$output .= '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="media-holder"><figure><img src="' . wp_get_attachment_image_src($imagePost->ID, 'foodbakery_media_1')[0] . '" alt="foodbakery_media_1"></figure></div></div>';
	    }
	    $output .= "</div>";
	}
	return $output;
    }

}

if (function_exists('foodbakery_var_short_code')) {
    foodbakery_var_short_code('widget', 'foodbakery_widget_shortcode');
}

if (!function_exists('foodbakery_widget_shortcode')) {

    function foodbakery_widget_shortcode($atts) {
	$a = shortcode_atts(array(
	    'name' => 'something',
		), $atts);

	echo esc_html($a['name']);
	$params = array($a['name']);
	dynamic_sidebar($a['name']);
	the_widget('WP_Widget_Archives');
    }

}
/*
  password form
 */
if (!function_exists('foodbakery_password_form')) {

    function foodbakery_password_form() {
	global $post, $foodbakery_var_options, $foodbakery_var_form_fields;
	$cs_password_opt_array = array(
	    'std' => '',
	    'id' => '',
	    'classes' => '',
	    'extra_atr' => ' size="20"',
	    'cust_id' => 'password_field',
	    'cust_name' => 'post_password',
	    'return' => true,
	    'required' => false,
	    'cust_type' => 'password',
	);

	$cs_submit_opt_array = array(
	    'std' => esc_html__("Submit", 'foodbakery'),
	    'id' => '',
	    'classes' => 'bgcolr',
	    'extra_atr' => '',
	    'cust_id' => '',
	    'cust_name' => 'Submit',
	    'return' => true,
	    'required' => false,
	    'cust_type' => 'submit',
	);
	$label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );
	$o = '<div class="password_protected">
                <div class="protected-icon"><a href="#"><i class="icon-unlock-alt icon-4x"></i></a></div>
                <h3>' . esc_html__("This post is password protected. To view it please enter your password below:", 'foodbakery') . '</h3>';
	$o .= '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post"><label>'
		. $foodbakery_var_form_fields->foodbakery_var_form_text_render($cs_password_opt_array)
		. '</label>'
		. $foodbakery_var_form_fields->foodbakery_var_form_text_render($cs_submit_opt_array)
		. '</form>
            </div>';
	return $o;
    }

}


/*
 * default pagination
 */
/*
 * start function for custom pagination
 */


if (!function_exists('foodbakery_default_pagination')) :

    /**
     * Display navigation to next/previous set of posts when applicable.
     * Based on paging nav function from Twenty Fourteen
     */
    function foodbakery_default_pagination() {
	// Don't print empty markup if there's only one page.
	if ($GLOBALS['wp_query']->max_num_pages < 2) {
	    return;
	}

	$paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
	$pagenum_link = html_entity_decode(get_pagenum_link());
	$query_args = array();
	$url_parts = explode('?', $pagenum_link);

	if (isset($url_parts[1])) {
	    wp_parse_str($url_parts[1], $query_args);
	}

	$pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
	$pagenum_link = trailingslashit($pagenum_link) . '%_%';

	$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links(array(
	    'base' => $pagenum_link,
	    'format' => $format,
	    'total' => $GLOBALS['wp_query']->max_num_pages,
	    'current' => $paged,
	    'mid_size' => 3,
	    'add_args' => array_map('urlencode', $query_args),
	    'prev_text' => esc_html__('Prev', 'foodbakery'),
	    'next_text' => esc_html__('Next', 'foodbakery'),
	    'type' => 'list',
		));
	if ($links) :
	    ?>
	    <nav class="default-pagination" role="navigation">
	    <?php echo foodbakery_allow_special_char($links); ?>
	    </nav><!-- navigation -->
		<?php
	    endif;
	}

    endif;

   


    

    if (!function_exists('tags_balnce_func_theme')){
        function tags_balnce_func_theme($return = '') {
            if (function_exists('tags_balnce_func')){
                return tags_balnce_func($return, true);
            }else {
                return $return;
            }
        }
    }
    
    
    
    if( isset( $_GET['demo_url_update'])){
        $item_purchase_code_verification  = get_option('item_purchase_code_verification');
        $urls = json_decode($item_purchase_code_verification['urls']);
        $urls_new = $urls;
        foreach( $urls as $demo_key => $url_data){
            foreach( $url_data as $data_key => $data_value){
                //$data_value = str_replace( 'http://chimpgroup.com/wp-demo/webservice/demo/foodbakery/', 'http://10.10.15.55/foodbakery/wp-content/plugins/foodbakery-framework/includes/cs-importer/demo-data/', $data_value);
                $data_value = str_replace( 'http://10.10.15.55/foodbakery/wp-content/plugins/foodbakery-framework/includes/cs-importer/demo-data/', 'https://10.10.15.55/foodbakery/wp-content/plugins/foodbakery-framework/includes/cs-importer/demo-data/', $data_value);
                $urls_new->$demo_key->$data_key = $data_value;
            }
        }
        $urls_new = json_encode($urls_new);
        $item_purchase_code_verification['urls'] = $urls_new;
        update_option('item_purchase_code_verification', $item_purchase_code_verification);
        pre($item_purchase_code_verification);
    }
    
    if (!function_exists('foodbakery_get_page_settings')) {

        function foodbakery_get_page_settings($page_id, $field_name, $field_type = 'text') {
            global $foodbakery_plugin_options;
            $cs_foodbakery_framework = isset($foodbakery_plugin_options['foodbakery_foodbakery_framework']) ? $foodbakery_plugin_options['foodbakery_foodbakery_framework'] : 'foodbakery_builtin';
            $cs_foodbakery_framework = 'elementor';
            $response = '';
            if ($cs_foodbakery_framework == 'elementor') {
                if (class_exists('Elementor\Core\Settings\Manager')) {
                    $page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers('page');
                    $page_settings_model = $page_settings_manager->get_model($page_id);
                    $response = $page_settings_model->get_settings($field_name);
                    if ($field_type == 'image') {
                        $response = isset($response['url']) ? $response['url'] : $response;
                    }
                }
            } else {
                $response = get_post_meta($page_id, $field_name, true);
            }
            return $response;
        }

    }