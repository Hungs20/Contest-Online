<?php
require_once('controllers/base_controller.php');
require_once("models/Problem.php");
require_once("models/SubmitHistory.php");
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
		}
		
		$data = array(
		'title' => $problem['name'],
		'problem' => $problem,
		'score' => @$score,
		);
		$this->render('show', $data);
	}

}