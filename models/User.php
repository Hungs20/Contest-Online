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
	
	/*public function __construct($_id, $_username, $_password, $_fullname, $_birthday, $_loginTime, $_regTime, $_numContest, $_scoreRate, $_avatar, $_type)
	{
		$this->id = $_id;
		$this->username = $_username;
		$this->password = $_password;
		$this->fullname = $_fullname;
		$this->birthday = $_birthday;
		$this->loginTime = $_loginTime;
		$this->regTime = $_regTime;
		$this->numContest = $_numContest;
		$this->scoreRate = $scoreRate;
		$this->avatar = $_avatar;
		$this->type = $_type;
	}
	*/
	public function signup($user)
	{
		$db = DB::getInstance();
		$query = "INSERT INTO `user`(`username`, `password`, `fullname`, `birthday`, `email`, `sex`, `regTime`, `loginTime`, `numContest`, `scoreRate`, `type`, `avatar`) VALUES ('".$user['username']."', '".$user['password']."', '".$user['fullname']."', '".$user['birthday']."', '".$user['email']."', ".$user['sex'].", '".$user['regTime']."', '".$user['loginTime']."', ".$user['numContest'].", ".$user['scoreRate'].", ".$user['type'].", '".$user['avatar']."' )";
		$req = $db->query($query);
		return $req;
	}
	public function getByUsername($username)
	{
		$db = DB::getInstance();
		$req = $db->query("select * from user where username = '$username'");
		return $req;
	}
	public function updateTimeLogin($id)
	{
		$db = DB::getInstance();
		$req = $db->query("UPDATE `user` SET `loginTime` = '".date("Y-m-d H:i:s")."' WHERE `id` = $id");
		return $req;
	}
	
	
}

?>