<?php
require_once('controllers/base_controller.php');
require_once("models/Problem.php");
require_once("models/Contest.php");
require_once("models/DoHistory.php");
require_once("models/User.php");
class DoHistoryController extends BaseController
{
  function __construct()
  {
    $this->folder = 'do_history';
  }
	
  public function index()
  {
	
    $data = array(
      'title' => 'Nhật kí làm bài',
    );
    $this->render('index', $data);
  }
  
}