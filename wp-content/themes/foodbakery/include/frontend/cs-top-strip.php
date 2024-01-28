<?php
/**
 * Header Functions
 *
 * @package WordPress
 * @subpackage foodbakery
 * @since Foodbakery 1.0
 */
if (!function_exists(' foodbakery_top_strip')) {

    /**
     * Header Top Strip Function
     */
    function foodbakery_top_strip() {
        global $foodbakery_var_options;
        $foodbakery_var_header_top_strip = isset($foodbakery_var_options['foodbakery_var_header_top_strip']) ? $foodbakery_var_options['foodbakery_var_header_top_strip'] : '';
        $foodbakery_var_header_top_address = isset($foodbakery_var_options['foodbakery_var_header_top_strip_address']) ? $foodbakery_var_options['foodbakery_var_header_top_strip_address'] : '';
        $foodbakery_var_header_top_email = isset($foodbakery_var_options['foodbakery_var_header_top_strip_email']) ? $foodbakery_var_options['foodbakery_var_header_top_strip_email'] : '';
        $foodbakery_var_header_top_phone = isset($foodbakery_var_options['foodbakery_var_header_top_strip_phone']) ? $foodbakery_var_options['foodbakery_var_header_top_strip_phone'] : '';
        ?>
        <?php if ('on' === $foodbakery_var_header_top_strip) { ?>
            <div class="top-bar">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php if (isset($foodbakery_var_options['foodbakery_var_header_top_strip_contact_us']) && 'on' === $foodbakery_var_options['foodbakery_var_header_top_strip_contact_us']) { ?>
                    <div class="contact-detail">
                        <ul>
                            <?php if($foodbakery_var_header_top_address!=''){ ?>
                            <li><?php echo esc_html( $foodbakery_var_header_top_address ); ?></li>
                            <?php } ?>
                            <?php if($foodbakery_var_header_top_email!=''){ ?>
                            <li><a href="#"><i class="icon-back2"></i><?php echo esc_html( $foodbakery_var_header_top_email ); ?></a></li>
                            <?php } ?>
                            <?php if($foodbakery_var_header_top_phone!=''){ ?>
                            <li><a href="#"><i class="icon-phone"></i><?php echo esc_html( $foodbakery_var_header_top_phone ); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php if (isset($foodbakery_var_options['foodbakery_var_header_top_strip_lang']) && 'on' === $foodbakery_var_options['foodbakery_var_header_top_strip_lang']) { ?>
                    <div class="user-option">
                        <div id="lang_sel">
                            <ul>
                                <li> <a href="#" class="lang_sel_sel icl-en"><i class="icon-earth-globe"></i> <?php esc_html_e( 'eng','foodbakery' ); ?></a>
                                    <ul>
                                        <li class="icl-zh-hant"> 
                                            <a href="#">
                                                <div class="img-holder"><img src="<?php echo esc_url(get_template_directory_uri('/assets/frontend/images/flag-france.png')); ?>" alt="flag-france"></div>
                                                <?php esc_html_e( 'France','foodbakery' ); ?>
                                            </a> 
                                        </li>
                                        <li class="icl-es"> 
                                            <a href="#">
                                                <div class="img-holder"><img src="<?php echo esc_url(get_template_directory_uri('/assets/frontend/images/flag-germany.png')); ?>" alt="flag-germany"></div>
                                                <?php esc_html_e( 'Germany','foodbakery' ); ?>
                                            </a> 
                                        </li>
                                        <li class="icl-ar"> 
                                            <a href="#">
                                                <div class="img-holder"><img src="<?php echo esc_url(get_template_directory_uri('/assets/frontend/images/flag-ar.png')); ?>" alt="flag-ar"></div>
                                                <?php esc_html_e( 'Italy','foodbakery' ); ?>
                                            </a> 
                                        </li>
                                        <li class="icl-ar"> 
                                            <a href="#">
                                                <div class="img-holder"><img src="<?php echo esc_url(get_template_directory_uri('/assets/frontend/images/flag-iceland.png')); ?>" alt="flag-iceland"></div>
                                                <?php esc_html_e( 'Iceland','foodbakery' ); ?>
                                            </a> 
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <ul class="user-currency">
                            <li>
                                <a href="#"><i class="icon-coins"></i><?php esc_html_e( 'USD','foodbakery' ); ?><?php esc_html_e( 'Read Article','foodbakery' ); ?></a>
                                <ul>
                                    <li><a href="#"><?php esc_html_e( 'UAE','foodbakery' ); ?></a></li>
                                    <li><a href="#"><?php esc_html_e( 'UAE','foodbakery' ); ?></a></li>
                                    <li><a href="#"><?php esc_html_e( 'UAE','foodbakery' ); ?></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                        <?php } ?>
                </div>

            </div>
            
            <?php
        }
    }

}
