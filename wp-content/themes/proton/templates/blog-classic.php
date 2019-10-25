<?php

// Blog Classic
global $proton_options, $author, $categories, $date;

?>
<div class="blog-post-holder md-bottom-padding">
	<?php if (has_post_thumbnail()) : ?>
		<div class="blog-img">
			<a href="<?php the_permalink(); ?>">
			    <?php the_post_thumbnail(); ?>
			</a>
		</div>
	<?php endif; ?>
	<div class="blog-info">
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<ul class="post-info">
            <?php
                // Author
                if ($author == 1) {
                    echo "<li>";
                    echo esc_html__('by ', 'proton');
                    the_author();
                    echo "</li>";
                }
                // Categories
                if ($categories == 1) {
                    echo "<li>";
                    echo esc_html__('in ', 'proton');
                    the_category(' ');
                    echo "</li>";
                }
                // Date
                if ($date == 1) {
                    echo "<li>";
                    echo esc_html__('posted ', 'proton');
                    echo "<span>";
                    the_time('F j, Y');
                    echo "</span></li>";
                }
            ?>
		</ul>
		<?php echo wpautop(excerpt(45)); ?>
		<a href="<?php the_permalink(); ?>" class="button main-color"><?php echo esc_html__('Read More', 'proton') ?></a>
	</div>
</div>
