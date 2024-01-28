<?php
// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Restaurant Opening Hours Format Change Frontend
 */
class class_opening_hours_format_backend
{

    /**
     * Constructor
     */
    public function __construct(){
       add_filter('foodbakery_time_format', array($this, 'foodbakery_time_format_callback'));
       add_filter('opening_hours_format', array($this, 'opening_hours_format_callback'));
       add_filter('opening_hours_open_time_format', array($this, 'opening_hours_open_time_format_callback'), 10, 2);
       add_filter('opening_hours_close_time_format', array($this, 'opening_hours_close_time_format_callback'), 10, 2);
    }
    
    /*
     * Change Opening Hours Format
     */
    public function opening_hours_format_callback($hours){
       $lapse = 15;
        $hours = array();
        $foodbakery_opening_hours_gap = get_post_meta($type_id, 'foodbakery_opening_hours_time_gap', true);
        if (isset($foodbakery_opening_hours_gap) && $foodbakery_opening_hours_gap != '') {
            $lapse = $foodbakery_opening_hours_gap;
        }

        $date = date("Y-m-d 00:00");
        $time = strtotime('00:00');
        $start_time = strtotime($date . ' am');
        $endtime = strtotime(date("Y-m-d H:i", strtotime('1440 minutes', $start_time)));

        while ($start_time < $endtime) {
            $time = date("H:i", strtotime('+' . $lapse . ' minutes', $time));
            $hours[$time] = $time;
            $time = strtotime($time);
            $start_time = strtotime(date("Y-m-d H:i", strtotime('+' . $lapse . ' minutes', $start_time)));
        }
        
        return $hours;
    }
    
    public function opening_hours_open_time_format_callback($opening_time, $_opening_time){
        $opening_time = ( $_opening_time != '' ? date('H:i', $_opening_time) : '' );
        return $opening_time;
    }
    
    public function opening_hours_close_time_format_callback($closing_time, $_closing_time){
        $closing_time = ( $_closing_time != '' ? date('H:i', $_closing_time) : '' );
        return $closing_time;
    }
    
    public function foodbakery_time_format_callback($time){
        $time = ( $time != '' ? date('H:i', strtotime($time)) : '' );
        return $time;
    }

}

new class_opening_hours_format_backend();
