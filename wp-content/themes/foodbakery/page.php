<?php
/**
 * The template for displaying all pages
 */
get_header();

$var_arrays = array( 'post', 'foodbakery_node', 'foodbakery_sidebarLayout', 'column_class', 'foodbakery_xmlObject', 'foodbakery_node_id', 'column_attributes', 'foodbakery_paged_id', 'foodbakery_elem_id' );
$page_global_vars = FOODBAKERY_VAR_GLOBALS()->globalizing($var_arrays);
extract($page_global_vars);
$foodbakery_post_id = isset($post->ID) ? $post->ID : '';
if ( isset($foodbakery_post_id) and $foodbakery_post_id <> '' ) {
    $foodbakery_postObject = get_post_meta($post->ID, 'foodbakery_full_data', true);
} else {
    $foodbakery_post_id = '';
}
$section_margin_class = 'page-margin';
$foodbakery_var_page_margin_switch = get_post_meta($post->ID, 'foodbakery_var_page_margin_switch', true);
$foodbakery_var_page_container_switch = get_post_meta($post->ID, 'foodbakery_var_page_container_switch', true);
$foodbakery_page_layout = get_post_meta($post->ID, 'foodbakery_var_page_layout', true);


if ( $foodbakery_var_page_margin_switch == 'on' ) {
    $section_margin_class = 'page-margin';
}
$foodbakery_page_layout = ( $foodbakery_page_layout == '' ) ? 'none' : $foodbakery_page_layout;
?>

<div class="main-section <?php esc_attr($section_margin_class); ?>">
    <?php
    if ( $foodbakery_var_page_container_switch == 'on' || $foodbakery_page_layout != "none" ) {
        echo '<div class="container">';
    }
    ?>
        <?php
        $foodbakery_page_sidebar_right = '';
        $foodbakery_page_sidebar_left = '';
        $foodbakery_postObject = get_post_meta($post->ID, 'foodbakery_var_full_data', true);
        $foodbakery_page_sidebar_right = get_post_meta($post->ID, 'foodbakery_var_page_sidebar_right', true);
        $foodbakery_page_sidebar_left = get_post_meta($post->ID, 'foodbakery_var_page_sidebar_left', true);
        $foodbakery_page_bulider = get_post_meta($post->ID, "foodbakery_page_builder", true);
