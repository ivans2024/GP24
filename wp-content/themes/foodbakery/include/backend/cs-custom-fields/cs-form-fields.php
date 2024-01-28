<?php

/**
 * Form Fields
 */
if (!class_exists('foodbakery_var_form_fields')) {

    class foodbakery_var_form_fields {

        private $counter = 0;

        public function __construct() {

            // Do something...
        }

        /**
         * @ render label
         */
        public function foodbakery_var_form_text_render($params = '') {

            global $post, $pagenow, $user;

            if (isset($params) && is_array($params)) {
                extract($params);
            }
            $foodbakery_var_output = '';
            $prefix_enable = 'true'; // default value of prefix add in name and id
            if (!isset($id)) {
                $id = '';
            }
            if (!isset($std)) {
                $std = '';
            }

            if (isset($prefix_on)) {
                $prefix_enable = $prefix_on;
            }

            $prefix = 'foodbakery_var_'; // default prefix
            if (isset($field_prefix) && $field_prefix != '') {
                $prefix = $field_prefix;
            }
            if ($prefix_enable != true) {
                $prefix = '';
            }
            if ($pagenow == 'post.php' && $id != '') {
                if (isset($cus_field) && $cus_field == true) {
                    $foodbakery_var_value = get_post_meta($post->ID, $id, true);
                } else {
                    $foodbakery_var_value = get_post_meta($post->ID, $prefix . $id, true);
                }
            } elseif (isset($usermeta) && $usermeta == true && $id != '') {
                if (isset($cus_field) && $cus_field == true) {
                    $foodbakery_var_value = get_the_author_meta($id, $user->ID);
                } else {
                    if (isset($id) && $id != '') {
                        $foodbakery_var_value = get_the_author_meta('foodbakery_var_' . $id, $user->ID);
                    }
                }
            } else {
                $foodbakery_var_value = isset($std) ? $std : '';
            }
            if (isset($foodbakery_var_value) && $foodbakery_var_value != '') {
                $value = $foodbakery_var_value;
            } else {
                $value = $std;
            }

            if (isset($force_std) && $force_std == true) {
                $value = $std;
            }

            $foodbakery_var_rand_id = time();

            if (isset($rand_id) && $rand_id != '') {
                $foodbakery_var_rand_id = $rand_id;
            }

            $html_id = ' id="' . $prefix . sanitize_html_class($id) . '"';

            if (isset($cus_field) && $cus_field == true) {
                $html_name = ' name="' . $prefix . 'cus_field[' . sanitize_html_class($id) . ']"';
            } else {
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '"';
            }

            if (isset($array) && $array == true) {
                $html_id = ' id="' . $prefix . sanitize_html_class($id) . $foodbakery_var_rand_id . '"';
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '_array[]"';
            }

            if (isset($cust_id) && $cust_id != '') {
                $html_id = ' id="' . $cust_id . '"';
            }

            if (isset($cust_name) && $cust_name != '') {
                $html_name = ' name="' . $cust_name . '"';
            }

            // Disabled Field
            $foodbakery_var_visibilty = '';
            if (isset($active) && $active == 'in-active') {
                $foodbakery_var_visibilty = 'readonly="readonly"';
            }

            $foodbakery_var_required = '';
            if (isset($required) && $required == 'yes') {
                $foodbakery_var_required = ' required';
            }

            $foodbakery_var_classes = '';
            if (isset($classes) && $classes != '') {
                $foodbakery_var_classes = ' class="' . $classes . '"';
            }
            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }

            $foodbakery_var_input_type = 'text';
            if (isset($cust_type) && $cust_type != '') {
                $foodbakery_var_input_type = $cust_type;
            }

            $foodbakery_var_before = '';
            if (isset($before) && $before != '') {
                $foodbakery_var_before = '<div class="' . $before . '">';
            }

            $foodbakery_var_after = '';
            if (isset($after) && $after != '') {
                $foodbakery_var_after = $after;
            }

            if ($html_id == ' id=""' || $html_id == ' id="foodbakery_var_"') {
                $html_id = '';
            }

            if (isset($rang) && $rang == true && isset($min) && isset($max)) {}
            if (isset($rang) && $rang == true && isset($min) && isset($max)) {
                $foodbakery_var_output .= '<ul><li class="to-field"><div class="cs-drag-slider" data-slider-min="' . $min . '" data-slider-max="' . $max . '" data-slider-step="1" data-slider-value="' . $value . '"></div>';
            }
            
            $foodbakery_var_output .= $foodbakery_var_before;

            if ($value != '') {
                $value = is_array($value) ? $value[0] : $value;
                $foodbakery_var_output .= '<input type="' . $foodbakery_var_input_type . '" ' . $foodbakery_var_visibilty . $foodbakery_var_required . ' ' . $extra_atributes . ' ' . $foodbakery_var_classes . ' ' . $html_id . $html_name . ' value="' . $value . '" />';
            } else {
                $foodbakery_var_output .= '<input type="' . $foodbakery_var_input_type . '" ' . $foodbakery_var_visibilty . $foodbakery_var_required . ' ' . $extra_atributes . ' ' . $foodbakery_var_classes . ' ' . $html_id . $html_name . ' />';
            }
            if (isset($rang) && $rang == true && isset($min) && isset($max)) {
                $foodbakery_var_output .= "</li></ul>";
            }
            $foodbakery_var_output .= $foodbakery_var_after;

            if (isset($return) && $return == true) {
                return foodbakery_allow_special_char($foodbakery_var_output);
            } else {
                echo foodbakery_allow_special_char($foodbakery_var_output);
            }
        }

        /**
         * @ render Radio field
         */
        public function foodbakery_var_form_radio_render($params = '') {
            global $post, $pagenow;
            extract($params);

            $foodbakery_var_output = '';

            if (!isset($id)) {
                $id = '';
            }

            $prefix_enable = 'true'; // default value of prefix add in name and id

            if (isset($prefix_on)) {
                $prefix_enable = $prefix_on;
            }

            $prefix = 'foodbakery_var_';    // default prefix
            if (isset($field_prefix) && $field_prefix != '') {
                $prefix = $field_prefix;
            }
            if ($prefix_enable != true) {
                $prefix = '';
            }

            if ($pagenow == 'post.php' && $id != '') {
                $foodbakery_var_value = get_post_meta($post->ID, 'foodbakery_var_' . $id, true);
                if (isset($foodbakery_var_value) && $foodbakery_var_value != '') {
                    $value = $foodbakery_var_value;
                } else {
                    $value = $std;
                }
            } else {
                $value = $std;
            }

            if (isset($cus_field) && $cus_field == true) {
                $html_name = ' name="' . $prefix . 'cus_field[' . sanitize_html_class($id) . ']"';
            } else {
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '"';
            }

            if (isset($array) && $array == true) {
                $html_id = ' id="' . $prefix . sanitize_html_class($id) . $foodbakery_var_rand_id . '"';
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '_array[]"';
            }

            if (isset($cust_id) && $cust_id != '') {
                $html_id = ' id="' . $cust_id . '"';
            }

            if (isset($cust_name)) {
                $html_name = ' name="' . $cust_name . '"';
            }

            $html_id = isset($html_id) ? $html_id : '';

            // Disbaled Field
            $foodbakery_var_visibilty = '';
            if (isset($active) && $active == 'in-active') {
                $foodbakery_var_visibilty = 'readonly="readonly"';
            }
            $foodbakery_var_required = '';
            if (isset($required) && $required == 'yes') {
                $foodbakery_var_required = ' required';
            }
            $foodbakery_var_classes = '';
            if (isset($classes) && $classes != '') {
                $foodbakery_var_classes = ' class="' . $classes . '"';
            }

            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }

            if ($html_id == ' id=""' || $html_id == ' id="foodbakery_var_"') {
                $html_id = '';
            }

            $foodbakery_var_output .= '<input type="radio" ' . $foodbakery_var_visibilty . $foodbakery_var_required . ' ' . $foodbakery_var_classes . ' ' . $extra_atributes . ' ' . $html_id . $html_name . ' value="' . sanitize_text_field($value) . '" />';

            if (isset($return) && $return == true) {
                return foodbakery_allow_special_char($foodbakery_var_output);
            } else {
                echo foodbakery_allow_special_char($foodbakery_var_output);
            }
        }

        /**
         * @ render Radio field
         */
        public function foodbakery_var_form_hidden_render($params = '') {
            global $post, $pagenow;
            extract($params);

            $foodbakery_var_rand_id = time();

            if (!isset($id)) {
                $id = '';
            }
            $html_id = '';
            $html_id = ' id="foodbakery_var_' . sanitize_html_class($id) . '"';
            $html_name = ' name="foodbakery_var_' . sanitize_html_class($id) . '"';

            if (isset($array) && $array == true) {
                $html_name = ' name="foodbakery_var_' . sanitize_html_class($id) . '_array[]"';
            }

            if (isset($cust_id) && $cust_id != '') {
                $html_id = ' id="' . $cust_id . '"';
            }

            if (isset($cust_name)) {
                $html_name = ' name="' . $cust_name . '"';
            }

            $foodbakery_var_classes = '';
            if (isset($classes) && $classes != '') {
                $foodbakery_var_classes = ' class="' . $classes . '"';
            }

            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }

            if ($html_id == ' id=""' || $html_id == ' id="foodbakery_var_"') {
                $html_id = '';
            }

            $foodbakery_var_output = '<input type="hidden" ' . $html_id . ' ' . $foodbakery_var_classes . ' ' . $extra_atributes . ' ' . $html_name . ' value="' . sanitize_text_field($std) . '" />';
            if (isset($return) && $return == true) {
                return foodbakery_allow_special_char($foodbakery_var_output);
            } else {
                echo foodbakery_allow_special_char($foodbakery_var_output);
            }
        }

        /**
         * @ render Date field
         */
        public function foodbakery_var_form_date_render($params = '') {

            global $post, $pagenow, $user;
            $foodbakery_var_format = 'd-m-Y';
            if (isset($format) && $format != '') {
                $foodbakery_var_format = $format;
            }

            if (isset($params) && is_array($params)) {
                extract($params);
            }
            $foodbakery_var_output = '';
            $prefix_enable = 'true'; // default value of prefix add in name and id
            if (!isset($id)) {
                $id = '';
            }
            if (!isset($std)) {
                $std = '';
            }

            if (isset($prefix_on)) {
                $prefix_enable = $prefix_on;
            }

            $prefix = 'foodbakery_var_'; // default prefix
            if (isset($field_prefix) && $field_prefix != '') {
                $prefix = $field_prefix;
            }
            if ($prefix_enable != true) {
                $prefix = '';
            }
            if ($pagenow == 'post.php' && $id != '') {
                if (isset($cus_field) && $cus_field == true) {
                    $foodbakery_var_value = get_post_meta($post->ID, $id, true);
                } else {
                    $foodbakery_var_value = get_post_meta($post->ID, $prefix . $id, true);
                }
            } elseif (isset($usermeta) && $usermeta == true && $id != '') {
                if (isset($cus_field) && $cus_field == true) {
                    $foodbakery_var_value = get_the_author_meta($id, $user->ID);
                } else {
                    if (isset($id) && $id != '') {
                        $foodbakery_var_value = get_the_author_meta('foodbakery_var_' . $id, $user->ID);
                    }
                }
            } else {
                $foodbakery_var_value = isset($std) ? $std : '';
            }
            if (isset($foodbakery_var_value) && $foodbakery_var_value != '') {
                $value = $foodbakery_var_value;
            } else {
                $value = $std;
            }

            if (isset($force_std) && $force_std == true) {
                $value = $std;
            }

            $foodbakery_var_rand_id = time();

            if (isset($rand_id) && $rand_id != '') {
                $foodbakery_var_rand_id = $rand_id;
            }

            $html_id = ' id="' . $prefix . sanitize_html_class($id) . '"';

            if (isset($cus_field) && $cus_field == true) {
                $html_name = ' name="' . $prefix . 'cus_field[' . sanitize_html_class($id) . ']"';
            } else {
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '"';
            }

            if (isset($array) && $array == true) {
                $html_id = ' id="' . $prefix . sanitize_html_class($id) . $foodbakery_var_rand_id . '"';
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '_array[]"';
            }

            if (isset($cust_id) && $cust_id != '') {
                $html_id = ' id="' . $cust_id . '"';
            }

            if (isset($cust_name) && $cust_name != '') {
                $html_name = ' name="' . $cust_name . '"';
            }

            // Disabled Field
            $foodbakery_var_visibilty = '';
            if (isset($active) && $active == 'in-active') {
                $foodbakery_var_visibilty = 'readonly="readonly"';
            }

            $foodbakery_var_required = '';
            if (isset($required) && $required == 'yes') {
                $foodbakery_var_required = ' required';
            }

            $foodbakery_var_classes = '';
            if (isset($classes) && $classes != '') {
                $foodbakery_var_classes = ' class="' . $classes . '"';
            }
            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }

            $foodbakery_var_input_type = 'text';
            if (isset($cust_type) && $cust_type != '') {
                $foodbakery_var_input_type = $cust_type;
            }

            $foodbakery_var_before = '';
            if (isset($before) && $before != '') {
                $foodbakery_var_before = '<div class="' . $before . '">';
            }

            $foodbakery_var_after = '';
            if (isset($after) && $after != '') {
                $foodbakery_var_after = $after;
            }

            if ($html_id == ' id=""' || $html_id == ' id="foodbakery_var_"') {
                $html_id = '';
            }

            if (isset($rang) && $rang == true && isset($min) && isset($max)) {
                $foodbakery_var_output .= '<div class="cs-drag-slider" data-slider-min="' . absint($min) . '" data-slider-max="' . absint($max) . '" data-slider-step="1" data-slider-value="' . $value . '">';
            }
            $foodbakery_var_output .= $foodbakery_var_before;
			
			$foodbakery_var_output .= '<script>
                                jQuery(function(){
                                    jQuery("#' . $cust_id . '").datetimepicker({
                                        format:"' . $foodbakery_var_format . '",
                                        timepicker:false
                                    });
                                });
                          </script>';
			
			if ($value != '') {
                $foodbakery_var_output .= '<input type="' . $foodbakery_var_input_type . '" ' . $foodbakery_var_visibilty . $foodbakery_var_required . ' ' . $extra_atributes . ' ' . $foodbakery_var_classes . ' ' . $html_id . $html_name . ' value="' . $value . '" />';
            } else {
                $foodbakery_var_output .= '<input type="' . $foodbakery_var_input_type . '" ' . $foodbakery_var_visibilty . $foodbakery_var_required . ' ' . $extra_atributes . ' ' . $foodbakery_var_classes . ' ' . $html_id . $html_name . ' />';
            }

            $foodbakery_var_output .= $foodbakery_var_after;

            if (isset($return) && $return == true) {
                return foodbakery_allow_special_char($foodbakery_var_output);
            } else {
                echo foodbakery_allow_special_char($foodbakery_var_output);
            }
        }

        /**
         * @ render Textarea field
         */
        public function foodbakery_var_form_textarea_render($params = '') {
            global $post, $pagenow;
            extract($params);

            $foodbakery_var_output = '';
            if (!isset($id)) {
                $id = '';
            }
			
			if ($pagenow == 'post.php') {
				
                if (isset($cus_field) && $cus_field == true) {
                    $foodbakery_var_value = get_post_meta($post->ID, $id, true);
				} else {
                    $foodbakery_var_value = get_post_meta($post->ID, 'foodbakery_var_' . $id, true);
				}
			} elseif (isset($usermeta) && $usermeta == true) {
                if (isset($cus_field) && $cus_field == true) {
                    $foodbakery_var_value = get_the_author_meta($id, $user->ID);
                } else {
                    if (isset($id) && $id != '') {
                        $foodbakery_var_value = get_the_author_meta('foodbakery_var_' . $id, $user->ID);
                    }
                }
            } else {
                $foodbakery_var_value = $std;
            }
			
			if (isset($foodbakery_var_value) && $foodbakery_var_value != '') {
                $value = $foodbakery_var_value;
            } else {
                $value = $std;
            }

            $foodbakery_var_rand_id = time();

            if (isset($force_std) && $force_std == true) {
                $value = $std;
            }

            $html_id = ' id="foodbakery_var_' . sanitize_html_class($id) . '"';
            if (isset($cus_field) && $cus_field == true) {
                $html_name = ' name="foodbakery_var_cus_field[' . sanitize_html_class($id) . ']"';
            } else {
                $html_name = ' name="foodbakery_var_' . sanitize_html_class($id) . '"';
            }

            if (isset($array) && $array == true) {
                $html_id = ' id="foodbakery_var_' . sanitize_html_class($id) . $foodbakery_var_rand_id . '"';
                $html_name = ' name="foodbakery_var_' . sanitize_html_class($id) . '_array[]"';
            }

            if (isset($cust_id) && $cust_id != '') {
                $html_id = ' id="' . $cust_id . '"';
            }

            if (isset($cust_name)) {
                $html_name = ' name="' . $cust_name . '"';
            }

            $foodbakery_var_required = '';
            if (isset($required) && $required == 'yes') {
                $foodbakery_var_required = ' required';
            }
            $foodbakery_var_before = '';
            if (isset($before) && $before != '') {
                $foodbakery_var_before = '<div class="' . $before . '">';
            }

            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }

            $foodbakery_var_classes = '';
            if (isset($classes) && $classes != '') {
                $foodbakery_var_classes = ' class="' . $classes . '"';
            }

            $foodbakery_var_after = '';
            if (isset($after) && $after != '') {
                $foodbakery_var_after = '</div>';
            }

            if ($html_id == ' id=""' || $html_id == ' id="foodbakery_var_"') {
                $html_id = '';
            }

            $foodbakery_var_output .= $foodbakery_var_before;
            $foodbakery_var_output .= ' <textarea' . $foodbakery_var_required . ' ' . $extra_atributes . ' ' . $html_id . $html_name . $foodbakery_var_classes . '>' . $value . '</textarea>';
            $foodbakery_var_output .= $foodbakery_var_after;

            if (isset($return) && $return == true) {
                return foodbakery_allow_special_char($foodbakery_var_output);
            } else {
                echo foodbakery_allow_special_char($foodbakery_var_output);
            }
        }

        /**
         * @ render select field
         */
        public function foodbakery_var_form_select_render($params = '') {
            global $post, $pagenow;
            extract($params);
            $prefix_enable = 'true';    // default value of prefix add in name and id
            if (!isset($id)) {
                $id = '';
            }
            $foodbakery_var_output = '';

            if (isset($prefix_on)) {
                $prefix_enable = $prefix_on;
            }

            $prefix = 'foodbakery_var_';    // default prefix
            if (isset($field_prefix) && $field_prefix != '') {
                $prefix = $field_prefix;
            }
            if ($prefix_enable != true) {
                $prefix = '';
            }

            $foodbakery_var_onchange = '';

            if ($pagenow == 'post.php' && $id != '') {
                if (isset($cus_field) && $cus_field == true) {
                    $foodbakery_var_value = get_post_meta($post->ID, $id, true);
                } else {
                    $foodbakery_var_value = get_post_meta($post->ID, $prefix . $id, true);
                }
            } elseif (isset($usermeta) && $usermeta == true) {
                if (isset($cus_field) && $cus_field == true) {
                    $foodbakery_var_value = get_the_author_meta($id, $user->ID);
                } else {
                    if (isset($id) && $id != '') {
                        $foodbakery_var_value = get_the_author_meta('foodbakery_var_' . $id, $user->ID);
                    }
                }
            } else {
                $foodbakery_var_value = $std;
            }

            if (isset($foodbakery_var_value) && $foodbakery_var_value != '') {
                $value = $foodbakery_var_value;
            } else {
                $value = $std;
            }

            $foodbakery_var_rand_id = time();
            if (isset($rand_id) && $rand_id != '') {
                $foodbakery_var_rand_id = $rand_id;
            }

            $html_wraper = ' id="wrapper_' . sanitize_html_class($id) . '"';
            $html_id = ' id="' . $prefix . sanitize_html_class($id) . '"';
            if (isset($cus_field) && $cus_field == true) {
                $html_name = ' name="' . $prefix . 'cus_field[' . sanitize_html_class($id) . ']"';
            } else {
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '"';
            }

            if (isset($array) && $array == true) {
                $html_id = ' id="' . $prefix . sanitize_html_class($id) . $foodbakery_var_rand_id . '"';
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '_array[]"';
                $html_wraper = ' id="wrapper_' . sanitize_html_class($id) . $foodbakery_var_rand_id . '"';
            }

            if (isset($cust_id) && $cust_id != '') {
                $html_id = ' id="' . $cust_id . '"';
            }

            if (isset($cust_name)) {
                $html_name = ' name="' . $cust_name . '"';
            }

            $foodbakery_var_display = '';
            if (isset($status) && $status == 'hide') {
                $foodbakery_var_display = 'style=display:none';
            }

            if (isset($onclick) && $onclick != '') {
                $foodbakery_var_onchange = 'onchange="' . $onclick . '"';
            }

            $foodbakery_var_visibilty = '';
            if (isset($active) && $active == 'in-active') {
                $foodbakery_var_visibilty = 'readonly="readonly"';
            }
            $foodbakery_var_required = '';
            if (isset($required) && $required == 'yes') {
                $foodbakery_var_required = ' required';
            }
            $foodbakery_var_classes = '';
            if (isset($classes) && $classes != '') {
                $foodbakery_var_classes = ' class="' . $classes . '"';
            }
            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }

            if (isset($markup) && $markup != '') {
                $foodbakery_var_output .= $markup;
            }

            if (isset($div_classes) && $div_classes <> "") {
                $foodbakery_var_output .= '<div class="' . esc_attr($div_classes) . '">';
            }

            if ($html_id == ' id=""' || $html_id == ' id="foodbakery_var_"') {
                $html_id = '';
            }

            $foodbakery_var_output .= '<select ' . $foodbakery_var_visibilty . ' ' . $foodbakery_var_required . ' ' . $extra_atributes . ' ' . $foodbakery_var_classes . ' ' . $html_id . $html_name . ' ' . $foodbakery_var_onchange . ' >';
            if (isset($options_markup) && $options_markup == true) {
                $foodbakery_var_output .= $options;
            } else {
                if (isset($first_option) && $first_option <> "") {
                    $foodbakery_var_output .= $first_option;
                }
                if (is_array($options)) {
                    foreach ($options as $key => $option) {
                        if (!is_array($option)) {
                            $foodbakery_var_output .= '<option ' . selected($key, $value, false) . ' value="' . $key . '">' . $option . '</option>';
                        }
                    }
                }
            }
            $foodbakery_var_output .= '</select>';

            if (isset($div_classes) && $div_classes <> "") {
                $foodbakery_var_output .= '</div>';
            }

            if (isset($return) && $return == true) {
                return foodbakery_allow_special_char($foodbakery_var_output);
            } else {
                echo foodbakery_allow_special_char($foodbakery_var_output);
            }
        }

        /**
         * @ render Multi Select field
         */
        public function foodbakery_var_form_multiselect_render($params = '') {
            global $post, $pagenow;
            extract($params);

            $foodbakery_var_output = '';

            $prefix_enable = 'true';    // default value of prefix add in name and id
            if (isset($prefix_on)) {
                $prefix_enable = $prefix_on;
            }

            $prefix = 'foodbakery_var_';    // default prefix
            if (isset($field_prefix) && $field_prefix != '') {
                $prefix = $field_prefix;
            }
            if ($prefix_enable != true) {
                $prefix = '';
            }
            $foodbakery_var_onchange = '';

            if ($pagenow == 'post.php') {
                if (isset($cus_field) && $cus_field == true) {
                    $foodbakery_var_value = get_post_meta($post->ID, $id, true);
                } else {
                    $foodbakery_var_value = get_post_meta($post->ID, $prefix . $id, true);
                }
            } elseif (isset($usermeta) && $usermeta == true) {
                if (isset($cus_field) && $cus_field == true) {
                    $foodbakery_var_value = get_the_author_meta($id, $user->ID);
                } else {
                    if (isset($id) && $id != '') {
                        $foodbakery_var_value = get_the_author_meta('foodbakery_var_' . $id, $user->ID);
                    }
                }
            } else {
                $foodbakery_var_value = $std;
            }
            if (isset($foodbakery_var_value) && $foodbakery_var_value != '') {
                $value = $foodbakery_var_value;
            } else {
                $value = $std;
            }
            $foodbakery_var_rand_id = time();
            if (isset($rand_id) && $rand_id != '') {
                $foodbakery_var_rand_id = $rand_id;
            }
            $html_wraper = '';
            if (isset($id) && $id != '') {
                $html_wraper = ' id="wrapper_' . sanitize_html_class($id) . '"';
            }
            $html_id = '';
            if (isset($id) && $id != '') {
                $html_id = ' id="' . $prefix . sanitize_html_class($id) . '"';
            }
            $html_name = '';
            if (isset($cus_field) && $cus_field == true) {
                $html_name = ' name="' . $prefix . 'cus_field[' . sanitize_html_class($id) . '][]"';
            } else {
                if (isset($id) && $id != '') {
                    $html_name = ' name="' . $prefix . sanitize_html_class($id) . '[]"';
                }
            }

            if (isset($cust_id) && $cust_id != '') {
                $html_id = ' id="' . $cust_id . '"';
            }

            if (isset($cust_name)) {
                $html_name = ' name="' . $cust_name . '"';
            }

            $foodbakery_var_display = '';
            if (isset($status) && $status == 'hide') {
                $foodbakery_var_display = 'style=display:none';
            }

            if (isset($onclick) && $onclick != '') {
                $foodbakery_var_onchange = 'onchange="javascript:' . $onclick . '(this.value, \'' . esc_js(admin_url('admin-ajax.php')) . '\')"';
            }

            if (!is_array($value) && $value != '') {
                $value = explode(',', $value);
            }

            if (!is_array($value)) {
                $value = array();
            }

            // Disbaled Field
            $foodbakery_var_visibilty = '';
            if (isset($active) && $active == 'in-active') {
                $foodbakery_var_visibilty = 'readonly="readonly"';
            }
            $foodbakery_var_required = '';
            if (isset($required) && $required == 'yes') {
                $foodbakery_var_required = ' required';
            }
            $foodbakery_var_classes = '';
            if (isset($classes) && $classes != '') {
                $foodbakery_var_classes = ' class="multiple ' . $classes . '"';
            } else {
                $foodbakery_var_classes = ' class="multiple"';
            }
            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }

            if ($html_id == ' id=""' || $html_id == ' id="foodbakery_var_"') {
                $html_id = '';
            }

            $foodbakery_var_output .= '<select' . $foodbakery_var_visibilty . $foodbakery_var_required . ' ' . $extra_atributes . ' ' . $foodbakery_var_classes . ' ' . ' multiple="multiple" ' . $html_id . $html_name . ' ' . $foodbakery_var_onchange . ' style="height:110px !important;">';

            if (isset($options_markup) && $options_markup == true) {
                $foodbakery_var_output .= $options;
            } else {
                foreach ($options as $key => $option) {
                    $selected = '';
                    if (in_array($key, $value)) {
                        $selected = 'selected="selected"';
                    }

                    $foodbakery_var_output .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
                }
            }
            $foodbakery_var_output .= '</select>';

            if (isset($return) && $return == true) {
                return foodbakery_allow_special_char($foodbakery_var_output);
            } else {
                echo foodbakery_allow_special_char($foodbakery_var_output);
            }
        }

        /**
         * @ render Checkbox field
         */
        public function foodbakery_var_form_checkbox_render($params = '') {
            global $post, $pagenow;
            extract($params);
            $prefix_enable = 'true';    // default value of prefix add in name and id

            $foodbakery_var_output = '';

            if (isset($prefix_on)) {
                $prefix_enable = $prefix_on;
            }

            if (!isset($id)) {
                $id = '';
            }

            $prefix = 'foodbakery_var_';    // default prefix
            if (isset($field_prefix) && $field_prefix != '') {
                $prefix = $field_prefix;
            }
            if ($prefix_enable != true) {
                $prefix = '';
            }
            if ($pagenow == 'post.php') {
                $foodbakery_var_value = get_post_meta($post->ID, 'foodbakery_var_' . $id, true);
            } elseif (isset($usermeta) && $usermeta == true) {
                if (isset($cus_field) && $cus_field == true) {
                    $foodbakery_var_value = get_the_author_meta($id, $user->ID);
                } else {
                    if (isset($id) && $id != '') {
                        $foodbakery_var_value = get_the_author_meta('foodbakery_var_' . $id, $user->ID);
                    }
                }
            } else {
                $foodbakery_var_value = $std;
            }

            if (isset($foodbakery_var_value) && $foodbakery_var_value != '') {
                $value = $foodbakery_var_value;
            } else {
                $value = $std;
            }

            $foodbakery_var_rand_id = time();

            $html_id = ' id="' . $prefix . sanitize_html_class($id) . '"';
            $btn_name = ' name="' . $prefix . sanitize_html_class($id) . '"';
            $html_name = ' name="' . $prefix . sanitize_html_class($id) . '"';

            if (isset($array) && $array == true) {
                $html_id = ' id="' . $prefix . sanitize_html_class($id) . $foodbakery_var_rand_id . '"';
                $btn_name = ' name="' . $prefix . sanitize_html_class($id) . $foodbakery_var_rand_id . '"';
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '_array[]"';
            }

            if (isset($cust_id) && $cust_id != '') {
                $html_id = ' id="' . $cust_id . '"';
            }

            if (isset($cust_name)) {
                $html_name = ' name="' . $cust_name . '"';
            }

            $checked = isset($value) && $value == 'on' ? ' checked="checked"' : '';
            // Disbaled Field
            $foodbakery_var_visibilty = '';
            if (isset($active) && $active == 'in-active') {
                $foodbakery_var_visibilty = 'readonly="readonly"';
            }
            $foodbakery_var_required = '';
            if (isset($required) && $required == 'yes') {
                $foodbakery_var_required = ' required';
            }
            $foodbakery_var_classes = '';
            if (isset($classes) && $classes != '') {
                $foodbakery_var_classes = ' class="' . $classes . '"';
            }
            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }

            if ($html_id == ' id=""' || $html_id == ' id="foodbakery_var_"') {
                $html_id = '';
            }

            if (isset($simple) && $simple == true) {
                if ($value == '') {
                    $foodbakery_var_output .= '<input type="checkbox" ' . $html_id . $html_name . ' ' . $foodbakery_var_classes . ' ' . $checked . ' ' . $extra_atributes . ' />';
                } else {
                    $foodbakery_var_output .= '<input type="checkbox" ' . $html_id . $html_name . ' ' . $foodbakery_var_classes . ' ' . $checked . ' value="' . $value . '"' . $extra_atributes . ' />';
                }
            } else {
                $foodbakery_var_output .= '<label class="pbwp-checkbox cs-chekbox">';
                $foodbakery_var_output .= '<input type="hidden"' . $html_id . $html_name . ' value="' . sanitize_text_field($std) . '" />';
                $foodbakery_var_output .= '<input type="checkbox" ' . $foodbakery_var_classes . ' ' . $btn_name . $checked . ' ' . $extra_atributes . ' />';
                $foodbakery_var_output .= '<span class="pbwp-box"></span>';
                $foodbakery_var_output .= '</label>';
            }

            if (isset($return) && $return == true) {
                return foodbakery_allow_special_char($foodbakery_var_output);
            } else {
                echo foodbakery_allow_special_char($foodbakery_var_output);
            }
        }

        /**
         * @ render Checkbox With Input Field
         */
        public function foodbakery_var_form_checkbox_with_field_render($params = '') {
            global $post, $pagenow;
            extract($params);
            extract($field);
            $prefix_enable = 'true';    // default value of prefix add in name and id

            if (isset($prefix_on)) {
                $prefix_enable = $prefix_on;
            }

            $prefix = 'foodbakery_var_';    // default prefix
            if (isset($field_prefix) && $field_prefix != '') {
                $prefix = $field_prefix;
            }
            if ($prefix_enable != true) {
                $prefix = '';
            }

            $foodbakery_var_value = get_post_meta($post->ID, $prefix . $id, true);
            if (isset($usermeta) && $usermeta == true) {
                if (isset($cus_field) && $cus_field == true) {
                    $foodbakery_var_value = get_the_author_meta($id, $user->ID);
                } else {
                    if (isset($id) && $id != '') {
                        $foodbakery_var_value = get_the_author_meta('foodbakery_var_' . $id, $user->ID);
                    }
                }
            }
            if (isset($foodbakery_var_value) && $foodbakery_var_value != '') {
                $value = $foodbakery_var_value;
            } else {
                $value = $std;
            }

            $foodbakery_var_input_value = get_post_meta($post->ID, $prefix . $field_id, true);
            if (isset($foodbakery_var_input_value) && $foodbakery_var_input_value != '') {
                $input_value = $foodbakery_var_input_value;
            } else {
                $input_value = $field_std;
            }

            $foodbakery_var_visibilty = ''; // Disbaled Field
            if (isset($active) && $active == 'in-active') {
                $foodbakery_var_visibilty = 'readonly="readonly"';
            }
            $foodbakery_var_required = '';
            if (isset($required) && $required == 'yes') {
                $foodbakery_var_required = ' required';
            }
            $foodbakery_var_classes = '';
            if (isset($classes) && $classes != '') {
                $foodbakery_var_classes = ' class="' . $classes . '"';
            }
            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }

            $foodbakery_var_output .= '<label class="pbwp-checkbox">';
            $foodbakery_var_output .= $this->foodbakery_var_form_hidden_render(array('id' => $id, 'std' => '', 'type' => '', 'return' => 'return'));
            $foodbakery_var_output .= '<input type="checkbox" ' . $foodbakery_var_visibilty . $foodbakery_var_required . ' ' . $extra_atributes . ' ' . $foodbakery_var_classes . ' ' . ' name="' . $prefix . sanitize_html_class($id) . '" id="' . $prefix . sanitize_html_class($id) . '" value="' . sanitize_text_field('on') . '" ' . checked('on', $value, false) . ' />';
            $foodbakery_var_output .= '<span class="pbwp-box"></span>';
            $foodbakery_var_output .= '</label>';
            $foodbakery_var_output .= '<input type="text" name="' . $prefix . sanitize_html_class($field_id) . '"  value="' . sanitize_text_field($input_value) . '">';
            $foodbakery_var_output .= $this->foodbakery_var_form_description($description);

            if (isset($return) && $return == true) {
                return foodbakery_allow_special_char($foodbakery_var_output);
            } else {
                echo foodbakery_allow_special_char($foodbakery_var_output);
            }
        }

        /**
         * @ render File Upload field
         */
        public function foodbakery_var_media_url($params = '') {
            global $post, $pagenow, $foodbakery_var_static_text;
            $strings = new foodbakery_theme_all_strings;
            $strings->foodbakery_theme_option_field_strings();
            extract($params);

            $foodbakery_var_output = '';

            $foodbakery_var_value = isset($post->ID) ? get_post_meta($post->ID, 'foodbakery_var_' . $id, true) : '';
            if (isset($usermeta) && $usermeta == true) {
                if (isset($cus_field) && $cus_field == true) {
                    $foodbakery_var_value = get_the_author_meta($id, $user->ID);
                } else {
                    if (isset($dp) && $dp == true) {
                        $foodbakery_var_value = get_the_author_meta($id, $user->ID);
                    } else {
                        if (isset($id) && $id != '') {
                            $foodbakery_var_value = get_the_author_meta('foodbakery_var_' . $id, $user->ID);
                        }
                    }
                }
            }
            if (isset($foodbakery_var_value) && $foodbakery_var_value != '') {
                $value = $foodbakery_var_value;
            } else {
                $value = $std;
            }

            $foodbakery_var_rand_id = time();

            if (isset($force_std) && $force_std == true) {
                $value = $std;
            }

            $html_id = ' id="foodbakery_var_' . sanitize_html_class($id) . '"';
            $html_id_btn = ' id="foodbakery_var_' . sanitize_html_class($id) . '_btn"';
            $html_name = ' name="foodbakery_var_' . sanitize_html_class($id) . '"';

            if (isset($array) && $array == true) {
                $html_id = ' id="foodbakery_var_' . sanitize_html_class($id) . $foodbakery_var_rand_id . '"';
                $html_id_btn = ' id="foodbakery_var_' . sanitize_html_class($id) . $foodbakery_var_rand_id . '_btn"';
                $html_name = ' name="foodbakery_var_' . sanitize_html_class($id) . '_array[]"';
            }
            $foodbakery_var_output .= '<input type="text" class="cs-form-text cs-input" ' . $html_id . $html_name . ' value="' . sanitize_text_field($value) . '" />';
            $foodbakery_var_output .= '<label class="cs-browse">';
            $foodbakery_var_output .= '<input type="button" ' . $html_id_btn . $html_name . ' class="uploadfile left" value="' . foodbakery_var_theme_text_srt('foodbakery_var_browse') . '"/>';
            $foodbakery_var_output .= '</label>';

            if (isset($return) && $return == true) {
                return $foodbakery_var_output;
            } else {
                echo foodbakery_allow_special_char($foodbakery_var_output);
            }
        }

        /**
         * @ render File Upload field
         */
        public function foodbakery_var_form_fileupload_render($params = '') {
            global $post, $pagenow, $image_val, $foodbakery_var_static_text;
            $strings = new foodbakery_theme_all_strings;
            $strings->foodbakery_theme_option_field_strings();
            extract($params);

            $foodbakery_var_output = '';
            if ($pagenow == 'post.php') {

                if (isset($dp) && $dp == true) {
                    $foodbakery_var_value = get_post_meta($post->ID, $id, true);
                } else {
                    $foodbakery_var_value = get_post_meta($post->ID, 'foodbakery_var_' . $id, true);
                }
            } elseif (isset($usermeta) && $usermeta == true) {
                if (isset($cus_field) && $cus_field == true) {
                    $foodbakery_var_value = get_the_author_meta($id, $user->ID);
                } else {
                    if (isset($dp) && $dp == true) {
                        $foodbakery_var_value = get_the_author_meta($id, $user->ID);
                    } else {
                        if (isset($id) && $id != '') {
                            $foodbakery_var_value = get_the_author_meta('foodbakery_var_' . $id, $user->ID);
                        }
                    }
                }
            } else {
                $foodbakery_var_value = $std;
            }

            if (isset($foodbakery_var_value) && $foodbakery_var_value != '') {
                $value = $foodbakery_var_value;
                if (isset($dp) && $dp == true) {
                    $value = foodbakery_var_get_img_url($foodbakery_var_value, 'foodbakery_var_media_5');
                } else {
                    $value = $foodbakery_var_value;
                }
            } else {
                $value = $std;
            }

            if (isset($force_std) && $force_std == true) {
                $value = $std;
            }

            $btn_name = ' name="foodbakery_var_' . sanitize_html_class($id) . '"';
            $html_id = ' id="foodbakery_var_' . sanitize_html_class($id) . '"';
            $html_name = ' name="foodbakery_var_' . sanitize_html_class($id) . '"';

            if (isset($array) && $array == true) {
                $btn_name = ' name="foodbakery_var_' . sanitize_html_class($id) . $foodbakery_var_random_id . '"';
                $html_id = ' id="foodbakery_var_' . sanitize_html_class($id) . $foodbakery_var_random_id . '"';
                $html_name = ' name="foodbakery_var_' . sanitize_html_class($id) . '_array[]"';
            } else if (isset($dp) && $dp == true) {
                $html_name = ' name="' . sanitize_html_class($id) . '"';
            }

            if (isset($cust_name) && $cust_name == true) {
                $html_name = ' name="' . $cust_name . '"';
            }

            if (isset($value) && $value != '') {
                $display_btn = ' style=display:none';
            } else {
                $display_btn = ' style=display:block';
            }
            
            $is_multi_images = ( isset( $multi ) && $multi == true)? '-multi' : '';

            $foodbakery_var_output .= '<input' . $html_id . $html_name . 'type="hidden" class="" value="' . $value . '"/>';

            $foodbakery_var_output .= '<label' . $display_btn . ' class="browse-icon"><input' . $btn_name . 'type="button" class="cs-foodbakery-media'.$is_multi_images.' left" value=' . foodbakery_var_theme_text_srt('foodbakery_var_browse') . ' /></label>';

            if (isset($return) && $return == true) {
                return foodbakery_allow_special_char($foodbakery_var_output);
            } else {
                echo foodbakery_allow_special_char($foodbakery_var_output);
            }
        }

        /**
         * @ render Random String
         */
        public function foodbakery_var_generate_random_string($length = 3) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
        }

        /**
         * @ render submit field
         */
        public function foodbakery_var_form_submit_render($params = '') {
            global $post, $pagenow;
            extract($params);

            $foodbakery_rand_id = time();

            if (!isset($id)) {
                $id = '';
            }

            $html_id = ' id="foodbakery_' . sanitize_html_class($id) . '"';
            $html_name = ' name="foodbakery_' . sanitize_html_class($id) . '"';

            if (isset($array) && $array == true) {
                $html_name = ' name="foodbakery_' . sanitize_html_class($id) . '_array[]"';
            }

            if (isset($cust_id) && $cust_id != '') {
                $html_id = ' id="' . $cust_id . '"';
            }

            if (isset($cust_name)) {
                if ($cust_name == '') {
                    $html_name = '';
                } else {
                    $html_name = ' name="' . $cust_name . '"';
                }
            }

            $foodbakery_classes = '';
            if (isset($classes) && $classes != '') {
                $foodbakery_classes = ' class="' . $classes . '"';
            }
            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }
            if ($html_id == ' id=""' || $html_id == ' id="foodbakery_"') {
                $html_id = '';
            }
            $foodbakery_output = '<input type="submit" ' . $html_id . ' ' . $extra_atributes . ' ' . $foodbakery_classes . ' ' . $html_name . ' value="' . sanitize_text_field($std) . '" />';

            if (isset($return) && $return == true) {
                return foodbakery_allow_special_char($foodbakery_output);
            } else {
                echo foodbakery_allow_special_char($foodbakery_output);
            }
        }

    }

    $var_arrays = array('foodbakery_var_form_fields');
    $form_fields_global_vars = FOODBAKERY_VAR_GLOBALS()->globalizing($var_arrays);
    extract($form_fields_global_vars);
    $foodbakery_var_form_fields = new foodbakery_var_form_fields();
}

/**
 * 
 * @ render Wrapper Start
 */
function foodbakery_wrapper_start_render($params = '') {
    global $post, $jobcareer_html_fields;
    extract($params);
    $foodbakery_display = '';
    if (isset($status) && $status == 'hide') {
        $foodbakery_display = 'style="display:none;"';
    }

    $foodbakery_output = '<div class="wrapper_' . sanitize_html_class($id) . '" id="wrapper_' . sanitize_html_class($id) . '" ' . $foodbakery_display . '>';
    echo foodbakery_allow_special_char($foodbakery_output);
}

/**
 * 
 * @ render Wrapper Start
 */
function foodbakery_wrapper_end_render($params = '') {
    global $post, $jobcareer_html_fields;
    extract($params);

    $foodbakery_output = '</div>';
    echo foodbakery_allow_special_char($foodbakery_output);
}
