<div class="newsletters-dashboard-widget">
	<?php
		
	$user_chart = $this -> get_user_option(false, 'chart');
	$chart = (empty($user_chart)) ? "bar" : $user_chart;
	
	$from = $Html -> gen_date("Y-m-d", strtotime("-6 days"));
	$to = $Html -> gen_date("Y-m-d");
	
	?>
	
	<p>
		<a href="<?php echo $Html -> retainquery('newsletters_method=set_user_option&option=chart&value=bar'); ?>" class="button <?php echo (empty($chart) || $chart == "bar") ? 'active' : ''; ?>"><i class="fa fa-bar-chart"></i></a>
		<a href="<?php echo $Html -> retainquery('newsletters_method=set_user_option&option=chart&value=line'); ?>" class="button <?php echo (!empty($chart) && $chart == "line") ? 'active' : ''; ?>"><i class="fa fa-line-chart"></i></a>
		<?php echo $Html -> help(__('Switch between bar and line charts.', 'wp-mailinglist')); ?>
	</p>
	
	<div>
		<div id="chart-legend" class="newsletters-chart-legend"></div>
		<canvas id="canvas" style="width:100%; height:200px;"></canvas>
	</div>
	<br class="clear" />
	
	<script type="text/javascript">
	jQuery(document).ready(function() {
		var ajaxdata = {chart:'<?php echo $chart; ?>', from:'<?php echo $from; ?>', to:'<?php echo $to; ?>'};
		
		jQuery.getJSON(newsletters_ajaxurl + 'action=wpmlwelcomestats&security=<?php echo wp_create_nonce('welcomestats'); ?>', ajaxdata, function(json) {
			var chartdata = json;
			var ctx = document.getElementById("canvas").getContext("2d");
			
			var chart = new Chart(ctx, {
				type: '<?php echo (empty($chart) || $chart == "bar") ? 'bar' : 'line'; ?>',
				data: chartdata, 
				options: {
					tooltips: {
						mode: 'index'
					}
				}
			});
		})
	});
	</script>
	
	<?php
	
	$histories = $this -> History() -> find_all(false, false, array('modified', "DESC"), 5);
	
	?>
	
	<div class="newsletters-dashboard-widget-column">		
		<h4><?php _e('Recent Newsletters', 'wp-mailinglist'); ?></h4>
		<?php if (!empty($histories)) : ?>
			<ul>
				<?php foreach ($histories as $history) : ?>
					<li>
						<a class="welcome-icon dashicons-edit" style="float:left; padding:0; width:20px;" href="<?php echo admin_url('admin.php?page=' . $this -> sections -> send . '&method=history&id=' . $history -> id); ?>"></a>
						<a class="welcome-icon dashicons-visibility" href="<?php echo admin_url('admin.php?page=' . $this -> sections -> history . '&method=view&id=' . $history -> id); ?>"><?php _e($history -> subject); ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
			
			<a class="button button-primary button-hero" href="<?php echo admin_url('admin.php?page=' . $this -> sections -> history); ?>"><?php _e('View All Newsletters', 'wp-mailinglist'); ?></a>
			<p><?php _e('or', 'wp-mailinglist'); ?> <a href="<?php echo admin_url('admin.php?page=' . $this -> sections -> send); ?>"><?php _e('create a new one', 'wp-mailinglist'); ?></a></p>
		<?php else : ?>
			<p><?php echo sprintf(__('No emails are available yet, please %s.', 'wp-mailinglist'), '<a href="' . admin_url('admin.php?page=' . $this -> sections -> send) . '">' . __('create one', 'wp-mailinglist') . '</a>'); ?></p>
		<?php endif; ?>
	</div>
	
	<?php
	
	global $wpdb;
	$Db -> model = $Email -> model;
	$emails = $Db -> count();
	$read = $Db -> count(array('read' => "Y"));
	$tracking = (($read / $emails) * 100);
	$Db -> model = $Subscriber -> model;
	$total = $Db -> count();
	$Db -> model = $SubscribersList -> model;
	$active = $Db -> count(array('active' => "Y"));
	$Db -> model = $Unsubscribe -> model;
	$unsubscribes = $Db -> count();
	$eunsubscribeperc = (($unsubscribes / $emails) * 100);
	$query = "SELECT SUM(`count`) FROM `" . $wpdb -> prefix . $Bounce -> table . "`";
	$bounces = $wpdb -> get_var($query);
	$bounces = (empty($bounces)) ? 0 : $bounces;
	$ebouncedperc = (($bounces / $emails) * 100);
	
	$options = array();
	
	$data = array(
		'datasets'		=>	array(
			array(
				'data'					=>	array(
					number_format($tracking, 0, '.', ''),
					number_format((100 - $tracking), 0, '.', ''),
					number_format($ebouncedperc, 0, '.', ''),
					number_format($eunsubscribeperc, 0, '.', ''),
				),
				'backgroundColor'		=>	array(
					'#46BFBD',
					'#949FB1',
					'#F7464A',
					'#FDB45C',
				)
			)
		),
		'labels'		=>	array(
			__('Read', 'wp-mailinglist'),
			__('Unread', 'wp-mailinglist'),
			__('Bounced', 'wp-mailinglist'),
			__('Unsubscribed', 'wp-mailinglist'),
		)
	);
	
	?>
	
	<div class="newsletters-dashboard-widget-column">
		<h4><?php _e('Overview', 'wp-mailinglist'); ?></h4>
		<?php $Html -> pie_chart('overview-chart', array('width' => 200), $data, $options); ?>
	</div>
	
	<br class="clear" />
</div>