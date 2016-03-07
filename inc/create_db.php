<?php
include "db_connect.php";
$sql = $DBH->prepare("CREATE TABLE IF NOT EXISTS `users`(`id` int(11) NOT NULL AUTO_INCREMENT, `username` text NOT NULL, `password` text NOT NULL, `psalt` text NOT NULL, PRIMARY KEY(`id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");
$sql->execute();
while ($r = $sql->fetch()) {
    echo $r . " <br />";
	echo "DONE";
}
echo "End Script";
?>