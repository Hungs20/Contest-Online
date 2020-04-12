<?php
require_once('controllers/base_controller.php');
require_once("models/User.php");
class AdminController extends BaseController
{
	
  function __construct()
  {
    $this->folder = 'admin';
  }
  
  private function isAccess()
  {
	 if(isset($_SESSION['user']))
	{
		$username = $_SESSION['user'];
		$user = User::getByUsername($username);
		if($user['type'] == ADMIN || $user['type'] == TEACHER ) return true;
		else return false;
	}
	else return false;
  }
  
  public function error()
  {
    $this->render('error');
  }
  
  public function index()
  {
	if($this->isAccess())
	{
		$data = array(
		'title' => 'Admin Panel',
		'user' => @$user,
		);
		$this->render('index', $data);
	}
	else $this->error();
    
  }

  
  //Class
  public function clss()
  {
	if($this->isAccess())
	{
		$listClass = explode(" ", $user['listClass']);
		$data = array(
		'title' => 'Class Panel',
		'user' => @$user,
		'listClass' => @$listClass,
		);
		$this->render('clss', $data);
	}
	else $this->error();
  }
  
  
}