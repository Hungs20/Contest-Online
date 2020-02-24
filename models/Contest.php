<?php
require_once('connection.php');
class Contest 
{
	public $id;
	public $name;
	public $nameAuthor;
	public $startTime;
	public $listIdProblem;
	public $duringTime;
	public $password;
	public $maxScore;
	public $mota;
	/*function __construct($id, $name, $idAuthor, $startTime, $listIdProblem, $duringTime, $password, $maxScore, $mota)
	{
		$this->id = $id;
		$this->name = $name;
		$this->idAuthor = $idAuthor;
		$this->startTime = $startTime;
		$this->listIdProblem = $listIdProblem;
		$this->duringTime = $duringTime;
		$this->password = $password;
		$this->maxScore = $maxScore;
		$this->mota = $mota;
	}*/

	static function addContest($contest)
	{
		$db = DB::getInstance();
		$query = "INSERT INTO `contest`(`name`, `nameAuthor`, `startTime`, `listIdProblem`, `duringTime`, `password`, `maxScore`, `mota`) VALUES ('".$contest['name']."', '".$contest['nameAuthor']."', '".$contest['startTime']."', '".$contest['listIdProblem']."', '".$contest['duringTime']."', '".$contest['password']."', ".$contest['maxScore'].", '".$contest['mota']."' )";
		$req = $db->query($query);
		return $query;
	}
	static function getAll()
	{
		$list = [];
		$db = DB::getInstance();
		$req = $db->query('SELECT * FROM contest ORDER BY startTime DESC');

		foreach ($req->fetchAll() as $item) {
		  $list[] = $item;
		}

		return $list;
	}
	static function findById($id)
	{
		$db = DB::getInstance();
		$req = $db->prepare("SELECT * FROM contest WHERE id = :id");
		
		$res=$req->execute(array('id' => $id));
		
		$item = $req->fetch();
		if (isset($item['id'])) {
		  return $item;
		}
		return null;
	}
	static function getNewContest()
	{
		$list = [];
		$db = DB::getInstance();
		$req = $db->query("SELECT * FROM contest WHERE `startTime`+ INTERVAL `duringTime` MINUTE >= NOW() ORDER BY startTime ASC");
		foreach ($req->fetchAll() as $item) {
		  $list[] = $item;
		}
		return $list;
	}
	
	static function getOldContest()
	{
		$list = [];
		$db = DB::getInstance();
		$req = $db->query("SELECT * FROM contest WHERE `startTime`+ INTERVAL `duringTime` MINUTE < NOW() ORDER BY startTime DESC");
		foreach ($req->fetchAll() as $item) {
		  $list[] = $item;
		}
		return $list;
	}
	
	static function updateThamgia($idContest)
	{
		$db = DB::getInstance();
		$req = $db->query("UPDATE `contest` SET `thamgia` = `thamgia` + 1 WHERE `id` = $idContest");
		return $req;
	}
	
	static function updateMaxScore($idContest,$score)
	{
		$db = DB::getInstance();
		$req = $db->query("UPDATE `contest` SET `maxScore` = $score WHERE `id` = $idContest");
		return $req;
	}
}
?>