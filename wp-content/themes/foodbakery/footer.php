<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Foodbakery
 * @since Foodbakery 1.0
 */
$foodbakery_var_options = FOODBAKERY_VAR_GLOBALS()->theme_options();
$foodbakery_var_footer_switch = isset($foodbakery_var_options['foodbakery_var_footer_switch']) ? $foodbakery_var_options['foodbakery_var_footer_switch'] : '';
$foodbakery_var_footer_style = isset($foodbakery_var_options['foodbakery_var_footer_style']) ? $foodbakery_var_options['foodbakery_var_footer_style'] : '';
$foodbakery_var_footer_widget = isset($foodbakery_var_options['foodbakery_var_footer_widget']) ? $foodbakery_var_options['foodbakery_var_footer_widget'] : '';
$foodbakery_var_copy_write_section = isset($foodbakery_var_options['foodbakery_var_copy_write_section']) ? $foodbakery_var_options['foodbakery_var_copy_write_section'] : '';
$foodbakery_var_copy_right = isset($foodbakery_var_options['foodbakery_var_copy_right']) ? $foodbakery_var_options['foodbakery_var_copy_right'] : '';
$foodbakery_var_right_logos_section = isset($foodbakery_var_options['foodbakery_var_right_logos_section']) ? $foodbakery_var_options['foodbakery_var_right_logos_section'] : '';
$foodbakery_var_right_logos = isset($foodbakery_var_options['foodbakery_var_right_logos']) ? $foodbakery_var_options['foodbakery_var_right_logos'] : '';
$foodbakery_var_footer_contact_no = isset($foodbakery_var_options['foodbakery_var_footer_contact_no']) ? $foodbakery_var_options['foodbakery_var_footer_contact_no'] : '';
$foodbakery_var_footer_menu = isset($foodbakery_var_options['foodbakery_var_footer_menu']) ? $foodbakery_var_options['foodbakery_var_footer_menu'] : '';
$foodbakery_var_back_to_top = isset($foodbakery_var_options['foodbakery_var_back_to_top']) ? $foodbakery_var_options['foodbakery_var_back_to_top'] : '';
$foodbakery_var_custom_footer_background = isset($foodbakery_var_options['foodbakery_var_custom_footer_background']) ? $foodbakery_var_options['foodbakery_var_custom_footer_background'] : '';
$foodbakery_var_custom_footer_image = isset($foodbakery_var_options['foodbakery_var_custom_footer_image']) ? $foodbakery_var_options['foodbakery_var_custom_footer_image'] : '';
$the_global_vars = array('foodbakery_var_frame_options', 'foodbakery_var_static_text');
$foodbakery_var_options_vars = FOODBAKERY_VAR_GLOBALS()->globalizing($the_global_vars);
extract($foodbakery_var_options_vars);
$foodbakery_var_maintenance_footer_switch = isset($foodbakery_var_options['foodbakery_var_maintenance_footer_switch']) ? $foodbakery_var_options['foodbakery_var_maintenance_footer_switch'] : '';
$foodbakery_var_maintinance_mode_page = isset($foodbakery_var_options['foodbakery_var_maintinance_mode_page']) ? $foodbakery_var_options['foodbakery_var_maintinance_mode_page'] : '';
if ('on' === $foodbakery_var_footer_switch) {
    if ('on' == $foodbakery_var_maintenance_footer_switch && get_the_id() == $foodbakery_var_maintinance_mode_page) {
	echo '<div class="cs-nofooter"></div>';
    } else {
	?>
	<footer id="footer" class="<?php echo esc_html($foodbakery_var_footer_style); ?>">
	    <?php
	    if ('on' === $foodbakery_var_footer_widget) {
		$footer_sidebar_list = array();
		$foodbakery_footer_sidebar_width = '';
		if (isset($foodbakery_var_options) and isset($foodbakery_var_options['foodbakery_var_footer_sidebar'])) {
		    if (is_array($foodbakery_var_options['foodbakery_var_footer_sidebar']) and count($foodbakery_var_options['foodbakery_var_footer_sidebar']) > 0) {
			$foodbakery_footer_sidebar = array('foodbakery_var_footer_sidebar' => $foodbakery_var_options['foodbakery_var_footer_sidebar']);
		    } else {
			$foodbakery_footer_sidebar = array('foodbakery_var_footer_sidebar' => array());
		    }
		} else {
		    $foodbakery_footer_sidebar = isset($foodbakery_var_footer_sidebar) ? $foodbakery_var_footer_sidebar : '';
		}
		$cssidebar = false;
		$i = 0;
		if (isset($foodbakery_footer_sidebar['foodbakery_var_footer_sidebar']) && is_array($foodbakery_footer_sidebar['foodbakery_var_footer_sidebar'])) {
		    foreach ($foodbakery_footer_sidebar['foodbakery_var_footer_sidebar'] as $footer_sidebar_var => $footer_sidebar_val) {
			$footer_sidebar_list[$footer_sidebar_var] = $footer_sidebar_val;
			$foodbakery_footer_sidebar_width = substr($foodbakery_var_options['foodbakery_var_footer_width'][$i], 0, 2);
			$footer_sidebar_id = sanitize_title($footer_sidebar_val);
			if (is_active_sidebar($footer_sidebar_id)) {
			    $cssidebar = true;
			}
			$i ++;
		    }
		}
		$footer_bg_image = '';
		if (true === $cssidebar) {
		    if (isset($foodbakery_var_custom_footer_background) && $foodbakery_var_custom_footer_background != '') {
			$footer_bg_image = 'style="background:url(' . esc_url($foodbakery_var_custom_footer_background) . ') no-repeat !important;"';
		    }
		    ?>
		    <?php if ('on' === $foodbakery_var_back_to_top) { ?>
		        <div class="btn-top bgcolor">
		    	<div class="container">
		    	    <div class="row">
		    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		    		    <a class="back-to-top" href="javascript:void(0);"><i class="icon-keyboard_arrow_up bounce text-color"></i><?php echo esc_html(foodbakery_var_theme_text_srt('foodbakery_var_theme_option_back_to_top')); ?></a>
		    		</div>
		    	    </div>
		    	</div>
		        </div>
		    <?php } ?>
		    <div class="footer-widget" <?php echo foodbakery_allow_special_char($footer_bg_image); ?> >

			<div class="container">

			    <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				    <div class="row">
					<?php
					$i = 0;
					if (isset($foodbakery_footer_sidebar['foodbakery_var_footer_sidebar'])) {
					    if (is_array($foodbakery_footer_sidebar['foodbakery_var_footer_sidebar'])) {
						foreach ($foodbakery_footer_sidebar['foodbakery_var_footer_sidebar'] as $footer_sidebar_var => $footer_sidebar_val) {
						    $footer_sidebar_list[$footer_sidebar_var] = $footer_sidebar_val;
						    $foodbakery_footer_sidebar_width = intval(substr($foodbakery_var_options['foodbakery_var_footer_width'][$i], 0, 2));
						    $footer_sidebar_id = sanitize_title($footer_sidebar_val);
						    $footer_side = '';
						    if (2 === $foodbakery_footer_sidebar_width) {
							$footer_side = 'col-lg-2 col-md-2 col-sm-6 col-xs-12';
						    } elseif (3 === $foodbakery_footer_sidebar_width) {
							$footer_side = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
						    } elseif (4 === $foodbakery_footer_sidebar_width) {
							$footer_side = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
						    } elseif (6 === $foodbakery_footer_sidebar_width) {
							$footer_side = 'col-lg-6 col-md-6 col-sm-12 col-xs-12';
						    } elseif (8 === $foodbakery_footer_sidebar_width) {
							$footer_side = 'col-lg-8 col-md-8 col-sm-12 col-xs-12';
						    } elseif (9 === $foodbakery_footer_sidebar_width) {
							$footer_side = 'col-lg-9 col-md-9 col-sm-12 col-xs-12';
						    } elseif (10 === $foodbakery_footer_sidebar_width) {
							$footer_side = 'col-lg-10 col-md-10 col-sm-12 col-xs-12';
						    } else {
							$footer_side = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
						    }
						    if (is_active_sidebar(foodbakery_get_sidebar_id($footer_sidebar_id))) {
							echo '<div class="' . esc_attr($footer_side) . '">';
							dynamic_sidebar($footer_sidebar_id);
                                                        if($footer_sidebar_id == 'about-us'){?>
                                                            <ul class="social-media">
                                        <?php echo foodbakery_social_share_blog(); ?>
                                    </ul>
                                                        <?php  } 
                                                      
							echo '</div>';
						    }
						    $i ++;
						}
					    }
					}
					?>
				    </div>
				</div>
			    </div>

			</div>

		    </div> <!-- /.cs-footer-widgets -->
		<?php } ?>
	    <?php } ?>
	    <?php if (('on' === $foodbakery_var_copy_write_section && '' !== $foodbakery_var_copy_right) || ($foodbakery_var_right_logos_section == 'on' && $foodbakery_var_right_logos != '' )) { ?>
	        <div class="copyright-sec">
	    	<div class="container">
	    	    <div class="row">
	    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			    
	    		    <div class="copyright-inner">
				    <?php
				    if (isset($foodbakery_var_footer_style) && ($foodbakery_var_footer_style == 'footer-style-3'|| $foodbakery_var_footer_style == 'footer-style-4')) {
					?>
					<div class="footer-logo">
					    <a href="#"><img src="<?php echo foodbakery_allow_special_char($foodbakery_var_custom_footer_image); ?>" /></a>
					</div>
				    <?php } ?>
                                
				    <?php if ('on' === $foodbakery_var_copy_write_section && '' !== $foodbakery_var_copy_right) { ?>
					<div class="copy-right">
					    <p>
						<?php
						$foodbakery_allowed_tags = array(
						    'a' => array('href' => array(), 'class' => array()),
						    'b' => array(),
						    'i' => array('class' => array()),
						);
						echo wp_kses(wp_specialchars_decode($foodbakery_var_copy_right), $foodbakery_allowed_tags);
						?>
					    </p>

					</div>
				<?php  if (isset($foodbakery_var_footer_style) && ($foodbakery_var_footer_style == 'footer-style-3')) {?>
				<ul class="social-media">
                                        <?php echo foodbakery_social_share_blog(); ?>
                                    </ul>
				<?php } ?>
				    <?php } ?>
				    <?php if ($foodbakery_var_right_logos_section == 'on' && $foodbakery_var_right_logos != '') { ?>
					<div class="right-logos">
					    <p>
						<?php
						$foodbakery_allowed_tags = array(
						    'a' => array('href' => array(), 'class' => array()),
						    'b' => array(),
						    'i' => array('class' => array()),
						    'img' => array('src' => array(), 'alt' => array(), 'class' => array()),
						);
						echo wp_kses(wp_specialchars_decode($foodbakery_var_right_logos), $foodbakery_allowed_tags);
						?>
					    </p>

					</div>
				    <?php } ?>
	    		    </div>
	    		</div>
	    	    </div>
	    	</div>
	        </div> <!-- /.cs-copyright -->
	    <?php } ?>
	</footer> <!-- /#footer -->
    <?php } ?>
<?php } ?>
</div> <!-- /.wrapper -->
<?php wp_footer(); ?>
</body>
</html>
