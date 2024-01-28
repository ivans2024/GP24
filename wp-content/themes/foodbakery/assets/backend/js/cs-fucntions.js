var $ = jQuery;

if (jQuery('body.rtl a.cs-help').length != '') {
	jQuery('body.rtl a.cs-help').attr("data-placement", "left");
	jQuery('body.rtl a.cs-help').attr("data-trigger", "click");
	
}	    


/*
 * Media Upload 
 */
jQuery(document).on("click", ".cs-foodbakery-media", function () {
    "use strict";
    var $ = jQuery;
    var id = $(this).attr("name");
    var custom_uploader = wp.media({
        title: 'Select File',
        button: {
            text: 'Add File'
        },
        multiple: false
    }).on('select', function () {
        var attachment = custom_uploader.state().get('selection').first().toJSON();
        jQuery('#' + id).val(attachment.url);
        jQuery('#' + id + '_img').attr('src', attachment.url);
        jQuery('#' + id + '_box').show();
    }).open();

});

jQuery(document).on("click", ".cs-foodbakery-media-multi", function () {
    "use strict";
    var $ = jQuery;
    var thisObj = jQuery(this);
    
    
    var section_index = thisObj.closest('.foodbakery-section-block').index();
    var total_sections = $('.foodbakery-section-block').length;
    total_sections  = parseInt(total_sections) + 1;
    section_index   = parseInt(section_index) - parseInt(total_sections);
    section_index  = ( section_index < 0 || section_index == '')? 0 : section_index;
    var id = $(this).attr("name");
    var custom_uploader = wp.media({
        title: 'Select File',
        button: {
            text: 'Add File'
        },
        multiple: true
    }).on('select', function () {
        var attachment = custom_uploader.state().get('selection').first().toJSON();
        var attachments = custom_uploader.state().get('selection').toJSON();
        jQuery.each(attachments, function(index, attachment_data) {
            var attachment_id = attachment_data.id;
            var url = attachment_data.url;
            if( attachment_id > 0){
                var attachment_id_index = attachment_id+index;
                var html = '<li class="ui-state-default" id=""><input id="foodbakery_images_url'+attachment_id_index+'" name="foodbakery_images_url['+section_index+'][]" type="hidden" class="" value="'+attachment_id+'"><div class="thumb-secs"> <img src="'+url+'" id="foodbakery_var_frame_image_url'+attachment_id_index+'_img" width="100" alt="foodbakery_var_"><div class="gal-edit-opts"><a href="javascript:;" class="delete del_media_img"></a> </div></div></li>';
                thisObj.closest('.image-upload-div').find('#gal-sortable').append(html);
            }
            
        });
        jQuery('#' + id + '_box').show();
        
        
        
        //console.log(custom_uploader.state().get('selection').toJSON());
        //jQuery('#' + id).val(attachment.url);
        //jQuery('#' + id + '_img').attr('src', attachment.url);
        //jQuery('#' + id + '_box').show();
        
    }).open();

});

jQuery(document).ready(function ($) {

    "use strict";
    $('[data-toggle="popover"]').popover();
    popup_view_box();
    
    

    /*
     * CS meta fileds Tabs
     */
    var myUrl = window.location.href; //get URL
    var myUrlTab = myUrl.substring(myUrl.indexOf("#")); // For localhost/tabs.html#tab2, myUrlTab = #tab2     
    var myUrlTabName = myUrlTab.substring(0, 4); // For the above example, myUrlTabName = #tab
    jQuery("#tabbed-content > div").addClass('hidden-tab'); // Initially hide all content #####EDITED#####
    jQuery("#cs-options-tab li:first a").attr("id", "current"); // Activate first tab
    jQuery("#tabbed-content > div:first").hide().removeClass('hidden-tab').fadeIn(); // Show first tab content   #####EDITED#####
    jQuery("#cs-options-tab > li:first").addClass('active');

    jQuery(document).on("click", "#cs-options-tab li > a", function (e) {
        e.preventDefault();
        if (jQuery(this).attr("id") == "current") { //detection for current tab
            return
        } else {
            foodbakery_reset_tabs();
          //  console.log(this);
            jQuery("#cs-options-tab > li").removeClass('active')
            jQuery(this).attr("id", "current"); // Activate this
            jQuery(this).parents('li').addClass('active');
            jQuery(jQuery(this).attr('name')).hide().removeClass('hidden-tab').fadeIn(); // Show content for current tab
        }
    });

    var i;
    for (i = 1; i <= jQuery("#cs-options-tab li").length; i++) {
        if (myUrlTab == myUrlTabName + i) {
            foodbakery_reset_tabs();
            jQuery("a[name='" + myUrlTab + "']").attr("id", "current"); // Activate url tab
            jQuery(myUrlTab).hide().removeClass('hidden-tab').fadeIn(); // Show url tab content        
        }
    }

    /*
     * End CS meta fileds Tabs
     */
});
/*
 * 
 * @ function for change image on change
 */
