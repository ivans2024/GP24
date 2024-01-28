<?php

/**
 * Admin Functions
 *
 * @package WordPress
 * @subpackage foodbakery
 * @since Auto Mobile 1.0
 */
if ( ! function_exists( 'foodbakery_var_icomoon_icons_box' ) ) {

    function foodbakery_var_icomoon_icons_box( $icon_value = '', $id = '', $name = '' ) {

        global $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;

        $foodbakery_var_icomoon = '';
        $foodbakery_var_icomoon .= '
		<script>
		jQuery(document).ready(function ($) {

			var e9_element = $(\'#e9_element_' . esc_html( $id ) . '\').fontIconPicker({
				theme: \'fip-bootstrap\'
			});
			// Add the event on the button
			$(\'#e9_buttons_' . esc_html( $id ) . ' button\').on(\'click\', function (e) {
				e.preventDefault();
				// Show processing message
				$(this).prop(\'disabled\', true).html(\'<i class="icon-cog demo-animate-spin"></i> ' . foodbakery_var_theme_text_srt( 'foodbakery_var_wait' ) . '\');
				$.ajax({
					url: "' . get_template_directory_uri() . '/assets/common/icomoon/js/selection.json",
					type: \'GET\',
					dataType: \'json\'
				}).done(function (response) {
						// Get the class prefix
						var classPrefix = response.preferences.fontPref.prefix,
								icomoon_json_icons = [],
								icomoon_json_search = [];
						$.each(response.icons, function (i, v) {
								icomoon_json_icons.push(classPrefix + v.properties.name);
								if (v.icon && v.icon.tags && v.icon.tags.length) {
										icomoon_json_search.push(v.properties.name + \' \' + v.icon.tags.join(\' \'));
								} else {
										icomoon_json_search.push(v.properties.name);
								}
						});
						// Set new fonts on fontIconPicker
						e9_element.setIcons(icomoon_json_icons, icomoon_json_search);
						// Show success message and disable
						$(\'#e9_buttons_' . esc_html( $id ) . ' button\').removeClass(\'btn-primary\').addClass(\'btn-success\').text(\'' . foodbakery_var_theme_text_srt( 'foodbakery_var_load_icon' ) . '\').prop(\'disabled\', true);
				})
				.fail(function () {
						// Show error message and enable
						$(\'#e9_buttons_' . esc_html( $id ) . ' button\').removeClass(\'btn-primary\').addClass(\'btn-danger\').text(\'' . foodbakery_var_theme_text_srt( 'foodbakery_var_try_again' ) . '\').prop(\'disabled\', false);
				});
				e.stopPropagation();
			});
			jQuery("#e9_buttons_' . esc_html( $id ) . ' button").click();
		});
		</script>';

        $foodbakery_opt_array = array(
            'std' => esc_html( $icon_value ),
            'cust_id' => 'e9_element_' . esc_html( $id ),
            'cust_name' => esc_html( $name ) . '[]',
            'return' => true,
        );
        $foodbakery_var_icomoon .= $foodbakery_var_form_fields->foodbakery_var_form_text_render( $foodbakery_opt_array );
        $foodbakery_var_icomoon .= '
        <span id="e9_buttons_' . esc_html( $id ) . '" style="display:none">
            <button autocomplete="off" type="button" class="btn btn-primary">' . foodbakery_var_theme_text_srt( 'foodbakery_var_load_json' ) . '</button>
        </span>';

        return $foodbakery_var_icomoon;
    }

}

/**
 * @count Banner Clicks
 *
 */
if ( ! function_exists( 'foodbakery_var_banner_click_count_plus' ) ) {

    function foodbakery_var_banner_click_count_plus() {
        $code_id = isset( $_POST['code_id'] ) ? $_POST['code_id'] : '';
        $banner_click_count = get_option( "banner_clicks_" . $code_id );
        $banner_click_count = $banner_click_count <> '' ? $banner_click_count : 0;
        if ( ! isset( $_COOKIE["banner_clicks_" . $code_id] ) ) {
            setcookie( "banner_clicks_" . $code_id, 'true', time() + 86400, '/' );
            update_option( "banner_clicks_" . $code_id, $banner_click_count + 1 );
        }
        die( 0 );
    }

    add_action( 'wp_ajax_foodbakery_var_banner_click_count_plus', 'foodbakery_var_banner_click_count_plus' );
    add_action( 'wp_ajax_nopriv_foodbakery_var_banner_click_count_plus', 'foodbakery_var_banner_click_count_plus' );
}

/**
 * @Adding Ads Unit
 *
 */
if ( ! function_exists( 'foodbakery_var_ads_banner' ) ) {

    function foodbakery_var_ads_banner() {

        global $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;
        $strings = new foodbakery_theme_all_strings;
        $strings->foodbakery_short_code_strings();
        $foodbakery_rand_num = rand( 123456, 987654 );
        $foodbakery_html = '';
        if ( $_POST['banner_title_input'] ) {

            $title = isset( $_POST['banner_title_input'] ) ? $_POST['banner_title_input'] : '';
        }
        $foodbakery_html .= '<tr id="del_' . absint( $foodbakery_rand_num ) . '">';
        $foodbakery_html .= '
		<td>' . esc_html( $title ) . '</td> 
                <td>' . esc_html( $_POST['banner_style_input'] ) . '</td> ';
        if ( $_POST['banner_type_input'] == 'image' ) {

            $foodbakery_html .= '<td><img src="' . esc_url( $_POST['image_path'] ) . '" alt="image_path" width="100" /></td>';
            $foodbakery_html .= '<td>&nbsp;</td>';
        } else {
            $foodbakery_html .= '<td>' . foodbakery_var_theme_text_srt( 'foodbakery_var_custom_code' ) . '</td>';
            $foodbakery_html .= '<td>&nbsp;</td>';
        }

        $foodbakery_html .= '<td>[foodbakery_ads id="' . absint( $foodbakery_rand_num ) . '"]</td>';
        $foodbakery_html .= '
              <td class="centr"> 
			<a class="remove-btn" onclick="javascript:return confirm(\'' . foodbakery_var_theme_text_srt( 'foodbakery_var_are_sure' ) . '\')" href="javascript:ads_del(\'' . $foodbakery_rand_num . '\')"><i class="icon-times"></i></a>
			<a href="javascript:foodbakery_var_toggle(\'' . absint( $foodbakery_rand_num ) . '\')"><i class="icon-edit3"></i></a>
		</td>
		</tr>';




        $foodbakery_html .= '
		<tr id="' . absint( $foodbakery_rand_num ) . '" style="display:none">
		  <td colspan="3">
			<div class="form-elements">
			  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
			  <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<a onclick="foodbakery_var_toggle(\'' . absint( $foodbakery_rand_num ) . '\')"><i class="icon-times"></i></a>
			  </div>
			</div>';




        $foodbakery_opt_array = array(
            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_title_field' ),
            'desc' => '',
            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_title_field_hint' ),
            'field_params' => array(
                'std' => isset( $_POST['banner_title_input'] ) ? $_POST['banner_title_input'] : '',
                'cust_id' => 'banner_title' . absint( $foodbakery_rand_num ),
                'cust_name' => 'foodbakery_var_banner_title[]',
                'classes' => '',
                'return' => true,
            ),
        );
        $foodbakery_html .= $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );


        $foodbakery_opt_array = array(
            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_style' ),
            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_style_hint' ),
            'field_params' => array(
                'std' => isset( $_POST['banner_style_input'] ) ? $_POST['banner_style_input'] : '',
                'cust_id' => 'banner_style' . absint( $foodbakery_rand_num ),
                'cust_name' => 'foodbakery_var_banner_style[]',
                'desc' => '',
                'classes' => 'input-small chosen-select',
                'options' =>
                array(
                    'top_banner' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_type_top' ),
                    'bottom_banner' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_type_bottom' ),
                    'sidebar_banner' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_type_sidebar' ),
                    'vertical_banner' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_type_vertical' ),
                ),
                'return' => true,
            ),
        );
        $foodbakery_html .= $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );




        $foodbakery_opt_array = array(
            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_type' ),
            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_type_hint' ),
            'field_params' => array(
                'std' => isset( $_POST['banner_type_input'] ) ? $_POST['banner_type_input'] : '',
                'cust_id' => 'banner_type' . absint( $foodbakery_rand_num ),
                'cust_name' => 'foodbakery_var_banner_type[]',
                'desc' => '',
                'extra_atr' => 'onchange="javascript:foodbakery_var_banner_type_toggle(this.value , \'' . $foodbakery_rand_num . '\')"',
                'classes' => 'input-small chosen-select',
                'options' =>
                array(
                    'image' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_image' ),
                    'code' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_code' ),
                ),
                'return' => true,
            ),
        );
        $foodbakery_html .= $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );
        $display_ads = 'none';
        if ( $_POST['banner_type_input'] == 'image' ) {
            $display_ads = 'block';
        } else if ( $_POST['banner_type_input'] == 'code' ) {
            $display_ads = 'none';
        }
        $foodbakery_html .='<div id="ads_image' . absint( $foodbakery_rand_num ) . '" style="display:' . esc_html( $display_ads ) . '">';


        $foodbakery_opt_array = array(
            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_image' ),
            'id' => 'banner_image',
            'std' => isset( $_POST['image_path'] ) ? $_POST['image_path'] : '',
            'desc' => '',
            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_image_hint' ),
            'prefix' => '',
            'array' => true,
            'field_params' => array(
                'std' => isset( $_POST['image_path'] ) ? $_POST['image_path'] : '',
                'id' => 'banner_image',
                'prefix' => '',
                'array' => true,
                'return' => true,
            ),
        );

        $foodbakery_html .= $foodbakery_var_html_fields->foodbakery_var_upload_file_field( $foodbakery_opt_array );

        $foodbakery_html .='</div>';

        $foodbakery_opt_array = array(
            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_url_field' ),
            'desc' => '',
            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_url_hint' ),
            'field_params' => array(
                'std' => isset( $_POST['banner_field_url_input'] ) ? $_POST['banner_field_url_input'] : '',
                'cust_id' => 'banner_field_url' . absint( $foodbakery_rand_num ),
                'cust_name' => 'foodbakery_var_banner_field_url[]',
                'classes' => '',
                'return' => true,
            ),
        );
        $foodbakery_html .= $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );


        $foodbakery_opt_array = array(
            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_target' ),
            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_target_hint' ),
            'field_params' => array(
                'std' => isset( $_POST['banner_target_input'] ) ? $_POST['banner_target_input'] : '',
                'desc' => '',
                'cust_id' => 'banner_target' . absint( $foodbakery_rand_num ),
                'cust_name' => 'foodbakery_var_banner_target[]',
                'classes' => 'input-small chosen-select',
                'options' =>
                array(
                    '_self' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_target_self' ),
                    '_blank' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_target_blank' ),
                ),
                'return' => true,
            ),
        );
        $foodbakery_html .= $foodbakery_var_html_fields->foodbakery_var_select_field( $foodbakery_opt_array );
        $display_ads = 'none';
        if ( $_POST['banner_type_input'] == 'image' ) {
            $display_ads = 'none';
        } else if ( $_POST['banner_type_input'] == 'code' ) {
            $display_ads = 'block';
        }
        $foodbakery_html .='<div id="ads_code' . absint( $foodbakery_rand_num ) . '" style="display:' . esc_html( $display_ads ) . '">';
        $foodbakery_opt_array = array(
            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_ad_sense_code' ),
            'desc' => '',
            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_banner_ad_sense_code_hint' ),
            'field_params' => array(
                'std' => isset( $_POST['adsense_code_input'] ) ? $_POST['adsense_code_input'] : '',
                'cust_id' => 'adsense_code' . absint( $foodbakery_rand_num ),
                'cust_name' => 'foodbakery_var_adsense_code[]',
                'classes' => '',
                'return' => true,
            ),
        );
        $foodbakery_html .= $foodbakery_var_html_fields->foodbakery_var_textarea_field( $foodbakery_opt_array );
        $foodbakery_html .='</div>';

        $foodbakery_opt_array = array(
            'std' => absint( $foodbakery_rand_num ),
            'id' => 'banner_field_code_no' . absint( $foodbakery_rand_num ),
            'cust_name' => 'foodbakery_var_banner_field_code_no[]',
            'return' => true,
        );
        $foodbakery_html .= $foodbakery_var_form_fields->foodbakery_var_form_hidden_render( $foodbakery_opt_array );


        $foodbakery_html .= '	
		  </td>
		</tr>';


        echo foodbakery_allow_special_char( $foodbakery_html );
        die;
    }

    add_action( 'wp_ajax_foodbakery_var_ads_banner', 'foodbakery_var_ads_banner' );
}



