<?php

global $config;
$config = require_once($_SERVER['DOCUMENT_ROOT'].'/config/init.php');
date_default_timezone_set("Asia/Bangkok");
function xss_clean($value) {
	return htmlspecialchars(strip_tags($value));
}
?>