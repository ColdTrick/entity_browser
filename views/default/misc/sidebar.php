<div id="entity_browser_sidebar">

	<div id="entity_browser_sidebar_objects_tree"></div>
	
	<div id="entity_browser_sidebar_search_options">
		<?php echo elgg_view('input/checkbox', array('id' => 'entity_browser_options_show_metadata', 'name' => 'show_metadata', 'value' => '1')); ?> 
		<?php echo elgg_echo('entity_browser:options:include_metadata'); ?><br /><br />
		
		<?php echo elgg_view('input/dropdown', array(	'id' => 'entity_browser_options_limit', 
														'options' => array(	'10' => '10', 
																			'25' => '25', 
																			'50' => '50', 
																			'100' => '100'))); ?>
		<?php echo elgg_echo('entity_browser:options:results'); ?>
	</div>
	
	<div id="entity_browser_displayed_sidebar_properties_container">
	
		<select multiple="multiple" id="entity_browser_displayed_properties"></select><br />
		
		<?php echo elgg_view('input/button', array(	'id' => 'entity_browser_show_selected_properties', 
													'value' => elgg_echo('entity_browser:options:show_selected_properties'))); ?>
	</div>
	
	<div id="entity_browser_displayed_sidebar_export">
		<?php echo elgg_view('input/button', array('id' => 'entity_browser_export_current_selection_csv', 'value' => 'export to csv')); ?>
	</div>
	
</div>