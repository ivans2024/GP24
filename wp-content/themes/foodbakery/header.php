<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package foodbakery
 */
do_action( 'foodbakery_before_header' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <?php
        global $foodbakery_var_options;
        $foodbakery_var_layout = isset( $foodbakery_var_options['foodbakery_var_layout'] ) ? $foodbakery_var_options['foodbakery_var_layout'] : '';
        ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php
        
        $bg_color = get_post_meta( get_the_id(), 'foodbakery_var_page_bg_color', true );
        $style_bgcol = '';
        if ( isset( $bg_color ) && $bg_color != '' && ! is_array( $bg_color ) ) {
            $style_bgcol = 'style="background-color:' . $bg_color . '"';
        }
		wp_head();
        ?>
    </head>
    <body  <?php body_class(); ?>>
        <?php wp_body_open(); ?>
        <div class="wrapper wrapper-<?php echo esc_html( $foodbakery_var_layout ); ?>" <?php esc_html($style_bgcol); ?>>
            <!-- Side Menu Start -->
            <div id="overlay"></div>
            <?php
            $foodbakery_var_maintenance_page = isset( $foodbakery_var_options['foodbakery_var_maintinance_mode_page'] ) ? $foodbakery_var_options['foodbakery_var_maintinance_mode_page'] : '';
            $foodbakery_var_maintenance_check = isset( $foodbakery_var_options['foodbakery_var_maintenance_switch'] ) ? $foodbakery_var_options['foodbakery_var_maintenance_switch'] : '';
            $foodbakery_var_maintenance_header_switch = isset( $foodbakery_var_options['foodbakery_var_maintenance_header_switch'] ) ? $foodbakery_var_options['foodbakery_var_maintenance_header_switch'] : 'off';
            if ( get_the_ID() == $foodbakery_var_maintenance_page && $foodbakery_var_maintenance_check == 'on' && $foodbakery_var_maintenance_header_switch <> 'on' ) {
                echo '<header id="header"></header>';
            } elseif ( '' != get_the_ID() && get_the_ID() == $foodbakery_var_maintenance_page && $foodbakery_var_maintenance_check <> 'on' && $foodbakery_var_maintenance_header_switch <> 'on' ) {
                echo '<header id="header"></header>';
            } else {
                foodbakery_main_header();
                if ( function_exists( 'foodbakery_var_subheader_style' ) ) {
                    foodbakery_var_subheader_style();
                }
            }