<?php
/**
 * The template for 
 * displaying shop page
 */
get_header();
$var_arrays = array('post', 'foodbakery_node', 'foodbakery_sidebarLayout', 'column_class', 'foodbakery_xmlObject', 'foodbakery_node_id', 'column_attributes', 'foodbakery_elem_id');
$page_global_vars = FOODBAKERY_VAR_GLOBALS()->globalizing($var_arrays);
extract($page_global_vars);

if (is_shop()) {

    $foodbakery_shop_id = wc_get_page_id('shop');

    $foodbakery_page_bulider = get_post_meta($foodbakery_shop_id, "foodbakery_page_builder", true);

    $foodbakery_xmlObject = new stdClass();
    if (isset($foodbakery_page_bulider) && $foodbakery_page_bulider <> '') {
	$foodbakery_xmlObject = new SimpleXMLElement($foodbakery_page_bulider);
    }
    ?>
    <!-- Main Content Section -->
    <div class="main-section">
	<?php
	$foodbakery_page_sidebar_right = '';
	$foodbakery_page_sidebar_left = '';
	$foodbakery_postObject = get_post_meta($foodbakery_shop_id, 'foodbakery_var_full_data', true);
	$foodbakery_page_layout = get_post_meta($foodbakery_shop_id, 'foodbakery_var_page_layout', true);
	$foodbakery_page_sidebar_right = get_post_meta($foodbakery_shop_id, 'foodbakery_var_page_sidebar_right', true);
	$foodbakery_page_sidebar_left = get_post_meta($foodbakery_shop_id, 'foodbakery_var_page_sidebar_left', true);
	$foodbakery_page_bulider = get_post_meta($foodbakery_shop_id, "foodbakery_page_builder", true);
	$section_container_width = '';
	$page_element_size = 'page-content-fullwidth';

	if (!isset($foodbakery_page_layout) || $foodbakery_page_layout == "none") {
	    $page_element_size = 'page-content-fullwidth col-lg-12 col-md-12 col-sm-12 col-xs-12';
	} else {
	    $page_element_size = 'page-content col-lg-9 col-md-9 col-sm-12 col-xs-12';
	}
	$foodbakery_xmlObject = new stdClass();

	if (isset($foodbakery_page_bulider) && $foodbakery_page_bulider <> '') {
	    $foodbakery_xmlObject = new SimpleXMLElement($foodbakery_page_bulider);
	}
	if (isset($foodbakery_page_layout)) {
	    $foodbakery_sidebarLayout = $foodbakery_page_layout;
	}
	$pageSidebar = false;
	if ($foodbakery_sidebarLayout == 'left' || $foodbakery_sidebarLayout == 'right') {
	    $pageSidebar = true;
	}
        if (!empty($foodbakery_xmlObject) && is_array($foodbakery_xmlObject) && count($foodbakery_xmlObject) > 1) {
	    if (isset($foodbakery_page_layout)) {
		$foodbakery_page_sidebar_right = $foodbakery_page_sidebar_right;
		$foodbakery_page_sidebar_left = $foodbakery_page_sidebar_left;
	    }
	    $foodbakery_counter_node = $column_no = 0;
	    $fullwith_style = '';
	    $section_container_style_elements = ' ';
	    if (isset($foodbakery_page_layout) && $foodbakery_sidebarLayout <> '' and $foodbakery_sidebarLayout <> "none") {

		$fullwith_style = 'style="width:100%;"';
		$section_container_style_elements = ' width: 100%;';
		echo '<div class="container">';
		echo '<div class="row">';

		if (isset($foodbakery_page_layout) && $foodbakery_sidebarLayout <> '' and $foodbakery_sidebarLayout <> "none" and $foodbakery_sidebarLayout == 'left') :
		    if (is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_page_sidebar_left))) {
			?>
		        <aside class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
			    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($foodbakery_page_sidebar_left)) : endif; ?>
		        </aside>
			<?php
		    }
		endif;
		echo '<div class="' . ($page_element_size) . '">';
	    }

	    if (post_password_required()) {
		echo '<header class="heading"><h6 class="transform">' . get_the_title($foodbakery_shop_id) . '</h6></header>';
		echo foodbakery_password_form();
	    } else {
		$width = 840;
		$height = 328;
		$foodbakery_post_thumbnail_id = get_post_thumbnail_id($foodbakery_shop_id);
		$image_url = foodbakery_attachment_image_src($foodbakery_post_thumbnail_id, $width, $height);
		wp_reset_postdata();

		if ($pageSidebar != true) {
		    ?>
		    <div class="page-section">
			<div class="container">
			    <div class="row">
				<?php
			    }
			    if (isset($image_url) && $image_url != '') {
				?>
				<a href="<?php echo esc_url($image_url); ?>" data-rel="prettyPhoto" data-title="prettyPhoto">
				    <figure>
					<div class="page-featured-image">
					    <img class="img-thumbnail cs-page-thumbnail" alt="cs-page-thumbnail" data-src="cs-page-thumbnail" src="<?php echo esc_url($image_url); ?>">
					</div>
				    </figure>
				</a>
				<?php
			    }
			    $content_post = get_post($foodbakery_shop_id);
			    if (is_object($content_post)) {
				$content = $content_post->post_content;

				if (trim($content) <> '') {
				    echo '<div class="cs-shop-wrap"><div class="cs-rich-editor">';
				    $content = apply_filters('the_content', $content);
				    $content = str_replace(']]>', ']]&gt;', $content);
				    echo do_shortcode($content);
				    echo '</div></div>';
				}
			    }
			    if ($pageSidebar != true) {
				?>
			    </div>
			</div>
		    </div>
		    <?php
		}
		if ($pageSidebar != true) {
		    ?>
		    <div class="page-section">
			<div class="container">
			    <?php
			}
			get_template_part('woocommerce/products-loop', 'page');
			if ($pageSidebar != true) {
			    ?>
			</div>
		    </div>
		    <?php
		}
	    }

	    if (isset($foodbakery_xmlObject->column_container)) {
		$foodbakery_elem_id = 0;
	    }
	    foreach ($foodbakery_xmlObject->column_container as $column_container) {

		$foodbakery_section_bg_image = $foodbakery_var_section_title = $foodbakery_var_section_subtitle = $foodbakery_section_bg_image_position = $foodbakery_section_bg_image_repeat = $foodbakery_section_bg_color = $foodbakery_section_padding_top = $foodbakery_section_padding_bottom = $foodbakery_section_custom_style = $foodbakery_section_css_id = $foodbakery_layout = $foodbakery_sidebar_left = $foodbakery_sidebar_right = $css_bg_image = '';
		$section_style_elements = '';
		$section_container_style_elements = '';
		$section_video_element = '';
		$foodbakery_section_bg_color = '';
		$foodbakery_section_view = 'container';
		if (isset($column_container)) {

		    $column_attributes = $column_container->attributes();
		    $column_class = $column_attributes->class;
		    $parallax_class = '';
		    $parallax_data_type = '';
		    $foodbakery_section_parallax = $column_attributes->foodbakery_section_parallax;
		    if (isset($foodbakery_section_parallax) && (string) $foodbakery_section_parallax == 'yes') {

			$parallax_class = ($foodbakery_section_parallax == 'yes') ? 'parallex-bg' : '';
			$parallax_data_type = ' data-type="background"';
		    }
		    $foodbakery_var_section_title = $column_attributes->foodbakery_var_section_title;
		    $foodbakery_var_section_subtitle = $column_attributes->foodbakery_var_section_subtitle;
		    $foodbakery_section_margin_top = $column_attributes->foodbakery_section_margin_top;
		    $foodbakery_section_margin_bottom = $column_attributes->foodbakery_section_margin_bottom;
		    $foodbakery_section_padding_top = $column_attributes->foodbakery_section_padding_top;
		    $foodbakery_section_padding_bottom = $column_attributes->foodbakery_section_padding_bottom;
		    $foodbakery_section_view = $column_attributes->foodbakery_section_view;
		    $foodbakery_section_border_color = $column_attributes->foodbakery_section_border_color;
		    if (isset($foodbakery_section_border_color) && $foodbakery_section_border_color != '') {
			$section_style_elements .= '';
		    }
		    if (isset($foodbakery_section_margin_top) && $foodbakery_section_margin_top != '') {
			$section_style_elements .= 'margin-top: ' . $foodbakery_section_margin_top . 'px;';
		    }
		    if (isset($foodbakery_section_padding_top) && $foodbakery_section_padding_top != '') {
			$section_style_elements .= 'padding-top: ' . $foodbakery_section_padding_top . 'px;';
		    }
		    if (isset($foodbakery_section_padding_bottom) && $foodbakery_section_padding_bottom != '') {
			$section_style_elements .= 'padding-bottom: ' . $foodbakery_section_padding_bottom . 'px;';
		    }
		    if (isset($foodbakery_section_margin_bottom) && $foodbakery_section_margin_bottom != '') {
			$section_style_elements .= 'margin-bottom: ' . $foodbakery_section_margin_bottom . 'px;';
		    }
		    $foodbakery_section_border_top = $column_attributes->foodbakery_section_border_top;
		    $foodbakery_section_border_bottom = $column_attributes->foodbakery_section_border_bottom;
		    if (isset($foodbakery_section_border_top) && $foodbakery_section_border_top != '') {
			$section_style_elements .= 'border-top: ' . $foodbakery_section_border_top . 'px ' . $foodbakery_section_border_color . ' solid;';
		    }
		    if (isset($foodbakery_section_border_bottom) && $foodbakery_section_border_bottom != '') {
			$section_style_elements .= 'border-bottom: ' . $foodbakery_section_border_bottom . 'px ' . $foodbakery_section_border_color . ' solid;';
		    }
		    $foodbakery_section_background_option = $column_attributes->foodbakery_section_background_option;
		    $foodbakery_section_bg_image_position = $column_attributes->foodbakery_section_bg_image_position;
		    if (isset($column_attributes->foodbakery_section_bg_color))
			$foodbakery_section_bg_color = $column_attributes->foodbakery_section_bg_color;
		    if (isset($foodbakery_section_background_option) && $foodbakery_section_background_option == 'section-custom-background-image') {
			$foodbakery_section_bg_image = $column_attributes->foodbakery_section_bg_image;
			$foodbakery_section_bg_image_position = $column_attributes->foodbakery_section_bg_image_position;
			$foodbakery_section_bg_imageg = '';
			if (isset($foodbakery_section_bg_image) && $foodbakery_section_bg_image != '') {
			    if (isset($foodbakery_section_parallax) && (string) $foodbakery_section_parallax == 'yes') {
				$foodbakery_section_bg_imageg = 'url(' . $foodbakery_section_bg_image . ') ' . $foodbakery_section_bg_image_position . ' ' . ' fixed';
			    } else {
				$foodbakery_section_bg_imageg = 'url(' . $foodbakery_section_bg_image . ') ' . $foodbakery_section_bg_image_position . ' ';
			    }
			}
			$section_style_elements .= 'background: ' . $foodbakery_section_bg_imageg . ' ' . $foodbakery_section_bg_color . ';';
		    } else if (isset($foodbakery_section_background_option) && $foodbakery_section_background_option == 'section_background_video') {
			$foodbakery_section_video_url = $column_attributes->foodbakery_section_video_url;
			$foodbakery_section_video_mute = $column_attributes->foodbakery_section_video_mute;
			$foodbakery_section_video_autoplay = $column_attributes->foodbakery_section_video_autoplay;
			$mute_flag = $mute_control = '';
			$mute_flag = 'true';
			if ($foodbakery_section_video_mute == 'yes') {
			    $mute_flag = 'false';
			    $mute_control = 'controls muted ';
			}
			$foodbakery_video_autoplay = 'autoplay';
			if ($foodbakery_section_video_autoplay == 'yes') {
			    $foodbakery_video_autoplay = 'autoplay';
			} else {
			    $foodbakery_video_autoplay = '';
			}
			$section_video_class = 'video-parallex';
			$url = parse_url($foodbakery_section_video_url);
			if ($url['host'] == cs_get_server_data("SERVER_NAME")) {
			    $file_type = wp_check_filetype($foodbakery_section_video_url);
			    if (isset($file_type['type']) && $file_type['type'] <> '') {
				$file_type = $file_type['type'];
			    } else {
				$file_type = 'video/mp4';
			    }
			    $rand_player_id = rand(6, 555);
			    $section_video_element = '<div class="page-section-video cs-section-video">
                                        <video id="player' . $rand_player_id . '" width="100%" height="100%" ' . $foodbakery_video_autoplay . ' loop="true" preload="none" volume="false" controls="controls" class="nectar-video-bg   cs-video-element"  ' . $mute_control . ' >
                                            <source src="' . esc_url($foodbakery_section_video_url) . '" type="' . $file_type . '">
                                        </video>
                                    </div>';
			} else {
			    $section_video_element = wp_oembed_get($foodbakery_section_video_url, array('height' => '1083'));
			}
		    } else {
			if (isset($foodbakery_section_bg_color) && $foodbakery_section_bg_color != '') {
			    $section_style_elements .= 'background: ' . esc_attr($foodbakery_section_bg_color) . ';';
			}
		    }
		    $foodbakery_section_padding_top = $column_attributes->foodbakery_section_padding_top;
		    $foodbakery_section_padding_bottom = $column_attributes->foodbakery_section_padding_bottom;
		    if (isset($foodbakery_section_padding_top) && $foodbakery_section_padding_top != '') {
			$section_container_style_elements .= 'padding-top: ' . $foodbakery_section_padding_top . 'px; ';
		    }
		    if (isset($foodbakery_section_padding_bottom) && $foodbakery_section_padding_bottom != '') {
			$section_container_style_elements .= 'padding-bottom: ' . $foodbakery_section_padding_bottom . 'px; ';
		    }
		    $foodbakery_section_custom_style = $column_attributes->foodbakery_section_custom_style;
		    $foodbakery_section_css_id = $column_attributes->foodbakery_section_css_id;
		    if (isset($foodbakery_section_css_id) && trim($foodbakery_section_css_id) != '') {
			$foodbakery_section_css_id = 'id="' . $foodbakery_section_css_id . '"';
		    }

		    $page_element_size = 'section-fullwidth';
		    $foodbakery_layout = $column_attributes->foodbakery_layout;
		    if (!isset($foodbakery_layout) || $foodbakery_layout == '' || $foodbakery_layout == 'none') {
			$foodbakery_layout = "none";
			$page_element_size = 'section-fullwidth col-lg-12 col-md-12 col-sm-12 col-xs-12';
		    } else {
			$page_element_size = 'section-content col-lg-9 col-md-9 col-sm-12 col-xs-12 ';
		    }
		    $foodbakery_sidebar_left = $column_attributes->foodbakery_sidebar_left;
		    $foodbakery_sidebar_right = $column_attributes->foodbakery_sidebar_right;
		}
		if (isset($foodbakery_section_bg_image) && $foodbakery_section_bg_image <> '' && $foodbakery_section_background_option == 'section-custom-background-image') {
		    $css_bg_image = 'url(' . $foodbakery_section_bg_image . ')';
		}

		$section_style_element = '';
		if ($section_style_elements) {
		    $section_style_element = 'style="' . $section_style_elements . '"';
		}
		if ($section_container_style_elements) {
		    $section_container_style_elements = 'style="' . $section_container_style_elements . '"';
		}
		?>
	        <!-- Page Section -->
	        <div <?php echo foodbakery_allow_special_char($foodbakery_section_css_id); ?> class="page-section <?php echo sanitize_html_class($parallax_class); ?>" <?php echo foodbakery_allow_special_char($parallax_data_type); ?>  <?php echo foodbakery_allow_special_char($section_style_element); ?> >
		    <?php
		    echo foodbakery_allow_special_char($section_video_element);
		    if (isset($foodbakery_section_background_option) && $foodbakery_section_background_option == 'section-custom-slider') {
			$foodbakery_section_custom_slider = $column_attributes->foodbakery_section_custom_slider;
			if ($foodbakery_section_custom_slider != '') {
			    echo do_shortcode($foodbakery_section_custom_slider);
			}
		    }
		    if ($foodbakery_page_layout == '' || $foodbakery_page_layout == 'none') {
			if ($foodbakery_section_view == 'container') {
			    $foodbakery_section_view = 'container';
			} else {
			    $foodbakery_section_view = 'wide';
			}
		    } else {
			$foodbakery_section_view = '';
		    }
		    ?>
	    	<!-- Container Start -->
	    	<div class="<?php echo sanitize_html_class($foodbakery_section_view); ?> "> 
			<?php
			if (isset($foodbakery_layout) && ( $foodbakery_layout != '' || $foodbakery_layout != 'none' )) {
			    ?>
			    <div class="row">
				<?php
			    }
			    // start page section
			    if ($foodbakery_var_section_title != '' || $foodbakery_var_section_subtitle != '') {
				?>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				    <div class="cs-section-title" style="margin-bottom:27px;">
					<?php if ($foodbakery_var_section_title != '') { ?>
		    			<h2 style="font-size:24px !important; letter-spacing:1px !important; text-align:center; margin-bottom:20px;"><?php echo esc_html($foodbakery_var_section_title) ?></h2>
					<?php } if ($foodbakery_var_section_subtitle != '') { ?>
		    			<span><?php echo esc_html($foodbakery_var_section_subtitle) ?></span>
					<?php } ?>
				    </div>
				</div>
				<?php
			    }// end page section
			    if (isset($foodbakery_layout) && $foodbakery_layout == "left" && $foodbakery_sidebar_left <> '') {
				echo '<aside class="section-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">';
				if (is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_sidebar_left))) {
				    if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($foodbakery_sidebar_left)) : endif;
				}
				echo '</aside>';
			    }
			    $foodbakery_node_id = 0;
			    echo '<div class="' . ($page_element_size) . ' ">';
			    echo '<div class="row">';

			    foreach ($column_container->children() as $column) {
				$column_no ++;
				$foodbakery_node_id ++;
				foreach ($column->children() as $foodbakery_node) {

				    $foodbakery_elem_id ++;
				    $page_element_size = '100';
				    if (isset($foodbakery_node->page_element_size))
					$page_element_size = $foodbakery_node->page_element_size;
				    echo '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . '">';
				    $shortcode = trim((string) $foodbakery_node->foodbakery_shortcode);
				    $shortcode = html_entity_decode($shortcode);
				    echo do_shortcode($shortcode);
				    echo '</div>';
				}
			    }
			    echo '</div></div>';
			    if (isset($foodbakery_layout) && $foodbakery_layout == "right" && $foodbakery_sidebar_right <> '') {
				echo '<aside class="section-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">';
				if (is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_sidebar_right))) {
				    if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($foodbakery_sidebar_right)) : endif;
				}
				echo '</aside>';
			    }
			    if (isset($foodbakery_layout) && ( $foodbakery_layout != '' || $foodbakery_layout != 'none' )) {
				?>
			    </div>
			    <?php
			}
			?>
	    	</div>
	        </div>
		<?php
		$column_no = 0;
	    }
	    if (isset($foodbakery_page_layout) && $foodbakery_sidebarLayout <> '' && $foodbakery_sidebarLayout <> "none") {

		echo '</div>';
		if (isset($foodbakery_page_layout) && $foodbakery_sidebarLayout <> '' and $foodbakery_sidebarLayout <> "none" and $foodbakery_sidebarLayout == 'right') :
		    if (is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_page_sidebar_right))) {
			?>
		        <aside class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
			    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($foodbakery_page_sidebar_right)) : endif; ?>
		        </aside>
			<?php
		    }
		endif;
		echo '</div>';
		echo '</div>';
	    }
	} else {
	    ?>
	    <div class="container">        
		<!-- Row Start -->
		<div class="row">
		    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?php get_template_part('woocommerce/products-loop', 'page'); ?>
		    </div>
		</div>
	    </div>
	    <?php
	}
	?>
    </div>
    <?php
}
get_footer();
