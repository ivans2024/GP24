<?php

$var_arrays = array( 'foodbakery_var_home', 'foodbakery_var_demo' );
$theme_option_array_global_vars = FOODBAKERY_VAR_GLOBALS()->globalizing( $var_arrays );
extract( $theme_option_array_global_vars );

$home_demo = foodbakery_var_get_demo_content( 'home.json' );

$foodbakery_page_option[] = array();
$foodbakery_page_option['theme_options'] = array(
    'select' => array(
        'home' => isset( $foodbakery_var_home ) ? $foodbakery_var_home : '',
    ),
    'home' => array(
        'name' => isset( $foodbakery_var_demo ) ? $foodbakery_var_demo : '',
        'page_slug' => 'home',
        'theme_option' => $home_demo,
        'thumb' => 'Import-Dummy-Data'
    ),
);
?>