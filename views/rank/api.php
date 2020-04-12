<div class="card text-white bg-primary mb-3 ">
	<div class="card-header text-center">
		Bảng xếp hạng
	</div>
	<ul class="list-group list-group-flush text-center">
<?php
	if($list)
	{
		foreach($list as $item)
		{
			echo '<li class="list-group-item list-group-item-info list-group-item-action d-flex justify-content-between align-items-center">'.xss_clean($item['user']);
			echo '<span class="badge badge-success badge-pill">'.sprintf ("%.2f", $item['max_score']).'</span></li>';
		}
	}
	else echo '<li class="list-group-item list-group-item-warning">Không có xếp hạng</li>';
	
?>
</ul>
</div>