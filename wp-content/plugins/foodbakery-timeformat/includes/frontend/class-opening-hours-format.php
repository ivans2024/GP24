<?php
// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Restaurant Opening Hours Format Change Frontend
 */
class class_opening_hours_format_frontend
{

    /**
     * Constructor
     */
    public function __construct(){
       add_filter('opening_hours_time_format', array($this, 'opening_hours_time_format_callback'));
       add_filter('opening_hours_format_frontend', array($this, 'opening_hours_format_frontend_callback'), 10, 2);
       add_filter('foodbakery_open_hour_after_item', array($this, 'foodbakery_open_hour_after_item_callback'), 10, 3);
    }
    
    /*
     * Change Opening Hours Format
     */
    public function opening_hours_time_format_callback($opening_hours_single_day_val){
        //echo 'testing';
        //date("d/m/Y", strtotime($report_daterange[0]))
        $opening_hours_single_day_val['opening_time'] = date("G:i", strtotime($opening_hours_single_day_val['opening_time']));
        $opening_hours_single_day_val['closing_time'] = date("G:i", strtotime($opening_hours_single_day_val['closing_time']));
        
        return $opening_hours_single_day_val;
    }
    
    /*
     * Change Opening Hours Format
     */
    public function opening_hours_format_frontend_callback($hours, $type_id){
       $lapse = 15;

        $foodbakery_opening_hours_gap = get_post_meta($type_id, 'foodbakery_opening_hours_time_gap', true);
        if (isset($foodbakery_opening_hours_gap) && $foodbakery_opening_hours_gap != '') {
            $lapse = $foodbakery_opening_hours_gap;
        }

        $date = date("Y-m-d 00:00");
        $time = strtotime('00:00');
        $start_time = strtotime($date);
        $endtime = strtotime(date("Y-m-d H:i", strtotime('1440 minutes', $start_time)));

        while ($start_time < $endtime) {
            $time = date("H:i", strtotime('+' . $lapse . ' minutes', $time));
            $hours[$time] = $time;
            $time = strtotime($time);
            $start_time = strtotime(date("Y-m-d H:i", strtotime('+' . $lapse . ' minutes', $start_time)));
        }
        
        return $hours;
    }
    
    public function foodbakery_open_hour_after_item_callback($html, $opening_hours_list, $day){
        
        if( $opening_hours_list[$day]['day_status'] == 'on'){
            if( isset( $opening_hours_list[$day]['opening_time_2'] ) && $opening_hours_list[$day]['opening_time_2'] != ''){
                $monday     = ( isset( $opening_hours_list[$day]['day_status'] ) && $opening_hours_list[$day]['day_status'] == 'on' )?$opening_hours_list[$day]['opening_time_2'] . ' - ' . $opening_hours_list[$day]['closing_time_2']:'Off';
                $html       .= '<li><span>'.__( ucfirst($day), 'foodbakery' ).'</span>' . $monday . '1111111</li>';
            }
        }
        
        return $html;
    }

}

new class_opening_hours_format_frontend();