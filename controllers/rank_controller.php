<?php
require_once('controllers/base_controller.php');
require_once("models/SubmitHistory.php");
class RankController extends BaseController
{
  function __construct()
  {
    $this->folder = 'rank';
  }
  public function index()
  {
	  $start = 0;
	  $num = 1000000;
	if(isset($_GET['idCt']) && $_GET['idCt'] > 0)
	{
		if(isset($_GET['idPb']) && $_GET['idPb'] > 0)
		{
			$list = SubmitHistory::getRankByIdContestAndIdProblem($_GET['idCt'], $_GET['idPb'], $start, $num);
		}
		else
		{
			$list = SubmitHistory::getRankByIdContest($_GET['idCt'], $start, $num);
		}
	}
	else 
	{
		if(isset($_GET['idPb']) && $_GET['idPb'] > 0)
		{
			$list = SubmitHistory::getRankByIdContestAndIdProblem(0, $_GET['idPb'], $start, $num);
		}
		else $list = SubmitHistory::getRankAll($start, $num);
	}
    $data = array(
      'title' => 'Bảng xếp hạng',
      'list' => $list
    );
    $this->render('index', $data);
  }
  public function api()
  {
	  $start = 0;
	  $num = 10;
	if(isset($_GET['idCt']) && $_GET['idCt'] > 0)
	{
		if(isset($_GET['idPb']) && $_GET['idPb'] > 0)
		{
			$list = SubmitHistory::getRankByIdContestAndIdProblem($_GET['idCt'], $_GET['idPb'], $start, $num);
		}
		else
		{
			$list = SubmitHistory::getRankByIdContest($_GET['idCt'], $start, $num);
		}
	}
	else 
	{
		if(isset($_GET['idPb']) && $_GET['idPb'] > 0)
		{
			$list = SubmitHistory::getRankByIdContestAndIdProblem(0, $_GET['idPb'], $start, $num);
		}
		else $list = SubmitHistory::getRankAll($start, $num);
	}
    $data = array(
      'title' => 'Bảng xếp hạng',
      'list' => $list
    );
    $this->render('api', $data);
  }
  
 
}