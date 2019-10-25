<?php

// Pricing Table - NeuronElement
$proton_pricing_table_class[] = "pricing-table";
$proton_pricing_table_button_class[] = "button";
$proton_pricing_table_uniqID = mt_rand(1, 99999);

$proton_pricing_table_class[] = "uniqid-". $proton_pricing_table_uniqID ."";

extract(
	shortcode_atts(
		array(
			'proton_pricing_table_title' => '',
			'proton_pricing_table_subtitle' => '',
			'proton_pricing_table_price' => '',
			'proton_pricing_table_currency_symbol' => '',
			'proton_pricing_table_pricing_unit' => '',
			'proton_pricing_table_description' => '',
			'proton_pricing_table_text_lines' => '',
			'proton_pricing_table_button' => '',
			'proton_pricing_table_text_color' => '',
			'proton_pricing_table_borders_color' => '',
			'proton_pricing_table_bgc' => '1',
			'proton_pricing_table_custom_bgc' => '',
			'proton_pricing_table_button_color' => '1',
			'proton_pricing_table_button_text_color' => '',
			'proton_pricing_table_button_background_color' => '',
			'proton_pricing_table_highlight' => '',
			'el_class' => '',
			'proton_css' => ''
		),
		$atts
	)
);

// Text Lines
$proton_pricing_table_texts = explode("\n", $proton_pricing_table_text_lines);
$proton_pricing_table_texts_arr = preg_replace('/<[^>]*>/', '', $proton_pricing_table_texts);

// Button
$proton_pricing_table_button_link = vc_build_link($proton_pricing_table_button);

// Text Color
if ($proton_pricing_table_text_color) {
	proton_generate_custom_css(".uniqid-". $proton_pricing_table_uniqID .", .uniqid-". $proton_pricing_table_uniqID ." .table-top .table-price, .uniqid-". $proton_pricing_table_uniqID ." .table-top .table-title h6, .uniqid-". $proton_pricing_table_uniqID ." .table-top span, .uniqid-". $proton_pricing_table_uniqID ." .table-top p, .uniqid-". $proton_pricing_table_uniqID ." li { color: ". $proton_pricing_table_text_color ." !important }");
}

// Border Color
if ($proton_pricing_table_borders_color) {
	proton_generate_custom_css(".uniqid-". $proton_pricing_table_uniqID .", .uniqid-". $proton_pricing_table_uniqID ." .table-top, .uniqid-". $proton_pricing_table_uniqID ." .table-bottom .table-list ul li { border-color: ". $proton_pricing_table_borders_color ." }");
}

// Background Color
if ($proton_pricing_table_bgc == '2') {
	proton_generate_custom_css(".uniqid-". $proton_pricing_table_uniqID ."{ background-color: transparent; }");
} elseif ($proton_pricing_table_bgc == '3' && $proton_pricing_table_custom_bgc) {
	proton_generate_custom_css(".uniqid-". $proton_pricing_table_uniqID .", .uniqid-". $proton_pricing_table_uniqID ." .table-top .table-price { background-color: ". $proton_pricing_table_custom_bgc ." }");
}

// Button Color
if ($proton_pricing_table_button_color == '8' && $proton_pricing_table_button_text_color || $proton_pricing_table_button_background_color) {
	if ($proton_pricing_table_button_text_color) {
		proton_generate_custom_css(".button, .button:hover, .button.button-border:hover { color: ". $proton_pricing_table_button_text_color . "; } .button.button-border { color: ". $proton_pricing_table_button_background_color . " !important; } .button:focus, .button:active { color: ". $proton_pricing_table_button_text_color . " }");
	}

	if ($proton_pricing_table_button_background_color) {
		proton_generate_custom_css(".button { background-color: ". $proton_pricing_table_button_background_color ."; border-color: ". $proton_pricing_table_button_background_color ."; } .button:hover { color: ". $proton_pricing_table_button_background_color ." }  .button.button-border:hover { background-color: ". $proton_pricing_table_button_background_color ." !important; }");
	}
} else {
	switch ($proton_pricing_table_button_color) {
		case '1':
		default:
			$proton_pricing_table_button_class[] = "main-color";
			break;
		case '2':
			$proton_pricing_table_button_class[] = "grey-color";
			break;
		case '3':
			$proton_pricing_table_button_class[] = "white-color";
			break;
		case '4':
			$proton_pricing_table_button_class[] = "dark-color";
			break;
		case '5':
			$proton_pricing_table_button_class[] = "red-color";
			break;
		case '6':
			$proton_pricing_table_button_class[] = "green-color";
			break;
		case '7':
			$proton_pricing_table_button_class[] = "blue-color";
			break;
	}
}

// Highlight
if ($proton_pricing_table_highlight) {
	$proton_pricing_table_class[] = "table-highlighted";
}

// Extra Class
if ($el_class) {
	$proton_pricing_table_class[] = $el_class;
}

// CSS Editor
if ($proton_css) {
	$proton_pricing_table_class[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($proton_css, ''), $this->settings['base'], $atts);
}

?>
<div class="<?php echo esc_attr(implode(' ', $proton_pricing_table_class)) ?>">
	<div class="table-top">
		<div class="table-title">
			<?php
				echo ($proton_pricing_table_title ? "<h6>". esc_attr($proton_pricing_table_title) ."</h6>" : "");

				echo ($proton_pricing_table_subtitle ? "<span>". esc_attr($proton_pricing_table_subtitle) ."</span>"  : "");
			?>
		</div>
		<div class="table-price">
			<?php
				echo ($proton_pricing_table_currency_symbol ? "<span class='currency-symb'>". esc_attr($proton_pricing_table_currency_symbol) ."</span>" : "");

				echo ($proton_pricing_table_price ? "<span class='price'>". esc_attr($proton_pricing_table_price) ."</span>" : "");

				echo ($proton_pricing_table_pricing_unit ? "<span class='date'>". esc_attr($proton_pricing_table_pricing_unit) ."</span>" : "");
			?>
		</div>
		<?php if ($proton_pricing_table_description) : ?>
			<div class="table-description">
				<p><?php echo esc_attr($proton_pricing_table_description) ?></p>
			</div>
		<?php endif; ?>
	</div>
	<div class="table-bottom">
		<?php if ($proton_pricing_table_texts) : ?>
			<div class="table-list">
				<ul>
					<?php foreach ($proton_pricing_table_texts_arr as $proton_table_list) : ?>
						<li><?php echo esc_attr($proton_table_list) ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
		<?php if ($proton_pricing_table_button_link['url']) : ?>
			<div class="table-button">
				<a href="<?php echo esc_attr($proton_pricing_table_button_link['url']) ?>" target="<?php echo esc_attr($proton_pricing_table_button_link['target']) ?>" rel="<?php echo esc_attr($proton_pricing_table_button_link['rel']) ?>" class="<?php echo esc_attr(implode(' ', $proton_pricing_table_button_class)) ?>"><?php echo esc_attr($proton_pricing_table_button_link['title']) ?></a>
			</div>
		<?php endif; ?>
	</div>
</div>
