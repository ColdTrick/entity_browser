<?php 

	if($_GET['type'] == 'csv')
	{	
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

		$csv_fields = array();
		$csv_fields[] = $displayed_properties;
		
		$i = 1;
		foreach($entities as $entity)
		{
			foreach($displayed_properties as $property)
			{
				$text = entity_browser_get_entity_property_text($entity, $property, true);
				$csv_fields[$i][] = $text; 
			}
			$i++;
		}
		
		$file = 'export.csv';
		
		$fp = fopen($file, 'w+');
		
		foreach ($csv_fields as $fields)
		{
		    fputcsv($fp, $fields);
		}
		
		fclose($fp);
		
		$content = file_get_contents($file);		

		header("Content-type: application/octet-stream");
    	header('Content-Disposition: attachment; filename='.basename($file));
    	header('Content-Length: ' . filesize($file));
		
    	echo $content;
		
		exit;
	}