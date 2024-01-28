<?php
/**
 * Plugin Name: Foodbakery Shortlists
 * Plugin URI: http://themeforest.net/user/Chimpstudio/
 * Description: Foodbakery Shortlists Add on
 * Version: 3.2
 * Author: ChimpStudio
 * Author URI: http://themeforest.net/user/Chimpstudio/
 * @package Foodbakery
 *
 * @package Foodbakery
 */
// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Foodbakery_Shortlists')) {

    class Foodbakery_Shortlists
    {

        public $admin_notices;

        /**
         * Start construct Functions
         */
        public function __construct()
        {
            // Define constants
            define('FOODBAKERY_SHORTLISTS_PLUGIN_VERSION', '1.6');
            define('FOODBAKERY_SHORTLISTS_PLUGIN_DOMAIN', 'foodbakery-shortlists');
            define('FOODBAKERY_SHORTLISTS_PLUGIN_URL', WP_PLUGIN_URL . '/foodbakery-shortlists');
            define('FOODBAKERY_SHORTLISTS_CORE_DIR', WP_PLUGIN_DIR . '/foodbakery-shortlists');
            define('FOODBAKERY_SHORTLISTS_LANGUAGES_DIR', FOODBAKERY_SHORTLISTS_CORE_DIR . '/languages');

            $this->admin_notices = array();
            //admin notices
            add_action('admin_notices', array($this, 'foodbakery_shortlist_notices_callback'));
            if (!$this->check_dependencies()) {
                return false;
            }

            // Initialize Addon
            add_action('init', array($this, 'init'), 0);
        }

        /**
         * Initialize application, load text domain, enqueue scripts and bind hooks
         */
        public function init()
        {
            // Add Plugin textdomain
            load_plugin_textdomain(FOODBAKERY_SHORTLISTS_PLUGIN_DOMAIN, false, FOODBAKERY_SHORTLISTS_LANGUAGES_DIR);
            // Enqueue JS
            wp_enqueue_script('foodbakery-shortlists-script', esc_url(FOODBAKERY_SHORTLISTS_PLUGIN_URL . '/assets/js/functions.js'), '', FOODBAKERY_SHORTLISTS_PLUGIN_DOMAIN, true);
            wp_localize_script('foodbakery-shortlists-script', 'foodbakery_shortlists', array(
                'admin_url' => esc_url(admin_url('admin-ajax.php')),
                'confirm_msg' => esc_html__('Are you sure to do this?', 'foodbakery-shortlists')
            ));

            // Add hook for dashboard publisher top menu links.
            add_action('foodbakery_top_menu_shortlists_dashboard', array($this, 'shortlists_top_menu_publisher_dashboard_callback'), 10, 3);
            add_filter('foodbakery_member_permissions', array($this, 'foodbakery_shortlists_member_permissions_callback'), 11, 1);
            // Add actions
            add_action('wp_ajax_foodbakery_publisher_shortlists', array($this, 'foodbakery_publisher_shortlists_callback'), 11, 2);
            add_action('foodbakery_shortlists_frontend_button', array($this, 'foodbakery_shortlists_frontend_button_callback'), 11, 3);
            add_action('wp_ajax_foodbakery_shortlist_submit', array($this, 'foodbakery_shortlist_submit_callback'), 11);
            add_action('wp_ajax_foodbakery_removed_shortlist', array($this, 'foodbakery_removed_shortlist_callback'), 11);
        }

        public function shortlists_top_menu_publisher_dashboard_callback($foodbakery_page_id, $icon = '', $shortlist_url = '')
        {
            global $total_shortlists;
            $permissions = apply_filters('member_permissions', '');
            $permission = apply_filters('check_permissions', 'shortlists', '');

            $publisher_id = get_current_user_id();
            $user_company = get_user_meta($publisher_id, 'foodbakery_company', true);

            $shortlists = get_post_meta($user_company, 'foodbakery_shortlists', true);

            $all_listings = array();
            if (isset($shortlists) && !empty($shortlists)) {
                $listing_ids = array();
                foreach ($shortlists as $shortlist_data) {
                    $listing_ids[] = $shortlist_data['listing_id'];
                }
                $args = array(
                    'post_type' => 'restaurants',
                    'post__in' => $listing_ids,
                    'post_status' => 'publish',
                    'fields' => 'ids',
                    'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key' => 'foodbakery_listing_expired',
                            'value' => strtotime(date("d-m-Y")),
                            'compare' => '>=',
                        ),
                        array(
                            'key' => 'foodbakery_listing_status',
                            'value' => 'active',
                            'compare' => '=',
                        ),
                    ),
                );
                $shortlist_query = new WP_Query($args);

                $total_shortlists = $shortlist_query->found_posts;
                wp_reset_postdata();
            }


            $permission_added = false;
            if (array_key_exists('shortlists', $permissions)) {
                $permission_added = true;
            }
            if (isset($shortlist_url) && $shortlist_url <> '') {
                if ($permission == true || $permission_added == false) {
                    echo ' <li class="user_dashboard_ajax" id="foodbakery_publisher_shortlists" data-queryvar="dashboard=shortlists"><a href="' . $shortlist_url . '">' . $icon . $foodbakery_page_id . '</a></li>';
                }
            } else if ($permission == true || $permission_added == false) {
                echo ' <li class="user_dashboard_ajax" id="foodbakery_publisher_shortlists" data-queryvar="dashboard=shortlists"><a href="javascript:void(0);">' . $icon . $foodbakery_page_id . '</a></li>';
            }
        }

        public function shortlists_dashboard_callback($foodbakery_page_id, $icon = '')
        {
            $permissions = apply_filters('member_permissions', '');
            $permission = apply_filters('check_permissions', 'shortlists', '');
            $permission_added = false;
            if (array_key_exists('shortlists', $permissions)) {
                $permission_added = true;
            }
            echo ' <li class="user_dashboard_ajax" id="foodbakery_publisher_shortlists"><a href="javascript:void(0);">' . $icon . ' ' . $foodbakery_page_id . '</a></li>';
        }

        public function foodbakery_shortlists_member_permissions_callback($permissions)
        {
            $permissions['shortlists'] = esc_html__('Shortlists Manage', 'foodbakery-shortlists');
            return $permissions;
        }

        /**
         * Check plugin dependencies (Foodbakery), nag if missing.
         *
         * @param boolean $disable disable the plugin if true, defaults to false.
         */
        public function check_dependencies($disable = false)
        {
            $result = true;
            $active_plugins = get_option('active_plugins', array());
            if (is_multisite()) {
                $active_sitewide_plugins = get_site_option('active_sitewide_plugins', array());
                $active_sitewide_plugins = array_keys($active_sitewide_plugins);
                $active_plugins = array_merge($active_plugins, $active_sitewide_plugins);
            }
            $foodbakery_is_active = in_array('wp-foodbakery/wp-foodbakery.php', $active_plugins);
            if (!$foodbakery_is_active) {
                $this->admin_notices[] = '<div class="error">' . esc_html__('<em><b>Foodbakery Shortlists</b></em> needs the <b>Foodbakery</b> plugin. Please install and activate it.', 'foodbakery-shortlists') . '</div>';
            }
            if (!$foodbakery_is_active) {
                if ($disable) {
                    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
                    deactivate_plugins(array(__FILE__));
                }
                $result = false;
            }
            return $result;
        }

        public function foodbakery_shortlist_notices_callback()
        {
            if (isset($this->admin_notices) && !empty($this->admin_notices)) {
                foreach ($this->admin_notices as $value) {
                    echo $value;
                }
            }
        }

        /**
         * Publisher Shortlists
         * @ filter the shortlists based on publisher id
         */
        public function foodbakery_publisher_shortlists_callback($publisher_id = '', $post_type = '')
        {
            global $foodbakery_plugin_options;

            $pagi_per_page = isset($foodbakery_plugin_options['foodbakery_publisher_dashboard_pagination']) ? $foodbakery_plugin_options['foodbakery_publisher_dashboard_pagination'] : '';

            // Publisher ID.
            if (!isset($publisher_id) || $publisher_id == '') {
                $publisher_id = get_current_user_id();
            }
            // Post Type.
            if (!isset($post_type) || $post_type == '') {
                $post_type = 'restaurants';
            }
            $user_company = get_user_meta($publisher_id, 'foodbakery_company', true);

            $shortlists = get_post_meta($user_company, 'foodbakery_shortlists', true);
            //  print_r($shortlists);
            $all_listings = array();
            $listing_ids = array();
            if (isset($shortlists) && !empty($shortlists)) {

                foreach ($shortlists as $shortlist_data) {
                    $listing_ids[] = $shortlist_data['listing_id'];
                }
                $args = array(
                    'posts_per_page' => -1,
                    'post_type' => $post_type,
                    'post__in' => $listing_ids,
                    'post_status' => 'publish',

                );
                $shortlist_query = new WP_Query($args);
                $total_posts = $shortlist_query->post_count;

                $posts_per_page = $pagi_per_page > 0 ? $pagi_per_page : 10;
                $posts_paged = isset($_REQUEST['page_id_all']) ? $_REQUEST['page_id_all'] : '';

                $args = array(
                    'posts_per_page' => $posts_per_page,
                    'paged' => $posts_paged,
                    'post_type' => $post_type,
                    'post__in' => $listing_ids,
                    'post_status' => 'publish',

                );
                $shortlist_query = new WP_Query($args);

                $this->render_view($shortlist_query);
                wp_reset_postdata();

                $total_pages = 1;
                if ($total_posts > 0 && $posts_per_page > 0 && $total_posts > $posts_per_page) {
                    $total_pages = ceil($total_posts / $posts_per_page);

                    $foodbakery_dashboard_page = isset($foodbakery_plugin_options['foodbakery_publisher_dashboard']) ? $foodbakery_plugin_options['foodbakery_publisher_dashboard'] : '';
                    $foodbakery_dashboard_link = $foodbakery_dashboard_page != '' ? get_permalink($foodbakery_dashboard_page) : '';
                    $this_url = $foodbakery_dashboard_link != '' ? add_query_arg(array('dashboard' => 'shortlists'), $foodbakery_dashboard_link) : '';
                    foodbakery_dashboard_pagination($total_pages, $posts_paged, $this_url, 'shortlists');
                }
            } else {

                echo $this->render_view();
            }
            wp_die();
        }

        /**
         * Publisher Shortlists HTML render
         * @ HTML before and after the shortlists listing items
         */
        public function render_view($shortlist_query = '')
        {
            ?>
            <div class="user-shortlist-list listing simple">
                <div class="element-title has-border">
                    <h5><?php echo esc_html__('Shortlists', 'foodbakery-shortlists'); ?></h5>
                </div>
                <?php if ($shortlist_query != '' && $shortlist_query->have_posts()) : ?>
                    <ul class="shortlists-list">
                        <?php echo $this->render_list_item_view($shortlist_query); ?>
                    </ul>
                <?php else: ?>
                    <div class="not-found">
                        <i class="icon-error"></i>
                        <p><?php echo esc_html__('You don\'t have any shortlists.', 'foodbakery-shortlists'); ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <?php
        }

        /**
         * Publisher Shortlists Items HTML render
         * @ HTML for shortlists listing items
         */
        public function render_list_item_view($shortlist_query)
        {
            while ($shortlist_query->have_posts()) : $shortlist_query->the_post();

                $category_all = get_the_terms(get_the_ID(), 'restaurant-category');
                $foodbakery_post_loc_address_restaurant = get_post_meta(get_the_ID(), 'foodbakery_post_loc_address_restaurant', true);
                ?>
                <li>
                    <div class="suggest-list-holder">
                        <div class="img-holder">
                            <figure>
                                <a href="<?php echo esc_url(get_the_permalink()); ?>">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail('full');
                                    } else {
                                        $no_image_url = esc_url(wp_foodbakery::plugin_url() . 'assets/frontend/images/no-image4x3.jpg');
                                        $no_image = '<img alt="" src="' . $no_image_url . '" />';
                                        echo force_balance_tags($no_image);
                                    }
                                    ?>
                                </a>
                            </figure>
                        </div>
                        <div class="text-holder">
                            <div class="post-title">
                                <h5>
                                    <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo get_the_title(); ?></a>
                                </h5>
                            </div>
                            <div class="delivery-potions">
                                <span><?php echo esc_html($foodbakery_post_loc_address_restaurant); ?></span>
                            </div>
                            <?php
                            if (is_array($category_all) || is_object($category_all))
                            {
                                foreach ($category_all as $key => $category) {
                                    if (isset($category->name) && $category->name != '') {
                                        ?>
                                        <span><?php echo esc_html($category->name); ?></span>
                                        <?php
                                        echo ', ';
                                    }
                                }
                            }
                            ?>
                            <?php
                            echo '<div class="list-option">';

                            echo '<a href="' . esc_url(get_the_permalink()) . '" class="viewmenu-btn">' . __('View Menu', 'foodbakery') . '</a>';
                            echo '<a href="javascript:void(0);" class="short-icon delete-shortlist" data-id="' . intval(get_the_ID()) . '"><i class="icon-close2"></i></a>';
                            echo '</div>';
                            ?>
                        </div>
                    </div>
                </li>
            <?php
            endwhile;
        }

        /**
         * Publisher Shortlists Frontend Button
         * @ shortlists frontend buuton based on listing id
         */
        public function foodbakery_shortlists_frontend_button_callback($post_id = '', $args = array(), $figcaption_div = false)
        {
            $before_label = '';
            $after_label = '';
            $before_icon = '<i class="icon-heart5"></i>';
            $after_icon = '<i class="icon-heart-o"></i>';
            extract($args);
            $user_id = get_current_user_id();
            $class = 'shortlist-btn';
            $shortlist_icon = $before_icon;
            $change_icon = $after_icon;
            $shortlist_text = $before_label;
            if ($user_id != 0 && $post_id != '') {
                $user_info = get_userdata($user_id);
                $user_role = implode(', ', $user_info->roles);
                $user_company = get_user_meta($user_id, 'foodbakery_company', true);
                $listing_shortlists = get_post_meta($user_company, 'foodbakery_shortlists', true);

                if (!empty($listing_shortlists) && $this->foodbakery_shortlists_find_in_multiarray($post_id, $listing_shortlists, 'listing_id')) {
                    $class = 'shortlisted';
                    $shortlist_text = $after_label;
                    $shortlist_icon = $after_icon;
                    $change_icon = $before_icon;
                }

                if (true === Foodbakery_Member_Permissions::check_permissions('shortlists')) {
                    if (isset($figcaption_div) && $figcaption_div == true) {
                        ?>
                        <div class="shortlist-btn">
                        <?php
                    }
                    ?>
                    <a href="javascript:void(0);" class="shortlist-btn <?php echo esc_html($class); ?>"
                       onclick="foodbakery_publisher_shortlist(this, '<?php echo intval($post_id); ?>', '<?php echo intval($user_id); ?>', '<?php echo esc_html($before_label); ?>', '<?php echo esc_html($after_label); ?>', '<?php echo esc_html($before_icon); ?>', '<?php echo esc_html($after_icon); ?>');">
                        <?php echo $shortlist_icon; ?><?php echo esc_html($shortlist_text); ?>
                    </a>

                    <?php
                    if (isset($figcaption_div) && $figcaption_div == true) {
                        ?>
                        </div>
                        <?php
                    }
                }
            } else {
                ?>

                <a href="javascript:void(0);" class="<?php echo esc_html($class); ?>" data-toggle="modal"
                   data-target="#sign-in">
                    <?php echo $shortlist_icon; ?><?php echo esc_html($shortlist_text); ?>
                </a>

                <?php
            }
        }

        /**
         * Publisher Shortlists
         * @ added publisher shortlists based on listing id
         */
        public function foodbakery_shortlist_submit_callback()
        {
            $listing_id = foodbakery_get_input('listing_id');
            $publisher_id = foodbakery_get_input('publisher_id');
            $current_user = wp_get_current_user();
            $response = $publisher_shortlists = array();

            if ('' != $publisher_id) {
                $user_company = get_user_meta($publisher_id, 'foodbakery_company', true);
                $publisher_name = get_the_title($user_company);
                $publisher_shortlists = empty(get_post_meta($user_company, 'foodbakery_shortlists', true)) ? array() : get_post_meta($user_company, 'foodbakery_shortlists', true);
                if (!empty($publisher_shortlists) && $this->foodbakery_shortlists_find_in_multiarray($listing_id, $publisher_shortlists, 'listing_id')) {
                    foreach ($publisher_shortlists as $key => $sub_array) {
                        if ($sub_array['listing_id'] == $listing_id) {
                            unset($publisher_shortlists[$key]);
                            $response['status'] = false;
                            $response['msg'] = esc_html__('Shortlist removed', 'foodbakery-shortlists');
                        }
                    }
                } else {
                    $publisher_shortlists_ = array(
                        'listing_id' => $listing_id,
                        'date' => strtotime(date('d-m-Y')),
                    );
                    array_push($publisher_shortlists, $publisher_shortlists_);
                    $response['status'] = true;
                    $response['msg'] = esc_html__('Shortlist added', 'foodbakery-shortlists');
                    /*
                     * Adding Notification
                     */
                    $notification_array = array(
                        'type' => 'listing',
                        'element_id' => $listing_id,
                        'message' => __($publisher_name . ' shortlisted your listing <a href="' . get_the_permalink($listing_id) . '">' . wp_trim_words(get_the_title($listing_id), 5) . '</a> .', 'foodbakery'),
                    );
                    do_action('foodbakery_add_notification', $notification_array);
                }
                if (!empty($publisher_shortlists)) {
                    $publisher_shortlists = array_values($publisher_shortlists);
                }
                update_post_meta($user_company, 'foodbakery_shortlists', $publisher_shortlists);
            } else {
                $response['status'] = false;
                $response['msg'] = esc_html__('Shortlist removed', 'foodbakery-shortlists');
            }
            echo json_encode($response);

            wp_die();
        }

        /**
         * Publisher Removed Shortlist
         * @ removed publisher shortlists based on listing id
         */
        public function foodbakery_removed_shortlist_callback()
        {

            $listing_id = foodbakery_get_input('listing_id');
            $current_user = wp_get_current_user();
            $publisher_id = get_current_user_id();
            $response = array();
            $response['status'] = false;
            if ('' != $listing_id && '' != $publisher_id) {
                $user_company = get_user_meta($publisher_id, 'foodbakery_company', true);
                $publisher_shortlists = get_post_meta($user_company, 'foodbakery_shortlists', true);
                foreach ($publisher_shortlists as $key => $sub_array) {
                    if ($sub_array['listing_id'] == $listing_id) {
                        unset($publisher_shortlists[$key]);
                        $response['status'] = true;
                        $response['message'] = 'Deleted Successfully';
                    }
                }
                if (!empty($publisher_shortlists)) {
                    $publisher_shortlists = array_values($publisher_shortlists);
                }
                update_post_meta($user_company, 'foodbakery_shortlists', $publisher_shortlists);
                $notification_array = array(
                    'type' => 'listing',
                    'element_id' => $listing_id,
                    'msg' => __($current_user->user_login . ' one of your listing removed from shortlists.', 'foodbakery'),
                );
                do_action('foodbakery_add_notification', $notification_array);
            }
            echo json_encode($response);
            wp_die();
        }

        public function foodbakery_shortlists_find_in_multiarray($elem, $array, $field)
        {

            $top = sizeof($array);
            $k = 0;
            $new_array = array();
            for ($i = 0; $i <= $top; $i++) {
                if (isset($array[$i])) {
                    $new_array[$k] = $array[$i];
                    $k++;
                }
            }
            $array = $new_array;
            $top = sizeof($array) - 1;
            $bottom = 0;

            $finded_index = array();
            if (is_array($array)) {
                while ($bottom <= $top) {
                    if ($array[$bottom][$field] == $elem)
                        $finded_index[] = $bottom;
                    else
                        if (is_array($array[$bottom][$field]))
                            if (foodbakery_find_in_multiarray($elem, ($array[$bottom][$field])))
                                $finded_index[] = $bottom;
                    $bottom++;
                }
            }
            return $finded_index;
        }

    }

    global $foodbakery_shortlists;
    $foodbakery_shortlists = new Foodbakery_Shortlists();
}