<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('class_multi_opening_hours_frontend')) {

    class class_multi_opening_hours_frontend {

        /**
         * class_multi_opening_hours_frontend constructor.
         */
        function __construct() {
            add_action('wp_multi_opening_hour_fields_frontend', array($this, 'wp_multi_opening_hour_fields_frontend_callback'), 10, 2);
            add_filter('wp_multi_opening_hour_status', array($this, 'wp_multi_opening_hour_status_callback'), 10, 2);
            
            add_filter('opening_hours_open_time_after_day', array($this, 'opening_hours_open_time_after_day_callback'), 11, 4);
            add_action('wp_multi_opening_hour_current_day', array($this, 'wp_multi_opening_hour_current_day_callback'), 11);
            
            
        }

        /*
         * Opening Hours Frontend View
         */

        public function wp_multi_opening_hour_fields_frontend_callback($opening_hours_single_day_var, $opening_hours_single_day_val) {
            if( isset( $opening_hours_single_day_val['opening_time_2'] ) && ($opening_hours_single_day_val['opening_time_2'] != 'no_selection' && $opening_hours_single_day_val['opening_time_2'] != '') && isset( $opening_hours_single_day_val['closing_time_2'] ) && ($opening_hours_single_day_val['closing_time_2'] != 'no_selection' && $opening_hours_single_day_val['closing_time_2'] != '')){ ?>
            
            &nbsp;&nbsp;&nbsp;&nbsp; /&nbsp;&nbsp;&nbsp;&nbsp; <?php echo date_i18n('h:i a', strtotime($opening_hours_single_day_val['opening_time_2'])); ?> - <?php echo date_i18n('h:i a', strtotime($opening_hours_single_day_val['closing_time_2'])); ?>
                
            <?php }
           
        }
        
        public function wp_multi_opening_hour_status_callback($open_flag, $post_id){
            
            if( $open_flag == false){
                $opening_hours_list = get_post_meta($post_id, 'wp_dp_opening_hour', true);
                
                if (isset($opening_hours_list) && !empty($opening_hours_list) && is_array($opening_hours_list)) {
                    $current_day = strtolower(date('l'));
                    $current_time = date('h:i a', strtotime('+1 hour'));
                    $date1 = DateTime::createFromFormat('h:i a', $current_time);
                    $date2 = DateTime::createFromFormat('h:i a', $opening_hours_list[$current_day]['opening_time_2']);
                    $date3 = DateTime::createFromFormat('h:i a', $opening_hours_list[$current_day]['closing_time_2']);
                    
                    if ($opening_hours_list[$current_day]['day_status'] != 'on') {
                        $open_flag = false;
                    } else if ($date1 >= $date2 && $date1 <= $date3) {
                        $open_flag = true;
                    } else {
                        $open_flag = false;
                    }
                }
            }
            
            return $open_flag;
        }
        
        /*
         * Front end opening hours display in restaurant Info
         */
        public function opening_hours_open_time_after_day_callback($html, $opening_hours_list, $day_slug, $day_label){
            $day_data     = ( isset( $opening_hours_list[$day_slug]['day_status'] ) && $opening_hours_list[$day_slug]['day_status'] == 'on' )?$opening_hours_list[$day_slug]['opening_time_2'] . ' - ' . $opening_hours_list[$day_slug]['closing_time_2']:'Off';
            $day_label_text = __( $day_label, 'foodbakery_multi_opening_hours' );
            if( apply_filters('foodbakery_moh_day_label', true) == false){
                $day_label_text = '&nbsp;';
            }
            if( $day_data != 'Off' && $opening_hours_list[$day_slug]['opening_time_2'] != '' && $opening_hours_list[$day_slug]['closing_time_2'] != ''){
                $html       .= '<li><span>'.$day_label_text.'</span>' . $day_data . '</li>';
            }
            return $html;
        }
        
        public function wp_multi_opening_hour_current_day_callback($current_day_array){
            if( $current_day_array['opening_time_2'] != '' && $current_day_array['closing_time_2'] != ''){
                echo '&nbsp;&nbsp;&nbsp;&nbsp; /&nbsp;&nbsp;&nbsp;&nbsp; ' . esc_html($current_day_array['opening_time_2']) ?> - <?php echo esc_html($current_day_array['closing_time_2']);
            }
        }

    }

    new class_multi_opening_hours_frontend();
}
?>