<?php

class Foodbakery_Testimonials_Frontend {

    public function render($settings) {
        global $wp_query, $foodbakery_shortcode_locations_front, $column_class, $section_title, $post, $foodbakery_var_author_color, $foodbakery_var_position_color, $foodbakery_var_testimonial_style;
        $atts = $settings;
        $randomid = rand(0123, 9999);
        $defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_var_testimonial_content' => '',
            'foodbakery_var_testimonial_title' => '',
            'foodbakery_var_testimonial_sub_title' => '',
            'foodbakery_var_author_color' => '',
            'foodbakery_var_testimonial_align' => '',
            'foodbakery_var_testimonial_style' => '',
            'testimonial_item' => array(),
        );
        extract(shortcode_atts($defaults, $atts));
        $html = '';
        $page_element_size = isset($atts['testimonial_element_size']) ? $atts['testimonial_element_size'] : 100;
        if ( function_exists('foodbakery_var_page_builder_element_sizes') ) {
            $html .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
        $section_title = '';
        $foodbakery_var_testimonial_title = isset($foodbakery_var_testimonial_title) ? $foodbakery_var_testimonial_title : '';
        $foodbakery_var_testimonial_content = isset($foodbakery_var_testimonial_content) ? $foodbakery_var_testimonial_content : '';
        $foodbakery_var_testimonial_sub_title = isset($foodbakery_var_testimonial_sub_title) ? $foodbakery_var_testimonial_sub_title : '';
        $foodbakery_var_column_size = isset($foodbakery_var_column_size) ? $foodbakery_var_column_size : '';
        $foodbakery_var_author_color = isset($foodbakery_var_author_color) ? $foodbakery_var_author_color : '';
        $foodbakery_var_testimonial_align = isset($foodbakery_var_testimonial_align) ? $foodbakery_var_testimonial_align : '';
        $foodbakery_var_testimonial_style = isset($foodbakery_var_testimonial_style) ? $foodbakery_var_testimonial_style : '';
        if ( isset($foodbakery_var_column_size) && $foodbakery_var_column_size != '' ) {
            if ( function_exists('foodbakery_var_custom_column_class') ) {
                $column_class = foodbakery_var_custom_column_class($foodbakery_var_column_size);
            }
        }
        if ( isset($column_class) && $column_class <> '' ) {
            $html .= '<div class="' . esc_html($column_class) . '">';
        }
        $html .= '<div class="row">';

        if ( isset($foodbakery_var_testimonial_title) and $foodbakery_var_testimonial_title <> '' ) {
            $html .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="section-title ' . $foodbakery_var_testimonial_align . '">';
            $html .= '<h3>' . esc_html($foodbakery_var_testimonial_title) . '</h3> ';
            $html .= '</div></div>';
        }

        $html .= '<div class="testimonial ' . $foodbakery_var_testimonial_style . '">';
        if ( isset($foodbakery_var_testimonial_style) && $foodbakery_var_testimonial_style == 'fancy' ) {
            $html .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
        }
        if ( isset($foodbakery_var_testimonial_style) && $foodbakery_var_testimonial_style == 'simple' ) {
            $html .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
        }
        if ( isset($foodbakery_var_testimonial_style) && $foodbakery_var_testimonial_style == 'fancy' ) {
            $html .= '<div class="swiper-container">';
            $html .= '<div class="swiper-wrapper">';
            $html .= $this->render_tesitimonial_items_array($testimonial_item);
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="swiper-pagination"></div>';
        }
         elseif  ( isset($foodbakery_var_testimonial_style) && $foodbakery_var_testimonial_style == 'simple' ) {
            $html .= '<div class="swiper-container">';
            $html .= '<div class="swiper-wrapper">';
            $html .= $this->render_tesitimonial_items_array($testimonial_item);
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="swiper-pagination"></div>';
        }else {
            $html .= $this->render_tesitimonial_items_array($testimonial_item);
        }
        if ( isset($foodbakery_var_testimonial_style) && $foodbakery_var_testimonial_style == 'fancy' ) {
            $html .= '</div>';
        }
         if ( isset($foodbakery_var_testimonial_style) && $foodbakery_var_testimonial_style == 'simple' ) {
            $html .= '</div>';
        }
        $html .= '</div>'; // main testimonial class
        $html .= ' </div>'; // end row

        if ( isset($column_class) && $column_class <> '' ) {
            $html .= ' </div>';
        }

        if ( function_exists('foodbakery_var_page_builder_element_sizes') ) {
            $html .= '</div>';
        }

        echo $html;
    }
    
