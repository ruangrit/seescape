<?php
get_header();

if(have_posts()) : while(have_posts()) : the_post();

$proton_vc = preg_match("/\[vc_row.*?\]/i", get_the_content());
$proton_page_layout = get_field("proton_page_layout");

if ($proton_vc && function_exists('vc_map')) {
	$proton_page_class = "n-container";
} else {
	$proton_page_class = "container";
}

if ($proton_page_layout == '2') {
	$page_content = "col-sm-9 vc-row-inner";
	$page_sidebar = "col-sm-3 sidebar";
} else {
	$page_content = "col-sm-12 vc-row-inner";
}
?>
	<div class="<?php echo esc_attr($proton_page_class) ?>">
		<div class="row">
			<div class="<?php echo esc_attr($page_content); ?>">
				<?php
					the_content();
					wp_link_pages('before=<div class="page-navigation">', 'after=</div>');
					comments_template();
				?>
			</div>
			<?php if ($proton_page_layout == '2') : ?>
				<div class="<?php echo esc_attr($page_sidebar); ?>">
					<?php
						if (is_active_sidebar('sidebar-1')) {
							dynamic_sidebar('sidebar-1');
						}
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php
endwhile; endif;

get_footer();
