<?php
/* Template Name: About */
get_header();

// Page Title
get_template_part('templates/page-title');
?>
<div class="container">
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<div class="about sm-top-padding">
		<div class="about-img">
			<?php
	            if(has_post_thumbnail()){
	                the_post_thumbnail();
	            }
	        ?>
		</div>
		<div class="about-content sm-top-padding">
			<div class="about-info">
				<?php if(get_field("proton_about_title")) : ?>
					<h3><?php echo esc_attr(get_field("proton_about_title")); ?></h3>
				<?php endif; ?>
				<?php the_content(); ?>
			</div>
			<?php if(have_rows("proton_about_clients")) : ?>
			<div class="about-clients sm-top-padding">
				<h3><?php the_field("proton_about_clients_title") ?></h3>
				<div class="owl-carousel owl-theme" id="clients">
					<?php while(have_rows("proton_about_clients")) : the_row(); ?>
						<?php if(get_sub_field("proton_about_clients_url")) : ?>
							<a href="<?php esc_attr(the_sub_field("proton_about_clients_url")); ?>">
						<?php endif; ?>
							<img src="<?php echo esc_attr(the_sub_field("proton_about_clients_img")) ?>" alt="">
						<?php if(get_sub_field("proton_about_clients_url")) : ?>
							</a>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
			</div>
			<?php endif;  ?>
		</div>
	</div>
</div>
<?php
endwhile; endif;

get_footer();

$proton_about_client_columns = get_field("proton_about_client_columns");

if($proton_about_client_columns){
	$proton_about_client_cols = $proton_about_client_columns;
}
else {
	$proton_about_client_cols = 6;
}
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#clients').owlCarousel({
			items : 1,
			loop: true,
			dots: false,
			margin: 15,
			responsive: {
				768: {
					items: 3,
					margin: 30
				},
				992: {
					items: <?php echo esc_attr($proton_about_client_cols);  ?>,
				}
			}
		})
	});
</script>
