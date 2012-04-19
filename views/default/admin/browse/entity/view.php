<?php

	elgg_load_js('entity_browser_table_sorter');
	elgg_load_js('entity_browser_accordion_chili');
	elgg_load_js('entity_browser_accordion_easing');
	elgg_load_js('entity_browser_accordion_dimensions');
	elgg_load_js('entity_browser_accordion');
	elgg_load_js('entity_browser_js');

	echo elgg_view('output/url', array('href' => 'admin/browse/entity/list', 'text' => elgg_echo('entity_browser:menu:back:to_list'))).'<br />';

	$entity_guid = get_input('guid');
	
	if($entity = get_entity($entity_guid))
	{
		if(in_array($entity->type, array('user', 'object', 'group', 'site')))
		{
			echo elgg_view('entity/object/'.$entity->type, array('entity' => $entity));
		}
		
		?><div id="entity_browser_details" class="basic">
			<?php echo elgg_view('entity/metadata', 		array('entity' => $entity));?>
			
			<?php echo elgg_view('entity/annotations', 		array('entity' => $entity));?>
			
			<?php echo elgg_view('entity/owner', 			array('entity' => $entity));?>
			
			<?php echo elgg_view('entity/container', 		array('entity' => $entity));?>
			
			<?php echo elgg_view('entity/relationships',	array('entity' => $entity));?>
		</div>
		<?php 
	}