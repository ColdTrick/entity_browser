<?php

	$result = array();

	access_show_hidden_entities(true);
	
	$type = get_input('type', 'entity');
	$show_metadata = get_input('show_metadata', false);
	$displayed_properties = get_input('displayed_properties');
	
	$displayed_properties = (array)$displayed_properties;
	
	$options = array(
		'offset' => $offset,
		'limit' => $limit,
		'full_view' => false,
	);
	
	if($type != 'entity')
	{
		$options['type'] = $type;
	}
	
	$entities = elgg_get_entities($options);
	
	$displayed_properties = entity_browser_get_displayed_properties($entities, array(	'type' => $options['type'], 
																						'show_metadata' => $show_metadata, 
																						'displayed_properties' => $displayed_properties));	
	
	$result['headers'] = elgg_view('misc/thead', array('headers' => $displayed_properties));
	$result['footer'] = elgg_view('misc/tfoot', array('headers' => $displayed_properties));
	
	
	echo json_encode($result);
	exit;