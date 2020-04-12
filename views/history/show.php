<?php
	include_once './views/layouts/header.php';
?>
		
		
		
		<div class="col-12 col-md-9 ">
			<!-- DE BAI-->
			<div class="card border-info  sticky-top sticky-offset">
			  <div class="card-header text-center">
				<?=@$problem['name']?>
			  </div>	
			  <div class="card-body">
			  <div class="embed-responsive embed-responsive-16by9">
				  <iframe class="embed-responsive-item" src="../../public/pdfviewer/web/viewer.html?file=<?=$problem["link"]?>"></iframe>
				</div>
				
			  </div>
			  <div class="card-footer text-center">
			  </div>
			</div>
		<br>
		</div>
		<div class="col-12 col-md-3 sticky-top sticky-offset">
			<!-- TRA LOI-->
			<div class="card border-info">
				  <div class="card-header text-center">
					Bài làm của <b><font color = "orange"><?= @$history['user'] ?></font></b>
				  </div>	
				  <div class="card-body text-center">
					<h3><b><font color="red"><?=$history['score']?></font></b>/<b><font color="blue">10</font></b></h3>
					<form method="POST">
						<table class="table table-sm">
						  <thead>
							<tr>
							  <th scope="col">#</th>
							  <th scope="col">A</th>
							  <th scope="col">B</th>
							  <th scope="col">C</th>
							  <th scope="col">D</th>
							</tr>
						  </thead>
						  <tbody>
							
							<?php
								for($i = 1; $i <= $problem['numQuess']; $i++)
								{
							?>
							<tr>
							  <th scope="row"><?=$i?></th>
							  <td><div class="form-check">
						  <input class="form-check-input position-static" type="radio" name="<?=$i?>" value="A" aria-label="A" 
							<?php 
							
								if($history['answer'][$i-1] == 'A') echo 'checked';  
								else echo 'disabled';
							
							  ?>>
						</div></td>
							  <td><div class="form-check">
						  <input class="form-check-input position-static" type="radio" name="<?=$i?>" value="B" aria-label="B" <?php 
							if($history['answer'][$i-1] == 'B') echo 'checked';  
								else echo 'disabled';
							  ?>>
						</div></td>
							  <td><div class="form-check">
						  <input class="form-check-input position-static" type="radio" name="<?=$i?>" value="C" aria-label="C" <?php 
							if($history['answer'][$i-1] == 'C') echo 'checked';  
								else echo 'disabled';
							
							  ?>>
						</div></td>
						<td><div class="form-check">
						  <input class="form-check-input position-static" type="radio" name="<?=$i?>" value="D" aria-label="D" <?php 
							if($history['answer'][$i-1] == 'D') echo 'checked';  
								else echo 'disabled';
							  ?>>
						</div></td>
							</tr>
							<?php
								}
							?>
						  </tbody>
						</table>
					</form>
					
				  </div>
				  
				</div>
			<br>
			</div>
		
	</div>
</div>
<!-- Jquery JS-->

    <script src="../../public/js/jquery-3.4.1.slim.min.js"></script>
	<script src="../../public/js/bootstrap.min.js"></script>
