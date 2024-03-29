<?php 

$history_id = (empty($_POST['ishistory'])) ? sanitize_text_field($_GET['id']) : sanitize_text_field($_POST['ishistory']);	
$src = (!empty($history_id)) ? admin_url('admin-ajax.php?action=' . $this -> pre . 'historyiframe&id=' . esc_html($history_id) . '&security=' . wp_create_nonce('historyiframe')) : false; 
$textsrc = (!empty($history_id)) ? admin_url('admin-ajax.php?action=' . $this -> pre . 'historyiframe&id=' . esc_html($history_id) . '&security=' . wp_create_nonce('historyiframe') . '&text=1') : false; 

?>

<p>
	<a href="<?php echo $src; ?>" id="newwindowbutton" <?php if (empty($history_id)) : ?>disabled="disabled"<?php endif; ?> target="_blank" class="button button-secondary"><i class="fa fa-external-link"></i> <?php _e('Open in New Window', 'wp-mailinglist'); ?></a>
	<a href="" id="previewrunnerbutton" onclick="newsletters_autosave(); return false;" class="button button-primary"><i class="fa fa-eye"></i> <?php _e('Update Preview', 'wp-mailinglist'); ?></a>
	<span id="previewrunnerloading" style="display:none;"><i class="fa fa-refresh fa-spin fa-fw"></i></span>
</p>

<p>
	<?php _e('Preview In:', 'wp-mailinglist'); ?>
	<a href="" class="button newsletters_preview_device active" data-device="desktop"><i class="fa fa-desktop fa-fw"></i> <?php _e('Desktop', 'wp-mailinglist'); ?></a>
	<a href="" class="button newsletters_preview_device" data-device="tablet"><i class="fa fa-tablet fa-fw"></i> <?php _e('Tablet', 'wp-mailinglist'); ?></a>
	<a href="" class="button newsletters_preview_device" data-device="mobile"><i class="fa fa-mobile fa-fw"></i> <?php _e('Mobile', 'wp-mailinglist'); ?></a>
</p>

<h3><?php _e('Normal/HTML Version', 'wp-mailinglist'); ?></h3>
<iframe width="100%" height="300" frameborder="0" scrolling="auto" class="autoHeight widefat" style="max-width:100%; width:100%; margin:15px 0 0 0; border:1px #CCCCCC solid;" src="<?php echo $src; ?>" id="previewiframe">
	<?php _e('Nothing to show yet, please add a subject, content and choose at least one mailing list.', 'wp-mailinglist'); ?>
</iframe>

<h3><?php _e('TEXT Version', 'wp-mailinglist'); ?></h3>
<iframe width="100%" height="100" frameborder="0" scrolling="auto" class="autoHeight widefat" style="max-width:100%; width:100%; margin:15px 0 0 0; border:1px #CCCCCC solid;" src="<?php echo $textsrc; ?>" id="textiframe">
	<?php _e('Nothing to show yet, please add a subject, content and choose at least one mailing list.', 'wp-mailinglist'); ?>
</iframe>

<script type="text/javascript">
	
jQuery('.newsletters_preview_device').on('click', function(e) {
	jQuery('.newsletters_preview_device').removeClass('active');
	var device = jQuery(this).addClass('active').data('device');
	
	if (device == "tablet") {
		jQuery('#previewiframe').css('width', "768px");
	} else if (device == "mobile") {
		jQuery('#previewiframe').css('width', "480px");
	} else {
		jQuery('#previewiframe').css('width', "100%");
	}
	
	return false;
});
	
var previewrequest = false;

<?php if (!empty($history_id)) : ?>
var history_id = "<?php echo $history_id; ?>";
<?php else : ?>
var history_id = false;
<?php endif; ?>

function previewrunner() {	
	jQuery('iframe#content_ifr').attr('tabindex', "2");
	var formvalues = jQuery('form#post').serialize();
	
	//var content = jQuery("iframe#content_ifr").contents().find("body#tinymce").html();
	//var content = tinyMCE.editors.content.getContent();
	
	var content = newsletters_tinymce_content('content');
	
	if (typeof(tinyMCE) == "object" && typeof(tinyMCE.execCommand) == "function") {
		tinyMCE.triggerSave();
	}
		
	if (previewrequest) { previewrequest.abort(); }
	jQuery('#previewrunnerbutton').attr('disabled', "disabled");
	jQuery('#previewrunnerloading').show();
	
	jQuery('#sendbutton, #sendbutton2').prop('disabled', true);
	//jQuery('#savedraftbutton, #savedraftbutton2').prop('disabled', true);
	
	jQuery.ajaxSetup({cache:false});
	
	previewrequest = jQuery.ajax({
		data: formvalues,
		dataType: 'xml',
		url: newsletters_ajaxurl + 'action=wpmlpreviewrunner&security=<?php echo wp_create_nonce('previewrunner'); ?>&random=' + (new Date()).getTime(),
		cache: false,
		type: "POST",
		success: function(response) {			
			history_id = jQuery("history_id", response).text();
			p_id = jQuery("p_id", response).text();
			previewcontent = jQuery("previewcontent", response).text();
			textcontent = jQuery("textcontent", response).text();
			newsletter_url = jQuery("newsletter_url", response).text();
			
			if (history_id != "") { 
				
				jQuery('#newwindowbutton').removeAttr('disabled').attr('href', "<?php echo admin_url('admin-ajax.php?action=wpmlhistoryiframe&id=&security=' . wp_create_nonce('historyiframe')); ?>" + history_id);
				
				jQuery('#ishistory').val(history_id); 
				jQuery('#p_id').val(p_id);
				jQuery('#edit-slug-box').show();
				jQuery('#sample-permalink').html(newsletter_url);
				jQuery('#view-post-btn a').attr('href', newsletter_url);
				jQuery('#shortlink').attr('value', newsletter_url).val(newsletter_url);
			}
		},
		complete: function(response) {		
			if (typeof previewcontent !== 'undefined') { jQuery('#previewiframe').contents().find('html').html(previewcontent); }
			if (typeof textcontent !== 'undefined') { jQuery('#textiframe').contents().find('html').html(textcontent); }
			jQuery('#previewrunnerbutton').removeAttr('disabled');
			jQuery('#previewrunnerloading').hide();
			
			jQuery('#sendbutton, #sendbutton2').prop('disabled', false);
			//jQuery('#savedraftbutton, #savedraftbutton2').prop('disabled', false);
			
			var iframeheight = jQuery("#previewiframe").contents().find("html").outerHeight();
			jQuery("#previewiframe").height(iframeheight).css({height: iframeheight}).attr("height", iframeheight);
			var iframeheight = jQuery("#textiframe").contents().find("html").outerHeight();
			jQuery("#textiframe").height(iframeheight).css({height: iframeheight}).attr("height", iframeheight);
			
			var date = new Date();
			var year = date.getFullYear();
			var month = ("0" + (date.getMonth() + 1)).slice(-2);
			var day = ("0" + date.getDate()).slice(-2);
			var hours = ("0" + date.getHours()).slice(-2);
			var minutes = ("0" + date.getMinutes()).slice(-2);
			var today = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes;
			var autosavedate = year + '-' + ('0' + (month + 1)).slice(-2) + '-' + day + ' ' + hours + ':' + minutes;
			jQuery('#autosave').html('<?php _e('Draft saved at', 'wp-mailinglist'); ?> ' + autosavedate).show();
		}
	});
	
	return true;
}
</script>