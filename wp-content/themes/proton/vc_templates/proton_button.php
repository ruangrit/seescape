<?php

// Button - NeuronElement
$class[] = "button";
$uniqID = mt_rand(1, 99999);
$class[] = "uniqid-". $uniqID ."";

extract(
	shortcode_atts(
		array(
			'link' => '',
			'style' => '1',
			'shape' => '1',
			'size' => '2',
			'fluid' => '2',
			'color' => '1',
			'text_color' => '',
			'background_color' => '',
			'el_class' => '',
			'proton_css' => ''
		),
		$atts
	)
);

// Style
if ($style == '2') {
	$class[] = "button-border";
}

// Shape
switch ($shape) {
	case '2':
		$class[] = "button-rounded";
		break;
	case '3':
		$class[] = "button-round";
		break;
}

// Size
switch ($size) {
	case '1':
		$class[] = "button-sm";
		break;
	case '3':
		$class[] = "button-lg";
		break;
	case '4':
		$class[] = "button-xl";
		break;
}

// Fluid
if ($fluid == '1') {
	$class[] = "button-fluid";
}

// Color
if ($color == '7' && $text_color || $background_color) {
	if ($text_color) {
		proton_generate_custom_css(".uniqid-". $uniqID .", .uniqid-". $uniqID .":hover, .uniqid-". $uniqID .".button-border:hover { color: ". $text_color . "; }");
		proton_generate_custom_css(".uniqid-". $uniqID .".button-border { color: ". $background_color . " !important; }");
		proton_generate_custom_css(".uniqid-". $uniqID .":focus, .uniqid-". $uniqID .":active { color: ". $text_color . " }");
	}
	if ($background_color) {
		proton_generate_custom_css(".uniqid-". $uniqID ." { background-color: ". $background_color ."; border-color: ". $background_color ."; }");
		proton_generate_custom_css(".uniqid-". $uniqID .":hover { color: ". $background_color ." }");
		proton_generate_custom_css(".uniqid-". $uniqID .".button-border:hover { background-color: ". $background_color ." !important; }");
	}
} else {
	switch ($color) {
		default:
			$class[] = "main-color";
			break;
		case '2':
			$class[] = "grey-color";
			break;
		case '3':
			$class[] = "white-color";
			break;
		case '4':
			$class[] = "red-color";
			break;
		case '5':
			$class[] = "green-color";
			break;
		case '6':
			$class[] = "blue-color";
			break;
	}
}

// Extra Class
if ($el_class) {
	$class[] = $el_class;
}

// CSS Editor
if ($proton_css) {
	$class[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($proton_css, ''), $this->settings['base'], $atts);
}

$proton_build_link = vc_build_link($link);

if ($proton_build_link['title']) :
?>
	<a class="<?php echo esc_attr(implode( ' ', $class)) ?>" href="<?php echo esc_url($proton_build_link['url']) ?>"  rel="<?php echo esc_attr($proton_build_link['rel']) ?>" target="<?php echo esc_attr($proton_build_link['target']) ?>" ><?php echo esc_attr($proton_build_link['title']) ?></a>
<?php

endif;
