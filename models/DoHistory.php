<?php
require_once('connection.php');
class DoHistory
{
	public $id;
	public $user;
	public $time;
	public $idProblem;
	public $idContest;
	public $answer;
	

	static function addDoHistory($doHistory)
	{
		$db = DB::getInstance();
		$query = "INSERT INTO `do_history`(`time`, `user`, `idProblem`, `answer`, `idContest`) VALUES ('".$doHistory['time']."', '".$doHistory['user']."', ".$doHistory['idProblem'].", '".$doHistory['answer']."', ".$doHistory['idContest'].")";
		$req = $db->query($query);
		return $query;
	}
	
	static function updateDoHistory($doHistory)
	{
		$db = DB::getInstance();
		$query = "UPDATE `do_history` SET `time` = ?, `user`= ?, `idProblem`= ?, `idContest` = ?, `answer` = ?";
		$req = $db->prepare($query);
		$req->execute([$doHistory['time'], $doHistory['user'], $doHistory['idProblem'], $doHistory['idContest'], $doHistory['answer']]);
	}
	
	static function getDoHistoryByUserAndIdContestAndIdProb($user, $idContest, $idProblem)
	{
		$db = DB::getInstance();
		$req = $db->prepare("SELECT * FROM do_history WHERE user = :user AND  idContest = :idContest AND idProblem = :idProblem");
		
		$res=$req->execute(array('user' => $user, 'idContest' => $idContest, 'idProblem' => $idProblem));
		
		$item = $req->fetch();
		if (isset($item['id'])) {
		  return $item;
		}
		return null;
	}
}
?>