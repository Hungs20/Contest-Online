<?php
	include_once './views/layouts/header.php';
?>

			
		<div class="col-12 col-md-9">
		
		<!-- History-->
		<li class="list-group-item list-group-item-primary text-center"><h5>Nhật kí làm bài</h5></li>
		 <div class="table-responsive">
			<table class="table table-bordered table-hover text-center">
				<thead class="thead-light">
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