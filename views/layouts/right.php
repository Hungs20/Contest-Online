

			<!-- THONG BAO -->
			<?php if(@$newContest['name']){
				?>
			<div class="card border-info text-center">
				<div class="card-header">
					<h6>Chú ý</h6>
				</div>
				<div class="card-body text-info">
					<h5 class="card-title"><?=@$newContest['name']?></h5>
					<p class="text-secondary">
							<?php
								$secondsLeft  = strtotime($newContest['startTime']) - time();
								if($secondsLeft <= 0) echo 'Đang diễn ra';
								else 
								{
									$days = floor($secondsLeft / (60*60*24));
									$hours = floor(($secondsLeft - ($days*60*60*24)) / (60*60));
									$minutes = floor(($secondsLeft - ($days * 60 * 60 * 24) - ($hours * 60 * 60)) / 60);
									$second = floor($secondsLeft - ($days * 60 * 60 * 24) - ($hours * 60 * 60) - ($minutes * 60));
									echo (($days> 0) ? ($days." ngày ") : "" )."$hours giờ $minutes phút";
								}
							?>
							</p>
					<a href="/index.php?controller=contest&action=show&id=<?=$newContest['id']?>" class="text-primary">Tham gia ngay »</a>
				</div>
			</div>
			<br>
			<?php } ?>
			<!--END THONG BAO-->
				<!-- RANK -->
				<div class="card  border-info">
					<div class="card-header text-center">
						Bảng xếp hạng
					</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item">Hung</li>
						<li class="list-group-item">Admin</li>
						<li class="list-group-item">Bot</li>
					</ul>
				</div>
				<!--END RANK-->
