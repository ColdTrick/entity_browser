<?php 
	$entity = $vars['entity'];
	
	if($entities = entity_browser_get_entity_relationships($entity->getGUID()))
	{
		?>
		<a class="tab"><?php echo elgg_echo('relationships');?> (<?php echo count($entities);?> found)</a>
		<div>
			<?php echo elgg_view('misc/table');?>
			<thead>	
			<tr>
				<th><?php echo elgg_echo('entity_browser:table:header:name');?></th>
				<th><?php echo elgg_echo('entity_browser:table:header:relationship');?></th>
				<th><?php echo elgg_echo('entity_browser:table:header:name');?></th>
				<th><?php echo elgg_echo('entity_browser:table:header:time_created');?></th>
			</tr>
			</thead> 
			<tbody>
				<?php 
				foreach($entities as $relation_entity)
				{
					echo elgg_view('relationship/row', array('entity' => $relation_entity, 'inverse_relation' => $inverse_relationship));
				}
				?>
			</tbody>
		</table>
		</div>
		<?php 
	}