function Foodbakery_change_image( val, div_id, img_url, rand_id ){
    "use strict";
    if ( rand_id === 'undefined' || rand_id === '' ) {
          rand_id = 0;
    } 
    var image_div_id = "#" + div_id;
    var image_url   = '';
    if( val != '' ){
        var image_url = '<img style="width:100%" src='+img_url+val+'.jpg>';
    }
    jQuery( image_div_id ).html(image_url);
    // hide/show blog views pagination/filterable fields
    if( val === 'view1' ){
        jQuery('#filter_view2_' + rand_id).show();
        jQuery('#filter_view1_' + rand_id).hide();
        jQuery('#filter_all_records_' + rand_id).hide();
    } else if( val === 'view11' || val === 'view12' || val === 'view13' ){
        jQuery('#filter_all_records_' + rand_id).show();
        jQuery('#filter_view1_' + rand_id).hide();
        jQuery('#filter_view2_' + rand_id).hide();
    }else{
        jQuery('#filter_view1_' + rand_id).show();
        jQuery('#filter_view2_' + rand_id).hide();
        jQuery('#filter_all_records_' + rand_id).hide();
    }
    // hide/show post formats fields
    if ( val == 'format-video' ) {
        jQuery('#post_format_video_url').show();
        jQuery('#sound_embedded_code').hide();
    } else if ( val == 'format-sound' ) {
        jQuery('#post_format_video_url').hide();
        jQuery('#sound_embedded_code').show();
    } else if ( val == 'format-masonary' || val == 'format-medium' || val == 'format-large' || val == 'format-small' ) {
        jQuery('#post_format_video_url').hide();
        jQuery('#sound_embedded_code').hide();
    }
}

function foodbakery_change_preview_image( val, div_id, img_url, rand_id ){
    "use strict";
    
    var image_div_id = "#" + div_id;
    
    if ( rand_id === 'undefined' || rand_id === '' ) {
          rand_id = 0;
    } 
    var image_url;
    if( val === '' ) {
        jQuery(image_div_id).fadeOut(600);
    }else{
        jQuery(image_div_id).fadeIn(600);
        image_url = img_url + val + '.jpg';
        jQuery(image_div_id).find('a').attr('href',  image_url);
        jQuery(image_div_id).find('a').attr('title', val);
        jQuery(image_div_id).find('img').attr('src', image_url);
        jQuery(image_div_id).find('img').attr('alt', val);
    }
    
    // hide/show blog views pagination/filterable fields
    if( val === 'view1' ) {
        jQuery('#filter_view2_' + rand_id).show();
        jQuery('#filter_view1_' + rand_id).hide();
        jQuery('#filter_all_records_' + rand_id).hide();
    } else if( val === 'view11' || val === 'view12' || val === 'view13' || val === 'view17' || val === 'view19' ){
        jQuery('#filter_all_records_' + rand_id).show();
        jQuery('#filter_view1_' + rand_id).hide();
        jQuery('#filter_view2_' + rand_id).hide();
    } else {
        jQuery('#filter_view1_' + rand_id).show();
        jQuery('#filter_view2_' + rand_id).hide();
        jQuery('#filter_all_records_' + rand_id).hide();
    }
    // hide/show post formats fields
    if ( val == 'format-video' ) {
        jQuery('#post_format_video_url').show();
        jQuery('#sound_embedded_code').hide();
    } else if ( val == 'format-sound' ) {
        jQuery('#post_format_video_url').hide();
        jQuery('#sound_embedded_code').show();
    } else if ( val == 'format-masonary' || val == 'format-medium' || val == 'format-large' || val == 'format-small' ) {
        jQuery('#post_format_video_url').hide();
        jQuery('#sound_embedded_code').hide();
    }
}
function Foodbakery_change_widget_image( sel, div_id, img_url ){
    "use strict";
    //var top_parent_id = jQuery(sel).parents().eq(5).attr('id');
    //var top_parent_id = jQuery(sel).parent().parent().parent().parent().parent().parent().attr('id');
    var top_parent_id = jQuery(sel).parents('.widget.open').attr('id');
    var image_div_id = "#" + top_parent_id + " #" + div_id;
    
    var image_url;
    var val = sel.value;
    if( val === '' ) {
        jQuery(image_div_id).fadeOut();
    }else{
        jQuery(image_div_id).fadeIn();
        image_url = img_url + val + '.jpg';
        jQuery(image_div_id).find('a').attr('href',  image_url);
        jQuery(image_div_id).find('a').attr('title', val);
        jQuery(image_div_id).find('img').attr('src', image_url);
        jQuery(image_div_id).find('img').attr('alt', val);
    }
}
/*
 * 
 * end
 */
