<?php

$guid_based_tooltip_fields = $vars['entity']->guid_based_tooltip_fields;
$time_based_tooltip_fields = $vars['entity']->time_based_tooltip_fields;
$date_time_format = $vars['entity']->date_time_format;

if(!$date_time_format)
{
	$date_time_format = 'd-m-Y G:i';
}

?>
<div>
	<?php echo elgg_echo('entity_browser:settings:fields:guid'); ?>
	
	<?php
		echo elgg_view('input/tags', array(
			'name' => 'params[guid_based_tooltip_fields]',
			'value' => $guid_based_tooltip_fields
		));
	?>
</div>

<div>
	<?php echo elgg_echo('entity_browser:settings:fields:time'); ?>
	
	<?php
		echo elgg_view('input/tags', array(
			'name' => 'params[time_based_tooltip_fields]',
			'value' => $time_based_tooltip_fields
		));
	?>
</div>

<div>
	<?php echo elgg_echo('entity_browser:settings:date_time_format'); ?>
	
	<?php
		echo elgg_view('input/text', array(
			'name' => 'params[date_time_format]',
			'value' => $date_time_format
		)); 
	?>
</div>
