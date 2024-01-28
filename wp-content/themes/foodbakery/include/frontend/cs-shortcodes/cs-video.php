<?php

/*
 *
 * @Shortcode Name : Video 
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_var_video' ) ) {

	function foodbakery_var_video( $atts, $content = "" ) {
		$video = '';
		$page_element_size = isset( $atts['video_element_size'] ) ? $atts['video_element_size'] : 100;
		if ( function_exists( 'foodbakery_var_page_builder_element_sizes' ) ) {
			$video .= '<div class="' . foodbakery_var_page_builder_element_sizes( $page_element_size ) . ' ">';
		}
		$defaults = array(
			'foodbakery_var_column_size' => '',
			'foodbakery_var_video_title' => '',
			'foodbakery_var_video_url' => '',
			'foodbakery_var_height' => '',
			'foodbakery_var_video_align' => '',
		);
		extract( shortcode_atts( $defaults, $atts ) );
		$foodbakery_var_video_title = isset( $foodbakery_var_video_title ) ? $foodbakery_var_video_title : '';
		$foodbakery_var_video_url = isset( $foodbakery_var_video_url ) ? $foodbakery_var_video_url : '';
		$foodbakery_var_height = isset( $foodbakery_var_height ) ? $foodbakery_var_height : '';
		$foodbakery_var_video_align = isset( $foodbakery_var_video_align ) ? $foodbakery_var_video_align : '';
		$video_url = '';
		$video_url = parse_url( $foodbakery_var_video_url );
		$foodbakery_iframe = '<' . 'i' . 'frame ';
		// Column Class
		$column_class = '';
		if ( isset( $foodbakery_var_column_size ) && $foodbakery_var_column_size != '' ) {
			if ( function_exists( 'foodbakery_var_custom_column_class' ) ) {
				$column_class = foodbakery_var_custom_column_class( $foodbakery_var_column_size );
			}
		}

		if ( isset( $column_class ) && $column_class <> '' ) {
			$video .= '<div class="' . esc_html( $column_class ) . '">';
		}

		if ( $foodbakery_var_video_title != '' ) {
			$video .= '<div class="element-title ' . $foodbakery_var_video_align . '"><h2>' . esc_html( $foodbakery_var_video_title ) . '</h2></div>';
		}

		if ( $foodbakery_var_video_url != '' ) {
			if ( $video_url['host'] == cs_get_server_data("SERVER_NAME") ) {
				$video .= '<figure  class="cs-video ' . $column_class . '">';
				$video .= '' . do_shortcode( '[video height="' . $foodbakery_var_height . '"  src="' . esc_url( $foodbakery_var_video_url ) . '"][/video]' ) . '';
				$video .= '</figure>';
			} else {
				$video .= wp_oembed_get( $foodbakery_var_video_url, array( 'height' => $foodbakery_var_height ) );
			}
		}

		if ( isset( $column_class ) && $column_class <> '' ) {
			$video .= '</div>';
		}
		if ( function_exists( 'foodbakery_var_page_builder_element_sizes' ) ) {
			$video .= '</div>';
		}
		return $video;
	}

	if ( function_exists( 'foodbakery_var_short_code' ) )
		foodbakery_var_short_code( 'foodbakery_video', 'foodbakery_var_video' );
}

function foodbakery_oembed_filter( $return, $data, $url ) {
	$return = str_replace( 'frameborder="0"', 'style="border: none"', $return );
	return $return;
}

add_filter( 'oembed_dataparse', 'foodbakery_oembed_filter', 90, 3 );
