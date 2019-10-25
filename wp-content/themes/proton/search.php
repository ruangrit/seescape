<?php
// Search Page
get_header();
global $proton_options;
?>
<div class="container">
	<?php
		if (proton_get_rdx_option('proton_search_page_title') != 'empty') :
	?>
		<div class="page-title ml-top-padding">
			<div class="row">
				<div class="col-md-9 col-xs-12">
					<?php
						if (proton_get_rdx_option('proton_search_page_title')) {
							$search_page_title = proton_get_rdx_option('proton_search_page_title');
						} else {
							$search_page_title = esc_html__("All search results in this critea.", "proton");
						}
					?>
					<h1><?php echo esc_attr($search_page_title); ?></h1>
				</div>
			</div>
		</div>
	<?php
		endif;
	?>
	<div class="portfolio">
		<?php
			$args = array_merge( $wp_query->query_vars, array(
				'post_type' => array('exhibition', 'post', 'artist', 'curator', 'artwork')
			));

			$query = new WP_Query($args);

			if($query->have_posts()) :
		?>
		<div class="row masonry md-top-padding">
			<?php
				switch (proton_get_rdx_option('proton_search_columns')) {
					case '1':
						$item_column = "col-xs-12 selector";
						break;
					case '2':
						$item_column = "col-sm-6 selector";
						break;
					default:
						$item_column = "col-md-4 col-sm-6 selector";
						break;
					case '4':
						$item_column = "col-md-3 col-sm-4 col-xs-12 selector";
						break;
				}

				while($query->have_posts()) : $query->the_post();
			?>
			<div class="<?php echo esc_attr($item_column); ?>">
				<div class="item-holder">
					<div class="item">
						<div class="overlay-background"></div>
						<div class="overlay">
							<div class="inner-overlay">
								<?php $proton_post_type = get_field("proton_post_type"); ?>
								<h3><a href="<?php echo esc_attr($proton_post_type == '3') ? excerpt(50) : the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<span><?php the_category(', ') ?></span>
							</div>
						</div>
					</div>
					<?php
						if(has_post_thumbnail()){
							the_post_thumbnail();
						}
						else {
							echo '<img src="' . get_template_directory_uri() . '/assets/images/default.png" />';
						}
					?>
				</div>
			</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<?php else : ?>
			<div class="page-title error xl-top-padding lg-bottom-padding">
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<h1><?php echo esc_attr__("404", "proton"); ?></h1>
						<h2><?php echo esc_attr__("Not Found", "proton"); ?></h2>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php
get_footer();
