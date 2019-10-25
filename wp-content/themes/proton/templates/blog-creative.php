<?php

// Blog Creative
global $proton_options, $author, $categories, $date;

?>
<div class="blog-post-holder sm-bottom-padding">
	<a class="permalink-creative" href="<?php the_permalink(); ?>"></a>
	<div class="blog-img">
        <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail();
            } else {
                echo '<img src="' . get_template_directory_uri() . '/assets/images/default-tall.png" />';
            }
        ?>
	</div>
	<div class="blog-info">
		<h2><?php the_title(); ?></h2>
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
		<div class="button main-color"><?php echo esc_html__('Read More', 'proton') ?></div>
	</div>
</div>
