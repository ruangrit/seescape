<!-- Mailinglists/Subscribers Box -->

<?php

global $wpdb, $wp_roles;
$roles = $wp_roles -> get_names();
$count_users = count_users();

?>

<div id="mailingliststabs">
	<ul>
		<li><a href="#mailingliststabs-subscribers"><i class="fa fa-users fa-fw"></i> <?php _e('Subscribers', 'wp-mailinglist'); ?></a></li>
		<li><a href="#mailingliststabs-filter"><i class="fa fa-filter fa-fw"></i> <?php _e('Filter', 'wp-mailinglist'); ?></a></li>
	</ul>
	
	<!-- Groups, Roles and Mailing Lists -->
	<div id="mailingliststabs-subscribers">
		<div id="groupsdiv">
            <?php if ($groups = $this -> Group() -> select()) : ?>
                <div><label class="selectit" style="font-weight:bold;"><input type="checkbox" id="groupsselectall" name="groupsselectall" value="1" onclick="jqCheckAll(this, 'post', 'groups'); update_subscribers();" /> <?php _e('Select all Groups', 'wp-mailinglist'); ?></label></div>
                <div class="scroll-list">
                    <?php foreach ($groups as $group_id => $group_title) : ?>
                        <div><label class="selectit"><input onclick="update_subscribers();" <?php echo (!empty($_POST['groups']) && is_array($_POST['groups']) && in_array($group_id, $_POST['groups'])) ? 'checked="checked"' : ''; ?> type="checkbox" name="groups[]" id="checklist<?php echo $group_id; ?>" value="<?php echo esc_attr($group_id); ?>" /> <?php echo __($group_title); ?> (<?php echo $Mailinglist -> count(array('group_id' => $group_id)); ?> <?php _e('lists', 'wp-mailinglist'); ?>)</label></div>
                    <?php endforeach; ?>
                </div>
                <br/>
            <?php else : ?>
            
            <?php endif; ?>
        </div>
    	<div id="listsdiv">
            <?php if ($mailinglists = $Mailinglist -> select(true)) : ?>
                <div><label class="selectit" style="font-weight:bold;"><input type="checkbox" id="mailinglistsselectall" name="mailinglistsselectall" value="1" onclick="jqCheckAll(this, 'post', 'mailinglists'); update_subscribers();" /> <?php _e('Select all Lists', 'wp-mailinglist'); ?></label></div>
                <div class="scroll-list">
                    <?php foreach ($mailinglists as $list_id => $list_title) : ?>
                        <div><label class="selectit"><input onclick="update_subscribers();" <?php echo (!empty($_POST['mailinglists']) && is_array($_POST['mailinglists']) && in_array($list_id, $_POST['mailinglists'])) ? 'checked="checked"' : ''; ?> type="checkbox" name="mailinglists[]" id="checklist<?php echo esc_attr($list_id); ?>" value="<?php echo $list_id; ?>" /> <?php echo $list_title; ?> (<?php echo $SubscribersList -> count(array('list_id' => $list_id, 'active' => "Y")); ?> <?php _e('active', 'wp-mailinglist'); ?>)</label></div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p class="newsletters_error"><?php _e('No lists are available', 'wp-mailinglist'); ?></p>
            <?php endif; ?>
        </div>
        <?php if (current_user_can('newsletters_admin_send_sendtoroles')) : ?>
	        <?php if (!empty($roles)) : ?>
	        	<br/>
	        	<div id="usersdiv">
	        		<div><label class="selectit" style="font-weight:bold;"><input type="checkbox" name="rolesselectall" value="1" id="rolesselectall" onclick="jqCheckAll(this, false, 'roles'); update_subscribers();" /> <?php _e('Select all Roles', 'wp-mailinglist'); ?></label></div>
	        		<div class="scroll-list">
	        			<?php foreach ($roles as $role_key => $role_name) : ?>
	        				<div><label class="selectit"><input onclick="update_subscribers();" <?php echo (!empty($_POST['roles']) && is_array($_POST['roles']) && in_array($role_key, $_POST['roles'])) ? 'checked="checked"' : ''; ?> type="checkbox" name="roles[]" value="<?php echo esc_attr($role_key); ?>" id="roles_<?php echo $role_key; ?>" /> <?php echo __($role_name); ?><?php echo (!empty($count_users['avail_roles'][$role_key])) ? ' (' . sprintf(__('%s users'), $count_users['avail_roles'][$role_key]) . ')' : ''; ?></label></div>
	        			<?php endforeach; ?>
	        		</div>
	        	</div>
	        <?php endif; ?>
	    <?php endif; ?>
	</div>
	
	<!-- Filter Subscribers -->
	<div id="mailingliststabs-filter">
		<?php if (apply_filters('newsletters_admin_createnewsletter_daterangesettings', true)) : ?>
	        <div class="misc-pub-section">
	        	<h4><label><input onclick="update_subscribers(); if (this.checked == true) { jQuery('#daterange_div').show(); } else { jQuery('#daterange_div').hide(); }" <?php echo (!empty($_POST['daterange']) && $_POST['daterange'] == "Y") ? 'checked="checked"' : ''; ?> type="checkbox" name="daterange" value="Y" id="daterange" /> <?php _e('Filter by date', 'wp-mailinglist'); ?></label>
	        	<?php echo $Html -> help(__('Specify a date range with a from/to date that subscribers subscribed to include in this newsletter. Both the From and To dates are required and should be in the format YYYY-MM-DD (without time).', 'wp-mailinglist')); ?></h4>
	        	
	        	<div id="daterange_div" style="display:<?php echo (!empty($_POST['daterange']) && $_POST['daterange'] == "Y") ? 'block' : 'none'; ?>;">
	        		<p>
	        			<label for="daterangefrom"><?php _e('From Date', 'wp-mailinglist'); ?></label>
	        			<input placeholder="<?php echo esc_attr(wp_unslash($Html -> gen_date("Y-m-d", strtotime("-1 month")))); ?>" onblur="update_subscribers();" onkeyup="update_subscribers();" type="text" name="daterangefrom" value="<?php echo esc_attr(wp_unslash($_POST['daterangefrom'])); ?>" id="daterangefrom" class="widefat" style="width:120px;" />
	        		</p>
	        		<p>
	        			<label for="daterangeto"><?php _e('To Date', 'wp-mailinglist'); ?></label>
	        			<input placeholder="<?php echo esc_attr(wp_unslash($Html -> gen_date("Y-m-d"))); ?>" onblur="update_subscribers();" onkeyup="update_subscribers();" type="text" name="daterangeto" value="<?php echo esc_attr(wp_unslash($_POST['daterangeto'])); ?>" id="daterangeto" class="widefat" style="width:120px;" />
	        		</p>
	        	</div>
	        	
	        	<script type="text/javascript">
	        	jQuery(document).ready(function() {
		        	jQuery('#daterangefrom').datepicker({showButtonPanel:true, numberOfMonths:1, changeMonth:true, changeYear:true, defaultDate:"<?php echo esc_js($_POST['daterangefrom']); ?>", dateFormat:"yy-mm-dd"});
		        	jQuery('#daterangeto').datepicker({showButtonPanel:true, numberOfMonths:1, changeMonth:true, changeYear:true, defaultDate:"<?php echo esc_js($_POST['daterangeto']); ?>", dateFormat:"yy-mm-dd"});
	        	});
	        	</script>
	        </div>
	    <?php endif; ?>
	    <?php if (apply_filters('newsletters_admin_createnewsletter_fieldsconditionssettings', true)) : ?>
	    
	    	<?php $saveipaddress = $this -> get_option('saveipaddress'); ?>
	    	<?php if (!empty($saveipaddress)) : ?>
		    	<div class="misc-pub-section">
		        	<h4><label><input onclick="update_subscribers(); if (this.checked == true) { jQuery('#countries_div').show(); } else { jQuery('#countries_div').hide(); }" <?php echo (!empty($_POST['countries'])) ? 'checked="checked"' : ''; ?> type="checkbox" name="countries" value="1" id="countries" /> <?php _e('Filter by Country', 'wp-mailinglist'); ?></label>
		        	<?php echo $Html -> help(__('Specify a date range with a from/to date that subscribers subscribed to include in this newsletter. Both the From and To dates are required and should be in the format YYYY-MM-DD (without time).', 'wp-mailinglist')); ?></h4>
		        	
		        	<div id="countries_div" style="display:<?php echo (!empty($_POST['countries'])) ? 'block' : 'none'; ?>;">
		        		<select onchange="update_subscribers();" name="selectedcountries[]" multiple="multiple" style="width:100%;">
			        		<?php if ($countries = $this -> Country() -> select_code()) : ?>
			        			<?php foreach ($countries as $country_code => $country_name) : ?>
			        				<option <?php echo (!empty($_POST['selectedcountries']) && in_array($country_code, $_POST['selectedcountries'])) ? 'selected="selected"' : ''; ?> value="<?php echo esc_attr($country_code); ?>"><?php echo $country_name; ?></option>
			        			<?php endforeach; ?>
			        		<?php endif; ?>
		        		</select>
		        	</div>
		        </div>
		    <?php endif; ?>
	    
	        <?php 
		        
		    $Db -> model = $Field -> model;
		    $fieldsquery = "SELECT `id`, `title`, `type`, `validation`, `slug`, `fieldoptions` FROM `" . $wpdb -> prefix . $Field -> table . "` WHERE `type` = 'text' OR `type` = 'hidden' OR `type` = 'radio' OR `type` = 'checkbox' OR `type` = 'select' OR `type` = 'pre_country' OR `type` = 'pre_gender' ORDER BY `order` ASC"; 
		    
		    ?>
	        <?php
	        
	        $query_hash = md5($fieldsquery);
	        if ($ob_fields = $this -> get_cache($query_hash)) {
		        $fields = $ob_fields;
	        } else {
		        $fields = $wpdb -> get_results($fieldsquery);
		        $this -> set_cache($query_hash, $fields);
	        }
	        
	        ?>
	        <?php if (!empty($fields)) : ?>
	        
	        	<?php
		        	
		        foreach ($fields as $fkey => $field) {
			        $fields[$fkey] = $this -> init_class($Field -> model, $field);
		        }	
		        	
		        ?>
	        
	        	<div class="misc-pub-section">
	                <h4><label><input <?php echo (!empty($_POST['dofieldsconditions']) && !empty($_POST['conditions'])) ? 'checked="checked"' : ''; ?> type="checkbox" name="dofieldsconditions" value="1" id="dofieldsconditions" onclick="update_subscribers(); if (this.checked == true) { jQuery('#fieldsconditions').show(); } else { jQuery('#fieldsconditions').hide(); }" /> <?php _e('Filter by custom fields', 'wp-mailinglist'); ?></label>
	                <?php echo $Html -> help(__('This filter works on the custom fields of your subscribers. You can filter the subscribers in the chosen mailing list/s to queue/send to subscribers with specific custom field values only. For example, with a "Gender" custom field, you can choose "Male" here under this filter to send only to male subscribers.', 'wp-mailinglist')); ?></h4>
	                
	                <div id="fieldsconditions" style="display:<?php echo (!empty($_POST['dofieldsconditions']) && !empty($_POST['conditions'])) ? 'block' : 'none'; ?>;">
	                	<p>
		                	<?php _e('Match', 'wp-mailinglist'); ?>
		                	<select onchange="update_subscribers();" name="fieldsconditionsscope" id="fieldsconditionsscope">
		                		<option <?php echo (empty($_POST['conditionsscope']) || $_POST['conditionsscope'] == "all") ? 'selected="selected"' : ''; ?> value="all"><?php _e('all', 'wp-mailinglist'); ?></option>
		                		<option <?php echo (!empty($_POST['conditionsscope']) && $_POST['conditionsscope'] == "any") ? 'selected="selected"' : ''; ?> value="any"><?php _e('any', 'wp-mailinglist'); ?></option>
		                	</select>
		                	<?php _e('of these conditions:', 'wp-mailinglist'); ?>
		                </p>
	                
						<div id="fieldsconditionsfields">
							<?php foreach ($fields as $field) : ?>
		                    	<?php $supportedfields = array('text', 'hidden', 'radio', 'checkbox', 'select', 'pre_country', 'pre_gender'); ?>
		                    	<?php if (!empty($field -> type) && in_array($field -> type, $supportedfields)) : ?>
		                            <p>
		                                <label for="fields_<?php echo $field -> id; ?>" style="font-weight:normal;"><?php echo __($field -> title); ?></label><br/>
		                                
		                                <small>
		                                <?php
		                                
		                                $condquery = false;
		                                if (!empty($_POST['condquery'][$field -> slug])) {
		                                	$condquery = esc_html($_POST['condquery'][$field -> slug]);
										}
		                                
		                                switch ($field -> validation) {
		                                	case 'numeric'					:
		                                		?>
		                                		<label><input onclick="update_subscribers();" <?php echo (!empty($condquery) && $condquery == "smaller") ? 'checked="checked"' : ''; ?> type="radio" name="condquery[<?php echo $field -> slug; ?>]" value="smaller" id="condquery_<?php echo $field -> slug; ?>_smaller" /> <?php _e('Smaller', 'wp-mailinglist'); ?></label>
		                                		<label><input onclick="update_subscribers();" <?php echo (!empty($condquery) && $condquery == "larger") ? 'checked="checked"' : ''; ?> type="radio" name="condquery[<?php echo $field -> slug; ?>]" value="larger" id="condquery_<?php echo $field -> slug; ?>_larger" /> <?php _e('Larger', 'wp-mailinglist'); ?></label>
		                                		<?php
			                                case 'notempty'					:
			                                default							:
			                                	?>
		                                		<label><input onclick="update_subscribers();" <?php echo (empty($condquery) || (!empty($condquery) && $condquery == "equals")) ? 'checked="checked"' : ''; ?> type="radio" name="condquery[<?php echo $field -> slug; ?>]" value="equals" id="condquery_<?php echo $field -> slug; ?>_equals" /> <?php _e('Equals', 'wp-mailinglist'); ?></label>
												<label><input onclick="update_subscribers();" <?php echo (!empty($condquery) && $condquery == "contains") ? 'checked="checked"' : ''; ?> type="radio" name="condquery[<?php echo $field -> slug; ?>]" value="contains" id="condquery_<?php echo $field -> slug; ?>_contains" /> <?php _e('Contains', 'wp-mailinglist'); ?></label>
			                                	<?php
			                                	break;
		                                }
		                                
		                                ?>
		                                </small>	                                
		                                
		                                <?php
		                                
		                                switch ($field -> type) {
		                                	case 'text'				:
		                                	case 'hidden'			:
		                                	
		                                		$value = (empty($_POST['fields'][$field -> slug])) ? false : esc_attr(wp_unslash($_POST['fields'][$field -> slug]));
		                                	
		                                		?>
		                                		
		                                		<input onkeyup="update_subscribers();" type="text" name="fields[<?php echo $field -> slug; ?>]" value="<?php echo $value; ?>" id="fields_<?php echo $field -> id; ?>" />
		                                		
		                                		<?php
		                                		break;
											case 'radio'			:									
												?>
		                                        
		                                        <?php if (!empty($field -> newfieldoptions)) : ?>
		                                        	<?php $r = 1; ?>
		                                        	<br/>
		                                            <label><input <?php echo (empty($_POST['fields'][$field -> slug])) ? 'checked="checked"' : ''; ?> type="radio" name="fields[<?php echo $field -> slug; ?>]" value="" onclick="update_subscribers();" id="fields_<?php echo $field -> id; ?>-0" /> <?php _e('ALL', 'wp-mailinglist'); ?></label><br/>
		                                        	<?php foreach ($field -> newfieldoptions as $fieldoption_key => $fieldoption_val) : ?>
		                                        		<?php if (!empty($fieldoption_val)) : ?>
		                                            		<label><input <?php echo (!empty($_POST['fields'][$field -> slug]) && $_POST['fields'][$field -> slug] == $fieldoption_key) ? 'checked="checked"' : ''; ?> onclick="update_subscribers();" type="radio" name="fields[<?php echo $field -> slug; ?>]" value="<?php echo $fieldoption_key; ?>" id="fields_<?php echo $field -> id; ?>-<?php echo $r; ?>"  /> <?php echo __($fieldoption_val); ?></label><br/>
		                                            	<?php endif; ?>
		                                                <?php $r++; ?>
		                                            <?php endforeach; ?>
		                                        <?php endif; ?>
		                                        
		                                        <?php
												break;
											case 'checkbox'			:											
												?>
												<div>
												<?php if (!empty($field -> newfieldoptions)) : ?>
													<label style="font-weight:bold"><input type="checkbox" name="checkboxall<?php echo $field -> id; ?>" value="1" id="checkboxall<?php echo $field -> id; ?>" onclick="jqCheckAll(this, false, 'fields[<?php echo $field -> slug; ?>]');" /> <?php _e('Select all', 'wp-mailinglist'); ?></label><br/>
													<?php foreach ($field -> newfieldoptions as $option_id => $option_value) : ?>
														<label><input onclick="update_subscribers();" <?php echo (!empty($_POST['fields'][$field -> slug]) && in_array($option_id, $_POST['fields'][$field -> slug])) ? 'checked="checked"' : ''; ?>  type="checkbox" name="fields[<?php echo $field -> slug; ?>][]" value="<?php echo $option_id; ?>" id="fields_<?php echo $field -> id; ?>" /> <?php _e($option_value); ?></label><br/>
													<?php endforeach; ?>
												<?php endif; ?>
												</div>
												<?php											
												break;
		                                    case 'select'			:
		                                        ?><select style="max-width:250px;" name="fields[<?php echo $field -> slug; ?>]" id="fields_<?php echo $field -> id; ?>" onchange="update_subscribers();">
		                                        <option value=""><?php _e('- Select -', 'wp-mailinglist'); ?></option>
		                                        <?php 
		                                        
		                                        //$fieldoptions = @unserialize($field -> fieldoptions);
		                                        $fieldoptions = $field -> newfieldoptions;
		                                        if (!empty($fieldoptions)) {
			                                        foreach ($fieldoptions as $fieldoption_key => $fieldoption_val) {
			                                            ?><option <?php echo (!empty($_POST['fields'][$field -> slug]) && $_POST['fields'][$field -> slug] == $fieldoption_key) ? 'selected="selected"' : ''; ?> value="<?php echo $fieldoption_key; ?>"><?php echo __($fieldoption_val); ?></option><?php	
			                                        }
			                                    }
		                                        
		                                        ?>
		                                        </select><?php
		                                        break;
											case 'pre_country'		:
												?>
		                                        
		                                        <?php if ($countries = $this -> Country() -> select()) : ?>
		                                            <select style="max-width:250px;" name="fields[<?php echo $field -> slug; ?>]" id="fields_<?php echo $field -> id; ?>" onchange="update_subscribers();">
		                                                <option value=""><?php _e('- Select Country -', 'wp-mailinglist'); ?></option>
		                                                <?php foreach ($countries as $country_id => $country_name) : ?>
		                                                	<option <?php echo (!empty($_POST['fields'][$field -> slug]) && $_POST['fields'][$field -> slug] == $country_id) ? 'selected="selected"' : ''; ?> value="<?php echo $country_id; ?>"><?php echo $country_name; ?></option>
		                                                <?php endforeach; ?>
		                                            </select>
		                                        <?php endif; ?>
		                                        
		                                        <?php
												break;
											case 'pre_gender'		:
												?>
		                                        
		                                        <select style="max-width:250px;" name="fields[<?php echo $field -> slug; ?>]" id="fields_<?php echo $field -> id; ?>" onchange="update_subscribers();">
		                                        	<option value=""><?php _e('- Select Gender -', 'wp-mailinglist'); ?></option>
		                                            <option <?php echo (!empty($_POST['fields'][$field -> slug]) && $_POST['fields'][$field -> slug] == "male") ? 'selected="selected"' : ''; ?> value="male"><?php _e('Male', 'wp-mailinglist'); ?></option>
		                                            <option <?php echo (!empty($_POST['fields'][$field -> slug]) && $_POST['fields'][$field -> slug] == "female") ? 'selected="selected"' : ''; ?> value="female"><?php _e('Female', 'wp-mailinglist'); ?></option>
		                                            <option <?php echo (!empty($_POST['fields'][$field -> slug]) && $_POST['fields'][$field -> slug] == "other") ? 'selected="selected"' : ''; ?> value="other"><?php _e('Other', 'wp-mailinglist'); ?></option>
		                                        </select>
		                                        
		                                        <?php
												break;	
		                                }
		                                
		                                ?>
		                            </p>
		                        <?php endif; ?>
		                    <?php endforeach; ?>
						</div>
	                </div>
	            </div>
	        <?php endif; ?>
	    <?php endif; ?>
	</div>
