<?php 

if(($entities = $vars['entities']) && ($headers = $vars['headers']))
{
	foreach($entities as $entity):?>
		<tr>
			<?php 
			foreach($headers as $property)
			{
				?><td><?php
				
				echo entity_browser_get_entity_property_text($entity, $property);
								
				?></td><?php 
			} ?>
		</tr>
	<?php endforeach; 
}?>

<script type="text/javascript">

$(function()
{
	$('table#entity_browser_list_entities td a').tooltip({
		onBeforeShow: function()
		{
			tip = this.getTip();
			link = this.getTrigger();
			link_class = link.attr('class');
			
			if(link_class == 'entity_browser_tooltip_guid')
			{
				id = link.attr('rel');
	
				elgg.action("admin/entities/gettip",
				{
					data: {guid: id},
			        success: function(response) 
			        {
						$(tip).html(response.content);
			        }
			    });
			}
			else if(link_class == 'entity_browser_tooltip_text')
			{
				tip.css({height: '300px', overflow: 'auto'});
			}
		},
		predelay: 500,
		position: 'center right',
		offset: [8, 1]
	}).dynamic({ bottom: { direction: 'down', bounce: true } });
});

</script>