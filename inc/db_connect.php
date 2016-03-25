<?php
require "dbmanager.php";

$dbname = "mPaster";
$dbuser = "paster";
$dbpass = "rt8RUHMpXQZ5pu4A";
$dbhost = "localhost";

$DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

$DBM = new DBManager($DBH);

?>
