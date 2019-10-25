<?php

// Page Heading - NeuronElement
extract(
	shortcode_atts(
		array(
			'title' => '',
			'el_class' => '',
			'css' => ''
		),
		$atts
	)
);

$page_heading_class[] = "page-title";

// Extra Class
if ($el_class) {
	$page_heading_class[] = $el_class;
}

// CSS Editor
if ($css) {
	$page_heading_class[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ''), $this->settings['base'], $atts);
}

if ($content || $title) :

?>
    <div class="<?php echo esc_attr(implode(' ', $page_heading_class)) ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-title">
                    <?php
                        if ($title) {
                            echo "<b>" . $title . "</b>";
                        }

                        if ($content) {
                            echo wpautop($content);
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php

endif;
