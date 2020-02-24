<?php
	include_once './views/layouts/header.php';
?>

		<div class="col-12 col-md-9">
		
		<!-- All Problem-->
		<a href = "index.php?controller=problem&action=create" class = "btn btn-primary">Thêm bài tập</a><br><br>
		<li class="list-group-item list-group-item-primary text-center"><h5>Danh sách luyện tập</h5></li>
		 <div class="table-responsive">
			<table class="table table-bordered table-hover text-center">
				<thead class="thead-light">
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
							<?=@$i['maxScore']?>
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
			<!--END All Problem-->
		</div>
		</div>
<?php

	include_once './views/layouts/footer.php';
?>