<?php
require_once('connection.php');
class Problem 
{
	public $id;
	public $name;
	public $nameAuthor;
	public $maxScore;
	public $mota;
	public $link;
	public $numQuess;
	public $answer;
	

	static function addProblem($problem)
	{
		$db = DB::getInstance();
		$query = "INSERT INTO `problem`(`name`, `nameAuthor`, `numQuess`, `answer`, `link`, `mota`) VALUES ('".$problem['name']."', '".$problem['nameAuthor']."', ".$problem['numQuess'].", '".$problem['answer']."', '".$problem['link']."', '".$problem['mota']."' )";
		$req = $db->query($query);
		return $query;
	}
	static function getAll()
	{
		$list = [];
		$db = DB::getInstance();
		$req = $db->query('SELECT * FROM problem ORDER BY id DESC');

		foreach ($req->fetchAll() as $item) {
		  $list[] = $item;
		}

		return $list;
	}
	static function findById($id)
	{
		$db = DB::getInstance();
		$req = $db->prepare("SELECT * FROM problem WHERE id = :id");
		
		$res=$req->execute(array('id' => $id));
		
		$item = $req->fetch();
		if (isset($item['id'])) {
		  return $item;
		}
		return null;
	}
	
	static function updateThamgia($idProblem)
	{
		$db = DB::getInstance();
		$req = $db->query("UPDATE `problem` SET `thamgia` = `thamgia` + 1 WHERE `id` = $idProblem");
		return $req;
	}
	
	static function updateMaxScore($idProblem,$score)
	{
		$db = DB::getInstance();
		$req = $db->query("UPDATE `problem` SET `maxScore` = $score WHERE `id` = $idProblem");
		return $req;
	}
	
}
?>