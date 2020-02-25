<?php
require_once('controllers/base_controller.php');
require_once("models/Contest.php");
require_once("models/Problem.php");
require_once("models/SubmitHistory.php");
require_once("models/DoHistory.php");
class ContestController extends BaseController
{
  function __construct()
  {
    $this->folder = 'contest';
  }

  public function index()
  {
	$list = Contest::getOldContest();
	$newContest = Contest::getNewContest();
    $data = array(
      'title' => 'Contest',
      'list' => $list,
	  'newContest' => $newContest
    );
    $this->render('index', $data);
  }
	
	public function create()
  {
	  $err = "";
	  if(isset($_POST['create']))
	  {
		  if(!$_SESSION['user']) header("location: index.php?controller=pages&action=login");
		  if($_POST['name'] != '' && $_POST['startTime'] != '' && $_POST['duringTime'] !='' && $_POST['listIdProblem'] != '')
		  {
			  $var = htmlentities($_POST['startTime']);
			  $startTime = str_replace('/', '-', $var);
			  $date=new DateTime(date('Y-m-d', strtotime($startTime)).' '.htmlentities($_POST['gio']).':'.htmlentities($_POST['phut']).' '.htmlentities($_POST['sc']));
			  $contest = array(
				'name' => htmlentities($_POST['name']),
				'startTime' =>  $date->format("Y-m-d G:i:s"),
				'duringTime' => htmlentities($_POST['duringTime']),
				'nameAuthor' => $_SESSION['user'],
				'password' => htmlentities($_POST['password']),
				'listIdProblem' => htmlentities($_POST['listIdProblem']),
				'maxScore' => 0,
				'mota' => htmlentities($_POST['mota'])
				);
			  Contest::addContest($contest);
			  $err = "Tạo cuộc thi thành công";
			  header('location:index.php?controller=contest');
		  }
		  else $err = "Chưa nhập đủ thông tin";
	  }
    $data = array(
      'title' => 'Tạo cuộc thi',
	  'err' => $err
    );
    $this->render('create', $data);
  }
  
