<?php

/**
 * @Blog Categories html form for page builder
 */
if ( ! function_exists('foodbakery_var_foodbakery_blog_categories_shortcode') ) {

    function foodbakery_var_foodbakery_blog_categories_shortcode($atts, $content = "") {
        global $foodbakery_var_static_text;
        $strings = new foodbakery_theme_all_strings;
        $strings->foodbakery_short_code_strings();
        $foodbakery_var_defaults = array(
            'blog_cats_element_title' => '',
            'blog_cats' => '',
            'blog_num_cats' => '',
            'blog_cats_more_link_switch' => '',
            'blog_cats_more_link' => ''
        );
        extract(shortcode_atts($foodbakery_var_defaults, $atts));

        if ( isset($foodbakery_var_column_size) && $foodbakery_var_column_size != '' ) {
            if ( function_exists('foodbakery_var_custom_column_class') ) {
                $column_class = foodbakery_var_custom_column_class($foodbakery_var_column_size);
            }
        }

        $blog_cats_element_title = isset($blog_cats_element_title) ? $blog_cats_element_title : '';
        $blog_cats = isset($blog_cats) ? $blog_cats : '';
        $blog_num_cats = isset($blog_num_cats) ? $blog_num_cats : '';


        $html = '';
        if ( isset($column_class) && $column_class <> '' ) {
            $html .= '<div class="' . esc_html($column_class) . '">';
        }
        if ( $blog_cats_element_title !== '' ) {
            $html .= '<div class="element-title"><h2>' . esc_html($blog_cats_element_title) . '</h4></div>';
        }
        $html .= '<ul class="game-category">';
        if ( '' !== $blog_cats ) {
            $cats = explode(',', $blog_cats);
            $count = 1;
            foreach ( $cats as $cat ) {
                $category = get_category_by_slug($cat);
                $cat_meta = get_term_meta($category->term_id, 'cat_meta_data', true);
                $cat_icon = isset($cat_meta['cat_icon']) ? $cat_meta['cat_icon'] : '';
                $cat_icon_html = '';
                if ( '' !== $cat_icon ) {
                    $cat_icon_html = '<i class="' . $cat_icon . '"></i>';
                }
                $html .= '<li><a href="' . get_term_link($category->term_id) . '">' . $cat_icon_html . $category->name . '</a></li>';
                if ( $blog_num_cats == $count ) {
                    break;
                }
                $count ++;
            }
        } else {
            $categories = get_categories('post');
            if ( $categories ) {
                $count = 1;
                foreach ( $categories as $category ) {
                    $cat_meta = get_term_meta($category->term_id, 'cat_meta_data', true);
                    $cat_icon = isset($cat_meta['cat_icon']) ? $cat_meta['cat_icon'] : '';
                    $cat_icon_html = '';
                    if ( '' !== $cat_icon ) {
                        $cat_icon_html = '<i class="' . $cat_icon . '"></i>';
                    }
                    $html .= '<li><a href="' . get_term_link($category->term_id) . '">' . $cat_icon_html . $category->name . '</a></li>';
                    if ( $blog_num_cats == $count ) {
                        break;
                    }
                    $count ++;
                }
            }
        }
        if ( 'on' === $blog_cats_more_link_switch && '' !== $blog_cats_more_link ) {
            $html .= '<li><a href="' . esc_url($blog_cats_more_link) . '"><i class="icon-uniF11B"></i>' . foodbakery_var_theme_text_srt('foodbakery_var_cats_more') . '</a></li>';
        }
        $html .= '</ul>';

        if ( isset($column_class) && $column_class <> '' ) {
            $html .= '</div>';
        }

        return do_shortcode($html);
    }

    if ( function_exists('foodbakery_var_short_code') )
        foodbakery_var_short_code('foodbakery_blog_categories', 'foodbakery_var_foodbakery_blog_categories_shortcode');
}