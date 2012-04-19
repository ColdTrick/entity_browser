<?php

	if($headers = $vars['headers'])
	{
		foreach($headers as $head)
		{
			$dir 	= 'desc';
			$class 	= '';
			if ($sort == $property) 
			{
				$class = 'active';
				if ($direction == 'desc') 
				{
					$dir = 'asc';
				}
			}
			?>
			<th>
				<a href="javascript:void(0);" id="sort:<?php echo $head;?>:<?php echo $dir; ?>" class="sort <?php echo $class; ?> <?php echo $direction; ?>"><?php echo e_b_elgg_echo($head, 'entity_browser:table:header:');?></a>
			</th>
		<?php
		}
	}