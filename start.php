<?php

	require_once(dirname(__FILE__) . "/lib/functions.php");

	function entity_browser_init()
	{
		//elgg_register_event_handler('upgrade', 'upgrade', 'entity_browser_run_upgrades');
			
		// add to the main css
		elgg_extend_view('css/admin', 'css/css');
		elgg_extend_view('css/admin', 'js/tablesorter/themes/blue/style');
		
		elgg_extend_view('css/admin', 'css/demo_table');
		elgg_extend_view('css/admin', 'css/demo_table_jui');
	
		// register the acties's JavaScript
		$js_root = 'mod/entity_browser/views/default/js/';
		
		elgg_register_js('entity_browser_jstree',	$js_root . 'jstree/jquery.jstree.js');
		elgg_register_js('entity_browser_loadmask',	$js_root . 'loadmask/jquery.loadmask.js');
		elgg_register_js('tooltipshit', 			$js_root . 'jtools/tooltip.js');
		elgg_register_js('entity_browser_js', 		$js_root . 'js.js');
		
		// routing of urls
		elgg_register_page_handler('entity_browser', 'entity_browser_page_handler');

		// register actions
		$action_path = elgg_get_plugins_path() . 'entity_browser/actions/admin';
		
		elgg_register_action('admin/entities/search', 				"$action_path/entities/search.php");
		elgg_register_action('admin/entities/gettypes', 			"$action_path/entities/gettypes.php");
		elgg_register_action('admin/entities/getproperties', 		"$action_path/entities/getproperties.php");
		elgg_register_action('admin/entities/displayedproperties', 	"$action_path/entities/displayedproperties.php");
		elgg_register_action('admin/entities/gettip', 				"$action_path/entities/gettip.php");
		elgg_register_action('admin/entities/export', 				"$action_path/entities/export.php");
		
		
		elgg_register_menu_item('page', array(	'name' 			=> 'entity_browser',
												'text' 			=> elgg_echo('entity_browser:menu:entity_browser'),
												'context' 		=> 'admin',
												'parent_name' 	=> 'utilities',
												'section' 		=> 'administer'
											));
		
		elgg_register_menu_item('page', array(	'name' 			=> 'entity_browser',
												'href' 			=> 'admin/browse/relationship/list',
												'text' 			=> elgg_echo('entity_browser:menu:list_relationships'),
												'context' 		=> 'admin',
												'parent_name' 	=> 'entity_browser',
												'section' 		=> 'administer'
											));
		
		elgg_register_menu_item('page', array(	'name' 			=> 'entity_browser',
												'href' 			=> 'admin/browse/entity/list',
												'text' 			=> elgg_echo('entity_browser:menu:list_entities'),
												'context' 		=> 'admin',
												'parent_name' 	=> 'entity_browser',
												'section' 		=> 'administer'
											));
	}

	elgg_register_event_handler('init', 	'system', 'entity_browser_init');
	elgg_register_event_handler('create', 	'object', 'entity_browser_create_object_handler');