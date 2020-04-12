<?php
require_once('controllers/base_controller.php');
require_once("models/Problem.php");
require_once("models/Contest.php");
require_once("models/SubmitHistory.php");
require_once("models/User.php");
class HistoryController extends BaseController
{
  function __construct()
  {
    $this->folder = 'history';
  }
	
  public function index()
  {
	 if(isset($_GET['idCt'])) $list = SubmitHistory::findByIdContest($_GET['idCt']);
	 else if(isset($_GET['idPb'])) $list = SubmitHistory::findByIdProblem($_GET['idPb']);
	else $list = SubmitHistory::getAll();
	foreach($list as $i => $item)
	{
		$user = User::getByUsername($item['user']);
		$problem = Problem::findById($item['idProblem']);
		if($item['idContest']) $problem = Contest::findById($item['idContest']);
		$list[$i]['idUser'] = $user['id'];
		$list[$i]['name'] = $problem['name'];
		
	}
    $data = array(
      'title' => 'Nhật kí làm bài',
      'list' => $list
    );
    $this->render('index', $data);
  }
  
  public function show()
  {
	  $problem = array('name'=>'Bài thi');
	  $history = SubmitHistory::findById($_GET['id']);
		$problem = Problem::findById($history['idProblem']);
		
		$data = array(
		'title' => $problem['name'],
		'problem' => $problem,
		'history' => $history,
		);
		$this->render('show', $data);
  }
  
}