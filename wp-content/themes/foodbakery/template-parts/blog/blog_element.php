<?php
/*
 *
 * @File : blog
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_var_page_builder_blog' ) ) {

	function foodbakery_var_page_builder_blog( $die = 0 ) {
		global $foodbakery_var_node, $post, $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;
		$strings = new foodbakery_theme_all_strings;
		$strings->foodbakery_short_code_strings();
		$strings->foodbakery_theme_option_strings();

		$shortcode_element = '';
		$filter_element = 'filterdrag';
		$shortcode_view = '';
		$output = array();
		$counter = $_POST['counter'];
		$foodbakery_counter = $_POST['counter'];
		if ( isset( $_POST['action'] ) && ! isset( $_POST['shortcode_element_id'] ) ) {
			$POSTID = '';
			$shortcode_element_id = '';
		} else {
			$POSTID = $_POST['POSTID'];
			$shortcode_element_id = $_POST['shortcode_element_id'];
			$shortcode_str = stripslashes( $shortcode_element_id );
			$PREFIX = 'foodbakery_blog';
			$parseObject = new ShortcodeParse();
			$output = $parseObject->foodbakery_shortcodes( $output, $shortcode_str, true, $PREFIX );
		}
		$defaults = array(
			'foodbakery_blog_element_title' => '',
			'foodbakery_blog_view' => 'view1',
			'foodbakery_blog_cat' => '',
			'foodbakery_blog_cat' => '',
			'foodbakery_blog_order_by' => 'ID',
			'foodbakery_blog_order_by_dir' => 'DESC',
			'foodbakery_blog_description' => 'yes',
			'foodbakery_blog_filterable' => '',
			'foodbakery_blog_excerpt' => '30',
			'foodbakery_blog_posts_title_length' => '',
			'foodbakery_blog_num_post' => '5',
			'blog_pagination' => '',
			'foodbakery_blog_class' => '',
			'foodbakery_blog_size' => ''
		);
		if ( isset( $output['0']['atts'] ) ) {
			$atts = $output['0']['atts'];
		} else {
			$atts = array();
		}
		$blog_element_size = '50';
		foreach ( $defaults as $key => $values ) {
			if ( isset( $atts[$key] ) ) {
				$$key = $atts[$key];
			} else {
				$$key = $values;
			}
		}
		$name = 'blog';
		$coloumn_class = 'column_' . $blog_element_size;
		if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) {
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
		$foodbakery_rand_id = rand( 13441324, 93441324 );
		?>
		<div id="<?php echo esc_attr( $name . $foodbakery_counter ); ?>_del" class="column  parentdelete <?php echo esc_attr( $coloumn_class ); ?> <?php echo esc_attr( $shortcode_view ); ?>" item="blog" data="<?php echo foodbakery_element_size_data_array_index( $blog_element_size ) ?>">
			<?php foodbakery_element_setting( $name, $foodbakery_counter, $blog_element_size ); ?>
			<div class="cs-wrapp-class-<?php echo intval( $foodbakery_counter ) ?> <?php echo esc_attr( $shortcode_element ); ?>" id="<?php echo esc_attr( $name . $foodbakery_counter ) ?>" data-shortcode-template="[foodbakery_blog {{attributes}}]"  style="display: none;">
				<div class="cs-heading-area">
					<h5><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_edit_blog_items' ) ); ?></h5>
					<a href="javascript:foodbakery_frame_removeoverlay('<?php echo esc_js( $name . $foodbakery_counter ); ?>','<?php echo esc_js( $filter_element ); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
				</div>
				<div class="cs-pbwp-content">
					<div class="cs-wrapp-clone cs-shortcode-wrapp">
						<?php
						if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) {
							foodbakery_shortcode_element_size();
						}
						?>
						<?php
						$foodbakery_opt_array = array(
							'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_element_title' ),
							'desc' => '',
							'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_element_title_hint' ),
							'echo' => true,
							'field_params' => array(
								'std' => esc_attr( $foodbakery_blog_element_title ),
								'cust_id' => '',
								'cust_name' => 'foodbakery_blog_element_title[]',
								'return' => true,
							),
						);

						$foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

						$a_options = array();
						$foodbakery_blog_cat = isset( $foodbakery_blog_cat ) ? $foodbakery_blog_cat : '';
						if ( '' != $foodbakery_blog_cat ) {
							$foodbakery_blog_cat = explode( ',', $foodbakery_blog_cat );
						}
						$a_options = foodbakery_show_all_cats( '', '', $foodbakery_blog_cat, "category", true );
						$foodbakery_opt_array = array(
							'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_choose_category' ),
							'desc' => '',
							'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_cat_hint' ),
							'echo' => true,
							'multi' => true,
							'field_params' => array(
								'std' => $foodbakery_blog_cat,
								'id' => '',
								'cust_name' => 'foodbakery_blog_cat[' . $foodbakery_rand_id . '][]',
								'classes' => 'dropdown chosen-select',
								'options' => $a_options,
								'return' => true,
							),
						);

						$foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );

						$rand = rand( 12345678, 93242432 );
						$imageurl = get_template_directory_uri() . '/assets/backend/images/views/blog-listings/';

						$foodbakery_opt_array = array(
							'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_design_views' ),
							'desc' => '',
							'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_design_views_hint' ),
							'echo' => true,
							'field_params' => array(
								'std' => $foodbakery_blog_view,
								'id' => '',
								'cust_name' => 'foodbakery_blog_view[]',
								'classes' => 'dropdown chosen-select',
								'options' => array(
									'view1' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_design_large' ),
									'view2' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_design_masonry' ),
									'view3' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_design_medium' ),
									'view4' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_design_grid' ),
								),
								'return' => true,
							),
						);
						$foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );
						?>
						<div id="Blog-listing<?php echo intval( $foodbakery_counter ); ?>" >
							<?php
							$foodbakery_opt_array = array(
								'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_col' ),
								'desc' => '',
								'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_col_hint' ),
								'echo' => true,
								'field_params' => array(
									'std' => $foodbakery_blog_size,
									'id' => '',
									'cust_name' => 'foodbakery_blog_size[]',
									'classes' => 'dropdown chosen-select',
									'options' => array(
										'1' => foodbakery_var_theme_text_srt( 'foodbakery_var_one_col' ),
										'2' => foodbakery_var_theme_text_srt( 'foodbakery_var_two_col' ),
										'3' => foodbakery_var_theme_text_srt( 'foodbakery_var_three_col' ),
										'4' => foodbakery_var_theme_text_srt( 'foodbakery_var_four_col' ),
										'6' => foodbakery_var_theme_text_srt( 'foodbakery_var_six_col' ),
									),
									'return' => true,
								),
							);
							$foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );

							$options = array(
								'id' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_views_widget_order_by_id' ),
								'date' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_views_widget_order_by_date' ),
								'title' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_views_widget_order_by_title' ),
							);
							$options = apply_filters( 'posts_order_by_options', $options );
							$foodbakery_opt_array = array(
								'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_views_widget_order_by' ),
								'desc' => '',
								'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_post_order_hint' ),
								'echo' => true,
								'field_params' => array(
									'options' => $options,
									'std' => esc_attr( $foodbakery_blog_order_by ),
									'id' => '',
									'classes' => 'dropdown chosen-select',
									'cust_id' => '',
									'cust_name' => 'foodbakery_var_post_order_by[]',
									'return' => true,
									'required' => false,
								),
							);
							$foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );

							$foodbakery_opt_array = array(
								'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_post_order' ),
								'desc' => '',
								'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_post_order_hint' ),
								'echo' => true,
								'field_params' => array(
									'std' => $foodbakery_blog_order_by_dir,
									'id' => '',
									'cust_name' => 'foodbakery_blog_order_by_dir[]',
									'classes' => 'dropdown chosen-select-no-single select-medium',
									'options' => array(
										'ASC' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_asc' ),
										'DESC' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_desc' ),
									),
									'return' => true,
								),
							);

							$foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );

							$foodbakery_opt_array = array(
								'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_post_description' ),
								'desc' => '',
								'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_post_description_hint' ),
								'echo' => true,
								'field_params' => array(
									'std' => $foodbakery_blog_description,
									'id' => '',
									'cust_name' => 'foodbakery_blog_description[]',
									'classes' => 'dropdown chosen-select-no-single select-medium',
									'options' => array(
										'yes' => foodbakery_var_theme_text_srt( 'foodbakery_var_yes' ),
										'no' => foodbakery_var_theme_text_srt( 'foodbakery_var_no' ),
									),
									'return' => true,
								),
							);

							$foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );

							$foodbakery_opt_array = array(
								'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_length_excerpt' ),
								'desc' => '',
								'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_length_excerpt_hint' ),
								'echo' => true,
								'field_params' => array(
									'std' => esc_attr( $foodbakery_blog_excerpt ),
									'cust_id' => '',
									'classes' => 'txtfield',
									'cust_name' => 'foodbakery_blog_excerpt[]',
									'return' => true,
								),
							);

							$foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

							if ( ! is_numeric( $foodbakery_blog_posts_title_length ) ) {
								$foodbakery_blog_posts_title_length = '';
							}

							$foodbakery_opt_array = array(
								'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_element_post_title_length' ),
								'desc' => '',
								'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_element_post_title_length_hint' ),
								'echo' => true,
								'field_params' => array(
									'std' => esc_attr( $foodbakery_blog_posts_title_length ),
									'cust_id' => '',
									'cust_name' => 'foodbakery_blog_posts_title_length[]',
									'return' => true,
								),
							);

							$foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );
							?>
						</div>

						<?php
						$foodbakery_opt_array = array(
							'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_post_per_page' ),
							'desc' => '',
							'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_post_per_page_hint' ),
							'echo' => true,
							'field_params' => array(
								'std' => esc_attr( $foodbakery_blog_num_post ),
								'cust_id' => '',
								'classes' => 'txtfield',
								'cust_name' => 'foodbakery_blog_num_post[]',
								'return' => true,
							),
						);

						$foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

						$filter_view1 = $filter_view2 = $filter_all_posts = '';
						$all_posts_blog_views = array( 'view11', 'view12', 'view13', 'view17', 'view19' );
						if ( 'view1' === $foodbakery_blog_view || '' === $foodbakery_blog_view ) {
							$filter_view1 = 'none';
							$filter_view2 = 'block';
							$filter_all_posts = 'none';
						} else if ( in_array( $foodbakery_blog_view, $all_posts_blog_views ) ) {
							$filter_view1 = 'none';
							$filter_view2 = 'none';
							$filter_all_posts = 'block';
						} else {
							$filter_view1 = 'block';
							$filter_view2 = 'none';
							$filter_all_posts = 'none';
						}

						$foodbakery_opt_array = array(
							'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_pagination' ),
							'desc' => '',
							'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_pagination_hint' ),
							'echo' => true,
							'field_params' => array(
								'std' => $blog_pagination,
								'id' => '',
								'cust_name' => 'blog_pagination[]',
								'classes' => 'dropdown chosen-select-no-single select-medium',
								'options' => array(
									'yes' => foodbakery_var_theme_text_srt( 'foodbakery_var_show_pagination' ),
									'no' => foodbakery_var_theme_text_srt( 'foodbakery_var_single_page' ),
								),
								'return' => true,
							),
						);
						$foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );

						$foodbakery_opt_array = array(
							'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_all_posts' ),
							'desc' => '',
							'hint_text' => '',
							'echo' => true,
							'field_params' => array(
								'std' => $foodbakery_blog_all_posts,
								'id' => '',
								'cust_name' => 'foodbakery_blog_all_posts[]',
								'classes' => 'dropdown chosen-select-no-single select-medium',
								'options' => array(
									'all' => foodbakery_var_theme_text_srt( 'foodbakery_var_blog_all_posts' ),
								),
								'return' => true,
							),
						);
						$foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );
						?>

						<?php if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) { ?>
							<ul class="form-elements insert-bg">
								<li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:foodbakery_shortcode_insert_editor('<?php echo esc_js( str_replace( 'foodbakery_', '', $name ) ); ?>', '<?php echo esc_js( $name . $foodbakery_counter ) ?>', '<?php echo esc_js( $filter_element ); ?>')" ><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_insert' ) ); ?></a> </li>
							</ul>
							<div id="results-shortocde"></div>
						<?php } else { ?>
							<?php
							$foodbakery_opt_array = array(
								'std' => 'blog',
								'id' => '',
								'before' => '',
								'after' => '',
								'classes' => '',
								'extra_atr' => '',
								'cust_id' => 'foodbakery_orderby' . $foodbakery_counter,
								'cust_name' => 'foodbakery_orderby[]',
								'required' => false
							);
							$foodbakery_var_form_fields->foodbakery_var_form_hidden_render( $foodbakery_opt_array );

							$foodbakery_opt_array = array(
								'id' => '',
								'std' => absint( $foodbakery_rand_id ),
								'cust_id' => "",
								'cust_name' => "foodbakery_blog_id[]",
							);

							$foodbakery_var_form_fields->foodbakery_var_form_hidden_render( $foodbakery_opt_array );

							$foodbakery_opt_array = array(
								'name' => '',
								'desc' => '',
								'hint_text' => '',
								'echo' => true,
								'field_params' => array(
									'std' => 'Save',
									'cust_id' => '',
									'cust_type' => 'button',
									'classes' => 'cs-foodbakery-admin-btn',
									'cust_name' => 'button',
									'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
									'return' => true,
								),
							);

							$foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );
							?>
						<?php } ?>

					</div>
				</div>
			</div>
		</div>
		<?php
		if ( $die <> 1 ) {
			die();
		}
	}

	add_action( 'wp_ajax_foodbakery_var_page_builder_blog', 'foodbakery_var_page_builder_blog' );
}
if ( ! function_exists( 'foodbakery_save_page_builder_data_blog_callback' ) ) {

	/**
	 * Save data for blog shortcode.
	 *
	 * @param	array $args
	 * @return	array
	 */
	function foodbakery_save_page_builder_data_blog_callback( $args ) {

		$data = $args['data'];
		$counters = $args['counters'];
		$widget_type = $args['widget_type'];
		$column = $args['column'];
		if ( $widget_type == "blog" || $widget_type == "cs_blog" ) {
			$foodbakery_var_blog = '';

			$page_element_size = $data['blog_element_size'][$counters['foodbakery_global_counter_blog']];
			$current_element_size = $data['blog_element_size'][$counters['foodbakery_global_counter_blog']];

			if ( isset( $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] ) && $data['foodbakery_widget_element_num'][$counters['foodbakery_counter']] == 'shortcode' ) {
				$shortcode_str = stripslashes( ( $data['shortcode']['blog'][$counters['foodbakery_shortcode_counter_blog']] ) );

				$element_settings = 'blog_element_size="' . $current_element_size . '"';
				$reg = '/blog_element_size="(\d+)"/s';
				$shortcode_str = preg_replace( $reg, $element_settings, $shortcode_str );
				$shortcode_data .= $shortcode_str;
				$counters['foodbakery_shortcode_counter_blog'] ++;
			} else {
				$foodbakery_var_blog = '[foodbakery_blog blog_element_size="' . htmlspecialchars( $data['blog_element_size'][$counters['foodbakery_global_counter_blog']] ) . '" ';
				if ( isset( $data['foodbakery_blog_element_title'][$counters['foodbakery_counter_blog']] ) && $data['foodbakery_blog_element_title'][$counters['foodbakery_counter_blog']] != '' ) {
					$foodbakery_var_blog .= 'foodbakery_blog_element_title="' . htmlspecialchars( $data['foodbakery_blog_element_title'][$counters['foodbakery_counter_blog']], ENT_QUOTES ) . '" ';
				}
				if ( isset( $data['foodbakery_blog_posts_title_length'][$counters['foodbakery_counter_blog']] ) && $data['foodbakery_blog_posts_title_length'][$counters['foodbakery_counter_blog']] != '' ) {
					$foodbakery_var_blog .= 'foodbakery_blog_posts_title_length="' . htmlspecialchars( $data['foodbakery_blog_posts_title_length'][$counters['foodbakery_counter_blog']], ENT_QUOTES ) . '" ';
				}

				if ( isset( $data['foodbakery_blog_id'][$counters['foodbakery_counter_blog']] ) && $data['foodbakery_blog_id'][$counters['foodbakery_counter_blog']] != '' ) {
					$foodbakery_blog_id = $data['foodbakery_blog_id'][$counters['foodbakery_counter_blog']];

					if ( isset( $_POST['foodbakery_blog_cat'][$foodbakery_blog_id] ) && $_POST['foodbakery_blog_cat'][$foodbakery_blog_id] != '' ) {

						if ( is_array( $_POST['foodbakery_blog_cat'][$foodbakery_blog_id] ) ) {

							$foodbakery_var_blog .= ' foodbakery_blog_cat="' . implode( ',', $_POST['foodbakery_blog_cat'][$foodbakery_blog_id] ) . '" ';
						}
					}
				}

				if ( isset( $data['foodbakery_var_post_order_by'][$counters['foodbakery_counter_blog']] ) && $data['foodbakery_var_post_order_by'][$counters['foodbakery_counter_blog']] != '' ) {
					$foodbakery_var_blog .= 'foodbakery_blog_order_by="' . htmlspecialchars( $data['foodbakery_var_post_order_by'][$counters['foodbakery_counter_blog']], ENT_QUOTES ) . '" ';
				}

				if ( isset( $data['foodbakery_blog_order_by_dir'][$counters['foodbakery_counter_blog']] ) && $data['foodbakery_blog_order_by_dir'][$counters['foodbakery_counter_blog']] != '' ) {
					$foodbakery_var_blog .= 'foodbakery_blog_order_by_dir="' . htmlspecialchars( $data['foodbakery_blog_order_by_dir'][$counters['foodbakery_counter_blog']], ENT_QUOTES ) . '" ';
				}
				if ( isset( $data['orderby'][$counters['foodbakery_counter_blog']] ) && $data['orderby'][$counters['foodbakery_counter_blog']] != '' ) {
					$foodbakery_var_blog .= 'orderby="' . htmlspecialchars( $data['orderby'][$counters['foodbakery_counter_blog']], ENT_QUOTES ) . '" ';
				}
				if ( isset( $data['foodbakery_blog_description'][$counters['foodbakery_counter_blog']] ) && $data['foodbakery_blog_description'][$counters['foodbakery_counter_blog']] != '' ) {
					$foodbakery_var_blog .= 'foodbakery_blog_description="' . htmlspecialchars( $data['foodbakery_blog_description'][$counters['foodbakery_counter_blog']], ENT_QUOTES ) . '" ';
				}
				if ( isset( $data['foodbakery_blog_filterable'][$counters['foodbakery_counter_blog']] ) && $data['foodbakery_blog_filterable'][$counters['foodbakery_counter_blog']] != '' ) {
					$foodbakery_var_blog .= 'foodbakery_blog_filterable="' . htmlspecialchars( $data['foodbakery_blog_filterable'][$counters['foodbakery_counter_blog']], ENT_QUOTES ) . '" ';
				}
				if ( isset( $data['foodbakery_blog_excerpt'][$counters['foodbakery_counter_blog']] ) && $data['foodbakery_blog_excerpt'][$counters['foodbakery_counter_blog']] != '' ) {
					$foodbakery_var_blog .= 'foodbakery_blog_excerpt="' . htmlspecialchars( $data['foodbakery_blog_excerpt'][$counters['foodbakery_counter_blog']], ENT_QUOTES ) . '" ';
				}
				if ( isset( $data['foodbakery_blog_excerpt'][$counters['foodbakery_counter_blog']] ) && $data['foodbakery_blog_excerpt'][$counters['foodbakery_counter_blog']] != '' ) {
					$foodbakery_var_blog .= 'foodbakery_blog_excerpt="' . htmlspecialchars( $data['foodbakery_blog_excerpt'][$counters['foodbakery_counter_blog']], ENT_QUOTES ) . '" ';
				}
				if ( isset( $data['foodbakery_blog_num_post'][$counters['foodbakery_counter_blog']] ) && $data['foodbakery_blog_num_post'][$counters['foodbakery_counter_blog']] != '' ) {
					$foodbakery_var_blog .= 'foodbakery_blog_num_post="' . htmlspecialchars( $data['foodbakery_blog_num_post'][$counters['foodbakery_counter_blog']], ENT_QUOTES ) . '" ';
				}
				if ( isset( $data['blog_pagination'][$counters['foodbakery_counter_blog']] ) && $data['blog_pagination'][$counters['foodbakery_counter_blog']] != '' ) {
					$foodbakery_var_blog .= 'blog_pagination="' . htmlspecialchars( $data['blog_pagination'][$counters['foodbakery_counter_blog']], ENT_QUOTES ) . '" ';
				}
				if ( isset( $data['foodbakery_blog_class'][$counters['foodbakery_counter_blog']] ) && $data['foodbakery_blog_class'][$counters['foodbakery_counter_blog']] != '' ) {
					$foodbakery_var_blog .= 'foodbakery_blog_class="' . htmlspecialchars( $data['foodbakery_blog_class'][$counters['foodbakery_counter_blog']], ENT_QUOTES ) . '" ';
				}
				if ( isset( $data['foodbakery_blog_view'][$counters['foodbakery_counter_blog']] ) && $data['foodbakery_blog_view'][$counters['foodbakery_counter_blog']] != '' ) {
					$foodbakery_var_blog .= 'foodbakery_blog_view="' . htmlspecialchars( $data['foodbakery_blog_view'][$counters['foodbakery_counter_blog']], ENT_QUOTES ) . '" ';
				}
				if ( isset( $data['foodbakery_blog_size'][$counters['foodbakery_counter_blog']] ) && $data['foodbakery_blog_size'][$counters['foodbakery_counter_blog']] != '' ) {
					$foodbakery_var_blog .= 'foodbakery_blog_size="' . htmlspecialchars( $data['foodbakery_blog_size'][$counters['foodbakery_counter_blog']], ENT_QUOTES ) . '" ';
				}
				$foodbakery_var_blog .= ']';
				if ( isset( $data['blog_text'][$counters['foodbakery_counter_blog']] ) && $data['blog_text'][$counters['foodbakery_counter_blog']] != '' ) {
					$foodbakery_var_blog .= htmlspecialchars( $data['blog_text'][$counters['foodbakery_counter_blog']], ENT_QUOTES ) . ' ';
				}
				$foodbakery_var_blog .= '[/foodbakery_blog]';

				$shortcode_data .= $foodbakery_var_blog;
				$counters['foodbakery_counter_blog'] ++;
			}
			$counters['foodbakery_global_counter_blog'] ++;
		}
		return array(
			'data' => $data,
			'counters' => $counters,
			'widget_type' => $widget_type,
			'column' => $shortcode_data,
		);
	}

	add_filter( 'foodbakery_save_page_builder_data_blog', 'foodbakery_save_page_builder_data_blog_callback' );
}
if ( ! function_exists( 'foodbakery_load_shortcode_counters_blog_callback' ) ) {

	/**
	 * Populate blog shortcode counter variables.
	 *
	 * @param	array $counters
	 * @return	array
	 */
	function foodbakery_load_shortcode_counters_blog_callback( $counters ) {
		$counters['foodbakery_global_counter_blog'] = 0;
		$counters['foodbakery_shortcode_counter_blog'] = 0;
		$counters['foodbakery_counter_blog'] = 0;
		return $counters;
	}

	add_filter( 'foodbakery_load_shortcode_counters', 'foodbakery_load_shortcode_counters_blog_callback' );
}
if ( ! function_exists( 'foodbakery_shortcode_names_list_populate_blog_callback' ) ) {

	/**
	 * Populate blog shortcode names list.
	 *
	 * @param	array $counters
	 * @return	array
	 */
	function foodbakery_shortcode_names_list_populate_blog_callback( $shortcode_array ) {
		$shortcode_array['blog'] = array(
			'title' => foodbakery_var_frame_text_srt( 'foodbakery_var_blog' ),
			'name' => 'blog',
			'icon' => 'icon-support',
			'categories' => 'typography',
		);
		return $shortcode_array;
	}

	add_filter( 'foodbakery_shortcode_names_list_populate', 'foodbakery_shortcode_names_list_populate_blog_callback' );
}
if ( ! function_exists( 'foodbakery_element_list_populate_blog_callback' ) ) {

	/**
	 * Populate blog shortcode strings list.
	 *
	 * @param	array $counters
	 * @return	array
	 */
	function foodbakery_element_list_populate_blog_callback( $element_list ) {
		$element_list['blog'] = foodbakery_var_frame_text_srt( 'foodbakery_var_blog' );
		return $element_list;
	}

	add_filter( 'foodbakery_element_list_populate', 'foodbakery_element_list_populate_blog_callback' );
}