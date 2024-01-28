<?php

class Foodbakery_Restaurants_Slider_Frontend {

    public function render($settings) {
        global $wp_query, $foodbakery_shortcode_restaurants_slider_frontend;
        $atts = $settings;
        echo $foodbakery_shortcode_restaurants_slider_frontend->foodbakery_restaurants_slider_shortcode_callback($atts);
        
    }

}

$Foodbakery_Restaurants_Slider_Frontend = new Foodbakery_Restaurants_Slider_Frontend();
