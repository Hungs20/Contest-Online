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
		if (isset($item['id'])) {
		  return $item;
		}
		return null;
	}
	static function findByIdUser($idUser)
	{
		$db = DB::getInstance();
		$req = $db->prepare("SELECT * FROM submit_history WHERE idUser = :idUser");
		
		$res=$req->execute(array('id' => $id));
		
		$item = $req->fetch();
		if (isset($item['id'])) {
		  return $item;
		}
		return null;
	}
	
	static function findByIdProblem($idProblem)
	{
		$db = DB::getInstance();
		$req = $db->prepare("SELECT * FROM submit_history WHERE idProblem = :idProblem");
		
		$res=$req->execute(array('id' => $id));
		
		$item = $req->fetch();
		if (isset($item['id'])) {
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
}
?>