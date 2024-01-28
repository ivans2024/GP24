jQuery(document).ready(function () {
    jQuery('#coupon_submit').slideUp();
    /*onclick coupon for admin*/
    jQuery(document).on('click', '#show_add_coupon', function () {
        jQuery('#coupon_submit').slideToggle();
        /* Empty All form first */
        jQuery('#coupon_submit').find("input[type=text], textarea, select").val("");
        jQuery('#add_coupon').removeClass('hide');
        if (!jQuery('#edit_coupon').hasClass('hide')) {
            jQuery('#edit_coupon').addClass('hide');
        }
        /*change the main tittle*/
        jQuery('#coupon_submit_form h5:first').html('Add Coupon');
    });

    /*get coupan*/
    jQuery(document).on('click', '.coupan_get', function () {
        var $this = jQuery(this);
        /*loader edit button in a list*/
        $this.addClass('input-button-loader foodbakery-processing');
        $this.append('<div class="foodbakery-button-loader" style="display: block;"><div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div>');

        /* Empty All form first */
        jQuery('#coupon_submit').find("input[type=text], textarea, select").val("");
        jQuery('#edit_coupon').removeClass('hide');
        if (!jQuery('#add_coupon').hasClass('hide')) {
            jQuery('#add_coupon').addClass('hide');
        }
        /*loader submit edit button*/
        jQuery('#edit_coupon').addClass('input-button-loader foodbakery-processing');
        jQuery('#edit_coupon').append('<div class="foodbakery-button-loader" style="display: block;"><div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div>');

        /*change the main tittle*/
        jQuery('#coupon_submit_form h5:first').html('Edit Coupon');

        var ajaxurl = $this.data('ajaxurl');
        var couponid = $this.data('couponid');
        jQuery.post(ajaxurl, {'couponid': couponid, 'action': 'foodbakery_get_restautant_coupon'}).done(function (res) {
            if (res) {

                /* open collaspe box for edit */
                jQuery('#coupon_submit').slideDown();

                var res = JSON.parse(res);
                jQuery('#foodbakery_restaurant_coupon_name').val(res.coupon_tittle);
                jQuery('#foodbakery_restaurant_coupon_type').val(res.foodbakery_restaurant_coupon_type).change();
                jQuery('#foodbakery_restaurant_coupon_amount').val(res.restaurant_coupon_amount);
                jQuery('#foodbakery_restaurant_coupon_expiry').val(res.foodbakery_restaurant_coupon_expiry);
                jQuery('#foodbakery_restaurant_limit_per_coupon').val(res.restaurant_limit_per_coupon);
                jQuery('#foodbakery_restaurant_limit_per_user').val(res.restaurant_limit_per_user);
                jQuery('#foodbakery_restaurant_coupon_desc').val(res.foodbakery_restaurant_coupon_desc);
                jQuery('#foodbakery_restaurant_coupon_code').val(res.foodbakery_restaurant_coupon_code);
                jQuery('#edit_coupon').data('couponid', couponid);
                /*remmove loader*/
                $this.removeClass('input-button-loader foodbakery-processing');
                ;
                jQuery('#edit_coupon').removeClass('input-button-loader foodbakery-processing');
                jQuery('.foodbakery-button-loader').remove();
            }
            return false;
        });
    });

    /*Edit coupan*/
    jQuery(document).on('click', '#edit_coupon', function () {
        var $this = jQuery(this);
        /*loader*/
        $this.addClass('input-button-loader foodbakery-processing');
        $this.append('<div class="foodbakery-button-loader" style="display: block;"><div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div>');

        var ajaxurl = $this.data('ajaxurl');
        var couponid = $this.data('couponid');
        var form_data = jQuery('#coupon_submit input').serialize() + '&' + jQuery('#coupon_submit select').serialize() + '&' + jQuery('#coupon_submit textarea').serialize();
        jQuery.post(ajaxurl, form_data + '&couponid=' + couponid + '&action=foodbakery_edit_restautant_admin_coupon').done(function (res) {
            if (res) {
                /*remmove loader*/
                $this.removeClass('input-button-loader foodbakery-processing');
                jQuery('.foodbakery-button-loader').remove();

                var responce = JSON.parse(res);

                var alert_success = '<div class="alert alert-success alert-notifications">'+responce.msg+' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size:20px">×</span></button></div>';
                var alert_danger = '<div class="alert alert-danger alert-notifications">'+responce.msg+' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size:20px">×</span></button></div>';
                jQuery('.alert-notifications').remove();

                if (responce.type == 'success') {
                    /*remove li*/
                    jQuery('#'+responce.restaurant_coupon_id).remove();
                    var list_html = '<li id="' + responce.restaurant_coupon_id + '" class="coupon-order-heading-data">\n' +
                        '<div>' + responce.restaurant_coupon_id + '</div>\n' +
                        '<div>' + responce.restaurant_coupon_name + '</div>\n' +
                        '<div>' + responce.foodbakery_restaurant_coupon_type + '</div>\n' +
                        '<div>' + responce.restaurant_coupon_amount + '</div>\n' +
                        '<div>' + responce.foodbakery_restaurant_coupon_expiry + '</div>\n' +
                        '<div>' + responce.foodbakery_restaurant_coupon_code + '</div>\n' +
                        '<div>\n' +
                        '<a href="javascript:void()" type="button" data-couponid="' + responce.restaurant_coupon_id + '" data-ajaxurl="' + responce.ajax_url + '" class="coupan_del"><i class="icon-trash-o"></i></a>\n' +
                        '<a href="javascript:void()" type="button" data-couponid="' + responce.restaurant_coupon_id + '" data-ajaxurl="' + responce.ajax_url + '" class="coupan_get"><i class="icon-edit"></i>\n' +
                        '</a>\n' +
                        '</div>\n' +
                        '</li>';
                    jQuery('.restaurant-menu-coupan-list').after().append(list_html);
                    jQuery('#tab-menu-restaurant-coupon .theme-help').after(alert_success);
                    jQuery('#coupon_submit').slideUp();

                }
                if (responce.type == 'error') {
                    jQuery('#tab-menu-restaurant-coupon .theme-help').after(alert_danger);
                }
                return false;
            }
        });
    });

    /*delete coupan*/
    jQuery(document).on('click', '.coupan_del', function () {
        var check = confirm('Are you sure to delete coupon?');
        if (check == true) {
            var $this = jQuery(this);
            $this.addClass('input-button-loader foodbakery-processing');
            $this.append('<div class="foodbakery-button-loader" style="display: block;"><div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div>');

            var ajaxurl = jQuery(this).data('ajaxurl');
            var couponid = jQuery(this).data('couponid');
            var $this = jQuery(this);
            jQuery.post(ajaxurl, {
                'couponid': couponid,
                'action': 'foodbakery_del_restautant_coupon'
            }).done(function (res) {
                if (res) {
                    $this.parents('li').remove();
                    var alert_success = '<div class="alert alert-success alert-notifications">Coupon deleted successfuly. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size:20px">×</span></button></div>';
                    jQuery('#tab-menu-restaurant-coupon .theme-help').after(alert_success);
                }
                $this.removeClass('input-button-loader foodbakery-processing');
                jQuery('.foodbakery-button-loader').remove();
                return false;
            });
        }
    });

    /*submit coupons*/
    jQuery(document).on('click', '#add_coupon', function () {
        var $this = jQuery(this);

        /*loader*/
        $this.addClass('input-button-loader foodbakery-processing');
        var restaurant_id = jQuery('#post_ID').val();
        $this.append('<div class="foodbakery-button-loader" style="display: block;"><div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div>');
        var ajaxurl = jQuery(this).data('ajaxurl');
        var form_data = jQuery('#coupon_submit input').serialize() + '&' + jQuery('#coupon_submit select').serialize() + '&' + jQuery('#coupon_submit textarea').serialize();
        jQuery.post(ajaxurl, form_data + '&restaurant_id=' + restaurant_id + '&action=' + 'foodbakery_save_restautant_coupon_admin').done(function (responce) {
            /*remmove loader*/
            $this.removeClass('input-button-loader foodbakery-processing');
            jQuery('.foodbakery-button-loader').remove();
            var responce = JSON.parse(responce);

            var alert_success = '<div class="alert alert-success alert-notifications">'+responce.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size:20px">×</span></button></div>';
            var alert_danger = '<div class="alert alert-danger alert-notifications">'+responce.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size:20px">×</span></button></div>';
            jQuery('.alert-notifications').remove();

            if (responce.type == 'success') {

                var coupon_id_input = $('input[name="coupon_id"]').val();
                coupon_id_input = coupon_id_input + ', ' + responce.restaurant_coupon_id;
                $('input[name="coupon_id"]').val(coupon_id_input);

                var list_html = '<li class="coupon-order-heading-data">\n' +
                    '<div>' + responce.restaurant_coupon_id + '</div>\n' +
                    '<div>' + responce.restaurant_coupon_name + '</div>\n' +
                    '<div>' + responce.foodbakery_restaurant_coupon_type + '</div>\n' +
                    '<div>' + responce.restaurant_coupon_amount + '</div>\n' +
                    '<div>' + responce.foodbakery_restaurant_coupon_expiry + '</div>\n' +
                    '<div>' + responce.foodbakery_restaurant_coupon_code + '</div>\n' +
                    '<div>\n' +
                    '<a href="javascript:void()" type="button" data-couponid="' + responce.restaurant_coupon_id + '" data-ajaxurl="' + responce.ajax_url + '" class="coupan_del"><i class="icon-trash-o"></i></a>\n' +
                    '<a href="javascript:void()" type="button" data-couponid="' + responce.restaurant_coupon_id + '" data-ajaxurl="' + responce.ajax_url + '" class="coupan_get"><i class="icon-edit"></i>\n' +
                    '</a>\n' +
                    '</div>\n' +
                    '</li>';
                jQuery('.restaurant-menu-coupan-list').after().append(list_html);
                jQuery('#tab-menu-restaurant-coupon .theme-help').after(alert_success);
                jQuery('.empty_coupon_list_msg').remove();
                jQuery('#coupon_submit').slideUp();
            }
            if (responce.type == 'error') {
                jQuery('#tab-menu-restaurant-coupon .theme-help').after(alert_danger);
            }
            return false;
        });
    });

    /*Datepiker*/
    jQuery('#foodbakery_restaurant_coupon_expiry').datetimepicker({
        format: 'd-m-Y H:i',
        timepicker: true,
        step: 15
    });

    /*number only validation for coupon ammount*/
    jQuery(document).on('keyup', '#foodbakery_restaurant_coupon_amount, #foodbakery_restaurant_limit_per_coupon, #foodbakery_restaurant_limit_per_user', function () {
        /*only numeric prevent char*/
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

});