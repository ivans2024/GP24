<?php
/**
 * Main plugin class (boots the plugin conditionally).
 *
 * @since 1.0
 * @package	Foodbakery
 */
// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main plugin class (boots the plugin conditionally).
 */
class Foodbakery_Email_Templates {

    /**
     * Keep all admin messages
     *
     * @var array Array Containing all admin email_templates.
     */
    private $admin_messages = array();

    public function __construct() {
        add_action('admin_notices', array($this, 'admin_notices'));
        add_action('init', array($this, 'text_domain'));
        if ($this->check_dependencies()) {
            require_once( FOODBAKERY_EMAIL_TEMPLATES_INCLUDES_DIR . '/class-templates-post-type.php' );
            require_once( FOODBAKERY_EMAIL_TEMPLATES_INCLUDES_DIR . '/class-email-templates-data.php' );
            require_once( FOODBAKERY_EMAIL_TEMPLATES_INCLUDES_DIR . '/class-templates-functions.php' );
        }
    }

    /**
     * Loads translations.
     */
    public function text_domain() {
        $locale = apply_filters('plugin_locale', get_locale(), 'foodbakery-email-templates');

        load_textdomain('foodbakery-email-templates', FOODBAKERY_EMAIL_TEMPLATES_LANGUAGES_DIR . '/foodbakery-email-templates-' . $locale . '.mo');
        load_plugin_textdomain('foodbakery-email-templates', false, FOODBAKERY_EMAIL_TEMPLATES_LANGUAGES_DIR);
    }

    /**
     * Prints admin notices.
     */
    public function admin_notices() {
        if (!empty($this->admin_messages)) {
            foreach ($this->admin_messages as $msg) {
                echo $msg;
            }
        }
    }

    /**
     * Check plugin dependencies (Foodbakery), nag if missing.
     *
     * @param boolean $disable Disable the plugin if true, defaults to false.
     */
    public function check_dependencies($disable = false) {
        $result = true;
        $active_plugins = get_option('active_plugins', array());
        if (is_multisite()) {
            $active_sitewide_plugins = get_site_option('active_sitewide_plugins', array());
            $active_sitewide_plugins = array_keys($active_sitewide_plugins);
            $active_plugins = array_merge($active_plugins, $active_sitewide_plugins);
        }
        $foodbakery_is_active = in_array('wp-foodbakery/wp-foodbakery.php', $active_plugins);
        if (!$foodbakery_is_active) {
            $this->admin_messages[] = "<div class='error'>" . __('<em><b>Foodbakery Email Templates</b></em> needs the <b>Foodbakery</b> plugin. Please install and activate it.', 'foodbakery-email-templates') . '</div>';
        }
        if (!$foodbakery_is_active) {
            if ($disable) {
                include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                deactivate_plugins(array(__FILE__));
            }
            $result = false;
        }
        return $result;
    }
	
	

}

$obj = new Foodbakery_Email_Templates();