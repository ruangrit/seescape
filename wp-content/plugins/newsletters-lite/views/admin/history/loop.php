<?php /*
	<form action="?page=<?php echo $this -> sections -> history; ?>&amp;method=mass" id="newsletters-history-form" onsubmit="if (!confirm('<?php _e('Are you sure you wish to execute this action on the selected history emails?', 'wp-mailinglist'); ?>')) { return false; }" method="post">
		<?php wp_nonce_field($this -> sections -> history . '_mass'); ?>
		<div class="tablenav">
			<div class="alignleft actions">
				<?php $rssfeed = $this -> get_option('rssfeed'); ?>
				<?php if (!empty($rssfeed) && $rssfeed == "Y" && apply_filters($this -> pre . '_admin_history_rsslink', true)) : ?>
					<a href="<?php echo add_query_arg(array('feed' => "newsletters"), home_url()); ?>" title="<?php _e('RSS feed for all newsletter history', 'wp-mailinglist'); ?>" class="button"><i class="fa fa-rss"></i> <?php _e('RSS', 'wp-mailinglist'); ?></a>
				<?php endif; ?>
				<?php if (apply_filters($this -> pre . '_admin_history_exportlink', true)) : ?>
                	<a onclick="jQuery('#newsletters-history-action').val('export'); jQuery('#newsletters-history-form').removeAttr('onsubmit').submit(); return false;" href="" class="button"><i class="fa fa-download"></i> <?php _e('Export', 'wp-mailinglist'); ?></a>
				<?php endif; ?>
				<a href="<?php echo $this -> url; ?>&amp;method=clear" onclick="if (!confirm('<?php _e('Are you sure you wish to clear the email history?', 'wp-mailinglist'); ?>')) { return false; } else { if (!confirm('<?php echo addslashes(__('Are you really sure? All newsletters will be deleted permanently!', 'wp-mailinglist')); ?>')) { return false; } }" class="button"><i class="fa fa-trash"></i> <?php _e('Clear', 'wp-mailinglist'); ?></a>
			</div>
			<div class="alignleft actions">
				<select name="action" id="newsletters-history-action">
					<option value=""><?php _e('- Bulk Actions -', 'wp-mailinglist'); ?></option>
					<option value="delete"><?php _e('Delete', 'wp-mailinglist'); ?></option>
					<option value="export"><?php _e('Export', 'wp-mailinglist'); ?></option>
				</select>
				<button value="1" type="submit" name="execute" class="button-secondary">
					<?php _e('Apply', 'wp-mailinglist'); ?>
				</button>
			</div>
			<?php $this -> render('pagination', array('paginate' => $paginate), true, 'admin'); ?>
		</div>
		
		<?php
		
		$orderby = (empty($_GET['orderby'])) ? 'modified' : esc_html($_GET['orderby']);
		$order = (empty($_GET['order'])) ? 'desc' : strtolower(esc_html($_GET['order']));
		$otherorder = ($order == "desc") ? 'asc' : 'desc';
		
		$columns = array(
			'id'				=>	__('ID', 'wp-mailinglist'),
			'subject'			=>	__('Subject', 'wp-mailinglist'),
			'lists'				=>	__('List(s)', 'wp-mailinglist'),
			'theme_id'			=>	__('Template', 'wp-mailinglist'),
			'stats'				=>	__('Stats', 'wp-mailinglist'),
			'sent'				=>	__('Status', 'wp-mailinglist'),
			'recurring'			=>	__('Recurring', 'wp-mailinglist'),
			'post_id'			=>	__('Post', 'wp-mailinglist'),
			'user_id'			=>	__('Author', 'wp-mailinglist'),
			'modified'			=>	__('Date', 'wp-mailinglist'),
			'attachments'		=>	__('Attachments', 'wp-mailinglist'),
		);
		
		$columns = apply_filters('newsletters_admin_history_table_columns', $columns);
		$colspan = count($columns);
		
		?>
		
		<table class="widefat">
			<thead>
				<tr>
					<?php ob_start(); ?>
					<td class="check-column"><input type="checkbox" name="" value="" id="checkboxall" /></td>
					<?php
						
					if (!empty($columns)) {
						foreach ($columns as $column_name => $column_value) {
							switch ($column_name) {
								case 'lists'			:
								case 'stats'			:
								case 'attachments'		:
									?>
									
									<th class="column-<?php echo $column_name; ?>"><?php echo $column_value; ?></th>
									
									<?php
									break;
								default					:								
									?>
									
									<th class="column-<?php echo $column_name; ?> <?php echo ($orderby == $column_name) ? 'sorted ' . $order : 'sortable desc'; ?>">
										<a href="<?php echo $Html -> retainquery('orderby=' . $column_name . '&order=' . (($orderby == $column_name) ? $otherorder : "asc")); ?>">
											<span><?php echo $column_value; ?></span>
											<span class="sorting-indicator"></span>
										</a>
									</th>
									
									<?php
									break;
							}
						}
					}	
					
					$columns_output = ob_get_clean();
					echo $columns_output;
						
					?>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<?php echo $columns_output; ?>
				</tr>
			</tfoot>
			<tbody id="the-list">
				<?php if (empty($histories)) : ?>
					<tr class="no-items">
						<td class="colspanchange" colspan="<?php echo $colspan; ?>"><?php _e('No history emails were found', 'wp-mailinglist'); ?></td>
					</tr>
				<?php else : ?>
					<?php $class = ''; ?>
					<?php foreach ($histories as $email) : ?>
					<tr id="historyrow<?php echo $email -> id; ?>" class="<?php echo $class = (empty($class)) ? 'alternate' : ''; ?>">
						<th class="check-column"><input id="checklist<?php echo $email -> id; ?>" type="checkbox" name="historylist[]" value="<?php echo $email -> id; ?>" /></th>
						<?php foreach ($columns as $column_name => $column_value) : ?>
							<?php
								
							switch ($column_name) {
								case 'id'						:
									?>
									<td><label for="checklist<?php echo $email -> id; ?>"><?php echo $email -> id; ?></label></td>
									<?php
									break;
								case 'subject'					:
									?>
									<td class="has-row-actions column-primary column-title">
										<strong>
											<a class="row-title" href="?page=<?php echo $this -> sections -> history; ?>&amp;method=view&amp;id=<?php echo $email -> id; ?>" title="<?php _e('View this email', 'wp-mailinglist'); ?>"><?php echo __($email -> subject); ?></a>
											<span class="post-state">
												<?php if ($email -> scheduled == "Y") : ?>
													<?php _e('- Scheduled', 'wp-mailinglist'); ?>
												<?php elseif ($email -> sent <= 0) : ?>
													<?php _e('- Draft', 'wp-mailinglist'); ?>
												<?php endif; ?>
											</span>
										</strong>
										<div class="row-actions">
											<span class="edit"><?php echo $Html -> link(__('Send/Edit', 'wp-mailinglist'), '?page=' . $this -> sections -> send . '&amp;method=history&amp;id=' . $email -> id); ?> |</span>
											<span class="delete"><?php echo $Html -> link(__('Delete', 'wp-mailinglist'), '?page=' . $this -> sections -> history . '&amp;method=delete&amp;id=' . $email -> id, array('class' => "submitdelete", 'onclick' => "if (!confirm('" . __('Are you sure you want to delete this email?', 'wp-mailinglist') . "')) { return false; }")); ?> |</span>
											<span class="edit"><?php echo $Html -> link(__('Duplicate', 'wp-mailinglist'), '?page=' . $this -> sections -> history . '&amp;method=duplicate&amp;id=' . $email -> id); ?> |</span>
											<span class="view"><?php echo $Html -> link(__('View', 'wp-mailinglist'), '?page=' . $this -> sections -> history . '&amp;method=view&amp;id=' . $email -> id); ?></span>
										</div>
									</td>
									<?php
									break;
								case 'lists'					:
									?>
									<td>
										<?php if (!empty($email -> mailinglists)) : ?>
											<?php $m = 1; ?>
											<?php $mailinglists = maybe_unserialize($email -> mailinglists); ?>
											<?php if (!empty($mailinglists) && (is_array($mailinglists) || is_object($mailinglists))) : ?>
												<?php foreach ($mailinglists as $mailinglist_id) : ?>
													<?php $mailinglist = $Mailinglist -> get($mailinglist_id, false); ?>
													<a href="?page=<?php echo $this -> sections -> lists; ?>&amp;method=view&amp;id=<?php echo $mailinglist_id; ?>" title="<?php echo __($mailinglist -> title); ?>"><?php echo __($mailinglist -> title); ?></a><?php echo ($m < count($mailinglists)) ? ', ' : ''; ?>
													<?php $m++; ?>
												<?php endforeach; ?>
											<?php endif; ?>
										<?php else : ?>
											<?php _e('none', 'wp-mailinglist'); ?>
										<?php endif; ?>
									</td>
									<?php
									break;
								case 'theme_id'					:
									?>
									<td>
				                    	<?php $Db -> model = $Theme -> model; ?>
				                        <?php if (!empty($email -> theme_id) && $theme = $Db -> find(array('id' => $email -> theme_id))) : ?>
				                        	<a href="" onclick="jQuery.colorbox({iframe:true, width:'80%', height:'80%', href:'<?php echo home_url(); ?>/?wpmlmethod=themepreview&amp;id=<?php echo $theme -> id; ?>'}); return false;" title="<?php _e('Template Preview:', 'wp-mailinglist'); ?> <?php echo $theme -> title; ?>"><?php echo $theme -> title; ?></a>
				                        <?php else : ?>
				                        	<?php _e('None', 'wp-mailinglist'); ?>
				                        <?php endif; ?>
				                    </td>
									<?php
									break;
								case 'stats'					:
									?>
									<td>
										<?php 
											
										$Db -> model = $Email -> model;
										$etotal = $Db -> count(array('history_id' => $email -> id));
										$eread = $Db -> count(array('history_id' => $email -> id, 'read' => "Y"));	
										
										global $wpdb;
										$tracking = (!empty($etotal)) ? ($eread/$etotal) * 100 : 0;
										
										$query = "SELECT SUM(`count`) FROM `" . $wpdb -> prefix . $Bounce -> table . "` WHERE `history_id` = '" . $email -> id . "'";
										
										$query_hash = md5($query);
										if ($ob_ebounced = $this -> get_cache($query_hash)) {
											$ebounced = $ob_ebounced;
										} else {
											$ebounced = $wpdb -> get_var($query);
											$this -> set_cache($query_hash, $ebounced);
										}
										
										$ebouncedperc = (!empty($etotal)) ? (($ebounced / $etotal) * 100) : 0; 
										
										$query = "SELECT COUNT(DISTINCT `email`) FROM `" . $wpdb -> prefix . $Unsubscribe -> table . "` WHERE `history_id` = '" . $email -> id . "'";
										
										$query_hash = md5($query);
										if ($ob_eunsubscribed = $this -> get_cache($query_hash)) {
											$eunsubscribed = $ob_eunsubscribed;
										} else {
											$eunsubscribed = $wpdb -> get_var($query);
											$this -> set_cache($query_hash, $eunsubscribed);
										}
										
										$eunsubscribeperc = (!empty($etotal)) ? (($eunsubscribed / $etotal) * 100) : 0;
										$clicks = $this -> Click() -> count(array('history_id' => $email -> id));
										
										?>
										<a href="?page=<?php echo $this -> sections -> history; ?>&amp;method=view&amp;id=<?php echo $email -> id; ?>"><?php echo sprintf("%s / %s / %s / %s", '<span style="color:#46BFBD;">' . number_format($tracking, 2, '.', '') . '&#37;</span>', '<span style="color:#FDB45C;">' . number_format($eunsubscribeperc, 2, '.', '') . '&#37;</span>', '<span style="color:#F7464A;">' . number_format($ebouncedperc, 2, '.', '') . '&#37;</span>', $clicks); ?></a>
										<?php echo $Html -> help(sprintf(__('%s read %s, %s unsubscribes %s, %s bounces %s and %s clicks out of %s emails sent out', 'wp-mailinglist'), '<strong>' . $eread . '</strong>', '(' . ((!empty($etotal)) ? number_format((($eread/$etotal) * 100), 2, '.', '') : 0) . '&#37;)', '<strong>' . $eunsubscribed . '</strong>', '(' . number_format($eunsubscribeperc, 2, '.', '') . '&#37;)', '<strong>' . $ebounced . '</strong>', '(' . number_format($ebouncedperc, 2, '.', '') . '&#37;)', '<strong>' . $clicks . '</strong>', '<strong>' . $etotal . '</strong>')); ?>
									</td>
									<?php
									break;
								case 'sent'						:
									?>
									<td>
										<?php if ($email -> scheduled == "Y") : ?>
											<span class="wpmlpending"><?php _e('Scheduled', 'wp-mailinglist'); ?></span>
											<small>(<abbr title="<?php echo $email -> senddate; ?>"><?php echo $Html -> gen_date(false, strtotime($email -> senddate)); ?></abbr>)</small>
										<?php elseif ($email -> sent <= 0) : ?>
											<span class="wpmlerror"><?php _e('Draft', 'wp-mailinglist'); ?></span>
										<?php else : ?>
											<span class="wpmlsuccess"><?php _e('Sent', 'wp-mailinglist'); ?></span>											
											<small>(<?php echo sprintf(__('%s times and %s emails', 'wp-mailinglist'), $email -> sent, $etotal); ?>)</small>
										<?php endif; ?>
				                    </td>
									<?php
									break;
								case 'recurring'				:
									?>
									<td>
				                    	<?php if (!empty($email -> recurring) && $email -> recurring == "Y") : ?>
				                    		<?php _e('Yes', 'wp-mailinglist'); ?>
				                    		<?php $helpstring = sprintf(__('Send every %s %s', 'wp-mailinglist'), $email -> recurringvalue, $email -> recurringinterval); ?>
				                    		<?php if (!empty($email -> recurringlimit)) : ?><?php $helpstring .= sprintf(__(' and repeat %s times', 'wp-mailinglist'), $email -> recurringlimit); ?><?php endif; ?>
				                    		<?php $helpstring .= sprintf(__(' starting %s and has been sent %s times already'), $email -> recurringdate, $email -> recurringsent); ?>
				                    		<?php echo $Html -> help($helpstring); ?>
				                    	<?php else : ?>
				                    		<?php _e('No', 'wp-mailinglist'); ?>
				                    	<?php endif; ?>
				                    </td>
									<?php
									break;
								case 'post_id'					:
									?>
									<td>
				                    	<?php if (!empty($email -> post_id)) : ?>
				                    		<?php 
				                    		
				                    		$post = get_post($email -> post_id);
				                    		edit_post_link(__($post -> post_title), null, null, $email -> post_id);
				                    		
				                    		?>
				                    	<?php else : ?>
				                    		<?php _e('None', 'wp-mailinglist'); ?>
				                    	<?php endif; ?>
				                    </td>
									<?php
									break;
								case 'user_id'					:
									if (apply_filters($this -> pre . '_admin_history_authorcolumn', true)) : ?>
					                    <td>
					                    	<?php if ($user = get_userdata($email -> user_id)) : ?>
					                        	<?php echo $Html -> link($user -> display_name, get_edit_user_link($user -> ID)); ?>
					                        <?php else : ?>
					                        	<?php _e('None', 'wp-mailinglist'); ?>
					                        <?php endif; ?>
					                    </td>
				                    <?php endif;
									break;
								case 'modified'					:
									?>
									<td><label for="checklist<?php echo $email -> id; ?>"><abbr title="<?php echo $email -> modified; ?>"><?php echo $Html -> gen_date(false, strtotime($email -> modified)); ?></abbr></label></td>
									<?php
									break;
								case 'attachments'				:
									?>
									<td>
				                    	<?php if (!empty($email -> attachments)) : ?>
				                        	<ul style="padding:0; margin:0;">
				                            	<?php foreach ($email -> attachments as $attachment) : ?>
				                                	<li class="<?php echo $this -> pre; ?>attachment"><?php echo $Html -> attachment_link($attachment, false); ?></li>
				                                <?php endforeach; ?>
				                            </ul>
				                        <?php else : ?>
				                        	<?php _e('None', 'wp-mailinglist'); ?>
				                        <?php endif; ?>
				                    </td>
									<?php
									break;
								default							:
									?><td><?php do_action('newsletters_admin_history_table_column_output', $column_name, $email); ?></td><?php
									break;
							}	
								
							?>
						<?php endforeach; ?> 
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
							<option <?php echo (!empty($perpage) && $perpage == $p) ? 'selected="selected"' : ''; ?> value="<?php echo $p; ?>"><?php echo $p; ?> <?php _e('per page', 'wp-mailinglist'); ?></option>
							<?php $p += 5; ?>
						<?php endwhile; ?>
						<?php if (isset($perpage)) : ?>
							<option selected="selected" value="<?php echo $perpage; ?>"><?php echo $perpage; ?></option>
						<?php endif; ?>
					</select>
					<span id="newsletters_history_perpage_loading" style="display:none;"><i class="fa fa-refresh fa-spin fa-fw"></i></span>
				<?php endif; ?>
			</div>
			<?php $this -> render('pagination', array('paginate' => $paginate), true, 'admin'); ?>
		</div>
	</form>*/ ?>