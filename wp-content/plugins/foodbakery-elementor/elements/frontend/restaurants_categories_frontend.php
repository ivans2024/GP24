<?php

class Foodbakery_Restaurants_Categories_Frontend {

    public function render($settings) {
        global $wp_query, $foodbakery_shortcode_restaurant_categories_front;
        $atts = $settings;
        echo $foodbakery_shortcode_restaurant_categories_front->foodbakery_restaurant_categories_shortcode_callback($atts);
        
    }

}

$Foodbakery_Restaurants_Categories_Frontend = new Foodbakery_Restaurants_Categories_Frontend();
