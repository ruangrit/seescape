<?php
get_header();

global $proton_options;

if (proton_get_rdx_option('proton_404_title')) {
	$proton_404_title = proton_get_rdx_option('proton_404_title');
} else {
	$proton_404_title = esc_html__("404", "proton");
}

if (proton_get_rdx_option('proton_404_description')) {
	$proton_404_description = proton_get_rdx_option('proton_404_description');
} else {
	$proton_404_description = esc_html__("Not Found", "proton");
}

?>
	<div class="container">
		<div class="page-title error xl-top-padding xl-bottom-padding">
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<h1><?php echo esc_attr($proton_404_title); ?></h1>
					<h2><?php echo esc_attr($proton_404_description); ?></h2>
				</div>
			</div>
		</div>
	</div>
<?php
get_footer();
