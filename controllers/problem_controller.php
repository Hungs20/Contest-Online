<?php
require_once('controllers/base_controller.php');
require_once("models/Problem.php");
require_once("models/SubmitHistory.php");
require_once("models/DoHistory.php");
class ProblemController extends BaseController
{
  function __construct()
  {
    $this->folder = 'problem';
  }
	
  public function index()
  {
	$list = Problem::getAll();
    $data = array(
      'title' => 'Luyện tập',
      'list' => $list
    );
    $this->render('index', $data);
  }
  
  public function create()
  {
	  $err = "";
	  if(isset($_POST['create']))
	  {
		  if(!$_SESSION['user']) header("location: index.php?controller=pages&action=login");
		  if($_POST['name'] != '' && $_POST['numQuess'] != '' && $_POST['answer'] !='' && ($_POST['link'] != '' || $_FILES["problem"]["name"]))
		  {
			if($_POST['numQuess'] != strlen($_POST['answer']))
			{
				$err = "Số đáp án không trùng với số lượng câu hỏi";
			}
			else 
			{
				if(isset($_FILES['problem']))
				{
					// Nếu file upload không bị lỗi,
					// Tức là thuộc tính error > 0
					if ($_FILES['problem']['error'] > 0)
					{
						$err = 'File Upload Bị Lỗi';
					}
					else{
						// Upload file
						move_uploaded_file($_FILES['problem']['tmp_name'], './public/problem/'.$_FILES['problem']['name']);
					}
				}
				  $problem = array(
					'name' => htmlentities($_POST['name']),
					'numQuess' => htmlentities($_POST['numQuess']),
					'nameAuthor' => $_SESSION['user'],
					'answer' => strtoupper(htmlentities($_POST['answer'])),
					'link' => ($_POST['link']) ? htmlentities($_POST['link']) : "/public/problem/".$_FILES['problem']['name'],
					'mota' => htmlentities($_POST['mota'])
					);
				  Problem::addProblem($problem);
				  $err = "Tạo bài thi thành công";
					header('location:index.php?controller=problem');
			}
		  }
		  else $err = "Chưa nhập đủ thông tin";
	  }
    $data = array(
      'title' => 'Tạo bài thi',
	  'err' => $err
    );
    $this->render('create', $data);
  }
	public function show()
	{
		$problem = array('name'=>'Bài thi');
		$problem = Problem::findById($_GET['id']);
		$ans = str_repeat('_', $problem['numQuess']);
		if(isset($_SESSION['user']))
		{
			$doHis = DoHistory::getDoHistoryByUserAndIdContestAndIdProb($_SESSION['user'], 0, $problem['id']);
			if(!$doHis)
			{
				$doHistory = array(
					'user' => $_SESSION['user'],
					'idProblem' => $problem['id'],
					'answer' => $ans,
					'idContest' => 0,
					'time' => date("Y-m-d H:i:s")
				);
				DoHistory::updateDoHistory($doHistory);
			}
			else
			{
				$ans = $doHis['answer'];
			}
		}
		$headProb = $problem['name'];
		/*<div class="embed-responsive embed-responsive-16by9">
				  <iframe class="embed-responsive-item" src="../../public/pdfviewer/web/viewer.html?file='.$problem["link"].'"></iframe>
				</div>*/
		$bodyProb = '<div class="embed-responsive embed-responsive-16by9">
				  <iframe class="embed-responsive-item" src="../../public/pdfviewer/web/viewer.html?file='.$problem["link"].'"></iframe>
				</div>' ;
		$footProb = 'Chúc các bạn làm bài tốt <3';
		$headSubmit = 'Trả lời';
		$bodySubmit = '';
		$footSubmit = '';
		$formSubmit = '<div class="table-responsive"><table class="table" >
						  <!--<thead>
							<tr>
							  <th scope="col">#</th>
							  <th scope="col">A</th>
							  <th scope="col">B</th>
							  <th scope="col">C</th>
							  <th scope="col">D</th>
							</tr>
						  </thead> --!>
						  <tbody>';
		for($i = 1; $i <= $problem['numQuess']; $i++)
		{
			$formSubmit = $formSubmit.'<tr><th scope="row">'.$i.'</th>';
			for($j = 'A'; $j <= 'D'; $j++)
			{
				$formSubmit = $formSubmit.'<td><label>'.$j.'</label><div class="form-check">
						  <input class="form-check-input position-static" type="radio" name="'.$i.'" value="'.$j.'" aria-label="'.$j.'"';
							
							if(isset($_POST['submit'])){
								if(isset($_POST["$i"]) && $_POST["$i"] == $j) $formSubmit=$formSubmit.' checked';  
								else $formSubmit = $formSubmit.' disabled';
							}
							else {
								if($ans[$i-1] == $j) $formSubmit=$formSubmit.' checked';
							}
					$formSubmit=$formSubmit.'></div></td>';
			}
			$formSubmit = $formSubmit.'</tr>';
			
		}
		$formSubmit = $formSubmit.'</tbody></table></div>';
		
		if(isset($_SESSION['user']))
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
				Problem::updateThamgia($problem['id']);
				$submitHistory = array(
					'user' => $_SESSION['user'],
					'idProblem' => $problem['id'],
					'score' => $score*10/$problem['numQuess'],
					'answer' => $ans,
					'idContest' => 0,
					'time' => date("Y-m-d H:i:s")
					);
				SubmitHistory::addSubmitHistory($submitHistory);
				DoHistory::deleteDoHistory($_SESSION['user'], 0, $problem['id']);
				$headSubmit = 'Kết quả';
				$bodySubmit = "Đúng : <b><font color='blue'>".$score."/".$problem['numQuess']."</font></b> câu<br>Điểm : <b><font color='red'>".$score*10/$problem['numQuess']."</font></b>";
				
				$formSubmit=$formSubmit.'<p class="text-center"><a href="" class="btn btn-success" >Làm lại</a></p>';
				
			}
			else
			{
				$formSubmit='<form method="POST">'.$formSubmit.'<p class="text-center"><button type="submit" class="btn btn-success" id="submit" name="submit">Nộp bài</button></p></form>';
			}
			
		}
		else
		{
			$formSubmit = '';
			$bodySubmit = 'Bạn cần đăng nhập để trả lời';
		}
	
		
		$data = array(
		'title' => $problem['name'],
		'problem' => $problem,
		'score' => @$score,
		'headProb' => $headProb,
		'bodyProb' => $bodyProb,
		'footProb' => $footProb,
		'headSubmit' => $headSubmit,
		'bodySubmit' => $bodySubmit,
		'footSubmit' => $footSubmit,
		'formSubmit' => $formSubmit
		);
		$this->render('show', $data);
	}

}