<?php 

	$entity = $vars['entity'];

	if($entity)
	{
		if(!$entity->getOwnerEntity()->title)
		{
			$name = get_entity($entity->container_guid)->name;
		}
		else
		{
			$name = get_entity($entity->container_guid)->title;
		}
		
		$container_url = $vars['url'] . 'admin/browse/entity/view?guid=' . $entity->container_guid;
	?>
	<td><a href="<?php echo $container_url;?>"><?php echo $name;?> (<?php echo $entity->container_guid;?>)</a></td>
	<?php 
	}