</div>

<div class="submitbox">
	<div>
		<div class="misc-pub-section">
			<p>
				<label for="status_active" style="font-weight:bold;"><?php _e('Status:', 'wp-mailinglist'); ?></label><br/>
				<label class="newsletters_success"><input <?php echo (empty($_POST['status']) || $_POST['status'] == "active") ? 'checked="checked"' : ''; ?> onclick="update_subscribers();" type="radio" name="status" value="active" id="status_active" /> <?php _e('Active', 'wp-mailinglist'); ?></label><br/>
				<label class="newsletters_error"><input <?php echo (!empty($_POST['status']) && $_POST['status'] == "inactive") ? 'checked="checked"' : ''; ?> onclick="update_subscribers();" type="radio" name="status" value="inactive" id="status_inactive" /> <?php _e('Inactive', 'wp-mailinglist'); ?></label><br/>
				<label class="newsletters_warning"><input <?php echo (!empty($_POST['status']) && $_POST['status'] == "all") ? 'checked="checked"' : ''; ?> onclick="update_subscribers();" type="radio" name="status" value="all" id="status_active" /> <?php _e('All/Both', 'wp-mailinglist'); ?></label>
			</p>
		</div>
		 
        <!-- Mailing Lists Errors -->
        <?php global $errors, $wpdb; ?>
        <?php if (!empty($errors['mailinglists'])) : ?>
            <p class="newsletters_error"><?php echo $errors['mailinglists']; ?></p>
        <?php endif; ?>
        
        <?php if (apply_filters('newsletters_admin_createnewsletter_subscribercount', true)) : ?>
	        <div class="misc-pub-section misc-pub-section-last">
	            <div id="subscriberscount">
	                <p><?php _e('0 subscribers total', 'wp-mailinglist'); ?></p>
	            </div>
	            
	            <p>
	            	<?php /*<a class="button button-secondary" id="updatesubscriberscountbutton" href="javascript:update_subscribers();"><?php _e('Update Count', 'wp-mailinglist'); ?></a>*/ ?>
	            	<input type="button" class="button button-secondary" id="updatesubscriberscountbutton" onclick="update_subscribers(); return false;" value="<?php _e('Update Count', 'wp-mailinglist'); ?>" />
	            	<?php echo $Html -> help(__('Click this button to update the subscribers count above in real-time. The subscribers count is an accurate count of how many subscribers this newsletter will be sent to based on the group, mailing list, custom fields filters and other selections made.', 'wp-mailinglist')); ?>	
	            </p>
	        </div>
	    <?php endif; ?>
    </div>
