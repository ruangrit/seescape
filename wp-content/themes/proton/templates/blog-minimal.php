<?php

// Blog Minimal
global $proton_options, $author, $categories, $date;

?>
<div class="blog-post-holder row md-bottom-padding">
	<div class="blog-img col-md-5 col-sm-12">
        <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail();
            } else {
                echo '<img src="' . get_template_directory_uri() . '/assets/images/default.png" />';
            }
        ?>
	</div>
	<div class="blog-info col-md-7 col-sm-12">
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
