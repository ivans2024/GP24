<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('class_moh_front_fields')) {

    class class_moh_front_fields {

        /**
         * wp_moh_back_fields constructor.
         */
        function __construct() {
            add_filter('wp_multi_opening_hour_input_fields_frontend', array($this, 'wp_multi_opening_hour_input_fields_frontend_callback'), 10, 4);
            add_filter('foodbakery_restaurant_save_opening_hours_frontend', array($this, 'foodbakery_restaurant_save_opening_hours_frontend_callback'), 10, 3);
            
        }
        
        /*
         * Saving Opening Hours
         */
        public function foodbakery_restaurant_save_opening_hours_frontend_callback($opening_hours_list, $restaurant_id, $day){
            
            
            $opening_time_2 = ( $opening_hours_list[$day]['opening_time_2'] != '' ? $opening_hours_list[$day]['opening_time_2'] : '' );
            if ($opening_time_2 != '') {
                $opening_time_2 = strtotime('2016-01-01 ' . $opening_time_2);
            }
            $closing_time_2 = ( $opening_hours_list[$day]['closing_time_2'] != '' ? $opening_hours_list[$day]['closing_time_2'] : '' );
            if ($closing_time_2 != '') {
                $closing_time_2 = strtotime('2016-01-01 ' . $closing_time_2);
            }

            if ($opening_time_2 != '' && $closing_time_2 != '' && $opening_time_2 > $closing_time_2) {
                $closing_time_2 = strtotime('+1 day', $closing_time_2);
            }

            update_post_meta($restaurant_id, 'foodbakery_opening_hours_' . $day . '_opening_time_2', $opening_time_2);
            update_post_meta($restaurant_id, 'foodbakery_opening_hours_' . $day . '_closing_time_2', $closing_time_2);
        }

        /*
         * Opening Hours Fields
         */

        public function wp_multi_opening_hour_input_fields_frontend_callback($day_key, $get_opening_hours, $time_list, $empty_return = '') {
            $day_status = isset($get_opening_hours[$day_key]['day_status']) ? $get_opening_hours[$day_key]['day_status'] : '';

                $opening_time = isset($get_opening_hours[$day_key]['opening_time_2']) ? $get_opening_hours[$day_key]['opening_time_2'] : '';
                $closing_time = isset($get_opening_hours[$day_key]['closing_time_2']) ? $get_opening_hours[$day_key]['closing_time_2'] : '';
                if (is_array($time_list) && sizeof($time_list) > 0) {
                    $time_from_html = '<option value="no_selection"' . ($opening_time == 'no_selection' ? ' selected="selected"' : '') . '>No Selection</option>' . "\n";
                    $time_to_html = '<option value="no_selection"' . ($closing_time == 'no_selection' ? ' selected="selected"' : '') . '>No Selection</option>' . "\n";
                    foreach ($time_list as $time_key => $time_val) {
                        $time_from_html .= '<option value="' . $time_key . '"' . ($opening_time == $time_key ? ' selected="selected"' : '') . '>' . date_i18n('H:i', strtotime($time_val)) . '</option>' . "\n";
                        $time_to_html .= '<option value="' . $time_key . '"' . ($closing_time == $time_key ? ' selected="selected"' : '') . '>' . date_i18n('H:i', strtotime($time_val)) . '</option>' . "\n";
                    }
                }


            $response = '&nbsp;&nbsp;&nbsp;<select class="chosen-select opening_hours_fields" name="foodbakery_opening_hour[' . $day_key . '][opening_time_2]">
                    ' . $time_from_html . '
            </select>
            <span class="option-label"> to </span>
            <select class="chosen-select " name="foodbakery_opening_hour[' . $day_key . '][closing_time_2]">
                    ' . $time_to_html . '
            </select>';

            return $response;
        }

    }

    new class_moh_front_fields();
}
?>