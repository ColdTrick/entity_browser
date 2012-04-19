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
			<td><?php echo elgg_echo('entity_browser:table:header:name');?></td>
			<td><?php echo $entity->name;?></td>
		</tr>
		<tr>
			<td><?php echo elgg_echo('username');?></td>
			<td><?php echo $entity->username;?></td>
		</tr>
		<tr>
			<td><?php echo elgg_echo('email');?></td>
			<td><?php echo $entity->email;?></td>
		</tr>
		<tr>
			<td><?php echo elgg_echo('entity_browser:table:header:language');?></td>
			<td><?php echo $entity->language;?></td>
		</tr>
		<tr>
			<td><?php echo elgg_echo('admin');?></td>
			<td><?php
			if($entity->isAdmin())
			{
				echo elgg_echo('option:yes');
			}
			else
			{
				echo elgg_echo('option:no');
			}
			?></td>
		</tr>
		<tr>
			<td><?php echo elgg_echo('banned');?></td>
			<td><?php echo $entity->banned;?></td>
		</tr>
		<tr>
			<td><?php echo elgg_echo('entity_browser:table:header:last_login');?></td>
			<?php echo elgg_view('cell/time', array('time' => $entity->last_login));?>
		</tr>
		<tr>
			<td><?php echo elgg_echo('entity_browser:table:header:prev_last_login');?></td>
			<?php echo elgg_view('cell/time', array('time' => $entity->prev_last_login));?>
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