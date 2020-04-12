<?php
require_once('connection.php');
class SubmitHistory
{
	public $id;
	public $user;
	public $time;
	public $idProblem;
	public $idContest;
	public $score;
	public $answer;
	

	static function addSubmitHistory($submitHistory)
	{
		$db = DB::getInstance();
		$query = "INSERT INTO `submit_history`(`time`, `user`, `idProblem`, `score`, `answer`, `idContest`) VALUES (?,?,?,?,?,?)";
		$req = $db->prepare($query);
		$res = $req->execute([$submitHistory['time'], $submitHistory['user'], $submitHistory['idProblem'], $submitHistory['score'], $submitHistory['answer'], $submitHistory['idContest']]);
		
	}
	static function getAll()
	{
		$list = [];
		$db = DB::getInstance();
		$req = $db->query('SELECT * FROM submit_history ORDER BY id DESC');

		foreach ($req->fetchAll() as $item) {
		  $list[] = $item;
		}

		return $list;
	}
	static function findById($id)
	{
		$db = DB::getInstance();
		$req = $db->prepare("SELECT * FROM submit_history WHERE id = :id");
		
		$res=$req->execute(array('id' => $id));
		
		$item = $req->fetch();
		if (isset($item)) {
		  return $item;
		}
		return null;
	}
	static function findByIdUser($idUser)
	{
		$db = DB::getInstance();
		$req = $db->prepare("SELECT * FROM submit_history WHERE idUser = :idUser");
		
		$res=$req->execute(array('id' => $idUser));
		
		$item = $req->fetchAll();
		if (isset($item)) {
		  return $item;
		}
		return null;
	}
	
	static function findByIdProblem($idProblem)
	{
		$db = DB::getInstance();
		$req = $db->prepare("SELECT * FROM submit_history WHERE idProblem = :idProblem");
		
		$res=$req->execute(array('idProblem' => $idProblem));
		
		$item = $req->fetchAll();
		if (isset($item)) {
		  return $item;
		}
		return null;
	}
	static function findByIdContest($idContest)
	{
		$db = DB::getInstance();
		$req = $db->prepare("SELECT * FROM submit_history WHERE idContest = :idContest");
		
		$res=$req->execute(array('idContest' => $idContest));
		
		$item = $req->fetchAll();
		if (isset($item)) {
		  return $item;
		}
		return null;
	}
	static function getSubmitHistoryByUserAndIdContest($user, $idContest)
	{
		$db = DB::getInstance();
		$req = $db->prepare("SELECT * FROM submit_history WHERE user = :user AND  idContest = :idContest");
		
		$res=$req->execute(array('user' => $user, 'idContest' => $idContest));
		
		$item = $req->fetch();
		if (isset($item['id'])) {
		  return $item;
		}
		return null;
	}
	static function getRankByIdContestAndIdProblem($idContest, $idProblem, $start, $num)
	{
		$db = DB::getInstance();
		$req = $db->prepare("SELECT *, MAX(score) max_score FROM `submit_history` WHERE idContest = :idContest AND  idProblem = :idProblem GROUP BY `idContest`,`idProblem`,`user` ORDER BY max_score DESC LIMIT :start, :num");
		
		$res=$req->execute(array('idContest' => $idContest, 'idProblem' => $idProblem, 'start' => $start, 'num' => $num));
		
		$item = $req->fetchAll();
		if (isset($item)) {
		  return $item;
		}
		return null;
	}
	static function getRankByIdContest($idContest, $start, $num)
	{
		$db = DB::getInstance();
		$req = $db->prepare("SELECT *, MAX(score) max_score FROM `submit_history` WHERE idContest = :idContest GROUP BY `idContest`,`idProblem`,`user` ORDER BY max_score DESC LIMIT :start, :num");
		
		$res=$req->execute(array('idContest' => $idContest, 'start' => $start, 'num' => $num));
		
		$item = $req->fetchAll();
		if (isset($item)) {
		  return $item;
		}
		return null;
	}
	static function getRankAll($start, $num)
	{
		$db = DB::getInstance();
		$req = $db->prepare("SELECT *, SUM(max_score) max_score FROM ( SELECT *, MAX(`score`) as max_score FROM `submit_history` GROUP BY `idContest`,`idProblem`,`user`) as max_scores GROUP BY `user` ORDER BY max_score DESC LIMIT :start, :num");
		//echo $req;
		$res=$req->execute(array('start' => $start, 'num' => $num));
		
		$item = $req->fetchAll();
		if (isset($item)) {
		  return $item;
		}
		return null;
	}
}
?>