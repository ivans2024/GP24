<?php
/**
 * @ Start front end Blog list view 
 *
 *
 */
global $foodbakery_var_static_text;
$foodbakery_blog_vars = array('col_class', 'args', 'post', 'foodbakery_blog_cats', 'foodbakery_blog_description', 'foodbakery_blog_excerpt', 'foodbakery_blog_posts_title_length_var', 'foodbakery_notification', 'wp_query', 'foodbakery_blog_element_title');
$foodbakery_blog_vars = FOODBAKERY_VAR_GLOBALS()->globalizing($foodbakery_blog_vars);
extract($foodbakery_blog_vars);
extract($wp_query->query_vars);
$foodbakery_blog_element_title = isset($foodbakery_blog_element_title) ? $foodbakery_blog_element_title : '';
?>

<div class = "blog blog-medium">
    <div class = "row">
	<?php
	$wpb_all_query = new WP_Query($args);
	if ($wpb_all_query->have_posts()) :
	    $cat = '';
	    while ($wpb_all_query->have_posts()) : $wpb_all_query->the_post();
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
						    $foodbakery_var_src = wp_get_attachment_image_src($gallery_image_id, 'foodbakery_media_2');
						    $image_alt = get_post_meta($gallery_image_id, '_wp_attachment_image_alt', true);
						    echo '<figure class="swiper-slide">
							    <a href="javascript:void(0)"><img src="' . esc_url($foodbakery_var_src[0]) . '" alt="foodbakery_var_src"></a>
							</figure>';
						}
					    }
					    ?>
					</div>
					<div class="swiper-pagination"></div>
					<!-- Add Arrows -->
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
	    			<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo esc_html(foodbakery_get_post_excerpt(get_the_title(), $foodbakery_blog_posts_title_length_var)); ?></a></h4>
	    		    </div>
			    <?php } ?>
			    <ul class="post-options">
				<li> <?php echo foodbakery_allow_special_char($post_cats); ?><span><a href="<?php echo esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))); ?>"><?php echo get_the_date(' F j, Y'); ?> </a></span></li>
			    </ul>
			    <p> <?php echo esc_html(foodbakery_get_excerpt($foodbakery_blog_excerpt, '', '')); ?></p>
			    <a href="<?php the_permalink(); ?>" class="read-more text-color"><?php esc_html_e('Learn more', 'foodbakery'); ?><i class="icon-arrow-right22"></i></a>
			</div>
		    </div>
		</div>
		<?php
	    endwhile;
	    wp_reset_postdata();
	else :
	    ?>	
    	<p><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_no_post_found')); ?></p>
	<?php
	endif;
	?>
    </div>
</div>
