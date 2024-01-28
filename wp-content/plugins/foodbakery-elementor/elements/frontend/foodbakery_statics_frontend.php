<?php

class Foodbakery_Statics_Frontend {

    public function render($settings) {
        global $wp_query, $foodbakery_shortcode_statics_front;
        $atts = $settings;
        echo $foodbakery_shortcode_statics_front->foodbakery_statics_shortcode_callback($atts);
        
    }

}

$Foodbakery_Statics_Frontend = new Foodbakery_Statics_Frontend();
