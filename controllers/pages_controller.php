<?php
require_once('controllers/base_controller.php');
require_once("models/User.php");
class PagesController extends BaseController
{
	
  function __construct()
  {
    $this->folder = 'pages';
  }

  public function home()
  {
	  $isLogin = false;
	  if(isset($_SESSION['user']))
	  {
		  $username = $_SESSION['user'];
		  $user_model = new User();
		  $user = $user_model->getByUsername($username)->fetch();
		  $isLogin = true;
	  }
    $data = array(
      'user' => @$user,
      'isLogin' => $isLogin
    );
    $this->render('home', $data);
  }

  public function error()
  {
    $this->render('error');
  }
  public function signup()
  {	
	$err = "";
	$status = 0;
	if(isset($_POST['signup']))
	{
		if($_POST['username'] != '' && $_POST['password'] != '' && $_POST['fullname'] != '' && $_POST['email'] != '' && $_POST['birthday'] != '' && $_POST['gender'] != '')
		{
			$user_model = new User();
			$r = $user_model->getByUsername(htmlentities($_POST['username']))->fetchColumn();
			if($r == 0)
			{
				$user = array(
					'username' => htmlentities($_POST['username']),
					'password' => htmlentities($_POST['password']),
					'fullname' => htmlentities($_POST['fullname']),
					'email' => htmlentities($_POST['email']),
					'birthday' =>  htmlentities($_POST['birthday']),
					'sex' => (htmlentities($_POST['gender']) == 'Nam') ? 1 : 0,
					'regTime' => date("Y-m-d H:i:s"),
					'loginTime' => date("Y-m-d H:i:s"), 
					'numContest' => 0,
					'scoreRate' => 0,
					'type' => 0,
					'avatar' => 'default.png'
					);
				$user_model->signup($user);
				$status = 1;
				$err = "Đăng kí thành công";
					
			}
			else 
			{
				$err= "Tên đăng nhập đã tồn tại!";
			}
		}
		else $err = "Chưa nhập đủ thông tin";
	}
	$data = array(
		'title' => 'Đăng kí tài khoản',
		'err' => $err,
		'status' => $status
		);
	$this->render('signup', $data);
  }
  public function login()
  {
	  $err = "";
	  $status = 0;
	if(isset($_POST['login']))
	{
		if($_POST['username'] != '' && $_POST['password'] != '' )
		{
			$user_model = new User();
			$r = $user_model->getByUsername(htmlentities($_POST['username']))->fetchColumn();
			if($r > 0)
			{
				$row = $user_model->getByUsername(htmlentities($_POST['username']))->fetch( PDO::FETCH_ASSOC );
				if($row['password'] == htmlentities($_POST['password']))
				{
					$err = "Đăng nhập thành công";
					$_SESSION['user'] = $row['username'];
					$_SESSION['userId'] = $row['id'];
					$user_model->updateTimeLogin($row['id']);
					$status = 1;
				}
				else $err = "Tài khoản hoặc mật khẩu không chính xác";	
			}
			else 
			{
				$err= "Tài khoản hoặc mật khẩu không chính xác";
			}
		}
		else $err = "Vui lòng nhập đầy đủ thông tin";
	}
	  $data = array(
		'title' => 'Đăng nhập',
		'status' => $status,
		'err' => $err
		);
	$this->render('login', $data);
  }
  
}