<?php

// Template: Single Portfolio
/**
 * Is called only in post type post
 */
global $proton_options;

// Layout
$portfolio_item_layout = proton_get_rdx_option('portfolio_item_layout');
$proton_project_single_style = get_field("proton_project_single_style");
$proton_project_single_style_content = "col-md-5 col-sm-12 col-xs-12";
$proton_project_single_style_gallery = "col-md-6 col-md-offset-1 project-photos col-sm-12 col-xs-12";
$proton_project_single_style_row = "row";

if(!$proton_project_single_style){
	$proton_project_single_style = 1;
}

if($proton_project_single_style == '1'){
	$proton_project_single_style = proton_get_rdx_option('portfolio_item_layout');
	$portfolio_item_layout = $proton_project_single_style;
}
else {
	$portfolio_item_layout = $proton_project_single_style - 1;
}

switch($portfolio_item_layout){
	case '2':
		$proton_project_single_style_content = "col-md-5 col-sm-12 pull-right";
		$proton_project_single_style_gallery = "col-md-7 project-photos col-sm-12";
	break;
	case '3':
		$proton_project_single_style_content = "col-md-12";
		$proton_project_single_style_gallery = "col-md-12 project-photos";
	break;
	case '4':
		$proton_project_single_style_content = "col-md-12 order-content";
		$proton_project_single_style_gallery = "col-md-12 project-photos order-gallery";
		$proton_project_single_style_row = "row order-single";
}

// Columns
$portfolio_item_gallery_columns = proton_get_rdx_option('portfolio_item_gallery_columns');
$proton_project_gallery_columns = get_field("proton_project_gallery_columns");
$proton_project_gallery_cols = "selector col-md-12";

if(!$proton_project_gallery_columns){
	$proton_project_gallery_columns = 1;
}

if($proton_project_gallery_columns == '1'){
	$proton_project_gallery_columns = proton_get_rdx_option('portfolio_item_gallery_columns');
	$portfolio_item_gallery_columns = $proton_project_gallery_columns;
} else {
	$portfolio_item_gallery_columns = $proton_project_gallery_columns - 1;
}

switch ($portfolio_item_gallery_columns) {
	case '2':
		$proton_project_gallery_cols = "selector col-md-6 col-sm-6 col-xs-12";
		break;
	case '3':
		$proton_project_gallery_cols = "selector col-md-4 col-sm-6 col-xs-12";
		break;
}

// Hide category
$portfolio_item_categories = proton_get_rdx_option('portfolio_item_categories');
?>
<div class="container">
    <div class="project-single md-top-padding">
        <div class="<?php echo esc_attr($proton_project_single_style_row); ?>">
            <div class="<?php echo esc_attr($proton_project_single_style_content); ?>">
                <div class="single-info">
                    <div class="project-description">
                        <h3><?php the_title(); ?></h3>
                        <?php if($portfolio_item_categories) :  ?>
                            <span><?php the_category(' '); ?></span>
                        <?php
							endif;
                        	the_content();

							// Tabs
							get_template_part('templates/single-tabs');

							// Share
							get_template_part('templates/single-share');
						?>
                    </div>
                </div>
            </div>
            <div class="<?php echo esc_attr($proton_project_single_style_gallery); ?>">
                <?php
                    // Embed Videos
                    $proton_project_single_embed_video = get_field("proton_project_single_embed_video");
                    $portfolio_item_embed_position = proton_get_rdx_option('portfolio_item_embed_position');
                    if($proton_project_single_embed_video && $portfolio_item_embed_position == '1'){
                        echo $proton_project_single_embed_video;
                    }

                    // Fancybox
                    $portfolio_item_gallery = proton_get_rdx_option('portfolio_item_gallery');
                    $proton_portfolio_item_gallery = get_field("proton_portfolio_item_gallery");
                    if($portfolio_item_gallery == true || $proton_portfolio_item_gallery){
                        $project_single_gallery = "row masonry project-single-gallery";
                    }
                    else {
                        $project_single_gallery = "row masonry";
                    }
                ?>
                <div class="<?php echo esc_attr($project_single_gallery); ?>">
                    <?php if(have_rows("proton_project_single_gallery")) : while(have_rows("proton_project_single_gallery")) : the_row(); ?>
                        <div class="<?php echo esc_attr($proton_project_gallery_cols); ?>">
                            <?php
                                $proton_project_single_gallery_img = get_sub_field("proton_project_single_gallery_img");
                                $proton_project_single_gallery_description = get_sub_field("proton_project_single_gallery_description");
                                if($portfolio_item_gallery || $proton_portfolio_item_gallery){
                                    $project_single_image_url = $proton_project_single_gallery_img['url'];
                                }
                                else {
                                    $project_single_gallery = "row masonry";
                                    $project_single_image_url = "#";
                                }
                            ?>
                            <a title="<?php echo $proton_project_single_gallery_description; ?>" href="<?php echo esc_attr($project_single_image_url); ?>">
                                <img src="<?php echo esc_url($proton_project_single_gallery_img['url']); ?>" alt="">
                                <?php
                                    if($proton_project_single_gallery_description){
                                        echo "<h5>" . $proton_project_single_gallery_description . "</h5>";
                                    }
                                ?>
                            </a>
                        </div>
                    <?php endwhile; endif; ?>
                </div>
                <?php
                    // Embed Video on bottom
                    if($proton_project_single_embed_video && $portfolio_item_embed_position == '2'){
                        echo $proton_project_single_embed_video;
                    }
                ?>
            </div>
        </div>
        <?php if (proton_get_rdx_option('portfolio_item_navigation')) : ?>
            <div class="single-navigation">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6 prev">
                        <?php
							if (get_post_type() == 'portfolio') {
								previous_post_link('%link', "<i class='fa fa-angle-left'></i><span>". esc_html__('Previous Project', 'proton') . "</span>", true, '', 'portfolio_category');
							} else {
								previous_post_link('%link',"<i class='fa fa-angle-left'></i><span>". esc_html__('Previous Project', 'proton') ."</span>", true);
							}
						?>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 next">
                        <?php
							if (get_post_type() == 'portfolio') {
								next_post_link('%link', "<span>" . esc_html__('Next Project', 'proton') . "</span><i class='fa fa-angle-right'></i>", true, '', 'portfolio_category');
							} else {
								next_post_link('%link',"<span>". esc_html__('Next Project', 'proton') ."</span><i class='fa fa-angle-right'></i>", true);
							}
						?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
