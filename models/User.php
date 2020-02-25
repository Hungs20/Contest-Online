<?php
require_once('connection.php');
class User {
	public $id;
	public $username;
	public $password;
	public $fullname;
	public $birthday;
	public $loginTime;
	public $regTime;
	public $numContest;
	public $scoreRate;
	public $avatar;
	public $type;
	
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
	static function updateTimeLogin($id)
	{
		$db = DB::getInstance();
		$req = $db->query("UPDATE `user` SET `loginTime` = '".date("Y-m-d H:i:s")."' WHERE `id` = $id");
		return $req;
	}
	
	
}

?>