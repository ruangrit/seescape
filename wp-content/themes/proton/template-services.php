<?php
/* Template Name: Services */
get_header();

// Page Title
get_template_part('templates/page-title');
?>
<div class="container">
	<?php
		if (have_posts()) {
			while (have_posts()) {
				the_post();
				the_content();
			}
		}
	?>
	<?php if(have_rows("proton_services_posts")) : ?>
		<div class="services">
			<?php
				$i = 1;
				while(have_rows("proton_services_posts")) : the_row();
			?>
				<?php if(get_sub_field("proton_services_posts_url")) : ?>
					<a href="<?php echo esc_attr(get_sub_field("proton_services_posts_url")); ?>">
				<?php endif; ?>
				<div class="service row md-top-padding">
					<div class="<?php echo esc_attr(($i % 2 == 0) ? 'col-md-6 col-sm-6 col-xs-12' : 'col-md-6 col-sm-6 col-xs-12 pull-right'); ?>">
						<img src="<?php echo esc_attr(get_sub_field("proton_services_posts_image")); ?>">
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="service-info-holder">
							<h3><?php echo esc_attr(get_sub_field("proton_services_posts_title")); ?></h3>
							<p><?php echo get_sub_field("proton_services_posts_content"); ?></p>
						</div>
					</div>
				</div>
				<?php if(get_sub_field("proton_services_posts_url")) : ?>
					</a>
				<?php endif; ?>
			<?php $i++; endwhile; ?>
		</div>
	<?php endif; ?>
</div>
<?php

get_footer();
