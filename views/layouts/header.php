<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= @$title ?></title>
<!--Navbar -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<link href="../../public/css/bootstrap.min.css" rel="stylesheet" media="all">
<link href="../../public/css/mystyle.css" rel="stylesheet" media="all">
</head> 
<body class="d-flex flex-column">
<div class="flex-grow-1 flex-shrink-0">
	<nav class="navbar navbar-expand-lg navbar-light fixed-top">
	<a class="navbar-brand" href=".">CHLContest</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
	</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			  <li class="nav-item <?php if(!isset($_GET['controller']) || (isset($_GET['controller']) && $_GET['controller'] == 'pages')) echo 'active'; ?>">
				<a class="nav-link" href=".">Trang chủ</a>
			  </li>
			  <li class="nav-item <?php if(isset($_GET['controller']) && $_GET['controller'] == 'contest') echo 'active'; ?>">
				<a class="nav-link" href="index.php?controller=contest">Kiểm tra</a>
			  </li>
			  <li class="nav-item <?php if(isset($_GET['controller']) && $_GET['controller'] == 'problem') echo 'active'; ?>">
				<a class="nav-link" href="index.php?controller=problem">Luyện tập</a>
			  </li>
			  <li class="nav-item <?php if(isset($_GET['controller']) && $_GET['controller'] == 'history') echo 'active'; ?>">
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
<div class="container-fluid">
	<div class="row">
	