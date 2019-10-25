<?php
/* Template Name: Contact */
get_header();

global $proton_options;

// Page Title
get_template_part('templates/page-title');
?>
<div class="container">
<?php
	$proton_contact_form_alignment = get_field("proton_contact_form_alignment");
	$proton_contact_show_map = get_field("proton_contact_show_map");
	switch ($proton_contact_form_alignment) {
		case '2':
			$proton_contact_form_holder = "col-md-8 col-sm-8 col-xs-12 pull-right";
			$proton_contact_form_sidebar = "col-md-4 col-sm-4 col-xs-12 sidebar";
			break;
		default:
			$proton_contact_form_holder = "col-md-9 col-sm-9 col-xs-12";
			$proton_contact_form_sidebar = "col-md-3 col-sm-3 col-xs-12 sidebar";
			break;
	}

	switch ($proton_contact_show_map) {
		case true:
			$proton_contact_container = "contact second-contact";
			break;
		default:
			$proton_contact_container = "contact";
			break;
	}

	if(have_posts()) : while(have_posts()) : the_post();
?>
	<div class="sm-top-padding <?php echo esc_attr($proton_contact_container); ?>">
		<div class="sm-bottom-padding <?php echo esc_attr(($proton_contact_show_map == true) ? 'contact-map' : 'display-none'); ?>">
			<div id="map"></div>
		</div>
		<div class="row">
			<div class="<?php echo esc_attr($proton_contact_form_holder); ?>">
				<div class="contact-form">
					<?php echo do_shortcode('[acf field="proton_contact_form"]'); ?>
				</div>
			</div>
			<div class="<?php echo esc_attr($proton_contact_form_sidebar); ?>">
				<?php the_content(); ?>
				<?php if(have_rows("proton_contact_social_icons")) : ?>
					<div class="social-icons">
						<h4><?php echo esc_attr(get_field("proton_social_media_title")); ?></h4>
						<ul>
							<?php while(have_rows("proton_contact_social_icons")) : the_row(); ?>
								<li>
									<a target="_BLANK" href="<?php echo esc_attr(get_sub_field("proton_contact_social_icons_link")); ?>">
										<i class="fa <?php echo esc_attr(get_sub_field("proton_contact_social_icons_icon")); ?>"></i>
									</a>
								</li>
							<?php endwhile; ?>
						</ul>
					</div>
				<?php endif; ?>
				<?php
					if(is_active_sidebar('sidebar-2')){
						dynamic_sidebar('sidebar-2');
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php
endwhile; endif;

get_footer();

$map_latitude = get_field('proton_contact_map_latitude');
$map_longitude = get_field('proton_contact_map_longitude');

if ($proton_contact_show_map && $map_latitude && $map_longitude) {
	if (proton_get_rdx_option('proton_style') == 'classic') {
		proton_map_classic($map_latitude, $map_longitude);
	} else {
		proton_map_modern($map_latitude, $map_longitude);
	}
}
