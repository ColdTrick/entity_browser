<?php 

	$time = $vars['time'];
	
	if($time > 0)
	{
		$time = elgg_view_friendly_time($time);
	}
	else
	{
		$time = '<span class="empty">[empty value]</span>';
	}
?>
	<td><?php echo $time; ?></td>