<?php

class Foodbakery_Clients_Frontend {

    public function render($settings) {
        global $foodbakery_var_blog_variables, $clients_style, $item_counter, $foodbakery_var_clients_text, $post, $clients_section_title;
        $atts = $settings;
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
	     'clients_items'=>  array(),
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
        $foodbakery_var_clients .= $this->render_client_items_array($clients_items);
        $foodbakery_var_clients .='</ul>';
        $foodbakery_var_clients .='</div>';


        if ( isset( $column_class ) && $column_class <> '' ) {
            $foodbakery_var_clients .= '</div>';
        }
        
         if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            $foodbakery_var_clients .=  '</div>';
          }

        echo $foodbakery_var_clients;
    }
    
    public function render_client_items_array($client_items_array)
    {
        $client_items_response = '';
        if (!empty($client_items_array)) {
            foreach ($client_items_array as $client_item) {
                $client_items_response .= $this->render_client_item($client_item);
            }
        }
        return $client_items_response;
    }
    
    public function render_client_item($atts)
    {
        global $clients_style, $column_class, $item_counter, $clients_style, $foodbakery_var_clients_text_color, $post;
        $defaults = array(
            'foodbakery_var_clients_img_user_array' => '',
            'foodbakery_var_clients_text' => '',
        );

        extract( shortcode_atts( $defaults, $atts ) );

        $foodbakery_var_clients_item = '';
        $clients_img_user = isset( $foodbakery_var_clients_img_user_array['url'] ) ? $foodbakery_var_clients_img_user_array['url'] : '';

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

}

$Foodbakery_Clients_Frontend = new Foodbakery_Clients_Frontend();
