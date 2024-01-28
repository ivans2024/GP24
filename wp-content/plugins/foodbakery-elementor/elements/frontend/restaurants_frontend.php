<?php

class Foodbakery_Restaurants_Frontend {

    public function render($settings) {
        global $wp_query, $foodbakery_shortcode_restaurants_frontend;
        $atts = $settings;
        echo $foodbakery_shortcode_restaurants_frontend->foodbakery_restaurants_shortcode_callback($atts);
        
    }

}

$Foodbakery_Restaurants_Frontend = new Foodbakery_Restaurants_Frontend();
