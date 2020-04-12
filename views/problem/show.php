<?php
	include_once './views/layouts/header.php';
?>
		
		
		
		<div class="col-12 col-md-9">
			<!-- DE BAI--
			<div class="card border-info sticky-top sticky-offset">
			  <div class="card-header text-center">-->
				<?=@$headProb?>
			 <!-- </div>	
			  -->
			  <?=@$bodyProb?>
			  <!--<div class="card-footer text-center" >-->
			  <?=@$footProb?>
			  <!--</div>
		</div> -->
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
			<!-- Rank-->
			<span id = "ranking"></span>
			</div>
	</div>
</div>
<!-- Jquery JS-->

    <script src="../../public/js/jquery-3.4.1.js"></script>
	<script src="../../public/js/bootstrap.min.js"></script>
	
<script>
$(document).ready(function(){ 
		var url_string = window.location.href;
var url = new URL(url_string);
var control = url.searchParams.get("controller");
var idCt = 0;
var idPb = 0;
if(control == 'contest') idCt = url.searchParams.get("id");
else if(control == 'problem') idPb = url.searchParams.get("id");
                    $("#ranking").load('index.php?controller=rank&action=api&idCt='+idCt+'&idPb='+idPb); 
            }); 
</script>
