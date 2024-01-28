<?php
/**
 * Header Functions
 *
 * @package WordPress
 * @subpackage foodbakery
 * @since Auto Mobile 1.0
 */
if (!get_option('foodbakery_var_options')) {
    $foodbakery_activation_data = theme_default_options();
    if (is_array($foodbakery_activation_data) && sizeof($foodbakery_activation_data) > 0) {
	$foodbakery_var_options = $foodbakery_activation_data;
    } else {
	foodbakery_include_file(trailingslashit(get_template_directory()) . 'include/backend/cs-global-variables.php', true);
    }
}

if (!function_exists('foodbakery_custom_pages_menu')) {

    function foodbakery_custom_pages_menu() {
	$cs_menu = wp_list_pages(array(
	    'title_li' => '',
	    'echo' => false,
	));

	echo '<ul>' . foodbakery_allow_special_char($cs_menu) . '</ul>';
    }

}

if (!function_exists('foodbakery_header_main_menu')) {

    function foodbakery_header_main_menu() {

        /* start wordpress importer case only*/
        $menus = wp_get_nav_menus();
        foreach ($menus as $rows){
                if($rows->name == 'All Pages'){
                 $locations = get_theme_mod('nav_menu_locations');
                 $locations['primary'] = $rows->term_id;
                 set_theme_mod( 'nav_menu_locations', $locations );
                 break;
             }
        }
        /* end wordpress importer case only*/

	if (has_nav_menu('primary')) {
	    global $foodbakery_var_options;
	    $custom_id = '';
	    $custom_id = 'site-navigation';
	    ?>
	    <nav id="<?php echo esc_attr($custom_id); ?>" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e(esc_html_e('Primary Menu', 'foodbakery')); ?>">
		<?php
		wp_nav_menu(array(
		    'container' => ' ',
		    'theme_location' => 'primary',
		    'menu_class' => 'primary-menu',
		    'walker' => new foodbakery_mega_menu_walker('main')
		));
		?>
	    </nav><!-- .main-navigation -->
	    <?php
	} else {
	    ?>
	    <nav class="main-navigation" id="main_nav">
		<?php
		wp_nav_menu(array(
		    'theme_location' => '',
		    'fallback_cb' => 'foodbakery_custom_pages_menu',
		));
		?>
	    </nav><!-- .main-navigation -->
	    <?php
	}
    }

}

//Fancy Menu
if (!function_exists('foodbakery_header_fancy_menu_right')) {

    function foodbakery_header_fancy_menu_right() {

	if (has_nav_menu('fancy_right_menu')) {
	    global $foodbakery_var_options;
	    $custom_id = '';
	    $custom_id = 'site-navigation';
	    ?>
	    <nav id="<?php echo esc_attr($custom_id); ?>" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e(esc_html_e('Fancy Right Menu', 'foodbakery')); ?>">
		<?php
		wp_nav_menu(array(
		    'container' => ' ',
		    'theme_location' => 'fancy_right_menu',
		    'menu_class' => 'fancy-right-menu',
		    'walker' => new foodbakery_mega_menu_walker('main')
		));
		?>
	    </nav><!-- .main-navigation -->
	    <?php
	}
    }

}
if (!function_exists('foodbakery_header_fancy_menu_left')) {

    function foodbakery_header_fancy_menu_left() {

	if (has_nav_menu('fancy_left_menu')) {
	    global $foodbakery_var_options;
	    $custom_id = '';
	    $custom_id = 'site-navigation';
	    ?>
	    <nav id="<?php echo esc_attr($custom_id); ?>" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Fancy Left Menu', 'foodbakery'); ?>">
		<?php
		wp_nav_menu(array(
		    'container' => ' ',
		    'theme_location' => 'fancy_left_menu',
		    'menu_class' => 'fancy-left-menu',
		    'walker' => new foodbakery_mega_menu_walker('main')
		));
		?>
	    </nav><!-- .main-navigation -->
	    <?php
	}
    }

}

if (!function_exists('foodbakery_header_mobile_menu')) {

    function foodbakery_header_mobile_menu() {

	if (has_nav_menu('header_mobile_menu')) {
	    global $foodbakery_var_options;
	    $custom_id = '';
	    $custom_id = 'site-navigation';
	    ?>
	    <nav id="<?php echo esc_attr($custom_id); ?>" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Header Mobile Menu', 'foodbakery'); ?>">
		<?php
		wp_nav_menu(array(
		    'container' => ' ',
		    'theme_location' => 'header_mobile_menu',
		    'menu_class' => 'header-mobile-menu',
		    'walker' => new foodbakery_mega_menu_walker('main')
		));
		?>
	    </nav><!-- .main-navigation -->
	    <?php
	}
    }

}

