<?php

/**
 * Foodbakery_Mailchimp Class
 *
 * @package Foodbakery
 */
if ( !class_exists( 'Foodbakery_Mailchimp' ) ) {

	/**
	  Foodbakery_Mailchimp class used to implement the custom mailchimp widget.
	 */
	class Foodbakery_Mailchimp extends WP_Widget {

		/**
		 * Sets up a new foodbakery mailchimp widget instance.
		 */
		public function __construct() {
			global $foodbakery_var_static_text;

			parent::__construct(
					'foodbakery_mailchimp', // Base ID.
					foodbakery_var_theme_text_srt( 'foodbakery_var_mailchimp' ), // Name.
					array( 'classname' => 'widget-newsletter', 'description' => foodbakery_var_theme_text_srt( 'foodbakery_var_mailchimp_desciption' ) ) // Args.
			);
		}

		/**
		 * Outputs the foodbakery mailchimp widget settings form.
		 *
		 * @param array $instance current settings.
		 */
		function form( $instance ) {
			global $foodbakery_var_form_fields, $foodbakery_var_html_fields, $foodbakery_var_static_text;
			$strings = new foodbakery_theme_all_strings;
			$strings->foodbakery_short_code_strings();
			$instance = wp_parse_args( ( array ) $instance, array( 'title' => '' ) );

			$title = $instance['title'];
			$description = isset( $instance['description'] ) ? esc_attr( $instance['description'] ) : '';
			$content = isset( $instance['content'] ) ? esc_attr( $instance['content'] ) : '';
			$url = isset( $instance['url'] ) ? esc_attr( $instance['url'] ) : '';

			$foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_title_field' ),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_multiple_counter_title_hint' ),
				'echo' => true,
				'field_params' => array(
					'std' => esc_attr( $title ),
					'cust_id' => '',
					'cust_name' => foodbakery_allow_special_char( $this->get_field_name( 'title' ) ),
					'return' => true,
				),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

			$foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_description' ),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_description_hint' ),
				'echo' => true,
				'field_params' => array(
					'std' => esc_attr( $description ),
					'cust_id' => '',
					'cust_name' => foodbakery_allow_special_char( $this->get_field_name( 'description' ) ),
					'return' => true,
				),
			);
			$foodbakery_var_html_fields->foodbakery_var_textarea_field( $foodbakery_opt_array );

			$foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_short_text' ),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_short_text_hint' ),
				'echo' => true,
				'field_params' => array(
					'std' => esc_attr( $content ),
					'cust_id' => '',
					'cust_name' => foodbakery_allow_special_char( $this->get_field_name( 'content' ) ),
					'return' => true,
				),
			);
			$foodbakery_var_html_fields->foodbakery_var_textarea_field( $foodbakery_opt_array );

			$foodbakery_opt_array = array(
				'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_url_mailchimp_field' ),
				'desc' => '',
				'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_url_field_hint' ),
				'echo' => true,
				'field_params' => array(
					'std' => esc_attr( $url ),
					'cust_id' => '',
					'cust_name' => foodbakery_allow_special_char( $this->get_field_name( 'url' ) ),
					'return' => true,
				),
			);
			$foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );
		}

		/**
		 * Handles updating settings for the current foodbakery mailchimp widget instance.
		 *
		 * @param array $new_instance New settings for this instance as input by the user.
		 * @param array $old_instance Old settings for this instance.
		 * @return array Settings to save or bool false to cancel saving.
		 */
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['url'] = $new_instance['url'];
			$instance['description'] = $new_instance['description'];
			$instance['content'] = $new_instance['content'];
			return $instance;
		}

		/**
		 * Outputs the content for the current foodbakery mailchimp widget instance.
		 *
		 * @param array $args Display arguments including 'before_title', 'after_title',
		 *                        'before_widget', and 'after_widget'.
		 * @param array $instance Settings for the current ads widget instance.
		 */
		function widget( $args, $instance ) {
			global $foodbakery_node, $wpdb, $post;

			extract( $args, EXTR_SKIP );
			$title = empty( $instance['title'] ) ? ' ' : apply_filters( 'widget_title', $instance['title'] );
			$description = empty( $instance['description'] ) ? ' ' : apply_filters( 'widget_title', $instance['description'] );
			$content = isset( $instance['content'] ) ? esc_attr( $instance['content'] ) : '';
			$url = isset( $instance['url'] ) ? esc_url( $instance['url'] ) : '';
			echo foodbakery_allow_special_char( $args['before_widget'] );
			if ( !empty( $title ) && ' ' !== $title ) {
				echo foodbakery_allow_special_char( $args['before_title'] . $title . $args['after_title'] );
			}
			
			if ( function_exists( 'foodbakery_custom_mailchimp' ) ) {
				if ( '' !== $description && ' ' !== $description ) {
					echo '<p>';
					echo html_entity_decode( $description );
					echo '</p>';
				}
				$mailchim_widget = 3;
				echo foodbakery_custom_mailchimp( $mailchim_widget );
			}
			if ( '' !== $content ) {
				echo '<a href="'. $url .'">' . foodbakery_allow_special_char( $content ) . '</a>';
			}

			echo foodbakery_allow_special_char( $args['after_widget'] );
		}

	}

}
if (function_exists('cs_widget_register')) {
    cs_widget_register("Foodbakery_Mailchimp");
}