<?php
$servername = "localhost";
$username = "hungs20";
$password = "hung2710";

class DB
{
    private static $instance = NULl;
    public static function getInstance() {
      if (!isset(self::$instance)) {
        try {
          self::$instance = new PDO("mysql:host=localhost;dbname=tracnghiem", "hungs20", "hung2710", [PDO::ATTR_EMULATE_PREPARES => false, 
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