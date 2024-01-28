<?php
/**
 * The template for displaying image attachments
 *
 * @package WordPress
 * @subpackage Foodbakery
 * @since Foodbakery
 */
get_header();

if ( isset( $foodbakery_var_options['foodbakery_var_excerpt_length'] ) && $foodbakery_var_options['foodbakery_var_excerpt_length'] <> '' ) {
    $default_excerpt_length = $foodbakery_var_options['foodbakery_var_excerpt_length'];
} else {
    $default_excerpt_length = '60';
}
$foodbakery_layout = isset( $foodbakery_var_options['foodbakery_var_default_page_layout'] ) ? $foodbakery_var_options['foodbakery_var_default_page_layout'] : '';
$foodbakery_default_sidebar = false;
if ( $foodbakery_layout == '' ) {
    $foodbakery_default_sidebar = true;
}
if ( isset( $foodbakery_layout ) && ($foodbakery_layout == "sidebar_left" || $foodbakery_layout == "sidebar_right") ) {
    $foodbakery_col_class = "page-content col-lg-8 col-md-8 col-sm-12 col-xs-12";
} else if ( $foodbakery_default_sidebar == true ) {
    $foodbakery_col_class = "page-content col-lg-8 col-md-8 col-sm-12 col-xs-12";
} else {
    $foodbakery_col_class = "page-content-fullwidth col-lg-12 col-md-12 col-sm-12 col-xs-12";
}
$strings = new foodbakery_theme_all_strings;
$strings->foodbakery_theme_option_strings();
$foodbakery_sidebar = isset( $foodbakery_var_options['foodbakery_var_default_layout_sidebar'] ) ? $foodbakery_var_options['foodbakery_var_default_layout_sidebar'] : '';
$foodbakery_blog_excerpt_theme_option = isset( $foodbakery_var_options['foodbakery_var_excerpt_length'] ) ? $foodbakery_var_options['foodbakery_var_excerpt_length'] : '255';
$section_margin_class = 'page-margin';
$foodbakery_var_page_margin_switch = get_post_meta($post->ID, 'foodbakery_var_page_margin_switch', true);
if ( $foodbakery_var_page_margin_switch == 'on' ) {
	$section_margin_class = 'page-margin';
}
?>
<div class="main-section <?php esc_attr($section_margin_class); ?>">
    <div class="page-section">
        <!-- Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <?php if ( $foodbakery_layout == 'sidebar_left' ) { ?>
                    <div class="page-sidebar col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="widget-holder">
                        <?php
                        if ( is_active_sidebar( foodbakery_get_sidebar_id( $foodbakery_sidebar ) ) ) {
                            if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( $foodbakery_sidebar ) ) : endif;
                        }
                        ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="<?php echo esc_html( $foodbakery_col_class ); ?>">
                    <?php
                    // Start the loop.
                    while ( have_posts() ) : the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <nav id="image-navigation" class="navigation image-navigation">
                                <div class="nav-links">
                                    <div class="nav-previous"><?php previous_image_link( false, foodbakery_var_theme_text_srt( 'foodbakery_var_page_previous' ) ); ?></div>
                                    <div class="nav-next"><?php next_image_link( false, foodbakery_var_theme_text_srt( 'foodbakery_var_page_next' ) ); ?></div>
                                </div><!-- .nav-links -->
                            </nav><!-- .image-navigation -->
                            <header class="entry-header">
                                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                            </header><!-- .entry-header -->
                            <div class="entry-content">
                                <div class="entry-attachment">
                                    <?php
                                    /**
                                     * Filter the default foodbakery image attachment size.
                                     *
                                     * @since Foodbakery
                                     *
                                     * @param string $image_size Image size. Default 'large'.
                                     */
                                    $image_size = apply_filters( 'foodbakery_attachment_size', 'large' );
                                    echo wp_get_attachment_image( get_the_ID(), $image_size );
                                    ?>
                                    <?php
                                    if ( function_exists( 'foodbakery_excerpt' ) ):
                                        foodbakery_excerpt( 'entry-caption' );
                                    endif;
                                    ?>
                                </div><!-- .entry-attachment -->
                                <?php
                                the_content();
                                wp_link_pages( array(
                                    'before' => '<div class="page-links"><span class="page-links-title">' . foodbakery_var_theme_text_srt( 'foodbakery_var_pages' ) . '</span>',
                                    'after' => '</div>',
                                    'link_before' => '<span>',
                                    'link_after' => '</span>',
                                    'pagelink' => '<span class="screen-reader-text">' . foodbakery_var_theme_text_srt( 'foodbakery_var_page' ) . ' </span>%',
                                    'separator' => '<span class="screen-reader-text">, </span>',
                                ) );
                                ?>
                            </div><!-- .entry-content -->
                            <footer class="entry-footer">
                                <?php
                                if ( function_exists( 'foodbakery_entry_meta' ) ):
                                    foodbakery_entry_meta();
                                endif;
                                
                                // Retrieve attachment metadata.
                                $metadata = wp_get_attachment_metadata();
                                if ( $metadata ) {
                                    printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>', esc_html_x( 'Full size', 'Used before full size attachment link.', 'foodbakery' ), esc_url( wp_get_attachment_url() ), absint( $metadata['width'] ), absint( $metadata['height'] )
                                    );
                                }
                                edit_post_link(
                                        sprintf(
                                                /* translators: %s: Name of current post */
                                                esc_html__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'foodbakery' ), get_the_title()
                                        ), '<span class="edit-link">', '</span>'
                                );
                                ?>
                            </footer><!-- .entry-footer -->
                        </article><!-- #post-## -->
                        <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                        // Parent post navigation.
                        the_post_navigation( array(
                            'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'foodbakery' ),
                        ) );
                    // End the loop.
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
                <?php
                if ( isset( $foodbakery_layout ) && $foodbakery_layout == 'sidebar_right' ) {
                    if ( is_active_sidebar( foodbakery_get_sidebar_id( $foodbakery_sidebar ) ) ) {
                        ?>
                        <div class="page-sidebar col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="widget-holder">
                            <?php
                            if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( $foodbakery_sidebar ) ) :
                                ?><?php
                            endif;
                            ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                if ( is_active_sidebar( 'sidebar-1' ) ) {
                    echo '<div class="page-sidebar col-lg-4 col-md-4 col-sm-12 col-xs-12">';
                    echo '<div class="widget-holder">';
                    if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'sidebar-1' ) ) : endif;
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-section -->
</div><!-- .main-section -->
<?php get_footer(); ?>
