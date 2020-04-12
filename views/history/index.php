<?php
	include_once './views/layouts/header.php';
?>

		<link href="../../public/css/dataTables.bootstrap4.min.css" rel="stylesheet" media="all">
		<div class="col-12 col-md-9">
		
		<!-- History-->
		 <div class="table-responsive">
			<table class="table table-striped table-bordered table-hover text-center" id = "history">
				<caption style="caption-side: top;">Nhật kí làm bài</caption>
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Thời gian</th>
						<th scope="col">Tài khoản</th>
						<th scope="col">Tham gia</th>
						<th scope="col">Điểm</th>
					</tr>
				</thead>
				<tbody>
					<?php
	foreach($list as $i)
	{
		
		?>
					<tr>
						<td>
							<?=@$i['id']?>
						</td>
						
						<td>
							<?php $dt = new DateTime(@$i['time']); echo $dt->format('d-m-Y H:i:s');?>
						</td>
						<td>
							<?=@$i['user']?>
						</td>
						<td>
							<a href = "index.php?controller=history&action=show&id=<?=@$i['id']?>"><?=@$i['name']?></a>
						</td>
						<td>
							<?=@$i['score']?>
						</td>
						
					</tr>
					<?php
	}
	?>
				</tbody>
			</table>
			</div>
			<!--END All Problem-->
		</div>
<?php

	include_once './views/layouts/footer.php';
?>
<script src="../../public/js/jquery.dataTables.min.js"></script>
	<script src="../../public/js/dataTables.bootstrap4.min.js"></script>
	<script>
	$(document).ready(function() {
    $('#history').DataTable( {
        "language": {
            "url": "../../public/Vietnamese.json"
        },
		"order": [[ 0, "desc" ]]
    } );
} );
</script>