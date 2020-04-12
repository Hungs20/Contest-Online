<?php
	require_once './views/layouts/header.php';
	?>

	<div class="col-12 col-md-9 ">
	<h5>Tạo lớp học mới</h5>
	
	<form>
	  <div class="form-group">
		<label><font color="red">*</font> Tên lớp học</label>
		<input type="text" class="form-control" name = "className">
	  </div>
	  <div class="form-group">
		<label>Mật khẩu lớp</label>
		<input type="text" class="form-control" name="password">
	  </div>
	</form>
	
	</div>

<?php	
	require_once './views/layouts/footer.php';
?>