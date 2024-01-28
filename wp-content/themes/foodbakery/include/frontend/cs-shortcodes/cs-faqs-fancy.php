<?php

/*
 *
 * @Shortcode Name :  faqs_fancy front end view
 * @retrun
 *
 */

if ( ! function_exists( 'foodbakery_var_faqs_fancy_shortcode' ) ) {

	function foodbakery_var_faqs_fancy_shortcode( $atts, $content = "" ) {
		global $post, $foodbakery_var_faqs_fancy_column, $foodbakery_var_faqs_fancy_parent_titles;
		global $faqs_fancy_content;
		$html = '';
		$page_element_size = isset( $atts['faqs_fancy_element_size'] ) ? $atts['faqs_fancy_element_size'] : 100;
		if ( function_exists( 'foodbakery_var_page_builder_element_sizes' ) ) {
			$html .= '<div class="' . foodbakery_var_page_builder_element_sizes( $page_element_size ) . ' ">';
		}
		$faqs_fancy_content = '';
		$defaults = array(
			'foodbakery_var_faqs_fancy_title' => '',
			'foodbakery_var_faqs_title' => '',
			'foodbakery_var_fancy_faq_align' => '',
		);

		extract( shortcode_atts( $defaults, $atts ) );
		$foodbakery_var_faqs_fancy_title = isset( $foodbakery_var_faqs_fancy_title ) ? $foodbakery_var_faqs_fancy_title : '';
		$foodbakery_var_faqs_fancy_parent_titles = isset( $foodbakery_var_faqs_title ) ? $foodbakery_var_faqs_title : '';
		$foodbakery_var_fancy_faq_align = isset( $foodbakery_var_fancy_faq_align ) ? $foodbakery_var_fancy_faq_align : '';

		$foodbakery_section_title = '';
		$foodbakery_section_sub_title = '';
		$exploded_titles = explode( ",", $foodbakery_var_faqs_fancy_parent_titles );
		$html .= '<div class="foodbakery-faqs fancy">';
		$faqs_nav = '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 section-sidebar">
                                <div class="widget widget-related-article">
                            <ul class="nav nav-list">';
		
		$counter = 1;
		$exploded_titles_width = count( $exploded_titles ) - 1;
		$width_percentage = 100 / $exploded_titles_width;
		foreach ( $exploded_titles as $exploded_title ) {
			if ( $exploded_title != '' ) {
				?>
				<?php $faqs_nav .='<li ><a class="fancyfaq" href="javascript:void(0)" data-toggle="faq"  data-common="' . $exploded_title . '" data-step="' . $counter . '"><strong>' . $exploded_title . '</strong></a></li> ';
				?>
				<?php

				$counter ++;
			}
		}
		?>
		<?php

		$faqs_nav .=' <div class="progress-data" data-totlasteps="' . ($counter - 1) . '"></div></ul>
                         </div></div>';

		$foodbakery_faqs_fancy_style = "vertical";

		$html .= $faqs_nav;


		$html .= do_shortcode( $content );

		$html .= '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="faq-section">  <div class="element-title ' . $foodbakery_var_fancy_faq_align . '"><h3>' . $foodbakery_var_faqs_fancy_title . '</h3></div><div class="panel-group" id="accordion">';
		$html .= $faqs_fancy_content;
		$html .= '</div></div></div></div></div>';
		$html .= '</div>';
		if ( function_exists( 'foodbakery_var_page_builder_element_sizes' ) ) {
			$html .= '</div>';
		}
		return do_shortcode( $html );
	}

	if ( function_exists( 'foodbakery_var_short_code' ) ) {
		foodbakery_var_short_code( 'foodbakery_faqs_fancy', 'foodbakery_var_faqs_fancy_shortcode' );
	}
}


/*
 *
 * @List  Item  shortcode/element front end view
 * @retrun
 *
 */

if ( ! function_exists( 'foodbakery_var_faqs_fancy_item_shortcode' ) ) {

	function foodbakery_var_faqs_fancy_item_shortcode( $atts, $content = "" ) {
		global $post, $foodbakery_var_faqs_fancy_column, $faqs_fancy_content, $foodbakery_var_faqs_fancy_parent_titles;
		$output = '';
		global $faqs_fancy_content;
		$defaults = array(
			'foodbakery_var_faqs_fancy_item_text' => '',
			'foodbakery_var_faqs_image_array' => '',
			'foodbakery_var_faqs_fancy_active' => '',
			'foodbakery_var_faqs_fancy_desc' => '',
		);
		extract( shortcode_atts( $defaults, $atts ) );

		$foodbakery_var_faqs_fancy_column_str = '';
		if ( $foodbakery_var_faqs_fancy_column != 12 ) {
			$foodbakery_var_faqs_fancy_column_str = 'class = "col-md-' . esc_html( $foodbakery_var_faqs_fancy_column ) . '"';
		}
		$foodbakery_var_faqs_fancy_item_text = isset( $foodbakery_var_faqs_fancy_item_text ) ? $foodbakery_var_faqs_fancy_item_text : '';
		$foodbakery_var_faqs_image_array = isset( $foodbakery_var_faqs_image_array ) ? $foodbakery_var_faqs_image_array : '';
		$foodbakery_var_faqs_fancy_desc = isset( $foodbakery_var_faqs_fancy_desc ) ? $foodbakery_var_faqs_fancy_desc : '';
		$foodbakery_var_faqs_fancy_active = isset( $foodbakery_var_faqs_fancy_active ) ? $foodbakery_var_faqs_fancy_active : '';
		?>

		<?php

		$activeClass = "";
		if ( $foodbakery_var_faqs_fancy_active == 'Yes' ) {
			$activeClass = 'active in';
		}
		$randid = rand( 877, 9999 );
		$new_str = preg_replace( "/[^A-Z]+/", "", $foodbakery_var_faqs_fancy_item_text );
		$faqs_fancy_content .= '<div class="faq-pane panel" data-common="' . $foodbakery_var_faqs_fancy_active . '" id="step' . $foodbakery_var_faqs_fancy_active . '"><div class="panel-heading"> <a data-toggle="collapse" data-parent="#accordion" class="collapsed" href="#' . $randid . '" aria-expanded="false"> ' . $foodbakery_var_faqs_fancy_item_text . ' </a> </div><div id="' . $randid . '" class="panel-collapse collapse"><div class="panel-body">
                          ' . do_shortcode( $content ) . '
                        
                      </div>
                      </div></div>';
		return do_shortcode( $output );
	}

	if ( function_exists( 'foodbakery_var_short_code' ) ) {
		foodbakery_var_short_code( 'foodbakery_faqs_fancy_item', 'foodbakery_var_faqs_fancy_item_shortcode' );
	}
}