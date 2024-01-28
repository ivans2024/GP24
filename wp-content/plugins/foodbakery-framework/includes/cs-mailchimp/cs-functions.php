<?php
if ( ! function_exists( 'foodbakery_mailchimp_list' ) ) {

    /**
     * Mailchimp list.
     *
     * @param string $apikey mailchimp shortcode api key.
     */
    function foodbakery_mailchimp_list( $apikey ) {
        global $foodbakery_var_options;
        $MailChimp = new MailChimp( $apikey );
        $mailchimp_list = $MailChimp->get('lists');
        $mailchimp_list['data'] = $mailchimp_list['lists'];
        return $mailchimp_list;
    }

    /**
     * Mailchimp list.
     */
    if ( ! function_exists( 'foodbakery_mailchimp' ) ) {

        add_action( 'wp_ajax_nopriv_foodbakery_mailchimp', 'foodbakery_mailchimp' );
        add_action( 'wp_ajax_foodbakery_mailchimp', 'foodbakery_mailchimp' );

        /**
         * Mailchimp list.
         */
        function foodbakery_mailchimp() {
            global $foodbakery_var_options, $counter, $foodbakery_var_frame_static_text;
            $msg = array();
            $foodbakery_var_subscribe_success = isset( $foodbakery_var_frame_static_text['foodbakery_var_subscribe_success'] ) ? $foodbakery_var_frame_static_text['foodbakery_var_subscribe_success'] : '';
            $foodbakery_var_api_set_msg = isset( $foodbakery_var_frame_static_text['foodbakery_var_api_set_msg'] ) ? $foodbakery_var_frame_static_text['foodbakery_var_api_set_msg'] : '';
            $mailchimp_key = '';
            if ( isset( $foodbakery_var_options['foodbakery_var_mailchimp_key'] ) ) {
                $mailchimp_key = $foodbakery_var_options['foodbakery_var_mailchimp_key'];
            }
            if ( isset( $foodbakery_var_options['foodbakery_var_mailchimp_list'] ) ) {
                $foodbakery_list_id = $foodbakery_var_options['foodbakery_var_mailchimp_list'];
            }
            $mc_email = foodbakery_get_input( 'mc_email', false, false );
            if ( isset( $mc_email ) && ! empty( $foodbakery_list_id ) && '' !== $mailchimp_key ) {
                if ( $mailchimp_key <> '' ) {
                    $MailChimp = new MailChimp( $mailchimp_key );
                }
                $email = $mc_email;
                $list_id = $foodbakery_list_id;
                $result = $MailChimp->post("lists/$list_id/members", [
                    'email_address' => $email,
                    'status'        => 'subscribed',
                ]);
                if ( '' !== $result ) {
                    if ( isset( $result['status'] ) && 'error' === $result['status'] ) {
                        $msg['type'] = 'error';
                        $msg['msg'] = foodbakery_allow_special_char( $result['error'] );
                    } else {
                        $msg['type'] = 'success';
                        $msg['msg'] = foodbakery_allow_special_char( $foodbakery_var_subscribe_success );
                    }
                }
            } else {
                $msg['type'] = 'error';
                $msg['msg'] = foodbakery_allow_special_char( $foodbakery_var_api_set_msg );
            }
            echo json_encode( $msg );
            die();
        }

    }
}

/**
 * Mailchimp frontend form.
 */