function foodbakery_reset_tabs() {
    "use strict";
    jQuery("#tabbed-content > div").addClass('hidden-tab'); //Hide all content
    jQuery("#cs-options-tab a").attr("id", ""); //Reset id's      
}

jQuery(document).on('click', 'label.cs-chekbox', function () {
    "use strict";
    var checkbox = jQuery(this).find('input[type=checkbox]');

    if (checkbox.is(":checked")) {
        jQuery(this).find('input[type="hidden"]').val(checkbox.val());
        jQuery(this).find('input[type="hidden"]').attr('value', 'on');
    } else {
        jQuery(this).find('input[type="hidden"]').val('off');
        jQuery(this).find('#input[type="hidden"]').attr('value', 'off');
    }
});


jQuery(document).on('click', '.del_media_img', function () {
    jQuery(this).closest('li').remove();
});


function foodbakery_var_show_slider(foodbakery_value) {
    "use strict";

    if (foodbakery_value == 'slider') {
        $('#cs-rev-slider-fields').show();
        $('#cs-no-headerfields').hide();
        $('#cs-breadcrumbs-fields').hide();
        $('#cs-subheader-with-bc').hide();
        $('#sub_header_bg_clr').hide();
        $('#cs-subheader-with-bg').hide();
    } else if (foodbakery_value == 'no_header') {
        $('#cs-no-headerfields').show();
        $('#cs-breadcrumbs-fields').hide();
        $('#cs-rev-slider-fields').hide();
        $('#cs-subheader-with-bc').hide();
        $('#sub_header_bg_clr').hide();
        $('#cs-subheader-with-bg').hide();
    } else {
        var sub_header_style_value = $('select#foodbakery_var_sub_header_style option:selected').val();
        $('#cs-breadcrumbs-fields').show();
        $('#cs-no-headerfields').hide();
        $('#cs-rev-slider-fields').hide();
        $('#cs-subheader-with-bc').show();
        $('#sub_header_bg_clr').show();
        if( sub_header_style_value == 'with_bg' ){
            $('#cs-subheader-with-bg').show();
            $('#cs-breadcrumbs_sub_header_fields').show();
            $('#cs-subheader-with-bc').hide();
        }else{
           $('#cs-subheader-with-bg').hide();
           $('#cs-breadcrumbs_sub_header_fields').hide();
           $('#cs-subheader-with-bc').show(); 
        }
        
    }
}

function foodbakery_var_subheader_style(foodbakery_value) {
    "use strict";

    if (foodbakery_value == 'with_bg') {
        $('#cs-subheader-with-bg').show();
        $('#cs-breadcrumbs_sub_header_fields').show();
        $('#sub_header_bg_clr').show();
        $('#cs-subheader-with-bc').hide();
        
    } else {
        $('#cs-subheader-with-bg').hide();
        $('#cs-breadcrumbs_sub_header_fields').hide();
        $('#cs-subheader-with-bc').show();
        $('#sub_header_bg_clr').show();
    }
}

