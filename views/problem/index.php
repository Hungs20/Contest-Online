<?php
	include_once './views/layouts/header.php';
	
?>
		<link href="../../public/css/dataTables.bootstrap4.min.css" rel="stylesheet" media="all">
		
		<div class="col-12 col-md-9">
		<a href = "index.php?controller=problem&action=create" class = "btn btn-primary">Thêm bài tập</a><br><br>
		<!-- All Problem-->
		 <div class="table-responsive">
			<table class="table table-striped table-bordered table-hover text-center" id = "problem">
			<caption style="caption-side: top;">Danh sách luyện tập</caption>
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Tên bài</th>
						<th scope="col">Tác giả</th>
						<th scope="col">Điểm cao</th>
						<th scope="col">Tham gia</th>
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
							<a href = "index.php?controller=problem&action=show&id=<?=@$i['id']?>"><?=@$i['name']?></a>
						</td>
						<td>
							<?=@$i['nameAuthor']?>
						</td>
						<td>
							<a href = "index.php?controller=rank&idCt=0&idPb=<?=@$i['id']?>"><?=@$i['maxScore']?></a>
						</td>
						<td>
							<a href = "index.php?controller=history&idPb=<?=@$i['id']?>"><?=@$i['thamgia']?></a>
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
    $('#problem').DataTable( {
        "language": {
            "url": "../../public/Vietnamese.json"
        },
		"order": [[ 0, "desc" ]]
    } );
} );
</script>