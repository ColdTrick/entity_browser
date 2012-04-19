<?php

	$result = array();

	access_show_hidden_entities(true);
	
	$type = get_input('type', 'entity');
	$show_metadata = get_input('show_metadata', false);
	
	$options = array(
		'offset' => $offset,
		'limit' => $limit,
		'full_view' => false,
	);
	
	if ($type != 'entity')
	{
		$options['type'] = $type;
	}
	
	if(!array_key_exists($type, entity_browser_get_core_properties()))
	{
		$options['subtype'] = $type;
		
		$type = 'object';
		$options['type'] = $type;
	}
	
	$entities = elgg_get_entities($options);
	
	$displayed_properties = entity_browser_get_displayed_properties($entities, array('type' => $type, 'show_metadata' => $show_metadata));
	
	foreach($displayed_properties as $test)
	{
		$result['content'] .= '<option value="' . $test . '">' . $test . '</option>';
	}
	
	echo json_encode($result);
	exit;