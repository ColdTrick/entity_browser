<?php 
	$entity = $vars['entity'];

	$entity_url = $vars['url'] . 'admin/browse/entity/view?guid=' . $entity->getGUID();
	$owner_url 	= $vars['url'] . 'admin/browse/owner/view?guid=' . $entity->owner_guid;
	
	if($entity->isEnabled()){
		$class = 'enabled';
	} else {
		$class = 'disabled';
	}
?>
<tr>
	<td class="<?php echo $class; ?>"><a href="<?php echo $entity_url; ?>"><?php echo $entity->getGUID(); ?></a></td>
	
	<?php echo elgg_view('cell/entity', array('entity' => $entity));?>
	
	<td><?php echo $entity->type; ?></td>
	
	<td><?php echo $entity->getSubtype() . ' (' . $entity->subtype . ')'; ?></td>
			
	<?php echo elgg_view('cell/owner', array('entity' => $entity));?>
			
	<td><?php echo elgg_get_site_entity($entity->site_guid)->name . ' (' . $entity->site_guid . ')'; ?></td>
		
	<?php echo elgg_view('cell/container', array('entity' => $entity));?>	
	
	<td><?php echo elgg_view('output/access', array('entity' => $entity)); ?></td>
		
	<?php echo elgg_view('cell/time', array('time' => $entity->time_created));?>
</tr>