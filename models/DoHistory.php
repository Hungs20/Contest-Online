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
		$query = "INSERT INTO `do_history`(`time`, `user`, `idProblem`, `answer`, `idContest`) VALUES (?,?,?,?,?)";
		$req = $db->prepare($query);
		$res = $req->execute([$doHistory['time'], $doHistory['user'], $doHistory['idProblem'], $doHistory['answer'], $doHistory['idContest']]);
	}
	
	static function updateDoHistory($doHistory)
	{
		$db = DB::getInstance();
		$query = "INSERT INTO `do_history`(`time`, `user`, `idProblem`, `answer`, `idContest`) VALUES (:time, :user, :idProblem, :answer, :idContest) ON DUPLICATE KEY UPDATE `time` = :time2, `answer` = :answer2";
		$req = $db->prepare($query);
		$req->bindParam(':time', $doHistory['time']);
		$req->bindParam(':time2', $doHistory['time']);
		$req->bindParam(':user', $doHistory['user'], PDO::PARAM_STR);
		$req->bindParam(':idProblem', $doHistory['idProblem'], PDO::PARAM_INT);
		$req->bindParam(':answer', $doHistory['answer'], PDO::PARAM_STR);
		$req->bindParam(':answer2', $doHistory['answer'], PDO::PARAM_STR);
		$req->bindParam(':idContest', $doHistory['idContest'], PDO::PARAM_INT);
		$req->execute();
	}
	
	static function getDoHistoryByUserAndIdContestAndIdProb($user, $idContest, $idProblem)
	{
		$db = DB::getInstance();
		$req = $db->prepare("SELECT * FROM do_history WHERE user = :user AND  idContest = :idContest AND idProblem = :idProblem");
		
		$res=$req->execute(array('user' => $user, 'idContest' => $idContest, 'idProblem' => $idProblem));
		
		$item = $req->fetch();
		if (isset($item)) {
		  return $item;
		}
		return null;
	}
	static function getDoHistoryByUserAndIdContest($user, $idContest)
	{
		$db = DB::getInstance();
		$req = $db->prepare("SELECT * FROM do_history WHERE user = :user AND  idContest = :idContest");
		
		$res=$req->execute(array('user' => $user, 'idContest' => $idContest));
		
		$item = $req->fetch();
		if (isset($item)) {
		  return $item;
		}
		return null;
	}
	static function deleteDoHistory($user, $idContest, $idProblem)
	{
		$db = DB::getInstance();
		$sql = "DELETE FROM do_history WHERE user = :user AND idContest = :idContest AND idProblem = :idProblem";
		$stmt = $db->prepare($sql);  
		$stmt->execute(array('user' => $user, 'idContest' => $idContest, 'idProblem' => $idProblem));
	}
}
?>