</div>

<script type="text/javascript">
var srequest = false;

jQuery(document).ready(function() {
	<?php if (!empty($_POST['mailinglists']) || !empty($_POST['roles'])) : ?>
		update_subscribers();
	<?php endif; ?>	
		
	if (jQuery.isFunction(jQuery.fn.tabs)) {
		jQuery('#mailingliststabs').tabs();
	}
});

function update_subscribers() {
	if (srequest) { srequest.abort(); }
	//jQuery('#updatesubscriberscountbutton').attr('disabled', "disabled");
	
	var formvalues = jQuery('form#post').serialize();
	
	jQuery('#updatesubscriberscountbutton').prop('disabled', true);
	jQuery("#subscriberscount").html('<p><i class="fa fa-refresh fa-spin fa-fw"></i> <?php echo addslashes(__('loading subscriber count...', 'wp-mailinglist')); ?></p>');
	
	srequest = jQuery.ajax({
		url: newsletters_ajaxurl + 'action=subscribercount&security=<?php echo wp_create_nonce('subscribercount'); ?>',
		data: formvalues,
		type: "POST",
		cache: false
	}).done(function(data, textStatus, jqXHR) {
		if (data == 0) {
			jQuery('#sendbutton, #sendbutton2').prop('disabled', true);
			//jQuery('#savedraftbutton, #savedraftbutton2').prop('disabled', true);	
			jQuery('#subscriberscount').html('<p><?php echo __('No subscribers are available', 'wp-mailinglist'); ?></p>');
		} else {
			jQuery('#subscriberscount').html(data);
			jQuery('#sendbutton, #sendbutton2').prop('disabled', false);
			//jQuery('#savedraftbutton, #savedraftbutton2').prop('disabled', false);
			jQuery('#updatesubscriberscountbutton').prop('disabled', false);
		}
	}).fail(function(jqXHR, textStatus, errorThrown) {
		// an error occurred
	}).always(function(data, textStatus, jqXHR) {
		// do nothing...
	});
}
</script>