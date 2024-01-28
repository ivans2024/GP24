<?php

/**
 * @Author posts widget Class
 *
 *
 */
class Foodbakery_author extends WP_Widget {

    /**
     * @init Author posts Module
     *
     *
     */
    public function __construct() {
	global $foodbakery_var_static_text;

	parent::__construct(
		'foodbakery_author_id', // Base ID
		foodbakery_var_theme_text_srt('foodbakery_var_author_widget_name'), // Name
		array('classname' => 'widget-author', 'description' => foodbakery_var_theme_text_srt('foodbakery_var_author_widget_description'),) // Args
	);
    }

    /**
     * Author posts html form
     *
     *
     */
    function form($instance) {
	global $foodbakery_var_form_fields, $foodbakery_var_html_fields, $foodbakery_var_static_text;
	$strings = new foodbakery_theme_all_strings;
	$strings->foodbakery_short_code_strings();
	$instance = wp_parse_args((array) $instance, array('title' => ''));
	$title = $instance['title'];
	$select_category = isset($instance['select_category']) ? esc_attr($instance['select_category']) : '';
	$showcount = isset($instance['showcount']) ? esc_attr($instance['showcount']) : '';
	$foodbakery_opt_array = array(
	    'name' => foodbakery_var_theme_text_srt('foodbakery_var_title_field'),
	    'desc' => '',
	    'hint_text' => '',
	    'echo' => true,
	    'field_params' => array(
		'std' => esc_attr($title),
		'id' => foodbakery_allow_special_char($this->get_field_id('title')),
		'classes' => '',
		'cust_id' => foodbakery_allow_special_char($this->get_field_name('title')),
		'cust_name' => foodbakery_allow_special_char($this->get_field_name('title')),
		'return' => true,
		'required' => false
	    ),
	);
	$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
	/*
	 * getting All user and form an array that contain user name as value and user id as key
	 */

	$args = array(
	    'blog_id' => $GLOBALS['blog_id'],
	    'role' => '',
	    'meta_key' => '',
	    'meta_value' => '',
	    'meta_compare' => '',
	    'orderby' => 'login',
	    'order' => 'ASC',
	    'offset' => '',
	    'search' => '',
	    'number' => '',
	    'count_total' => false,
	    'fields' => 'all',
	    'who' => ''
	);
	$user_query = new WP_User_Query($args);
	if (!empty($user_query->results)) {
	    foreach ($user_query->results as $user) {
		if ($user->display_name != '') {
		    $arr[$user->ID] = $user->display_name;
		}
	    }
	}
	$foodbakery_opt_array = array(
	    'name' => foodbakery_var_theme_text_srt('foodbakery_var_author_widget_choose_author'),
	    'desc' => '',
	    'hint_text' => '',
	    'echo' => true,
	    'field_params' => array(
		'std' => $select_category,
		'cust_name' => foodbakery_allow_special_char($this->get_field_name('select_category')),
		'cust_id' => foodbakery_allow_special_char($this->get_field_id('select_category')),
		'id' => '',
		'options' => $arr,
		'return' => true,
	    ),
	);
	$foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
	$foodbakery_inline_script = 'jQuery(document).ready(function ($) {
				chosen_selectionbox();
			});';
	foodbakery_admin_inline_enqueue_script($foodbakery_inline_script, 'foodbakery-custom-functions');
    }

    /**
     * @Author update form data
     *
     *
     */
    function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['title'] = $new_instance['title'];
	$instance['select_category'] = $new_instance['select_category'];
	return $instance;
    }

    /**
     * @Display Author posts widget
     *
     */
    function widget($args, $instance) {
	global $foodbakery_node, $wpdb, $post, $foodbakery_var_static_text;
	extract($args, EXTR_SKIP);
	$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
	$title = wp_specialchars_decode(stripslashes($title));
	$author_id = empty($instance['select_category']) ? '' : apply_filters('widget_title', $instance['select_category']);

	$author_name = '';
	$author_role = '';
	$author_meta = '';
	$author_description = '';
	$facebook = '';
	$twitter = '';
	$google_plus = '';
	$linkedin = '';
	$author_avatar = '';
	$user_post_count = '';

	echo '<div class="widget widget-related-post">';
	if (!empty($title) && $title <> ' ') {
	    echo '<div class="widget-title">';
	    echo '<h3 class="text-color">' . foodbakery_allow_special_char($title) . '</h3>';
	    echo '</div>';
	}
	$args = array(
	    'blog_id' => $GLOBALS['blog_id'],
	    'role' => '',
	    'meta_key' => '',
	    'meta_value' => '',
	    'meta_compare' => '',
	    'orderby' => 'login',
	    'order' => 'ASC',
	    'offset' => '',
	    'search' => '',
	    'number' => '',
	    'count_total' => false,
	    'fields' => 'all',
	    'who' => ''
	);
	$ss = get_users($args);
	$user_query = new WP_User_Query($args);

	// User Loop
	if (!empty($user_query->results)) {
	    foreach ($user_query->results as $user) {
		if ($user->ID == $author_id) {
		    $author_name = $user->display_name;
		    $author_role = $user->roles[0];
		    $author_meta = get_user_meta($user->ID);
		    $author_description = $author_meta['description'][0];
		    $facebook = get_user_meta($user->ID, 'foodbakery_user_facebook', true);
		    $twitter = get_user_meta($user->ID, 'foodbakery_user_twitter', true);
		    $google_plus = get_user_meta($user->ID, 'foodbakery_user_google_plus', true);
		    $linkedin = get_user_meta($user->ID, 'foodbakery_user_linkedin', true);
		    $author_avatar = get_avatar($user->ID, apply_filters('foodbakery_author_bio_avatar_size', 59));
		    $user_post_count = count_user_posts($user->ID);
		    $author_link = get_author_posts_url($user->ID);
		    ?> 
		    <div class="widget user-widget">
		        <div class="user-info">
		    	<div class="img-holder"><figure><a href="<?php echo esc_url($author_link); ?>"><?php echo esc_html($author_avatar) ; ?></a></figure></div>
		    	<div class="text-holder">
		    	    <h4><a href="<?php echo esc_url($author_link); ?>"><?php echo esc_html($author_name); ?></a></h4>
		    	    <?php echo foodbakery_var_theme_text_srt('foodbakery_var_author_widget_users_stories') ?><em><?php echo esc_html( $author_role ); ?></em>
		    	</div>
		        </div>
		        <p><?php echo wp_trim_words($author_description, 20); ?></p>
			</div>
		    <?php
		    echo '</div>';
		}
	    }
	} else {
	    echo foodbakery_var_theme_text_srt('foodbakery_var_author_widget_users_no_found');
	}
    }

}

if (function_exists('cs_widget_register')) {
    cs_widget_register("Foodbakery_author");
}
