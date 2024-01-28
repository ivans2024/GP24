<?php

/*
 *
 * @Shortcode Name : Start function for Map shortcode/element front end view
 * @retrun
 *
 */
if ( !function_exists( 'foodbakery_var_map_shortcode' ) ) {

	function foodbakery_var_map_shortcode( $atts, $content = "" ) {
		global $header_map, $foodbakery_var_form_fields, $foodbakery_var_html_fields, $foodbakery_var_options;
                
                $html = '';
                $page_element_size  = isset( $atts['map_element_size'] )? $atts['map_element_size'] : 100;
                if (function_exists('foodbakery_var_page_builder_element_sizes')) {
                    $html   .= '<div class="' . foodbakery_var_page_builder_element_sizes($page_element_size) . ' ">';
                }

		$defaults = array(
			'foodbakery_var_column_size' => '1/1',
			'foodbakery_var_map_title' => '',
			'foodbakery_var_map_height' => '',
			'foodbakery_var_map_lat' => '40.7143528',
			'foodbakery_var_map_lon' => '-74.0059731',
			'foodbakery_var_map_zoom' => '11',
			'foodbakery_var_map_info' => '',
			'foodbakery_var_map_info_width' => '200',
			'foodbakery_var_map_info_height' => '200',
			'foodbakery_var_map_marker_icon' => '',
			'foodbakery_var_map_show_marker' => 'true',
			'foodbakery_var_map_controls' => '',
			'foodbakery_var_map_draggable' => 'true',
			'foodbakery_var_map_scrollwheel' => 'true',
			'foodbakery_var_map_border' => '',
			'foodbakery_var_map_border_color' => '',
			'foodbakery_map_directions' => 'off',
                    'foodbakery_var_map_align' => '',
		);
		extract( shortcode_atts( $defaults, $atts ) );
		$foodbakery_var_column_size = isset( $foodbakery_var_column_size ) ? $foodbakery_var_column_size : '';
		$foodbakery_var_map_title = isset( $foodbakery_var_map_title ) ? $foodbakery_var_map_title : '';
		$foodbakery_var_map_height = isset( $foodbakery_var_map_height ) ? $foodbakery_var_map_height : '';
		$foodbakery_var_map_lat = isset( $foodbakery_var_map_lat ) ? $foodbakery_var_map_lat : '';
		$foodbakery_var_map_lon = isset( $foodbakery_var_map_lon ) ? $foodbakery_var_map_lon : '';
		$foodbakery_var_map_zoom = isset( $foodbakery_var_map_zoom ) ? $foodbakery_var_map_zoom : '';
		$foodbakery_var_map_info = isset( $foodbakery_var_map_info ) ? $foodbakery_var_map_info : '';
		$foodbakery_var_map_info_width = isset( $foodbakery_var_map_info_width ) ? $foodbakery_var_map_info_width : '';
		$foodbakery_var_map_info_height = isset( $foodbakery_var_map_info_height ) ? $foodbakery_var_map_info_height : '';
		$foodbakery_var_map_marker_icon = isset( $foodbakery_var_map_marker_icon ) ? $foodbakery_var_map_marker_icon : '';
		$foodbakery_var_map_show_marker = isset( $foodbakery_var_map_show_marker ) ? $foodbakery_var_map_show_marker : '';
		$foodbakery_var_map_controls = isset( $foodbakery_var_map_controls ) ? $foodbakery_var_map_controls : '';
		$foodbakery_var_map_draggable = isset( $foodbakery_var_map_draggable ) ? $foodbakery_var_map_draggable : '';
		$foodbakery_var_map_scrollwheel = isset( $foodbakery_var_map_scrollwheel ) ? $foodbakery_var_map_scrollwheel : '';
		$foodbakery_var_map_border = isset( $foodbakery_var_map_border ) ? $foodbakery_var_map_border : '';
		$foodbakery_var_map_border_color = isset( $foodbakery_var_map_border_color ) ? $foodbakery_var_map_border_color : '';
                $foodbakery_var_map_align = isset($foodbakery_var_map_align) ? $foodbakery_var_map_align : '';

		$foodbakery_var_map_style = isset( $foodbakery_var_options['foodbakery_var_def_map_style'] ) ? $foodbakery_var_options['foodbakery_var_def_map_style'] : '';

		if ( isset( $foodbakery_var_map_height ) && $foodbakery_var_map_height == '' ) {
			$foodbakery_var_map_height = '500';
		}

		$column_class = '';

		if ( $header_map ) {
			$header_map = false;
		} else {
			if ( isset( $foodbakery_var_column_size ) && $foodbakery_var_column_size != '' ) {
				if ( function_exists( 'foodbakery_custom_column_class' ) ) {
					$column_class = foodbakery_custom_column_class( $foodbakery_var_column_size );
				}
			}
		}
		$section_title = '';
		if ( $foodbakery_var_map_title && trim( $foodbakery_var_map_title ) != '' ) {
			$section_title = '<div class="element-title '.$foodbakery_var_map_align.'"><h2>' . esc_html( $foodbakery_var_map_title ) . '</h2></div>';
		}
		if ( $foodbakery_var_map_show_marker == "true" ) {
			$foodbakery_var_map_show_marker = " var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title: '',
                        icon: '" . $foodbakery_var_map_marker_icon . "',
                        shadow: ''
                    });
            ";
		} else {
			$foodbakery_var_map_show_marker = "var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title: '',
                        icon: '',
                        shadow: ''
                    });";
		}
		$border = '';
		if ( isset( $foodbakery_var_map_border ) && $foodbakery_var_map_border == 'yes' && $foodbakery_var_map_border_color != '' ) {
			$border = 'border:1px solid ' . esc_attr( $foodbakery_var_map_border_color ) . '; ';
		}

		foodbakery_enqueue_google_map();

		$map_dynmaic_no = foodbakery_generate_random_string( '10' );
		$html .= $section_title;
		$html .= '<div class="cs-map-section">';
		$html .='<div class="maps" style="' . $border . '">';
		$html .= '<div class="cs-map">';
		$html .= '<div class="cs-map-content">';

		$html .= '<div class="mapcode iframe mapsection gmapwrapp" id="map_canvas' . $map_dynmaic_no . '" style="height:' . $foodbakery_var_map_height . 'px;"> </div>';
		$zoomControl = '';
		if ( isset( $foodbakery_var_map_controls ) && $foodbakery_var_map_controls == false ) {
			$zoomControl = ' zoomControl:true,';
		}
		$foodbakery_inline_script = "
		jQuery(document).ready(function() {
                    var panorama;
                    function initialize() {
                    var myLatlng = new google.maps.LatLng(" . $foodbakery_var_map_lat . ", " . $foodbakery_var_map_lon . ");
                    var mapOptions = {
                        " . $zoomControl . "
                        zoom: " . $foodbakery_var_map_zoom . ",
                        scrollwheel: " . $foodbakery_var_map_scrollwheel . ",
                        draggable: " . $foodbakery_var_map_draggable . ",
                        streetViewControl: false,
                        center: myLatlng,
                        disableDefaultUI:" . $foodbakery_var_map_controls . "
                    };";

		if ( $foodbakery_map_directions == 'on' ) {
			$foodbakery_inline_script .= "var directionsDisplay;
                      var directionsService = new google.maps.DirectionsService();
                      directionsDisplay = new google.maps.DirectionsRenderer();";
		}

		$foodbakery_inline_script .= "var map = new google.maps.Map(document.getElementById('map_canvas" . $map_dynmaic_no . "'), mapOptions);";

		if ( $foodbakery_map_directions == 'on' ) {
			$foodbakery_inline_script .= "directionsDisplay.setMap(map);
                        directionsDisplay.setPanel(document.getElementById('cs-directions-panel'));

                        function foodbakery_calc_route() {
                                var myLatlng = new google.maps.LatLng(" . $foodbakery_var_map_lat . ", " . $foodbakery_var_map_lon . ");
                                var start = myLatlng;
                                var end = document.getElementById('foodbakery_end_direction').value;
                                var mode = document.getElementById('foodbakery_chng_dir_mode').value;
                                var request = {
                                        origin:start,
                                        destination:end,
                                        travelMode: google.maps.TravelMode[mode]
                                };
                                directionsService.route(request, function(response, status) {
                                        if (status == google.maps.DirectionsStatus.OK) {
                                                directionsDisplay.setDirections(response);
                                        }
                                });
                        }
                        document.getElementById('foodbakery_search_direction').addEventListener('click', function() {
                                foodbakery_calc_route();
                        });";
		}

		$foodbakery_inline_script .= "
				var style = '" . $foodbakery_var_map_style . "';
				if (style != '') {
					var styles = foodbakery_map_select_style(style);
					if (styles != '') {
						var styledMap = new google.maps.StyledMapType(styles,
								{name: 'Styled Map'});
						map.mapTypes.set('map_style', styledMap);
						map.setMapTypeId('map_style');
					}
				}
				var infowindow = new google.maps.InfoWindow({
					content: '" . $foodbakery_var_map_info . "',
					maxWidth: " . $foodbakery_var_map_info_width . ",
					maxHeight: " . $foodbakery_var_map_info_height . ",
					
				});
				" . $foodbakery_var_map_show_marker . "
					if (infowindow.content != ''){
					  infowindow.open(map, marker);
					   map.panBy(1,-60);
					   google.maps.event.addListener(marker, 'click', function(event) {
						infowindow.open(map, marker);
					   });
					}
					panorama = map.getStreetView();
					panorama.setPosition(myLatlng);
					panorama.setPov(({
					  heading: 265,
					  pitch: 0
					}));
			}			
				function foodbakery_toggle_street_view(btn) {
				  var toggle = panorama.getVisible();
				  if (toggle == false) {
						if(btn == 'streetview'){
						  panorama.setVisible(true);
						}
				  } else {
						if(btn == 'mapview'){
						  panorama.setVisible(false);
						}
				  }
				}
		google.maps.event.addDomListener(window, 'load', initialize);
		});";
		$html .= '</div>';
		$html .= '</div></div></div>';
		$html .= '<script> '.$foodbakery_inline_script.' </script>';
                if (function_exists('foodbakery_var_page_builder_element_sizes')) {
                    $html    .=  '</div>';
                 } 
		return $html;
	}

}

if ( function_exists( 'foodbakery_var_short_code' ) ) {
	foodbakery_var_short_code( 'foodbakery_map', 'foodbakery_var_map_shortcode' );
}