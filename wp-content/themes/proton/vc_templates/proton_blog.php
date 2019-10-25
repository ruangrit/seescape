<?php

// Blog - NeuronElement
global $proton_options, $author, $categories, $date;
$holder_class[] = "blog";
extract(
	shortcode_atts(
		array(
			'category' => 'all',
			'posts_per_page' => '',
			'layout' => '1',
			'columns' => '1',
			'sidebar' => '2',
			'pagination_position' => '1',
			'show_author' => '1',
			'show_categories' => '1',
			'show_date' => '1',
			'el_class' => '',
	        'css' => ''
		),
		$atts
	)
);

// Category
if ($category) {
	$category_arr = explode(',', $category);

	// Taxonmy Operator
	if (in_array('all', $category_arr)) {
		$loop_operator = "NOT IN";
	} else {
		$loop_operator = "IN";
	}
}

// Layout
$blog_holder[] = "blog-content";
$sidebar_holder[] = "sidebar";
if ($layout == '2') {
    $blog_holder[] = "minimal-blog";
} elseif ($layout == '3') {
    $blog_holder[] = "creative-blog blog-grid";
}

// Columns
$item_holder[] = "blog-post selector";
switch ($columns) {
    case '2':
        $item_holder[] = "col-md-6 col-sm-6 col-xs-12";
        break;
    case '3':
        $item_holder[] = "col-md-4 col-sm-6 col-xs-12";
        break;
    case '4':
        $item_holder[] = "col-md-3 col-sm-6 col-xs-12";
        break;
    default:
        $item_holder[] = "col-sm-12";
        break;
}

// Sidebar
switch ($sidebar) {
    case '1':
        $blog_holder[] = "col-sm-9 pull-right";
        $sidebar_holder[] = "col-sm-3";
        break;
    case '3':
        $blog_holder[] = "col-sm-12";
        break;
    default:
        $blog_holder[] = "col-sm-9";
        $sidebar_holder[] = "col-sm-3";
        break;
}

// Pagination Position
$pagination_holder = "";
if (!$pagination_position) {
    $pagination_position = 1;
}

if ($pagination_position == '1') {
    $pagination = proton_get_rdx_option('blog_pagination_position');
} else {
    $pagination = $pagination_position - 1;
}

if ($pagination == '2') {
    $pagination_holder = "align-center";
} elseif ($pagination == '3') {
    $pagination_holder = "align-right";
}

// Show Author
if (!$show_author) {
    $show_author = 1;
}

if ($show_author == '1') {
    $author = proton_get_rdx_option('blog_author_info');
} else {
    $author = $show_author - 1;
}

// Show Categories
if (!$show_categories) {
    $show_categories = 1;
}

if ($show_categories == '1') {
    $categories = proton_get_rdx_option('blog_categories');
} else {
    $categories = $show_categories - 1;
}

// Show Date
if (!$show_date) {
    $show_date = 1;
}

if ($show_date == '1') {
    $date = proton_get_rdx_option('blog_post_date');
} else {
    $date = $show_date - 1;
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
<div class="<?php echo esc_attr(implode(' ', $holder_class)) ?>">
    <div class="row">
        <div class="<?php echo esc_attr(implode(' ', $blog_holder)) ?>">
            <div class="row masonry">
                <?php
                    // Paged
                    if (get_query_var('paged')) {
                        $paged = get_query_var('paged');
                    } elseif (get_query_var('page')) {
                        $paged = get_query_var('page');
                    } else {
                        $paged = 1;
                    }

                    $args = array(
                        'post_type' => 'post',
                        'paged' => $paged,
                        'posts_per_page' => $posts_per_page,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'slug',
                                'terms' => $category_arr,
                                'operator' => $loop_operator
                            )
                        )
                    );

                    $query = new WP_Query($args);

                    if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
                ?>
                    <div id="post-<?php the_ID(); ?>" <?php post_class('blog-post selector' . " " . implode(' ', $item_holder)); ?>>
                        <?php
                            switch ($layout) {
                                case '2':
                                    get_template_part('templates/blog-minimal');
                                    break;
                                case '3':
                                    get_template_part('templates/blog-creative');
                                    break;
                                default:
                                    get_template_part('templates/blog-classic');
                                    break;
                            }
                        ?>
                    </div>
                <?php endwhile; endif; wp_reset_postdata(); ?>
            </div>
        </div>
        <?php if ($sidebar != '3') : ?>
            <div class="<?php echo esc_attr(implode(' ', $sidebar_holder)) ?>">
                <?php get_sidebar(); ?>
            </div>
        <?php endif; ?>
    </div>
    <?php
        if ($query->max_num_pages > 1) {
            echo "<div class=". $pagination_holder .">";
            proton_pagination($query->max_num_pages);
            echo "<div>";
        }
    ?>
</div>
