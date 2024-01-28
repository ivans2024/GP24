<?php

/**
 * Saving Theme Options
 *
 */
if ( ! function_exists( 'theme_option_save' ) ) {
    /*
     * function to save theme options
     */

    function theme_option_save() {
        global $foodbakery_var_static_text;
        $strings = new foodbakery_theme_all_strings;
        $strings->foodbakery_theme_option_strings();
        // theme option save request.
        if ( isset( $_REQUEST['foodbakery_var_theme_option_save_flag'] ) ) {
            $_POST = foodbakery_var_stripslashes_htmlspecialchars( $_POST );
			
            if($_POST['foodbakery_var_header_options'] == 'court'){
               $_POST['foodbakery_var_full_header'] = 'on';
			   $_POST['foodbakery_var_transparent_header'] = 'on';
            }

            update_option( "foodbakery_var_options", $_POST );

            // create css file when them option call
            foodbakery_write_stylesheet_content();

            echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_save_msg' ) );
        }
        die();
    }

    add_action( 'wp_ajax_theme_option_save', 'theme_option_save' );
}

/**
 * @Generate Options Backup
 * @return
 *
 */
if ( ! function_exists( 'foodbakery_var_settings_backup_generate' ) ) {

    function foodbakery_var_settings_backup_generate() {

        global $wp_filesystem, $foodbakery_var_options, $foodbakery_var_static_text;
        $strings = new foodbakery_theme_all_strings;
        $strings->foodbakery_theme_option_field_strings();

        $foodbakery_var_export_options = $foodbakery_var_options;

        $foodbakery_var_option_fields = json_encode( $foodbakery_var_export_options, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE );

        $backup_url = wp_nonce_url( 'themes.php?page=foodbakery_var_settings_page' );
        if ( false === ($creds = request_filesystem_credentials( $backup_url, '', false, false, array() ) ) ) {

            return true;
        }

        if ( ! WP_Filesystem( $creds ) ) {
            request_filesystem_credentials( $backup_url, '', true, false, array() );
            return true;
        }

        $foodbakery_var_upload_dir = get_template_directory() . '/include/backend/cs-theme-options/backups/';
        $foodbakery_var_filename = trailingslashit( $foodbakery_var_upload_dir ) . (current_time( 'd-M-Y_H.i.s' )) . '.json';


        if ( ! $wp_filesystem->put_contents( $foodbakery_var_filename, $foodbakery_var_option_fields, FS_CHMOD_FILE ) ) {
            echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_error_saving_file' ) );
        } else {
            echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_backup_generated' ) );
        }

        die();
    }

    add_action( 'wp_ajax_foodbakery_var_settings_backup_generate', 'foodbakery_var_settings_backup_generate' );
}

/**
 * @Delete Backup File
 * @return
 *
 */
if ( ! function_exists( 'foodbakery_var_backup_file_delete' ) ) {

    function foodbakery_var_backup_file_delete() {

        global $wp_filesystem, $foodbakery_var_static_text;

        $strings = new foodbakery_theme_all_strings;
        $strings->foodbakery_theme_option_field_strings();
        $backup_url = wp_nonce_url( 'themes.php?page=foodbakery_var_settings_page' );
        if ( false === ($creds = request_filesystem_credentials( $backup_url, '', false, false, array() ) ) ) {

            return true;
        }

        if ( ! WP_Filesystem( $creds ) ) {
            request_filesystem_credentials( $backup_url, '', true, false, array() );
            return true;
        }

        $foodbakery_var_upload_dir = get_template_directory() . '/include/backend/cs-theme-options/backups/';

        $file_name = isset( $_POST['file_name'] ) ? $_POST['file_name'] : '';

        $foodbakery_var_filename = trailingslashit( $foodbakery_var_upload_dir ) . $file_name;

        if ( is_file( $foodbakery_var_filename ) ) {
            unlink( $foodbakery_var_filename );
            printf( foodbakery_var_theme_text_srt( 'foodbakery_var_file_deleted_successfully' ), $file_name );
        } else {
            echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_error_deleting_file' ) );
        }

        die();
    }

    add_action( 'wp_ajax_foodbakery_var_backup_file_delete', 'foodbakery_var_backup_file_delete' );
}

/**
 * @Restore Backup File
 * @return
 *
 */
