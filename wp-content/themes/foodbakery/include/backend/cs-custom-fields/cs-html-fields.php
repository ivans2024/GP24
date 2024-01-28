<?php
/**
 * Html Fields
 */
if ( ! class_exists( 'foodbakery_var_html_fields' ) ) {

    class foodbakery_var_html_fields extends foodbakery_var_form_fields {

        public function __construct() {
            // Do something...
        }

        /**
         * opening field markup
         * 
         */
        public function foodbakery_var_opening_field( $params = '' ) {
            extract( $params );
            $foodbakery_var_output = '';
            $foodbakery_var_styles = '';
            if ( isset( $styles ) && $styles != '' ) {
                $foodbakery_var_styles = ' style="' . $styles . '"';
            }
            $cust_id = isset( $id ) ? ' id="' . $id . '"' : '';
            $extra_attr = isset( $extra_att ) ? ' ' . $extra_att . ' ' : '';
            $name = isset( $name ) ? $name : '';
            $foodbakery_var_output .= '<div' . $cust_id . $extra_attr . ' class="form-elements"' . $foodbakery_var_styles . '>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_attr( $name ) . '</label>';
            if ( isset( $hint_text ) && $hint_text != '' ) {
                $foodbakery_var_output .= foodbakery_var_tooltip_helptext( esc_html( $hint_text ) );
            }
            $foodbakery_var_output .= '
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';

            return $foodbakery_var_output;
        }

        /**
         * full opening field markup
         * 
         */
        public function foodbakery_var_full_opening_field( $params = '' ) {
            extract( $params );
            $foodbakery_var_output = '';
            $foodbakery_var_output .= '<div class="form-elements"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';

            return $foodbakery_var_output;
        }

        /**
         * closing field markup
         * 
         */
        public function foodbakery_var_closing_field( $params = '' ) {
            extract( $params );
            $foodbakery_var_output = '';
            if ( isset( $desc ) && $desc != '' ) {
                $foodbakery_var_output .= '<p>' . esc_html( $desc ) . '</p>';
            }
            $foodbakery_var_output .= '</div>';
            if ( isset( $split ) && $split == true ) {
                $foodbakery_var_output .= '<div class="splitter"></div>';
            }
            $foodbakery_var_output .= '</div>';

            return $foodbakery_var_output;
        }

        /**
         * division markup
         * 
         */
        public function foodbakery_var_division( $params = '' ) {
            global $post;
            extract( $params );

            $foodbakery_var_id = 'foodbakery_var_' . $id;

            $d_enable = ' style="display:none;"';
            if ( isset( $enable_val ) ) {

                $d_val = '';
                $d_val = get_post_meta( $post->ID, $enable_id, true );

                $enable_multi = explode( ',', $enable_val );
                if ( is_array( $enable_multi ) && sizeof( $enable_multi ) > 1 ) {
                    $d_enable = in_array( $d_val, $enable_multi ) ? ' style="display:block;"' : ' style="display:none;"';
                } else {
                    $d_enable = $d_val == $enable_val ? ' style="display:block;"' : ' style="display:none;"';
                }
            }

            $foodbakery_var_output = '';
            $foodbakery_var_output .= '<div id="' . $foodbakery_var_id . '"' . $d_enable . '>';

            if ( isset( $return ) && $return == true ) {
                return $foodbakery_var_output;
            } else {
                echo foodbakery_allow_special_char( $foodbakery_var_output );
            }
        }

        /**
         * division markup close
         * 
         */
        public function foodbakery_var_division_close( $params = '' ) {

            extract( $params );
            $foodbakery_var_output = '</div>';

            if ( isset( $return ) && $return == true ) {
                return $foodbakery_var_output;
            } else {
                echo foodbakery_allow_special_char( $foodbakery_var_output );
            }
        }

        /**
         * layout style
         * 
         */
        public function foodbakery_form_layout_render( $params = '' ) {
            global $post, $foodbakery_var_form_fields, $foodbakery_var_html_fields, $pagenow;
            extract( $params );

            $foodbakery_value = get_post_meta( $post->ID, 'foodbakery_var_' . $id, true );
            if ( isset( $foodbakery_value ) && $foodbakery_value != '' ) {
                $value = $foodbakery_value;
            } else {
                $value = $std;
            }

            $foodbakery_left_checklist=$foodbakery_right_checklist = $foodbakery_none_checklist = $foodbakery_right =$foodbakery_left=$foodbakery_none='';
            if ( isset( $foodbakery_value ) ) {
                if ( isset( $value ) && $value == 'left' ) {
                    $foodbakery_left = 'checked';
                    $foodbakery_left_checklist = "class=check-list";
                } else if ( isset( $value ) && $value == 'right' ) {
                    $foodbakery_right = 'checked';
                    $foodbakery_right_checklist = "class=check-list";
                }  else if ( isset( $value ) && $value == 'none' ) {
                    $foodbakery_none = 'checked';
                    $foodbakery_none_checklist = "class=check-list";
                }
            }

            $help_text_str = '';
            if ( isset( $help_text ) && $help_text != '' ) {
                $help_text_str = $help_text;
            }

            $foodbakery_styles = '';
            if ( isset( $styles ) && $styles != '' ) {
                $foodbakery_styles = ' style="' . $styles . '"';
            }
            $cust_id = isset( $id ) ? ' id="' . $id . '"' : '';
            $extra_attr = isset( $extra_att ) ? ' ' . $extra_att . ' ' : '';

            $foodbakery_output = '
			<div  ' . $cust_id . $extra_attr . ' class="form-elements"' . $foodbakery_styles . '>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_attr( $name ) . '</label>
				</div>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
            $foodbakery_output .= '<div class="input-sec">';
            $foodbakery_output .= '<div class="meta-input pattern">';

            $foodbakery_output .= '<div class=\'radio-image-wrapper\'>';
            $foodbakery_opt_array = array(
                'extra_atr' => '' . $foodbakery_none . ' onclick="show_sidebar_page(\'none\')"',
                'cust_name' => 'foodbakery_var_' . sanitize_html_class( $id ),
                'cust_id' => 'page_radio_1',
                'classes' => 'radio',
                'std' => 'none',
                'return' => true,
            );
            $foodbakery_output .= $foodbakery_var_form_fields->foodbakery_var_form_radio_render( $foodbakery_opt_array );
            $foodbakery_output .= '<label for="page_radio_1">';
            $foodbakery_output .= '<span class="ss">';
            $foodbakery_output .= '<img src="' . get_template_directory_uri() . '/assets/backend/images/no_sidebar.png"  alt="no_sidebar" />';
            $foodbakery_output .= '</span>';
            $foodbakery_output .= '<span ' . $foodbakery_none_checklist . ' id="check-list"></span>';
            $foodbakery_output .= '</label>';
            $foodbakery_output .= '<span class="title-theme">' . foodbakery_var_theme_text_srt( 'foodbakery_var_full_width' ) . '</span></div>';

            $foodbakery_output .= '<div class=\'radio-image-wrapper\'>';
            $foodbakery_opt_array = array(
                'extra_atr' => '' . $foodbakery_right . ' onclick="show_sidebar_page(\'right\')"',
                'cust_name' => 'foodbakery_var_' . sanitize_html_class( $id ),
                'cust_id' => 'page_radio_2',
                'classes' => 'radio',
                'std' => 'right',
                'return' => true,
            );
            $foodbakery_output .= $foodbakery_var_form_fields->foodbakery_var_form_radio_render( $foodbakery_opt_array );
            $foodbakery_output .= '<label for="page_radio_2">';
            $foodbakery_output .= '<span class="ss">';
            $foodbakery_output .= '<img src="' . get_template_directory_uri() . '/assets/backend/images/sidebar_right.png" alt="sidebar_right" />';
            $foodbakery_output .= '</span>';
            $foodbakery_output .= '<span ' . $foodbakery_right_checklist . ' id="check-list"></span>';
            $foodbakery_output .= '</label>';
            $foodbakery_output .= '<span class="title-theme">' . foodbakery_var_theme_text_srt( 'foodbakery_var_sidebar_right' ) . '</span> </div>';

            $foodbakery_output .= '<div class=\'radio-image-wrapper\'>';
            $foodbakery_opt_array = array(
                'cust_id' => 'page_radio_3',
                'classes' => 'radio',
                'std' => 'left',
                'extra_atr' => '' . $foodbakery_left . ' onclick="show_sidebar_page(\'left\')"',
                'cust_name' => 'foodbakery_var_' . sanitize_html_class( $id ),
                'return' => true,
            );
            $foodbakery_output .= $foodbakery_var_form_fields->foodbakery_var_form_radio_render( $foodbakery_opt_array );
            $foodbakery_output .= '<label for="page_radio_3">';
            $foodbakery_output .= '<span class="ss">';
            $foodbakery_output .= '<img src="' . get_template_directory_uri() . '/assets/backend/images/sidebar_left.png" alt="sidebar_left" />';
            $foodbakery_output .= '</span>';
            $foodbakery_output .= '<span ' . $foodbakery_left_checklist . ' id="check-list"></span>';
            $foodbakery_output .= '</label>';
            $foodbakery_output .= '<span class="title-theme">' . foodbakery_var_theme_text_srt( 'foodbakery_var_sidebar_left' ) . '</span> </div>';

            $cs_extra_layouts = false;
            if ( $pagenow == 'post.php' && get_post_type() == 'page' ) {
                $cs_extra_layouts = true;
            }


            $foodbakery_output .= '</div>';
            $foodbakery_output .= '</div>';
            $foodbakery_output .= '</div>';

            if ( isset( $split ) && $split == true ) {
                $foodbakery_output .= '<div class="splitter"></div>';
            }
            $foodbakery_output .= '
				</div>';

            echo foodbakery_allow_special_char( $foodbakery_output );
        }

        /**
         * heading markup
         * 
         */
        public function foodbakery_var_heading_render( $params = '' ) {
            global $post;
            extract( $params );
            $foodbakery_var_output = '
			<div class="theme-help" id="' . sanitize_html_class( $id ) . '">
				<h4 style="padding-bottom:0px;">' . esc_attr( $name ) . '</h4>
				<div class="clear"></div>
			</div>';
            echo foodbakery_allow_special_char( $foodbakery_var_output );
        }

        /**
         * heading markup
         * 
         */
        public function foodbakery_var_set_heading( $params = '' ) {
            extract( $params );
            $foodbakery_var_output = '';
            $foodbakery_var_output .= '<li><a title="' . esc_html( $name ) . '" href="#"><i class="' . sanitize_html_class( $fontawesome ) . '"></i>
				<span class="cs-title-menu">' . esc_html( $name ) . '</span></a>';
            if ( is_array( $options ) && sizeof( $options ) > 0 ) {
                $active = '';
                $foodbakery_var_output .= '<ul class="sub-menu">';
                foreach ( $options as $key => $value ) {
                    $active = ( $key == "tab-general-page-settings" ) ? 'active' : '';
                    $foodbakery_var_output .= '<li class="' . sanitize_html_class( $key ) . ' ' . $active . '"><a href="#' . $key . '" onClick="toggleDiv(this.hash);return false;">' . esc_html( $value ) . '</a></li>';
                }
                $foodbakery_var_output .= '</ul>';
            }
            $foodbakery_var_output .= '
			</li>';

            return $foodbakery_var_output;
        }

        /**
         * main heading markup
         * 
         */
        public function foodbakery_var_set_main_heading( $params = '' ) {
            extract( $params );
            $foodbakery_var_output = '';
            $foodbakery_var_output .= '<li><a title="' . $name . '" href="#' . $id . '" onClick="toggleDiv(this.hash);return false;"><i class="' . sanitize_html_class( $fontawesome ) . '"></i>
			<span class="cs-title-menu">' . esc_html( $name ) . '</span>
			</a>
			</li>';

            return $foodbakery_var_output;
        }

        /**
         * sub heading markup
         * 
         */
        public function foodbakery_var_set_sub_heading( $params = '' ) {
            extract( $params );
            $foodbakery_var_output = '';
            $style = '';
            if ( $counter > 1 ) {
                $foodbakery_var_output .= '</div>';
            }
            if ( $id != 'tab-general-page-settings' ) {
                $style = 'style="display:none;"';
            }
            $foodbakery_var_output .= '<div  id="' . $id . '" ' . $style . '>';
            $foodbakery_var_output .= '<div class="theme-header"><h1>' . esc_html( $name ) . '</h1>
			</div>';

            $foodbakery_var_output .= '<div class="col2-right">';

            return $foodbakery_var_output;
        }

        /**
         * announcement markup
         * 
         */
        public function foodbakery_var_set_announcement( $params = '' ) {
            extract( $params );
            $foodbakery_var_output = '';
            $foodbakery_var_output .= '<div id="' . $id . '" class="alert alert-info fade in nomargin theme_box"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#215;</button>
			<h4>' . esc_html( $name ) . '</h4>
			<p>' . esc_html( $std ) . '</p></div>';

            return $foodbakery_var_output;
        }

        /**
         * settings col right markup
         * 
         */
        public function foodbakery_var_set_col_right( $params = '' ) {
            extract( $params );
            $foodbakery_var_output = '';
            $foodbakery_var_output .= '
			</div><!-- end col2-right-->';
            if ( (isset( $col_heading ) && $col_heading != '') || (isset( $help_text ) && $help_text <> '') ) {
                $foodbakery_var_output .= '<div class="col3"><h3>' . esc_html( $col_heading ) . '</h3><p>' . esc_html( $help_text ) . '</p></div>';
            }

            if ( isset( $echo ) && $echo == true ) {
                echo foodbakery_allow_special_char( $foodbakery_var_output );
            } else {
                return $foodbakery_var_output;
            }
        }

        /**
         * settings section markup
         * 
         */
        public function foodbakery_var_set_section( $params = '' ) {
            extract( $params );
            $foodbakery_var_output = '';
            if ( isset( $accordion ) && $accordion == true ) {
                if ( isset( $active ) && $active == true ) {
                    $active = '';
                } else {
                    $active = ' class="collapsed"';
                }
                $foodbakery_var_output .= '<div class="panel-heading"><a' . $active . ' href="#accordion-' . esc_attr( $id ) . '" data-parent="#accordion-' . esc_attr( $parrent_id ) . '" data-toggle="collapse"><h4>' . esc_html( $std ) . '</h4>';
            } else {
                $foodbakery_var_output .= '<div class="theme-help"><h4>' . esc_html( $std ) . '</h4><div class="clear"></div></div>';
            }
            if ( isset( $accordion ) && $accordion == true ) {
                $foodbakery_var_output .= '</a></div>';
            }

            if ( isset( $echo ) && $echo == true ) {
                echo foodbakery_allow_special_char( $foodbakery_var_output );
            } else {
                return $foodbakery_var_output;
            }
        }

        /**
         * text field markup
         * 
         */
        public function foodbakery_var_text_field( $params = '' ) {
            extract( $params );
            $foodbakery_var_output = '';

            $foodbakery_var_styles = '';
            if ( isset( $styles ) && $styles != '' ) {
                $foodbakery_var_styles = ' style="' . $styles . '"';
            }
            $cust_id = isset( $id ) ? ' id="' . $id . '"' : '';
            $extra_attr = isset( $extra_att ) ? ' ' . $extra_att . ' ' : '';
            $name = isset( $name ) ? $name : '';
            $field_params = isset( $field_params ) ? $field_params : '';
            $desc = isset( $desc ) ? $desc : '';
            $foodbakery_var_output .= '<div' . $cust_id . $extra_attr . ' class="form-elements"' . $foodbakery_var_styles . '><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<label>' . esc_attr( $name ) . '</label>';
            if ( isset( $hint_text ) && $hint_text != '' ) {
                $foodbakery_var_output .= foodbakery_var_tooltip_helptext( esc_html( $hint_text ) );
            }
            $foodbakery_var_output .= '</div><div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
            $foodbakery_var_output .= parent::foodbakery_var_form_text_render( $field_params );
            $foodbakery_var_output .= '<p>' . esc_html( $desc ) . '</p></div>';
            if ( isset( $split ) && $split == true ) {
                $foodbakery_var_output .= '<div class="splitter"></div>';
            }
            $foodbakery_var_output .= '</div>';

            if ( isset( $echo ) && $echo == true ) {
                echo foodbakery_allow_special_char( $foodbakery_var_output );
            } else {
                return $foodbakery_var_output;
            }
        }

        /**
         * date field markup
         * 
         */
        public function foodbakery_var_date_field( $params = '' ) {
            extract( $params );
            $foodbakery_var_output = '';

            $foodbakery_var_styles = '';
            if ( isset( $styles ) && $styles != '' ) {
                $foodbakery_var_styles = ' style="' . $styles . '"';
            }

            $cust_id = isset( $id ) ? ' id="' . $id . '"' : '';
            $extra_attr = isset( $extra_att ) ? ' ' . $extra_att . ' ' : '';
            $foodbakery_var_output .= '
			<div' . $cust_id . $extra_attr . ' class="form-elements"' . $foodbakery_var_styles . '>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_attr( $name ) . '</label>';
            if ( isset( $hint_text ) && $hint_text != '' ) {
                $foodbakery_var_output .= foodbakery_var_tooltip_helptext( esc_html( $hint_text ) );
            }
            $foodbakery_var_output .= '</div><div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
            $foodbakery_var_output .= parent::foodbakery_var_form_date_render( $field_params );
            $foodbakery_var_output .= '<p>' . esc_html( $desc ) . '</p></div>';
            if ( isset( $split ) && $split == true ) {
                $foodbakery_var_output .= '<div class="splitter"></div>';
            }
            $foodbakery_var_output .= '</div>';

            if ( isset( $echo ) && $echo == true ) {
                echo foodbakery_allow_special_char( $foodbakery_var_output );
            } else {
                return $foodbakery_var_output;
            }
        }

        /**
         * textarea field markup
         * 
         */
        public function foodbakery_var_textarea_field( $params = '' ) {
            extract( $params );
            $foodbakery_var_output = '';
            $foodbakery_var_styles = '';
            if ( isset( $styles ) && $styles != '' ) {
                $foodbakery_var_styles = ' style="' . $styles . '"';
            }

            $cust_id = isset( $id ) ? ' id="' . $id . '"' : '';
            $extra_attr = isset( $extra_att ) ? ' ' . $extra_att . ' ' : '';
            $foodbakery_var_output .= '<div' . $cust_id . $extra_attr . ' class="form-elements"' . $foodbakery_var_styles . '><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><label>' . esc_attr( $name ) . '</label>';
            if ( isset( $hint_text ) && $hint_text != '' ) {
                $foodbakery_var_output .= foodbakery_var_tooltip_helptext( esc_html( $hint_text ) );
            }
            $foodbakery_var_output .= '</div><div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
            if ( isset( $field_params['foodbakery_editor'] ) ) {
                if ( $field_params['foodbakery_editor'] == true ) {
                    $editor_class = 'foodbakery_editor' . mt_rand();
                    $field_params['classes'] .= ' ' . $editor_class;
                }
            }
            $foodbakery_var_output .= parent::foodbakery_var_form_textarea_render( $field_params );
            $foodbakery_var_output .= '<p>' . esc_html( $desc ) . '</p>
				</div>';
            if ( isset( $split ) && $split == true ) {
                $foodbakery_var_output .= '<div class="splitter"></div>';
            }
            $foodbakery_var_output .= '</div>';
            if ( isset( $field_params['foodbakery_editor'] ) ) {
                if ( $field_params['foodbakery_editor'] == true ) {
                    $foodbakery_inline_script = 'jQuery(".' . $editor_class . '").jqte();';
                    $foodbakery_var_output .='<script>' . $foodbakery_inline_script . '</script>';
                }
            }
            if ( isset( $echo ) && $echo == true ) {
                echo foodbakery_allow_special_char( $foodbakery_var_output );
            } else {
                return $foodbakery_var_output;
            }
        }

        /**
         * radio field markup
         * 
         */
        public function foodbakery_var_radio_field( $params = '' ) {
            extract( $params );
            $foodbakery_var_output = '';
            $foodbakery_var_output .= '
			<div class="input-sec">';
            $foodbakery_var_output .= parent::foodbakery_var_form_radio_render( $field_params );
            $foodbakery_var_output .= esc_html( $description );
            $foodbakery_var_output .= '
			</div>';

            if ( isset( $echo ) && $echo == true ) {
                echo foodbakery_allow_special_char( $foodbakery_var_output );
            } else {
                return $foodbakery_var_output;
            }
        }

        /**
         * select field markup
         * 
         */
        public function foodbakery_var_select_field( $params = '' ) {
            extract( $params );
            $foodbakery_var_output = '';
            $foodbakery_var_styles = '';
            $desc = isset( $desc ) ? $desc : '';
            if ( isset( $styles ) && $styles != '' ) {
                $foodbakery_var_styles = ' style="' . $styles . '"';
            }

            $cust_id = isset( $id ) ? ' id="' . $id . '"' : '';
            $extra_attr = isset( $extra_att ) ? ' ' . $extra_att . ' ' : '';
            $foodbakery_var_output .= '<div' . $cust_id . $extra_attr . ' class="form-elements"' . $foodbakery_var_styles . '><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><label>' . esc_attr( $name ) . '</label>';
            if ( isset( $hint_text ) && $hint_text != '' ) {
                $foodbakery_var_output .= foodbakery_var_tooltip_helptext( esc_html( $hint_text ) );
            }
            $foodbakery_var_output .= '</div><div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';

            if ( isset( $array ) && $array == true ) {
                $foodbakery_var_random_id = rand( 123456, 987654 );
                $html_id = ' id="foodbakery_var_' . sanitize_html_class( $id ) . $foodbakery_var_random_id . '"';
            }
            if ( isset( $multi ) && $multi == true ) {
                $foodbakery_var_output .= parent::foodbakery_var_form_multiselect_render( $field_params );
            } else {
                $foodbakery_var_output .= parent::foodbakery_var_form_select_render( $field_params );
            }
            $foodbakery_var_output .= '<p>' . esc_html( $desc ) . '</p>
				</div>';
            if ( isset( $split ) && $split == true ) {
                $foodbakery_var_output .= '<div class="splitter"></div>';
            }
            $foodbakery_var_output .= '
			</div>';

            if ( isset( $echo ) && $echo == true ) {
                echo foodbakery_allow_special_char( $foodbakery_var_output );
            } else {
                return $foodbakery_var_output;
            }
        }

        /**
         * checkbox field markup
         * 
         */
        public function foodbakery_var_checkbox_field( $params = '' ) {
            extract( $params );
            $foodbakery_var_output = '';
            $foodbakery_var_styles = '';
            if ( isset( $styles ) && $styles != '' ) {
                $foodbakery_var_styles = ' style="' . $styles . '"';
            }

            $cust_id = isset( $id ) ? ' id="' . $id . '"' : '';
            $extra_attr = isset( $extra_att ) ? ' ' . $extra_att . ' ' : '';
            $foodbakery_var_output .= '
			<div' . $cust_id . $extra_attr . ' class="form-elements"' . $foodbakery_var_styles . '>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_attr( $name ) . '</label>';
            if ( isset( $hint_text ) && $hint_text != '' ) {
                $foodbakery_var_output .= foodbakery_var_tooltip_helptext( esc_html( $hint_text ) );
            }
            $foodbakery_var_output .= '
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
            $foodbakery_var_output .= parent::foodbakery_var_form_checkbox_render( $field_params );
            $foodbakery_var_output .= '<p>' . esc_html( $desc ) . '</p>
				</div>';
            if ( isset( $split ) && $split == true ) {
                $foodbakery_var_output .= '<div class="splitter"></div>';
            }
            $foodbakery_var_output .= '
			</div>';

            if ( isset( $echo ) && $echo == true ) {
                echo foodbakery_allow_special_char( $foodbakery_var_output );
            } else {
                return $foodbakery_var_output;
            }
        }

        /**
         * upload media field markup
         * 
         */
        public function foodbakery_var_media_url_field( $params = '' ) {
            extract( $params );
            $foodbakery_var_output = '';
            $foodbakery_var_output .= '<div class="form-elements"><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><label>' . esc_attr( $name ) . '</label>';
            if ( isset( $hint_text ) && $hint_text != '' ) {
                $foodbakery_var_output .= foodbakery_var_tooltip_helptext( esc_html( $hint_text ) );
            }
            $foodbakery_var_output .= '</div><div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
            $foodbakery_var_output .= parent::foodbakery_var_media_url( $field_params );
            $foodbakery_var_output .= '<p>' . esc_html( $desc ) . '</p>
				</div>';
            if ( isset( $split ) && $split == true ) {
                $foodbakery_var_output .= '<div class="splitter"></div>';
            }
            $foodbakery_var_output .= '</div>';

            if ( isset( $echo ) && $echo == true ) {
                echo foodbakery_allow_special_char( $foodbakery_var_output );
            } else {
                return $foodbakery_var_output;
            }
        }

        /**
         * upload file field markup
         * 
         */
        public function foodbakery_var_upload_file_field( $params = '' ) {
            global $post, $pagenow, $image_val;

            extract( $params );
            $std = isset( $std ) ? $std : '';
            if ( $pagenow == 'post.php' ) {

                if ( isset( $dp ) && $dp == true ) {
                    $foodbakery_var_value = get_post_meta( $post->ID, $id, true );
                } else {
                    $foodbakery_var_value = get_post_meta( $post->ID, 'foodbakery_var_' . $id, true );
                }
            } elseif ( isset( $user ) && ! empty( $user ) ) {

                if ( isset( $dp ) && $dp == true ) {

                    $foodbakery_var_value = get_the_author_meta( $id, $user->ID );
                } else {
                    $foodbakery_var_value = get_the_author_meta( 'foodbakery_var_' . $id, $user->ID );
                }
            } else {
                $foodbakery_var_value = $std;
            }

            if ( isset( $foodbakery_var_value ) && $foodbakery_var_value != '' ) {
                $value = $foodbakery_var_value;
                if ( isset( $dp ) && $dp == true ) {
                    $value = foodbakery_var_get_img_url( $foodbakery_var_value, 'foodbakery_var_media_5' );
                } else {
                    $value = $foodbakery_var_value;
                }
            } else {
                $value = $std;
            }

            if ( isset( $force_std ) && $force_std == true ) {
                $value = $std;
            }
            if ( isset( $value ) && $value != '' ) {
                $display = 'style=display:block';
            } else {
                $display = 'style=display:none';
            }

            $foodbakery_var_random_id = '';
            $html_id = ' id="foodbakery_var_' . sanitize_html_class( $id ) . '"';
            if ( isset( $array ) && $array == true ) {
                $foodbakery_var_random_id = rand( 123456, 987654 );

                $html_id = ' id="foodbakery_var_' . sanitize_html_class( $id ) . $foodbakery_var_random_id . '"';
            }

            $field_params['foodbakery_var_random_id'] = $foodbakery_var_random_id;
            
            $is_multi = isset( $field_params['multi'] )? $field_params['multi'] : false;

            $foodbakery_var_output = '';
            $foodbakery_var_styles = '';
            if ( isset( $styles ) && $styles != '' ) {
                $foodbakery_var_styles = ' style="' . $styles . '"';
            }
            $extra_attr = isset( $extra_att ) ? ' ' . $extra_att . ' ' : '';
            $foodbakery_var_output .= '<div' . $extra_attr . ' class="form-elements"' . $foodbakery_var_styles . '><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
	    <label>' . esc_attr( $name ) . '</label>';
            if ( isset( $hint_text ) && $hint_text != '' ) {
                $foodbakery_var_output .= foodbakery_var_tooltip_helptext( esc_html( $hint_text ) );
            }
            
            if( $is_multi == true){
                $images_ids = explode(',', $images_ids);
                if( !empty( $images_ids ) ){
                    $display = 'style=display:block';
                }
            }
            
            $foodbakery_var_output .= '</div><div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 image-upload-div">';
            $foodbakery_var_output .= parent::foodbakery_var_form_fileupload_render( $field_params );
            $foodbakery_var_output .= '<div class="page-wrap" ' . $display . ' id="foodbakery_var_' . sanitize_html_class( $id ) . $foodbakery_var_random_id . '_box">';
            $foodbakery_var_output .= '<div class="gal-active">';
            $foodbakery_var_output .= '<div class="dragareamain" style="padding-bottom:0px;">';
            $foodbakery_var_output .= '<ul id="gal-sortable">';
            
            $index_id       = isset( $index_id )? $index_id : 0;
            
            if( $is_multi == true){
                if( !empty( $images_ids ) ){
                    foreach( $images_ids as $image_key => $image_id){
                        $image_src = wp_get_attachment_image_src($image_id, 'small');
                        $image_src = isset($image_src[0]) ? $image_src[0] : '';
                        $foodbakery_var_output .= '<li class="ui-state-default" id="">';
                        
                        $foodbakery_var_output .= '<input id="foodbakery_images_url'.$image_key.'" name="foodbakery_images_url['. $index_id .'][]" type="hidden" class="" value="'.$image_id.'">';
                        
                        $foodbakery_var_output .= '<div class="thumb-secs"> <img src="' . esc_url( $image_src ) . '" id="foodbakery_var_' . sanitize_html_class( $image_id ) . $foodbakery_var_random_id . '_img" width="100" alt="foodbakery_var_" />';
                        $foodbakery_var_output .= '<div class="gal-edit-opts"><a href="javascript:;" class="delete del_media_img"></a> </div>';
                        $foodbakery_var_output .= '</div>';
                        $foodbakery_var_output .= '</li>';
                    }
                }
            }
            if( $is_multi != true){
                $foodbakery_var_output .= '<li class="ui-state-default" id="">';
                $foodbakery_var_output .= '<div class="thumb-secs"> <img src="' . esc_url( $value ) . '" id="foodbakery_var_' . sanitize_html_class( $id ) . $foodbakery_var_random_id . '_img" width="100" alt="foodbakery_var_" />';
                $foodbakery_var_output .= '<div class="gal-edit-opts"><a href="javascript:del_media(\'foodbakery_var_' . sanitize_html_class( $id ) . $foodbakery_var_random_id . '\')" class="delete"></a> </div>';
                $foodbakery_var_output .= '</div>';
                $foodbakery_var_output .= '</li>';
            }
            $foodbakery_var_output .= '</ul>';
            $foodbakery_var_output .= '</div>';
            $foodbakery_var_output .= '</div>';
            $foodbakery_var_output .= '</div>';

            $foodbakery_var_output .= '<p>' . esc_html( $desc ) . '</p>
				</div>';
            if ( isset( $split ) && $split == true ) {
                $foodbakery_var_output .= '<div class="splitter"></div>';
            }
            $foodbakery_var_output .= '
			</div>';

            if ( isset( $echo ) && $echo == true ) {
                echo foodbakery_allow_special_char( $foodbakery_var_output );
            } else {
                return $foodbakery_var_output;
            }
        }

        /**
         * select page field markup
         * 
         */
        public function foodbakery_var_select_page_field( $params = '' ) {
            extract( $params );
            $foodbakery_var_output = '';
            $foodbakery_var_output .= '
			<div class="form-elements">
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_attr( $name ) . '</label>';
            if ( isset( $hint_text ) && $hint_text != '' ) {
                $foodbakery_var_output .= foodbakery_var_tooltip_helptext( esc_html( $hint_text ) );
            }
            $foodbakery_var_output .= '
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="select-style">';
            $foodbakery_var_output .= wp_dropdown_pages( $args );
            $foodbakery_var_output .= '<p>' . esc_html( $desc ) . '</p>
					</div>
				</div>';
            if ( isset( $split ) && $split == true ) {
                $foodbakery_var_output .= '<div class="splitter"></div>';
            }
            $foodbakery_var_output .= '
			</div>';

            if ( isset( $echo ) && $echo == true ) {
                echo foodbakery_allow_special_char( $foodbakery_var_output );
            } else {
                return $foodbakery_var_output;
            }
        }

        public function foodbakery_var_multi_fields( $params = '' ) {
            extract( $params );
            $foodbakery_var_output = '';

            $foodbakery_var_styles = '';
            if ( isset( $styles ) && $styles != '' ) {
                $foodbakery_var_styles = ' style="' . $styles . '"';
            }
            $cust_id = isset( $id ) ? ' id="' . $id . '"' : '';
            $extra_attr = isset( $extra_att ) ? ' ' . $extra_att . ' ' : '';
            $foodbakery_var_output .= '
			<div' . $cust_id . $extra_attr . ' class="form-elements"' . $foodbakery_var_styles . '>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_attr( $name ) . '</label>';
            if ( isset( $hint_text ) && $hint_text != '' ) {
                $foodbakery_var_output .= foodbakery_var_tooltip_helptext( esc_html( $hint_text ) );
            }
            $foodbakery_var_output .= '
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
            if ( isset( $fields_list ) && is_array( $fields_list ) ) {
                foreach ( $fields_list as $field_array ) {
                    if ( $field_array['type'] == 'text' ) {
                        $foodbakery_var_output .= parent::foodbakery_var_form_text_render( $field_array['field_params'] );
                    } elseif ( $field_array['type'] == 'hidden' ) {
                        $foodbakery_var_output .= parent::foodbakery_var_form_hidden_render( $field_array['field_params'] );
                    } elseif ( $field_array['type'] == 'select' ) {
                        $foodbakery_var_output .= parent::foodbakery_var_form_select_render( $field_array['field_params'] );
                    } elseif ( $field_array['type'] == 'multiselect' ) {
                        $foodbakery_var_output .= parent::foodbakery_var_form_multiselect_render( $field_array['field_params'] );
                    } elseif ( $field_array['type'] == 'checkbox' ) {
                        $foodbakery_var_output .= parent::foodbakery_var_form_checkbox_render( $field_array['field_params'] );
                    } elseif ( $field_array['type'] == 'radio' ) {
                        $foodbakery_var_output .= parent::foodbakery_var_form_radio_render( $field_array['field_params'] );
                    } elseif ( $field_array['type'] == 'date' ) {
                        $foodbakery_var_output .= parent::foodbakery_var_form_radio_render( $field_array['field_params'] );
                    } elseif ( $field_array['type'] == 'textarea' ) {
                        $foodbakery_var_output .= parent::foodbakery_var_form_textarea_render( $field_array['field_params'] );
                    } elseif ( $field_array['type'] == 'media' ) {
                        $foodbakery_var_output .= parent::foodbakery_var_media_url( $field_array['field_params'] );
                    } elseif ( $field_array['type'] == 'fileupload' ) {
                        $foodbakery_var_output .= '<div class="page-wrap" ' . $display . ' id="foodbakery_var_' . sanitize_html_class( $id ) . '_box">';
                        $foodbakery_var_output .= '<div class="gal-active">';
                        $foodbakery_var_output .= '<div class="dragareamain" style="padding-bottom:0px;">';
                        $foodbakery_var_output .= '<ul id="gal-sortable">';
                        $foodbakery_var_output .= '<li class="ui-state-default" id="">';
                        $foodbakery_var_output .= '<div class="thumb-secs"> <img src="' . esc_url( $value ) . '" id="foodbakery_var_' . sanitize_html_class( $id ) . '_img" width="100" alt="thumb-secs" />';
                        $foodbakery_var_output .= '<div class="gal-edit-opts"><a href="javascript:del_media(\'foodbakery_var_' . sanitize_html_class( $id ) . '\')" class="delete"></a> </div>';
                        $foodbakery_var_output .= '</div>';
                        $foodbakery_var_output .= '</li>';
                        $foodbakery_var_output .= '</ul>';
                        $foodbakery_var_output .= '</div>';
                        $foodbakery_var_output .= '</div>';
                        $foodbakery_var_output .= '</div>';
                        $foodbakery_var_output .= parent::foodbakery_var_form_fileupload_render( $field_params );
                    } elseif ( $field_array['type'] == 'dropdown_pages' ) {
                        $foodbakery_var_output .= wp_dropdown_pages( $args );
                    }
                }
            }

            $foodbakery_var_output .= '<p>' . esc_html( $desc ) . '</p>
				</div>';
            if ( isset( $split ) && $split == true ) {
                $foodbakery_var_output .= '<div class="splitter"></div>';
            }
            $foodbakery_var_output .= '
			</div>';

            if ( isset( $echo ) && $echo == true ) {
                echo foodbakery_allow_special_char( $foodbakery_var_output );
            } else {
                return $foodbakery_var_output;
            }
        }

        public function foodbakery_var_get_attachment_id( $attachment_url ) {
            global $wpdb;
            $attachment_id = false;
            //  If there is no url, return. 
            if ( '' == $attachment_url )
                return;
            // Get the upload foodbakery paths 
            $upload_dir_paths = wp_upload_dir();
            if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
                //  If this is the URL of an auto-generated thumbnail, get the URL of the original image 
                $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
                // Remove the upload path base foodbakery from the attachment URL 
                $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

                $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
            }
            return $attachment_id;
        }

        public function foodbakery_var_get_icon_for_attachment( $post_id ) {

            return wp_get_attachment_image( $post_id, 'thumbnail' );
        }

        public function foodbakery_gallery_render_theme( $params = '' ) {
            extract( $params );
            global $post, $foodbakery_var_plugin_core, $foodbakery_var_plugin_static_text;


            $foodbakery_var_random_id = rand( 156546, 956546 );
            ?>
            <div class="cs-gallery-con">
                <div id="gallery_container_<?php echo esc_attr( $foodbakery_var_random_id ); ?>" data-csid="foodbakery_<?php echo esc_attr( $id ) ?>">
                    <?php
                    $foodbakery_inline_script = '
					jQuery(document).ready(function () {
						jQuery("#gallery_sortable_' . esc_attr( $foodbakery_var_random_id ) . '").sortable({
							out: function (event, ui) {
								foodbakery_var_gallery_sorting_list(\'foodbakery_' . sanitize_html_class( $id ) . '\', \'' . esc_attr( $foodbakery_var_random_id ) . '\');
							}
						});

						gal_num_of_items(\'' . esc_attr( $id ) . '\', \'' . absint( $foodbakery_var_random_id ) . '\', \'\');

						jQuery(\'#gallery_container_' . esc_attr( $foodbakery_var_random_id ) . '\').on(\'click\', \'a.delete\', function () {
							gal_num_of_items(\'' . esc_attr( $id ) . '\', \'' . absint( $foodbakery_var_random_id ) . '\', 1);
							jQuery(this).closest(\'li.image\').remove();
							foodbakery_var_gallery_sorting_list(\'foodbakery_' . sanitize_html_class( $id ) . '\', \'' . esc_attr( $foodbakery_var_random_id ) . '\');
						});
					});';
                    foodbakery_admin_inline_enqueue_script( $foodbakery_inline_script, 'foodbakery-custom-functions' );
                    ?>
                    <ul class="gallery_images" id="gallery_sortable_<?php echo esc_attr( $foodbakery_var_random_id ); ?>">
                        <?php
                        $gallery = get_post_meta( $post->ID, 'foodbakery_' . $id . '_url', true );

                        $foodbakery_var_gal_counter = 0;
                        if ( is_array( $gallery ) && sizeof( $gallery ) > 0 ) {
                            foreach ( $gallery as $attach_url ) {

                                if ( $attach_url != '' ) {

                                    $foodbakery_var_gal_id = rand( 156546, 956546 );

                                    $foodbakery_var_attach_id = $foodbakery_var_plugin_core->foodbakery_var_get_attachment_id( $attach_url );

                                    $foodbakery_var_attach_img = $this->foodbakery_var_get_icon_for_attachment( $foodbakery_var_attach_id );
                                    echo '
                                    <li class="image" data-attachment_id="' . esc_attr( $foodbakery_var_gal_id ) . '">
                                        ' . $foodbakery_var_attach_img . '
                                        <input type="hidden" value="' . esc_url( $attach_url ) . '" name="foodbakery_' . $id . '_url[]" />
                                        <div class="actions">
                                            <span><a href="javascript:;" class="delete tips" data-tip="' . foodbakery_var_theme_text_srt( 'foodbakery_var_delete_image' ) . '"><i class="icon-times"></i></a></span>
                                        </div>
                                    </li>';
                                }
                                $foodbakery_var_gal_counter ++;
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div id="foodbakery_var_<?php echo esc_attr( $id ) ?>_temp"></div>
                <input type="hidden" value="" name="foodbakery_<?php echo esc_attr( $id ) ?>_num" />
                <div style="width:100%; display:inline-block; margin:20px 0;">
                    <label class="add_gallery hide-if-no-js" data-id="<?php echo 'foodbakery_' . sanitize_html_class( $id ); ?>" data-rand_id="<?php echo esc_attr( $foodbakery_var_random_id ); ?>">
                        <input type="button" class="button button-primary button-large" data-choose="<?php echo esc_attr( $name ); ?>" data-update="<?php echo esc_attr( $name ); ?>" data-delete="<?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_delete' ) ); ?>" data-text="<?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_delete' ) ); ?>"  value="<?php echo esc_attr( $name ); ?>">
                    </label>
                </div>
            </div>
            <?php
        }

        public function foodbakery_var_gallery_render( $params = '' ) {
            global $post;
            extract( $params );
            $foodbakery_var_random_id = rand( 156546, 956546 );
           
            ?>
            <div class="form-elements">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <label><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_add_gallery' ) ); ?></label>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div id="gallery_container_<?php echo esc_attr( $foodbakery_var_random_id ); ?>" data-csid="foodbakery_var_<?php echo esc_attr( $id ) ?>">
                        <?php
                        $foodbakery_inline_script = '
						jQuery(document).ready(function () {
							jQuery("#gallery_sortable_' . esc_attr( $foodbakery_var_random_id ) . '").sortable({
								out: function (event, ui) {
									foodbakery_var_gallery_sorting_list(\'foodbakery_var_' . sanitize_html_class( $id ) . '\', \'' . esc_attr( $foodbakery_var_random_id ) . '\');
								}
							});

							foodbakery_var_num_of_items(\'' . esc_attr( $id ) . '\', \'' . absint( $foodbakery_var_random_id ) . '\');

							jQuery(\'#gallery_container_' . esc_attr( $foodbakery_var_random_id ) . '\').on(\'click\', \'a.delete\', function () {
								var listItems = jQuery(\'#gallery_sortable_' . esc_attr( $foodbakery_var_random_id ) . '\').children();
								var count = listItems.length;
								foodbakery_var_num_of_items(\'' . esc_attr( $id ) . '\', \'' . absint( $foodbakery_var_random_id ) . '\', count);
								jQuery(this).closest(\'li.image\').remove();
								foodbakery_var_gallery_sorting_list(\'foodbakery_var_' . sanitize_html_class( $id ) . '\', \'' . esc_attr( $foodbakery_var_random_id ) . '\');
							});
						});';
                        foodbakery_admin_inline_enqueue_script( $foodbakery_inline_script, 'foodbakery-custom-functions' );
                        ?>
                        <ul class="gallery_images" id="gallery_sortable_<?php echo esc_attr( $foodbakery_var_random_id ); ?>">
                            <?php
                            $gallery = get_post_meta( $post->ID, 'foodbakery_var_' . $id, true );
                            $gallery_titles = get_post_meta( $post->ID, 'foodbakery_var_' . $id . '_title', true );
                            $gallery_descs = get_post_meta( $post->ID, 'foodbakery_var_' . $id . '_desc', true );

                            $foodbakery_var_gal_counter = 0;
                            if ( is_array( $gallery ) && sizeof( $gallery ) > 0 ) {
                                foreach ( $gallery as $attach_id ) {

                                    if ( $attach_id != '' ) {

                                        $foodbakery_var_gal_id = rand( 156546, 956546 );

                                        $foodbakery_var_gallery_title = isset( $gallery_titles[$foodbakery_var_gal_counter] ) ? $gallery_titles[$foodbakery_var_gal_counter] : '';
                                        $foodbakery_var_gallery_desc = isset( $gallery_descs[$foodbakery_var_gal_counter] ) ? $gallery_descs[$foodbakery_var_gal_counter] : '';

                                        //$foodbakery_var_attach_id = $this->foodbakery_var_get_attachment_id( $attach_url );

                                        $foodbakery_var_attach_img = $this->foodbakery_var_get_icon_for_attachment( $attach_id );
                                        echo '
                                            <li class="image" data-attachment_id="' . esc_attr( $foodbakery_var_gal_id ) . '">
                                                    ' . $foodbakery_var_attach_img . '
                                                    <input type="hidden" value="' . $attach_id . '" name="foodbakery_var_' . $id . '[]" />
                                                    <div class="actions">
                                                           
                                                            <span><a href="javascript:void(0);" class="delete tips" data-tip="' . foodbakery_var_theme_text_srt( 'foodbakery_var_delete_image' ) . '"><i class="icon-times"></i></a></span>
                                                    </div>
                                                    <tr class="parentdelete" id="edit_track' . absint( $foodbakery_var_gal_id ) . '">
                                                      <td style="width:0">
                                                      <div id="edit_track_form' . absint( $foodbakery_var_gal_id ) . '" style="display: none;" class="table-form-elem">
                                                              <div class="cs-heading-area">
                                                                    <h5 style="text-align: left;">' . foodbakery_var_theme_text_srt( 'foodbakery_var_edit_item' ) . '</h5>
                                                                    <span onclick="javascript:foodbakery_var_remove_overlay(\'edit_track_form' . absint( $foodbakery_var_gal_id ) . '\',\'append\')" class="cs-btnclose"> <i class="icon-times"></i></span>
                                                                    <div class="clear"></div>
                                                              </div>
                                                              <div class="form-elements">
                                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                      <label>&nbsp;</label>
                                                                    </div>
                                                                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                                      ' . $foodbakery_var_attach_img . '
                                                                    </div>
                                                              </div>
                                                              <div class="form-elements">
                                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                      <label>' . foodbakery_var_theme_text_srt( 'foodbakery_var_title' ) . '</label>
                                                                    </div>
                                                                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                                      <input type="text" name="foodbakery_var_' . $id . '_title[]" value="' . esc_html( $foodbakery_var_gallery_title ) . '" />
                                                                    </div>
                                                              </div>
                                                              <div class="form-elements">
                                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                      <label>' . foodbakery_var_theme_text_srt( 'foodbakery_var_description' ) . '</label>
                                                                    </div>
                                                                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                                      <textarea name="foodbakery_var_' . $id . '_desc[]">' . esc_html( $foodbakery_var_gallery_desc ) . '</textarea>
                                                                    </div>
                                                              </div>
                                                              <ul class="form-elements noborder">
                                                                    <li class="to-label">
                                                                      <label></label>
                                                                    </li>
                                                                    <li class="to-field">
                                                                      <input type="button" value="' . foodbakery_var_theme_text_srt( 'foodbakery_var_update' ) . '" onclick="foodbakery_var_remove_overlay(\'edit_track_form' . absint( $foodbakery_var_gal_id ) . '\',\'append\')" />
                                                                    </li>
                                                              </ul>
                                                            </div>
                                                            </td>
                                                    </tr>
                                            </li>';
                                    }
                                    $foodbakery_var_gal_counter ++;
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <div id="foodbakery_var_<?php echo esc_attr( $id ) ?>_temp"></div>
                    <input type="hidden" value="" name="foodbakery_var_<?php echo esc_attr( $id ) ?>_num" />
                    <div style="width:100%; display:inline-block; margin:20px 0;">
                        <label class="browse-icon add_gallery hide-if-no-js" data-id="<?php echo 'foodbakery_var_' . sanitize_html_class( $id ); ?>" data-rand_id="<?php echo esc_attr( $foodbakery_var_random_id ); ?>">
                            <input type="button" class="left" data-choose="<?php echo esc_attr( $name ); ?>" data-update="<?php echo esc_attr( $name ); ?>" data-delete="<?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_delete' ) ); ?>" data-text="<?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_delete' ) ); ?>"  value="<?php echo esc_attr( $name ); ?>">
                        </label>
                    </div>
                </div>
            </div>
            <?php
        }

    }

    $var_arrays = array( 'foodbakery_var_html_fields' );
    $foodbakery_var_html_fields_global_vars = FOODBAKERY_VAR_GLOBALS()->globalizing( $var_arrays );
    extract( $foodbakery_var_html_fields_global_vars );
    $foodbakery_var_html_fields = new foodbakery_var_html_fields();
}
