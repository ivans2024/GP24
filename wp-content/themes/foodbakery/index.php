<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package foodbakery
 */
get_header();
$var_arrays = array('post', 'current_user', 'foodbakery_user', 'foodbakery_num');
$search_global_vars = FOODBAKERY_VAR_GLOBALS()->globalizing($var_arrays);
extract($search_global_vars);
extract($search_global_vars);
$foodbakery_var_options = FOODBAKERY_VAR_GLOBALS()->theme_options();
$paging_var = 'paged_id';
if (!isset($_GET[$paging_var])) {
    $_GET[$paging_var] = '';
}
if (isset($foodbakery_var_options['foodbakery_var_excerpt_length']) && $foodbakery_var_options['foodbakery_var_excerpt_length'] <> '') {
    $default_excerpt_length = $foodbakery_var_options['foodbakery_var_excerpt_length'];
} else {
    $default_excerpt_length = '60';
}
$foodbakery_layout = isset($foodbakery_var_options['foodbakery_var_default_page_layout']) ? $foodbakery_var_options['foodbakery_var_default_page_layout'] : '';
$foodbakery_default_sidebar = false;
if ($foodbakery_layout == '') {
    $foodbakery_default_sidebar = true;
}
if (isset($foodbakery_layout) && ($foodbakery_layout == "sidebar_left" || $foodbakery_layout == "sidebar_right")) {
    $foodbakery_col_class = "page-content col-lg-8 col-md-8 col-sm-12 col-xs-12";
} else if ($foodbakery_default_sidebar == true) {
    $foodbakery_col_class = "page-content col-lg-8 col-md-8 col-sm-12 col-xs-12";
} else {
    $foodbakery_col_class = "page-content-fullwidth col-lg-12 col-md-12 col-sm-12 col-xs-12";
}
$page_margin_class = 'page-margin';
$strings = new foodbakery_theme_all_strings;
$strings->foodbakery_theme_option_strings();
$foodbakery_sidebar = isset($foodbakery_var_options['foodbakery_var_default_layout_sidebar']) ? $foodbakery_var_options['foodbakery_var_default_layout_sidebar'] : '';
$foodbakery_var_page_margin = isset($foodbakery_var_options['foodbakery_var_page_margin']) ? $foodbakery_var_options['foodbakery_var_page_margin'] : '';
if ($foodbakery_var_page_margin == 'on') {
    $page_margin_class = 'page-margin';
}
?>
<div class="main-section <?php echo esc_attr($page_margin_class); ?>">
    <div class="page-section">
        <div class="container">
            <div class="row"> 
		<?php
		if ($foodbakery_layout == 'sidebar_left') {
		    if (is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_sidebar))) {
			?>
			<aside class="page-sidebar col-lg-4 col-md-4 col-sm-12 col-xs-12">
			    <div class="widget-holder">
				<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($foodbakery_sidebar)) : endif;
				?>
			    </div>
			</aside>
			<?php
		    }
		}
		?>
                <div class="<?php echo esc_html($foodbakery_col_class); ?>">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			    <?php
			    $foodbakery_cat_name = isset($_GET['cat']) ? $_GET['cat'] : '';
			    $foodbakery_post_title = isset($_GET['s']) ? $_GET['s'] : '';
			    $paged = isset($_GET['paged_id']) ? $_GET['paged_id'] : 1;

			    $posts_per_page = get_option('posts_per_page');

			    $args = array('post_type' => 'post',
				'search_title' => $foodbakery_post_title,
				'posts_per_page' => $posts_per_page,
				'paged' => $_GET[$paging_var],
			    );
			    if (isset($foodbakery_cat_name) && $foodbakery_cat_name != "") {
				$args['tax_query'] = array(
				    array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => $foodbakery_cat_name,
				    )
				);
			    }
			    $foodbakery_total = 0;
			    $query = new WP_Query($args);
			    ?>
                            <div class = "blog blog-medium">
                                <div class = "row">
				    <?php
				    if ($query->have_posts()) {
					while ($query->have_posts()) : $query->the_post();
					    global $post;
					    $post_id = $post->ID;
					    $author_id = $post->post_author;
					    $cat = get_the_category($post_id);
					    $cat_name = isset($cat[0]->name) ? $cat[0]->name : '';
					    $cat_id = isset($cat[0]->cat_ID) ? $cat[0]->cat_ID : '';
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
                                            $foodbakery_var_src_0 = '';
                                            if(isset($foodbakery_var_src[0])){
                                                $foodbakery_var_src_0 = isset($foodbakery_var_src[0]);
                                            }
										echo '<figure class="swiper-slide">'
										. '<a href="javascript:void(0)"><img src="' . $foodbakery_var_src_0 . '"></a>
																				</figure>';
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
	    						    <h4>
	    							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
								    <?php
								    if (is_sticky($post_id)) {
									echo '<span class="list-feature-item">' . esc_html__(' Featured', 'foodbakery') . '</span>';
								    }
								    ?> 
	    						    </h4>
	    						</div>
							<?php } ?>
							<ul class="post-options">
							    <li> <a href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($cat_name); ?></a><span><a href="<?php echo esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))); ?>"><?php echo get_the_date(' F j, Y'); ?> </a></span></li>
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
				    } else {
					echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_noresult_found'));
				    }
				    wp_reset_postdata();
				    ?>
                                </div>
                            </div>
                        </div>
			<?php
			$foodbakery_current_page = 1;
			$foodbakery_totalposts = wp_count_posts()->publish;
			if (isset($_GET['paged_id'])) {
			    $foodbakery_current_page = $_GET['paged_id'];
			}
			$posts_per_page = get_option('posts_per_page');
			if (isset($foodbakery_cat_name) && $foodbakery_cat_name != "") {
			    $posts_per_page = $foodbakery_total;
			    $foodbakery_totalposts = $foodbakery_total;
			}
			$foodbakery_pages = ceil($foodbakery_totalposts / $posts_per_page);
			$qrystr = '';
			if (isset($_GET['page_id'])) {
			    $qrystr .= "&amp;page_id=" . $_GET['page_id'];
			}
			$args_count = array(
			    'posts_per_page' => "-1",
			    'post_type' => 'post',
			    'post_status' => 'publish',
			    'fields' => 'ids',
			);

			$listing_loop_count = new WP_Query($args_count);
			$listing_totnum = $listing_loop_count->found_posts;
			$paging_args = array(
			    'total_posts' => $listing_totnum,
			    'posts_per_page' => get_option('posts_per_page'),
			    'paging_var' => $paging_var,
			    'show_pagination' => 'yes',
			);
			if ($posts_per_page < $foodbakery_totalposts) {
			    do_action('foodbakery_pagination', $paging_args);
			}
			?>
                    </div>
                </div>
		<?php
		if (isset($foodbakery_layout) && $foodbakery_layout == 'sidebar_right') {

		    if (is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_sidebar))) {
			?>
			<aside class="page-sidebar col-lg-4 col-md-4 col-sm-12 col-xs-12">
			    <div class="widget-holder"><?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($foodbakery_sidebar)) :
				    ?><?php
				endif;
				?>
			    </div>
			</aside>
			<?php
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
<?php
get_footer();
