<?php
include_once 'config.php';
$var = '20/04/2012';
$date = str_replace('/', '-', $var);

$date = new DateTime(date('Y-m-d', strtotime($date))." 01:00 AM");
echo $date->format('Y-m-d G:i:s');
?>