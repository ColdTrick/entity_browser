<?php

	function e_b_elgg_echo($key, $pre = '')
	{
		if($key == elgg_echo($key))
		{
			$full_key = $pre . $key;
			$elgg_echo = elgg_echo($full_key);
			
			if($elgg_echo == $full_key)
			{
				return $key;
			}
			else
			{
				return $elgg_echo;
			}
		}
		else
		{
			return elgg_echo($key);
		}
	}
	
	function entity_browser_get_guid_based_fields()
	{
		$entity_browser_settings_guids = elgg_get_plugin_setting('guid_based_tooltip_fields', 'entity_browser');
		
		$entity_browser_settings_guids = explode(', ', $entity_browser_settings_guids);
		
		$standard_fields = array(
			'guid',
			'owner_guid',
			'site_guid',
			'container_guid',
		);
		
		$standard_fields = array_merge($standard_fields, $entity_browser_settings_guids);
		
		return $standard_fields;
	}
	
	function entity_browser_get_time_based_fields()
	{
		$entity_browser_settings_time = elgg_get_plugin_setting('time_based_tooltip_fields', 'entity_browser');
		
		$entity_browser_settings_time = explode(', ', $entity_browser_settings_time);
		
		$standard_fields = array(
			'time_created',
			'time_updated',
			'last_action',
			'icontime',
			'prev_last_action',
			'last_login',
			'prev_last_login',
		);
		
		$standard_fields = array_merge($standard_fields, $entity_browser_settings_time);
		
		return $standard_fields;
	}
	
	function entity_browser_get_entity_property_text($entity, $property, $export = false)
	{
		if($export)
		{
			$property_text = entity_browser_get_friendly_text($entity, $property);
		}
		else
		{
			$property_text = entity_browser_check_for_tooltip($entity, $property);
		}
		
		if(!$property_text)
		{
			$text = $entity->$property;
			
			if(is_array($text))
			{
				$property_text = htmlspecialchars(implode(', ', $text));
			}
			else
			{
				$property_text = htmlspecialchars($text);
			}
			
			if(!$property_text)
			{
				if($export)
				{
					$property_text = '';	
				}
				else
				{
					$property_text = '<span class="empty">[empty value]</span>';
				}
			}
		}
		
		return $property_text;
	}
	
	function entity_browser_get_friendly_text($entity, $property)
	{
		$text = $entity->$property;
		
		$format = elgg_get_plugin_setting('date_time_format', 'entity_browser');
		
		if(!$format)
		{
			$format = 'd-m-Y G:i';
		}
		
		$result = '';
		
		if($text)
		{
			if(in_array($property, entity_browser_get_guid_based_fields()))
			{
				if($property != 'guid')
				{
					$result = entity_browser_get_object_title($entity);
				} 
			}
			elseif(in_array($property, entity_browser_get_time_based_fields()))
			{
				$result = date($format, $text);
			}
			elseif($property == 'subtype')
			{
				$result = $entity->getSubtype();
			}
			elseif($property == 'access_id')
			{
				$result = get_readable_access_level($entity->$property);
			}
		}
		
		return $result;
	}
	
	function entity_browser_check_for_tooltip($entity, $property)
	{
		$text = $entity->$property;
		
		$format = elgg_get_plugin_setting('date_time_format', 'entity_browser');
		
		if(!$format)
		{
			$format = 'd-m-Y G:i';
		}
		
		$result = '';
		
		if($text)
		{
			if(in_array($property, entity_browser_get_guid_based_fields()))
			{
				$result = '<a title="' . elgg_echo('entity_browser:table:loading') . '" class="entity_browser_tooltip_guid" rel="' . $text . '" href="javascript:void(0);">' . $text . '</a>';
			}
			elseif(in_array($property, entity_browser_get_time_based_fields()))
			{
				$result = '<a title="' . date($format, $text) . '" class="entity_browser_tooltip_time" rel="' . $text . '" href="javascript:void(0);">' . $text . '</a>';
			}
			elseif($property == 'subtype')
			{
				$result = '<a title="' . $entity->getSubtype() . '" rel="' . $text . '" href="javascript:void(0);">' . $text . '</a>';
			}
			elseif($property == 'access_id')
			{
				$result = '<a title="' . get_readable_access_level($entity->$property) . '" href="javascript:void(0);">' . $text . '</a>';
			}
			elseif(strlen($text) > 25)
			{
				if(strlen($text) > 50)
				{
					$result = '<a title="' . $text . '" href="javascript:void(0);" class="entity_browser_tooltip_text">' . elgg_get_excerpt($text, 25) . '</a>';
				}
				else
				{
					$result = elgg_get_excerpt($text, 25);
				}
			}
		}
		
		return $result;
	}
	
	function entity_browser_get_object_title($entity)
	{
		$result = '';
		
		switch ($entity->type)
		{
			case 'site':
				$result = $entity->name;
				break;
			case 'object':
				$result = $entity->title;
				break;
			case 'group':
				$result = $entity->name;
				break;
			case 'user':
				$result = $entity->name;
				break;
		}
		
		return $result;
	}

	function entity_browser_get_entity_properties()
	{
		$entity_properties = array(	'guid', 
									'type', 
									'subtype', 
									'owner_guid', 
									'site_guid', 
									'container_guid', 
									'access_id', 
									'time_created', 
									'time_updated', 
									'last_action', 
									'enabled');
		
		return $entity_properties;
	}
	
	function entity_browser_get_core_properties($type = null)
	{
		$core_properties = array(	'entity' 	=> array(),
									'user' 		=> array('name', 	'username', 'password', 'salt', 'email' , 'language', 'code', 'banned', 'admin', 'prev_last_action', 'last_login', 'prev_last_login'),
									'object' 	=> array('title', 	'description'),
									'group' 	=> array('name', 	'description'),
									'site' 		=> array('name', 	'description', 'url')
								);
	
		if(array_key_exists($type, $core_properties))
		{
			return $core_properties[$type];
		}
		else
		{
			return $core_properties;
		}
	}
	
	function entity_browser_db_tables()
	{
		global $CONFIG;
		
		$db_tables = array(
			'user' 		=> $CONFIG->dbprefix . 'users_entity', 
			'object' 	=> $CONFIG->dbprefix . 'objects_entity', 
			'group' 	=> $CONFIG->dbprefix . 'groups_entity',
			'site' 		=> $CONFIG->dbprefix . 'sites_entity'
		);
		
		return $db_tables;
	}
	
	function entity_browser_db_tables_alias()
	{
		$db_tables_alias = array(
			'user' => 'u', 
			'object' => 'o', 
			'group' => 'g',
			'site' => 's'
		);
		
		return $db_tables_alias;
	}
	
	function entity_browser_get_displayed_properties($entities, $options = array())
	{
		$default_options = array(	'displayed_properties' => array(), 
									'type' => 'object', 
									'show_metadata' => false);
		
		$options = array_merge($default_options, $options);
		
		if(is_array($entities) && sizeof($entities) > 0)
		{
			if($options['show_metadata'])
			{
				$meta_names = array();
				foreach ($entities as $entity)
				{					
					$meta = elgg_get_metadata(array('guid' => $entity->getGUID(), 'limit' => false));
					if(is_array($meta) && !empty($meta))
					{
						foreach($meta as $m)
						{
							if (!in_array($m->name, $meta_names))
							{
								$meta_names[] = $m->name;
							}
						}
					}
				}
			}
			
			$displayed_properties = $options['displayed_properties'];
			
			if(!$displayed_properties)
			{
				$core_properties = entity_browser_get_core_properties($options['type']);
				
				$displayed_properties = array_merge_recursive(entity_browser_get_entity_properties(), $core_properties);
				
				if($options['show_metadata'])
				{
					$displayed_properties = array_merge_recursive($displayed_properties, $meta_names);
				}
			}
		}
		
		return $displayed_properties;
	}
	
	function entity_browser_search_entities($options = array())
	{
 		global $CONFIG;
 		
 		$default_options = array(
 			'filters' => array(),
 			'type' => 'entity',
 			'subtype' => ELGG_ENTITIES_ANY_VALUE,
 			'sort' => 'time_created',
 			'direction' => 'desc',
 			'offset' => 0,
 			'limit' => 10
 		);
 		
 		$options = array_merge($default_options, $options);
 		
		access_show_hidden_entities(true);
	
		$entity_properties 	= entity_browser_get_entity_properties();
		$core_properties 	= entity_browser_get_core_properties();
		$db_tables 			= entity_browser_db_tables();
		$db_tables_alias 	= entity_browser_db_tables_alias();
	
		$current_type 		= $options['type'];
		
		$wheres 					= array();
		$metadata_name_value_pairs 	= array();
		$extra_tables 				= array();
		
		foreach ($options['filters'] as $key => $value) 
		{
			$keyparts = explode(':', $key);
			
			if (in_array($keyparts[1], $entity_properties))
			{
				$wheres[] = 'e.' . $keyparts[1] . ' LIKE "%' . $value . '%"';
			}
			elseif (in_array($keyparts[1], $core_properties[$options['type']]))
			{
				$extra_tables[] = $options['type'];
				$wheres[] = $db_tables_alias[$options['type']] . '.' . $keyparts[1] . ' LIKE "%' . $value . '%"';
			}
			else
			{
				$metadata_name_value_pairs[] = array('name' => $keyparts[1], 'operand' => 'LIKE', 'value' => '%' . $value . '%');
			}
		}
		
		$entity_options = array(
			'offset' 	=> $options['offset'],
			'limit' 	=> $options['limit'],
			'full_view' => false,
		);
		
		if (!empty($extra_tables))
		{
			$entity_options['joins'] = array();
			
			foreach ($extra_tables as $table)
			{
				$entity_options['joins'][] = "JOIN {$db_tables[$table]} {$db_tables_alias[$table]} ON ({$db_tables_alias[$table]}.guid = e.guid)";
			}
		}
		
		if ($options['type'] != 'entity') 
		{
			$entity_options['type'] = $options['type'];
		}
		if ($options['subtype'])
		{
			$entity_options['subtype'] = $options['subtype'];
		}
		
		if ($options['type'] == 'site')
		{
			$entity_options['site_guids'] = ELGG_ENTITIES_ANY_VALUE;
		}
		
		if (!empty($wheres))
		{
			$entity_options['wheres'] = $wheres;
		}
		
		$__get_entities_function = 'elgg_get_entities';
		if (in_array($options['sort'], $entity_properties))
		{
			$entity_options['order_by'] = $options['sort'] . ' ' . $options['direction'];
		}
		elseif (in_array($options['sort'], $core_properties[$options['type']]))
		{
			$entity_options['joins'][] = "JOIN {$db_tables[$options['type']]} {$db_tables_alias[$options['type']]} ON ({$db_tables_alias[$options['type']]}.guid = e.guid)";
			$entity_options['order_by'] = $db_tables_alias[$options['type']] . '.' . $options['sort'] . ' ' . $options['direction'];
		}
		else
		{
			$__get_entities_function = 'elgg_get_entities_from_metadata';
			$entity_options['order_by_metadata'] = array('name' => $options['sort'], 'direction' => strtoupper($options['direction']), 'as' => 'text');
		}
		
		if (!empty($metadata_name_value_pairs))
		{
			$__get_entities_function = 'elgg_get_entities_from_metadata';
			$entity_options['metadata_name_value_pairs'] = $metadata_name_value_pairs;
		}
		
		if (!empty($options['joins']))
		{
			$entity_options['joins'] = array_unique($options['joins']);
		}
		
		$count = $__get_entities_function(array_merge(array('count' => TRUE), $entity_options));
		$entities = $__get_entities_function($entity_options);
		
		access_show_hidden_entities(false);
		
		return array(	'count' => $count,
						'entities' => $entities
		);
	}