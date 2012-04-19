<?php 

	$entity = $vars['entity'];
	$guid = $vars['guid'];

	if($entity || ($entity = get_entity($guid)))
	{
		$entity_url = $vars['url'] . 'admin/browse/entity/view?guid=' . $entity->getGUID();
		
		switch ($entity->type)
		{
			case 'site':
				$title = $entity->name;
				break;
			case 'object':
				$title = $entity->title;
				break;
			case 'group':
				$title = $entity->name;
				break;
			case 'user':
				$title = $entity->name;
				break;
		}
		
		?>
		<td>
		<!-- <a href="<?php echo $entity_url; ?>"> -->
		<?php echo $title; ?> 
		<!-- (<?php echo $entity->getGUID();?>)</a> --></td>
	<?php 
	}