/*
 *  Message Slide show functions
 */
function slideout() {
    "use strict";
    setTimeout(function () {
        jQuery(".form-msg").slideUp("slow", function () {
        });
    }, 5000);
}
/*
 *End Message Slide show functions
 */

/*
 *  Remove div Function
 */
function foodbakery_div_remove(id) {
    "use strict";
    jQuery("#" + id).remove();
}

/*
 *End Remove div Function
 */


/*
 * Delete Media Functions
 */
function del_media(id) {
    
    "use strict";
    var $ = jQuery;
    //jQuery('input[name="'+id+'"]').show();
    jQuery('#' + id + '_box').hide();
    jQuery('#' + id).val('');
    jQuery('#' + id).next().show();
}
/*
 * End Delete Media Functions
 */

/*
jQuery(document).on("click", ".delImgMedia", function () {
    var $ = jQuery;
    jQuery(this).parent().parent().parent().parent().parent().parent().parent().hide();
    jQuery(this).parent().parent().parent().parent().parent().parent().parent().parent().children('.browse-icon').show();
    jQuery(this).parent().parent().parent().parent().parent().parent().parent().parent().children('input').val('');
    //jQuery(this).parent('.gal-edit-opts').parent('.thumb-secs').parent('li').parent('ul').parent('.dragareamain').parent('.gal-active').parent('.page-wrap').hide();
    //jQuery(this).parent('.gal-edit-opts').parent('.thumb-secs').parent('li').parent('ul').parent('.dragareamain').parent('.gal-active').parent('.page-wrap').parent('.cs-dr-option-img').children('.browse-icon').show();
    //jQuery(this).parent('.gal-edit-opts').parent('.thumb-secs').parent('li').parent('ul').parent('.dragareamain').parent('.gal-active').parent('.page-wrap').parent('.cs-dr-option-img').children('input').val('');
});*/


function foodbakery_var_toggle(id) {
    "use strict";
    jQuery("#" + id).slideToggle("slow");
}

function chosen_selectionbox() {
    "use strict";
    
    if (jQuery('.chosen-select, .chosen-select-deselect, .chosen-select-no-single, .chosen-select-no-results, .chosen-select-width').length != '') {
        var config = {
            '.chosen-select': {width: "100%"},
            '.chosen-select-deselect': {allow_single_deselect: true},
            '.chosen-select-no-single': {disable_search_threshold: 10, width: "100%"},
            '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
            '.chosen-select-width': {width: "95%"}
        };
        for (var selector in config) {
            jQuery(selector).chosen(config[selector]);
        }
    }
}

function popup_view_box() {
    "use strict";
    jQuery('.thumbnail').viewbox();
}

/*
 *   Overley remove function
 */
function _removerlay(object) {
    "use strict";
    var $elem;
    jQuery("#cs-widgets-list .loader").remove();
    var _elem1 = "<div id='cs-pbwp-outerlay'></div>",
    _elem2 = "<div id='cs-widgets-list'></div>";
    $elem = object.closest('div[class*="cs-wrapp-class-"]');
    $elem.unwrap();
    $elem.unwrap();
    $elem.hide()
}

/*
 * End Overley remove function
 */

/*
 * Bannner widget options function
 */
function foodbakery_service_view_change(value) {
    "use strict";
    if (value == 'image') {
        jQuery(".cs-sh-service-image-area").show();
        jQuery(".cs-sh-service-icon-area").hide();
    }
    else {
        jQuery(".cs-sh-service-image-area").hide();
        jQuery(".cs-sh-service-icon-area").show();
    }
}

/*
 * Gallery Number of Items
 */
function gal_num_of_items(id, rand_id, numb) {
    "use strict";
    var foodbakery_var_gal_count = 0;
    jQuery("#gallery_sortable_" + rand_id + " > li").each(function (index) {
        foodbakery_var_gal_count++;
        jQuery('input[name="foodbakery_' + id + '_num"]').val(foodbakery_var_gal_count);
    });

    if (numb != '') {
        var foodbakery_var_data_temp = jQuery('#foodbakery_var_' + id + '_temp');
        if (jQuery('input[name="foodbakery_' + id + '_num"]').val() == numb) {
            foodbakery_var_data_temp.html('<input type="hidden" name="foodbakery_' + id + '_url[]" value="">');
        }
    }
}

