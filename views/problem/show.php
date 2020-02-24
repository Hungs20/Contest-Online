<?php
	include_once './views/layouts/header.php';
?>
		
		
		
		<div class="col-12 col-md-9 ">
			<!-- DE BAI-->
			<div class="card border-info sticky-top">
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
		<div class="col-12 col-md-3">
			<!-- TRA LOI-->
			<div class="card border-info">
				  <div class="card-header text-center">
					<?php if(isset($_POST['submit'])) echo 'Kết quả'; else echo 'Trả lời'; ?>
				  </div>	
				  <div class="card-body text-center">
				  <?php if(!isset($_SESSION['user'])) echo 'Bạn cần đăng nhập để làm bài';
					else {
						?>
				  <?php
					if(isset($_POST['submit'])) echo "Đúng : <b><font color='blue'>".$score."/".$problem['numQuess']."</font></b> câu<br>Điểm : <b><font color='red'>".$score*10/$problem['numQuess']."</font></b>";
				  ?>
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
							if(isset($_POST['submit'])){
								if(isset($_POST["$i"]) && $_POST["$i"] == 'A') echo 'checked';  
								else echo 'disabled';
							}
							  ?>>
						</div></td>
							  <td><div class="form-check">
						  <input class="form-check-input position-static" type="radio" name="<?=$i?>" value="B" aria-label="B" <?php 
							if(isset($_POST['submit'])){
								if(isset($_POST["$i"]) && $_POST["$i"] == 'B') echo 'checked';  
								else echo 'disabled';
							}
							  ?>>
						</div></td>
							  <td><div class="form-check">
						  <input class="form-check-input position-static" type="radio" name="<?=$i?>" value="C" aria-label="C" <?php 
							if(isset($_POST['submit'])){
								if(isset($_POST["$i"]) && $_POST["$i"] == 'C') echo 'checked';  
								else echo 'disabled';
							}
							  ?>>
						</div></td>
						<td><div class="form-check">
						  <input class="form-check-input position-static" type="radio" name="<?=$i?>" value="D" aria-label="D" <?php 
							if(isset($_POST['submit'])){
								if(isset($_POST["$i"]) && $_POST["$i"] == 'D') echo 'checked';  
								else echo 'disabled';
							}
							  ?>>
						</div></td>
							</tr>
							<?php
								}
							?>
						  </tbody>
						</table>
						<p class="text-center">
							<?php 
							if(isset($_POST['submit'])) echo '<a href = "" class="btn btn-success">Làm lại</a>';
							else echo '<button type="submit" class="btn btn-success" name="submit">Nộp bài</button>';
							?>
						</p>
					</form>
					<?php 
					}
					?>
				  </div>
				  
				</div>
			<br>
			</div>
		
	</div>
</div>
<!-- Jquery JS-->

    <script src="../../public/js/jquery-3.4.1.slim.min.js"></script>
	<script src="../../public/js/bootstrap.min.js"></script>