if (!function_exists('foodbakery_header_view_1')) {

    function foodbakery_header_view_1() {
	global $post, $foodbakery_var_options, $foodbakery_var_form_fields;
	$foodbakery_custom_logo = isset($foodbakery_var_options['foodbakery_var_custom_logo']) ? $foodbakery_var_options['foodbakery_var_custom_logo'] : '';
	$foodbakery_logo_height = isset($foodbakery_var_options['foodbakery_var_logo_height']) ? $foodbakery_var_options['foodbakery_var_logo_height'] : '';
	$foodbakery_logo_width = isset($foodbakery_var_options['foodbakery_var_logo_width']) ? $foodbakery_var_options['foodbakery_var_logo_width'] : '';
        
        $foodbakery_menu_style = isset($foodbakery_var_options['foodbakery_var_menu_style']) ? $foodbakery_var_options['foodbakery_var_menu_style'] : 'default';

	$sticky_logo = isset($foodbakery_var_options['foodbakery_var_sticky_logo']) ? $foodbakery_var_options['foodbakery_var_sticky_logo'] : '';
	$sticky_logo_height = isset($foodbakery_var_options['foodbakery_var_sticky_logo_height']) ? $foodbakery_var_options['foodbakery_var_sticky_logo_height'] : '';
	$sticky_logo_width = isset($foodbakery_var_options['foodbakery_var_sticky_logo_width']) ? $foodbakery_var_options['foodbakery_var_sticky_logo_width'] : '';

	$foodbakery_autosidebar = isset($foodbakery_var_options['foodbakery_var_autosidebar']) ? $foodbakery_var_options['foodbakery_var_autosidebar'] : '';
	$foodbakery_var_sticky_header = isset($foodbakery_var_options['foodbakery_var_sticky_header']) ? $foodbakery_var_options['foodbakery_var_sticky_header'] : '';
	$foodbakery_var_transparent_header = isset($foodbakery_var_options['foodbakery_var_transparent_header']) ? $foodbakery_var_options['foodbakery_var_transparent_header'] : '';
	$foodbakery_header_full = isset($foodbakery_var_options['foodbakery_var_full_header']) ? $foodbakery_var_options['foodbakery_var_full_header'] : '';
	$foodbakery_var_header_options = isset($foodbakery_var_options['foodbakery_var_header_options']) ? $foodbakery_var_options['foodbakery_var_header_options'] : '';
	$foodbakery_var_header_class = '';
	if (isset($foodbakery_var_header_options) && $foodbakery_var_header_options == 'fancy') {
	    $foodbakery_var_header_class = ' fancy';
	} elseif (isset($foodbakery_var_header_options) && $foodbakery_var_header_options == 'default') {
	    $foodbakery_var_header_class = ' default';
	} 
        
         elseif (isset($foodbakery_var_header_options) && $foodbakery_var_header_options == 'court') {
	    $foodbakery_var_header_class = ' court';
	}
        
        
        else { 
	    $foodbakery_var_header_class = '';
	}

	if (is_object($post)) {
	    $foodbakery_page_post_header_style = get_post_meta($post->ID, 'foodbakery_var_simple_header', true);
	}
	$foodbakery_page_post_header_style = isset($foodbakery_page_post_header_style) ? $foodbakery_page_post_header_style : '';
	$transparent_header = '';
	if (isset($foodbakery_page_post_header_style) && $foodbakery_page_post_header_style != 'simple_header') {
	    if ($foodbakery_page_post_header_style == 'transparennt_header') {
		$transparent_header = ' transparent-header';
	    }
	}
	if (($transparent_header == '') && (isset($foodbakery_var_transparent_header) && $foodbakery_var_transparent_header == 'on')) {
	    $transparent_header = ' transparent-header';
	}
	if ($foodbakery_header_full == 'on') {
	    $header_con_class = 'wide';
	    $header_extra_class = ' header-full-width';
	} else {
	    $header_con_class = 'container';
	    $header_extra_class = '';
	}
	$sticky_header_class = '';
	if (isset($foodbakery_var_sticky_header) && $foodbakery_var_sticky_header == 'on') {
	    $sticky_header_class = 'sticky-header';
	}
	$style_string = '';
	if ('' !== $foodbakery_logo_width || '' !== $foodbakery_logo_height) {
	    $style_string = 'style="';
	    if ('' !== $foodbakery_logo_width) {
		$style_string .= 'width:' . absint($foodbakery_logo_width) . 'px;';
	    }
	    if ('' !== $foodbakery_logo_height) {
		$style_string .= 'height:' . absint($foodbakery_logo_height) . 'px;';
	    }
	    $style_string .= '"';
	}

	$sticky_style_string = '';
	if ('' !== $sticky_logo_width || '' !== $sticky_logo_height) {
	    $sticky_style_string = 'style="';
	    if ('' !== $sticky_logo_width) {
		$sticky_style_string .= 'width:' . absint($sticky_logo_width) . 'px;';
	    }
	    if ('' !== $sticky_logo_height) {
		$sticky_style_string .= 'height:' . absint($sticky_logo_height) . 'px;';
	    }
	    $sticky_style_string .= '"';
	}

	$all_classes = '';
        $menu_style_css = ( $foodbakery_menu_style == 'fancy')? ' single-slide' : '';
	if ($sticky_header_class != '' || $header_extra_class != '' || $transparent_header != '' || $menu_style_css != '') {
	    $all_classes = 'class="' . ($sticky_header_class) . ($header_extra_class) . ($transparent_header) . ($menu_style_css) . ($foodbakery_var_header_class) . '"';
	}
        
        ?>
            <header id="header" <?php echo foodbakery_allow_special_char($all_classes); ?> >
	    <div class="main-header">
		<div class="<?php echo sanitize_html_class($header_con_class) ?>">
		    <?php if (isset($foodbakery_var_header_options) && $foodbakery_var_header_options != 'fancy' ) { ?>
	    	    <div class="row">
			 <?php if (isset($foodbakery_var_header_options) && $foodbakery_var_header_options != 'court') { ?>
	    		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			 <?php } ?>
			    <?php if (isset($foodbakery_var_header_options) && $foodbakery_var_header_options != 'court') { ?>
                            
                            <?php
                            if( $foodbakery_menu_style == 'fancy'){
                                if ($transparent_header != '') {
                                    ?>
                                    <div class="main-nav mega-menu-item">
                                        <?php foodbakery_header_main_menu(); ?>
                                    </div>
                            
                            
                                    
                                    <?php
                                }
                            }
                            ?>
                            
                            
	    		    <div class="logo">
	    			<figure> 
	    			    <a href="<?php echo esc_url(home_url('/')) ?>" class="light-logo"> 
					    <?php
					    if (get_option('foodbakery_var_options')) {
						?>
						<img src="<?php echo esc_url($foodbakery_custom_logo) ?>" <?php echo foodbakery_allow_special_char($style_string); ?> alt="<?php esc_attr(bloginfo('name')) ?>">
						<?php
					    } else {
						?>
						<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/frontend/images/logo-classic.png') ?>" <?php echo foodbakery_allow_special_char($style_string); ?> alt="<?php esc_attr(bloginfo('name')) ?>">
						<?php
					    }
					    ?>
	    			    </a> 
					<?php
					if ($sticky_logo != '') {
					    ?>
					    <a href="<?php echo esc_url(home_url('/')) ?>" class="dark-logo">
						<img src="<?php echo esc_url($sticky_logo) ?>" <?php echo foodbakery_allow_special_char($sticky_style_string); ?> alt="<?php esc_attr(bloginfo('name')) ?>">
					    </a>
					    <?php
					}
					?>

	    			</figure>
	    		    </div>
			    <?php } ?>
                             <?php if (isset($foodbakery_var_header_options) && $foodbakery_var_header_options == 'court') { ?>
                           
             <div class="main-nav">
				    <?php foodbakery_header_main_menu(); ?>
	    		    </div>
                             <?php }} ?>
			    <?php
			    if ($foodbakery_header_full != 'on' && $transparent_header == '') {
				?>
	    		    <div class="main-nav">
				    <?php foodbakery_header_main_menu(); ?>
	    		    </div>
				<?php
			    }
			    ?>
			    <?php if (isset($foodbakery_var_header_options) && $foodbakery_var_header_options != 'fancy'&& $foodbakery_var_header_options != 'court') { ?>
	    		    <div class="main-location">
	    			<ul>
					<?php do_action('foodbakery_types_dropdown_menu'); ?>
					<?php do_action('foodbakery_location_dropdown'); ?>
					<?php do_action('foodbakery_header_items'); ?>
	    			</ul>
	    		    </div>
			    <?php } ?>
			    <?php
			    if ($foodbakery_header_full == 'on' && $transparent_header == '') {
				?>
	    		    <div class="main-nav">
				    <?php foodbakery_header_main_menu(); ?>
	    		    </div>
				<?php
			    }
			    ?>
			    <?php if (isset($foodbakery_var_header_options) && $foodbakery_var_header_options != 'fancy') { ?>
			     <?php if (isset($foodbakery_var_header_options) && $foodbakery_var_header_options != 'court') { ?>
	    		</div>
		    <?php } }?>
			<?php if (isset($foodbakery_var_header_options) && $foodbakery_var_header_options != 'fancy' && $foodbakery_var_header_options != 'court') { ?>
	    		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
	    		    <div class="login-option">
				    <?php do_action('foodbakery_login') ?>
	    		    </div>
                            
                                <?php
                                if( $foodbakery_menu_style != 'fancy'){
                                    if ($transparent_header != '') {
                                        ?>
                                        <div class="main-nav">
                                            <?php foodbakery_header_main_menu(); ?>
                                        </div>
                                        <?php
                                    }
                                }
				?>
                            
			    <?php } else { ?>
				<?php if (wp_is_mobile() && $foodbakery_var_header_options != 'court') { ?>
				    <div class="main-nav">
					<?php foodbakery_header_mobile_menu(); ?>
				    </div>
				<?php } else { ?>
			    <?php if (isset($foodbakery_var_header_options) && $foodbakery_var_header_options != 'court') { ?>
				    <div class="nav-left wow fadeOutLeft" data-wow-duration="2s">

					<?php if (isset($foodbakery_var_header_options) && $foodbakery_var_header_options == 'fancy') { ?>

					    <?php
					    if ($transparent_header != '') {
						?>
						<div class="main-nav">
						    <?php foodbakery_header_fancy_menu_left(); ?>
						</div>

						<?php
					    }
					}
					?>
				    </div>
				<?php } }
				?>
			    <?php 
                            if (isset($foodbakery_var_header_options) && $foodbakery_var_header_options == 'court' || $foodbakery_var_header_options == 'fancy') { ?>
	    		    <div class="logo">
	    			<figure> 
	    			    <a href="<?php echo esc_url(home_url('/')) ?>" class="light-logo"> 
					    <?php
					    if (get_option('foodbakery_var_options')) {
						?>
						<img src="<?php echo esc_url($foodbakery_custom_logo) ?>" <?php echo foodbakery_allow_special_char($style_string); ?> alt="<?php esc_attr(bloginfo('name')) ?>">
						<?php
					    } else {
						?>
						<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/frontend/images/logo-classic.png') ?>" <?php echo foodbakery_allow_special_char($style_string); ?> alt="<?php esc_attr(bloginfo('name')) ?>">
						<?php
					    }
					    ?>
	    			    </a> 
					<?php
					if ($sticky_logo != '') {
					    ?>
					    <a href="<?php echo esc_url(home_url('/')) ?>" class="dark-logo">
						<img src="<?php echo esc_url($sticky_logo) ?>" <?php echo foodbakery_allow_special_char($sticky_style_string); ?> alt="<?php esc_attr(bloginfo('name')) ?>">
					    </a>
					    <?php
					}
					?>

	    			</figure>
	    		    </div>
			    <?php } ?>
				<?php if (!wp_is_mobile()) { ?>
			     <?php if (isset($foodbakery_var_header_options) && $foodbakery_var_header_options != 'court') { ?>
				    <div class="nav-right wow fadeOutRight" data-wow-duration="2s">
			     <?php }?>
					<?php if (isset($foodbakery_var_header_options) && $foodbakery_var_header_options == 'fancy' ) { ?>

					    <?php
					    if ($transparent_header != '') {
						?>
						<div class="main-nav">
						    <?php foodbakery_header_fancy_menu_right(); ?>
						</div>
						<?php
					    }
					}
				    }
				    ?>
	    			<div class="login-option">
				    <?php do_action('foodbakery_login') ?>
	    			</div>
				<?php if (!wp_is_mobile()) { ?> 
					  <?php if (isset($foodbakery_var_header_options) && $foodbakery_var_header_options != 'court') { ?>
				    </div> 
				<?php } }?>
			    <?php } ?>

			<?php if (isset($foodbakery_var_header_options) && $foodbakery_var_header_options != 'fancy') { ?>
	    		</div>
	<?php } ?>
		    </div>
		</div>
	</header>
        <?php 
    }

}

