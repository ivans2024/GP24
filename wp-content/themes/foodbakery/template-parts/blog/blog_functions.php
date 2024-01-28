<?php

/**
 * @  Blog html form for page builder Frontend side
 *
 *
 */
if ( ! function_exists('foodbakery_blog_shortcode') ) {

	function foodbakery_blog_shortcode($atts) {
		global $foodbakery_blog_size, $post, $col_class, $foodbakery_blog_element_title, $wpdb, $blog_pagination, $foodbakery_blog_num_post, $foodbakery_counter_node, $foodbakery_column_atts, $foodbakery_blog_cats, $foodbakery_blog_description, $foodbakery_blog_excerpt, $foodbakery_blog_posts_title_length_var, $post_thumb_view, $foodbakery_blog_section_title, $foodbakery_exclude_post_id, $args, $foodbakery_blog_orderby, $orderby;
		$paging_var = 'paged_id';
		if ( ! isset($_GET[$paging_var]) ) {
			$_GET[$paging_var] = '';
		}
		$defaults = array(
			'foodbakery_blog_element_title' => '',
			'foodbakery_blog_view' => '',
			'foodbakery_exclude_post_id' => '0',
			'foodbakery_blog_cat' => '',
			'foodbakery_blog_orderby' => 'DESC',
			'orderby' => 'ID',
			'foodbakery_blog_order_by' => 'ID', // This is used for ratings sorting
			'foodbakery_blog_order_by_dir' => 'DESC', // This is used for ratings sorting
			'foodbakery_blog_description' => 'yes',
			'foodbakery_blog_excerpt' => '255',
			'foodbakery_blog_posts_title_length' => '',
			'foodbakery_blog_num_post' => '10',
			'blog_pagination' => '',
			'foodbakery_blog_class' => '',
			'foodbakery_blog_size' => ''
		);

		extract(shortcode_atts($defaults, $atts));
		$foodbakery_blog_posts_title_length_var = '';
		if ( ! is_numeric($foodbakery_blog_posts_title_length) || $foodbakery_blog_posts_title_length == '' ) {
			$foodbakery_blog_posts_title_length_var = '4';
		} else {
			$foodbakery_blog_posts_title_length_var = $foodbakery_blog_posts_title_length;
		}

		$buildere_data = get_post_meta(get_the_ID(), 'foodbakery_page_builder', true);


		$foodbakery_blog_cats = $foodbakery_blog_cat;
		static $foodbakery_var_custom_counter;
		if ( ! isset($foodbakery_var_custom_counter) ) {
			$foodbakery_var_custom_counter = 1;
		} else {
			$foodbakery_var_custom_counter ++;
		}
		$foodbakery_var_page = isset($_GET['post_paging_' . $foodbakery_var_custom_counter]) ? $_GET['post_paging_' . $foodbakery_var_custom_counter] : '1';
		if ( isset($foodbakery_blog_size) && $foodbakery_blog_size != '' ) {
			$number_col = 12 / $foodbakery_blog_size;
			$number_col_sm = 12;
			$number_col_xs = 12;
			if ( $number_col == 2 ) {
				$number_col_sm = 4;
				$number_col_xs = 6;
			}
			if ( $number_col == 3 ) {
				$number_col_sm = 6;
				$number_col_xs = 12;
			}
			if ( $number_col == 4 ) {
				$number_col_sm = 6;
				$number_col_xs = 12;
			}
			if ( $number_col == 6 ) {
				$number_col_sm = 12;
				$number_col_xs = 12;
			}
			$col_class = 'col-lg-' . $number_col . ' col-md-' . $number_col . ' col-sm-' . $number_col_sm . ' col-xs-' . $number_col_xs . '';
		}
		$foodbakery_dataObject = get_post_meta($post->ID, 'foodbakery_full_data');
		$foodbakery_sidebarLayout = '';
		$section_foodbakery_layout = '';
		$pageSidebar = false;
		$box_col_class = 'col-md-3';
		if ( isset($foodbakery_dataObject['foodbakery_page_layout']) ) {
			$foodbakery_sidebarLayout = $foodbakery_dataObject['foodbakery_page_layout'];
		}

		if ( isset($foodbakery_column_atts->foodbakery_layout) ) {
			$section_foodbakery_layout = $foodbakery_column_atts->foodbakery_layout;
			if ( $section_foodbakery_layout == 'left' || $section_foodbakery_layout == 'right' ) {
				$pageSidebar = true;
			}
		}
		if ( $foodbakery_sidebarLayout == 'left' || $foodbakery_sidebarLayout == 'right' ) {
			$pageSidebar = true;
		}
		if ( $pageSidebar == true ) {
			$box_col_class = 'col-md-4';
		}
		if ( (isset($foodbakery_dataObject['foodbakery_page_layout']) && $foodbakery_dataObject['foodbakery_page_layout'] <> '' and $foodbakery_dataObject['foodbakery_page_layout'] <> "none") || $pageSidebar == true ) {
			$foodbakery_blog_grid_layout = 'col-md-4';
		} else {
			$foodbakery_blog_grid_layout = 'col-md-3';
		}
		$CustomId = '';
		if ( isset($foodbakery_blog_class) && $foodbakery_blog_class ) {
			$CustomId = 'id="' . $foodbakery_blog_class . '"';
		}
		$owlcount = rand(40, 9999999);
		$foodbakery_counter_node ++;
		ob_start();
		$filter_category = '';
		$filter_tag = '';
		$author_filter = '';
		if ( isset($_GET['filter_category']) && $_GET['filter_category'] <> '' && $_GET['filter_category'] <> '0' ) {
			$filter_category = $_GET['filter_category'];
		}
		if ( isset($_GET['sort']) and $_GET['sort'] == 'asc' ) {
			$foodbakery_blog_orderby = 'ASC';
		} else {
			$foodbakery_blog_orderby = $foodbakery_blog_orderby;
		}
		if ( isset($_GET['sort']) and $_GET['sort'] == 'alphabetical' ) {
			$orderby = 'title';
			$foodbakery_blog_orderby = 'ASC';
		} else if ( isset($foodbakery_blog_order_by) ) {
			$orderby = $foodbakery_blog_order_by;
			$foodbakery_blog_orderby = $foodbakery_blog_order_by_dir;
		} elseif ( isset($_GET['catform']) && isset($_GET['sort_option']) ) {
			if ( ! empty($_GET['sort_option']) || $_GET['sort_option'] != '0' ) {
				$orderby = $_GET['sort_option'];
			}
		} else {
			$orderby = 'meta_value';
		}


		if ( empty($_GET['page_id_all']) ) {
			$_GET['page_id_all'] = 1;
		}
		$foodbakery_blog_num_post = $foodbakery_blog_num_post ? $foodbakery_blog_num_post : '-1';
		if ( $foodbakery_exclude_post_id == 0 && $foodbakery_exclude_post_id == '' ) {
			$args = array( 'posts_per_page' => "-1", 'post_type' => 'post', 'order' => $foodbakery_blog_orderby, 'orderby' => $orderby, 'post_status' => 'publish', 'ignore_sticky_posts' => 1 );
		} else {
			$args = array( 'posts_per_page' => "-1", 'post__not_in' => array( $foodbakery_exclude_post_id ), 'post_type' => 'post', 'order' => $foodbakery_blog_orderby, 'orderby' => $orderby, 'post_status' => 'publish', 'ignore_sticky_posts' => 1 );
		}
		if ( isset($foodbakery_blog_cat) && $foodbakery_blog_cat <> '' && $foodbakery_blog_cat <> '0' ) {
			$blog_category_array = array( 'category_name' => "$foodbakery_blog_cat" );
			$args = array_merge($args, $blog_category_array);
		}
		if ( isset($filter_category) && $filter_category <> '' && $filter_category <> '0' ) {
			if ( isset($_GET['filter-tag']) ) {
				$filter_tag = $_GET['filter-tag'];
			}
			if ( $filter_tag <> '' ) {
				$blog_category_array = array( 'category_name' => "$filter_category", 'tag' => "$filter_tag" );
			} else {
				$blog_category_array = array( 'category_name' => "$filter_category" );
			}
			$args = array_merge($args, $blog_category_array);
		}
		if ( isset($_GET['filter-tag']) && $_GET['filter-tag'] <> '' && $_GET['filter-tag'] <> '0' ) {
			$filter_tag = $_GET['filter-tag'];
			if ( $filter_tag <> '' ) {
				$course_category_array = array( 'category_name' => "$filter_category", 'tag' => "$filter_tag" );
				$args = array_merge($args, $course_category_array);
			}
		}
		if ( isset($_GET['by_author']) && $_GET['by_author'] <> '' && $_GET['by_author'] <> '0' ) {
			$author_filter = $_GET['by_author'];
			if ( $author_filter <> '' ) {
				$authorArray = array( 'author' => "$author_filter" );
				$args = array_merge($args, $authorArray);
			}
		}
		if ( isset($_GET['catform']) ) {
			if ( isset($_GET['category']) && ! empty($_GET['category']) ) {
				$cats = $_GET['category'];
				$args['tax_query'] = array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'category',
						'field' => 'slug',
						'terms' => $cats
					),
				);
			}
		}
		$query = new WP_Query($args);
		$count_post = $query->post_count;
		wp_reset_postdata();
		$foodbakery_blog_num_post = $foodbakery_blog_num_post ? $foodbakery_blog_num_post : '-1';
		if ( $foodbakery_exclude_post_id == 0 && $foodbakery_exclude_post_id == '' ) {
			$args = array( 'posts_per_page' => "$foodbakery_blog_num_post", 'post_type' => 'post', 'paged' => $_GET[$paging_var], 'order' => $foodbakery_blog_orderby, 'orderby' => $orderby, 'post_status' => 'publish', 'ignore_sticky_posts' => 1 );
		} else {
			$args = array( 'posts_per_page' => "$foodbakery_blog_num_post", 'post__not_in' => array( $foodbakery_exclude_post_id ), 'post_type' => 'post', 'paged' => $_GET[$paging_var], 'order' => $foodbakery_blog_orderby, 'orderby' => $orderby, 'post_status' => 'publish', 'ignore_sticky_posts' => 1 );
		}
		if ( isset($foodbakery_blog_cat) && $foodbakery_blog_cat <> '' && $foodbakery_blog_cat <> '0' ) {

			$blog_category_array = array( 'category_name' => "$foodbakery_blog_cat" );
			$args = array_merge($args, $blog_category_array);
		}
		if ( isset($filter_category) && $filter_category <> '' && $filter_category <> '0' ) {
			if ( isset($_GET['filter-tag']) ) {
				$filter_tag = $_GET['filter-tag'];
			}
			if ( $filter_tag <> '' ) {
				$blog_category_array = array( 'category_name' => "$filter_category", 'tag' => "$filter_tag" );
			} else {
				$blog_category_array = array( 'category_name' => "$filter_category" );
			}
			$args = array_merge($args, $blog_category_array);
		}

		if ( isset($_GET['filter-tag']) && $_GET['filter-tag'] <> '' && $_GET['filter-tag'] <> '0' ) {
			$filter_tag = $_GET['filter-tag'];
			if ( $filter_tag <> '' ) {
				$course_category_array = array( 'category_name' => "$filter_category", 'tag' => "$filter_tag" );
				$args = array_merge($args, $course_category_array);
			}
		}
		if ( isset($_GET['by_author']) && $_GET['by_author'] <> '' && $_GET['by_author'] <> '0' ) {
			$author_filter = $_GET['by_author'];
			if ( $author_filter <> '' ) {
				$authorArray = array( 'author' => "$author_filter" );
				$args = array_merge($args, $authorArray);
			}
		}
		if ( $foodbakery_blog_cat != '' && $foodbakery_blog_cat != '0' ) {

			$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $foodbakery_blog_cat));
		}
		$page_element_size = isset($atts['blog_element_size']) ? $atts['blog_element_size'] : 100;
		if ( function_exists('foodbakery_var_page_builder_element_sizes') ) {
			echo '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
		}
		$section_title = '';

		if ( isset($foodbakery_blog_element_title) && trim($foodbakery_blog_element_title) <> '' && $foodbakery_blog_view !== 'view1' && $foodbakery_blog_view !== 'view18' ) {
			$section_title = '<div class="element-title"><h5>' . esc_html($foodbakery_blog_element_title) . '</h5></div>';
		}

		echo foodbakery_allow_special_char($section_title);

		if ( isset($_GET['catform']) ) {
			if ( isset($_GET['category']) && ! empty($_GET['category']) ) {
				$cats = $_GET['category'];
				$args['tax_query'] = array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'category',
						'field' => 'slug',
						'terms' => $cats
					),
				);
			}
		}

		$args = apply_filters('blog_views_query', $args);

		set_query_var('args', $args);
		if ( $foodbakery_blog_view == 'view1' ) {
			get_template_part('template-parts/blog/blog', 'large');
		} else if ( $foodbakery_blog_view == 'view2' ) {
			get_template_part('template-parts/blog/blog', 'masonry');
		} else if ( $foodbakery_blog_view == 'view3' ) {
			get_template_part('template-parts/blog/blog', 'medium');
		} else if ( $foodbakery_blog_view == 'view4' ) {
			get_template_part('template-parts/blog/blog', 'grid');
		}
		$foodbakery_var_post_counts = $query->post_count;
		$foodbakery_var_page = 'post_paging_' . $foodbakery_var_custom_counter;
		$blog_views_without_paging = array( 'view1', 'view11', 'view12', 'view13', 'view17', 'view19' );
		if ( $blog_pagination == "yes" && $count_post > $foodbakery_blog_num_post && $foodbakery_blog_num_post > 0 ) {
			$total_pages = '';
			$total_pages = ceil($foodbakery_var_post_counts / $foodbakery_blog_num_post);
			$args_count = array(
				'posts_per_page' => "-1",
				'post_type' => 'post',
				'post_status' => 'publish',
				'fields' => 'ids', // only load ids
			);
			$listing_loop_count = new WP_Query($args_count);
			$listing_totnum = $listing_loop_count->found_posts;
			$paging_args = array( 'total_posts' => $foodbakery_var_post_counts,
				'posts_per_page' => $foodbakery_blog_num_post,
				'paging_var' => $paging_var,
				'show_pagination' => 'yes',
			);
			echo '<div class="row">';
			do_action('foodbakery_pagination', $paging_args);
			echo '</div>';
		}
		if ( function_exists('foodbakery_var_page_builder_element_sizes') ) {
			echo '</div>';
		}
		wp_reset_postdata();
		$post_data = ob_get_clean();
		return $post_data;
	}

	if ( function_exists('foodbakery_var_short_code') ) {
		foodbakery_var_short_code('foodbakery_blog', 'foodbakery_blog_shortcode');
	}
}
/**
 * @ cs get categories all post
 *
 *
 */
