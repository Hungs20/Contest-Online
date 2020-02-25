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
	if(isset($_SESSION['user']))
	{
		if(isset($_POST['idCt']) && isset($_POST['idPb']) && isset($_POST['num']) && isset($_POST['val']))
		{
			$doHis = DoHistory::getDoHistoryByUserAndIdContestAndIdProb($_SESSION['user'], $_POST['idCt'], $_POST['idPb']);
			$ans = $doHis['answer'];
			$ans[$_POST['num']] = $_POST['val'];
			
			$doHistory = array(
				'user' => $_SESSION['user'],
				'idProblem' => $_POST['idPb'],
				'answer' => $ans,
				'idContest' => $_POST['idCt'],
				'time' => date("Y-m-d H:i:s")
			);
			DoHistory::updateDoHistory($doHistory);
		}
	}
    $data = array(
      'title' => 'Update history',
    );
    $this->render('index', $data);
  }
  
}