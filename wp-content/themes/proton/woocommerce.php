<?php
get_header();

global $proton_options;

if(is_singular('product')){
	$proton_shop_container = "col-md-12 col-sm-12 col-xs-12";
	$proton_shop_sidebar = "display-none";
}
else {
	$proton_shop_container = "col-md-9 col-sm-12 col-xs-12 woo-padding";
	$proton_shop_sidebar = "col-md-3 col-sm-12 col-xs-12 sidebar";
}
$shop_columns = proton_get_rdx_option('shop_columns');

if($shop_columns == '2'){
	$proton_shop_container = "col-md-12 col-sm-12 col-xs-12 woo-padding";
	$proton_shop_sidebar = "display-none";
}
?>
<div class="container">
	<?php
		$proton_page_title = proton_get_rdx_option('shop_page_title');
		if($proton_page_title && !is_singular('product')) :
	?>
		<div class="page-title ml-top-padding">
			<div class="row">
				<div class="col-md-12">
					<h1><?php echo $proton_page_title; ?></h1>
				</div>
			</div>
		</div>
	<?php
		endif;
	?>
	<div class="shop sm-top-padding">
		<div class="row">
			<div class="<?php echo esc_attr($proton_shop_container); ?>">
				<?php if(have_posts()) : ?>
					<?php woocommerce_content(); ?>
				<?php endif; ?>
			</div>
			<div class="<?php echo esc_attr($proton_shop_sidebar); ?>">
				<?php
					if(is_active_sidebar('sidebar-3')){
						dynamic_sidebar('sidebar-3');
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php

get_footer();
