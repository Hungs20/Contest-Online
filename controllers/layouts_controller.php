<?php
require_once('controllers/base_controller.php');
require_once("models/Contest.php");
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
      'newContest' => @$list[0]
    );
    $this->render('right', $data);
  }
	
}