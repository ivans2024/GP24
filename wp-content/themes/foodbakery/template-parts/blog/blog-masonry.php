<?php
/**
 * @ Start frontend Blog Grid View 
 *
 *
 */
global $foodbakery_var_static_text;
$foodbakery_blog_vars = array('col_class', 'args', 'post', 'foodbakery_blog_cats', 'foodbakery_blog_description', 'foodbakery_blog_excerpt', 'foodbakery_blog_posts_title_length_var', 'foodbakery_notification', 'wp_query', 'foodbakery_blog_element_title');
$foodbakery_blog_vars = FOODBAKERY_VAR_GLOBALS()->globalizing($foodbakery_blog_vars);
extract($foodbakery_blog_vars);
$post_id = $post->ID;
extract($wp_query->query_vars);
$foodbakery_blog_element_title = isset($foodbakery_blog_element_title) ? $foodbakery_blog_element_title : '';
$comment_text = '';
$comment_text = foodbakery_var_theme_text_srt('foodbakery_var_comments_off');
?>
<div class="blog blog-masonry">
    <div class ="row">
	<div class="grid">
	    <?php
	    $wpb_all_query = new WP_Query($args);
	    if ($wpb_all_query->have_posts()) :
		$cats = '';
		while ($wpb_all_query->have_posts()) : $wpb_all_query->the_post();
		    $post_id = $post->ID;
		    $foodbakery_post_like_counter = get_post_meta($post_id, 'foodbakery_post_like_counter', true);
		    $post_style = get_post_meta($post_id, 'foodbakery_var_post_style', true);
		    $gallery_images = get_post_meta($post->ID, 'foodbakery_var_post_detail_page_gallery', true);
		    $author_id = $post->post_author;
		    ?>
		    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 grid-item">
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
							$foodbakery_var_src = wp_get_attachment_image_src($gallery_image_id, '');
							$image_alt = get_post_meta($gallery_image_id, '_wp_attachment_image_alt', true);
							echo '	<figure class="swiper-slide">
						    		    <a href="javascript:void(0)"><img src="' . esc_url($foodbakery_var_src[0]) . '"></a>
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
					    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
					</figure>
				    </div>
				    <?php
				}
			    }
			    ?>
			    <div class="text-holder">
				<div class="author-info">
				    <ul class="post-options">
					<li><i class=" icon-clock4"></i><?php echo get_the_date(' F j, Y'); ?><span><?php comments_popup_link(' 0 comment', '1 comment', '% comments', 'comments-link', $comment_text); ?> </span></li>
				    </ul>
				</div>
				<?php if (get_the_title() != '') { ?>
	    			<div class="post-title">
	    			    <h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo esc_html(foodbakery_get_post_excerpt(get_the_title(), $foodbakery_blog_posts_title_length_var)); ?></a></h4>
	    			</div>
				<?php } ?>
				<a href="<?php the_permalink(); ?>" class="read-more text-color text-color"><?php esc_html_e('Read Article', 'foodbakery'); ?></a>
			    </div>
			</div>
		    </div>
		    <?php
		endwhile;
		wp_reset_postdata();
	    else :
		?>	
    	    <p><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_no_post_found')); ?></p>
	    <?php endif;
	    ?>
	</div>
    </div>
</div>