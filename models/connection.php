<?php
$servername = "localhost";
$username = "hungs20";
$password = "hung2710";
//mysql://bf4e459bc6e653:40ef37b6@us-cdbr-iron-east-01.cleardb.net/heroku_7b0aa3836e09062?reconnect=true
class DB
{
    private static $instance = NULl;
    public static function getInstance() {
      if (!isset(self::$instance)) {
        try {
          self::$instance = new PDO("mysql:host=us-cdbr-iron-east-01.cleardb.net;dbname=heroku_7b0aa3836e09062", "bf4e459bc6e653", "40ef37b6", [PDO::ATTR_EMULATE_PREPARES => false, 
       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
          self::$instance->exec("SET NAMES 'utf8'");
		  
        } catch (PDOException $ex) {
          die($ex->getMessage());
        }
      }
      return self::$instance;
    }
}
?>
