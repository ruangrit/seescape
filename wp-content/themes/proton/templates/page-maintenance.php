<?php

// Maintenance Mode
add_filter('proton_display_header', '__return_false');
add_filter('proton_display_footer', '__return_false');

global $proton_options;

$proton_maintenance_title = proton_get_rdx_option('proton_maintenance_title');
$proton_maintenance_description = proton_get_rdx_option('proton_maintenance_description');
$proton_maintenance_mode_button = proton_get_rdx_option('proton_maintenance_mode_button');
$proton_maintenance_mode_button_text = proton_get_rdx_option('proton_maintenance_mode_button_text');
$proton_maintenance_mode_button_url = proton_get_rdx_option('proton_maintenance_mode_button_url');

get_header();

?>
<div class="maintenance-holder background-absolute">
    <div class="full-width-section full-height">
        <div class="vertical-aligment">
            <div class="col-md-6 col-sm-10 col-md-offset-3 col-sm-offset-1 col-xs-12">
                <h1><?php echo esc_attr($proton_maintenance_title ? $proton_maintenance_title : esc_html__('Maintenance Mode', 'proton')) ?></h1>
                <p><?php echo esc_attr($proton_maintenance_title ? $proton_maintenance_description : esc_html__("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed semper pretium tem. Praesent velit nunc, porta vel sem bibendum, condimentum convallis nunc. Proin maximus finibus ultricies curabitur mi justo, consequat a augue non, sceleris.", 'proton')) ?></p>
    			<?php if ($proton_maintenance_mode_button && $proton_maintenance_mode_button_text) : ?>
    				<div class="button-holder">
    					<a class="button main-color" href="<?php echo esc_url($proton_maintenance_mode_button_url) ?>"><?php echo esc_attr($proton_maintenance_mode_button_text) ?></a>
    				</div>
    			<?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php

get_footer();
