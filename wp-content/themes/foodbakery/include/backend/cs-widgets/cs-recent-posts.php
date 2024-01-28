<?php

/**
 * @Recent posts widget Class
 *
 *
 */
class Foodbakery_recentposts extends WP_Widget {

    /**
     * @init Recent posts Module
     *
     *
     */
    public function __construct() {
	global $foodbakery_var_static_text;

	parent::__construct(
		'foodbakery_recentposts_id', // Base ID
		foodbakery_var_theme_text_srt('foodbakery_var_recent_post'), // Name
		array('classname' => 'widget-recent-blog', 'description' => foodbakery_var_theme_text_srt('foodbakery_var_recent_post_des'),) // Args
	);
    }

    /**
     * @Recent posts html form
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
	$select_blog_views = isset($instance['select_blog_views']) ? esc_attr($instance['select_blog_views']) : '';
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
	if (function_exists('foodbakery_show_all_cats')) {
	    $default_option = $cats_options = array();
	    $default_option[''] = foodbakery_var_theme_text_srt('foodbakery_var_all_cats');
	    $cats_options = foodbakery_show_all_cats('', '', foodbakery_allow_special_char($this->get_field_id('select_category')), 'category', true);
	    $cats_options = array_merge($default_option, $cats_options);
	    $foodbakery_opt_array = array(
		'name' => foodbakery_var_theme_text_srt('foodbakery_var_choose_category'),
		'desc' => '',
		'hint_text' => '',
		'echo' => true,
		'field_params' => array(
		    'std' => $select_category,
		    'cust_name' => foodbakery_allow_special_char($this->get_field_name('select_category')),
		    'cust_id' => foodbakery_allow_special_char($this->get_field_id('select_category')),
		    'id' => '',
		    'options' => $cats_options,
		    'return' => true,
		),
	    );

	    $foodbakery_var_html_fields->foodbakery_var_select_field($foodbakery_opt_array);
	}

	$foodbakery_opt_array = array(
	    'name' => foodbakery_var_theme_text_srt('foodbakery_var_blog_widget_style_desc'),
	    'desc' => '',
	    'hint_text' => '',
	    'echo' => true,
	    'field_params' => array(
		'std' => $select_blog_views,
		'cust_name' => foodbakery_allow_special_char($this->get_field_name('select_blog_views')),
		'cust_id' => foodbakery_allow_special_char($this->get_field_id('select_blog_views')),
		'id' => '',
		'options' => array(
		    'classic' => foodbakery_var_theme_text_srt('foodbakery_var_classic'),
		    'fancy' => foodbakery_var_theme_text_srt('foodbakery_var_fancy'),
		),
		'return' => true,
	    ),
	);

	$foodbakery_opt_array = array(
	    'name' => foodbakery_var_theme_text_srt('foodbakery_var_num_post'),
	    'desc' => '',
	    'hint_text' => '',
	    'echo' => true,
	    'field_params' => array(
		'std' => esc_attr($showcount),
		'id' => foodbakery_allow_special_char($this->get_field_id('showcount')),
		'classes' => '',
		'cust_id' => foodbakery_allow_special_char($this->get_field_name('showcount')),
		'cust_name' => foodbakery_allow_special_char($this->get_field_name('showcount')),
		'return' => true,
		'required' => false
	    ),
	);
	$foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
	$foodbakery_inline_script = 'jQuery(document).ready(function ($) {
				chosen_selectionbox();
			});';
	foodbakery_admin_inline_enqueue_script($foodbakery_inline_script, 'foodbakery-custom-functions');
    }

    /**
     * @Recent posts update form data
     *
     *
     */
    function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['title'] = $new_instance['title'];
	$instance['select_category'] = $new_instance['select_category'];
	$instance['select_blog_views'] = $new_instance['select_blog_views'];
	$instance['showcount'] = $new_instance['showcount'];
	return $instance;
    }

    /**
     * @Display Recent posts widget
     *
     */
    function widget($args, $instance) {
	global $foodbakery_node, $wpdb, $post, $foodbakery_var_static_text;
	extract($args, EXTR_SKIP);
	$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
	$title = wp_specialchars_decode(stripslashes($title));
	$select_category = empty($instance['select_category']) ? '' : apply_filters('widget_title', $instance['select_category']);
	$select_blog_views = empty($instance['select_blog_views']) ? '' : apply_filters('widget_title', $instance['select_blog_views']);
	$showcount = empty($instance['showcount']) ? ' ' : apply_filters('widget_title', $instance['showcount']);
	if ($instance['showcount'] == "") {
	    $instance['showcount'] = '-1';
	}
	echo '<div class="widget widget-related-post">';

	$blog_style_class = 'fancy';
	if ($select_blog_views == 'fancy') {
	    $blog_style_class = 'fancy';
	} else {
	    $blog_style_class = 'classic';
	}
	?>
	<div class="widget widget-recent-blog-post">
	    <?php
	    if (!empty($title) && $title <> ' ') {
		echo '<div class="widget-title">';
		echo '<h5>' . foodbakery_allow_special_char($title) . '</h5>';
		echo '</div>';
	    }


	    if (isset($select_category) && $select_category <> '') {
		$args = array('posts_per_page' => $showcount, 'post_type' => 'post', 'category_name' => $select_category);
	    } else {
		$args = array('posts_per_page' => $showcount, 'post_type' => 'post');
	    }
	    $title_limit = 4;
	    $custom_query2 = new WP_Query($args);

	    if ($custom_query2->have_posts() <> "") {
		echo '<ul>';
		while ($custom_query2->have_posts()) : $custom_query2->the_post();
		    ?>
		    <li>
			<?php if (has_post_thumbnail()) { ?>
		    	<div class="img-holder">
		    	    <figure>
		    		<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail('thumbnail'); ?> </a>
		    	    </figure>
		    	</div>
			<?php } ?>

			<div class="text-holder">
			    <?php if (get_the_title() != '') { ?>
		    	    <div class="post-title">
		    		<h6><a href="<?php the_permalink(); ?>"><?php echo esc_html( foodbakery_get_post_excerpt( get_the_title(), '8' ) ); ?></a></h6>
		    	    </div>
			    <?php } ?>
			    <div class="post-options">
				<span><i class=" icon-clock4"></i><?php echo get_the_date(' F j, Y'); ?></span>
			    </div>
			</div>
		    </li>
		    <?php
		endwhile;
		wp_reset_postdata();
		echo '</ul>';
	    } else {
		echo '<p>' . esc_html(foodbakery_var_theme_text_srt('foodbakery_var_noresult_found')) . '</p>';
	    }
	    ?>
	</div>
	<?php
	echo '</div>';
    }

}
if (function_exists('cs_widget_register')) {
    cs_widget_register("Foodbakery_recentposts");
}
