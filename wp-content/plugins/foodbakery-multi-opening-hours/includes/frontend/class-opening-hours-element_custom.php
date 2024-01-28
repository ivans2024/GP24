<?php
/**
 * File Type: Opening Hours Page Element
 */
if (!class_exists('foodbakery_opening_hours_element_custom')) {

    class foodbakery_opening_hours_element_custom {

        /**
         * Start construct Functions
         */
        public function __construct() {
            add_action('foodbakery_opening_hours_element_custom_html', array($this, 'foodbakery_opening_hours_element_custom_html_callback'), 11, 1);
        }

        /*
         * Output features html for frontend on restaurant detail page.
         */
        public function foodbakery_opening_hours_element_custom_html_callback( $post_id ){
            $restaurant_type_slug      = get_post_meta( $post_id, 'foodbakery_restaurant_type', true );
            $restaurant_type_post      = get_posts(array( 'posts_per_page' => '1', 'post_type' => 'restaurant-type', 'name' => "$restaurant_type_slug", 'post_status' => 'publish' ));
            $restaurant_type_id        = isset($restaurant_type_post[0]->ID) ? $restaurant_type_post[0]->ID : 0;
            $foodbakery_full_data    = get_post_meta( $restaurant_type_id, 'foodbakery_full_data', true );

            if ( !isset( $foodbakery_full_data['foodbakery_opening_hours_element'] ) || $foodbakery_full_data['foodbakery_opening_hours_element'] != 'on' ){
                $html = '';
            } else {
                $html = '';
                $days = array( 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday' );
                $opening_hours_list = array();
                foreach ( $days as $key => $day ) {
                    $opening_time_ = get_post_meta( $post_id, 'foodbakery_opening_hours_' . $day . '_opening_time', true );
                    $closing_time_ = get_post_meta( $post_id, 'foodbakery_opening_hours_' . $day . '_closing_time', true );

                    if(is_array($opening_time_) && !empty($opening_time_)){
                        $opening_time = array();
                        $closing_time = array();
                        foreach ($opening_time_ as $i => $row){
                            $opening_time[$i] = ( $opening_time_ != '' ? date('h:i a', $opening_time_[$i] ) : '' );
                            $closing_time[$i] = ( $closing_time_ != '' ? date('h:i a', $closing_time_[$i] ) : '' );
                        }
                    }else{
                        $opening_time = ( $opening_time_ != '' ? date('h:i a', $opening_time_ ) : '' );
                        $closing_time = ( $closing_time_ != '' ? date('h:i a', $closing_time_ ) : '' );
                    }

                    $opening_hours_list[ $day ] = array(
                        'day_status' => get_post_meta( $post_id, 'foodbakery_opening_hours_' . $day . '_day_status', true ),
                        'opening_time' => $opening_time,
                        'closing_time' => $closing_time,
                    );
                }
                if ( isset ( $opening_hours_list ) && !empty( $opening_hours_list ) ){
                    $html   = '<div class="widget widget-timing">'
                        . '<h5>' . __( 'Opening Hours', 'fb_customization' ) . '</h5>';
                    $html   .= '<ul>';

                    foreach ($opening_hours_list as $k => $opening_hours_list_days){
                        $days_timing = '<span class="opend-time">';
                        if(is_array($opening_hours_list_days['opening_time'])){
                            foreach($opening_hours_list_days['opening_time'] as $j => $timing_list){
                                 if( isset( $opening_hours_list[$k]['day_status'] ) && $opening_hours_list[$k]['day_status'] == 'on' ) {
                                     $days_timing  .= '<span class="multi-time">' . $opening_hours_list[$k]['opening_time'][$j] . ' - ' . $opening_hours_list[$k]['closing_time'][$j] . '</span>';
                                 }else{
                                     $days_timing .= 'Off';
                                     break;
                                 }
                            }
                        }else{
                            $days_timing     .= '<span class="multi-time"> Set From Admin </span>';
                        }
                        $days_timing .= '</span>';
                        $html       .= '<li><span>'.ucfirst($k).'</span>' . $days_timing . '</li>';
                    }
                    $html   .= '</ul></div>';
                }
            }

            echo force_balance_tags( $html );

        }
    }
    global $foodbakery_opening_hours_element;
    $foodbakery_opening_hours_element    = new foodbakery_opening_hours_element_custom();
}