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
		  $user = User::getByUsername($username);
		  $isLogin = true;
	  }
    $data = array(
	'title' => 'Trang chủ',
      'user' => @$user,
      'isLogin' => $isLogin
    );
    $this->render('home', $data);
  }

  public function error()
  {
    $this->render('error');
  }
  public function logout()
  {
    $this->render('logout');
  }
  public function signup()
  {	
	$err = "";
	$status = 0;
	if(isset($_POST['signup']))
	{
		if($_POST['username'] != '' && $_POST['password'] != '' && $_POST['fullname'] != '' && $_POST['email'] != '' && $_POST['birthday'] != '' && $_POST['gender'] != '')
		{
			$r = User::getByUsername(htmlentities($_POST['username']));
			if(!$r)
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
				User::signup($user);
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
			$r = User::getByUsername($_POST['username']);
			if($r)
			{
				$row = User::getByUsername($_POST['username']);
				if($row['password'] == $_POST['password'])
				{
					$err = "Đăng nhập thành công";
					$_SESSION['user'] = $row['username'];
					$_SESSION['userId'] = $row['id'];
					User::updateTimeLogin($row['username']);
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