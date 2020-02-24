<?php
	include_once './views/layouts/header.php';
?>

		<div class="col-12 col-md-9">
			<div class="card border-info">
			  <div class="card-header text-center">
				Thông tin cuộc thi
			  </div>	
			  <div class="card-body">
				<h5 class="card-title text-center"><?=@$contest['name']?></h5>
				<p class="card-text text-primary">Tác giả : <?=@$contest['nameAuthor']?></p>
				<p class="card-text">Thời gian bắt đầu : <?=@$contest['startTime']?></p>
				<p class="card-text">Thời gian làm bài : <?=@$contest['duringTime']?> phút</p>
				<p class="card-text">Mô tả cuộc thi : <?=@$contest['mota']?></p>
				
			  </div>
			  <div class="card-footer text-center">
			  <?php if(!isset($_SESSION['user'])) echo 'Bạn cần đăng nhập để tham gia';
					else echo '<p id="timer" class="card-text"></p>';
					?>
			  </div>
			</div>
		<br>
		</div>
<?php

	include_once './views/layouts/footer.php';
?>


<script>
// Set the date we're counting down to

var countDownDate = new Date("<?=$contest['startTime']?>").getTime();
var x = setInterval(function() {

  var now = new Date().getTime();
  var distance = countDownDate - now;

  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  document.getElementById("timer").innerHTML = (days > 0) ? (days + " ngày ") : "" + hours + " giờ "
  + minutes + " phút " + seconds + " giây ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("timer").innerHTML = '<a href="index.php?controller=contest&action=play&id='+<?=@$contest['id']?>+'" class="btn btn-primary">Bắt đầu làm bài</a>';
  }
}, 1000);
</script>