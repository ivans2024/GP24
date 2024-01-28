<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage Foodbakery
 * @since Auto Mobile 1.0
 */
get_header();

$var_arrays = array('post', 'foodbakery_var_static_text');
$archive_global_vars = FOODBAKERY_VAR_GLOBALS()->globalizing($var_arrays);
extract($archive_global_vars);
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

if (!isset($_GET['page_id_all']))
    $_GET['page_id_all'] = 1;
?>   

<div class="main-section <?php esc_attr($page_margin_class); ?>">
    <div class="page-section">
        <div class="container">
            <div class="row">
		<?php if ($foodbakery_layout == 'sidebar_left') { ?>
    		<div class="page-sidebar col-lg-4 col-md-4 col-sm-12 col-xs-12">
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
		    <?php
		    if (is_author()) {
			$var_arrays = array('author');
			$archive_global_vars = FOODBAKERY_VAR_GLOBALS()->globalizing($var_arrays);
			extract($archive_global_vars);
			$userdata = get_userdata($author);
		    }
		    if (category_description() || is_tag() || (is_author() && isset($userdata->description) && !empty($userdata->description))) {
			echo '<div class="widget evorgnizer">';
			if (is_author()) {
			    ?>
			    <figure>
				<a>
				    <?php
				    echo get_avatar($userdata->user_email, apply_filters('foodbakery_author_bio_avatar_size', 70));
				    ?>
				</a>
			    </figure>
			    <div class="left-sp">
				<h5><a><?php echo esc_html($userdata->display_name); ?></a></h5>
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
				<?php
			    }
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
			echo '</div>';
		    }
		    if (have_posts()) {
			?>
    		    <div class = "blog blog-medium">
    			<div class = "row">
				<?php
				while (have_posts()) : the_post();
				    global $post;
				    $post_id = $post->ID;
				    $author_id = $post->post_author;
				    $cat_name = '';
				    $cat_id = '';
				    $cat = get_the_category($post_id);
				    if (is_array($cat)) {
					foreach ($cat as $cats) {
					    $cat_name = $cats->name;
					    $cat_id = $cats->cat_ID;
					}
				    }
				    $category_link = get_category_link($cat_id);
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
									$foodbakery_var_src = wp_get_attachment_image_src($gallery_image_id, 'foodbakery_media_5');
									$image_alt = get_post_meta($gallery_image_id, '_wp_attachment_image_alt', true);
									echo '<figure class="swiper-slide">
                                                                                    <a href="javascript:void(0)"><img src="' . esc_url($foodbakery_var_src[0]) . '"></a>
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
							    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('foodbakery_media_5'); ?></a>
							</figure>
						    </div>
						    <?php
						}
					    }
					    ?>
					    <div class="text-holder">
						<?php if (get_the_title() != '') { ?>
	    					<div class="post-title">
	    					    <h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							    <?php
							    if (is_sticky($post_id)) {
								echo '<span class="list-feature-item">' .esc_html__(' Featured', 'foodbakery').'</span>';
							    }
							    ?> 
	    					    </h4>
	    					</div>
						<?php } ?>
						<ul class="post-options">

						    <li> 
							<?php if ($category_link != '') { ?>
	    						<a href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($cat_name); ?></a>
							<?php } ?>
							<span><a href="<?php echo esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))); ?>"><?php echo get_the_date(' F j, Y'); ?> </a></span</li>
						</ul>
						<?php if (get_the_excerpt() != '') { ?>
	    					<p> <?php echo wp_trim_words(get_the_excerpt(), $default_excerpt_length); ?></p>
						<?php } ?>
						<a href="<?php the_permalink(); ?>" class="read-more text-color"><?php _e('Learn more', 'foodbakery'); ?><i class="icon-arrow-right22"></i></a>
					    </div>
					</div>
				    </div>
				    <?php
				endwhile;
				?>
    			</div>
    		    </div>
			<?php
		    } else {
			get_template_part('template-parts/content-none');
		    }

		    if (function_exists('foodbakery_default_pagination')) {
			echo foodbakery_default_pagination();
		    }
		    ?>
                </div>
		<?php
		if (isset($foodbakery_layout) and $foodbakery_layout == 'sidebar_right') {
		    if (is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_sidebar))) {
			echo '<div class="page-sidebar right col-lg-4 col-md-4 col-sm-12 col-xs-12">';
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