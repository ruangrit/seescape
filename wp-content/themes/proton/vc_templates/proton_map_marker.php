<?php

// Map Marker - NeuronElement
$proton_map_marker_the_title = $proton_map_marker_the_description = "";

extract(
	shortcode_atts(
		array(
	        'proton_map_latitude' => '',
	        'proton_map_longitude' => '',
	        'proton_map_marker' => '',
	        'proton_map_marker_title' => '',
	        'proton_map_marker_description' => ''
		),
		$atts
	)
);

// Map Marker Image
if ($proton_map_marker) {
	$proton_map_the_marker = wp_get_attachment_image_src($proton_map_marker, full);
	$proton_map_marker_image = $proton_map_the_marker['0'];
} else {
	$proton_map_marker_image = get_template_directory_uri() .'/assets/images/map-marker.png';
}

// Map Marker Title
if ($proton_map_marker_title) {
	$proton_map_marker_the_title = '<h3 style="margin-top: 0">'. $proton_map_marker_title .'</h3>';
}

// Map Marker Description
if ($proton_map_marker_description) {
	$proton_map_marker_the_description = '<p style="margin-top: 10px">'. $proton_map_marker_description .'</p>';
}

echo "['$proton_map_marker_the_title $proton_map_marker_the_description', $proton_map_latitude, $proton_map_longitude, '$proton_map_marker_image'],";
