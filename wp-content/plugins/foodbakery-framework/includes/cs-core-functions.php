<?php

/**
 * Core Functions of Plugin
 * @return
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('foodbakery_var_core_functions')) {

    class foodbakery_var_core_functions {

        public function __construct() {
           //* add_action('save_post', array($this, 'foodbakery_var_save_custom_option'));
        }

        /**
         * Get attachment id
         * from url
         * @return id
         */
        public function foodbakery_var_get_attachment_id($attachment_url) {
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
         * Pagination 
         */

        public function foodbakery_var_plugin_pagination($total_pages = 1, $page = 1, $shortcode_paging) {
            global $foodbakery_var_frame_static_text;
			/*
            $foodbakery_var_prev = isset($foodbakery_var_frame_static_text['foodbakery_var_prev']) ? $foodbakery_var_frame_static_text['foodbakery_var_prev'] : '';
            $foodbakery_var_next = isset($foodbakery_var_frame_static_text['foodbakery_var_next']) ? $foodbakery_var_frame_static_text['foodbakery_var_next'] : '';
            $query_string = $_SERVER['QUERY_STRING'];
			*/
            $base = get_permalink() . '?' . remove_query_arg($shortcode_paging, $query_string) . '%_%';

            $foodbakery_var_pagination = paginate_links(array(
                'base' => @add_query_arg($shortcode_paging, '%#%'),
                'format' => '&' . $shortcode_paging . '=%#%', // this defines the query parameter that will be used, in this case "p"
                'prev_text' => '<i class="icon-angle-left"></i> ' . foodbakery_var_frame_text_srt('foodbakery_var_prev'), // text for previous page
                'next_text' => foodbakery_var_frame_text_srt('foodbakery_var_next') . ' <i class="icon-angle-right"></i>', // text for next page
                'total' => $total_pages, // the total number of pages we have
                'current' => $page, // the current page
                'end_size' => 1,
                'mid_size' => 2,
                'type' => 'array',
            ));
            $foodbakery_var_pages = '';
            if (is_array($foodbakery_var_pagination) && sizeof($foodbakery_var_pagination) > 0) {
                $foodbakery_var_pages .= '<ul class="pagination">';
                foreach ($foodbakery_var_pagination as $foodbakery_var_link) {
                    if (strpos($foodbakery_var_link, 'current') !== false) {
                        $foodbakery_var_pages .= '<li><a class="active">' . preg_replace("/[^0-9]/", "", $foodbakery_var_link) . '</a></li>';
                    } else {
                        $foodbakery_var_pages .= '<li>' . $foodbakery_var_link . '</li>';
                    }
                }
                $foodbakery_var_pages .= '</ul>';
            }
            echo force_balance_tags($foodbakery_var_pages);
        }

        /**
         * Include any template file with wordpress standards
         */
        public function foodbakery_var_get_template_part($slug, $name = '', $ext_template = '') {
            $template = '';

            if ($ext_template != '') {
                $ext_template = trailingslashit($ext_template);
            }
            if ($name) {
                $template = locate_template(array("{$slug}-{$name}.php", wp_foodbakery_var()->template_path() . "{$ext_template}{$slug}-{$name}.php"));
            }
            if (!$template && $name && file_exists(wp_foodbakery_var()->plugin_path() . "/templates/{$ext_template}{$slug}-{$name}.php")) {
                $template = wp_foodbakery_var()->plugin_path() . "/templates/{$ext_template}{$slug}-{$name}.php";
            }
            if (!$template) {
                $template = locate_template(array("{$slug}.php", wp_foodbakery_var()->template_path() . "{$ext_template}{$slug}.php"));
            }
            if ($template) {
                load_template($template, false);
            }
        }

    }

    global $foodbakery_var_wp_foodbakery_core;
    $foodbakery_var_wp_foodbakery_core = new foodbakery_var_core_functions();
}