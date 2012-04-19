<?php

	//elgg_load_js('entity_browser_tooltip');
	elgg_load_js('entity_browser_jstree');
	elgg_load_js('entity_browser_loadmask');
	elgg_load_js('tooltipshit');
	elgg_load_js('entity_browser_js');
	
	$search 	= entity_browser_search_entities();
	$entities 	= $search['entities'];

	$displayed_properties = entity_browser_get_displayed_properties($entities);
	
	echo elgg_view('misc/header');
	
	echo elgg_view('misc/sidebar');
	
	echo elgg_view('misc/table', array(	'id' 					=> 'list_entities', 
										'entities' 				=> $entities, 
										'displayed_properties' 	=> $displayed_properties));