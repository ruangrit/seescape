
	<form action="?page=<?php echo $this -> sections -> templates; ?>&amp;method=mass" method="post" onsubmit="if (!confirm('<?php _e('Are you sure you wish to execute this action on the selected snippets?', 'wp-mailinglist'); ?>')) { return false; }" id="templatesform" name="templatesform">
		<div class="tablenav">
			<div class="alignleft actions">
				<select name="action" class="widefat" style="width:auto;">
					<option value=""><?php _e('- Bulk Actions -', 'wp-mailinglist'); ?></option>
					<option value="delete"><?php _e('Delete', 'wp-mailinglist'); ?></option>
				</select>
				<button value="1" type="submit" class="button-secondary action" name="execute">
					<?php _e('Apply', 'wp-mailinglist'); ?>
				</button>
			</div>
			<?php $this -> render('pagination', array('paginate' => $paginate), true, 'admin'); ?>
		</div>
		
		<?php
		
		$orderby = (empty($_GET['orderby'])) ? 'modified' : esc_html($_GET['orderby']);
		$order = (empty($_GET['order'])) ? 'desc' : strtolower(esc_html($_GET['order']));
		$otherorder = ($order == "desc") ? 'asc' : 'desc';
		
		$colspan = 6;
		
		?>
		
		<table class="widefat">
			<thead>
				<tr>
					<td class="check-column"><input type="checkbox" id="checkboxall" name="" value="" /></td>
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
					<th class="column-sent <?php echo ($orderby == "sent") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=sent&order=' . (($orderby == "sent") ? $otherorder : "asc")); ?>">
							<span><?php _e('Sent', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
					<th><?php _e('Shortcode', 'wp-mailinglist'); ?></th>
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
					<td class="check-column"><input type="checkbox" id="checkboxall" name="" value="" /></td>
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
					<th class="column-sent <?php echo ($orderby == "sent") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=sent&order=' . (($orderby == "sent") ? $otherorder : "asc")); ?>">
							<span><?php _e('Sent', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
					<th><?php _e('Shortcode', 'wp-mailinglist'); ?></th>
					<th class="column-modified <?php echo ($orderby == "modified") ? 'sorted ' . $order : 'sortable desc'; ?>">
						<a href="<?php echo $Html -> retainquery('orderby=modified&order=' . (($orderby == "modified") ? $otherorder : "asc")); ?>">
							<span><?php _e('Date', 'wp-mailinglist'); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
				</tr>
			</tfoot>
			<tbody>
				<?php if (empty($templates)) : ?>
					<tr class="no-items">
						<td class="colspanchange" colspan="<?php echo $colspan; ?>"><?php _e('No snippets were found', 'wp-mailinglist'); ?></td>
					</tr>
				<?php else : ?>
					<?php foreach ($templates as $template) : ?>
					<?php $class = ($class == "alternate") ? '' : 'alternate'; ?>
						<tr class="<?php echo $class; ?>" id="templaterow<?php echo $template -> id; ?>">
							<th class="check-column"><input id="checklist<?php echo $template -> id; ?>" type="checkbox" name="templateslist[]" value="<?php echo $template -> id; ?>" /></th>
							<td><label for="checklist<?php echo $template -> id; ?>"><?php echo $template -> id; ?></label></td>
							<td>
								<strong><a class="row-title" href="?page=<?php echo $this -> sections -> templates; ?>&amp;method=view&amp;id=<?php echo $template -> id; ?>" title="<?php _e('View this template', 'wp-mailinglist'); ?>"><?php echo __($template -> title); ?></a></strong>
								<div class="row-actions">
									<span class="edit"><?php echo $Html -> link(__('Edit', 'wp-mailinglist'), '?page=' . $this -> sections -> templates_save . '&amp;id=' . $template -> id); ?> |</span>
									<span class="delete"><?php echo $Html -> link(__('Delete', 'wp-mailinglist'), $this -> url . '&amp;method=delete&amp;id=' . $template -> id, array('onclick' => "if (!confirm('" . __('Are you sure you want to delete this template?', 'wp-mailinglist') . "')) { return false; }", 'class' => "submitdelete")); ?> |</span>
									<span class="view"><?php echo $Html -> link(__('View', 'wp-mailinglist'), $this -> url . '&amp;method=view&amp;id=' . $template -> id); ?> |</span>
									<span class="edit"><?php echo $Html -> link(__('Send', 'wp-mailinglist'), admin_url('admin.php?page=' . $this -> sections -> send . '&method=template&id=' . $template -> id)); ?></span>
								</div>
							</td>
							<td><label for="checklist<?php echo $template -> id; ?>"><?php echo $template -> sent; ?></label></td>
							<td>
								<code>[newsletters_snippet id="<?php echo $template -> id; ?>"]</code>
								<button type="button" class="button button-secondary button-small copy-button" data-clipboard-text="[newsletters_snippet id=<?php echo $template -> id; ?>]">
									<i class="fa fa-clipboard fa-fw"></i>
								</button>
							</td>
							<td><label for="checklist<?php echo $template -> id; ?>"><?php echo $Html -> gen_date(false, strtotime($template -> modified)); ?></label></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
		<div class="tablenav">
			<div class="alignleft">
				<?php if (empty($_GET['showall'])) : ?>
					<select class="widefat" style="width:auto;" name="perpage" onchange="change_perpage(this.value);">
						<option value=""><?php _e('- Per Page -', 'wp-mailinglist'); ?></option>
						<?php $p = 5; ?>
						<?php while ($p < 100) : ?>
							<option <?php echo (!empty($_COOKIE[$this -> pre . 'templatesperpage']) && $_COOKIE[$this -> pre . 'templatesperpage'] == $p) ? 'selected="selected"' : ''; ?> value="<?php echo $p; ?>"><?php echo $p; ?> <?php _e('per page', 'wp-mailinglist'); ?></option>
							<?php $p += 5; ?>
						<?php endwhile; ?>
						<?php if (isset($_COOKIE[$this -> pre . 'templatesperpage'])) : ?>
							<option selected="selected" value="<?php echo $_COOKIE[$this -> pre . 'templatesperpage']; ?>"><?php echo $_COOKIE[$this -> pre . 'templatesperpage']; ?></option>
						<?php endif; ?>
					</select>
				<?php endif; ?>
				
				<script type="text/javascript">
				function change_perpage(perpage) {
					document.cookie = "<?php echo $this -> pre; ?>templatesperpage=" + perpage + "; expires=<?php echo $Html -> gen_date($this -> get_option('cookieformat'), strtotime("+30 days")); ?> UTC; path=/";
					window.location = "<?php echo preg_replace("/\&?" . $this -> pre . "page\=(.*)?/si", "", $_SERVER['REQUEST_URI']); ?>";
				}
				
				function change_sorting(field, dir) {
					document.cookie = "<?php echo $this -> pre; ?>templatessorting=" + field + "; expires=<?php echo $Html -> gen_date($this -> get_option('cookieformat'), strtotime("+30 days")); ?> UTC; path=/";
					document.cookie = "<?php echo $this -> pre; ?>templates" + field + "dir=" + dir + "; expires=<?php echo $Html -> gen_date($this -> get_option('cookieformat'), strtotime("+30 days")); ?> UTC; path=/";
					window.location = "<?php echo preg_replace("/\&?" . $this -> pre . "page\=(.*)?/si", "", $_SERVER['REQUEST_URI']); ?>";
				}
				</script>
			</div>
			<?php $this -> render('pagination', array('paginate' => $paginate), true, 'admin'); ?>
		</div>
	</form>