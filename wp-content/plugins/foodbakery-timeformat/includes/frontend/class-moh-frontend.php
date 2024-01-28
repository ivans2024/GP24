<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('wp_moh_frontend')) {

    class class_moh_frontend {

        /**
         * wp_moh_frontend constructor.
         */
        function __construct() {
            //add_action('wp_multi_opening_hour_fields_frontend', array($this, 'wp_multi_opening_hour_fields_frontend_callback'), 10, 2);
            add_filter('wp_multi_opening_hour_status', array($this, 'wp_multi_opening_hour_status_callback'), 10, 2);
        }

        /*
         * Opening Hours Frontend View
         */

        public function wp_multi_opening_hour_fields_frontend_callback($opening_hours_single_day_var, $opening_hours_single_day_val) {
            //echo 'test-11';
            //print_r( $opening_hours_single_day_val );
            if( isset( $opening_hours_single_day_val['opening_time_2'] ) && ($opening_hours_single_day_val['opening_time_2'] != 'no_selection' && $opening_hours_single_day_val['opening_time_2'] != '') && isset( $opening_hours_single_day_val['closing_time_2'] ) && ($opening_hours_single_day_val['closing_time_2'] != 'no_selection' && $opening_hours_single_day_val['closing_time_2'] != '')){ ?>
            
                <li><a href="javascript:void(0)"><span class="opend-day"><?php echo __( ucfirst($opening_hours_single_day_var), 'foodbakery' ); ?></span> <span class="opend-time"><small>:</small> <?php echo date_i18n('H:i', strtotime($opening_hours_single_day_val['opening_time_2'])); ?> - <?php echo date_i18n('H:i', strtotime($opening_hours_single_day_val['closing_time_2'])); ?></span></a></li>
                
            <?php }
           
        }
        
        public function wp_multi_opening_hour_status_callback($open_flag, $post_id){
            
            if( $open_flag == false){
                $opening_hours_list = get_post_meta($post_id, 'wp_dp_opening_hour', true);
                
                
                
                if (isset($opening_hours_list) && !empty($opening_hours_list) && is_array($opening_hours_list)) {
                    $current_day = strtolower(date('l'));
                    $current_time = date('h:i a', strtotime('+1 hour'));
                    $date1 = DateTime::createFromFormat('H:i a', $current_time);
                    $date2 = DateTime::createFromFormat('H:i a', $opening_hours_list[$current_day]['opening_time_2']);
                    $date3 = DateTime::createFromFormat('H:i a', $opening_hours_list[$current_day]['closing_time_2']);
                    
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

    }

    new class_moh_frontend();
}
?>