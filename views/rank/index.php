<?php
	include_once './views/layouts/header.php';
	
?>
		<link href="../../public/css/dataTables.bootstrap4.min.css" rel="stylesheet" media="all">
		
		<div class="col-12 col-md-9">
		<!-- All Problem-->
		 <div class="table-responsive">
			<table class="table table-striped table-bordered table-hover text-center" id = "rank">
			<caption style="caption-side: top;">Bảng xếp hạng</caption>
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Tài khoản</th>
						<th scope="col">Điểm</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 0;
	foreach($list as $item)
	{
		$i++;
		?>
					<tr>
						<td>
							<?=@$i?>
						</td>
						<td>
							<?=@$item['user']?>
						</td>
						<td>
							<?=sprintf ("%.2f", @$item['max_score']);?>
						</td>
						
					</tr>
					<?php
	}
	?>
				</tbody>
			</table>
			<!--END All Problem-->
		</div>
		</div>	
<?php

	include_once './views/layouts/footer.php';
?>
<script src="../../public/js/jquery.dataTables.min.js"></script>
	<script src="../../public/js/dataTables.bootstrap4.min.js"></script>
	<script>
	$(document).ready(function() {
    $('#rank').DataTable( {
        "language": {
            "url": "../../public/Vietnamese.json"
        },
		"order": [[ 2, "desc" ]]
    } );
} );
</script>