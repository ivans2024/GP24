<?php
/*
 *
 * @Shortcode Name : Maintenance
 * @retrun
 *
 */



if ( ! function_exists( 'foodbakery_var_maintenance' ) ) {

    function foodbakery_var_maintenance( $atts, $content = "" ) {
        global $post, $wp_query, $foodbakery_var_options, $foodbakery_var_post_meta;

        update_option( 'foodbakery_underconstruction_redirecting', '0' ); // for undercostruction reset redirect.\

        $defaults = array(
            'foodbakery_var_column_size' => '',
            'foodbakery_var_column' => '1',
            'foodbakery_var_maintenance_text' => '',
            'foodbakery_var_maintenance_time_left' => '',
            'foodbakery_var_maintainance_logo_array' => '',
            'foodbakery_var_maintainance_image_array' => '',
            'foodbakery_page_view' => '',
            'foodbakery_var_lunch_date' => '',
        );
        extract( shortcode_atts( $defaults, $atts ) );
        $column_class = '';

        if ( isset( $foodbakery_var_column_size ) && $foodbakery_var_column_size != '' ) {
            if ( $foodbakery_var_column_size <> '' ) {
                if ( function_exists( 'foodbakery_var_custom_column_class' ) ) {
                    $column_class = foodbakery_var_custom_column_class( $foodbakery_var_column_size );
                }
            }
        }

        if ( isset( $column_class ) && $column_class <> '' ) {
            echo '<div class="' . esc_html( $column_class ) . '">';
        }
        $foodbakery_page_view = isset( $foodbakery_page_view ) ? $foodbakery_page_view : '2';
        $foodbakery_var_maintainance_image_array = isset( $foodbakery_var_maintainance_image_array ) ? $foodbakery_var_maintainance_image_array : '';
        $foodbakery_var_maintainance_logo_array = isset( $foodbakery_var_maintainance_logo_array ) ? $foodbakery_var_maintainance_logo_array : '';
        $foodbakery_var_maintenance_text = $content;
        $foodbakery_var_lunch_date = isset( $foodbakery_var_lunch_date ) ? $foodbakery_var_lunch_date : '';
        $foodbakery_var_maintenance_switch = isset( $foodbakery_var_options['foodbakery_var_maintenance_switch'] ) ? $foodbakery_var_options['foodbakery_var_maintenance_switch'] : '';
        $foodbakery_var_maintenance_logo = isset( $foodbakery_var_options['foodbakery_var_maintenance_logo_switch'] ) ? $foodbakery_var_options['foodbakery_var_maintenance_logo_switch'] : '';
        $foodbakery_var_maintenance_header_switch = isset( $foodbakery_var_options['foodbakery_var_maintenance_header_switch'] ) ? $foodbakery_var_options['foodbakery_var_maintenance_header_switch'] : '';
        $foodbakery_var_footer_switch = isset( $foodbakery_var_options['foodbakery_var_maintenance_footer_switch'] ) ? $foodbakery_var_options['foodbakery_var_maintenance_footer_switch'] : '';
        $foodbakery_var_maintenance_social_switch = isset( $foodbakery_var_options['foodbakery_var_maintenance_social_switch'] ) ? $foodbakery_var_options['foodbakery_var_maintenance_social_switch'] : '';
        $foodbakery_var_maintenance_newsletter_switch = isset( $foodbakery_var_options['foodbakery_var_maintenance_newsletter_switch'] ) ? $foodbakery_var_options['foodbakery_var_maintenance_newsletter_switch'] : '';
        $foodbakery_var_date = date_i18n( 'Y/m/d', strtotime( $foodbakery_var_lunch_date ) );
        $foodbakery_var_maintenance = '';
        ob_start();
        ?>
        <script>
            jQuery(document).ready(function ($) {
                var date = '<?php echo $foodbakery_var_date; ?>';
                if (jQuery('#getting-started').length != '') {
                    jQuery('#getting-started').countdown(date, function (event) {
                        jQuery(this).html(event.strftime('<div class="time-box"><h4 class="dd">%D</h4> <span class="label">days</span> </div><div class="time-box"><h4 class="hh">%H</h4><span class="label">hours</span></div><div class="time-box"><h4 class="mm">%M</h4> <span class="label">minutes</span></div><div class="time-box"><h4 class="ss">%S</h4> <span class="label">seconds</span></div> '));
                    });
                }
            });
        </script>
            <div id="cs-construction" class="page-section" style="background:#f8f8f8 url(<?php echo $foodbakery_var_maintainance_image_array; ?>)no-repeat; background-size:cover; height:50%; padding-top:260px;">
                <div class="container">
                    <div class="row">
                        <div class="cs-construction-holder">
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <div class="cs-construction">
                                    <div class="cs-logo">
                                        <?php if ( isset( $foodbakery_var_maintenance_logo ) && $foodbakery_var_maintenance_logo == 'on' ) { ?>
                                            <div class="cs-media">
                                                <figure>
                                                    <img src="<?php echo esc_url( $foodbakery_var_maintainance_logo_array ); ?>" alt="" />
                                                </figure>
                                            </div>
                                        <?php } ?>

                                        <?php if ( $foodbakery_var_maintenance_text <> '' ) { ?>
                                            <span><?php echo htmlspecialchars_decode( $foodbakery_var_maintenance_text ); ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="cs-const-counter">
                                        <div id="getting-started"></div>
                                    </div>
                                    <div class="cs-seprater"></div>
                                    <?php if ( $foodbakery_var_maintenance_newsletter_switch <> '' && $foodbakery_var_maintenance_newsletter_switch == "on" ) { ?>
                                        <div class="cs-news-letter">
                                            <div class="news-letter-form">
                                                <?php
                                                $under_construction = '1';
                                                foodbakery_custom_mailchimp( $under_construction );
                                                ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ( isset( $foodbakery_var_maintenance_social_switch ) && $foodbakery_var_maintenance_social_switch == 'on' ) { ?>
                                        <div class="cs-social-media">
                                            <?php echo foodbakery_social_network(1, '', '', 'social-media', false); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
        <?php
        if ( isset( $column_class ) && $column_class <> '' ) {
            echo '</div>';
        }
        ?>
        <?php
        $foodbakery_var_maintenance = ob_get_clean();
        return $foodbakery_var_maintenance;
    }

    if ( function_exists( 'foodbakery_var_short_code' ) )
        foodbakery_var_short_code( 'maintenance', 'foodbakery_var_maintenance' );
}