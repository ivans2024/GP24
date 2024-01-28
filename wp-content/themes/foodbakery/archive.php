<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 */
get_header();

$var_arrays = array('post', 'foodbakery_var_static_text');
$search_global_vars = FOODBAKERY_VAR_GLOBALS()->globalizing($var_arrays);
extract($search_global_vars);
$paging_var = 'paged_id';
if (!isset($_GET[$paging_var])) {
    $_GET[$paging_var] = '';
}
$var_arrays = array('post');
$foodbakery_var_options = FOODBAKERY_VAR_GLOBALS()->theme_options();

if (isset($foodbakery_var_options['foodbakery_var_excerpt_length']) && $foodbakery_var_options['foodbakery_var_excerpt_length'] <> '') {
    $default_excerpt_length = $foodbakery_var_options['foodbakery_var_excerpt_length'];
} else {
    $default_excerpt_length = '60';
}
$foodbakery_layout = isset($foodbakery_var_options['foodbakery_var_default_page_layout']) ? $foodbakery_var_options['foodbakery_var_default_page_layout'] : '';

if (isset($foodbakery_layout) && ($foodbakery_layout == "sidebar_left" || $foodbakery_layout == "sidebar_right")) {
    $foodbakery_col_class = "page-content col-lg-8 col-md-8 col-sm-12 col-xs-12";
} else {
    $foodbakery_col_class = "page-content-fullwidth col-lg-12 col-md-12 col-sm-12 col-xs-12";
}
if (!get_option('foodbakery_var_options') && is_active_sidebar('sidebar-1')) {
    $foodbakery_col_class = "page-content col-lg-8 col-md-8 col-sm-12 col-xs-12";
    $foodbakery_def_sidebar = 'sidebar-1';
}
$page_margin_class = 'page-margin';
$foodbakery_sidebar = isset($foodbakery_var_options['foodbakery_var_default_layout_sidebar']) ? $foodbakery_var_options['foodbakery_var_default_layout_sidebar'] : '';
$foodbakery_var_page_margin = isset($foodbakery_var_options['foodbakery_var_page_margin']) ? $foodbakery_var_options['foodbakery_var_page_margin'] : '';
if ($foodbakery_var_page_margin == 'on') {
    $page_margin_class = 'page-margin';
}
$foodbakery_tags_name = 'post_tag';
$foodbakery_categories_name = 'category';
$width = '350';
$height = '210';
?>   
<div class="main-section <?php esc_attr($page_margin_class); ?>">
    <div class="page-section">
        <div class="container">
            <div class="row">
		<?php if ($foodbakery_layout == 'sidebar_left') { ?>
    		<div class="page-sidebar left col-lg-4 col-md-4 col-sm-12 col-xs-12">
    		    <div class="widget-holder">
			    <?php
			    if (is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_sidebar))) {
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($foodbakery_sidebar)) : endif;
			    }
			    ?>
    		    </div>
    		</div>
		<?php } ?>
                <div class= "<?php echo esc_html($foodbakery_col_class); ?>">
                    <div class="row">
			<?php
			if (is_author()) {
			    $var_arrays = array('author');
			    $archive_global_vars = FOODBAKERY_VAR_GLOBALS()->globalizing($var_arrays);
			    extract($archive_global_vars);
			    $userdata = get_userdata($author);
			    $author_meta = get_user_meta($userdata->ID);
			    $author_email = $userdata->user_email;
			    $author_roles = $userdata->roles;
			    $display_name = '';
			    foreach ($userdata as $key => $value) {
				if (isset($value->display_name)) {
				    $display_name = $value->display_name;
				}
			    }
			    $author_first_name = $author_meta['first_name'][0];
			    $author_last_name = $author_meta['last_name'][0];
			    $author_complete_name = $author_first_name . ' ' . $author_last_name;
			    $author_descreption = $author_meta['description'][0];
			    $author_avatar = get_avatar($author_email, apply_filters('foodbakery_author_bio_avatar_size', 80));
			    ?>
    			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    			    <div class="author-list-holder">
    				<div class="img-holder">
    				    <figure><?php echo foodbakery_allow_special_char($author_avatar); ?></figure>
    				</div>
    				<div class="text-holder">
    				    <p><?php echo esc_html($author_complete_name); ?>
					    <?php if (isset($display_name) && $display_name != '') { ?>
						<span class="name text-color"><?php echo esc_html($display_name); ?></span>
						<?php
					    }
					    echo esc_html($author_roles[0]);
					    ?></p>
    				    <p><?php echo esc_html($author_descreption); ?></p>
    				</div>
    			    </div>

    			    <div class="element-title">
    				<h2><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_latest_stories')); ?></h2>
    			    </div>

    			</div>
			    <?php
			}
			if (category_description() || is_tag()) {
			    if (is_author()) {
				?>
				<figure>
				    <a>
					<?php
					echo get_avatar($userdata->user_email, apply_filters('foodbakery_author_bio_avatar_size', 80));
					?>
				    </a>
				</figure>
				<div class="left-sp">
				    <?php
				    $auth = get_post($post_id);
				    $author_name = get_the_author();
				    $authid = $auth->post_author;
				    if ($author_name == '') {
					$author_data = get_userdata($authid);
					$author_name = $author_data->user_login;
				    }
				    ?>
				    <h5><a href="<?php echo get_author_posts_url($authid); ?> "><?php echo esc_html($author_name); ?></a></h5>
				    <p><?php echo foodbakery_allow_special_char($userdata->description, true); ?></p>
				</div>
				<?php
			    } elseif (is_category()) {
				$category_description = category_description();
				if (!empty($category_description)) {
				    ?>
	    			<div class="left-sp">
	    			    <p><?php echo category_description(); ?></p>
	    			</div>
				<?php } ?>
				<?php
			    } elseif (is_tag()) {
				$tag_description = tag_description();
				if (!empty($tag_description)) {
				    ?>
	    			<div class="left-sp">
	    			    <p><?php echo apply_filters('tag_archive_meta', $tag_description); ?></p>
	    			</div>
				    <?php
				}
			    }
			}
			if (empty($_GET['page_id_all'])) {
			    $_GET['page_id_all'] = 1;
			}
			if (!isset($_GET["s"])) {
			    $_GET["s"] = '';
			}
			$description = 'yes';
			$taxonomy = 'category';
			$taxonomy_tag = 'post_tag';
			$args_cat = array();
			if (is_author()) {
			    $args_cat = array('author' => $wp_query->query_vars['author']);

			    $post_type = array('post');
			} elseif (is_date()) {

			    if (is_month() || is_year() || is_day() || is_time()) {
				$cs_month = $wp_query->query_vars['monthnum'];
				$cs_year = $wp_query->query_vars['year'];
				$cs_month = $cs_month;
				$args_cat = array('monthnum' => $cs_month, 'year' => $wp_query->query_vars['year'], 'day' => $wp_query->query_vars['day'], 'hour' => $wp_query->query_vars['hour'], 'minute' => $wp_query->query_vars['minute'], 'second' => $wp_query->query_vars['second']);
			    }
			} else if ((isset($wp_query->query_vars['taxonomy']) && !empty($wp_query->query_vars['taxonomy']))) {
			    $taxonomy = $wp_query->query_vars['taxonomy'];
			    $taxonomy_category = '';
			    if (isset($wp_query->query_vars[$taxonomy])) {
				$taxonomy_category = $wp_query->query_vars[$taxonomy];
			    }
			    if (isset($wp_query->query_vars['taxonomy']) && $wp_query->query_vars['taxonomy'] == 'service-category') {
				$args_cat = array($taxonomy => "$taxonomy_category");
				$post_type = 'service';
			    } else if (isset($wp_query->query_vars['taxonomy']) && $wp_query->query_vars['taxonomy'] == 'stylist-category') {
				$args_cat = array($taxonomy => "$taxonomy_category");
				$post_type = 'stylist';
			    } else {
				$taxonomy = 'category';
				$args_cat = array();
				$post_type = 'post';
			    }
			} else if (is_category()) {

			    $taxonomy = 'category';
			    $args_cat = array();
			    $category_blog = '';
			    if (isset($wp_query->query_vars['cat'])) {
				$category_blog = $wp_query->query_vars['cat'];
			    }
			    $post_type = 'post';
			    $args_cat = array('cat' => "$category_blog");
			} else if (is_tag()) {

			    $taxonomy = 'category';
			    $args_cat = array();
			    $tag_blog = '';
			    if (isset($wp_query->query_vars['tag'])) {
				$tag_blog = $wp_query->query_vars['tag'];
			    }
			    $post_type = 'post';
			    $args_cat = array('tag' => "$tag_blog");
			} else {

			    $taxonomy = 'category';
			    $args_cat = array();
			    $post_type = 'post';
			}
			$args = array(
			    'post_type' => $post_type,
			    'paged' => $_GET[$paging_var],
			    'post_status' => 'publish',
			    'order' => 'DESC',
			);

			$args = array_merge($args_cat, $args);

			$custom_query = new WP_Query($args);
			if (have_posts()) :

			    if (empty($_GET['page_id_all'])) {
				$_GET['page_id_all'] = 1;
			    }
			    if (!isset($_GET["s"])) {
				$_GET["s"] = '';
			    }
			    ?>
    			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    			    <div class = "blog blog-medium">
    				<div class = "row">
					<?php
					while ($custom_query->have_posts()) : $custom_query->the_post();
					    global $post;
					    $post_id = $post->ID;
					    $author_id = $post->post_author;
					    $cat = get_the_category($post_id);
					    $cat_name = $cat[0]->name;
					    $cat_id = $cat[0]->cat_ID;
					    $category_link = get_category_link($cat_id);
					    $cat_meta = get_term_meta($cat_id, 'cat_meta_data', true);
					    $cat_icon = isset($cat_meta['cat_icon']) ? $cat_meta['cat_icon'] : '';
					    $post_style = get_post_meta($post_id, 'foodbakery_var_post_style', true);
					    $gallery_images = get_post_meta($post->ID, 'foodbakery_var_post_detail_page_gallery', true);
					    ?>
					    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="blog-post">
						    <?php
						    if (isset($post_style) && $post_style == 'slider') {
							if (is_array($gallery_images) && array_filter($gallery_images)) {
							    ?>
							    <div class="img-holder">
								<div class="swiper-container">
								    <div class="swiper-wrapper">
									<?php
									foreach ($gallery_images as $key => $gallery_image_id) {
									    if ('' != $gallery_image_id) {
										$foodbakery_var_src = wp_get_attachment_image_src($gallery_image_id, 'foodbakery_media_2');
										$image_alt = get_post_meta($gallery_image_id, '_wp_attachment_image_alt', true);
										echo '<figure class="swiper-slide"><a href="javascript:void(0)"><img src="' . esc_url($foodbakery_var_src[0]) . '"></a></figure>';
									    }
									}
									?>
								    </div>
								    <div class="swiper-pagination"></div>
								    <div class="swiper-button-next"><i class="icon-arrow_forward"></i></div>
								    <div class="swiper-button-prev"> <i class="icon-arrow_back"></i></div>
								</div>
							    </div>
							    <?php
							}
						    } else {
							if (has_post_thumbnail()) {
							    ?>
							    <div class="img-holder">
								<figure>
								    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('foodbakery_media_2'); ?></a>
								</figure>
							    </div>
							    <?php
							}
						    }
						    ?>
						    <div class="text-holder">
							<?php if (get_the_title() != '') { ?>
	    						<div class="post-title">
	    						    <h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo get_the_title(); ?></a>
								    <?php
								    if (is_sticky($post_id)) {
									echo '<span class="list-feature-item">' .esc_html__(' Featured', 'foodbakery').'</span>';
								    }
								    ?> 
	    						    </h4>

	    						</div>
							<?php } ?>
							<ul class="post-options">
							    <li> <a href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($cat_name); ?></a><span><a href="<?php echo esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))); ?>"><?php echo get_the_date(' F j, Y'); ?> </a></span</li>
							</ul>
							<?php if (get_the_excerpt() != '') { ?>
	    						<p> <?php echo wp_trim_words(get_the_excerpt(), $default_excerpt_length); ?></p>
							<?php } ?>
							<a href="<?php the_permalink(); ?>" class="read-more text-color"><?php esc_html_e('Learn more', 'foodbakery'); ?><i class="icon-arrow-right22"></i></a>
						    </div>
						</div>
					    </div>
					    <?php
					endwhile;
					wp_reset_postdata();
					?>
    				</div>
    			    </div>
    			</div>
			    <?php
			else:
			    if (function_exists('foodbakery_no_result_found')) {
				foodbakery_no_result_found();
			    }
			endif;
			?>
			<?php
			$qrystr = '';
			if (isset($_GET['page_id'])) {
			    $qrystr .= "&amp;page_id=" . $_GET['page_id'];
			}
			if (isset($_GET['specialisms'])) {
			    $qrystr .= "&specialisms=" . $_GET['specialisms'];
			}
			if (isset($_GET['page_id'])) {
			    $qrystr .= "&amp;page_id=" . $_GET['page_id'];
			}

			$args_count = array(
			    'posts_per_page' => "-1",
			    'post_type' => 'post',
			    'post_status' => 'publish',
			    'fields' => 'ids', // only load ids
			);

			$listing_loop_count = new WP_Query($args_count);
			$total_post = $custom_query->found_posts;
			$paging_args = array(
			    'total_posts' => $total_post,
			    'posts_per_page' => get_option('posts_per_page'),
			    'paging_var' => $paging_var,
			    'show_pagination' => 'yes',
			);
			if (get_option('posts_per_page') < $total_post) {
			    do_action('foodbakery_pagination', $paging_args);
			}
			?>	
                    </div>
                </div>
		<?php
		if (isset($foodbakery_layout) and $foodbakery_layout == 'sidebar_right') {
		    if (is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_sidebar))) {
			echo '<div class="page-sidebar right col-md-4 col-lg-4 col-sm-12 col-xs-12">';
			echo '<div class="widget-holder">';
			if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($foodbakery_sidebar)) : endif;
			echo '</div>';
			echo '</div>';
		    }
		}
		if (!is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_sidebar)) && is_active_sidebar('sidebar-1')) {
		    echo '<div class="page-sidebar col-lg-4 col-md-4 col-sm-12 col-xs-12">';
		    echo '<div class="widget-holder">';
		    if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-1')) : endif;
		    echo '</div>';
		    echo '</div>';
		}
		?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>