<?php
/**
 * @Spacer html form for page builder
 */
if ( ! function_exists( 'foodbakery_sitemap' ) ) {

    function foodbakery_sitemap( $atts, $content = "" ) {
        global $foodbakery_border, $foodbakery_var_plugin_options, $foodbakery_var_static_text;
        $strings = new foodbakery_theme_all_strings;
        $strings->foodbakery_theme_option_strings();
        $foodbakery_search_result_page = isset( $foodbakery_var_plugin_options['foodbakery_search_result_page'] ) ? $foodbakery_var_plugin_options['foodbakery_search_result_page'] : '';

        $defaults = array( 
            'foodbakery_sitemap_section_title' => '',
            'foodbakery_var_sitemap_align' => '',
            );
        extract( shortcode_atts( $defaults, $atts ) );

        $foodbakery_sitemap_section_title = $foodbakery_sitemap_section_title ? $foodbakery_sitemap_section_title : '';
        $foodbakery_var_sitemap_align = isset($foodbakery_var_sitemap_align) ? $foodbakery_var_sitemap_align : '';
        ob_start();
        $page_element_size  = isset( $atts['sitemap_element_size'] )? $atts['sitemap_element_size'] : 100;
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
            echo   '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
        }
        ?>
        <div class="row">
            <div class="sitemap-links">	
                <?php if ( isset( $foodbakery_sitemap_section_title ) && $foodbakery_sitemap_section_title != '' ) { ?>
                    <div class="element-title col-md-12 <?php echo esc_html($foodbakery_var_sitemap_align); ?>">
                        <h2><?php echo esc_html( $foodbakery_sitemap_section_title ); ?></h2>
                    </div> 
                <?php } ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="site-maps-links">
                        <h3><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_pages' ) ); ?></h3>
                        <ul>
                            <?php
                            $args = array(
                                'posts_per_page' => "-1",
                                'post_type' => 'page',
                                'order' => 'ASC',
                                'post_status' => 'publish',
                            );
                            $query = new WP_Query( $args );
                            $post_count = $query->post_count;
                            if ( $query->have_posts() ) {
                                while ( $query->have_posts() ) : $query->the_post();
                                    ?>
                                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                    <?php
                                endwhile;
                            }
                            wp_reset_postdata();
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="site-maps-links">
                        <h4><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_posts' ) ); ?></h4>
                        <ul>
                            <?php
                            $args = array(
                                'posts_per_page' => "-1",
                                'post_type' => 'post',
                                'order' => 'ASC',
                                'post_status' => 'publish',
                            );
                            $query = new WP_Query( $args );
                            $post_count = $query->post_count;
                            if ( $query->have_posts() ) {
                                while ( $query->have_posts() ) : $query->the_post();
                                    ?>
                                    <li><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 3, '...' ); ?></a></li>
                                    <?php
                                endwhile;
                            }
                            wp_reset_postdata();
                            ?>
                        </ul>
                    </div>	
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="site-maps-links">
                        <h4><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_categories' ) ); ?></h4>
                        <ul>
                            <?php
                            $args = array(
                                'show_option_all' => '',
                                'order' => 'ASC',
                                'post_type' => 'post',
                                'order' => 'ASC',
                                'style' => 'list',
                                'title_li' => '',
                                'taxonomy' => 'category'
                            );

                            wp_list_categories( $args );
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="site-maps-links">
                        <h4><?php echo esc_html( foodbakery_var_theme_text_srt( 'foodbakery_var_tag' ) ); ?></h4>
                        <ul>
                            <?php
                            $tags = get_tags( array( 'order' => 'ASC', 'post_type' => 'post', 'order' => 'DESC' ) );
                            foreach ( (array) $tags as $tag ) {
                                ?>
                                <li> <?php echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" rel="tag">' . $tag->name . ' (' . $tag->count . ') </a>'; ?></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (function_exists('foodbakery_var_page_builder_element_sizes')) {
           echo   '</div>';
        }
        $foodbakery_sitemap = ob_get_clean();
        return do_shortcode( $foodbakery_sitemap );
    }

    if ( function_exists( 'foodbakery_var_short_code' ) ) {
        foodbakery_var_short_code( 'foodbakery_sitemap', 'foodbakery_sitemap' );
    }
}