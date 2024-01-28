<?php
/**
 * Foodbakery_Flickr Class
 *
 * @package Foodbakery
 */
if (!class_exists('Foodbakery_contact')) {

    /**
      Foodbakery_contact class used to implement the custom contact widget.
     */
    class Foodbakery_contact extends WP_Widget {

	/**
	 * Sets up a new foodbakery contact widget instance.
	 */
	public function __construct() {
	    global $foodbakery_var_static_text;
	    foodbakery_var_theme_text_srt('foodbakery_var_contact_description');
	    parent::__construct(
		    'foodbakery_contact', // Base ID.
		    foodbakery_var_theme_text_srt('foodbakery_var_contact'), // Name.
		    array('classname' => 'widget-connect', 'description' => foodbakery_var_theme_text_srt('foodbakery_var_contact_description'),)
	    );
	}

	/**
	 * Outputs the foodbakery contact widget settings form.
	 *
	 * @param array $instance current settings.
	 */
	function form($instance) {
	    global $foodbakery_var_form_fields, $foodbakery_var_html_fields, $foodbakery_var_static_text;

	    $cs_rand_id = rand(23789, 934578930);
	    $instance = wp_parse_args((array) $instance, array('title' => '', 'contact_code' => ''));
	    $title = $instance['title'];
	    $address_content = isset($instance['address_content']) ? esc_attr($instance['address_content']) : '';
	    $contact_code = $instance['contact_code'];
	    $phone = isset($instance['phone']) ? esc_attr($instance['phone']) : '';
	    $showcount = isset($instance['showcount']) ? esc_attr($instance['showcount']) : '';
	    $email = isset($instance['email']) ? esc_attr($instance['email']) : '';
	    $description = isset($instance['description']) ? esc_attr($instance['description']) : '';
	    $contact_logo = isset($instance['contact_logo']) ? esc_attr($instance['contact_logo']) : '';

	    $tw_url = isset($instance['tw_url']) ? esc_url($instance['tw_url']) : '';
	    $lk_url = isset($instance['lk_url']) ? esc_url($instance['lk_url']) : '';
	    $pn_url = isset($instance['pn_url']) ? esc_url($instance['pn_url']) : '';
	    $gl_url = isset($instance['gl_url']) ? esc_url($instance['gl_url']) : '';
	    $ig_url = isset($instance['ig_url']) ? esc_url($instance['ig_url']) : '';
	    $yt_url = isset($instance['yt_url']) ? esc_url($instance['yt_url']) : '';

	    $foodbakery_opt_array = array(
		'name' => foodbakery_var_theme_text_srt('foodbakery_var_title_field'),
		'desc' => '',
		'hint_text' => '',
		'echo' => true,
		'field_params' => array(
		    'std' => esc_attr($title),
		    'classes' => '',
		    'cust_id' => foodbakery_allow_special_char($this->get_field_name('title')),
		    'cust_name' => foodbakery_allow_special_char($this->get_field_name('title')),
		    'return' => true,
		    'required' => false,
		),
	    );
	    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

	    $foodbakery_opt_array = array(
		'std' => $contact_logo,
		'id' => 'contact_logo',
		'name' => foodbakery_var_theme_text_srt('foodbakery_var_contact_logo'),
		'desc' => '',
		'hint_text' => '',
		'echo' => true,
		'array' => true,
		'field_params' => array(
		    'std' => $contact_logo,
		    'return' => true,
		    'cust_name' => foodbakery_allow_special_char($this->get_field_name('contact_logo')),
		    'cust_id' => 'contact_logo',
		    'id' => 'contact_logo',
		    'array' => true,
		    'array_txt' => false,
		),
	    );

	    $foodbakery_var_html_fields->foodbakery_var_upload_file_field($foodbakery_opt_array);

	    $foodbakery_opt_array = array(
		'name' => foodbakery_var_theme_text_srt('foodbakery_var_contact_desc'),
		'desc' => '',
		'hint_text' => '',
		'echo' => true,
		'field_params' => array(
		    'std' => esc_textarea($description),
		    'classes' => 'txtfield',
		    'cust_id' => foodbakery_allow_special_char($this->get_field_name('description')),
		    'cust_name' => foodbakery_allow_special_char($this->get_field_name('description')),
		    'return' => true,
		),
	    );

	    $foodbakery_var_html_fields->foodbakery_var_textarea_field($foodbakery_opt_array);
	    $foodbakery_opt_array = array(
		'name' => foodbakery_var_theme_text_srt('foodbakery_var_contact_address'),
		'desc' => '',
		'hint_text' => foodbakery_var_theme_text_srt('foodbakery_var_contact_address_hint'),
		'echo' => true,
		'field_params' => array(
		    'std' => esc_textarea($address_content),
		    'classes' => 'txtfield',
		    'cust_id' => foodbakery_allow_special_char($this->get_field_name('address_content')),
		    'cust_name' => foodbakery_allow_special_char($this->get_field_name('address_content')),
		    'return' => true,
		),
	    );

	    $foodbakery_var_html_fields->foodbakery_var_textarea_field($foodbakery_opt_array);
	    $foodbakery_opt_array = array(
		'name' => foodbakery_var_theme_text_srt('foodbakery_var_contact_email'),
		'desc' => '',
		'hint_text' => '',
		'echo' => true,
		'field_params' => array(
		    'std' => esc_attr($email),
		    'classes' => '',
		    'cust_id' => foodbakery_allow_special_char($this->get_field_name('email')),
		    'cust_name' => foodbakery_allow_special_char($this->get_field_name('email')),
		    'return' => true,
		    'required' => false,
		),
	    );
	    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);



	    $foodbakery_opt_array = array(
		'name' => foodbakery_var_theme_text_srt('foodbakery_var_contact_phone'),
		'desc' => '',
		'hint_text' => '',
		'echo' => true,
		'field_params' => array(
		    'std' => esc_attr($phone),
		    'classes' => '',
		    'cust_id' => foodbakery_allow_special_char($this->get_field_name('phone')),
		    'cust_name' => foodbakery_allow_special_char($this->get_field_name('phone')),
		    'return' => true,
		    'required' => false,
		),
	    );
	    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

	    $foodbakery_opt_array = array(
		'name' => foodbakery_var_theme_text_srt('foodbakery_var_contact_facebook_url'),
		'desc' => '',
		'hint_text' => '',
		'echo' => true,
		'field_params' => array(
		    'std' => (isset($fb_url) && $fb_url != '') ? esc_attr($fb_url) : '',
		    'classes' => '',
		    'cust_id' => foodbakery_allow_special_char($this->get_field_name('fb_url')),
		    'cust_name' => foodbakery_allow_special_char($this->get_field_name('fb_url')),
		    'return' => true,
		    'required' => false,
		),
	    );
	    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

	    $foodbakery_opt_array = array(
		'name' => foodbakery_var_theme_text_srt('foodbakery_var_contact_twitter_url'),
		'desc' => '',
		'hint_text' => '',
		'echo' => true,
		'field_params' => array(
		    'std' => esc_attr($tw_url),
		    'classes' => '',
		    'cust_id' => foodbakery_allow_special_char($this->get_field_name('tw_url')),
		    'cust_name' => foodbakery_allow_special_char($this->get_field_name('tw_url')),
		    'return' => true,
		    'required' => false,
		),
	    );
	    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

	    $foodbakery_opt_array = array(
		'name' => foodbakery_var_theme_text_srt('foodbakery_var_contact_linkedin_url'),
		'desc' => '',
		'hint_text' => '',
		'echo' => true,
		'field_params' => array(
		    'std' => esc_attr($lk_url),
		    'classes' => '',
		    'cust_id' => foodbakery_allow_special_char($this->get_field_name('lk_url')),
		    'cust_name' => foodbakery_allow_special_char($this->get_field_name('lk_url')),
		    'return' => true,
		    'required' => false,
		),
	    );
	    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

	    $foodbakery_opt_array = array(
		'name' => foodbakery_var_theme_text_srt('foodbakery_var_contact_pinterest_url'),
		'desc' => '',
		'hint_text' => '',
		'echo' => true,
		'field_params' => array(
		    'std' => esc_attr($pn_url),
		    'classes' => '',
		    'cust_id' => foodbakery_allow_special_char($this->get_field_name('pn_url')),
		    'cust_name' => foodbakery_allow_special_char($this->get_field_name('pn_url')),
		    'return' => true,
		    'required' => false,
		),
	    );
	    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

	    $foodbakery_opt_array = array(
		'name' => foodbakery_var_theme_text_srt('foodbakery_var_contact_google_url'),
		'desc' => '',
		'hint_text' => '',
		'echo' => true,
		'field_params' => array(
		    'std' => esc_attr($gl_url),
		    'classes' => '',
		    'cust_id' => foodbakery_allow_special_char($this->get_field_name('gl_url')),
		    'cust_name' => foodbakery_allow_special_char($this->get_field_name('gl_url')),
		    'return' => true,
		    'required' => false,
		),
	    );
	    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

	    $foodbakery_opt_array = array(
		'name' => foodbakery_var_theme_text_srt('foodbakery_var_contact_instagram_url'),
		'desc' => '',
		'hint_text' => '',
		'echo' => true,
		'field_params' => array(
		    'std' => esc_attr($ig_url),
		    'classes' => '',
		    'cust_id' => foodbakery_allow_special_char($this->get_field_name('ig_url')),
		    'cust_name' => foodbakery_allow_special_char($this->get_field_name('ig_url')),
		    'return' => true,
		    'required' => false,
		),
	    );
	    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);

	    $foodbakery_opt_array = array(
		'name' => foodbakery_var_theme_text_srt('foodbakery_var_contact_youtube_url'),
		'desc' => '',
		'hint_text' => '',
		'echo' => true,
		'field_params' => array(
		    'std' => esc_attr($yt_url),
		    'classes' => '',
		    'cust_id' => foodbakery_allow_special_char($this->get_field_name('yt_url')),
		    'cust_name' => foodbakery_allow_special_char($this->get_field_name('yt_url')),
		    'return' => true,
		    'required' => false,
		),
	    );
	    $foodbakery_var_html_fields->foodbakery_var_text_field($foodbakery_opt_array);
	}

	/**
	 * Handles updating settings for the current foodbakery contact widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user.
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	function update($new_instance, $old_instance) {
	    $instance = $old_instance;
	    $instance['title'] = $new_instance['title'];
	    $instance['address_content'] = esc_sql($new_instance['address_content']);
	    $instance['contact_code'] = $new_instance['contact_code'];
	    $instance['phone'] = esc_sql($new_instance['phone']);
	    $instance['showcount'] = esc_sql($new_instance['showcount']);
	    $instance['email'] = esc_sql($new_instance['email']);
	    $instance['description'] = esc_sql($new_instance['description']);
	    $instance['contact_logo'] = esc_sql($new_instance['contact_logo']);
	    $instance['fb_url'] = $new_instance['fb_url'];
	    $instance['tw_url'] = $new_instance['tw_url'];
	    $instance['lk_url'] = $new_instance['lk_url'];
	    $instance['pn_url'] = $new_instance['pn_url'];
	    $instance['gl_url'] = $new_instance['gl_url'];
	    $instance['ig_url'] = $new_instance['ig_url'];
	    $instance['yt_url'] = $new_instance['yt_url'];
	    return $instance;
	}

	/**
	 * Outputs the content for the current foodbakery contact widget instance.
	 *
	 * @param array $args Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current contact widget instance.
	 */
	function widget($args, $instance) {

	    extract($args, EXTR_SKIP);
	    global $wpdb, $post, $foodbakery_var_options;
	    $foodbakery_var_footer_style = isset($foodbakery_var_options['foodbakery_var_footer_style']) ? $foodbakery_var_options['foodbakery_var_footer_style'] : '';
	    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

	    $title = wp_specialchars_decode(stripslashes($title));
	    $address_content = empty($instance['address_content']) ? '' : $instance['address_content'];
	    $contact_code = empty($instance['contact_code']) ? '' : $instance['contact_code'];
	    $phone = empty($instance['phone']) ? '' : $instance['phone'];
	    $email = empty($instance['email']) ? '' : $instance['email'];
	    $description = empty($instance['description']) ? '' : $instance['description'];
	    $contact_logo = empty($instance['contact_logo']) ? '' : $instance['contact_logo'];
	    $showcount = empty($instance['showcount']) ? '' : $instance['showcount'];
	    $fb_url = empty($instance['fb_url']) ? '' : esc_url($instance['fb_url']);
	    $tw_url = empty($instance['tw_url']) ? '' : esc_url($instance['tw_url']);
	    $lk_url = empty($instance['lk_url']) ? '' : esc_url($instance['lk_url']);
	    $pn_url = empty($instance['pn_url']) ? '' : esc_url($instance['pn_url']);
	    $gl_url = empty($instance['gl_url']) ? '' : esc_url($instance['gl_url']);
	    $ig_url = empty($instance['ig_url']) ? '' : esc_url($instance['ig_url']);
	    $yt_url = empty($instance['yt_url']) ? '' : esc_url($instance['yt_url']);

	    echo '<div class="widget widget-connect">';
	    if ('' !== $title) {
		echo foodbakery_allow_special_char($args['before_title'] . $title . $args['after_title']);
	    }
	    $showcount = ( '' !== $showcount || !is_integer($showcount) ) ? $showcount : 2;

	    if (filter_var($contact_logo, FILTER_VALIDATE_URL) != FALSE) {
		echo '<div class="map-holder"> ';
		echo '<img src="' . esc_url($contact_logo) . '" alt="contact_logo" />';
		echo '</div>';
	    }

	    if ('' !== $description) {
		echo '<p>' . esc_html($description) . '</p>';
	    }
	    if (isset($foodbakery_var_footer_style) && $foodbakery_var_footer_style != 'footer-style-3') {
		if ($fb_url != '' || $tw_url != '' || $lk_url != '' || $pn_url != '' || $gl_url != '' || $ig_url != '' || $yt_url != '') {
		    ?>
		    <ul class="social-media">
			<?php if ($fb_url <> '') { ?>
			    <li><a href="<?php echo esc_url($fb_url); ?>" data-original-title="facebook"><i class="icon-facebook"></i></a></li>
			<?php } if ($tw_url <> '') { ?>
			    <li><a href="<?php echo esc_url($tw_url); ?>" data-original-title="twitter"><i class=" icon-twitter"></i></a></li>
			<?php } if ($lk_url <> '') { ?>
			    <li><a href="<?php echo esc_url($lk_url); ?>" data-original-title="linkedin"><i class="icon-linkedin"></i></a></li>
			<?php } if ($pn_url <> '') { ?>
			    <li><a href="<?php echo esc_url($pn_url); ?>" data-original-title="pinterest"><i class="icon-pinterest"></i></a></li>
			<?php } if ($gl_url <> '') { ?>
			    <li><a href="<?php echo esc_url($gl_url); ?>" data-original-title="google"><i class="icon-google"></i></a></li>
			<?php } if ($ig_url <> '') { ?>
			    <li><a href="<?php echo esc_url($ig_url); ?>" data-original-title="instagram"><i class="icon-instagram"></i></a></li>
			<?php } if ($yt_url <> '') { ?>
			    <li><a href="<?php echo esc_url($yt_url); ?>" data-original-title="youtube"><i class="icon-youtube"></i></a></li>
				<?php } ?>
		    </ul>
		    <?php
		}
	    }

	    echo '<ul>';

	    if ('' !== $phone) {
		echo '<li><span class="bgcolor"><i class="icon-ring_volume"></i>
                    </span><p>' . esc_html($phone) . '</p></li>';
	    }
	    if ('' !== $email) {
		echo '<li><span class="bgcolor"><i class="icon-envelope-o"></i>
                   </span><p><a href="mailto:' . esc_html($email) . '">' . esc_html($email) . '</a></p></li>';
	    }
	    if ('' !== $address_content) {
		echo '<li><span class="bgcolor"><i class="icon-location-pin2"></i>
                    </span><p>' . esc_html($address_content) . '</p></li>';
	    }
	    echo '</ul>';

	    echo '</div>';
	}

    }

}

if (function_exists('cs_widget_register')) {
    cs_widget_register("Foodbakery_contact");
}



