<?php

if($headers = $vars['headers'])
{
	foreach ($headers as $property) 
	{
		$filter_value = get_input('filter:' . $property, '');
		?>
		<td><input class="entity_browser_filter" type="text" name="filter:<?php echo $property; ?>" value="<?php echo $filter_value; ?>"></input></td>
		<?php
	}
}