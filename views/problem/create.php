
	<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title><?= $title ?></title>

   <!-- Icons font CSS-->
     <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

   
    <!-- Icons font CSS-->
    <link href="../../public/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../../public/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">

     <!-- Vendor CSS-->
    <link href="../../public/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../../public/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
	<style>
	.input-file-container {
  position: relative;
  width: 225px;
} 
.js .input-file-trigger {
  display: block;
  padding: 14px 45px;
  background: #39D2B4;
  color: #fff;
  font-size: 1em;
  transition: all .4s;
  cursor: pointer;
}
.js .input-file {
  position: absolute;
  top: 0; left: 0;
  width: 225px;
  opacity: 0;
  padding: 14px 0;
  cursor: pointer;
}
.js .input-file:hover + .input-file-trigger,
.js .input-file:focus + .input-file-trigger,
.js .input-file-trigger:hover,
.js .input-file-trigger:focus {
  background: #34495E;
  color: #39D2B4;
}

.file-return {
  margin: 0;
}
.file-return:not(:empty) {
  margin: 1em 0;
}
.js .file-return {
  font-style: italic;
  font-size: .9em;
  font-weight: bold;
}
.js .file-return:not(:empty):before {
  content: "Selected file: ";
  font-style: normal;
  font-weight: normal;
}





</style>
    <link href="../../public/css/main.css" rel="stylesheet" media="all">
	
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Tạo bài thi</h2>
                    <form method="POST" enctype="multipart/form-data">
					
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label"><font color = "red">*</font> Tên bài</label>
                                    <input class="input--style-4" type="text" name="name">
                                </div>
                            </div>
							
                            <div class="col-3">
                                <div class="input-group">
                                    <label class="label"><font color = "red">*</font> Số câu hỏi</label>
                                    <input class="input--style-4" type="number" name="numQuess" value = "50">
                                </div>
                            </div>
                        </div>
						<div class="input-group">
                                    <label class="label"><font color = "red">*</font> Link đề</label>
                                    <input class="input--style-4" type="text" name="link">
                                </div>
								
							
						<div class="input-group">
                                    <label class="label"><font color = "red">*</font>Hoặc</label>
                                    <input class="input-file" id="my-file" type="file" name="problem">
									<label tabindex="0" for="my-file" class="input-file-trigger">Select a file...</label>
								  <p class="file-return"></p>
                                </div>
                                <div class="input-group">
                                    <label class="label"><font color = "red">*</font> Đáp án (VD: ADCBA...)</label>
                                    <textarea class="input--style-4" type="text" name="answer"></textarea>
                                </div>
                                <div class="input-group">
                                    <label class="label">Mô tả</label>
                                    <textarea  class="input--style-4" type="text" name="mota"></textarea>
                                </div>
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit" name = "create">Tạo</button>
							<?php echo '<font color = "red"> '.@$err.'</font>'; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
	<!-- Jquery JS-->
    <script src="../../public/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="../../public/vendor/select2/select2.min.js"></script>
    <script src="../../public/vendor/datepicker/moment.min.js"></script>
    <script src="../../public/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="../../public/js/global.js"></script>
	<script>
	document.querySelector("html").classList.add('js');

var fileInput  = document.querySelector( ".input-file" ),  
    button     = document.querySelector( ".input-file-trigger" ),
    the_return = document.querySelector(".file-return");
      
button.addEventListener( "keydown", function( event ) {  
    if ( event.keyCode == 13 || event.keyCode == 32 ) {  
        fileInput.focus();  
    }  
});
button.addEventListener( "click", function( event ) {
   fileInput.focus();
   return false;
});  
fileInput.addEventListener( "change", function( event ) {  
    the_return.innerHTML = this.value;  
});  
</script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
	