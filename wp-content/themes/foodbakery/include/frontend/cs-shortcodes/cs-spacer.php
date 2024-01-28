<?php

/**
 * @Spacer html form for page builder
 */
if ( ! function_exists( 'foodbakery_var_spacer_shortcode' ) ) {

    function foodbakery_var_spacer_shortcode( $atts, $content = "" ) {
        global $foodbakery_border;

        $foodbakery_var_defaults = array( 'foodbakery_var_spacer_height' => '25' );
        extract( shortcode_atts( $foodbakery_var_defaults, $atts ) );

        return '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height:' . do_shortcode( $foodbakery_var_spacer_height ) . 'px">
		</div>';
    }

    if ( function_exists( 'foodbakery_var_short_code' ) )
        foodbakery_var_short_code( 'spacer', 'foodbakery_var_spacer_shortcode' );
}