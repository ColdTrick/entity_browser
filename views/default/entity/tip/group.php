<?php 

	$entity = $vars['entity'];
?>
<table class="elgg-table" style="width: auto !important;">
	<thead>
		<tr>
			<th><?php echo elgg_echo('column');?></th>
			<th><?php echo elgg_echo('value');?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo elgg_echo('entity_browser:table:header:name'); ?></td>
			<td><?php echo $entity->name; ?></td>
		</tr>
		<tr>
			<td><?php echo elgg_echo('description'); ?></td>
			<td><?php echo elgg_get_excerpt($entity->description); ?></td>
		</tr>
		<tr>
			<td><?php echo elgg_echo('entity_browser:table:header:time_created'); ?></td>
			<?php echo elgg_view('cell/time', array('time' => $entity->time_created));?>
		</tr>
		<tr>
			<td><?php echo elgg_echo('entity_browser:table:header:time_updated'); ?></td>
			<?php echo elgg_view('cell/time', array('time' => $entity->time_updated));?>
		</tr>
		<tr>
			<td><?php echo elgg_echo('entity_browser:table:header:last_action'); ?></td>
			<?php echo elgg_view('cell/time', array('time' => $entity->last_action));?>
		</tr>
	</tbody>
</table>
<?php 