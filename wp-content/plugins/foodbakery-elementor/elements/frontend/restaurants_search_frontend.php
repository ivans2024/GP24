<?php

class Foodbakery_Restaurants_Search_Frontend {

    public function render($settings) {
        global $wp_query, $foodbakery_shortcode_restaurant_search_front;
        $atts = $settings;
        echo $foodbakery_shortcode_restaurant_search_front->foodbakery_restaurant_search_shortcode_callback($atts);
        
    }

}

$Foodbakery_Restaurants_Search_Frontend = new Foodbakery_Restaurants_Search_Frontend();
