<?php

// Template: Single Blog

global $proton_options;

// Page Title
get_template_part('templates/page-title');
?>
<div class="container">
    <?php

        // Blog Single Layout Options
        $blog_single_layout = proton_get_rdx_option('blog_single_layout');
        $blog_single_sidebar = proton_get_rdx_option('blog_single_sidebar');
        $blog_single_layout_post = "col-md-9 col-sm-9 col-xs-12 blog-content";
        $blog_single_layout_sidebar = "col-md-3 col-sm-3 col-xs-12 sidebar";

        if($blog_single_layout == '2'){
            $blog_single_layout_post = "col-md-12 blog-content";
            $blog_single_layout_sidebar = "display-none";
        }

        switch($blog_single_sidebar){
            case '1':
                $blog_single_layout_post .= " pull-right";
                break;
            case '3':
                $blog_single_layout_sidebar .= " display-none";
                $blog_single_layout_post .= " col-lg-12";
                break;
        }

        // Blog Single Thumbnail & Author & Category & Post Date Options & Pagination
        $blog_single_thumbnail = proton_get_rdx_option('blog_single_thumbnail');
        $blog_single_author_info = proton_get_rdx_option('blog_single_author_info');
        $blog_single_categories = proton_get_rdx_option('blog_single_categories');
        $blog_single_post_date = proton_get_rdx_option('blog_single_post_date');
        $blog_single_next_previous = proton_get_rdx_option('blog_single_next_previous');
    ?>
    <div class="blog blog-single sm-top-padding">
        <div class="row">
            <div class="<?php echo esc_attr($blog_single_layout_post) ?>">
                <div class="blog-post">
                    <div class="blog-img">
                        <?php
                            if(has_post_thumbnail() && $blog_single_thumbnail){
                                the_post_thumbnail();
                            }
                        ?>
                    </div>
                    <div class="blog-info">
                        <h2><?php the_title(); ?></h2>
                        <ul class="post-info">
                            <?php if($blog_single_author_info) : ?>
                                <li><?php echo esc_attr__("by", "proton") ?> <?php the_author_posts_link(); ?></li>
                            <?php
                                endif;
                                if($blog_single_categories) :
                            ?>
                            <li><?php echo esc_attr__("in", "proton") ?> <?php the_category(' '); ?></li>
                            <?php
                                endif;
                                if($blog_single_post_date) :
                            ?>
                            <li><?php echo esc_attr__("posted", "proton") ?> <span><?php the_time('F j, Y'); ?></span></li>
                            <?php endif; ?>
                        </ul>
                        <?php the_content(); ?>
                        <?php if($blog_single_next_previous) : ?>
                            <div class="single-navigation">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6 prev">
                                        <?php previous_post_link('%link',"<i class='fa fa-angle-left'></i><span>". esc_attr__("Previous Post", "proton") ."</span>", true); ?>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 next">
                                        <?php next_post_link('%link',"<span>". esc_attr__("Next Post", "proton") ."</span><i class='fa fa-angle-right'></i>", true); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php comments_template(); ?>
            </div>
            <div class="<?php echo esc_attr($blog_single_layout_sidebar); ?>">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>
