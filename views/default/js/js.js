$(function() 
{	
	$('.entity_browser_guidbased_tooltip').live('click', function()
	{
		console.log($(this));
	});
	
	var $container = $('div#entity_browser_list_entities_container');
	var $form = $('#entity_browser_entity_search_form');
	
	elgg.action("admin/entities/gettypes",
	{
		data: {operation: 'get_children'},
        success: function(response) 
        {
    		$("#entity_browser_sidebar_objects_tree").jstree({ 
    			"json_data" : {
    				"data" : response
    			},
    			"ui" :	{ 	
    				"initially_select" : [ "entity" ],
    				"select_limit" : 1
    			},
    			"plugins" : [ "themes", "json_data", "ui" ]
    		})
    		.bind("select_node.jstree", function (event, data) 
    		{
    			$('input:hidden#type').val(data.rslt.obj.attr("id"));
    			
    			entity_browser_clear_filters();
    			
    			entity_browser_post_form($form.serialize(), true, true);
			});
        }
    });

	$('table#entity_browser_list_entities th a.sort').live('click', function() 
	{
		var target = $(this).attr('id');
		var target_parts = target.split(':');
			
		$('input:hidden#sort').val(target_parts[1]);
		$('input:hidden#direction').val(target_parts[2]);
		
		if(target_parts[2] == 'desc'){
			dir = 'asc';
		} else {
			dir = 'desc';
		}
		
		$(this).attr('id', target_parts[0] + ':' + target_parts[1] + ':' + dir);

		entity_browser_post_form($form.serialize(), false, false);		
	});

	$('input.entity_browser_filter').live('keypress', function(e)
	{
		if((e.keyCode || e.which) == 13)
		{
			entity_browser_post_form($form.serialize(), true, false);		

			e.preventDefault();
		}
	});
	
	$('#entity_browser_options_show_metadata').change(function()
	{
		if($(this).is(':checked'))
		{
			$('input:hidden#show_metadata').val(1);
		}
		else
		{
			$('input:hidden#show_metadata').val(0);
		}
		
		entity_browser_post_form($form.serialize(), true, true);		
	});
	
	$('#entity_browser_options_limit').change(function()
	{
		limit = $(this).val();
		$('input:hidden#limit').val(limit);

		entity_browser_post_form($form.serialize(), true, false);		
	});
	
	$('#entity_browser_show_selected_properties').click(function()
	{
		entity_browser_post_form($form.serialize(), true);	
	});
	
	$('#entity_browser_export_current_selection_csv').click(function()
	{
		var properties = $('#entity_browser_displayed_properties').val() || [];
		
		$form.attr('target', 'entity_browser_export_csv_frame');
		$form.attr('action', '/action/admin/entities/export?type=csv&displayed_properties='+properties);
		$form.submit();
		
		$form.attr('action', '');
	});

	/*$('a.entity_browser_guidbased_tooltip').live('mouseenter', function(e)
	{
		element = $(this);
		//tooltip_timeout = setTimeout("entity_browser_show_tooltip(element)", 500);
		entity_browser_show_tooltip(element, false, e);
	});
	
	$('a.entity_browser_guidbased_tooltip').live('mouseleave', function()
	{
		//var t = setTimeout("entity_browser_show_tooltip($(this))", 1000);
		entity_browser_show_tooltip($(this), true);
	});*/
});

/*function entity_browser_show_tooltip(element, hide, event)
{
	console.log(element);
	if(hide == true)
	{
		//$('#entity_browser_tooltip').hide();
		clearTimeout(tooltip_timeout);
	}
	else
	{
		console.log(element.parent());
		
		
		if($('#entity_browser_tooltip').length == 0)
		{
			element.parent().append('<div id="entity_browser_tooltip">jahe</div>');
			console.log('append');
		}
		
		yOffset = -30;
		xOffset = element.height() +10;
		
		guid = element.attr('rel');
		topPx = (element.parent().position().top) + 'px';
		leftPx = (element.parent().position().left + element.parent().width()) + 'px';
		
		$('#entity_browser_tooltip').css({top: topPx, left: leftPx}).show();
		
		console.log('guid: ' + guid);
		console.log('top: ' + topPx);
		console.log('left: ' + leftPx);
	}
}*/

function entity_browser_post_form(form_data, headfoot, refresh_properties, action)
{
	if(action == undefined)
	{
		action = 'admin/entities/search';
	}
	
	if(action = 'admin/entities/search')
	{
		$('#entity_browser_body').html('');
		$('#entity_browser_load_mask').mask(elgg.echo('entity_browser:table:loading'));
	}
	
	var properties = $('#entity_browser_displayed_properties').val() || [];
	data = form_data.concat('&displayed_properties='+properties);
	
	
	elgg.action(action, 
	{
		data: data,
		success: function(response)
		{
			if(action == 'admin/entities/search')
			{
				entity_browser_display_result(response, headfoot);
			}
		}
	});
	
	if(refresh_properties == true)
	{
		entity_browser_get_properties();
	}
}

function entity_browser_display_result(response, headfoot)
{	
	if(headfoot == true && response.content.length > 0)
	{
		$('#entity_browser_head').html(response.headers);
		$('#entity_browser_foot').html(response.footer);
	}
	$('#entity_browser_body').html(response.content);
	$('#entity_browser_load_mask').unmask();
}

function entity_browser_get_properties()
{
	elgg.action("admin/entities/getproperties",
	{
		data: {	type: 			$('input:hidden#type').val(),
				show_metadata: 	$('input:hidden#show_metadata').val()},
		success: function(response)
		{
			$('#entity_browser_displayed_properties').html('');
			$('#entity_browser_displayed_properties').append(response.content);
		}
	});
}

function entity_browser_show_properties()
{
	var properties = $('#entity_browser_displayed_properties').val() || [];
	
	console.log(properties);

	elgg.action("admin/entities/displayedproperties",
	{
		data: {	type: 					$('input:hidden#type').val(),
				show_metadata: 			$('input:hidden#show_metadata').val(),
				displayed_properties: 	properties},
		success: function(response)
		{
			$('#entity_browser_head').html(response.headers);
			$('#entity_browser_foot').html(response.footer);
		}
	});
}

function entity_browser_clear_filters()
{
	$('#entity_browser_displayed_properties option:selected').removeAttr("selected");
	
	$('.entity_browser_filter').val('');
}