if (!function_exists('foodbakery_main_header')) {

    function foodbakery_main_header() {

	global $foodbakery_var_options;
	$toggle_sidebar = isset($foodbakery_var_options['foodbakery_var_toggle_sidebar']) ? $foodbakery_var_options['foodbakery_var_toggle_sidebar'] : '';
	foodbakery_header_view_1();
    }

}

if (!function_exists('foodbakery_sticky_header')) {

    function foodbakery_sticky_header() {
	global $foodbakery_var_options;
	$foodbakery_var_sticky_header = isset($foodbakery_var_options['foodbakery_var_sticky_header']) ? $foodbakery_var_options['foodbakery_var_sticky_header'] : '';
	if ($foodbakery_var_sticky_header == 'on') {
	    echo 'has-stick';
	}
    }

    add_action('foodbakery_sticky_class', 'foodbakery_sticky_header');
}


if (!function_exists('foodbakery_var_subheader_style')) {

    function foodbakery_var_subheader_style($foodbakery_var_post_ID = '') {
	global $post, $wp_query, $foodbakery_var_options, $foodbakery_var_post_meta;
	$post_type = get_post_type(get_the_ID());
	$foodbakery_var_post_ID = get_the_ID();
	if (is_search() || is_category() || is_home() || is_404() || is_archive()) {
	    $foodbakery_var_post_ID = '';
	}
	$meta_element = 'foodbakery_full_data';
	$foodbakery_var_post_meta = get_post_meta((int) $foodbakery_var_post_ID, "$meta_element", true);
	$foodbakery_var_header_banner_style = get_post_meta((int) $foodbakery_var_post_ID, "foodbakery_var_header_banner_style", true);
        if( $foodbakery_var_header_banner_style == 'default_header'){
            $foodbakery_var_header_banner_style = foodbakery_get_page_settings($foodbakery_var_post_ID, "foodbakery_var_header_banner_style");
        }

	if (isset($foodbakery_var_header_banner_style) && $foodbakery_var_header_banner_style == 'no-header') {
	    $foodbakery_var_header_border_color = get_post_meta((int) $foodbakery_var_post_ID, "foodbakery_var_main_header_border_color", true);
	    if ($foodbakery_var_header_border_color <> '') {
		$foodbakery_header_border_style = '
				#header {
                    border-bottom: 1px solid ' . $foodbakery_var_header_border_color . ';
                }';
		foodbakery_var_dynamic_scripts('foodbakery_header_border_style', 'css', $foodbakery_header_border_style);
	    }
	    //echo '<div class="cs-no-subheader"></div>';
	} else if (isset($foodbakery_var_header_banner_style) && $foodbakery_var_header_banner_style == 'breadcrumb_header') {

	    foodbakery_var_breadcrumb_page_setting($foodbakery_var_post_ID);
	} else if (isset($foodbakery_var_header_banner_style) && $foodbakery_var_header_banner_style == 'custom_slider') {

	    foodbakery_var_rev_slider('pages', $foodbakery_var_post_ID);
	} else if (isset($foodbakery_var_header_banner_style) && $foodbakery_var_header_banner_style == 'map') {

	    foodbakery_var_page_map($foodbakery_var_post_ID);
	} else if (isset($foodbakery_var_options['foodbakery_var_default_header'])) {
	    if ($foodbakery_var_options['foodbakery_var_default_header'] == 'no_header') {
		$foodbakery_var_header_border_color = isset($foodbakery_var_options['foodbakery_var_header_border_color']) ? $foodbakery_var_options['foodbakery_var_header_border_color'] : '';
		if ($foodbakery_var_header_border_color <> '') {
		    $foodbakery_header_border_style = '
                    #header .cs-main-nav .pinned {
                        border-bottom: 1px solid ' . $foodbakery_var_header_border_color . ';
                    }';
		    foodbakery_var_dynamic_scripts('foodbakery_header_border_style', 'css', $foodbakery_header_border_style);
		}
	    } else if ($foodbakery_var_options['foodbakery_var_default_header'] == 'breadcrumbs_sub_header') {
		foodbakery_var_breadcrumb_theme_option($foodbakery_var_post_ID);
	    } else if ($foodbakery_var_options['foodbakery_var_default_header'] == 'slider') {

		foodbakery_var_rev_slider('default-pages', $foodbakery_var_post_ID);
	    }
	}
    }

}

