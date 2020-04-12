<?php
require_once('controllers/base_controller.php');
require_once("models/User.php");
require_once("models/Class_Model.php");
class ClassController extends BaseController
{
	
  function __construct()
  {
    $this->folder = 'class';
  }
  private function isAccess()
  {
	 if(isset($_SESSION['user']))
	{
		$username = $_SESSION['user'];
		$user = User::getByUsername($username);
		if($user['type'] == $config['ADMIN'] || $user['type'] == $config['TEACHER'] ) return true;
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
	$list = array();
	$user = array();
	if(isset($_SESSION['user']))
	{
		
		if(isset($_POST['create']))
		{
			if($_POST['className'] == '') $err = '<p class = "text-danger">Tên lớp không được trống.</p>';
			else
			{
				$class['className'] = $_POST['className'];
				$class['password'] = $_POST['password'];
				$class['teacherName'] = $_SESSION['user'];
				$id = Class_Model::create($class);
				User::addClass($id, $_SESSION['user']);
			}
		}
		
		$user = User::getByUsername($_SESSION['user']);
		$lsClass= array_filter(explode(" ", $user['listClass']));
		for($i = 0; $i < sizeof($lsClass); $i++)
		{
			$id = $lsClass[$i];
			$list[$i] = Class_Model::getById($id);
		}
	
	}
	$data = array(
	'title' => 'Lớp học',
	'list' => @$list,
	'user' => @$user,
	'err' => @$err
	);
	$this->render('index', $data);
  }

  

  
  
}