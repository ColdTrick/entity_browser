<?php

	elgg_load_js('entity_browser_table_sorter');
	elgg_load_js('entity_browser_accordion_chili');
	elgg_load_js('entity_browser_accordion_easing');
	elgg_load_js('entity_browser_accordion_dimensions');
	elgg_load_js('entity_browser_accordion');
	elgg_load_js('entity_browser_js');

	echo elgg_view('output/url', array('href' => 'admin/browse/entity/list', 'text' => elgg_echo('entity_browser:menu:back:to_list'))).'<br />';

	$relation = get_input('relationship');
	
	if($relations = get_relationships_by_type($relation))
	{
		?>
		<div id="entity_browser_details" class="basic">
			<?php echo elgg_view('relationship/row', array('relations' => $relations));?>
		</div>
		<?php
	}