<?php

	elgg_load_js('entity_browser_table_sorter');
	elgg_load_js('entity_browser_js');

	$relationship = get_input('relationship');

	if($relationships = entity_browser_get_relationships_by_type($relationship))
	{		
		echo elgg_view('relationship/list', array('relationships' => $relationships, 'relation' => $relationship));
	}