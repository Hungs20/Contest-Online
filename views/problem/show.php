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
// when the DOM is ready
$(document).ready(function() {

	var idPb = <?=@$problem['id']?>;
		$('.form-check-input').click(function(e) {
			$.post('index.php?controller=dohistory&action=index',{idCt : 0, idPb : idPb, num : $(this).attr('name')-1, val : $(this).val() }, function(data) {
			});
		});
});
</script>
