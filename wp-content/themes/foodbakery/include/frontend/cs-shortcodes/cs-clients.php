<?php

/*
 *
 * @Shortcode Name :   Start function for Client shortcode/element front end view
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_clients_shortcode' ) ) {

    function foodbakery_clients_shortcode( $atts, $content = null ) {
        global $foodbakery_var_blog_variables, $clients_style, $item_counter, $foodbakery_var_clients_text, $post, $clients_section_title;
         $foodbakery_var_clients = '';
        $page_element_size  = isset( $atts['clients_element_size'] )? $atts['clients_element_size'] : 100;
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $foodbakery_var_clients   .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
        $randomid = rand( 1234, 7894563 );
        $defaults = array(
            'foodbakery_var_column_size' => '',
            'clients_style' => '',
            'foodbakery_var_clients_text' => '',
            'foodbakery_var_clients_element_title' => '',
            'foodbakery_var_client_align' => '',
	     'foodbakery_var_client_view'=>'',
        );
        extract( shortcode_atts( $defaults, $atts ) );
        $item_counter = 1;
       
        $foodbakery_var_clients_element_title = isset( $foodbakery_var_clients_element_title ) ? $foodbakery_var_clients_element_title : '';
	 $foodbakery_var_client_view = isset( $foodbakery_var_client_view ) ? $foodbakery_var_client_view : '';
        $foodbakery_var_column_size = isset( $foodbakery_var_column_size ) ? $foodbakery_var_column_size : '';
        $clients_style = isset( $clients_style ) ? $clients_style : '';
        $foodbakery_var_clients_text = isset( $foodbakery_var_clients_text ) ? $foodbakery_var_clients_text : '';
        $foodbakery_var_client_align = isset($foodbakery_var_client_align) ? $foodbakery_var_client_align : '';

        if ( isset( $foodbakery_var_column_size ) && $foodbakery_var_column_size != '' ) {
            if ( function_exists( 'foodbakery_var_custom_column_class' ) ) {
                $column_class = foodbakery_var_custom_column_class( $foodbakery_var_column_size );
            }
        }
        if ( isset( $column_class ) && $column_class <> '' ) {

            $foodbakery_var_clients .= '<div class="' . esc_html( $column_class ) . '">';
        }

        if ( $foodbakery_var_clients_element_title <> '' ) {
            $foodbakery_var_clients .= '<div class="element-title '.$foodbakery_var_client_align.'"><h2>' . esc_html( $foodbakery_var_clients_element_title ) . '</h2></div>';
        }

        $foodbakery_var_clients .='<div class="company-logo '.$foodbakery_var_client_view.'">';
        $foodbakery_var_clients .='<ul>';
        $foodbakery_var_clients .= do_shortcode( $content );
        $foodbakery_var_clients .='</ul>';
        $foodbakery_var_clients .='</div>';


        if ( isset( $column_class ) && $column_class <> '' ) {
            $foodbakery_var_clients .= '</div>';
        }
        
         if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $foodbakery_var_clients .=  '</div>';
          }

        return $foodbakery_var_clients;
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'foodbakery_clients', 'foodbakery_clients_shortcode' );
    }
}

/*
 *
 * @Shortcode Name :  Start function for Client Item shortcode/element front end view
 * @retrun
 *
 */
if ( ! function_exists( 'foodbakery_clients_item' ) ) {

    function foodbakery_clients_item( $atts, $content = null ) {
        global $clients_style, $column_class, $item_counter, $clients_style, $foodbakery_var_clients_text_color, $post;
        $defaults = array(
            'foodbakery_var_clients_img_user_array' => '',
            'foodbakery_var_clients_text' => '',
        );

        extract( shortcode_atts( $defaults, $atts ) );

        $foodbakery_var_clients_item = '';
        $clients_img_user = isset( $foodbakery_var_clients_img_user_array ) ? $foodbakery_var_clients_img_user_array : '';

        if ( $foodbakery_var_clients_text == '' ) {
            $foodbakery_var_clients_text = 'javascript:void(0)';
        } else {
            $foodbakery_var_clients_text = esc_url( $foodbakery_var_clients_text );
        }

        if ( $clients_img_user <> '' ) {
            $foodbakery_var_clients_item .= '<li>';
            $foodbakery_var_clients_item .= '<figure>';
            $foodbakery_var_clients_item .= '<a href="' . $foodbakery_var_clients_text . '">';
            $foodbakery_var_clients_item .= '<img src="' . esc_url( $clients_img_user ) . '" alt="clients_img_user">';
            $foodbakery_var_clients_item .= '</a>';
            $foodbakery_var_clients_item .= '</figure>';
            $foodbakery_var_clients_item .= '</li>';
        }

        $item_counter ++;

        return $foodbakery_var_clients_item;
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'clients_item', 'foodbakery_clients_item' );
    }
}