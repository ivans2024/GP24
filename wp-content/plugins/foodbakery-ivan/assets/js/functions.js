function foodbakery_refresh_order_listing_page() {
    if (jQuery(".orders-notification").length < 1) {
        jQuery.ajax({
            type: "POST",
            url: foodbakery_ivan.ajax_url,
            data: 'action=foodbakery_new_order',
            success: function (response) {
                if (response == 1) {
                    show_orders_notification();
                }
            }
        });
    }
}

jQuery(document).on("click", ".foodbakery_play_new_order_alarm", function () {
    jQuery('#foodbakery_new_order_sound')[0].play();
});


jQuery(document).on("click", ".acknowledge_btn", function () {
    jQuery(".acknowledge_btn").prop( "disabled", true );
    jQuery(".acknowledge_btn").html("&nbsp;<i class='icon-spinner8 icon-spin'></i>");
    var order_id = jQuery(this).data('order_id');
    jQuery.ajax({
        type: "POST",
        url: foodbakery_ivan.ajax_url,
        data: 'order_id=' + order_id + '&action=foodbakery_acknowledge_order',
        success: function (response) {
            jQuery('#foodbakery_new_order_sound')[0].pause();
            jQuery("#orders-notification").modal('hide');
            jQuery(".orders-notification").remove();
            jQuery(".modal-backdrop").remove();
        }
    });

});

function show_orders_notification() {
    jQuery.ajax({
        type: "POST",
        url: foodbakery_ivan.ajax_url,
        data: 'action=show_orders_notification',
        success: function (response) {
            if( response != ''){
                jQuery("body").append(response);
                jQuery("#orders-notification").modal('show');
                jQuery(".foodbakery_play_new_order_alarm").click();
                jQuery(".user-nav-list #foodbakery_publisher_received_orders").click();
            }
        }
    });

}