/*
 * Start Rev slider function
 */

if (!function_exists('foodbakery_var_rev_slider')) {

    function foodbakery_var_rev_slider($foodbakery_var_slider_type = '', $foodbakery_var_post_ID = '') {
	global $post, $post_meta, $foodbakery_var_options;

	if ($foodbakery_var_slider_type == 'pages') {
	    $foodbakery_var_rev_slider_id = get_post_meta((int) $foodbakery_var_post_ID, "foodbakery_var_custom_slider_id", true);
	} else {
	    $foodbakery_var_rev_slider_id = isset($foodbakery_var_options['foodbakery_var_custom_slider']) ? $foodbakery_var_options['foodbakery_var_custom_slider'] : '';
	}
	if (isset($foodbakery_var_rev_slider_id) && $foodbakery_var_rev_slider_id != '') {
	    ?>
	    <div class="cs-banner"> <?php echo do_shortcode("[rev_slider alias=\"{$foodbakery_var_rev_slider_id}\"]"); ?> </div>
	    <?php
	}
    }

}

/*
 * Start page map function
 */

if (!function_exists('foodbakery_var_page_map')) {

    function foodbakery_var_page_map($foodbakery_var_post_ID = '') {
	global $post, $post_meta, $header_map;
	$foodbakery_var_custom_map = get_post_meta((int) $foodbakery_var_post_ID, "foodbakery_var_custom_map", true);
	if (empty($foodbakery_var_custom_map)) {
	    $foodbakery_var_custom_map = "";
	} else {
	    $foodbakery_var_custom_map = html_entity_decode($foodbakery_var_custom_map);
	}
	if (isset($foodbakery_var_custom_map) && $foodbakery_var_custom_map != '') {
	    $header_map = true;
	    ?>
	    <div class="cs-fullmap"> <?php echo do_shortcode($foodbakery_var_custom_map); ?> </div>
	    <?php
	}
    }

}

