<?php 

	$id 					= $vars['id'];
	$table_class 			= $vars['class'];
	$headers 				= $vars['displayed_properties'];
	$entities 				= $vars['entities'];
	
	$count 					= ($vars['count'])?$vars['count']:0;
	$offset 				= ($vars['offset'])?$vars['offset']:0;
	$limit 					= ($vars['limit'])?$vars['limit']:10;
	$sort 					= ($vars['sort'])?$vars['sort']:'time_created'; 
	$direction 				= ($vars['direction'])?$vars['direction']:'desc'; 
	$type 					= ($vars['type'])?$vars['type']:'object';
	$current_type 			= ($vars['current_type'])?$vars['current_type']:'';
	
	if(isset($class))
	{
		$table_class = "elgg-table {$class}";
	}
	else
	{
		$table_class = "elgg-table ";
	}
	
	if(isset($id))
	{
		$id = 'entity_browser_' . $id;
	}

	?>
	<div id="entity_browser_load_mask">
	<div id="<?php echo $id;?>_container" class="entity_browser_container">
	<form method="post" id="entity_browser_entity_search_form">
		<table id="<?php echo $id; ?>"  class="<?php echo $table_class; ?>">		
		
			<thead id="entity_browser_head">
				<tr>
				<?php echo elgg_view('misc/thead', array('headers' => $headers)); ?>
				</tr>
			</thead>
			
			
			<tbody id="entity_browser_body">
				<?php echo elgg_view('misc/body', array('entities' => $entities, 'headers' => $headers)); ?>
			</tbody>
			
		
			
			<tfoot id="entity_browser_foot">
				<tr>
					<?php echo elgg_view('misc/tfoot', array('headers' => $headers)); ?>
				</tr>
			</tfoot>
			
		</table>
		
		<?php echo elgg_view('input/securitytoken'); ?>
		
		<input type="hidden" name="type" 			value="<?php echo $current_type; ?>" 	id="type"></input>
		<input type="hidden" name="offset" 			value="<?php echo $offset; ?>" 			id="offset"></input>
		<input type="hidden" name="limit" 			value="<?php echo $limit; ?>"			id="limit"></input>
		<input type="hidden" name="sort" 			value="<?php echo $sort; ?>" 			id="sort"></input>
		<input type="hidden" name="direction" 		value="<?php echo $direction; ?>" 		id="direction"></input>
		<input type="hidden" name="show_metadata" 	value="<?php echo $show_metadata; ?>" 	id="show_metadata"></input>
	</form>
		
	<iframe id="entity_browser_export_csv_frame" name="entity_browser_export_csv_frame" width="0" height="0" scrolling="no" frameborder="0"></iframe>
	</div>
	</div>