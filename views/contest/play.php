<?php
	include_once './views/layouts/header.php';
?>
		
		<div class="col-12 col-md-9 ">
			<!-- DE BAI-->
			<div class="card border-info sticky-top">
			  <div class="card-header text-center">
				<?=@$headProb?>
			  </div>	
			  <div class="card-body text-center">
			  <?=@$bodyProb?>
			  </div>
			  <div class="card-footer text-center">
			  <?=@$footProb?>
			  </div>
			</div>
		<br>
		</div>
		<div class="col-12 col-md-3">
			<!-- TRA LOI-->
			<div class="card border-info">
				  <div class="card-header text-center">
					<?=@$headSubmit?>
				  </div>	
				  <div class="card-body text-center">
				  <?=@$bodySubmit?>
				  <?=@$formSubmit?>
				  </div>
				  
				<div class="card-footer text-center">
					<?=@$footSubmit?>
			  </div>
				</div>
			<br>
			</div>
		
	</div>
</div>
<!-- Jquery JS-->

    <script src="../../public/js/jquery-3.4.1.js"></script>
	<script src="../../public/js/bootstrap.min.js"></script>
	
	

<script>
//Timer
// Set the date we're counting down to
if(document.getElementById("timer")){
var isSubmit = <?php if(@$isSubmit !== null) echo @$isSubmit['id']; else echo 0;?>;
let timer = <?=@$contest['duringTime']*60?>; //60 * 1000 milisecond
var countDownDate = new Date("<?=$contest['startTime']?>").getTime() + timer*1000;

var x = setInterval(function() {

	var now = new Date().getTime();
	var distance = (countDownDate - now) / 1000;
	//console.log(countDownDate + ' ' + now + ' ' + distance);
	 var m = Math.floor(distance/60);
	 var s = Math.floor(distance%60);
	 if(distance >= timer*2/3) document.getElementById("timer").innerHTML = "<span class='text-success'>" + m + " phút " + s + " giây</span>";
	else if(distance >= timer/3) document.getElementById("timer").innerHTML = "<span class='text-warning'>" + m + " phút " + s + " giây</span>";
	else document.getElementById("timer").innerHTML = "<span class='text-danger'>" + m + " phút " + s + " giây</span>";


  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("timer").innerHTML = 'Hết giờ làm bài';
	if(!isSubmit) document.getElementById('submit').click();
  }
}, 1000);
}
</script>
	<script>
// when the DOM is ready
$(document).ready(function() {

	var idPb = <?=@$problem['id']?>;
	var idCt = <?=@$contest['id']?>;
		$('.form-check-input').click(function(e) {
			$.post('index.php?controller=dohistory&action=index',{idCt : idCt, idPb : idPb, num : $(this).attr('name')-1, val : $(this).val() }, function(data) {
			});
		});
});
</script>