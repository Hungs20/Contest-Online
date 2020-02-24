<?php
	include_once './views/layouts/header.php';
?>

		<div class="col-12 col-md-9 ">
		
		<a href = "index.php?controller=contest&action=create" class = "btn btn-primary">Tạo cuộc thi</a><br><br>
		<!-- New Contest-->
		<?php if(@$newContest){ ?>
		 <li class="list-group-item list-group-item-primary text-center"><h5>Cuộc thi mới</h5></li>
		 <div class="table-responsive">
		<table class="table table-bordered table-hover text-center">
				<thead class="thead-light">
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
								if($secondsLeft <= 0) echo '<a href="/index.php?controller=contest&action=rank&id='.$i['id'].'">Bảng xếp hạng</a><br><small>Đang diễn ra</small>';
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
							<?=@$i['thamgia']?>
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
		<li class="list-group-item list-group-item-primary text-center"><h5>Cuộc thi đã kết thúc</h5></li>
		<div class="table-responsive">
			<table class="table table-bordered table-hover text-center">
				<thead class="thead-light">
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
								echo '<a href="/index.php?controller=contest&action=rank&id='.$i['id'].'">Bảng xếp hạng</a>';
								
							?>
							</p>
						</td>
						<td>
							<?=@$i['thamgia']?>
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