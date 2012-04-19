<?php 

	$guid = get_input('guid');

	$result = array();

	access_show_hidden_entities(true);
	
	if($entity = get_entity($guid)){
		$result['content'] = elgg_view('entity/tip/' . $entity->type, array('entity' => $entity));
	}else{
		$result['content'] = elgg_echo('entity_browser:table:tooltip:no_entity');
	}
	
	access_show_hidden_entities(false);

	echo json_encode($result);
	exit;