/* ---------------------------------------------------------------------------
 * Mega Menu view select action
 * --------------------------------------------------------------------------- */
function foodbakery_menu_view_select(value, id) {
    "use strict";
    var title = jQuery('#field-cat-title-' + id);
    var categories = jQuery('#field-item-categories-' + id);
    var link = jQuery('#field-item-view-all-' + id);
    if (value == 'simple'){
        categories.hide();
    } else {
        categories.show();
    }
    if (value == 'cat-view-2'){
        title.show();
    } else {
        title.hide();
    }
    if (value == 'cat-view-3'){
        link.show();
    } else {
        link.hide();
    }
}
jQuery(function ($) {
    // Product gallery file uploads
    var gallery_frame;

    jQuery('.add_gallery').on('click', 'input', function (event) {
        var $el = $(this);
        rand_id = $el.data('rand_id');
        button_label = $el.data('button_label');
        multiple = $el.data('multiple');
        foodbakery_var_theme_url = $("#foodbakery_var_theme_url").val();
        $gallery_images = $('#gallery_container_' + rand_id + ' ul.gallery_images');
        foodbakery_var_gallery_id = $('#gallery_container_' + rand_id).data("csid");
        event.preventDefault();
         if( button_label !== '' ){
            button_label = button_label;
        }else{
            button_label = 'Add Gallery Image';
        }
        if( multiple == false ){
            multiple = false;
        }else{
           multiple = true; 
        }

        // Create the media frame.
        gallery_frame = wp.media({
            title: "Select Image",
            multiple: multiple,
            library: {type: 'image'},
            button: {text: button_label}
        });

        // If the media frame already exists, reopen it.
        if (gallery_frame) {
           // gallery_frame.open();
          //  return;
        }
       
        // When an image is selected, run a callback.
        gallery_frame.on('select', function () {
        
            var selection = gallery_frame.state().get('selection');

            selection.map(function (attachment) {

                attachment = attachment.toJSON();
                if (attachment.type == 'image') {
                    var gallery_url = attachment.url;
                    var gallery_ID = attachment.id;
                }

                if (attachment.url) {
                    attachment_ids = Math.floor((Math.random() * 965674) + 1);
                    if( multiple == false ){
                        var listItems = jQuery('#gallery_container_' + rand_id + ' ul.gallery_images').children();
						var count = listItems.length;
                        if( count > 0 ){
                            $('#gallery_container_' + rand_id + ' ul.gallery_images img').attr('src',gallery_url);
                            $('#gallery_container_' + rand_id + ' ul.gallery_images input[name="'+ foodbakery_var_gallery_id +'"]').val(gallery_ID);
                        }else{
                            $('#gallery_container_' + rand_id + ' ul.gallery_images').append('\
                            <li class="image" data-attachment_id="' + attachment_ids + '">\
                                <img src="' + gallery_url + '" />\
                                <input type="hidden" value="' + gallery_ID + '" name="' + foodbakery_var_gallery_id + '" />\
                                <div class="actions">\
                                    <span><a href="javascript:;" class="delete" title="' + $el.data('delete') + '"><i class="icon-times"></i></a></span>\
                                </div>\
                            </li>');
                        }
                    }else{
                        $('#gallery_container_' + rand_id + ' ul.gallery_images').append('\
                            <li class="image" data-attachment_id="' + attachment_ids + '">\
                                <img src="' + gallery_url + '" />\
                                <input type="hidden" value="' + gallery_ID + '" name="' + foodbakery_var_gallery_id + '[]" />\
                                <div class="actions">\
                                    <span><a href="javascript:;" class="delete" title="' + $el.data('delete') + '"><i class="icon-times"></i></a></span>\
                                </div>\
                            </li>');
                    }
                }

            });
            jQuery('#' + foodbakery_var_gallery_id + '_temp').html('');
        });

        // Finally, open the modal.
        gallery_frame.open();
    });
});