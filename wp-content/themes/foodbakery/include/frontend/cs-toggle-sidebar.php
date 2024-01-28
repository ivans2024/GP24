<?php

/**
 * Header Functions
 *
 * @package WordPress
 * @subpackage foodbakery
 * @since Foodbakery 1.0
 */
if ( ! function_exists( ' foodbakery_top_strip2' ) ) {

    /**
     * Header Top Strip Function
     */
    function foodbakery_top_strip2() {
        global $foodbakery_var_options;
        ?>
        <?php if ( 'on' === $foodbakery_var_options['foodbakery_var_header_top_strip'] ) {
		}
    }

}
