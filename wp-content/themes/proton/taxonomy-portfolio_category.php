<?php
get_header();

global $proton_options;

$proton_archive_page_title = get_field('proton_archive_page_title', get_queried_object());
$proton_archive_columns = get_field('proton_archive_columns', get_queried_object());

switch ($proton_archive_columns) {
	case '1':
		$columns = "col-sm-12";
		break;
	case '2':
		$columns = "col-sm-6";
		break;
	case '4':
		$columns = "col-sm-3 col-sm-4 col-xs-12";
		break;
	default:
		$columns = "col-md-4 col-sm-6 col-xs-12";
		break;
}
?>
<div class="container">
	<?php if ($proton_archive_page_title != 'empty') : ?>
		<div class="page-title ml-top-padding">
			<div class="row">
				<div class="col-md-9 col-xs-12">
					<?php
						if ($proton_archive_page_title) {
							$archive_page_title = $proton_archive_page_title;
						} else {
							$archive_page_title = esc_html__('All posts in this taxonomy.', 'proton');
						}
					?>
					<h1><?php echo esc_attr($archive_page_title) ?></h1>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<div class="portfolio md-top-padding">
		<div class="row masonry">
			<?php
				$args = array_merge(
					$wp_query->query_vars, array(
						'post_type' => 'portfolio'
					)
				);
				$query = new WP_Query($args);

				if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
			?>
			<div class="<?php echo esc_attr($columns) ?> selector">
				<div class="item-holder">
					<div class="item">
						<div class="overlay-background"></div>
						<div class="overlay">
							<div class="inner-overlay">
								<h3><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<span>
									<?php
										$terms = get_the_terms(get_the_ID(), 'portfolio_category');
										if (proton_get_rdx_option('proton_portfolio_categories_link')) {
											foreach ($terms as $term) {
												$term_link = get_term_link($term);
												echo " <a href=". $term_link .">". $term->name ."</a>";
											}
										} else {
											foreach ($terms as $term) {
												echo $term->name . " ";
											}
										}
									?>
								</span>
							</div>
						</div>
					</div>
					<?php
						if (has_post_thumbnail()) {
							the_post_thumbnail();
						} else {
							echo '<img src="' . get_template_directory_uri() . '/assets/images/default.png" />';
						}
					?>
				</div>
			</div>
			<?php endwhile; endif; wp_reset_postdata(); ?>
		</div>
	</div>
</div>
<?php
get_footer();
