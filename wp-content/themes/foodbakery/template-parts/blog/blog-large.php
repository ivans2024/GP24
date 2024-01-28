<?php
/**
 * @ Start front end Blog list view 
 *
 *
 */
global $foodbakery_var_static_text, $post;
$foodbakery_blog_vars = array('col_class', 'args', 'post', 'foodbakery_blog_cats', 'foodbakery_blog_description', 'foodbakery_blog_excerpt', 'foodbakery_blog_posts_title_length_var', 'foodbakery_blog_num_post', 'foodbakery_notification', 'wp_query', 'foodbakery_blog_element_title', 'foodbakery_blog_filterable', 'foodbakery_blog_orderby', 'orderby');
$foodbakery_blog_vars = FOODBAKERY_VAR_GLOBALS()->globalizing($foodbakery_blog_vars);
extract($foodbakery_blog_vars);
$post_id = $post->ID;
extract($wp_query->query_vars);
$foodbakery_blog_filterable;
$foodbakery_blog_element_title = isset($foodbakery_blog_element_title) ? $foodbakery_blog_element_title : '';
?>
<div class="blog blog-large">
    <div class="row">
	<?php
	$author_id = $post->post_author;
	$wpb_all_query = new WP_Query($args);
	if ($wpb_all_query->have_posts()) {
	    while ($wpb_all_query->have_posts()) {
		$wpb_all_query->the_post();
		$category_ids = get_the_category(get_the_id());
		$cat_id = isset($category_ids[0]->term_id) ? $category_ids[0]->term_id : '';
		$cat_name = isset($category_ids[0]->name) ? $category_ids[0]->name : '';
		if ($cat_id != '') {
		    $cat_icon = get_term_meta($cat_id, 'cat_meta_data', true);
		}
		$cat_icon = isset($cat_icon['cat_icon']) ? $cat_icon['cat_icon'] : '';
		$loop_start_tag = true;
		$post_style = get_post_meta(get_the_id(), 'foodbakery_var_post_style', true);
		$gallery_images = get_post_meta(get_the_id(), 'foodbakery_var_post_detail_page_gallery', true);
		$post_date = get_the_time('d/m/y h:m A');
		$archive_year = get_the_time('Y');
		$archive_month = get_the_time('m');
		$archive_day = get_the_time('d');
		$post_cats = '';
		if (function_exists('foodbakery_get_post_categories')) {
		    $post_cats = foodbakery_get_post_categories(get_the_id());
		}
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
						    $foodbakery_var_src = wp_get_attachment_image_src($gallery_image_id, 'foodbakery_media_1');
						    $image_alt = get_post_meta($gallery_image_id, '_wp_attachment_image_alt', true);
						    echo '<figure class="swiper-slide">
													<a href="javascript:void(0)"><img src="' . esc_url($foodbakery_var_src[0]) . '" alt="foodbakery_var_src"></a></figure>';
						}
					    }
					    ?>
					</div>
					<div class="swiper-pagination"></div>
				    </div>
				    <div class="swiper-button-next"><i class="icon-arrow_forward"></i></div>
				    <div class="swiper-button-prev"> <i class="icon-arrow_back"></i></div>
				</div>

				<?php
			    }
			} else {
			    if (has_post_thumbnail()) {
				?>
				<div class="img-holder">
				    <figure>
					<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_post_thumbnail('foodbakery_media_1'); ?></a>
				    </figure>
				</div>
				<?php
			    }
			}
			?>
			<?php if ($foodbakery_blog_description == 'yes') { ?>
	    		<div class="text-holder">
	    		    <div class="post-title">
	    			<h3><a href="<?php the_permalink(); ?>"><?php echo esc_html(foodbakery_get_post_excerpt(get_the_title(), $foodbakery_blog_posts_title_length_var)); ?></a></h3>
	    		    </div>
	    		    <ul class="social-media">
				    <?php echo foodbakery_social_share_blog(); ?>
	    		    </ul>	
	    		    <div class="author-info">
				    <?php
				    $auth = get_post($post_id);
				    $author_name = get_the_author();
				    $authid = $auth->post_author;
				    if ($author_name == '') {
					$author_data = get_userdata($authid);
					$author_name = $author_data->user_login;
				    }
				    ?>
	    			<p><?php echo esc_html('Posted by', 'foodbakery'); ?><a href="<?php echo get_author_posts_url($authid); ?>"><?php echo esc_html($author_name); ?></a> <?php echo esc_html__('on', 'foodbakery'); ?> <a class="date-archive-link" href="<?php echo get_month_link($archive_year, $archive_month); ?>"><?php echo esc_html($post_date); ?></a> <?php echo foodbakery_allow_special_char($post_cats); ?> </p>
	    		    </div>
	    		    <p><?php echo esc_html(foodbakery_get_excerpt($foodbakery_blog_excerpt, '', '')); ?></p>
	    		    <a href="<?php the_permalink(); ?>" class="read-more text-color text-color"><?php echo esc_html('Read Article', 'foodbakery'); ?></a>
			    <?php } ?>

			</div>
		    </div>
		</div>
		<?php
	    }
	}
	?>
    </div>
</div>
