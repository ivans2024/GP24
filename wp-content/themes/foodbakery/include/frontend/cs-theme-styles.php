<?php
/*
 * Theme style 
 */
if (!function_exists('foodbakery_var_custom_style_theme_options')) {
    $foodbakery_var_custom_themeoption_str = '';

    /**
     * @Start Function for Theme Option Backend Settings and Classes
     *
     */
    function foodbakery_var_custom_style_theme_options() {
	global $foodbakery_var_custom_themeoption_str;
	$foodbakery_var_custom_footer_background = '';
	$foodbakery_var_options = get_option('foodbakery_var_options');
	ob_start();

	$foodbakery_var_theme_color = isset($foodbakery_var_options['foodbakery_var_theme_color']) ? $foodbakery_var_options['foodbakery_var_theme_color'] : '';
	$foodbakery_var_bg_color = (isset($foodbakery_var_options['foodbakery_var_bg_color']) && $foodbakery_var_options['foodbakery_var_bg_color'] != '' ) ? $foodbakery_var_options['foodbakery_var_bg_color'] : '';
	$foodbakery_var_text_color = (isset($foodbakery_var_options['foodbakery_var_text_color']) && $foodbakery_var_options['foodbakery_var_text_color'] != '' ) ? $foodbakery_var_options['foodbakery_var_text_color'] : '';
	?>
	/*!
	*Theme Colors Classes*/

	.text-color, .listing .post-title:hover h5 a, .pagination > li > a:hover, .pagination > li > span:hover, .pagination > li > a:focus, .pagination > li > span:focus,
        .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus, .pagination > .active > span > a,
    .order-sort-results ul li:hover a, .tabs-holder .nav li a:hover, .nav li  a:focus, .tabs-holder .nav-tabs li.active a, .nav-tabs li.active a:hover, .nav-tabs li.active a:focus,
    .sub-header .breadcrumbs ul li:hover a, .sub-header .breadcrumbs ul li:hover:before, .widget-popular-cities ul li a:hover, .widget-popular-cuisines ul li a:hover, .widget-menu ul li a:hover, .widget-connect ul li p a:hover,
    .news-letter .news-letter-form form .btn-holder input[type="submit"]:hover, .widget-recent-blog-post li:hover .post-title h6 a, .widget-categories ul li a:hover, .widget-categories ul li a:hover:before, .widget-cloud ul li a:hover,
    .panel-group .panel-heading a , .categories-menu li a:hover, .user-order .error-message, .delivery-timing > ul > li > a span, .delivery-timing ul li ul.delivery-dropdown li a:hover, .blog-detail .blockquote-hloder::before, .blog-detail .tags-list li a:hover,
    .blog-detail .swiper-button-prev:hover, .blog-detail .swiper-button-next:hover, .blog .post-title h3 a:hover, .blog .post-title h4 a:hover, .blog-large .author-info p a, .delivery-list .button a:hover, .user-nav-list ul li a:hover, .user-nav-list ul li a:hover i,
    .company-holder .swiper-button-next:hover i, .company-holder .swiper-button-prev:hover i, .user-holder .add-btn a, .user-holder .order-list .author-info .text-holder span.price, .user-holder .order-list .order-btn a, .main-header.transparent .main-location ul li ul li a:hover,
    .main-header.transparent .main-location ul li ul li .has-child li a:hover, .order-sort-results ul li.active a, .listing-filter .expand, #footer .footer-widget .widget a:hover, .order-sort-results ul li.active a, ul.dashboard-nav li a:hover, .upload-file button[type='button'], .user-dashboard-menu > ul > li > ul li.user-add-restaurant > a, .widget_tag_cloud .tagcloud a:hover, .page-not-found .cs-text span.cs-error, .widget.widget_nav_menu ul li a:hover, .widget.widget-categories li a:hover, .widget.widget_categories li a:hover, .widget.widget_pages ul li a:hover, .widget.widget_archive li a:hover,
    .widget.widget_meta li a:hover, .widget.widget_nav_menu ul li a:hover:before, .widget.widget-categories li a:hover:before, .widget.widget-archives ul li a:hover,
    .widget.widget_categories li:hover:before, .widget.widget_pages ul li:hover:before, .widget.widget_archive li:hover:before,.site-maps-links ul li:hover a, .widget.widget-archives ul li:hover a:before, .widget.twitter-post li p a, .widget.widget_recent_comments li a:hover, .widget.widget_rss li .rsswidget:hover, .cs-construction .time-box h4, .listing .list-option .viewmenu-btn, .restaurant-menu-nav.nav-tabs > li.active a, .user-nav-list ul li.active a, .user-nav-list ul li.active i, .categories-order li li:after, .listing.fancy-simple .delivery-potions i, .listing.grid-listing .min-order, .listing.grid-listing .listing-footer .text-holder p.deliver-time span, .listing.grid-listing .listing-footer .text-holder p.pickup-time span, .transparent-header .main-header .login-option a.login-popup, .copy-right p a, .blog-medium .read-more i, .related-post .read-more, .user-suggest-list > .element-title > h5 + span em, .listing.grid-listing h4 a:hover, .listing.grid-listing .listing-footer a.ordernow-btn:hover, .transparent-header .main-header .login-option a.get-start-btn:hover, .categories-menu li.active a,
    .company-holder.fancy .rating-star .rating-box:before, .company-holder.fancy .fancy-button-prev:hover i, .company-holder.fancy .fancy-button-next:hover i, .company-rating .list-option .shortlist-btn i, .wp-foodbakery .listing.grid-slider:hover .restaurant-status, #footer.footer-style-4 .widget-connect ul li span i,
.wp-foodbakery .listing.grid-slider .rating-star .rating-box:before, .location-holder.modern a.more-btn, .grid-slider .swiper-button-prev:hover i, .grid-slider .swiper-button-next:hover i,
.company-holder.simple .company-logo .text-holder .post-title h6 a:hover
	{
	<?php if (isset($foodbakery_var_theme_color) || $foodbakery_var_theme_color != '') { ?>
	    color:<?php echo foodbakery_allow_special_char($foodbakery_var_theme_color); ?> !important;
	<?php } ?>
	}
	/*!
	* Theme Background Color */
    .bgcolor, .chosen-container .chosen-results li.highlighted, .order-sort-results ul li:hover:before, .bootstrap-datetimepicker-widget .btn-primary,
    .booking-info-sec .contact-info .field-holder .submit-btn input[type="submit"], .user-order input[type="submit"], .main-post .column-text form .field-holder .field-btn,
	.main-search.fancy.bg-holder, .load-more-btn:hover, .order-sort-results ul li.active:before, .order-sort-results ul li.active:before, .listing.simple.slide-loader:before, .main-header .login-option a.get-start-btn, .field-holder .btn-submit:hover, .no-results .suggestions ul li:before, .widget.widget_search form .btn-default, .textwidget span.button-med a, .cs-seprater:after, .slicknav_btn, .user-order .select-option input[type="radio"]:checked + label:after, #add_payment_method #payment ul.payment_methods li.wc_payment_method input[type="radio"]:checked + label:after, .woocommerce-checkout #payment ul.payment_methods li.wc_payment_method input[type="radio"]:checked + label:after, .woocommerce form .woocommerce-checkout-payment .form-row input.button, .pricetable-holder .cs-price, .foodbakery-button-loader, .invite-member .btn-send, .menu-order-detail .btn-print, .radio-holder .input-radio label:after, .footer-style-1 .social-media li a:hover, #footer.footer-style-1 .widget-title h5:after, .pricetable-holder .foodbakery-subscribe-pkg-btn, .pricetable-holder .foodbakery-subscribe-pkg, .login-form .input-filed input[type="submit"], .login-form .input-filed input[type="button"], .user-dashboard .foodbakery_loader, .user-order input[type="submit"], .user-order .menu-order-confirm, .modal-dialog .menu-selection-container button, .modal-dialog .menu-selection-container .reset-menu-fields, .suggestion-search .btn-default, .main-search.classic .field-holder input[type="submit"],
	.wp-foodbakery .listing.grid-slider .list-post:hover:before, #footer.footer-style-4 .social-media > li > a:hover, #header.transparent-header.court.pinned .main-header,
    .main-location > ul > li.choose-location ul ul::-webkit-scrollbar-thumb, .icon-boxes.fancy:hover .img-holder figure i, .tab-single-page .tabs-holder .deal-tabs-modal>.nav-tabs li.active a, 
.tab-single-page .tabs-holder .deal-tabs-modal>.nav-tabs li.active a:hover, 
.tab-single-page .tabs-holder .deal-tabs-modal>.nav-tabs li.active a:focus, 
.tab-single-page .tabs-holder .deal-tabs-modal>.nav-tabs li a:hover, .tab-single-page .categories-menu a:hover, 
.tab-single-page .categories-menu li.active a, 
.tab-single-page .categories-menu li.active a i, .widget_search .wp-block-search__button
	{
	<?php if (isset($foodbakery_var_theme_color) || $foodbakery_var_theme_color != '') { ?>
	    background-color:<?php echo foodbakery_allow_special_char($foodbakery_var_theme_color); ?> !important;
	<?php } ?>
	}
	/*Fancy Scroll Bar Styleing hack */
	.max-location-height::-webkit-scrollbar-thumb, .slicknav_nav::-webkit-scrollbar-thumb
	{
	<?php if (isset($foodbakery_var_theme_color) || $foodbakery_var_theme_color != '') { ?>
	    background-color:<?php echo foodbakery_allow_special_char($foodbakery_var_theme_color); ?> !important;
	<?php } ?>
	}

	/* Theme Border Color */
	.br-color, .listing .list-option .viewmenu-btn, .widget-text .content-btn, .load-more-btn, .blog-detail .blockquote-hloder, .blog-large .read-more, .delivery-list .button a:hover, .upload-file button[type='button'], .widget_tag_cloud .tagcloud a:hover, .icon-boxes.modern figure:before, .icon-boxes.modern figure, .listing.grid-listing .listing-footer a.ordernow-btn:hover, .transparent-header .main-header .login-option a.get-start-btn:hover, #footer.footer-style-4 .social-media > li > a:hover, .location-holder.modern a.more-btn
	{
	<?php if (isset($foodbakery_var_theme_color) || $foodbakery_var_theme_color != '') { ?>
	    border-color:<?php echo foodbakery_allow_special_char($foodbakery_var_theme_color); ?> !important;
	<?php } ?>
	}
	/* Theme Border Top Color */
	.restaurant-menu-nav.nav-tabs > li a:hover, .restaurant-menu-nav.nav-tabs > li a:focus, .restaurant-menu-nav.nav-tabs > li.active a
	{
	<?php if (isset($foodbakery_var_theme_color) || $foodbakery_var_theme_color != '') { ?>
	    border-top-color:<?php echo foodbakery_allow_special_char($foodbakery_var_theme_color); ?> !important;
	<?php } ?>
	}

	<?php
	$foodbakery_var_sitcky_header_switch = isset($foodbakery_var_options['foodbakery_var_sitcky_header_switch']) ? $foodbakery_var_options['foodbakery_var_sitcky_header_switch'] : '';
	$foodbakery_var_layout = isset($foodbakery_var_options['foodbakery_var_layout']) ? $foodbakery_var_options['foodbakery_var_layout'] : '';
	$foodbakery_var_custom_bgimage = isset($foodbakery_var_options['foodbakery_var_custom_bgimage']) ? $foodbakery_var_options['foodbakery_var_custom_bgimage'] : '';
	$foodbakery_var_bg_image = isset($foodbakery_var_options['foodbakery_var_bg_image']) ? $foodbakery_var_options['foodbakery_var_bg_image'] : '';
	$foodbakery_var_pattern_image = isset($foodbakery_var_options['foodbakery_var_pattern_image']) ? $foodbakery_var_options['foodbakery_var_pattern_image'] : '';
	$foodbakery_var_background_position = isset($foodbakery_var_options['foodbakery_var_bgimage_position']) ? $foodbakery_var_options['foodbakery_var_bgimage_position'] : '';
	if ($foodbakery_var_layout != 'full_width') {
	    $foodbakery_repeat_options = false;
	    if ($foodbakery_var_custom_bgimage != "") {
		$foodbakery_repeat_options = true;
		$foodbakery_var_background_image = $foodbakery_var_custom_bgimage;
	    } else if ($foodbakery_var_bg_image != "" && $foodbakery_var_bg_image != 'bg0') {
		$foodbakery_var_background_image = trailingslashit(get_template_directory_uri()) . "assets/backend/images/background/" . $foodbakery_var_bg_image . ".png";
	    } else if ($foodbakery_var_pattern_image != "" && $foodbakery_var_pattern_image != 'pattern0') {
		$foodbakery_var_background_image = trailingslashit(get_template_directory_uri()) . "assets/backend/images/patterns/" . $foodbakery_var_pattern_image . ".png";
	    }

	    if (isset($foodbakery_var_background_image) && $foodbakery_var_background_image <> "") {
		if ($foodbakery_repeat_options == true) {
		    $wrppaer_style = 'background:url(' . $foodbakery_var_background_image . ') ' . $foodbakery_var_background_position . ' ' . $foodbakery_var_bg_color . ' !important;';
		} else {
		    $wrppaer_style = 'background:url(' . $foodbakery_var_background_image . ') repeat ' . $foodbakery_var_bg_color . ' !important;';
		}
	    } else if ($foodbakery_var_bg_color != '') {
		$wrppaer_style = 'background:' . $foodbakery_var_bg_color . ' !important;';
	    }
	} else if ($foodbakery_var_custom_bgimage != '') {
	    $wrppaer_style = 'background:url(' . $foodbakery_var_custom_bgimage . ') ' . $foodbakery_var_background_position . ' ' . $foodbakery_var_bg_color . ' !important;';
	} else if ($foodbakery_var_bg_color != '') {
	    $wrppaer_style = 'background:' . $foodbakery_var_bg_color . ' !important;';
	}

	if (isset($wrppaer_style) && $wrppaer_style != '') {
	    ?>
	    body{
	    <?php echo foodbakery_allow_special_char($wrppaer_style) ?>
	    }
	    <?php
	}

	///// Start Extra CSS
	if (isset($foodbakery_var_sitcky_header_switch) && $foodbakery_var_sitcky_header_switch == 'on') {
	    ?>
	    .cs-main-nav {
	    position: fixed !important;

	    z-index: 99 !important;
	    }
	    <?php
	} else {
	    ?>
	    .cs-main-nav {

	    position: relative !important;

	    }
	    <?php
	}
	///// END Extra CSS
	/**
	 * @Set Header color Css
	 *
	 *
	 */
	$foodbakery_var_top_strip_color = (isset($foodbakery_var_options['foodbakery_var_top_strip_color'])) ? $foodbakery_var_options['foodbakery_var_top_strip_color'] : '';
	$foodbakery_var_top_strip_bgcolor = (isset($foodbakery_var_options['foodbakery_var_top_strip_bgcolor'])) ? $foodbakery_var_options['foodbakery_var_top_strip_bgcolor'] : '';
	$foodbakery_var_header_bgcolor = (isset($foodbakery_var_options['foodbakery_var_header_bgcolor']) and $foodbakery_var_options['foodbakery_var_header_bgcolor'] <> '') ? $foodbakery_var_options['foodbakery_var_header_bgcolor'] : '';
	$foodbakery_var_menu_color = (isset($foodbakery_var_options['foodbakery_var_menu_color']) and $foodbakery_var_options['foodbakery_var_menu_color'] <> '') ? $foodbakery_var_options['foodbakery_var_menu_color'] : '';
	$foodbakery_var_menu_active_color = (isset($foodbakery_var_options['foodbakery_var_menu_active_color']) and $foodbakery_var_options['foodbakery_var_menu_active_color'] <> '') ? $foodbakery_var_options['foodbakery_var_menu_active_color'] : '';
	$foodbakery_var_menu_hover_bg_color = (isset($foodbakery_var_options['foodbakery_var_menu_hover_bg_color']) and $foodbakery_var_options['foodbakery_var_menu_hover_bg_color'] <> '') ? $foodbakery_var_options['foodbakery_var_menu_hover_bg_color'] : '';
	$foodbakery_var_submenu_2nd_level_bgcolor = (isset($foodbakery_var_options['foodbakery_var_submenu_2nd_level_bgcolor']) and $foodbakery_var_options['foodbakery_var_submenu_2nd_level_bgcolor'] <> '') ? $foodbakery_var_options['foodbakery_var_submenu_2nd_level_bgcolor'] : '';



	$foodbakery_var_modern_menu_color = (isset($foodbakery_var_options['foodbakery_var_modern_menu_color']) and $foodbakery_var_options['foodbakery_var_modern_menu_color'] <> '') ? $foodbakery_var_options['foodbakery_var_modern_menu_color'] : '';
	$foodbakery_var_modern_menu_active_color = (isset($foodbakery_var_options['foodbakery_var_modern_menu_active_color']) and $foodbakery_var_options['foodbakery_var_modern_menu_active_color'] <> '') ? $foodbakery_var_options['foodbakery_var_modern_menu_active_color'] : '';
	$foodbakery_var_submenu_bgcolor = (isset($foodbakery_var_options['foodbakery_var_submenu_bgcolor']) and $foodbakery_var_options['foodbakery_var_submenu_bgcolor'] <> '' ) ? $foodbakery_var_options['foodbakery_var_submenu_bgcolor'] : '';
	$foodbakery_var_submenu_color = (isset($foodbakery_var_options['foodbakery_var_submenu_color']) and $foodbakery_var_options['foodbakery_var_submenu_color'] <> '') ? $foodbakery_var_options['foodbakery_var_submenu_color'] : '';
	$foodbakery_var_submenu_2nd_level_color = (isset($foodbakery_var_options['foodbakery_var_submenu_2nd_level_color']) and $foodbakery_var_options['foodbakery_var_submenu_2nd_level_color'] <> '') ? $foodbakery_var_options['foodbakery_var_submenu_2nd_level_color'] : '';
	$foodbakery_var_menu_heading_color = (isset($foodbakery_var_options['foodbakery_var_menu_heading_color']) and $foodbakery_var_options['foodbakery_var_menu_heading_color'] <> '') ? $foodbakery_var_options['foodbakery_var_menu_heading_color'] : '';
	$foodbakery_var_submenu_hover_color = (isset($foodbakery_var_options['foodbakery_var_submenu_hover_color']) and $foodbakery_var_options['foodbakery_var_submenu_hover_color'] <> '') ? $foodbakery_var_options['foodbakery_var_submenu_hover_color'] : '';
	$foodbakery_var_topstrip_bgcolor = (isset($foodbakery_var_options['foodbakery_var_topstrip_bgcolor']) and $foodbakery_var_options['foodbakery_var_topstrip_bgcolor'] <> '') ? $foodbakery_var_options['foodbakery_var_topstrip_bgcolor'] : '';
	$foodbakery_var_topstrip_text_color = (isset($foodbakery_var_options['foodbakery_var_topstrip_text_color']) and $foodbakery_var_options['foodbakery_var_topstrip_text_color'] <> '') ? $foodbakery_var_options['foodbakery_var_topstrip_text_color'] : '';
	$foodbakery_var_topstrip_link_color = (isset($foodbakery_var_options['foodbakery_var_topstrip_link_color']) and $foodbakery_var_options['foodbakery_var_topstrip_link_color'] <> '') ? $foodbakery_var_options['foodbakery_var_topstrip_link_color'] : '';
	$foodbakery_var_menu_activ_bg = (isset($foodbakery_var_options['foodbakery_var_theme_color'])) ? $foodbakery_var_options['foodbakery_var_theme_color'] : '';
	$foodbakery_var_page_title_color = (isset($foodbakery_var_options['foodbakery_var_page_title_color'])) ? $foodbakery_var_options['foodbakery_var_page_title_color'] : '';

	/**
	 * @Logo Margins
	 *
	 */
	$foodbakery_var_logo_margint = (isset($foodbakery_var_options['foodbakery_var_logo_margint']) and $foodbakery_var_options['foodbakery_var_logo_margint'] <> '') ? $foodbakery_var_options['foodbakery_var_logo_margint'] : '0';
	$foodbakery_var_logo_marginb = (isset($foodbakery_var_options['foodbakery_var_logo_marginb']) and $foodbakery_var_options['foodbakery_var_logo_marginb'] <> '') ? $foodbakery_var_options['foodbakery_var_logo_marginb'] : '0';

	$foodbakery_var_logo_marginr = (isset($foodbakery_var_options['foodbakery_var_logo_marginr']) and $foodbakery_var_options['foodbakery_var_logo_marginr'] <> '') ? $foodbakery_var_options['foodbakery_var_logo_marginr'] : '0';
	$foodbakery_var_logo_marginl = (isset($foodbakery_var_options['foodbakery_var_logo_marginl']) and $foodbakery_var_options['foodbakery_var_logo_marginl'] <> '') ? $foodbakery_var_options['foodbakery_var_logo_marginl'] : '0';

	/**
	 * @Font Family
	 *
	 */
	$foodbakery_var_content_font = (isset($foodbakery_var_options['foodbakery_var_content_font'])) ? $foodbakery_var_options['foodbakery_var_content_font'] : '';
	$foodbakery_var_content_font_att = (isset($foodbakery_var_options['foodbakery_var_content_font_att'])) ? $foodbakery_var_options['foodbakery_var_content_font_att'] : '';

	$foodbakery_var_mainmenu_font = (isset($foodbakery_var_options['foodbakery_var_mainmenu_font'])) ? $foodbakery_var_options['foodbakery_var_mainmenu_font'] : '';
	$foodbakery_var_mainmenu_font_att = (isset($foodbakery_var_options['foodbakery_var_mainmenu_font_att'])) ? $foodbakery_var_options['foodbakery_var_mainmenu_font_att'] : '';

	$foodbakery_var_heading1_font = (isset($foodbakery_var_options['foodbakery_var_heading1_font'])) ? $foodbakery_var_options['foodbakery_var_heading1_font'] : '';
	$foodbakery_var_heading1_font_att = (isset($foodbakery_var_options['foodbakery_var_heading1_font_att'])) ? $foodbakery_var_options['foodbakery_var_heading1_font_att'] : '';

	$foodbakery_var_heading2_font = (isset($foodbakery_var_options['foodbakery_var_heading2_font'])) ? $foodbakery_var_options['foodbakery_var_heading2_font'] : '';
	$foodbakery_var_heading2_font_att = (isset($foodbakery_var_options['foodbakery_var_heading2_font_att'])) ? $foodbakery_var_options['foodbakery_var_heading2_font_att'] : '';

	$foodbakery_var_heading3_font = (isset($foodbakery_var_options['foodbakery_var_heading3_font'])) ? $foodbakery_var_options['foodbakery_var_heading3_font'] : '';
	$foodbakery_var_heading3_font_att = (isset($foodbakery_var_options['foodbakery_var_heading3_font_att'])) ? $foodbakery_var_options['foodbakery_var_heading3_font_att'] : '';

	$foodbakery_var_heading4_font = (isset($foodbakery_var_options['foodbakery_var_heading4_font'])) ? $foodbakery_var_options['foodbakery_var_heading4_font'] : '';
	$foodbakery_var_heading4_font_att = (isset($foodbakery_var_options['foodbakery_var_heading4_font_att'])) ? $foodbakery_var_options['foodbakery_var_heading4_font_att'] : '';

	$foodbakery_var_heading5_font = (isset($foodbakery_var_options['foodbakery_var_heading5_font'])) ? $foodbakery_var_options['foodbakery_var_heading5_font'] : '';
	$foodbakery_var_heading5_font_att = (isset($foodbakery_var_options['foodbakery_var_heading5_font_att'])) ? $foodbakery_var_options['foodbakery_var_heading5_font_att'] : '';

	$foodbakery_var_heading6_font = (isset($foodbakery_var_options['foodbakery_var_heading6_font'])) ? $foodbakery_var_options['foodbakery_var_heading6_font'] : '';
	$foodbakery_var_heading6_font_att = (isset($foodbakery_var_options['foodbakery_var_heading6_font_att'])) ? $foodbakery_var_options['foodbakery_var_heading6_font_att'] : '';

	$foodbakery_var_section_title_font = (isset($foodbakery_var_options['foodbakery_var_section_title_font'])) ? $foodbakery_var_options['foodbakery_var_section_title_font'] : '';
	$foodbakery_var_section_title_font_att = (isset($foodbakery_var_options['foodbakery_var_section_title_font_att'])) ? $foodbakery_var_options['foodbakery_var_section_title_font_att'] : '';

	$foodbakery_var_page_title_font = (isset($foodbakery_var_options['foodbakery_var_page_title_font'])) ? $foodbakery_var_options['foodbakery_var_page_title_font'] : '';
	$foodbakery_var_page_title_font_att = (isset($foodbakery_var_options['foodbakery_var_page_title_font_att'])) ? $foodbakery_var_options['foodbakery_var_page_title_font_att'] : '';

	$foodbakery_var_post_title_font = (isset($foodbakery_var_options['foodbakery_var_post_title_font'])) ? $foodbakery_var_options['foodbakery_var_post_title_font'] : '';
	$foodbakery_var_post_title_font_att = (isset($foodbakery_var_options['foodbakery_var_post_title_font_att'])) ? $foodbakery_var_options['foodbakery_var_post_title_font_att'] : '';

	$foodbakery_var_widget_heading_font = (isset($foodbakery_var_options['foodbakery_var_widget_heading_font'])) ? $foodbakery_var_options['foodbakery_var_widget_heading_font'] : '';
	$foodbakery_var_widget_heading_font_att = (isset($foodbakery_var_options['foodbakery_var_widget_heading_font_att'])) ? $foodbakery_var_options['foodbakery_var_widget_heading_font_att'] : '';

	$foodbakery_var_ft_widget_heading_font = (isset($foodbakery_var_options['foodbakery_var_ft_widget_heading_font'])) ? $foodbakery_var_options['foodbakery_var_ft_widget_heading_font'] : '';
	$foodbakery_var_ft_widget_heading_font_att = (isset($foodbakery_var_options['foodbakery_var_ft_widget_heading_font_att'])) ? $foodbakery_var_options['foodbakery_var_ft_widget_heading_font_att'] : '';

	/**
	 * @Setting Content Fonts
	 *
	 */
	$foodbakery_var_content_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $foodbakery_var_content_font_att);

	$foodbakery_var_content_font_atts = foodbakery_var_get_font_att_array($foodbakery_var_content_fonts);

	/**
	 * @Setting Main Menu Fonts
	 *
	 */
	$foodbakery_var_mainmenu_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $foodbakery_var_mainmenu_font_att);

	$foodbakery_var_mainmenu_font_atts = foodbakery_var_get_font_att_array($foodbakery_var_mainmenu_fonts);

	/**
	 * @Setting Heading Fonts
	 *
	 */
	$foodbakery_var_heading1_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $foodbakery_var_heading1_font_att);
	$foodbakery_var_heading1_font_atts = foodbakery_var_get_font_att_array($foodbakery_var_heading1_fonts);

	$foodbakery_var_heading2_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $foodbakery_var_heading2_font_att);
	$foodbakery_var_heading2_font_atts = foodbakery_var_get_font_att_array($foodbakery_var_heading2_fonts);

	$foodbakery_var_heading3_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $foodbakery_var_heading3_font_att);
	$foodbakery_var_heading3_font_atts = foodbakery_var_get_font_att_array($foodbakery_var_heading3_fonts);

	$foodbakery_var_heading4_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $foodbakery_var_heading4_font_att);
	$foodbakery_var_heading4_font_atts = foodbakery_var_get_font_att_array($foodbakery_var_heading4_fonts);

	$foodbakery_var_heading5_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $foodbakery_var_heading5_font_att);
	$foodbakery_var_heading5_font_atts = foodbakery_var_get_font_att_array($foodbakery_var_heading5_fonts);

	$foodbakery_var_heading6_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $foodbakery_var_heading6_font_att);
	$foodbakery_var_heading6_font_atts = foodbakery_var_get_font_att_array($foodbakery_var_heading6_fonts);

	/**
	 * @Section Title Fonts
	 *
	 */
	$foodbakery_var_section_title_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $foodbakery_var_section_title_font_att);
	$foodbakery_var_section_title_font_atts = foodbakery_var_get_font_att_array($foodbakery_var_section_title_fonts);

	/**
	 * @Page Title Heading Fonts
	 *
	 */
	$foodbakery_var_page_title_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $foodbakery_var_page_title_font_att);
	$foodbakery_var_page_title_font_atts = foodbakery_var_get_font_att_array($foodbakery_var_page_title_fonts);

	/**
	 * @Post Title Heading Fonts
	 *
	 */
	$foodbakery_var_post_title_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $foodbakery_var_post_title_font_att);
	$foodbakery_var_post_title_font_atts = foodbakery_var_get_font_att_array($foodbakery_var_post_title_fonts);

	/**
	 * @Setting Widget Heading Fonts
	 *
	 */
	$foodbakery_var_widget_heading_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $foodbakery_var_widget_heading_font_att);
	$foodbakery_var_widget_heading_font_atts = foodbakery_var_get_font_att_array($foodbakery_var_widget_heading_fonts);


	/**
	 * @Setting Footer Widget Heading Fonts
	 *
	 */
	$foodbakery_var_ft_widget_heading_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $foodbakery_var_ft_widget_heading_font_att);
	$foodbakery_var_ft_widget_heading_font_atts = foodbakery_var_get_font_att_array($foodbakery_var_ft_widget_heading_fonts);

	/**
	 * @Font Sizes
	 *
	 */
	$foodbakery_var_content_size = (isset($foodbakery_var_options['foodbakery_var_content_size'])) ? $foodbakery_var_options['foodbakery_var_content_size'] : '';
	$foodbakery_var_mainmenu_size = (isset($foodbakery_var_options['foodbakery_var_mainmenu_size'])) ? $foodbakery_var_options['foodbakery_var_mainmenu_size'] : '';
	$foodbakery_var_heading_1_size = (isset($foodbakery_var_options['foodbakery_var_heading_1_size'])) ? $foodbakery_var_options['foodbakery_var_heading_1_size'] : '';
	$foodbakery_var_heading_2_size = (isset($foodbakery_var_options['foodbakery_var_heading_2_size'])) ? $foodbakery_var_options['foodbakery_var_heading_2_size'] : '';
	$foodbakery_var_heading_3_size = (isset($foodbakery_var_options['foodbakery_var_heading_3_size'])) ? $foodbakery_var_options['foodbakery_var_heading_3_size'] : '';
	$foodbakery_var_heading_4_size = (isset($foodbakery_var_options['foodbakery_var_heading_4_size'])) ? $foodbakery_var_options['foodbakery_var_heading_4_size'] : '';
	$foodbakery_var_heading_5_size = (isset($foodbakery_var_options['foodbakery_var_heading_5_size'])) ? $foodbakery_var_options['foodbakery_var_heading_5_size'] : '';
	$foodbakery_var_heading_6_size = (isset($foodbakery_var_options['foodbakery_var_heading_6_size'])) ? $foodbakery_var_options['foodbakery_var_heading_6_size'] : '';
	$foodbakery_var_section_title_size = (isset($foodbakery_var_options['foodbakery_var_section_title_size'])) ? $foodbakery_var_options['foodbakery_var_section_title_size'] : '';
	$foodbakery_var_page_title_size = (isset($foodbakery_var_options['foodbakery_var_page_title_size'])) ? $foodbakery_var_options['foodbakery_var_page_title_size'] : '';
	$foodbakery_var_post_title_size = (isset($foodbakery_var_options['foodbakery_var_post_title_size'])) ? $foodbakery_var_options['foodbakery_var_post_title_size'] : '';
	$foodbakery_var_widget_heading_size = (isset($foodbakery_var_options['foodbakery_var_widget_heading_size'])) ? $foodbakery_var_options['foodbakery_var_widget_heading_size'] : '';
	$foodbakery_var_widget_title_color = (isset($foodbakery_var_options['foodbakery_var_widget_title_color'])) ? $foodbakery_var_options['foodbakery_var_widget_title_color'] : '';
	$foodbakery_var_ft_widget_heading_size = (isset($foodbakery_var_options['foodbakery_var_ft_widget_heading_size'])) ? $foodbakery_var_options['foodbakery_var_ft_widget_heading_size'] : '';

	/**
	 * @Font LIne Heights
	 *
	 */
	$foodbakery_var_content_lh = (isset($foodbakery_var_options['foodbakery_var_content_lh'])) ? $foodbakery_var_options['foodbakery_var_content_lh'] : '';
	$foodbakery_var_mainmenu_lh = (isset($foodbakery_var_options['foodbakery_var_mainmenu_lh'])) ? $foodbakery_var_options['foodbakery_var_mainmenu_lh'] : '';
	$foodbakery_var_heading_1_lh = (isset($foodbakery_var_options['foodbakery_var_heading_1_lh'])) ? $foodbakery_var_options['foodbakery_var_heading_1_lh'] : '';
	$foodbakery_var_heading_2_lh = (isset($foodbakery_var_options['foodbakery_var_heading_2_lh'])) ? $foodbakery_var_options['foodbakery_var_heading_2_lh'] : '';
	$foodbakery_var_heading_3_lh = (isset($foodbakery_var_options['foodbakery_var_heading_3_lh'])) ? $foodbakery_var_options['foodbakery_var_heading_3_lh'] : '';
	$foodbakery_var_heading_4_lh = (isset($foodbakery_var_options['foodbakery_var_heading_4_lh'])) ? $foodbakery_var_options['foodbakery_var_heading_4_lh'] : '';
	$foodbakery_var_heading_5_lh = (isset($foodbakery_var_options['foodbakery_var_heading_5_lh'])) ? $foodbakery_var_options['foodbakery_var_heading_5_lh'] : '';
	$foodbakery_var_heading_6_lh = (isset($foodbakery_var_options['foodbakery_var_heading_6_lh'])) ? $foodbakery_var_options['foodbakery_var_heading_6_lh'] : '';
	$foodbakery_var_section_title_lh = (isset($foodbakery_var_options['foodbakery_var_section_title_lh'])) ? $foodbakery_var_options['foodbakery_var_section_title_lh'] : '';
	$foodbakery_var_page_title_lh = (isset($foodbakery_var_options['foodbakery_var_page_title_lh'])) ? $foodbakery_var_options['foodbakery_var_page_title_lh'] : '';
	$foodbakery_var_post_title_lh = (isset($foodbakery_var_options['foodbakery_var_post_title_lh'])) ? $foodbakery_var_options['foodbakery_var_post_title_lh'] : '';
	$foodbakery_var_widget_heading_lh = (isset($foodbakery_var_options['foodbakery_var_widget_heading_lh'])) ? $foodbakery_var_options['foodbakery_var_widget_heading_lh'] : '';
	$foodbakery_var_ft_widget_heading_lh = (isset($foodbakery_var_options['foodbakery_var_ft_widget_heading_lh'])) ? $foodbakery_var_options['foodbakery_var_ft_widget_heading_lh'] : '';

	$foodbakery_var_content_spc = (isset($foodbakery_var_options['foodbakery_var_content_spc'])) ? $foodbakery_var_options['foodbakery_var_content_spc'] : '';
	$foodbakery_var_mainmenu_spc = (isset($foodbakery_var_options['foodbakery_var_mainmenu_spc'])) ? $foodbakery_var_options['foodbakery_var_mainmenu_spc'] : '';
	$foodbakery_var_heading_1_spc = (isset($foodbakery_var_options['foodbakery_var_heading_1_spc'])) ? $foodbakery_var_options['foodbakery_var_heading_1_spc'] : '';
	$foodbakery_var_heading_2_spc = (isset($foodbakery_var_options['foodbakery_var_heading_2_spc'])) ? $foodbakery_var_options['foodbakery_var_heading_2_spc'] : '';
	$foodbakery_var_heading_3_spc = (isset($foodbakery_var_options['foodbakery_var_heading_3_spc'])) ? $foodbakery_var_options['foodbakery_var_heading_3_spc'] : '';
	$foodbakery_var_heading_4_spc = (isset($foodbakery_var_options['foodbakery_var_heading_4_spc'])) ? $foodbakery_var_options['foodbakery_var_heading_4_spc'] : '';
	$foodbakery_var_heading_5_spc = (isset($foodbakery_var_options['foodbakery_var_heading_5_spc'])) ? $foodbakery_var_options['foodbakery_var_heading_5_spc'] : '';
	$foodbakery_var_heading_6_spc = (isset($foodbakery_var_options['foodbakery_var_heading_6_spc'])) ? $foodbakery_var_options['foodbakery_var_heading_6_spc'] : '';
	$foodbakery_var_section_title_spc = (isset($foodbakery_var_options['foodbakery_var_section_title_spc'])) ? $foodbakery_var_options['foodbakery_var_section_title_spc'] : '';
	$foodbakery_var_page_title_spc = (isset($foodbakery_var_options['foodbakery_var_page_title_spc'])) ? $foodbakery_var_options['foodbakery_var_page_title_spc'] : '';
	$foodbakery_var_post_title_spc = (isset($foodbakery_var_options['foodbakery_var_post_title_spc'])) ? $foodbakery_var_options['foodbakery_var_post_title_spc'] : '';
	$foodbakery_var_section_title_color = (isset($foodbakery_var_options['foodbakery_var_section_title_color'])) ? $foodbakery_var_options['foodbakery_var_section_title_color'] : '';
	$foodbakery_var_widget_heading_spc = (isset($foodbakery_var_options['foodbakery_var_widget_heading_spc'])) ? $foodbakery_var_options['foodbakery_var_widget_heading_spc'] : '';
	$foodbakery_var_ft_widget_heading_spc = (isset($foodbakery_var_options['foodbakery_var_ft_widget_heading_spc'])) ? $foodbakery_var_options['foodbakery_var_ft_widget_heading_spc'] : '';

	/**
	 * @Font Text Transform
	 *
	 */
	$foodbakery_var_content_textr = (isset($foodbakery_var_options['foodbakery_var_content_textr'])) ? $foodbakery_var_options['foodbakery_var_content_textr'] : '';
	$foodbakery_var_mainmenu_textr = (isset($foodbakery_var_options['foodbakery_var_mainmenu_textr'])) ? $foodbakery_var_options['foodbakery_var_mainmenu_textr'] : '';
	$foodbakery_var_heading_1_textr = (isset($foodbakery_var_options['foodbakery_var_heading_1_textr'])) ? $foodbakery_var_options['foodbakery_var_heading_1_textr'] : '';
	$foodbakery_var_heading_2_textr = (isset($foodbakery_var_options['foodbakery_var_heading_2_textr'])) ? $foodbakery_var_options['foodbakery_var_heading_2_textr'] : '';
	$foodbakery_var_heading_3_textr = (isset($foodbakery_var_options['foodbakery_var_heading_3_textr'])) ? $foodbakery_var_options['foodbakery_var_heading_3_textr'] : '';
	$foodbakery_var_heading_4_textr = (isset($foodbakery_var_options['foodbakery_var_heading_4_textr'])) ? $foodbakery_var_options['foodbakery_var_heading_4_textr'] : '';
	$foodbakery_var_heading_5_textr = (isset($foodbakery_var_options['foodbakery_var_heading_5_textr'])) ? $foodbakery_var_options['foodbakery_var_heading_5_textr'] : '';
	$foodbakery_var_heading_6_textr = (isset($foodbakery_var_options['foodbakery_var_heading_6_textr'])) ? $foodbakery_var_options['foodbakery_var_heading_6_textr'] : '';
	$foodbakery_var_section_title_textr = (isset($foodbakery_var_options['foodbakery_var_section_title_textr'])) ? $foodbakery_var_options['foodbakery_var_section_title_textr'] : '';
	$foodbakery_var_page_title_textr = (isset($foodbakery_var_options['foodbakery_var_page_title_textr'])) ? $foodbakery_var_options['foodbakery_var_page_title_textr'] : '';
	$foodbakery_var_post_title_textr = (isset($foodbakery_var_options['foodbakery_var_post_title_textr'])) ? $foodbakery_var_options['foodbakery_var_post_title_textr'] : '';
	$foodbakery_var_post_title_color = (isset($foodbakery_var_options['foodbakery_var_post_title_color'])) ? $foodbakery_var_options['foodbakery_var_post_title_color'] : '';
	$foodbakery_var_widget_heading_textr = (isset($foodbakery_var_options['foodbakery_var_widget_heading_textr'])) ? $foodbakery_var_options['foodbakery_var_widget_heading_textr'] : '';
	$foodbakery_var_ft_widget_heading_textr = (isset($foodbakery_var_options['foodbakery_var_ft_widget_heading_textr'])) ? $foodbakery_var_options['foodbakery_var_ft_widget_heading_textr'] : '';


	$foodbakery_var_widget_color = isset($foodbakery_var_options['foodbakery_var_widget_color']) ? $foodbakery_var_options['foodbakery_var_widget_color'] : '#2d2d2d';
	$foodbakery_var_ft_widget_title_color = isset($foodbakery_var_options['foodbakery_var_footer_widget_title_color']) ? $foodbakery_var_options['foodbakery_var_footer_widget_title_color'] : '';


	/**
	 * @Font Color
	 *
	 */
	$foodbakery_var_heading_h1_color = (isset($foodbakery_var_options['foodbakery_var_heading_h1_color']) and $foodbakery_var_options['foodbakery_var_heading_h1_color'] <> '') ? $foodbakery_var_options['foodbakery_var_heading_h1_color'] : '';
	$foodbakery_var_heading_h2_color = (isset($foodbakery_var_options['foodbakery_var_heading_h2_color']) and $foodbakery_var_options['foodbakery_var_heading_h2_color'] <> '') ? $foodbakery_var_options['foodbakery_var_heading_h2_color'] : '';
	$foodbakery_var_heading_h3_color = (isset($foodbakery_var_options['foodbakery_var_heading_h3_color']) and $foodbakery_var_options['foodbakery_var_heading_h3_color'] <> '') ? $foodbakery_var_options['foodbakery_var_heading_h3_color'] : '';
	$foodbakery_var_heading_h4_color = (isset($foodbakery_var_options['foodbakery_var_heading_h4_color']) and $foodbakery_var_options['foodbakery_var_heading_h4_color'] <> '') ? $foodbakery_var_options['foodbakery_var_heading_h4_color'] : '';
	$foodbakery_var_heading_h5_color = (isset($foodbakery_var_options['foodbakery_var_heading_h5_color']) and $foodbakery_var_options['foodbakery_var_heading_h5_color'] <> '') ? $foodbakery_var_options['foodbakery_var_heading_h5_color'] : '';
	$foodbakery_var_heading_h6_color = (isset($foodbakery_var_options['foodbakery_var_heading_h6_color']) and $foodbakery_var_options['foodbakery_var_heading_h6_color'] <> '') ? $foodbakery_var_options['foodbakery_var_heading_h6_color'] : '';

	$foodbakery_var_widget_heading_size = (isset($foodbakery_var_options['foodbakery_var_widget_heading_size'])) ? $foodbakery_var_options['foodbakery_var_widget_heading_size'] : '';
	$foodbakery_var_section_heading_size = (isset($foodbakery_var_options['foodbakery_var_section_heading_size'])) ? $foodbakery_var_options['foodbakery_var_section_heading_size'] : '';
	$foodbakery_var_copyright_bg_color = (isset($foodbakery_var_options['foodbakery_var_copyright_bg_color'])) ? $foodbakery_var_options['foodbakery_var_copyright_bg_color'] : '';

	if (
		( isset($foodbakery_var_options['foodbakery_var_custom_font_woff']) && $foodbakery_var_options['foodbakery_var_custom_font_woff'] <> '' ) &&
		( isset($foodbakery_var_options['foodbakery_var_custom_font_ttf']) && $foodbakery_var_options['foodbakery_var_custom_font_ttf'] <> '' ) &&
		( isset($foodbakery_var_options['foodbakery_var_custom_font_svg']) && $foodbakery_var_options['foodbakery_var_custom_font_svg'] <> '' ) &&
		( isset($foodbakery_var_options['foodbakery_var_custom_font_eot']) && $foodbakery_var_options['foodbakery_var_custom_font_eot'] <> '' )
	):

	    $font_face_html = "
        @font-face {
    font-family: 'foodbakery_var_custom_font';
    src: url('" . $foodbakery_var_options['foodbakery_var_custom_font_eot'] . "');
    src:
        url('" . $foodbakery_var_options['foodbakery_var_custom_font_eot'] . "?#iefix') format('eot'),
        url('" . $foodbakery_var_options['foodbakery_var_custom_font_woff'] . "') format('woff'),
        url('" . $foodbakery_var_options['foodbakery_var_custom_font_ttf'] . "') format('truetype'),
        url('" . $foodbakery_var_options['foodbakery_var_custom_font_svg'] . "#foodbakery_var_custom_font') format('svg');
    font-weight: 400;
    font-style: normal;
        }";

	    $custom_font = true;
	else: $custom_font = false;
	endif;

	if ($custom_font == true) {
	    echo foodbakery_allow_special_char($font_face_html);
	}
	if ((isset($foodbakery_var_content_size) && $foodbakery_var_content_size != '') || (isset($foodbakery_var_content_spc) && $foodbakery_var_content_spc != '') || (isset($foodbakery_var_content_textr) && $foodbakery_var_content_textr != '') || (isset($foodbakery_var_text_color) && $foodbakery_var_text_color != '')) {
	    ?>
	    /*Theme TypoColors Classes*/

	    body,
	    .main-section p,
	    .mce-content-body p
	    {
	    <?php
	    if ($custom_font == true) {
		echo 'font-family: foodbakery_var_custom_font;';
		if (isset($foodbakery_var_content_size) && $foodbakery_var_content_size != '') {
		    echo 'font-size: ' . $foodbakery_var_content_size . ';';
		}
		if (isset($foodbakery_var_content_spc) && $foodbakery_var_content_spc != '') {
		    echo esc_html($foodbakery_var_content_spc != '' ? 'letter-spacing: ' . $foodbakery_var_content_spc . 'px;' : '' );
		}
		if (isset($foodbakery_var_content_textr) && $foodbakery_var_content_textr != '') {
		    echo esc_html($foodbakery_var_content_textr != '' ? 'text-transform: ' . $foodbakery_var_content_textr . ';' : '' );
		}
		if (isset($foodbakery_var_text_color) && $foodbakery_var_text_color != '') {
		    echo esc_html($foodbakery_var_text_color != '' ? 'color: ' . $foodbakery_var_text_color . ' !important;' : '' );
		}
	    } else {
		echo foodbakery_var_font_font_print($foodbakery_var_content_font_atts, $foodbakery_var_content_size, $foodbakery_var_content_lh, $foodbakery_var_content_font);
		if (isset($foodbakery_var_content_spc) && $foodbakery_var_content_spc != '') {
		    echo esc_html($foodbakery_var_content_spc != '' ? 'letter-spacing: ' . $foodbakery_var_content_spc . 'px;' : '' );
		}
		if (isset($foodbakery_var_content_textr) && $foodbakery_var_content_textr != '') {
		    echo esc_html($foodbakery_var_content_textr != '' ? 'text-transform: ' . $foodbakery_var_content_textr . ';' : '' );
		}
		if (isset($foodbakery_var_text_color) && $foodbakery_var_text_color != '') {
		    echo esc_html($foodbakery_var_text_color != '' ? 'color: ' . $foodbakery_var_text_color . ' !important;' : '' );
		}
	    }
	    ?>
	    }
	    <?php
	}
	if ((isset($foodbakery_var_logo_margint) && $foodbakery_var_logo_margint != '') || (isset($foodbakery_var_logo_marginr) && $foodbakery_var_logo_marginr != '') || (isset($foodbakery_var_logo_marginb) && $foodbakery_var_logo_marginb != '') || (isset($foodbakery_var_logo_marginl) && $foodbakery_var_logo_marginl != '')) {
	    ?>
	    /*Header Default Start*/

	    header .logo {
	    <?php if (isset($foodbakery_var_logo_margint) && $foodbakery_var_logo_margint != '') { ?>
		margin-top:<?php echo foodbakery_allow_special_char($foodbakery_var_logo_margint); ?>px;
	    <?php } if (isset($foodbakery_var_logo_marginr) && $foodbakery_var_logo_marginr != '') { ?>
		margin-right:<?php echo foodbakery_allow_special_char($foodbakery_var_logo_marginr); ?>px;
	    <?php } if (isset($foodbakery_var_logo_marginb) && $foodbakery_var_logo_marginb != '') { ?>
		margin-bottom:<?php echo foodbakery_allow_special_char($foodbakery_var_logo_marginb); ?>px;
	    <?php }if (isset($foodbakery_var_logo_marginl) && $foodbakery_var_logo_marginl != '') { ?>
		margin-left:<?php echo foodbakery_allow_special_char($foodbakery_var_logo_marginl); ?>px;
	    <?php } ?>

	    }
	    <?php
	}
	if ((isset($foodbakery_var_mainmenu_size) && $foodbakery_var_mainmenu_size != '') || (isset($foodbakery_var_mainmenu_spc) && $foodbakery_var_mainmenu_spc != '') || (isset($foodbakery_var_mainmenu_textr) && $foodbakery_var_mainmenu_textr != '')) {
	    ?>
	    /*Navigation FontSizes*/

	    #header .navigation > ul > li > a,
	    #header .navigation > ul > li
	    {
	    <?php
	    if ($custom_font == true) {
		echo 'font-family: foodbakery_var_custom_font;';
		if (isset($foodbakery_var_mainmenu_size) && $foodbakery_var_mainmenu_size != '') {
		    echo 'font-size: ' . $foodbakery_var_mainmenu_size . ';';
		}
		if (isset($foodbakery_var_mainmenu_spc) && $foodbakery_var_mainmenu_spc != '') {
		    echo esc_html($foodbakery_var_mainmenu_spc != '' ? 'letter-spacing: ' . $foodbakery_var_mainmenu_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_mainmenu_textr) && $foodbakery_var_mainmenu_textr != '') {
		    echo esc_html($foodbakery_var_mainmenu_textr != '' ? 'text-transform: ' . $foodbakery_var_mainmenu_textr . ' !important;' : '' );
		}
	    } else {
		echo foodbakery_var_font_font_print($foodbakery_var_mainmenu_font_atts, $foodbakery_var_mainmenu_size, $foodbakery_var_mainmenu_lh, $foodbakery_var_mainmenu_font, true);
		if (isset($foodbakery_var_mainmenu_spc) && $foodbakery_var_mainmenu_spc != '') {
		    echo esc_html($foodbakery_var_mainmenu_spc != '' ? 'letter-spacing: ' . $foodbakery_var_mainmenu_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_mainmenu_textr) && $foodbakery_var_mainmenu_textr != '') {
		    echo esc_html($foodbakery_var_mainmenu_textr != '' ? 'text-transform: ' . $foodbakery_var_mainmenu_textr . ' !important;' : '' );
		}
	    }
	    ?>
	    }

	    <?php
	}

	if ((isset($foodbakery_var_heading_1_size) && $foodbakery_var_heading_1_size != '') || (isset($foodbakery_var_heading_1_spc) && $foodbakery_var_heading_1_spc != '') || (isset($foodbakery_var_heading_1_textr) && $foodbakery_var_heading_1_textr != '') || (isset($foodbakery_var_heading_h1_color) && $foodbakery_var_heading_h1_color != '')) {
	    ?>
	    h1, h1 a{
	    <?php
	    if ($custom_font == true) {
		echo 'font-family: foodbakery_var_custom_font;';
		if (isset($foodbakery_var_heading_1_size) && $foodbakery_var_heading_1_size != '') {
		    echo 'font-size: ' . $foodbakery_var_heading_1_size . ';';
		}
		if (isset($foodbakery_var_heading_1_spc) && $foodbakery_var_heading_1_spc != '') {
		    echo esc_html($foodbakery_var_heading_1_spc != '' ? 'letter-spacing: ' . $foodbakery_var_heading_1_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_heading_1_textr) && $foodbakery_var_heading_1_textr != '') {
		    echo esc_html($foodbakery_var_heading_1_textr != '' ? 'text-transform: ' . $foodbakery_var_heading_1_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_heading_h1_color) && $foodbakery_var_heading_h1_color != '') {
		    echo esc_html($foodbakery_var_heading_h1_color != '' ? 'color: ' . $foodbakery_var_heading_h1_color . ' !important;' : '' );
		}
	    } else {
		echo foodbakery_var_font_font_print($foodbakery_var_heading1_font_atts, $foodbakery_var_heading_1_size, $foodbakery_var_heading_1_lh, $foodbakery_var_heading1_font, true);
        
		if (isset($foodbakery_var_heading_1_spc) && $foodbakery_var_heading_1_spc != '') {
		    echo esc_html($foodbakery_var_heading_1_spc != '' ? 'letter-spacing: ' . $foodbakery_var_heading_1_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_heading_1_textr) && $foodbakery_var_heading_1_textr != '') {
		    echo esc_html($foodbakery_var_heading_1_textr != '' ? 'text-transform: ' . $foodbakery_var_heading_1_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_heading_h1_color) && $foodbakery_var_heading_h1_color != '') {
		    echo esc_html($foodbakery_var_heading_h1_color != '' ? 'color: ' . $foodbakery_var_heading_h1_color . ' !important;' : '' );
		}
	    }
	    ?>}
	    <?php
	}
	if ((isset($foodbakery_var_heading_2_size) && $foodbakery_var_heading_2_size != '') || (isset($foodbakery_var_heading_2_spc) && $foodbakery_var_heading_2_spc != '') || (isset($foodbakery_var_heading_2_textr) && $foodbakery_var_heading_2_textr != '') || (isset($foodbakery_var_heading_h2_color) && $foodbakery_var_heading_h2_color != '')) {
	    ?>
	    h2, h2 a{
	    <?php
	    if ($custom_font == true) {
		echo 'font-family: foodbakery_var_custom_font;';
		if (isset($foodbakery_var_heading_2_size) && $foodbakery_var_heading_2_size != '') {
		    echo 'font-size: ' . $foodbakery_var_heading_2_size . ';';
		}
		if (isset($foodbakery_var_heading_2_spc) && $foodbakery_var_heading_2_spc != '') {
		    echo esc_html($foodbakery_var_heading_2_spc != '' ? 'letter-spacing: ' . $foodbakery_var_heading_2_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_heading_2_textr) && $foodbakery_var_heading_2_textr != '') {
		    echo esc_html($foodbakery_var_heading_2_textr != '' ? 'text-transform: ' . $foodbakery_var_heading_2_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_heading_h2_color) && $foodbakery_var_heading_h2_color != '') {
		    echo esc_html($foodbakery_var_heading_h2_color != '' ? 'color: ' . $foodbakery_var_heading_h2_color . ' !important;' : '' );
		}
	    } else {
		echo foodbakery_var_font_font_print($foodbakery_var_heading2_font_atts, $foodbakery_var_heading_2_size, $foodbakery_var_heading_2_lh, $foodbakery_var_heading2_font, true);
		if (isset($foodbakery_var_heading_2_spc) && $foodbakery_var_heading_2_spc != '') {
		    echo esc_html($foodbakery_var_heading_2_spc != '' ? 'letter-spacing: ' . $foodbakery_var_heading_2_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_heading_2_textr) && $foodbakery_var_heading_2_textr != '') {
		    echo esc_html($foodbakery_var_heading_2_textr != '' ? 'text-transform: ' . $foodbakery_var_heading_2_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_heading_h2_color) && $foodbakery_var_heading_h2_color != '') {
		    echo esc_html($foodbakery_var_heading_h2_color != '' ? 'color: ' . $foodbakery_var_heading_h2_color . ' !important;' : '' );
		}
	    }
	    ?>
	    }
	    <?php
	}
	if ((isset($foodbakery_var_heading_3_size) && $foodbakery_var_heading_3_size != '') || (isset($foodbakery_var_heading_3_spc) && $foodbakery_var_heading_3_spc != '') || (isset($foodbakery_var_heading_3_textr) && $foodbakery_var_heading_3_textr != '') || (isset($foodbakery_var_heading_h3_color) && $foodbakery_var_heading_h3_color != '')) {
	    ?>
	    h3, h3 a{
	    <?php
	    if ($custom_font == true) {
		echo 'font-family: foodbakery_var_custom_font;';
		if (isset($foodbakery_var_heading_3_size) && $foodbakery_var_heading_3_size != '') {
		    echo 'font-size: ' . $foodbakery_var_heading_3_size . ';';
		}
		if (isset($foodbakery_var_heading_3_spc) && $foodbakery_var_heading_3_spc != '') {
		    echo esc_html($foodbakery_var_heading_3_spc != '' ? 'letter-spacing: ' . $foodbakery_var_heading_3_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_heading_3_textr) && $foodbakery_var_heading_3_textr != '') {
		    echo esc_html($foodbakery_var_heading_3_textr != '' ? 'text-transform: ' . $foodbakery_var_heading_3_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_heading_h3_color) && $foodbakery_var_heading_h3_color != '') {
		    echo esc_html($foodbakery_var_heading_h3_color != '' ? 'color: ' . $foodbakery_var_heading_h3_color . ' !important;' : '' );
		}
	    } else {
		echo foodbakery_var_font_font_print($foodbakery_var_heading3_font_atts, $foodbakery_var_heading_3_size, $foodbakery_var_heading_3_lh, $foodbakery_var_heading3_font, true);
		if (isset($foodbakery_var_heading_3_spc) && $foodbakery_var_heading_3_spc != '') {
		    echo esc_html($foodbakery_var_heading_3_spc != '' ? 'letter-spacing: ' . $foodbakery_var_heading_3_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_heading_3_textr) && $foodbakery_var_heading_3_textr != '') {
		    echo esc_html($foodbakery_var_heading_3_textr != '' ? 'text-transform: ' . $foodbakery_var_heading_3_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_heading_h3_color) && $foodbakery_var_heading_h3_color != '') {
		    echo esc_html($foodbakery_var_heading_h3_color != '' ? 'color: ' . $foodbakery_var_heading_h3_color . ' !important;' : '' );
		}
	    }
	    ?>
	    }
	    <?php
	}
	if ((isset($foodbakery_var_heading_4_size) && $foodbakery_var_heading_4_size != '') || (isset($foodbakery_var_heading_4_spc) && $foodbakery_var_heading_4_spc != '') || (isset($foodbakery_var_heading_4_textr) && $foodbakery_var_heading_4_textr != '') || (isset($foodbakery_var_heading_h4_color) && $foodbakery_var_heading_h4_color != '')) {
	    ?>
	    h4, h4 a{
	    <?php
	    if ($custom_font == true) {
		echo 'font-family: foodbakery_var_custom_font;';
		if (isset($foodbakery_var_heading_4_size) && $foodbakery_var_heading_4_size != '') {
		    echo 'font-size: ' . $foodbakery_var_heading_4_size . ';';
		}
		if (isset($foodbakery_var_heading_4_spc) && $foodbakery_var_heading_4_spc != '') {
		    echo esc_html($foodbakery_var_heading_4_spc != '' ? 'letter-spacing: ' . $foodbakery_var_heading_4_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_heading_4_textr) && $foodbakery_var_heading_4_textr != '') {
		    echo esc_html($foodbakery_var_heading_4_textr != '' ? 'text-transform: ' . $foodbakery_var_heading_4_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_heading_h4_color) && $foodbakery_var_heading_h4_color != '') {
		    echo esc_html($foodbakery_var_heading_h4_color != '' ? 'color: ' . $foodbakery_var_heading_h4_color . ' !important;' : '' );
		}
	    } else {
		echo foodbakery_var_font_font_print($foodbakery_var_heading4_font_atts, $foodbakery_var_heading_4_size, $foodbakery_var_heading_4_lh, $foodbakery_var_heading4_font, true);
		if (isset($foodbakery_var_heading_4_spc) && $foodbakery_var_heading_4_spc != '') {
		    echo esc_html($foodbakery_var_heading_4_spc != '' ? 'letter-spacing: ' . $foodbakery_var_heading_4_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_heading_4_textr) && $foodbakery_var_heading_4_textr != '') {
		    echo esc_html($foodbakery_var_heading_4_textr != '' ? 'text-transform: ' . $foodbakery_var_heading_4_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_heading_h4_color) && $foodbakery_var_heading_h4_color != '') {
		    echo esc_html($foodbakery_var_heading_h4_color != '' ? 'color: ' . $foodbakery_var_heading_h4_color . ' !important;' : '' );
		}
	    }
	    ?>
	    }
	    <?php
	}
	if ((isset($foodbakery_var_heading_5_size) && $foodbakery_var_heading_5_size != '') || (isset($foodbakery_var_heading_5_spc) && $foodbakery_var_heading_5_spc != '') || (isset($foodbakery_var_heading_5_textr) && $foodbakery_var_heading_5_textr != '') || (isset($foodbakery_var_heading_h5_color) && $foodbakery_var_heading_h5_color != '')) {
	    ?>
	    h5, h5 a{
	    <?php
	    if ($custom_font == true) {
		echo 'font-family: foodbakery_var_custom_font;';
		if (isset($foodbakery_var_heading_5_size) && $foodbakery_var_heading_5_size != '') {
		    echo 'font-size: ' . $foodbakery_var_heading_5_size . ';';
		}
		if (isset($foodbakery_var_heading_5_spc) && $foodbakery_var_heading_5_spc != '') {
		    echo esc_html($foodbakery_var_heading_5_spc != '' ? 'letter-spacing: ' . $foodbakery_var_heading_5_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_heading_5_textr) && $foodbakery_var_heading_5_textr != '') {
		    echo esc_html($foodbakery_var_heading_5_textr != '' ? 'text-transform: ' . $foodbakery_var_heading_5_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_heading_h5_color) && $foodbakery_var_heading_h5_color != '') {
		    echo esc_html($foodbakery_var_heading_h5_color != '' ? 'color: ' . $foodbakery_var_heading_h5_color . ' !important;' : '' );
		}
	    } else {
		echo foodbakery_var_font_font_print($foodbakery_var_heading5_font_atts, $foodbakery_var_heading_5_size, $foodbakery_var_heading_5_lh, $foodbakery_var_heading5_font, true);
		if (isset($foodbakery_var_heading_5_spc) && $foodbakery_var_heading_5_spc != '') {
		    echo esc_html($foodbakery_var_heading_5_spc != '' ? 'letter-spacing: ' . $foodbakery_var_heading_5_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_heading_5_textr) && $foodbakery_var_heading_5_textr != '') {
		    echo esc_html($foodbakery_var_heading_5_textr != '' ? 'text-transform: ' . $foodbakery_var_heading_5_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_heading_h5_color) && $foodbakery_var_heading_h5_color != '') {
		    echo esc_html($foodbakery_var_heading_h5_color != '' ? 'color: ' . $foodbakery_var_heading_h5_color . ' !important;' : '' );
		}
	    }
	    ?>
	    }
	    <?php
	}
	if ((isset($foodbakery_var_heading_6_size) && $foodbakery_var_heading_6_size != '') || (isset($foodbakery_var_heading_6_spc) && $foodbakery_var_heading_6_spc != '') || (isset($foodbakery_var_heading_6_textr) && $foodbakery_var_heading_6_textr != '') || (isset($foodbakery_var_heading_h6_color) && $foodbakery_var_heading_h6_color != '')) {
	    ?>
	    h6, h6 a{
	    <?php
	    if ($custom_font == true) {
		echo 'font-family: foodbakery_var_custom_font;';
		if (isset($foodbakery_var_heading_6_size) && $foodbakery_var_heading_6_size != '') {
		    echo 'font-size: ' . $foodbakery_var_heading_6_size . ';';
		}
		if (isset($foodbakery_var_heading_6_spc) && $foodbakery_var_heading_6_spc != '') {
		    echo esc_html($foodbakery_var_heading_6_spc != '' ? 'letter-spacing: ' . $foodbakery_var_heading_6_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_heading_6_textr) && $foodbakery_var_heading_6_textr != '') {
		    echo esc_html($foodbakery_var_heading_6_textr != '' ? 'text-transform: ' . $foodbakery_var_heading_6_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_heading_h6_color) && $foodbakery_var_heading_h6_color != '') {
		    echo esc_html($foodbakery_var_heading_h6_color != '' ? 'color: ' . $foodbakery_var_heading_h6_color . ' !important;' : '' );
		}
	    } else {
		echo foodbakery_var_font_font_print($foodbakery_var_heading6_font_atts, $foodbakery_var_heading_6_size, $foodbakery_var_heading_6_lh, $foodbakery_var_heading6_font, true);
		if (isset($foodbakery_var_heading_6_spc) && $foodbakery_var_heading_6_spc != '') {
		    echo esc_html($foodbakery_var_heading_6_spc != '' ? 'letter-spacing: ' . $foodbakery_var_heading_6_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_heading_6_textr) && $foodbakery_var_heading_6_textr != '') {
		    echo esc_html($foodbakery_var_heading_6_textr != '' ? 'text-transform: ' . $foodbakery_var_heading_6_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_heading_h6_color) && $foodbakery_var_heading_h6_color != '') {
		    echo esc_html($foodbakery_var_heading_h6_color != '' ? 'color: ' . $foodbakery_var_heading_h6_color . ' !important;' : '' );
		}
	    }
	    ?>
	    }
	    <?php
	}
	if ((isset($foodbakery_var_section_title_size) && $foodbakery_var_section_title_size != '') || (isset($foodbakery_var_section_title_spc) && $foodbakery_var_section_title_spc != '') || (isset($foodbakery_var_section_title_textr) && $foodbakery_var_section_title_textr != '') || (isset($foodbakery_var_section_title_color) && $foodbakery_var_section_title_color != '')) {
	    ?>
	    .cs-section-title h2{
	    <?php
	    if ($custom_font == true) {
		echo 'font-family: foodbakery_var_custom_font;';
		if (isset($foodbakery_var_section_title_size) && $foodbakery_var_section_title_size != '') {
		    echo 'font-size: ' . $foodbakery_var_section_title_size . ';';
		}
		if (isset($foodbakery_var_section_title_spc) && $foodbakery_var_section_title_spc != '') {
		    echo esc_html($foodbakery_var_section_title_spc != '' ? 'letter-spacing: ' . $foodbakery_var_section_title_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_section_title_textr) && $foodbakery_var_section_title_textr != '') {
		    echo esc_html($foodbakery_var_section_title_textr != '' ? 'text-transform: ' . $foodbakery_var_section_title_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_section_title_color) && $foodbakery_var_section_title_color != '') {
		    echo esc_html($foodbakery_var_section_title_color != '' ? 'color: ' . $foodbakery_var_section_title_color . ' !important;' : '' );
		}
	    } else {

		echo foodbakery_var_font_font_print($foodbakery_var_section_title_font_atts, $foodbakery_var_section_title_size, $foodbakery_var_section_title_lh, $foodbakery_var_section_title_font, true);
		if (isset($foodbakery_var_section_title_spc) && $foodbakery_var_section_title_spc != '') {
		    echo esc_html($foodbakery_var_section_title_spc != '' ? 'letter-spacing: ' . $foodbakery_var_section_title_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_section_title_textr) && $foodbakery_var_section_title_textr != '') {
		    echo esc_html($foodbakery_var_section_title_textr != '' ? 'text-transform: ' . $foodbakery_var_section_title_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_section_title_color) && $foodbakery_var_section_title_color != '') {
		    echo esc_html($foodbakery_var_section_title_color != '' ? 'color: ' . $foodbakery_var_section_title_color . ' !important;' : '' );
		}
	    }
	    ?>
	    }
	    <?php
	}

	if ((isset($foodbakery_var_post_title_size) && $foodbakery_var_post_title_size != '') || (isset($foodbakery_var_post_title_spc) && $foodbakery_var_post_title_spc != '') || (isset($foodbakery_var_post_title_textr) && $foodbakery_var_post_title_textr != '') || (isset($foodbakery_var_post_title_color) && $foodbakery_var_post_title_color != '')) {
	    ?>
	    .post-title h3 a{
	    <?php
	    if ($custom_font == true) {
		echo 'font-family: foodbakery_var_custom_font;';

		if (isset($foodbakery_var_post_title_size) && $foodbakery_var_post_title_size != '') {
		    echo 'font-size: ' . $foodbakery_var_post_title_size . ';';
		}
		if (isset($foodbakery_var_post_title_spc) && $foodbakery_var_post_title_spc != '') {
		    echo esc_html($foodbakery_var_post_title_spc != '' ? 'letter-spacing: ' . $foodbakery_var_post_title_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_post_title_textr) && $foodbakery_var_post_title_textr != '') {
		    echo esc_html($foodbakery_var_post_title_textr != '' ? 'text-transform: ' . $foodbakery_var_post_title_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_post_title_color) && $foodbakery_var_post_title_color != '') {
		    echo esc_html($foodbakery_var_post_title_color != '' ? 'color: ' . $foodbakery_var_post_title_color . ' !important;' : '' );
		}
	    } else {
		echo foodbakery_var_font_font_print($foodbakery_var_post_title_font_atts, $foodbakery_var_post_title_size, $foodbakery_var_post_title_lh, $foodbakery_var_post_title_font, true);
		if (isset($foodbakery_var_post_title_spc) && $foodbakery_var_post_title_spc != '') {
		    echo esc_html($foodbakery_var_post_title_spc != '' ? 'letter-spacing: ' . $foodbakery_var_post_title_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_post_title_textr) && $foodbakery_var_post_title_textr != '') {
		    echo esc_html($foodbakery_var_post_title_textr != '' ? 'text-transform: ' . $foodbakery_var_post_title_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_post_title_color) && $foodbakery_var_post_title_color != '') {
		    echo esc_html($foodbakery_var_post_title_color != '' ? 'color: ' . $foodbakery_var_post_title_color . ' !important;' : '' );
		}
	    }
	    ?>
	    }
	    <?php
	}
	if ((isset($foodbakery_var_page_title_color) && $foodbakery_var_page_title_color != '') || (isset($foodbakery_var_page_title_size) && $foodbakery_var_page_title_size != '') || (isset($foodbakery_var_page_title_spc) && $foodbakery_var_page_title_spc != '') || (isset($foodbakery_var_page_title_textr) && $foodbakery_var_page_title_textr != '')) {
	    ?>
	    .cs-page-title h1 {
	    <?php
	    if ($custom_font == true) {
		echo 'font-family: foodbakery_var_custom_font;';
		if (isset($foodbakery_var_page_title_size) && $foodbakery_var_page_title_size != '') {
		    echo 'font-size: ' . $foodbakery_var_page_title_size . ';';
		}
		if (isset($foodbakery_var_page_title_spc) && $foodbakery_var_page_title_spc != '') {
		    echo esc_html($foodbakery_var_page_title_spc != '' ? 'letter-spacing: ' . $foodbakery_var_page_title_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_page_title_textr) && $foodbakery_var_page_title_textr != '') {
		    echo esc_html($foodbakery_var_page_title_textr != '' ? 'text-transform: ' . $foodbakery_var_page_title_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_page_title_color) && $foodbakery_var_page_title_color != '') {
		    echo esc_html($foodbakery_var_page_title_color != '' ? 'color: ' . $foodbakery_var_page_title_color . ' !important;' : '' );
		}
	    } else {

		echo foodbakery_var_font_font_print($foodbakery_var_page_title_font_atts, $foodbakery_var_page_title_size, $foodbakery_var_page_title_lh, $foodbakery_var_page_title_font, true);
		if (isset($foodbakery_var_page_title_spc) && $foodbakery_var_page_title_spc != '') {
		    echo esc_html($foodbakery_var_page_title_spc != '' ? 'letter-spacing: ' . $foodbakery_var_page_title_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_page_title_textr) && $foodbakery_var_page_title_textr != '') {
		    echo esc_html($foodbakery_var_page_title_textr != '' ? 'text-transform: ' . $foodbakery_var_page_title_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_page_title_color) && $foodbakery_var_page_title_color != '') {
		    echo esc_html($foodbakery_var_page_title_color != '' ? 'color: ' . $foodbakery_var_page_title_color . ' !important;' : '' );
		}
	    }
	    ?>
	    }
	    <?php
	}




	if ((isset($foodbakery_var_widget_heading_size) && $foodbakery_var_widget_heading_size != '') || (isset($foodbakery_var_widget_heading_spc) && $foodbakery_var_widget_heading_spc != '') || (isset($foodbakery_var_widget_title_color) && $foodbakery_var_widget_title_color != '')) {
	    ?>
	    .page-sidebar .widget .widget-title h5{
	    <?php
	    if ($custom_font == true) {
		echo 'font-family: foodbakery_var_custom_font;';
		if (isset($foodbakery_var_widget_heading_size) && $foodbakery_var_widget_heading_size != '') {
		    echo 'font-size: ' . $foodbakery_var_widget_heading_size . ';';
		}
		if (isset($foodbakery_var_widget_heading_spc) && $foodbakery_var_widget_heading_spc != '') {
		    echo esc_html($foodbakery_var_widget_heading_spc != '' ? 'letter-spacing: ' . $foodbakery_var_widget_heading_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_widget_heading_textr) && $foodbakery_var_widget_heading_textr != '') {
		    echo esc_html($foodbakery_var_widget_heading_textr != '' ? 'text-transform: ' . $foodbakery_var_widget_heading_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_widget_title_color) && $foodbakery_var_widget_title_color != '') {
		    echo esc_html($foodbakery_var_widget_title_color != '' ? 'color: ' . $foodbakery_var_widget_title_color . ' !important;' : '' );
		}
	    } else {
		echo foodbakery_var_font_font_print($foodbakery_var_widget_heading_font_atts, $foodbakery_var_widget_heading_size, $foodbakery_var_widget_heading_lh, $foodbakery_var_widget_heading_font, true);
		if (isset($foodbakery_var_widget_heading_spc) && $foodbakery_var_widget_heading_spc != '') {
		    echo esc_html($foodbakery_var_widget_heading_spc != '' ? 'letter-spacing: ' . $foodbakery_var_widget_heading_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_widget_heading_textr) && $foodbakery_var_widget_heading_textr != '') {
		    echo esc_html($foodbakery_var_widget_heading_textr != '' ? 'text-transform: ' . $foodbakery_var_widget_heading_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_widget_title_color) && $foodbakery_var_widget_title_color != '') {
		    echo esc_html($foodbakery_var_widget_title_color != '' ? 'color: ' . $foodbakery_var_widget_title_color . ' !important;' : '' );
		}
	    }
	    ?>
	    }
	    <?php
	}


	if ((isset($foodbakery_var_ft_widget_heading_size) && $foodbakery_var_ft_widget_heading_size != '') || (isset($foodbakery_var_ft_widget_heading_spc) && $foodbakery_var_ft_widget_heading_spc != '') || (isset($foodbakery_var_ft_widget_heading_textr) && $foodbakery_var_ft_widget_heading_textr != '') || (isset($foodbakery_var_ft_widget_title_color) && $foodbakery_var_ft_widget_title_color != '')) {
	    ?>
	    /*
	    * Footer Title color and fonts
	    */
	    #footer .widget-title h5{
	    <?php
	    if ($custom_font == true) {
		echo 'font-family: foodbakery_var_custom_font;';
		if (isset($foodbakery_var_ft_widget_heading_size) && $foodbakery_var_ft_widget_heading_size != '') {
		    echo 'font-size: ' . $foodbakery_var_ft_widget_heading_size . ';';
		}
		if (isset($foodbakery_var_ft_widget_heading_spc) && $foodbakery_var_ft_widget_heading_spc != '') {
		    echo esc_html($foodbakery_var_ft_widget_heading_spc != '' ? 'letter-spacing: ' . $foodbakery_var_ft_widget_heading_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_ft_widget_heading_textr) && $foodbakery_var_ft_widget_heading_textr != '') {
		    echo esc_html($foodbakery_var_ft_widget_heading_textr != '' ? 'text-transform: ' . $foodbakery_var_ft_widget_heading_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_ft_widget_title_color) && $foodbakery_var_ft_widget_title_color != '') {
		    echo esc_html($foodbakery_var_ft_widget_title_color != '' ? 'color: ' . $foodbakery_var_ft_widget_title_color . ' !important;' : '' );
		}
	    } else {
		echo foodbakery_var_font_font_print($foodbakery_var_ft_widget_heading_font_atts, $foodbakery_var_ft_widget_heading_size, $foodbakery_var_ft_widget_heading_lh, $foodbakery_var_ft_widget_heading_font, true);

		if (isset($foodbakery_var_ft_widget_heading_spc) && $foodbakery_var_ft_widget_heading_spc != '') {
		    echo esc_html($foodbakery_var_ft_widget_heading_spc != '' ? 'letter-spacing: ' . $foodbakery_var_ft_widget_heading_spc . 'px !important;' : '' );
		}
		if (isset($foodbakery_var_ft_widget_heading_textr) && $foodbakery_var_ft_widget_heading_textr != '') {
		    echo esc_html($foodbakery_var_ft_widget_heading_textr != '' ? 'text-transform: ' . $foodbakery_var_ft_widget_heading_textr . ' !important;' : '' );
		}
		if (isset($foodbakery_var_ft_widget_title_color) && $foodbakery_var_ft_widget_title_color != '') {
		    echo esc_html($foodbakery_var_ft_widget_title_color != '' ? 'color: ' . $foodbakery_var_ft_widget_title_color . ' !important;' : '' );
		}
	    }
	    ?>
	    }
	    <?php
	}

	if (isset($foodbakery_var_top_strip_color) && $foodbakery_var_top_strip_color != '') {
	    ?>
	    /*Topbar text Color*/

	    #header .top-bar a,
	    #header .top-bar .today-date{
	    color: <?php echo foodbakery_allow_special_char($foodbakery_var_top_strip_color); ?> !important;
	    }
	    <?php
	}

	if (isset($foodbakery_var_top_strip_bgcolor) && $foodbakery_var_top_strip_bgcolor != '') {
	    ?>
	    /*TopBar Background Color*/

	    #header .top-bar {
	    background: <?php echo foodbakery_allow_special_char($foodbakery_var_top_strip_bgcolor); ?> !important;
	    }
	    <?php
	}

	if (isset($foodbakery_var_submenu_bgcolor) && $foodbakery_var_submenu_bgcolor != '') {
	    ?>
	    /*Dropdown and Megamenu Background Color*/

	    #header .main-navigation ul ul,
	    .main-navigation ul li.mega-dropdown-lg ul,
	    .main-navigation ul li.mega-menu ul.mega-dropdown-lg:before,
	    #header .mega-menu .mega-dropdown-lg.has-border > li:before,
	    .main-navigation ul li.mega-menu ul.mega-dropdown-lg:after,
	    #header .main-navigation ul ul ul li:hover > a,
	    ul.mega-dropdown-lg .menu-loader:before,
	    #header .main-navigation ul .mega-dropdown-post .swiper-loader
	    { background-color:<?php echo foodbakery_allow_special_char($foodbakery_var_submenu_bgcolor); ?> !important; }
	    <?php
	}



	if (isset($foodbakery_var_header_bgcolor) && $foodbakery_var_header_bgcolor != '') {
	    ?>

	    /*Header Background Color*/

	    #header .main-header
	    {
	    background-color:<?php echo foodbakery_allow_special_char($foodbakery_var_header_bgcolor); ?> !important;
	    }

	    <?php
	}

	if (isset($foodbakery_var_submenu_color) && $foodbakery_var_submenu_color != '') {
	    ?>
	    /*1st level Dropdown Link Color*/
	    #header .main-navigation ul ul li a,
	    #header .main-navigation ul ul li.menu-item-has-children > a:after,
	    {color:<?php echo foodbakery_allow_special_char($foodbakery_var_submenu_color); ?> !important;}
	    <?php
	}
	if (isset($foodbakery_var_submenu_2nd_level_color) && $foodbakery_var_submenu_2nd_level_color != '') {
	    ?>
	    /*2nd Level Menu link Color*/

	    #header .main-navigation ul ul li a,
	    #header .main-navigation ul ul ul li a
	    {color:<?php echo foodbakery_allow_special_char($foodbakery_var_submenu_2nd_level_color); ?> !important;}
	    <?php
	}
	if (isset($foodbakery_var_submenu_hover_color) && $foodbakery_var_submenu_hover_color != '') {
	    ?>

	    /*Submenu Hover Colors*/

	    #header .main-navigation ul ul li:hover > a,
	    #header .main-navigation ul li.current-menu-parent ul li.current-menu-item:hover > a,
	    #header .main-navigation ul li.current-menu-ancestor ul li.current-menu-item > a,
	    #header .main-navigation ul li.current-menu-ancestor ul li.current-menu-item > a:after,
	    #header .main-navigation ul li.current-menu-ancestor ul li.current-menu-ancestor > a,
	    #header .main-navigation ul li.current-menu-ancestor ul li.current-menu-ancestor > a:after {
	    color:<?php echo foodbakery_allow_special_char($foodbakery_var_submenu_hover_color); ?> !important;}

	    <?php
	}


	if (isset($foodbakery_var_menu_color) && $foodbakery_var_menu_color != '') {
	    ?>
	    /*Navigation-Menu Link Color*/
	    #header .main-navigation ul li > a,
	    #header .main-navigation ul li.menu-item-has-children > a:after,
        .transparent-header .user-dashboard-menu > ul > li > a,
        .transparent-header .user-dashboard-menu > ul > li.user-dashboard-menu-children > a:after
	    { color:<?php echo foodbakery_allow_special_char($foodbakery_var_menu_color); ?> !important;}
	    <?php
	}
	if (isset($foodbakery_var_menu_active_color) && $foodbakery_var_menu_active_color != '') {
	    ?>
	    /*Navigation-Menu Hover Link Color*/
	    #header .main-navigation ul li:hover > a,
	    #header .main-navigation ul li.menu-item-has-children:hover > a:after,
	    #header .main-navigation ul li.current-menu-ancestor > a,
	    #header .main-navigation ul li.current-menu-ancestor > a:after,
	    #header .main-navigation ul li.current-menu-item > a,
	    #header .main-navigation ul li.current-menu-item > a:after
	    { color:<?php echo foodbakery_allow_special_char($foodbakery_var_menu_active_color); ?> !important; }
	    <?php
	}
	if (isset($foodbakery_var_menu_hover_bg_color) && $foodbakery_var_menu_hover_bg_color != '') {
	    ?>
	    /*Menu Link hover background-color*/

	    #header .main-navigation ul li:hover > a,
	    #header .main-navigation ul li.current-menu-ancestor > a,
	    #header .main-navigation ul li.current-menu-item > a,
	    .home #header .main-navigation ul li.current-menu-item:hover > a,
	    #header .main-navigation ul ul,
	    #header .main-navigation ul ul ul li:hover > a
	    { background:<?php echo foodbakery_allow_special_char($foodbakery_var_menu_hover_bg_color); ?> !important; }
	    <?php
	}

	if (isset($foodbakery_var_submenu_2nd_level_bgcolor) && $foodbakery_var_submenu_2nd_level_bgcolor != '') {
	    ?>
	    /*DropDown 2nd Level Background-Color*/
	    #header .main-navigation ul ul ul,
	    #header .main-navigation ul li.current-menu-ancestor ul li.current-menu-item > a,
	    #header .main-navigation ul li.current-menu-ancestor ul li.current-menu-ancestor > a,
	    #header .main-navigation ul ul,
	    #header .main-navigation ul ul ul li:hover > a
	    { background:<?php echo foodbakery_allow_special_char($foodbakery_var_submenu_2nd_level_bgcolor); ?> !important; }
	    <?php
	}


	if (isset($foodbakery_var_widget_color) && $foodbakery_var_widget_color != '') {
	    ?>
	    .page-sidebar .widget-title h3, .page-sidebar .widget-title h4, .page-sidebar .widget-title h5, .page-sidebar .widget-title h6{
	    color:<?php echo foodbakery_allow_special_char($foodbakery_var_widget_color); ?> !important;
	    }<?php
	}
	if (isset($foodbakery_var_widget_color) && $foodbakery_var_widget_color != '') {
	    ?>
	    .section-sidebar .widget-title h3, .section-sidebar .widget-title h4, .section-sidebar .widget-title h5, .section-sidebar .widget-title h6{
	    color:<?php echo foodbakery_allow_special_char($foodbakery_var_widget_color); ?> !important;
	    }
	    <?php
	}
	/**
	 * @Set Footer Colors
	 *
	 *
	 */
	$foodbakery_var_footerbg_color = (isset($foodbakery_var_options['foodbakery_var_footerbg_color']) and $foodbakery_var_options['foodbakery_var_footerbg_color'] <> '') ? $foodbakery_var_options['foodbakery_var_footerbg_color'] : '';
	$foodbakery_var_copyright_bg_color = (isset($foodbakery_var_options['foodbakery_var_copyright_bg_color']) and $foodbakery_var_options['foodbakery_var_copyright_bg_color'] <> '') ? $foodbakery_var_options['foodbakery_var_copyright_bg_color'] : '';
	$foodbakery_var_widget_bg_color = (isset($foodbakery_var_options['foodbakery_var_widget_bg_color']) and $foodbakery_var_options['foodbakery_var_widget_bg_color'] <> '') ? $foodbakery_var_options['foodbakery_var_widget_bg_color'] : '';

	$foodbakery_var_footerbg_image = (isset($foodbakery_var_options['foodbakery_var_footer_background_image']) and $foodbakery_var_options['foodbakery_var_footer_background_image'] <> '') ? $foodbakery_var_options['foodbakery_var_footer_background_image'] : '';

	$foodbakery_var_footer_text_color = (isset($foodbakery_var_options['foodbakery_var_footer_text_color']) and $foodbakery_var_options['foodbakery_var_footer_text_color'] <> '') ? $foodbakery_var_options['foodbakery_var_footer_text_color'] : '';
	$foodbakery_var_link_color = (isset($foodbakery_var_options['foodbakery_var_link_color']) and $foodbakery_var_options['foodbakery_var_link_color'] <> '') ? $foodbakery_var_options['foodbakery_var_link_color'] : '';
	$foodbakery_var_sub_footerbg_color = (isset($foodbakery_var_options['foodbakery_var_sub_footerbg_color']) and $foodbakery_var_options['foodbakery_var_sub_footerbg_color'] <> '') ? $foodbakery_var_options['foodbakery_var_sub_footerbg_color'] : '';

	$foodbakery_var_copyright_text_color = (isset($foodbakery_var_options['foodbakery_var_copyright_text_color']) and $foodbakery_var_options['foodbakery_var_copyright_text_color'] <> '') ? $foodbakery_var_options['foodbakery_var_copyright_text_color'] : '';

	$foodbakery_var_copyright_bg_color = (isset($foodbakery_var_options['foodbakery_var_copyright_bg_color']) and $foodbakery_var_options['foodbakery_var_copyright_bg_color'] <> '') ? $foodbakery_var_options['foodbakery_var_copyright_bg_color'] : '';


	/* Footer */

	/* Footer BackgroundImage */
	if (isset($foodbakery_var_footerbg_image) && $foodbakery_var_footerbg_image != '') {
	    echo 'dsfsdfasdf';
	    ?>
	    #footer .cs-footer-widgets {
	    background: url(<?php echo esc_url($foodbakery_var_footerbg_image); ?>) no-repeat !important;
	    background-size: cover !important;
	    }
	    <?php
	}
	if (isset($foodbakery_var_footerbg_color) && $foodbakery_var_footerbg_color != '') {
	    ?>
	    /*Footer Background Color*/

	    #footer .footer-widget { background-color:<?php echo foodbakery_allow_special_char($foodbakery_var_footerbg_color); ?> !important; }
	    <?php
	}

	if (isset($foodbakery_var_footerbg_color) && $foodbakery_var_footerbg_color != '') {
	    ?>
	    /*Footer Background Color*/
	    #footer .cs-footer-widgets { background-color: <?php echo foodbakery_allow_special_char($foodbakery_var_custom_footer_background); ?> !important; }
	    <?php
	}

	if (isset($foodbakery_var_sub_footerbg_color) && $foodbakery_var_sub_footerbg_color != '') {
	    ?>
	    footer#footer-sec, footer.group:before { background-color:<?php echo foodbakery_allow_special_char($foodbakery_var_sub_footerbg_color); ?> !important; }
	    <?php
	}
	if (isset($foodbakery_var_footer_text_color) && $foodbakery_var_footer_text_color != '') {
	    ?>
	    /*Footer Text Color*/

	    #footer .footer-widget p, .custom-container
	    {color:<?php echo foodbakery_allow_special_char($foodbakery_var_footer_text_color); ?> !important;}
	    <?php
	}
	if (isset($foodbakery_var_copyright_text_color) && $foodbakery_var_copyright_text_color != '') {
	    ?>
	    /*Footer Copyright-text Color*/

	    #footer.modern-v1 .cs-copyright p a,
	    #footer.modern-v1 .cs-copyright .btn-top a,
	    #footer .cs-copyright a,
	    #footer .copy-right p,
	    #footer .cs-copyright p a,
	    #footer .cs-copyright .btn-top a
	    {
	    color:<?php echo foodbakery_allow_special_char($foodbakery_var_copyright_text_color); ?> !important;
	    }
	<?php }if (isset($foodbakery_var_link_color) && $foodbakery_var_link_color != '') { ?>
	    /*Footer Link Color*/

	    #footer .footer-widget a,
	    #footer .cs-footer-widgets a i,
	    #footer .footer-widget .widget ul li span,
	    #footer .footer-widget .widget ul li i,
	    #footer .widget.widget-related-post .related-post-holder.classic .text-holder span,
	    #footer .textwidget
	    {
	    color:<?php echo foodbakery_allow_special_char($foodbakery_var_link_color); ?> !important;
	    }<?php
	}
	if (isset($foodbakery_var_copyright_bg_color) && $foodbakery_var_copyright_bg_color != '') {
	    ?>
	    /*Footer Copyright Background Color*/

	    #footer .copy-right,
	    #footer.modern-v1 .cs-copyright {background-color:<?php echo foodbakery_allow_special_char($foodbakery_var_copyright_bg_color); ?> !important;}
	    <?php
	}

	if (isset($foodbakery_var_copyright_bg_color) && $foodbakery_var_copyright_bg_color != '') {
	    ?>
	    /*Footer Copyright Background Color*/

	    #footer .copyright-sec,
	    #footer.modern-v1 .cs-copyright {background-color:<?php echo foodbakery_allow_special_char($foodbakery_var_copyright_bg_color); ?> !important;}
	    <?php
	}



	$foodbakery_var_custom_themeoption_str = ob_get_clean();
	return $foodbakery_var_custom_themeoption_str;
    }

}