if ( ! function_exists( 'foodbakery_var_backup_file_restore' ) ) {

    function foodbakery_var_backup_file_restore() {

        global $wp_filesystem, $foodbakery_var_static_text;
        $strings = new foodbakery_theme_all_strings;
        $strings->foodbakery_theme_option_field_strings();

        $backup_url = wp_nonce_url( 'themes.php?page=foodbakery_var_settings_page' );
        if ( false === ($creds = request_filesystem_credentials( $backup_url, '', false, false, array() ) ) ) {

            return true;
        }

        if ( ! WP_Filesystem( $creds ) ) {
            request_filesystem_credentials( $backup_url, '', true, false, array() );
            return true;
        }

        $foodbakery_var_upload_dir = get_template_directory() . '/include/backend/cs-theme-options/backups/';

        $file_name = isset( $_POST['file_name'] ) ? $_POST['file_name'] : '';

        $file_path = isset( $_POST['file_path'] ) ? $_POST['file_path'] : '';

        if ( $file_path == 'yes' ) {

            $foodbakery_var_file_body = '';

            $foodbakery_var_file_response = wp_remote_get( $file_name, array( 'decompress' => false ) );

            if ( is_array( $foodbakery_var_file_response ) ) {
                $foodbakery_var_file_body = isset( $foodbakery_var_file_response['body'] ) ? $foodbakery_var_file_response['body'] : '';
            }

            if ( $foodbakery_var_file_body != '' ) {

                $get_options_file = json_decode( $foodbakery_var_file_body, true );

                update_option( "foodbakery_var_options", $get_options_file );


                echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_file_import_successfully' ) );
            } else {
                echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_error_restoring_file' ) );
            }

            die;
        }

        $foodbakery_var_filename = trailingslashit( $foodbakery_var_upload_dir ) . $file_name;

        if ( is_file( $foodbakery_var_filename ) ) {

            $get_options_file = $wp_filesystem->get_contents( $foodbakery_var_filename );

            $get_options_file = json_decode( $get_options_file, true );

            update_option( "foodbakery_var_options", $get_options_file );


            $foodbakery_var_file_restore_successfully = foodbakery_var_theme_text_srt( 'foodbakery_var_file_restore_successfully' );
            printf( $foodbakery_var_file_restore_successfully, $file_name );
        } else {
            echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_error_restoring_file' ) );
        }

        die();
    }

    add_action( 'wp_ajax_foodbakery_var_backup_file_restore', 'foodbakery_var_backup_file_restore' );
}

/**
 * @saving all the theme options end
 * @return
 *
 */
if ( ! function_exists( 'theme_option_rest_all' ) ) {

    function theme_option_rest_all() {

        global $wp_filesystem;

        $backup_url = esc_url( home_url( '/' ) );
        if ( false === ($creds = request_filesystem_credentials( $backup_url, '', false, false, array() ) ) ) {

            return true;
        }

        if ( ! WP_Filesystem( $creds ) ) {
            request_filesystem_credentials( $backup_url, '', true, false, array() );
            return true;
        }

        $foodbakery_var_upload_dir = get_template_directory() . '/include/backend/cs-theme-options/default-settings/';

        $foodbakery_var_filename = trailingslashit( $foodbakery_var_upload_dir ) . 'default-settings.json';

        if ( is_file( $foodbakery_var_filename ) ) {

            $get_options_file = $wp_filesystem->get_contents( $foodbakery_var_filename );

            $get_options_file = json_decode( $get_options_file, true );

            update_option( "foodbakery_var_options", $get_options_file );
        } else {
            foodbakery_var_reset_data();
        }
        die;
    }

    add_action( 'wp_ajax_theme_option_rest_all', 'theme_option_rest_all' );
}


/**
 * @Default Options for Theme
 *
 */
if ( ! function_exists( 'theme_default_options' ) ) {

    function theme_default_options() {

        global $wp_filesystem;

        $backup_url = wp_nonce_url( 'themes.php?page=foodbakery_var_settings_page' );
        if ( false === ($creds = request_filesystem_credentials( $backup_url, '', false, false, array() ) ) ) {

            return true;
        }

        if ( ! WP_Filesystem( $creds ) ) {
            request_filesystem_credentials( $backup_url, '', true, false, array() );
            return true;
        }

        $foodbakery_var_upload_dir = get_template_directory() . '/include/backend/cs-theme-options/default-settings/';

        $foodbakery_var_filename = trailingslashit( $foodbakery_var_upload_dir ) . 'default-settings.json';

        if ( is_file( $foodbakery_var_filename ) ) {

            $get_options_file = $wp_filesystem->get_contents( $foodbakery_var_filename );

            $foodbakery_var_default_data = $get_options_file = json_decode( $get_options_file, true );
        } else {
            $foodbakery_var_default_data = '';
        }

        return $foodbakery_var_default_data;
    }

}


