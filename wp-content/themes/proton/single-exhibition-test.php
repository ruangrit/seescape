<?php
get_header();

if (have_posts()) {
	while (have_posts()) {
		the_post();
		if (get_field("proton_post_type") == '2') {
			get_template_part('templates/single-portfolio');
		} else {
			get_template_part('templates/single-blog');

		}
	}
}

get_footer();
