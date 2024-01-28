<?php

/*
 *
 * @Shortcode Name : Accordion
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_faq_shortcode' ) ) {

    function foodbakery_faq_shortcode( $atts, $content = "" ) {

        global $acc_counter, $foodbakery_var_faq_view;
        $acc_counter = rand( 40, 9999999 );

        $html = '';
        $defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_var_faq_view' => '',
            'foodbakery_var_faq_main_title' => '',
            'foodbakery_var_faq_align' => '',
        );
        extract( shortcode_atts( $defaults, $atts ) );
        
        $column_class = '';
        $foodbakery_var_faq_view = isset( $foodbakery_var_faq_view ) ? $foodbakery_var_faq_view : '';
        $foodbakery_var_column_size = isset( $foodbakery_var_column_size ) ? $foodbakery_var_column_size : '';
        $foodbakery_var_faq_main_title = isset( $foodbakery_var_faq_main_title ) ? $foodbakery_var_faq_main_title : '';
        $foodbakery_var_faq_align = isset($foodbakery_var_faq_align) ? $foodbakery_var_faq_align : '';
        if ( isset( $foodbakery_var_column_size ) && $foodbakery_var_column_size != '' ) {
            if ( function_exists( 'foodbakery_var_custom_column_class' ) ) {
                $column_class = foodbakery_var_custom_column_class( $foodbakery_var_column_size );
            }
        }
        if ( isset( $column_class ) && $column_class <> '' ) {
            $html .= '<div class="' . esc_html( $column_class ) . '">';
        } 

        if ( $foodbakery_var_faq_main_title <> '' )
            $html .= '<div class="element-title '.$foodbakery_var_faq_align.'">
            <h2>' . esc_attr( $foodbakery_var_faq_main_title ) . '</h2>
        </div>';

        $html .= '<div class="faq panel-group " id="faq_' . absint( $acc_counter ) . '">';
        $html .= do_shortcode( $content );
        $html .= '</div>';

        if ( isset( $column_class ) && $column_class <> '' ) {
            $html .= '</div>';
        }
        $page_element_size  = isset( $atts['faq_element_size'] )? $atts['faq_element_size'] : 100;
        return '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' "><div class="faqs">'.$html.'</div></div>';
        
        
    }

    if ( function_exists( 'foodbakery_short_code' ) ) {
        foodbakery_short_code( 'foodbakery_faq', 'foodbakery_faq_shortcode' );
    }
}
if ( function_exists( 'foodbakery_var_short_code' ) )
    foodbakery_var_short_code( 'foodbakery_faq', 'foodbakery_faq_shortcode' );
/*
 *
 * @Accordion Item
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_faq_item_shortcode' ) ) {

    function foodbakery_faq_item_shortcode( $atts, $content = "" ) {
        global $acc_counter, $foodbakery_var_faq_view;
        $strings = new foodbakery_theme_all_strings;
        $strings->foodbakery_short_code_strings();
        $defaults = array(
            'foodbakery_var_faq_title' => esc_html__('Title', 'foodbakery'),
            'foodbakery_var_icon_box' => '',
            'foodbakery_var_faq_active' => 'yes',
        );
        extract( shortcode_atts( $defaults, $atts ) );
        $foodbakery_var_acc_icon = '';
        $foodbakery_var_faq_title = isset( $foodbakery_var_faq_title ) ? $foodbakery_var_faq_title : '';
        $foodbakery_var_icon_box = isset( $foodbakery_var_icon_box ) ? $foodbakery_var_icon_box : '';
        $foodbakery_var_faq_active = isset( $foodbakery_var_faq_active ) ? $foodbakery_var_faq_active : ''; 
		if ( isset( $foodbakery_var_icon_box ) && $foodbakery_var_icon_box != '' ) {
			$foodbakery_var_acc_icon .= '<i class="' . esc_html ( $foodbakery_var_icon_box ) . '"></i>';
		} 
        $faq_count = 0;
        $faq_count = rand( 4045, 99999 );
        $html = '';
        $active_in = '';
        $active_class = '';
        $styleColapse = 'collapsed';
        if ( isset( $foodbakery_var_faq_active ) && $foodbakery_var_faq_active == 'yes' ) {
            $active_in = 'in';
            $styleColapse = '';
        } else {
            $active_class = 'collapsed';
        }

        $html .= ' <div class="panel">';
        $html .= '  <div class="panel-heading">';
        $html .= '   <h4 class="panel-title">';
        $html .= '<a class="' . esc_html( $active_class ) . '" data-toggle="collapse" data-parent="#faq_' . absint( $acc_counter ) . '" href="#collapse' . absint( $faq_count ) . '">' . $foodbakery_var_acc_icon . esc_html( $foodbakery_var_faq_title ) . '</a>';
        $html .= '   </h4>';
        $html .= ' </div>';
        $html .= '  <div id="collapse' . absint( $faq_count ) . '" class="panel-collapse collapse ' . esc_html( $active_in ) . '"	>';
        $html .= '     <div class="panel-body">' . do_shortcode( $content ) . '</div>';
        $html .= ' </div>';
        $html .= '</div>
		
		';
        return $html;
    }

    if ( function_exists( 'foodbakery_short_code' ) ) {
        foodbakery_short_code( 'faq_item', 'foodbakery_faq_item_shortcode' );
    }
}
if ( function_exists( 'foodbakery_var_short_code' ) )
    foodbakery_var_short_code( 'faq_item', 'foodbakery_faq_item_shortcode' );