	public function show()
	{
		$contest = Contest::findById($_GET['id']);
		$data = array(
		'title' => $contest['name'],
		'contest' => $contest
		);
		$this->render('show', $data);
	}
	public function play()
	{
		$contest = Contest::findById($_GET['id']);
		$listId = explode(" ", $contest['listIdProblem']);
		shuffle($listId);
		$isSubmit = (isset($_SESSION['user'])) ? SubmitHistory::getSubmitHistoryByUserAndIdContest($_SESSION['user'], $_GET['id']) : null;
		
		$isEnd = ((strtotime($contest['startTime']." + ".$contest['duringTime']." minutes" ) - strtotime("now")) < 0) ? true : false;
		$isStart = ((strtotime($contest['startTime']) - strtotime("now")) > 0) ? false : true;
		$ans='';
		if(isset($_SESSION['user']))
		{
			$doHis = DoHistory::getDoHistoryByUserAndIdContest($_SESSION['user'], $contest['id']);
			if(!$doHis)
			{
				if($isSubmit) $problem = Problem::findById($isSubmit['idProblem']);
				else $problem = Problem::findById($listId[0]);
				$ans = str_repeat('_', $problem['numQuess']);
				$doHistory = array(
					'user' => $_SESSION['user'],
					'idProblem' => $problem['id'],
					'answer' => $ans,
					'idContest' => $contest['id'],
					'time' => date("Y-m-d H:i:s")
				);
				if(!$isSubmit && $isStart && !$isEnd) DoHistory::updateDoHistory($doHistory);
			}
			else
			{
				$problem = Problem::findById($doHis['idProblem']);
				$ans = $doHis['answer'];
			}
		}
		
		
		$headProb = $problem['name'];
		$bodyProb = ($isStart) ? '<div class="embed-responsive embed-responsive-16by9">
				  <iframe class="embed-responsive-item" src="../../public/pdfviewer/web/viewer.html?file='.$problem["link"].'"></iframe>
				</div>' : 'Cuộc thi chưa bắt đầu';
		$footProb = 'Chúc các bạn làm bài tốt <3';
		
		
		$headSubmit = ($isStart && !$isEnd) ? 'Trả lời' : 'Thông báo';
		$bodySubmit = '<h4><p id="timer"></p></h4>';
		$footSubmit = '';
		$formSubmit = '';
		if($isStart)
		{
		$formSubmit = $formSubmit.'<table class="table table-sm">
						  <thead>
							<tr>
							  <th scope="col">#</th>
							  <th scope="col">A</th>
							  <th scope="col">B</th>
							  <th scope="col">C</th>
							  <th scope="col">D</th>
							</tr>
						  </thead>
						  <tbody>';
		for($i = 1; $i <= $problem['numQuess']; $i++)
		{
			$formSubmit = $formSubmit.'<tr><th scope="row">'.$i.'</th>';
			for($j = 'A'; $j <= 'D'; $j++)
			{
				$formSubmit = $formSubmit.'<td><div class="form-check">
						  <input class="form-check-input position-static" type="radio" name="'.$i.'" value="'.$j.'" aria-label="'.$j.'"';
							
							if(isset($_POST['submit'])){
								if(isset($_POST["$i"]) && $_POST["$i"] == $j) $formSubmit=$formSubmit.' checked';  
								else $formSubmit = $formSubmit.' disabled';
							}
							else if($isSubmit != null){
								if($isSubmit['answer'][$i-1] == $j) $formSubmit=$formSubmit.' checked';
								else $formSubmit=$formSubmit.' disabled';
							}
							else {
								if($ans[$i-1] == $j) $formSubmit=$formSubmit.' checked';
							}
					$formSubmit=$formSubmit.'></div></td>';
			}
			$formSubmit = $formSubmit.'</tr>';
			
		}
		$formSubmit = $formSubmit.'</tbody></table>';
		}
		if($isEnd && $isSubmit == null) $formSubmit = '';
		if(isset($_SESSION['user']))
		{
			if($isSubmit != null)
			{
				$headSubmit = 'Bạn đã nộp bài rồi';
				$bodySubmit = '<h3><b><font color="red">'.$isSubmit['score'].'</font></b>/<b><font color="blue">10</font></b></h3>';
			}
			else
			{
			if($isStart && !$isEnd) 
			{
				if(isset($_POST['submit']))
				{
					$num = $problem['numQuess'];
					$score = 0;
					$ans = "";
					for($i = 1; $i <= $num; $i++)
					{
						if(isset($_POST["$i"]))
						{
							if($_POST["$i"] == $problem['answer'][$i-1]) $score++;
							$ans = $ans.$_POST["$i"];
						}
						else $ans = $ans.'_';
					}
					if($score*10/$problem['numQuess'] > $problem['maxScore']) Problem::updateMaxScore($problem['id'],$score*10/$problem['numQuess']);
					if($score*10/$problem['numQuess'] > $contest['maxScore']) Contest::updateMaxScore($contest['id'],$score*10/$problem['numQuess']);
					Contest::updateThamgia($contest['id']);
					Problem::updateThamgia($problem['id']);
					$submitHistory = array(
						'user' => $_SESSION['user'],
						'idProblem' => $problem['id'],
						'score' => $score*10/$problem['numQuess'],
						'answer' => $ans,
						'idContest' => $contest['id'],
						'time' => date("Y-m-d H:i:s")
						);
					SubmitHistory::addSubmitHistory($submitHistory);
					DoHistory::deleteDoHistory($_SESSION['user'], $contest['id'], $problem['id']);
					$headSubmit = 'Kết quả';
					$bodySubmit = "Đúng : <b><font color='blue'>".$score."/".$problem['numQuess']."</font></b> câu<br>Điểm : <b><font color='red'>".$score*10/$problem['numQuess']."</font></b>";

				}
				else
				{
					$formSubmit='<form method="POST">'.$formSubmit.'<p class="text-center"><button type="submit" class="btn btn-success" id="submit" name="submit">Nộp bài</button></p></form>';
				}
			}
			else
			{
				$headSubmit = 'Lỗi!';
				if(!$isStart) $bodySubmit = 'Cuộc thi chưa bắt đầu';
				else if($isEnd) $bodySubmit = 'Cuộc thi đã kết thúc';
			}
			
			}
		}
		else
		{
			$bodyProb = 'Bạn cần đăng nhập để xem đề';
			$formSubmit = '';
			$bodySubmit = 'Bạn cần đăng nhập để trả lời';
		}
		
		$data = array(
		'title' => $contest['name'],
		'problem' => $problem,
		'score' => @$score,
		'contest' => $contest,
		'isSubmit' => $isSubmit,
		'headProb' => $headProb,
		'bodyProb' => $bodyProb,
		'footProb' => $footProb,
		'headSubmit' => $headSubmit,
		'bodySubmit' => $bodySubmit,
		'footSubmit' => $footSubmit,
		'formSubmit' => $formSubmit
		);
		$this->render('play', $data);
	}
}