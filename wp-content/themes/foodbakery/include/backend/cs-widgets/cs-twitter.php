<?php

/**
 * Foodbakery_Twitter_Widget Class
 *
 * @package Foodbakery
 */
if (!class_exists('Foodbakery_Twitter_Widget')) {

    /**
      Foodbakery_Weather class used to implement the custom weather widget.
     */
    class Foodbakery_Twitter_Widget extends WP_Widget {

	/**
	 * Sets up a new foodbakery twitter widget instance.
	 */
	public function __construct() {
	    global $foodbakery_var_static_text;
	    parent::__construct(
		    'foodbakery_var_twitter_widget', // Base ID.
		    foodbakery_var_theme_text_srt('foodbakery_var_twitter_widget'), // Name.
		    array('classname' => 'twitter-post', 'description' => foodbakery_var_theme_text_srt('foodbakery_var_twitter_widget_desciption'))
	    );
	}

	/**
	 * Outputs the foodbakery twitter widget settings form.
	 *
	 * @param array $instance Current settings.
	 */
	function form($instance) {
	    global $foodbakery_var_form_fields, $foodbakery_var_html_fields, $foodbakery_var_static_text;
	    $strings = new foodbakery_theme_all_strings;
	    $strings->foodbakery_short_code_strings();
	    $instance = wp_parse_args((array) $instance, array('title' => ''));
	    $title = $instance['title'];
	    $username = isset($instance['username']) ? esc_attr($instance['username']) : '';
	    $numoftweets = isset($instance['numoftweets']) ? esc_attr($instance['numoftweets']) : '';

	    $foodbakery_opt_array = array(
		'name' => foodbakery_var_theme_text_srt('foodbakery_var_title_field'),
		'desc' => '',
		'hint_text' => '',
		'echo' => true,
		'field_params' => array(
		    'std' => esc_html($title),
		    'id' => '',
		    'cust_name' => foodbakery_allow_special_char($this->get_field_name('title')),
		    'cust_id' => foodbakery_allow_special_char($this->get_field_name('title')),
		    'return' => true,
		),
	    );
	    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

	    $foodbakery_opt_array = array(
		'name' => foodbakery_var_theme_text_srt('foodbakery_var_twitter_widget_user_name'),
		'desc' => '',
		'hint_text' => '',
		'echo' => true,
		'field_params' => array(
		    'std' => esc_html($username),
		    'id' => '',
		    'cust_name' => foodbakery_allow_special_char($this->get_field_name('username')),
		    'cust_id' => foodbakery_allow_special_char($this->get_field_name('username')),
		    'return' => true,
		),
	    );
	    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

	    $foodbakery_opt_array = array(
		'name' => foodbakery_var_theme_text_srt('foodbakery_var_twitter_widget_tweets_num'),
		'desc' => '',
		'hint_text' => '',
		'echo' => true,
		'field_params' => array(
		    'std' => esc_html($numoftweets),
		    'id' => '',
		    'cust_name' => foodbakery_allow_special_char($this->get_field_name('numoftweets')),
		    'cust_id' => foodbakery_allow_special_char($this->get_field_name('numoftweets')),
		    'return' => true,
		),
	    );
	    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
	}

	/**
	 * Handles updating settings for the current foodbakery twitter widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user.
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	function update($new_instance, $old_instance) {

	    $instance = $old_instance;
	    $instance['title'] = $new_instance['title'];
	    $instance['username'] = $new_instance['username'];
	    $instance['numoftweets'] = $new_instance['numoftweets'];
	    return $instance;
	}

	/**
	 * Outputs the content for the current foodbakery twitter widget instance.
	 *
	 * @param array $args Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current twitter widget instance.
	 */
	function widget($args, $instance) {
	    global $foodbakery_var_options, $foodbakery_twitter_arg;

	    // include_once ABSPATH . 'wp-admin/includes/plugin.php';
	    //if (is_plugin_active('wp-foodbakery/wp-foodbakery.php')) {
		global $foodbakery_plugin_options;
		$foodbakery_twitter_arg['consumerkey'] = isset($foodbakery_plugin_options['foodbakery_consumer_key']) ? $foodbakery_plugin_options['foodbakery_consumer_key'] : '';
		$foodbakery_twitter_arg['consumersecret'] = isset($foodbakery_plugin_options['foodbakery_consumer_secret']) ? $foodbakery_plugin_options['foodbakery_consumer_secret'] : '';
		$foodbakery_twitter_arg['accesstoken'] = isset($foodbakery_plugin_options['foodbakery_access_token']) ? $foodbakery_plugin_options['foodbakery_access_token'] : '';
		$foodbakery_twitter_arg['accesstokensecret'] = isset($foodbakery_plugin_options['foodbakery_access_token_secret']) ? $foodbakery_plugin_options['foodbakery_access_token_secret'] : '';
		$foodbakery_cache_limit_time = isset($foodbakery_plugin_options['foodbakery_cache_limit_time']) ? $foodbakery_plugin_options['foodbakery_var_cache_limit_time'] : '';
		$foodbakery_tweet_num_from_twitter = isset($foodbakery_plugin_options['foodbakery_tweet_num_post']) ? $foodbakery_plugin_options['foodbakery_var_tweet_num_post'] : '';
		$foodbakery_twitter_datetime_formate = isset($foodbakery_plugin_options['foodbakery_twitter_datetime_formate']) ? $foodbakery_plugin_options['foodbakery_var_twitter_datetime_formate'] : '';
	    //} else {
		//$foodbakery_twitter_arg['consumerkey'] = isset($foodbakery_var_options['foodbakery_var_consumer_key']) ? $foodbakery_var_options['foodbakery_var_consumer_key'] : '';
		//$foodbakery_twitter_arg['consumersecret'] = isset($foodbakery_var_options['foodbakery_var_consumer_secret']) ? $foodbakery_var_options['foodbakery_var_consumer_secret'] : '';
		//$foodbakery_twitter_arg['accesstoken'] = isset($foodbakery_var_options['foodbakery_var_access_token']) ? $foodbakery_var_options['foodbakery_var_access_token'] : '';
		//$foodbakery_twitter_arg['accesstokensecret'] = isset($foodbakery_var_options['foodbakery_var_access_token_secret']) ? $foodbakery_var_options['foodbakery_var_access_token_secret'] : '';
		//$foodbakery_cache_limit_time = isset($foodbakery_var_options['foodbakery_var_cache_limit_time']) ? $foodbakery_var_options['foodbakery_var_cache_limit_time'] : '';
		//$foodbakery_tweet_num_from_twitter = isset($foodbakery_var_options['foodbakery_var_tweet_num_post']) ? $foodbakery_var_options['foodbakery_var_tweet_num_post'] : '';
		//$foodbakery_twitter_datetime_formate = isset($foodbakery_var_options['foodbakery_var_twitter_datetime_formate']) ? $foodbakery_var_options['foodbakery_var_twitter_datetime_formate'] : '';
	    //}

	    if ('' === intval($foodbakery_cache_limit_time)) {
		$foodbakery_cache_limit_time = 60;
	    }
	    if ('' === $foodbakery_twitter_datetime_formate) {
		$foodbakery_twitter_datetime_formate = 'time_since';
	    }

	    if ('' === intval($foodbakery_tweet_num_from_twitter)) {
		$foodbakery_tweet_num_from_twitter = 5;
	    }
	    extract($args, EXTR_SKIP);
	    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
	    $title = wp_specialchars_decode(stripslashes($title));
	    $username = $instance['username'];
	    $numoftweets = $instance['numoftweets'];

	    if ('' === intval($numoftweets)) {
		$numoftweets = 2;
	    }

	    echo foodbakery_allow_special_char($before_widget);
	    if (!empty($title) && ' ' !== $title) {
		echo foodbakery_allow_special_char($args['before_title'] . esc_html($title) . $args['after_title']);
	    }
	    if (class_exists('wp_foodbakery_framework')) {
		if (strlen($username) > 1) {
		    foodbakery_include_file(wp_foodbakery_framework::plugin_path() . '/includes/cs-twitter/display-tweets.php');
		    display_tweets($username, $foodbakery_twitter_datetime_formate, $foodbakery_tweet_num_from_twitter, $numoftweets, $foodbakery_cache_limit_time);
		}
	    }
	    echo foodbakery_allow_special_char($after_widget);
	}

    }

}
if (function_exists('cs_widget_register')) {
    cs_widget_register("Foodbakery_Twitter_Widget");
}

