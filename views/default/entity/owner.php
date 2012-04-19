<?php 

	$entity = $vars['entity'];
	
	$options = array(
		'owner_guid' => $entity->getOwnerGUID()
	);

	if($owning_entities = elgg_get_entities($options))
	{
		?>
		<a class="tab"><?php echo elgg_echo('entity_browser:accordion:head:owning');?> (<?php echo count($owning_entities);?> found)</a>
		<div>
			<?php echo elgg_view('misc/table', array('id' => 'owner_list'));?>
			<thead>	
			<tr>
				<?php 
					echo elgg_view('entity/head');
				?>
			</tr>
			</thead> 
			<tbody>
			<?php 
			foreach($owning_entities as $owning_entity)
			{
				echo elgg_view('entity/row', array('entity' => $owning_entity));
			}
			?>
			</tbody>
		</table>
		</div>
		<?php
	}