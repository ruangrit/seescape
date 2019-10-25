<?php

// Template: Single Share section
global $proton_options;


$proton_show_share = proton_get_rdx_option('proton_portfolio_item_show_share');
$proton_share = proton_get_rdx_option('proton_portfolio_item_share');
$proton_share_type = proton_get_rdx_option('proton_portfolio_item_share_type');
$proton_share_layout = proton_get_rdx_option('proton_portfolio_item_share_layout');
$proton_share_style = proton_get_rdx_option('proton_portfolio_item_share_style');
$proton_share_title = proton_get_rdx_option('proton_portfolio_item_share_title');

if ($proton_show_share) {
    proton_share_media($proton_show_share, $proton_share_type, $proton_share_layout, $proton_share_style, $proton_share_title, $proton_share);
}