    public function render_tesitimonial_items_array($testimonial_items_array)
    {
        $testimonial_item_response = '';
        if (!empty($testimonial_items_array)) {
            foreach ($testimonial_items_array as $testimonial_item) {
                $testimonial_item_response .= $this->render_tesitimonial_item($testimonial_item);
            }
        }
        return $testimonial_item_response;
    }
    
    public function render_tesitimonial_item($atts)
    {
        global $column_class, $post, $foodbakery_var_author_color, $foodbakery_var_position_color, $foodbakery_var_testimonial_style;
        $width = '150';
        $height = '150';
        $defaults = array(
            'foodbakery_var_testimonial_content' => '',
            'foodbakery_var_testimonial_author' => '',
            'foodbakery_var_testimonial_author_image_array' => array()
        );

        extract(shortcode_atts($defaults, $atts));
        $figure = '';
        $html = '';

        $foodbakery_var_testimonial_author_image_url = isset($foodbakery_var_testimonial_author_image_array['url']) ? $foodbakery_var_testimonial_author_image_array['url'] : '';
        $image_url = $foodbakery_var_testimonial_author_image_url;
        $foodbakery_var_testimonial_author = isset($foodbakery_var_testimonial_author) ? $foodbakery_var_testimonial_author : '';
        $foodbakery_var_testimonial_style = isset($foodbakery_var_testimonial_style) ? $foodbakery_var_testimonial_style : 'default';
        $author_color = '';
        if ( $foodbakery_var_author_color != '' ) {
            $author_color = 'style="color: ' . esc_html($foodbakery_var_author_color) . ' !important;"';
        }
        $html .= '';
        if ( isset($foodbakery_var_testimonial_style) && $foodbakery_var_testimonial_style == 'default' ) {
            $html .= '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">';
        }
        if ( isset($foodbakery_var_testimonial_style) && $foodbakery_var_testimonial_style == 'fancy' ) {
            $html .= ' <div class="swiper-slide">';
            $html .= '<div class="testimonial-holder">';
        }
        if ( isset($foodbakery_var_testimonial_style) && $foodbakery_var_testimonial_style == 'simple' ) {
            $html .= ' <div class="swiper-slide">';
            $html .= '<div class="testimonial-holder">';
        }
        if ( $image_url <> '' ) {
            
        }
        $html .= '<div class="text-holder">';
        $html .= ' <p>' . do_shortcode($foodbakery_var_testimonial_content) . '</p>';
        
         if ($foodbakery_var_testimonial_style == 'simple' ) {
        $html .= '</div>';
        $html .= '<div class="img-holder">';
            $html .= '<figure>';
            $html .= '<img src="' . esc_url($image_url) . '" alt="image_url">';
            $html .= '</figure>';
            $html .= '</div>';
            $html .= '<div class="author-detail">';
            $html .= '<div class="auther-name">';
            $html .= '<span>@' . esc_html($foodbakery_var_testimonial_author) . '</span>';
            $html .= '</div>';
         }
         else{
             
             $html .= '<div class="img-holder">';
            $html .= '<figure>';
            $html .= '<img src="' . esc_url($image_url) . '" alt="image_url">';
            $html .= '</figure>';
            $html .= '</div>';
            $html .= '<div class="author-detail">';
            $html .= '<div class="auther-name">';
            $html .= '<span ' . $author_color . '>@' . esc_html($foodbakery_var_testimonial_author) . '</span>';
            $html .= '</div>';
             $html .= '</div>';
             
         }
         
         
        $html .= '</div>';
        if ( isset($foodbakery_var_testimonial_style) && $foodbakery_var_testimonial_style == 'fancy' ) {
            $html .= '</div>';
            $html .= '</div>';
        }
         if ( isset($foodbakery_var_testimonial_style) && $foodbakery_var_testimonial_style == 'simple' ) {
            $html .= '</div>';
            $html .= '</div>';
        }
        if ( isset($foodbakery_var_testimonial_style) && $foodbakery_var_testimonial_style == 'default' ) {
            $html .= '</div>';
        }
        return $html;
    }

}

$Foodbakery_Testimonials_Frontend = new Foodbakery_Testimonials_Frontend();
