<?php
	
	access_show_hidden_entities(true);
	
	$node_id = get_input('id', 'entity');
	switch ($node_id) {
		case 1:
		case 'entity':
			$options = array(
				'type' => 'user',
				'count' => true
			);
			
			$users_count 	= elgg_get_entities($options);					
			$objects_count 	= elgg_get_entities(array('type' => 'object', 'count' => true));				
			$groups_count 	= elgg_get_entities(array('type' => 'group', 'count' => true));			
			$sites_count 	= elgg_get_entities(array('type' => 'site', 'site_guids' => ELGG_ENTITIES_ANY_VALUE, 'count' => true));
			
			$entities_count = ($users_count + $objects_count + $groups_count + $sites_count);

			$entity_stats = get_entity_statistics();
			foreach($entity_stats['object'] as $subtype => $count)
			{
				$object_children[] = array('data' => array('title' => "{$subtype} ({$count})"), 'attr' => array('id' => $subtype));
			}

			$nodes = array(
				'data' => array('title' => elgg_echo('entity_browser:tree:entities') . '(' . $entities_count . ')'), 'attr' => array('id' => 'entity'),
				'state' => 'open',
				'children' => array(
					array('data' => array('title' => elgg_echo('entity_browser:tree:users') . 	'(' . $users_count . ')'), 		'attr' => array('id' => 'user')),
					array('data' => array('title' => elgg_echo('entity_browser:tree:objects') . '(' . $objects_count . ')'), 	'attr' => array('id' => 'object'), 'state' => 'closed', 'children' => $object_children),
					array('data' => array('title' => elgg_echo('entity_browser:tree:groups') . 	'(' . $groups_count . ')'), 	'attr' => array('id' => 'group')),
					array('data' => array('title' => elgg_echo('entity_browser:tree:sites') . 	'(' . $sites_count . ')'), 		'attr' => array('id' => 'site')),
				)
			);
			break;
	}

	header("HTTP/1.0 200 OK");
	header('Content-type: text/json; charset=utf-8');
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Pragma: no-cache");
	
	echo json_encode($nodes);
	
	exit;