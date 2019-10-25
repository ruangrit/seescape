<?php

// Service - NeuronElement
$proton_service_class[] = "service";
$proton_service_icon_style = $proton_service_title_style = $proton_service_title_class = $proton_service_icon_arr = array();

extract(
	shortcode_atts(
		array(
			'proton_service_icon_position' => '3',
			'proton_service_alignment' => '1',
			'proton_service_icon' => '1',
			'proton_service_icon_feather' => '',
			'proton_service_icon_font_awesome' => '',
			'proton_service_icon_open_iconic' => '',
			'proton_service_icon_typicons' => '',
			'proton_service_icon_entypo' => '',
			'proton_service_icon_linecons' => '',
			'proton_service_icon_mono_social' => '',
			'proton_service_icon_material' => '',
			'proton_service_image' => '',
			'proton_service_icon_color' => '',
			'proton_service_icon_size' => '2',
			'proton_service_title' => '',
			'proton_service_title_size' => '5',
			'proton_service_title_custom_size' => '',
			'proton_service_url' => '',
			'el_class' => '',
			'proton_css' => ''
		),
		$atts
	)
);

// Position
switch ($proton_service_icon_position) {
	case '1':
		$proton_service_class[] = "left-icon";
		break;
	case '2':
		$proton_service_class[] = "right-icon";
		break;
	case '4':
		$proton_service_class[] = "bottom-icon";
		break;
}

// Alignment
if ($proton_service_alignment == '2') {
    $proton_service_class[] = "align-center";
} elseif ($proton_service_alignment == '3') {
    $proton_service_class[] = "align-right";
}

// Icon
switch ($proton_service_icon) {
	default:
		$proton_service_icon_arr[] = $proton_service_icon_font_awesome;
		break;
	case '2':
		$proton_service_icon_arr[] = $proton_service_icon_open_iconic;
		wp_enqueue_style('vc_openiconic');
		break;
	case '3':
		$proton_service_icon_arr[] = $proton_service_icon_typicons;
		wp_enqueue_style('vc_typicons');
		break;
	case '4':
		$proton_service_icon_arr[] = $proton_service_icon_entypo;
		wp_enqueue_style('vc_entypo');
		break;
	case '5':
		$proton_service_icon_arr[] = $proton_service_icon_linecons;
		wp_enqueue_style('vc_linecons');
		break;
	case '6':
		$proton_service_icon_arr[] = $proton_service_icon_mono_social;
		wp_enqueue_style('vc_monosocialiconsfont');
		break;
	case '7':
		$proton_service_icon_arr[] = $proton_service_icon_material;
		wp_enqueue_style('vc_material');
		break;
}


// Image
if ($proton_service_image) {
    $proton_service_icon_image = wp_get_attachment_image_src($proton_service_image, 'full');
}

// Icon Color
if ($proton_service_icon_color) {
    $proton_service_icon_style[] = "color: $proton_service_icon_color;";
}

// Icon Size
switch ($proton_service_icon_size) {
    case '1':
        $proton_service_class[] = "xs";
    	break;
    case '2':
        $proton_service_class[] = "sm";
    	break;
    case '3':
        $proton_service_class[] = "md";
    	break;
    case '4':
        $proton_service_class[] = "lg";
    	break;
    case '5':
        $proton_service_class[] = "xl";
    	break;
}

// Title Size
if ($proton_service_title_size == '7' && $proton_service_title_custom_size) {
    $proton_service_title_style[] = "font-size: ". $proton_service_title_custom_size ."px; line-height: ". $proton_service_title_custom_size ."px;";
} else {
    switch ($proton_service_title_size) {
        case '1':
            $proton_service_title_class[] = "h1";
	        break;
        case '2':
            $proton_service_title_class[] = "h2";
	        break;
        case '3':
            $proton_service_title_class[] = "h3";
	        break;
        case '4':
            $proton_service_title_class[] = "h4";
	        break;
        case '5':
            $proton_service_title_class[] = "h5";
	        break;
        case '6':
            $proton_service_title_class[] = "h6";
	        break;
    }
}

// Link
$proton_service_link = vc_build_link( $proton_service_url );

// Extra Class
if ($el_class) {
	$proton_service_class[] = $el_class;
}

// CSS Editor
if ($proton_css) {
	$proton_service_class[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($proton_css, ''), $this->settings['base'], $atts);
}

?>
<div class="<?php echo esc_attr(implode(' ', $proton_service_class)) ?>">
<?php
    if ($proton_service_url) {
        echo "<a href=". $proton_service_link['url'] ." target=". $proton_service_link['target'] ."  rel=". $proton_service_link['rel'] .">";
    }
?>
    <?php if ($proton_service_icon_position != '4' && $proton_service_icon || $proton_service_image) : ?>
        <div class="service-icon">
            <?php if ($proton_service_icon) : ?>
                <i style="<?php echo esc_attr(implode(' ', $proton_service_icon_style)) ?>" class="<?php echo esc_attr(implode(' ', $proton_service_icon_arr)) ?>"></i>
            <?php elseif ($proton_service_image) : ?>
                <img src="<?php echo esc_url($proton_service_icon_image['0']) ?>">
            <?php endif; ?>
        </div>
    <?php endif; ?>
	<?php if ($content || $proton_service_title) : ?>
	    <div class="service-content">
			<?php if ($proton_service_title) : ?>
		        <h3 class="<?php echo esc_attr(implode(' ', $proton_service_title_class)) ?>" style="<?php echo esc_attr(implode(' ', $proton_service_title_style)) ?>"><?php echo esc_attr($proton_service_title) ?></h3>
			<?php endif; ?>
			<?php echo ($content) ? wpautop($content) : ""; ?>
	    </div>
	<?php endif; ?>
    <?php if ($proton_service_icon_position  == '4') : ?>
        <div class="service-icon">
            <?php if ($proton_service_icon) : ?>
                <i style="<?php echo esc_attr(implode(' ', $proton_service_icon_style)) ?>" class="<?php echo esc_attr(implode(' ', $proton_service_icon_arr)) ?>"></i>
            <?php elseif ($proton_service_images) : ?>
                <img src="<?php echo esc_url($proton_service_icon_image['0']) ?>">
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php
    if ($proton_service_url) {
        echo "</a>";
    }
?>
</div>
