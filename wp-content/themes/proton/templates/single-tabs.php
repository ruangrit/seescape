<?php

// Template: Tabs in Portfolio Single
// Is called only in POST
$proton_portfolio_item_tabs_class = "tabs";

if (have_rows('portfolio_item_custom_tabs')) :
?>
    <div class="<?php echo esc_attr($proton_portfolio_item_tabs_class); ?>">
    <?php
        // Custom Item Tabs
        $proton_portfolio_item_link_target = "_self";
        while (have_rows('portfolio_item_custom_tabs')) :
            the_row();
            if (get_sub_field('portfolio_item_custom_tabs_link_target')) {
                $proton_portfolio_item_link_target = "_BLANK";
            }
    ?>
        <div class="tab">
            <h4><?php echo esc_attr(get_sub_field('portfolio_item_custom_tabs_title')); ?></h4>
            <?php if (get_sub_field('portfolio_item_custom_tabs_type') == '2') : ?>
                <a target="<?php echo esc_attr($proton_portfolio_item_link_target) ?>" href="<?php echo esc_url(get_sub_field('portfolio_item_custom_tabs_link_url')) ?>"><?php echo esc_attr(get_sub_field('portfolio_item_custom_tabs_link_title')) ?></a>
            <?php else : ?>
                <p><?php echo get_sub_field('portfolio_item_custom_tabs_description') ?></p>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
    </div>
<?php
endif;
