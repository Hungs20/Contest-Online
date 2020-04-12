<?php
	require_once './views/layouts/header.php';
	?>
	<style>section{
  display:block;
  height:100px;
}</style>
	<div class="col-12 col-md-9 ">
	<h5>Lớp học của tôi</h5>
	<?php if(isset($_SESSION['user']) && ($user['type'] == $config['ADMIN'] || $user['type'] == $config['TEACHER'])) {
			?>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">Tạo lớp học</button><br>'
		<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tạo lớp học</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form method="POST">
      <div class="modal-body">
        
		  <div class="form-group">
		  <?=@$err?>
			<label><font color="red">*</font> Tên lớp học</label>
			<input type="text" class="form-control" name = "className">
		  </div>
		  <div class="form-group">
			<label>Mật khẩu lớp</label>
			<input type="text" class="form-control" name="password">
		  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="submit" name = "create" class="btn btn-primary">Tạo</button>
      </div>
	  </form>
    </div>
  </div>
</div>
	<?php 
		
	} ?>
	<div class="card-columns">
	<?php foreach($list as $i){ 
		echo '<a href="index.php?controller=class&action=show&id='.$i["id"].'">';
		echo '<div class="card">
			<section><div class="card-body text-center"><p>'.$i["className"].' ( '.$i["teacherName"].' )</p></div></section>
  </div></a>';
	 } ?>
</div>
	
	</div>

<?php	
	require_once './views/layouts/footer.php';
if(isset($err)) {
		?>
		<script type="text/javascript">
    $(document).ready(function(){
        $("#create").modal('show');
    });
</script>
<?php 
	}
?>

<script>
let colors = ["#ffd0d2","#fffdd0","#d0fffd","#d0d2ff"];
    $(".card").children('section').each(function(){   
        let firstGradient = randomNumber(10,90);
        $(this).css(
            "background", "linear-gradient(141deg, "+colors[randomNumber(0,4)]+" "+firstGradient+"%, "+colors[randomNumber(0,4)] + ")"
        );
    });
    function randomNumber(min,max){
        return Math.floor((Math.random() * max) + min);
    }
	</script>