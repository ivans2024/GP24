<?php
/**
 * File Type: Global Varibles Functions
 */
if ( ! class_exists( 'foodbakery_global_functions' ) ) {

    class foodbakery_global_functions {

        // The single instance of the class
        protected static $_instance = null;

        public function __construct() {
            // Do something...
        }

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function theme_options() {
            global $foodbakery_var_options;

            return $foodbakery_var_options;
        }

        public function globalizing( $var_array = array() ) {
            if ( is_array( $var_array ) && sizeof( $var_array ) > 0 ) {
                $return_array = array();
                foreach ( $var_array as $value ) {
                    global $$value;
                    $return_array[$value] = $$value;
                }
                return $return_array;
            }
        }

    }

    function FOODBAKERY_VAR_GLOBALS() {
        return foodbakery_global_functions::instance();
    }

    $GLOBALS['foodbakery_global_functions'] = FOODBAKERY_VAR_GLOBALS();
}


if ( ! function_exists( 'foodbakery_post_detail' ) ) {

    function foodbakery_post_detail( $width, $height, $postid, $view ) {
        global $post, $foodbakery_node, $foodbakery_options, $foodbakery_counter_node;
        $foodbakery_post_counter = rand( 40, 9999999 );
        $foodbakery_counter_node ++;

        if ( $view == 'post-list' ) {
            $viewMeta = 'foodbakery_post_list_gallery';
        } else {
            $viewMeta = $view;
        }
        $foodbakery_meta_slider_options = get_post_meta( "$postid", $viewMeta, true );
        $totaImages = '';

        $foodbakery_counter = 1;

        $sliderData = get_post_meta( $post->ID, 'foodbakery_post_detail_gallery_url', true );
        $totaImages = count( $sliderData );

        asort( $sliderData );
        foreach ( $sliderData as $as_node ) {
            $as_node = foodbakery_attachment_image_id( $as_node );
            $image_url = foodbakery_attachment_image_src( (int) $as_node, $width, $height );

            echo ' <li><figure><img src="' . esc_url( $image_url ) . '" alt="image_url"></figure></li>';
            $foodbakery_counter ++;
        }
    }

}
/**
 * Start filter thumbnail function
 */
if ( ! function_exists( 'foodbakery_remove_thumbnail_dimensions' ) ) {
    add_filter( 'post_thumbnail_html', 'foodbakery_remove_thumbnail_dimensions', 10, 3 );

    function foodbakery_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
        $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
        return $html;
    }

}
/**
 * Start Function Related Blog Posts
 */
if ( ! function_exists( 'foodbakery_related_posts' ) ) {

    function foodbakery_related_posts( $number_post = '-1' ) {
        global $post, $foodbakery_var_static_text;
        // check related posts on/off.
        $rel_posts = get_post_meta( $post->ID, 'foodbakery_var_related_post', true );
        if ( 'on' === $rel_posts ) {
            $post_cats = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
            $args = array(
                'category__in' => $post_cats,
                'posts_per_page' => $number_post,
                'post__not_in' => array( $post->ID ),
            );
            $rel_qry = new WP_Query( $args );
            if ( $rel_qry->have_posts() ) :
                ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="related-post-holder">
                        <div class="element-title">
                            <h3><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_recommended_posts' ) ); ?></h3>
                        </div>
                        <div class="row">
                        <div class="swiper-container swiper-container-horizontal">
                            <div class="swiper-wrapper">
                                <?php
                                while ( $rel_qry->have_posts() ) : $rel_qry->the_post();
                                    global $post;
                                    $cs_views_counter = get_post_meta( $post->ID, "foodbakery_post_views_counter", true );
                                    if ( $cs_views_counter == '' ) {
                                        $cs_views_counter = '0';
                                    }
                                    $thumb_id = get_post_thumbnail_id();
                                    if ( $thumb_id ) :
                                        $post_cats = wp_get_post_categories( get_the_ID(), array( 'fields' => 'all' ) );
                                        $image = wp_get_attachment_image_src( $thumb_id, 'foodbakery_media_4' );
                                        $image_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
                                        $image_url = $image[0];
                                        ?>
                                        <div class="swiper-slide col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <div class="related-post">
                                                <div class="img-holder">
                                                    <figure><a href="<?php echo esc_url( get_permalink() ); ?>"><img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_html( $image_alt ); ?>" /></a>
                                                    </figure>
                                                </div>
                                                <div class="text-holder">
                                                    <ul class="post-options">
                                                        <li>
                                                            <i class="icon-clock"></i>
                                                            <span><a href="<?php echo esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ); ?>"><?php echo get_the_date( 'M j, Y' ); ?></a></span>
                                                        </li>
                                                        <li>
                                                            <i class="icon-eye4"></i>
                                                            <span><?php echo esc_html($cs_views_counter); ?> <?php esc_html_e( 'read','foodbakery' ); ?></span>
                                                        </li>
                                                    </ul>

                                                    <div class="post-title">
                                                        <h5><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo get_the_title(); ?>" ><?php echo foodbakery_get_post_excerpt( get_the_title(), 4 ); ?></a></h5>
                                                    </div>
                                                    <p><?php echo esc_html( foodbakery_get_excerpt( 12, '', '' ) ); ?></p>
                                                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more"><?php esc_html_e( 'Read Article','foodbakery' ); ?><i class="icon-chevron-with-circle-right"></i></a>
                                                </div>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                                <!-- Add Arrows -->
                            </div>
                            <div class="swiper-button-prev"><i class="icon-chevron-thin-left"></i></div>
                            <div class="swiper-button-next"><i class="icon-chevron-thin-right"></i></div>
                        </div>
                        </div>
                    </div>
                </div>
                <?php
            endif;
            wp_reset_postdata();
        }
    }

}
/**
 * End Function Related Blog Posts
 */
