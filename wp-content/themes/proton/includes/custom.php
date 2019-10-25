<?php
function proton_custom_css() {
	global $proton_options;
	$proton_mini_cart = proton_get_rdx_option('proton_mini_cart');
	$proton_transition = proton_get_rdx_option('proton_transition');
	$proton_transition_duration = proton_get_rdx_option('proton_transition_duration');
	$proton_sticky_header = proton_get_rdx_option('proton_sticky_header');
	$proton_borders_activate = proton_get_rdx_option('proton_activate_borders');
	$proton_custom_css = proton_get_rdx_option('proton_custom_css');
	$proton_custom_js = proton_get_rdx_option('proton_custom_js');
	$proton_logo_width = proton_get_rdx_option('proton_logo_width');
	$proton_logo_height = proton_get_rdx_option('proton_logo_height');
	$proton_body_color = proton_get_rdx_option('proton_body_color');
    $proton_main_color = proton_get_rdx_option('proton_main_color');
	$proton_borders_color = proton_get_rdx_option('proton_borders_color');
	$proton_header_color = proton_get_rdx_option('proton_header_color');
	$proton_dropdown_color = proton_get_rdx_option('proton_dropdown_color');
	$proton_style = proton_get_rdx_option('proton_style');
    $proton_skin = proton_get_rdx_option('proton_skin');
	$proton_footer_color = proton_get_rdx_option('proton_footer_color');
	$proton_borders_size = proton_get_rdx_option('proton_borders_size');


    // Mini cart
	if(!class_exists('WooCommerce')){
		proton_generate_custom_css(".wrapper header nav ul {margin-right: 0 !important;}");
	}

	if(!$proton_mini_cart){
		proton_generate_custom_css("header #minicart {display: none !important;} .wrapper header nav ul {margin-right: 0 !important;}");
	}

	// Transition effect and duration
	$transition_classes = ".show-more-holder .button-show-more,
	.wrapper header,
	.wrapper header nav ul li a,
	.wrapper .portfolio .filters ul li,
	.wrapper header .logo,
	.wrapper header nav ul li ul,
	.wrapper header .hamburger .hamburger-inner,
	.wrapper header .hamburger .hamburger-inner:after,
	.wrapper header .hamburger .hamburger-inner:before,
	.wrapper header nav ul li a:after,
	.wrapper .portfolio .filters ul li:after,
	.slicknav_menu .slicknav_icon-bar,
	.slicknav_menu .slicknav_icon-bar:before,
	.slicknav_menu .slicknav_icon-bar:after,
	.wrapper .portfolio .item-holder .item .overlay-background,
	.wrapper .blog-grid .blog-post .blog-post-holder .blog-info,
	.blog .sidebar .widget ul li a,
	.blog .sidebar .widget .tagcloud a,
	.contact .contact-form input[type=submit],
	.wrapper .blog-single .comment-form input[type=submit],
	.wrapper .blog .blog-content .blog-post .blog-info .button,
	footer .footer-widgets .widget_text a,
	footer .footer-widgets .widget ul li a,
	footer .footer-widgets .widget_rotatingtweets_widget .rtw_meta a,
	footer .footer-copyright ul li a";

	if ($proton_transition == true) {
		if ($proton_transition_duration) {
			proton_generate_custom_css("$transition_classes { -webkit-transition: ". $proton_transition_duration ."s all; -o-transition: ". $proton_transition_duration ."s all; transition: ". $proton_transition_duration ."s all; }");
		}
	} elseif($proton_transition == false) {
        proton_generate_custom_css("$transition_classes { -webkit-transition: 0s all; -o-transition: 0s all; transition: 0s all; }");
	}

	// Borders Activate - Margins
	if ($proton_borders_activate == true) {
		proton_generate_custom_css(".fixed-footer { padding-bottom: 24px;}");
	}
	if ($proton_borders_activate == true && $proton_style == 'modern') {
		proton_generate_custom_css(".fixed-footer { padding-bottom: 0;}");
	}
	if ($proton_borders_size) {
		proton_generate_custom_css("
			.proton-borders .border-top, .proton-borders .border-right, .proton-borders .border-bottom, .proton-borders .border-left {padding: " . $proton_borders_size . "px}
			.proton-borders {margin: " . $proton_borders_size*2 . "px}
			.wrapper header.fixed {margin-top: " . $proton_borders_size*2 . "px}
            .fixed-footer { padding-bottom: ". $proton_borders_size*2 . "px }
            .mfp-gallery .mfp-container .mfp-arrow-left {left: ". ($proton_borders_size+40) ."px !important}
            .mfp-gallery .mfp-container .mfp-arrow-right {right: ". ($proton_borders_size+40) ."px !important}
		");
	}

	// Logo width and height
	if ($proton_logo_width) {
		proton_generate_custom_css(".wrapper header .logo img { width: ".$proton_logo_width ."px; }");
	}
	if ($proton_logo_height) {
		proton_generate_custom_css(".wrapper header .logo img { height: ".$proton_logo_height ."px; }");
	}

	// Style Options
	if ($proton_body_color) {
		proton_generate_custom_css("body, .wrapper header, footer, .loader { background-color: ". $proton_body_color ." !important;}");
	}
    if ($proton_main_color && $proton_skin == 'light') {
		$color_group = array(
			'color' => ".wrapper .portfolio .filters ul li:hover, .wrapper .project-single .single-navigation a:hover i, .wrapper .project-single .single-navigation a:hover span, .blog .sidebar .widget ul li a:hover, .blog .sidebar .widget .tagcloud a:hover, wrapper .blog .blog-content .blog-post .blog-info .post-info li a, .wrapper .blog .blog-content .blog-post .blog-info .post-info li span, footer .footer-widgets .widget ul li a:hover, footer .footer-widgets .widget_text a, footer .footer-widgets .widget_rotatingtweets_widget .rtw_meta a, footer .footer-copyright ul li a:hover, footer .footer-copyright a",
			'background-color' => ".wrapper header nav ul li a:after, .wrapper .portfolio .filters ul li:after, .contact .contact-form input[type=submit]:hover, .wrapper .blog-single .comment-form input[type=submit]:hover, .wrapper .blog .blog-content .blog-post .blog-info .button:hover, .wrapper .portfolio .item-holder .item .overlay-background",
			'selection-color' => "::selection, ::-moz-selection",
			'border-color' => ".wrapper .blog-single blockquote, show-more-holder .button-show-more:hover"
		);

		proton_generate_custom_css("". $color_group['color'] ." { color: ". $proton_main_color ." !important; }");
		proton_generate_custom_css("". $color_group['background-color'] ." { background-color: ". $proton_main_color ." !important; }");
		proton_generate_custom_css("". $color_group['selection-color'] ." { background-color: ". $proton_main_color ." !important; }");
		proton_generate_custom_css("". $color_group['border-color'] ." { border-color: ". $proton_main_color ." !important; }");

    } elseif($proton_main_color && $proton_skin == 'dark'){
		$color_group = array(
			'color' => "footer .footer-widgets .widget_text a, footer .footer-widgets .widget_rotatingtweets_widget .rtw_meta a, footer .footer-copyright ul li a:hover, .show-more-holder .button-show-more:hover, footer .footer-widgets .widget ul li a:hover, .blog .sidebar .widget ul li a:hover, .blog .sidebar .widget .tagcloud a, .wrapper .project-single .single-info .project-description span, .wrapper .project-single .single-navigation a:hover i, .wrapper .project-single .single-navigation a:hover span, .wrapper .contact .social-icons ul li a:hover, .wrapper .shop .product .summary .product_meta span a, .wrapper .portfolio .filters ul li.active, .wrapper .portfolio .filters ul li:hover, .wrapper .blog .blog-content .blog-post .blog-info .post-info li span,
            footer .footer-copyright a",
			'background-color' => ".wrapper .portfolio .item-holder .item .overlay, .wrapper .blog .blog-content .blog-post .blog-info .button, .page-pagination li.active, .page-pagination li:hover, .contact .contact-form input[type=submit], .wrapper .blog-single .comment-form input[type=submit], .wrapper .shop div.product .product_type_simple, .wrapper .shop .widget_shopping_cart .widget_shopping_cart_content .buttons a, .wrapper .shop .widget_price_filter form .price_slider_wrapper .price_slider_amount .button, .wrapper .shop .product .summary .cart .button, .wrapper header nav ul li a:after, .wrapper .portfolio .filters ul li:after, .sidebar .widget_search input#searchsubmit, .wrapper .shop .product .woocommerce-tabs #reviews #review_form_wrapper input, .contact .contact-form input[type=submit]:hover, .wrapper .blog .blog-content .blog-post .blog-info .button:hover, .wrapper .blog-single .comment-form input[type=submit]:hover, .wrapper .portfolio .filters ul li:after, .wrapper .portfolio .item-holder .item .overlay-background, .wrapper header nav ul li a:after",
			'border-color' => ".show-more-holder .button-show-more:hover, .wrapper .blog-single blockquote"
		);

		proton_generate_custom_css("". $color_group['color'] ." { color: ". $proton_main_color ." !important; }");
		proton_generate_custom_css("". $color_group['background-color'] ." { background-color: ". $proton_main_color ." !important; }");
		proton_generate_custom_css("". $color_group['border-color'] ." { border-color: ". $proton_main_color ." !important; }");

    }
	if($proton_borders_color){
		proton_generate_custom_css(".proton-borders .border-top, .proton-borders .border-right, .proton-borders .border-bottom, .proton-borders .border-left { background-color: ". $proton_borders_color ." !important;}");
	}
	if($proton_header_color){
		proton_generate_custom_css(".wrapper header nav ul li > a { color: ". $proton_header_color ." !important;}");
	}
	if($proton_dropdown_color){
		proton_generate_custom_css(".wrapper header nav ul li ul li a { color: ". $proton_dropdown_color ." !important;}");
	}

	// Custom CSS
	($proton_custom_css) ? proton_generate_custom_css($proton_custom_css) : "";

	// Footer Background color
	if($proton_footer_color){
		proton_generate_custom_css("footer {background-color:". $proton_footer_color . " !important}");
	}

    // Custom JS
    if($proton_custom_js){
        echo "<script>". $proton_custom_js  ."</script>";
    }
}

add_action('wp_head', 'proton_custom_css');
