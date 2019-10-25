<?php

// Portfolio - NeuronElement
global $proton_options;
$holder_class[] = "portfolio";

extract(
	shortcode_atts(
		array(
			'loop' => 'order_by:date',
			'sortable' => '',
			'filters_string' => '',
			'posts_per_page' => '',
			'button_link' => '',
			'style' => '1',
			'hover_style' => '1',
			'metro_layout' => '',
			'columns' => '1',
			'text_position' => '1',
			'hover_effect' => '1',
			'pagination' => '1',
			'show_more' => '',
			'el_class' => '',
	        'css' => ''
		),
		$atts
	)
);

// Category
$portfolio_loop_query = explode('|', $loop);
$portfolio_tax_query = $portfolio_order_by = '';
foreach ($portfolio_loop_query as $arr) {
	if (strpos($arr, 'order_by') !== false) {
		$portfolio_order_by = $arr;
	}

	if (strpos($arr, 'tax_query') !== false) {
		$portfolio_tax_query = $arr;
	}
}

$portfolio_order = str_replace('order_by:', '', $portfolio_order_by);
$portfolio_query = str_replace('tax_query:', '', $portfolio_tax_query);
$portfolio_taxonomies = explode(',', $portfolio_query);

// Taxonmy operator
if ($portfolio_tax_query) {
	$loop_operator = "IN";
} else {
	$loop_operator = "NOT IN";
}

// Style
$proton_portfolio_masonry_row[] = "row masonry";
if (!$style) {
	$style = 1;
}

if ($style == '1') {
	$portfolio_style = proton_get_rdx_option('portfolio_style');
} else {
	$portfolio_style = $style - 1;
}

// Hover Style
if (!$hover_style) {
	$hover_style = 1;
}

if ($hover_style == '1') {
	$portfolio_hover = proton_get_rdx_option('portfolio_hover');
} else {
	$portfolio_hover = $hover_style - 1;
}

if ($portfolio_style == '1' || $portfolio_style == '2') {
	if($portfolio_hover == '3' || $portfolio_hover == '6'){
		$proton_portfolio_masonry_row[] = "active-gallery";
	}
} else if ($portfolio_style == '3' || $portfolio_style == '4') {
	$proton_portfolio_masonry_row[] = "meta-tags-holder";
}

if ($portfolio_style == '2' || $portfolio_style == '4' || $portfolio_style == '6') {
	$proton_portfolio_masonry_row[] = "no-space";
}

// Columns
$item_holder = "selector";
if (!$columns) {
	$columns = 1;
}

if ($columns == '1') {
	$portfolio_columns = proton_get_rdx_option('portfolio_columns');
} else {
	$portfolio_columns = $columns - 1;
}

switch ($portfolio_columns) {
	case '1':
		$item_holder = "col-md-6 col-sm-6 col-xs-12";
		break;
	case '3':
		$item_holder = "col-md-3 col-sm-6 col-xs-12";
		break;
	case '4':
		$item_holder = "five-column col-sm-4 col-xs-12";
		break;
	default:
		$item_holder = "col-md-4 col-sm-6 col-xs-12";
		break;
}

// Hover Effect
$portfolio_hover_effect = proton_get_rdx_option('portfolio_hover_effect');
if ($portfolio_hover_effect || $hover_effect == '2') {
	$proton_portfolio_masonry_row[] = "hover-effect";
}

// Text Position
$proton_text_position_holder = array();
$portfolio_meta_position = proton_get_rdx_option('portfolio_meta_position');

if (!$text_position) {
	$text_position = 1;
}

if ($text_position == '1') {
	$portfolio_meta_position = proton_get_rdx_option('portfolio_meta_position');
} else {
	$portfolio_meta_position = $text_position - 1;
}

switch ($portfolio_meta_position) {
	case '2':
		$proton_text_position_holder = "top-left-hover";
		break;
	case '3':
		$proton_text_position_holder = "top-right-hover";
		break;
	case '4':
		$proton_text_position_holder = "bottom-left-hover";
		break;
	case '5':
		$proton_text_position_holder = "bottom-right-hover";
		break;
}