/**
 * @subheader page 
 * setting breadcrums
 */
if (!function_exists('foodbakery_var_breadcrumb_page_setting')) {

    function foodbakery_var_breadcrumb_page_setting() {
	global $post, $wp_query, $foodbakery_var_options, $post_meta;
	$meta_element = 'foodbakery_full_data';
	$foodbakery_var_post_ID = get_the_ID();
	if (function_exists('is_shop')) {
	    if (is_shop()) {
		$foodbakery_var_post_ID = wc_get_page_id('shop');
	    }
	}
	$post_meta = get_post_meta((int) $foodbakery_var_post_ID, "$meta_element", true);

	$foodbakery_var_sub_header_style = get_post_meta((int) $foodbakery_var_post_ID, "foodbakery_var_sub_header_style", true);
	$foodbakery_var_sub_header_sub_hdng = get_post_meta((int) $foodbakery_var_post_ID, "foodbakery_var_page_subheading_title", true);
	$foodbakery_var_header_banner_image = get_post_meta((int) $foodbakery_var_post_ID, "foodbakery_var_header_banner_image", true);
	$foodbakery_var_page_subheader_parallax = get_post_meta((int) $foodbakery_var_post_ID, "foodbakery_var_page_subheader_parallax", true);
	$foodbakery_var_page_subheader_color = get_post_meta((int) $foodbakery_var_post_ID, "foodbakery_var_page_subheader_color", true);
	$foodbakery_var_page_title_switch = get_post_meta((int) $foodbakery_var_post_ID, "foodbakery_var_page_title_switch", true);
	$foodbakery_var_sub_header_align = get_post_meta((int) $foodbakery_var_post_ID, "foodbakery_var_sub_header_align", true);
	$foodbakery_var_page_breadcrumbs = get_post_meta((int) $foodbakery_var_post_ID, "foodbakery_var_page_breadcrumbs", true);
	$foodbakery_var_subheader_padding_top = get_post_meta((int) $foodbakery_var_post_ID, "foodbakery_var_subheader_padding_top", true);
	$foodbakery_var_subheader_padding_bottom = get_post_meta((int) $foodbakery_var_post_ID, "foodbakery_var_subheader_padding_bottom", true);
	$foodbakery_var_subheader_margin_top = get_post_meta((int) $foodbakery_var_post_ID, "foodbakery_var_subheader_margin_top", true);
	$foodbakery_var_subheader_margin_bottom = get_post_meta((int) $foodbakery_var_post_ID, "foodbakery_var_subheader_margin_bottom", true);
	$foodbakery_var_page_subheader_text_color = get_post_meta((int) $foodbakery_var_post_ID, "foodbakery_var_page_subheader_text_color", true);

	$foodbakery_all_fields = array(
	    'foodbakery_var_post_ID' => $foodbakery_var_post_ID,
	    'foodbakery_var_sub_header_style' => $foodbakery_var_sub_header_style,
	    'foodbakery_var_sub_header_sub_hdng' => $foodbakery_var_sub_header_sub_hdng,
	    'foodbakery_var_header_banner_image' => $foodbakery_var_header_banner_image,
	    'foodbakery_var_page_subheader_parallax' => $foodbakery_var_page_subheader_parallax,
	    'foodbakery_var_page_subheader_color' => $foodbakery_var_page_subheader_color,
	    'foodbakery_var_sub_header_align' => $foodbakery_var_sub_header_align,
	    'foodbakery_var_page_title_switch' => $foodbakery_var_page_title_switch,
	    'foodbakery_var_page_breadcrumbs' => $foodbakery_var_page_breadcrumbs,
	    'foodbakery_var_subheader_padding_top' => $foodbakery_var_subheader_padding_top,
	    'foodbakery_var_subheader_padding_bottom' => $foodbakery_var_subheader_padding_bottom,
	    'foodbakery_var_subheader_margin_top' => $foodbakery_var_subheader_margin_top,
	    'foodbakery_var_subheader_margin_bottom' => $foodbakery_var_subheader_margin_bottom,
	    'foodbakery_var_page_subheader_text_color' => $foodbakery_var_page_subheader_text_color,
	);
	foodbakery_var_breadcrumb_markup($foodbakery_all_fields);
    }

}

