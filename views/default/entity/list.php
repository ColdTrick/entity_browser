<?php 

	$entities = $vars['entities'];
	$count = $vars['count'];
	
	echo $count;?> entities found.
	<div>
		<?php echo elgg_view('misc/table', array('id' => 'entity_list'));?>
		<thead>	
		<tr>
			<?php 
				echo elgg_view('entity/head');
			?>
		</tr>
		</thead> 
		<tbody>
			<?php 
			foreach($entities as $entity)
			{
				echo elgg_view('entity/row', array('entity' => $entity));
			}
			?>
		</tbody>
	</table></div>