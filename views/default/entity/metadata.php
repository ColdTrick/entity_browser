<?php 
	$entity = $vars['entity'];
	
	$options["wheres"] = elgg_get_guid_based_where_sql('n_table.entity_guid', $entity->getGUID());
	$options["limit"] = false;
	
	if($metadata = elgg_get_metadata($options))
	{
		?>
		<a class="tab"><?php echo elgg_echo('metadata');?> (<?php echo count($metadata);?> found)</a>
		<div>
			<?php echo elgg_view('misc/table');?>
				<thead>	
				<tr>
					<th class="name"><?php echo elgg_echo('entity_browser:table:header:name');?></th>
					<th class="value"><?php echo elgg_echo('value');?></th>
					<th class="type"><?php echo elgg_echo('entity_browser:table:header:type');?></th>
					<th class="owner"><?php echo elgg_echo('entity_browser:table:header:owner');?></th>
				</tr>
				</thead> 
				<tbody>
				
				<?php 
				foreach($metadata as $metadata_item)
				{
					?><tr>
						<td><?php echo get_metastring($metadata_item->name_id);?> (<?php echo $metadata_item->name_id;?>)</td>
						<td><?php echo get_metastring($metadata_item->value_id);?> (<?php echo $metadata_item->value_id;?>)</td>
						<td><?php echo $metadata_item->value_type;?></td>
						<?php echo elgg_view('cell/owner', array('entity' => $metadata_item));?>
					</tr>
					<?php 
				}
				?>
				
				</tbody>
			</table>
		</div>
		<?php 
	}