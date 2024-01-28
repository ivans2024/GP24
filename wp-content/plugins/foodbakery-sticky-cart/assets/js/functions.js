jQuery(document).ready(function () {
    /*open model*/
    jQuery('.toggle-btn').click(function () {
        jQuery(".menu-orders-holder").toggleClass("open");
    });

    /*close model */
    jQuery(document).on('click', '.orders-list-close', function () {
        $(".footer-cart-bar").removeClass("open");
    });

    /*on click on cart fee type auto select the fee type for both mobile and destop view*/
    $('input[type=radio][name=order_fee_type_cart]').change(function() {
        var fee_type_val = $(this).val();
        if(fee_type_val == 'pickup'){
            $("#order-pick-up-fee").prop("checked", true);
        }else if (fee_type_val == 'delivery'){
            $("#order-delivery-fee").prop("checked", true);
        }
    });

    $('input[type=radio][name=order_fee_type]').change(function() {
        var fee_type_val = $(this).val();
        if(fee_type_val == 'pickup'){
            $("#sticky-order-pick-up-fee").prop("checked", true);
        }else if (fee_type_val == 'delivery'){
            $("#sticky-order-delivery-fee").prop("checked", true);
        }
    });

    /*on click on cart payment types auto select the payment type for both mobile and destop view*/
    $('input[type=radio][name=sticky-order_payment_method]').change(function() {
        var payment_type = $(this).val();
        if(payment_type == 'card'){
            $("#order-card-payment").prop("checked", true);
        }else if (payment_type == 'cash'){
            $("#order-cash-payment").prop("checked", true);
        }
    });

    $('input[type=radio][name=order_payment_method]').change(function() {
        var payment_type = $(this).val();
        if(payment_type == 'card'){
            $("#sticky-order-card-payment").prop("checked", true);
        }else if (payment_type == 'cash'){
            $("#sticky-order-cash-payment").prop("checked", true);
        }
    });

});