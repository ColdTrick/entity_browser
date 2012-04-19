<?php

	$result = array();
	
	$displayed_properties 	= get_input('displayed_properties');
	$sort 					= get_input('sort', 'time_created');
	$direction 				= get_input('direction', 'desc');
	$offset 				= get_input('offset', 0);
	$limit 					= get_input('limit', 10);
	
	if(!$displayed_properties)
	{
		$displayed_properties = array();
	}
	else
	{
		$displayed_properties = explode(',', $displayed_properties);
	}
	
	$show_metadata 			= get_input('show_metadata', 0);
	if($show_metadata == 1) {
		$show_metadata = true;
	} else {
		$show_metadata = false;
	}
	
	$type 					= get_input('type');
	
	$current_type = $type;
	
	$filters = array();	
	foreach($_POST as $key => $value) 
	{
		$value = get_input($key);
		
		if((strpos($key, 'filter:') === 0) && (!empty($value)))
		{
			$filters[$key] = $value;
		}
	}
	
	$result['show_metadata'] 	= $show_metadata;
	$result['type'] 			= $type;
	$result['sort'] 			= $sort;
	$result['direction'] 		= $direction;
	$result['offset'] 			= $offset;
	$result['limit'] 			= $limit;
	
	if(!array_key_exists($type, entity_browser_get_core_properties()))
	{
		$subtype = $type;
		$type = 'object';
	}
	
	$options = array(	'type' 		=> $type,
						'subtype'	=> $subtype,
						'sort' 		=> $sort,
						'direction' => $direction,
						'offset' 	=> $offset,
						'limit' 	=> $limit,
						'filters'	=> $filters);
	
	$search 	= entity_browser_search_entities($options);	
	$entities 	= $search['entities'];
	
	$displayed_properties = entity_browser_get_displayed_properties($entities, array('type' => $type, 'show_metadata' => $show_metadata, 'displayed_properties' => $displayed_properties));
	
	$result['headers'] = elgg_view('misc/thead', array('headers' => $displayed_properties));
	$result['content'] = elgg_view('misc/body', array('entities' => $entities, 'headers' => $displayed_properties));
	$result['footer'] = elgg_view('misc/tfoot', array('headers' => $displayed_properties));
	

	echo json_encode($result);
	exit;