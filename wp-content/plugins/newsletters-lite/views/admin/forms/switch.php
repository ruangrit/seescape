<!-- Form Switch -->

<?php if ($forms = $this -> Subscribeform() -> find_all()) : ?>
	<select name="switchform" onchange="if (this.value != '') { window.location = '<?php echo admin_url('admin.php?page=' . $this -> sections -> forms . '&method=save&id='); ?>' + this.value; }">
		<option value=""><?php _e('- Switch Form -', 'wp-mailinglist'); ?></option>
		<?php foreach ($forms as $form) : ?>
			<option value="<?php echo esc_attr($form -> id); ?>"><?php _e($form -> title); ?></option>
		<?php endforeach; ?>
	</select>
<?php endif; ?>