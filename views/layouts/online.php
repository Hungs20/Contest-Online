<?php
	echo '<b>Online <font color="red"><big>'.sizeof($list).'</big></font> <i class="fas fa-user text-success"></b></i> : ';
	foreach($list as $item)
	{
		echo $item['username'].' , ';
	}
?>