if ( ! function_exists( 'foodbakery_custom_mailchimp' ) ) {

    /**
     * Mailchimp frontend form.
     *
     * @param bolean $under_construction checking under construction.
     */
    function foodbakery_custom_mailchimp( $under_construction = '0' ) {

        global $foodbakery_var_options, $counter, $social_switch, $foodbakery_var_frame_static_text;
        $foodbakery_var_enter_valid = isset( $foodbakery_var_frame_static_text['foodbakery_var_enter_valid'] ) ? $foodbakery_var_frame_static_text['foodbakery_var_enter_valid'] : '';
        $counter ++;
        ?>

        <script>
            function foodbakery_mailchimp_submit(theme_url, counter, admin_url) {
                'use strict';
                $ = jQuery;
                $('#newsletter_error_div_' + counter).fadeOut();
                $('#newsletter_success_div_' + counter).fadeOut();
                $('#process_' + counter).show();
                $('#process_' + counter).html('<i class="icon-spinner8 fa-spin"></i>');
                $.ajax({
                    type: 'POST',
                    url: admin_url,
                    data: $('#mcform_' + counter).serialize() + '&action=foodbakery_mailchimp',
                    dataType: "json",
                    success: function (response) {
                        $('#mcform_' + counter).get(0).reset();
                        if (response.type === 'error') {
                            $('#process_' + counter).hide();
                            $('#newsletter_mess_error_' + counter).html(response.msg);
                            $('#newsletter_error_div_' + counter).fadeIn();
                        } else {
                            $('#process_' + counter).hide();
                            $('#newsletter_mess_success_' + counter).html(response.msg);
                            $('#newsletter_success_div_' + counter).fadeIn();
                        }
                        $('#newsletter_mess_' + counter).fadeIn(600);
                        $('#newsletter_mess_' + counter).html(response);
                        $('#process_' + counter).html('');
                    }
                });
            }
            function hide_div(div_hide) {
                jQuery('#' + div_hide).hide();
            }
        </script>
        <div id ="process_newsletter_<?php echo intval( $counter ); ?>" class="mailchimp-signup">
            <div id="process_<?php echo intval( $counter ); ?>" class="status status-message cs-spinner" style="display:none"></div>
            <?php if($under_construction == '1'){ ?>
            <form  action="javascript:foodbakery_mailchimp_submit('<?php echo get_template_directory_uri() ?>','<?php echo esc_js( $counter ); ?>','<?php echo admin_url( 'admin-ajax.php' ); ?>')" id="mcform_<?php echo intval( $counter ); ?>" method="post">
             <div class="news-letter-heading">
                    <h6><?php echo foodbakery_var_frame_text_srt( 'foodbakery_var_news_letter' ); ?></h6>
                </div>
                <div class="input-holder">
                    <input id="foodbakery_list_id<?php echo intval( $counter ); ?>" type="hidden" name="foodbakery_list_id" value="<?php
                    if ( isset( $foodbakery_var_options['foodbakery_var_mailchimp_list'] ) ) {
                        echo esc_attr( $foodbakery_var_options['foodbakery_var_mailchimp_list'] );
                    }
                    ?>" />
                    <input type="text" id="mc_email<?php echo intval( $counter ); ?>" class="txt-bar"  name="mc_email" placeholder=" <?php echo esc_html( $foodbakery_var_enter_valid ); ?>"   >
                    <input class="btn-submit bgcolor" id="btn_newsletter_<?php echo intval( $counter ); ?>" type="submit" value="Sign Up">
                </div>
            </form>
            <div id="newsletter_error_div_<?php echo intval( $counter ); ?>" style="display:none" class="alert alert-danger">
                    <button class="close" type="button" onclick="hide_div('newsletter_error_div_<?php echo intval( $counter ); ?>')" aria-hidden="true">×</button>
                    <p><i class="icon-warning4"></i>
                        <span id="newsletter_mess_error_<?php echo intval( $counter ); ?>"></span></p>
                </div> 
                <div id="newsletter_success_div_<?php echo intval( $counter ); ?>" style="display:none" class="alert alert-success">
                    <button class="close" type="button" onclick="hide_div('newsletter_success_div_<?php echo intval( $counter ); ?>')" aria-hidden="true">×</button>
                    <p><i class="icon-warning4"></i><span id="newsletter_mess_success_<?php echo intval( $counter ); ?>"></span></p>
                </div>
            <?php }else{ ?>
            <div class="fieldset">
                <form  action="javascript:foodbakery_mailchimp_submit('<?php echo get_template_directory_uri() ?>','<?php echo esc_js( $counter ); ?>','<?php echo admin_url( 'admin-ajax.php' ); ?>')" id="mcform_<?php echo intval( $counter ); ?>" method="post">
                    <?php
                    if ( $under_construction != '2' ) {
                        if ( $under_construction != '3' ) {
                            ?>
                            <div class="news-letter-heading">
                                <h6><?php echo foodbakery_var_frame_text_srt( 'foodbakery_var_maintenance_newsletter' ); ?></h6>
                            </div>
                            <?php
                        }
                    }
                    if ( $under_construction != '3' ) {
                        ?>
                        <div class="input-holder">
                        <?php } ?>
                        <input id="foodbakery_list_id<?php echo intval( $counter ); ?>" type="hidden" name="foodbakery_list_id" value="<?php
                        if ( isset( $foodbakery_var_options['foodbakery_var_mailchimp_list'] ) ) {
                            echo esc_attr( $foodbakery_var_options['foodbakery_var_mailchimp_list'] );
                        }
                        ?>" />
                        <div class="field-holder">
                            <label>
                                <i class=" icon-envelope3"></i>
                                <input type="text" id="mc_email<?php echo intval( $counter ); ?>" class="field-input"  name="mc_email" placeholder=" <?php echo esc_html( $foodbakery_var_enter_valid ); ?>"   >
                            </label>
                        </div>

                        <?php if ( $under_construction == '3' ) { ?>
                            <div class="field-holder btn-holder">
                                <input class="subscribe-btn bgcolor" id="btn_newsletter_<?php echo intval( $counter ); ?>" type="submit" value="Sign Up">
                            </div>
                        <?php } if ( $under_construction != '3' ) { ?>
                            <input class="btn-submit bgcolor" id="btn_newsletter_<?php echo intval( $counter ); ?>" type="submit" value="Sign Up">
                        <?php } if ( $under_construction != '3' ) { ?>
                        </div>
                    <?php } ?>

                </form>
                <div id="newsletter_error_div_<?php echo intval( $counter ); ?>" style="display:none" class="alert alert-danger">
                    <button class="close" type="button" onclick="hide_div('newsletter_error_div_<?php echo intval( $counter ); ?>')" aria-hidden="true">×</button>
                    <p><i class="icon-warning4"></i>
                        <span id="newsletter_mess_error_<?php echo intval( $counter ); ?>"></span></p>
                </div> 
                <div id="newsletter_success_div_<?php echo intval( $counter ); ?>" style="display:none" class="alert alert-success">
                    <button class="close" type="button" onclick="hide_div('newsletter_success_div_<?php echo intval( $counter ); ?>')" aria-hidden="true">×</button>
                    <p><i class="icon-warning4"></i><span id="newsletter_mess_success_<?php echo intval( $counter ); ?>"></span></p>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php
    }

}

if ( ! function_exists( 'foodbakery_var_social_network' ) ) {

    function foodbakery_var_social_network( $icon_type = '', $tooltip = '' ) {
        global $foodbakery_var_options;
        $tooltip_data = '';
        if ( $icon_type == 'large' ) {
            $icon = 'icon-2x';
        } else {

            $icon = '';
        }
        if ( isset( $tooltip ) && $tooltip <> '' ) {
            $tooltip_data = 'data-placement-tooltip="tooltip"';
        }
        if ( isset( $foodbakery_var_options['foodbakery_var_social_net_url'] ) and count( $foodbakery_var_options['foodbakery_var_social_net_url'] ) > 0 ) {
            $i = 0;
            $icon_color = array();
            $icon_color = $foodbakery_var_options['foodbakery_var_social_icon_color'];
            ?>
            <ul>
                <?php
                if ( is_array( $foodbakery_var_options['foodbakery_var_social_net_url'] ) ):
                    foreach ( $foodbakery_var_options['foodbakery_var_social_net_url'] as $val ) {

                        if ( $val != '' ) {
                            ?>      
                            <li>
                                <a style="background :<?php echo $icon_color[$i]; ?> "  href="<?php echo esc_url( $val ); ?>" data-original-title="<?php echo foodbakery_allow_special_char( $foodbakery_var_options['foodbakery_var_social_net_tooltip'][$i] ); ?>"  <?php echo balanceTags( $tooltip_data, false ); ?> >
                                    <?php if ( $foodbakery_var_options['foodbakery_var_social_net_awesome'][$i] <> '' && isset( $foodbakery_var_options['foodbakery_var_social_net_awesome'][$i] ) ) { ?>
                                        <i class="<?php echo esc_attr( $foodbakery_var_options['foodbakery_var_social_net_awesome'][$i] ); ?> <?php echo esc_attr( $icon ); ?>"></i>

                                    <?php } else { ?>
                                        <img title="<?php echo esc_attr( $foodbakery_var_options['foodbakery_var_social_net_tooltip'][$i] ); ?>" src="<?php echo esc_url( $foodbakery_var_options['foodbakery_var_social_icon_path_array'][$i] ); ?>" alt="<?php echo esc_attr( $foodbakery_var_options['foodbakery_var_social_net_tooltip'][$i] ); ?>" />
                                    <?php } ?>
                                </a>
                            </li>
                            <?php
                        }
                        $i ++;
                    }
                endif;
                ?>
            </ul>
            <?php
        }
    }

}
