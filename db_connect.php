<?php
// require "loginhelper.php";
require "dbmanager.php";

$dbname = "martenxy_paster";
$dbuser = "martenxy_paster";
$dbpass = "pass";
$dbhost = "localhost";

$DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

// $lh = new loginHelper($DBH);
$DBM = new DBManager($DBH);

?>
