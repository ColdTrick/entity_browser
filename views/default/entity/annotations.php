<?php 
	$entity = $vars['entity'];
	
	$options["wheres"] = elgg_get_guid_based_where_sql('n_table.entity_guid', $entity->getGUID());
	$options["limit"] = false;
	
	if($annotations = elgg_get_annotations($options))
	{
		?>
		<a class="tab"><?php echo elgg_echo('annotations');?> (<?php echo count($annotations);?> found)</a>
		<div>
			<?php echo elgg_view('misc/table', array('id' => 'annotations_list'));?>
				<thead>	
				<tr>
					<th class="guid"><?php echo elgg_echo('Guid');?></th>
					<th class="name"><?php echo elgg_echo('entity_browser:table:header:name');?></th>
					<th class="value"><?php echo elgg_echo('value');?></th>
					<th class="type"><?php echo elgg_echo('entity_browser:table:header:type');?></th>
					<th class="owner"><?php echo elgg_echo('entity_browser:table:header:owner');?></th>
				</tr>
				</thead> 
				<tbody>
		<?php 
		foreach($annotations as $annotation)
		{
			
			?><tr>
				<td><?php echo $annotation->id?></td>
				<td><?php echo $annotation->name;?></td>
				<td><?php echo strip_tags($annotation->value);?></td>
				<td><?php echo $annotation->value_type;?></td>
				<?php echo elgg_view('cell/owner', array('entity' => $annotation));?>
			</tr>
			<?php 
		}
		?>
		
			</tbody>
		</table>
		</div>
		<?php 
	}