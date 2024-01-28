<?php

/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package foodbakery
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function foodbakery_body_classes($classes) {
	global $foodbakery_var_options;
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }
	
	if ( ! get_option('foodbakery_var_options') ) {
		$classes[] = 'cs-blog-unit';
	}
	
	$header_view = isset( $foodbakery_var_options['foodbakery_var_select_header_Style'] ) ? $foodbakery_var_options['foodbakery_var_select_header_Style'] : '';
    if( 'view-9' === $header_view ) {
		$classes[] = ' container-margin ';
	}
	if( 'view-10' === $header_view ) {
		$classes[] = ' custom-container ';
	}
    return $classes;
}

add_filter('body_class', 'foodbakery_body_classes');
