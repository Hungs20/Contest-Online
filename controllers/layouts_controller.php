<?php
require_once('controllers/base_controller.php');
require_once("models/Contest.php");
require_once("models/User.php");
class LayoutsController extends BaseController
{
  function __construct()
  {
    $this->folder = 'layouts';
  }

  public function right()
  {
	$list = Contest::getNewContest();
    $data = array(
      'title' => 'Contest',
      'newContest' => @$list[0],
    );
    $this->render('right', $data);
  }
  public function online()
  {
	if(isset($_SESSION['user']))
	{
		
		User::updateTimeLogin($_SESSION['user']);
	}
	$list = User::getOnline();
	$data = array(
      'title' => 'Online',
      'list' => @$list,
    );
    $this->render('online', $data);
  }
  
	
}