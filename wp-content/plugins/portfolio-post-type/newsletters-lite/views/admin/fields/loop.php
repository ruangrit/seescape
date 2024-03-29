<!-- Custom Fields Loop -->

<?php

include $this -> plugin_base() . DS . 'includes' . DS . 'variables.php';

?>

	<form action="?page=<?php echo $this -> sections -> fields; ?>&amp;method=mass" method="post" id="Field.form" onsubmit="if (!confirm('<?php _e('Are you sure you wish to execute this action?', 'wp-mailinglist'); ?>')) { return false; };">
		<?php wp_nonce_field($this -> sections -> fields . '_mass'); ?>
		<div class="tablenav">
			<div class="alignleft actions">
				<a href="?page=<?php echo $this -> sections -> fields; ?>&amp;method=order" title="<?php _e('Sort/order all your custom fields', 'wp-mailinglist'); ?>" class="button action"><i class="fa fa-sort"></i> <?php _e('Order Fields', 'wp-mailinglist'); ?></a>
			</div>
			<div class="alignleft actions">
				<select name="action" class="widefat" style="width:auto;" onchange="change_action(this.value);">
					<option value=""><?php _e('- Bulk Actions -', 'wp-mailinglist'); ?></option>
					<option value="delete"><?php _e('Delete', 'wp-mailinglist'); ?></option>
					<optgroup  label="<?php _e('Required', 'wp-mailinglist'); ?>">
						<option value="required"><?php _e('Set as Required', 'wp-mailinglist'); ?></option>
						<option value="notrequired"><?php _e('Set as NOT Required', 'wp-mailinglist'); ?></option>
					</optgroup>
					<optgroup  label="<?php _e('Lists', 'wp-mailinglist'); ?>">
						<option value="lists"><?php _e('Assign to Specific Lists', 'wp-mailinglist'); ?></option>
						<option value="alllists"><?php _e('Assign to Always Show', 'wp-mailinglist'); ?></option>
					</optgroup>
				</select>				
				<input class="button-secondary action" type="submit" name="execute" value="<?php _e('Apply', 'wp-mailinglist'); ?>" class="button" />
			</div>
			<?php $this -> render('pagination', array('paginate' => $paginate), true, 'admin'); ?>
		</div>
		
		<span id="lists_div" style="display:none;">
			<?php if ($mailinglists = $Mailinglist -> select(true)) : ?>
				<?php foreach ($mailinglists as $list_id => $list_title) : ?>
					<label><input type="checkbox" name="mailinglists[]" value="<?php echo $list_id; ?>" id="mailinglists_<?php echo $list_id; ?>" /> <?php _e($list_title); ?></label><br/>
				<?php endforeach; ?>
			<?php else : ?>
				<p class="newsletters_error"><?php _e('No lists available', 'wp-mailinglist'); ?></p>
			<?php endif; ?>
		</span>
		
		<script type="text/javascript">
		function change_action(action) {			
			if (action == "lists") {
				jQuery('#lists_div').show();
			} else {
				jQuery('#lists_div').hide();
			}
		}
		</script>
		
		<?php
		
		$orderby = (empty($_GET['orderby'])) ? 'modified' : esc_html($_GET['orderby']);
		$order = (empty($_GET['order'])) ? 'desc' : strtolower(esc_html($_GET['order']));
		$otherorder = ($order == "desc") ? 'asc' : 'desc';
		
		$colspan = 10;
		
		?>
		
		<table class="widefat">
			<thead>
				<tr>
					<td class="check-column"><input type="checkbox" name="" value="" id="checkboxall" /></td>
					<th class="column-id <?php echo ($orderby == "id") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=id&order=' . (($orderby == "id") ? $otherorder : "asc")); ?>">
							<span><?php _e('ID', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
					<th class="column-title <?php echo ($orderby == "title") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=title&order=' . (($orderby == "title") ? $otherorder : "asc")); ?>">
							<span><?php _e('Title', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
					<th class="column-slug <?php echo ($orderby == "slug") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=slug&order=' . (($orderby == "slug") ? $otherorder : "asc")); ?>">
							<span><?php _e('Slug', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
					<th class="column-type <?php echo ($orderby == "type") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=type&order=' . (($orderby == "type") ? $otherorder : "asc")); ?>">
							<span><?php _e('Type', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
					<th class="column-mailinglists"><?php _e('List(s)', 'wp-mailinglist'); ?></th>
					<th class="column-shortcode"><?php _e('Shortcode', 'wp-mailinglist'); ?></th>
					<th class="column-required <?php echo ($orderby == "required") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=required&order=' . (($orderby == "required") ? $otherorder : "asc")); ?>">
							<span><?php _e('Required', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
					<th class="column-validation <?php echo ($orderby == "validation") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=validation&order=' . (($orderby == "validation") ? $otherorder : "asc")); ?>">
							<span><?php _e('Validation', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
					<th class="column-modified <?php echo ($orderby == "modified") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=modified&order=' . (($orderby == "modified") ? $otherorder : "asc")); ?>">
							<span><?php _e('Date', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td class="check-column"><input type="checkbox" name="" value="" id="checkboxall" /></td>
					<th class="column-id <?php echo ($orderby == "id") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=id&order=' . (($orderby == "id") ? $otherorder : "asc")); ?>">
							<span><?php _e('ID', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
					<th class="column-title <?php echo ($orderby == "title") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=title&order=' . (($orderby == "title") ? $otherorder : "asc")); ?>">
							<span><?php _e('Title', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
					<th class="column-slug <?php echo ($orderby == "slug") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=slug&order=' . (($orderby == "slug") ? $otherorder : "asc")); ?>">
							<span><?php _e('Slug', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
					<th class="column-type <?php echo ($orderby == "type") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=type&order=' . (($orderby == "type") ? $otherorder : "asc")); ?>">
							<span><?php _e('Type', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
					<th><?php _e('List(s)', 'wp-mailinglist'); ?></th>
					<th><?php _e('Shortcode', 'wp-mailinglist'); ?></th>
					<th class="column-required <?php echo ($orderby == "required") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=required&order=' . (($orderby == "required") ? $otherorder : "asc")); ?>">
							<span><?php _e('Required', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
					<th class="column-validation <?php echo ($orderby == "validation") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=validation&order=' . (($orderby == "validation") ? $otherorder : "asc")); ?>">
							<span><?php _e('Validation', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
					<th class="column-modified <?php echo ($orderby == "modified") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=modified&order=' . (($orderby == "modified") ? $otherorder : "asc")); ?>">
							<span><?php _e('Date', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
				</tr>
			</tfoot>
			<tbody>
				<?php if (empty($fields)) : ?>
					<tr class="no-items">
						<td class="colspanchange" colspan="<?php echo $colspan; ?>"><?php echo sprintf(__('No custom fields were found %s', 'wp-mailinglist'), '<a class="button button-small button-secondary" href="' . admin_url('admin.php?page=' . $this -> sections -> fields . '&method=loaddefaults') . '"><i class="fa fa-check"></i> ' . __('load defaults', 'wp-mailinglist') . '</a>'); ?></td>
					</tr>
				<?php else : ?>
					<?php $class = ''; ?>
					<?php $types = $this -> get_option('fieldtypes'); ?>
					<?php foreach ($fields as $field) : ?>
						<tr class="<?php echo $class = ($class == "") ? 'alternate' : ''; ?>" id="Field.row<?php echo $field -> id; ?>">
							<th class="check-column">
								<?php if ($field -> slug != "email" && $field -> slug != "list") : ?>
									<input type="checkbox" name="fieldslist[]" id="checklist<?php echo $field -> id; ?>" value="<?php echo $field -> id; ?>" />
								<?php endif; ?>
							</th>
							<td><label for="checklist<?php echo $field -> id; ?>"><?php echo $field -> id; ?></label></td>
							<td>
								<strong><a href="?page=<?php echo $this -> sections -> fields; ?>&amp;method=save&amp;id=<?php echo $field -> id; ?>" title="<?php _e('Edit this custom field', 'wp-mailinglist'); ?>" class="row-title"><?php _e($field -> title); ?></a></strong>
								<div class="row-actions">
									<span class="edit"><?php echo $Html -> link(__('Edit', 'wp-mailinglist'), '?page=' . $this -> sections -> fields . '&amp;method=save&amp;id=' . $field -> id); ?><?php if ($field -> slug != "email" && $field -> slug != "list") : ?> |<?php endif; ?></span>
	                                <?php if ($field -> slug != "email" && $field -> slug != "list") : ?>
										<span class="delete"><?php echo $Html -> link(__('Delete', 'wp-mailinglist'), '?page=' . $this -> sections -> fields . '&amp;method=delete&amp;id=' . $field -> id, array('class' => "submitdelete", 'onclick' => "if (!confirm('" . __('Are you sure you want to delete this custom field?', 'wp-mailinglist') . "')) { return false; }")); ?></span>
	                                <?php endif; ?>
								</div>
							</td>
							<td><label for="checklist<?php echo $field -> id; ?>"><?php echo $field -> slug; ?></label></td>
							<td><label for="checklist<?php echo $field -> id; ?>"><?php echo $Html -> field_type($field -> type, $field -> slug); ?></label></td>
							<td>
								<?php if (!empty($field -> display) && $field -> display == "always") : ?>
									<?php _e('All', 'wp-mailinglist'); ?>
								<?php else : ?>
									<?php if ($lists = $FieldsList -> checkedlists_by_field($field -> id)) : ?>
										<?php $l = 1; ?>
										<?php foreach ($lists as $list_id) : ?>
											<?php if ($list_id == "0") : ?>
												<?php _e('None', 'wp-mailinglist'); ?>
											<?php else : ?>
												<?php if ($list_title = $Mailinglist -> get_title_by_id($list_id)) : ?>
													<a href="?page=<?php echo $this -> sections -> lists; ?>&amp;method=view&amp;id=<?php echo $list_id; ?>"><?php echo $list_title; ?></a>
													<?php if ($l < count($lists)) : ?>, <?php endif; ?>
												<?php endif; ?>
											<?php endif; ?>
											<?php $l++; ?>
										<?php endforeach; ?>
									<?php else : ?>
										<?php _e('None', 'wp-mailinglist'); ?>
									<?php endif; ?>
								<?php endif; ?>
							</td>
							<td>
								<code>[newsletters_field name=<?php echo $field -> slug; ?>]</code>
								<button type="button" class="button button-secondary button-small copy-button" data-clipboard-text="[newsletters_field name=<?php echo esc_attr(wp_unslash($field -> slug)); ?>]">
									<i class="fa fa-clipboard fa-fw"></i>
								</button>
							</td>
							<td><label for="checklist<?php echo $field -> id; ?>"><?php echo (empty($field -> required) || $field -> required == "N") ? '<span class="newsletters_success"><i class="fa fa-times"></i>' : '<span class="newsletters_error"><i class="fa fa-check"></i>'; ?></span></label></td>
							<td>
								<?php if (empty($field -> validation) || $field -> validation == "notempty") : ?>
									<?php echo __('Not Empty', 'wp-mailinglist'); ?>
								<?php else : ?>
									<?php echo __($validation_rules[$field -> validation]['title']); ?>
								<?php endif; ?>
							</td>
							<td><label for="checklist<?php echo $field -> id; ?>"><abbr title="<?php echo $field -> modified; ?>"><?php echo $Html -> gen_date(false, strtotime($field -> modified)); ?></abbr></label></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
		<div class="tablenav">
			<div class="alignleft">
				<?php if (empty($_GET['showall'])) : ?>
					<select class="widefat alignleft" style="width:auto;" name="perpage" onchange="change_perpage(this.value);">
						<option value=""><?php _e('- Per Page -', 'wp-mailinglist'); ?></option>
						<?php $p = 5; ?>
						<?php while ($p < 100) : ?>
							<option <?php echo (!empty($_COOKIE[$this -> pre . 'fieldsperpage']) && $_COOKIE[$this -> pre . 'fieldsperpage'] == $p) ? 'selected="selected"' : ''; ?> value="<?php echo $p; ?>"><?php echo $p; ?> <?php _e('per page', 'wp-mailinglist'); ?></option>
							<?php $p += 5; ?>
						<?php endwhile; ?>
						<?php if (isset($_COOKIE[$this -> pre . 'fieldsperpage'])) : ?>
							<option selected="selected" value="<?php echo $_COOKIE[$this -> pre . 'fieldsperpage']; ?>"><?php echo $_COOKIE[$this -> pre . 'fieldsperpage']; ?></option>
						<?php endif; ?>
					</select>
				<?php endif; ?>
				
				<script type="text/javascript">
				function change_perpage(perpage) {
					if (perpage != "") {
						document.cookie = "<?php echo $this -> pre; ?>fieldsperpage=" + perpage + "; expires=<?php echo $Html -> gen_date($this -> get_option('cookieformat'), strtotime("+30 days")); ?> UTC; path=/";
						window.location = "<?php echo preg_replace("/\&?" . $this -> pre . "page\=(.*)?/si", "", $_SERVER['REQUEST_URI']); ?>";
					}
				}
				
				function change_sorting(field, dir) {
					document.cookie = "<?php echo $this -> pre; ?>fieldssorting=" + field + "; expires=<?php echo $Html -> gen_date($this -> get_option('cookieformat'), strtotime("+30 days")); ?> UTC; path=/";
					document.cookie = "<?php echo $this -> pre; ?>fields" + field + "dir=" + dir + "; expires=<?php echo $Html -> gen_date($this -> get_option('cookieformat'), strtotime("+30 days")); ?> UTC; path=/";
					window.location = "<?php echo preg_replace("/\&?" . $this -> pre . "page\=(.*)?/si", "", $_SERVER['REQUEST_URI']); ?>";
				}
				</script>
			</div>
			<?php $this -> render('pagination', array('paginate' => $paginate), true, 'admin'); ?>
		</div>
	</form>