if ( ! function_exists('foodbakery_get_categories') ) {

	function foodbakery_get_categories($foodbakery_blog_cat) {
		global $post, $wpdb;
		if ( isset($foodbakery_blog_cat) && $foodbakery_blog_cat != '' && $foodbakery_blog_cat != '0' ) {
			$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $foodbakery_blog_cat));
			echo '<a class="cs-color" href="' . esc_url(home_url('/')) . '?cat=' . $row_cat->term_id . '">' . $row_cat->name . '</a>';
		} else {
			$before_cat = "";
			$categories_list = get_the_term_list(get_the_id(), 'category', $before_cat, ' ', '');
			if ( $categories_list ) {
				printf('%1$s', $categories_list);
			}
		}
	}

}

if ( ! function_exists('foodbakery_get_single_category') ) {

	function foodbakery_get_single_category($post_id) {

		$categories_list = get_the_category($post_id);
		if ( isset($categories_list[0]) && is_object($categories_list[0]) ) {
			$cat_id = $categories_list[0]->term_id;
			$cat_name = $categories_list[0]->name;
			$cat_link = get_term_link($cat_id);
			$cat_meta = get_term_meta($cat_id, 'cat_meta_data', true);
			$cat_color = isset($cat_meta['cat_color']) ? $cat_meta['cat_color'] : '';

			$category_color = '';
			if ( $cat_color != '' ) {
				$category_color = ' style="background:' . $cat_color . ';"';
			}

			return '<a href="' . esc_url($cat_link) . '" class="category"' . $category_color . '>' . esc_html($cat_name) . '</a>';
		}
	}

}