/**
 * @Adding Social Icons
 *
 */
if ( ! function_exists( 'foodbakery_var_add_social_icon' ) ) {

    function foodbakery_var_add_social_icon() {

        global $foodbakery_var_html_fields, $foodbakery_var_form_fields, $foodbakery_var_static_text;
        $strings = new foodbakery_theme_all_strings;
        $strings->foodbakery_short_code_strings();
        $foodbakery_rand_num = rand( 123456, 987654 );
        $foodbakery_html = '';
        if ( $_POST['social_net_awesome'] ) {

            $icon_awesome = $_POST['social_net_awesome'];
        }
        $socail_network = get_option( 'foodbakery_var_social_network' );
        $foodbakery_html .= '<tr id="del_' . absint( $foodbakery_rand_num ) . '"><td>';
        if ( isset( $icon_awesome ) && $icon_awesome <> '' ) {
            $foodbakery_html .= '<i  class="' . $_POST['social_net_awesome'] . ' icon-2x"></i>';
        } else {
            $foodbakery_html .= '<img width="50" src="' . esc_url( $_POST['social_net_icon_path'] ) . '">';
        }
        $foodbakery_html .= '</td>';
        $foodbakery_html .= '
		<td>' . esc_html( $_POST['social_net_tooltip'] ) . '</td> 

		<td><a href="#">' . esc_url( $_POST['social_net_url'] ) . '</a></td> 

		<td class="centr"> 
			<a class="remove-btn" onclick="javascript:return confirm(\'' . foodbakery_var_theme_text_srt( 'foodbakery_var_are_sure' ) . '\')" href="javascript:social_icon_del(\'' . $foodbakery_rand_num . '\')"><i class="icon-times"></i></a>
			<a href="javascript:foodbakery_var_toggle(\'' . absint( $foodbakery_rand_num ) . '\')"><i class="icon-edit3"></i></a>
		</td>
		</tr>';

        $foodbakery_html .= '
		<tr id="' . absint( $foodbakery_rand_num ) . '" style="display:none">
		  <td colspan="3">
			<div class="form-elements">
			  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
			  <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<a onclick="foodbakery_var_toggle(\'' . absint( $foodbakery_rand_num ) . '\')"><i class="icon-times"></i></a>
			  </div>
			</div>';

        $foodbakery_opt_array = array(
            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_title_field' ),
            'desc' => '',
            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_icon_hint' ),
            'field_params' => array(
                'std' => isset( $_POST['social_net_tooltip'] ) ? $_POST['social_net_tooltip'] : '',
                'cust_id' => 'social_net_tooltip' . absint( $foodbakery_rand_num ),
                'cust_name' => 'foodbakery_var_social_net_tooltip[]',
                'classes' => '',
                'return' => true,
            ),
        );
        $foodbakery_html .= $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

        $foodbakery_opt_array = array(
            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_url_field' ),
            'desc' => '',
            'hint_text' => foodbakery_var_theme_text_srt( 'foodbakery_var_url_hint' ),
            'field_params' => array(
                'std' => isset( $_POST['social_net_url'] ) ? $_POST['social_net_url'] : '',
                'cust_id' => 'social_net_url' . absint( $foodbakery_rand_num ),
                'cust_name' => 'foodbakery_var_social_net_url[]',
                'classes' => '',
                'return' => true,
            ),
        );
        $foodbakery_html .= $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

        $foodbakery_opt_array = array(
            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_icon_path' ),
            'id' => 'social_icon_path',
            'std' => isset( $_POST['social_net_icon_path'] ) ? $_POST['social_net_icon_path'] : '',
            'desc' => '',
            'hint_text' => '',
            'prefix' => '',
            'array' => true,
            'field_params' => array(
                'std' => isset( $_POST['social_net_icon_path'] ) ? $_POST['social_net_icon_path'] : '',
                'id' => 'social_icon_path',
                'prefix' => '',
                'array' => true,
                'return' => true,
            ),
        );

        $foodbakery_html .= $foodbakery_var_html_fields->foodbakery_var_upload_file_field( $foodbakery_opt_array );

        $foodbakery_html .= '
			<div class="form-elements" id="foodbakery_var_infobox_networks' . absint( $foodbakery_rand_num ) . '">
			  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><label>' . foodbakery_var_theme_text_srt( 'foodbakery_var_icon' ) . '</label></div>
			  <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				' . foodbakery_var_icomoon_icons_box( $_POST['social_net_awesome'], "networks" . absint( $foodbakery_rand_num ), 'foodbakery_var_social_net_awesome' ) . '
			  </div>
			</div>';

        $foodbakery_opt_array = array(
            'name' => foodbakery_var_theme_text_srt( 'foodbakery_var_icon_color' ),
            'desc' => '',
            'hint_text' => '',
            'field_params' => array(
                'std' => isset( $_POST['social_font_awesome_color'] ) ? $_POST['social_font_awesome_color'] : '',
                'cust_id' => 'social_font_awesome_color' . absint( $foodbakery_rand_num ),
                'cust_name' => 'foodbakery_var_social_icon_color[]',
                'classes' => 'bg_color',
                'return' => true,
            ),
        );
        $foodbakery_html .= $foodbakery_var_html_fields->foodbakery_var_text_field( $foodbakery_opt_array );

        $foodbakery_html .= '	
		  </td>
		</tr>';

        echo foodbakery_allow_special_char( $foodbakery_html );
        die;
    }

    add_action( 'wp_ajax_foodbakery_var_add_social_icon', 'foodbakery_var_add_social_icon' );
}


/**
 * @Tool Tip Help Text Style
 *
 */
if ( ! function_exists( 'foodbakery_var_tooltip_helptext' ) ) {

    function foodbakery_var_tooltip_helptext( $popover_text = '', $return_html = true ) {
        $popover_link = '';
        if ( isset( $popover_text ) && $popover_text != '' ) {
            $popover_link = '<br><em><strong>' . $popover_text . '</strong></em>';
        }
        if ( $return_html == true ) {
            return $popover_link;
        } else {
            echo foodbakery_allow_special_char( $popover_link );
        }
    }

}

/**
 * @Decoding Shortcode
 *
 */
if ( ! function_exists( 'foodbakery_var_custom_shortcode_decode' ) ) {

    function foodbakery_var_custom_shortcode_decode( $sh_content = '' ) {
        $sh_content = str_replace( array( 'foodbakery_open', 'foodbakery_close' ), array( '[', ']' ), $sh_content );
        return $sh_content;
    }

}
