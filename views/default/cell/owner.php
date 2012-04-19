<?php 

	$entity = $vars['entity'];

	if($entity)
	{
		if(!$entity->getOwnerEntity()->title)
		{
			$name = $entity->getOwnerEntity()->name;
		}
		else
		{
			$name = $entity->getOwnerEntity()->title;
		}
		
		$owner_url = $vars['url'] . 'admin/browse/entity/view?guid=' . $entity->owner_guid;
	?>
	<td><a href="<?php echo $owner_url;?>"><?php echo $name;?> (<?php echo $entity->owner_guid;?>)</a></td>
	<?php 
	}
	?>