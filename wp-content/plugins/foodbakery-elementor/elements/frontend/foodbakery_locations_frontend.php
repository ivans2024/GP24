<?php

class Foodbakery_Locations_Frontend {

    public function render($settings) {
        global $wp_query, $foodbakery_shortcode_locations_front;
        $atts = $settings;
        echo $foodbakery_shortcode_locations_front->foodbakery_locations_shortcode_callback($atts);
        
    }

}

$Foodbakery_Locations_Frontend = new Foodbakery_Locations_Frontend();
