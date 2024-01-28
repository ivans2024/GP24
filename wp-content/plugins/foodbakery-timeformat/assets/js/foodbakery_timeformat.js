jQuery(document).ready(function () {
    /* user order tip*/
    jQuery(document).on('keyup', '#user_order_tip', function () {
        /*only numeric prevent char*/
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
        /*Calc total bill by ading tip*/
        var tip = jQuery(this).val() || 0;
        var prev_grant_total_amount = jQuery('.dev-menu-grtotal').data('grant_total');
        var latest_grant_total_amount = parseFloat(prev_grant_total_amount) + parseFloat(tip);
        jQuery('.dev-menu-grtotal').html(cs_number_format(latest_grant_total_amount));
    });

    /*Autocomplete google*/
    jQuery(document).on('keyup, keypress', '#user_delivery_address', function () {
        var ajaxurl = jQuery(this).data('ajaxurl');
        var restaurant_id = jQuery(this).data('restaurantid');
        var autocomplete;
        autocomplete = new google.maps.places.Autocomplete(this);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            /* Add Loader */
            jQuery('#user_order_tip').prop("readonly", true);
            jQuery('#coupon_number').prop("readonly", true);
            jQuery('.menu-order-confirm').addClass('input-button-loader foodbakery-processing');
            jQuery('.menu-order-confirm').append('<div class="foodbakery-button-loader" style="display: block;"><div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div>');
            var delivery_address = jQuery('#user_delivery_address').val();
            if (delivery_address != '') {
                jQuery.post(ajaxurl, {
                    'action': 'foodbakery_get_latlng_distance_delivery_address',
                    'restaurant_id': restaurant_id,
                    'delivery_address': delivery_address
                }).done(function (responce) {
                    var responce = JSON.parse(responce);

                    /* Remove Loader */
                    jQuery('#user_order_tip').prop("readonly", false);
                    jQuery('#coupon_number').prop("readonly", false);
                    jQuery('.foodbakery-button-loader').remove();
                    jQuery('.menu-order-confirm').removeClass('input-button-loader foodbakery-processing');

                    /* updat the text rate on changing delivery address */
                    jQuery('#delivery_fee_price').html(cs_number_format(responce.total_tax));
                    jQuery('#delivery_fee_price').data('confee', cs_number_format(responce.total_tax));
                    jQuery('#delivery_fee_price').data('fee', cs_number_format(responce.total_tax));

                    /* change the grand total afrer changing delivery address */
                    jQuery('#delivery_fee_price_li').remove();
                    if ($('.categories-order li').length > 0 && responce.total_tax != '') {
                        var sub_total = jQuery('.dev-menu-subtotal').html() || 0;
                        var coupon_discount_price = jQuery('#coupon_discount_price').html() || 0;
                        var deliveryfee = jQuery('.dev-menu-deliveryfee').data('fee');
                        var charger_deliveryfee = 0;
                        if(typeof deliveryfee != 'undefined'){
                            charger_deliveryfee = deliveryfee;
                        }
                        var grand_total = parseFloat(sub_total) + parseFloat(coupon_discount_price) + parseFloat(responce.total_tax) + parseFloat(charger_deliveryfee);
                        jQuery('.dev-menu-grtotal').data('grant_total', cs_number_format(grand_total));
                        jQuery('.dev-menu-grtotal').html(cs_number_format(grand_total));

                        var li_list = '<li class="restaurant-fee-con" id="delivery_fee_price_li"><span class="fee-title">Delivery Fee Per Mile</span><span class="price">£<em id="delivery_fee_price" class="dev-menu-charges" data-confee="' + responce.total_tax + '" data-fee="' + responce.total_tax + '">' + responce.total_tax + '</em></span></li>';
                        $('.dev-menu-subtotal').parent().parent().after(li_list);
                    }

                    jQuery("#user_order_tip").keyup()
                    var response = {
                        type: responce.status,
                        msg: responce.msg,
                    };
                    foodbakery_show_response(response);
                });
            }
            return false;
        });
    });

    /*number only validation for coupon ammount*/
    jQuery(document).on('keyup', '#foodbakery_restaurant_coupon_amount, #foodbakery_restaurant_limit_per_coupon, #foodbakery_restaurant_limit_per_user', function () {
        /*only numeric prevent char*/
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    /*submit coupons*/
    jQuery(document).on('click', '#add_coupon', function () {
        var $this = jQuery(this);
        /*loader*/
        $this.addClass('input-button-loader foodbakery-processing');
        $this.append('<div class="foodbakery-button-loader" style="display: block;"><div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div>');
        var ajaxurl = jQuery(this).data('ajaxurl');

        jQuery.post(ajaxurl, jQuery('#coupon_submit_form').serialize() + '&action=' + 'foodbakery_save_restautant_coupon').done(function (responce) {
            var responce = JSON.parse(responce);
            /*remmove loader*/
            $this.removeClass('input-button-loader foodbakery-processing');
            jQuery('.foodbakery-button-loader').remove();
            var response = {
                type: responce.type,
                msg:  responce.msg,
            };
            foodbakery_show_response(response);
            if(responce.type == 'success'){
                /*refresh list of coupon*/
                jQuery('#foodbakery_restautant_coupon').trigger('click');
            }
            return false;
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
                    var response = {
                        type: 'success',
                        msg: 'Delete successfully',
                    };
                    foodbakery_show_response(response);
                }
                $this.removeClass('input-button-loader foodbakery-processing');
                jQuery('.foodbakery-button-loader').remove();
                return false;
            });
        }
    });

    /*get coupan*/
    jQuery(document).on('click', '.coupan_get', function () {
        var $this = jQuery(this);
        /*loader edit button in a list*/
        $this.addClass('input-button-loader foodbakery-processing');
        $this.append('<div class="foodbakery-button-loader" style="display: block;"><div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div>');

        /* Empty All form first */
        jQuery('#coupon_submit_form').find("input[type=text], textarea, select").val("");
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
                if (!jQuery("#coupon_submit_form").hasClass("in")) {
                    jQuery('#coupon_submit_form').addClass('in');
                }

                var res = JSON.parse(res);
                jQuery('#foodbakery_restaurant_coupon_name').val(res.coupon_tittle);
                jQuery('#foodbakery_restaurant_coupon_type').val(res.foodbakery_restaurant_coupon_type).change();
                jQuery('#foodbakery_restaurant_coupon_amount').val(res.restaurant_coupon_amount);
                jQuery('#foodbakery_restaurant_coupon_expiry').val(res.foodbakery_restaurant_coupon_expiry);
                jQuery('#foodbakery_restaurant_limit_per_coupon').val(res.restaurant_limit_per_coupon);
                jQuery('#foodbakery_restaurant_limit_per_user').val(res.restaurant_limit_per_user);
                jQuery('#foodbakery_restaurant_coupon_desc').val(res.foodbakery_restaurant_coupon_desc);
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

    /* Make collaspe add coupon*/
    jQuery(document).on('click', '#show_add_coupon_form', function () {
        /* Empty All form first */
        jQuery('#coupon_submit_form').find("input[type=text], textarea, select").val("");
        jQuery('#add_coupon').removeClass('hide');
        if (!jQuery('#edit_coupon').hasClass('hide')) {
            jQuery('#edit_coupon').addClass('hide');
        }
        /*change the main tittle*/
        jQuery('#coupon_submit_form h5:first').html('Add Coupon');
    });

    /*Edit coupan*/
    jQuery(document).on('click', '#edit_coupon', function () {
        var $this = jQuery(this);
        /*loader*/
        $this.addClass('input-button-loader foodbakery-processing');
        $this.append('<div class="foodbakery-button-loader" style="display: block;"><div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div>');

        var ajaxurl = $this.data('ajaxurl');
        var couponid = $this.data('couponid');

        jQuery.post(ajaxurl, jQuery('#coupon_submit_form').serialize() + '&couponid=' + couponid + '&action=foodbakery_edit_restautant_coupon').done(function (res) {
            if (res) {
               var responce =  JSON.parse(res);
                /*remmove loader*/
                $this.removeClass('input-button-loader foodbakery-processing');
                jQuery('.foodbakery-button-loader').remove();
                var response = {
                    type: responce.type,
                    msg:  responce.msg,
                };
                foodbakery_show_response(response);
                if(responce.type == 'success'){
                    /*refresh list of coupon*/
                    jQuery('#foodbakery_restautant_coupon').trigger('click');
                }
                return false;
            }
        });
    });

    /*Apply coupan*/
    jQuery(document).on('click', '#user_discount_coupon_apply', function () {

        if (jQuery('#user_delivery_address').val() == '') {
            alert('Please Enter Delivery Address First');
            return false;
        }

        var $this = jQuery(this);
        /*loader*/
        jQuery('#user_order_tip').prop("readonly", true);
        jQuery('#coupon_number').prop("readonly", true);
        $this.addClass('input-button-loader foodbakery-processing');
        $this.append('<div class="foodbakery-button-loader" style="display: block;"><div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div>');

        var ajaxurl = $this.data('ajaxurl');
        var restaurant_id = $this.data('restaurant_id');
        var coupon_number = jQuery('#coupon_number').val();

        var sub_total = jQuery('.dev-menu-subtotal').html() || 0;
        var delivery_fee_price = jQuery('#delivery_fee_price').html() || 0;
        var deliveryfee = jQuery('.dev-menu-deliveryfee').data('fee');
        var charger_deliveryfee = 0;
        if(typeof deliveryfee != 'undefined'){
            charger_deliveryfee = deliveryfee;
        }
        var total_price_exluding_tip = parseFloat(charger_deliveryfee) + parseFloat(delivery_fee_price) + parseFloat(sub_total);
        jQuery.post(ajaxurl, {
            'coupon_number': coupon_number,
            'restaurant_id': restaurant_id,
            'total_price_exluding_tip': total_price_exluding_tip,
            'action': 'foodbakery_apply_restautant_coupon'
        }).done(function (res) {
            if (res) {
                var res = JSON.parse(res);

                var coupon_discount_price = res.coupon_discount_price;
                var dicount_percent = 0;
                var dicount_percent_show = '';

                if (res.foodbakery_restaurant_coupon_type = 'percentage_discount') {
                    var dicount_percent = res.restaurant_coupon_amount;
                }

                /* show percentage */
                if (dicount_percent != 0) {
                    var dicount_percent_show = dicount_percent + '% | ';
                }
                /*remmove loader*/
                $this.removeClass('input-button-loader foodbakery-processing');
                jQuery('.foodbakery-button-loader').remove();
                jQuery('#user_order_tip').prop("readonly", false);
                jQuery('#coupon_number').prop("readonly", false);
                if (res.status == 'success') {
                    /* add in the list */
                    /*unset couper price from the above list*/
                    jQuery('#coupon_discount_price_li').remove();
                    if ($('.categories-order li').length > 0 && coupon_discount_price != '') {
                        var sub_total = jQuery('.dev-menu-subtotal').html() || 0;
                        var delivery_fee_price = jQuery('#delivery_fee_price').html() || 0;

                        var grand_total = parseFloat(sub_total) + parseFloat(delivery_fee_price) + parseFloat(charger_deliveryfee) - parseFloat(coupon_discount_price);
                        jQuery('.dev-menu-grtotal').data('grant_total', cs_number_format(grand_total));
                        jQuery('.dev-menu-grtotal').html(cs_number_format(grand_total));
                        var li_list = '<li class="restaurant-fee-con" id="coupon_discount_price_li"><span class="fee-title">Coupon Discount</span><span class="price">£<em id="coupon_discount_price" class="dev-menu-coupon" data-confee="' + coupon_discount_price + '" data-fee="' + coupon_discount_price + '">' + cs_number_format(coupon_discount_price) + '</em></span></li>';
                        $('.dev-menu-subtotal').parent().parent().after(li_list);
                    }
                    jQuery("#user_order_tip").keyup();
                    var response = {
                        type: 'success',
                        msg: 'Coupon Apply successfully',
                    };
                    foodbakery_show_response(response);
                    return true;
                } else if (res.status == 'error') {
                    if ($('.categories-order li').length > 0 && coupon_discount_price != '' && jQuery('#coupon_discount_price_li').length == 1) {
                        var discount_price = jQuery('#coupon_discount_price').data('fee') || 0;
                        var grand_total = jQuery('.dev-menu-grtotal').data('grant_total');

                        var grand_total = parseFloat(grand_total) + parseFloat(discount_price);
                        jQuery('.dev-menu-grtotal').data('grant_total', cs_number_format(grand_total));
                        jQuery('.dev-menu-grtotal').html(cs_number_format(grand_total));

                        /*unset couper price from the above list*/
                        jQuery('#coupon_discount_price_li').remove();
                    }
                    var response = {
                        type: 'error',
                        msg: res.msg,
                    };
                    foodbakery_show_response(response);
                    return false;
                }

            }
        });

    });

});