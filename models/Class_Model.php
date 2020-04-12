<?php
require_once('connection.php');
class Class_Model {
	
	static function create($class)
	{
		$db = DB::getInstance();
		$query = "INSERT INTO `class`(`className`, `teacherName`, `password`) VALUES (?,?,?)";
		$req = $db->prepare($query);
		$res = $req->execute([$class['className'], $class['teacherName'], $class['password']]);
		$id = $db->lastInsertId();
		return $id;
	}
	static function getById($id)
	{
		$db = DB::getInstance();
		$req = $db->prepare("select * from `class` where `id` = :id");
		$res = $req->execute(array('id' => $id));
		$item = $req->fetch(PDO::FETCH_ASSOC);
		if (isset($item)) {
		  return $item;
		}
		return null;
	}

	static function updateListStudent($idClass, $idStudent, $password)
	{
		if($password == '') $password = null;
		$db = DB::getInstance();
		$req = $db->prepare("UPDATE `class` SET `listStudent` = listStudent + ' ' + :idStudent WHERE `id` = :idClass AND `password` = :password");
		$res = $req->execute(array('idClass' => $idClass, 'idStudent' => $idStudent, 'password' => $password));
		if($res) 
		{
			if($req->fetch()) return true;
			else return false;
		}
		else return false;
	}
	
}

?>