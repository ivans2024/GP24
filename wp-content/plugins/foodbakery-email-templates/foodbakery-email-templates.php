<?php
/**
 * Plugin Name: Foodbakery Email Templates
 * Plugin URI: http://themeforest.net/user/Chimpstudio/
 * Description: Foodbakery Email Templates Add on
 * Version: 3.2
 * Author: ChimpStudio
 * Author URI: http://themeforest.net/user/Chimpstudio/
 * @package WP Foodbakery
 *
 * @package	Foodbakery
 */

// Direct access not allowed.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define constants
define( 'FOODBAKERY_EMAIL_TEMPLATES_VERSION', '3.0' );
define( 'FOODBAKERY_EMAIL_TEMPLATES_FILE', __FILE__ );
define( 'FOODBAKERY_EMAIL_TEMPLATES_CORE_DIR', WP_PLUGIN_DIR . '/foodbakery-email-templates' );
define( 'FOODBAKERY_EMAIL_TEMPLATES_INCLUDES_DIR', FOODBAKERY_EMAIL_TEMPLATES_CORE_DIR . '/includes' );
define( 'FOODBAKERY_EMAIL_TEMPLATES_LANGUAGES_DIR', FOODBAKERY_EMAIL_TEMPLATES_CORE_DIR . '/languages' );
define( 'FOODBAKERY_EMAIL_TEMPLATES_PLUGIN_URL', WP_PLUGIN_URL . '/foodbakery-email-templates' );

require_once( FOODBAKERY_EMAIL_TEMPLATES_INCLUDES_DIR . '/class-foodbakery-email-templates.php');

if ( ! function_exists( 'foodbakery_check_if_template_exists' ) ) {

	function foodbakery_check_if_template_exists( $slug, $type ) {
		global $wpdb;
		$post = $wpdb->get_row( "SELECT ID FROM " . $wpdb->prefix . "posts WHERE post_name = '" . $slug . "' && post_type = '" . $type . "'", 'ARRAY_A' );

		if ( isset( $post ) && isset( $post['ID'] ) ) {
			return $post['ID'];
		} else {
			return false;
		}
	}

}
