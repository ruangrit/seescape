<?php $embed = $this -> get_option('embed'); ?>

<script type="text/javascript">
var wpmlAjax = '<?php echo rtrim($this -> url(), '/'); ?>/<?php echo $this -> plugin_name; ?>-ajax.php';
var wpmlUrl = '<?php echo $this -> url(); ?>';
var wpmlScroll = "<?php echo ($embed['scroll'] == "Y") ? 'Y' : 'N'; ?>";
var newsletters_locale = "<?php echo substr(get_locale(), 0, 2); ?>";

<?php if ($this -> language_do()) : ?>
	var newsletters_ajaxurl = '<?php echo admin_url('admin-ajax.php?lang=' . $this -> language_current() . '&'); ?>';
<?php else : ?>
	var newsletters_ajaxurl = '<?php echo admin_url('admin-ajax.php?'); ?>';
<?php endif; ?>

$ = jQuery.noConflict();

jQuery(document).ready(function() {
	if (jQuery.isFunction(jQuery.fn.select2)) {
		jQuery('.newsletters select').select2();
	}
	
	if (jQuery.isFunction(jQuery.fn.tooltip)) {
		jQuery('[data-toggle="tooltip"]').tooltip();
	}
});
</script>

<?php if (get_option('wpmlcustomcss') == "Y") : ?>
	<style type="text/css">
	<?php echo wp_unslash(get_option('wpmlcustomcsscode')); ?>
	</style>
<?php endif; ?>