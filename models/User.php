<?php
require_once('connection.php');
class User {
	
	static function signup($user)
	{
		$db = DB::getInstance();
		$query = "INSERT INTO `user`(`username`, `password`, `fullname`, `birthday`, `email`, `sex`, `regTime`, `loginTime`, `numContest`, `scoreRate`, `type`, `avatar`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
		$req = $db->prepare($query);
		$res = $req->execute([$user['username'], $user['password'], $user['fullname'], $user['birthday'], $user['email'], $user['sex'], $user['regTime'], $user['loginTime'], $user['numContest'], $user['scoreRate'], $user['type'], $user['avatar']]);
	}
	static function getByUsername($username)
	{
		$db = DB::getInstance();
		$req = $db->prepare("select * from `user` where `username` = :username");
		$res = $req->execute(array('username' => $username));
		$item = $req->fetch(PDO::FETCH_ASSOC);
		if (isset($item)) {
		  return $item;
		}
		return null;
	}
	static function getOnline()
	{
		$db = DB::getInstance();
		$req = $db->prepare("select * from `user` where `loginTime` + INTERVAL 15 MINUTE > '".date("Y-m-d H:i:s")."'");
		$res = $req->execute();
		$item = $req->fetchAll();
		if (isset($item)) {
		  return $item;
		}
		return null;
	}
	static function updateTimeLogin($username)
	{
		$db = DB::getInstance();
		$req = $db->prepare("UPDATE `user` SET `loginTime` = '".date("Y-m-d H:i:s")."' WHERE `username` = :username");
		$res = $req->execute(array('username' => $username));
	}
	static function addClass($idClass, $username)
	{
		$db = DB::getInstance();
		$req = $db->prepare("UPDATE `user` SET `listClass` = IFNULL(CONCAT(`listClass`,' ',:idClass), :idClass2) WHERE `username` = :username");
		$res = $req->execute(array('idClass' => $idClass, 'username' => $username, 'idClass2' => $idClass));
	}
	static function getListClass($username)
	{
		$db = DB::getInstance();
		$req = $db->prepare("select listClass from `user` where `username` = :username");
		$res = $req->execute(array('username' => $username));
		$item = $req->fetch(PDO::FETCH_ASSOC);
		if (isset($item)) {
		  return $item;
		}
		return null;
	}
	static function editUser($user)
	{
		$db = DB::getInstance();
		$query = "UPDATE `user` SET `username` = :username, `password` = :password, `fullname` = :fullname, `birthday` = :birthday, `email` = :email, `sex` = :sex, `type` = :type, `avatar` = :avatar";
		$req = $db->prepare($query);
		$res = $req->execute([$user['username'], $user['password'], $user['fullname'], $user['birthday'], $user['email'], $user['sex'], $user['type'], $user['avatar']]);
	}
	
	
}

?>