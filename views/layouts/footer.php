
		<div class="col-12 col-md-3">
			<span id = "right"></span>
			<!-- RANK -->
			<span id = "ranking"></span>
			<!--END RANK-->
		</div>
	</div>
	
	
</div>
</div>
<div class="container"><div class="row"><div class="col-md-12"><span id = "online"></span></div></div></div>
	<!--Bottom Footer-->
		<div class="bottom section-padding">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<div class="copyright">
							<p>© <span><script type="text/javascript">
  document.write(new Date().getFullYear());
</script></span> <a href="https://facebook.com/hungs20" class="transition"><?=@$config['Author']?></a> Made with <i class="fas fa-heart text-danger"></i></p>
						</div>
					</div>
				</div>
			</div>
		</div>
<!--Bottom Footer-->
<!-- Jquery JS-->

    <script src="../../public/js/jquery-3.4.1.slim.min.js"></script>
  <script src="../../public/js/jquery-3.4.1.js"></script>
	<script src="../../public/js/bootstrap.min.js"></script>
	
	<script>
$( "#right" ).load("/index.php?controller=layouts&action=right");
</script>
<script>
$(document).ready(function online(){ 
		$.ajax({
                url: 'index.php?controller=layouts&action=online',
                type: 'GET',
                dataType: 'html',
                
            }).done(function(ketqua) {
                $('#online').html(ketqua);
				setTimeout(online, 1000);
            });
            }); 
</script>
<script>
$(document).ready(function ranking(){ 
	var url_string = window.location.href;
	var url = new URL(url_string);
	var control = url.searchParams.get("controller");
	var idCt = 0;
	var idPb = 0;
	if(control == 'contest') idCt = url.searchParams.get("id");
	else if(control == 'problem') idPb = url.searchParams.get("id");
    //$("#ranking").load('index.php?controller=rank&action=api&idCt='+idCt+'&idPb='+idPb); 
	$.ajax({
                url: 'index.php?controller=rank&action=api&idCt='+idCt+'&idPb='+idPb,
                type: 'GET',
                dataType: 'html',
                
            }).done(function(ketqua) {
                $('#ranking').html(ketqua);
				setTimeout(ranking, 1000);
            });
}); 
</script>