/**
 * @subheader page 
 * breadcrums settings
 */
if (!function_exists('foodbakery_var_breadcrumb_theme_option')) {

    function foodbakery_var_breadcrumb_theme_option() {
	global $foodbakery_var_options;
	$foodbakery_var_post_ID = get_the_ID();
	if (function_exists('is_shop')) {
	    if (is_shop()) {
		$foodbakery_var_post_ID = wc_get_page_id('shop');
	    }
	}

	$foodbakery_var_sub_header_style = isset($foodbakery_var_options['foodbakery_var_sub_header_style']) ? $foodbakery_var_options['foodbakery_var_sub_header_style'] : '';
	$foodbakery_var_sub_header_sub_hdng = isset($foodbakery_var_options['foodbakery_var_sub_header_sub_hdng']) ? $foodbakery_var_options['foodbakery_var_sub_header_sub_hdng'] : '';
	$foodbakery_var_header_banner_image = isset($foodbakery_var_options['foodbakery_var_sub_header_bg_img']) ? $foodbakery_var_options['foodbakery_var_sub_header_bg_img'] : '';
	$foodbakery_var_page_subheader_parallax = isset($foodbakery_var_options['foodbakery_var_sub_header_parallax']) ? $foodbakery_var_options['foodbakery_var_sub_header_parallax'] : '';
	$foodbakery_var_page_subheader_color = isset($foodbakery_var_options['foodbakery_var_sub_header_bg_clr']) ? $foodbakery_var_options['foodbakery_var_sub_header_bg_clr'] : '';
	$foodbakery_var_page_title_switch = isset($foodbakery_var_options['foodbakery_var_page_title_switch']) ? $foodbakery_var_options['foodbakery_var_page_title_switch'] : '';
	$foodbakery_var_sub_header_align = isset($foodbakery_var_options['foodbakery_var_sub_header_align']) ? $foodbakery_var_options['foodbakery_var_sub_header_align'] : '';
	$foodbakery_var_page_breadcrumbs = isset($foodbakery_var_options['foodbakery_var_breadcrumbs_switch']) ? $foodbakery_var_options['foodbakery_var_breadcrumbs_switch'] : '';
	$foodbakery_var_subheader_padding_top = isset($foodbakery_var_options['foodbakery_var_sh_paddingtop']) ? $foodbakery_var_options['foodbakery_var_sh_paddingtop'] : '';
	$foodbakery_var_subheader_padding_bottom = isset($foodbakery_var_options['foodbakery_var_sh_paddingbottom']) ? $foodbakery_var_options['foodbakery_var_sh_paddingbottom'] : '';
	$foodbakery_var_subheader_margin_top = isset($foodbakery_var_options['foodbakery_var_sh_margintop']) ? $foodbakery_var_options['foodbakery_var_sh_margintop'] : '';
	$foodbakery_var_subheader_margin_bottom = isset($foodbakery_var_options['foodbakery_var_sh_marginbottom']) ? $foodbakery_var_options['foodbakery_var_sh_marginbottom'] : '';
	$foodbakery_var_page_subheader_text_color = isset($foodbakery_var_options['foodbakery_var_sub_header_text_color']) ? $foodbakery_var_options['foodbakery_var_sub_header_text_color'] : '';

	$foodbakery_all_fields = array(
	    'foodbakery_var_post_ID' => $foodbakery_var_post_ID,
	    'foodbakery_var_sub_header_style' => $foodbakery_var_sub_header_style,
	    'foodbakery_var_sub_header_sub_hdng' => $foodbakery_var_sub_header_sub_hdng,
	    'foodbakery_var_header_banner_image' => $foodbakery_var_header_banner_image,
	    'foodbakery_var_page_subheader_parallax' => $foodbakery_var_page_subheader_parallax,
	    'foodbakery_var_page_subheader_color' => $foodbakery_var_page_subheader_color,
	    'foodbakery_var_page_title_switch' => $foodbakery_var_page_title_switch,
	    'foodbakery_var_sub_header_align' => $foodbakery_var_sub_header_align,
	    'foodbakery_var_page_breadcrumbs' => $foodbakery_var_page_breadcrumbs,
	    'foodbakery_var_subheader_padding_top' => $foodbakery_var_subheader_padding_top,
	    'foodbakery_var_subheader_padding_bottom' => $foodbakery_var_subheader_padding_bottom,
	    'foodbakery_var_subheader_margin_top' => $foodbakery_var_subheader_margin_top,
	    'foodbakery_var_subheader_margin_bottom' => $foodbakery_var_subheader_margin_bottom,
	    'foodbakery_var_page_subheader_text_color' => $foodbakery_var_page_subheader_text_color,
	);

	$foodbakery_sub_header_view = true;

	if ($foodbakery_sub_header_view == true) {
	    foodbakery_var_breadcrumb_markup($foodbakery_all_fields);
	}
    }

}

