<?php

// Carousel - NeuronElement
$proton_carousel_class[] = "owl-carousel owl-theme";

extract(
	shortcode_atts(
		array(
			'proton_carousel_images' => '',
			'proton_carousel_items' => '1',
			'proton_carousel_margin' => '',
			'proton_carousel_controls' => 'auto-height,loop,mousedrag,touchdrag,navigation',
			'proton_carousel_stage_padding' => '',
			'proton_carousel_start_position' => '',
			'proton_carousel_auto_play_timeout' => '',
			'proton_carousel_smart_speed' => '',
			'el_class' => '',
			'proton_css' => ''
		),
		$atts
	)
);

// Images
$proton_carousel_arr = explode(',', $proton_carousel_images);

// Extra Class
if ($el_class) {
	$proton_carousel_class[] = $el_class;
}

// CSS Editor
if ($proton_css) {
	$proton_carousel_class[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($proton_css, ''), $this->settings['base'], $atts);
}

$proton_uniqid = uniqid('', false);

if ($proton_carousel_images) :

?>
<div id="<?php echo esc_attr($proton_uniqid) ?>" class="<?php echo esc_attr(implode(' ', $proton_carousel_class)) ?>">
	<?php foreach ($proton_carousel_arr as $image) : ?>
		<?php
			$proton_carousel_image_data = wp_get_attachment_image_src($image, 'full');
			$proton_image_url = $proton_carousel_image_data[0];
		?>
	    <div class="item">
			<img src="<?php echo esc_url($proton_image_url) ?>">
	    </div>
	<?php endforeach; ?>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($){
		var owl = $('#<?php echo esc_attr($proton_uniqid) ?>');
		owl.owlCarousel({
			items: 1,
			margin: <?php echo esc_attr($proton_carousel_margin ? $proton_carousel_margin : "0") ?>,
			autoHeight: <?php echo esc_attr(strpos($proton_carousel_controls, 'auto-height' ) !== false ? "true" : "false") ?>,
			loop: <?php echo esc_attr(strpos($proton_carousel_controls, 'loop' ) !== false ? "true" : "false") ?>,
			mouseDrag: <?php echo esc_attr(strpos($proton_carousel_controls, 'mousedrag' ) !== false ? "true" : "false") ?>,
			touchDrag: <?php echo esc_attr(strpos($proton_carousel_controls, 'touchdrag' ) !== false ? "true" : "false") ?>,
			stagePadding: <?php echo esc_attr($proton_carousel_stage_padding ? $proton_carousel_stage_padding : "0") ?>,
			startPosition: <?php echo esc_attr($proton_carousel_start_position ? $proton_carousel_start_position : "0") ?>,
			nav: <?php echo esc_attr(strpos($proton_carousel_controls, 'navigation' ) !== false ? "true" : "false") ?>,
			navText: [
				"<i class='fa fa-angle-left'></i>",
				"<i class='fa fa-angle-right'></i>"
			],
			dots: <?php echo esc_attr(strpos($proton_carousel_controls, 'dots' ) !== false ? "true" : "false") ?>,
			autoplay: <?php echo esc_attr(strpos($proton_carousel_controls, 'autoplay' ) !== false ? "true" : "false") ?>,
			autoplayTimeout: <?php echo esc_attr($proton_carousel_auto_play_timeout ? $proton_carousel_auto_play_timeout*1000 : "2000") ?>,
			autoplayHoverPause: <?php echo esc_attr(strpos($proton_carousel_controls, 'autoplay-hover-poause' ) !== false ? "true" : "false") ?>,
			smartSpeed: <?php echo esc_attr($proton_carousel_smart_speed ? $proton_carousel_smart_speed/100 : "450") ?>,
			responsive: {
				769: {
					items: <?php echo esc_attr($proton_carousel_items ? $proton_carousel_items : "1")  ?>
				}
			}
		});
	});
</script>
<?php

endif;
