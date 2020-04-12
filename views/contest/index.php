<?php
	include_once './views/layouts/header.php';
?>
		<link href="../../public/css/dataTables.bootstrap4.min.css" rel="stylesheet" media="all">
		<div class="col-12 col-md-9 ">
		
		<a href = "index.php?controller=contest&action=create" class = "btn btn-primary">Tạo cuộc thi</a><br><br>
		<!-- New Contest-->
		<?php if(@$newContest){ ?>
		 <div class="table-responsive">
			<table class="table table-striped table-bordered table-hover text-center">
				<caption style="caption-side: top;">Cuộc thi mới</caption>
				<thead class="thead-dark">
					<tr>
						<th scope="col">Cuộc thi</th>
						<th scope="col">Tác giả</th>
						<th scope="col">Bắt đầu</th>
						<th scope="col">Thời gian</th>
						<th scope="col"></th>
						<th scope="col">Tham gia</th>
					</tr>
				</thead>
				<tbody>
					<?php
	foreach($newContest as $i)
	{
		
		?>
					<tr>
						<td>
							<a href = "index.php?controller=contest&action=show&id=<?=@$i['id']?>"><?=@$i['name']?></a>
						</td>
						<td>
							<?=@$i['nameAuthor']?>
						</td>
						<td>
							<?=@$i['startTime']?>
						</td>
						<td>
							<?=@$i['duringTime']?> phút
						</td>
						<td>
							<p class="text-secondary">
							<?php
								$secondsLeft  = strtotime($i['startTime']) - time();
								if($secondsLeft <= 0) echo '<a href="/index.php?controller=rank&action=index&idCt='.$i['id'].'">Bảng xếp hạng</a><br><small>Đang diễn ra</small>';
								else 
								{
									$days = floor($secondsLeft / (60*60*24));
									$hours = floor(($secondsLeft - ($days*60*60*24)) / (60*60));
									$minutes = floor(($secondsLeft - ($days * 60 * 60 * 24) - ($hours * 60 * 60)) / 60);
									$second = floor($secondsLeft - ($days * 60 * 60 * 24) - ($hours * 60 * 60) - ($minutes * 60));
									echo "Bắt đầu sau ".(($days> 0) ? ($days." ngày ") : "" )."$hours giờ $minutes phút $second giây";
								}
							?>
							</p>
						</td>
						<td>
							<a href = "index.php?controller=history&idCt=<?=@$i['id']?>"><?=@$i['thamgia']?></a>
						</td>
					</tr>
					<?php
	}
	?>
				</tbody>
			</table>
			</div>
		<?php } ?>
			<!--END New Contest-->
		
		
		<!-- All Contest-->
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover text-center" id = "contest">
				<caption style="caption-side: top;">Cuộc thi đã kết thúc</caption>
				<thead class="thead-dark">
					<tr>
						<th scope="col">Cuộc thi</th>
						<th scope="col">Tác giả</th>
						<th scope="col">Bắt đầu</th>
						<th scope="col">Thời gian</th>
						<th scope="col"></th>
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
							<a href = "index.php?controller=contest&action=show&id=<?=@$i['id']?>"><?=@$i['name']?></a>
						</td>
						<td>
							<?=@$i['nameAuthor']?>
						</td>
						<td>
							<?=@$i['startTime']?>
						</td>
						<td>
							<?=@$i['duringTime']?> phút
						</td>
						<td>
							<p class="text-secondary">
							<?php
								echo '<a href="/index.php?controller=rank&idCt='.$i['id'].'">Bảng xếp hạng</a>';
								
							?>
							</p>
						</td>
						<td>
							<a href = "index.php?controller=history&idCt=<?=@$i['id']?>"><?=@$i['thamgia']?></a>
						</td>
					</tr>
					<?php
	}
	?>
				</tbody>
			</table>
			</div>
			<!--END All Contest-->
		</div>
<?php

	include_once './views/layouts/footer.php';
?>
<script src="../../public/js/jquery.dataTables.min.js"></script>
	<script src="../../public/js/dataTables.bootstrap4.min.js"></script>
	<script>
	$(document).ready(function() {
    $('#contest').DataTable( {
        "language": {
            "url": "../../public/Vietnamese.json"
        },
		"order": [[ 0, "desc" ]]
    } );
} );
</script>