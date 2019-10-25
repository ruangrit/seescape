<?php
/* Template Name: Gallery */
get_header();

// Page Title
get_template_part('templates/page-title');
?>
<div class="container">
	<div class="portfolio md-top-padding">
		<?php
			// The content of Page
			if (have_posts()) {
				while(have_posts()) {
					the_post();
					the_content();
				}
			}

			// Columns
			$proton_gallery_layout_item = "col-md-4 col-sm-6 col-xs-12 selector";
			$proton_gallery_columns = get_field("proton_gallery_columns");

			switch( $proton_gallery_columns ) {
				case '1':
					$proton_gallery_layout_col = "col-sm-12 selector";
				break;
				case '2':
					$proton_gallery_layout_col = "col-sm-6 selector";
				break;
				case '3':
				default:
					$proton_gallery_layout_col = "col-sm-4 selector";
				break;
				case '4':
					$proton_gallery_layout_col = "col-sm-3 selector";
				break;
			}

			if( have_rows( 'proton_gallery_posts' ) ) :
		?>
			<div class="row masonry active-gallery">
				<?php while( have_rows( 'proton_gallery_posts' ) ) : the_row(); ?>
					<div class="<?php echo esc_attr($proton_gallery_layout_col); ?>">
						<div class="item-holder">
							<div class="item">
								<a class="full-overlay-link" href="<?php echo esc_attr( get_sub_field( 'proton_gallery_posts_image' ) ); ?>"></a>
								<div class="overlay-background"></div>
								<div class="overlay">
									<div class="inner-overlay">
										<h3><?php echo esc_attr( get_sub_field( 'proton_gallery_posts_title' ) ); ?></h3>
									</div>
								</div>
							</div>
							<img src="<?php echo esc_attr( get_sub_field( 'proton_gallery_posts_image' ) ); ?>" alt="">
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php

get_footer();
