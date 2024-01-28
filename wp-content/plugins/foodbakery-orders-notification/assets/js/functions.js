function foodbakery_refresh_order_listing_page(){
    jQuery.ajax({
        type: "POST",
        url: foodbakery_customization.ajax_url,
        data: 'action=foodbakery_new_order',
        success: function (response) {
            if(response == 1){
                show_orders_notification();
            }
        }
    });
    
}
jQuery(document).on("click",".foodbakery_play_new_order_alarm",function() {
    jQuery('#foodbakery_new_order_sound')[0].play();
});


function show_orders_notification(){
    console.log('test');
    jQuery.ajax({
        type: "POST",
        url: foodbakery_customization.ajax_url,
        data: 'action=show_orders_notification',
        success: function (response) {
            var response = JSON.parse(response);
            jQuery.each(jQuery(response),function(responseKey,responseData){
                var success_message = jQuery.growl.success({
                    message: responseData
                });
            });
            console.log(response.length);
            if( response.length > 0){
                jQuery(".foodbakery_play_new_order_alarm").click();
                jQuery(".user-nav-list #foodbakery_publisher_received_orders").click();
            }
        }
    });
    
}
