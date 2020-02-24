<!--Navbar -->
<link href="https://fonts.googleapis.com/css?family=Merienda+One" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="../../public/css/bootstrap.min.css" rel="stylesheet" media="all">
</head> 
<body>
<div class="container-fluid">
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
	<a class="navbar-brand" href="#">CHLContest</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
	</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			  <li class="nav-item active">
				<a class="nav-link" href=".">Trang chủ <span class="sr-only">(current)</span></a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="index.php?controller=contest">Kiểm tra</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="index.php?controller=problem">Luyện tập</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="index.php?controller=history">Nhật kí</a>
			  </li>
			  <?php if(!isset($_SESSION['user'])) {
				  ?>
				<li class="nav-item">
				<a class="nav-link" href="index.php?controller=pages&action=login">Đăng nhập</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="index.php?controller=pages&action=signup">Đăng kí</a>
			  </li>
			  <?php }
				else {
					?>
			  <li class="nav-item dropdown form-inline">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  <?=$_SESSION['user']?>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				  <a class="dropdown-item" href="index.php?controller=user&action=index">Trang cá nhân</a>
				  <div class="dropdown-divider"></div>
				  <a class="dropdown-item" href="index.php?controller=pages&action=logout">Đăng xuất</a>
				</div>
			  </li>
			  <?php
				}
				?>
			  
			</ul>
		
		</div>
	</nav>
	<br>
	<br><br>
	<div class="row">
	