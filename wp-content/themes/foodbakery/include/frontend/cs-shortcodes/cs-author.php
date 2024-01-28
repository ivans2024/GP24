<?php
/**
 * @  Blog html form for page builder Frontend side
 *
 *
 */
if ( ! function_exists( 'foodbakery_author_shortcode' ) ) {

	function foodbakery_author_shortcode( $atts ) {
		global $post, $foodbakery_author_element_title, $wpdb, $author_pagination, $foodbakery_author_num_post, $foodbakery_counter_node, $foodbakery_column_atts, $foodbakery_author_description, $foodbakery_author_excerpt, $post_thumb_view, $foodbakery_author_section_title, $args, $foodbakery_author_orderby, $orderby;
		$html = '';
		ob_start();
		$defaults = array(
			'foodbakery_author_element_title' => '',
			'foodbakery_author_orderby' => 'DESC',
			'orderby' => 'ID',
			'foodbakery_author_description' => 'yes',
			'foodbakery_author_excerpt' => '30',
			'foodbakery_author_num_post' => '10',
			'author_pagination' => 'no',
			'foodbakery_var_author_tabs_align' => '',
		);
		extract( shortcode_atts( $defaults, $atts ) );
		$page_element_size = isset( $atts['author_element_size'] ) ? $atts['author_element_size'] : 100;
		if ( function_exists( 'foodbakery_var_page_builder_element_sizes' ) ) {
			echo '<div class="' . foodbakery_var_page_builder_element_sizes( $page_element_size ) . ' ">';
		}

		/*
		 * We start by doing a query to retrieve all users
		 * We need a total user count so that we can calculate how many pages there are
		 */

		$count_args = array(
			'fields' => 'all_with_meta',
			'number' => 999999
		);
		$user_count_query = new WP_User_Query( $count_args );
		$user_count = $user_count_query->get_results();
		static $foodbakery_var_custom_counter;
		if ( ! isset( $foodbakery_var_custom_counter ) ) {
			$foodbakery_var_custom_counter = 1;
		} else {
			$foodbakery_var_custom_counter ++;
		}

		// count the number of users found in the query
		$total_users = $user_count ? count( $user_count ) : 1;
		// grab the current page number and set to 1 if no page number is set
		$page = isset( $_GET['page_id_all_' . $foodbakery_var_custom_counter] ) ? $_GET['page_id_all_' . $foodbakery_var_custom_counter] : 1;

		// how many users to show per page
		if ( isset( $author_pagination ) && $author_pagination == 'yes' ) {
			$users_per_page = $foodbakery_author_num_post;
		} else {
			$users_per_page = $foodbakery_author_num_post;
		}
		// calculate the total number of pages.
		$total_pages = 1;
		$offset = $users_per_page * ($page - 1);
		$total_pages = ceil( $total_users / $users_per_page );

		// main user query
		$args = array(
			'orderby' => 'post_count',
			'fields' => 'all_with_meta',
			'number' => $users_per_page,
			'offset' => $offset,
			'order' => $foodbakery_author_orderby
		);

		// Create the WP_User_Query object
		$wp_user_query = new WP_User_Query( $args );

		// Get the results
		$authors = $wp_user_query->get_results();

		// check to see if we have users
		$foodbakery_var_author_tabs_align = isset( $foodbakery_var_author_tabs_align ) ? $foodbakery_var_author_tabs_align : '';
		if ( ! empty( $authors ) ) {

			$element_title = '';
			if ( isset( $foodbakery_author_element_title ) && trim( $foodbakery_author_element_title ) <> '' ) {
				$element_title = '<div class="element-title ' . $foodbakery_var_author_tabs_align . '"><h2>' . $foodbakery_author_element_title . '</h2></div>';
			}


			echo foodbakery_allow_special_char( $element_title );

			echo '<ul class="author-list col-lg-12 col-md-12 col-sm-12 col-xs-12">';
			// loop trough each user
			$excerpt = $author_first_name = $author_last_name = $author_descreption = $excerpt_new = '';
			foreach ( $authors as $user ) {
				//get usermeta
				$author_meta = get_user_meta( $user->ID );
				$author_first_name = $author_meta['first_name'][0];
				$author_last_name = $author_meta['last_name'][0];
				$author_descreption = $author_meta['description'][0];
				$author_roles = $user->roles;
				$author_avatar = get_avatar( $user->ID, apply_filters( 'foodbakery_author_bio_avatar_size', 70 ) );
				$excerpt = trim( preg_replace( '/<a[^>]*>(.*)<\/a>/iU', '', $author_descreption ) );
				$excerpt_new = wp_trim_words( $excerpt, $foodbakery_author_excerpt, $more = '' );
				$author_facebook_profile = isset( $author_meta['facebook_profile'][0] ) ? $author_meta['facebook_profile'][0] : '';
				$author_twitter_profile = isset( $author_meta['twitter_profile'][0] ) ? $author_meta['twitter_profile'][0] : '';
				$author_google_profile = isset( $author_meta['google_profile'][0] ) ? $author_meta['google_profile'][0] : '';
				$author_instagrame_profile = isset( $author_meta['instagrame_profile'][0] ) ? $author_meta['instagrame_profile'][0] : '';
				$dynamic_col = '';
				$args = array( 'post_type' => 'post', 'posts_per_page' => '2', 'author' => $user->ID );
				$loop = new WP_Query( $args );
				if ( $loop->have_posts() ) {
					$dynamic_col = 'class="col-lg-7 col-md-7 col-sm-12 col-xs-12"';
				} else {
					$dynamic_col = 'class="col-lg-12 col-md-12 col-sm-12 col-xs-12"';
				}
				?>
				<li class="scrollingeffect fadeInUp">
					<div class="row">
						<div <?php echo foodbakery_allow_special_char( $dynamic_col ); ?> >
							<div class="img-holder">
								<figure><?php echo foodbakery_allow_special_char( $author_avatar ); ?></figure>
							</div>
							<div class="text-holder">
								<h5><a href="<?php echo esc_url( get_author_posts_url( $user->ID ) ); ?>"><?php echo esc_html( $user->display_name ); ?></a> <span><?php echo esc_html( $author_roles[0] ); ?></span></h5>
								<?php if ( $foodbakery_author_description == 'yes' && $excerpt_new <> '' ) { ?>
									<p><?php echo esc_html( $excerpt_new ); ?></p>
								<?php } ?>
								<ul class="author-post-options">
									<?php if ( isset( $author_facebook_profile ) && $author_facebook_profile <> '' ) { ?>
										<li><a href="<?php echo esc_url( $author_facebook_profile ); ?>" data-original-title="facebook"><i class="icon-facebook"></i></a></li>
									<?php } ?>
									<?php if ( isset( $author_twitter_profile ) && $author_twitter_profile <> '' ) { ?>
										<li><a href="<?php echo esc_url( $author_twitter_profile ); ?>" data-original-title="twitter"><i class="icon-twitter"></i></a></li>
									<?php } ?>
									<?php if ( isset( $author_google_profile ) && $author_google_profile <> '' ) { ?>
										<li><a href="<?php echo esc_url( $author_google_profile ); ?>" data-original-title="googleplus"><i class="icon-google4"></i></a></li>
									<?php } ?>
									<?php if ( isset( $author_instagrame_profile ) && $author_instagrame_profile <> '' ) { ?>
										<li><a href="<?php echo esc_url( $author_instagrame_profile ); ?>" data-original-title="instagram"><i class="icon-instagram3"></i></a></li>
									<?php } ?>
								</ul>
								<?php if ( $loop->have_posts() != '' ) { ?>
									<a class="btn-view-post" href="<?php echo esc_url( get_author_posts_url( $user->ID ) ); ?>"><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_view_all_posts' ) ); ?><i class="icon-keyboard_arrow_right"></i></a>
								<?php } ?>
							</div>
						</div>
						<?php if ( $loop->have_posts() != '' ) { ?>
							<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
								<div class="author-post-list">
									<ul class="row">
										<?php
										if ( $loop->have_posts() ):
											while ( $loop->have_posts() ):
												$loop->the_post();
												?>
												<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="img-holder">
														<figure><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'foodbakery_media_6' ); ?></a>
															<figcaption><span><?php echo foodbakery_get_post_excerpt( get_the_title(), 4 ); ?></span></figcaption>
														</figure>
													</div>
												</li>
												<?php
											endwhile;
										endif;
										wp_reset_postdata();
										?>
									</ul>
								</div>
							</div>
						<?php } ?>
					</div>
				</li>
				<?php
			}
			echo '</ul>';
		} else {
			echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_no_authors_found' ) );
		}

		// grab the current query parameters
		$query_string = cs_get_server_data('QUERY_STRING');

		// if on the front end, your base is the current page
		if ( isset( $author_pagination ) && $author_pagination == 'yes' ) {
			$foodbakery_var_page = 'page_id_all_' . $foodbakery_var_custom_counter;
			echo '<nav>';
			echo '<div class="row">';
			foodbakery_var_get_pagination( $total_pages, isset( $_GET[$foodbakery_var_page] ) ? $_GET[$foodbakery_var_page] : 1, $foodbakery_var_page );
			echo '</div>';
			echo '</nav>';
		}
		if ( function_exists( 'foodbakery_var_page_builder_element_sizes' ) ) {
			echo '</div>';
		}
		$post_data = ob_get_clean();
		return $post_data;
	}

	if ( function_exists( 'foodbakery_var_short_code' ) ) {
		foodbakery_var_short_code( 'foodbakery_author', 'foodbakery_author_shortcode' );
	}
}