/**
 * @subheader styles 
 * markup
 */
if (!function_exists('foodbakery_var_breadcrumb_markup')) {

    function foodbakery_var_breadcrumb_markup($foodbakery_fields = array()) {

	extract($foodbakery_fields);
	global $post, $foodbakery_plugin_options;
	$foodbakery_sub_style = '';
	$foodbakery_var_sub_header_align = isset($foodbakery_var_sub_header_align) ? $foodbakery_var_sub_header_align : 'pull-left';

	if (!get_option('foodbakery_var_options')) {
	    $foodbakery_var_header_banner_image = esc_url(get_template_directory_uri() . '/assets/frontend/images/subheader-img.jpg');
	}

	if ($foodbakery_var_header_banner_image != '' && $foodbakery_var_sub_header_style == 'with_bg') {
	    $foodbakery_var_parallax_fixed = $foodbakery_var_page_subheader_parallax == 'on' ? ' fixed' : '';

	    $foodbakery_sub_style .= ' background:url(' . $foodbakery_var_header_banner_image . ') ' . $foodbakery_var_page_subheader_color . ' no-repeat' . $foodbakery_var_parallax_fixed . ' ;';
	    $foodbakery_sub_style .= ' background-size: cover;';
	} else if ($foodbakery_var_page_subheader_color != '' && ($foodbakery_var_sub_header_style == 'with_bg' || $foodbakery_var_sub_header_style == 'classic')) {
	    $foodbakery_sub_style .= ' background:' . $foodbakery_var_page_subheader_color . ';';
	}
	if ($foodbakery_var_subheader_padding_top != '') {
	    $foodbakery_sub_style .= ' padding-top: ' . esc_html($foodbakery_var_subheader_padding_top) . 'px;';
	}
	if ($foodbakery_var_subheader_padding_bottom != '') {
	    $foodbakery_sub_style .= ' padding-bottom: ' . esc_html($foodbakery_var_subheader_padding_bottom) . 'px;';
	}
	if ($foodbakery_var_subheader_margin_top != '') {
	    $foodbakery_sub_style .= ' margin-top: ' . esc_html($foodbakery_var_subheader_margin_top) . 'px;';
	}
	if ($foodbakery_var_subheader_margin_bottom != '') {
	    $foodbakery_sub_style .= ' margin-bottom: ' . esc_html($foodbakery_var_subheader_margin_bottom) . 'px;';
	}

	if ($foodbakery_var_header_banner_image != '') {
	    $foodbakery_upload_dir = wp_upload_dir();
	    $foodbakery_upload_baseurl = isset($foodbakery_upload_dir['baseurl']) ? $foodbakery_upload_dir['baseurl'] . '/' : '';

	    $foodbakery_upload_dir = isset($foodbakery_upload_dir['basedir']) ? $foodbakery_upload_dir['basedir'] . '/' : '';

	    if (false !== strpos($foodbakery_var_header_banner_image, $foodbakery_upload_baseurl)) {
		$foodbakery_upload_subdir_file = str_replace($foodbakery_upload_baseurl, '', $foodbakery_var_header_banner_image);
	    }

	    $foodbakery_images_dir = trailingslashit(get_template_directory()) . 'assets/frontend/images/';

	    $foodbakery_img_name = preg_replace('/^.+[\\\\\\/]/', '', $foodbakery_var_header_banner_image);

		if (!get_option('foodbakery_var_options')) {
		    $foodbakery_var_header_banner_image = get_theme_file_path() . '/assets/frontend/images/subheader-img.jpg';
		}

if (!get_option('foodbakery_var_options')) {
	    $foodbakery_var_header_banner_image = get_theme_file_path() . '/assets/frontend/images/subheader-img.jpg';
}

	    if (is_file($foodbakery_upload_dir . $foodbakery_img_name) || is_file($foodbakery_images_dir . $foodbakery_img_name)) {
		if (ini_get('allow_url_fopen')) {
		    $foodbakery_var_header_image_height = file_exists( $foodbakery_var_header_banner_image )? getimagesize($foodbakery_var_header_banner_image) : '';
		}
	    } else if (isset($foodbakery_upload_subdir_file) && is_file($foodbakery_upload_dir . $foodbakery_upload_subdir_file)) {
		if (ini_get('allow_url_fopen')) {
		    $foodbakery_var_header_image_height = file_exists( $foodbakery_var_header_banner_image )? getimagesize($foodbakery_var_header_banner_image) : '';
		}
	    } else {
		$foodbakery_var_header_image_height = '';
	    }

	    if (isset($foodbakery_var_header_image_height[1]) && $foodbakery_var_header_image_height[1] != '') {
		$foodbakery_var_header_image_height = $foodbakery_var_header_image_height[1] . 'px';
		$foodbakery_sub_style .= ' min-height: ' . foodbakery_allow_special_char($foodbakery_var_header_image_height) . ' !important;';
	    }
	}
	$post_type = '';
	if (!is_author() && !is_404()) {
	    if ($post != '') {
		$post_type = isset($post->ID) ? get_post_type($post->ID) : '';
	    }
	}
	if ($foodbakery_var_sub_header_align == '') {
	    $foodbakery_var_sub_header_align = 'pull-left';
	}

	$sub_header_align = '';
	if ($foodbakery_var_sub_header_align == 'center') {
	    $sub_header_align = ' center';
	} elseif ($foodbakery_var_sub_header_align == 'right') {
	    $sub_header_align = ' pull-right';
	} elseif ($foodbakery_var_sub_header_align == 'left') {
	    $sub_header_align = ' pull-left';
	}

	$foodbakery_dashboard_page = isset($foodbakery_plugin_options['foodbakery_publisher_dashboard']) ? $foodbakery_plugin_options['foodbakery_publisher_dashboard'] : '';

	$is_foodbakery_dashboard = false;
	if ($foodbakery_dashboard_page == get_the_id()) {
	    $is_foodbakery_dashboard = true;
	}

	if (!is_404() && !is_singular('restaurants')) {
	    if ($foodbakery_var_sub_header_style == 'with_bg') {
		?>
		<div class="sub-header align-center">
		    <div class="subheader-holder" <?php if ($foodbakery_sub_style != '') { ?> style="<?php echo foodbakery_allow_special_char($foodbakery_sub_style) ?>"<?php } ?>>
			<div class="container">
			    <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				    <div class="text-holder">
					<div class="page-title <?php echo sanitize_html_class($sub_header_align); ?>">
					    <?php if ($foodbakery_var_page_title_switch == "on") { ?>
		    			    <h1<?php if ($foodbakery_var_page_subheader_text_color != '') { ?> style="color:<?php echo esc_html($foodbakery_var_page_subheader_text_color); ?> !important;"<?php } ?>><?php foodbakery_post_page_title(); ?></h1>
					<?php } ?>
					</div>
					<?php if ($foodbakery_var_sub_header_sub_hdng != '') { ?>
		    			<p <?php if ($foodbakery_var_page_subheader_text_color != '') { ?> style="color:<?php echo esc_html($foodbakery_var_page_subheader_text_color); ?> !important;"<?php } ?>><?php echo do_shortcode($foodbakery_var_sub_header_sub_hdng) ?></p>
		<?php } ?>

				    </div>
				</div>
			    </div>
			</div>
		    </div>
		    <?php
		    if ($foodbakery_var_page_breadcrumbs == "on") {
			foodbakery_breadcrumbs();
		    }
		    ?>
		</div>
		<?php
	    } else {
		?>				
		<div class="sub-header align-center">
		    <div  class="subheader-holder"<?php if ($foodbakery_sub_style != '') { ?> style="<?php echo foodbakery_allow_special_char($foodbakery_sub_style) ?>"<?php } ?>>
			<div class="container">
			    <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				    <div class="text-holder">
		<?php if ($foodbakery_var_page_title_switch == "on") { ?>
		    			<div  class="cs-page-title <?php echo sanitize_html_class($sub_header_align); ?>">
		    			    <h1<?php if ($foodbakery_var_page_subheader_text_color != '') { ?> style="color:<?php echo esc_html($foodbakery_var_page_subheader_text_color); ?> !important;"<?php } ?>><?php foodbakery_post_page_title(); ?></h1>
		    			</div>
					    <?php
					}
					?>
				    </div>
				</div>
			    </div>
			</div>
		    </div>
		    <?php
		    if ($foodbakery_var_page_breadcrumbs == "on") {
			foodbakery_breadcrumbs();
		    }
		    ?>

		</div>
		<?php
	    }
	}
    }

}