if ($proton_text_position_holder) {
	$proton_portfolio_masonry_row[] = $proton_text_position_holder;
}

// Border Hover
if ($portfolio_hover == '4' || $portfolio_hover == '5' || $portfolio_hover == '6') {
	$proton_portfolio_masonry_row[] = "border-hover";
}

// Extra Class
if ($el_class) {
	$holder_class[] = $el_class;
}

// CSS Editor
if ($css) {
	$holder_class[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ''), $this->settings['base'], $atts);
}
?>
<div class="<?php echo esc_attr(implode(' ', $holder_class)); ?>">
    <?php if ($sortable && $portfolio_taxonomies) : ?>
        <div class="filters sm-bottom-padding">
			<?php
				// Filters
				if ($filters_string) {
					$before_filters = __($filters_string, 'proton');
				} else {
					$before_filters = __('Filters:', 'proton');
				}

				if ($filters_string != 'empty') :
			?>
	            <span><?php echo esc_attr($before_filters); ?></span>
			<?php endif; ?>
            <ul id="filters">
                <li class="active" data-filter="*"><?php echo esc_html__('All', 'proton'); ?></li>
                <?php
                    foreach ($portfolio_taxonomies as $filter) :
                    $term = get_term_by('id', $filter, 'portfolio_category');
                    if ($term) :
                ?>
                	<li data-filter=".<?php echo esc_attr($term->slug); ?>"><?php echo esc_attr($term->name); ?></li>
                <?php endif; endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
	<div class="<?php echo esc_attr(implode(' ', $proton_portfolio_masonry_row)) ?>">
		<?php
			// Paged
			if (get_query_var('paged')) {
				$paged = get_query_var('paged');
			} elseif (get_query_var('page')) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;
			}

			$proton_filter = isset($_GET['filter']) ? $_GET['filter'] : '';
			$proton_exclude = isset($_GET['exclude']) ? $_GET['exclude'] : '';

			$args = array(
				'post_type' => 'portfolio',
				'paged' => $paged,
				'posts_per_page' => $posts_per_page,
				'orderby' => $portfolio_order,
				'tax_query' => array(
					array(
						'taxonomy' => 'portfolio_category',
						'field' => 'term_id',
						'terms' => $portfolio_taxonomies,
						'operator' => $loop_operator
					)
				)
			);

			if ($proton_filter) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'portfolio_category',
						'field' => 'slug',
						'terms' => $proton_filter
					)
				);
			}

			if ($proton_exclude) {
				$args['post__not_in'] = $proton_exclude;
			}

			$query = new WP_Query($args);

			if ($query->have_posts()) : while($query->have_posts()) : $query->the_post();

			$filter_categories = get_the_terms(get_the_ID(), 'portfolio_category');
			$filter_array = array();
			if ($filter_categories) {
				foreach ($filter_categories as $category) {
					$filter_array[] = $category->slug;
				}
			}

			// Custom Column
			if ($metro_layout) {
				switch (get_field('metro_layout_column')) {
					case '1':
						$item_holder = "col-md-3 col-sm-4 col-xs-12";
						break;
					case '2':
						$item_holder = "col-md-4 col-xs-12";
						break;
					case '3':
						$item_holder = "col-md-5 col-sm-6 col-xs-12";
						break;
					case '4':
						$item_holder = "col-md-6 col-xs-12";
						break;
					case '5':
						$item_holder = "col-md-7 col-sm-6 col-xs-12";
						break;
					case '6':
						$item_holder = "col-md-8 col-sm-6 col-xs-12";
						break;
					case '7':
						$item_holder = "col-md-9 col-sm-12";
						break;
					case '8':
						$item_holder = "col-md-10 col-sm-12";
						break;
					case '9':
						$item_holder = "col-md-11 col-sm-12";
						break;
					case '10':
						$item_holder = "col-xs-12";
						break;
				}
			}
		?>
			<div class="selector <?php echo esc_attr($item_holder) . " " . implode(' ', $filter_array) ?>" data-id="<?php the_ID(); ?>">
				<div class="item-holder">
					<div class="item">
						<?php
							$proton_post_type = get_field("proton_post_type");
							$proton_post_url = get_permalink();
							if($proton_post_type == '3'){
								$proton_post_url = excerpt(50);
							} else {
								if ($portfolio_style == '1' || $portfolio_style == '2') {
									if ($portfolio_hover == '3' || $portfolio_hover == '6') {
										$proton_post_url = get_the_post_thumbnail_url();
									}
								}
							}
						?>
						<a class="full-overlay-link" href="<?php echo esc_attr($proton_post_url); ?>"></a>
						<?php if ($portfolio_style == '1' || $portfolio_style == '2') :  ?>
							<div class="overlay-background"></div>
							<div class="overlay">
								<div class="inner-overlay">
									<?php if ($portfolio_hover == '1' || $portfolio_hover == '2' || $portfolio_hover == '4' || $portfolio_hover == '5') : ?>
										<h3><a title="<?php the_title(); ?>" href="<?php echo esc_attr($proton_post_url) ?>"><?php the_title(); ?></a></h3>
									<?php endif; ?>
									<?php if ($portfolio_hover == '1' || $portfolio_hover == '4') : ?>
										<span>
											<?php
												$terms_array = array();
												$terms = get_the_terms(get_the_ID(), 'portfolio_category');
												if (proton_get_rdx_option('proton_portfolio_categories_link')) {
													foreach ($terms as $term) {
														$term_link = get_term_link($term);
														echo " <a href=". $term_link .">". $term->name ."</a>";
													}
												} else {
													foreach ($terms as $term) {
														$terms_array[] = $term->name;
													}
													echo implode(', ', $terms_array);
												}
											?>
										</span>
									<?php endif; ?>
									<?php if ($portfolio_hover == '3' || $portfolio_hover == '6') : ?>
										<h3 class="gallery-plus">+</h3>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
					<?php
						if (has_post_thumbnail()) {
							the_post_thumbnail();
						} else {
							$proton_count = count(get_the_category());
							if($proton_count >= 10){
								echo '<img src="' . get_template_directory_uri() . '/assets/images/default-tall.png" />';
							} else {
								echo '<img src="' . get_template_directory_uri() . '/assets/images/default.png" />';
							}
						}
					?>
				</div>
				<?php if ($portfolio_style == '3' || $portfolio_style == '4') :  ?>
					<div class="meta-tags-outside">
						<h3><a title="<?php the_title(); ?>" href="<?php echo esc_attr($proton_post_url) ?>"><?php the_title(); ?></a></h3>
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
				<?php endif; ?>
			</div>
		<?php endwhile; endif; wp_reset_postdata(); ?>
	</div>
	<?php
		$link = vc_build_link($button_link);
		if ($link['url']) :
	?>
		<div class="row">
			<div class="show-more-holder">
				<a target="<?php echo esc_attr($link['target']) ?>" rel="<?php echo esc_attr($link['rel']) ?>" class="button-show-more" href="<?php echo esc_url($link['url']); ?>">
					<?php echo esc_attr__($link['title'], 'proton'); ?>
				</a>
			</div>
		</div>
	<?php
		endif;

		// Show More Text
		if ($show_more) {
			$show_more_text = $show_more;
		} else {
			$show_more_text = esc_html__('Show More', 'proton');
		}
		// Pagination
		if ($pagination == '2' && $query->max_num_pages > $paged) {
		?>
			<div class="show-more-holder">
				<button type="button" class="button-show-more" id="load-more-posts"><?php echo esc_attr($show_more_text); ?></button>
			</div>
		<?php
		} else {
			proton_pagination($query->max_num_pages);
		}
	?>
</div>