//
        $section_container_width = '';
        $page_element_size = 'page-content-fullwidth';

        if ( ! isset($foodbakery_page_layout) || $foodbakery_page_layout == "none" ) {
            $page_element_size = 'page-content-fullwidth';
        } else {
            $page_element_size = 'page-content col-lg-8 col-md-8 col-sm-12 col-xs-12';
        }

        if ( class_exists('WooCommerce') ) {
            if ( is_checkout() ) {
                $page_element_size .= ' foodbakery-checkout-page';
            }
        }


        if ( isset($foodbakery_page_layout) ) {
            $foodbakery_sidebarLayout = $foodbakery_page_layout;
        }
        $pageSidebar = false;
        if ( $foodbakery_sidebarLayout == 'left' || $foodbakery_sidebarLayout == 'right' ) {
            $pageSidebar = true;
        }

        if ( isset($foodbakery_page_layout) && $foodbakery_sidebarLayout <> '' and $foodbakery_sidebarLayout <> "none" and $foodbakery_sidebarLayout == 'left' ) :
            if ( is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_page_sidebar_left)) ) {
                ?>
                <aside class="page-sidebar left col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="widget-holder">
                        <?php if ( ! function_exists('dynamic_sidebar') || ! dynamic_sidebar($foodbakery_page_sidebar_left) ) : endif; ?>
                    </div>
                </aside>
                <?php
            }
        endif;
        echo '<div class="' . ($page_element_size) . '">';
        if ( isset($foodbakery_page_bulider) && $foodbakery_page_bulider == 1 ) {
            if ( isset($foodbakery_page_layout) ) {
                $foodbakery_page_sidebar_right = $foodbakery_page_sidebar_right;
                $foodbakery_page_sidebar_left = $foodbakery_page_sidebar_left;
            }
            $foodbakery_counter_node = $column_no = 0;
            $fullwith_style = '';
            $section_container_style_elements = ' ';
            if ( isset($foodbakery_page_layout) && $foodbakery_sidebarLayout <> '' and $foodbakery_sidebarLayout <> "none" ) {

                $fullwith_style = 'style="width:100%;"';
                $section_container_style_elements = ' width: 100%;';
            }
            if ( post_password_required() ) {
                echo '<header class="heading"><h6 class="transform">' . get_the_title() . '</h6></header>';
                echo foodbakery_password_form();
            } else {
                $width = 840;
                $height = 328;
                $image_url = foodbakery_get_post_img_src($post->ID, $width, $height);
                wp_reset_postdata();


                if ( get_the_content() != '' || $image_url != '' ) {
                    if ( $pageSidebar != true ) {
                        ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?php
                            }
                            if ( isset($image_url) && $image_url != '' ) {
                                ?>
                                <a href="<?php echo esc_url($image_url); ?>" data-rel="prettyPhoto" data-title="prettyPhoto">
                                    <figure>
                                        <div class="page-featured-image">
                                            <img class="img-thumbnail cs-page-thumbnail" alt="cs-page-thumbnail" data-src="" src="<?php echo esc_url($image_url); ?>">
                                        </div>
                                    </figure>
                                </a>
                                <?php
                            }
                            echo '<div class="cs-rich-editor">';
                            $pattern = "/<p[^>]*><\\/p[^>]*>/";
                            $content = get_the_content();
                            preg_replace($pattern, '', $content);
                            do_shortcode($content);

                            echo '</div>';

                            if ( $pageSidebar != true ) {
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
        } else {

            $main_con_classes = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
            if ( is_active_sidebar('sidebar-1') ) {
                $main_con_classes = 'col-lg-8 col-md-8 col-sm-12 col-xs-12';
            }
            $theme_options = get_option('wp_rem_cs_var_options');

            if ( ! $theme_options ) {
                echo '<div class="col-xs-12">';
                echo '<div class="row">';
            }
            ?>

            <div class="<?php echo esc_attr($main_con_classes) ?>">
                <div class="container">
                <?php
                while ( have_posts() ) : the_post();
                    echo '<div class="cs-rich-editor">';
                    the_content();
                      wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">Pages</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
                    echo '</div>';
                endwhile;

                if ( comments_open() ) :
                    comments_template('', true);
                endif;
                ?>
                    </div>
            </div>
            <?php
            if ( is_active_sidebar('sidebar-1') ) {
                ?>
                <aside class="page-sidebar col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <?php
                    dynamic_sidebar('sidebar-1');
                    ?>
                </aside>
                <?php
            }
            if ( ! $theme_options ) {
                echo '</div>';
                echo '</div>';
            }

            /*while ( have_posts() ) : the_post();
                echo '<div class="cs-rich-editor">';
                the_content();
                echo '</div>';
            endwhile;
            if ( comments_open() ) :
                comments_template('', true);
            endif;*/
        }
        
        echo '</div>';
        if ( isset($foodbakery_page_layout) && $foodbakery_page_layout <> '' && $foodbakery_page_layout <> "none" && $foodbakery_page_layout == 'right' ) :
            if ( is_active_sidebar(foodbakery_get_sidebar_id($foodbakery_page_sidebar_right)) ) {
                ?>
                <aside class="page-sidebar right col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="widget-holder">
                        <?php if ( ! function_exists('dynamic_sidebar') || ! dynamic_sidebar($foodbakery_page_sidebar_right) ) : endif; ?>
                    </div>
                </aside>
                <?php
            }
        endif;
        if ( $foodbakery_var_page_container_switch == 'on' || $foodbakery_page_layout != "none" ) {
            echo '</div>';
        }
        ?>


</div>
<?php
get_footer();
