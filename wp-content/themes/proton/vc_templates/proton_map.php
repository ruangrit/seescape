<?php

// Map - NeuronElement
$proton_map_holder_class[] = "map-holder";
$proton_map_class[] = "map";

extract(
	shortcode_atts(
		array(
	        'proton_map_height' => '',
	        'proton_map_full_height' => '',
	        'proton_map_zoom' => '13',
	        'proton_map_scroll_zoom' => '',
	        'proton_map_style' => '1',
	        'proton_map_custom_style' => '',
	        'proton_map_controls' => 'zoom-control,draggable',
			'proton_map_marker_animation' => 'marker-animation',
	        'el_class' => '',
	        'proton_css' => ''
		),
		$atts
	)
);

// Height
if ($proton_map_full_height) {
    $proton_map_class[] = "full-height";
} elseif ($proton_map_height) {
    $proton_map_custom_height = "height: ". $proton_map_height. "px";
} else {
	$proton_map_custom_height = "height: 450px";
}

// Style
$proton_map_the_style = '[{"featureType":"administrative","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"administrative.land_parcel","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","stylers":[{"color":"#ffffff"},{"weight":0.5}]},{"featureType":"road.local","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"color":"#B4D0EF"}]}]';

if ($proton_map_style == '3' && $proton_map_custom_style) {
    $proton_map_the_style = $proton_map_custom_style;
}

// Extra Class
if ($el_class) {
	$proton_map_holder_class[] = $el_class;
}

// CSS Editor
if ($proton_css) {
	$proton_map_holder_class[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($proton_css, ''), $this->settings['base'], $atts);
}

$map_id = rand(100, 999);

?>
<div class="<?php echo esc_attr(implode(' ', $proton_map_holder_class)) ?>">
	<div id="map-<?php echo esc_attr($map_id); ?>" class="<?php echo esc_attr(implode(' ', $proton_map_class)) ?>" style="<?php echo esc_attr($proton_map_custom_height) ?>"></div>
</div>

<script>
	var locations = [
		<?php echo do_shortcode($content) ?>
	];

	var myOptions = {
		center: new google.maps.LatLng( locations[0][1], locations[0][2] ),
		zoom: <?php echo esc_attr($proton_map_zoom) ?>,
		scrollwheel: <?php echo esc_attr(!$proton_map_scroll_zoom ? "false" : "true"); ?>,
		mapTypeControl: <?php echo esc_attr((strpos($proton_map_controls, 'type-control' ) !== false) ? "true" : "false"); ?>,
		zoomControl: <?php echo esc_attr((strpos($proton_map_controls, 'zoom-control' ) !== false) ? "true" : "false"); ?>,
		fullscreenControl: <?php echo esc_attr((strpos($proton_map_controls, 'fullscreen-control' ) !== false) ? "true" : "false"); ?>,
		streetViewControl: <?php echo esc_attr((strpos($proton_map_controls, 'street-view-control' ) !== false) ? "true" : "false"); ?>,
		draggable: <?php echo esc_attr((strpos($proton_map_controls, 'draggable' ) !== false) ? "true" : "false"); ?>
	}

	var map = new google.maps.Map(document.getElementById('map-<?php echo esc_attr($map_id); ?>'), myOptions );

	var infowindow = new google.maps.InfoWindow();
	var bounds = new google.maps.LatLngBounds();

	var marker, i;

	for (i = 0; i < locations.length; i++) {
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			map: map,
			icon: locations[i][3],
			<?php echo esc_attr( ( strpos( $proton_map_marker_animation, 'marker-animation' ) !== false ) ? "animation: google.maps.Animation.DROP" : "" ); ?>
		});

		bounds.extend(marker.position);

		if (locations[i][0] != " ") {
			google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function() {
					infowindow.setContent(locations[i][0]);
					infowindow.open(map, marker);
				}
			})(marker, i));
		}
	}

	if (<?php echo esc_attr($proton_map_zoom) ?> > 0) {
		map.setCenter(bounds.getCenter());
		map.setZoom(<?php echo esc_attr($proton_map_zoom) ?>);
	} else {
		map.fitBounds(bounds);
	}

	<?php if ($proton_map_style != '2') : ?>
		var styledMapType = new google.maps.StyledMapType(
			<?php echo ($proton_map_the_style ? strip_tags($proton_map_the_style) . "," : ""); ?>
			{ name: 'Styled Map' }
		);
		map.mapTypes.set('styled_map', styledMapType);
		map.setMapTypeId('styled_map');
	<?php endif; ?>
</script>