/**
 * @Getting Demo Content
 *
 */
if ( ! function_exists( 'foodbakery_var_get_demo_content' ) ) {

    function foodbakery_var_get_demo_content( $foodbakery_var_demo_file = '' ) {

        global $wp_filesystem;

        $backup_url = wp_nonce_url( 'themes.php?page=foodbakery_var_settings_page' );
        if ( false === ( $creds = request_filesystem_credentials( $backup_url, '', false, false, array() ) ) ) {

            return true;
        }

        if ( ! WP_Filesystem( $creds ) ) {
            request_filesystem_credentials( $backup_url, '', true, false, array() );
            return true;
        }

        $foodbakery_var_upload_dir = get_template_directory() . '/include/backend/cs-theme-options/demo-data/';

        $foodbakery_var_filename = trailingslashit( $foodbakery_var_upload_dir ) . $foodbakery_var_demo_file;

        $foodbakery_var_demo_data = array();

        if ( is_file( $foodbakery_var_filename ) ) {

            $get_options_file = $wp_filesystem->get_contents( $foodbakery_var_filename );

            $foodbakery_var_demo_data = $get_options_file;
        }

        return $foodbakery_var_demo_data;
    }

}

/**
 * @theme activation
 * @return
 *
 */
if ( ! function_exists( 'foodbakery_var_activation_data' ) ) {

    function foodbakery_var_activation_data() {
        update_option( 'foodbakery_var_options', theme_default_options() );
    }

}

/**
 * @array for reset theme options
 * @return
 *
 */
if ( ! function_exists( 'foodbakery_var_reset_data' ) ) {

    function foodbakery_var_reset_data() {
        global $reset_data, $foodbakery_var_settings;
        foreach ( $foodbakery_var_settings as $value ) {
            if ( $value['type'] <> 'heading' and $value['type'] <> 'sub-heading' and $value['type'] <> 'main-heading' ) {
                if ( $value['type'] == 'sidebar' || $value['type'] == 'networks' || $value['type'] == 'badges' ) {
                    $reset_data = (array_merge( $reset_data, $value['options'] ));
                } elseif ( 'check_color' == $value['type'] ) {
                    $reset_data[$value['id']] = $value['std'];
                    $reset_data[$value['id'] . '_switch'] = 'off';
                } else {
                    $reset_data[$value['id']] = $value['std'];
                }
            }
        }
        return $reset_data;
    }

}

// commented due to plugin option page selection conflict

if ( ! function_exists('foodbakery_load_all_pages_theme_options_callback') ) {
	add_action('wp_ajax_foodbakery_load_all_pages_theme_options', 'foodbakery_load_all_pages_theme_options_callback');
    function foodbakery_load_all_pages_theme_options_callback() {
		global $foodbakery_var_form_fields;
		$selected_page = isset($_POST['selected_page']) ? $_POST['selected_page'] : '';
		$args = array(
			'sort_order' => 'asc',
			'sort_column' => 'post_title',
			'hierarchical' => 1,
			'exclude' => '',
			//'include' => '',
			'meta_key' => '',
			'meta_value' => '',
			'authors' => '',
			'child_of' => 0,
			'parent' => -1,
			'exclude_tree' => '',
			'number' => '',
			'offset' => 0,
			'post_type' => 'page',
			'post_status' => 'publish'
		);

		$foodbakery_var_pages = get_pages( $args );

		$foodbakery_var_options_array = array();
		$foodbakery_var_options_array[] = foodbakery_var_theme_text_srt( 'foodbakery_var_maintenance_field_select_page' );
		foreach ( $foodbakery_var_pages as $foodbakery_var_page ) {
			$foodbakery_var_options_array[$foodbakery_var_page->ID] = isset( $foodbakery_var_page->post_title ) && ($foodbakery_var_page->post_title != '') ? $foodbakery_var_page->post_title : foodbakery_var_theme_text_srt( 'foodbakery_var_no_title' );
		}
		
		$foodbakery_opt_array = array(
			'std' => $select_value,
			'id' => 'maintinance_mode_page',
			'classes' => 'chosen-select',
			'extra_atr' => '',
			'return' => true,
			'options' => $foodbakery_var_options_array,

		);
		$output .= $foodbakery_var_form_fields->foodbakery_var_form_select_render($foodbakery_opt_array);
		
		$output .= '<script type="text/javascript">
			jQuery(document).ready(function () {
				chosen_selectionbox();
			});
		</script>';
		echo json_encode(array('html' => $output));
		die;
    }
}